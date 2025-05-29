<?php
if (!defined('ABSPATH')) {
    exit;
}

class Tax_Calculator {
    public function init() {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('wp_ajax_tax_calculator_submit', array($this, 'handle_submission'));
        add_action('wp_ajax_nopriv_tax_calculator_submit', array($this, 'handle_submission'));
        add_shortcode('tax_calculator', array($this, 'render_calculator'));
    }

    public function enqueue_scripts() {
        // Enqueue Bootstrap CSS
       
        // Enqueue Material Icons
        wp_enqueue_style(
            'material-icons',
            'https://fonts.googleapis.com/icon?family=Material+Icons',
            array(),
            null
        );

        // Enqueue our custom CSS
        wp_enqueue_style(
            'tax-calculator',
            TAX_CALCULATOR_PLUGIN_URL . 'assets/css/tax-calculator.css',
            array('bootstrap'),
            TAX_CALCULATOR_VERSION
        );

        // Enqueue Bootstrap JS
        wp_enqueue_script(
            'bootstrap',
            'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js',
            array('jquery'),
            '5.3.0',
            true
        );

        // Enqueue our custom JS
        wp_enqueue_script(
            'tax-calculator',
            TAX_CALCULATOR_PLUGIN_URL . 'assets/js/tax-calculator.js',
            array('jquery', 'bootstrap'),
            TAX_CALCULATOR_VERSION,
            true
        );

        wp_localize_script('tax-calculator', 'taxCalculator', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('tax_calculator_nonce'),
            'minDonation' => get_option('tax_calculator_settings')['min_donation'] ?? 1,
            'maxYears' => get_option('tax_calculator_max_years', 10)
        ));
    }

    public function render_calculator($atts = array()) {
        // Define default values for the new text attributes
        $default_texts = array(
            'text_monthly_donation_label' => esc_html__('The amount I am happy to give each month', 'tax-calculator'),
            'text_years_label' => esc_html__('The number of years over which I wish to spread my donation', 'tax-calculator'),
            'text_one_off_donation_label' => esc_html__('The amount I am happy to give as a one-off donation', 'tax-calculator'),
            'text_invalid_amount_message' => esc_html__('Amount is required and should be more than &pound;1', 'tax-calculator'),
            'text_invalid_years_message' => esc_html__('Years count should be from 1 to 10', 'tax-calculator')
        );

        $parsed_atts = shortcode_atts($default_texts, $atts, 'tax_calculator');
        
        // Extract attributes into variables for the template
        extract($parsed_atts);

        ob_start();
        include TAX_CALCULATOR_PLUGIN_DIR . 'templates/tax-calculator.php';
        return ob_get_clean();
    }

    public function handle_submission() {
        // Validate required fields
        $required_fields = array('firstName', 'lastName', 'email', 'address', 'postalTown', 'postalCode', 'country', 'mobile');
        foreach ($required_fields as $field) {
            if (empty($_POST[$field])) {
                wp_send_json_error(array(
                    'message' => sprintf(__('Please fill in the %s field.', 'tax-calculator'), $field)
                ));
                return;
            }
        }

        // Validate years if phased donation
        if (isset($_POST['donation_way']) && $_POST['donation_way'] === 'phased') {
            $years = isset($_POST['years']) ? intval($_POST['years']) : 0;
            $max_years = get_option('tax_calculator_max_years', 10);
            
            if ($years < 1 || $years > $max_years) {
                wp_send_json_error(array(
                    'message' => sprintf(__('Years count should be from 1 to %d', 'tax-calculator'), $max_years)
                ));
                return;
            }
        }

        $data = array(
            'firstName' => sanitize_text_field($_POST['firstName']),
            'lastName' => sanitize_text_field($_POST['lastName']),
            'email' => sanitize_email($_POST['email']),
            'address' => sanitize_textarea_field($_POST['address']),
            'postalTown' => sanitize_text_field($_POST['postalTown']),
            'postalCode' => sanitize_text_field($_POST['postalCode']),
            'country' => sanitize_text_field($_POST['country']),
            'mobile' => sanitize_text_field($_POST['mobile']),
            'donation_amount' => floatval($_POST['donation_amount']),
            'donation_way' => sanitize_text_field($_POST['donation_way']),
            'years' => isset($_POST['years']) ? intval($_POST['years']) : null,
            'gift_aid' => isset($_POST['gift_aid']) && $_POST['gift_aid'] === 'yes',
            'gift_aid_date' => isset($_POST['gift_aid_date']) ? sanitize_text_field($_POST['gift_aid_date']) : null,
            'public_acknowledgment' => isset($_POST['public_acknowledgment']) && $_POST['public_acknowledgment'] === 'yes',
            'appear_name' => isset($_POST['appear_name']) ? sanitize_text_field($_POST['appear_name']) : null,
            'donation_for' => isset($_POST['donation_for']) ? sanitize_text_field($_POST['donation_for']) : null
        );

        // Save to database
        $submission_id = Tax_Calculator_DB::save_submission($data);

        if ($submission_id) {
            // Send emails
            $this->send_emails($data);

            wp_send_json_success(array(
                'message' => __('Thank you for your submission!', 'tax-calculator'),
                'submission_id' => $submission_id
            ));
        } else {
            wp_send_json_error(array(
                'message' => __('There was an error saving your submission.', 'tax-calculator')
            ));
        }
    }

    private function send_emails($data) {
        $admin_emails = get_option('tax_calculator_admin_emails', array(get_option('admin_email')));
        $subject = get_option('tax_calculator_email_subject', __('New Donation Form Submission', 'tax-calculator'));
        $message = $this->get_email_template($data);

        foreach ($admin_emails as $email) {
            wp_mail($email, $subject, $message, array('Content-Type: text/html; charset=UTF-8'));
        }

        // Send confirmation email to user
        $user_subject = get_option('tax_calculator_user_email_subject', __('Thank you from Amici Bruerni', 'tax-calculator'));
        $user_message = $this->get_user_email_template($data);
        wp_mail($data['email'], $user_subject, $user_message, array('Content-Type: text/html; charset=UTF-8'));
    }

    private function get_email_template($data) {
        ob_start();
        include TAX_CALCULATOR_PLUGIN_DIR . 'templates/email-template.php';
        return ob_get_clean();
    }

    private function get_user_email_template($data) {
        ob_start();
        include TAX_CALCULATOR_PLUGIN_DIR . 'templates/user-email-template.php';
        return ob_get_clean();
    }
}

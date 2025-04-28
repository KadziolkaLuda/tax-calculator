<?php
if (!defined('ABSPATH')) {
    exit;
}

class Tax_Calculator_Admin {
    private $settings_page = 'tax-calculator-settings';
    private $submissions_page = 'tax-calculator-submissions';

    public function init() {
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_init', array($this, 'register_settings'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
        add_action('wp_ajax_tax_calculator_export_csv', array($this, 'export_csv'));
        add_action('wp_ajax_tax_calculator_delete_submission', array($this, 'delete_submission'));
    }

    public function add_admin_menu() {
        add_menu_page(
            __('Tax Calculator', 'tax-calculator'),
            __('Tax Calculator', 'tax-calculator'),
            'manage_options',
            $this->settings_page,
            array($this, 'render_settings_page'),
            'dashicons-calculator',
            30
        );

        add_submenu_page(
            $this->settings_page,
            __('Submissions', 'tax-calculator'),
            __('Submissions', 'tax-calculator'),
            'manage_options',
            $this->submissions_page,
            array($this, 'render_submissions_page')
        );
    }

    public function register_settings() {
        register_setting('tax_calculator_settings', 'tax_calculator_min_donation');
        register_setting('tax_calculator_settings', 'tax_calculator_max_years');
        register_setting('tax_calculator_settings', 'tax_calculator_admin_emails', array(
            'type' => 'array',
            'sanitize_callback' => array($this, 'sanitize_admin_emails')
        ));
        register_setting('tax_calculator_settings', 'tax_calculator_email_subject');
        register_setting('tax_calculator_settings', 'tax_calculator_email_template');
        register_setting('tax_calculator_settings', 'tax_calculator_user_email_subject');
        register_setting('tax_calculator_settings', 'tax_calculator_user_email_template');
    }

    public function sanitize_admin_emails($emails) {
        if (is_string($emails)) {
            $emails = explode("\n", $emails);
        }
        
        $sanitized_emails = array();
        foreach ($emails as $email) {
            $email = trim($email);
            if (is_email($email)) {
                $sanitized_emails[] = $email;
            }
        }
        
        return array_unique($sanitized_emails);
    }

    public function enqueue_admin_scripts($hook) {
        if (strpos($hook, 'tax-calculator') === false) {
            return;
        }

        // Enqueue admin CSS
        wp_enqueue_style(
            'tax-calculator-admin',
            plugins_url('assets/css/admin.css', dirname(__FILE__)),
            array(),
            TAX_CALCULATOR_VERSION
        );

        // Enqueue jQuery if not already loaded
        wp_enqueue_script('jquery');

        // Enqueue admin JS
        wp_enqueue_script(
            'tax-calculator-admin',
            plugins_url('assets/js/admin.js', dirname(__FILE__)),
            array('jquery'),
            TAX_CALCULATOR_VERSION,
            true
        );

        // Localize the script with new data
        wp_localize_script('tax-calculator-admin', 'taxCalculatorAdmin', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('tax_calculator_admin_nonce'),
            'confirmDelete' => __('Are you sure you want to delete this submission?', 'tax-calculator'),
            'confirmExport' => __('Are you sure you want to export all submissions?', 'tax-calculator')
        ));
    }

    public function render_settings_page() {
        if (!current_user_can('manage_options')) {
            return;
        }

        include TAX_CALCULATOR_PLUGIN_DIR . 'templates/admin/settings.php';
    }

    public function render_submissions_page() {
        if (!current_user_can('manage_options')) {
            return;
        }

        $submissions = Tax_Calculator_DB::get_submissions(array(
            'per_page' => 20,
            'page' => isset($_GET['paged']) ? max(1, intval($_GET['paged'])) : 1,
            'search' => isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '',
            'date_from' => isset($_GET['date_from']) ? sanitize_text_field($_GET['date_from']) : '',
            'date_to' => isset($_GET['date_to']) ? sanitize_text_field($_GET['date_to']) : ''
        ));

        include TAX_CALCULATOR_PLUGIN_DIR . 'templates/admin/submissions.php';
    }

    public function export_csv() {
        if (!current_user_can('manage_options')) {
            wp_die(__('You do not have sufficient permissions to access this page.'));
        }

        check_ajax_referer('tax_calculator_admin_nonce', 'nonce');

        // Get filter parameters
        $search = isset($_GET['search']) ? sanitize_text_field($_GET['search']) : '';
        $date_from = isset($_GET['date_from']) ? sanitize_text_field($_GET['date_from']) : '';
        $date_to = isset($_GET['date_to']) ? sanitize_text_field($_GET['date_to']) : '';

        // Get all submissions with filters
        $args = array(
            'per_page' => -1, // Get all records
            'page' => 1,
            'search' => $search,
            'date_from' => $date_from,
            'date_to' => $date_to
        );

        $submissions = Tax_Calculator_DB::get_submissions($args);

        if (empty($submissions['items'])) {
            wp_die(__('No submissions found to export.', 'tax-calculator'));
        }

        // Set headers for CSV download
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=tax-calculator-submissions-' . date('Y-m-d') . '.csv');

        // Create output stream
        $output = fopen('php://output', 'w');

        // Add UTF-8 BOM
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

        // Add headers
        $headers = array(
            'ID',
            'First Name',
            'Last Name',
            'Email',
            'Address',
            'Postal Town',
            'Postal Code',
            'Country',
            'Mobile',
            'Donation Type',
            'Donation Amount',
            'Years',
            'Tax Rate',
            'Gift Aid',
            'Total Amount',
            'Net Monthly Cost',
            'Net Annual Cost',
            'Total Net Cost',
            'Total Value with Gift Aid',
            'IP Address',
            'Created At'
        );
        
        // Write headers with semicolon delimiter
        fputcsv($output, $headers, ';');

        // Add data
        foreach ($submissions['items'] as $submission) {
            $row = array(
                $submission->id,
                $submission->first_name,
                $submission->last_name,
                $submission->email,
                $submission->address,
                $submission->postal_town,
                $submission->postal_code,
                $submission->country,
                $submission->mobile,
                $submission->donation_type,
                $submission->donation_amount,
                $submission->years,
                $submission->tax_rate,
                $submission->gift_aid ? 'Yes' : 'No',
                $submission->total_amount,
                $submission->net_monthly_cost,
                $submission->net_annual_cost,
                $submission->total_net_cost,
                $submission->total_value_with_gift_aid,
                $submission->ip_address,
                $submission->created_at
            );
            
            // Write row with semicolon delimiter
            fputcsv($output, $row, ';');
        }

        fclose($output);
        exit;
    }

    public function delete_submission() {
        if (!current_user_can('manage_options')) {
            wp_die(__('You do not have sufficient permissions to access this page.', 'tax-calculator'));
        }

        check_ajax_referer('tax_calculator_admin_nonce', 'nonce');

        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        if ($id) {
            Tax_Calculator_DB::delete_submission($id);
            wp_send_json_success();
        }

        wp_send_json_error();
    }
}

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
        add_action('wp_ajax_tax_calculator_delete_submission', array($this, 'handle_delete_submission'));
        add_action('wp_ajax_tax_calculator_export_csv', array($this, 'handle_export_csv'));
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

    public function handle_export_csv() {
        if (!current_user_can('manage_options')) {
            wp_die(__('You do not have sufficient permissions to access this page.'));
        }

        check_ajax_referer('tax_calculator_admin_nonce', 'nonce');

        // Get filter parameters
        $args = array(
            'search' => isset($_GET['search']) ? sanitize_text_field($_GET['search']) : '',
            'date_from' => isset($_GET['date_from']) ? sanitize_text_field($_GET['date_from']) : '',
            'date_to' => isset($_GET['date_to']) ? sanitize_text_field($_GET['date_to']) : ''
        );

        // Use the export class to handle the export
        Tax_Calculator_Export::export_csv($args);
    }

    public function handle_delete_submission() {
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

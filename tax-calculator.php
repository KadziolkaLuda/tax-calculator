<?php
/**
 * Plugin Name: Tax Calculator
 * Plugin URI: https://yourwebsite.com/tax-calculator
 * Description: A donation calculator with Gift Aid and tax relief calculations, integrated with Elementor.
 * Version: 1.0.0
 * Author: Your Name
 * Author URI: https://yourwebsite.com
 * Text Domain: tax-calculator
 * Domain Path: /languages
 * Requires at least: 5.8
 * Requires PHP: 7.4
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Define plugin constants
define('TAX_CALCULATOR_VERSION', '1.0.0');
define('TAX_CALCULATOR_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('TAX_CALCULATOR_PLUGIN_URL', plugin_dir_url(__FILE__));
define('TAX_CALCULATOR_PLUGIN_BASENAME', plugin_basename(__FILE__));

// Include required files
require_once TAX_CALCULATOR_PLUGIN_DIR . 'includes/class-tax-calculator.php';
require_once TAX_CALCULATOR_PLUGIN_DIR . 'includes/class-tax-calculator-db.php';
require_once TAX_CALCULATOR_PLUGIN_DIR . 'includes/class-tax-calculator-admin.php';
require_once TAX_CALCULATOR_PLUGIN_DIR . 'includes/class-tax-calculator-export.php';

// Initialize the plugin
function tax_calculator_init() {
    try {
        // Initialize main plugin class
        $tax_calculator = new Tax_Calculator();
        $tax_calculator->init();

        // Initialize admin
        if (is_admin()) {
            $tax_calculator_admin = new Tax_Calculator_Admin();
            $tax_calculator_admin->init();
        }
    } catch (Exception $e) {
        error_log('Tax Calculator Error: ' . $e->getMessage());
    }
}
add_action('plugins_loaded', 'tax_calculator_init');

// Activation hook
register_activation_hook(__FILE__, 'tax_calculator_activate');
function tax_calculator_activate() {
    try {
        // Create database tables
        require_once TAX_CALCULATOR_PLUGIN_DIR . 'includes/class-tax-calculator-db.php';
        Tax_Calculator_DB::create_tables();

        // Set default options
        $default_options = array(
            'admin_email' => get_option('admin_email'),
            'additional_emails' => array(),
            'min_donation' => 1,
            'max_years' => 3
        );
        add_option('tax_calculator_settings', $default_options);
    } catch (Exception $e) {
        error_log('Tax Calculator Activation Error: ' . $e->getMessage());
    }
}

// Deactivation hook
register_deactivation_hook(__FILE__, 'tax_calculator_deactivate');
function tax_calculator_deactivate() {
    // Cleanup if needed
}

// Enqueue styles and scripts
function tax_calculator_enqueue_assets() {
    // Enqueue Bootstrap CSS from CDN
    wp_enqueue_style(
        'bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css',
        array(),
        '5.3.0'
    );

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
        TAX_CALCULATOR_PLUGIN_URL . 'assets/css/tax-calculator.min.css',
        array('bootstrap'),
        TAX_CALCULATOR_VERSION
    );

    // Enqueue Bootstrap JS from CDN
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

    // Localize script with necessary data
    wp_localize_script('tax-calculator', 'taxCalculator', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('tax_calculator_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'tax_calculator_enqueue_assets');

// Elementor Widget Registration
function register_tax_calculator_widget($widgets_manager) {
    require_once TAX_CALCULATOR_PLUGIN_DIR . 'includes/class-tax-calculator-elementor.php';
    $widgets_manager->register(new Tax_Calculator_Elementor_Widget());
}
add_action('elementor/widgets/register', 'register_tax_calculator_widget');

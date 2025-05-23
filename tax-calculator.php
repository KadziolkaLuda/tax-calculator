<?php
/**
 * Plugin Name: Tax Calculator
 * Plugin URI: https://github.com/KadziolkaLuda/tax-calculator
 * Description: A donation calculator with Gift Aid and tax relief calculations, integrated with Elementor.
 * Version: 1.0.0
 * Author: Liudmyla Kadziolka
 * Author URI: https://github.com/KadziolkaLuda
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
define('TAX_CALCULATOR_DEV_MODE', true); // Set to false in production

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
    try {
        // Delete plugin options
        delete_option('tax_calculator_settings');
        
        // Delete database tables
        global $wpdb;
        $wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}tax_calculator_donations");
        $wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}tax_calculator_settings");
        
        // Clear any transients
        delete_transient('tax_calculator_cache');
        
        // Clear any scheduled events
        wp_clear_scheduled_hook('tax_calculator_daily_cleanup');
        
    } catch (Exception $e) {
        error_log('Tax Calculator Deactivation Error: ' . $e->getMessage());
    }
}

// Enqueue styles and scripts
function tax_calculator_enqueue_assets() {
    // Enqueue Material Icons
    wp_enqueue_style(
        'material-icons',
        'https://fonts.googleapis.com/icon?family=Material+Icons',
        array(),
        null
    );

    // Enqueue our custom CSS
    if (defined('TAX_CALCULATOR_DEV_MODE') && TAX_CALCULATOR_DEV_MODE) {
        // In development mode, use uncompressed CSS and add timestamp to prevent caching
        wp_enqueue_style(
            'tax-calculator',
            TAX_CALCULATOR_PLUGIN_URL . 'assets/css/tax-calculator.css',
            array(),
            time() // Use timestamp to prevent caching
        );
    } else {
        // In production mode, use minified CSS with version number
        wp_enqueue_style(
            'tax-calculator',
            TAX_CALCULATOR_PLUGIN_URL . 'assets/css/tax-calculator.min.css',
            array(),
            TAX_CALCULATOR_VERSION
        );
    }

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

// Add deactivation warning
function tax_calculator_admin_notices() {
    $screen = get_current_screen();
    if ($screen && $screen->id === 'plugins') {
        ?>
        <div class="notice notice-warning is-dismissible tax-calculator-deactivation-warning" style="display: none;">
            <p><strong>Warning:</strong> Deactivating the Tax Calculator plugin will remove all calculator data and settings. This action cannot be undone. Are you sure you want to proceed?</p>
        </div>
        <script type="text/javascript">
        jQuery(document).ready(function($) {
            function showWarning() {
                $('.tax-calculator-deactivation-warning').show();
            }
            
            function hideWarning() {
                $('.tax-calculator-deactivation-warning').hide();
            }
            
            function handleDeactivation(e) {
                e.preventDefault();
                e.stopPropagation();
                var deactivateLink = $(this).attr('href');
                
                if (confirm('Warning: Deactivating the Tax Calculator plugin will remove all calculator data and settings. This action cannot be undone. Are you sure you want to proceed?')) {
                    window.location.href = deactivateLink;
                }
                return false;
            }
            
            function attachDeactivationEvents() {
                var selectors = [
                    'a[href*="action=deactivate&plugin=<?php echo TAX_CALCULATOR_PLUGIN_BASENAME; ?>"]',
                    'a[href*="deactivate&plugin=<?php echo TAX_CALCULATOR_PLUGIN_BASENAME; ?>"]',
                    'tr[data-plugin="<?php echo TAX_CALCULATOR_PLUGIN_BASENAME; ?>"] .deactivate a',
                    'tr[data-plugin="<?php echo TAX_CALCULATOR_PLUGIN_BASENAME; ?>"] a[href*="deactivate"]'
                ];
                
                var deactivateLinks = null;
                for (var i = 0; i < selectors.length; i++) {
                    deactivateLinks = $(selectors[i]);
                    if (deactivateLinks.length > 0) {
                        break;
                    }
                }
                
                if (deactivateLinks && deactivateLinks.length > 0) {
                    deactivateLinks.off('mouseenter mouseleave click')
                                 .on('mouseenter', showWarning)
                                 .on('mouseleave', hideWarning)
                                 .on('click', handleDeactivation);
                }
            }
            
            attachDeactivationEvents();
            
            var observer = new MutationObserver(function(mutations) {
                attachDeactivationEvents();
            });
            
            var pluginsTable = document.querySelector('.wp-list-table.plugins');
            if (pluginsTable) {
                observer.observe(pluginsTable, {
                    childList: true,
                    subtree: true
                });
            }
            
            var attempts = 0;
            var interval = setInterval(function() {
                if (attempts >= 10) {
                    clearInterval(interval);
                    return;
                }
                attachDeactivationEvents();
                attempts++;
            }, 500);
        });
        </script>
        <?php
    }
}
add_action('admin_notices', 'tax_calculator_admin_notices');

// Add deactivation confirmation script
function tax_calculator_admin_scripts() {
    $screen = get_current_screen();
    if ($screen && $screen->id === 'plugins') {
        ?>
        <script type="text/javascript">
        jQuery(document).ready(function($) {
            // Debug log
            console.log('Tax Calculator deactivation script loaded');
            
            // Function to show warning
            function showWarning() {
                console.log('Showing warning');
                $('.tax-calculator-deactivation-warning').show();
            }
            
            // Function to hide warning
            function hideWarning() {
                console.log('Hiding warning');
                $('.tax-calculator-deactivation-warning').hide();
            }
            
            // Function to handle deactivation
            function handleDeactivation(e) {
                console.log('Deactivation clicked');
                e.preventDefault();
                var deactivateLink = $(this).attr('href');
                
                if (confirm('Warning: Deactivating the Tax Calculator plugin will remove all calculator data and settings. This action cannot be undone. Are you sure you want to proceed?')) {
                    window.location.href = deactivateLink;
                }
            }
            
            // Find all deactivate links for our plugin
            var deactivateLinks = $('a[href*="action=deactivate&plugin=<?php echo TAX_CALCULATOR_PLUGIN_BASENAME; ?>"]');
            console.log('Found deactivate links:', deactivateLinks.length);
            
            // Add hover events
            deactivateLinks.on('mouseenter', showWarning)
                          .on('mouseleave', hideWarning)
                          .on('click', handleDeactivation);
            
            // Handle bulk actions
            $('#bulk-action-selector-top, #bulk-action-selector-bottom').on('change', function() {
                if ($(this).val() === 'deactivate-selected') {
                    showWarning();
                } else {
                    hideWarning();
                }
            });
            
            // Handle bulk form submission
            $('#plugins-form').on('submit', function(e) {
                if ($('#bulk-action-selector-top').val() === 'deactivate-selected' || 
                    $('#bulk-action-selector-bottom').val() === 'deactivate-selected') {
                    if ($('input[name="checked[]"][value="<?php echo TAX_CALCULATOR_PLUGIN_BASENAME; ?>"]').is(':checked')) {
                        if (!confirm('Warning: Deactivating the Tax Calculator plugin will remove all calculator data and settings. This action cannot be undone. Are you sure you want to proceed?')) {
                            e.preventDefault();
                        }
                    }
                }
            });
            
            // Add warning to the DOM if it doesn't exist
            if ($('.tax-calculator-deactivation-warning').length === 0) {
                $('<div class="notice notice-warning is-dismissible tax-calculator-deactivation-warning" style="display: none;"><p><strong>Warning:</strong> Deactivating the Tax Calculator plugin will remove all calculator data and settings. This action cannot be undone. Are you sure you want to proceed?</p></div>').insertAfter('.wrap h1');
            }
        });
        </script>
        <?php
    }
}
add_action('admin_footer', 'tax_calculator_admin_scripts');

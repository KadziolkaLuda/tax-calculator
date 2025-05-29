<?php
if (!defined('ABSPATH')) {
    exit;
}

// Get default templates
$default_admin_template = file_get_contents(TAX_CALCULATOR_PLUGIN_DIR . 'templates/email-template.php');
$default_user_template = file_get_contents(TAX_CALCULATOR_PLUGIN_DIR . 'templates/user-email-template.php');

// Get current templates or use defaults if not set
$admin_template = get_option('tax_calculator_email_template');
$user_template = get_option('tax_calculator_user_email_template');

// If templates are not set in database, use defaults
if ($admin_template === false) {
    $admin_template = $default_admin_template;
}
if ($user_template === false) {
    $user_template = $default_user_template;
}
?>
<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    
    <form method="post" action="options.php">
        <?php
        settings_fields('tax_calculator_settings');
        do_settings_sections('tax_calculator_settings');
        ?>
        
        <table class="form-table">
            <tr>
                <th scope="row">
                    <label for="tax_calculator_max_years"><?php _e('Maximum Number of Years', 'tax-calculator'); ?></label>
                </th>
                <td>
                    <input type="number" 
                           id="tax_calculator_max_years" 
                           name="tax_calculator_max_years" 
                           value="<?php echo esc_attr(get_option('tax_calculator_max_years', 3)); ?>" 
                           min="1" 
                           max="10" 
                           class="regular-text" />
                    <p class="description"><?php _e('The maximum number of years for recurring donations.', 'tax-calculator'); ?></p>
                </td>
            </tr>
            
            <tr>
                <th scope="row">
                    <label for="tax_calculator_admin_emails"><?php _e('Admin Emails', 'tax-calculator'); ?></label>
                </th>
                <td>
                    <textarea id="tax_calculator_admin_emails" 
                              name="tax_calculator_admin_emails" 
                              rows="5" 
                              class="large-text code"><?php 
                        $admin_emails = get_option('tax_calculator_admin_emails', array(get_option('admin_email')));
                        echo esc_textarea(implode("\n", $admin_emails)); 
                    ?></textarea>
                    <p class="description"><?php _e('Enter one email address per line. These emails will receive notifications about new submissions.', 'tax-calculator'); ?></p>
                </td>
            </tr>
            
            <tr>
                <th scope="row">
                    <label for="tax_calculator_email_subject"><?php _e('Admin Email Subject', 'tax-calculator'); ?></label>
                </th>
                <td>
                    <input type="text" 
                           id="tax_calculator_email_subject" 
                           name="tax_calculator_email_subject" 
                           value="<?php echo esc_attr(get_option('tax_calculator_email_subject', __('New Donation Form Submission', 'tax-calculator'))); ?>" 
                           class="regular-text" />
                </td>
            </tr>
            
            <tr>
                <th scope="row">
                    <label for="tax_calculator_email_template"><?php _e('Admin Email Template', 'tax-calculator'); ?></label>
                </th>
                <td>
                    <textarea id="tax_calculator_email_template" 
                              name="tax_calculator_email_template" 
                              rows="10" 
                              class="large-text code"><?php echo esc_textarea($admin_template); ?></textarea>
                    <p class="description"><?php _e('Available placeholders: {first_name}, {last_name}, {email}, {mobile}, {address}, {postal_town}, {postal_code}, {country}, {donation_amount}, {donation_way}, {years_html}, {donation_for}, {gift_aid}, {gift_aid_date_html}, {public_acknowledgment}, {appear_name_html}', 'tax-calculator'); ?></p>
                </td>
            </tr>
            
            <tr>
                <th scope="row">
                    <label for="tax_calculator_user_email_subject"><?php _e('User Email Subject', 'tax-calculator'); ?></label>
                </th>
                <td>
                    <input type="text" 
                           id="tax_calculator_user_email_subject" 
                           name="tax_calculator_user_email_subject" 
                           value="<?php echo esc_attr(get_option('tax_calculator_user_email_subject', __('Thank you from Amici Bruerni', 'tax-calculator'))); ?>" 
                           class="regular-text" />
                </td>
            </tr>
            
            <tr>
                <th scope="row">
                    <label for="tax_calculator_user_email_template"><?php _e('User Email Template', 'tax-calculator'); ?></label>
                </th>
                <td>
                    <textarea id="tax_calculator_user_email_template" 
                              name="tax_calculator_user_email_template" 
                              rows="10" 
                              class="large-text code"><?php echo esc_textarea($user_template); ?></textarea>
                    <p class="description"><?php _e('Available placeholders: {first_name}', 'tax-calculator'); ?></p>
                </td>
            </tr>
        </table>
        
        <?php submit_button(); ?>
    </form>
</div> 
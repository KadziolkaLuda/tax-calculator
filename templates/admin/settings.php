<?php
if (!defined('ABSPATH')) {
    exit;
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
                    <label for="tax_calculator_min_donation"><?php _e('Minimum Donation Amount', 'tax-calculator'); ?></label>
                </th>
                <td>
                    <input type="number" 
                           id="tax_calculator_min_donation" 
                           name="tax_calculator_min_donation" 
                           value="<?php echo esc_attr(get_option('tax_calculator_min_donation', 1)); ?>" 
                           min="1" 
                           step="0.01" 
                           class="regular-text" />
                    <p class="description"><?php _e('The minimum amount that can be donated.', 'tax-calculator'); ?></p>
                </td>
            </tr>
            
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
                           value="<?php echo esc_attr(get_option('tax_calculator_email_subject', __('New Tax Calculator Submission', 'tax-calculator'))); ?>" 
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
                              class="large-text code"><?php echo esc_textarea(get_option('tax_calculator_email_template', __('A new submission has been received from {first_name} {last_name}.', 'tax-calculator'))); ?></textarea>
                    <p class="description"><?php _e('Available placeholders: {first_name}, {last_name}, {email}, {donation_amount}, {years}, {tax_rate}, {gift_aid}, {total_amount}', 'tax-calculator'); ?></p>
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
                           value="<?php echo esc_attr(get_option('tax_calculator_user_email_subject', __('Thank you for your donation calculation', 'tax-calculator'))); ?>" 
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
                              class="large-text code"><?php echo esc_textarea(get_option('tax_calculator_user_email_template', __('Dear {first_name},\n\nThank you for using our tax calculator. Here are your calculation results:\n\nDonation Amount: {donation_amount}\nYears: {years}\nTax Rate: {tax_rate}\nGift Aid: {gift_aid}\nTotal Amount: {total_amount}\n\nBest regards,\nYour Charity', 'tax-calculator'))); ?></textarea>
                    <p class="description"><?php _e('Available placeholders: {first_name}, {last_name}, {email}, {donation_amount}, {years}, {tax_rate}, {gift_aid}, {total_amount}', 'tax-calculator'); ?></p>
                </td>
            </tr>
        </table>
        
        <?php submit_button(); ?>
    </form>
</div> 
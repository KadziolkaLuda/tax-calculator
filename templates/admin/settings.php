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
                              class="large-text code"><?php echo esc_textarea(get_option('tax_calculator_email_template', __('<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Donation Form Submission</title>
</head>
<body>
    <h2>New Donation Submission</h2>
    
    <p><strong>Donor Details:</strong></p>
    <ul>
        <li>Name: {first_name} {last_name}</li>
        <li>Email: {email}</li>
        <li>Phone: {mobile}</li>
        <li>Address: {address}</li>
        <li>Postal Town: {postal_town}</li>
        <li>Postal Code: {postal_code}</li>
        <li>Country: {country}</li>
    </ul>

    <p><strong>Donation Details:</strong></p>
    <ul>
        <li>Amount: £{donation_amount}</li>
        <li>Donation Way: {donation_way}</li>
        {years_html}
        <li>Donation For: {donation_for}</li>
    </ul>

    <p><strong>Gift Aid:</strong></p>
    <ul>
        <li>Gift Aid: {gift_aid}</li>
        {gift_aid_date_html}
    </ul>

    <p><strong>Acknowledgment:</strong></p>
    <ul>
        <li>Acknowledgment: {public_acknowledgment}</li>
        {appear_name_html}
    </ul>
</body>
</html>', 'tax-calculator'))); ?></textarea>
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
                              class="large-text code"><?php echo esc_textarea(get_option('tax_calculator_user_email_template', __('Dear {first_name},

Thank you very much indeed for completing our donation form.

This is an automated message, but we will be in touch with you personally very soon to thank you properly and to answer any questions.

Kind regards
The AB Team', 'tax-calculator'))); ?></textarea>
                    <p class="description"><?php _e('Available placeholders: {first_name}', 'tax-calculator'); ?></p>
                </td>
            </tr>
        </table>
        
        <?php submit_button(); ?>
    </form>
</div> 
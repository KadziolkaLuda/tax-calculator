<?php
/**
 * Email Template for User Confirmation
 */
if (!defined('ABSPATH')) {
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php _e('Thank you from Amici Bruerni', 'tax-calculator'); ?></title>
</head>
<body>
    <p><?php _e('Dear', 'tax-calculator'); ?> <?php echo esc_html($data['firstName']); ?>,</p>
    
    <p><?php _e('Thank you very much indeed for completing our donation form.', 'tax-calculator'); ?></p>
    
    <p><?php _e('This is an automated message, but we will be in touch with you personally very soon to thank you properly and to answer any questions.', 'tax-calculator'); ?></p>
    
    <p><?php _e('Kind regards', 'tax-calculator'); ?><br>
    <?php _e('The AB Team', 'tax-calculator'); ?></p>
</body>
</html> 
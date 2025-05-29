<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php _e('New Donation Form Submission', 'tax-calculator'); ?></title>
</head>
<body>
    <h2><?php _e('New Donation Submission', 'tax-calculator'); ?></h2>
    
    <p><strong><?php _e('Donor Details:', 'tax-calculator'); ?></strong></p>
    <ul style="list-style-type: none; padding-left: 0; margin: 0;">
        <li style="margin-bottom: 5px;"><?php _e('Name:', 'tax-calculator'); ?> <?php echo esc_html($data['firstName'] . ' ' . $data['lastName']); ?></li>
        <li style="margin-bottom: 5px;"><?php _e('Email:', 'tax-calculator'); ?> <?php echo esc_html($data['email']); ?></li>
        <li style="margin-bottom: 5px;"><?php _e('Phone:', 'tax-calculator'); ?> <?php echo esc_html($data['mobile']); ?></li>
        <li style="margin-bottom: 5px;"><?php _e('Address:', 'tax-calculator'); ?> <?php echo esc_html($data['address']); ?></li>
        <li style="margin-bottom: 5px;"><?php _e('Postal Town:', 'tax-calculator'); ?> <?php echo esc_html($data['postalTown']); ?></li>
        <li style="margin-bottom: 5px;"><?php _e('Postal Code:', 'tax-calculator'); ?> <?php echo esc_html($data['postalCode']); ?></li>
        <li style="margin-bottom: 5px;"><?php _e('Country:', 'tax-calculator'); ?> <?php echo esc_html($data['country']); ?></li>
    </ul>

    <p><strong><?php _e('Donation Details:', 'tax-calculator'); ?></strong></p>
    <ul style="list-style-type: none; padding-left: 0; margin: 0;">
        <li style="margin-bottom: 5px;"><?php _e('Amount:', 'tax-calculator'); ?> £<?php echo number_format($data['donation_amount'], 2); ?></li>
        <li style="margin-bottom: 5px;"><?php _e('Donation Way:', 'tax-calculator'); ?> <?php echo esc_html($data['donation_way']); ?></li>
        <?php if ($data['donation_way'] === 'phased' && isset($data['years'])): ?>
        <li style="margin-bottom: 5px;"><?php _e('Years:', 'tax-calculator'); ?> <?php echo esc_html($data['years']); ?></li>
        <?php endif; ?>
        <li style="margin-bottom: 5px;"><?php _e('Donation For:', 'tax-calculator'); ?> <?php echo esc_html($data['donation_for']); ?></li>
    </ul>

    <p><strong><?php _e('Gift Aid:', 'tax-calculator'); ?></strong></p>
    <ul style="list-style-type: none; padding-left: 0; margin: 0;">
        <li style="margin-bottom: 5px;"><?php _e('Gift Aid:', 'tax-calculator'); ?> <?php echo $data['gift_aid'] ? __('Yes', 'tax-calculator') : __('No', 'tax-calculator'); ?></li>
        <?php if ($data['gift_aid'] && isset($data['gift_aid_date'])): ?>
        <li style="margin-bottom: 5px;"><?php _e('Gift Aid Date:', 'tax-calculator'); ?> <?php echo esc_html($data['gift_aid_date']); ?></li>
        <?php endif; ?>
    </ul>

    <p><strong><?php _e('Acknowledgment:', 'tax-calculator'); ?></strong></p>
    <ul style="list-style-type: none; padding-left: 0; margin: 0;">
        <li style="margin-bottom: 5px;"><?php _e('Acknowledgment:', 'tax-calculator'); ?> <?php echo $data['public_acknowledgment'] ? __('Yes', 'tax-calculator') : __('No', 'tax-calculator'); ?></li>
        <?php if ($data['public_acknowledgment'] && isset($data['appear_name'])): ?>
        <li style="margin-bottom: 5px;"><?php _e('Name to Appear:', 'tax-calculator'); ?> <?php echo esc_html($data['appear_name']); ?></li>
        <?php endif; ?>
    </ul>
</body>
</html> 
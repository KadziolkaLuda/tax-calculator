<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php _e('New Tax Calculator Submission', 'tax-calculator'); ?></title>
</head>
<body>
    <h2><?php _e('New Tax Calculator Submission', 'tax-calculator'); ?></h2>
    
    <h3><?php _e('Donor Information', 'tax-calculator'); ?></h3>
    <p><strong><?php _e('Name:', 'tax-calculator'); ?></strong> <?php echo esc_html($data['firstName'] . ' ' . $data['lastName']); ?></p>
    <p><strong><?php _e('Email:', 'tax-calculator'); ?></strong> <?php echo esc_html($data['email']); ?></p>
    <p><strong><?php _e('Address:', 'tax-calculator'); ?></strong> <?php echo esc_html($data['address']); ?></p>
    <p><strong><?php _e('Postal Town:', 'tax-calculator'); ?></strong> <?php echo esc_html($data['postalTown']); ?></p>
    <p><strong><?php _e('Postal Code:', 'tax-calculator'); ?></strong> <?php echo esc_html($data['postalCode']); ?></p>
    <p><strong><?php _e('Country:', 'tax-calculator'); ?></strong> <?php echo esc_html($data['country']); ?></p>
    <p><strong><?php _e('Mobile:', 'tax-calculator'); ?></strong> <?php echo esc_html($data['mobile']); ?></p>
    
    <h3><?php _e('Donation Details', 'tax-calculator'); ?></h3>
    <p><strong><?php _e('Donation Type:', 'tax-calculator'); ?></strong> <?php echo esc_html($data['donationType']); ?></p>
    <p><strong><?php _e('Donation Amount:', 'tax-calculator'); ?></strong> £<?php echo number_format($data['donationAmount'], 2); ?></p>
    <?php if ($data['years']) : ?>
    <p><strong><?php _e('Number of Years:', 'tax-calculator'); ?></strong> <?php echo esc_html($data['years']); ?></p>
    <?php endif; ?>
    <p><strong><?php _e('Tax Rate:', 'tax-calculator'); ?></strong> <?php echo esc_html($data['taxRate']); ?></p>
    <p><strong><?php _e('Gift Aid:', 'tax-calculator'); ?></strong> <?php echo $data['giftAid'] ? __('Yes', 'tax-calculator') : __('No', 'tax-calculator'); ?></p>
    
    <h3><?php _e('Financial Summary', 'tax-calculator'); ?></h3>
    <p><strong><?php _e('Total Amount:', 'tax-calculator'); ?></strong> £<?php echo number_format($data['totalAmount'], 2); ?></p>
    <?php if ($data['netMonthlyCost']) : ?>
    <p><strong><?php _e('Net Monthly Cost:', 'tax-calculator'); ?></strong> £<?php echo number_format($data['netMonthlyCost'], 2); ?></p>
    <?php endif; ?>
    <?php if ($data['netAnnualCost']) : ?>
    <p><strong><?php _e('Net Annual Cost:', 'tax-calculator'); ?></strong> £<?php echo number_format($data['netAnnualCost'], 2); ?></p>
    <?php endif; ?>
    <?php if ($data['totalNetCost']) : ?>
    <p><strong><?php _e('Total Net Cost:', 'tax-calculator'); ?></strong> £<?php echo number_format($data['totalNetCost'], 2); ?></p>
    <?php endif; ?>
    <p><strong><?php _e('Total Value with Gift Aid:', 'tax-calculator'); ?></strong> £<?php echo number_format($data['totalValueWithGiftAid'], 2); ?></p>
</body>
</html> 
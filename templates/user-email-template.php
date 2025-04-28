<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php _e('Thank you for your donation pledge', 'tax-calculator'); ?></title>
</head>
<body>
    <h2><?php _e('Thank you for your donation pledge', 'tax-calculator'); ?></h2>
    
    <p><?php _e('Dear', 'tax-calculator'); ?> <?php echo esc_html($data['firstName']); ?>,</p>
    
    <p><?php _e('Thank you for your generous donation pledge. Here are the details of your pledge:', 'tax-calculator'); ?></p>
    
    <h3><?php _e('Donation Details', 'tax-calculator'); ?></h3>
    <p><strong><?php _e('Donation Type:', 'tax-calculator'); ?></strong> <?php echo esc_html($data['donationType']); ?></p>
    <p><strong><?php _e('Donation Amount:', 'tax-calculator'); ?></strong> £<?php echo number_format($data['donationAmount'], 2); ?></p>
    <?php if ($data['years']) : ?>
    <p><strong><?php _e('Number of Years:', 'tax-calculator'); ?></strong> <?php echo esc_html($data['years']); ?></p>
    <?php endif; ?>
    
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
    
    <p><?php _e('If you have any questions about your donation or need to make any changes, please don\'t hesitate to contact us.', 'tax-calculator'); ?></p>
    
    <p><?php _e('Best regards,', 'tax-calculator'); ?><br>
    <?php _e('The Team', 'tax-calculator'); ?></p>
</body>
</html> 
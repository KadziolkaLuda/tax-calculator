<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    
    <div class="tablenav top">
        <div class="alignleft actions">
            <form method="get">
                <input type="hidden" name="page" value="<?php echo esc_attr($this->submissions_page); ?>" />
                <input type="text" 
                       name="s" 
                       value="<?php echo esc_attr(isset($_GET['s']) ? $_GET['s'] : ''); ?>" 
                       placeholder="<?php esc_attr_e('Search submissions...', 'tax-calculator'); ?>" />
                <input type="date" 
                       name="date_from" 
                       value="<?php echo esc_attr(isset($_GET['date_from']) ? $_GET['date_from'] : ''); ?>" 
                       placeholder="<?php esc_attr_e('From', 'tax-calculator'); ?>" />
                <input type="date" 
                       name="date_to" 
                       value="<?php echo esc_attr(isset($_GET['date_to']) ? $_GET['date_to'] : ''); ?>" 
                       placeholder="<?php esc_attr_e('To', 'tax-calculator'); ?>" />
                <input type="submit" class="button" value="<?php esc_attr_e('Filter', 'tax-calculator'); ?>" />
            </form>
        </div>
        <div class="alignright actions">
            <button type="button" 
                    class="button" 
                    id="tax-calculator-export-csv">
                <?php _e('Export CSV', 'tax-calculator'); ?>
            </button>
        </div>
    </div>
    
    <table class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th scope="col"><?php _e('ID', 'tax-calculator'); ?></th>
                <th scope="col"><?php _e('Name', 'tax-calculator'); ?></th>
                <th scope="col"><?php _e('Email', 'tax-calculator'); ?></th>
                <th scope="col"><?php _e('Donation Type', 'tax-calculator'); ?></th>
                <th scope="col"><?php _e('Amount', 'tax-calculator'); ?></th>
                <th scope="col"><?php _e('Years', 'tax-calculator'); ?></th>
                <th scope="col"><?php _e('Tax Rate', 'tax-calculator'); ?></th>
                <th scope="col"><?php _e('Gift Aid', 'tax-calculator'); ?></th>
                <th scope="col"><?php _e('Total', 'tax-calculator'); ?></th>
                <th scope="col"><?php _e('Date', 'tax-calculator'); ?></th>
                <th scope="col"><?php _e('Actions', 'tax-calculator'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($submissions['items'])) : ?>
                <?php foreach ($submissions['items'] as $submission) : ?>
                    <tr>
                        <td><?php echo esc_html($submission->id); ?></td>
                        <td><?php echo esc_html($submission->first_name . ' ' . $submission->last_name); ?></td>
                        <td><?php echo esc_html($submission->email); ?></td>
                        <td><?php echo esc_html($submission->donation_type); ?></td>
                        <td><?php echo esc_html($submission->donation_amount); ?></td>
                        <td><?php echo esc_html($submission->years); ?></td>
                        <td><?php echo esc_html($submission->tax_rate); ?></td>
                        <td><?php echo $submission->gift_aid ? __('Yes', 'tax-calculator') : __('No', 'tax-calculator'); ?></td>
                        <td><?php echo esc_html($submission->total_amount); ?></td>
                        <td><?php echo esc_html($submission->created_at); ?></td>
                        <td>
                            <button type="button" 
                                    class="button tax-calculator-delete" 
                                    data-id="<?php echo esc_attr($submission->id); ?>">
                                <?php _e('Delete', 'tax-calculator'); ?>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="11"><?php _e('No submissions found.', 'tax-calculator'); ?></td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    
    <?php if ($submissions['total_pages'] > 1) : ?>
        <div class="tablenav bottom">
            <div class="tablenav-pages">
                <?php
                $pagination = paginate_links(array(
                    'base' => add_query_arg('paged', '%#%'),
                    'format' => '',
                    'prev_text' => __('&laquo;'),
                    'next_text' => __('&raquo;'),
                    'total' => $submissions['total_pages'],
                    'current' => $submissions['current_page']
                ));
                echo $pagination;
                ?>
            </div>
        </div>
    <?php endif; ?>
</div> 
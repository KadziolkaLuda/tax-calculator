<?php
if (!defined('ABSPATH')) {
    exit;
}

class Tax_Calculator_DB {
    private static $table_name = 'tax_calculator_submissions';

    public static function create_tables() {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        $table_name = $wpdb->prefix . self::$table_name;

        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            first_name varchar(100) NOT NULL,
            last_name varchar(100) NOT NULL,
            email varchar(100) NOT NULL,
            address text NOT NULL,
            postal_town varchar(100) NOT NULL,
            postal_code varchar(20) NOT NULL,
            country varchar(100) NOT NULL,
            mobile varchar(20) NOT NULL,
            donation_type enum('monthly','one-time') NOT NULL,
            donation_amount decimal(10,2) NOT NULL,
            years int(2) DEFAULT NULL,
            tax_rate enum('basic','40','45','not') NOT NULL,
            gift_aid tinyint(1) NOT NULL,
            total_amount decimal(10,2) NOT NULL,
            net_monthly_cost decimal(10,2) DEFAULT NULL,
            net_annual_cost decimal(10,2) DEFAULT NULL,
            total_net_cost decimal(10,2) DEFAULT NULL,
            total_value_with_gift_aid decimal(10,2) NOT NULL,
            ip_address varchar(45) DEFAULT NULL,
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY  (id),
            KEY last_name (last_name),
            KEY created_at (created_at)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }

    public static function save_submission($data) {
        global $wpdb;
        $table_name = $wpdb->prefix . self::$table_name;

        $wpdb->insert(
            $table_name,
            array(
                'first_name' => sanitize_text_field($data['firstName']),
                'last_name' => sanitize_text_field($data['lastName']),
                'email' => sanitize_email($data['email']),
                'address' => sanitize_textarea_field($data['address']),
                'postal_town' => sanitize_text_field($data['postalTown']),
                'postal_code' => sanitize_text_field($data['postalCode']),
                'country' => sanitize_text_field($data['country']),
                'mobile' => sanitize_text_field($data['mobile']),
                'donation_type' => $data['donationType'],
                'donation_amount' => floatval($data['donationAmount']),
                'years' => isset($data['years']) ? intval($data['years']) : null,
                'tax_rate' => $data['taxRate'],
                'gift_aid' => $data['giftAid'] ? 1 : 0,
                'total_amount' => floatval($data['totalAmount']),
                'net_monthly_cost' => isset($data['netMonthlyCost']) ? floatval($data['netMonthlyCost']) : null,
                'net_annual_cost' => isset($data['netAnnualCost']) ? floatval($data['netAnnualCost']) : null,
                'total_net_cost' => isset($data['totalNetCost']) ? floatval($data['totalNetCost']) : null,
                'total_value_with_gift_aid' => floatval($data['totalValueWithGiftAid']),
                'ip_address' => self::get_client_ip()
            ),
            array(
                '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s',
                '%s', '%f', '%d', '%s', '%d',
                '%f', '%f', '%f', '%f', '%f',
                '%s'
            )
        );

        return $wpdb->insert_id;
    }

    public static function get_submissions($args = array()) {
        global $wpdb;
        $table_name = $wpdb->prefix . self::$table_name;

        $defaults = array(
            'per_page' => 20,
            'page' => 1,
            'orderby' => 'created_at',
            'order' => 'DESC',
            'search' => '',
            'date_from' => '',
            'date_to' => ''
        );

        $args = wp_parse_args($args, $defaults);
        $offset = ($args['page'] - 1) * $args['per_page'];

        $where = array();
        $where_values = array();

        if (!empty($args['search'])) {
            $where[] = "(first_name LIKE %s OR last_name LIKE %s OR email LIKE %s)";
            $search_term = '%' . $wpdb->esc_like($args['search']) . '%';
            $where_values[] = $search_term;
            $where_values[] = $search_term;
            $where_values[] = $search_term;
        }

        if (!empty($args['date_from'])) {
            $where[] = "created_at >= %s";
            $where_values[] = $args['date_from'] . ' 00:00:00';
        }

        if (!empty($args['date_to'])) {
            $where[] = "created_at <= %s";
            $where_values[] = $args['date_to'] . ' 23:59:59';
        }

        $where_clause = !empty($where) ? 'WHERE ' . implode(' AND ', $where) : '';

        // First get the total count
        $count_query = "SELECT COUNT(*) FROM $table_name $where_clause";
        if (!empty($where_values)) {
            $count_query = $wpdb->prepare($count_query, $where_values);
        }
        $total = $wpdb->get_var($count_query);

        // Then get the results
        $query = "SELECT * FROM $table_name $where_clause ORDER BY {$args['orderby']} {$args['order']}";
        
        // Only add LIMIT if per_page is positive
        if ($args['per_page'] > 0) {
            $query .= " LIMIT %d OFFSET %d";
            $query = $wpdb->prepare($query, array_merge($where_values, array($args['per_page'], $offset)));
        } else {
            // If per_page is -1 or 0, get all results
            if (!empty($where_values)) {
                $query = $wpdb->prepare($query, $where_values);
            }
        }

        $results = $wpdb->get_results($query);
        $total_pages = $args['per_page'] > 0 ? ceil($total / $args['per_page']) : 1;

        return array(
            'items' => $results,
            'total' => $total,
            'total_pages' => $total_pages,
            'current_page' => $args['page']
        );
    }

    public static function delete_submission($id) {
        global $wpdb;
        $table_name = $wpdb->prefix . self::$table_name;
        return $wpdb->delete($table_name, array('id' => $id), array('%d'));
    }

    private static function get_client_ip() {
        $ip_address = '';
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip_address = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED'])) {
            $ip_address = $_SERVER['HTTP_X_FORWARDED'];
        } elseif (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ip_address = $_SERVER['HTTP_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_FORWARDED'])) {
            $ip_address = $_SERVER['HTTP_FORWARDED'];
        } elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip_address = $_SERVER['REMOTE_ADDR'];
        }
        return $ip_address;
    }
}

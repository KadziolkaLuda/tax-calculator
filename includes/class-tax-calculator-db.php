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

        // Drop existing table if it exists
        $wpdb->query("DROP TABLE IF EXISTS $table_name");

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
            donation_amount decimal(10,2) NOT NULL,
            donation_way enum('single','phased') NOT NULL,
            years int(2) DEFAULT NULL,
            gift_aid tinyint(1) NOT NULL DEFAULT 0,
            gift_aid_date date DEFAULT NULL,
            public_acknowledgment tinyint(1) NOT NULL DEFAULT 0,
            appear_name varchar(100) DEFAULT NULL,
            donation_for varchar(100) DEFAULT NULL,
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
                'donation_amount' => floatval($data['donation_amount']),
                'donation_way' => $data['donation_way'],
                'years' => isset($data['years']) ? intval($data['years']) : null,
                'gift_aid' => $data['gift_aid'] ? 1 : 0,
                'gift_aid_date' => $data['gift_aid_date'],
                'public_acknowledgment' => $data['public_acknowledgment'] ? 1 : 0,
                'appear_name' => $data['appear_name'],
                'donation_for' => $data['donation_for'],
                'ip_address' => self::get_client_ip()
            ),
            array(
                '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s',
                '%f', '%s', '%d', '%d', '%s', '%d', '%s', '%s', '%s'
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

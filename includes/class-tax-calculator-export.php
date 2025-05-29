<?php
if (!defined('ABSPATH')) {
    exit;
}

class Tax_Calculator_Export {
    public static function export_csv($args = array()) {
        if (!current_user_can('manage_options')) {
            wp_die(__('You do not have sufficient permissions to access this page.'));
        }

        // Get all submissions with filters
        $default_args = array(
            'per_page' => -1, // Get all records
            'page' => 1,
            'search' => '',
            'date_from' => '',
            'date_to' => ''
        );

        $args = wp_parse_args($args, $default_args);
        $submissions = Tax_Calculator_DB::get_submissions($args);

        if (empty($submissions['items'])) {
            wp_die(__('No submissions found to export.', 'tax-calculator'));
        }

        // Generate filename
        $filename = 'donation-form-submissions';
        if (!empty($args['date_from']) && !empty($args['date_to'])) {
            $filename .= '-' . date('Y-m-d', strtotime($args['date_from'])) . '-to-' . date('Y-m-d', strtotime($args['date_to']));
        }
        $filename .= '-' . date('Y-m-d-H-i') . '.csv';

        // Set headers for CSV download
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $filename);

        // Create output stream
        $output = fopen('php://output', 'w');

        // Add UTF-8 BOM
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

        // Add headers
        $headers = array(
            'ID',
            'Name',
            'Email',
            'Mobile',
            'Address',
            'Donation Amount',
            'Donation Type',
            'Years',
            'Gift Aid',
            'Gift Aid Date',
            'Public Acknowledgment',
            'Appear Name',
            'Donation For',
            'Created At'
        );
        
        // Write headers with semicolon delimiter
        fputcsv($output, $headers, ';');

        // Add data
        foreach ($submissions['items'] as $submission) {
            // Combine address parts
            $address_parts = array(
                $submission->address,
                $submission->postal_town,
                $submission->postal_code,
                $submission->country
            );
            $full_address = implode(', ', array_filter($address_parts));

            // Format donation type
            $donation_type = $submission->donation_way === 'single' ? 'One-time' : 'Phased';

            $row = array(
                $submission->id,
                $submission->first_name . ' ' . $submission->last_name,
                $submission->email,
                $submission->mobile,
                $full_address,
                $submission->donation_amount,
                $donation_type,
                $submission->years,
                $submission->gift_aid ? 'Yes' : 'No',
                $submission->gift_aid_date,
                $submission->public_acknowledgment ? 'Yes' : 'No',
                $submission->appear_name,
                $submission->donation_for,
                $submission->created_at
            );

            fputcsv($output, $row, ';');
        }

        fclose($output);
        exit;
    }
} 
<?php
if (!defined('ABSPATH')) {
    exit;
}

class Tax_Calculator_Export {
    public static function export_csv($submissions) {
        $filename = 'tax-calculator-submissions-' . date('Y-m-d') . '.csv';
        
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        
        // Add CSV headers
        fputcsv($output, array(
            'ID',
            'First Name',
            'Last Name',
            'Email',
            'Address',
            'Postal Town',
            'Postal Code',
            'Country',
            'Mobile',
            'Donation Type',
            'Donation Amount',
            'Years',
            'Tax Rate',
            'Gift Aid',
            'Total Amount',
            'Net Monthly Cost',
            'Net Annual Cost',
            'Total Net Cost',
            'Total Value with Gift Aid',
            'IP Address',
            'Created At'
        ));
        
        // Add data rows
        foreach ($submissions as $submission) {
            fputcsv($output, array(
                $submission->id,
                $submission->first_name,
                $submission->last_name,
                $submission->email,
                $submission->address,
                $submission->postal_town,
                $submission->postal_code,
                $submission->country,
                $submission->mobile,
                $submission->donation_type,
                $submission->donation_amount,
                $submission->years,
                $submission->tax_rate,
                $submission->gift_aid ? 'Yes' : 'No',
                $submission->total_amount,
                $submission->net_monthly_cost,
                $submission->net_annual_cost,
                $submission->total_net_cost,
                $submission->total_value_with_gift_aid,
                $submission->ip_address,
                $submission->created_at
            ));
        }
        
        fclose($output);
        exit;
    }
} 
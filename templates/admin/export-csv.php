    // Set headers for CSV download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="donations-' . date('Y-m-d') . '.csv"');
    header('Pragma: no-cache');
    header('Expires: 0');

    // Create CSV file
    $output = fopen('php://output', 'w');

    // Add UTF-8 BOM for Excel
    fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

    // Add headers
    fputcsv($output, array(
        __('ID', 'tax-calculator'),
        __('First Name', 'tax-calculator'),
        __('Last Name', 'tax-calculator'),
        __('Email', 'tax-calculator'),
        __('Phone', 'tax-calculator'),
        __('Address', 'tax-calculator'),
        __('Postal Town', 'tax-calculator'),
        __('Postal Code', 'tax-calculator'),
        __('Country', 'tax-calculator'),
        __('Amount', 'tax-calculator'),
        __('Donation Way', 'tax-calculator'),
        __('Years', 'tax-calculator'),
        __('Gift Aid', 'tax-calculator'),
        __('Gift Aid Date', 'tax-calculator'),
        __('Public Acknowledgment', 'tax-calculator'),
        __('Appear Name', 'tax-calculator'),
        __('Donation For', 'tax-calculator'),
        __('Date', 'tax-calculator')
    ));

    // Add data
    foreach ($submissions as $submission) {
        fputcsv($output, array(
            $submission->id,
            $submission->first_name,
            $submission->last_name,
            $submission->email,
            $submission->mobile,
            $submission->address,
            $submission->postal_town,
            $submission->postal_code,
            $submission->country,
            number_format($submission->donation_amount, 2),
            $submission->donation_way,
            $submission->donation_way === 'phased' ? $submission->years : '',
            $submission->gift_aid ? __('Yes', 'tax-calculator') : __('No', 'tax-calculator'),
            $submission->gift_aid ? $submission->gift_aid_date : '',
            $submission->public_acknowledgment ? __('Yes', 'tax-calculator') : __('No', 'tax-calculator'),
            $submission->public_acknowledgment ? $submission->appear_name : '',
            $submission->donation_for,
            $submission->created_at
        ));
    } 
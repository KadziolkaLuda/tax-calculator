<?php
/**
 * Export donations to XLSX file
 */

// Set headers for XLSX download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="donations-' . date('Y-m-d') . '.xlsx"');
header('Pragma: no-cache');
header('Expires: 0');

// Create new Spreadsheet object
$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set document properties
$spreadsheet->getProperties()
    ->setCreator('Amici Bruerni')
    ->setLastModifiedBy('Amici Bruerni')
    ->setTitle('Donations Report')
    ->setSubject('Donations Report')
    ->setDescription('Donations Report generated on ' . date('Y-m-d H:i:s'));

// Set headers
$headers = array(
    'ID',
    'First Name',
    'Last Name',
    'Email',
    'Phone',
    'Address',
    'Postal Town',
    'Postal Code',
    'Country',
    'Amount',
    'Donation Way',
    'Years',
    'Gift Aid',
    'Gift Aid Date',
    'Public Acknowledgment',
    'Appear Name',
    'Donation For',
    'Date'
);

$col = 1;
foreach ($headers as $header) {
    $sheet->setCellValueByColumnAndRow($col, 1, $header);
    $col++;
}

// Add data
$row = 2;
foreach ($submissions as $submission) {
    $sheet->setCellValueByColumnAndRow(1, $row, $submission->id);
    $sheet->setCellValueByColumnAndRow(2, $row, $submission->first_name);
    $sheet->setCellValueByColumnAndRow(3, $row, $submission->last_name);
    $sheet->setCellValueByColumnAndRow(4, $row, $submission->email);
    $sheet->setCellValueByColumnAndRow(5, $row, $submission->mobile);
    $sheet->setCellValueByColumnAndRow(6, $row, $submission->address);
    $sheet->setCellValueByColumnAndRow(7, $row, $submission->postal_town);
    $sheet->setCellValueByColumnAndRow(8, $row, $submission->postal_code);
    $sheet->setCellValueByColumnAndRow(9, $row, $submission->country);
    $sheet->setCellValueByColumnAndRow(10, $row, number_format($submission->donation_amount, 2));
    $sheet->setCellValueByColumnAndRow(11, $row, $submission->donation_way);
    $sheet->setCellValueByColumnAndRow(12, $row, $submission->donation_way === 'phased' ? $submission->years : '');
    $sheet->setCellValueByColumnAndRow(13, $row, $submission->gift_aid ? 'Yes' : 'No');
    $sheet->setCellValueByColumnAndRow(14, $row, $submission->gift_aid ? $submission->gift_aid_date : '');
    $sheet->setCellValueByColumnAndRow(15, $row, $submission->public_acknowledgment ? 'Yes' : 'No');
    $sheet->setCellValueByColumnAndRow(16, $row, $submission->public_acknowledgment ? $submission->appear_name : '');
    $sheet->setCellValueByColumnAndRow(17, $row, $submission->donation_for);
    $sheet->setCellValueByColumnAndRow(18, $row, $submission->created_at);
    $row++;
}

// Auto-size columns
foreach (range('A', 'R') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

// Create Excel file
$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
$writer->save('php://output'); 
jQuery(document).ready(function($) {
    // Handle CSV export
    $('#tax-calculator-export-csv').on('click', function() {
        var search = $('input[name="s"]').val();
        var dateFrom = $('input[name="date_from"]').val();
        var dateTo = $('input[name="date_to"]').val();
        
        var url = ajaxurl + '?action=tax_calculator_export_csv';
        if (search) url += '&s=' + encodeURIComponent(search);
        if (dateFrom) url += '&date_from=' + encodeURIComponent(dateFrom);
        if (dateTo) url += '&date_to=' + encodeURIComponent(dateTo);
        
        window.location.href = url;
    });

    // Handle delete submission
    $('.tax-calculator-delete').on('click', function() {
        if (!confirm(taxCalculatorAdmin.confirmDelete)) {
            return;
        }

        var button = $(this);
        var id = button.data('id');

        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'tax_calculator_delete_submission',
                id: id,
                nonce: taxCalculatorAdmin.nonce
            },
            success: function(response) {
                if (response.success) {
                    button.closest('tr').fadeOut(400, function() {
                        $(this).remove();
                        if ($('.wp-list-table tbody tr').length === 0) {
                            $('.wp-list-table tbody').append(
                                '<tr><td colspan="12">' + taxCalculatorAdmin.noSubmissions + '</td></tr>'
                            );
                        }
                    });
                } else {
                    alert(response.data.message);
                }
            }
        });
    });
}); 
jQuery(document).ready(function($) {
    // Handle export button click
    $('#tax-calculator-export-csv').on('click', function(e) {
        e.preventDefault();
        if (confirm(taxCalculatorAdmin.confirmExport)) {
            // Create a form and submit it to trigger the download
            var form = $('<form>', {
                'method': 'POST',
                'action': taxCalculatorAdmin.ajaxurl
            });
            
            form.append($('<input>', {
                'type': 'hidden',
                'name': 'action',
                'value': 'tax_calculator_export_csv'
            }));
            
            form.append($('<input>', {
                'type': 'hidden',
                'name': 'nonce',
                'value': taxCalculatorAdmin.nonce
            }));
            
            $('body').append(form);
            form.submit();
            form.remove();
        }
    });

    // Handle delete button clicks
    $('.tax-calculator-delete').on('click', function(e) {
        e.preventDefault();
        if (confirm(taxCalculatorAdmin.confirmDelete)) {
            var submissionId = $(this).data('id');
            var row = $(this).closest('tr');

            $.ajax({
                url: taxCalculatorAdmin.ajaxurl,
                type: 'POST',
                data: {
                    action: 'tax_calculator_delete_submission',
                    id: submissionId,
                    nonce: taxCalculatorAdmin.nonce
                },
                success: function(response) {
                    if (response.success) {
                        row.fadeOut(400, function() {
                            $(this).remove();
                        });
                    } else {
                        alert('Error deleting submission');
                    }
                },
                error: function() {
                    alert('Error deleting submission');
                }
            });
        }
    });

    // Handle date filter form submission
    $('#date-filter-form').on('submit', function(e) {
        e.preventDefault();
        var startDate = $('#start-date').val();
        var endDate = $('#end-date').val();
        
        if (startDate && endDate) {
            window.location.href = window.location.pathname + '?page=tax-calculator&start_date=' + startDate + '&end_date=' + endDate;
        }
    });

    // Handle search form submission
    $('#search-form').on('submit', function(e) {
        e.preventDefault();
        var searchTerm = $('#search-term').val();
        
        if (searchTerm) {
            window.location.href = window.location.pathname + '?page=tax-calculator&s=' + encodeURIComponent(searchTerm);
        }
    });

    // Initialize datepicker if available
    if ($.fn.datepicker) {
        $('#start-date, #end-date').datepicker({
            dateFormat: 'yy-mm-dd'
        });
    }
}); 
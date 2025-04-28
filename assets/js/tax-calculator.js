jQuery(document).ready(function($) {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Initialize modal if it exists
    var modalElement = document.getElementById('calculatorModal');
    if (modalElement) {
        var calculatorModal = new bootstrap.Modal(modalElement);
    }

    // Variables to store calculation results
    var monthlyGift = 0;
    var totalOnEndMonthly = 0;
    var moneyInFuture = 0;
    var actualPledge = 0;
    var totalValDonation = 0;
    var netVisabile = true;
    var sorryAID = false;
    var totalNetCostsVisible = true;

    const monthly = $('#monthlyAmount');
    const years = $('#numOfYears');
    const oneOff = $('#oneOffAmount');
    const form = $('#calculatorForm');
    const results = $('#results');

    // Handle input changes
    $('#monthlyAmount, #oneOffAmount').on('input', function() {
        if ($(this).attr('id') === 'monthlyAmount') {
            $('#oneOffAmount').val('').prop('required', false);
            $('#numOfYears').prop('required', true);
            countMonthly();
        } else {
            $('#monthlyAmount').val('').prop('required', false);
            $('#numOfYears').val('').prop('required', false);
            countOneSumm();
        }
    });

    $('#numOfYears').on('change', function() {
        countMonthly();
    });

    $('input[name="taxBand"]').on('change', function() {
        countTaxes();
    });

    // Clear fields if one is used
    monthly.on('input', function() {
        if ($(this).val()) {
            oneOff.val('');
        }
    });

    years.on('input', function() {
        if ($(this).val()) {
            oneOff.val('');
        }
    });

    oneOff.on('input', function() {
        if ($(this).val()) {
            monthly.val('');
            years.val('');
        }
    });

    // Calculation functions
    function countMonthly() {
        const monthlyValue = parseFloat($('#monthlyAmount').val()) || 0;
        const yearVal = parseInt($('#numOfYears').val()) || 0;

        monthlyGift = monthlyValue * 20 / 80;
        totalOnEndMonthly = (monthlyGift + monthlyValue) * yearVal * 12;
        moneyInFuture = monthlyValue * yearVal * 12;

        actualPledge = moneyInFuture.toFixed(2).replace(/\.00$/, '');
        totalValDonation = totalOnEndMonthly.toFixed(2).replace(/\.00$/, '');
        netVisabile = false;

        updateDisplay();
        countTaxes();
    }

    function countOneSumm() {
        const oneSum = parseFloat($('#oneOffAmount').val()) || 0;

        actualPledge = oneSum.toFixed(2).replace(/\.00$/, '');
        totalValDonation = oneSum.toFixed(2).replace(/\.00$/, '');
        netVisabile = false;
        totalNetCostsVisible = false;

        updateDisplay();
        countTaxes();
    }

    function countTaxes() {
        const monthlyValue = parseFloat($('#monthlyAmount').val()) || 0;
        const yearVal = parseInt($('#numOfYears').val()) || 0;
        const oneSum = parseFloat($('#oneOffAmount').val()) || 0;
        const taxes = $('input[name="taxBand"]:checked').val();

        if (monthlyValue && yearVal) {
            const monthlyGift = monthlyValue * 20 / 80;
            const monthlyAmountGift = monthlyGift + monthlyValue;
            const tax45 = monthlyAmountGift * 0.25;
            const monthlyCost45 = Math.round((monthlyValue - tax45) * 100) / 100;
            const annualCost45 = Math.round((monthlyCost45 * 12) * 100) / 100;
            const totalNetCost45 = Math.round((annualCost45 * yearVal) * 1) / 1;
            const tax40 = monthlyAmountGift * 0.2;
            const monthlyCost40 = Math.round((monthlyValue - tax40) * 100) / 100;
            const annualCost40 = Math.round((monthlyCost40 * 12) * 100) / 100;
            const totalNetCost40 = Math.round((annualCost40 * yearVal) * 1) / 1;

            if (taxes === 'basic') {
                actualPledge = moneyInFuture.toFixed(2).replace(/\.00$/, '');
                totalValDonation = totalOnEndMonthly.toFixed(2).replace(/\.00$/, '');
                netVisabile = false;
                sorryAID = false;
                totalNetCostsVisible = false;
            } else if (taxes === '40') {
                actualPledge = moneyInFuture.toFixed(2).replace(/\.00$/, '');
                totalValDonation = totalOnEndMonthly.toFixed(2).replace(/\.00$/, '');
                $('.total-net-costs-value').text(totalNetCost40.toFixed(2).replace(/\.00$/, ''));
                $('.net-month-after-tax-value').text(monthlyCost40.toFixed(2).replace(/\.00$/, ''));
                $('.anual-costs-value').text(annualCost40.toFixed(2).replace(/\.00$/, ''));
                netVisabile = true;
                totalNetCostsVisible = true;
                sorryAID = false;
            } else if (taxes === '45') {
                actualPledge = moneyInFuture.toFixed(2).replace(/\.00$/, '');
                totalValDonation = totalOnEndMonthly.toFixed(2).replace(/\.00$/, '');
                $('.total-net-costs-value').text(totalNetCost45.toFixed(2).replace(/\.00$/, ''));
                $('.net-month-after-tax-value').text(monthlyCost45.toFixed(2).replace(/\.00$/, ''));
                $('.anual-costs-value').text(annualCost45.toFixed(2).replace(/\.00$/, ''));
                netVisabile = true;
                totalNetCostsVisible = true;
                sorryAID = false;
            } else if (taxes === 'not') {
                actualPledge = moneyInFuture.toFixed(2).replace(/\.00$/, '');
                totalValDonation = totalOnEndMonthly.toFixed(2).replace(/\.00$/, '');
                $('.total-net-costs-value').text('0');
                $('.net-month-after-tax-value').text('0');
                $('.anual-costs-value').text('0');
                netVisabile = false;
                totalNetCostsVisible = false;
                sorryAID = true;
            }
        } else if (oneSum) {
            const giftOneSum = oneSum * 20 / 80;
            const amountGiftOneSum = giftOneSum + oneSum;
            const tax45OneSum = amountGiftOneSum * 0.25;
            const totalNetCost45OneSum = Math.round((oneSum - tax45OneSum) * 100) / 100;
            const tax40OneSum = amountGiftOneSum * 0.2;
            const totalNetCost40OneSum = Math.round((oneSum - tax40OneSum) * 100) / 100;

            if (taxes === 'basic') {
                actualPledge = oneSum.toFixed(2).replace(/\.00$/, '');
                totalValDonation = amountGiftOneSum.toFixed(2).replace(/\.00$/, '');
                $('.total-net-costs-value').text('0');
                $('.net-month-after-tax-value').text('0');
                $('.anual-costs-value').text('0');
                netVisabile = false;
                sorryAID = false;
                totalNetCostsVisible = false;
            } else if (taxes === '40') {
                actualPledge = oneSum.toFixed(2).replace(/\.00$/, '');
                totalValDonation = amountGiftOneSum.toFixed(2).replace(/\.00$/, '');
                $('.total-net-costs-value').text(totalNetCost40OneSum.toFixed(2).replace(/\.00$/, ''));
                $('.net-month-after-tax-value').text('0');
                $('.anual-costs-value').text('0');
                netVisabile = false;
                sorryAID = false;
                totalNetCostsVisible = true;
            } else if (taxes === '45') {
                actualPledge = oneSum.toFixed(2).replace(/\.00$/, '');
                totalValDonation = amountGiftOneSum.toFixed(2).replace(/\.00$/, '');
                $('.total-net-costs-value').text(totalNetCost45OneSum.toFixed(2).replace(/\.00$/, ''));
                $('.net-month-after-tax-value').text('0');
                $('.anual-costs-value').text('0');
                netVisabile = false;
                sorryAID = false;
                totalNetCostsVisible = true;
            } else if (taxes === 'not') {
                actualPledge = oneSum.toFixed(2).replace(/\.00$/, '');
                totalValDonation = oneSum.toFixed(2).replace(/\.00$/, '');
                $('.total-net-costs-value').text('0');
                $('.net-month-after-tax-value').text('0');
                $('.anual-costs-value').text('0');
                netVisabile = false;
                sorryAID = true;
                totalNetCostsVisible = false;
            }
        }

        updateDisplay();
    }

    function updateDisplay() {
        $('.actual-pledge-value').text(actualPledge);
        $('.total-pledge-value').text(totalValDonation);

        if (netVisabile) {
            $('#anualCosts, #netMonthAfterTax').show();
        } else {
            $('#anualCosts, #netMonthAfterTax').hide();
        }

        if (sorryAID) {
            $('.sorryAID').show();
        } else {
            $('.sorryAID').hide();
        }

        if (totalNetCostsVisible) {
            $('#totalNetCosts').show();
        } else {
            $('#totalNetCosts').hide();
        }
    }

    // Form submission
    $('#submitCalculator').on('click', function() {
        const form = $('#calculatorForm');
        const monthlyValue = parseFloat($('#monthlyAmount').val()) || 0;
        const oneSum = parseFloat($('#oneOffAmount').val()) || 0;
        const yearVal = parseInt($('#numOfYears').val()) || 0;

        if (!monthlyValue && !oneSum) {
            alert('Please enter a donation amount');
            return;
        }

        if (monthlyValue && !yearVal) {
            alert('Please enter the number of years');
            return;
        }

        calculatorModal.show();
    });

    $('#submitDonation').on('click', function() {
        const form = $('#donationForm');
        const monthlyValue = parseFloat($('#monthlyAmount').val()) || 0;
        const oneSum = parseFloat($('#oneOffAmount').val()) || 0;
        const yearVal = parseInt($('#numOfYears').val()) || 0;

        if (!form[0].checkValidity()) {
            form[0].reportValidity();
            return;
        }

        $.ajax({
            url: taxCalculator.ajaxurl,
            type: 'POST',
            data: {
                action: 'tax_calculator_submit',
                firstName: $('#firstName').val(),
                lastName: $('#lastName').val(),
                email: $('#email').val(),
                address: $('#address').val(),
                postalTown: $('#postalTown').val(),
                postalCode: $('#postalCode').val(),
                country: $('#country').val(),
                mobile: $('#mobile').val(),
                donationType: monthlyValue ? 'monthly' : 'one-time',
                donationAmount: monthlyValue || oneSum,
                years: yearVal,
                taxRate: $('input[name="taxBand"]:checked').val(),
                giftAid: $('#giftAid').is(':checked'),
                totalAmount: actualPledge,
                netMonthlyCost: $('.net-month-after-tax-value').text(),
                netAnnualCost: $('.anual-costs-value').text(),
                totalNetCost: $('.total-net-costs-value').text(),
                totalValueWithGiftAid: totalValDonation
            },
            success: function(response) {
                if (response.success) {
                    calculatorModal.hide();
                    form[0].reset();
                    $('#calculatorForm')[0].reset();
                    alert(response.data.message);
                } else {
                    alert(response.data.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
                console.error('Response:', xhr.responseText);
                alert('There was an error submitting your donation. Please try again.');
            }
        });
    });

    form.on('submit', function(e) {
        e.preventDefault();
        $('#submitCalculator').click();
    });
});

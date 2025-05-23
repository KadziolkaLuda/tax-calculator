jQuery(document).ready(function($) {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Initialize toasts
    const successToast = new bootstrap.Toast(document.getElementById('successToast'), {
        autohide: true,
        delay: 5000
    });
    const errorToast = new bootstrap.Toast(document.getElementById('errorToast'), {
        autohide: true,
        delay: 5000
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
    const results = $('#results');

    // Handle input changes
    monthly.on('input', function() {
        const monthlyValue = parseFloat($(this).val()) || 0;
        if (monthlyValue > 0) {
            oneOff.val('').prop('required', false);
            years.prop('required', true);
            validateMonthlyInputs();
            $('#validation-message').hide();
        } else {
            resetValidation();
        }
    });

    years.on('input', function() {
        const monthlyValue = parseFloat(monthly.val()) || 0;
        if (monthlyValue > 0) {
            validateMonthlyInputs();
        }
    });

    oneOff.on('input', function() {
        const oneSum = parseFloat($(this).val()) || 0;
        if (oneSum > 0) {
            monthly.val('').prop('required', false);
            validateOneTimeInput();
            $('#validation-message').hide();
        } else {
            resetValidation();
        }
    });

    function validateMonthlyInputs() {
        const monthlyValue = parseFloat(monthly.val()) || 0;
        const yearVal = parseInt(years.val()) || 0;
        let isValid = true;

        // Validate monthly amount
        if (monthlyValue < 1) {
            monthly.addClass('is-invalid');
            isValid = false;
        } else {
            monthly.removeClass('is-invalid');
        }

        // Validate years only if user has interacted with the field
        if (years.val() !== '') {
            if (yearVal < 1 || yearVal > 4) {
                years.addClass('is-invalid');
                isValid = false;
            } else {
                years.removeClass('is-invalid');
            }
        }

        if (isValid) {
            countMonthly();
        }

        return isValid;
    }

    function validateOneTimeInput() {
        const oneSum = parseFloat(oneOff.val()) || 0;
        let isValid = true;

        if (oneSum < 1) {
            oneOff.addClass('is-invalid');
            isValid = false;
        } else {
            oneOff.removeClass('is-invalid');
            countOneSumm();
        }

        return isValid;
    }

    function resetValidation() {
        $('.tp-input').removeClass('is-invalid');
        $('.invalid-feedback').removeAttr('style');
        $('.actual-pledge-value, .total-pledge-value').text('0');
        $('#anualCosts, #netMonthAfterTax, #totalNetCosts').hide();
        $('#validation-message').hide();
    }

    // Form submission
    $('#submitCalculator').on('click', function(e) {
        e.preventDefault(); // Prevent default button behavior
        const monthlyValue = parseFloat(monthly.val()) || 0;
        const oneSum = parseFloat(oneOff.val()) || 0;
        let isValid = true;

        // Reset previous validation states
        resetValidation();

        // Validate based on which input is filled
        if (monthlyValue > 0) {
            isValid = validateMonthlyInputs();
            $('#validation-message').hide();
            
            // Show monthly info and update years
            const yearVal = parseInt(years.val()) || 0;
            $('.monthly-info').show();
            $('.years-value').text(yearVal);
            $('.years-text').text(yearVal === 1 ? 'year' : 'years');
        } else if (oneSum > 0) {
            isValid = validateOneTimeInput();
            $('#validation-message').hide();
            
            // Hide monthly info for one-time donations
            $('.monthly-info').hide();
        } else {
            // No valid input - show only message without marking inputs
            $('#validation-message').show();
            isValid = false;
        }

        if (!isValid) {
            return;
        }

        // Update the total amount in the modal
        $('.total-amount-value').text('£' + actualPledge);
        
        // Show the modal
        calculatorModal.show();
    });

    // Handle tax band changes
    $('input[name="taxBand"]').on('change', function(e) {
        e.preventDefault(); // Prevent default behavior
        const monthlyValue = parseFloat(monthly.val()) || 0;
        const oneSum = parseFloat(oneOff.val()) || 0;

        if (monthlyValue > 0) {
            countMonthly();
        } else if (oneSum > 0) {
            countOneSumm();
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

    // Add input validation on change
    $('#monthlyAmount, #oneOffAmount').on('input', function() {
        const value = parseFloat($(this).val()) || 0;
        if (value < 1) {
            $(this).addClass('is-invalid');
        } else {
            $(this).removeClass('is-invalid');
        }
    });

    $('#numOfYears').on('input', function() {
        const value = parseInt($(this).val()) || 0;
        if (value < 1 || value > 3) {
            $(this).addClass('is-invalid');
        } else {
            $(this).removeClass('is-invalid');
        }
    });

    $('#submitDonation').on('click', function(e) {
        e.preventDefault();
        
        // Reset previous validation states
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').hide();
        $('.format-error').hide();
        $('.required-error').show();
        
        // Validate all required fields
        let isValid = true;
        const requiredFields = ['firstName', 'lastName', 'address', 'postalTown', 'postalCode', 'country', 'mobile', 'email'];
        
        requiredFields.forEach(field => {
            const input = $(`input[name="${field}"]`);
            if (!input.val().trim()) {
                input[0].classList.add('is-invalid');
                input.next('.invalid-feedback').show();
                isValid = false;
            }
        });
        
        // Validate email format
        const emailInput = $('input[name="email"]');
        const emailValue = emailInput.val().trim();
        if (emailValue) {
            const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (!emailRegex.test(emailValue)) {
                emailInput[0].classList.add('is-invalid');
                emailInput.next('.invalid-feedback').show();
                emailInput.next('.invalid-feedback').find('.required-error').hide();
                emailInput.next('.invalid-feedback').find('.format-error').show();
                isValid = false;
            }
        }
        
        // Validate phone number format
        const mobileInput = $('input[name="mobile"]');
        const phoneValue = mobileInput.val().trim();
        if (phoneValue) {
            // More flexible phone regex that accepts:
            // - UK mobile: 07xxx xxxxxx, +447xxx xxxxxx
            // - UK landline: 02xxx xxxxxx, +442xxx xxxxxx
            // - European numbers: +xx xxxxxxxx
            // - International numbers: +xxx xxxxxxxx
            // - Numbers with or without spaces and dashes
            const phoneRegex = /^(\+?44|0)7\d{9}$|^(\+?44|0)2\d{9}$|^\+\d{1,3}[\s-]?\d{6,14}$/;
            if (!phoneRegex.test(phoneValue.replace(/[\s-]/g, ''))) {
                mobileInput[0].classList.add('is-invalid');
                mobileInput.next('.invalid-feedback').show();
                mobileInput.next('.invalid-feedback').find('.required-error').hide();
                mobileInput.next('.invalid-feedback').find('.format-error').show();
                isValid = false;
            }
        }
        
        if (!isValid) {
            return;
        }

        // Get current calculator values
        const monthlyValue = parseFloat($('#monthlyAmount').val()) || 0;
        const oneSum = parseFloat($('#oneOffAmount').val()) || 0;
        const yearVal = parseInt($('#numOfYears').val()) || 0;
        const taxRate = $('input[name="taxBand"]:checked').val() || 'basic';

        // Prepare form data
        const formData = {
            action: 'tax_calculator_submit',
            firstName: $('input[name="firstName"]').val(),
            lastName: $('input[name="lastName"]').val(),
            email: $('input[name="email"]').val(),
            address: $('input[name="address"]').val(),
            postalTown: $('input[name="postalTown"]').val(),
            postalCode: $('input[name="postalCode"]').val(),
            country: $('input[name="country"]').val(),
            mobile: $('input[name="mobile"]').val(),
            donationType: monthlyValue > 0 ? 'monthly' : 'one-time',
            donationAmount: monthlyValue > 0 ? monthlyValue : oneSum,
            years: yearVal,
            taxRate: taxRate,
            giftAid: $('input[name="giftAid"]').is(':checked') ? '1' : '',
            totalAmount: actualPledge,
            totalNetCost: $('.total-net-costs-value').text() || '0'
        };

        // Send AJAX request
        $.ajax({
            url: taxCalculator.ajaxurl,
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    calculatorModal.hide();
                    // Reset donation form
                    $('#donationForm')[0].reset();
                    // Reset calculator form
                    $('#calculatorForm')[0].reset();
                    // Reset Results Section
                    $('.actual-pledge-value, .total-pledge-value').text('0');
                    $('#anualCosts, #netMonthAfterTax, #totalNetCosts').hide();
                    $('.monthly-info').hide();
                    $('.sorryAID').hide();
                    // Reset input states
                    $('.is-invalid').removeClass('is-invalid');
                    $('.invalid-feedback').hide();
                    // Reset validation message
                    $('#validation-message').hide();
                    // Reset total amount in modal
                    $('.total-amount-value').text('£0');
                    // Reset variables
                    monthlyGift = 0;
                    totalOnEndMonthly = 0;
                    moneyInFuture = 0;
                    actualPledge = 0;
                    totalValDonation = 0;
                    netVisabile = true;
                    sorryAID = false;
                    totalNetCostsVisible = true;
                    
                    // Show success toast
                    successToast.show();
                } else {
                    // Show error toast
                    errorToast.show();
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
                console.error('Response:', xhr.responseText);
                // Show error toast
                errorToast.show();
            }
        });
    });

    // Prevent form submission
    $('#donationForm').on('submit', function(e) {
        e.preventDefault();
    });

    // Add real-time validation on input change
    $('input[name]').on('input', function(e) {
        e.preventDefault();
        const input = $(this);
        const value = input.val().trim();
        
        // Remove invalid state if user starts typing
        if (value) {
            input[0].classList.remove('is-invalid');
            input.next('.invalid-feedback').hide();
        }
        
        // Special validation for email
        if (input.attr('name') === 'email' && value) {
            const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (!emailRegex.test(value)) {
                input[0].classList.add('is-invalid');
                input.next('.invalid-feedback').show();
                input.next('.invalid-feedback').find('.required-error').hide();
                input.next('.invalid-feedback').find('.format-error').show();
            }
        }
        
        // Special validation for phone
        if (input.attr('name') === 'mobile' && value) {
            const phoneRegex = /^(\+?44|0)7\d{9}$|^(\+?44|0)2\d{9}$|^\+\d{1,3}[\s-]?\d{6,14}$/;
            if (!phoneRegex.test(value.replace(/[\s-]/g, ''))) {
                input[0].classList.add('is-invalid');
                input.next('.invalid-feedback').show();
                input.next('.invalid-feedback').find('.required-error').hide();
                input.next('.invalid-feedback').find('.format-error').show();
            }
        }
    });
});

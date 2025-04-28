<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
<div id="taxCalculator" class="container my-5">
    <form id="calculatorForm" class="needs-validation" novalidate>
        <div class="row mb-4">
            <div class="col-md-6">
                <label for="monthlyAmount"><?php _e('Monthly Donation', 'tax-calculator'); ?></label>
                <div class="input-group">
                    <span class="input-group-text">£</span>
                    <input type="number" class="form-control tp-input" id="monthlyAmount" min="1" step="any" required>
                </div>
            </div>
            <div class="col-md-6">
                <label for="numOfYears"><?php _e('Number of Years (1-3)', 'tax-calculator'); ?></label>
                <input type="number" class="form-control tp-input" id="numOfYears" min="1" max="3" required>
            </div>
        </div>

        <div class="text-center mb-3"><?php _e('OR', 'tax-calculator'); ?></div>

        <div class="row mb-4">
            <div class="col-md-6">
                <label for="oneOffAmount"><?php _e('One-off Donation', 'tax-calculator'); ?></label>
                <div class="input-group">
                    <span class="input-group-text">£</span>
                    <input type="number" class="form-control tp-input" id="oneOffAmount" min="1" step="any">
                </div>
            </div>
        </div>

        <h5 class="mt-4"><?php _e('Tax Band', 'tax-calculator'); ?></h5>
        <div class="d-flex flex-wrap gap-3 my-3">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="taxBand" id="taxBasic" value="basic" checked>
                <label class="form-check-label" for="taxBasic"><?php _e('Basic Rate', 'tax-calculator'); ?></label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="taxBand" id="tax40" value="40">
                <label class="form-check-label" for="tax40">40%</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="taxBand" id="tax45" value="45">
                <label class="form-check-label" for="tax45">45%</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="taxBand" id="taxNone" value="not">
                <label class="form-check-label" for="taxNone"><?php _e('Not a UK taxpayer', 'tax-calculator'); ?></label>
            </div>
        </div>

        <div class="d-grid mt-4">
            <button type="submit" class="btn btn-primary"><?php _e('Calculate', 'tax-calculator'); ?></button>
        </div>
    </form>

    <div id="results" class="mt-5" style="display:none">
        <h4><?php _e('Calculation Result', 'tax-calculator'); ?></h4>
        <ul>
            <li><strong><?php _e('Your Donation:', 'tax-calculator'); ?></strong> <span id="donationAmount"></span></li>
            <li><strong><?php _e('Gift Aid Value:', 'tax-calculator'); ?></strong> <span id="giftAidValue"></span></li>
            <li><strong><?php _e('Total Value to Charity:', 'tax-calculator'); ?></strong> <span id="totalCharity"></span></li>
        </ul>
    </div>
</div>

<!-- Modal Form -->
<div class="modal fade" id="calculatorModal" tabindex="-1" aria-labelledby="calculatorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="calculatorModalLabel"><?php _e('Complete Your Donation', 'tax-calculator'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="donationForm">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName" class="form-label"><?php _e('First Name', 'tax-calculator'); ?></label>
                            <input type="text" class="form-control" id="firstName" name="firstName" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName" class="form-label"><?php _e('Last Name', 'tax-calculator'); ?></label>
                            <input type="text" class="form-control" id="lastName" name="lastName" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label"><?php _e('Email', 'tax-calculator'); ?></label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label"><?php _e('Address', 'tax-calculator'); ?></label>
                        <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="postalTown" class="form-label"><?php _e('Postal Town', 'tax-calculator'); ?></label>
                            <input type="text" class="form-control" id="postalTown" name="postalTown" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="postalCode" class="form-label"><?php _e('Postal Code', 'tax-calculator'); ?></label>
                            <input type="text" class="form-control" id="postalCode" name="postalCode" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="country" class="form-label"><?php _e('Country', 'tax-calculator'); ?></label>
                            <input type="text" class="form-control" id="country" name="country" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="mobile" class="form-label"><?php _e('Mobile', 'tax-calculator'); ?></label>
                            <input type="tel" class="form-control" id="mobile" name="mobile" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="giftAid" name="giftAid" checked>
                            <label class="form-check-label" for="giftAid">
                                <?php _e('I would like to Gift Aid my donation', 'tax-calculator'); ?>
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php _e('Close', 'tax-calculator'); ?></button>
                <button type="button" class="btn btn-primary" id="submitDonation"><?php _e('Submit', 'tax-calculator'); ?></button>
            </div>
        </div>
    </div>
</div>

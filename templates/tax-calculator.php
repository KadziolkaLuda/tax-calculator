<?php
/**
 * Tax Calculator Template
 */
?>
<div class="tax-calculator-container">
    <div class="container">
                <form id="calculatorForm" class="tax-calculator">
                    <div class="quantity">
                        <!-- Monthly Donation Section -->
                        <div class="quantity-monthly row d-flex align-items-baseline">
                            <div class="col-lg-6">
                                <div class="row">
                                    <label for="monthlyAmount"
                                        class="tax-input-label col-sm-6 pr-3 pr-sm-0 mb-2 mb-sm-0 text-md-end">
                                        <?php echo esc_html($text_monthly_donation_label); ?>
                                    </label>
                                    <div class="col-sm-6 d-flex flex-row align-items-baseline px-0 ps-sm-3">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="monthlyAmount-addon">&pound;</span>
                                            </div>
                                            <input type="number" id="monthlyAmount" name="monthlyAmount"
                                                class="form-control tp-input" placeholder="enter amount here"
                                                aria-label="Amount" aria-describedby="monthlyAmount-addon">
                                            <div class="invalid-feedback">
                                                <?php echo esc_html($text_invalid_amount_message); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row d-flex">
                                    <label for="numOfYears" class="tax-input-label col-sm-6 pr-3 pr-sm-0 mb-2 mb-sm-0 text-md-end">
                                        <?php echo esc_html($text_years_label); ?>
                                    </label>
                                    <div class="col-sm-6 d-flex flex-column align-items-start position-relative px-0 ps-sm-3">
                                        <input type="number" id="numOfYears" name="numOfYears"
                                            class="form-control text-sm tp-input tp-input--years" placeholder="years"
                                            min="1" max="4" value="1">
                                        <div class="year invalid-feedback">
                                            <?php echo esc_html($text_invalid_years_message); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- OR Divider -->                        
                        <div class="calculat-divider"><span>OR</span></div>

                        <!-- One-time Donation Section -->
                        <div class="quantity-onse row mt-4 mb-3">
                            <div class="col-lg-6">
                                <div class="row">
                                    <label for="oneOffAmount" class="tax-input-label col-sm-6 pe-3 pe-sm-0 mb-2 mb-sm-0 text-md-end">
                                        <?php echo esc_html($text_one_off_donation_label); ?>
                                    </label>
                                    <div class="col-sm-6 d-flex flex-row align-items-baseline px-0 ps-sm-3">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="oneOffAmount-addon">&pound;</span>
                                            </div>

                                            <input type="number" id="oneOffAmount" name="oneOffAmount"
                                                class="form-control tp-input" placeholder="enter amount here" min="1"
                                                aria-label="Amount" aria-describedby="oneOffAmount-addon">
                                            <div class="invalid-feedback">
                                                <?php echo esc_html($text_invalid_amount_message); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tax Rate Selection -->
                    <div class="taxes-view">
                        <h4 class="tax-rate-title text-center">
                            See how Gift Aid boosts your donation and reduces the net cost to you,
                            if you pay higher rate tax (select one of these four options)
                        </h4>

                        <div class="container">
                            <div class="row py-3 py-md-5">
                                <div class="col-md-6 col-lg-3 d-flex align-items-center justify-content-end">
                                    <div class="form-check">
                                        <p class="tax-radio-label">I pay only basic rate UK tax</p>
                                        <input class="form-check-input" type="radio" name="taxBand" id="taxBasic"
                                            value="basic" checked>
                                        <label class="form-check-label" for="taxBasic"></label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3 d-flex align-items-center justify-content-end">
                                    <div class="form-check">
                                        <p class="tax-radio-label">I pay UK tax @ 40%</p>
                                        <input class="form-check-input" type="radio" name="taxBand" id="tax40"
                                            value="40">
                                        <label class="form-check-label" for="tax40"></label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3 d-flex align-items-center justify-content-end">
                                    <div class="form-check">
                                        <p class="tax-radio-label">I pay UK tax @ 45%</p>
                                        <input class="form-check-input" type="radio" name="taxBand" id="tax45"
                                            value="45">
                                        <label class="form-check-label" for="tax45"></label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3 d-flex align-items-center justify-content-end">
                                    <div class="form-check">
                                        <p class="tax-radio-label">I do not pay UK tax</p>
                                        <input class="form-check-input" type="radio" name="taxBand" id="taxNone"
                                            value="not">
                                        <label class="form-check-label" for="taxNone"></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Results Section -->
                        <div id="results" class="row justify-content-end taxes-result pt-3">
                            <div class="col-md-6 sorryAID" style="display: none;">
                                <p class="text-center input-description-text-warning">sorry, Gift Aid only applies
                                    to UK tax payers</p>
                            </div>

                            <div class="col-md-2" id="anualCosts" style="display: none;">
                                <div class="d-flex align-items-center justify-content-between form-control tp-input">
                                    <span>&pound;<span class="anual-costs-value">0</span></span>
                                </div>
                                <p class="input-description-text">Net annual cost to me after tax relief</p>
                            </div>

                            <div class="col-md-2" id="netMonthAfterTax" style="display: none;">
                                <div class="d-flex align-items-center justify-content-between form-control tp-input">
                                    <span>&pound;<span class="net-month-after-tax-value">0</span></span>
                                    <span class="tooltip-icon material-icons icon-ack" data-bs-toggle="tooltip"
                                        title="If you pay tax at the higher or additional rate, you can claim the difference between the rate you pay and basic rate on your donation. Do this either through your Self Assessment tax return or by asking HM Revenue and Customs (HMRC) to amend your tax code.">
                                        question_mark
                                    </span>
                                </div>
                                <p class="input-description-text">Net monthly cost to me after tax relief</p>
                            </div>

                            <div class="col-md-2" id="totalNetCosts" style="display: none;">
                                <div class="d-flex align-items-center justify-content-between form-control tp-input">
                                    <span>&pound;<span class="total-net-costs-value">0</span></span>
                                    <span class="tooltip-icon material-icons icon-ack" data-bs-toggle="tooltip"
                                        title="This is what your donation will actually cost you once you have benefitted from higher rate tax relief.">
                                        question_mark
                                    </span>
                                </div>
                                <p class="input-description-text">Total net cost</p>
                            </div>

                            <div class="col-md-2" id="actualPledge">
                                <div class="d-flex align-items-center justify-content-between form-control tp-input">
                                    <span>&pound;<span class="actual-pledge-value">0</span></span>
                                    <span class="tooltip-icon material-icons icon-ack" data-bs-toggle="tooltip"
                                        title="This is sum you actually give. We add Gift Aid to this (if applicable) and you claim tax relief on it.">
                                        question_mark
                                    </span>
                                </div>
                                <p class="input-description-text">The total cost of my pledge (i.e. over time - if
                                    giving a regular gift)</p>
                            </div>

                            <div class="col-md-4" id="totalPledge">
                                <div
                                    class="d-flex align-items-center justify-content-center form-control tp-input bg-secondary text-light text-center">
                                    <span>&pound;<span class="total-pledge-value">0</span></span>
                                </div>
                                <p class="input-description-text">Total value of my donation to the campaign with Gift
                                    Aid added</p>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center my-6">
                        <div class="submit-button-wrapper w-100">
                        <button type="submit" id="submitCalculator" class="btn rounded-0 btn-subbmit">
                            <?php echo esc_html(strtoupper($text_submit_button)); ?>
                        </button>
                        </div>
                        <div id="validation-message" class="mt-3 text-danger" style="display: none;">
                            Please select a donation type and enter an amount to proceed.
                        </div>
                    </div>
                </form>
    </div>

    <?php include plugin_dir_path(__FILE__) . 'tax-calculator-modal.php'; ?>
</div>
<?php
/**
 * Tax Calculator Template
 */
?>
<div class="tax-calculator-container">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12">
                <form id="calculatorForm" class="tax-calculator">
                    <div class="quantity">
                        <!-- Monthly Donation Section -->
                        <div class="quantity-monthly row d-flex align-items-baseline my-3 mb-4">
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label for="monthlyAmount" class="col-sm-6 pr-3 pr-sm-0 text-md-end">
                                        The amount I am happy to give each month
                                    </label>
                                    <div class="col-sm-6 d-flex flex-row align-items-baseline">
                                        <span class="pe-2">&pound;</span>
                                        <div class="d-flex flex-column align-items-center position-relative w-100">
                                            <input type="number" id="monthlyAmount" name="monthlyAmount" 
                                                class="form-control text-sm tp-input" placeholder="enter amount here" 
                                                min="1">
                                            <div class="invalid-feedback">
                                                Amount is required and should be more than &pound;1
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 mt-4 mt-lg-0">
                                <div class="form-group row d-flex">
                                    <label for="numOfYears" class="col-sm-6 pr-3 pr-sm-0 text-md-end">
                                        The number of years over which I wish to spread my donation
                                    </label>
                                    <div class="col-sm-6 d-flex flex-column align-items-start position-relative">
                                        <input type="number" id="numOfYears" name="numOfYears" 
                                            class="form-control text-sm tp-input tp-input--years" 
                                            placeholder="years" min="1" max="3">
                                        <div class="year invalid-feedback">
                                            Years count should be from 1 to 3
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- OR Divider -->
                        <div class="d-flex align-items-center my-5">
                            <span class="or-text bg-secondary text-light">OR</span>
                            <span class="or-line"></span>
                        </div>

                        <!-- One-time Donation Section -->
                        <div class="quantity-onse row mt-4 mb-3">
                            <div class="col-lg-6">
                                <div class="form-group row d-flex">
                                    <label for="oneOffAmount" class="col-sm-6 pe-3 pe-sm-0 text-md-end">
                                        The amount I am happy to give as a one-off donation
                                    </label>
                                    <div class="col-sm-6 d-flex flex-row align-items-baseline">
                                        <span class="pe-2">&pound;</span>
                                        <div class="d-flex flex-column align-items-center position-relative w-100">
                                            <input type="number" id="oneOffAmount" name="oneOffAmount" 
                                                class="form-control text-sm tp-input" placeholder="enter amount here" 
                                                min="1">
                                            <div class="invalid-feedback">
                                                Amount is required and should be more than &pound;1
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tax Rate Selection -->
                    <div class="taxes-view">
                        <h4 class="title-sm text-center mt-5 mb-4">
                            See how Gift Aid boosts your donation and reduces the net cost to you, 
                            if you pay higher rate tax (select one of these four options)
                        </h4>
                        
                        <div class="container">
                            <div class="row py-5">
                                <div class="col-6 col-md-3 d-flex align-items-center justify-content-end">
                                    <div class="form-check">
                                        <p>I pay only basic rate UK tax</p>
                                        <input class="form-check-input" type="radio" name="taxBand" 
                                            id="taxBasic" value="basic" checked>
                                        <label class="form-check-label" for="taxBasic"></label>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 d-flex align-items-center justify-content-end">
                                    <div class="form-check">
                                        <p>I pay UK tax @ 40%</p>
                                        <input class="form-check-input" type="radio" name="taxBand" 
                                            id="tax40" value="40">
                                        <label class="form-check-label" for="tax40"></label>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 d-flex align-items-center justify-content-end">
                                    <div class="form-check">
                                        <p>I pay UK tax @ 45%</p>
                                        <input class="form-check-input" type="radio" name="taxBand" 
                                            id="tax45" value="45">
                                        <label class="form-check-label" for="tax45"></label>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 d-flex align-items-center justify-content-end">
                                    <div class="form-check">
                                        <p>I do not pay UK tax</p>
                                        <input class="form-check-input" type="radio" name="taxBand" 
                                            id="taxNone" value="not">
                                        <label class="form-check-label" for="taxNone"></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Results Section -->
                        <div id="results" class="row justify-content-end taxes-result pt-3">
                            <div class="col-md-6 sorryAID" style="display: none;">
                                <p class="mb-0 text-center text-warning">sorry, Gift Aid only applies to UK tax payers</p>
                            </div>

                            <div class="col-md-2" id="anualCosts" style="display: none;">
                                <div class="d-flex align-items-center justify-content-between form-control tp-input">
                                    <span>&pound;<span class="anual-costs-value">0</span></span>
                                </div>
                                <p class="text-muted">Net annual cost to me after tax relief</p>
                            </div>

                            <div class="col-md-2" id="netMonthAfterTax" style="display: none;">
                                <div class="d-flex align-items-center justify-content-between form-control tp-input">
                                    <span>&pound;<span class="net-month-after-tax-value">0</span></span>
                                    <span class="material-icons icon-ack" data-bs-toggle="tooltip" 
                                        title="If you pay tax at the higher or additional rate, you can claim the difference between the rate you pay and basic rate on your donation. Do this either through your Self Assessment tax return or by asking HM Revenue and Customs (HMRC) to amend your tax code.">
                                        question_mark
                                    </span>
                                </div>
                                <p class="text-muted">Net monthly cost to me after tax relief</p>
                            </div>

                            <div class="col-md-2" id="totalNetCosts" style="display: none;">
                                <div class="d-flex align-items-center justify-content-between form-control tp-input">
                                    <span>&pound;<span class="total-net-costs-value">0</span></span>
                                    <span class="material-icons icon-ack" data-bs-toggle="tooltip" 
                                        title="This is what your donation will actually cost you once you have benefitted from higher rate tax relief.">
                                        question_mark
                                    </span>
                                </div>
                                <p class="text-muted">Total net cost</p>
                            </div>

                            <div class="col-md-2" id="actualPledge">
                                <div class="d-flex align-items-center justify-content-between form-control tp-input">
                                    <span>&pound;<span class="actual-pledge-value">0</span></span>
                                    <span class="material-icons icon-ack" data-bs-toggle="tooltip" 
                                        title="This is sum you actually give. We add Gift Aid to this (if applicable) and you claim tax relief on it.">
                                        question_mark
                                    </span>
                                </div>
                                <p class="text-muted">The total cost of my pledge (i.e. over time - if giving a regular gift)</p>
                            </div>

                            <div class="col-md-4" id="totalPledge">
                                <div class="d-flex align-items-center justify-content-center form-control tp-input bg-secondary text-light text-center">
                                    <span>&pound;<span class="total-pledge-value">0</span></span>
                                </div>
                                <p class="text-muted">Total value of my donation to the campaign with Gift Aid added</p>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center my-6">
                        <button type="submit" id="submitCalculator" class="btn btn-secondary btn-rounded btn-lg">
                            SUBMIT
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="calculatorModal" tabindex="-1" aria-labelledby="calculatorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="calculatorModalLabel">Donation Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="donationForm">
                        <div class="mb-3">
                            <label for="firstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="firstName" required>
                        </div>
                        <div class="mb-3">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastName" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" required>
                        </div>
                        <div class="mb-3">
                            <label for="postalTown" class="form-label">Town/City</label>
                            <input type="text" class="form-control" id="postalTown" required>
                        </div>
                        <div class="mb-3">
                            <label for="postalCode" class="form-label">Postal Code</label>
                            <input type="text" class="form-control" id="postalCode" required>
                        </div>
                        <div class="mb-3">
                            <label for="country" class="form-label">Country</label>
                            <input type="text" class="form-control" id="country" required>
                        </div>
                        <div class="mb-3">
                            <label for="mobile" class="form-label">Mobile Number</label>
                            <input type="tel" class="form-control" id="mobile" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="giftAid" checked>
                            <label class="form-check-label" for="giftAid">I want to Gift Aid my donation</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="submitDonation" class="btn btn-primary">Submit Donation</button>
                </div>
            </div>
        </div>
    </div>
</div> 
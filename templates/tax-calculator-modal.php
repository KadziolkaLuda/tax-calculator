<?php
/**
 * Tax Calculator Modal (Donation form) Template
 */
?>
<!-- Modal -->
<div class="modal fade" id="calculatorModal" class="donation-modal" tabindex="-1" aria-labelledby="calculatorModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    <h3 class="modal-title-heading">Donation form</h3>
                </div>
                <button type="button" class="btn-custom-close close pull-right" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="donationForm">
                    <h5 class="modal-form-heading">Your Details</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="firstName"
                                    class="form-label modal-form-label tp-label tp-label--required">First
                                    Name</label>
                                <input type="text" id="firstName" name="firstName" class="form-control text-sm tp-input"
                                    placeholder="First Name" required />
                                <div class="invalid-feedback">
                                    <div>
                                        First Name is required
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="lastName"
                                    class="form-label modal-form-label tp-label tp-label--required">Surname</label>
                                <input type="text" id="lastName" name="lastName" class="form-control text-sm tp-input"
                                    placeholder="Surname" required />
                                <div class="invalid-feedback">
                                    <div>
                                        Surname is required
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="address"
                                    class="form-label modal-form-label tp-label tp-label--required">Street</label>
                                <input type="text" id="address" name="address" class="form-control text-sm tp-input"
                                    placeholder="Street" required />
                                <div class="invalid-feedback">
                                    <div>
                                        Street is required
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="postalTown"
                                    class="form-label modal-form-label tp-label tp-label--required">Postal
                                    town</label>
                                <input type="text" id="postalTown" name="postalTown"
                                    class="form-control text-sm tp-input" placeholder="Town" required />
                                <div class="invalid-feedback">
                                    <div>
                                        Postal town is required
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="postalCode"
                                    class="form-label modal-form-label tp-label tp-label--required">Postcode
                                </label>
                                <input type="text" id="postalCode" name="postalCode"
                                    class="form-control text-sm tp-input" placeholder="Postcode" required />
                                <div class="invalid-feedback">
                                    <div>
                                        Postcode is required
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="country"
                                    class="form-label modal-form-label tp-label tp-label--required">Country</label>
                                <input type="text" id="country" name="country" class="form-control text-sm tp-input"
                                    placeholder="Country" required />
                                <div class="invalid-feedback">
                                    <div>
                                        Country is required
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="mobile"
                                    class="form-label modal-form-label tp-label tp-label--required">Mobile</label>
                                <input type="tel" id="mobile" name="mobile" class="form-control text-sm tp-input"
                                    placeholder="Preferred phone number" required />
                                <div class="invalid-feedback">
                                    <div class="required-error">Phone number is required</div>
                                    <div class="format-error" style="display: none;">Please enter a valid phone number.
                                        Examples: +44 7123 456789, 07123 456789, +33 6 12 34 56 78</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="email"
                                    class="form-label modal-form-label tp-label tp-label--required">Email</label>
                                <input type="email" id="email" name="email" class="form-control text-sm tp-input"
                                    placeholder="Email address" required />
                                <div class="invalid-feedback">
                                    <div class="required-error">Email is required</div>
                                    <div class="format-error" style="display: none;">Please enter a valid email
                                        address. Example: john.doe@example.com</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Donation Details Section -->
                    <hr class="my-4">
                    <h5 class="modal-form-heading">Your donation</h5>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group row align-items-baseline justify-content-center mb-4">
                                <div class="col-auto text-md-end">
                                    <label class="tp-label tp-label--required" for="donation_amount">I wish to give
                                        (amount)</label>
                                </div>
                                <div class="col-auto">
                                    <div class="input-group flex-nowrap">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="donation_amount-addon">&pound;</span>
                                        </div>
                                        <div>
                                            <input type="number" name="donation_amount" id="donation_amount" required
                                                class="form-control tp-input" min="1" step="0.5" />
                                            <div class="invalid-feedback">
                                                <div>Please enter a valid donation amount (minimum £1).</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row align-items-center mb-4">
                                <label class="col-md-4 text-md-end m-md-0 tp-label" for="donation_for">I wish to direct
                                    my donation to</label>
                                <div class="col-md-8">
                                    <select id="donation_for" name="donation_for" class="form-control tp-input">
                                        <option selected>The Bridge Campaign</option>
                                        <option>Unrestricted</option>
                                        <option>Enrichment projects</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Donation Way Section -->
                        <div class="col-12 mt-3">
                            <div class="radio-grid donation-way-group">
                                <div class="radio-grid__item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="donation_way"
                                            id="donation_way_single" value="single" checked>
                                        <label class="form-check-label" for="donation_way_single"></label>
                                        <p>My donation will be as a single gift</p>
                                    </div>
                                </div>
                                <div class="radio-grid__item">
                                    <!-- OR Divider -->
                                    <div class="modal-divider modal-divider-vertical my-2"><span>OR</span></div>
                                </div>
                                <div class="radio-grid__item d-flex">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="donation_way"
                                            id="donation_way_phased" value="phased">
                                        <label class="form-check-label" for="donation_way_phased"></label>
                                        <p>My donation will be phased over
                                        <div class="form-group">
                                            <div class="years-group">
                                                <input type="number" id="years" name="years" min="1"
                                                    max="<?php echo esc_attr(get_option('tax_calculator_max_years', 10)); ?>"
                                                    class="form-control tp-input">
                                                <label for="years" class="years-text">years</label>
                                            </div>
                                            <div class="invalid-feedback" id="years-feedback">
                                                <?php printf(esc_html__('Years count should be from 1 to %d', 'tax-calculator'), get_option('tax_calculator_max_years', 10)); ?>
                                            </div>
                                        </div>
                                        </p>
                                    </div>
                                </div>
                                <div class="invalid-feedback">
                                    <div>Please select a donation way.</div>
                                </div>
                            </div>
                        </div>

                        <div class="row row-explain mt-4">
                            <div class="col-sm-6">
                                <h5 class="row-explain--heading">If giving as a single gift, you can make a bank
                                    transfer using the details below</h5>
                                <p>Account name: Amici Bruerni</p>
                                <p>Bruern Abbey School<br>
                                    Chesterton House<br>
                                    Chesterton<br>
                                    Bicester<br>
                                    OX26 1UY
                                </p>

                                <p>
                                    Sort code: 20-02-06<br>
                                    Account No: 90346667</p>
                                <!-- IBAN: GB61 NWBK 6006 1859 0138 69<br>
                                            SWIFTBIC: NWBKGB2L</p> -->
                            </div>
                            <div class="col-sm-6">
                                <h5 class="row-explain--heading">If you intend to give over a number of years, we
                                    will be in touch with a standing order form.</h5>
                                <p>If you would prefer to give by cheque, please make
                                    your cheque out to BAmici Bruerni and send it
                                    to:</p>
                                <p>Bruern Abbey School<br>
                                    Chesterton House<br>
                                    Chesterton<br>
                                    Bicester<br>
                                    OX26 1UY
                                </p>
                            </div>
                        </div>



                    </div>

                    <!-- Gift Aid Section -->
                    <hr class="my-4">
                    <h5 class="modal-form-heading">Gift Aid</h5>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="gift_aid" value="yes"
                                    id="gift_aid_yes" checked>
                                <label class="form-check-label" for="gift_aid_yes"></label>
                                <p class="">
                                    I would like to Gift Aid my donation and any donations I make in the future
                                    or
                                    have made in the past four
                                    years to Amici Bruerni, registered charity no. 1135207. I am a UK taxpayer
                                    and
                                    understand that if I pay less
                                    income tax and/or Capital Gains Tax than the amount of Gift Aid claimed on
                                    all
                                    my donations in that tax year
                                    it is my responsibility to pay any difference.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6 gift-aid-date">
                            <div class="form-check align-items-baseline my-2">
                                <p class="me-3 p-0">Date</p>
                                <div>
                                    <input type="date" id="gift_aid_date" name="gift_aid_date"
                                        class="form-control tp-input">
                                    <div class="invalid-feedback">
                                        <div>Please select a date for Gift Aid declaration.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <!-- OR Divider -->
                            <div class="modal-divider"><span>OR</span></div>
                        </div>
                        <div class="col-12">
                            <div class="form-check justify-content-start mb-2">
                                <input class="form-check-input" type="radio" name="gift_aid" id="gift_aid_no"
                                    value="no">
                                <label class="form-check-label" for="gift_aid_no"></label>
                                <p class="">No, I am not a UK taxpayer, or I do not wish to Gift Aid
                                    my donation.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Acknowledgment Section -->
                    <hr class="my-4">
                    <h5 class="modal-form-heading">Acknowledging your generosity</h5>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-check justify-content-start mb-2">
                                <input class="form-check-input" type="radio" name="public_acknowledgment"
                                    id="public_acknowledgment_yes" value="yes" checked>
                                <label class="form-check-label" for="public_acknowledgment_yes"></label>
                                <p class="">I am happy for my support to be acknowledged in
                                    publications. (We will not publish the amount.)
                                </p>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-check align-items-baseline my-2 d-block d-md-flex">
                                <p class="me-3 p-0 mb-2 mb-md-0">I would like my name to appear as</p>
                                <div>
                                    <input type="text" name="appear_name" id="appear_name"
                                        class="form-control tp-input">
                                    <div class="invalid-feedback">
                                        <div>Please enter the name you want to appear in public acknowledgment.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <!-- OR Divider -->
                            <div class="modal-divider"><span>OR</span></div>
                        </div>
                        <div class="col-12">
                            <div class="form-check justify-content-start mb-2">
                                <input class="form-check-input" type="radio" name="public_acknowledgment"
                                    id="public_acknowledgment_no" value="no">
                                <label class="form-check-label" for="public_acknowledgment_no"></label>
                                <p class="">I would prefer my gift to be anonymous.
                                </p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer flex-column">
                <button type="button" id="submitDonation"
                    class="btn rounded-0 btn-subbmit text-uppercase">Submit</button>
            </div>

        </div>
    </div>
</div>

<!-- Toast Container -->
<div class="toast-container position-fixed top-0 end-0 p-3">
    <!-- Success Toast -->
    <div id="successToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-success text-white">
            <strong class="me-auto">Thank You</strong>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            Form sent successfully!
        </div>
    </div>

    <!-- Error Toast -->
    <div id="errorToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-danger text-white">
            <strong class="me-auto">Something went wrong</strong>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            Please try again later.
        </div>
    </div>
</div>
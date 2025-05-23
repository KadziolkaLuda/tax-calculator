<?php
/**
 * Tax Calculator Modal Template
 */
?>
<!-- Modal -->
<div class="modal fade" id="calculatorModal" tabindex="-1" aria-labelledby="calculatorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close close pull-right" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="visually-hidden">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="donationForm">
                    <div class="container-fluid">
                        <h5 class="modal-form-heading">MY CONTACT DETAILS</h5>

                        <div class="mb-4">
                            <label for="firstName" class="form-label modal-form-label tp-label tp-label--required">First Name</label>
                            <input type="text" id="firstName" name="firstName" class="form-control text-sm tp-input"
                                placeholder="First Name" />
                            <div class="invalid-feedback">
                                <div>
                                    First Name is required
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="lastName" class="form-label modal-form-label tp-label tp-label--required">Surname</label>
                            <input type="text" id="lastName" name="lastName" class="form-control text-sm tp-input"
                                placeholder="Surname" required />
                            <div class="invalid-feedback">
                                <div>
                                    Surname is required
                                </div>
                            </div>
                        </div>

                        <h5 class="modal-form-heading">ADDRESS</h5>
                        <div class="row mt-5">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="address" class="form-label modal-form-label tp-label tp-label--required">Street</label>
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
                                    <label for="postalTown" class="form-label modal-form-label tp-label tp-label--required">Postal
                                        town</label>
                                    <input type="text" id="postalTown" name="postalTown" class="form-control text-sm tp-input"
                                        placeholder="Town" required />
                                    <div class="invalid-feedback">
                                        <div>
                                            Postal town is required
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="postalCode" class="form-label modal-form-label tp-label tp-label--required">Postcode
                                    </label>
                                    <input type="text" id="postalCode" name="postalCode" class="form-control text-sm tp-input"
                                        placeholder="Postcode" required />
                                    <div class="invalid-feedback">
                                        <div>
                                            Postcode is required
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="country" class="form-label modal-form-label tp-label tp-label--required">Country</label>
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
                                    <label for="mobile" class="form-label modal-form-label tp-label tp-label--required">Mobile</label>
                                    <input type="tel" id="mobile" name="mobile" class="form-control text-sm tp-input"
                                        placeholder="Preferred phone number" required />
                                    <div class="invalid-feedback">
                                        <div class="required-error">Phone number is required</div>
                                        <div class="format-error" style="display: none;">Please enter a valid phone number. Examples: +44 7123 456789, 07123 456789, +33 6 12 34 56 78</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="email" class="form-label modal-form-label tp-label tp-label--required">Email</label>
                                    <input type="email" id="email" name="email" class="form-control text-sm tp-input"
                                        placeholder="Email address" required />
                                    <div class="invalid-feedback">
                                        <div class="required-error">Email is required</div>
                                        <div class="format-error" style="display: none;">Please enter a valid email address. Example: john.doe@example.com</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex align-items-center">
                        <h5 class="modal-form-pledge text-secondary w-50 text-uppercase my-3 me-3 text-end">MY PLEDGE
                            <span class="modal-form-pledge--total d-block text-right text-lowercase">
                                (Total amount)</span>
                        </h5>
                        <span class="shadow form-control tp-input text-center w-50 total-amount-value">£0</span>
                    </div>
                    <div class="monthly-info bg-secondary text-secondary text-center p-3 rounded bg-opacity-25 mt-2" style="display: none;">
                        <span>This donation will spread over <span class="years-value">0</span> <span class="years-text">years</span>.</span>
                    </div>

                    <div class="accept">
                        <div class="form-check justify-content-start ps-0 mt-4">
                            <input class="form-check-input" type="checkbox" name="giftAid" id="giftAid" value="1">
                            <label class="form-check-label" for="giftAid"></label>
                            <p class="ms-3 text-start">My donation will qualify for Gift Aid, i.e. I pay sufficient UK
                                tax</p>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer flex-column">
                <button type="button" id="submitDonation" class="btn rounded-0 btn-subbmit text-uppercase">Submit</button>
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
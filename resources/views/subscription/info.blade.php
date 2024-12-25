@extends('layouts.login.main')
@section('title', 'Subscription Info')
@section('content')
    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="{{route('home', ['locale' => app()->getLocale()])}}" class="d-inline-block auth-logo">
                                    <img src="{{asset('assets/login/images/logo-light.png')}}" alt="" height="20">
                                </a>
                            </div>
                            <p class="mt-3 fs-15 fw-medium">Online Performance and Risk Management Framework</p>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
					<div class="card">
						<div class="card-header">
							<h4 class="card-title mb-0">ORMAF Subscription</h4>
						</div>
						<!-- end card header -->
						<div class="card-body form-steps">
							<form class="vertical-navs-step">
								<div class="row gy-5">
									<div class="col-lg-3">
										<div class="nav flex-column custom-nav nav-pills" role="tablist" aria-orientation="vertical">
											<button class="nav-link active" id="v-pills-bill-info-tab" data-bs-toggle="pill" data-bs-target="#v-pills-bill-info" type="button" role="tab" aria-controls="v-pills-bill-info" aria-selected="true">
												<span class="step-title me-2">
													<i class="ri-close-circle-fill step-icon me-2"></i> Step 1
												</span>
												Personal Details
											</button>
											<button class="nav-link" id="v-pills-bill-address-tab" data-bs-toggle="pill" data-bs-target="#v-pills-bill-address" type="button" role="tab" aria-controls="v-pills-bill-address" aria-selected="false">
												<span class="step-title me-2">
													<i class="ri-close-circle-fill step-icon me-2"></i> Step 2
												</span>
												Organization
											</button>
											<button class="nav-link" id="v-pills-payment-tab" data-bs-toggle="pill" data-bs-target="#v-pills-payment" type="button" role="tab" aria-controls="v-pills-payment" aria-selected="false">
												<span class="step-title me-2">
													<i class="ri-close-circle-fill step-icon me-2"></i> Step 3
												</span>
												Invoice
											</button>
											<button class="nav-link" id="v-pills-finish-tab" data-bs-toggle="pill" data-bs-target="#v-pills-finish" type="button" role="tab" aria-controls="v-pills-finish" aria-selected="false">
												<span class="step-title me-2">
													<i class="ri-close-circle-fill step-icon me-2"></i> Step 4
												</span>
												Payment
											</button>
										</div>
										<!-- end nav -->
									</div> <!-- end col-->
									<div class="col-lg-6">
										<div class="px-lg-4">
											<div class="tab-content">
												<div class="tab-pane fade  show active" id="v-pills-bill-info" role="tabpanel" aria-labelledby="v-pills-bill-info-tab">
													<div>
														<h5>Personal Details</h5>
														<p class="text-muted">Fill the information below</p>
													</div>

													<div>
														<div class="row g-3">
															<div class="col-sm-6">
																<label for="firstName" class="form-label">First name</label>
																<input type="text" class="form-control" id="firstName" placeholder="Enter first name" value="" required >
																<div class="invalid-feedback">Please enter a first name</div>
															</div>

															<div class="col-sm-6">
																<label for="lastName" class="form-label">Last name</label>
																<input type="text" class="form-control" id="lastName" placeholder="Enter last name" value="" required >
																<div class="invalid-feedback">Please enter a last name</div>
															</div>

															<div class="col-12">
																<label for="username" class="form-label">Email</label>
																<div class="input-group">
																	<span class="input-group-text">@</span>
																	<input type="text" class="form-control" id="username" placeholder="Email" required >
																	<div class="invalid-feedback">Please enter a user name</div>
																</div>
															</div>

															<div class="col-6">
																<label for="email" class="form-label">Password </label>
																<input type="email" class="form-control" id="email" placeholder="Password" />
															</div>
															<div class="col-6">
																<label for="email" class="form-label">Confirm Password </label>
																<input type="email" class="form-control" id="email" placeholder="Confirm Password" />
															</div>
														</div>
													</div>

													<hr class="my-4 text-muted">

													<div class="form-check mb-2">
														<input type="checkbox" class="form-check-input" id="same-address">
														<label class="form-check-label" for="same-address">By continuing, I agree to the ORMAF <a href="#">Terms and Conditions</a></label>
													</div>
												</div>
												<!-- end tab pane -->
												<div class="tab-pane fade" id="v-pills-bill-address" role="tabpanel" aria-labelledby="v-pills-bill-address-tab">
													<div>
														<h5>Organization</h5>
														<p class="text-muted">Fill all information below</p>
													</div>

													<div>
														<div class="row g-3">
															<div class="col-12">
																<label for="address" class="form-label">Name</label>
																<input type="text" class="form-control" id="org-name" placeholder="Organization Name" required >
																<div class="invalid-feedback">Please enter organization name</div>
															</div>

															<div class="col-12">
																<label for="address2" class="form-label">Address</label>
																<input type="text" class="form-control" id="address" placeholder="Address" />
															</div>

															<div class="col-md-5">
																<label for="country" class="form-label">Country</label>
																<select class="form-select" id="country" required>
																	<option value="">Choose...</option>
																	<option>United States</option>
																	<option>Canada</option>
																	<option>UK</option>
																</select>
																<div class="invalid-feedback">Please select a country</div>
															</div>

															<div class="col-md-4">
																<label for="state" class="form-label">State</label>
																<select class="form-select" id="state">
																	<option value="">Choose...</option>
																	<option>California</option>
																</select>
																<div class="invalid-feedback">Please select a state</div>
															</div>

															<div class="col-md-3">
																<label for="zip" class="form-label">Zip</label>
																<input type="text" class="form-control" id="zip" placeholder="" />
															</div>
														</div>

														<hr class="my-4 text-muted">

														<div class="form-check mb-2">
															<input type="checkbox" class="form-check-input" id="same-address">
															<label class="form-check-label" for="same-address">I would like to subscribe for more than one location</label>
														</div>

													</div>

												</div>
												<!-- end tab pane -->
												<div class="tab-pane fade" id="v-pills-payment" role="tabpanel" aria-labelledby="v-pills-payment-tab">
													<div>
														<h5>Invoice</h5>

													</div>

													<ul class="list-group mb-3">
                                                    <li class="list-group-item d-flex justify-content-between lh-sm">
                                                        <div>
                                                            <h6 class="my-0">Performance Management</h6>
                                                            <small class="text-success">For Single User</small>
                                                        </div>
                                                        <span class="text-muted">$10.00</span>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between lh-sm">
                                                        <div>
                                                            <h6 class="my-0">Risk Management</h6>
                                                            <small class="text-success">For Single User</small>
                                                        </div>
                                                        <span class="text-muted">$20.00</span>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between lh-sm">
                                                        <div>
                                                            <h6 class="my-0">Audit Planning</h6>
                                                            <small class="text-success">For Single User</small>
                                                        </div>
                                                        <span class="text-muted">$30.00</span>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between bg-light">
                                                        <div class="text-success">
                                                            <h6 class="my-0">Discount</h6>
															<div class="input-group input-group-sm">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm">Apply</span>
                                                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Discount Code">
                                                </div>
                                                        </div>
                                                        <span class="text-success">-$10.00</span>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between">
                                                        <span>Sub Total (USD)</span>
                                                        <strong>$50.00</strong>
                                                    </li>
													<li class="list-group-item d-flex justify-content-between">
                                                        <span>Tax (USD)</span>
                                                        <strong>$13.00</strong>
                                                    </li>
													<li class="list-group-item d-flex justify-content-between">
                                                        <span>Amount Due (USD)</span>
                                                        <strong>$63.00</strong>
                                                    </li>
                                                </ul>
												</div>
												<!-- end tab pane -->
												<div class="tab-pane fade" id="v-pills-finish" role="tabpanel" aria-labelledby="v-pills-finish-tab">
													<div class="text-center pt-4 pb-2">

                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <h5 class="fs-14 text-primary mb-0"><i class="ri-shopping-cart-fill align-middle me-2"></i> Payment Method</h5>
                                                </div>
                                                <ul class="list-group mb-3">
                                                    <li class="list-group-item d-flex justify-content-between lh-sm">
                                                        <div>
                                                            <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked required>
																<label class="form-check-label" for="credit">Credit card </label>
                                                        </div>
														<small class="text-success">Powered by Stripe</small>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between lh-sm">
                                                        <div>
                                                            <input id="credit" name="paymentMethod" type="radio" class="form-check-input" >
																<label class="form-check-label" for="credit">Debit card </label>
                                                        </div>
														<small class="text-success">Powered by Stripe</small>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between lh-sm">
                                                        <div>
                                                            <input id="credit" name="paymentMethod" type="radio" class="form-check-input">
																<label class="form-check-label" for="credit">PayPal </label>

                                                        </div>
														 <small class="text-success">Coming Soon</small>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between bg-light">
                                                        <div>
                                                            <input id="credit" name="paymentMethod" type="radio" class="form-check-input">
																<label class="form-check-label" for="credit">Send Invoice </label>
                                                        </div>
                                                         <small class="text-success">Email Invoice</small>
                                                    </li>

                                                </ul>
													</div>

												</div>
												<!-- end tab pane -->
											</div>
											<!-- end tab content -->
										</div>
									</div>
									<!-- end col -->

									<div class="col-lg-3">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <h5 class="fs-14 text-primary mb-0"><i class="ri-shopping-cart-fill align-middle me-2"></i> Your selection</h5>
                                                    <span class="badge bg-danger rounded-pill">3</span>
                                                </div>
                                                <ul class="list-group mb-3">
                                                    <li class="list-group-item d-flex justify-content-between lh-sm">
                                                        <div>
                                                            <h6 class="my-0">Performance Management</h6>
                                                            <small class="text-success">For Single User</small>
                                                        </div>
                                                        <span class="text-muted">$10.00</span>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between lh-sm">
                                                        <div>
                                                            <h6 class="my-0">Risk Management</h6>
                                                            <small class="text-success">For Single User</small>
                                                        </div>
                                                        <span class="text-muted">$20.00</span>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between lh-sm">
                                                        <div>
                                                            <h6 class="my-0">Audit Planning</h6>
                                                            <small class="text-success">For Single User</small>
                                                        </div>
                                                        <span class="text-muted">$30.00</span>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between bg-light">
                                                        <div class="text-success">
                                                            <h6 class="my-0">Discount</h6>
                                                        </div>
                                                        <span class="text-success">-$10.00</span>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between">
                                                        <span>Sub Total (USD)</span>
                                                        <strong>$50.00</strong>
                                                    </li>
                                                </ul>

													<div class="d-flex align-items-start gap-3 mt-4">
														<a href="email-verify.php"><button type="button" class="btn btn-success btn-label right ms-auto nexttab nexttab" data-nexttab="v-pills-bill-address-tab"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Next</button></a>
													</div>

                                            </div>
								</div>
								<!-- end row -->
							</form>
						</div>
					</div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->
        </div>
@endsection
@push('scripts')
    <script src="{{asset('assets/login/js/pages/password-addon.init.js')}}"></script>
@endpush

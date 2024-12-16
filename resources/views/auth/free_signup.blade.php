<?php
// Include config file
// require_once "../config/config.php";

// Define variables and initialize with empty values
$useremail = $username =  $password = $confirm_password = "";
$useremail_err = $username_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate useremail
    if (empty(trim($_POST["useremail"]))) {
        $useremail_err = "Please enter a useremail.";
    } elseif (!filter_var($_POST["useremail"], FILTER_VALIDATE_EMAIL)) {
        $useremail_err = "Invalid email format";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE useremail = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_useremail);

            // Set parameters
            $param_useremail = trim($_POST["useremail"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $useremail_err = "This user email is already taken.";
                } else {
                    $useremail = trim($_POST["useremail"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);

        }
    }

    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 8) {
        $password_err = "Password must have atleast 8 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    // if (empty(trim($_POST["confirm_password"]))) {
    //     $confirm_password_err = "Please enter a confirm password.";
    // } else {
    //     $confirm_password = trim($_POST["confirm_password"]);
    //     if (empty($password_err) && ($password != $confirm_password)) {
    //         $confirm_password_err = "Password did not match.";
    //     }
    // }

    // Check input errors before inserting in database
    if (empty($useremail_err) && empty($username_err) && empty($password_err) && empty($confirm_password_err)) {

        // Prepare an insert statement
        $sql = "INSERT INTO users (useremail, username, password, token) VALUES (?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_useremail, $param_username, $param_password, $param_token);

            // Set parameters
            $param_useremail = $useremail;
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_token = bin2hex(random_bytes(50)); // generate unique token

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to index page
                header("location: verify.php");
            } else {
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($link);
}
?>
@extends('layouts.login.main')
@section('title', 'Sign Up')
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
                                <a href="{{ route('home', ['locale' => app()->getLocale()])}}" class="d-inline-block auth-logo">
                                    <img src="{{asset('assets/login/images/logo-light.png')}}" alt="" height="20">
                                </a>
                            </div>
                            <p class="mt-3 fs-15 fw-medium">Online Performance and Risk Management Framework</p>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">

                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Sign up for a Free Trial</h5>
                                    <p class="text-muted">Create New Account</p>
                                </div>
                                <div class="px-lg-4">
                                            <form method="post" action="{{ route('free-signup.store', ['locale' => app()->getLocale()]) }}">
                                            @csrf
											<div class="tab-content">
												<div class="tab-pane fade  show active" id="v-pills-bill-info" role="tabpanel" aria-labelledby="v-pills-bill-info-tab">
													<div>
														<p class="text-muted">Fill the information below</p>
													</div>

													<div>
														<div class="row g-3">
															<div class="col-sm-6">
																<label for="firstName" class="form-label">First name</label>
																<input type="text" class="form-control" id="firstName" placeholder="Enter first name" value="{{ old('first_name') }}"  name="first_name">
															@error('first_name')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
															</div>

															<div class="col-sm-6">
																<label for="lastName" class="form-label">Last name</label>
																<input type="text" class="form-control" id="lastName" placeholder="Enter last name" value="{{ old('last_name') }}" name="last_name">
															@error('last_name')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
															</div>

															<div class="col-12">
																<label for="email" class="form-label">Email</label>
																	<input type="email" name="email" class="form-control" id="email" placeholder="Email" value="{{ old('email') }}" >
															@error('email')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
																</div>

															<div class="col-6">
																<label for="password" class="form-label">Password </label>
																<input type="password" name="password" class="form-control" id="password" placeholder="Password" />
                                                            @error('password')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
															</div>
															<div class="col-6">
																<label for="password_confirmation" class="form-label">Confirm Password </label>
																<input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirm Password" />
                                                            @error('password')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
															</div>
														</div>
													</div>

													<hr class="my-4 text-muted">

													<div class="row g-3">
															<div class="col-12">
																<label for="organization_name" class="form-label">Organization</label>
																<input type="text" class="form-control" name="organization_name" id="organization_name" placeholder="Organization Name" value="{{ old('organization_name') }}">
															@error('organization_name')
                                                                <div class="text-danger">{{ $message }}</div>
                                                           @enderror
															</div>

															<div class="col-12">
																<label for="address" class="form-label">Address</label>
																<input type="text" class="form-control" id="address" placeholder="Address" name="address" value="{{ old('address') }}" />
                                                              @error('address')
                                                                <div class="text-danger">{{ $message }}</div>
                                                               @enderror
															</div>

															<div class="col-md-5">
																<label for="country" class="form-label">Country</label>
																<select class="form-select" name="country" id="country">
																	<option value="">Choose...</option>
																	<option value="pakistan">Pakistan</option>
																</select>
															@error('country')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
															</div>

															<div class="col-md-4">
																<label for="state" class="form-label">State</label>
																<select class="form-select" id="state" name="state">
																	<option value="">Choose...</option>
																	<option value="punjab">Punjab</option>
                                                                    <option value="sindh">Sindh</option>
                                                                    <option value="kpk">KPK</option>
                                                                    <option value="balochistan">Balochistan</option>
																</select>
															   @error('state')
                                                                <div class="text-danger">{{ $message }}</div>
                                                               @enderror
															</div>
															<div class="col-md-3">
																<label for="zip" class="form-label">Zip</label>
																<input type="text" name="zip_code" class="form-control" id="zip" placeholder="" value="{{ old('zip_code') }}" />
                                                            @error('zip_code')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
															</div>
														</div>
                                                         <div class="col-12">
																<label for="city" class="form-label">City</label>
																<input type="text" name="city" class="form-control" id="city" placeholder="Enter City" value="{{ old('city') }}" />
                                                            @error('city')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
														</div>
													<hr class="my-4 text-muted">

													<div class="form-check mb-2">
														<input type="checkbox" name="terms_conditions" class="form-check-input" id="terms_conditions">
														<label class="form-check-label" for="terms_conditions">By continuing, I agree to the ORMAF <a href="#">Terms and Conditions</a></label>
													</div>
												</div>
												<!-- end tab pane -->
											</div>
											<!-- end tab content -->

											<div class="mt-4">
                                            <button class="btn btn-success w-100" type="submit">Sign Up</button>
                                        </div>
                                        </form>
										</div>

                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        <div class="mt-4 text-center">
                            <p class="mb-0">Already have an account ? <a href="{{ route('login.create', [ 'locale' => app()->getLocale()])}}" class="fw-semibold text-primary text-decoration-underline"> Signin </a> </p>
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
 <!-- validation init -->
    <script src="{{asset('assets/login/js/pages/form-validation.init.js')}}"></script>
    <!-- password create init -->
    <script src="{{asset('assets/login/js/pages/passowrd-create.init.js')}}"></script>
@endpush

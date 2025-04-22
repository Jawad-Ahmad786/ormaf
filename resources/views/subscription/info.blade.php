@extends('layouts.login.main')
@section('title', 'Subscription Info')
@section('content')
    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 1440 120">
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
                                <a href="{{ route('home', ['locale' => app()->getLocale()]) }}"
                                    class="d-inline-block auth-logo">
                                    <img src="{{ asset('assets/login/images/logo-light.png') }}" alt=""
                                        height="20">
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
                            <form class="vertical-navs-step" method="post" action="{{ route('register.store', app()->getLocale()) }}">
                                @csrf
                                <div class="row gy-5">
                                    <div class="col-lg-3">
                                        <div class="nav flex-column custom-nav nav-pills" role="tablist"
                                            aria-orientation="vertical">
                                            <button class="nav-link active" id="v-pills-bill-info-tab" data-bs-toggle="pill"
                                                data-bs-target="#v-pills-bill-info" type="button" role="tab"
                                                aria-controls="v-pills-bill-info" aria-selected="true">
                                                <span class="step-title me-2">
                                                    <i class="ri-close-circle-fill step-icon me-2"></i> Step 1
                                                </span>
                                                Personal Details
                                            </button>
                                            <button class="nav-link" id="v-pills-bill-address-tab" data-bs-toggle="pill"
                                                data-bs-target="#v-pills-bill-address" type="button" role="tab"
                                                aria-controls="v-pills-bill-address" aria-selected="false">
                                                <span class="step-title me-2">
                                                    <i class="ri-close-circle-fill step-icon me-2"></i> Step 2
                                                </span>
                                                Organization
                                            </button>
                                            <button class="nav-link" id="v-pills-payment-tab" data-bs-toggle="pill"
                                                data-bs-target="#v-pills-payment" type="button" role="tab"
                                                aria-controls="v-pills-payment" aria-selected="false">
                                                <span class="step-title me-2">
                                                    <i class="ri-close-circle-fill step-icon me-2"></i> Step 3
                                                </span>
                                                Invoice
                                            </button>
                                            <button class="nav-link" id="v-pills-finish-tab" data-bs-toggle="pill"
                                                data-bs-target="#v-pills-finish" type="button" role="tab"
                                                aria-controls="v-pills-finish" aria-selected="false">
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
                                                <div class="tab-pane fade  show active" id="v-pills-bill-info"
                                                    role="tabpanel" aria-labelledby="v-pills-bill-info-tab">
                                                    <div>
                                                        <h5>Personal Details</h5>
                                                        <p class="text-muted">Fill the information below</p>
                                                    </div>

                                                    <div>
                                                        <div class="row g-3">
                                                            <div class="col-sm-6">
                                                                <label for="firstName" class="form-label">First name</label>
                                                                <input type="text" name="first_name" class="form-control"
                                                                    id="firstName" placeholder="Enter first name"
                                                                    value="{{ old('first_name') }}">
                                                                @error('first_name')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                            <div class="col-sm-6">
                                                                <label for="lastName" class="form-label">Last name</label>
                                                                <input type="text" name="last_name" class="form-control"
                                                                    id="lastName" placeholder="Enter last name"
                                                                    value="{{ old('last_name') }}">
                                                                @error('last_name')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                            <div class="col-12">
                                                                <label for="email" class="form-label">Email</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-text">@</span>
                                                                    <input type="email" name="email"
                                                                        class="form-control" id="email"
                                                                        placeholder="Email"
                                                                        value="{{ old('email') }}">
                                                                    @error('email')
                                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-6">
                                                                <label for="password" class="form-label">Password </label>
                                                                <input type="password" name="password"
                                                                    class="form-control" id="password"
                                                                    placeholder="Password" />
                                                                @error('password')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-6">
                                                                <label for="password_confirmation"
                                                                    class="form-label">Confirm Password </label>
                                                                <input type="password" name="password_confirmation"
                                                                    class="form-control" id="password_confirmation"
                                                                    placeholder="Confirm Password" />
                                                                @error('password')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <hr class="my-4 text-muted">

                                                    <div class="form-check mb-2">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="terms_conditions">
                                                        <label class="form-check-label" for="terms_conditions">By continuing,
                                                            I agree to the ORMAF <a href="#">Terms and
                                                                Conditions</a></label>
                                                    </div>
                                                </div>
                                                <!-- end tab pane -->
                                                <div class="tab-pane fade" id="v-pills-bill-address" role="tabpanel"
                                                    aria-labelledby="v-pills-bill-address-tab">
                                                    <div>
                                                        <h5>Organization</h5>
                                                        <p class="text-muted">Fill all information below</p>
                                                    </div>

                                                    <div>
                                                        <div class="row g-3">
                                                            <div class="col-12">
                                                                <label for="organization_name" class="form-label">Name</label>
                                                                <input type="text" name="organization_name" class="form-control" id="organization_name"
                                                                    placeholder="Organization Name"
                                                                    value="{{ old('organization_name') }}">
                                                              @error('organization_name')
                                                                <div class="invalid-feedback">
                                                                {{ $message }}
                                                                </div>
                                                              @enderror
                                                            </div>

                                                            <div class="col-12">
                                                                <label for="address" class="form-label">Address</label>
                                                                <input type="text" name="address" class="form-control" id="address"
                                                                    placeholder="Address"
                                                                    value="{{ old('address') }}" />
                                                            </div>

                                                            <div class="col-md-5">
                                                               <label for="country" class="form-label">Country</label>
                                                            <select class="form-select" name="country" id="country">
                                                                <option value="">Choose...</option>
                                                                @foreach ($countries as $country)
                                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('country')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                            </div>

                                                            <div class="col-md-4">
                                                                <label for="state" class="form-label">State</label>
                                                            <select class="form-select" name="state" id="state">
                                                                <option value="">Choose...</option>
                                                            </select>
                                                            @error('state')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label for="city" class="form-label">City</label>
                                                            <select class="form-select" name="city" id="city">
                                                                <option value="">Choose...</option>
                                                            </select>
                                                            @error('city')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="zip_code" class="form-label">Zip</label>
                                                                <input type="text" name="zip_code" class="form-control" id="zip_code"
                                                                    placeholder="Enter Zip Code"
                                                                    value="{{ old('zip_code') }}" />
                                                                @error('zip_code')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                            </div>
                                                        </div>

                                                        <hr class="my-4 text-muted">

                                                        <div class="form-check mb-2">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="same-address">
                                                            <label class="form-check-label" for="same-address">I would
                                                                like to subscribe for more than one location</label>
                                                        </div>

                                                    </div>
                                                </div>
                                                <!-- end tab pane -->
                                                <div class="tab-pane fade" id="v-pills-payment" role="tabpanel"
                                                    aria-labelledby="v-pills-payment-tab">
                                                    <div>
                                                        <h5>Invoice</h5>

                                                    </div>
                                                <ul class="list-group mb-3" id="selected-plans-list"></ul>
                                                    <ul class="list-group mb-3">
                                                        <li
                                                            class="list-group-item d-flex justify-content-between bg-light">
                                                            <div class="text-success">
                                                                <h6 class="my-0">Discount</h6>
                                                                <div class="input-group input-group-sm">
                                                                    <span class="input-group-text"
                                                                        id="inputGroup-sizing-sm">Apply</span>
                                                                    <input type="text" class="form-control"
                                                                        aria-label="Sizing example input"
                                                                        aria-describedby="inputGroup-sizing-sm"
                                                                        placeholder="Discount Code">
                                                                </div>
                                                            </div>
                                                            <span class="text-success"id="discount"></span>
                                                        </li>
                                                        <li class="list-group-item d-flex justify-content-between">
                                                            <span>Sub Total (USD)</span>
                                                            <strong id="sub-total"></strong>
                                                        </li>
                                                        <li class="list-group-item d-flex justify-content-between">
                                                            <span>Tax (USD)</span>
                                                            <strong id="tax"></strong>
                                                        </li>
                                                        <li class="list-group-item d-flex justify-content-between">
                                                            <span>Amount Due (USD)</span>
                                                            <strong id="amount-due"></strong>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!-- end tab pane -->
                                                <div class="tab-pane fade" id="v-pills-finish" role="tabpanel"
                                                    aria-labelledby="v-pills-finish-tab">
                                                    <div class="text-center pt-4 pb-2">

                                                        <div
                                                            class="d-flex justify-content-between align-items-center mb-3">
                                                            <h5 class="fs-14 text-primary mb-0"><i
                                                                    class="ri-shopping-cart-fill align-middle me-2"></i>
                                                                Payment Method</h5>
                                                        </div>
                                                        <ul class="list-group mb-3">
                                                            <li
                                                                class="list-group-item d-flex justify-content-between lh-sm">
                                                                <div>
                                                                    <input id="credit" name="paymentMethod"
                                                                        type="radio" class="form-check-input"
                                                                        value="stripe"
                                                                        >
                                                                    <label class="form-check-label" for="credit">Credit
                                                                        card </label>
                                                                </div>
                                                                <small class="text-success">Powered by Stripe</small>
                                                            </li>
                                                            <li
                                                                class="list-group-item d-flex justify-content-between lh-sm">
                                                                <div>
                                                                    <input id="paypal" name="paymentMethod"
                                                                        type="radio" class="form-check-input"
                                                                        value="paypal"
                                                                        >
                                                                    <label class="form-check-label" for="paypal">PayPal
                                                                    </label>

                                                                </div>
                                                                <small class="text-success">Coming Soon</small>
                                                            </li>
                                                            <li
                                                                class="list-group-item d-flex justify-content-between bg-light">
                                                                <div>
                                                                    <input id="invoice" name="paymentMethod"
                                                                        type="radio" class="form-check-input"
                                                                        value="invoice"
                                                                        >
                                                                    <label class="form-check-label" for="invoice">Send
                                                                        Invoice </label>
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
                                            <h5 class="fs-14 text-primary mb-0"><i
                                                    class="ri-shopping-cart-fill align-middle me-2"></i> Your selection
                                            </h5>
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
                                            <button type="submit"
                                                    class="btn btn-success btn-label right ms-auto nexttab nexttab"
                                                    data-nexttab="v-pills-bill-address-tab"><i
                                                        class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Next</button>
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
    <script>
    $(document).ready(function () {

        // When the country is selected
        $('#country').on('change', function () {
            const countryId = $(this).val();
            let locale = "{{ app()->getLocale() }}"; // Get the locale from Laravel
            $('#state').html('<option value="">Choose...</option>');
            $('#city').html('<option value="">Choose...</option>');
            let url = `/${locale}/locations/states/${countryId}`;

            if (countryId) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function (states) {
                        states.forEach(state => {
                            $('#state').append(`<option value="${state.id}">${state.name}</option>`);
                        });
                    }
                });
            }
        });

        // When the state is selected
        $('#state').on('change', function () {
            const stateId = $(this).val();
            let locale = "{{ app()->getLocale() }}"; // Get the locale from Laravel
            $('#city').html('<option value="">Choose...</option>');
            let url = `/${locale}/locations/cities/${stateId}`;

            if (stateId) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function (cities) {
                        cities.forEach(city => {
                            $('#city').append(`<option value="${city.id}">${city.name}</option>`);
                        });
                    }
                });
            }
        });

        const selectedPlans = JSON.parse(localStorage.getItem('selectedPlans')) || [];

        console.log(selectedPlans)
        // 2. Get the UL element
        const plansList = document.getElementById('selected-plans-list');

        let totalAmount = 0;

        // 3. Loop and inject each plan
        selectedPlans.forEach(plan => {
            const li = document.createElement('li');
            li.className = 'list-group-item d-flex justify-content-between lh-sm';

            li.innerHTML = `
                <div>
                    <h6 class="my-0">${plan.module_name}</h6>
                    <small class="text-success">${plan.plan_name}</small>
                </div>
                <span class="text-muted">$${(plan.price ).toFixed(2)}</span>
            `;

            plansList.appendChild(li);

            totalAmount += plan.price;
        });

        const subTotal = totalAmount
        const discount = localStorage.getItem('discount');
        const tax = 0.00;
        const amountDue = subTotal + tax - discount;

        document.getElementById('sub-total').textContent = `$${subTotal.toFixed(2)}`;
        document.getElementById('discount').textContent = `-$${discount}`;
        document.getElementById('tax').textContent = `$${tax.toFixed(2)}`;
        document.getElementById('amount-due').textContent = `$${amountDue.toFixed(2)}`;

    });
</script>
@endsection
@push('scripts')
    <script src="{{ asset('assets/login/js/pages/password-addon.init.js') }}"></script>
@endpush

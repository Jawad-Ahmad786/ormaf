@extends('layouts.login.main')
@section('title', 'Subscription Plans')
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
                            <div class="col-lg-12">
                                <div class="text-center mb-4">
                                    <h4 class="fw-semibold fs-22">Select Subscription Plan</h4>
                                    <p class="text-muted mb-4 fs-15">Simple pricing. No hidden fees. <br>
                                        Advanced features for your management and reporting needs.</p>

                                    <div class="d-inline-flex">
                                        <ul class="nav nav-pills arrow-navtabs plan-nav rounded mb-3 p-1" id="pills-tab"
                                            role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button
                                                    class="nav-link fw-semibold {{ $annualTab == 'false' ? 'active' : '' }}"
                                                    id="month-tab" data-bs-toggle="pill" data-bs-target="#month"
                                                    type="button" role="tab" aria-selected="true">Monthly</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button
                                                    class="nav-link fw-semibold {{ $annualTab == 'true' ? 'active' : '' }}"
                                                    id="annual-tab" data-bs-toggle="pill" data-bs-target="#annual"
                                                    type="button" role="tab" aria-selected="false">Annual <span
                                                        class="badge bg-success">25% Off</span></button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card header -->
                        <div class="card-body form-steps">
                            <form class="vertical-navs-step">
                                <div class="row gy-5">
                                    <!-- end col-->
                                    <div class="col-xl-9">
                                        @foreach ($selectedModules as $module)
                                            <div class="mb-4">
                                                <h5 class="fw-bold text-primary">{{ $module->name }}</h5>
                                                <div class="row">
                                                    @foreach ($module->plans as $plan)
                                                        @php
                                                            $monthly = $plan->pivot->price;
                                                            $annual = round($monthly * 12, 2);
                                                            $discounted = round($annual * 0.75, 2);
                                                        @endphp
                                                        <div class="col-lg-4">
                                                            <div class="card pricing-box">
                                                                <div class="card-body p-4 m-2">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="flex-grow-1">
                                                                            <h5 class="mb-1 fw-semibold">{{ $plan->name }}
                                                                            </h5>
                                                                            <small class="text-success">
                                                                                @if ($plan->name == 'Basic')
                                                                                    For Single User
                                                                                @elseif ($plan->name == 'Standard')
                                                                                    For Multi User
                                                                                @else
                                                                                    For Multi Department
                                                                                @endif
                                                                            </small>
                                                                        </div>
                                                                        <div class="avatar-sm">
                                                                            <div
                                                                                class="avatar-title bg-light rounded-circle text-primary">
                                                                                <i class="ri-book-mark-line fs-20"></i>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="pt-3 text-center">
                                                                        <div class="price-display">
                                                                            <span class="price-amount h2 fw-bold"
                                                                                data-monthly="{{ $monthly }}"
                                                                                data-annual="{{ $annual }}"
                                                                                data-discounted="{{ $discounted }}">
                                                                                ${{ $monthly }}
                                                                            </span>
                                                                            <span
                                                                                class="price-type fs-13 text-muted">/Month</span>
                                                                        </div>
                                                                        <div class="discount-badge d-none mt-1">
                                                                            <span
                                                                                class="text-decoration-line-through text-muted me-2 strike-price"></span>
                                                                            <span class="badge bg-success">25% Off</span>
                                                                        </div>
                                                                    </div>

                                                                    <hr class="my-4 text-muted">

                                                                    <ul class="list-unstyled text-muted vstack gap-3">
                                                                        @foreach ($plan->features as $feature)
                                                                            <li>
                                                                                <div class="d-flex">
                                                                                    <div
                                                                                        class="flex-shrink-0 text-{{ $feature->pivot->value === 'No' ? 'danger' : 'success' }} me-1">
                                                                                        <i
                                                                                            class="ri-{{ $feature->pivot->value === 'No' ? 'close' : 'checkbox' }}-circle-fill fs-15 align-middle"></i>
                                                                                    </div>
                                                                                    <div class="flex-grow-1">
                                                                                        @if ($feature->pivot->value === 'Yes' || $feature->pivot->value === 'No')
                                                                                            {{ $feature->name }}
                                                                                        @else
                                                                                            {{ $feature->pivot->value }}
                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>

                                                                    <div class="mt-4">
                                                                        <a href="#"
                                                                            class="btn btn-success w-100 waves-effect waves-light select-plan"
                                                                            data-plan-name="{{ $plan->name }}"
                                                                            data-plan-price="{{ $monthly }}">
                                                                            Select
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                        @endforeach
                                    </div>
                                </div>


                                <!--end row-->
                        </div>
                        <!-- end col -->

                        <div class="col-lg-3">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="fs-14 text-primary mb-0"><i class="ri-shopping-cart-fill align-middle me-2"></i>
                                    Your selection</h5>
                                <span class="badge bg-danger rounded-pill">3</span>
                            </div>
                            <ul class="list-group mb-3">
                                <li class="list-group-item d-flex justify-content-between bg-light">
                                    <div class="text-success">
                                        <h6 class="my-0">Discount</h6>
                                    </div>
                                    <span class="text-success">-$10.00</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Sub Total (USD)</span>
                                    <strong id="subtotal">$0.00</strong>
                                </li>
                            </ul>

                            <div class="d-flex align-items-start gap-3 mt-4">
                                <a href="{{ route('subscription.info', ['locale' => app()->getLocale()]) }}"><button
                                        type="button" class="btn btn-success btn-label right ms-auto nexttab nexttab"
                                        data-nexttab="v-pills-bill-address-tab"><i
                                            class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Checkout</button></a>
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
    <!-- end row -->


    <!--end row-->

    </div>
    <!-- end row -->
    </div>
    <!-- end container -->
    </div>
    <!-- end auth page content -->
    </div>
    <script>
        $(document).ready(function() {

    const isAnnual = "{{ $annualTab }}" === "true";

    function updatePrices(showAnnual) {
        $(".price-amount").each(function() {
            const $this = $(this);
            const originalMonthly = parseFloat($this.data("monthly"));
            console.log('Monthly Prices: ', originalMonthly);
            let displayPrice;

            if (showAnnual) {
                const annual = originalMonthly * 12;
                const discounted = annual * 0.75;
                displayPrice = discounted;
                $this.closest(".price-display").siblings(".discount-badge").removeClass('d-none')
                    .find(".strike-price").text(`$${annual.toFixed(2)}`);
                $this.closest(".price-display").find(".price-type").text("/Year");
            } else {
                displayPrice = originalMonthly;
                $this.closest(".price-display").find(".price-type").text("/Month");
                $this.closest(".price-display").siblings(".discount-badge").addClass('d-none');
            }

            $this.text(`$${displayPrice.toFixed(2)}`);
        });
    }

    // Initial load
    if (isAnnual) {
        updatePrices(true);
    } else {
        updatePrices(false);
    }

    // Toggle listeners
    $("#month-tab").on("click", function() {
        updatePrices(false);
    });

    $("#annual-tab").on("click", function() {
        updatePrices(true);
    });


            {{-- let selectedModules = JSON.parse(localStorage.getItem("selectedModules")) || {};
    let selectedPlan = JSON.parse(localStorage.getItem("selectedPlan")) || null;
    let isAnnual = localStorage.getItem("isAnnual") === "true"; // Check if annual billing is selected
    let subtotal = 0;
    let discount = 0;

    let invoiceList = $(".list-group.mb-3");
    invoiceList.find(".dynamic-item").remove(); // Remove previous items

    // ✅ Add Selected Plan to Invoice (if exists)
    if (selectedPlan) {
        let planPrice = parseFloat(selectedPlan.price);

        // If annual is selected, multiply by 12 and apply 25% discount
        if (isAnnual) {
            discount += planPrice * 12 * 0.25;
            planPrice = planPrice * 12 - discount;
        }

        subtotal += planPrice;

        let planItem = `
            <li class="list-group-item d-flex justify-content-between lh-sm dynamic-item">
                <div>
                    <h6 class="my-0">${selectedPlan.name} Plan</h6>
                </div>
                <span class="text-muted">$${planPrice.toFixed(2)}</span>
            </li>
        `;

        invoiceList.prepend(planItem);
    }

    // ✅ Add Selected Modules to Invoice
    $.each(selectedModules, function (moduleId, module) {
        let price = isAnnual ? module.annualPrice : module.monthlyPrice;
        let discountAmount = isAnnual ? module.discountAmount : 0;

        subtotal += price;
        discount += discountAmount;

        let moduleItem = `
            <li class="list-group-item d-flex justify-content-between lh-sm dynamic-item">
                <div>
                    <h6 class="my-0">${module.name}</h6>
                </div>
                <span class="text-muted">$${price.toFixed(2)}</span>
            </li>
        `;

        invoiceList.prepend(moduleItem);
    });

    // ✅ If no modules or plan selected, show message
    if (!selectedPlan && Object.keys(selectedModules).length === 0) {
        let emptyMessage = `
            <li class="list-group-item text-center text-muted dynamic-item">
                No plan or modules selected.
            </li>
        `;
        invoiceList.prepend(emptyMessage);
    }

    // ✅ Update discount row
    $(".bg-light .text-success").text(discount > 0 ? `-$${discount.toFixed(2)}` : "-$0.00");

    // ✅ Update Subtotal
    $("#subtotal").text(`$${(subtotal - discount).toFixed(2)}`);

    // ✅ Store updated subtotal in localStorage
    localStorage.setItem("subtotal", subtotal - discount);
});

// ✅ Function to Handle Plan Selection
$(".select-plan").click(function () {
    let planName = $(this).data("plan-name");
    let planPrice = $(this).data("plan-price");

    localStorage.setItem("selectedPlan", JSON.stringify({ name: planName, price: planPrice }));

    // Reload to update invoice
    location.reload(); --}}
        });
    </script>
@endsection

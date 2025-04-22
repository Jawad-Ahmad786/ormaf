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
            <!-- Main Plans Section -->
            <div class="col-xl-9">
                @foreach ($selectedModules as $module)
                    <div class="mb-4" data-module="{{ $module->name }}">
                        <h5 class="fw-bold text-primary">{{ $module->name }}</h5>
                        <div class="row">
                            @foreach ($module->plans as $plan)
                                @php
                                    $monthly = $plan->pivot->price;
                                    $annual = round($monthly * 12, 2);
                                    $discounted = round($annual * 0.75, 2);
                                @endphp
                                <div class="col-lg-4">
                                    <div class="card pricing-box plan-card"
                                        data-id="{{ $plan->id }}"
                                        data-name="{{ $plan->name }}"
                                        data-price="{{ $plan->pivot->price }}"
                                        >
                                        <div class="card-body p-4 m-2">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <h5 class="mb-1 fw-semibold">{{ $plan->name }}</h5>
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
                                                    <div class="avatar-title bg-light rounded-circle text-primary">
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
                                                    <span class="price-type fs-13 text-muted">/Month</span>
                                                </div>
                                                <div class="discount-badge d-none mt-1">
                                                    <span class="text-decoration-line-through text-muted me-2 strike-price"></span>
                                                    <span class="badge bg-success">25% Off</span>
                                                </div>
                                            </div>

                                            <hr class="my-4 text-muted">

                                            <ul class="list-unstyled text-muted vstack gap-3">
                                                @foreach ($plan->features as $feature)
                                                    <li>
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 text-{{ $feature->pivot->value === 'No' ? 'danger' : 'success' }} me-1">
                                                                <i class="ri-{{ $feature->pivot->value === 'No' ? 'close' : 'checkbox' }}-circle-fill fs-15 align-middle"></i>
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
                                                <button type="button"
                                                    class="btn btn-success w-100 waves-effect waves-light select-plan">
                                                    Select
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- End Main Plans Section -->

            <!-- Sidebar Selection Summary -->
            <div class="col-lg-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fs-14 text-primary mb-0">
                        <i class="ri-shopping-cart-fill align-middle me-2"></i> Your Selection
                    </h5>
                    <span class="badge bg-danger rounded-pill" id="item-count">0</span>
                </div>

                <ul class="list-group mb-3" id="selected-items">
                    <!-- Selected plans will appear here -->
                </ul>

                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between bg-light">
                        <div class="text-success">
                            <h6 class="my-0">Discount</h6>
                        </div>
                        <span class="text-success" id="discount">-$0.00</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Sub Total (USD)</span>
                        <strong id="subtotal">$0.00</strong>
                    </li>
                </ul>

                <div class="d-flex align-items-start gap-3 mt-4">
                    <a href="{{ route('subscription.info', ['locale' => app()->getLocale()]) }}" class="w-100">
                        <button type="button" class="btn btn-success w-100 btn-label right nexttab"
                            data-nexttab="v-pills-bill-address-tab">
                            Checkout <i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>
                        </button>
                    </a>
                </div>
            </div>
            <!-- End Sidebar Selection Summary -->

        </div>
        <!-- End Row -->
    </form>
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
    let isAnnual = "{{ $annualTab }}" === "true";
    let selectedPlans = [];

    // Load stored plans safely
    let storedPlans = localStorage.getItem("selectedPlans");
    if (storedPlans) {
        try {
            const parsedPlans = JSON.parse(storedPlans);
            if (Array.isArray(parsedPlans)) {
                selectedPlans = parsedPlans;
            } else {
                selectedPlans = [];
            }
        } catch (error) {
            selectedPlans = [];
        }
    }

    let storedIsAnnual = localStorage.getItem("isAnnual");
    if (storedIsAnnual !== null) {
        isAnnual = JSON.parse(storedIsAnnual);
    }

    function getMonthlyPrice($card) {
        return parseFloat($card.data("price"));
    }

    function updatePrices(showAnnual) {
        $(".price-amount").each(function() {
            const $this = $(this);
            const originalMonthly = parseFloat($this.data("monthly"));
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

    function storeSelectedPlans() {
        localStorage.setItem("selectedPlans", JSON.stringify(selectedPlans));
        localStorage.setItem("isAnnual", JSON.stringify(isAnnual));
    }

    function updateInvoice() {
    let subtotal = 0;
    let totalDiscountAmount = 0;
    let itemCount = 0;
    $("#selected-items").empty();

    selectedPlans.forEach(plan => {
        let $card = $(`.mb-4[data-module="${plan.module_name}"] .plan-card[data-name="${plan.plan_name}"]`);
        if ($card.length > 0) {
            const monthlyPrice = parseFloat($card.data("price"));
            const originalAnnualPrice = monthlyPrice * 12;
            const discountedAnnualPrice = originalAnnualPrice * 0.75;
            const displayedPrice = isAnnual ? originalAnnualPrice : monthlyPrice;
            const originalPriceForCalculation = isAnnual ? originalAnnualPrice : monthlyPrice;
            const discount = isAnnual ? (originalAnnualPrice - discountedAnnualPrice) : 0;

            subtotal += displayedPrice;
            subtotal -= discount;
            totalDiscountAmount += discount;
            itemCount++;

            $("#selected-items").append(`
                <li class="list-group-item d-flex justify-content-between">
                    <span>${plan.module_name} - ${plan.plan_name}</span>
                    <div>
                        ${isAnnual ? `<strong class="ms-2">$${displayedPrice.toFixed(2)}</strong>` : `<strong>$${displayedPrice.toFixed(2)}</strong>`}
                    </div>
                </li>
            `);
        }
    });

    $("#subtotal").text(`$${subtotal.toFixed(2)}`);
    $("#discount").text(`-$${totalDiscountAmount.toFixed(2)}`);
    $("#total").text(`$${subtotal.toFixed(2)}`);
    $("#item-count").text(itemCount);
    localStorage.setItem("discount", JSON.stringify(totalDiscountAmount || 0));
}

    function restoreSelections() {
        $(".plan-card").each(function() {
            const $card = $(this);
            const moduleName = $card.closest(".mb-4").data("module");
            const planName = $card.data("name");

            const isSelected = selectedPlans.some(plan => plan.module_name === moduleName && plan.plan_name === planName);

            if (isSelected) {
                $card.css("border", "2px solid green");
                $card.find(".select-plan").text("Unselect");
            } else {
                $card.css("border", "none");
                $card.find(".select-plan").text("Select");
            }
        });

        updateInvoice();
    }

    function updateSelectedPlansPrices() {
        const updatedPlans = selectedPlans.map(plan => {
            const $card = $(`.mb-4[data-module="${plan.module_name}"] .plan-card[data-name="${plan.plan_name}"]`);
            if ($card.length > 0) {
                const monthlyPrice = getMonthlyPrice($card);
                const updatedPrice = isAnnual ? monthlyPrice * 12 : monthlyPrice;
                return { ...plan, price: updatedPrice };
            }
            return plan;
        });
        selectedPlans = updatedPlans;
        storeSelectedPlans();
        console.log('Updated Selected Plans in Storage: ', JSON.parse(localStorage.getItem('selectedPlans')));
    }

    // Initial load
    updatePrices(isAnnual);
    restoreSelections();

    // Toggle listeners
    $("#month-tab").on("click", function() {
        isAnnual = false;
        updatePrices(false);
        updateSelectedPlansPrices();
        updateInvoice();
        storeSelectedPlans();
    });

    $("#annual-tab").on("click", function() {
        isAnnual = true;
        updatePrices(true);
        updateSelectedPlansPrices();
        updateInvoice();
        storeSelectedPlans();
    });

    $(".select-plan").on("click", function() {
        let clickedCard = $(this).closest(".plan-card");
        let planName = clickedCard.data("name");
        let moduleName = clickedCard.closest(".mb-4").data("module");
        const monthlyPrice = getMonthlyPrice(clickedCard);
        const priceToStore = isAnnual ? monthlyPrice * 12 : monthlyPrice;

        const existingIndex = selectedPlans.findIndex(plan =>
            plan.module_name === moduleName && plan.plan_name === planName
        );

        if (existingIndex > -1) {
            // Unselect
            selectedPlans.splice(existingIndex, 1);
            clickedCard.css("border", "none");
            clickedCard.find(".select-plan").text("Select");
        } else {
            // Select
            selectedPlans.push({
                module_name: moduleName,
                plan_name: planName,
                price: priceToStore
            });
            clickedCard.css("border", "2px solid green");
            clickedCard.find(".select-plan").text("Unselect");
        }

        storeSelectedPlans();
        updateInvoice();
        console.log('Selected Plans: ', JSON.parse(localStorage.getItem('selectedPlans')));
    });
});


    </script>

@endsection

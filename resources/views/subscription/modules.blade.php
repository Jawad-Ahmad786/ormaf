@extends('layouts.login.main')
@section('title', 'Subscription Modules')
@section('content')
    <div class="auth-page-wrapper pt-5">
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>
            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <div class="auth-page-content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="card">
                        <div class="card-header">
                            <div class="col-lg-12 text-center mb-4">
                                <h4 class="fw-semibold fs-22">Select Modules</h4>
                                <p class="text-muted fs-15">
                                    Simple pricing. No hidden fees. <br> Advanced features for your management and reporting needs.
                                </p>
                                <div class="d-inline-flex">
                                    <ul class="nav nav-pills arrow-navtabs plan-nav rounded mb-3 p-1" id="pills-tab">
                                        <li class="nav-item">
                                            <button class="nav-link fw-semibold active" id="month-tab" data-bs-toggle="pill" type="button">
                                                Monthly
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button class="nav-link fw-semibold" id="annual-tab" data-bs-toggle="pill" type="button">
                                                Annual <span class="badge bg-success">25% Off</span>
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="card-body form-steps">
                            <form class="vertical-navs-step">
                                <div class="row gy-5">
                                    <div class="col-xl-9">
                                        <div class="row">
                                            @foreach ($modules as $module)
                                                <div class="col-lg-4">
                                                    <div class="card pricing-box module-card"
                                                         data-id="{{ $module->id }}"
                                                         data-name="{{ $module->name }}"
                                                         data-price="{{ $module->plans->first()->pivot->price }}">
                                                        <div class="card-body p-4 m-2">
                                                            <div class="d-flex align-items-center">
                                                                <div class="flex-grow-1">
                                                                    <h5 class="mb-1 fw-semibold">{{ $module->name }}</h5>
                                                                </div>
                                                                <div class="avatar-sm">
                                                                    <div class="avatar-title bg-light rounded-circle text-primary">
                                                                        <i class="ri-book-mark-line fs-20"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="pt-4">
                                                                <h2>
                                                                    <sup><small>$</small></sup>
                                                                    <span class="module-price">{{$module->plans->first()->pivot->price }}</span>
                                                                    <span class="fs-13 text-muted">/Month</span>
                                                                </h2>
                                                                <h4 class="text-success discounted-price d-none">
                                                                    <sup><small>$</small></sup>
                                                                    <span class="discount-price"></span>
                                                                </h4>
                                                                <h5 class="text-muted original-price d-none" style="text-decoration: line-through;">
                                                                    <sup><small>$</small></sup>
                                                                    <span class="original-price-value"></span>
                                                                </h5>
                                                            </div>
                                                            <div>
                                                                <small class="text-success">For Manager</small>
                                                            </div>
                                                            <hr class="my-4 text-muted">
                                                            <ul class="list-unstyled text-muted vstack gap-3">
                                                                @foreach ($module->items as $item)
                                                                    <li>
                                                                        <div class="d-flex">
                                                                            <div class="flex-shrink-0 text-success me-1">
                                                                                <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                                            </div>
                                                                            <div class="flex-grow-1">
                                                                                {{ $item->name }}
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                            <div class="mt-4">
                                                                <button type="button" class="btn btn-soft-success w-100 waves-effect waves-light select-module">
                                                                    Select
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h5 class="fs-14 text-primary">
                                                <i class="ri-shopping-cart-fill align-middle me-2"></i> Your selection
                                            </h5>
                                            <span class="badge bg-danger rounded-pill" id="module-count">0</span>
                                        </div>
                                        <ul class="list-group mb-3" id="invoice-list"></ul>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <p style="margin-left: 20px">Sub Total (USD) <span id="subtotal-value" style="margin-left: 60px">$0.00</span></p>
                                        </li>
                                        <button type="button" id="continue" class="btn btn-success btn-label right ms-auto">
                                            <i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Continue
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

 <script>
$(document).ready(function () {
    let selectedModules = JSON.parse(localStorage.getItem("selectedModules")) || {};
    let isAnnual = JSON.parse(localStorage.getItem("isAnnual")) || false;

  // Restore toggle state
    function restoreToggle() {
    if (isAnnual) {
        $("#annual-tab").addClass("active");
        $("#month-tab").removeClass("active");
    } else {
        $("#month-tab").addClass("active");
        $("#annual-tab").removeClass("active");
    }
    updatePrices();
}

    restoreToggle();

    // Restore previous selections
    function restoreSelections() {
        Object.keys(selectedModules).forEach(moduleId => {
            let card = $(".module-card[data-id='" + moduleId + "']");
            let button = card.find(".select-module");

            card.css("border", "2px solid green");
            button.text("Unselect");
        });

        updateInvoice();
    }

    // Handle Monthly and Annual Plan Toggle
    $("#month-tab").click(function () {
        isAnnual = false;
        localStorage.setItem("isAnnual", JSON.stringify(isAnnual));
        updatePrices();
    });

    $("#annual-tab").click(function () {
        isAnnual = true;
        localStorage.setItem("isAnnual", JSON.stringify(isAnnual));
        updatePrices();
    });

    function updatePrices() {
        $(".module-card").each(function () {
            let price = parseFloat($(this).data("price"));
            let annualPrice = price * 12;
            let discountedPrice = annualPrice * 0.75;

            let priceElement = $(this).find(".module-price");
            let originalPriceElement = $(this).find(".original-price");

            if (isAnnual) {
                priceElement.html(`<span class="text-success">$${discountedPrice.toFixed(2)}</span>`);
                originalPriceElement.html(`<span class="text-muted" style="text-decoration: line-through;">$${annualPrice.toFixed(2)}</span>`).removeClass("d-none");
            } else {
                priceElement.html(`$${price.toFixed(2)}`);
                originalPriceElement.addClass("d-none");
            }
        });

        updateInvoice();
    }

    $(".select-module").click(function () {
        let card = $(this).closest(".module-card");
        let moduleId = card.data("id");
        let moduleName = card.data("name");
        let price = parseFloat(card.data("price"));
        let button = $(this);

        let annualPrice = price * 12;
        let discountedPrice = annualPrice * 0.75;
        let discountAmount = annualPrice - discountedPrice;

        if (selectedModules[moduleId]) {
            delete selectedModules[moduleId];
            card.css("border", "1px solid #ddd");
            button.text("Select");
        } else {
            selectedModules[moduleId] = {
                name: moduleName,
                monthlyPrice: price,
                annualPrice: annualPrice,
                discountedPrice: discountedPrice,
                discountAmount: discountAmount
            };
            card.css("border", "2px solid green");
            button.text("Unselect");
        }

        localStorage.setItem("selectedModules", JSON.stringify(selectedModules));
        updateInvoice();
    });

    function updateInvoice() {
        $("#invoice-list").empty();
        let subtotal = 0;
        let totalDiscount = 0;

        Object.keys(selectedModules).forEach(moduleId => {
            let module = selectedModules[moduleId];
            let displayPrice = isAnnual ? module.annualPrice : module.monthlyPrice;

            $("#invoice-list").append(`
                <li class="list-group-item d-flex justify-content-between">
                    <span>${module.name}</span>
                    <span>$${displayPrice.toFixed(2)}</span>
                </li>
            `);

            subtotal += displayPrice;
            totalDiscount += isAnnual ? module.discountAmount : 0;
        });

        if (isAnnual && totalDiscount > 0) {
            $("#invoice-list").append(`
                <li class="list-group-item d-flex justify-content-between text-danger">
                    <strong>Discount</strong>
                    <span>-$${totalDiscount.toFixed(2)}</span>
                </li>
            `);
        }

        let finalTotal = subtotal - totalDiscount;
        $("#subtotal-value").text(`$${finalTotal.toFixed(2)}`);

        // Store subtotal in local storage for retrieval on plans page
        localStorage.setItem("subtotal", finalTotal.toFixed(2));
    }

    // Retrieve and populate invoice on page load
    restoreSelections();

    $("#continue").click(function (e) {
            let modules = JSON.parse(localStorage.getItem("selectedModules"));
            let moduleIds = Object.keys(modules).map(id => parseInt(id));
            let annualTab = JSON.parse(localStorage.getItem('isAnnual'));
            let token = $('meta[name="csrf-token"]').attr('content');
            let locale = '{{app()->getLocale()}}';
            let url = `/${locale}/subscription/selected-modules`;
         $.ajax({
            url: url,
            type: 'POST',
            data: {
                 moduleIds: moduleIds,
                 annualTab: annualTab,
                _token : token
                },
            success: function(response){
                window.location.href = response.redirect_url;
            },
            error: function(xhr) {
                console.log(xhr.responseJson);
            }
         });
        });
});

</script>
@endsection

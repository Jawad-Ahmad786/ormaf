@extends('layouts.login.main')
@section('title', 'Home')
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
                    <div class="card">
                                <div class="card-header">
                                    <div class="col-lg-12">
                            <div class="text-center mb-4">
                                <h4 class="fw-semibold fs-22">Select Modules</h4>
                                <p class="text-muted mb-4 fs-15">Simple pricing. No hidden fees. <br>
								Advanced features for your management and reporting needs.</p>

                                <div class="d-inline-flex">
                                    <ul class="nav nav-pills arrow-navtabs plan-nav rounded mb-3 p-1" id="pills-tab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link fw-semibold active" id="month-tab" data-bs-toggle="pill" data-bs-target="#month" type="button" role="tab" aria-selected="true">Monthly</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link fw-semibold" id="annual-tab" data-bs-toggle="pill" data-bs-target="#annual" type="button" role="tab" aria-selected="false">Annual <span class="badge bg-success">25% Off</span></button>
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
                                            <div class="col-xl-12">
											<div class="row">
                                <div class="col-lg-4">
                                    <div class="card pricing-box">
                                        <div class="card-body p-4 m-2">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <h5 class="mb-1 fw-semibold">Performance Management</h5>
                                                </div>
                                                <div class="avatar-sm">
                                                    <div class="avatar-title bg-light rounded-circle text-primary">
                                                        <i class="ri-book-mark-line fs-20"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pt-4">
                                                <h2><sup><small>$</small></sup>10.00 <span class="fs-13 text-muted">/Month</span></h2>
                                            </div>
											<div>
												 <small class="text-success">For Manager</small>
											</div>
                                            <hr class="my-4 text-muted">
                                            <div>
                                                <ul class="list-unstyled text-muted vstack gap-3">
                                                    <li>
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 text-success me-1">
                                                                <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                Performance <b>Dashboard</b>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 text-success me-1">
                                                                <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                Linkages to <b>Objectives</b>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 text-success me-1">
                                                                <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                Customized <b>Logic Model</b>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 text-success me-1">
                                                                <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                Performance <b>Indicators</b>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 text-success me-1">
                                                                <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                               Timelines
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 text-success me-1">
                                                                <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                               Accountabilities
                                                            </div>
                                                        </div>
                                                    </li>
                                                   <li>
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 text-success me-1">
                                                                <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                Performance Reporting
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <div class="mt-4">
                                                    <a href="{{ route('free-signup.create', ['locale' => app()->getLocale()])}}" class="btn btn-soft-success w-100 waves-effect waves-light">7 Day Free Trial</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-4">
                                    <div class="card pricing-box">
                                        <div class="card-body p-4 m-2">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <h5 class="mb-1 fw-semibold">Risk Management</h5>
                                                </div>
                                                <div class="avatar-sm">
                                                        <div class="avatar-title bg-light rounded-circle text-primary">
                                                            <i class="ri-medal-line fs-20"></i>
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="pt-4">
                                                <h2><sup><small>$</small></sup>20.00 <span class="fs-13 text-muted">/Month</span></h2>
                                            </div>
											<div>
												 <small class="text-success">For Manager</small>
											</div>
                                            <hr class="my-4 text-muted">
                                            <div>
                                                <ul class="list-unstyled text-muted vstack gap-3">
                                                    <li>
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 text-success me-1">
                                                                <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                Risk <b>Dashboard</b>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 text-success me-1">
                                                                <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                Linkages to <b>Objectives</b>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 text-success me-1">
                                                                <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                Key Risk Areas
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 text-success me-1">
                                                                <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                Risk <b>Indicators</b>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 text-success me-1">
                                                                <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                               Timelines
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 text-success me-1">
                                                                <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                               Accountabilities
                                                            </div>
                                                        </div>
                                                    </li>
                                                   <li>
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 text-success me-1">
                                                                <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                Risk Reporting
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <div class="mt-4">
                                                    <a href="modules.php" class="btn btn-soft-success w-100 waves-effect waves-light">Subscribe</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-4">
                                    <div class="card pricing-box">
                                        <div class="card-body p-4 m-2">
                                            <div>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1">
                                                        <h5 class="mb-1 fw-semibold">Audit <br>Planning</h5>
                                                    </div>
                                                    <div class="avatar-sm">
                                                        <div class="avatar-title bg-light rounded-circle text-primary">
                                                            <i class="ri-stack-line fs-20"></i>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="pt-4">
                                                    <h2><sup><small>$</small></sup> 30.00<span class="fs-13 text-muted">/Month</span></h2>
                                                </div>
												<div>
                                                     <small class="text-success">For Manager</small>
                                                </div>
                                            </div>
                                            <hr class="my-4 text-muted">
                                            <div>
                                                <ul class="list-unstyled text-muted vstack gap-3">
                                                    <li>
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 text-success me-1">
                                                                <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                               Audit <b>Universe</b>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 text-success me-1">
                                                                <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                Factor <b>Risk Analysis</b>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 text-success me-1">
                                                                <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                Key Risk Areas
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 text-success me-1">
                                                                <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <b>Risk-Based Planning</b>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 text-success me-1">
                                                                <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                               Timelines
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 text-success me-1">
                                                                <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                               Accountabilities
                                                            </div>
                                                        </div>
                                                    </li>
                                                   <li>
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 text-success me-1">
                                                                <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                Audit Plans
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <div class="mt-4">
                                                    <a href="modules.php" class="btn btn-soft-success w-100 waves-effect waves-light">Subscribe</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>

                            <!--end row-->
                        </div>
                                            <!-- end col -->
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
  <!-- password-addon init -->
    <script src="{{asset('assets/login/js/pages/password-addon.init.js')}}"></script>
@endpush

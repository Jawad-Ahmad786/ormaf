@extends('layouts.login.main')
@section('title', 'Wiz 2')
@section('content')

    @push('css')
    <link href="{{asset('assets/login/libs/jsvectormap/css/jsvectormap.min.css')}}" rel="stylesheet" type="text/css" />
    @endpush

    <!-- Begin page -->
    <div id="layout-wrapper">

        @include ('../layouts/login/topbar-wiz')
        @include ('../layouts/login/sidebar-wiz')

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">

				<div class="bg-overlay bg-overlay-pattern"></div>
				<div class="row justify-content-center">

					<div class="col-lg-9 col-sm-10">
					<div class="card overflow-hidden">
						<div class="card-body bg-marketplace d-flex">
							<div class="flex-grow-1">
								<h4 class="fs-18 lh-base mb-0">Step 2 - Identify your <span class="text-success">Strategic Objectives</span> </h4>
								<p class="mb-3 mt-2 pt-1 text-muted">Enter your Department's strategic objectives/outcomes.</p>
								<div class="d-flex pull-right mb-2">
									<button type="button" class="btn btn-light btn-label previestab" data-previous="steparrow-gen-info-tab"><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> Back</button>
									<button type="button" class="btn btn-primary btn-label right ms-auto nexttab nexttab" data-nexttab="steparrow-description-info-tab"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Next</button>
								</div>
							</div>
							<img src="{{asset('assets/login/images/bg-d.png')}}" alt="" class="img-fluid" />
						</div>
					</div>

					<div class="row ">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="step-arrow-nav mb-4">
                                            <ul class="nav nav-pills custom-nav nav-justified bg-success-subtle" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <a href="{{ route('wiz1', ['locale' => app()->getLocale()]) }}"><button class="nav-link" id="steparrow-gen-info-tab" data-bs-toggle="pill" data-bs-target="#steparrow-gen-info" type="button" role="tab" aria-controls="steparrow-gen-info" aria-selected="true">Department</button></a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a href="{{ route('wiz2', ['locale' => app()->getLocale()]) }}"><button class="nav-link active" id="steparrow-description-info-tab" data-bs-toggle="pill" data-bs-target="#steparrow-description-info" type="button" role="tab" aria-controls="steparrow-description-info" aria-selected="false">Objectives</button></a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a href="{{ route('wiz3', ['locale' => app()->getLocale()]) }}"><button class="nav-link" id="pills-experience-tab" data-bs-toggle="pill" data-bs-target="#pills-experience" type="button" role="tab" aria-controls="pills-experience" aria-selected="false">Programs</button></a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a href="{{ route('wiz4', ['locale' => app()->getLocale()]) }}"><button class="nav-link" id="pills-experience-tab" data-bs-toggle="pill" data-bs-target="#pills-experience" type="button" role="tab" aria-controls="pills-experience" aria-selected="false">Team</button></a>
                                                </li>
                                            </ul>
                                        </div><!-- end card header -->
                                <div class="row">
                        <div class="col-xl-6">
                            <div class="card card-height-100">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Department's Objectives</h4>
                                    <div class="flex-shrink-0">
                                        <div class="dropdown card-header-dropdown">
                                            <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="text-muted"><i class="ri-settings-4-line align-middle me-1 fs-15"></i>Settings</span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Edit</a>
                                                <a class="dropdown-item" href="#">Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card header -->

                                <div class="card-body p-0">

                                    <div class="align-items-center p-3 justify-content-between d-flex">
                                        <div class="flex-shrink-0">
                                            <div class="text-muted"><span class="fw-semibold">2</span> of <span class="fw-semibold">5</span> remaining</div>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#exampleModalgrid"><i class="ri-add-line align-middle me-1"></i> Add Objective</button>

										<!-- Modal Start -->
										<div class="modal fade" id="exampleModalgrid" tabindex="-1" aria-labelledby="exampleModalgridLabel">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalgridLabel">Add Objective</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="javascript:void(0);">
                                                            <div class="row g-3">
                                                                <div class="col-lg-12">
																		<label class="form-label" for="des-info-description-input">Objective</label>
																		<textarea class="form-control" placeholder="Department's Objective" id="des-info-description-input" rows="3" required></textarea>
																		<div class="invalid-feedback">Please enter Objective</div>
                                                                </div>
                                                                <!--end col-->
                                                                <div class="col-lg-12">
                                                                    <div class="hstack gap-2 justify-content-end">
                                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Add</button>
                                                                    </div>
                                                                </div>
                                                                <!--end col-->
                                                            </div>
                                                            <!--end row-->
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
										<!-- Modal End -->

                                    </div><!-- end card header -->

                                    <div data-simplebar style="max-height: 256px;">
                                        <ul class="list-group list-group-flush border-dashed px-3">
                                            <li class="list-group-item ps-0">
                                                <div class="d-flex align-items-start">
                                                    <div class="form-check ps-0 flex-sharink-0">
                                                        <input type="checkbox" class="form-check-input ms-0" id="task_one">
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <label class="form-check-label mb-0 ps-2" for="task_one">Objective 1</label>
                                                    </div>
                                                    <div class="flex-shrink-0 ms-2">
                                                        <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                    </div>
                                                </div>
                                            </li>

                                        </ul><!-- end ul -->
                                    </div>
                                    <div class="p-3 pt-2">
                                        <a href="javascript:void(0);" class="text-muted text-decoration-underline">Show more...</a>
                                    </div>
                                </div><!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="card-title mb-0"><i class=" ri-stack-line align-middle me-1 lh-1"></i> What is Program Alignment Architecture?</h6>
                                </div>
                                <div class="card-body">
                                    <p class="text-muted">A Program Alignment Architecture (PAA) is an inventory of programs and activities describing their linkages to the Department's Strategic Outcomes. All Programs within a Department are expected to be reflected in its PAA and their Performance Measurement and Risk Management Strategies should be based on how it is defined in the PAA. As the first step for effective management of performance and risks, it is important to understand your Programs in the context of your departmental Strategic Outcomes and PAA.</p>
                                </div>
                                <div class="card-footer">
                                    <div class="hstack gap-2 justify-content-end">
                                        <a href="javascript:void(0)" class="btn btn-link btn-sm link-success"><i class="ri-close-line align-middle lh-1"></i> Close</a>
                                        <a href="javascript:void(0);" class="btn btn-primary btn-sm">Read More</a>
                                    </div>
                                </div>
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
					<div class="card">
                                <div class="card-header">
                                    <h6 class="card-title mb-0"><i class=" ri-stack-line align-middle me-1 lh-1"></i> Department's Strategic Objectives/Outcomes</h6>
                                </div>
                                <div class="card-body">
                                    <p class="text-muted">A Program Alignment Architecture (PAA) is an inventory of programs and activities describing their linkages to the Department's Strategic Outcomes. All Programs within a Department are expected to be reflected in its PAA and their Performance Measurement and Risk Management Strategies should be based on how it is defined in the PAA. As the first step for effective management of performance and risks, it is important to understand your Programs in the context of your departmental Strategic Outcomes and PAA.</p>
                                </div>
                                <div class="card-footer">
                                    <div class="hstack gap-2 justify-content-end">
                                        <a href="javascript:void(0)" class="btn btn-link btn-sm link-success"><i class="ri-close-line align-middle lh-1"></i> Close</a>
                                        <a href="javascript:void(0);" class="btn btn-primary btn-sm">Read More</a>
                                    </div>
                                </div>
                            </div>
						</div>
					</div>
				<!-- end container -->
            </div>
            <!-- End Page-content -->
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->
@endsection
@push('scripts')
    <!-- apexcharts -->
    <script src="{{asset('assets/login/libs/apexcharts/apexcharts.min.js')}}"></script>

    <!-- Vector map-->
    <script src="{{asset('assets/login/libs/jsvectormap/js/jsvectormap.min.js')}}"></script>
    <script src="{{asset('assets/login/libs/jsvectormap/maps/world-merc.js')}}"></script>

    <!-- Dashboard init -->
    <script src="{{asset('assets/login/js/pages/dashboard-analytics.init.js')}}"></script>

    <!-- App js -->
    <script src="{{asset('assets/login/js/app.js')}}"></script>
@endpush

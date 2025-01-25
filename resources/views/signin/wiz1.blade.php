@extends('layouts.login.main')
@section('title', 'Wiz 1')
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
								<h4 class="fs-18 lh-base mb-0">Step 1 - Setup your <span class="text-success">Organization</span> </h4>
								<p class="mb-3 mt-2 pt-1 text-muted">Enter your Department's detail</p>
								<div class="d-flex pull-right mb-2">
									<button type="button" class="btn btn-primary btn-label right ms-auto nexttab nexttab" data-nexttab="{{route('wiz2', ['locale' => app()->getLocale()])}}"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Next</button>
								</div>
							</div>
							<img src="{{asset('assets/login/images/bg-d.png')}}" alt="" class="img-fluid" />
						</div>
					</div>

					<div class="row ">
                        <div class="col-xl-12">
                            <div class="card ">
                                <div class="step-arrow-nav mb-4">
                                            <ul class="nav nav-pills custom-nav nav-justified bg-success-subtle" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <a href="{{ route('wiz1', ['locale' => app()->getLocale()]) }}"><button class="nav-link active" id="steparrow-gen-info-tab" data-bs-toggle="pill" data-bs-target="#steparrow-gen-info" type="button" role="tab" aria-controls="steparrow-gen-info" aria-selected="true">Department</button></a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a href="{{ route('wiz2', ['locale' => app()->getLocale()]) }}"><button class="nav-link" id="steparrow-description-info-tab" data-bs-toggle="pill" data-bs-target="#steparrow-description-info" type="button" role="tab" aria-controls="steparrow-description-info" aria-selected="false">Objectives</button></a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a href="{{ route('wiz3', ['locale' => app()->getLocale()]) }}"><button class="nav-link" id="pills-experience-tab" data-bs-toggle="pill" data-bs-target="#pills-experience" type="button" role="tab" aria-controls="pills-experience" aria-selected="false">Programs</button></a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a href="{{ route('wiz4', ['locale' => app()->getLocale()]) }}"><button class="nav-link" id="pills-experience-tab" data-bs-toggle="pill" data-bs-target="#pills-experience" type="button" role="tab" aria-controls="pills-experience" aria-selected="false">Team</button></a>
                                                </li>
                                            </ul>
                                        </div><!-- end card header -->
                                <div class="card-body">
                                    <form action="{{ route('department.update', ['locale' => app()->getLocale(), 'department' => $department]) }}" method="post" class="form-steps" autocomplete="off" enctype="multipart/form-data">
                                     @csrf
                                        <div class="text-center">
											<div class="profile-user position-relative d-inline-block mx-auto mb-2">
												<img src="{{asset('assets/login/images/users/user-dummy-img.jpg')}}" class="rounded-circle avatar-lg img-thumbnail user-profile-image" alt="user-profile-image">
												<div class="avatar-xs p-0 rounded-circle profile-photo-edit">
													<input id="profile-img-file-input" type="file" class="profile-img-file-input" name="logo">
													<label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
														<span class="avatar-title rounded-circle bg-light text-body">
															<i class="ri-camera-fill"></i>
														</span>
													</label>
												</div>
											</div>
											<h5 class="fs-14">Add Logo</h5>
                                                    @error('logo')
                                                       <span class="text-danger">{{ $message }}</span>
                                                    @enderror
										</div>

                                        <div>
                                                    <div class="mb-3">
                                                        <label for="formFile" class="form-label">Abbr.</label>
                                                        <input type="text" name="abbrevation" class="form-control" id="gen-info-username-input" placeholder="Department Name Abbreviation" value="{{ $department->abbrevation }}">
                                                    @error('abbrevation')
                                                       <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    </div>
                                                    <div>
                                                        <label class="form-label" for="des-info-description-input">Department</label>
                                                        <textarea class="form-control" placeholder="Department Name" id="des-info-description-input" name="name" rows="3">{{ $department->name }}</textarea>
                                                    @error('name')
                                                       <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    </div>
                                                </div>
                                                <button class="btn btn-success mt-3" type="submit">Save</button>
                                        <!-- end tab content -->
                                    </form>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
					<div class="card">
                                <div class="card-header">
                                    <h6 class="card-title mb-0"><i class=" ri-stack-line align-middle me-1 lh-1"></i> Department and Strategic Outcomes?</h6>
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
    <script>
    $(document).on('click', '.nexttab', function () {
        let url = $(this).data('nexttab');
        window.location.href = url;
    });
    </script>
    <!-- END layout-wrapper -->
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
    @endsection


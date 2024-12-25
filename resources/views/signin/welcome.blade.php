@extends('layouts.login.main')
@section('title', 'Welcome')
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
						<div class="col-lg-8 col-sm-10">
							<div class="text-center mt-lg-4 pt-4">
								<h1 class="display-6 fw-semibold mb-3 lh-base"><span class="text-success">Welcome!</span>   </h1>
								<p class="lead text-muted lh-base">Thank you for choosing ORMAF!<br> An Online Performance and Risk Management Accountability Software!</p>

								<h6>By continuing you agree that you agree with the <a href="#tc-box" class="tc-window">Terms and Conditions</a> for using the ORMAF Software.</h6>

								<div class="d-flex gap-2 justify-content-center mt-4">
									<a href="{{ route('wiz1', [ 'locale' => app()->getLocale()]) }}" class="btn btn-primary">Get Started <i class="ri-arrow-right-line align-middle ms-1"></i></a>
									<a href="#" class="btn btn-danger">View Plans <i class="ri-eye-line align-middle ms-1"></i></a>
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

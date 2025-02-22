@extends('layouts.login.main')
@section('title', 'Wiz End')
@section('content')
    @push('css')
    <!-- plugin css -->
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
					<div class="col-lg-10 col-sm-10">

					<div class="card">

				<div class="bg-overlay bg-overlay-pattern"></div>
				<div class="row justify-content-center">
						<div class="col-lg-8 col-sm-10">
							<div class="text-center mt-lg-4 pt-4">
								<div class="mb-4">
								<lord-icon src="https://cdn.lordicon.com/lupuorrc.json" trigger="loop" colors="primary:#0ab39c,secondary:#405189" style="width:120px;height:120px"></lord-icon>
							</div>
								<h5>Well Done !</h5>
								<p class="lead text-muted lh-base">You have Successfully Set up your Organization</p>
								<div class="d-flex gap-2 justify-content-center mt-4">
									<a href="{{ route('dashboard', ['locale' => app()->getLocale()]) }}" class="btn btn-primary">Get Started <i class="ri-arrow-right-line align-middle ms-1"></i></a>
								</div>
							</div>
						</div>
					</div>
				<!-- end container -->

					<div>
						<div class="text-center mt-lg-4 pt-4">
							<p class="text-muted">Please continue to your Dashboard</p>
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

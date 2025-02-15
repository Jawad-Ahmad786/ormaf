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
									<button
                                        type="button"
                                        class="btn btn-light btn-label previestab"
                                        data-previous="{{ route('wiz1', ['locale' => app()->getLocale()]) }}"
                                    >
                                        <i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> Back
                                    </button>

                                    <button
                                        type="button"
                                        class="btn btn-primary btn-label right ms-auto nexttab"
                                        data-nexttab="{{ route('wiz3', ['locale' => app()->getLocale()]) }}">
                                        <i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i> Next
                                    </button>
								</div>
							</div>
							<img src="{{asset('assets/login/images/bg-d.png')}}" alt="" class="img-fluid" />
						</div>
					</div>

					<div class="row ">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="step-arrow-nav mb-4">
                                            @include('signin.tabs')
                                        </div><!-- end card header -->
                                <div class="row">
                        <div class="col-xl-6">
                            <div class="card card-height-100">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Department's Objectives</h4>

                                </div><!-- end card header -->

                                <div class="card-body p-0">

                                    <div class="align-items-center p-3 justify-content-between d-flex">
                                        <div class="flex-shrink-0">
                                        </div>
                                        <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#addObjectiveModal"><i class="ri-add-line align-middle me-1"></i> Add Objective</button>

										<!-- Modal Start -->
									<div class="modal fade" id="addObjectiveModal" tabindex="-1" aria-labelledby="addObjectiveModalLabel">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="addObjectiveModalLabel">Add Objective</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="objectiveForm" method="post" action="{{ route('objective.store', ['locale' => app()->getLocale()]) }}">
                                                            @csrf
                                                            <div class="row g-3">
                                                                <div class="col-lg-12">
                                                                    <label class="form-label" for="des-info-description-input">Objective</label>
                                                                    <textarea name="name" class="form-control" placeholder="Department's Objective" id="des-info-description-input" rows="3"></textarea>
                                                                    <div id="nameError" class="text-danger mt-2"></div> <!-- Placeholder for error -->
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="hstack gap-2 justify-content-end">
                                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Add</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

										<!-- Modal End -->

                                    </div><!-- end card header -->
                                   <div class="modal fade" id="updateObjectiveModal" tabindex="-1" aria-labelledby="updateObjectiveModalLabel">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="updateObjectiveModalLabel">Edit Objective</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="editObjectiveForm">
                                                        @csrf
                                                        <input type="hidden" id="editObjectiveId"> <!-- Hidden ID Field -->
                                                        <div class="row g-3">
                                                            <div class="col-lg-12">
                                                                <label class="form-label" for="editObjectiveInput">Objective</label>
                                                                <textarea name="name" class="form-control" id="editObjectiveInput" rows="3"></textarea>
                                                                <div id="editNameError" class="text-danger mt-2"></div> <!-- Error Message -->
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="hstack gap-2 justify-content-end">
                                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  <div data-simplebar style="max-height: 256px;">
                                        <ul class="list-group list-group-flush border-dashed px-3">
                                 @if(!is_null($objectives))
                                    @foreach ($objectives as $objective)
                                        <li class="list-group-item ps-0" id="objective-{{ $objective->id }}">
                                            <div class="d-flex align-items-start">
                                                <div class="flex-grow-1">
                                                    <label class="form-check-label mb-0 ps-2">{{ $objective->name }}</label>
                                                </div>
                                                <div class="flex-shrink-0 ms-2">
                                                     <button type="button" class="btn btn-link text-warning p-0 edit-objective" data-id="{{ $objective->id }}" title="Edit">
                                                        <i class="ri-edit-line"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-link text-danger p-0 delete-objective" data-id="{{ $objective->id }}" title="Delete">
                                                        <i class="ri-delete-bin-fill align-bottom me-2"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif

                                        </ul><!-- end ul -->
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
    <script>

$(document).ready(function () {
  $(document).on('click', '.delete-objective', function () {

    let objectiveId = $(this).data('id');
    let locale = "{{ app()->getLocale() }}";
    let token = $('meta[name="csrf-token"]').attr('content');
    let url = `/${locale}/objective/destroy/${objectiveId}`;

    if (confirm('Are you sure you want to delete this objective?')) {
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                _token: token,
            },
            success: function (response) {
                // Remove the objective's list item on success
                $(`#objective-${objectiveId}`).remove();
                alert(response.message);
            },
            error: function (xhr) {
                // Handle the error
                console.error(xhr.responseText);
                alert('Failed to delete the objective.');
            }
        });
    }
});
$(document).on('click', '.previestab', function () {
    let previousUrl = $(this).data('previous'); // Get the URL for the previous step
    window.location.href = previousUrl; // Redirect to the previous step
});

$(document).on('click', '.nexttab', function () {
    let nextUrl = $(this).data('nexttab'); // Get the URL for the next step
    window.location.href = nextUrl; // Redirect to the next step
});

    $('#objectiveForm').on('submit', function (e) {
        e.preventDefault(); // Prevent default form submission

        let form = $(this);
        let url = form.attr('action'); // Get the form action URL
        let formData = form.serialize(); // Serialize the form data

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            success: function (response) {
                // Close the modal on success
                $('#addObjectiveModal').modal('hide');
                alert(response.message)
                location.reload();
            },
            error: function (response) {
                // Clear previous error messages
                $('#nameError').text('');

                // Check for validation errors
                if (response.status === 422) {
                    let errors = response.responseJSON.errors;
                    if (errors.name) {
                        // Display all error messages for the "name" field
                        errors.name.forEach(function (error) {
                            $('#nameError').append('<div>' + error + '</div>');
                        });
                    }
                }
                else {
                    alert(response.error)
                }
            },
        });
    });
    $('#addObjectiveModal').on('hidden.bs.modal', function () {
        $('#nameError').html(''); // Clear error messages
        $('#des-info-description-input').val(''); // Clear the input field (optional)
    });

 $(document).on('click', '.edit-objective', function () {
        let objectiveId = $(this).data('id'); // Get the objective ID
        let locale = "{{ app()->getLocale() }}"; // Get the locale from Laravel
        let url = `/${locale}/objective/edit/${objectiveId}`; // API route for fetching objective

        // Clear previous errors
        $('#editNameError').text('');

        // Fetch the objective details using AJAX
        $.ajax({
            url: url,
            type: 'GET',
            success: function (response) {
                // Populate the modal fields with the data
                $('#editObjectiveId').val(response.id);
                $('#editObjectiveInput').val(response.name);
                $('#updateObjectiveModal').modal('show'); // Show the modal
            },
            error: function (xhr) {
                alert('Failed to fetch objective details.');
            }
        });
    });

    // Handle the update form submission
    $('#editObjectiveForm').submit(function (e) {
        e.preventDefault();

        let objectiveId = $('#editObjectiveId').val();
        let locale = "{{ app()->getLocale() }}";
        let url = `/${locale}/objective/update/${objectiveId}`; // API route for updating objective
        let token = $('meta[name="csrf-token"]').attr('content');
        let name = $('#editObjectiveInput').val();

        // Clear previous error messages
        $('#editNameError').text('');

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                _token: token,
                name: name
            },
            success: function (response) {
                // Update the objective in the UI
                $(`#objective-${objectiveId} .form-check-label`).text(name);
                $('#updateObjectiveModal').modal('hide'); // Hide the modal
                alert(response.message);
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    if (errors.name) {
                        $('#editNameError').text(errors.name[0]); // Show validation error
                    }
                } else {
                    alert(response.error);
                }
            }
        });
    });
});

</script>
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

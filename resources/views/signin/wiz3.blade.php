@extends('layouts.login.main')
@section('title', 'Wiz 3')
@section('content')
    @push('css')
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/login/js/org_chart/css/chart.css') }}">

        <script type="text/javascript" src="{{ asset('assets/login/js/js/jquery-1.10.2.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/login/js/js/mbExtruder.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/login/js/js/ajax.js') }}"></script>
        <script type="text/javascript" src="popUp/popUp.js"></script>
        <script type="text/javascript" src="{{ asset('assets/login/js/org_chart/js/jquery_002.js') }}"></script>
    @endpush
    <script>
        $(document).ready(function() {
            $("#org").jOrgChart({
                chartElement: '#chart',
                dragAndDrop: false
            });
        });
    </script>

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
                                    <h4 class="fs-18 lh-base mb-0">Step 3 - Setup your <span
                                            class="text-success">Team</span> </h4>
                                    @if (session()->has('error'))
                                        <div class="alert alert-dismissible">
                                        </div>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>{{ session('error') }}</strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                    <p class="mb-3 mt-2 pt-1 text-muted">Enter the Team members helping you in managing your
                                        Programs.</p>
                                    <div class="d-flex pull-right mb-2">
                                        <button type="button" class="btn btn-light btn-label previestab"
                                            data-previous="{{ route('wiz2', ['locale' => app()->getLocale()]) }}"><i
                                                class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>
                                            Back</button>
                                        <button type="button"
                                            class="btn btn-primary btn-label right ms-auto nexttab nexttab"
                                            data-nexttab="{{ route('wiz4', ['locale' => app()->getLocale()]) }}"><i
                                                class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Next</button>
                                    </div>
                                </div>
                                <img src="{{ asset('assets/login/images/bg-d.png') }}" alt="" class="img-fluid" />
                            </div>
                        </div>

                        <div class="row ">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="step-arrow-nav mb-4">
                                        @include('signin.tabs')

                                    </div><!-- end card header -->
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="card card-height-100">
                                                <div class="card-header align-items-center d-flex">
                                                    <h4 class="card-title mb-0 flex-grow-1">Team Members</h4>

                                                </div><!-- end card header -->

                                                <div class="card-body p-0">

                                                    <div class="align-items-center p-3 justify-content-between d-flex">
                                                        <button
                                                            {{ auth()->user()->subscription->user_create_limits === 0 ? 'disabled' : '' }}
                                                            type="button" class="btn btn-sm btn-success"
                                                            data-bs-toggle="modal" data-bs-target="#createMemberModal"><i
                                                                class="ri-add-line align-middle me-1"></i>{{ auth()->user()->subscription->user_create_limits === 0 ? 'disabled' : '' }}Add
                                                            Team Member</button>

                                                        <!-- Modal Start -->
                                                        <div class="modal fade" id="createMemberModal" tabindex="-1"
                                                            aria-labelledby="createMemberModalLabel">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="createMemberModalLabel">
                                                                            Add Team Member</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <!-- Error messages will be displayed here -->
                                                                        <div id="errorMessages"></div>
                                                                        <form id="addTeamMemberForm" method="post"
                                                                            action="{{ route('team-member.store', ['locale' => app()->getLocale()]) }}">
                                                                            @csrf
                                                                            <div class="row g-3">
                                                                                <div class="col-xxl-6">
                                                                                    <div>
                                                                                        <label for="firstName"
                                                                                            class="form-label">First
                                                                                            Name</label>
                                                                                        <input type="text"
                                                                                            name="first_name"
                                                                                            class="form-control"
                                                                                            id="firstName"
                                                                                            placeholder="Enter First Name">
                                                                                    </div>
                                                                                </div>
                                                                                <!-- End of first name -->

                                                                                <div class="col-xxl-6">
                                                                                    <label for="lastName"
                                                                                        class="form-label">Last Name</label>
                                                                                    <input type="text" name="last_name"
                                                                                        class="form-control" id="lastName"
                                                                                        placeholder="Enter Last Name">
                                                                                </div>

                                                                                <div class="col-xxl-6">
                                                                                    <label for="email"
                                                                                        class="form-label">Email</label>
                                                                                    <input type="email" name="email"
                                                                                        class="form-control" id="email"
                                                                                        placeholder="Enter Email">
                                                                                </div>

                                                                                <div class="col-xxl-6">
                                                                                    <label for="passwordInput"
                                                                                        class="form-label">Password</label>
                                                                                    <input type="password" name="password"
                                                                                        class="form-control"
                                                                                        id="passwordInput"
                                                                                        placeholder="Enter password">
                                                                                </div>

                                                                                <div class="col-xxl-6">
                                                                                    <label for="confirmPasswordInput"
                                                                                        class="form-label">Confirm
                                                                                        Password</label>
                                                                                    <input type="password"
                                                                                        name="password_confirmation"
                                                                                        class="form-control"
                                                                                        id="confirmPasswordInput"
                                                                                        placeholder="Confirm password">
                                                                                </div>

                                                                                <!-- Country Dropdown -->
                                                                                <div class="col-xxl-6">
                                                                                    <label for="country"
                                                                                        class="form-label">Country</label>
                                                                                    <select class="form-select"
                                                                                        name="country" id="country">
                                                                                        <option value="">Choose...
                                                                                        </option>
                                                                                        @foreach ($countries as $country)
                                                                                            <option
                                                                                                value="{{ $country->id }}">
                                                                                                {{ $country->name }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>

                                                                                <!-- State Dropdown -->
                                                                                <div class="col-xxl-6">
                                                                                    <label for="state"
                                                                                        class="form-label">State</label>
                                                                                    <select name="state" id="state"
                                                                                        class="form-select">
                                                                                        <option value="">Choose...
                                                                                        </option>
                                                                                    </select>
                                                                                </div>

                                                                                <!-- City Dropdown -->
                                                                                <div class="col-xxl-6">
                                                                                    <label for="city"
                                                                                        class="form-label">City</label>
                                                                                    <select name="city" id="city"
                                                                                        class="form-select">
                                                                                        <option value="">Choose...
                                                                                        </option>
                                                                                    </select>
                                                                                </div>

                                                                                <div class="col-xxl-6">
                                                                                    <label for="address"
                                                                                        class="form-label">Address</label>
                                                                                    <input type="text" name="address"
                                                                                        class="form-control"
                                                                                        id="address"
                                                                                        placeholder="Enter Address">
                                                                                </div>

                                                                                <div class="col-xxl-6">
                                                                                    <label for="zip_code"
                                                                                        class="form-label">Zip Code</label>
                                                                                    <input type="text" name="zip_code"
                                                                                        class="form-control"
                                                                                        id="zip_code"
                                                                                        placeholder="Enter Zip Code">
                                                                                </div>

                                                                                <div class="col-lg-12">
                                                                                    <div
                                                                                        class="hstack gap-2 justify-content-end">
                                                                                        <button type="button"
                                                                                            class="btn btn-light"
                                                                                            data-bs-dismiss="modal">Close</button>
                                                                                        <button type="submit"
                                                                                            class="btn btn-primary">Submit</button>
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
                                                    <div>
                                                        <div class="table-responsive table-card mb-3 mt-3">
                                                            <table class="table align-middle table-nowrap mb-0"
                                                                id="customerTable">
                                                                <thead class="table-light">
                                                                    <tr>
                                                                        <th scope="col">First Name</th>
                                                                        <th scope="col">Last Name</th>
                                                                        <th scope="col">Email</th>
                                                                        <th scope="col">Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="list form-check-all">
                                                                    @if (!is_null($teamMembers))
                                                                        @foreach ($teamMembers as $member)
                                                                            <tr id="member-{{ $member->id }}">
                                                                                <td class="name">
                                                                                    <div class="d-flex align-items-center">
                                                                                        <div class="flex-shrink-0"><img
                                                                                                src="{{ asset('assets/login/images/users/avatar-8.jpg') }}"
                                                                                                alt=""
                                                                                                class="avatar-xs rounded-circle">
                                                                                        </div>
                                                                                        <div class="flex-grow-1 ms-2 name">
                                                                                            {{ $member->first_name }}</div>
                                                                                    </div>
                                                                                </td>
                                                                                <td class="email_id">
                                                                                    {{ $member->last_name }}
                                                                                </td>
                                                                                <td class="tags">
                                                                                    <span
                                                                                        class="badge bg-primary-subtle text-primary">{{ $member->email }}</span>
                                                                                </td>
                                                                                <td>
                                                                                    <button type="button"
                                                                                        class="btn btn-link text-warning p-0 edit-member"
                                                                                        data-id="{{ $member->id }}"
                                                                                        title="Edit"
                                                                                        data-bs-target="#updateMemberModal">
                                                                                        <i class="ri-edit-line"></i>
                                                                                    </button>
                                                                                    <button type="button"
                                                                                        class="btn btn-link text-danger p-0 delete-member"
                                                                                        data-id="{{ $member->id }}"
                                                                                        title="Delete">
                                                                                        <i
                                                                                            class="ri-delete-bin-fill align-bottom me-2"></i>
                                                                                    </button>
                                                                                </td>
                                                                            </tr>
                                                                            <div class="modal fade" id="updateMemberModal"
                                                                                tabindex="-1"
                                                                                aria-labelledby="updateMemberModalLabel">
                                                                                <div class="modal-dialog">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title"
                                                                                                id="updateMemberModalLabel">
                                                                                                Edit Team Member</h5>
                                                                                            <button type="button"
                                                                                                class="btn-close"
                                                                                                data-bs-dismiss="modal"
                                                                                                aria-label="Close"></button>
                                                                                        </div>
                                                                                 <div class="modal-body">
                                                                                    <form id="updtateTeamMemberForm" method="POST" action="" data-id="{{ $member->id }}">
                                                                                        @csrf
                                                                                        @method('PUT')
                                                                                        <div class="row g-3">
                                                                                        <div id="updateErrorMessages" class="text-danger"></div>
                                                                                            <div class="col-xxl-6">
                                                                                                <label for="firstName" class="form-label">First Name</label>
                                                                                                <input type="hidden" id="member_id">
                                                                                                <input type="text" name="first_name" class="form-control" id="firstName">
                                                                                            </div>
                                                                                            <div class="col-xxl-6">
                                                                                                <label for="lastName" class="form-label">Last Name</label>
                                                                                                <input type="text" name="last_name" class="form-control" id="lastName">
                                                                                            </div>
                                                                                            <div class="col-xxl-6">
                                                                                                <label for="email" class="form-label">Email</label>
                                                                                                <input type="email" name="email" class="form-control" id="email">
                                                                                            </div>
                                                                                            <div class="col-xxl-6">
                                                                                                <label for="password" class="form-label">Password</label>
                                                                                                <input type="password" name="password" class="form-control" id="password" >
                                                                                            </div>
                                                                                            <div class="col-xxl-6">
                                                                                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                                                                                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" >
                                                                                            </div>
                                                                                            <div class="col-xxl-6">
                                                                                                <label for="country" class="form-label">Country</label>
                                                                                                <select class="form-select" name="country_id" id="country">
                                                                                                    <option value="">Choose...</option>
                                                                                                    @foreach ($countries as $country)
                                                                                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                                                                    @endforeach
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="col-xxl-6">
                                                                                                <label for="state" class="form-label">State</label>
                                                                                                <select name="state_id" id="state" class="form-select">
                                                                                                    <option value="">Choose...</option>
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="col-xxl-6">
                                                                                                <label for="city" class="form-label">City</label>
                                                                                                <select name="city_id" id="city" class="form-select">
                                                                                                    <option value="">Choose...</option>
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="col-xxl-6">
                                                                                                <label for="address" class="form-label">Address</label>
                                                                                                <input type="text" name="address" class="form-control" id="address">
                                                                                            </div>
                                                                                            <div class="col-xxl-6">
                                                                                                <label for="zip_code" class="form-label">Zip Code</label>
                                                                                                <input type="text" name="zip_code" class="form-control" id="zip_code">
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
                                                                        @endforeach
                                                                        @endif
                                                                        </tbody>
                                                                        </table>

                                                                          </div>
                                                </div>
                                            </div><!-- end card body -->
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
                            <h6 class="card-title mb-0"><i class=" ri-stack-line align-middle me-1 lh-1"></i> Programs
                                Alignment Architecture (PAA)</h6>
                        </div>
                        <div class="card-body">
                            <p class="text-muted">A Program Alignment Architecture (PAA) is an inventory of programs and
                                activities describing their linkages to the Department's Strategic Outcomes. All Programs
                                within a Department are expected to be reflected in its PAA and their Performance
                                Measurement and Risk Management Strategies should be based on how it is defined in the PAA.
                                As the first step for effective management of performance and risks, it is important to
                                understand your Programs in the context of your departmental Strategic Outcomes and PAA.</p>
                        </div>
                        <div class="card-footer">
                            <div class="hstack gap-2 justify-content-end">
                                <a href="javascript:void(0)" class="btn btn-link btn-sm link-success"><i
                                        class="ri-close-line align-middle lh-1"></i> Close</a>
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
        $(document).ready(function() {
            // When the country is selected
            $('#country').on('change', function() {
                const countryId = $(this).val();
                let locale = "{{ app()->getLocale() }}"; // Get the locale from Laravel
                $('#state').html('<option value="">Choose...</option>');
                $('#city').html('<option value="">Choose...</option>');
                let url = `/${locale}/locations/states/${countryId}`;

                if (countryId) {
                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function(states) {
                            states.forEach(state => {
                                $('#state').append(
                                    `<option value="${state.id}">${state.name}</option>`
                                    );
                            });
                        }
                    });
                }
            });

            // When the state is selected
            $('#state').on('change', function() {
                const stateId = $(this).val();
                let locale = "{{ app()->getLocale() }}"; // Get the locale from Laravel
                $('#city').html('<option value="">Choose...</option>');
                let url = `/${locale}/locations/cities/${stateId}`;

                if (stateId) {
                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function(cities) {
                            cities.forEach(city => {
                                $('#city').append(
                                    `<option value="${city.id}">${city.name}</option>`
                                    );
                            });
                        }
                    });
                }
            });
            $(document).on('click', '.previestab', function() {
                let previousUrl = $(this).data('previous'); // Get the URL for the previous step
                window.location.href = previousUrl; // Redirect to the previous step
            });

            $(document).on('click', '.nexttab', function() {
                let nextUrl = $(this).data('nexttab'); // Get the URL for the next step
                window.location.href = nextUrl; // Redirect to the next step
            });
            $('#addTeamMemberForm').on('submit', function(event) {
                event.preventDefault(); // Prevent form from reloading the page

                // Clear previous errors
                $('#errorMessages').empty();

                var formData = $(this).serialize(); // Collect form data

                $.ajax({
                    url: $(this).attr('action'), // Get the form action URL
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        // If successful, you can handle redirection or close the modal
                        if (response.success) {
                            alert(response.message);
                            $('#createMemberModal').modal('hide');
                            location.reload();
                        }
                    },
                    error: function(xhr) {
                        // Handle validation errors
                        var errors = xhr.responseJSON.errors;
                        var errorHtml =
                            '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                        if (xhr.responseJSON.error) {
                            errorHtml += '<strong>' + xhr.responseJSON.error + '</strong>';
                        } else {
                            // Loop through errors and show each one
                            $.each(errors, function(field, messages) {
                                $.each(messages, function(index, message) {
                                    errorHtml += '<strong>' + message +
                                        '</strong><br>';
                                });
                            });
                        }
                        errorHtml +=
                            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                        errorHtml += '</div>';
                        $('#errorMessages').html(errorHtml); // Display errors inside the modal
                    }
                });
            });
            $(document).on('click', '.edit-member', function() {
                let memberId = $(this).data('id');
                let locale = "{{ app()->getLocale() }}";
                let url = `/${locale}/team-member/${memberId}/edit`; // Adjust the route as needed

                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                        if (response.success) {
                            let member = response.member;
                            $('#updateMemberModal #member_id').val(member.id);
                            $('#updateMemberModal #firstName').val(member.first_name);
                            $('#updateMemberModal #lastName').val(member.last_name);
                            $('#updateMemberModal #email').val(member.email);
                            $('#updateMemberModal #address').val(member.address);
                            $('#updateMemberModal #zip_code').val(member.zip_code);
                            $('#updateMemberModal #country').val(member.country_id).trigger(
                                'change');

                            $('#updateMemberModal #country').on('change', function() {
                                const countryId = $(this).val();
                                let locale = "{{ app()->getLocale() }}";
                                $('#updateMemberModal #state').html(
                                    '<option value="">Choose...</option>');
                                $('#updateMemberModal #city').html(
                                    '<option value="">Choose...</option>');
                                let url = `/${locale}/locations/states/${countryId}`;

                                if (countryId) {
                                    $.ajax({
                                        url: url,
                                        type: 'GET',
                                        success: function(states) {
                                            states.forEach(state => {
                                                $('#updateMemberModal #state')
                                                    .append(
                                                        `<option value="${state.id}">${state.name}</option>`
                                                        );
                                            });
                                            $('#updateMemberModal #state')
                                                .val(member.state_id)
                                                .trigger('change');
                                        }
                                    });
                                }
                            });

                            $('#updateMemberModal #state').on('change', function() {
                                const stateId = $(this).val();
                                let locale = "{{ app()->getLocale() }}";
                                $('#updateMemberModal #city').html(
                                    '<option value="">Choose...</option>');
                                let url = `/${locale}/locations/cities/${stateId}`;

                                if (stateId) {
                                    $.ajax({
                                        url: url,
                                        type: 'GET',
                                        success: function(cities) {
                                            cities.forEach(city => {
                                                $('#updateMemberModal #city')
                                                    .append(
                                                        `<option value="${city.id}">${city.name}</option>`
                                                        );
                                            });
                                            $('#updateMemberModal #city')
                                                .val(member.city_id);
                                        }
                                    });
                                }
                            });

                            $('#updateMemberModal').modal('show');

                            $('#updateMemberModal #country').trigger('change');

                        } else {
                            alert(response.message || 'Error fetching member data.');
                        }
                    },
                    error: function() {
                        alert('AJAX error fetching member data.');
                    }
                });
            });
   $('#updtateTeamMemberForm').on('submit', function(event) {
    event.preventDefault();

    let memberId = $('#updateMemberModal #member_id').val();
    let locale = "{{ app()->getLocale() }}";
    let url = `/${locale}/team-member/${memberId}/update`; // Construct URL (no /update if using resource routes)


    let formData = $(this).serialize();

    $.ajax({
        url: url,
        type: 'POST', // Keep this as POST (because of the override)
        data: formData,
        success: function(response) {
            if (response.success) {
                alert(response.message);
                $('#updateMemberModal').modal('hide');
                location.reload();
            } else {
                alert(response.message || 'Error updating member.');
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", status, error, xhr); // Detailed error logging
            alert('AJAX error updating member.');

            if (xhr.responseJSON && xhr.responseJSON.errors) {
                // Display validation errors (if any)
                let errorHtml = "<ul>";
                $.each(xhr.responseJSON.errors, function(key, value) {
                    errorHtml += "<li>" + value[0] + "</li>";
                });
                errorHtml += "</ul>";
                $('#updateErrorMessages').html(errorHtml);
            }
        }
    });
});
  });
$(document).ready(function () {
  $(document).on('click', '.delete-member', function () {

    let memberId = $(this).data('id');
    console.log('Member id: ', memberId);
    let locale = "{{ app()->getLocale() }}";
    let token = $('meta[name="csrf-token"]').attr('content');
    let url = `/${locale}/team-member/destroy/${memberId}`;

    if (confirm('Are you sure you want to delete this member?')) {
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                _token: token,
            },
            success: function (response) {
                $(`#member-${memberId}`).remove();
                alert(response.message);
                location.reload();
            },
            error: function (xhr) {
                console.error(xhr.responseText);
                alert('Failed to delete the member.');
            }
        });
    }
});
});
    </script>
@endsection
@push('scripts')
    <!-- apexcharts -->
    <scrip src="{{ asset('assets/login/libs/apexcharts/apexcharts.min.js') }}"></scrip>

    <!-- Vector map-->
    <script src="{{ asset('assets/login/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/login/libs/jsvectormap/maps/world-merc.js') }}"></script>

    <!-- Dashboard init -->
    <script src="{{ asset('assets/login/js/pages/dashboard-analytics.init.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('assets/login/js/app.js') }}"></script>
@endpush

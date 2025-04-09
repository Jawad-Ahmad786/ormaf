{{-- <?php
{{-- include("../layouts/login/paasetting.php"); --}}

try
{
	$retrievePAAOb = new classRetrievePAA;
	$retrievePAAOb->setUserID($_SESSION['security']['userID']);
	$department_details = $retrievePAAOb->retrieveDepartmentDetailByUserID();

}
catch(MyException $e)
{
	$_GET['error'] = $e->getUserMsg();
}

try
{
	if(isset($department_details[0]['department_id']))
	{
		$dep_id = $department_details[0]['department_id'];

		$retrievePAAOb = new classRetrievePAA;
		$retrievePAAOb->setDepartmentID($dep_id);
		$singleDepartmentDetails = $retrievePAAOb->retrieveDepartmentDetailByDepartmentID();
		$strategicOutcomeDetailsOfSingleDepartment = $retrievePAAOb->retrieveStrategicOutcomesDetailByDepartmentID();
		$programDetailsOfSingleDepartment = $retrievePAAOb->retrieveProgramDetailByDepartmentIDOnly();
	}
}
catch(MyException $e)
{
	$_GET['error'] = $e->getUserMsg();
}


if(count($department_details)==0)
{
	header('location:step1.php');
}
if(count($programDetailsOfSingleDepartment)==0)
{
	header('location:step3.php');
}

if(isset($_POST['Finish'])&&$_POST['Finish']=='Finish')
{
	$userOb = new classUser;
	$userOb->setUserRedirection(1,$_SESSION['security']['userID']);
	if($_SESSION['security']['categoryID']==2)
	{
		$redirect = 'summarydh.php';
	}
	if($_SESSION['security']['categoryID']==3)
	{
		$redirect = 'summarymd.php';
	}
	header("location:$redirect");
	exit;
}

/*echo '<pre>';
print_r($_POST);
echo '</pre>';
exit;
*/
if(isset($_POST['department_id']))
{
	$retireveDepartmentOb = new classRetrievePAA;
	$retireveDepartmentOb->setDepartmentID($_POST['department_id']);
	$departmentDetails = $retireveDepartmentOb->retrieveDepartmentDetailByDepartmentID();
}
else
{

	$retireveDepartmentOb = new classRetrievePAA;
	$retireveDepartmentOb->setDepartmentID($department_details[0]['department_id']);
	$departmentDetails = $retireveDepartmentOb->retrieveDepartmentDetailByDepartmentID();
}
?> --}}
@extends('layouts.login.main')
@section('title', 'Wiz 4')
@section('content')
    @push('css')
    <!-- plugin css -->
    <link href="{{asset('assets/login/libs/jsvectormap/css/jsvectormap.min.css')}}" rel="stylesheet" type="text/css" />

	<link rel="stylesheet" type="text/css" href="{{asset('assets/login/js/org_chart/css/chart.css')}}">

	<script type="text/javascript" src="{{asset('assets/login/js/js/jquery-1.10.2.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/login/js/js/mbExtruder.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/login/js/js/ajax.js')}}"></script>
	<script type="text/javascript" src="popUp/popUp.js"></script>
	<script type="text/javascript" src="{{asset('assets/login/js/org_chart/js/jquery_002.js')}}"></script>
    @endpush

<script>
jQuery(document).ready(function() {
    $("#org").jOrgChart({
        chartElement : '#chart',
        dragAndDrop  : false
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
								<h4 class="fs-18 lh-base mb-0">Step 4 - Outline your <span class="text-success">Programs Structure</span> </h4>
								<p class="mb-3 mt-2 pt-1 text-muted">Enter the Programs, Sub-Programs and Projects which you would be managing.</p>
								<div class="d-flex pull-right mb-2">
									<button type="button" class="btn btn-light btn-label previestab" data-previous="{{ route('wiz3', ['locale' => app()->getLocale()]) }}"><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> Back</button>
									<button type="button" class="btn btn-primary btn-label right ms-auto nexttab nexttab" data-nexttab="{{ route('wiz.end', ['locale' => app()->getLocale()]) }}"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Finish</button>
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

                        </div>

                                <div class="row">
                        <div class="col-xl-6">
                            <div class="card card-height-100">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Programs & Sub-Programs</h4>

                                </div><!-- end card header -->

                                <div class="card-body p-0">

                                    <div class="align-items-center p-3 justify-content-between d-flex">
                                        <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#programsModal"><i class="ri-add-line align-middle me-1"></i> Add Program</button>

										<!-- Modal Start -->
									<div class="modal fade" id="programsModal" tabindex="-1" aria-labelledby="programsModalLabel">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="programsModalLabel">Add Program</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="programForm" method="post" action="{{ route('program.store', ['locale' => app()->getLocale()]) }}">
                                                     @csrf
                                                        <div class="row g-3">
                                                            <!-- Program Name -->
                                                            <div class="col-xxl-6">
                                                                <label for="Program" class="form-label">Program Name</label>
                                                                <input name="name" type="text" class="form-control" id="Program" placeholder="Enter Program Name">
                                                                <span class="text-danger" id="nameError"></span>
                                                            </div>

                                                            <!-- Program Alignment -->
                                                            <div class="col-xxl-6">
                                                                <label for="objective_id" class="form-label">Program Alignment to Strategic Outcome</label>
                                                                <select class="form-select" id="objective_id" name="objective">
                                                                    <option value="">Select...</option>
                                                                    @foreach ($objectives as $objective)
                                                                        <option value="{{ $objective->id }}">{{ $objective->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <span class="text-danger" id="objectiveError"></span>
                                                            </div>

                                                            <!-- Checkbox for Sub-Programs -->
                                                                <div class="col-lg-12">
                                                                    <div class="form-check mb-2">
                                                                        <input name="has_subprograms" type="checkbox" class="form-check-input" id="parent">
                                                                        <label class="form-check-label" for="parent">This Program has Sub-Programs</label>
                                                                    </div>
                                                                    <span class="text-danger" id="parentError"></span>
                                                                </div>

                                                                <!-- Program Manager -->
                                                                <div class="col-xxl-6">
                                                                    <label for="manager" class="form-label">Program Manager</label>
                                                                   <select class="form-select" name="manager" id="manager">
                                                                        <option value="">Choose...</option>
                                                                        @foreach ($programMembers as $manager)
                                                                            <option value="{{ $manager['id'] }}">{{ $manager['first_name'] }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <!-- Program Members -->
                                                                <div class="col-xxl-6">
                                                                    <label for="members" class="form-label">Program Members</label>
                                                                    <select class="form-select" name="members[]" id="members" multiple>
                                                                        <option value="">Choose...</option>
                                                                        @foreach ($programMembers as $member)
                                                                            <option value="{{ $member->id }}">{{ $member->first_name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <!-- Program Value -->
                                                                <div class="col-xxl-6">
                                                                    <label for="value" class="form-label">Program Value</label>
                                                                    <input type="number" class="form-control" name="value" id="value" value="" placeholder="Enter value">
                                                                    <span class="text-danger" id="valueError"></span>
                                                                </div>

                                                                <!-- Submit Buttons -->
                                                                <div class="col-lg-12">
                                                                    <div class="hstack gap-2 justify-content-end">
                                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>

										<!-- Modal End -->

                                    </div>
                                    <!-- end card header -->

                                     <ul class="list-group list-group-flush border-dashed px-3">
                                        @if($programs)
                                            @foreach ($programs as $program)
                                                <li class="list-group-item d-flex align-items-center justify-content-between">
                                                    <div>
                                                        <label class="form-check-label fw-bold mb-0">{{ $program->name }}</label>
                                                    </div>
                                                    <div>
                                                        @if($program->has_subprograms)
                                                            <button type="button" data-bs-toggle="modal" data-bs-target="#subProgramsModal_{{$program->id}}" class="btn btn-info btn-sm me-2">Add Subprogram</button>
                                                        @endif
                                                        <button type="button" class="btn btn-link text-warning p-0" data-bs-toggle="modal" data-bs-target="#updateProgramModal_{{ $program->id }}" title="Edit">
                                                            <i class="ri-edit-line"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-link text-danger p-0 delete-program" data-id="{{ $program->id }}" title="Delete">
                                                            <i class="ri-delete-bin-fill align-bottom me-2"></i>
                                                        </button>
                                                    </div>
                                                </li>

                                                <!-- Loop through subprograms -->
                                                @if($program->subprograms->count() > 0)
                                                    <ul class="list-group ms-4">
                                                        @foreach ($program->subprograms as $subprogram)
                                                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                                                    <label class="form-check-label fw-bold mb-0">{{ $subprogram->name }}</label>
                                                                    <button type="button" class="btn btn-link text-warning p-0 edit-subprogram" data-bs-toggle="modal" data-bs-target="#updateSubProgramModal_{{$subprogram->id}}" title="Edit">
                                                                        <i class="ri-edit-line"></i>
                                                                    </button>
                                                                    <button type="button" class="btn btn-link text-danger p-0 delete-subProgram" data-id="{{ $subprogram->id }}" title="Delete">
                                                                        <i class="ri-delete-bin-fill align-bottom me-2"></i>
                                                                    </button>
                                                                </li>
                                                             <!-- Update SubProgram Modal -->
                                                 <div class="modal fade" id="updateSubProgramModal_{{$subprogram->id}}" tabindex="-1" aria-labelledby="updateSubProgramModal">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Update Sub Program</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form id="updateSubProgramForm" method="post" action="{{ route('subprogram.update', ['locale' => app()->getLocale(), $subprogram->id]) }}">
                                                            @csrf
                                                            <div class="row g-3">
                                                                <div class="col-xxl-6">
                                                                    <label for="name" class="form-label">Sub Program Name</label>
                                                                    <input name="name" value="{{$subprogram->name}}" type="text" class="form-control" id="name" placeholder="Enter Sub Program Name">
                                                                    <input type="hidden" value="{{$subprogram->id}}" id="programId">
                                                                    <span class="text-danger" id="nameError"></span>
                                                                </div>

                                                                <div class="col-xxl-6">
                                                                    <label for="objective_id" class="form-label">Sub Program Alignment to Strategic Outcome</label>
                                                                    <select class="form-select" id="objective_id" name="objective">
                                                                        <option value="">Select...</option>
                                                                        @foreach ($objectives as $objective)
                                                                            <option {{ $subprogram->logic_model_component_id == $objective->id ? 'selected' : '' }} value="{{ $objective->id }}">{{ $objective->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <span class="text-danger" id="objectiveError"></span>
                                                                </div>
                                                                <div class="col-xxl-6">
                                                                    <label for="manager" class="form-label">Sub Program Manager</label>
                                                                    <select class="form-select" name="manager" id="manager">
                                                                        @foreach ($programMembers as $manager)
                                                                            <option value="{{ $manager['id'] }}" {{ $subprogram->manager_id == $manager['id'] ? 'selected' : '' }}>
                                                                                {{ $manager['first_name'] }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-xxl-6">
                                                                    <label for="members" class="form-label">Sub Program Members</label>
                                                                    <select class="form-select" name="members[]" id="members" multiple>
                                                                        @foreach ($programMembers as $member)
                                                                            <option value="{{ $member->id }}" {{ in_array($member->id, $subprogram->members->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                                                {{ $member->first_name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-xxl-6">
                                                                    <label for="value" class="form-label">Sub Program Value</label>
                                                                    <input type="number" class="form-control" name="value" id="value" value="{{ $subprogram->value }}" placeholder="Enter value">
                                                                    <span class="text-danger" id="valueError"></span>
                                                                </div>

                                                                <div class="col-lg-12">
                                                                    <div class="hstack gap-2 justify-content-end">
                                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                 @endforeach
                                                    </ul>
                                                @endif
                                                <!-- Subprogram Modal -->
                                                <div class="modal fade" id="subProgramsModal_{{$program->id}}" tabindex="-1" aria-labelledby="subProgramsModal">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Add Sub Program</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form id="subProgramForm" method="post" action="{{ route('subprogram.store', ['locale' => app()->getLocale()]) }}">
                                                                    @csrf
                                                            <!-- Subpogram Name -->
                                                                <label for="objective_id" class="form-label">Sub Program Name</label>
                                                                    <input type="hidden" name="program_id" class="programIdInput" value="{{ $program->id }}">
                                                                    <input name="name" type="text" class="form-control" placeholder="Enter Sub Program Name">
                                                                    <span class="text-danger" id="nameError"></span>
                                                                      <!-- Subprogram Alignment -->
                                                                <label for="objective_id" class="form-label">Program Alignment to Strategic Outcome</label>
                                                                <select class="form-select" id="objective_id" name="objective">
                                                                    <option value="">Select...</option>
                                                                    @foreach ($objectives as $objective)
                                                                        <option value="{{ $objective->id }}">{{ $objective->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <span class="text-danger" id="objectiveError"></span>
                                                                <!-- Subprogram Manager -->
                                                                    <label for="manager" class="form-label">Sub Program Manager</label>
                                                                   <select class="form-select" name="manager" id="manager">
                                                                        <option value="">Choose...</option>
                                                                        @foreach ($programMembers as $manager)
                                                                            <option value="{{ $manager['id'] }}">{{ $manager['first_name'] }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                <!-- Subprogram Members -->
                                                                    <label for="members" class="form-label">Sub Program Members</label>
                                                                    <select class="form-select" name="members[]" id="members" multiple>
                                                                        <option value="">Choose...</option>
                                                                        @foreach ($programMembers as $member)
                                                                            <option value="{{ $member->id }}">{{ $member->first_name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                <!-- Subprogram Value -->
                                                                    <label for="value" class="form-label">Sub Program Value</label>
                                                                    <input type="number" class="form-control" name="value" id="value" value="" placeholder="Enter value">
                                                                    <span class="text-danger" id="valueError"></span>

                                                                    <button type="submit" class="mt-3 btn btn-primary">Submit</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                    <!-- Update Program Modal -->
                                        <div class="modal fade" id="updateProgramModal_{{ $program->id }}" tabindex="-1" aria-labelledby="updateProgramModalLabel">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="updateProgramModalLabel">Update Program</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="updateProgramForm" method="post" action="{{ route('program.update', ['locale' => app()->getLocale(), $program->id]) }}">
                                                            @csrf
                                                            <div class="row g-3">
                                                                <div class="col-xxl-6">
                                                                    <label for="name" class="form-label">Program Name</label>
                                                                    <input name="name" value="{{$program->name}}" type="text" class="form-control" id="name" placeholder="Enter Program Name">
                                                                    <input type="hidden" value="{{$program->id}}" id="programId">
                                                                    <span class="text-danger" id="nameError"></span>
                                                                </div>

                                                                <div class="col-xxl-6">
                                                                    <label for="objective_id" class="form-label">Program Alignment to Strategic Outcome</label>
                                                                    <select class="form-select" id="objective_id" name="objective">
                                                                        <option value="">Select...</option>
                                                                        @foreach ($objectives as $objective)
                                                                            <option {{ $program->logic_model_component_id == $objective->id ? 'selected' : '' }} value="{{ $objective->id }}">{{ $objective->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <span class="text-danger" id="objectiveError"></span>
                                                                </div>

                                                                <div class="col-lg-12">
                                                                    <div class="form-check mb-2">
                                                                        <input name="has_subprograms" {{ $program->has_subprograms ? 'checked' : '' }} type="checkbox" class="form-check-input" id="parent">
                                                                        <label class="form-check-label" for="parent">This Program has Sub-Programs</label>
                                                                    </div>
                                                                    <span class="text-danger" id="parentError"></span>
                                                                </div>

                                                                <div class="col-xxl-6">
                                                                    <label for="manager" class="form-label">Program Manager</label>
                                                                    <select class="form-select" name="manager" id="manager">
                                                                        @foreach ($programMembers as $manager)
                                                                            <option value="{{ $manager['id'] }}" {{ $program->manager_id == $manager['id'] ? 'selected' : '' }}>
                                                                                {{ $manager['first_name'] }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-xxl-6">
                                                                    <label for="members" class="form-label">Program Members</label>
                                                                    <select class="form-select" name="members[]" id="members" multiple>
                                                                        @foreach ($programMembers as $member)
                                                                            <option value="{{ $member->id }}" {{ in_array($member->id, $program->members->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                                                {{ $member->first_name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-xxl-6">
                                                                    <label for="value" class="form-label">Program Value</label>
                                                                    <input type="number" class="form-control" name="value" id="value" value="{{ $program->value }}" placeholder="Enter value">
                                                                    <span class="text-danger" id="valueError"></span>
                                                                </div>

                                                                <div class="col-lg-12">
                                                                    <div class="hstack gap-2 justify-content-end">
                                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                        @else
                                            <li class="list-group-item text-center text-muted">
                                                No programs available.
                                            </li>
                                        @endif
                                    </ul>

                                    <!-- end ul -->
                                </div><!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                        <div class="col-xl-6">
                            <div class="card">

                                <div class="card-header">
                                    <h4 class="card-title mb-0">Program Alignment Architecture (PAA)</h4>
                                </div><!-- end card header -->

                                <div class="card-body">
									<div>
                                		<div class="text-center">
                                    		<div class="profile-user position-relative d-inline-block mx-auto mb-2">

												<script>
												$(document).ready(function() {
													$('#org_chart_select').change(function() {
														$("#org_chart_form").submit();
													});
													});
												</script>

												{{-- <?php
												if( $_SESSION['security']['categoryID']==3)
												{ ?>
												<form action="" id="org_chart_form" method="post">
												<select name="department_id" id="org_chart_select">
												  <?php
												  for($d=0;$d<count($department_details);$d++)
												  {
													  ?>
													  <option value="<?php if(isset($department_details[$d]['department_id'])){echo $department_details[$d]['department_id'];}?>" <?php if($department_details[$d]['department_id']==$departmentDetails[0]['department_id']){echo 'selected';}?>><?php if(isset($department_details[$d]['department_name'])){echo $department_details[$d]['department_name'];}?></option>
													  <?php
												  }
												  ?>
												  </select>
												</form>
												 <?php }?> --}}

												<ul id="org" style="display:none">
														{{-- <?php
														$userOb = new classUser;
														$user_group_by = $userOb->getUserGroupBy($_SESSION['security']['userID']);

														if(isset($user_group_by)&&$user_group_by)
														{

															$retrievePAAOb = new classRetrievePAA;
															$wholeOfGovtDetail = $retrievePAAOb->retrieveWholeOfGovtSpendingAreasDetail();
															$programUnderDepartmentDetails = $retrievePAAOb->retrieveSpecificProgramDetailByDepartmentID(0,false,false,true,$_SESSION['security']['userID']);

														?>
														<li>Whole of govt
														<ul>
														<?php
															for($j=0;$j<count($wholeOfGovtDetail);$j++)
															{
																$programDetails = $retrievePAAOb->retrieveProgramDetailBySpendingAreaID($wholeOfGovtDetail[$j]['spending_area_id']);
																?>
																<li><?php echo ucfirst($wholeOfGovtDetail[$j]['spending_area_name']);
																if(isset($programDetails[0])&&$programDetails[0]!="")
																{
																?>
																	<ul>
																	<?php
																	for($k=0;$k<count($programDetails);$k++)
																	{
																		$retrievePAAOb->setProgramID($programDetails[$k]['program_id']);
																		$subProgramDetail = $retrievePAAOb->retrieveSubProgramDetailByProgramID();
																		?>
																		<li><a style="color:white;" href="?prog_id=<?php echo $programDetails[$k]['program_id']?>"><?php echo ucfirst($programDetails[$k]['program_name']); ?></a>
																		<?php
																		if(isset($subProgramDetail[0])&&$subProgramDetail[0]!="")
																		{
																		?>
																			<ul>
																			<?php
																			for($h=0;$h<count($subProgramDetail);$h++)
																			{
																				?>
																				<li><a style="color:white;" href="?prog_id=<?php echo $subProgramDetail[$h]['program_id']?>"><?php echo ucfirst($subProgramDetail[$h]['program_name']); ?></a></li>
																				<?php
																			}
																			?>
																			</ul>
																		<?php
																		}
																		?>

																		</li>
																	<?php
																	}
																	?>
																	</ul>
																<?php
																}
																?>
																</li>
																<?php
															}
															if(isset($programUnderDepartmentDetails[0])&&$programUnderDepartmentDetails[0]!="")
															{
																for($j=0;$j<count($programUnderDepartmentDetails);$j++)
																{
																	$retrievePAAOb->setProgramID($programUnderDepartmentDetails[$j]['program_id']);
																	$subProgramDetail = $retrievePAAOb->retrieveSubProgramDetailByProgramID();
																	?>
																	<li><a style="color:white;" href="?prog_id=<?php echo $programUnderDepartmentDetails[$j]['program_id']?>"><?php echo ucfirst($programUnderDepartmentDetails[$j]['program_name']); ?></a>
																		<?php
																		if(isset($subProgramDetail[0])&&$subProgramDetail[0]!="")
																		{
																		?>
																			<ul>
																			<?php
																			for($h=0;$h<count($subProgramDetail);$h++)
																			{
																			?>
																				<li><a style="color:white;" href="?prog_id=<?php echo $subProgramDetail[$h]['program_id']?>"><?php echo ucfirst($subProgramDetail[$h]['program_name']); ?></a></li>
																			<?php
																			}
																			?>
																			</ul>
																		<?php
																		}
																		?>
																	</li>
																	<?php
																}
															}
														?>
														</ul>
														</li>
														<?php

														}
														else
														{

															?>
															<li><a style="color:white;" href="?dep_id=<?php echo $departmentDetails[0]['department_id']?>"><?php echo ucfirst($departmentDetails[0]['department_name']);?></a>
																<?php
																if(isset($departmentDetails[0]['department_name'])&&$departmentDetails[0]['department_name']!="")
																{
																	for($i=0;$i<count($departmentDetails);$i++)
																	{
																		if(isset($departmentDetails[$i]['group_by'])&&$departmentDetails[$i]['group_by']=='strategic_outcomes')
																		{
																			$retrievePAAOb->setDepartmentID($departmentDetails[$i]['department_id']);
																			$strategicOutcomeDetails = $retrievePAAOb->retrieveStrategicOutcomesDetailByDepartmentID();
																			$programUnderDepartmentDetails = $retrievePAAOb->retrieveSpecificProgramDetailByDepartmentID($departmentDetails[$i]['department_id'],true,false,false);

																			if(isset($strategicOutcomeDetails[0])&&$strategicOutcomeDetails[0]!="")
																			{
																			?>
																				<ul>
																				<?php
																				for($j=0;$j<count($strategicOutcomeDetails);$j++)
																				{

																					$retrievePAAOb->setDepartmentID($departmentDetails[$i]['department_id']);
																					$retrievePAAOb->setStrategicOutcomeID($strategicOutcomeDetails[$j]['so_id']);
																					$programDetails = $retrievePAAOb->retrieveProgramDetailByDepartmentIDAndByStrategicOutcomeID();
																					?>
																					<li>
																					<?php
																					if($strategicOutcomeDetails[$j]['so_pms_exist'])
																					{
																						?>
																						<a  style="color:white;" href="?so_id=<?php echo $strategicOutcomeDetails[$j]['so_id']?>"><?php echo ucfirst($strategicOutcomeDetails[$j]['so_name']); ?></a>
																						<?php
																					}
																					else
																					{
																						 echo ucfirst($strategicOutcomeDetails[$j]['so_name']);
																					}
																					if(isset($programDetails[0])&&$programDetails[0]!="")
																					{
																					?>
																						<ul>
																						<?php
																						for($k=0;$k<count($programDetails);$k++)
																						{
																							$retrievePAAOb->setProgramID($programDetails[$k]['program_id']);
																							$subProgramDetail = $retrievePAAOb->retrieveSubProgramDetailByProgramID();
																						?>
																							<li><a style="color:white;" href="?prog_id=<?php echo $programDetails[$k]['program_id']?>"><?php echo ucfirst($programDetails[$k]['program_name']); ?></a>
																							<?php
																							if(isset($subProgramDetail[0])&&$subProgramDetail[0]!="")
																							{
																							?>
																								<ul>
																								<?php
																								for($h=0;$h<count($subProgramDetail);$h++)
																								{
																								?>
																									<li><a  style="color:white;" href="?prog_id=<?php echo $subProgramDetail[$h]['program_id']?>"><?php echo ucfirst($subProgramDetail[$h]['program_name']); ?></a></li>
																								<?php
																								}
																								?>
																								</ul>
																							<?php
																							}
																							?>

																							</li>
																						<?php
																						}
																						?>
																						</ul>
																					<?php
																					}
																					?>
																					</li>
																					<?php
																				}
																				?>
																				</ul>
																			<?php
																			}
																			if(isset($programUnderDepartmentDetails[0])&&$programUnderDepartmentDetails[0]!="")
																			{

																			?>
																				<ul>
																				<?php
																				for($j=0;$j<count($programUnderDepartmentDetails);$j++)
																				{
																					$retrievePAAOb->setProgramID($programUnderDepartmentDetails[$j]['program_id']);
																					$subProgramDetail = $retrievePAAOb->retrieveSubProgramDetailByProgramID();
																					?>
																					<li><a href="?prog_id=<?php echo $programUnderDepartmentDetails[$j]['program_id']?>"><?php echo ucfirst($programUnderDepartmentDetails[$j]['program_name']); ?></a>
																						<?php
																						if(isset($subProgramDetail[0])&&$subProgramDetail[0]!="")
																						{
																						?>
																							<ul>
																							<?php
																							for($h=0;$h<count($subProgramDetail);$h++)
																							{
																							?>
																								<li><a href="?prog_id=<?php echo $subProgramDetail[$h]['program_id']?>"><?php echo ucfirst($subProgramDetail[$h]['program_name']); ?></a></li>
																							<?php
																							}
																							?>
																							</ul>
																						<?php
																						}
																						?>
																					</li>
																					<?php
																				}
																				?>
																				</ul>
																			<?php
																			}

																		}
																		elseif(isset($departmentDetails[$i]['group_by'])&&$departmentDetails[$i]['group_by']=='branches')
																		{
																			$retrievePAAOb->setDepartmentID($departmentDetails[$i]['department_id']);
																			$branchDetails = $retrievePAAOb->retrieveBranchDetailsByDepartmentID();
																			$programUnderDepartmentDetails = $retrievePAAOb->retrieveSpecificProgramDetailByDepartmentID($departmentDetails[$i]['department_id'],false,true,false);

																			if(isset($branchDetails[0])&&$branchDetails[0]!="")
																			{
																			?>
																				<ul>
																				<?php
																				for($j=0;$j<count($branchDetails);$j++)
																				{

																					$retrievePAAOb->setDepartmentID($departmentDetails[$i]['department_id']);
																					$retrievePAAOb->setBranchID($branchDetails[$j]['branch_id']);
																					$programDetails = $retrievePAAOb->retrieveProgramDetailByDepartmentIDAndByBranchID();
																					?>
																					<li>
																					<?php
																					if($branchDetails[$j]['so_pms_exist'])
																					{
																						?>
																						<a style="color:white;" href="?branch_id=<?php echo $branchDetails[$j]['branch_id']?>"><?php echo ucfirst($branchDetails[$j]['branch_name']); ?></a>
																						<?php
																					}
																					else
																					{
																						 echo ucfirst($branchDetails[$j]['branch_name']);
																					}


																					if(isset($programDetails[0])&&$programDetails[0]!="")
																					{
																					?>
																						<ul>
																						<?php
																						for($k=0;$k<count($programDetails);$k++)
																						{
																							$retrievePAAOb->setProgramID($programDetails[$k]['program_id']);
																							$subProgramDetail = $retrievePAAOb->retrieveSubProgramDetailByProgramID();
																						?>
																							<li>
																							<a style="color:white;" href="?prog_id=<?php echo $programDetails[$k]['program_id']?>"><?php echo ucfirst($programDetails[$k]['program_name']);?></a>
																							 <?php
																							if(isset($subProgramDetail[0])&&$subProgramDetail[0]!="")
																							{
																							?>
																								<ul>
																								<?php
																								for($h=0;$h<count($subProgramDetail);$h++)
																								{
																								?>
																									<li><a style="color:white;" href="?prog_id=<?php echo $subProgramDetail[$h]['program_id']?>"><?php echo ucfirst($subProgramDetail[$h]['program_name']); ?></a></li>
																								<?php
																								}
																								?>
																								</ul>
																							<?php
																							}
																							?>
																							</span></li>
																						<?php
																						}
																						?>
																						</ul>
																					<?php
																					}
																					?>
																					</li>
																					<?php
																				}
																				?>
																				</ul>
																			<?php
																			}
																			if(isset($programUnderDepartmentDetails[0])&&$programUnderDepartmentDetails[0]!="")
																			{
																			?>
																				<ul>
																				<?php
																				for($j=0;$j<count($programUnderDepartmentDetails);$j++)
																				{
																					$retrievePAAOb->setProgramID($programUnderDepartmentDetails[$j]['program_id']);
																					$subProgramDetail = $retrievePAAOb->retrieveSubProgramDetailByProgramID();
																					?>
																					<li><a style="color:white;" href="?prog_id=<?php echo $programUnderDepartmentDetails[$j]['program_id']?>"><?php echo ucfirst($programUnderDepartmentDetails[$j]['program_name']); ?></a>
																					<?php
																					if(isset($subProgramDetail[0])&&$subProgramDetail[0]!="")
																					{
																					?>
																						<ul>
																						<?php
																						for($h=0;$h<count($subProgramDetail);$h++)
																						{
																						?>
																							<li><a style="color:white;" href="?prog_id=<?php echo $subProgramDetail[$h]['program_id']?>"><?php echo ucfirst($subProgramDetail[$h]['program_name']); ?></a></li>
																						<?php
																						}
																						?>
																						</ul>
																					<?php
																					}
																					?>
																					</li>
																					<?php
																				}
																				?>
																				</ul>
																			<?php
																			}

																		}

																	}
																}
																?>
																</li>
														   <?php
														}
														?> --}}
														</ul>

												<div id="chart" class="orgChart"></div>

							  			 	</div>
                                      </div>
                                   </div>
                                </div>
                                <!-- end card body -->
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
                                    <h6 class="card-title mb-0"><i class=" ri-stack-line align-middle me-1 lh-1"></i> Programs Alignment Architecture (PAA)</h6>
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
    $('#programForm').on('submit', function (e) {
    e.preventDefault();

    let form = $(this);
    let url = form.attr('action');
    let formData = form.serialize();

    $.ajax({
        url: url,
        type: 'POST',
        data: formData,

        success: function (response) {
            $('#programsModal').modal('hide');
            alert(response.message);
            location.reload();
        },
        error: function (response) {
            $('.text-danger').remove();

            if (response.status === 422) {
                let errors = response.responseJSON.errors;
                for (let field in errors) {
                    if (errors.hasOwnProperty(field)) {
                        errors[field].forEach(function (error) {
                            $(`[name="${field}"]`).after(`<span class="text-danger">${error}</span>`);
                        });
                    }
                }
            }
            if (response.status === 500) {
                alert("something went wrong");
            }
        },
    });
});

 $(document).on('submit', '#subProgramForm', function (e) {
    e.preventDefault();

    let form = $(this);
    let url = form.attr('action');
    let formData = form.serialize();

    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        success: function (response) {
            form.closest('.modal').modal('hide');

            alert(response.message);
            location.reload();
        },
        error: function (response) {
            $('.text-danger').remove();

            if (response.status === 422) {
                let errors = response.responseJSON.errors;
                for (let field in errors) {
                    if (errors.hasOwnProperty(field)) {
                        errors[field].forEach(function (error) {
                            $(`[name="${field}"]`).after(`<span class="text-danger">${error}</span>`);
                        });
                    }
                }
            }
            if (response.status === 500) {
                alert(response.responseJSON.message);
            }
        },
    });
});

$(document).on('hidden.bs.modal', '.modal', function () {
    $(this).find('form')[0].reset();
    $(this).find('.text-danger').remove();
});

$(document).on('click', '.previestab', function () {
    let previousUrl = $(this).data('previous');
    window.location.href = previousUrl;
});

$(document).on('click', '.nexttab', function () {
    let nextUrl = $(this).data('nexttab');
    window.location.href = nextUrl;
});

$(document).on('submit', 'form#updateProgramForm', function (e) {
    e.preventDefault();
    let form = $(this);
    let programId = $('#programId').val();
    let locale = "{{ app()->getLocale() }}";
    let url = form.attr('action');

    $.ajax({
        url: url,
        type: 'POST',
        data: form.serialize(),
        dataType: 'json',
        success: function (response) {
            $(`#updateProgramModal_${programId}`).modal('hide');
            alert(response.message);
            location.reload();
        },
        error: function (xhr) {
            if (xhr.status === 422) {
                let errors = xhr.responseJSON.errors;
                $('#nameError').text(errors.name ? errors.name[0] : '');
                $('#objectiveError').text(errors.objective ? errors.objective[0] : '');
                $('#parentError').text(errors.has_subprograms ? errors.has_subprograms[0] : '');
                $('#valueError').text(errors.value ? errors.value[0] : '');
            } else {
                alert('An error occurred: ' + (xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Unknown error'));
            }
        }
    });
});
$(document).on('click', '.delete-program', function (){

    let programId = $(this).data('id');
    let locale = "{{app()->getLocale()}}";
    let url = `/${locale}/program/destroy/${programId}`;
    let token = $('meta[name="csrf-token"]').attr('content');
    let listItem = $(this).closest('.list-group-item');

 if(confirm("Are you sure you want to delete this program?")) {
    $.ajax({
            url: url,
            type: 'POST',
            data: {
                _token: token,
            },
        success: function(response) {
                alert(response.message);
            if (response.success) {
                    // Remove the main program <li> and any nested <ul> containing subprograms
                    listItem.next('ul').fadeOut(300, function () {
                        $(this).remove();
                    });
                    listItem.fadeOut(300, function () {
                        $(this).remove();
                    });
                }
            },
        error: function(xhr) {
        }
    });
 }
});
    $(document).on('submit', 'form#updateSubProgramForm', function (e) {
    e.preventDefault();
    let form = $(this);
    let subProgramId = $('#subProgramId').val();
    let locale = "{{ app()->getLocale() }}";
    let url = form.attr('action');

    $.ajax({
        url: url,
        type: 'POST',
        data: form.serialize(),
        dataType: 'json',
        success: function (response) {
            $(`#updateSubProgramModal_${subProgramId}`).modal('hide');
            alert(response.message);
            location.reload();
        },
        error: function (xhr) {
            if (xhr.status === 422) {
                let errors = xhr.responseJSON.errors;
                $('#nameError').text(errors.name ? errors.name[0] : '');
                $('#objectiveError').text(errors.objective ? errors.objective[0] : '');
                $('#valueError').text(errors.value ? errors.value[0] : '');
            } else {
                alert('An error occurred: ' + (xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Unknown error'));
            }
        }
    });
});
$(document).on('click', '.delete-subProgram', function (){

    let subProgramId = $(this).data('id');
    let locale = "{{app()->getLocale()}}";
    let url = `/${locale}/subprogram/destroy/${subProgramId}`;
    let token = $('meta[name="csrf-token"]').attr('content');
    let listItem = $(this).closest('.list-group-item');

 if(confirm("Are you sure you want to delete this subprogram?")) {
    $.ajax({
            url: url,
            type: 'POST',
            data: {
                _token: token,
            },
        success: function(response) {
                alert(response.message);
            if (response.success) {
                    listItem.next('ul').fadeOut(300, function () {
                        $(this).remove();
                    });
                    listItem.fadeOut(300, function () {
                        $(this).remove();
                    });
                }
            },
        error: function(xhr) {
        }
    });
 }
});
</script>
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

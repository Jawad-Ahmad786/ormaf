{{-- <?php
include("paasetting.php");

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
@section('title', 'Wiz 3')
@section('content')
    @push('css')
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
								<h4 class="fs-18 lh-base mb-0">Step 3 - Setup your <span class="text-success">Team</span> </h4>
                                @if(session()->has('error'))
                                <div class="alert alert-dismissible">
                                </div>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ session('error') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                @endif
								<p class="mb-3 mt-2 pt-1 text-muted">Enter the Team members helping you in managing your Programs.</p>
								<div class="d-flex pull-right mb-2">
									<button type="button" class="btn btn-light btn-label previestab" data-previous="{{ route('wiz2', ['locale' => app()->getLocale()]) }}"><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> Back</button>
									<button type="button" class="btn btn-primary btn-label right ms-auto nexttab nexttab" data-nexttab="{{ route('wiz4', ['locale' => app()->getLocale()]) }}"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Next</button>
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
                                    <h4 class="card-title mb-0 flex-grow-1">Team Members</h4>
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
                                        <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#exampleModalgrid"><i class="ri-add-line align-middle me-1"></i> Add Team Member</button>

										<!-- Modal Start -->
										<div class="modal fade" id="exampleModalgrid" tabindex="-1" aria-labelledby="exampleModalgridLabel">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalgridLabel">Add Team Member</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Error messages will be displayed here -->
                                                        <div id="errorMessages"></div>
                                                        <form id="addTeamMemberForm" method="post" action="{{ route('free-signup.store', ['locale' => app()->getLocale()]) }}">
                                                            @csrf
                                                            <div class="row g-3">
                                                                <div class="col-xxl-6">
                                                                    <div>
                                                                        <label for="firstName" class="form-label">First Name</label>
                                                                        <input type="text" name="first_name" class="form-control" id="firstName" placeholder="Enter First Name">
                                                                        <input type="hidden" name="added_by" value="{{ auth()->id() }}">
                                                                    </div>
                                                                </div>
                                                                <!-- End of first name -->

                                                                <div class="col-xxl-6">
                                                                    <label for="lastName" class="form-label">Last Name</label>
                                                                    <input type="text" name="last_name" class="form-control" id="lastName" placeholder="Enter Last Name">
                                                                </div>

                                                                <div class="col-xxl-6">
                                                                    <label for="email" class="form-label">Email</label>
                                                                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email">
                                                                </div>

                                                                <div class="col-xxl-6">
                                                                    <label for="passwordInput" class="form-label">Password</label>
                                                                    <input type="password" name="password" class="form-control" id="passwordInput" placeholder="Enter password">
                                                                </div>

                                                                <div class="col-xxl-6">
                                                                    <label for="confirmPasswordInput" class="form-label">Confirm Password</label>
                                                                    <input type="password" name="password_confirmation" class="form-control" id="confirmPasswordInput" placeholder="Confirm password">
                                                                </div>

                                                                <!-- Country Dropdown -->
                                                                <div class="col-xxl-6">
                                                                    <label for="country" class="form-label">Country</label>
                                                                    <select class="form-select" name="country" id="country">
                                                                        <option value="">Choose...</option>
                                                                        @foreach ($countries as $country)
                                                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <!-- State Dropdown -->
                                                                <div class="col-xxl-6">
                                                                    <label for="state" class="form-label">State</label>
                                                                    <select name="state" id="state" class="form-select">
                                                                        <option value="">Choose...</option>
                                                                    </select>
                                                                </div>

                                                                <!-- City Dropdown -->
                                                                <div class="col-xxl-6">
                                                                    <label for="city" class="form-label">City</label>
                                                                    <select name="city" id="city" class="form-select">
                                                                        <option value="">Choose...</option>
                                                                    </select>
                                                                </div>

                                                                <div class="col-xxl-6">
                                                                    <label for="address" class="form-label">Address</label>
                                                                    <input type="text" name="address" class="form-control" id="address" placeholder="Enter Address">
                                                                </div>

                                                                <div class="col-xxl-6">
                                                                    <label for="zip_code" class="form-label">Zip Code</label>
                                                                    <input type="text" name="zip_code" class="form-control" id="zip_code" placeholder="Enter Zip Code">
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

										<!-- Modal End -->

                                    </div><!-- end card header -->
									<div>
                                        <div class="table-responsive table-card mb-3 mt-3">
                                              <table class="table align-middle table-nowrap mb-0" id="customerTable">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th class="sort" data-sort="name" scope="col">First Name</th>
                                                        <th class="sort" data-sort="email_id" scope="col">Last Name</th>
                                                        <th class="sort" data-sort="tags" scope="col">Email</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list form-check-all">
                                                 @if(!is_null($teamMembers))
                                                    @foreach ($teamMembers as $member)
                                                    <tr>
                                                        <td class="name">
                                                            <div class="d-flex align-items-center">
                                                                <div class="flex-shrink-0"><img src="{{asset('assets/login/images/users/avatar-8.jpg')}}" alt="" class="avatar-xs rounded-circle"></div>
                                                                <div class="flex-grow-1 ms-2 name">{{ $member->first_name }}</div>
                                                            </div>
                                                        </td>
                                                        <td class="email_id">{{ $member->last_name }}
														</td>
                                                        <td class="tags">
                                                            <span class="badge bg-primary-subtle text-primary">{{ $member->email }}</span>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    @endif
													</tbody>
                                                    </table>

                                        </div>
                                        <!--<div class="d-flex justify-content-end mt-3">
                                            <div class="pagination-wrap hstack gap-2">
                                                <a class="page-item pagination-prev disabled" href="#">
                                                    Previous
                                                </a>
                                                <ul class="pagination listjs-pagination mb-0"></ul>
                                                <a class="page-item pagination-next" href="#">
                                                    Next
                                                </a>
                                            </div>
                                        </div>-->
                                    </div>
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

												{{-- <scrip>
												$(document).ready(function() {
													$('#org_chart_select').change(function() {
														$("#org_chart_form").submit();
													});
													});
												</scrip>

												<?php
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
												 <?php }?>

												<ul id="org" style="display:none">
														<?php
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
														?>
														</ul> --}}

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
    $(document).ready(function () {
        // When the country is selected
        $('#country').on('change', function () {
            const countryId = $(this).val();
            let locale = "{{ app()->getLocale() }}"; // Get the locale from Laravel
            $('#state').html('<option value="">Choose...</option>');
            $('#city').html('<option value="">Choose...</option>');
            let url = `/${locale}/locations/states/${countryId}`;
            console.log("Locale is: ", locale); // This should output the current locale, e.g., 'en', 'fr'.


            if (countryId) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function (states) {
                        states.forEach(state => {
                            $('#state').append(`<option value="${state.id}">${state.name}</option>`);
                        });
                    }
                });
            }
        });

        // When the state is selected
        $('#state').on('change', function () {
            const stateId = $(this).val();
            let locale = "{{ app()->getLocale() }}"; // Get the locale from Laravel
            $('#city').html('<option value="">Choose...</option>');
            let url = `/${locale}/locations/cities/${stateId}`;

            if (stateId) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function (cities) {
                        cities.forEach(city => {
                            $('#city').append(`<option value="${city.id}">${city.name}</option>`);
                        });
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
                    $('#exampleModalgrid').modal('hide');
                    location.reload();
                }
            },
            error: function(xhr) {
                // Handle validation errors
                var errors = xhr.responseJSON.errors;
                var errorHtml = '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                if (xhr.responseJSON.error) {
                    errorHtml += '<strong>' + xhr.responseJSON.error + '</strong>';
                } else {
                    // Loop through errors and show each one
                    $.each(errors, function(field, messages) {
                         $.each(messages, function(index, message) {
                            errorHtml += '<strong>' + message + '</strong><br>';
                        });
                    });
                }
                errorHtml += '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                errorHtml += '</div>';
                $('#errorMessages').html(errorHtml); // Display errors inside the modal
            }
        });
    });

    });
</script>
    @endsection
@push('scripts')
    <!-- apexcharts -->
    <scrip src="{{asset('assets/login/libs/apexcharts/apexcharts.min.js')}}"></scrip>

    <!-- Vector map-->
    <script src="{{asset('assets/login/libs/jsvectormap/js/jsvectormap.min.js')}}"></script>
    <script src="{{asset('assets/login/libs/jsvectormap/maps/world-merc.js')}}"></script>

    <!-- Dashboard init -->
    <script src="{{asset('assets/login/js/pages/dashboard-analytics.init.js')}}"></script>

    <!-- App js -->
    <script src="{{asset('assets/login/js/app.js')}}"></script>
@endpush

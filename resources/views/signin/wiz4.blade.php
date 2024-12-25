<?php
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
?>
@extends('layouts.login.main')
@section('title', 'Wiz 4')
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
								<h4 class="fs-18 lh-base mb-0">Step 4 - Setup your <span class="text-success">Team</span> </h4>
								<p class="mb-3 mt-2 pt-1 text-muted">Enter the Team members helping you in managing your Programs.</p>
								<div class="d-flex pull-right mb-2">
									<button type="button" class="btn btn-light btn-label previestab" data-previous="steparrow-gen-info-tab"><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> Back</button>
									<button type="button" class="btn btn-primary btn-label right ms-auto nexttab nexttab" data-nexttab="steparrow-description-info-tab"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Finish</button>
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
                                                    <a href="{{ route('wiz2', ['locale' => app()->getLocale()]) }}"><button class="nav-link" id="steparrow-description-info-tab" data-bs-toggle="pill" data-bs-target="#steparrow-description-info" type="button" role="tab" aria-controls="steparrow-description-info" aria-selected="false">Objectives</button></a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a href="{{ route('wiz3', ['locale' => app()->getLocale()]) }}"><button class="nav-link" id="pills-experience-tab" data-bs-toggle="pill" data-bs-target="#pills-experience" type="button" role="tab" aria-controls="pills-experience" aria-selected="false">Programs</button></a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a href="{{ route('wiz4', ['locale' => app()->getLocale()]) }}"><button class="nav-link active" id="pills-experience-tab" data-bs-toggle="pill" data-bs-target="#pills-experience" type="button" role="tab" aria-controls="pills-experience" aria-selected="false">Team</button></a>
                                                </li>
                                            </ul>
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
                                        <div class="flex-shrink-0">
                                            <div class="text-muted"><span class="fw-semibold">2</span> of <span class="fw-semibold">5</span> remaining</div>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#exampleModalgrid"><i class="ri-add-line align-middle me-1"></i> Add Team Member</button>

										<!-- Modal Start -->
										<div class="modal fade" id="exampleModalgrid" tabindex="-1" aria-labelledby="exampleModalgridLabel">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalgridLabel">Add Program</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="javascript:void(0);">
                                                            <div class="row g-3">
                                                                <div class="col-xxl-6">
                                                                    <div>
                                                                        <label for="firstName" class="form-label">Program Name</label>
                                                                        <input type="text" class="form-control" id="Program" placeholder="Enter Program Name">
                                                                    </div>
                                                                </div>
                                                                <!--end col-->
                                                                <div class="col-xxl-6">

                                                                        <label for="lastName" class="form-label">Program Alignment to Strategic Outcome</label>
                                                                        <select class="form-select" id="country" required>
                                                                            <option value="">Select...</option>
                                                                            <option>Objective 1</option>
                                                                            <option>Objective 2</option>
                                                                        </select>
                                                                        <div class="invalid-feedback">Please select an Objective</div>

                                                                </div>
                                                                <!--end col-->
                                                                <div class="col-lg-12">
                                                                   <div class="form-check mb-2">
                                                                    <input type="checkbox" class="form-check-input" id="same-address">
                                                                    <label class="form-check-label" for="same-address">This Proram has Sub-Programs</label>
                                                                </div>
                                                                </div>
                                                                <!--end col-->
                                                                <div class="col-xxl-6">
                                                                    <div class="col-xxl-6">
                                                                        <label for="lastName" class="form-label">Program Manager</label>
                                                                        <select class="form-select" id="country" required>
                                                                            <option value="">Select...</option>
                                                                            <option>Objective 1</option>
                                                                            <option>Objective 2</option>
                                                                        </select>
                                                                        <div class="invalid-feedback">Please select an Objective</div>
                                                                    </div>
                                                                </div>
                                                                <!--end col-->
                                                                <div class="col-xxl-6">
                                                                    <label for="passwordInput" class="form-label">Password</label>
                                                                    <input type="password" class="form-control" id="passwordInput" value="451326546" placeholder="Enter password">
                                                                </div>
                                                                <!--end col-->
                                                                <div class="col-lg-12">
                                                                    <div class="hstack gap-2 justify-content-end">
                                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Submit</button>
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
									<div>
                                        <div class="table-responsive table-card mb-3">
                                            <table class="table align-middle table-nowrap mb-0" id="customerTable">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th class="sort" data-sort="name" scope="col">Name</th>
                                                        <th class="sort" data-sort="email_id" scope="col">Contact</th>
                                                        <th class="sort" data-sort="tags" scope="col">Role</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list form-check-all">
                                                    <tr>
                                                        <td class="name">
                                                            <div class="d-flex align-items-center">
                                                                <div class="flex-shrink-0"><img src="../assets/images/users/avatar-8.jpg" alt="" class="avatar-xs rounded-circle"></div>
                                                                <div class="flex-grow-1 ms-2 name">Khawar Javaid</div>
                                                            </div>
                                                        </td>
                                                        <td class="email_id">414-453-5725<br>
														tonyanoble@pwgs.com</td>
                                                        <td class="tags">
                                                            <span class="badge bg-primary-subtle text-primary">Manager</span>
                                                        </td>
                                                    </tr>
													<tr>
                                                        <td class="name">
                                                            <div class="d-flex align-items-center">
                                                                <div class="flex-shrink-0"><img src="../assets/images/users/avatar-8.jpg" alt="" class="avatar-xs rounded-circle"></div>
                       <?php
include("../config/config.php");


?>
<?php include '../layouts/main-diff-layouts.php'; ?>
<!doctype html>
<html lang="en" data-layout="horizontal" data-layout-style="" data-layout-position="fixed" data-topbar="light">

<head>

    <?php includeFileWithVariables('../layouts/title-meta.php', array('title' => 'Welcome')); ?>
                                         <div class="flex-grow-1 ms-2 name">Khawar Javaid</div>
                                                            </div>
                                                        </td>
                                                        <td class="email_id">414-453-5725<br>
														tonyanoble@pwgs.com</td>
                                                        <td class="tags">
                                                            <span class="badge bg-primary-subtle text-primary">Manager</span>
                       <?php
include("../config/config.php");


?>
<?php include '../layouts/main-diff-layouts.php'; ?>
<!doctype html>
<html lang="en" data-layout="horizontal" data-layout-style="" data-layout-position="fixed" data-topbar="light">

<head>

    <?php includeFileWithVariables('../layouts/title-meta.php', array('title' => 'Welcome')); ?>
                                 </td>
                                                    </tr>
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

												<script>
												$(document).ready(function() {
													$('#org_chart_select').change(function() {
														$("#org_chart_form").submit();
													});
													});
												</script>

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

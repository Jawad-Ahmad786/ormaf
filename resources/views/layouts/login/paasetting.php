<?php
if(isset($_POST['checkboxdefault'])&&isset($_POST['default_paa_id'])&&$_POST['default_paa_id']!="")
{
	$userOb = new classUser;
	$userOb->updateUserPaaSettingsToDefault($_POST['default_paa_id'],$_SESSION['security']['userID']);
}

if(isset($_POST['paa_id_for_risk_matrix'])&&isset($_POST['risk_matrix_type'])&&$_POST['risk_matrix_type']!="")
{
	$updateRiskMatrixTypeOb = new classUser;
	$updateRiskMatrixTypeOb->updateRiskMatrixType($_POST['paa_id_for_risk_matrix'],$_POST['risk_matrix_type']);
}

if(isset($_POST['corp_filter'])&&$_POST['corp_filter']!='')
{
	
	try
	{
		$userOb = new classUser;
		$userOb->updatePaaShowOrNot($_POST);
	}
	catch(MyException $e)
	{
		$error_message = $e->getUserMsg();
	}	
}

if(isset($_GET['dep_id'])||isset($_GET['so_id'])||isset($_GET['branch_id'])||isset($_GET['prog_id']))
{
	$urlRewriting = '&'; 
}
else
{
	$urlRewriting = '?';
}

if(isset($_GET['dep_id'])||isset($_GET['so_id'])||isset($_GET['branch_id'])||isset($_GET['prog_id']))
{
	if(isset($_GET['dep_id'])){$dep_id = $_GET['dep_id'];}else{$dep_id = 0;}
	
	if(isset($_GET['so_id'])){$so_id = $_GET['so_id'];}else{$so_id = 0;}
	
	if(isset($_GET['branch_id'])){$branch_id = $_GET['branch_id'];}else{$branch_id = "0";}
	
	if(isset($_GET['prog_id'])){$program_id = $_GET['prog_id'];}else{$program_id = 0;}
	
	$userOb = new classUser;
	$paaData = $userOb->getUserPaaSettings($dep_id,$so_id,$branch_id,$program_id);
	$paa_id = $paaData[0]['paa_id'];
	$risk_matrix_type = $paaData[0]['risk_matrix_type'];
	
}
elseif(isset($_SESSION['paa_id'])&&$_SESSION['paa_id']!="")
{
	
	$paa_id = $_SESSION['paa_id'];
	$userOb = new classUser;
	$paaData = $userOb->getUserPaaSettingsByPaaID($paa_id);
	
	$dep_id = $paaData[0]['department_id'];
	$so_id = $paaData[0]['so_id'];
	$branch_id = $paaData[0]['branch_id'];
	$program_id = $paaData[0]['program_id'];
	
	$risk_matrix_type = $paaData[0]['risk_matrix_type'];
}
else
{
	
	$userOb = new classUser;
	$user_id = $userOb->retrieveOwnerIDOfTeamMember($_SESSION['security']['userID']);	
	if(isset($user_id)&&$user_id!='')
	{
		
	}
	else
	{
		
		$user_id = $_SESSION['security']['userID'];
	}
	
	$userOb = new classUser;
	$paaData = $userOb->getUserDefaultPaaSettings($user_id,1);
	
	$paa_id = $paaData[0]['paa_id'];
	$dep_id = $paaData[0]['department_id'];
	$so_id = $paaData[0]['so_id'];
	$branch_id = $paaData[0]['branch_id'];
	$program_id = $paaData[0]['program_id'];
	
	$risk_matrix_type = $paaData[0]['risk_matrix_type'];
}

$retrievePAAOb = new classRetrievePAA;
$allDetails = $retrievePAAOb->retrieveDetailOfAnyType($dep_id,$so_id,$branch_id,$program_id);

$_SESSION['paa_id'] = $paa_id;

$userOb = new classUser;
$paaDataForCorp = $userOb->getUserPaaSettings($allDetails[0]['department_id'],0,0,0);

$_SESSION['corp_paa_id'] = $paaDataForCorp[0]['paa_id'];
$corp_paa_id = $_SESSION['corp_paa_id'];

$_SESSION['corp_risk_matrix_type'] = $paaDataForCorp[0]['risk_matrix_type'];
$corp_risk_matrix_type = $_SESSION['corp_risk_matrix_type'];


##################### VISITOR INFORMATION ##############################

$visitorOb = new classAddVisitor;
$visitorOb->setOwnerID($_SESSION['security']['userID']);
$visitorDetails = $visitorOb->retrieveVisitorByOwnerID();

$retrieveVisitorOb = new classAddVisitor;
$retrieveVisitorOb->setEmailAddress($_SESSION['security']['email']);
$visitor_data_array = $retrieveVisitorOb->retrieveVisitorByEmailAndType();

if($paaData[0]['user_id']!=$_SESSION['security']['userID'])
{
	$sharedDataOb = new classShareData;
	$sharedDataOb->setVisitorID($visitor_data_array[0]['visitor_id']);
	$shared_access = $sharedDataOb->retrieveSharedPrograms();
	
	define('access',$shared_access[0]['access']);
	define('pms_share',$shared_access[0]['performance']);
	define('rm_share',$shared_access[0]['risk']);
}
else
{
	define('access',1);
	define('pms_share',pms_module);
	define('rm_share',rm_module);
}

/*echo '<pre>';
print_r($visitorDetails);
echo '</pre>';*/
	
?>

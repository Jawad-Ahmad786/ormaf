<?php 
include("../config/config.php"); 
include("paasetting.php"); 


if((isset($allDetails[0]['so_name'])||isset($allDetails[0]['branch_name'])||isset($allDetails[0]['program_name'])||isset($allDetails[0]['subprog_name'])))
{ 
	try
	{
		$retrievePAAOb = new classRetrievePAA;
		$retrievePAAOb->setUserID($_SESSION['security']['userID']);			
		$departments = $retrievePAAOb->retrieveDepartmentDetailByUserID();
		
		$userOb = new classUser;
		$paaData = $userOb->getUserPaaSettings($departments[0]['department_id'],0,0,0);
		$paa_id = $paaData[0]['paa_id'];
		$risk_matrix_type = $paaData[0]['risk_matrix_type'];
		
		$retrievePAAOb = new classRetrievePAA;
		$allDetails = $retrievePAAOb->retrieveDetailOfAnyType($departments[0]['department_id'],0,0,0);
	}
	catch(MyException $e)
	{
		$error_message = $e->getUserMsg();
	}
}

try
{
	$progOb = new classRetrievePAA;
	$progOb->setDepartmentID($allDetails[0]['department_id']);
	$countProgram = $progOb->countProgramsOfDepartment();
	$countSubPrograms = $progOb->countSubProgramsOfDepartment();
}
catch(MyException $e)
{
	$error_message = $e->getUserMsg();
}


################################################# Task and calender ###################################################
try
{
	$retrieveTaskOb = new classCalender;
	$retrieveTaskOb->setTaskResponsiblePerson($visitor_data_array[0]['visitor_id']);
	$task_array = $retrieveTaskOb->retrieveTasks();
	
	//if(isset($task_array[0]))
	//{
		$no_of_task = count((array)$task_array);
	//}
	
	$retrieveTaskOb = new classCalender;
	$retrieveTaskOb->setTaskResponsiblePerson($visitor_data_array[0]['visitor_id']);
	$retrieveTaskOb->setStartTime(time());
	$retrieveTaskOb->setEndTime(strtotime('+30 days',time()));
	$upcoming_task_array = $retrieveTaskOb->retrieveUpcomingTasks();
	
	//$no_of_upcoming_task = count($upcoming_task_array);
}
catch(MyException $e)
{
	$error_message = $e->getUserMsg();
}

if(rm_module&&rm_share)
{
	################################################### retrieve Objectives and risks ######################################
	
	try
	{
		$retrieveObjectivesOb = new classRiskAssesment;
		$retrieveObjectivesOb->setPaaID($paa_id);
		$objectives_array = $retrieveObjectivesOb->retrieveObjectives();
	
		if($risk_matrix_type==0)
		{
			$userOb = new classUser;
			$paaDataForRiskMatrix = $userOb->getUserPaaSettings($allDetails[0]['department_id'],0,0,0);
			$paa_id_for_risk_matrix = $paaDataForRiskMatrix[0]['paa_id'];
			$risk_matrix_type_for_scorecard = $paaDataForRiskMatrix[0]['risk_matrix_type'];
		}
		else
		{
			$risk_matrix_type_for_scorecard = $risk_matrix_type;
		}
	
	}
	catch(MyException $e)
	{
		$error_message = $e->getUserMsg();
	}
	
	
	/////////////////////////////retrieve risks by type////////////////////////
	try
	{
		$no_of_risks='0';
		
		$retrieveObjectivesOb = new classRiskAssesment;
		$retrieveObjectivesOb->setPaaID($paa_id);
		$objectives_array = $retrieveObjectivesOb->retrieveObjectives();
		$show_risk_chart = 0;
		for($i=0;$i<count($objectives_array);$i++)
		{
			$retrieveObjectiveRisksOb = new classRiskAssesment;
			$retrieveObjectiveRisksOb->setObjectiveID($objectives_array[$i]['objective_id']);
			$objective_risks_count = $retrieveObjectiveRisksOb->retrieveObjectiveRisks();
			
			$no_of_risks += count($objective_risks_count);
			
			if(isset($objective_risks_count[0]['risk_level'])&&$objective_risks_count[0]['risk_level']!='')
			{
				$show_risk_chart = 1;
			}
		}
	}
	catch(MyException $e)
	{
		$error_message = $e->getUserMsg();
	}
}

/*echo '<pre>';
print_r($departments);
echo '</pre>';
exit;*/

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/summary.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ORMAF - Online Performance and Risk Management Accountability Framework</title>
<meta name="description" content="ORMAF is an innovative web application specifically designed for Canadian public sector managers to effectively and efficiently respond to the requirements and expectations of Treasury Board of Canada Secretariat (TBS)...!">
<meta name="keywords" content="performance measurement, performance measurement software, performance measurement application, performance measurement strategy, canada, canadian public sector, canadian government, performance management, logic model, risk management, risk assessment, risk management software, risk landscape, results management, accountability, framework, management accountability framework, risk monitoring, performance monitoring, audit monitoring, audit plan, evaluation plan, evaluation framework, project risk analysis, program risk analysis, performance indicators, performance measurement strategy implementation">
  
<link rel="icon" href="../images/favicon.ico">

<link rel="stylesheet" type="text/css" href="org_chart/css/chart.css">
<link rel="stylesheet" type="text/css" href="css/summary.css" />
<link rel="stylesheet" type="text/css" href="css/tableshorter-theme.css" /> 
<link rel="stylesheet" type="text/css" href="css/generic_signin.css" />
<link rel="stylesheet" type="text/css" href="css/top_menu_signin.css" />
<link rel="stylesheet" type="text/css" href="popUp/popUp.css" />
<link rel="stylesheet" type="text/css" href="css/mbExtruder.css" />
 
<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="js/mbExtruder.js"></script> 
<script type="text/javascript" src="js/ajax.js"></script>
<script type="text/javascript" src="popUp/popUp.js"></script>
<script type="text/javascript" src="org_chart/js/jquery_002.js"></script>

<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
</tr>
  <tr>
    <td><?php include("header_summary.php") ?></td>
  </tr>
  <tr>
    <td>
      <table width="80%" border="0" align="center" cellspacing="10" cellpadding="10">
        <tr>
          <td><!-- InstanceBeginEditable name="centretext" -->
            
            <link rel="stylesheet" href="datepicker/jquery-ui.css">
            
            <script type="text/javascript" src="js/jquery-ui.js"></script>
            
			<script>
			function calnderWinOpen()
			{
				window.open("calender.php","Calender","toolbar=no, scrollbars=yes, resizable=yes, top=300,addressbar=no, left=200, width=750, height=600");
			}
			</script>
            
			<script>
			$(function() {
				$("#datepicker").datepicker({
				showOn: "button",
				buttonImage: "images/calendar.gif",
				buttonImageOnly: true,
				changeMonth: true,
				changeYear: true,
				dateFormat: "yy-mm-dd",
				minDate:0
				
				});
			});
			</script>
            
            <?php
         	if(isset($_GET['showtask']))
 			{
				$singleTaskOb = new classCalender;
				$singleTaskOb->setTaskID($_GET['showtask']);
				$task_detail_array = $singleTaskOb->retrieveTaskByTaskID();
				
				$visitorOb = new classAddVisitor;
				$visitorOb->setVisitorID($task_detail_array[0]['resp_person']);
				$visitorInfo = $visitorOb->retrieveVisitorByVisitorID();
													
				$userOb = new classUser;
				$paaData = $userOb->getUserPaaSettingsByPaaID($task_detail_array[0]['paa_id']);
				
				$dep_id = $paaData[0]['department_id'];
				$so_id = $paaData[0]['so_id'];
				$branch_id = $paaData[0]['branch_id'];
				$program_id = $paaData[0]['program_id'];
				
				$retrievePAAOb = new classRetrievePAA;
				$allDetails = $retrievePAAOb->retrieveDetailOfAnyType($dep_id,$so_id,$branch_id,$program_id);
				//print_r($task_detail_array);
        		?>
                
        		<div class="add-indicator-popup" style="left:20%;">
                
                <div class="close_pop">
                 	<span>Task Details</span>
                    <a href="<?php echo str_replace($urlRewriting.'showtask='.$_GET['showtask'],' ',$_SERVER['REQUEST_URI'])?>" style="float:right;">Close X</a>
                </div>
                
                <div id="result_update_task_due_date_form" style="margin:10px;"></div>
                
                <table width="100%" cellpadding="0" cellspacing="0">
                
                    <tr>
                        <td><table width="100%" border="0" cellspacing="1" cellpadding="1" style="border-top:1px solid #f3f3f3; border-bottom:1px solid #f3f3f3;background:#FAFAFA; color:#000;">
                        <tr>
                            <td width="15%" class="smallcaps_blue">Department:</td>
                            <td width="85%" class="smallcaps_black"><?php if(isset($allDetails[0]['department_name'])){echo $allDetails[0]['department_name']; } ?></td>
                            <!--<td width="15%" align="center">&nbsp;</td>-->
                        </tr>
                        <?php
                        if(isset($allDetails[0]['so_name'])&&$allDetails[0]['so_name']!='')
                        {
                            ?>
                            <tr>
                            <td class="smallcaps_blue">Strategic Outcome:</td>
                            <td class="smallcaps_black"><?php echo $allDetails[0]['so_name'];?></td>
                            <!--<td width="10%">&nbsp;</td>-->
                            </tr>
                            <?php
                        }
                        elseif(isset($allDetails[0]['branch_name'])&&$allDetails[0]['branch_name']!='')
                        {
                            ?>
                            <tr>
                            <td class="smallcaps_blue">Branch:</td>
                            <td class="smallcaps_black"><?php echo $allDetails[0]['branch_name'];?></td>
                            <!--<td width="10%">&nbsp;</td>-->
                            </tr>
                            <?php  
                        }
                        
                        if(isset($allDetails[0]['program_name'])&&$allDetails[0]['program_name']!='')
                        {
                            ?>
                            <tr>
                            <td class="smallcaps_blue">Program:</td>
                            <td class="smallcaps_black"><?php  echo $allDetails[0]['program_name']; ?></td>
                            <!--<td width="10%">&nbsp;</td>-->
                            </tr>
                            <?php
                        }
                        
                        if(isset($allDetails[0]['subprog_name'])&&$allDetails[0]['subprog_name']!='')
                        { 
                            ?>
                            <tr>
                            <td class="smallcaps_blue">Sub-Program/Activity:</td>
                            <td class="smallcaps_black"><?php echo $allDetails[0]['subprog_name']; ?></td>
                            <!--<td width="10%">&nbsp;</td>-->
                            </tr>
                            <?php
                        }
                        ?>
                        </table></td>
                    </tr>

                    <tr>
                        <td><h3 style="color:#276486; font-size:16px;"><?php echo $task_detail_array[0]['task_heading'];?></h3></td>
                    </tr>
                    
                    <tr>
                        <td><strong>Task Description :</strong> <?php echo $task_detail_array[0]['task_description'];?></td>
                    </tr>
                    
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    
                    <tr>
                        <td><strong>Responsible Person :</strong> <?php echo $visitorInfo[0]['first_name'].' '.$visitorInfo[0]['last_name'];;?></td>
                    </tr>
                    
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    
                    <tr>
                   
                        <td>
                        <form method="post" class="signin" id="update_task_due_date_form"  style="clear:both;" onsubmit="return false;">
                        <fieldset class="textbox">
                        
                            <label class="password" style="float:left; width:25%;">
                            <span>Due Date</span>
                            <input type="text" name="due_date" id="datepicker" value="<?php echo date('Y M d',$task_detail_array[0]['due_date']);?>">
                            </label>
                            <input name="task_id" type="hidden" value="<?php echo $_GET['showtask']; ?>" />
                            <input name="update_due_date" type="hidden" value="Update" />
                            
                            <input name="ajax_submit" type="submit" class="btn_pop ajax_submit" value="Update" style="float:left; margin-top:15px;"/>
                        </fieldset>
                        </form>
                        </td>
                    </tr>
                    
                </table>
        		
                </div>
        		<?php
    		}
			
			
			if(isset($_GET['rmpriority_id'])&&$_GET['rmpriority_id']!="")
			{
				$priority_id =  $_GET['rmpriority_id'];  
				$riskOb = new classRiskAssesment;
				$riskOb->setRiskID($priority_id);
				$priority_details = $riskOb->retrieveObjectiveRisksByRiskID();
				?>                    
				<div class="change_priority_rm-popup">
							
					<div class="close_pop">
						<span>Change Priority</span>
						<a href="<?php echo str_replace($urlRewriting.'rmpriority_id='.$_GET['rmpriority_id'],' ',$_SERVER['REQUEST_URI'])?>" style="float:right;">Close(X)</a>
					</div>
					
					<div id="result_change_priority_form" style="margin:10px;"></div>
				
					<form method="post" class="signin" id="change_priority_form" action="" style="clear:both;" onsubmit="return false;">
						<fieldset class="textbox">
						
							<label class="password">
							<span>Priority</span>
								<input type="radio" name="priority" value="high" style="width:20px;" <?php if($priority_details[0]['priority']=='high'){echo 'checked';}?> /><img src="images/buttonred.png">
							</label>
							
							<label class="password">
								<input type="radio" name="priority" value="medium" style="width:20px;" <?php if($priority_details[0]['priority']=='medium'){echo 'checked';}?> /><img src="images/buttonyellow.png">
							</label>
							
							<label class="password">
								<input type="radio" name="priority" value="low" style="width:20px;"  <?php if($priority_details[0]['priority']=='low'){echo 'checked';}?>/><img src="images/buttongreen.png">
							</label>
								
							<input name="priority_id" type="hidden" value="<?php echo $_GET['rmpriority_id']; ?>" />
							
							<input name="change_priority_risk" type="hidden" value="change" />
							<input name="ajax_submit" type="submit" class="btn_pop ajax_submit" value="Change" />
							
						</fieldset>
					 </form>
					 
				</div>
				<?php
			}
			
			
        	if(isset($error_message)&&$error_message!="")
        	{
				?>
				<span class="message_red"><?php echo $error_message;?></span>
				<?php
        	}
        
		  	?>          
        
        	<table width="100%" border="0" cellspacing="5" cellpadding="5">
            <tr> 
             
                <td><table width="100%" cellspacing="0" cellpadding="0">
                        <tr>
                            <td><?php include("sum_includedh.php") ?></td>
                    	</tr>
            	</table></td>
                
            </tr>
            </table>
            
            <div id="add-groupmember-box" class="add-groupmember-popup" style="width:33%;">
            
                <?php
                $visitorOb = new classAddVisitor;
                $visitorOb->setOwnerID($_SESSION['security']['userID']);
                $visitorDetails = $visitorOb->retrieveSystemUserVisitorsByOwnerID();
                
				
				$getGroupMemberOb = new classShareData;
				$getGroupMemberOb->setUserID($_SESSION['security']['userID']); 
				$getGroupMemberOb->setPaaID($paa_id); 
				$group_members_array = $getGroupMemberOb->retrieveGroupMembers();
                
				?>
            
                <div class="close_pop"><span>Add Group Members</span><a href="#" class="close" style="float:right;">X</a></div>
            
                <div id="result_sharing_form" style="margin:10px;"></div>
            
            
                <form method="post" class="signin" id="sharing_form"  style="clear:both;" onsubmit="return false;">
                <fieldset class="textbox">
                
                <label class="username"><span>Responsible Person</span>
                    <select name="responsible_party" class="style_box" style="width: 235px;">
                    
                        <?php
                        for($i=0;$i<count($visitorDetails);$i++)
                        {
							if($visitorDetails[$i]['email']!=$_SESSION['security']['email'])
							{
								?>
								<option value="<?php echo $visitorDetails[$i]['visitor_id'];?>"><?php echo $visitorDetails[$i]['first_name'].' '.$visitorDetails[$i]['last_name'];?></option>
								<?php
							}
                        }
                        ?>
                    </select>
                    <span><a href="acc_visitors.php">Add System User or Visitor</a></span>
                </label>
                
                <label class="password">
                	<span>Select Module</span>
                    <?php
					if(pms_module&&!pms_free_trial)
					{
						?>
						<input type="checkbox" name="module[]" value="performance" />Performance
						<?php
					}
					if(rm_module&&!rm_free_trial)
					{
						?>
						<input type="checkbox" name="module[]" value="risk" style="margin-left:10px;" />Risk
						<?php
					}
					?>
                </label>
                
                 
                <label class="password">
                
                    <span>Group Members</span>
                    <div style="border:1px solid #e5e5e5; width:98%; height:180px; padding-left: 7px; padding-top: 7px;">
                    <table>
                    <?php
					if(isset($group_members_array[0])&&$group_members_array[0]!='')
					{
						for($mem=0;$mem<count($group_members_array);$mem++)
						{
							?>
							<tr>
								<td>
                              <img src="images/bluebullet.png" />
								<?php 
								$visitorOb = new classAddVisitor;
								$visitorOb->setVisitorID($group_members_array[$mem]['visitor_id']);
								$visitorInfo = $visitorOb->retrieveVisitorByVisitorID();
								
								echo ucwords($visitorInfo[0]['first_name'].' '.$visitorInfo[0]['last_name']);
								?>
                              
                                </td>
							</tr>
							<?php
						}
					}
					else
					{
						?>
							<tr>
								<td>No group member added yet.</td>
							</tr>
							<?php
					}
					
					?>
                    </table>
                    </div>
                    
                </label>
                
              
                <input type="hidden" name="user_id" value="<?php echo $_SESSION['security']['userID'];?>" />
                <input type="hidden" name="paa_id" value="<?php echo $paa_id;?>" />
                
                <input type="hidden" name="add_member" value="ADD" />
                <input name="ajax_submit" type="submit" class="btn_pop ajax_submit" value="Add" />
                
                </fieldset>
                </form>
            
            </div>

            <div id="side_tree_dept-box" class="side_tree_dept-popup">
                <div class="close_pop">
                    <span>Select Another Program Or Department</span>
                    <a href="#" class="close" style="float:right; margin-left:10px;">Close (X)</a>
                </div>
                <?php include("tree_menu/sidetree_step1.php"); ?>
            </div>	 
            
            <div id="change_priority_lm-box" class="change_priority_lm-popup">
            
    <div class="close_pop">
        <span>Change Priority</span>
       	<a href="#" class="close" style="float:right;">Close (X)</a>
    </div>
    
    <div id="result_change_priority_form" style="margin:10px;"></div>

    <form method="post" class="signin" id="change_priority_form" action="" style="clear:both;" onsubmit="return false;">
        <fieldset class="textbox">
        
            <label class="password">
            <span>Priority</span>
                <input type="radio" name="priority" id="component_priority_high" value="high" style="width:20px;"/><img src="images/buttonred.png">
            </label>
            
            <label class="password">
                <input type="radio" name="priority" id="component_priority_medium" value="medium" style="width:20px;"/><img src="images/buttonyellow.png">
            </label>
            
            <label class="password">
                <input type="radio" name="priority" id="component_priority_low" value="low" style="width:20px;"/><img src="images/buttongreen.png">
            </label>
                
            <input name="component_id" id="component_id" type="hidden" value="" />
            <input name="change_priority_lm" type="hidden" value="change" />
            <input name="ajax_submit" type="submit" class="btn_pop ajax_submit" value="Change" />
            
        </fieldset>
     </form>
     
</div>


			<script>
$(".change_priority_lm").click(function() {
	
	var id = this.id;
	//alert(id);
	component_id = $("#component_id_"+id).val();
	component_priority = $("#component_priority_"+id).val();
	
	$("#component_id").val(component_id);
	
	if(component_priority=='high')
	{
		$("#component_priority_high").attr('checked','checked');
	}
	if(component_priority=='medium')
	{
		$("#component_priority_medium").attr('checked','checked');
	}
	if(component_priority=='low')
	{
		$("#component_priority_low").attr('checked','checked');
	}
	
	
	
});
</script>  
            
         <!-- InstanceEndEditable --></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
  <td align="center"><?php include("footer_summary.php") ?> </td>
  </tr>
</table>

 
</body>
<!-- InstanceEnd --></html>
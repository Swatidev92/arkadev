<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php
$action_message ='';
$pid = $_GET['id'];
if($_SESSION['REFERER_page']==''){
	$_SESSION['REFERER_page']=$_SERVER['HTTP_REFERER'];
}

if($cms->is_post_back()){
	$statusLeadQry = $cms->db_query("SELECT to_user, to_admin FROM #_lead_type_status where constant=".$_POST['status']." and lead_type=1 ");
	$statusLeadRes = $statusLeadQry->fetch_array();
	
	//print_r($_POST);die;
	if($_POST['automatic']=='on'){
		$_POST['automatic'] = 1;
	}else{
		$_POST['automatic'] = 0;
	}
	$_POST["selected_reasons"]=implode("$#",$_POST["selected_reasons"]);
	$_POST['proposal_address'] = $_POST['address_input'];
	if($_POST['assigned_to']!='' && $_POST['status']==1){
		$_POST['status'] = 2;
	}
	$leadsStatusArr = getAllStatus();
	if($pid){ 
		//$_POST['created_date'] =  date("H:i a");
		$_POST["update_date"] = date("Y-m-d h:i:s");
		if($assigned_to){
			$_POST["assigned_date"] = date("Y-m-d h:i:s");
		}
		/*if($_POST['assigned_to']=='' && $_POST['status']==2){
			echo "<script>alert('Select user also')</script>";
			$path = SITE_PATH_ADM.CPAGE.'?mode=add&start=&id='.$pid;
			$cms->redir($path, true);
		}*/
		
		$cms->sqlquery("rs","leads",$_POST, 'id', $pid);
		if(!empty($_POST["lead_comment"])){
			$_CommentPoast["lead_comment"] = $_POST["lead_comment"]?$_POST["lead_comment"]:"No Comment";
			$_CommentPoast["lead_id"] = $pid;
			$_CommentPoast["post_date"] = date('Y-m-d h:i:s');			
			$_CommentPoast["post_by"] = $_SESSION["ses_adm_id"];
			$cms->sqlquery("rs","lead_comments",$_CommentPoast);
		}
		if($old_assigned_to!=$assigned_to){
			$assignedTo =  $cms->getSingleResult("SELECT customer_name FROM #_users WHERE id='".$assigned_to."'");
			$action_message="Assigned to ".$assignedTo;
			
			$_POSTS["lead_id"] = $pid;
			$_POSTS["action_message"] = $action_message;
			$_POSTS["action_date"] = date('Y-m-d h:i:s');
			$_POSTS["action_by"] = $_SESSION["ses_adm_id"];
			$_POSTS["action"] = $_POST["status"];
			$cms->sqlquery("rs","lead_tracker",$_POSTS);
		}
		$old_status=$_POST['old_status'];
		$status=$_POST['status'];
		if($old_status!=$status){
			$action_message="Status Changed from <b>".$leadsStatusArr[$old_status]."</b> to <b>".$leadsStatusArr[$status]."</b>";
			
			$_POSTS["lead_id"] = $pid;
			$_POSTS["action_message"] = $action_message;
			$_POSTS["action_date"] = date('Y-m-d h:i:s');
			$_POSTS["action_by"] = $_SESSION["ses_adm_id"];
			$_POSTS["action"] = $_POST["status"];
			$cms->sqlquery("rs","lead_tracker",$_POSTS);
			
			//updated status mail to user
			if($statusLeadRes['to_user']){
				$assignedQry = $cms->db_query("SELECT customer_name, email_id FROM #_users WHERE id='".$_POST['assigned_to']."'");
				$assignedRes = $assignedQry->fetch_array();
				$subject='Status Updated';			
				$msg_body='<div>Hi '.$assignedRes['customer_name'].',</div>
						   <div>&nbsp;</div>
						   <div>Status has been changed from <b>'.$leadsStatusArr[$old_status].'</b> to <b>'.$leadsStatusArr[$status].'</b> for customer <b>'.$_POST['customer_name'].'</b></div>
						   <div>&nbsp;</div>
						   <div><b>Regards,<br>Arka</b></div>';
					   
				$email_msg=emailFormat($msg_body);
				
				$to=$assignedRes['email_id'];
				$resReturn = sendEmail($to, $subject,$email_msg);
			}
			
			//updated status mail to Admin 
			if($statusLeadRes['to_admin']){
				$subject='Status Updated';			
				$msg_body='<div>Hi Admin,</div>
						   <div>&nbsp;</div>
						   <div>Status has been changed from <b>'.$leadsStatusArr[$old_status].'</b> to <b>'.$leadsStatusArr[$status].'</b> for customer <b>'.$_POST['customer_name'].'</b></div>
						   <div>&nbsp;</div>
						   <div><b>Regards,<br>Arka</b></div>';
					   
				$email_msg=emailFormat($msg_body);
				
				$to = $settingArr['to_emails'];
				$resReturn = sendEmail($to, $subject,$email_msg);
			}
			
			if(!empty($accessUserArr) && ($old_status!=$status && $_POST['old_status']!=9 && $_POST['status']==9)){
				foreach($accessUserArr as $uid){
					$userQry = $cms->db_query("SELECT id, email_id, customer_name FROM #_users where id=$uid ");
					if($userQry->num_rows>0){
						$userRes = $userQry->fetch_array();
						$_POSTS["lead_id"] = $pid;			
						$_POSTS["action_message"] = '';
						$_POSTS["action_date"] = date('Y-m-d h:i:s');
						$_POSTS["action_by"] = $userRes["id"];
						$_POSTS["activity_message"] = "Dimensioning requested";
						$_POSTS["due_date"] = date('Y-m-d');
						//print_r($_POSTS);die;
						$cms->sqlquery("rs","lead_tracker",$_POSTS);
						
						if(!empty($_POST["lead_comment"])){
							$_CommentPoast["lead_comment"] = $_POST["lead_comment"]?$_POST["lead_comment"]:"No Comment";
							$_CommentPoast["lead_id"] = $pid;
							$_CommentPoast["post_date"] = date('Y-m-d h:i:s');			
							$_CommentPoast["post_by"] = $userRes["id"];
							$cms->sqlquery("rs","lead_comments",$_CommentPoast);
						}
						
						//send mail to dimensioning user
						$subject='Status Updated';			
						$msg_body='<div>Hi '.$userRes['customer_name'].',</div>
							   <div>&nbsp;</div>
							   <div>Dimensioning requested for customer <b>'.$_POST['customer_name'].'</b></div>
							   <div>&nbsp;</div>
							   <div><b>Regards,<br>Arka</b></div>';
							   
						$email_msg=emailFormat($msg_body);
						
						$to = $userRes['email_id'];
						$resReturn = sendEmail($to, $subject,$email_msg);
					}
				}
			}
		}
		
		if(!empty($_POST['activity_message'])){
			$_POSTS["lead_id"] = $pid;			
			$_POSTS["action_message"] = '';
			$_POSTS["action_date"] = date('Y-m-d h:i:s');
			$_POSTS["action_by"] = $_SESSION["ses_adm_id"];
			$_POSTS["activity_message"] = $_POST['activity_message'];
			$_POSTS["due_date"] = ($_POST['due_date']?$_POST['due_date']:date('Y-m-d'));
			//print_r($_POSTS);die;
			$cms->sqlquery("rs","lead_tracker",$_POSTS);
			
			//updated activity mail send
			/*$assignedQry = $cms->db_query("SELECT customer_name, email_id FROM #_users WHERE id='".$_POST['assigned_to']."'");
			$assignedRes = $assignedQry->fetch_array();
			$subject='New activity';			
			$msg_body='<div>Hi '.$assignedRes['customer_name'].',</div>
					   <div>&nbsp;</div>
					   <div>Activity - <b>'.$_POST['activity_message'].'</b> for customer <b>'.$_POST['customer_name'].'</b></div>
					   <div>Due Date - <b>'.$_POSTS["due_date"].'</b> for customer <b>'.$_POST['customer_name'].'</b></div>
					   <div>&nbsp;</div>
					   <div><b>Regards,<br>Arka</b></div>';
				   
			$email_msg=emailFormat($msg_body);
				
			$to=$assignedRes['email_id'];
			$resReturn = sendEmail($to, $subject,$email_msg); */
			
			//send mail to admin/agent and dimensioning access user
			if($_POST['activity_send_to']){
				//print_r($_POST['activity_send_to']);die;
				foreach($_POST['activity_send_to'] as $udata){
					$userinfo = explode('|',$udata);
								
					$_POSTS["lead_id"] = $pid;			
					$_POSTS["action_message"] = '';
					$_POSTS["action_date"] = date('Y-m-d h:i:s');
					$_POSTS["action_by"] = $userinfo[0];
					$_POSTS["activity_message"] = $_POST['activity_message'];
					$_POSTS["due_date"] = ($_POST['due_date']?$_POST['due_date']:date('Y-m-d'));
					//print_r($_POSTS);die;
					$cms->sqlquery("rs","lead_tracker",$_POSTS);
					
					//updated activity mail send
					$assignedQry = $cms->db_query("SELECT customer_name, email_id FROM #_users WHERE id='".$_POST['assigned_to']."'");
					$assignedRes = $assignedQry->fetch_array();
					$subject='New activity';			
					$msg_body='<div>Hi '.$assignedRes['customer_name'].',</div>
							   <div>&nbsp;</div>
							   <div>Activity - <b>'.$_POST['activity_message'].'</b> for customer <b>'.$_POST['customer_name'].'</b></div>
							   <div>Due Date - <b>'.$_POSTS["due_date"].'</b> for customer <b>'.$_POST['customer_name'].'</b></div>
							   <div>&nbsp;</div>
							   <div><b>Regards,<br>Arka</b></div>';
						   
					$email_msg=emailFormat($msg_body);
						
					$to = $userinfo[1];
					$resReturn = sendEmail($to, $subject,$email_msg);
				}
			}			
		}
		
		if($_POST['old_status']!=$_POST['status'] && $_POST['old_status']==1 && $_POST['status']==2){
			//add in activity when new lead assigned 
			$_POSTS["lead_id"] = $pid;
			$_POSTS["action_message"] = '';
			$_POSTS["action_date"] = date('Y-m-d h:i:s');
			$_POSTS["action_by"] = $_POST["assigned_to"];
			$assignedTo =  $cms->getSingleResult("SELECT customer_name FROM #_users WHERE id=".$_POST["assigned_to"]." ");
			$_POSTS["activity_message"] = 'Lead assigned to '.$assignedTo;
			$_POSTS["due_date"] = date('Y-m-d');
			//print_r($_POSTS);die;
			$cms->sqlquery("rs","lead_tracker",$_POSTS);
		}
		$adm->sessset('Record has been updated', 's');
		
	} else {
		$_POST['created_date'] =  date("H:i a");
		//$_POST["created_date"] = date("Y-m-d h:i:s");
		$_POST["update_date"] = date("Y-m-d h:i:s");
		$_POST["post_date"] = date("Y-m-d");
		$_POST["post_by"] = $_SESSION["ses_adm_id"];
		$_POST["lead_type"] = 1;
		//$_POST["form_type"] = 4;		
		$_POST["post_by"] = $_SESSION["ses_adm_id"];
		//$_POST["assigned_to"] = $_SESSION["ses_adm_id"];
		$lead_insert_id=$cms->sqlquery("rs","leads",$_POST);	
		
		$POSTARR["lead_unique_id"] = generateLeadId($lead_insert_id);
		$cms->sqlquery("rs","leads",$POSTARR, 'id', $lead_insert_id);
		
		if((!empty($_POST["lead_date"]) && !empty($_POST["lead_time"])) || !empty($_POST["lead_comment"])){
			$_CommentPoast["lead_comment"] = $_POST["lead_comment"]?$_POST["lead_comment"]:"No Comment";
			$_CommentPoast["lead_id"] = $lead_insert_id;
			$_CommentPoast["post_by"] = $_SESSION["ses_adm_id"];
			$_CommentPoast["post_date"] = date('Y-m-d h:i:s');
			$_CommentPoast["visit_call"] = $_POST["visit_call"];
			$_CommentPoast["next_call_date"]=date("Y-m-d", strtotime($_POST["lead_date"]))." ".$_POST["lead_time"];
			
						
			$insert_comment=$cms->sqlquery("rs","lead_comments",$_CommentPoast);
		}
		if(empty($action_message)){
			$action_message ="New Lead added by ".$cms->getSingleResult("SELECT customer_name FROM #_users WHERE id='".$_SESSION["ses_adm_id"]."'").".";
			$_POSTS["lead_id"] = $lead_insert_id;
			$_POSTS["action_message"] = $action_message;
			$_POSTS["action_date"] = date('Y-m-d h:i:s');
			$_POSTS["action_by"] = $_SESSION["ses_adm_id"];
			$_POSTS["action"] = $_POST["status"];
			$cms->sqlquery("rs","lead_tracker",$_POSTS);
			
			if($_POST['old_status']!=$_POST['status'] && $_POST['old_status']==1 && $_POST['status']==2){
				//add in activity when new lead assigned 
				$_POSTS["lead_id"] = $lead_insert_id;
				$_POSTS["action_message"] = '';
				$_POSTS["action_date"] = date('Y-m-d h:i:s');
				$_POSTS["action_by"] = $_POST["assigned_to"];
				$assignedTo =  $cms->getSingleResult("SELECT customer_name FROM #_users WHERE id=".$_POST["assigned_to"]." ");
				$_POSTS["activity_message"] = 'Lead assigned to '.$assignedTo;
				$_POSTS["due_date"] = date('Y-m-d');
				//print_r($_POSTS);die;
				$cms->sqlquery("rs","lead_tracker",$_POSTS);
			}
		}
		$old_status=$_POST['old_status'];
		$status=$_POST['status'];
		
		if($old_status!=$status && $old_status!=''){
			$action_message="Status Changed from ".$leadsStatusArr[$old_status]." to ".$leadsStatusArr[$status];
			$_POSTS["lead_id"] = $lead_insert_id;
			$_POSTS["action_message"] = $action_message;
			$_POSTS["action_date"] = date('Y-m-d h:i:s');
			$_POSTS["action_by"] = $_SESSION["ses_adm_id"];
			$_POSTS["action"] = $_POST["status"];
			$cms->sqlquery("rs","lead_tracker",$_POSTS);
			
			//updated status mail to user
			if($statusLeadRes['to_user']){
				$assignedQry = $cms->db_query("SELECT customer_name, email_id FROM #_users WHERE id='".$_POST['assigned_to']."'");
				$assignedRes = $assignedQry->fetch_array();
				$subject='Status Updated';			
				$msg_body='<div>Hi '.$assignedRes['customer_name'].',</div>
						   <div>&nbsp;</div>
						   <div>Status has been changed from <b>'.$leadsStatusArr[$old_status].'</b> to <b>'.$leadsStatusArr[$status].'</b> for customer <b>'.$_POST['customer_name'].'</b></div>
						   <div>&nbsp;</div>
						   <div><b>Regards,<br>Arka</b></div>';
					   
				$email_msg=emailFormat($msg_body);
				
				$to=$assignedRes['email_id'];
				$resReturn = sendEmail($to, $subject,$email_msg);
			}
			
			//updated status mail to Admin 
			if($statusLeadRes['to_admin']){
				$subject='Status Updated';			
				$msg_body='<div>Hi Admin,</div>
						   <div>&nbsp;</div>
						   <div>Status has been changed from <b>'.$leadsStatusArr[$old_status].'</b> to <b>'.$leadsStatusArr[$status].'</b> for customer <b>'.$_POST['customer_name'].'</b></div>
						   <div>&nbsp;</div>
						   <div><b>Regards,<br>Arka</b></div>';
					   
				$email_msg=emailFormat($msg_body);
				
				$to = $settingArr['to_emails'];
				$resReturn = sendEmail($to, $subject,$email_msg);
			}
		}
		
		if(!empty($_POST['activity_message'])){
			$_POSTS["lead_id"] = $lead_insert_id;
			$_POSTS["action_message"] = '';
			$_POSTS["action_date"] = date('Y-m-d h:i:s');
			$_POSTS["action_by"] = $_SESSION["ses_adm_id"];
			$_POSTS["activity_message"] = $_POST['activity_message'];
			$_POSTS["due_date"] = ($_POST['due_date']?$_POST['due_date']:date('Y-m-d'));
			//print_r($_POSTS);die;
			$cms->sqlquery("rs","lead_tracker",$_POSTS);
			
			//updated status mail send
			$assignedQry = $cms->db_query("SELECT customer_name, email_id FROM #_users WHERE id='".$_POST['assigned_to']."'");
			$assignedRes = $assignedQry->fetch_array();
			$subject='Status Updated';			
			$msg_body='<div>Hi '.$assignedRes['customer_name'].',</div>
					   <div>&nbsp;</div>
					   <div>Activity - <b>'.$_POST['activity_message'].'</b> for customer <b>'.$_POST['customer_name'].'</b></div>
					   <div>Due Date - <b>'.$_POSTS["due_date"].'</b> for customer <b>'.$_POST['customer_name'].'</b></div>
					   <div>&nbsp;</div>
					   <div><b>Regards,<br>Arka</b></div>';
				   
			$email_msg=emailFormat($msg_body);
				
			$to=$assignedRes['email_id'];
			$resReturn = sendEmail($to, $subject,$email_msg);
		}
		$adm->sessset('Record has been added', 's');
	}
	
	/*if(isset($_GET['start']) && $_GET['start'] > 0) {
		$path = SITE_PATH_ADM.CPAGE."/index.php?start=".$_GET['start'];
	} else {
		$path = SITE_PATH_ADM.CPAGE;
	}
	*/
	
	$path = $_SESSION['REFERER_page'];
	
	$cms->redir($path, true);
}  

$rsAdmin = $cms->db_query("select * from #_leads where id='".$pid."'");
$arrAdmin = $rsAdmin->fetch_array(); 
@extract($arrAdmin);

if($proposal_type!='' && $proposal_type!=0){
	$address_input = $proposal_address;
}

$customerPriceQry = $cms->db_query("SELECT * FROM #_customer_price where id=1 ");
$customerPriceArr = $customerPriceQry->fetch_array(); 


if(in_array(11,$act_arr) && !in_array(3,$act_arr)){
	$readonly_field = 'readonly';
}else{
	$readonly_field = '';
}
?>
<!-- .row -->
<style>
.scroll_bar {
    max-height: 600px;
    overflow-y: auto;
}
.message-center .mail-contnet .mail-desc{
	text-overflow: inherit;
    overflow: inherit;
    white-space: normal;
}
.mg0{
	margin:0px;
}
</style>
<div class="row">
    <div class="col-sm-12">
		<?php if($pid){?>
		<div class="white-box panel-body">
			<div class="col-sm-6">
				<h2 class="mg0">Lead Date : <?=date("Y-m-d",strtotime($post_date))?></h2>
			</div>
			<div class="col-sm-6">
				<h2 class="mg0">Lead Form : <?=$cms->getSingleResult("SELECT lead_status FROM #_lead_type_status where constant=$form_type AND lead_type=2")?></h2>
			</div>
			<div class="clearfix"></div>
			<?php if($form_type==1){?>
			<div class="col-md-12">
				<div class="col-md-2">
					<div class="form-group">
						<label class="control-label"><strong>Annual Savings:</strong></label>
						<input type="text" class="form-control" value="<?=$annual_savings?> kr" readonly>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label class="control-label"><strong>Total Cost:</strong></label>
						 <input type="text" class="form-control" value="<?=$total_cost?> kr" readonly>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label class="control-label"><strong>Green Sibsidy:</strong></label>
						 <input type="text" class="form-control" value="<?=$green_subsidy?> kr" readonly>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label class="control-label"><strong>Payback Time:</strong></label>
						 <input type="" class="form-control" value="<?=$payback_time?> Years" readonly>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label class="control-label"><strong>Yearly Energy Production:</strong></label>
						 <input type="" class="form-control" value="<?=$yearly_energy_production?> kWh" readonly>
					</div>
				</div>
				<div class="clearfix"></div><br>
			</div>
			<?php } ?>
		</div>
		<?php } ?>
		<?php if($form_type==1){?>
		<div class="white-box panel-body">
			<div class="col-md-12">
				<div class="col-md-2">
					<div class="form-group">
						<label class="control-label"><strong>Area:</strong></label>
						<input type="text" class="form-control" value="<?=$roof_area?>" readonly>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label class="control-label"><strong>Solar Pnaels:</strong></label>
						 <input type="text" class="form-control" value="<?=$panels?>" readonly>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label class="control-label"><strong>Size:</strong></label>
						 <input type="text" class="form-control" value="<?=$size?> kW" readonly>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label class="control-label"><strong>Slop Type:</strong></label>
						 <input type="" class="form-control" value="<?=$slope_type?>" readonly>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label class="control-label"><strong>Panel Type:</strong></label>
						 <input type="" class="form-control" value="<?=$panel_type?>" readonly>
					</div>
				</div>
				<?php $addonArr = explode(':',$addon_type);	?>
				<div class="col-md-3">
					<div class="form-group">
						<label class="control-label"><strong>Battery:</strong></label>
						 <input type="" class="form-control" value="<?=in_array('at1',$addonArr)?'Yes':'No'?>" readonly>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label class="control-label"><strong>Car Charger:</strong></label>
						 <input type="" class="form-control" value="<?=in_array('at2',$addonArr)?'Yes':'No'?>" readonly>
					</div>
				</div>
				<div class="clearfix"></div><br>
			</div>
		</div>
		<?php } ?>
		
		
        <div class="white-box">			
			<div class="form-group col-md-3">
				<label class="control-label">Customer Type</label>
				<select class="form-control" id="proposal_customer_type" name="proposal_customer_type" <?=$readonly_field?>>
					<?php foreach($proosalCustomerTypeArr as $ckey=>$cval){?>
					<option value="<?=$ckey?>" <?=$proposal_customer_type==$ckey?'selected':''?>><?=$cval?></option>
					<?php } ?>
				</select>
			</div>
			<?php if($_SESSION["ses_adm_role"]=="1"){?>
			<div class="col-sm-3" style="margin-top:30px;">
				<input class="form-check-input" type="checkbox" name="automatic" id="automatic" <?=$automatic==1?'checked':''?>>
				<label class="form-check-label" for="automatic">Automatic</label>
			</div>
			<?php } ?>
			<div class="col-sm-3">
				<label for="post_date" class="control-label">Lead Date</label>
				<div class="input-group">
					<input class="form-control" id="datepicker-autoclose" placeholder="mm/dd/yyyy" type="text" name="post_date" value="<?=date('Y-m-d')?>" autocomplete="off" <?=$readonly_field?>>
					<span class="input-group-addon"><i class="icon-calender"></i></span> 
				</div>
            </div>
			<div class="form-group col-sm-3">
				<label for="form_type" class="control-label">Lead From</label>
				<select class="form-control" name="form_type" required <?=$readonly_field?>>
					<option value="">Lead from</option>
					<?php $leadFormType = getAllLeadType();
					foreach($leadFormType as $fkey=>$fval){?>
					<option value="<?=$fkey?>" <?=$form_type==$fkey?'selected':''?>><?=$fval?></option>
					<?php } ?>
				</select>
            </div>
			<div class="clearfix"></div>
			<div class="form-group col-sm-3">
				<label for="customer_name" class="control-label">Name</label>
				<input type="text" name="customer_name" value="<?=$customer_name?>" class="form-control" id="customer_name" placeholder="Name" required data-fv-regexp="true"  data-error="Please enter valid Name" <?=$readonly_field?>>
				<div class="help-block with-errors"></div>	
			</div>
			<div class="col-sm-3">
				<label for="email" class="control-label">Email</label>
				<input type="email" name="email" value="<?=$email?>" class="form-control" id="email" placeholder="Email" data-error="Email, that email address is invalid" <?=$readonly_field?>>
				<div class="help-block with-errors"></div>	
			</div>
			<div class="col-sm-3">
				<label for="phone" class="control-label">Phone</label>
				<input id="phone" type="text" name="phone" value="<?=$phone?>" class="form-control" placeholder="Phone" data-error="Phone Number is invalid" data-fv-regexp="true" <?=$readonly_field?>>	
			</div>
			<div class="col-sm-3">
				<label for="address_input" class="control-label">Address</label>
				<input type="text" name="address_input" value="<?=$address_input?$address_input:$proposal_address?>" class="form-control" id="address_input" placeholder="Address" <?=$readonly_field?>>
				<div class="help-block with-errors"></div>	
			</div>
			<div class="clearfix"></div>
			<div class="form-group col-md-4">
				<label for="annual_electricity_consumption" class="control-label">Annual consumption (kWh)</label>
				<input type="text" class="form-control" name="annual_electricity_consumption" value="<?=$annual_electricity_consumption?>" id="annual_electricity_consumption" <?=$readonly_field?>>
			</div>
			<div class="form-group col-md-4">
				<label for="roofing_material" class="control-label">Roof Type</label>
				<select class="form-control" id="roofing_material" name="roofing_material" <?=$readonly_field?>>
					<option value="">Select Roof type</option>
					<?php $roofTypePriceArr = json_decode($customerPriceArr["roof_type_price"], true);
					foreach ($roofTypePriceArr as $rkey => $rvalue) {
						if($rvalue["rfstatus"]==1){
							if($roofing_material==$rvalue["name"]){
								$rsel = 'selected';
							}else{
								$rsel = '';
							}
							echo '<option value="'.$rvalue["name"].'" '.$rsel.'>'.$rvalue["name"].'</option>';
						} 
					}
					?>
				</select>
			</div>
			<div class="form-group col-md-4">
				<label for="roof_angle" class="control-label">Roof Angle</label>
				<input type="text" class="form-control" name="roof_angle" id="roof_angle" value="<?=$roof_angle?>" <?=$readonly_field?>>
			</div>
			
			<!--<div class="form-group col-md-4">
				<label class="control-label">Region</label>
				<input type="text" class="form-control" name="region" placeholder="Region" value="<?=$region?>">
			</div>-->
			<?php if(($form_type==1 || $form_type==3) && $form_type!=''){?>
			<div class="form-group col-sm-4">
				<label for="postal_code" class="control-label">Postal Code</label>
				<input type="text" name="postal_code" value="<?=$postal_code?>" class="form-control" id="postal_code" placeholder="Postal Code" <?=$readonly_field?>>
				<div class="help-block with-errors"></div>	
			</div>
			<?php } ?>
			<?php if($form_type==2){?>
			<div class="form-group col-sm-4">
				<label for="city" class="control-label">City</label>
				<input type="text" name="city" value="<?=$city?>" class="form-control" id="city" <?=$readonly_field?>>
				<div class="help-block with-errors"></div>	
			</div>
			<?php } ?>
			<?php if($form_type==3 && $form_type!=''){?>
			<div class="form-group col-sm-4">
				<label for="purpose" class="control-label">Purpose</label>
				<input type="text" name="purpose" value="<?=$purpose?>" class="form-control" <?=$readonly_field?>>
			</div>
			<div class="clearfix"></div>
			<?php } ?>
			<?php if(($form_type==2 || $form_type==3) && $form_type!=''){?>
			<div class="form-group col-sm-6">
				<label for="message" class="control-label">Message</label>
				<textarea name="message" class="form-control" cols="30" rows="5" <?=$readonly_field?>><?=$message?></textarea>
				<div class="help-block with-errors"></div>
			</div>
			<?php } ?>
			<div class="clearfix"></div>
			
			<?php if($_SESSION["ses_adm_role"]=="1"){
				$admQry = '';
			}else{
				$admQry = ' AND id='.$_SESSION["ses_adm_id"];
			} ?>  
			<div class="form-group col-sm-4">
				<label for="inputPassword" class="control-label">User</label>
				<input type="hidden" name="old_assigned_to" value="<?php echo $assigned_to; ?>">
				<select class="form-control" name="assigned_to" id="assigned_to" data-error="Please select assigned to" <?=$readonly_field?>>
					<option value="">Select User</option>
					<?php $userQry=$cms->db_query("select id, customer_name from #_users where role='3' AND customer_name!='' $admQry ");
					while($userRes=$userQry->fetch_array()){?>
						<option <?=($userRes['id']==$assigned_to)?"selected":"";?> value="<?=$userRes['id']?>"><?=$userRes['customer_name']?></option>
					<?php } ?>
				</select>	
            </div>
			<div class="form-group col-sm-4">
				<label for="status" class="control-label">Status <a href="javascript:void(0)" data-toggle="modal" data-target="#status_chart"> <i class="fa fa-info" aria-hidden="true"></i> </a></label>
				<input type="hidden" name="old_status" value="<?php echo $status; ?>">
				<select class="form-control leadStatuss" name="status" id="leadstatus" <?=$readonly_field?>>
					<?php $leadsStatusArr = getAllStatus();
					foreach($leadsStatusArr as $status_key=>$status_val){?>
					<option value="<?=$status_key?>" <?=($status==$status_key)?'selected':''?>><?=$status_val?></option>
					<?php } ?>
				</select>
				<div class="help-block with-errors"></div>	
			</div>
			<?php if($selected_reasons!='' || $status==5){
				$selected_reasonsArr = explode('$#',$selected_reasons);
				$rstyle = "";
			}else{
				$rstyle = "display:none";
			}
			?>
			<div class="form-group col-sm-4 show-reason" style="<?=$rstyle?>">
				<label for="title" class="control-label">Select Reason*</label>
				<select class="form-control-new select2" name="selected_reasons[]" multiple required <?=$readonly_field?>>
					<?php $reasonsArr = $cms->getSingleResult("SELECT reasons FROM #_lead_type_status where id=5 and lead_type=1 ");
					$obj = json_decode($reasonsArr);
					if(count($obj)>0){
					$i=0;
					foreach($obj as $val){
						if($val->status==1){
							if(in_array($val->name,$selected_reasonsArr)){
								$rsel = 'selected';
							}else{
								$rsel = '';
							}
					?>
					<option value="<?=$val->name?>" <?=$rsel?>><?=$val->name?></option>
					<?php } } } ?>
				</select>
				<div class="help-block with-errors"></div>
			</div>
			<div class="clearfix"></div>
					
			<?php
			$showComment = TRUE;
			if($showComment == TRUE){ ?>
			<div class="form-group col-sm-12">
				<div class="form-group col-sm-6">
					<label for="lead_comment" class="control-label">Comment</label>
					<textarea name="lead_comment" class="form-control" cols="30" rows="5" placeholder="Lead Comment" ></textarea>
				</div>
				
				<div class="form-group col-sm-6">
					<label for="activity_message" class="control-label">Activity</label>
					<textarea name="activity_message" class="form-control" id="activity_message" cols="30" rows="2"></textarea>
					<div class="row">
						<div class="form-group col-sm-6">
							<label for="due_date" class="control-label">Due date</label>
							<div class="input-group">
								<input class="form-control" id="due_date" type="text" name="due_date" value="" autocomplete="off">
								<span class="input-group-addon"><i class="icon-calender"></i></span> 
							</div>
						</div>
						<?php if($_SESSION["ses_adm_role"]=="1"){
							$muid = $_SESSION["ses_adm_id"];
							$muemail = $settingArr['to_emails'];
						}else{
							$muid = $_SESSION["ses_adm_id"];
							$muemail = $_SESSION['ses_adm_email'];
						}?>
						<div class="form-group col-sm-6">							
							<label for="due_date" class="control-label">Send to</label>
							<select name="activity_send_to[]" class="form-control-new select2" multiple>
								<option value="<?=$muid.'|'.$muemail?>">Self</option>
								<?php foreach($accessUserArr as $uid){
									$userQry = $cms->db_query("SELECT id, email_id, customer_name FROM #_users where id=$uid ");
									if($userQry->num_rows>0){
									$userRes = $userQry->fetch_array();
								?>
								<option value="<?=$userRes['id'].'|'.$userRes['email_id']?>"><?=$userRes['customer_name']?></option>
								<?php } } ?>
							</select>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>			
			</div>
			<?php } else{  ?> 
			<div class="form-group col-sm-12">
				<label for="inputPassword" class="control-label">Status - </label>
				<label for="inputPassword" class="control-label"><?=$leadsStatusArr[$status];?></label>
			</div>	
			<?php } ?>
			<div class="col-md-6 col-xs-12 col-sm-6">
				<div class="white-box">
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#home">Comments History</a></li>
						<li><a data-toggle="tab" href="#menu1">Status History</a></li>
						<li><a data-toggle="tab" href="#menu3">Activity History</a></li>
					</ul>
					<div class="tab-content">
						<div id="home" class="tab-pane fade in active">
							<h3>Comments History</h3>
							<div class="message-center scroll_bar"> 
							<?php if(isset($_REQUEST['id'])){ $i=0;
							$leadCommentQr = $cms->db_query("SELECT `id`, `lead_comment`, `lead_id`, `post_by`, `post_date`, `lead_status`, `attched_file`, `action_from_date_time`, `action_to_date_time`, `visit_call`, `next_call_date` FROM #_lead_comments WHERE lead_status='1' and lead_id='".$_REQUEST['id']."' ORDER BY id DESC");
							if($leadCommentQr->num_rows>0){
							while($leadCommentRes = $leadCommentQr->fetch_array()){
							?>
								<div class="message_div" style="padding:10px;<?=$i%2==0?"background:#e8e8e8":"";?>"> 
									<div class="user-img"> 
										<img src="<?=SITE_PATH_ADM?>images/blankuser.png" alt="user" class="img-circle">
									</div>
									<div class="mail-contnet">
										<h5><?=$cms->getSingleResult("SELECT customer_name FROM #_users WHERE id='".$leadCommentRes["post_by"]."'");?>
											<span class="time pull-right"><br><?=$leadCommentRes["post_date"]?></span>
										</h5>
										<span class="mail-desc" style="float:left;">
											<?=$leadCommentRes["lead_comment"]?>
											<br>
											<?php 
											if($leadCommentRes["visit_call"]==0){
												$visits = "Call";
											}else if($leadCommentRes["visit_call"]==1){
												$visits = "Visit";
												if($leadCommentRes["action_from_date_time"]){ 
												echo "Action: ".$visits." (".$leadCommentRes["action_from_date_time"];} 
											 if($leadCommentRes["action_to_date_time"]){echo " To "; echo $leadCommentRes["action_to_date_time"]; echo ")";} 
											}else {
												$visits = "";
											}
											
											 ?>											
										</span>
									</div>
									<div class="clearfix"></div>
								</div> 
							<?php $i++; } }   else{
							echo "No Records Found.";
							} } ?> 
						</div>
					</div>
					<div id="menu1" class="tab-pane fade">
						<h3>Status History</h3>
						<div class="message-center scroll_bar"> 
						<?php if(isset($_REQUEST['id'])){ $i=0;
							$leadCommentQr = $cms->db_query("SELECT action_message, action_date,action_by FROM #_lead_tracker WHERE lead_id='".$_REQUEST['id']."' ORDER BY id DESC");
							if($leadCommentQr->num_rows>0){
							while($leadCommentRes = $leadCommentQr->fetch_array()){
								if($leadCommentRes['action_message']!='' && $leadCommentRes['action_date']!=''){
							?>
							<div class="message_div" style="padding:10px;<?=$i%2==0?"background:#e8e8e8":"";?>"> 
								<div class="user-img"> <i class="fa fa-clock-o fa-2x"></i> </div>
								<div class="mail-contnet">
									<h5><?=$cms->getSingleResult("SELECT customer_name FROM #_users WHERE id='".$leadCommentRes["action_by"]."'");?>
										<span class="time pull-right"><?=$leadCommentRes["action_date"]?></span>
									</h5>
									<span class="mail-desc">
										<?=$leadCommentRes["action_message"]?>
										<br>
									</span>
								</div>
								<div class="clearfix"></div>
							</div> 
							<?php $i++; } } } else{
							echo "No Records Found."; 
							} }?> 
						</div>
					</div>
					<div id="menu3" class="tab-pane fade">
						<h3>Activity History</h3>
						<div class="message-center scroll_bar"> 
						<?php if(isset($_REQUEST['id'])){ $i=0;
							if($_SESSION["ses_adm_role"]=="1"){
								$admActionBy = '';
							}else{
								$admActionBy = "AND action_by=".$_SESSION['ses_adm_id']." ";
							}
							$leadCommentQr = $cms->db_query("SELECT activity_message, due_date, action_date, action_by FROM #_lead_tracker WHERE lead_id='".$_REQUEST['id']."' $admActionBy ORDER BY id DESC");
							if($leadCommentQr->num_rows>0){
							while($leadCommentRes = $leadCommentQr->fetch_array()){
								if($leadCommentRes['activity_message']!='' && $leadCommentRes['due_date']!=''){
							?>
							<div class="message_div" style="padding:10px;<?=$i%2==0?"background:#e8e8e8":"";?>"> 
								<div class="user-img"> <i class="fa fa-clock-o fa-2x"></i> </div>
								<div class="mail-contnet">
									<h5><?=$cms->getSingleResult("SELECT customer_name FROM #_users WHERE id='".$leadCommentRes["action_by"]."'");?>
										<span class="time pull-right"><?=$leadCommentRes["action_date"]?></span>
									</h5>
									<span class="mail-desc">
										<?=$leadCommentRes["activity_message"]?> on date <?=$leadCommentRes["due_date"]?>
									</span>
								</div>
								<div class="clearfix"></div>
							</div> 
							<?php $i++; } } } else{
							echo "No Records Found."; 
							} }?> 
						</div>
					</div>
				</div>					
			</div>
			</div>
			<div class="form-group col-sm-12">
				<button type="submit" class="btn add-submit-btn">Submit</button>
				<a href="<?=$_SESSION['REFERER_page']?>" class="" ><button type="button" class="btn back-btn">Back</button></a>
			</div>				
			<div class="clearfix"></div>
		</div>
	</div>
</div>

<div class="modal" id="status_chart">
	<div class="modal-dialog ">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title pull-left">Status</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<table class="table table-striped1 table-hover table-bordered">
					<thead>
						<tr>
							<th class="text-nowrap">Status</th>
							<th>Help Text</th>
						</tr>
					</thead>
					<tbody>
						<?php $statusQry = $cms->db_query("SELECT * FROM #_lead_type_status where lead_type=1 AND status=1 AND is_deleted=0 order by lead_status ");
						while ($statusRes = $statusQry->fetch_array()){ 		 
						?>  
						<tr class="clickable-row">
							<td class="text-nowrap"><?=$statusRes['lead_status']?></td>
							<td class="text-nowrap"><?=$statusRes['help_text']?></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script>
$("#leadstatus").change(function(){
	var lstatus = $(this).val();
	//alert(lstatus);
	if(lstatus=="2"){
		if($('#assigned_to').val()==""){
			alert("Select User");
		}
	}
});
</script>
<script>
$("#leadstatus").change(function(){
	var lstatus = $(this).val();
	//alert(lstatus);
	if(lstatus=="5"){
		$(".show-reason").show();
	}else{
		$(".show-reason").hide();
	}
});
</script>
<script>
$("#activity_message").blur(function(){
	var activity_message = $(this).val();
	var due_date = $('#due_date').val();
	//alert(activity_message);
	if(due_date==""){
		alert("Select due date");
	}
});
</script>
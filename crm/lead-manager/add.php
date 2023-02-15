<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php
$action_message ='';
$uniqueLeadId ='';
$pid = $_GET['id'];
if($_SESSION['REFERER_page']==''){
	$_SESSION['REFERER_page']=$_SERVER['HTTP_REFERER'];
}
// mk-19
$roof_details_count = 0;

if($cms->is_post_back()){	
	//print_r($_POST);die;
	
	$_POST['dimensioning_user']=$_POST['dimensioning_user']?$_POST['dimensioning_user']:0;
	$leadsStatusArr = getAllStatus();
	
	if($_POST['automatic']=='on'){
		$_POST['automatic'] = 1;
	}else{
		$_POST['automatic'] = 0;
	}
	$_POST["selected_reasons"] = implode("$#",$_POST["selected_reasons"]);
	$_POST['proposal_address'] = $_POST['address_input'];
	
	//if user assigned but lead status not changed to assigned
	if($_POST['assigned_to']!='' && $_POST['status']==1){
		$_POST['status'] = 2;
	}
	
	$_POST["last_updated_by"] = $_SESSION["ses_adm_id"];
	if($pid){ 
		$_POST["update_date"] = date("Y-m-d h:i:s");
		
		$_POST["lead_unique_id"] = generateLeadId($pid);
		$lead_insert_id = $pid;
		$uniqueLeadId = $_POST["lead_unique_id"];
		$cms->sqlquery("rs","leads",$_POST, 'id', $pid);	
		$adm->sessset('Record has been updated', 's');		
	} else {
		$_POST["update_date"] = date("Y-m-d h:i:s");
		$_POST["post_date"] = date("Y-m-d");
		$_POST["post_by"] = $_SESSION["ses_adm_id"];
		$_POST["lead_type"] = 1;
		$lead_insert_id=$cms->sqlquery("rs","leads",$_POST);	
		$POSTARR["lead_unique_id"] = generateLeadId($lead_insert_id);
		$uniqueLeadId = $POSTARR["lead_unique_id"];
		$cms->sqlquery("rs","leads",$POSTARR, 'id', $lead_insert_id);	
		$adm->sessset('Record has been added', 's');
	}
	
	//when new lead added
	if(empty($action_message) && $pid==''){
		$action_message ="New Lead added by ".$cms->getSingleResult("SELECT customer_name FROM #_users WHERE id='".$_SESSION["ses_adm_id"]."'").".";
		$_POSTS["lead_id"] = $lead_insert_id;
		$_POSTS["action_message"] = $action_message;
		$_POSTS["action_date"] = date('Y-m-d h:i:s');
		$_POSTS["action_by"] = $_SESSION["ses_adm_id"];
		$_POSTS["activity_for"] = $_SESSION["ses_adm_id"];		
		$_POSTS["new_status"] = $_POST["status"];
		$_POSTS["lead_status"] = 0;
		$cms->sqlquery("rs","lead_tracker",$_POSTS);
	}
	//add comment
	if(!empty($_POST["lead_comment"])){
		$_CommentPoast["lead_comment"] = $_POST["lead_comment"]?$_POST["lead_comment"]:"No Comment";
		$_CommentPoast["lead_id"] = $lead_insert_id;
		$_CommentPoast["post_by"] = $_SESSION["ses_adm_id"];
		$_CommentPoast["post_date"] = date('Y-m-d h:i:s');
		
		$cms->sqlquery("rs","lead_comments",$_CommentPoast);
	}

	//add activity
	if(!empty($_POST['activity_message']) && empty($_POST['activity_send_to'])){
		$_ActivityPost["lead_id"] = $lead_insert_id;			
		$_ActivityPost["action_message"] = '';
		$_ActivityPost["action_date"] = date('Y-m-d h:i:s');
		$_ActivityPost["action_by"] = $_SESSION["ses_adm_id"];
		$_ActivityPost["activity_for"] = $_SESSION["ses_adm_id"];
		$_ActivityPost["activity_message"] = $_POST['activity_message'];
		$_ActivityPost["due_date"] = ($_POST['due_date']?$_POST['due_date']:date('Y-m-d'));
		$cms->sqlquery("rs","lead_tracker",$_ActivityPost);
	}
		
	//add in activity and send mail to the selected users
	if(!empty($_POST['activity_message']) && !empty($_POST['activity_send_to'])){
		foreach($_POST['activity_send_to'] as $udata){
			$userinfo = explode('|',$udata);
						
			$ACTPOSTS["lead_id"] = $lead_insert_id;			
			$ACTPOSTS["action_message"] = '';
			$ACTPOSTS["action_date"] = date('Y-m-d h:i:s');
			$ACTPOSTS["action_by"] = $_SESSION["ses_adm_id"];
			$ACTPOSTS["activity_for"] = $userinfo[0];
			$ACTPOSTS["activity_message"] = $_POST['activity_message'];
			$ACTPOSTS["due_date"] = ($_POST['due_date']?$_POST['due_date']:date('Y-m-d'));
			$cms->sqlquery("rs","lead_tracker",$ACTPOSTS);
			
			//updated activity mail send
			$assignedQry = $cms->db_query("SELECT customer_name, email_id FROM #_users WHERE id='".$_POST['assigned_to']."'");
			$assignedRes = $assignedQry->fetch_array();
			$subject='New activity';			
			$msg_body='<div>Hi '.$assignedRes['customer_name'].',</div>
					   <div>&nbsp;</div>
					   <div>Activity - <b>'.$_POST['activity_message'].'</b> for customer <b>'.$_POST['customer_name'].' '.$uniqueLeadId.'</b></div>
					   <div>Due Date - <b>'.$_POSTS["due_date"].'</b> for customer <b>'.$_POST['customer_name'].'</b></div>
					   <div>&nbsp;</div>
					   <div><b>Regards,<br>Arka</b></div>';
				   
			$email_msg=emailFormat($msg_body);
				
			$to = $userinfo[1];
			$resReturn = sendEmail($to, $subject,$email_msg);
		}
	}

	// mk-19
	if(isset($_POST['save'])){
        
        $total_rec = $_POST['total_rec'];
		if($total_rec>0){
            $roofDetails =array();
            $roof_details_count= $total_rec;
            if($_POST['edit']){ $roof_details_count = $roof_details_count-1;  }
            //echo $roof_details_count;die;
            
                for($i=0;$i<=$roof_details_count;$i++){
                    $roofDetails['total_panel'] = $_POST['total_panel'][$i];
                    $roofDetails['roofing_material'] = $_POST['roofing_material'][$i];
                    $roofDetails['roof_support'] = $_POST['roof_support'][$i];
                    $roofDetails['roof_angle'] = $_POST['roof_angle'][$i];
					$roofDetails['roof_breath'] =$_POST['roof_breath'][$i];
					$roofDetails['roof_length'] =$_POST['roof_length'][$i];
					$roofDetails['roof_height'] = $_POST['roof_height'][$i];
                    $roofDetails['lead_id'] = $pid;
                    $roofDetails['form_type'] = 'lead';
                    $roofDetails['status'] = 0;
                    if(empty($_POST['rec_id'][$i]))
                    { 
                        $cms->sqlquery("rs","roof_details",$roofDetails); 
                        //print_r($roofDetails);
                        // die;
                    } 
                    else{
                       $cms->sqlquery("rs","roof_details",$roofDetails,'id',$_POST['rec_id'][$i]);
                    }
                    // echo $i;die;
                }
                $roofDetails = array();
                // echo "<script type='text/javascript'> alert(".json_encode($roofDetails).") </script>";
            }
            else{
                if(count($_POST['total_panel'])!=0 || count($_POST['roofing_material'])!=0 || count($_POST['roof_support'])!=0 ||  count($_POST['roof_angle'])!=0 )
                {
                    $roofDetails['total_panel'] = $_POST['total_panel'];
                    $roofDetails['roofing_material'] = $_POST['roofing_material'];
                    $roofDetails['roof_support'] = $_POST['roof_support'];
                    $roofDetails['roof_angle'] = $_POST['roof_angle'];
					$roofDetails['roof_breath'] =$_POST['roof_breath'];
					$roofDetails['roof_length'] =$_POST['roof_length'];
					$roofDetails['roof_height'] = $_POST['roof_height'];$roofDetails['lead_id'] = $pid;
					$roofDetails['form_type'] = 'lead';
                    $roofDetails['status'] = 0;
                    if(empty($_POST['rec_id'][$i]))
                    { 
                        $cms->sqlquery("rs","roof_details",$roofDetails); 
                     } 
                    // else{
                    //    $cms->sqlquery("rs","roof_details",$roofDetails,'id',$_POST['rec_id'][$i]);
                    // }
                }
            }
    }
	
	//when status changed
	$old_status=$_POST['old_status'];
	$status=$_POST['status'];
	if($old_status!=$status && $old_status!=''){
		$action_message="Status Changed from <b>".$leadsStatusArr[$old_status]."</b> to <b>".$leadsStatusArr[$status]."</b>";	
		$StatusPOSTS["lead_id"] = $lead_insert_id;
		$StatusPOSTS["action_message"] = $action_message;
		$StatusPOSTS["action_date"] = date('Y-m-d h:i:s');
		$StatusPOSTS["action_by"] = $_SESSION["ses_adm_id"];
		$StatusPOSTS["activity_for"] = $_SESSION["ses_adm_id"];
		$StatusPOSTS["new_status"] = $_POST["status"];
		$StatusPOSTS["lead_status"] = $_POST["old_status"];
		//print_r($StatusPOSTS);die;
		$cms->sqlquery("rs","lead_tracker",$StatusPOSTS);
		
		$statusLeadQry = $cms->db_query("SELECT to_user, to_admin FROM #_lead_type_status where constant=".$_POST['status']." and lead_type=1 ");
		$statusLeadRes = $statusLeadQry->fetch_array();
		
		//send updated status mail to user if checked
		if($statusLeadRes['to_user']){
			if(!empty($_POST['assigned_to'])){ //if user is assigned
				$assignedQry = $cms->db_query("SELECT customer_name, email_id FROM #_users WHERE id='".$_POST['assigned_to']."'");
				$assignedRes = $assignedQry->fetch_array();
				if($status==2){
					$subject = 'New lead '.$leadsStatusArr[$status];
				}
				else{
					$subject = 'New '.$leadsStatusArr[$status];
				}
							
				$msg_body='<div>Hi '.$assignedRes['customer_name'].',</div>
						   <div>&nbsp;</div>
						   <div>Status has been changed from <b>'.$leadsStatusArr[$old_status].'</b> to <b>'.$leadsStatusArr[$status].'</b> for customer <b>'.$_POST['customer_name'].'</b></div>
						   <div>&nbsp;</div>
						   <div><b>Regards,<br>Arka</b></div>';
					   
				$email_msg=emailFormat($msg_body);			
				$to=$assignedRes['email_id'];
				$resReturn = sendEmail($to, $subject,$email_msg);
			}
		}
		
		//send updated status mail to Admin if checked
		if($statusLeadRes['to_admin']){
			if($status==2){
				$subject = 'New lead '.$leadsStatusArr[$status];
			}
			else{
				$subject = 'New '.$leadsStatusArr[$status];
			}			
			$msg_body='<div>Hi Admin,</div>
					   <div>&nbsp;</div>
					   <div>Status has been changed from <b>'.$leadsStatusArr[$old_status].'</b> to <b>'.$leadsStatusArr[$status].'</b> for customer <b>'.$_POST['customer_name'].'</b></div>
					   <div>&nbsp;</div>
					   <div><b>Regards,<br>Arka</b></div>';
				   
			$email_msg=emailFormat($msg_body);			
			$to = $settingArr['from_email'];
			$resReturn = sendEmail($to, $subject,$email_msg);
		}
		
		//when lead status change from New to assigned, add activity to the assigned user
		if($_POST['old_status']==1 && $_POST['status']==2 && !empty($_POST["assigned_to"])){
			if($assigned_to){
				$ASSIGN["assigned_date"] = date("Y-m-d h:i:s");
			}	
			$cms->sqlquery("rs","leads",$_POST, 'id', $ASSIGN);
		
		
			$AssignPOSTS["lead_id"] = $lead_insert_id;
			$AssignPOSTS["action_message"] = '';
			$AssignPOSTS["action_date"] = date('Y-m-d h:i:s');
			$AssignPOSTS["action_by"] = $_SESSION["ses_adm_id"];
			$AssignPOSTS["activity_for"] = $_POST["assigned_to"];
			$assignedTo = $cms->getSingleResult("SELECT customer_name FROM #_users WHERE id=".$_POST["assigned_to"]." ");
			$AssignPOSTS["activity_message"] = $_POST['customer_name'].' '.$uniqueLeadId.' assigned to '.$assignedTo;
			$AssignPOSTS["due_date"] = ($_POST['due_date']?$_POST['due_date']:date('Y-m-d'));
			$cms->sqlquery("rs","lead_tracker",$AssignPOSTS);
		}
		
		//when lead status change to dimensioning requested, add activity to the dimensioning user		
		if($_POST['dimensioning_user']!='' && $_POST['old_status']!=9 && $_POST['status']==9){	
			$DIMENSIONPOSTS["lead_id"] = $lead_insert_id;			
			$DIMENSIONPOSTS["action_message"] = '';
			$DIMENSIONPOSTS["action_date"] = date('Y-m-d h:i:s');
			$DIMENSIONPOSTS["action_by"] = $_SESSION["ses_adm_id"];
			$DIMENSIONPOSTS["activity_for"] = $_POST['dimensioning_user'];
			$DIMENSIONPOSTS["dimensioning_priority"] = $_POST['dimensioning_priority'];
			$DIMENSIONPOSTS["activity_message"] = 'Dimensioning requested for '.$_POST['customer_name'].' '.$uniqueLeadId;
			$DIMENSIONPOSTS["due_date"] = ($_POST['due_date']?$_POST['due_date']:date('Y-m-d'));
			$cms->sqlquery("rs","lead_tracker",$DIMENSIONPOSTS);
		}	
		
		//when lead status change to dimensioning completed, add activity to the dimensioning user	
		/*if(!empty($dimensioningUserArr) && $_POST['old_status']!=8 && $_POST['status']==8){
			foreach($dimensioningUserArr as $uid){
				$userQry = $cms->db_query("SELECT id, email_id, customer_name FROM #_users where id=$uid ");
				if($userQry->num_rows>0){
					$userRes = $userQry->fetch_array();
					$DIMENSIONPOSTS["lead_id"] = $lead_insert_id;			
					$DIMENSIONPOSTS["action_message"] = '';
					$DIMENSIONPOSTS["action_date"] = date('Y-m-d h:i:s');
					$DIMENSIONPOSTS["action_by"] = $_SESSION["ses_adm_id"];
					$DIMENSIONPOSTS["activity_for"] = $userRes["id"];
					$DIMENSIONPOSTS["activity_message"] = 'Dimensioning completed for customer '.$_POST['customer_name'].' '.$uniqueLeadId;
					$DIMENSIONPOSTS["due_date"] = ($_POST['due_date']?$_POST['due_date']:date('Y-m-d'));
					$cms->sqlquery("rs","lead_tracker",$DIMENSIONPOSTS);
				}
			}
		}*/	
		if($_POST['dimensioning_user']!='' && $_POST['old_status']!=8 && $_POST['status']==8){	
			$DIMENSIONPOSTS["lead_id"] = $lead_insert_id;			
			$DIMENSIONPOSTS["action_message"] = '';
			$DIMENSIONPOSTS["action_date"] = date('Y-m-d h:i:s');
			$DIMENSIONPOSTS["action_by"] = $_SESSION["ses_adm_id"];
			$DIMENSIONPOSTS["activity_for"] = $_POST['dimensioning_user'];
			$DIMENSIONPOSTS["activity_message"] = 'Dimensioning completed for '.$_POST['customer_name'].' '.$uniqueLeadId;
			$DIMENSIONPOSTS["due_date"] = ($_POST['due_date']?$_POST['due_date']:date('Y-m-d'));
			//print_r($DIMENSIONPOSTS);die;
			$cms->sqlquery("rs","lead_tracker",$DIMENSIONPOSTS);
			
			$DIMENSIONPOSTS["lead_id"] = $lead_insert_id;			
			$DIMENSIONPOSTS["action_message"] = '';
			$DIMENSIONPOSTS["action_date"] = date('Y-m-d h:i:s');
			$DIMENSIONPOSTS["action_by"] = $_SESSION["ses_adm_id"];
			$DIMENSIONPOSTS["activity_for"] = $_POST['assigned_to'];
			$DIMENSIONPOSTS["activity_message"] = 'Dimensioning completed for '.$_POST['customer_name'].' '.$uniqueLeadId;
			$DIMENSIONPOSTS["due_date"] = ($_POST['due_date']?$_POST['due_date']:date('Y-m-d'));
			//print_r($DIMENSIONPOSTS);die;
			$cms->sqlquery("rs","lead_tracker",$DIMENSIONPOSTS);
		}	
	}
		
	if(isset($_FILES['file_upload']) and count(array_filter($_FILES['file_upload']['tmp_name']))>0){
		if(count($_FILES["file_upload"]["name"])>0){				
			$pcount = count($_FILES["file_upload"]["name"]);
			for($i=0; $i<$pcount; $i++){									
				if(!empty($_FILES["file_upload"]["name"][$i])){
					$validImage  = array("jpg","JPG","jpeg","JPEG","gif","GIF","png","PNG","svg","SVG");
					$path = $_FILES["file_upload"]["name"][$i];
					$end = pathinfo($path, PATHINFO_EXTENSION);
					if(!in_array($end,$validImage)){
						$err = "You have uploaded an invalid file!";
						if($mess!=""){ echo "<script>alert('".$mess."')</script>";  } 
					}else{
						$filename = $_FILES['file_upload']['name'][$i]; 
						$file_loc = $_FILES['file_upload']['tmp_name'][$i];
						$file_size = $_FILES['file_upload']['size'][$i];
						$file_type = $_FILES['file_upload']['type'][$i];
						$folder = CRM_FILES_PATH.UP_FILES_MEDIA."/";
						// make file name in lower case
						$new_file_name = strtolower($filename);
						$final_file= str_replace(" ","-",$new_file_name);
						if($file_size>0 && $file_size>5000000){
							echo "<script>alert('File size should be less than 5MB')</script>";
						}else{
							move_uploaded_file($file_loc,$folder.$final_file);
							$uploadArr['media_name']=$final_file;
							$uploadArr['lead_id']=$lead_insert_id;
							$cms->sqlquery("rs","media_files",$uploadArr);
						}
					}
				}			
			}
		}	
	}
	
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
// mk-19
$roofFetchDetailsQry = $cms->db_query("SELECT * FROM #_roof_details where lead_id='$pid' AND status=0 AND is_deleted=0 ");
$numRowsRoof = $roofFetchDetailsQry->num_rows;
if($numRowsRoof>0){
$roof_details_count = $numRowsRoof;
}

if(in_array(11,$act_arr) && !in_array(3,$act_arr)){
	$readonly_field = 'readonly';
}else{
	$readonly_field = '';
}

//print_r($_SESSION);
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
			<div class="col-sm-12">
				<h2 class="mg0"><b><?=$lead_unique_id?></b></h2>
			</div>
			<div class="col-sm-4">
				<h2 class="mg0">Lead Date : <?=date("Y-m-d",strtotime($post_date))?></h2>
			</div>
			<div class="col-sm-4">
				<h2 class="mg0">Lead Form : <?=$cms->getSingleResult("SELECT lead_status FROM #_lead_type_status where constant=$form_type AND lead_type=2")?></h2>
				<input type="hidden" name="lead_unique_id" value="<?=$lead_unique_id?>">
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
		<!-- Add Form in Lead Manager-->
        <div class="white-box">
        <!--:Created by MK-13/12-Start-->
		<?php
			$t=$_REQUEST["t"];
			
			$lnk1="#";
			$lnk2="#";
			if($pid>0){
				$lnk1="?mode=add&t=proj_info&id=".$pid;
				$lnk2="?mode=add&t=roof_details&id=".$pid;
            }					
			
			if($t=='proj_info' || $t=='' ){
				$active="active";
				$active1="active";
			}
			elseif($t=='roof_details'){
				$active="active";
				$active2="active";
			}
            else{}
            ?>
            <ul class="nav nav-tabs" role="tablist1">
				<input type="hidden" name="lead_id" id="lead_id" value="<?=$lead_id?>">
				<li role="presentation" class="<?php echo $active1;?>">
                    <a href="<?PHP echo $lnk1 ?>"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs">Lead Info</span></a>
                </li>
				<li role="presentation" class="<?php echo $active2;?>"><a href="<?PHP echo $lnk2 ?>">
                    <span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Roof Details</span></a>
                </li>
            </ul>
            <!-- End:Created Tabs -->
			<!-- Tab panes -->
			<div class="tab-content" style="margin-top:0px;">
				<!--Tab 1-->
				<br>
				<!-- S:Project Info Form -->
				<div role="tabpanel" class="tab-pane <?php echo $active1;?>" id="proj_info">
			
				<div class="form-group col-md-3">
					<label class="control-label">Customer Type</label>
					<select class="form-control" id="proposal_customer_type" name="proposal_customer_type" <?=$readonly_field?>>
						<?php foreach($proosalCustomerTypeArr as $ckey=>$cval){?>
						<option value="<?=$ckey?>" <?=$proposal_customer_type==$ckey?'selected':''?>><?=$cval?></option>
						<?php } ?>
					</select>
				</div>
			<!--
			<?php if($_SESSION["ses_adm_role"]=="1"){?>
			<div class="col-sm-3" style="margin-top:30px;">				
				<div class="checkbox checkbox-success">
					<input id="automatic" type="checkbox" name="automatic" <?=$automatic==1?'checked':''?>>
					<label for="automatic">Automatic MMS Cost</label>
				</div>
			</div>
			<?php } ?>
			-->
			<?php if($pid==0 || $pid==''){?>
			<div class="col-sm-3">
				<label for="post_date" class="control-label">Lead Date</label>
				<div class="input-group">
					<input class="form-control" id="datepicker-autoclose" placeholder="mm/dd/yyyy" type="text" name="post_date" value="<?=date('Y-m-d')?>" autocomplete="off" <?=$readonly_field?>>
					<span class="input-group-addon"><i class="icon-calender"></i></span> 
				</div>
            </div>
			<?php } ?>
			<div class="form-group col-sm-3">
				<label for="form_type" class="control-label">Lead From*</label>
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
				<label for="customer_name" class="control-label">Name*</label>
				<input type="text" name="customer_name" value="<?=$customer_name?>" class="form-control" id="customer_name" placeholder="Name" required data-fv-regexp="true"  data-error="Please enter valid Name" <?=$readonly_field?>>
				<div class="help-block with-errors"></div>	
			</div>
			<div class="form-group col-sm-3">
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
			<div class="form-group col-sm-3">
				<label for="city" class="control-label">City</label>
				<input type="text" name="city" value="<?=$city?>" class="form-control" id="city">
				<div class="help-block with-errors"></div>	
			</div>
			<div class="form-group col-md-3">
				<label for="annual_electricity_consumption" class="control-label">Annual consumption (kWh)</label>
				<input type="text" class="form-control" name="annual_electricity_consumption" value="<?=$annual_electricity_consumption?>" id="annual_electricity_consumption" <?=$readonly_field?>>
			</div>
			<div class="clearfix"></div>
			<div class="form-group col-sm-12">
				<label for="cooner" class="control-label">Co-owner(if any)</label>
			</div>
			<div class="form-group col-sm-3">
				<label for="customer_name_ownwer2" class="control-label">Name</label>
				<input type="text" name="customer_name_ownwer2" value="<?=$customer_name_ownwer2?>" class="form-control" id="customer_name_ownwer2" placeholder="Name" data-fv-regexp="true"  data-error="Please enter valid Name" <?=$readonly_field?>>
				<div class="help-block with-errors"></div>	
			</div>
			<div class="form-group col-sm-3">
				<label for="email_owner2" class="control-label">Email</label>
				<input type="email_owner2" name="email_owner2" value="<?=$email_owner2?>" class="form-control" id="email_owner2" placeholder="Email" data-error="Email, that email address is invalid" <?=$readonly_field?>>
				<div class="help-block with-errors"></div>	
			</div>
			<div class="col-sm-3">
				<label for="phone" class="control-label">Phone</label>
				<input id="phone_ownwer2" type="text" name="phone_ownwer2" value="<?=$phone_ownwer2?>" class="form-control" placeholder="Phone" data-error="Phone Number is invalid" data-fv-regexp="true" <?=$readonly_field?>>	
			</div>
			<div class="clearfix"></div>
			<div class="form-group col-md-3">
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
			<div class="form-group col-md-3">
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
			<?php $allAgents = getAllAgents(); ?>
			<div class="form-group col-sm-4">
				<label for="assigned_to" class="control-label">User</label>
				<input type="hidden" name="old_assigned_to" value="<?php echo $assigned_to; ?>">
				<?php if($_SESSION["ses_adm_role"]=="1" || (in_array(3,$act_arr))){?> 
				<select class="form-control" name="assigned_to" id="assigned_to" data-error="Please select assigned to" <?=$readonly_field?>>
					<option value="">Select User</option>
					<option value="">No User</option>
					<?php foreach($allAgents as $akey=>$aval){
						if($aval!=''){
					?>
						<option <?=($akey==$assigned_to)?"selected":"";?> value="<?=$akey?>"><?=$aval?></option>
					<?php } } ?>
				</select>
				<?php }else{?>
					<input type="text" class="form-control" name="assigned_to" value="<?=$allAgents[$assigned_to]?>" <?=$readonly_field?>>
				<?php } ?> 	
            </div>
			<div class="form-group col-sm-3">
				<label for="status" class="control-label">Status <a href="javascript:void(0)" data-toggle="modal" data-target="#status_chart"> <i class="fa fa-info" aria-hidden="true"></i> </a></label>
				<input type="hidden" name="old_status" value="<?php echo $status; ?>">
				<select class="form-control leadStatuss" name="status" id="leadstatus">
					<?php $leadsStatusArr = getAllStatus();
					foreach($leadsStatusArr as $status_key=>$status_val){
						if($status_key!=4){
						if($pid=='' && $status_key==1){
							$defaultNew = 'selected';
						}else{
							$defaultNew = '';
						}
					?>
					<option value="<?=$status_key?>" <?=$defaultNew?> <?=($status==$status_key)?'selected':''?>><?=$status_val?></option>
					<?php }else{
						if($status==4){ ?>
						<option value="<?=$status_key?>" <?=$defaultNew?> <?=($status==$status_key)?'selected':''?>><?=$status_val?></option>
					<?php } } } ?>
				</select>
				<div class="help-block with-errors"></div>	
			</div>
			
			<?php if(!in_array($_SESSION["ses_adm_id"],$dimensioningUserArr) && $dimensioning_user && $status==9){
				$dstyle = "";
			}else{
				$dstyle = "display:none";
			}?>
			<div class="form-group col-sm-3" id="show-dimensioning-user" style="<?=$dstyle?>">							
				<label for="dimensioning_user" class="control-label">Dimensioning User*</label>
				<select name="dimensioning_user" class="form-control" required>
					<option value="">Select</option>
					<?php foreach($dimensioningUserArr as $uid){
						$userQry = $cms->db_query("SELECT id, customer_name FROM #_users where id=$uid AND status=1 AND is_deleted=0 ");
						if($userQry->num_rows>0){
						$userRes = $userQry->fetch_array();
						if($dimensioning_user==$userRes['id']){
							$dusel = 'selected';
						}else{
							$dusel = '';
						}
					?>
					<option value="<?=$userRes['id']?>" <?=$dusel?>><?=$userRes['customer_name']?></option>
					<?php } } ?>
				</select>
			</div>
			<div class="form-group col-sm-2" id="show-dimensioning-priority" style="<?=$dstyle?>">							
				<label for="dimensioning_priority" class="control-label">Priority*</label>
				<select name="dimensioning_priority" class="form-control" required>
					<option value="">Select</option>
					<?php for($p=1;$p<=5;$p++){	?>
					<option value="<?=$p?>"><?=$p?></option>
					<?php } ?>
				</select>
			</div>
			<?php if(in_array($_SESSION["ses_adm_id"],$dimensioningUserArr)){ ?>
				<input type="hidden" name="dimensioning_user" value="<?=$dimensioning_user?>">
			<?php } ?>
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
			
			<div class="form-group col-sm-4">
				<label for="file_upload" class="control-label">Upload Images</label>
				<input type="file" id="file_upload" name="file_upload[]" multiple>
			</div>
			<div class="clearfix"></div>
			<div class="form-group col-sm-12">
				<?php $fileQry = $cms->db_query("SELECT * FROM #_media_files where lead_id=$pid order by id ");
					if($fileQry->num_rows>0){ ?>
					<div class="row">
						<?php while($fileRes = $fileQry->fetch_array()){?>
						<div class="col-md-3" id="<?=$fileRes['id']?>">
							<a href="javascript:void(0)" class="remove_icon" onClick="remove_img_file('<?=$fileRes['id']?>','<?=$fileRes['media_name']?>')" data-toggle="tooltip" data-original-title="Delete File"><img src="<?=SITE_PATH_ADM?>images/close-btn.png"></a>
							<img src="<?=SITE_PATH.UPLOAD_FILES_PTH?>/<?=UP_FILES_MEDIA?>/<?=$fileRes['media_name']?>" width="100%">
						</div>						
						<?php }	?>
					</div>						
				<?php }	?>
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
							$muemail = $settingArr['from_email'];
						}else{
							$muid = $_SESSION["ses_adm_id"];
							$muemail = $_SESSION['ses_adm_email'];
						}?>
						<div class="form-group col-sm-6">							
							<label for="due_date" class="control-label">Send to</label>
							<select name="activity_send_to[]" class="form-control-new select2" multiple>
								<option value="<?=$muid.'|'.$muemail?>">Self</option>
								<?php foreach($dimensioningUserArr as $uid){
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
									$admActionBy = "AND activity_for=".$_SESSION['ses_adm_id']." ";
								}
								$leadCommentQr = $cms->db_query("SELECT activity_message, due_date, action_date, action_by, activity_for FROM #_lead_tracker WHERE lead_id='".$_REQUEST['id']."' $admActionBy ORDER BY id DESC");
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
			<div class="form-group col-md-6 col-xs-12 col-sm-6">
                <label for="aggrement_note" class="control-label">Crucial Info</label>
				<textarea name="aggrement_note" class="form-control" id="aggrement_note" data-fv-regexp="true" data-error="Please enter value in correct format." maxlength="250"><?=$aggrement_note?></textarea>
				<div class="help-block with-errors"></div>
			</div>
			<div class="form-group col-sm-12">
				<button type="submit" class="btn add-submit-btn">Submit</button>
				<a href="<?=$_SESSION['REFERER_page']?>" class="" ><button type="button" class="btn back-btn">Back</button></a>
			</div>				
			<div class="clearfix"></div>
			</div>
                <!-- E:Project Info Form -->
                                        

                <!-- S:Roof Details Form -->
                <div role="tabpanel" class="tab-pane <?php echo $active2;?>" id="roof_details">
                    <div class="list_wrapper list_wrapper5">
                    <?php if($numRowsRoof>0) {
                        $j=0;
                        while($roofFetchDetailsArr = $roofFetchDetailsQry->fetch_array())
                        { @extract($roofFetchDetailsArr); 
                    ?>
                    <!-- S:Edit-->
                        <div class="row" id="btrow<?=$j?>">
                            <div class="form-group col-md-12">
                                <h3>Roof Details:&nbsp;<?= $j+1;?></h3>
                            </div>
                            <div class="form-group col-md-1">
                                <label for="total-pannel" class="control-label">Total Panel</label>
                                <input type="number" min="1" class="form-control" name="total_panel[<?=$j?>]" id="total_panel[<?=$j?>]" value="<?=$total_panel?>">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="roofing_material" class="control-label">Roof Type</label>
                                <select class="form-control" id="roofing_material[<?=$j?>]" name="roofing_material[<?=$j?>]" <?= $readonly_field ?>>
                                    <option value="">Select Roof type</option>
                                    <?php $roofTypePriceArr = json_decode($customerPriceArr["roof_type_price"], true);
                                    foreach ($roofTypePriceArr as $rkey => $rvalue) {
                                    if ($rvalue["rfstatus"] == 1) {
                                        if ($roofing_material == $rvalue["name"]) {
                                            $rsel = 'selected';
                                            } else {
                                            $rsel = '';
                                        }
                                            echo '<option value="' . $rvalue["name"] . '" ' . $rsel . '>' . $rvalue["name"] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="roof-support" class="control-label">Roof Support</label><br>
                                <select class="form-control" id="roof_support[<?=$j?>]" name="roof_support[<?=$j?>]">
                                    <option value="">Select Roof Support</option>
                                        <option value="1" <?php if($roof_support == 1){ echo 'Selected';}?>>Råspont</option>
                                        <option value="2" <?php if($roof_support == 2){ echo 'Selected';}?>>No Råspont</option>
                                </select>
                            </div>
                            <div class="form-group col-md-1">
                                <label for="roof_angle" class="control-label">Roof Angle</label>
                                <input type="number" min="1" class="form-control" name="roof_angle[<?=$j?>]" id="roof_angle<?=$j?>" value="<?= $roof_angle ?>" <?= $readonly_field ?>>
                            </div>
							<div class="form-group col-md-2">
                                <label for="roof_length" class="control-label">Roof Height<span style="font-size:9px;">[in m]</span></label>
                                <input type="text" class="form-control" name="roof_height[<?=$i?>]" id="roof_height<?=$i?>" value="<?= $roof_height ?>" <?= $readonly_field ?>>
                            </div>
							<div class="form-group col-md-1">
                                <label for="roof_length" class="control-label">Length<span style="font-size:9px;">[in m]</span></label>
                                <input type="text" class="form-control" name="roof_length[<?=$j?>]" id="roof_length<?=$j?>" value="<?= $roof_length ?>" <?= $readonly_field ?>>
                            </div>
							<div class="form-group col-md-1">
                                <label for="roof_breath" class="control-label">Breath<span style="font-size:9px;">[in m]</span></label>
                                <input type="text" class="form-control" name="roof_breath[<?=$j?>]" id="roof_breath<?=$j?>" value="<?= $roof_breath ?>" <?= $readonly_field ?>>
                            </div>
                            <input type="hidden" name="rec_id[<?=$j?>]" value="<?= $id ?>">
                            
                            <div class="col-xs-1 col-sm-7 col-md-1">
                                <label for="remove" class="control-label">Action</label>
                                <a href="javascript:void(0);" class="list_remove_button btn btn-danger " onClick="remove_roof_details('<?= $id ?>')">-</a>
                            </div>
                        </div>
                        <input type="hidden" name="edit" value="1">        
                        <!-- E:Edit -->
                        <?php $j++; } } else{ ?>

                        <!-- S:create new -->
                        <div class="row" id="btrow<?=$j?>">
                            <div class="form-group col-md-1">
                                <label for="total-pannel" class="control-label">Total Panel</label>
                                <input type="number" class="form-control" name="total_panel[<?=$j?>]" id="total_panel[<?=$j?>]" min="1">
                             </div>
                            <div class="form-group col-md-3">
                                <label for="roofing_material" class="control-label">Roof Type</label>
                                <select class="form-control" id="roofing_material[<?=$j?>]" name="roofing_material[<?=$j?>]" <?= $readonly_field ?>>
                                    <option value="">Select Roof type</option>
                                    <?php $roofTypePriceArr = json_decode($customerPriceArr["roof_type_price"], true);
                                    foreach ($roofTypePriceArr as $rkey => $rvalue) {
                                    if ($rvalue["rfstatus"] == 1) {
                                        if ($roofing_material == $rvalue["name"]) {
                                            $rsel = 'selected';
                                            } else {
                                            $rsel = '';
                                        }
                                            echo '<option value="' . $rvalue["name"] . '" ' . $rsel . '>' . $rvalue["name"] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="roof-support" class="control-label">Roof Support</label><br>
                                <select class="form-control" id="roof_support[<?=$j?>]" name="roof_support[<?=$j?>]">
                                    <option value="">Select Roof Support</option>
                                        <option value="1">Råspont</option>
                                        <option value="2">No Råspont</option>
                                </select>
                            </div>
                            <div class="form-group col-md-1">
                                <label for="roof_angle" class="control-label">Roof Angle</label>
                                <input type="number" min="1" class="form-control" name="roof_angle[<?=$j?>]" id="roof_angle<?=$j?>" <?= $readonly_field ?>>
                            </div>
							<div class="form-group col-md-2">
                                <label for="roof_length" class="control-label">Roof Height<span style="font-size:9px;">[in m]</span></label>
                                <input type="text" class="form-control" name="roof_height[<?=$i?>]" id="roof_height<?=$i?>" value="<?= $roof_height ?>" <?= $readonly_field ?>>
                            </div>
							<div class="form-group col-md-1">
                                <label for="roof_length" class="control-label">Length<span style="font-size:9px;">[in m]</span></label>
                                <input type="text" class="form-control" name="roof_length[<?=$j?>]" id="roof_length<?=$j?>" <?= $readonly_field ?>>
                            </div>
							<div class="form-group col-md-1">
                                <label for="roof_breath" class="control-label">Breath<span style="font-size:9px;">[in m]</span></label>
                                <input type="text" class="form-control" name="roof_breath[<?=$j?>]" id="roof_breath<?=$j?>" <?= $readonly_field ?>>
                            </div>
                        </div>
                                    
                        <!-- E:create new -->
                        <?php } ?>
                    </div>
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <h3>Add New <button class="btn btn-primary list_add_button5" type="button">+</button></h3>
                        </div>
                        <input type="hidden" name="total_rec" id="total_rec" value="<?=$roof_details_count?>">
                        <div class="form-group col-sm-12">
                            <button type="submit" class="btn add-submit-btn" name="save" value="1">Save</button>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <!-- E:Roof Details Form -->
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
$("#leadstatus").change(function(){
	var lstatus = $(this).val();
	if(lstatus=="9"){
		$("#show-dimensioning-user").show();
		$("#show-dimensioning-priority").show();
	}else{
		$("#show-dimensioning-user").hide();
		$("#show-dimensioning-priority").hide();
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

<script>
function remove_img_file(id,name){
	if (confirm("Are you sure to delete?")) {
		$.ajax({
			type:"post",
			url: "<?=SITE_PATH_ADM.CPAGE?>/remove_img_file.php?id="+id+"&name="+name,
			success:function(result){
				if(parseInt(result)=='1'){
					$("#"+id).hide();
					//location.reload();
				}
				else{
					alert("Something went wrong.Pleas try again.")
				}
			}
		})
	}
}	
</script>
<!-- delete roof details-->
<script>
    function remove_roof_details(id){
        if(confirm("Are you sure to delete?")){
        $.ajax({
           type:"post",
           url:"<?= SITE_PATH_ADM . CPAGE ?>/remove_roof_details.php?id=" + id,
           success: function(result){
            if (parseInt(result) == '1') {
                $("#" + id).hide();
                location.reload();
                } else {
                    alert("Something went wrong.Pleas try again.")
                }
            } 
        })}
    }
</script>
<!-- adding new feilds in roof details -->
<script type="text/javascript">
    $(document).ready(function()
    {

        var list_maxField = 50; //Input fields increment limitation
    var x5 = "<?=$roof_details_count?>"; //Initial field counter
    if(<?=$roof_details_count?> !== 0)
    { x5 = x5-1; }
    // else{ x5= x5+1; }
    			 
	$('.list_add_button5').click(function()
	    {
            // alert(x5);
	    //Check maximum number of input fields
	    if(x5 < list_maxField){ 
	        x5++; //Increment field counter
	        var list_fieldHTML = '<div class="row"><div class="form-group col-md-1 "><label for="total-panel" class="control-label">Total Pannel</label><input type="number" class="form-control" name="total_panel['+x5+']" id="total_panel['+x5+']"></div><div class="form-group col-md-3 col-sm-4 col-xs-6"><label for="roofing_material" class="control-label">Roof Type</label><select class="form-control roof" id="roofing_material'+x5+'" name="roofing_material['+x5+']"  <?=$readonly_field ?>  ><option value="">Select Roof type</option><?php $roofTypePriceArr=json_decode($customerPriceArr["roof_type_price"], true);foreach ($roofTypePriceArr as $rkey=> $rvalue){if ($rvalue["rfstatus"]==1){ if ($roofing_material==$rvalue["name"]){$rsel='';}else{$rsel='';}echo '<option value="' . $rvalue["name"] . '" ' . $rsel . '>' . $rvalue["name"] . '</option>';}}?></select></div><div class="form-group col-md-2 col-sm-4 col-xs-6"><label for="roof-support" class="control-label">Roof Support</label><br><select class="form-control" id="roof_support['+x5+']" name="roof_support['+x5+']"><option value="">Select Roof Support</option><option value="1">Råspont</option><option value="2">No Råspont</option></select></div><div class="form-group col-md-1 col-sm-4 col-xs-6"><label for="roof_angle" class="control-label">Roof Angle</label><input type="text" class="form-control" name="roof_angle['+x5+']" id="roof_angle['+x5+']" ></div><div class="form-group col-md-2"><label for="roof_length" class="control-label">Roof Height</label><input type="text" class="form-control" name="roof_height['+x5+']" id="roof_height['+x5+']"  <?= $readonly_field ?>></div><div class="form-group col-md-1 col-sm-4 col-xs-6"><label for="roof_length" class="control-label">Length</label><input type="text" class="form-control" name="roof_length['+x5+']" id="roof_length['+x5+']" <?= $readonly_field ?>></div><div class="form-group col-md-1 col-sm-4 col-xs-6"><label for="roof_breath" class="control-label">Breath</label><input type="text" class="form-control" name="roof_breath['+x5+']" id="roof_breath['+x5+']"  <?= $readonly_field ?>></div><div class="col-xs-1 col-sm-7 col-md-1"><label for="remove" class="control-label">Action</label><br><a href="javascript:void(0);" class="list_remove_button btn btn-danger">-</a></div></div>';
	        $('.list_wrapper5').append(list_fieldHTML); //Add field html
            //var total_rec= $("#total_rec").val();
            var total_rec = parseInt($("#total_rec").val());
            total_rec = total_rec+1;
            //alert(total_rec);
            // total_rec =  parseInt('total_rec')+1;
             console.log(total_rec);
             $("#total_rec").val(total_rec);
            
	    }

        });

        //Once remove button is clicked
        $('.list_wrapper').on('click', '.list_remove_button', function()
        {
           $(this).closest('div.row').remove(); //Remove field html
           x5--; //Decrement field counter
           var total_rec = parseInt($("#total_rec").val());
            total_rec = total_rec-1;
            // alert(total_rec);
            // total_rec =  parseInt('total_rec')+1;
             console.log(total_rec);
             $("#total_rec").val(total_rec);
        });

    });
</script>


<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php
$action_message ='';
$pid = $_GET['id']; 
if($cms->is_post_back()){
	if($pid){ 
		$_POST["update_date"] = date("Y-m-d h:i:s");
		$cms->sqlquery("rs","leads",$_POST, 'id', $pid);
		if($_POST["lead_comment"]){
			$_CommentPoast["lead_comment"] = $_POST["lead_comment"];
			$_CommentPoast["lead_id"] = $pid;
			$_CommentPoast["post_by"] = $_SESSION["ses_adm_id"];
			$_CommentPoast["post_date"] = date('Y-m-d h:i:s');
			 
			$_CommentPoast["visit_call"] = $_POST["visit_call"];
			$_CommentPoast["next_call_date"] = $_POST["next_call_date"];
			$validImage  = array("jpg","jpeg","png","pdf","doc","docx");
			$end = pathinfo($_FILES['attched_file']['name'], PATHINFO_EXTENSION);// strtolower(end(explode(".",$_FILES['attched_file']['name']))); 
			if(in_array($end,$validImage)){
				if(!empty($_FILES["attched_file"]["name"])){
					$filename = rand(1000,100000)."-".$_FILES['attched_file']['name'];
					$file_loc = $_FILES['attched_file']['tmp_name'];
					$file_size = $_FILES['attched_file']['size'];
					$file_type = $_FILES['attched_file']['type'];
					$folder = FILES_PATH."files/";
					// new file size in KB
					$new_size = $file_size/1024;  
					// new file size in KB

					// make file name in lower case
					$new_file_name = strtolower($filename);
					// make file name in lower case

					$final_file=str_replace(' ','-',$new_file_name);
					$_CommentPoast["attched_file"] = $final_file;
					move_uploaded_file($file_loc,$folder.$final_file);
				}
			}
			if($_CommentPoast["visit_call"]>0){
				if(!empty($actionDateFrom)){
					$actionDateFrom = date("Y-m-d", strtotime($_POST["actionDateFrom"]));
					$_CommentPoast["action_from_date_time"] = $actionDateFrom." ".$_POST["actionTimeFrom"].":00";
				}
				if(!empty($actionDateTo)){
					$actionDateTo = date("Y-m-d", strtotime($_POST["actionDateTo"]));
					$_CommentPoast["action_to_date_time"] = $actionDateTo." ".$_POST["actionTimeTo"].":00";
				}
			}
			
			//print_r($_CommentPoast);die;
			$cms->sqlquery("rs","comments",$_CommentPoast);
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
			$action_message="Status Changed from ".$leadsStatusArr[$old_status]." to ".$leadsStatusArr[$status];
			$_POSTS["lead_id"] = $pid;
			$_POSTS["action_message"] = $action_message;
			$_POSTS["action_date"] = date('Y-m-d h:i:s');
			$_POSTS["action_by"] = $_SESSION["ses_adm_id"];
			$_POSTS["action"] = $_POST["status"];
			$cms->sqlquery("rs","lead_tracker",$_POSTS);
		}
		$adm->sessset('Record has been updated', 's');
	}
}

$rsAdmin = $cms->db_query("SELECT * FROM #_leads  WHERE id='".$pid."'");
$arrAdmin = $rsAdmin->fetch_array(); 
@extract($arrAdmin);

?>
<?php 	
	$disabled ="disabled";

?>
<!-- .row -->
<div class="row">
    <div class="col-sm-12">
        <div class="white-box panel-body">
			<div class="form-group col-sm-6">
				<h2>Lead Date : <?=date("Y-m-d",strtotime($post_date))?></h2>
			</div>
			<div class="form-group col-sm-6">
				<h2>Lead Form : <?=$leadFormType[$form_type]?></h2>
			</div>
			<div class="clearfix"></div>
			<?php if($form_type==1){?>
			<div class="col-md-12">
				<div class="col-md-2">
					<div class="form-group">
						<label class="control-label"><strong>Annual Savings:</strong></label>
						<input type="text" class="form-control" value="<?=$annual_savings?> kr" disabled>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label class="control-label"><strong>Total Cost:</strong></label>
						 <input type="text" class="form-control" value="<?=$total_cost?> kr" disabled>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label class="control-label"><strong>Green Sibsidy:</strong></label>
						 <input type="text" class="form-control" value="<?=$green_subsidy?> kr" disabled>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label class="control-label"><strong>Payback Time:</strong></label>
						 <input type="" class="form-control" value="<?=$payback_time?> Years" disabled>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label class="control-label"><strong>Yearly Energy Production:</strong></label>
						 <input type="" class="form-control" value="<?=$yearly_energy_production?> kWh" disabled>
					</div>
				</div>
				<div class="clearfix"></div><br>
			</div>
			<?php } ?>
		</div>
		<?php if($form_type==1){?>
		<div class="white-box panel-body">
			<div class="col-md-12">
				<div class="col-md-2">
					<div class="form-group">
						<label class="control-label"><strong>Area:</strong></label>
						<input type="text" class="form-control" value="<?=$roof_area?>" disabled>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label class="control-label"><strong>Solar Pnaels:</strong></label>
						 <input type="text" class="form-control" value="<?=$panels?>" disabled>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label class="control-label"><strong>Size:</strong></label>
						 <input type="text" class="form-control" value="<?=$size?> kW" disabled>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label class="control-label"><strong>Slop Type:</strong></label>
						 <input type="" class="form-control" value="<?=$slope_type?>" disabled>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label class="control-label"><strong>Panel Type:</strong></label>
						 <input type="" class="form-control" value="<?=$panel_type?>" disabled>
					</div>
				</div>
				<?php $addonArr = explode(':',$addon_type);	?>
				<div class="col-md-3">
					<div class="form-group">
						<label class="control-label"><strong>Battery:</strong></label>
						 <input type="" class="form-control" value="<?=in_array('at1',$addonArr)?'Yes':'No'?>" disabled>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label class="control-label"><strong>Car Charger:</strong></label>
						 <input type="" class="form-control" value="<?=in_array('at2',$addonArr)?'Yes':'No'?>" disabled>
					</div>
				</div>
				<div class="clearfix"></div><br>
			</div>
		</div>
		<?php } ?>
		
		
        <div class="white-box">
			
			<div class="form-group col-sm-4">
				<label for="customer_name" class="control-label">Name</label>
				<input type="text" name="customer_name" value="<?=$customer_name?>" class="form-control" id="customer_name" placeholder="Name" required data-fv-regexp="true"  data-error="Please enter valid Name" <?=$disabled?>>
			<div class="help-block with-errors"></div>	
			</div>
			<div class="form-group col-sm-4">
				<label for="email" class="control-label">Email</label>
				<input type="email" name="email" value="<?=$email?>" class="form-control" id="email" placeholder="Email" data-error="Email, that email address is invalid" <?=$disabled?>>
				<div class="help-block with-errors"></div>	
			</div>
			<div class="form-group col-sm-4">
				<label for="phone" class="control-label">Phone</label>
				<div class="ui-widget">
					<input id="phone" type="text" name="phone" value="<?=$phone?>" class="form-control" placeholder="Phone" data-error="Phone Number is invalid" maxlength="10" data-fv-regexp="true" pattern="[0-9]{10}" <?=$disabled?>>
				</div>
				<div class="help-block with-errors"></div>	
			</div>
			<div class="clearfix"></div>
			<?php if($form_type==3){?>			
			<div class="form-group col-sm-4">
				<label for="ort" class="control-label">Ort</label>
				<input type="text" name="ort" value="<?=$ort?>" class="form-control" id="ort" <?=$disabled?>>
				<div class="help-block with-errors"></div>	
			</div>
			<?php } ?>
			<div class="form-group col-sm-4">
				<label for="address_input" class="control-label">Address</label>
				<input type="text" name="address_input" value="<?=$address_input?>" class="form-control" id="address_input" placeholder="Address" <?=$disabled?>>
				<div class="help-block with-errors"></div>	
			</div>
			<div class="form-group col-sm-4">
				<label for="postal_code" class="control-label">Postal Code</label>
				<input type="text" name="postal_code" value="<?=$postal_code?>" class="form-control" id="postal_code" placeholder="Postal Code" <?=$disabled?>>
				<div class="help-block with-errors"></div>	
			</div>
			<?php if($form_type==2){?>
			<div class="form-group col-sm-4">
				<label for="city" class="control-label">City</label>
				<input type="text" name="city" value="<?=$city?>" class="form-control" id="city" <?=$disabled?>>
				<div class="help-block with-errors"></div>	
			</div>
			<?php } ?>
			<?php if($form_type==3){?>
			<div class="form-group col-sm-4">
				<label for="link_source" class="control-label">How did you hear about Arka Energy?</label>
				<input type="text" name="link_source" value="<?=$link_source?>" class="form-control" <?=$disabled?>>
			</div>
			<?php } ?>
			<?php if($form_type!=1){?>
			<div class="form-group col-sm-4">
				<label for="purpose" class="control-label">Purpose</label>
				<input type="text" name="purpose" value="<?=$purpose?>" class="form-control" <?=$disabled?>>
			</div>
			<div class="clearfix"></div>
			<div class="form-group col-sm-6">
				<label for="message" class="control-label">Message</label>
				<textarea name="message" class="form-control" cols="30" rows="5" <?=$disabled?>><?=$message?></textarea>
				<div class="help-block with-errors"></div>
			</div>
			<?php } ?>
			 
			<div class="clearfix"></div>
			<?php if($_SESSION["ses_adm_role"]=="1"){ 
					$showComment = TRUE;
			}else if(($status== 4 OR $status ==6) AND $_SESSION["ses_adm_role"]!="1"){
				$showComment = FALSE;
			}else{ 
			$showComment = TRUE;
			} 
			if($showComment == TRUE){?>
			<div class="form-group col-sm-6">
				<label for="inputName1" class="control-label">Comment</label>
				<textarea name="lead_comment" class="form-control" cols="30" rows="5" placeholder="Lead Comment" ></textarea>
				<div class="help-block with-errors"></div>
				<div class="clearfix"></div>
				<!--<div class="form-group col-sm-12">
					<label for="inputName1" class="control-label">Attachment</label>
					<div class="fileinput fileinput-new input-group" data-provides="fileinput">
						<div class="form-control" data-trigger="fileinput"> 
							<i class="glyphicon glyphicon-file fileinput-exists"></i> 
							<span class="fileinput-filename"><?=$attched_file?></span>
						</div>
						<span class="input-group-addon btn btn-default btn-file"> 
							<span class="fileinput-new">Select file</span> 
							<span class="fileinput-exists">Change</span>
							<input type="hidden">
							<input type="file" name="attched_file">
						</span> 
						<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a> 
					</div>
				</div>
				<div class="clearfix"></div>-->
				
				<div class="form-group col-sm-12">
					<label for="inputPassword" class="control-label">Next Call Date/Time</label>
					<div class="clearfix"></div>
					<?php  
						if(!empty($next_call_date)){
							$callDateArr = explode(" ", $next_call_date);
							if(!empty($callDateArr[0])){
								$lead_date = date("m/d/Y", strtotime($callDateArr[0]));
								$lead_time =substr($callDateArr[1], 0, -3);
							}else{
								$lead_date = "";
								$lead_time = "";
							}
						}else{
							$lead_date = "";
							$lead_time = "";
						}
					?>
					<div class="input-group  col-sm-6" style="float:left">
						<input class="form-control" id="datepicker-autoclose" placeholder="mm/dd/yyyy" type="text" name="lead_date" value="">
						<span class="input-group-addon"><i class="icon-calender"></i></span> 
					</div>
					<div class="input-group  clockpicker  col-sm-6" data-placement="top" data-align="top" data-autoclose="true"> 
						<input class="form-control" value="" type="text" name="lead_time" >
						<span class="input-group-addon"> <span class="glyphicon glyphicon-time"></span> </span> 
					</div>
					<div class="help-block with-errors"></div>	
				</div>
				<div class="clearfix"></div>
				<div class="form-group col-sm-12">
				<label for="inputPassword" class="control-label">Visit/Call</label>
					<select class="form-control" name="visit_call" onChange="visitCall(this.value)">
						<option value="" >Select</option>
						<option value="0" >Call</option>
						<option value="1" >Visit</option>
					</select>
					<div class="help-block with-errors"></div>	
				</div>
				<div class="clearfix"></div>
				<div class="form-group col-sm-12" id="hide_from_call">
					<label for="inputPassword" class="control-label">From  Date Time</label>
					<div class="clearfix"></div>
					<?php  
						if(!empty($action_from_date_time)){
							$callDateArr = explode(" ", $action_from_date_time);
							if(!empty($callDateArr[0])){
								$actionDateFrom = date("m/d/Y", strtotime($callDateArr[0]));
								$actionTimeFrom =substr($callDateArr[1], 0, -3);
							}else{
								$actionDateFrom =  date("m/d/Y");
								$actionTimeFrom = "";
							}
						}else{
							$actionDateFrom =  date("m/d/Y");
							$actionTimeFrom = "";
						}
					?>
					<div class="input-group  col-sm-6" style="float:left">
						<input class="form-control actionDateFrom" id="datepicker-autoclose1" placeholder="mm/dd/yyyy" type="text" name="actionDateFrom" value="<?=$actionDateFrom?>">
						<span class="input-group-addon"><i class="icon-calender"></i></span> 
					</div>
					<div class="input-group  clockpicker  col-sm-6" data-placement="top" data-align="top" data-autoclose="true"> 
						<input class="form-control" id="actionTimeFrom" value="<?=$actionTimeFrom?>" type="text" name="actionTimeFrom" >
						<span class="input-group-addon"> <span class="glyphicon glyphicon-time"></span> </span> 
					</div>
					<div class="help-block with-errors"></div>	
				</div>
				<div class="clearfix"></div>
				<div class="form-group col-sm-12"  id="hide_from_call_to_date">
					<label for="inputPassword" class="control-label">To Date Time</label>
					<div class="clearfix"></div>
					<?php  
						if(!empty($action_to_date_time)){
							$callDateArr = explode(" ", $action_to_date_time);
							if(!empty($callDateArr[0])){
								$actionDateTo = date("m/d/Y", strtotime($callDateArr[0]));
								$actionTimeTo =substr($callDateArr[1], 0, -3);
							}else{
								$actionDateTo =  date("m/d/Y");
								$actionTimeTo = "";
							}
						}else{
							$actionDateTo =  date("m/d/Y");
							$actionTimeTo = "";
						}
					?>
					<div class="input-group  col-sm-6" style="float:left">
						<input class="form-control actionDateTo" id="datepicker-autoclose2" placeholder="mm/dd/yyyy" type="text" name="actionDateTo" value="<?=$actionDateTo?>">
						<span class="input-group-addon"><i class="icon-calender"></i></span> 
					</div>
					<div class="input-group  clockpicker  col-sm-6" data-placement="top" data-align="top" data-autoclose="true"> 
						<input class="form-control" id="actionTimeTo" value="<?=$actionTimeTo?>" type="text" name="actionTimeTo" >
						<span class="input-group-addon"> <span class="glyphicon glyphicon-time"></span> </span> 
					</div>
					<div class="help-block with-errors"></div>	
				</div>
				<div class="clearfix"></div>
				<div class="form-group col-sm-12">
				<label for="inputPassword" class="control-label">Status<input type="hidden" name="old_status" value="<?php echo $status; ?>"></label>
					<select class="form-control" name="status" required  >
						<?php foreach($leadsStatusArr as $statusId=>$statusName){ ?>
						<?php if($status==0 && $statusId<=2){?>
						<option value="<?=$statusId?>" <?=(($status==$statusId)?'selected="selected"':'')?>><?=$statusName?></option>
						<?php } elseif($_SESSION["ses_adm_type"]=='Sales Person' && $status>=3 && $statusId>=3) {?>
						<option value="<?=$statusId?>" <?=(($status==$statusId)?'selected="selected"':'')?>><?=$statusName?></option>
						<?php } elseif($status!=0 && $statusId>0){?>
						<option value="<?=$statusId?>" <?=(($status==$statusId)?'selected="selected"':'')?>><?=$statusName?></option>
						<?php } } ?>
					</select>
					<div class="help-block with-errors"></div>	
				</div>
				
				<div class="clearfix"></div>
				<div class="form-group col-sm-12">
					<button type="submit" class="btn btn-primary">Submit</button>
					<button type="reset" class="btn btn-primary">Reset</button>
				</div>				
			</div>
			<?php } else{  ?> 
			<div class="form-group col-sm-12">
				<label for="inputPassword" class="control-label">Status - </label>
				<label for="inputPassword" class="control-label"><?=$leadsStatusArr[$status];?></label>
			</div>	
			<?php } ?>
			<div class="col-md-6 col-xs-12 col-sm-6">
				<div class="white-box">
				<h3 class="box-title">All Comments</h3>
					<div class="message-center scroll_bar" > 
						<?php if(isset($_REQUEST['id'])){
							$leadCommentQr = $cms->db_query("SELECT `id`, `lead_comment`, `lead_id`, `post_by`, `post_date`, `lead_status`, `attched_file`, `action_from_date_time`, `action_to_date_time`, `visit_call`, `next_call_date` FROM #_lead_comments WHERE lead_status='1' and lead_id='".$_REQUEST['id']."' ORDER BY id DESC");
							while($leadCommentRes = $leadCommentQr->fetch_array()){
							?>
								<div class="message_div"> 
									<div class="user-img"> <img src="<?=SITE_PATH_ADM?>images/blankuser.png" alt="user" class="img-circle">  </div>
									<div class="mail-contnet">
										<h5><?=$cms->getSingleResult("SELECT customer_name FROM #_users WHERE id='".$leadCommentRes["post_by"]."'");?>
										<span class="time"><?=$leadCommentRes["post_date"]?></span></h5>
										<span class="mail-desc">
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
											
											 ?><br>
											<?php 
											if($leadCommentRes["next_call_date"]!="0000-00-00 00:00:00"){ 
												echo "Next Call Date: ".$leadCommentRes["next_call_date"]."<br>"; 
											} ?>
											
											<?php $attachFiles = FILES_PATH.'files/'; ?>
											<?php if(!empty($leadCommentRes["attched_file"]) AND file_exists($attachFiles.$leadCommentRes["attched_file"])) { ?>
											<a href="<?=SITE_PATH?>uploaded_files/files/<?=$leadCommentRes["attched_file"]?>" target="_blank" data-toggle="tooltip" data-original-title="Attached File" style="border-bottom: 0;padding: 0;"><i class="ti-link"></i><?=$leadCommentRes["attched_file"]?></a>
											<?php } ?></span>
										<span class="mail-desc"></span> 
									</div>
									<div class="clearfix"></div>
								</div> 
						<?php } 
						} ?> 
					</div>
				</div>
			</div>
			
			<div class="clearfix"></div>
        </div>
	</div>
</div>
 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
$(function() {
    $("#skills").autocomplete({
        source: 'autoloadContact.php',
		select: function (event, ui) {
			//alert(ui.item.value);
			var label = ui.item.label;
			var value = ui.item.value;
			$("#skills").val(ui.item.label);
            
		   //store in session
		  location.href='<?=SITE_PATH_ADM?>leads/?mode=add&start=<?=$_GET['start']?>&id='+ui.item.value;
		  return false;
		}
    });
});
$("#actionTimeTo").change(function() {
	var actionDateFrom = $(".actionDateFrom").val();
	var actionTimeFrom = $("#actionTimeFrom").val();
	actionTimeFrom = actionTimeFrom.replace(":", "/");
	var NewTimeFrom = actionDateFrom+"/"+actionTimeFrom;
	var arrdt= NewTimeFrom.split("/");
	var fromDate = new Date(arrdt[2], arrdt[1] - 1, arrdt[0],arrdt[3],arrdt[4]);
	
	var actionDateTo = $(".actionDateTo").val();
	var actionTimeTo = $("#actionTimeTo").val();
	actionTimeTo = actionTimeTo.replace(":", "/");
	var NewTimeTo = actionDateTo+"/"+actionTimeTo;
	var arrdt1 = NewTimeTo.split("/");
	var toDate = new Date(arrdt1[2], arrdt1[1] - 1, arrdt1[0],arrdt1[3],arrdt1[4]);
	if (fromDate > toDate) {
		alert("Please use To date greate than From date");
		$(".actionDateTo").val(actionDateFrom);
		$("#actionTimeTo").val("");
	}
}); 
 
function visitCall(vals){
	if(vals=='0' || vals=='2'){
		$("#hide_from_call").hide();
		$("#hide_from_call_to_date").hide();
	}else{
		$("#hide_from_call").show();
		$("#hide_from_call_to_date").show();
	}
}
</script>
 
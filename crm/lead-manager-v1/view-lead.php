<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php
$action_message ='';
$pid = $_GET['id']; 
if($cms->is_post_back()){ 
	
}  
	$rsAdmin = $cms->db_query("select id, source, name, phone, email,countryid, address, city, state, pin_code, message, status, assigned_user_type, assigned_to, assigned_date, lead_date, next_call_date from #_lead_management where id='".$pid."'");
	$arrAdmin = $rsAdmin->fetch_array(); 
	@extract($arrAdmin);
	$SQLSTATE = "SELECT pid, state FROM #_states WHERE status='1'"; 
 
?>
<?php 	
$disabled ="disabled";
$contriesReq = $cms->db_query("SELECT id, name FROM #_countries WHERE status=1 ORDER BY name ASC ");
$contriesArr = array();
while($contriesRes=$contriesReq->fetch_assoc()){
	$contriesArr[$contriesRes["id"]] = $contriesRes["name"];
}
$stateArr = array();
$stateRe2 = $cms->db_query($SQLSTATE);
while($stateRes = $stateRe2->fetch_array()){
	$stateArr[$stateRes["pid"]] = $stateRes["state"];
}
$stateHTML ='<select class="form-control select2" name="state" id="state" title="State" data-error="Please select state" data-fv-regexp="true" required >';
foreach($stateArr as $stKey=>$stVal){  
	$stateHTML .='<option value="'.$stKey.'">'.$stVal.'</option>';
} 
$stateHTML .='</select>';
?>
<!-- .row -->
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
			
			<div class="form-group col-sm-4">
				<label for="inputName1" class="control-label">Phone</label>
				<div class="ui-widget">
					<input id="skills"  type="text" name="phone" value="<?=$phone?>" class="form-control" placeholder="Phone" required  data-error="Phone Number is invalid"  data-fv-regexp="true" pattern="[0-9]{7,15}" <?=$disabled?> >
				</div>
				<!--<input type="text" name="phone" value="<?=$phone?>" class="form-control" id="inputName1" placeholder="Phone" required  data-error="Phone Number is invalid"  data-fv-regexp="true" pattern="[0-9]{10,12}"  <?=$disabled?>>-->
				<div class="help-block with-errors"></div>	
			</div>
			<div class="form-group col-sm-6">
				<label for="inputName1" class="control-label">Customer Name</label>
				<input type="text" name="name" value="<?=$name?>" class="form-control" id="inputName1" placeholder="Customer Name" required data-fv-regexp="true" pattern="[A-Za-z &.-]{3,150}"  data-error="Please enter valid Customer Name"  <?=$disabled?>>
				<div class="help-block with-errors"></div>	
			</div>
			<div class="form-group col-sm-2">
				<label for="inputPassword" class="control-label">Source</label>
				<select class="form-control" name="source" required  data-error="Please select source" <?=$disabled?>>
					<option value="Manual" <?=(($source=='Manual')?'selected="selected"':'')?>>Manual</option>
					<option value="PPC" <?=(($source=='PPC')?'selected="selected"':'')?>>PPC</option>
				</select>
				<div class="help-block with-errors"></div>	
            </div>
			
			<div class="clearfix"></div>
			<div class="form-group col-sm-4">
				<label for="inputName1" class="control-label">Email</label>
				<input type="email" name="email" value="<?=$email?>" class="form-control" id="inputName1" placeholder="Email" required data-error="Email, that email address is invalid"  <?=$disabled?>>
				<div class="help-block with-errors"></div>	
			</div>
			
			<div class="form-group col-sm-8">
				<label for="inputName1" class="control-label">Address</label>
				<input type="text" name="address" value="<?=$address?>" class="form-control" id="inputName1" placeholder="Address" required  required data-error="Please enter Address" <?=$disabled?>>
				<div class="help-block with-errors"></div>	
			</div>			
			<div class="clearfix"></div>
			<div class="form-group col-sm-3">
				<label for="inputName1" class="control-label">Country</label>
				<?php if(!empty($disabled)){ ?>
					<input type="text" name="countryid" value="<?=$cms->getSingleResult("SELECT name FROM #_countries WHERE id='".$countryid."'")?>" class="form-control" id="countryid"  title="Country" placeholder="Country"  data-error="Please select Country" data-fv-regexp="true"  required <?=$disabled?>>
				<?php }else{ ?>
				<select class="form-control select2" name="countryid" id="countryid" title="Country" data-error="Please select Country" data-fv-regexp="true" required <?=$disabled?>>
				<option value="">Select</option>
					<?php 
					foreach($contriesArr as $key=>$vals){ ?> 
					<option value="<?=$key?>" <?=(($countryid==$key)?'selected="selected"':'')?>><?=$vals?></option>
					<?php } ?> 
				</select>
				<?php } ?>
				
				<div class="help-block with-errors"></div>	
			</div>
			<div class="form-group col-sm-3" >
				<label for="inputName1" class="control-label">State</label>
				<?php if(!empty($disabled)){ if($state>0){ $states = $cms->getSingleResult("SELECT state FROM #_states WHERE pid='".$state."'"); }else{ $states = $state;}?>
					<input type="text" name="state" value="<?=$states?>" class="form-control" id="state"  title="State" placeholder="State"  data-error="Please select state" data-fv-regexp="true"  required <?=$disabled?>>
				<?php }else{ ?>
				<span id="changeState">
				<?php if($state>0){ ?>
					<select class="form-control select2" name="state" id="state" title="State" data-error="Please select state" data-fv-regexp="true" required <?=$disabled?>>
					<?php foreach($stateArr as $stKey=>$stVal){  ?>
						<option value="<?=$stKey?>" <?=(($state==$stKey)?'selected="selected"':'')?>><?=$stVal?></option>
					<?php } ?> 
				</select>
				<?php }else{ ?>
					<input type="text" name="state" value="<?=$state?>" class="form-control" id="state"  title="State" placeholder="State"  data-error="Please select state" data-fv-regexp="true"  required <?=$disabled?>>
				<?php } ?>
				</span>
				<?php } ?>
				
				<div class="help-block with-errors"></div>	
			</div>
			<div class="form-group col-sm-3">
				<label for="inputName1" class="control-label">City</label>
				<input type="text" name="city" value="<?=$city?>" class="form-control" id="city" placeholder="City" required data-error="Please enter city"   <?=$disabled?>>
				<div class="help-block with-errors"></div>	
			</div>
			
			
			<div class="form-group col-sm-3">
				<label for="inputName1" class="control-label">Pin Code</label>
				<input type="text" name="pin_code" value="<?=$pin_code?>" class="form-control" id="inputName1" placeholder="Pin Code" required data-fv-regexp="true" data-error="Please enter valid pin code"  <?=$disabled?>>
				<div class="help-block with-errors"></div>	
			</div>
			<div class="clearfix"></div>	
			<div class="form-group col-sm-12">
				<label for="inputName1" class="control-label">Message</label>
			
				<textarea name="message" required class="form-control"  <?=$disabled?> cols="60" rows="5" placeholder="Enter your requirements" ><?=$message?></textarea>
				<div class="help-block with-errors"></div>	
			</div>
			 
			<div class="clearfix"></div>
			<?php if($_SESSION["ses_adm_type"]=="Super Admin"){ 
					$showComment = TRUE;
			}else if(($status== 4 OR $status ==6) AND $_SESSION["ses_adm_type"]!="Super Admin"){
				$showComment = FALSE;
			}else{ 
			$showComment = TRUE;
			} 
			if($showComment == TRUE){?>
			<div class="form-group col-sm-6">
				<label for="inputName1" class="control-label">Comment</label>
				<textarea name="lead_comment" class="form-control" cols="30" rows="5" placeholder="Lead Comment" <?=$disabled?>></textarea>
				<div class="help-block with-errors"></div>
				<div class="clearfix"></div>
				<div class="form-group col-sm-12">
					<label for="inputName1" class="control-label">Attachment</label>
					<div class="fileinput fileinput-new input-group" data-provides="fileinput">
						<div class="form-control" data-trigger="fileinput"> 
							<i class="glyphicon glyphicon-file fileinput-exists"></i> 
							<span class="fileinput-filename"><?=$attched_file?></span>
						</div>
						<span class="input-group-addon btn btn-default btn-file"> 
							<span class="fileinput-new"  <?=$disabled?>>Select file</span> 
							<span class="fileinput-exists">Change</span>
							<input type="hidden">
							<input type="file" name="attched_file"  <?=$disabled?>>
						</span> 
						<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a> 
					</div>
				</div>
				<div class="clearfix"></div>
				
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
						<input class="form-control" id="datepicker-autoclose" placeholder="mm/dd/yyyy" type="text" name="lead_date" value="" <?=$disabled?>>
						<span class="input-group-addon"><i class="icon-calender"></i></span> 
					</div>
					<div class="input-group  clockpicker  col-sm-6" data-placement="top" data-align="top" data-autoclose="true"> 
						<input class="form-control" value="" type="text" name="lead_time" <?=$disabled?>>
						<span class="input-group-addon"> <span class="glyphicon glyphicon-time"></span> </span> 
					</div>
					<div class="help-block with-errors"></div>	
				</div>
				<div class="clearfix"></div>
				<div class="form-group col-sm-12">
				<label for="inputPassword" class="control-label">Visit/Call</label>
					<select class="form-control" name="visit_call" <?=$disabled?>>
						<option value="" >Select</option>
						<option value="0"  <?=(($visit_call=='0')?'selected="selected"':'')?>>Call</option>
						<option value="1" <?=(($visit_call=='1')?'selected="selected"':'')?>>Visit</option>
					</select>
					<div class="help-block with-errors"></div>	
				</div>
				<div class="clearfix"></div>
				<div class="form-group col-sm-12">
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
						<input class="form-control actionDateFrom" id="datepicker-autoclose1" placeholder="mm/dd/yyyy" type="text" name="actionDateFrom" value="<?=$actionDateFrom?>" <?=$disabled?>>
						<span class="input-group-addon"><i class="icon-calender"></i></span> 
					</div>
					<div class="input-group  clockpicker  col-sm-6" data-placement="top" data-align="top" data-autoclose="true"  <?=$disabled?>> 
						<input class="form-control" id="actionTimeFrom" value="<?=$actionTimeFrom?>" type="text" name="actionTimeFrom" <?=$disabled?> >
						<span class="input-group-addon "> <span class="glyphicon glyphicon-time"></span> </span> 
					</div>
					<div class="help-block with-errors"></div>	
				</div>
				<div class="clearfix"></div>
				<div class="form-group col-sm-12">
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
						<input class="form-control actionDateTo" id="datepicker-autoclose2" placeholder="mm/dd/yyyy" type="text" name="actionDateTo" value="<?=$actionDateTo?>"  >
						<span class="input-group-addon"  <?=$disabled?>><i class="icon-calender"></i></span> 
					</div>
					<div class="input-group  clockpicker  col-sm-6" data-placement="top" data-align="top" data-autoclose="true"  <?=$disabled?>> 
						<input class="form-control" id="actionTimeTo" value="<?=$actionTimeTo?>" type="text" name="actionTimeTo" <?=$disabled?> >
						<span class="input-group-addon"> <span class="glyphicon glyphicon-time"></span> </span> 
					</div>
					<div class="help-block with-errors"></div>	
				</div>
				<div class="clearfix"></div>
				<div class="form-group col-sm-12">
				<label for="inputPassword" class="control-label">Status<input type="hidden" name="old_status" value="<?php echo $status; ?>"></label>
					<select class="form-control" name="status" required <?=$disabled?> >
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
					
					<a href="<?=SITE_PATH_ADM?>daily-activity-reports/" class="btn btn-primary">Back</a>
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
						$leadCommentQr = $cms->db_query("SELECT * FROM #_comments WHERE lead_status='1' and lead_id='".$_REQUEST['id']."' ORDER BY id DESC");
						while($leadCommentRes = $leadCommentQr->fetch_array()){
						?>
						<div class="message_div"> 
					 		<div class="user-img"> <img src="<?=SITE_PATH_ADM?>images/users/blankuser.png" alt="user" class="img-circle">  </div>
							<div class="mail-contnet">
								<h5><?=$cms->getSingleResult("SELECT CONCAT(fname, ' ', lname) as fullname FROM #_administrator WHERE id='".$leadCommentRes["post_by"]."'");?><span class="time"><?=$leadCommentRes["post_date"]?></span></h5>
								<span class="mail-desc"><?=$leadCommentRes["lead_comment"]?>
									<br>
									<?php 
									if($leadCommentRes["visit_call"]==0){
										$visits = "Call";
									}else if($leadCommentRes["visit_call"]==1){
										$visits = "Visit";
									}else {
										$visits = "";
									}
									if($leadCommentRes["action_from_date_time"]){ 
										echo "Action: ".$visits." (".$leadCommentRes["action_from_date_time"];} ?>
									<?php if($leadCommentRes["action_to_date_time"]){echo " To "; echo $leadCommentRes["action_to_date_time"];} echo ")";?><br>
									<?php if($leadCommentRes["next_call_date"]!="0000-00-00 00:00:00"){echo "Next Call Date: ".$leadCommentRes["next_call_date"]."<br>";} ?>
									
								<?php $attachFiles = SITE_FS_PATH.'/uploaded_files/files/';?>
									<?php if(!empty($leadCommentRes["attched_file"]) AND file_exists($attachFiles.$leadCommentRes["attched_file"])) { ?>
									<a href="<?=SITE_PATH?>uploaded_files/files/<?=$leadCommentRes["attched_file"]?>" target="_blank" data-toggle="tooltip" data-original-title="Attached File" style="border-bottom: 0;padding: 0;"><i class="ti-link"></i></a>
									<?php } ?></span>
								<span class="mail-desc"></span> 
							</div>
							<div class="clearfix"></div>
						</div> 
						<?php } } ?>
							 
						
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
$("#countryid").change(function(){
	if($(this).val() =='99'){
		$("#changeState").html('<?=$stateHTML?>');
		$('select').select2();
	}else{
		$("#changeState").html('<input type="text" name="state" value="" class="form-control" id="state"  title="State" placeholder="State"  data-error="Please select state" data-fv-regexp="true"  required />');
	}
});
</script>
 
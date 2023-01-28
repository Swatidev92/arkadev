<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php
$action_message ='';
$pid = $_GET['id'];
if($_SESSION['REFERER_page']==''){
$_SESSION['REFERER_page']=$_SERVER['HTTP_REFERER'];
}


$rsAdmin = $cms->db_query("select * from #_leads where id='".$pid."'");
$arrAdmin = $rsAdmin->fetch_array(); 
@extract($arrAdmin);

if($proposal_type!='' && $proposal_type!=0){
	$address_input = $proposal_address;
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
</style>
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
				<input type="text" name="customer_name" value="<?=$customer_name?>" class="form-control" id="customer_name" placeholder="Name" required data-fv-regexp="true"  data-error="Please enter valid Name" disabled>
			<div class="help-block with-errors"></div>	
			</div>
			<div class="form-group col-sm-4">
				<label for="email" class="control-label">Email</label>
				<input type="email" name="email" value="<?=$email?>" class="form-control" id="email" placeholder="Email" data-error="Email, that email address is invalid" disabled>
				<div class="help-block with-errors"></div>	
			</div>
			<div class="form-group col-sm-4">
				<label for="phone" class="control-label">Phone</label>
				<div class="ui-widget">
					<input id="phone" type="text" name="phone" value="<?=$phone?>" class="form-control" placeholder="Phone" data-error="Phone Number is invalid" maxlength="10" data-fv-regexp="true" pattern="[+0-9]{10,13}" disabled>
				</div>
				<div class="help-block with-errors"></div>	
			</div>
			<div class="clearfix"></div>
			<?php if($form_type==3){?>			
			<div class="form-group col-sm-4">
				<label for="ort" class="control-label">Ort</label>
				<input type="text" name="ort" value="<?=$ort?>" class="form-control" id="ort" disabled>
				<div class="help-block with-errors"></div>	
			</div>
			<?php } ?>
			<div class="form-group col-sm-4">
				<label for="address_input" class="control-label">Address</label>
				<input type="text" name="address_input" value="<?=$address_input?$address_input:$proposal_address?>" class="form-control" id="address_input" placeholder="Address" disabled>
				<div class="help-block with-errors"></div>	
			</div>
			<div class="form-group col-sm-4">
				<label for="postal_code" class="control-label">Postal Code</label>
				<input type="text" name="postal_code" value="<?=$postal_code?>" class="form-control" id="postal_code" placeholder="Postal Code" disabled>
				<div class="help-block with-errors"></div>	
			</div>
			<?php if($form_type==2){?>
			<div class="form-group col-sm-4">
				<label for="city" class="control-label">City</label>
				<input type="text" name="city" value="<?=$city?>" class="form-control" id="city" disabled>
				<div class="help-block with-errors"></div>	
			</div>
			<?php } ?>
			<?php if($form_type==3){?>
			<div class="form-group col-sm-4">
				<label for="link_source" class="control-label">How did you hear about Arka Energy?</label>
				<input type="text" name="link_source" value="<?=$link_source?>" class="form-control" disabled>
			</div>
			<?php } ?>
			<?php if($form_type!=1){?>
			<div class="form-group col-sm-4">
				<label for="purpose" class="control-label">Purpose</label>
				<input type="text" name="purpose" value="<?=$purpose?>" class="form-control" disabled>
			</div>
			<div class="clearfix"></div>
			<div class="form-group col-sm-6">
				<label for="message" class="control-label">Message</label>
				<textarea name="message" class="form-control" cols="30" rows="5" disabled><?=$message?></textarea>
				<div class="help-block with-errors"></div>
			</div>
			<?php } ?>
			<div class="clearfix"></div>
			
			
			<?php //if($assigned_date){ ?>
			<div class="form-group col-sm-6">
				<label for="inputPassword" class="control-label">Lead Assigned Date</label>
				<input type="text" value="<?=$assigned_date?>" class="form-control" disabled>
            </div>
			<div class="clearfix"></div>
			<?php if($_SESSION["ses_adm_role"]=="1"){
				$admQry = '';
			}else{
				$admQry = ' AND id='.$_SESSION["ses_adm_id"];
			} ?>  
			<div class="form-group col-sm-6">
				<label for="inputPassword" class="control-label">Lead Assigned to</label>
				<input type="hidden" name="old_assigned_to" value="<?php echo $assigned_to; ?>">
				<select class="form-control" name="assigned_to" data-error="Please select assigned to" disabled>
					<option value="">Select Agent</option>
					<?php $userQry=$cms->db_query("select id, customer_name from #_users where role='3' $admQry ");
					while($userRes=$userQry->fetch_array()){?>
						<option <?=($userRes['id']==$assigned_to)?"selected":"";?> value="<?=$userRes['id']?>"><?=$userRes['customer_name']?></option>
					<?php } ?>
				</select>
				<div class="help-block with-errors"></div>	
            </div>
			
			<?php //} ?>
			<?php //} ?>
			<div class="form-group col-sm-6">
				<label for="inputPassword" class="control-label">Lead Type</label>
				<select class="form-control" name="source" required  data-error="Please select source" disabled>
					<?php foreach($leadSourceArr as $leadSourceID=>$leadSourceName){ ?>
						<option <?=($source==$leadSourceID)?"selected":"";?> value="<?=$leadSourceID?>"><?=$leadSourceName?></option>
					<?php } ?>
				</select>
				<div class="help-block with-errors"></div>	
            </div>
			<div class="clearfix"></div>
			<?php
			$showComment = TRUE;
			if($showComment == TRUE){ ?>
			<div class="form-group col-sm-6">
				<label for="inputName1" class="control-label">Comment</label>
				<textarea name="lead_comment" class="form-control" cols="30" rows="5" placeholder="Lead Comment" disabled></textarea>
				<div class="help-block with-errors"></div>
				<div class="clearfix"></div>
				<div class="form-group col-sm-12">
					<label for="inputPassword" class="control-label">Status<input type="hidden" name="old_status" value="<?php echo $status; ?>"></label>
					<select class="form-control leadStatuss" name="status" disabled>
						<?php foreach($leadsStatusArr as $statusId=>$statusName){ ?>
							<option <?=$statusId==$status?"selected":""?> value="<?=$statusId?>"><?=$statusName?></option>
						<?php }  ?>
					</select>
					<div class="help-block with-errors"></div>	
				</div>
				<div class="clearfix"></div>
				<div class="form-group col-sm-12 actionDateTime_div1">
					<label for="inputPassword" class="control-label">Action Date/Time</label>
					<div class="clearfix"></div>
					<?php  
						/*if(!empty($next_call_date)){
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
						}*/
					?>
					<div class="input-group  col-sm-6" style="float:left">
						<input class="form-control" id="datepicker-autoclose" placeholder="mm/dd/yyyy" type="text" name="lead_date" value="" disabled>
						<span class="input-group-addon"><i class="icon-calender"></i></span> 
					</div>
					<div class="input-group  clockpicker  col-sm-6" data-placement="top" data-align="top" data-autoclose="true"> 
						<input class="form-control" value="" type="text" name="lead_time" disabled>
						<span class="input-group-addon"> <span class="glyphicon glyphicon-time"></span> </span> 
					</div>
					<div class="help-block with-errors"></div>	
				</div>
				<div class="clearfix"></div>
				
				<div class="clearfix"></div>
				
				<div class="form-group col-sm-12">
					<a href="<?=$_SESSION['REFERER_page']?>" class="" ><button type="button" class="btn btn-primary">Back</button></a>
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
				<ul class="nav nav-tabs">
				  <li class="active"><a data-toggle="tab" href="#home">Comments History</a></li>
				  <li><a data-toggle="tab" href="#menu1">Status History</a></li>
				</ul>
				<div class="tab-content">
				  <div id="home" class="tab-pane fade in active">
					<h3>Comments History</h3>
					<div class="message-center scroll_bar" > 
						<?php if(isset($_REQUEST['id'])){ $i=0;
							$leadCommentQr = $cms->db_query("SELECT `id`, `lead_comment`, `lead_id`, `post_by`, `post_date`, `lead_status`, `attched_file`, `action_from_date_time`, `action_to_date_time`, `visit_call`, `next_call_date` FROM #_lead_comments WHERE lead_status='1' and lead_id='".$_REQUEST['id']."' ORDER BY id DESC");
							if($leadCommentQr->num_rows>0){
							while($leadCommentRes = $leadCommentQr->fetch_array()){
							?>
								<div class="message_div" style="padding:10px;<?=$i%2==0?"background:#e8e8e8":"";?>"> 
									<div class="user-img"> <img src="<?=SITE_PATH_ADM?>images/blankuser.png" alt="user" class="img-circle">  </div>
									<div class="mail-contnet">
										<h5><?=$cms->getSingleResult("SELECT customer_name FROM #_users WHERE id='".$leadCommentRes["post_by"]."'");?>
										<span class="time pull-right"><br><?=$leadCommentRes["post_date"]?></span></h5>
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
											<?php 
											if($leadCommentRes["next_call_date"]!="0000-00-00 00:00:00" && !empty($leadCommentRes["next_call_date"])){ 
												echo "<b class='pull-right' style='color:#f89652'>Action Date: ".$leadCommentRes["next_call_date"]."</b><br>"; 
											} ?>
											
											<?php $attachFiles = FILES_PATH.'files/'; ?>
											<?php if(!empty($leadCommentRes["attched_file"]) AND file_exists($attachFiles.$leadCommentRes["attched_file"])) { ?>
											<a href="<?=SITE_PATH?>uploaded_files/files/<?=$leadCommentRes["attched_file"]?>" target="_blank" data-toggle="tooltip" data-original-title="Attached File" style="border-bottom: 0;padding: 0;"><i class="ti-link"></i><?=$leadCommentRes["attched_file"]?></a>
											<?php } ?></span>
										<span class="mail-desc"></span> 
									</div>
									<div class="clearfix"></div>
								</div> 
							<?php $i++; } }   else{
							echo "No Records Found.";
						}
						
						} ?> 
					</div>
				  </div>
				  <div id="menu1" class="tab-pane fade">
					<h3>Status History</h3>
					<div class="message-center scroll_bar" > 
						<?php if(isset($_REQUEST['id'])){ $i=0;
							$leadCommentQr = $cms->db_query("SELECT action_message, action_date,action_by FROM #_lead_tracker WHERE  lead_id='".$_REQUEST['id']."' ORDER BY id DESC");
							if($leadCommentQr->num_rows>0){
							while($leadCommentRes = $leadCommentQr->fetch_array()){
							?>
								<div class="message_div" style="padding:10px;<?=$i%2==0?"background:#e8e8e8":"";?>"> 
									<div class="user-img"> <i class="fa fa-clock-o fa-2x"></i> </div>
									<div class="mail-contnet">
										<h5><?=$cms->getSingleResult("SELECT customer_name FROM #_users WHERE id='".$leadCommentRes["action_by"]."'");?>
										<span class="time pull-right"><?=$leadCommentRes["action_date"]?></span></h5>
										<span class="mail-desc">
											<?=$leadCommentRes["action_message"]?>
											<br>
											</span>
										<span class="mail-desc"></span> 
									</div>
									<div class="clearfix"></div>
								</div> 
						<?php $i++;  
							} }
						 else{
							echo "No Records Found."; 
						} }?> 
					</div>
				  </div>
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
/*function visitCall(vals){
	if(vals=='0' || vals=='2'){
		$("#hide_from_call").hide();
		$("#hide_from_call_to_date").hide();
	}else{
		$("#hide_from_call").show();
		$("#hide_from_call_to_date").show();
	}
}
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
});*/
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
$(".leadStatuss").change(function(){
		var f_status = $(this).val();
		//alert(f_status);
		if(f_status=="2" || f_status=="4" || f_status=="5" || f_status=="7"){
			$(".actionDateTime_div").show();
		}else{
			$(".actionDateTime_div").hide();
		}
	});
</script>
 
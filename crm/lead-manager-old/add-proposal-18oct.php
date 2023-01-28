<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php
$action_message ='';
$pid = $_GET['id']; 
if (isset($_POST["save-only"])) {
	//print_r($_POST);die;
		
	date_default_timezone_set('Asia/Kolkata');
	
	if($_FILES["installation_image"]["name"]){ 
		$_POST["installation_image"] = uploadImage("installation_image","proposal");
	}
	
	$_POST['form_type']=4;
	if($pid){ 
		//$_POST['created_date'] =  date("H:i a");
		$_POST["update_date"] = date("Y-m-d h:i:s");
		if($assigned_to){
			$_POST["assigned_date"] = date("Y-m-d h:i:s");
		}
		
		$cms->sqlquery("rs","leads",$_POST, 'id', $pid);
		if((!empty($_POST["lead_date"]) && !empty($_POST["lead_time"])) || !empty($_POST["lead_comment"])){
			$_CommentPoast["lead_comment"] = $_POST["lead_comment"]?$_POST["lead_comment"]:"No Comment";
			$_CommentPoast["lead_id"] = $pid;
			$_CommentPoast["post_by"] = $_SESSION["ses_adm_id"];
			$_CommentPoast["post_date"] = date('Y-m-d h:i:s');
			 
			$_CommentPoast["visit_call"] = $_POST["visit_call"];
			if($_POST["lead_date"]){
				$_CommentPoast["next_call_date"]=date("Y-m-d", strtotime($_POST["lead_date"]))." ".$_POST["lead_time"];
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
		}
		$adm->sessset('Record has been updated', 's');
		
	} else {  
		$_POST['created_date'] =  date("H:i a");
		//$_POST["created_date"] = date("Y-m-d h:i:s");
		$_POST["update_date"] = date("Y-m-d h:i:s");
		$_POST["post_date"] = date("Y-m-d");
		$_POST["post_by"] = $_SESSION["ses_adm_id"];
		$lead_insert_id=$cms->sqlquery("rs","leads",$_POST);
		
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
		}
		$_POSTS["lead_id"] = $insertId;
		$_POSTS["action_message"] = $action_message;
		$_POSTS["action_date"] = date('Y-m-d h:i:s');
		$_POSTS["action_by"] = $_SESSION["ses_adm_id"];
		$_POSTS["action"] = $_POST["status"];
		$cms->sqlquery("rs","lead_tracker",$_POSTS);
		$old_status=$_POST['old_status'];
		$status=$_POST['status'];
		if($old_status!=$status){
			$action_message="Status Changed from ".$leadsStatusArr[$old_status]." to ".$leadsStatusArr[$status];
			$_POSTS["lead_id"] = $insertId;
			$_POSTS["action_message"] = $action_message;
			$_POSTS["action_date"] = date('Y-m-d h:i:s');
			$_POSTS["action_by"] = $_SESSION["ses_adm_id"];
			$_POSTS["action"] = $_POST["status"];
			$cms->sqlquery("rs","lead_tracker",$_POSTS);
		}
		$adm->sessset('Record has been added', 's');
	}
	if(isset($_GET['start']) && $_GET['start'] > 0) {
		$path = SITE_PATH_ADM.CPAGE."/index.php?start=".$_GET['start'];
	} else {
		$path = SITE_PATH_ADM.CPAGE;
	}
	$cms->redir($path, true);	
}  

$rsAdmin = $cms->db_query("select * from #_leads where id='".$pid."'");
$arrAdmin = $rsAdmin->fetch_array(); 
@extract($arrAdmin);


$customerPriceQry = $cms->db_query("SELECT * FROM #_customer_price where id=1 ");
$customerPriceArr = $customerPriceQry->fetch_array(); 
//echo $customerPriceArr["panel_types"];die;

					
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
.form-section-heading1{
	margin-bottom: 20px;
    background-color: #22914f;
    border: 1px solid #eee;
    border-radius: 4px;
    -webkit-box-shadow: 0 1px 1px rgb(0 0 0 / 5%);
    box-shadow: 0 1px 1px rgb(0 0 0 / 5%);
}
.form-section-heading1 h2{
    padding: 1px 15px;
	color:#fff;
	font-size:22px;
}
</style>
<div class="row">
    <div class="col-sm-12">
		<div class="white-box panel-body">
			<div class="form-section-heading1">	
				<h2>Proposal Manager</h2>
			</div>
			<div class="form-section-heading">	
				<h2>Personal Information</h2>
			</div>
			<div class="form-group col-md-6">
				<label class="control-label">Customer Type</label>
				<select class="form-control select2" id="proposal_customer_type" name="proposal_customer_type" required>
					<option value="">Customer Type</option>
					<?php foreach($proosalCustomerTypeArr as $ckey=>$cval){?>
					<option value="<?=$ckey?>" <?=$proposal_customer_type==$ckey?'selected':''?>><?=$cval?></option>
					<?php } ?>
				</select>
			</div>
			<div class="clearfix"></div>
			<div class="form-group col-md-6">
				<label class="control-label">Full name</label>
				<input type="text" class="form-control" name="customer_name" placeholder="Full name" pattern="([^\s][A-zÀ-ž\s]+)" value="<?=$customer_name?>" required>
				<input type="hidden" class="form-control" name="pid" value="<?=$pid?>">
			</div>
			<div class="clearfix"></div>
			<div class="form-group col-md-6">
				<label class="control-label">Email</label>
				<input type="email" class="form-control" name="email" placeholder="Email" value="<?=$email?>" required>
			</div>
			<div class="form-group col-md-6">
				<label class="control-label">Phone</label>
				<input type="text" class="form-control" name="phone" placeholder="Phone Number" pattern="[+0-9]{10,13}" value="<?=$phone?>" required>
			</div>
			<div class="clearfix"></div>
			<div class="form-group col-md-12">
				<label class="control-label">Address</label>
				<input type="text" class="form-control" name="proposal_address" placeholder="Address" value="<?=$proposal_address?>" required>
			</div>
			<div class="clearfix"></div>
			<div class="form-group col-md-6">
				<label class="control-label">Reference</label>
				<input type="text" class="form-control" name="reference" placeholder="Our reference" value="<?=$reference?>">
			</div>
			<div class="form-group col-md-6">
				<label class="control-label">Quotation number</label>
				<input type="text" class="form-control" name="quotation_number" placeholder="Quotation number" value="<?=$quotation_number?>">
			</div>
			
			<div class="form-group col-md-6">	
				<label class="control-label">Quotation date</label>
				<input type="date" class="form-control" name="quotation_date" placeholder="Quotation date" value="<?=$quotation_date?>">
			</div>
			<div class="form-group col-md-6">
				<label class="control-label">Quotation valid till</label>
				<input type="date" class="form-control" name="quotation_valid_till" placeholder="Quotation valid for" value="<?=$quotation_valid_till?>">
			</div>
			<div class="clearfix"></div>
			<div class="form-section-heading">	
				<h2>Technical information</h2>
			</div>
			<div class="form-group col-md-3">
				<label class="control-label">Panel Type</label>
				<select class="form-control select2" id="panel_model" name="panel_model">
					<option value="">Select Panel Type</option>
					<?php $panelTyeArray = json_decode($customerPriceArr["panel_types"], true);
					foreach ($panelTyeArray as $key => $value) {
						if($panel_model==$value["name"]){
							$psel = 'selected';
						}else{
							$psel = '';
						}
						echo '<option value="'.$value["name"].'" '.$psel.'>'.$value["name"].' - '.$value["wattage"].' Wp</option>';
					}
					?>
				</select>
			</div>
			<!--<div class="form-group col-md-3">
				<label class="control-label">Panel Area</label>
				<input type="text" class="form-control" name="panel_area" value="<?=$panel_area?>">
			</div>-->
			<div class="form-group col-md-3">
				<label class="control-label">Panel Area</label>
				<input type="text" class="form-control" name="panel_area_dimension" value="<?=$panel_area_dimension?>">
			</div>
			<div class="form-group col-md-3">
				<label class="control-label">Number Of Panels</label>
				<input type="text" class="form-control" name="panel_count" value="<?=$panel_count?>">
			</div>
			<div class="form-group col-md-3">
				<label class="control-label">Color</label>
				<input type="text" class="form-control" name="color" placeholder="Color" value="<?=$color?>">
			</div>
			<div class="clearfix"></div>
			
			<div class="form-group col-md-6">
				<label class="control-label">Inverter Type</label>
				<select class="form-control select2" id="inverter_type" name="inverter_type">
					<option value="">Select Inverter Type</option>
					<?php $inverterTyeArray = json_decode($customerPriceArr["inverter_types"], true);
					foreach ($inverterTyeArray as $ikey => $ivalue) {
						if($inverter_type==$ivalue["name"]){
							$invsel = 'selected';
						}else{
							$invsel = '';
						}
						echo '<option value="'.$ivalue["name"].'" '.$invsel.'>'.$ivalue["name"].'</option>';
					}
					?>
				</select>
			</div>
			<div class="form-group col-md-6">
				<label class="control-label">Installation Days</label>
				<select class="form-control select2" id="installation_days" name="installation_days">
					<option value="">Select Inverter Type</option>
					<?php $installationArray = json_decode($customerPriceArr["installation_charges"], true);
					foreach ($installationArray as $ikey => $invalue) {
						if($installation_days==$invalue["day"]){
							$inssel = 'selected';
						}else{
							$inssel = '';
						}
						echo '<option value="'.$invalue["day"].'" '.$inssel.'>'.$invalue["day"].'</option>';
					}
					?>
				</select>
			</div>
			<div class="form-group col-md-3">
				<label class="control-label">Battery</label>
				<select class="form-control select2" id="battery_name" name="battery_name">
					<option value="">Select Battery</option>
					<?php $batteryTyeArray = json_decode($customerPriceArr["battery_types"], true);
					foreach ($batteryTyeArray as $bkey => $bvalue) {
						if($battery_name==$bvalue["name"]){
							$bsel = 'selected';
						}else{
							$bsel = '';
						}
						echo '<option value="'.$bvalue["name"].'" '.$bsel.'>'.$bvalue["name"].'</option>';
					}
					?>
				</select>
			</div>
			<div class="form-group col-md-3">
				<label class="control-label">EV Charger Type</label>
				<select class="form-control select2" id="charger_name" name="charger_name">
					<option value="">Select EV Charger</option>
					<?php $chargerTyeArray = json_decode($customerPriceArr["ev_charger_types"], true);
					foreach ($chargerTyeArray as $ckey => $cvalue) {
						if($charger_name==$cvalue["name"]){
							$csel = 'selected';
						}else{
							$csel = '';
						}
						echo '<option value="'.$cvalue["name"].'" '.$csel.'>'.$cvalue["name"].'</option>';
					}
					?>
				</select>
			</div>
			<div class="form-group col-md-3">
				<label class="control-label">Product warranty car charger</label>
				<input type="text" class="form-control" name="charger_warranty" placeholder="Product warranty car charger" value="<?=$charger_warranty?>">
			</div>
			<div class="form-group col-md-3">
				<label class="control-label">Roofing material</label>
				<input type="text" class="form-control" name="roofing_material" placeholder="Roofing material" value="<?=$roofing_material?>">
			</div>
			<div class="clearfix"></div>
			<div class="form-section-heading">	
				<h2>Guarantee</h2>
			</div>
			<div class="form-group col-md-6">
				<label class="control-label">Supplier of solar cells (in year)</label>
				<input type="text" class="form-control" name="supplier_solar_cells" value="<?=$supplier_solar_cells?>" placeholder="Supplier of solar cells">
			</div>
			<div class="form-group col-md-6">
				<label class="control-label">Work performed (in year)</label>
				<input type="text" class="form-control" name="work_performed" value="<?=$work_performed?>" placeholder="Work performed">
			</div>
			<div class="clearfix"></div>
			<div class="form-group col-md-6">
				<label class="control-label">Product guarantee solar cells (in year)</label>
				<input type="text" class="form-control" name="warranty_solar" value="<?=$warranty_solar?>" placeholder="Product guarantee solar cells">
			</div>
			<div class="form-group col-md-6">
				<label class="control-label">Product guarantee inverter (in year)</label>
				<input type="text" class="form-control" name="warranty_inverter" value="<?=$warranty_inverter?>" placeholder="Product guarantee inverter">
			</div>
			<div class="clearfix"></div>
			<div class="form-group col-md-6">
				<label class="control-label">Product guarantee mounting system (in year)</label>
				<input type="text" class="form-control" name="product_guarantee_mounting_system" value="<?=$product_guarantee_mounting_system?>" placeholder="Product guarantee mounting system">
			</div>
			<div class="form-group col-md-6">
				<label class="control-label">Power guarantee solar cells after 30 years (in %)</label>
				<input type="text" class="form-control" name="guarantee_after_30_years" value="<?=$guarantee_after_30_years?>" placeholder="Power guarantee solar cells after 30 years">
			</div>
			<div class="clearfix"></div>
			<div class="form-section-heading">	
				<h2>Estimated production and conditions</h2>
			</div>
			<div class="form-group col-md-6">
				<label class="control-label">Annual electricity consumption in property</label>
				<input type="text" class="form-control" name="annual_electricity_consumption" value="<?=$annual_electricity_consumption?>" placeholder="Annual electricity consumption in property">
			</div>
			<div class="form-group col-md-6">
				<label class="control-label">Estimated annual production solar</label>
				<input type="text" class="form-control" name="annual_production" value="<?=$annual_production?>" placeholder="Estimated annual production solar">
			</div>
			<div class="clearfix"></div>
			<div class="form-group col-md-6">
				<label class="control-label">Self-use of solar</label>
				<input type="text" class="form-control" name="self_use_solar" value="<?=$self_use_solar?>" placeholder="Self-use of solar">
			</div>
			<div class="clearfix"></div>
			<div class="form-group col-md-6">
				<label class="control-label">Standard hours of sunshine / year</label>
				<input type="text" class="form-control" name="sunshine_hours" value="<?=$sunshine_hours?>" placeholder="Standard hours of sunshine / year">
			</div>
			<div class="form-group col-md-6">
				<label class="control-label">Angle of panels</label>
				<input type="text" class="form-control" name="panels_angles" value="<?=$panels_angles?>" placeholder="Angle of panels">
			</div>
			<div class="clearfix"></div>
			<div class="form-group col-md-6">
				<label class="control-label">Direction from the south</label>
				<input type="text" class="form-control" name="direction_from_south" value="<?=$direction_from_south?>" placeholder="Direction from the south">
			</div>
			<div class="form-group col-md-6">
				<label class="control-label">Losses from shading</label>
				<input type="text" class="form-control" name="losses_from_shading" value="<?=$losses_from_shading?>" placeholder="Losses from shading">
			</div>
			<div class="clearfix"></div>
			<div class="form-section-heading">	
				<h2>Dimensioning</h2>
			</div>
			<div class="form-group col-md-6">
				<label class="label-control">The system is connected to the property's electrical exchange and installed according to the picture below. (570px X 330px)</label>
				<div>
					<input type="file" name="installation_image" id="input-file-max-fs" class="dropify" data-max-file-size="1M" data-height="150" <?php if($installation_image AND file_exists(FILES_PATH.'proposal/'.$installation_image)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/proposal/<?=$installation_image?>" <?php }else{ ?> required <?php } ?> />
				</div>
			</div>
			<div class="clearfix"></div>
			
			<div class="form-section-heading">	
				<h2>Production</h2>
			</div>
			<div class="form-group col-md-6">
				<label class="control-label">Annual inflation adjustment on electricity price</label>
				<input type="text" class="form-control" name="annual_inflation" placeholder="Annual inflation adjustment on electricity price" value="<?=$annual_inflation?>">
			</div>
			<div class="form-group col-md-6">
				<label class="control-label">Real price increase on variable electricity price</label>
				<input type="text" class="form-control" name="price_increase" placeholder="Real price increase on variable electricity price" value="<?=$price_increase?>">
			</div>
			<div class="form-group col-md-6">
				<label class="control-label">Annual effect deterioration in percent</label>
				<input type="text" class="form-control" name="annual_deterioration_percent" placeholder="Annual effect deterioration in percent" value="<?=$annual_deterioration_percent?>">
			</div>
			<div class="form-group col-md-6">
				<label class="control-label">Power loss</label>
				<input type="text" class="form-control" name="power_loss" placeholder="Power loss" value="<?=$power_loss?>">
			</div>
			<div class="clearfix"></div>
			
			<div class="form-section-heading">	
				<h2>Electricity price based on own consumption</h2>
			</div>
			<div class="form-group col-md-6">
				<label class="control-label">Own consumption</label>
				<input type="text" class="form-control" name="own_consumption" placeholder="Own Consumption" value="<?=$own_consumption?>">
			</div>
			<div class="form-group col-md-6">
				<label class="control-label">Sold electricity</label>
				<input type="text" class="form-control" name="sold_electricity" placeholder="Sold electricity" value="<?=$sold_electricity?>">
			</div>
			<div class="form-group col-md-6">
				<label class="control-label">Issued by</label>
				<input type="text" class="form-control" name="issued_by" placeholder="Issued by" value="<?=$issued_by?>">
			</div>
			<div class="form-group col-md-6">
				<label class="control-label">Inverter Count</label>
				<input type="text" class="form-control" name="inverter_count" placeholder="Inverter Count" value="<?=$inverter_count?>">
			</div>
			<div class="form-group col-md-6">
				<label class="control-label">Mounting system Count</label>
				<input type="text" class="form-control" name="mounting_system" placeholder="Mounting system Count" value="<?=$mounting_system?>">
			</div>
			<div class="form-group col-md-6">
				<label class="control-label">DC switch</label>
				<input type="text" class="form-control" name="dc_switch" placeholder="DC switch" value="<?=$dc_switch?>">
			</div>
			<div class="form-group col-md-6">
				<label class="control-label">AC switch</label>
				<input type="text" class="form-control" name="ac_switch" placeholder="AC switch" value="<?=$ac_switch?>">
			</div>
			<div class="form-group col-md-6">
				<label class="control-label">Electrical enclosure and fuses</label>
				<input type="text" class="form-control" name="electrical_enclosure_fuses" value="<?=$electrical_enclosure_fuses?>" placeholder="Electrical enclosure and fuses">
			</div>
			<div class="clearfix"></div>
			<div class="form-group col-sm-12">
				<button type="submit" class="btn btn-primary" name="save-only">Save</button>
				<button type="button" onClick="generatePDF()" name="save-generate" class="btn btn-primary">Save & Generate</button>
				<a href="<?=SITE_PATH_ADM.CPAGE?>" class="" ><button type="button" class="btn btn-primary">Back</button></a>
			</div>
		</div>
	</div>
</div>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script>
function generatePDF(){
	$("#aforms").attr("action","<?=SITE_PATH_ADM.CPAGE?>/generate.php");
	//alert($(".filter_form").attr("action"));
	$("#aforms").submit();
	//setTimeout(function(){ location.reload() }, 1000);
}
</script>


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
 

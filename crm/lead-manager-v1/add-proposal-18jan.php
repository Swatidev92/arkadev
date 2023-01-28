<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php
$action_message ='';
$pid = $_GET['id']; 

if($_SESSION['REFERER_page']==''){
$_SESSION['REFERER_page']=$_SERVER['HTTP_REFERER'];
}

if (isset($_POST["save-only"])) {
	//print_r($_FILES);die;
		
	date_default_timezone_set('Asia/Kolkata');
	
	if($_FILES["installation_image"]["name"]){ 
		$_POST["installation_image"] = uploadImage("installation_image","proposal");
	}
	if($_POST['proposal_type']!=3 && $_POST['proposal_type']!=4){
		$_POST['number_of_proposal']=1;
		$_POST['customer_name2']='';
	}else{
		$_POST['number_of_proposal'] = $_POST['number_of_proposal'];
		$_POST['customer_name2']= $_POST['customer_name2'];
	}
	
	if($_POST['proposal_type']==1){
		$_POST['battery_name']='';
		$_POST['charger_name']='';
		$_POST['charger_discount']='';
		$_POST['battery_discount']='';
	}
	if($_POST['proposal_type']==2 || $_POST['proposal_type']==5){
		$_POST['battery_name']='';
		$_POST['battery_discount']='';
	}
	if($_POST['proposal_type']==4 || $_POST['proposal_type']==6){
		$_POST['charger_name']='';
		$_POST['charger_discount']='';
	}
	
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
		$_POST["form_type"] = 4;
		$_POST['status'] = 1;
		$_POST['source'] = 0;
		$_POST['created_date'] =  date("H:i a");
		//$_POST["created_date"] = date("Y-m-d h:i:s");
		$_POST["update_date"] = date("Y-m-d h:i:s");
		$_POST["post_date"] = date("Y-m-d");
		$_POST["post_by"] = $_SESSION["ses_adm_id"];
		$_POST["assigned_to"] = $_SESSION["ses_adm_id"];
		
		//print_r($_POST);die;
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
	/*if(isset($_GET['start']) && $_GET['start'] > 0) {
		$path = SITE_PATH_ADM.CPAGE."/index.php?start=".$_GET['start'];
	} else {
		$path = SITE_PATH_ADM.CPAGE;
	}*/
	
	$path = $_SESSION['REFERER_page'];
	echo "<script>window.location.href='".$path."';</script>";
	//$cms->redir($path, true);	
}  

$rsAdmin = $cms->db_query("select * from #_leads where id='".$pid."'");
$arrAdmin = $rsAdmin->fetch_array(); 
@extract($arrAdmin);


$customerPriceQry = $cms->db_query("SELECT * FROM #_customer_price where id=1 ");
$customerPriceArr = $customerPriceQry->fetch_array(); 
//echo $customerPriceArr["panel_types"];die;

$priceQry = $cms->db_query("select * from #_customer_price where id='1'");
$priceRes = $priceQry->fetch_array();

$obj_sdis = json_decode($priceRes['solar_discount']);
$obj_bdis = json_decode($priceRes['battery_types']);
$obj_cdis = json_decode($priceRes['ev_charger_types']);
$obj_smrg = json_decode($priceRes['solar_margin']);
$obj_evmrg = json_decode($priceRes['ev_margin']);
$obj_btmrg = json_decode($priceRes['battery_margin']);
					
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
			<div class="form-group col-md-4">	
				<label class="control-label">Lead date</label>
				<input type="date" class="form-control" name="post_date" placeholder="Lead date" value="<?=$post_date?>">
			</div>
			<div class="form-group col-md-3">
				<label class="control-label">Work Start</label>
				<select class="form-control select2" id="work_start" name="work_start">
					<option value="">Work Start From</option>
					<?php foreach($workStartArr as $wkey=>$wval){?>
					<option value="<?=$wkey?>" <?=$work_start==$wkey?'selected':''?>><?=$wval?></option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group col-md-3">
				<label class="control-label">Project area (m<sup>2</sup>)</label>
				<input type="text" class="form-control" name="panel_area" value="<?=$panel_area?>">
			</div>
			<div class="clearfix"></div>
			
			<div class="form-group col-md-6">
				<label class="control-label">Customer Type</label>
				<select class="form-control select2" id="proposal_customer_type" name="proposal_customer_type">
					<?php foreach($proosalCustomerTypeArr as $ckey=>$cval){?>
					<option value="<?=$ckey?>" <?=$proposal_customer_type==$ckey?'selected':''?>><?=$cval?></option>
					<?php } ?>
				</select>
			</div>
			<div class="clearfix"></div>
			<div class="form-group col-md-6">
				<label class="control-label">Full name</label>
				<input type="text" class="form-control" name="customer_name" placeholder="Full name" pattern="([^\s][A-Za-z\W+]+)" value="<?=$customer_name?>" required>
				<input type="hidden" class="form-control" name="pid" value="<?=$pid?>">
			</div>
			<div class="clearfix"></div>
			<div class="form-group col-md-6">
				<label class="control-label">Email</label>
				<input type="email" class="form-control" name="email" placeholder="Email" value="<?=$email?>">
			</div>
			<div class="form-group col-md-6">
				<label class="control-label">Phone</label>
				<input type="text" class="form-control" name="phone" placeholder="Phone Number" pattern="[+0-9]{8,13}" value="<?=$phone?>">
			</div>
			<div class="clearfix"></div>
			<div class="form-group col-md-12">
				<label class="control-label">Address</label>
				<input type="text" class="form-control" name="proposal_address" placeholder="Address" value="<?=$proposal_address?>" required>
			</div>
			<div class="clearfix"></div>
			<div class="form-section-heading">	
				<h2>Proposal details</h2>
			</div>
			<div class="form-group col-md-6">
				<label class="control-label">Proposal Type</label>
				<select class="form-control" id="proposal_type" name="proposal_type" required>
					<option value="">Select Proposal Type</option>
					<?php foreach($proposalType as $pkey=>$pval){?>
					<option value="<?=$pkey?>" <?=$proposal_type==$pkey?'selected':''?>><?=$pval?></option>
					<?php } ?>
				</select>
			</div>
			<?php if($proposal_type==3 || $proposal_type==4){
				$propCount = 'display:block;';
			}else{
				$propCount = 'display:none;';
			}?>
			<div class="form-group col-md-6 show_proposal_selection" style="<?=$propCount?>">
				<label class="control-label">Generate number of proposal</label>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="number_of_proposal" id="number_of_proposal1" value="1" <?=$number_of_proposal==1?'checked':''?>>
					<label class="form-check-label" for="number_of_proposal1">1 Proposal</label>
					&nbsp;&nbsp;&nbsp;
					<input class="form-check-input" type="radio" name="number_of_proposal" id="number_of_proposal2" value="2" <?=$number_of_proposal==2?'checked':''?>>
					<label class="form-check-label" for="number_of_proposal2">2 Proposal</label>
				</div>
			</div>
			<div class="clearfix"></div>
			<?php if($number_of_proposal==2 && ($proposal_type==3 || $proposal_type==4)){
					$name2Style = 'display:block';
			}else{
				$name2Style = 'display:none';
			}
			?>
			<div class="form-group col-md-6 customer_name2_show" style="<?=$name2Style?>">
				<label class="control-label">Name 2</label>
				<input type="text" class="form-control" name="customer_name2" placeholder="Full name" pattern="([^\s][A-Za-z\W+]+)" value="<?=$customer_name2?>" required>
			</div>
			<div class="clearfix"></div>	
			
			<div class="form-section-heading">	
				<h2>Sales channel details</h2>
			</div>
			<div class="form-group col-md-4">
				<label class="control-label">Reference</label>
				<input type="text" class="form-control" name="reference" placeholder="Our reference" pattern="([^\s][A-Za-z\W+]+)" value="<?=$reference?>">
			</div>
			<div class="form-group col-md-4">
				<label class="control-label">Reference Email</label>
				<input type="email" class="form-control" name="ref_email" placeholder="Reference Email" value="<?=$ref_email?>">
			</div>
			<div class="form-group col-md-4">
				<label class="control-label">Reference Phone</label>
				<input type="text" class="form-control" name="ref_phone" placeholder="Reference Phone" pattern="[+0-9]{8,13}" value="<?=$ref_phone?>">
			</div>
			<div class="clearfix"></div>
			<div class="form-group col-md-4">
				<label class="control-label">Quotation number</label>
				<input type="text" class="form-control" name="quotation_number" placeholder="Quotation number" value="<?=$quotation_number?>">
			</div>
			
			<div class="form-group col-md-4">	
				<label class="control-label">Quotation date</label>
				<input type="date" class="form-control" name="quotation_date" placeholder="Quotation date" value="<?=$quotation_date?>">
			</div>
			<div class="form-group col-md-4">
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
			<div class="form-group col-md-3">
				<label class="control-label">Roofing material</label>
				<input type="text" class="form-control" name="roofing_material" placeholder="Roofing material" value="<?=$roofing_material?>">
			</div>
			<div class="form-group col-md-4">
				<label class="control-label">Roof dimensions (AA x BB m,CC x DD m)</label>
				<input type="text" class="form-control" name="panel_area_dimension" value="<?=$panel_area_dimension?>">
			</div>
			<div class="clearfix"></div>
			<div class="form-group col-md-3">
				<label class="control-label">Number Of Panels</label>
				<input type="text" class="form-control" name="panel_count" value="<?=$panel_count?>">
			</div>
			<div class="form-group col-md-3">
				<label class="control-label">Color</label>
				<input type="text" class="form-control" name="color" placeholder="Color" value="<?=$color?>">
			</div>
			<div class="form-group col-md-3">
				<label class="control-label">Installation Days</label>
				<select class="form-control select2" id="installation_days" name="installation_days">
					<option value="">Select Installation Days</option>
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
			<div class="clearfix"></div>
			
			<div class="form-group col-md-3">
				<label class="control-label">Inverter Type 1</label>
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
			<div class="form-group col-md-3">
				<label class="control-label">Inverter Type 2</label>
				<select class="form-control select2" id="inverter_type2" name="inverter_type2">
					<option value="">Select Inverter Type</option>
					<?php $inverterTyeArray = json_decode($customerPriceArr["inverter_types"], true);
					foreach ($inverterTyeArray as $ikey => $ivalue) {
						if($inverter_type2==$ivalue["name"]){
							$invsel = 'selected';
						}else{
							$invsel = '';
						}
						echo '<option value="'.$ivalue["name"].'" '.$invsel.'>'.$ivalue["name"].'</option>';
					}
					?>
				</select>
			</div>
			<div class="form-group col-md-3">
				<label class="control-label">Inverter Type 3</label>
				<select class="form-control select2" id="inverter_type3" name="inverter_type3">
					<option value="">Select Inverter Type</option>
					<?php $inverterTyeArray = json_decode($customerPriceArr["inverter_types"], true);
					foreach ($inverterTyeArray as $ikey => $ivalue) {
						if($inverter_type3==$ivalue["name"]){
							$invsel = 'selected';
						}else{
							$invsel = '';
						}
						echo '<option value="'.$ivalue["name"].'" '.$invsel.'>'.$ivalue["name"].'</option>';
					}
					?>
				</select>
			</div>
			<div class="clearfix"></div>
			<?php if($proposal_type==3 || $proposal_type==4 || $proposal_type==6 || $proposal_type==7){
				$styleb = '';
			}else{	
				$styleb = 'display:none';
			}
			?>
			<div class="form-group col-md-3 battery_show" style="<?=$styleb?>">
				<label class="control-label">Battery</label>
				<select class="form-control" id="battery_name" name="battery_name" required>
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
			<?php if($proposal_type==2 || $proposal_type==3 || $proposal_type==5 || $proposal_type==7){
				$stylec = '';
			}else{	
				$stylec = 'display:none';
			}
			?>
			<div class="form-group col-md-3 charger_show" style="<?=$stylec?>">
				<label class="control-label">EV Charger Type</label>
				<select class="form-control" id="charger_name" name="charger_name" required>
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
			
			<div class="form-group col-md-3 charger_show" style="margin-top:30px; <?=$stylec?>">
				<label class="control-label" for="load_balancer">Load Balancer</label>
				<input type="checkbox" id="load_balancer" name="load_balancer" value="1" <?=$load_balancer==1?'checked':''?>>
			</div>
			<!--<div class="form-group col-md-3">
				<label class="control-label">Product warranty car charger</label>
				<input type="text" class="form-control" name="charger_warranty" placeholder="Product warranty car charger" value="<?=$charger_warranty?>">
			</div>-->
			<!--<div class="clearfix"></div>
			<div class="form-section-heading">	
				<h2>Guarantee</h2>
			</div>
			<div class="form-group col-md-6">
				<label class="control-label">Supplier of solar cells</label>
				<input type="text" class="form-control" name="supplier_solar_cells" value="<?=$supplier_solar_cells?>" placeholder="Supplier of solar cells">
			</div>
			<div class="form-group col-md-6">
				<label class="control-label">Work performed (in year)</label>
				<input type="text" class="form-control" name="work_performed" value="<?=$work_performed?>" placeholder="Work performed">
			</div>
			<div class="clearfix"></div>
			<!--<div class="form-group col-md-6">
				<label class="control-label">Product guarantee solar cells (in year)</label>
				<input type="text" class="form-control" name="warranty_solar" value="<?=$warranty_solar?>" placeholder="Product guarantee solar cells">
			</div>
			<div class="form-group col-md-6">
				<label class="control-label">Product guarantee inverter (in year)</label>
				<input type="text" class="form-control" name="warranty_inverter" value="<?=$warranty_inverter?>" placeholder="Product guarantee inverter">
			</div>
			<div class="clearfix"></div>-->
			<!--<div class="form-group col-md-6">
				<label class="control-label">Product guarantee mounting system (in year)</label>
				<input type="text" class="form-control" name="product_guarantee_mounting_system" value="<?=$product_guarantee_mounting_system?>" placeholder="Product guarantee mounting system">
			</div>
			<div class="form-group col-md-6">
				<label class="control-label">Power guarantee solar cells after 30 years (in %)</label>
				<input type="text" class="form-control" name="guarantee_after_30_years" value="<?=$guarantee_after_30_years?>" placeholder="Power guarantee solar cells after 30 years">
			</div>-->
			<div class="clearfix"></div>
			
			<!--<div class="form-group col-md-3">
				<label class="control-label">Solar panel discount (kr)</label>
				<input type="text" class="form-control" name="solar_discount" id="solar_discount" placeholder="Solar panel discount" value="<?=$solar_discount?>">
			</div>-->
			<?php  if($proposal_type==3 || $proposal_type==4 || $proposal_type==6 || $proposal_type==7){
				
				$stylebd = '';?>
			<div class="form-section-heading">	
				<h2>Discount</h2>
			</div>
			<?php }else{	
				$stylebd = 'display:none';
			}
			?>
			<div class="form-group col-md-3 show_battery_disc" style="<?=$stylebd?>">
				<label class="control-label" style="color:red;">Battery discount (kr) <i class="fa fa-info-circle" title="Do not change" style="color:red;"></i></label>
				<input type="text" class="form-control" name="battery_discount" id="battery_discount" placeholder="Battery discount" value="<?=$battery_discount?>">
				<label class="control-label" style="color:red;">Battery actual discount (kr) <i class="fa fa-info-circle" title="Do not change" style="color:red;"></i></label>
				<input type="text" class="form-control" id="actual_battery_discount" disabled>
			</div>
			<?php if($proposal_type==2 || $proposal_type==3 || $proposal_type==5 || $proposal_type==7){
				$stylecd = '';
			}else{	
				$stylecd = 'display:none';
			}
			?>
			<div class="form-group col-md-3 show_charger_disc" style="<?=$stylecd?>">
				<label class="control-label" style="color:red;">Charger discount (kr) <i class="fa fa-info-circle" title="Do not change" style="color:red;"></i></label>
				<input type="text" class="form-control" name="charger_discount" id="charger_discount" placeholder="Charger discount" value="<?=$charger_discount?>">
				<label class="control-label" style="color:red;">Charger actual discount (kr) <i class="fa fa-info-circle" title="Do not change" style="color:red;"></i></label>
				<input type="text" class="form-control" id="actual_charger_discount" disabled>
			</div>
			<div class="clearfix"></div>
			<div class="form-section-heading">	
				<h2>Estimated production and conditions</h2>
			</div>
			<div class="form-group col-md-6">
				<label class="control-label">Annual electricity consumption in property (kWh)</label>
				<input type="text" class="form-control" name="annual_electricity_consumption" value="<?=$annual_electricity_consumption?>" placeholder="Annual electricity consumption in property">
			</div>
			<div class="form-group col-md-6">
				<label class="control-label">Estimated annual production solar (kWh)</label>
				<input type="text" class="form-control" name="annual_production" value="<?=$annual_production?>" placeholder="Estimated annual production solar">
			</div>
			<div class="clearfix"></div>
			<div class="form-group col-md-6">
				<label class="control-label">Self-use of solar (%)</label>
				<input type="text" class="form-control" name="self_use_solar" value="<?=$self_use_solar?>" placeholder="Self-use of solar">
			</div>
			<!--<div class="form-group col-md-6">
				<label class="control-label">Standard hours of sunshine (years)</label>
				<input type="text" class="form-control" name="sunshine_hours" value="<?=$sunshine_hours?>" placeholder="Standard hours of sunshine / year">
			</div>-->
			<div class="form-group col-md-6">
				<label class="control-label">Angle of panels</label>
				<input type="text" class="form-control" name="panels_angles" value="<?=$panels_angles?>" placeholder="Angle of panels">
			</div>
			<div class="clearfix"></div>
			<!--<div class="form-group col-md-6">
				<label class="control-label">Direction from the south</label>
				<input type="text" class="form-control" name="direction_from_south" value="<?=$direction_from_south?>" placeholder="Direction from the south">
			</div>
			<div class="form-group col-md-6">
				<label class="control-label">Losses from shading (%)</label>
				<input type="text" class="form-control" name="losses_from_shading" value="<?=$losses_from_shading?>" placeholder="Losses from shading">
			</div>
			<div class="clearfix"></div>-->
			<div class="form-section-heading">	
				<h2>Dimensioning</h2>
			</div>
			<div class="form-group col-md-12">
				<label class="label-control">The system is connected to the property's electrical exchange and installed according to the picture below.<br>(570px X 330px and should be less than 1 MB) (only png,jpg,jpeg)</label>
			</div>
			<div class="form-group col-md-6">
				<div>
					<input type="file" name="installation_image" id="drop_area<?=$id?>" class="dropify dropify-area-img" data-max-file-size="1M" data-height="150" <?php if($installation_image AND file_exists(FILES_PATH.'proposal/'.$installation_image)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/proposal/<?=$installation_image?>" <?php } ?> />
				</div>
			</div>
			<div class="clearfix"></div>
			
			<div class="form-section-heading">	
				<h2>Production</h2>
			</div>
			
			<div class="form-group col-md-3">
				<label class="control-label">MMS Cost (kr)</label>
				<input type="text" class="form-control" name="proposal_mms_cost" placeholder="MMS Cost" value="<?=$proposal_mms_cost?>">
			</div>
			<div class="clearfix"></div>
			
			
			
			<div class="form-section-heading">	
				<h2>Margin</h2>
			</div>
			<?php  if($proposal_type==1 || $proposal_type==2 || $proposal_type==3 || $proposal_type==4){
				$stylesm = '';
			}else{	
				$stylesm = 'display:none';
			}
			?>
			<div class="form-group col-md-3 show-solar-margin" style="<?=$stylesm?>">
				<label class="control-label" style="color:red;">Solar panel margin (%) <i class="fa fa-info-circle" title="Do not change" style="color:red;"></i></label>
				<input type="text" class="form-control" name="solar_margin" value="<?=$solar_margin?$solar_margin:$obj_smrg[0]->margin?>">
				<label class="control-label" style="color:red;">Solar panel actual margin (%) <i class="fa fa-info-circle" title="Do not change" style="color:red;"></i></label>
				<input type="text" class="form-control" value="<?=$obj_smrg[0]->margin?>" disabled>
			</div>
			<?php if($proposal_type==2 || $proposal_type==3 || $proposal_type==5 || $proposal_type==7){
				$stylem = '';
			}else{	
				$stylem = 'display:none';
			}
			?>
			<div class="form-group col-md-3 show-charger-margin" style="<?=$stylem?>">
				<label class="control-label" style="color:red;">Charger margin (%) <i class="fa fa-info-circle" title="Do not change" style="color:red;"></i></label>
				<input type="text" class="form-control" name="charger_margin" value="<?=$charger_margin?$charger_margin:$obj_evmrg[0]->margin?>">
				<label class="control-label" style="color:red;">Charger actual margin (%) <i class="fa fa-info-circle" title="Do not change" style="color:red;"></i></label>
				<input type="text" class="form-control" value="<?=$obj_evmrg[0]->margin?>" disabled>
			</div>
			<?php  if($proposal_type==3 || $proposal_type==4 || $proposal_type==6 || $proposal_type==7){
				$stylebm = '';
			}else{	
				$stylebm = 'display:none';
			}
			?>
			<div class="form-group col-md-3 show-battery-margin" style="<?=$stylebm?>">
				<label class="control-label" style="color:red;">Battery margin (%) <i class="fa fa-info-circle" title="Do not change" style="color:red;"></i></label>
				<input type="text" class="form-control" name="battery_margin" value="<?=$battery_margin?$battery_margin:$obj_btmrg[0]->margin?>">
				<label class="control-label" style="color:red;">Battery actual margin (%) <i class="fa fa-info-circle" title="Do not change" style="color:red;"></i></label>
				<input type="text" class="form-control" value="<?=$obj_btmrg[0]->margin?>" disabled>
			</div>
			<div class="clearfix"></div>
			
			<div class="form-group col-md-3">
				<label class="control-label">Current status</label>
				<select class="form-control select2" id="status" name="status">
					<option value="">Select Status</option>
					<?php foreach ($leadsStatusArr as $skey => $sval) {
						if($status==$skey){
							$statusSel = 'selected';
						}else{
							$statusSel = '';
						}
						echo '<option value="'.$skey.'" '.$statusSel.'>'.$sval.'</option>';
					}
					?>
				</select>
			</div>
			<div class="form-group col-sm-12">
				<button type="submit" class="btn btn-primary" name="save-only">Save</button>
				<button type="button" onClick="generatePDF()" name="save-generate" class="btn btn-primary">Save & Generate</button>
				<a href="javascript:void()" onClick="backToPage()" class=""><button type="button" class="btn btn-primary">Back</button></a>
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

<script>
$("#proposal_type").change(function(){
	var p_type = $(this).val();
	//alert(f_status);
	var number_of_proposal = $("input[type='radio']:checked").val();
	if(p_type=="3" || p_type=="4"){
		$(".show_proposal_selection").show();
		if(number_of_proposal==2){
			$('.customer_name2_show').show();
		}else{
			$('.customer_name2_show').hide();
		}
	}else{
		$(".show_proposal_selection").hide();
		$('.customer_name2_show').hide();
	}
});
</script>
<script>
$("#proposal_type").change(function(){
	var p_type = $(this).val();
	//alert(f_status);
	if(p_type=="1" || p_type=="2" || p_type=="3" || p_type=="4"){
		$(".show-solar-margin").show();
	}else{
		$(".show-solar-margin").hide();
	}
});
</script>
<script>
$("#proposal_type").change(function(){
	var p_type = $(this).val();
	//alert(f_status);
	if(p_type=="2" || p_type=="3" || p_type=="5" || p_type=="7"){
		$(".charger_show").show();
		$(".show_charger_disc").show();
		$(".show-charger-margin").show();
	}else{
		$(".charger_show").hide();
		$(".show_charger_disc").hide();
		$(".show-charger-margin").hide();
	}
});
</script>
<script>
$("#proposal_type").change(function(){
	var p_type = $(this).val();
	//alert(f_status);
	if(p_type=="3" || p_type=="4" || p_type=="6" || p_type=="7"){
		$(".battery_show").show();
		$(".show_battery_disc").show();
		$(".show-battery-margin").show();
	}else{
		$(".battery_show").hide();
		$(".show_battery_disc").hide();
		$(".show-battery-margin").hide();
	}
});
</script>

<script>
//panel discount

$("#panel_model").change(function(){
	var panel_name = $(this).val();
	$.ajax({
		type:'post',
		url:"<?=SITE_PATH_ADM.CPAGE?>/panel-discount.php",
		data:"panel_name="+panel_name,
		success:function(response){
		//alert(response); 
			if(response){
				$('#solar_discount').val(response);	
			}
		}
	});
});
</script>

<script>
//charger discount

$("#charger_name").change(function(){
	var charger_name = $(this).val();
	$.ajax({
		type:'post',
		url:"<?=SITE_PATH_ADM.CPAGE?>/charger-discount.php",
		data:"charger_name="+charger_name,
		success:function(response){
		//alert(response); 
			if(response){
				$('#charger_discount').val(response);	
				$('#actual_charger_discount').val(response);	
			}
		}
	});
});
</script>
<script>
$(document).ready(function(){
	var charger_name = '<?=$charger_name?>';
	$.ajax({
		type:'post',
		url:"<?=SITE_PATH_ADM.CPAGE?>/charger-discount.php",
		data:"charger_name="+charger_name,
		success:function(response){
		//alert(response); 
			if(response){
				$('#actual_charger_discount').val(response);	
			}
		}
	});
});
</script>

<script>
//battery discount

$("#battery_name").change(function(){
	var battery_name = $(this).val();
	$.ajax({
		type:'post',
		url:"<?=SITE_PATH_ADM.CPAGE?>/battery-discount.php",
		data:"battery_name="+battery_name,
		success:function(response){
		//alert(response); 
			if(response){
				$('#battery_discount').val(response);	
				$('#actual_battery_discount').val(response);	
			}
		}
	});
});
</script>
<script>
$(document).ready(function(){
	//alert('<?=$battery_name?>');
	var battery_name = '<?=$battery_name?>';
	$.ajax({
		type:'post',
		url:"<?=SITE_PATH_ADM.CPAGE?>/battery-discount.php",
		data:"battery_name="+battery_name,
		success:function(response){
		//alert(response); 
			if(response){
				$('#actual_battery_discount').val(response);	
			}
		}
	});
});
</script>
<script>
$(document).ready(function(){ 
    $("input[name$='number_of_proposal']").click(function() {
        var pval = $(this).val();
		//alert(pval);
		if(pval==2){
			$('.customer_name2_show').show();
		}else{
			$('.customer_name2_show').hide();
		}
    }); 
});
</script>
<script>
function backToPage(){
	location.href = '<?=$_SESSION["REFERER_page"]?>';
}
</script>
 

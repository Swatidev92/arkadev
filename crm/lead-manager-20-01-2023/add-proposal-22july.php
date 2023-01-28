<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php
$action_message ='';
$pid = $_GET['id']; 
$leadid = $_GET['leadid']; 

if($_SESSION['REFERER_page']==''){
$_SESSION['REFERER_page']=$_SERVER['HTTP_REFERER'];
}
/*
if (isset($_POST["save-only"])) {
	//print_r($_FILES);die;
		
	date_default_timezone_set('Asia/Kolkata');
	
	if($_FILES["installation_image"]["name"]){ 
		$_POST["installation_image"] = uploadImage("installation_image","proposal");
	}else{
		$_POST["installation_image"] = $_POST["installation_image"];
	}
	if($_POST['proposal_type']!=3 && $_POST['proposal_type']!=4){
		$_POST['number_of_proposal']=1;
		$_POST['customer_name2']='';
	}else{
		$_POST['number_of_proposal'] = $_POST['number_of_proposal'];
		$_POST['customer_name2']= $_POST['customer_name2'];
	}
	
	$_POST['address_input']= $_POST['proposal_address'];
	
	if($_POST['proposal_type']==1){
		$_POST['battery_name']='';
		$_POST['charger_name']='';
		$_POST['charger_discount']='';
		$_POST['battery_discount']='';
	}
	if($_POST['proposal_type']==2 || $_POST['proposal_type']==5 || $_POST['proposal_type']==9){
		$_POST['battery_name']='';
		$_POST['battery_discount']='';
	}
	if($_POST['proposal_type']==4 || $_POST['proposal_type']==6 || $_POST['proposal_type']==10 || $_POST['proposal_type']==11){
		$_POST['charger_name']='';
		$_POST['charger_discount']='';
	}
	
	if($_POST['proposal_type']==1 || $_POST['proposal_type']==2 || $_POST['proposal_type']==3 || $_POST['proposal_type']==4 || $_POST['proposal_type']==8 || $_POST['proposal_type']==9 || $_POST['proposal_type']==10 || $_POST['proposal_type']==11){
		$solar_name = 'solar';
	}else{
		$solar_name = '';
	}
	$old_status=$_POST['old_status'];
	$status=$_POST['status'];
	$cms->db_query("UPDATE #_leads SET status=$status WHERE id=$leadid");
	if($old_status!=$status && $status==4 && $old_status!=4){
		$leadsStatusArr = getAllStatus();
		$action_message="Status Changed from <b>".$leadsStatusArr[$old_status]."</b> to <b>".$leadsStatusArr[$status]."</b>";
		
		$_POSTS["lead_id"] = $leadid;
		$_POSTS["action_message"] = $action_message;
		$_POSTS["action_date"] = date('Y-m-d h:i:s');
		$_POSTS["action_by"] = $_SESSION["ses_adm_id"];
		$_POSTS["action"] = $_POST["status"];
		$cms->sqlquery("rs","lead_tracker",$_POSTS);
	}
		
	if($_POST['status']==4){
		$_POST['lead_type'] = 3; //converted to project		
	}else{
		$_POST['lead_type'] = 2; // converted to proposal
	}
	//$_POST['source'] = 0;
	//$_POST["form_type"] = 4;
	//$_POST["post_by"] = $_SESSION["ses_adm_id"];
	//$_POST["assigned_to"] = $_SESSION["ses_adm_id"];
	$_POST["update_date"] = date("Y-m-d h:i:s");
	
	if($leadid && $pid==''){   //created first time
		$_POST["created_date"] = date("Y-m-d h:i:s");
		$_POST["post_date"] = date("Y-m-d");
		$_POST["parent_id"] = $leadid;
		$_POST["lead_id"] = $leadid;
	}else if($leadid && $pid!=''){ //re-generate;
		$_POST["created_date"] = date("Y-m-d h:i:s");
		$_POST["post_date"] = date("Y-m-d");
		$_POST["parent_id"] = $pid;
		$_POST["lead_id"] = $leadid;
	}else{  
		$_POST["created_date"] = date("Y-m-d h:i:s");
		$_POST["post_date"] = date("Y-m-d");
	}	
		
	if($_POST['create_log']==1){
		$lead_insert_id=$cms->sqlquery("rs","leads",$_POST);
		$POSTARR["quotation_number"] = generateQuotationNumber($lead_insert_id,$solar_name,$_POST['charger_name'],$_POST['battery_name']);
		$cms->sqlquery("rs","leads",$POSTARR, 'id', $lead_insert_id);		
	}else{
		if($_POST["quotation_number"]==''){
			$getParentId = $cms->getSingleResult("SELECT id FROM #_leads where id=$leadid AND status=1 AND is_deleted=0 ");
			$_POST["quotation_number"] = generateQuotationNumber($getParentId,$solar_name,$_POST['charger_name'],$_POST['battery_name']);
		}
		$lead_insert_id = $pid;
		//$_POST['quotation_date'] = date('Y-m-d');
		//$_POST['quotation_valid_till'] = date('Y-m-d',strtotime(date("Y-m-d", strtotime(date('Y-m-d'))) . " +15 day")); //next 15 days
		$cms->sqlquery("rs","leads",$_POST, 'id', $pid);
	}
	
	$adm->sessset('Record has been added', 's');	
	$path = $_SESSION['REFERER_page'];
	echo "<script>window.location.href='".$path."';</script>";
	//$cms->redir($path, true);	
}
*/
			
  
if($leadid!='' && $pid!=''){
	$whereCond = "id='".$pid."'";
}
if($leadid!='' && $pid==''){
	$whereCond = "id='".$leadid."'";
}

$rsAdmin = $cms->db_query("select * from #_leads where $whereCond ");
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
$obj_mintotalmrg = json_decode($priceRes['minimum_total_margin']);

$lead_automatic = $cms->getSingleResult("SELECT automatic FROM #_leads where id=$leadid ");

if($lead_automatic==1 && $_SESSION["ses_adm_role"]==1){
	$autofill = '';
}
elseif($lead_automatic==1 && $_SESSION["ses_adm_role"]!=1){
	$autofill = 'readonly';
}else{
	$autofill = '';
}
//echo $_SESSION["ses_adm_id"];

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
			<div class="form-section-heading">	
				<h2>Proposal details</h2>
			</div>
			<input type="hidden" class="form-control" name="proposal_customer_type" value="<?=$cms->getSingleResult("SELECT proposal_customer_type FROM #_leads where id=$leadid ")?>">
			<input type="hidden" class="form-control" name="customer_name" value="<?=$cms->getSingleResult("SELECT customer_name FROM #_leads where id=$leadid ")?>">
			<input type="hidden" class="form-control" name="email" value="<?=$cms->getSingleResult("SELECT email FROM #_leads where id=$leadid ")?>">
			<input type="hidden" class="form-control" name="phone" value="<?=$cms->getSingleResult("SELECT phone FROM #_leads where id=$leadid ")?>">
			<input type="hidden" class="form-control" name="lead_unique_id" value="<?=$lead_unique_id?>">
			<input type="hidden" name="automatic" id="automatic" value="<?=$lead_automatic?>">
			<input type="hidden" class="form-control" name="proposal_address" value="<?=$cms->getSingleResult("SELECT proposal_address FROM #_leads where id=$leadid ")?>">
			<input type="hidden" class="form-control" name="pid" value="<?=$leadid?>">
			<input type="hidden" class="form-control" name="parent_id" value="<?=$pid?>">
			<div class="form-group col-md-4">
				<label class="control-label">Proposal Type</label>
				<select class="form-control" id="proposal_type" name="proposal_type" required>
					<option value="">Select Proposal Type</option>					
					<?php $proposalType = json_decode($customerPriceArr["proposal_type_name"], true);
					foreach ($proposalType as $pkey=>$pval){
						if($pval["status"]==1){
							if($proposal_type==$pval["pnum"] && ($leadid!='' && $pid!='')){
								$psel = 'selected';
							}else{
								$psel = '';
							}
							echo '<option value="'.$pval["pnum"].'" '.$psel.'>'.$pval["name"].'</option>';
					} 	}
					?>
				</select>
			</div>
			<?php if($proposal_type==3 || $proposal_type==4 || $proposal_type==8 || $proposal_type==11){
				$propCount = 'display:block;';
			}else{
				$propCount = 'display:none;';
			}?>
			<div class="col-md-3 show_proposal_selection" style="<?=$propCount?>">
				<label class="control-label">Generate number of proposal</label>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="number_of_proposal" id="number_of_proposal1" value="1" <?=$number_of_proposal==1?'checked':''?>>
					<label class="form-check-label" for="number_of_proposal1">1 Proposal</label>
					&nbsp;&nbsp;&nbsp;
					<input class="form-check-input" type="radio" name="number_of_proposal" id="number_of_proposal2" value="2" <?=$number_of_proposal==2?'checked':''?>>
					<label class="form-check-label" for="number_of_proposal2">2 Proposal</label>
				</div>
			</div>
			<div class="form-group col-md-2">
				<label class="control-label">Prefix Proposal Name</label>
				<input type="text" class="form-control" name="proposal_name" value="<?=($leadid!='' && $pid!='')?$proposal_name:''?>" id="proposal_name">
			</div>
			<?php if($leadid && $pid!=''){ ?>
			<div class="col-sm-3" style="margin-top:25px;">
				<div class="checkbox checkbox-success">
					<input id="create_log" type="checkbox" name="create_log" value="1">
					<label for="create_log"> Create new version </label>
				</div>
			</div>
			<?php }else{ ?>
			<input type="hidden" name="create_log" value="1">
			<?php } ?>
			<div class="clearfix"></div>	
			<?php 
			$obj_max_solar = json_decode($customerPriceArr['solar_max_rebate']);
			$obj_max_solar_ev = json_decode($customerPriceArr['solar_ev_max_rebate']);
			$obj_max_solar_battery = json_decode($customerPriceArr['solar_battery_max_rebate']);
			$obj_max_solar_ev_battery = json_decode($customerPriceArr['solar_ev_battery_max_rebate']);
			?>
			<input type="hidden" name="max_solar_rebate" value="<?=$obj_max_solar[0]->status==1?$obj_max_solar[0]->maxmargin:0?>">
			<input type="hidden" name="max_solar_ev_rebate" value="<?=$obj_max_solar_ev[0]->status==1?$obj_max_solar_ev[0]->maxmargin:0?>">
			<input type="hidden" name="max_solar_battery_rebate" value="<?=$obj_max_solar_battery[0]->status==1?$obj_max_solar_battery[0]->maxmargin:0?>">
			<input type="hidden" name="max_solar_ev_battery_rebate" value="<?=$obj_max_solar_ev_battery[0]->sevstatus==1?$obj_max_solar_ev_battery[0]->sevmaxmargin:0?>">
			<input type="hidden" name="max_only_battery_rebate" value="<?=$obj_max_solar_ev_battery[0]->sbstatus==1?$obj_max_solar_ev_battery[0]->bmaxmargin:0?>">
			
			<?php if($proposal_type==11 && $leadid && $pid!=''){ 
				$sbMaxstyle = "";
			}else{
				$sbMaxstyle = "display:none";
			}
			?>
			<div class="col-sm-8 show-max-rebate-solar-battery" style="<?=$sbMaxstyle?>">
				<table class="table table-striped1 table-hover1 table-bordered">
					<thead>
						<tr>
							<div class="form-check">
								<th class="text-center"><input class="form-check-input" type="radio" name="number_of_person" id="number_of_person1" value="1" <?=$number_of_person==1?'checked':''?>>
								<label class="form-check-label" for="number_of_person1">1 Person</label></th>
								
								<th class="text-center" colspan="2"><input class="form-check-input" type="radio" name="number_of_person" id="number_of_person2" value="2" <?=$number_of_person==2?'checked':''?>>
								<label class="form-check-label" for="number_of_person2">2 Person</label></th>
							</div>
						</tr>
						<tr>
							<th class="text-center">Solar+Battery</th>
							<th class="text-center">Solar</th>
							<th class="text-center">Battery</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<?php if($max_solar_battery_person1_rebate==''){
									if($obj_max_solar_battery[0]->status==1){
										$max_solar_battery_person1_rebate = $obj_max_solar_battery[0]->maxmargin;
									}else{
										$max_solar_battery_person1_rebate = 0;
									}
								}else{
									$max_solar_battery_person1_rebate = $max_solar_battery_person1_rebate;
								}?>
								<input type="text" class="form-control" name="max_solar_battery_person1_rebate" value="<?=$max_solar_battery_person1_rebate?>">
							</td>
							<td>
								<?php if($max_solar_person2_rebate==''){
									if($obj_max_solar_battery[0]->smaxstatus==1){
										$max_solar_person2_rebate = $obj_max_solar_battery[0]->solarmaxmargin;
									}else{
										$max_solar_person2_rebate = 0;
									}
								}else{
									$max_solar_person2_rebate = $max_solar_person2_rebate;
								}?>
								<input type="text" class="form-control" name="max_solar_person2_rebate" value="<?=$max_solar_person2_rebate?>">
							</td>
							<td>								
								<?php if($max_battery_person2_rebate==''){
									if($obj_max_solar_battery[0]->bmaxstatus==1){
										$max_battery_person2_rebate = $obj_max_solar_battery[0]->batterymaxmargin;
									}else{
										$max_battery_person2_rebate = 0;
									}
								}else{
									$max_battery_person2_rebate = $max_battery_person2_rebate;
								}?>
								<input type="text" class="form-control" name="max_battery_person2_rebate" value="<?=$max_battery_person2_rebate?>">
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="form-group col-sm-3">
				<label class="control-label">Offer Type</label>
				<select class="form-control" name="offer_type" id="offer_type" required>
					<?php foreach($offerTyeArr as $fkey=>$fval){
						if($offer_type==$fkey){
							$fsel = 'selected';
						}else{
							$fsel = '';
						}
					?>
					<option value="<?=$fkey?>" <?=$fsel?>><?=$fval?></option> 
					<?php } ?>
				</select>
			</div>
			<div class="clearfix"></div>
			<?php if($number_of_proposal==2 && ($proposal_type==3 || $proposal_type==4 || $proposal_type==8 || $proposal_type==11)){
					$name2Style = 'display:block';
			}else{
				$name2Style = 'display:none';
			}
			?>
			<div class="form-group col-md-6 customer_name2_show" style="<?=$name2Style?>">
				<label class="control-label">Name 2</label>
				<input type="text" class="form-control" name="customer_name2" placeholder="Full name" value="<?=($leadid!='' && $pid!='')?$customer_name2:''?>" required>
			</div>
			<div class="clearfix"></div>	
			
			<div class="form-section-heading">	
				<h2>Sales channel details</h2>
			</div>
			<?php $lead_assigned_to = $cms->getSingleResult("SELECT assigned_to FROM #_leads where id=$leadid ");
			
			if($lead_assigned_to!=''){
			$agentQry = $cms->db_query("SELECT id, customer_name, email_id, contact_no FROM #_users where id=$lead_assigned_to AND status=1 AND is_deleted=0 ");
			$agentRes = $agentQry->fetch_array();
			} ?>
			<input type="hidden" name="form_type" value="<?=$cms->getSingleResult("SELECT form_type FROM #_leads where id=$leadid ")?>">
			<input type="hidden" name="post_by" value="<?=$_SESSION["ses_adm_id"]?>">
			<input type="hidden" name="assigned_to" value="<?=$lead_assigned_to?>">
			<div class="form-group col-md-4">
				<label class="control-label">Reference</label>
				<input type="text" class="form-control" name="reference" placeholder="Our reference" value="<?=$agentRes['customer_name']?>" readonly>
			</div>
			<div class="form-group col-md-4">
				<label class="control-label">Reference Email</label>
				<input type="email" class="form-control" name="ref_email" placeholder="Reference Email" value="<?=$agentRes['email_id']?>" readonly>
			</div>
			<div class="form-group col-md-4">
				<label class="control-label">Reference Phone</label>
				<input type="text" class="form-control" name="ref_phone" placeholder="Reference Phone" value="<?=$agentRes['contact_no']?>" readonly>
			</div>
			<div class="clearfix"></div>
			<input type="hidden" class="form-control" name="quotation_number" value="<?=$quotation_number?>">
			
			<div class="col-md-4">	
				<label class="control-label">Quotation date(Y-m-d)</label>
				<?php if($_SESSION["ses_adm_role"]==1){?>
				<div class="input-group">
					<input class="form-control" id="quotation_date" type="text" name="quotation_date" autocomplete="off" value="<?=date('Y-m-d')?>">
					<span class="input-group-addon"><i class="icon-calender"></i></span> 
				</div>
				<?php }else{?>
					<input class="form-control" id="" type="text" name="quotation_date" autocomplete="off" value="<?=date('Y-m-d')?>" readonly>
				<?php } ?>
			</div>
			<div class="col-md-4">
				<label class="control-label">Quotation valid till (Y-m-d)</label>
				<?php if($_SESSION["ses_adm_role"]==1){?>
				<div class="input-group">
					<input class="form-control" id="quotation_valid_till" type="text" name="quotation_valid_till" autocomplete="off" value="<?=date('Y-m-d',strtotime(date("Y-m-d", strtotime(date('Y-m-d'))) . " +15 day"))?>">
					<span class="input-group-addon"><i class="icon-calender"></i></span> 
				</div>
				<?php }else{?>
					<input class="form-control" id="" type="text" name="quotation_valid_till" autocomplete="off" value="<?=date('Y-m-d',strtotime(date("Y-m-d", strtotime(date('Y-m-d'))) . " +15 day"))?>" readonly>
				<?php } ?>
			</div>
			<div class="clearfix"></div>
			<div class="form-section-heading">	
				<h2>Technical information</h2>
			</div>
			<div class="form-group col-md-3">
				<label class="control-label">Panel Type</label>
				<select class="form-control select2" id="panel_model" name="panel_model" id="panel_model">
					<option value="">Select Panel Type</option>
					<?php $panelTyeArray = json_decode($customerPriceArr["panel_types"], true);
					usort($panelTyeArray, function ($a, $b) {
						return $a['name'] <=> $b['name'];
					});
					foreach ($panelTyeArray as $key => $value) {
						if($value["pstatus"]==1){
							if($panel_model==$value["name"] && $leadid!='' && $pid!=''){
								$psel = 'selected';
							}else{
								$psel = '';
							}
							echo '<option value="'.$value["name"].'" '.$psel.'>'.$value["name"].' - '.$value["wattage"].' Wp</option>';
					} 	}
					?>
				</select>
			</div>
			<div class="form-group col-md-2">
				<label class="control-label">Number Of Panels <?php if($lead_automatic==1){ ?><span style="<?=$binfo?>"><i class="fa fa-info-circle" title="Click refresh to apply changes" style="color:red;"></i></span><?php } ?></label>
				<input type="text" class="form-control" name="panel_count" value="<?=($leadid!='' && $pid!='')?$panel_count:''?>" id="panel_count">
			</div>
			<?php if($lead_automatic==1){ ?><div class="form-group col-md-1" style="margin-top:30px;">
				<a href="javascript:void(0)" onClick="updateData()"><i class="fa fa-refresh text-success"></i></a>
			</div>
			<?php } ?>
			<div class="form-group col-md-3">
				<label class="control-label">Color</label>
				<input type="text" class="form-control" name="color" id="color" value="<?=($leadid!='' && $pid!='')?$color:''?>" readonly>
			</div>
			<div class="form-group col-md-3">
				<label class="control-label">Roof Type</label>
				<input type="text" class="form-control" name="roofing_material" placeholder="Roofing material" value="<?=$roofing_material?>" id="roofing_material" readonly>
			</div>
			<div class="clearfix"></div>
			<div class="form-group col-md-3">
				<label class="control-label">Inverter Type 1</label>
				<select class="form-control select2" id="inverter_type" name="inverter_type">
					<option value="">Select Inverter Type</option>
					<?php $inverterTyeArray = json_decode($customerPriceArr["inverter_types"], true);
					usort($inverterTyeArray, function ($a, $b) {
						return $a['name'] <=> $b['name'];
					});
					foreach ($inverterTyeArray as $ikey => $ivalue) {
						if($ivalue["invstatus"]){
						if($inverter_type==$ivalue["name"] && ($leadid!='' && $pid!='')){
							$invsel = 'selected';
						}else{
							$invsel = '';
						}
						echo '<option value="'.$ivalue["name"].'" '.$invsel.'>'.$ivalue["name"].'</option>';
					} }
					?>
				</select>
			</div>
			<div class="form-group col-md-3">
				<label class="control-label">Inverter Type 2</label>
				<select class="form-control select2" id="inverter_type2" name="inverter_type2">
					<option value="">Select Inverter Type</option>
					<?php $inverterTyeArray = json_decode($customerPriceArr["inverter_types"], true);
					usort($inverterTyeArray, function ($a, $b) {
						return $a['name'] <=> $b['name'];
					});
					foreach ($inverterTyeArray as $ikey => $ivalue) {
						if($ivalue["invstatus"]){
						if($inverter_type2==$ivalue["name"] && ($leadid!='' && $pid!='')){
							$invsel = 'selected';
						}else{
							$invsel = '';
						}
						echo '<option value="'.$ivalue["name"].'" '.$invsel.'>'.$ivalue["name"].'</option>';
					} }
					?>
				</select>
			</div>
			<div class="form-group col-md-3">
				<label class="control-label">Inverter Type 3</label>
				<select class="form-control select2" id="inverter_type3" name="inverter_type3">
					<option value="">Select Inverter Type</option>
					<?php $inverterTyeArray = json_decode($customerPriceArr["inverter_types"], true);
					usort($inverterTyeArray, function ($a, $b) {
						return $a['name'] <=> $b['name'];
					});
					foreach ($inverterTyeArray as $ikey => $ivalue) {
						if($ivalue["invstatus"]){
						if($inverter_type3==$ivalue["name"] && ($leadid!='' && $pid!='')){
							$invsel = 'selected';
						}else{
							$invsel = '';
						}
						echo '<option value="'.$ivalue["name"].'" '.$invsel.'>'.$ivalue["name"].'</option>';
					} }
					?>
				</select>
			</div>
			<div class="form-group col-md-3">
				<label class="control-label">Installation Days &nbsp; <a href="javascript:void(0)" data-toggle="modal" data-target="#installation_chart"> <i class="fa fa-info" aria-hidden="true"></i> </a></label>
				<div class="show_installation_days">
				<?php if($_SESSION["ses_adm_role"]!=1){ ?>
					<input type="text" name="installation_days" class="form-control" value="<?=($leadid!='' && $pid!='')?$installation_days:''?>" readonly>
				<?php }else{ ?>
					<select class="form-control select2" id="installation_days" name="installation_days">
						<option value="">Select Installation Days</option>
						<?php $installationArray = json_decode($customerPriceArr["installation_charges"], true);
						
						foreach ($installationArray as $ikey => $invalue) {
							$installationJsonArray[$ikey] = floatval(str_replace(',', '.', $invalue[day]));
						}
						asort($installationJsonArray);
						foreach ($installationJsonArray as $daykey => $dayVal) {
							if($installation_days==$dayVal && ($leadid!='' && $pid!='')){
								$inssel = 'selected';
							}else{
								$inssel = '';
							}
							echo '<option value="'.$dayVal.'" '.$inssel.'>'.$dayVal.'</option>';
						}
						?>
					</select>
				<?php }	?>
				</div>
			</div>
			<div class="clearfix"></div>
			
			<div class="form-group col-md-4">
				<label class="control-label">Roof dimensions (AA x BB m,CC x DD m)</label>
				<input type="text" class="form-control" name="panel_area_dimension" value="<?=($leadid!='' && $pid!='')?$panel_area_dimension:''?>">
			</div>
			<div class="clearfix"></div>
			
			<?php if($proposal_type==3 || $proposal_type==4 || $proposal_type==6 || $proposal_type==7 || $proposal_type==8 || $proposal_type==10 || $proposal_type==11){
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
					usort($batteryTyeArray, function ($a, $b) {
						return $a['name'] <=> $b['name'];
					});
					foreach ($batteryTyeArray as $bkey => $bvalue) {
						if($bvalue["bstatus"]==1){
						if($battery_name==$bvalue["name"] && ($leadid!='' && $pid!='')){
							$bsel = 'selected';
						}else{
							$bsel = '';
						}
						echo '<option value="'.$bvalue["name"].'" '.$bsel.'>'.$bvalue["name"].'</option>';
					} }
					?>
				</select>
			</div>
			<?php if($proposal_type==2 || $proposal_type==3 || $proposal_type==5 || $proposal_type==7 || $proposal_type==8 || $proposal_type==9){
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
					usort($chargerTyeArray, function ($a, $b) {
						return $a['name'] <=> $b['name'];
					});
					foreach ($chargerTyeArray as $ckey => $cvalue) {
						if($cvalue["evstatus"]==1){
						if($charger_name==$cvalue["name"] && ($leadid!='' && $pid!='')){
							$csel = 'selected';
						}else{
							$csel = '';
						}
						echo '<option value="'.$cvalue["name"].'" '.$csel.'>'.$cvalue["name"].'</option>';
					} }
					?>
				</select>
			</div>
			
			<div class="form-group col-md-3 charger_show" style="margin-top:30px; <?=$stylec?>">
				<label class="control-label" for="load_balancer">Load Balancer</label>
				<input type="checkbox" id="load_balancer" name="load_balancer" value="1" <?=($leadid!='' && $pid!='')?($load_balancer==1?'checked':''):''?>>
			</div>
			<div class="clearfix"></div>
			<?php  if($proposal_type==2 || $proposal_type==3 || $proposal_type==4 || $proposal_type==5 || $proposal_type==6 ||$proposal_type==7 || $proposal_type==8 || $proposal_type==9 || $proposal_type==10 || $proposal_type==11){			
				$styletd = '';?>
			<?php }else{	
				$styletd = 'display:none';
			}
			?>
			<div class="form-group col-md-3 show_total_disc" style="<?=$styletd?>">
				<label class="control-label">Discount (kr)</label>
				<input type="text" class="form-control" name="total_discount" id="total_discount" value="<?=($leadid!='' && $pid!='')?$total_discount:''?>">
			</div>
			<div class="clearfix"></div>
			<div class="form-section-heading">	
				<h2>Estimated production and conditions</h2>
			</div>
			<div class="form-group col-md-3">
				<label class="control-label">Annual consumption(kWh)</label>
				<input type="text" class="form-control" name="annual_electricity_consumption" value="<?=$cms->getSingleResult("SELECT annual_electricity_consumption FROM #_leads where id=$leadid ")?>" placeholder="Annual electricity consumption in property" readonly>
			</div>
			<div class="form-group col-md-3">
				<label class="control-label">Annual production(kWh)</label>
				<input type="text" class="form-control" name="annual_production" value="<?=($leadid!='' && $pid!='')?$annual_production:''?>" placeholder="Estimated annual production solar">
			</div>
			<div class="form-group col-md-3">
				<label class="control-label">Self-use of solar (%)</label>
				<input type="text" class="form-control" name="self_use_solar" id="self_use_solar" value="<?=($leadid!='' && $pid!='')?$self_use_solar:''?>" placeholder="Self-use of solar">
			</div>
			<div class="form-group col-md-3">
				<label class="control-label">Angle of panels</label>
				<input type="text" class="form-control" name="roof_angle" value="<?=$cms->getSingleResult("SELECT roof_angle FROM #_leads where id=$leadid ")?>" placeholder="Angle of panels" readonly>
			</div>
			<div class="clearfix"></div>
			<div class="form-section-heading">	
				<h2>Dimensioning</h2>
			</div>
			<div class="form-group col-md-12">
				<label class="label-control">The system is connected to the property's electrical exchange and installed according to the picture below.<br>(570px X 330px and should be less than 1 MB) (only png,jpg,jpeg)</label>
			</div>
			<div class="form-group col-md-6">
				<div>
					<input type="file" name="installation_image" id="drop_area<?=$id?>" class="dropify dropify-area-img installation_image" data-max-file-size="1M" data-height="150" <?php if($installation_image AND file_exists(FILES_PATH.'proposal/'.$installation_image) && ($leadid!='' && $pid!='')){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/proposal/<?=$installation_image?>" <?php } ?> />
				</div>
				<input type="hidden" name="installation_image" value="<?=$installation_image?>">
			</div>
			<div class="clearfix"></div>
			
			<div class="form-section-heading">	
				<h2>MMS</h2>
			</div>			
			<div class="form-group col-md-3">
				<label class="control-label">MMS Cost (kr)</label>
				<input type="text" class="form-control" name="proposal_mms_cost" value="<?=($leadid!='' && $pid!='')?$proposal_mms_cost:''?>" id="proposal_mms_cost" <?=$autofill?>>
			</div>
			<div class="clearfix"></div>
			
			
			<?php  if($proposal_type!=''){ 
				$stylesm1 = '';
			}else{	
				$stylesm1 = 'display:none';
			}
			?>
			<?php if($obj_mintotalmrg[0]->status==1){
				$totminmargin = $obj_mintotalmrg[0]->margin;
				$margininfo = '';
			}else{
				$totminmargin = 0;
				$margininfo = 'display:none';
			}?>
			<div class="form-section-heading" id="margin-heading" style="<?=$stylesm1?>">	
				<h2>Margin</h2>
			</div>
			<?php  if(($proposal_type==1 || $proposal_type==2 || $proposal_type==3 || $proposal_type==4 || $proposal_type==8 || $proposal_type==9 || $proposal_type==10 || $proposal_type==11)){
				$stylesm = '';
			}else{	
				$stylesm = 'display:none';
			}
			?>
			<?php if($obj_smrg[0]->status==1){
				$smargin = $obj_smrg[0]->margin;
				$sinfo = '';
			}else{
				$smargin = 0;
				$sinfo = 'display:none';
			}?>
			<div class="form-group col-md-3 show-solar-margin" style="<?=$stylesm?>">
				<label class="control-label" style="color:red;">Solar panel margin (%) <span style="<?=$sinfo?>"><i class="fa fa-info-circle" title="Minimum <?=$obj_smrg[0]->margin?>%" style="color:red;"></i><br>(Minimum <?=$obj_smrg[0]->margin?>%)</span></label>

				<input type="number" class="form-control" name="solar_margin" value="<?=($leadid!='' && $pid!='')?($solar_margin?$solar_margin:$smargin):$smargin?>" <?=$_SESSION["ses_adm_role"]==1?'':''?> min="<?=($_SESSION["ses_adm_role"]==1)?0:$smargin?>">
			</div>
			<?php if($proposal_type==2 || $proposal_type==3 || $proposal_type==5 || $proposal_type==7 || $proposal_type==8 || $proposal_type==9){
				$stylem = '';
			}else{	
				$stylem = 'display:none';
			}
			?>
			<?php if($obj_evmrg[0]->status==1){
				$cmargin = $obj_evmrg[0]->margin;
				$evinfo = '';
			}else{
				$cmargin = 0;
				$evinfo = 'display:none';
			}?>
			<div class="form-group col-md-3 show-charger-margin" style="<?=$stylem?>">
				<label class="control-label" style="color:red;">Charger margin (%) <span style="<?=$evinfo?>"><i class="fa fa-info-circle" title="Minimum <?=$obj_evmrg[0]->margin?>%" style="color:red;"></i><br>(Minimum <?=$obj_evmrg[0]->margin?>%)</span></label>
				
				<input type="number" class="form-control" name="charger_margin" value="<?=($leadid!='' && $pid!='')?($charger_margin?$charger_margin:$cmargin):$cmargin?>" <?=$_SESSION["ses_adm_role"]==1?'':'readonly'?> min="<?=($_SESSION["ses_adm_role"]==1)?0:$cmargin?>">
			</div>
			<?php  if($proposal_type==3 || $proposal_type==4 || $proposal_type==6 || $proposal_type==7 || $proposal_type==8 || $proposal_type==10 || $proposal_type==11){
				$stylebm = '';
			}else{	
				$stylebm = 'display:none';
			}
			?>
			<?php if($obj_btmrg[0]->status==1){
				$bmargin = $obj_btmrg[0]->margin;
				$binfo = '';
			}else{
				$bmargin = 0;
				$binfo = 'display:none';
			}?>
			<div class="form-group col-md-3 show-battery-margin" style="<?=$stylebm?>">
				<label class="control-label" style="color:red;">Battery margin (%) <span style="<?=$binfo?>"><i class="fa fa-info-circle" title="Minimum <?=$obj_btmrg[0]->margin?>%" style="color:red;"></i><br>(Minimum <?=$obj_btmrg[0]->margin?>%)</span></label>
				
				<input type="number" class="form-control" name="battery_margin" value="<?=($leadid!='' && $pid!='')?($battery_margin?$battery_margin:$bmargin):$bmargin?>" <?=$_SESSION["ses_adm_role"]==1?'':'readonly'?> min="<?=($_SESSION["ses_adm_role"]==1)?0:$bmargin?>">
			</div>		
			<?php if($obj_btmrg[0]->status==1){
				$bmargin = $obj_btmrg[0]->margin;
				$binfo = '';
			}else{
				$bmargin = 0;
				$binfo = 'display:none';
			}?>
			
			<?php if($obj_mintotalmrg[0]->status==1){
				$totminmargin = $obj_mintotalmrg[0]->margin;
				$margininfo = '';
			}else{
				$totminmargin = 0;
				$margininfo = 'display:none';
			}?>
			<div class="form-group col-md-3">
				<label class="control-label" style="color:red;">Minimum Total Margin (%) <span style="<?=$margininfo?>"><i class="fa fa-info-circle" title="Minimum <?=$obj_mintotalmrg[0]->margin?>%" style="color:red;"></i><br>(Minimum <?=$obj_mintotalmrg[0]->margin?>%)</span></label>
				<input type="text" class="form-control" name="minimum_total_margin" value="<?=($leadid!='' && $pid!='')?($minimum_total_margin?$minimum_total_margin:$totminmargin):$totminmargin?>" <?=$_SESSION["ses_adm_role"]==1?'':'readonly'?>>
			</div>
			<div class="clearfix"></div>
			
			<div class="form-group col-md-3">
				<label class="control-label">Current status &nbsp; <a href="javascript:void(0)" data-toggle="modal" data-target="#status_chart"> <i class="fa fa-info" aria-hidden="true"></i> </a></label>
				<input type="hidden" name="old_status" value="<?=$status?>">
				<select class="form-control" id="status" name="status">
					<option value="">Select Status</option>
					<?php $leadsStatusArr = getAllStatus();
					foreach($leadsStatusArr as $status_key=>$status_val){
						if($status_key==4){
					?>
					<option value="<?=$status_key?>" <?=($status==$status_key && ($leadid!='' && $pid!=''))?'selected':''?>><?=$status_val?></option>
					<?php } } ?>
				</select>
			</div>
			
			<div class="clearfix"></div>
			<div class="form-group col-sm-12">
				<div class="form-group text-danger error-while-generating"></div>
				<button type="button" class="btn add-submit-btn" name="save-only" id="save_only">Save</button>
				<button type="submit" name="save-generate" id="save-generate" class="btn btn-primary">Save & Generate</button>
				<a href="javascript:void()" onClick="backToPage()" class=""><button type="button" class="btn back-btn">Back</button></a>
			</div>
		</div>
	</div>
</div>

<div class="modal" id="installation_chart">
	<div class="modal-dialog ">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title pull-left">Installation Days</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<img src="<?=SITE_PATH_ADM?>images/installation-chart.jpg" class="img-responsive">
			</div>
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
$("#save_only").click(function(e) {
    e.preventDefault();
	
	var frm = $('#aforms');
var formData = new FormData(frm[0]);
formData.append('file', $('input[type=file]')[0].files[0]);


	// var fd = new FormData();
        //var files = $('.installation_image')[0].files;
       // var form = $('#aforms').serialize();
        //alert(form);
           //fd.append('file',files[0]);
          // fd.append(form);
    $.ajax({
        type: "POST",
        url: "<?=SITE_PATH_ADM.CPAGE?>/save-proposal.php",
       
              data: formData,
              contentType: false,
              processData: false,
		beforeSend:function(){
			$(".admin-ajax-loader").show();
		},
        success: function(result) {
			$(".admin-ajax-loader").hide();
			location.href="<?=SITE_PATH_ADM.CPAGE?>?mode=proposal-list&start=&id=<?=$leadid?>";
        }
    });
	
});
</script>

<script>
$("#aforms").on("submit",function(e){
	if($("#save-generate").hasClass("disabled")==false){
		var formData = new FormData(this);
		$.ajax({
			url:"<?=SITE_PATH_ADM.CPAGE?>/generate.php",
			//data: $('#aforms').serialize(),
			type:"post",
			data: formData,			
			cache: false,
			contentType: false,
			processData: false,
			beforeSend:function(){
				$(".admin-ajax-loader").show();
			},
			success:function(response){
				$(".admin-ajax-loader").hide();
				//alert(response);
				$('.error-while-generating').html(response); 
			}
		});
	}
	return false;
    e.preventDefault();
});
</script>

<script>
$("#panel_model").change(function(){
	var panel_model = $(this).val();
	//alert(panel_model);
	if(panel_model){
		$.ajax({
			url:"<?=SITE_PATH_ADM.CPAGE?>/panel-color.php",
			type:"post",
			data: "panel_model="+panel_model,
			beforeSend:function(){
				$(".admin-ajax-loader").show();
			},
			success:function(response){
				$(".admin-ajax-loader").hide();
				$('#color').val(response); 
			}
		});
	}
});
</script>

<script>
$(document).ready(function(){
	var panel_model = '<?=$panel_model?>';
	//alert(panel_model);
	if(panel_model){
		$.ajax({
			url:"<?=SITE_PATH_ADM.CPAGE?>/panel-color.php",
			type:"post",
			data: "panel_model="+panel_model,
			success:function(response){
				$('#color').val(response); 
			}
		});
	}
});
</script>
<script>
$("#proposal_type").change(function(){
	var p_type = $(this).val();
	//alert(f_status);
	var number_of_proposal = $("input[type='radio']:checked").val();
	if(p_type=="3" || p_type=="4" || p_type=="8" || p_type=="11"){
		$(".show_proposal_selection").show();
		if(number_of_proposal==2){
			$('.customer_name2_show').show();
		}else{
			$('.customer_name2_show').hide();
		}		
		$("#margin-heading").show();
	}else{
		$(".show_proposal_selection").hide();
		$('.customer_name2_show').hide();
		$("#margin-heading").show();
	}
});
</script>
<script>
$("#proposal_type").change(function(){
	var p_type = $(this).val();
	if(p_type=="1"){
		$(".show-solar-margin").show();
		$("#margin-heading").show();
		$("#discount-heading").hide();
		$(".charger_show").hide();
		$(".show-charger-margin").hide();
		$(".show_total_disc").hide();
		$("#self_use_solar").val(40);		
		$(".battery_show").hide();
		$(".show-battery-margin").hide();
		$(".show-max-rebate-solar-battery").hide();
	}
	else if(p_type=="2" || p_type=="9"){
		$(".show-solar-margin").show();
		$(".charger_show").show();
		$(".show-charger-margin").show();
		$(".show_total_disc").show();
		$("#self_use_solar").val(40);	
		$("#margin-heading").show();		
		$("#discount-heading").show();		
		$(".battery_show").hide();
		$(".show-battery-margin").hide();
		$(".show-max-rebate-solar-battery").hide();
	}
	else if(p_type=="3" || p_type=="8"){
		$(".show-solar-margin").show();
		$(".charger_show").show();
		$(".show-charger-margin").show();
		$(".battery_show").show();
		$(".show_total_disc").show();
		$(".show-battery-margin").show();
		$("#self_use_solar").val(60);	
		$("#margin-heading").show();
		$("#discount-heading").show();
		$(".show-max-rebate-solar-battery").hide();
	}
	else if(p_type=="4" || p_type=="10" || p_type=="11"){
		$(".show-solar-margin").show();
		$(".battery_show").show();
		$(".show-battery-margin").show();
		$(".show_total_disc").show();
		$("#self_use_solar").val(60);	
		$("#margin-heading").show();		
		$("#discount-heading").show();		
		$(".show-max-rebate-solar-battery").show();		
		$(".charger_show").hide();
		$(".show-charger-margin").hide();
	}
	else if(p_type=="5"){
		$(".charger_show").show();
		$(".show-charger-margin").show();
		$(".show_total_disc").show();
		$("#margin-heading").show();		
		$("#discount-heading").show();		
		$(".show-solar-margin").hide();
		$("#self_use_solar").val(40);		
		$(".battery_show").hide();
		$(".show-battery-margin").hide();
		$(".show-max-rebate-solar-battery").hide();	
	}
	else if(p_type=="6"){
		$(".battery_show").show();
		$(".show-battery-margin").show();
		$(".show_total_disc").show();
		$(".show_total_disc").show();
		$("#self_use_solar").val(60);
		$("#margin-heading").show();		
		$("#discount-heading").show();		
		$(".show-solar-margin").hide();
		$(".charger_show").hide();
		$(".show-charger-margin").hide();
		$(".show-max-rebate-solar-battery").hide();
	}
	else if(p_type=="7"){
		$(".charger_show").show();
		$(".show-charger-margin").show();
		$(".show_total_disc").show();
		$(".battery_show").show();
		$(".show-battery-margin").show();
		$("#self_use_solar").val(60);
		$("#margin-heading").show();		
		$("#discount-heading").show();		
		$(".show-solar-margin").hide();
		$(".show-max-rebate-solar-battery").hide();
	}	
	else{
		$(".show-solar-margin").hide();
		$(".charger_show").hide();
		$(".show-charger-margin").hide();
		$(".show_total_disc").hide();
		$("#self_use_solar").val(40);		
		$(".battery_show").hide();
		$(".show-battery-margin").hide();
		$("#margin-heading").hide();
		$("#discount-heading").hide();
		$(".show-max-rebate-solar-battery").hide();
	}
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
<?php if($lead_automatic==1){?>
<script>
$("#panel_count").blur(function(){
	var panel_count = $(this).val();
	var roof_type = $('#roofing_material').val();
	var proposal_type = $('#proposal_type').val();
	$.ajax({
		type:'post',
		url:"<?=SITE_PATH_ADM.CPAGE?>/calculate-mms-cost.php",
		data:"panel_count="+panel_count+"&roof_type="+roof_type,
		beforeSend:function(){
			$(".admin-ajax-loader").show();
		},
		success:function(response){
			$(".admin-ajax-loader").hide();
			//alert(response); 
			if(response){
				$('#proposal_mms_cost').val(response);
			}
		}
	});
});
</script>
<?php } ?>
<script>
$("#panel_count").blur(function(){
	var panel_count = $(this).val();
	var roof_type = $('#roofing_material').val();
	var proposal_type = $('#proposal_type').val();
	if(proposal_type){
		$.ajax({
			type:'post',
			url:"<?=SITE_PATH_ADM.CPAGE?>/installation-cost.php",
			data:"panel_count="+panel_count+"&proposal_type="+proposal_type,
			beforeSend:function(){
				$(".admin-ajax-loader").show();
			},
			success:function(response){
				$(".admin-ajax-loader").hide();
				//alert(response); 
				if(response){	
					$('.show_installation_days').html(response);	
				}
			}
		});
	}else{
		alert('Select proposal type');
	}
});
</script>

<script>
$("#proposal_type").change(function(){
	var proposal_type = $(this).val();
	var panel_count = $('#panel_count').val();
	if(proposal_type){
		$.ajax({
			type:'post',
			url:"<?=SITE_PATH_ADM.CPAGE?>/installation-cost.php",
			data:"panel_count="+panel_count+"&proposal_type="+proposal_type,
			success:function(response){
				//alert(response); 
				if(response){	
					$('.show_installation_days').html(response);	
				}
			}
		});
	}else{
		alert('Select proposal type');
	}
});
</script>
<script>
function updateData(){
	var panel_count = $('#panel_count').val();
	var proposal_type = $('#proposal_type').val();
	
	if(panel_count){
		$.ajax({
			type:'post',
			url:"<?=SITE_PATH_ADM.CPAGE?>/installation-cost.php",
			data:"panel_count="+panel_count+"&proposal_type="+proposal_type,
			beforeSend:function(){
				$(".admin-ajax-loader").show();
			},
			success:function(response){
				//alert(response); 
				$(".admin-ajax-loader").hide();
				if(response>0){	
					$('.show_installation_days').html(response);
				} 
				else if(response==-1){
					alert('Select proposal type');
				}
				else{
					
				}
			}
		});
		updateMmsCost();
	}else{
		alert('Enter number of panels');
	}
}
</script>
<script>
function updateMmsCost(){
	var panel_count = $('#panel_count').val();
	var roof_type = $('#roofing_material').val();
	
	if(panel_count){
		$.ajax({
			type:'post',
			url:"<?=SITE_PATH_ADM.CPAGE?>/calculate-mms-cost.php",
			data:"panel_count="+panel_count+"&roof_type="+roof_type,
			beforeSend:function(){
				$(".admin-ajax-loader").show();
			},
			success:function(response){
				//alert(response); 
				$(".admin-ajax-loader").hide();
				if(response>0){
					$('#proposal_mms_cost').val(response);
				}
				else if(response==-1){
					alert('Select toof type');
				}
				else{
					
				}
			}
		});
	}else{
		alert('Enter number of panels');
	}
}
</script>
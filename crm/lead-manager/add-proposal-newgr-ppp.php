<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php
$action_message ='';
$pid = $_GET['id']; 
$leadid = $_GET['leadid']; 
$roof_details_count = 0;
  
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

// $obj_sdis = json_decode($customerPriceArr['solar_discount']);
//$obj_bdis = json_decode($customerPriceArr['battery_types']);
//$obj_cdis = json_decode($customerPriceArr['ev_charger_types']);

// $obj_smrg = json_decode($customerPriceArr['solar_margin']);
$obj_smrg = json_decode($cms->getSingleResult("SELECT content FROM #_customer_price_manager where field_const='solar_margin' "));
// $obj_evmrg = json_decode($customerPriceArr['ev_margin']);
$obj_evmrg = json_decode($cms->getSingleResult("SELECT content FROM #_customer_price_manager where field_const='ev_margin' "));
//$obj_btmrg = json_decode($customerPriceArr['battery_margin']);
$obj_btmrg = json_decode($cms->getSingleResult("SELECT content FROM #_customer_price_manager where field_const='battery_margin' "));
//$obj_mintotalmrg = json_decode($customerPriceArr['minimum_total_margin']);
$obj_mintotalmrg = json_decode($cms->getSingleResult("SELECT content FROM #_customer_price_manager where field_const='minimum_total_margin' "));

// S:mk-19
//$obj_ac_protec = json_decode($customerPriceArr['ac_protect'],true);
$obj_ac_protec = json_decode($cms->getSingleResult("SELECT content FROM #_customer_price_manager where field_const='ac_protect' "),true);
//$obj_dc_protec = json_decode($customerPriceArr['dc_protect'],true);
$obj_dc_protec = json_decode($cms->getSingleResult("SELECT content FROM #_customer_price_manager where field_const='dc_protect'"),true);
$ac_status= $obj_ac_protec[0]['status'];
$dc_status= $obj_dc_protec[0]['status'];
// e:mk-19


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

$proposalCustomerType = $cms->getSingleResult("SELECT proposal_customer_type FROM #_leads where id=$leadid ");

$roofFetchDetailsQry = $cms->db_query("SELECT * FROM #_roof_details where lead_id='$leadid' AND status=0 AND is_deleted=0 ");
$numRowsRoof = $roofFetchDetailsQry->num_rows;
if($numRowsRoof>0){
$roof_details_count = $numRowsRoof;
}
// other-details-07
$otherDetailsQry = $cms->db_query("SELECT * FROM #_other_details where lead_id='$leadid' AND is_deleted=0 ");
$otherDetailsfetch = $otherDetailsQry->fetch_array(); 
@extract($otherDetailsfetch);


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
	.has-error .form-check-label {
		color: #fb9678;
		box-shadow: none !important;
	}
</style>
<div class="row">
    <div class="col-sm-12">
		<div class="white-box">
			<?php
				$t=$_REQUEST["t"];
				
				$lnk1="#";
				$lnk2="#";
				$lnk3="#";
				if($leadid>0){
					$lnk1="?mode=add-proposal-newgr-ppp&start=&t=prop_details&leadid=".$leadid."&id=".$pid;
					$lnk3="?mode=add-proposal-newgr-ppp&start=&t=other_details&leadid=".$leadid."&id=".$pid;
					$lnk2="?mode=add-proposal-newgr-ppp&start=&t=roof_details&leadid=".$leadid."&id=".$pid;
				}					
				
				if($t=='prop_details' || $t=='' ){
					$active="active";
					$active1="active";
				}
				elseif($t=='other_details'){
					$active="active";
					$active3="active";
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
						<a href="<?PHP echo $lnk1 ?>"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs">Proposal Details</span></a>
					</li>
					<li role="presentation" class="<?php echo $active3;?>"><a href="<?PHP echo $lnk3 ?>">
						<span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Other Details</span></a>
					</li>
					<li role="presentation" class="<?php echo $active2;?>"><a href="<?PHP echo $lnk2 ?>">
						<span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Roof Details</span></a>
					</li>
				</ul>

				<div class="tab-content" style="margin-top:0px;">
				<!--Tab 1-->
                <br>
                <!-- S:Project Info Form -->
				<div role="tabpannel" class="tab-pane <?php echo $active1;?>" id="proj_info">
				
					<div class="white-box panel-body">
						<div class="form-section-heading">	
							<h2>Proposal details</h2>
						</div>
					<input type="hidden" class="form-control" name="proposal_customer_type" value="<?=$proposalCustomerType?>">
					<input type="hidden" class="form-control" name="customer_name" value="<?=$cms->getSingleResult("SELECT customer_name FROM #_leads where id=$leadid ")?>">
					<input type="hidden" class="form-control" name="email" value="<?=$cms->getSingleResult("SELECT email FROM #_leads where id=$leadid ")?>">
					<input type="hidden" class="form-control" name="phone" value="<?=$cms->getSingleResult("SELECT phone FROM #_leads where id=$leadid ")?>">
					<input type="hidden" class="form-control" name="lead_unique_id" value="<?=$lead_unique_id?>">
					<input type="hidden" name="automatic" id="automatic" value="<?=$lead_automatic?>">
					<input type="hidden" class="form-control" name="proposal_address" value="<?=$cms->getSingleResult("SELECT proposal_address FROM #_leads where id=$leadid ")?>">
					<input type="hidden" class="form-control" name="city" value="<?=$cms->getSingleResult("SELECT city FROM #_leads where id=$leadid ")?>">
					<input type="hidden" class="form-control" name="pid" value="<?=$leadid?>">
					<input type="hidden" class="form-control" name="parent_id" value="<?=$pid?>">
					<div class="form-group col-md-4">
						<label class="control-label">Proposal Type</label>
						<select class="form-control" id="proposal_type" name="proposal_type" required>
							<option value="">Select Proposal Type</option>					
							<?php 
							//$proposalType = json_decode($customerPriceArr["proposal_type_name"], true);
							
							$proposalType = json_decode($customerPriceArr["proposal_type_name_2"], true);
							
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
					<input class="form-check-input" type="hidden" name="number_of_proposal" id="number_of_proposal1" value="1">
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
					$obj_evchargermaxmrg = json_decode($customerPriceArr['only_charger_max_rebate']);
					?>
					<!--<input type="hidden" name="max_solar_rebate" value="<?=$obj_max_solar[0]->status==1?$obj_max_solar[0]->maxmargin:0?>">
					<input type="hidden" name="max_solar_ev_rebate" value="50000">
					<input type="hidden" name="max_solar_battery_rebate" value="<?=$obj_max_solar_battery[0]->status==1?$obj_max_solar_battery[0]->maxmargin:0?>">
					<input type="hidden" name="max_solar_ev_battery_rebate" value="<?=$obj_max_solar_ev_battery[0]->sevstatus==1?$obj_max_solar_ev_battery[0]->sevmaxmargin:0?>">
					<input type="hidden" name="max_only_battery_rebate" value="<?=$obj_max_solar_ev_battery[0]->sbstatus==1?$obj_max_solar_ev_battery[0]->bmaxmargin:0?>">-->
					
					<input type="hidden" class="form-control" name="ev_charger_max_fixed_rebate" value="<?=$obj_evchargermaxmrg[0]->maxrebate?>">
					
					
					
					<?php if($proposalCustomerType==1){
					$lead_id = $leadid;
						$rsAdminGR = $cms->db_query("select * from #_leads where id='$lead_id' ");
						$arrAdminGR = $rsAdminGR->fetch_array(); 
						
						?>
					<div class="row">
					<div class="col-sm-2" align="left">
						<label class="control-label">Green Rebate</label>
					</div>
					</div>
					<div class="row">
						<div class="col-sm-2" style="margin-top:5px;">
						<div class="checkbox1">
							<!--<input id="owner_1" type="checkbox" name="owner_1" value="1">-->
							<label for="create_log1"> <?=$arrAdminGR['customer_name']?> </label>
						</div>
					</div>
					<div class="col-sm-4 form-group has-error1" style="margin-top:5px;">
						<input type="number" class="form-control" name="person1_max_rebate" value="<?=$person1_max_rebate?>" min="0" max="50000">
					</div>
					</div>
					<?php
					if($arrAdminGR['customer_name_ownwer2']!=''){?>
					<div class="row">
						<div class="col-sm-2" style="margin-top:5px;">
						<div class="checkbox1">
							<!--<input id="owner_2" type="checkbox" name="owner_2" value="2">-->
							<label for="create_log1"> <?=$arrAdminGR['customer_name_ownwer2']?> </label>
						</div>
					</div>
					<div class="col-sm-4 form-group has-error1" style="margin-top:5px;">
						<input type="number" class="form-control" name="person2_max_rebate" value="<?=$person2_max_rebate?>" min="0" max="50000">
					</div>
					</div>
					<?php 
						}
					} ?>
					
					<div class="clearfix"></div>			
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
							<input class="form-control" id="quotation_valid_till" type="text" name="quotation_valid_till" autocomplete="off" value="<?=date('Y-m-d',strtotime(date("Y-m-d", strtotime(date('Y-m-d'))) . " +7 day"))?>">
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
					<?php //$panel_types=getNewPrice('panel_types','1');
							//echo "<pre>";print_r($val);die; ?>
					<div class="form-group col-md-3">
						<label class="control-label">Panel Type</label>
						<select class="form-control select2" id="panel_model" name="panel_model" id="panel_model">
							<option value="">Select Panel Type</option>
							<?php  
							$panel_types1=getNewPrice('panel_types','1');
							while($panel_types=$cms->db_fetch_array($panel_types1)){ 
							$panelTyeArray = json_decode($panel_types["content"], true);
							usort($panelTyeArray, function ($a, $b) {
								return $a['name'] <=> $b['name'];
							});
							foreach ($panelTyeArray as $key => $value) {
								if($value["pstatus"]==1){
									if($panel_model==$value["name"] || $panel_model==$panel_types["id"] && $leadid!='' && $pid!=''){
										$psel = 'selected';
									}else{
										$psel = '';
									}
									echo '<option value="'.$panel_types["id"].'" '.$psel.'>'.$value["name"].' - '.$value["wattage"].' Wp</option>';
							} 	} }
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
						<input type="text" class="form-control" name="roofing_material" placeholder="Roofing material" value="<?=$cms->getSingleResult("SELECT roofing_material FROM #_leads where id=$leadid ")?>" id="roofing_material" readonly>
					</div>
					<div class="clearfix"></div>			
					<div class="form-group col-md-3">
						<div class="form-group">
							<label class="control-label">Inverter Type 1</label>
							<select class="form-control select2" id="inverter_type" name="inverter_type">
								<option value="">Select Inverter Type</option>
								<?php 
								$inverterRes=getNewPrice('inverter_types','1');
								while($inverter_types =$cms->db_fetch_array($inverterRes)){
								$inverterTyeArray = json_decode($inverter_types["content"], true);
								usort($inverterTyeArray, function ($a, $b) {
									return $a['name'] <=> $b['name'];
								});
								foreach ($inverterTyeArray as $ikey => $ivalue) {
									if($ivalue["invstatus"]){
									if($inverter_type==$ivalue["name"] || $inverter_type==$inverter_types["id"] && ($leadid!='' && $pid!='')){
										$invsel = 'selected';
									}else{
										$invsel = '';
									}
								  if($ivalue["dongle"]==1){
									  $dongle='(dongle included)';	
									  }else{ $dongle=' '; }
									echo '<option value="'.$inverter_types["id"].'" '.$invsel.'>'.$ivalue["name"].'</option>';
								} } }
								?>
							</select>
						</div>
						<?php if($inverter_type){
							$inverter_type1_style = "";
						}else{
							$inverter_type1_style = "display:none";
						}?>
						<div class="form-group" id="inverter_type1_qty" style="<?=$inverter_type1_style?>">
							<label for="inverter_type1_qty" class="control-label">Inverter Type 1 Quantity</label>
							<input type="number" class="form-control" name="inverter_type1_qty" min="1" value="<?=$inverter_type1_qty?>">
						</div>
					</div>
					
					<div class="form-group col-md-3">
						<div class="form-group">
							<label class="control-label">Inverter Type 2</label>
							<select class="form-control select2" id="inverter_type2" name="inverter_type2">
								<option value="">Select Inverter Type</option>
								<?php
								$inverterRes=getNewPrice('inverter_types','1');
								while($inverter_types =$cms->db_fetch_array($inverterRes)){
								$inverterTyeArray = json_decode($inverter_types["content"], true);
								usort($inverterTyeArray, function ($a, $b) {
									return $a['name'] <=> $b['name'];
								});
								foreach ($inverterTyeArray as $ikey => $ivalue) {
									if($ivalue["invstatus"]){
									if($inverter_type2==$ivalue["name"] || $inverter_type2==$inverter_types["id"] && ($leadid!='' && $pid!='')){
										$invsel = 'selected';
									}else{ $invsel = ''; }
									if($ivalue["dongle"]==1){
										$dongle='(dongle included)';	
									  }else{ $dongle=''; }
									echo '<option value="'.$inverter_types["id"].'" '.$invsel.'>'.$ivalue["name"].'</option>';
								} } }
								?>
							</select>
						</div>
						<?php if($inverter_type2){
							$inverter_type2_style = "";
						}else{
							$inverter_type2_style = "display:none";
						}?>
						<div class="form-group" id="inverter_type2_qty" style="<?=$inverter_type2_style?>">
							<label for="inverter_type2_qty" class="control-label">Inverter Type 2 Quantity</label>
							<input type="number" class="form-control" name="inverter_type2_qty" min="1" value="<?=$inverter_type2_qty?>">
						</div>
					</div>
					
					<div class="form-group col-md-3">
						<div class="form-group">
							<label class="control-label">Inverter Type 3</label>
							<select class="form-control select2" id="inverter_type3" name="inverter_type3">
								<option value="">Select Inverter Type</option>
								<?php
								$inverterRes=getNewPrice('inverter_types','1');
								while($inverter_types =$cms->db_fetch_array($inverterRes)){ 
								$inverterTyeArray = json_decode($inverter_types["content"], true);
								usort($inverterTyeArray, function ($a, $b) {
									return $a['name'] <=> $b['name'];
								});
								foreach ($inverterTyeArray as $ikey => $ivalue) {
									if($ivalue["invstatus"]){
									if($inverter_type3==$ivalue["name"] || $inverter_type3==$inverter_types["id"] && ($leadid!='' && $pid!='')){
										$invsel = 'selected';
									}else{
										$invsel = '';
									}
								  if($ivalue["dongle"]==1){
								  $dongle='(dongle included)'; }else { $dongle='';}
									echo '<option value="'.$inverter_types["id"].'" '.$invsel.'>'.$ivalue["name"].'</option>';
								} } }
								?>
							</select>
						</div>
						<?php if($inverter_type3){
							$inverter_type3_style = "";
						}else{
							$inverter_type3_style = "display:none";
						}?>
						<div class="form-group" id="inverter_type3_qty" style="<?=$inverter_type3_style?>">
							<label for="inverter_type3_qty" class="control-label">Inverter Type 3 Quantity</label>
							<input type="number" class="form-control" name="inverter_type3_qty" min="1" value="<?=$inverter_type3_qty?>">
						</div>
					</div>
					
					<div class="form-group col-md-3">
						<label class="control-label">Installation Days &nbsp; <a href="javascript:void(0)" data-toggle="modal" data-target="#installation_chart"> <i class="fa fa-info" aria-hidden="true"></i> </a></label>
						<div class="show_installation_days">
						<?php if($_SESSION["ses_adm_role"]!=1){ ?>
							<input type="text" name="installation_days" class="form-control" value="<?=($leadid!='' && $pid!='')?$installation_days:''?>" readonly>
						<?php }else{ ?>
							<select class="form-control" id="installation_days" name="installation_days" required>
								<option value="">Select Installation Days</option>
								<?php
								$installation_chargesRes=getNewPrice('installation_charges','0'); 
								while($installation_chargesAry =$cms->db_fetch_array($installation_chargesRes)){
								$installationArray = json_decode($installation_chargesAry["content"], true);
								
								foreach ($installationArray as $ikey => $invalue) {
									$installationJsonArray[$ikey] = floatval(str_replace(',', '.', $invalue['day']));
								}
								asort($installationJsonArray);
								foreach ($installationJsonArray as $daykey => $dayVal) {
									if($installation_days==$dayVal || $installation_days== $installation_chargesAry["id"] && ($leadid!='' && $pid!='')){
										$inssel = 'selected';
									}else{
										$inssel = '';
									}
									echo '<option value="'.$installation_chargesAry["id"].'" '.$inssel.'>'.$dayVal.'</option>';
								} }
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
						<div class="form-group">
							<label class="control-label">Battery</label>
							<select class="form-control" id="battery_name" name="battery_name" required>
								<option value="">Select Battery</option>
								<?php
								$battery_typesRes=getNewPrice('battery_types','1'); 
								while($battery_typesAry = $cms->db_fetch_array($battery_typesRes)){
								$batteryTyeArray = json_decode($battery_typesAry["content"], true);
								usort($batteryTyeArray, function ($a, $b) {
									return $a['name'] <=> $b['name'];
								});
								foreach ($batteryTyeArray as $bkey => $bvalue) {
									if($bvalue["bstatus"]==1){
									if($battery_name==$bvalue["name"] || $battery_name==$battery_typesAry['id'] && ($leadid!='' && $pid!='')){
										$bsel = 'selected';
									}else{
										$bsel = '';
									}
									echo '<option value="'.$battery_typesAry['id'].'" '.$bsel.'>'.$bvalue["name"].'</option>';
								} } }
								?>
							</select>
						</div>
						<?php if($battery_name){
							$battery_name_style = "";
						}else{
							$battery_name_style = "display:none";
						}?>
						<div class="form-group" id="battery_qty" style="<?=$battery_name_style?>">
							<label for="battery_qty" class="control-label">Battery Quantity</label>
							<input type="number" class="form-control" name="battery_qty" min="1" value="<?=$battery_qty?>">
						</div>
					</div>
					
					<?php if($proposal_type==2 || $proposal_type==3 || $proposal_type==5 || $proposal_type==7 || $proposal_type==8 || $proposal_type==9){
						$stylec = '';
					}else{	
						$stylec = 'display:none';
					}
					?>
								
					<div class="form-group col-md-3 charger_show" style="<?=$stylec?>">
						<div class="form-group">
							<label class="control-label">EV Charger Type</label>
							<select class="form-control" id="charger_name" name="charger_name" required>
								<option value="">Select EV Charger</option>
								<?php
								$chargerTyeRes=getNewPrice('ev_charger_types','1'); 
								while($chargerTyeAry = $cms->db_fetch_array($chargerTyeRes)){
								$chargerTyeArray = json_decode($chargerTyeAry["content"], true);
								usort($chargerTyeArray, function ($a, $b) {
									return $a['name'] <=> $b['name'];
								});
								foreach ($chargerTyeArray as $ckey => $cvalue) {
									if($cvalue["evstatus"]==1){
									if($charger_name==$cvalue["name"] || $charger_name==$chargerTyeAry["id"] && ($leadid!='' && $pid!='')){
										$csel = 'selected';
									}else{
										$csel = '';
									}
									echo '<option value="'.$chargerTyeAry["id"].'" '.$csel.'>'.$cvalue["name"].'</option>';
								} } }
								?>
							</select>
						</div>
						<?php if($charger_name){
							$charger_name_style = "";
						}else{
							$charger_name_style = "display:none";
						}?>
						<div class="form-group" id="charger_qty" style="<?=$charger_name_style?>">
							<label for="charger_qty" class="control-label">Charger Quantity</label>
							<?php 
								if($_SESSION["ses_adm_role"]!=1){$maxch=1;}else{$maxch=1000;} ?>
							<input type="number" class="form-control" name="charger_qty" min="1" max ="<?=$maxch?>" value="<?=$charger_qty?>">
						</div>
					</div>
					
					<!--<div class="form-group col-md-3 charger_show" style="margin-top:30px; <?=$stylec?>">
						<label class="control-label" for="load_balancer">Load Balancer</label>
						<input type="checkbox" id="load_balancer" name="load_balancer" value="1" <?=($leadid!='' && $pid!='')?($load_balancer==1?'checked':''):''?>>
					</div>-->
					<div class="clearfix"></div>
					<?php  if($proposal_type==2 || $proposal_type==3 || $proposal_type==4 || $proposal_type==5 || $proposal_type==6 ||$proposal_type==7 || $proposal_type==8 || $proposal_type==9 || $proposal_type==10 || $proposal_type==11){			
						$styletd = '';?>
					<?php }else{	
						$styletd = 'display:none';
					}
					?>
					<!--<div class="form-group col-md-3 show_total_disc" style="<?=$styletd?>">
						<label class="control-label">Discount (kr)</label>
						<input type="text" class="form-control" name="total_discount" id="total_discount" value="<?=($leadid!='' && $pid!='')?$total_discount:''?>">
					</div>-->
					<input type="hidden" class="form-control" name="total_discount" id="total_discount" value="0">
					
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
							<input type="file" name="installation_image" id="drop_area<?=$id?>" class="dropify dropify-area-img installation_image" data-max-file-size="1M" data-height="150" <?php if($installation_image AND file_exists(CRM_FILES_PATH.UP_FILES_PROPOSAL.'/'.$installation_image) && ($leadid!='' && $pid!='')){ ?> data-default-file="<?=SITE_PATH.UPLOAD_FILES_PTH?>/<?=UP_FILES_PROPOSAL?>/<?=$installation_image?>" <?php } ?> />
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
					<div class="form-section-heading">	
						<h2>Extras</h2>
					</div>			
					
					<div class="form-group col-md-4" id="show_sensor">
						<div class="form-group">
							<label class="control-label">Smart Sensor</label>
							<select class="form-control" id="sensor_type_name" name="sensor_type_name">
								<option value="">Select Smart Sensor</option>
								<?php
								 $sensor_typeRes=getNewPrice('sensor_type','1'); 
								 while($sensor_typeAry = $cms->db_fetch_array($sensor_typeRes)){
								$sensorTypeArray = json_decode($sensor_typeAry["content"], true);
								usort($sensorTypeArray, function ($a, $b) {
									return $a['sensor_name'] <=> $b['sensor_name'];
								});
								foreach ($sensorTypeArray as $snkey => $snvalue) {
									if($snvalue["sensor_status"]==1){
									if($sensor_type_name==$snvalue["sensor_name"] ||$sensor_type_name = $sensor_typeAry["id"] && ($leadid!='' && $pid!='')){
										$snsel = 'selected';
									}else{
										$snsel = '';
									}
									echo '<option value="'.$sensor_typeAry["id"].'" '.$snsel.'>'.$snvalue["sensor_name"].'</option>';
								} } }
								?>
							</select>
						</div>
						<?php if($sensor_type_name){
							$sensor_style = "";
						}else{
							$sensor_style = "display:none";
						}?>
						<div class="form-group" id="sensor_qty" style="<?=$sensor_style?>">
							<label for="sensor_qty" class="control-label">Smart Sensor Quantity</label>
							<input type="number" class="form-control" name="sensor_qty" min="1" value="<?=$sensor_qty?>">
						</div>
					</div>
					<div class="form-group col-md-4">
						<div class="form-group">
							<label class="control-label">Backup Box</label>
							<select class="form-control" id="odrift_type_name" name="odrift_type_name">
								<option value="">Select Backup Box</option>
								<?php
								$odrift_typeRes = getNewPrice('odrift_type','1'); 
								while($odrift_typeAry = $cms->db_fetch_array($odrift_typeRes)){ 
								$odriftTypeArray = json_decode($odrift_typeAry["content"], true);
								usort($odriftTypeArray, function ($a, $b) {
									return $a['odrift_name'] <=> $b['odrift_name'];
								});
								foreach ($odriftTypeArray as $odkey => $odvalue) {
									if($odvalue["odrift_status"]==1){
									if($odrift_type_name==$odvalue["odrift_name"] || $odrift_type_name== $odrift_typeAry["id"] && ($leadid!='' && $pid!='')){
										$snsel = 'selected';
									}else{
										$snsel = '';
									}
									echo '<option value="'.$odrift_typeAry["id"].'" '.$snsel.'>'.$odvalue["odrift_name"].'</option>';
								} } }
								?>
							</select>
						</div>
						<?php if($odrift_type_name){
							$odrift_style = "";
						}else{
							$odrift_style = "display:none";
						}?>
						<div class="form-group" id="odrift_qty" style="<?=$odrift_style?>">
							<label for="odrift_qty" class="control-label">Backup Box Quantity</label>
							<input type="number" class="form-control" name="odrift_qty" min="1" value="<?=$odrift_qty?>">
						</div>
					</div>
					
					<div class="form-group col-md-4">
						<div class="form-group">
							<label class="control-label">Optimizer</label>
							<select class="form-control" id="optimizer_type_name" name="optimizer_type_name">
								<option value="">Select Optimizer</option>
								<?php 
								$optimizer_typeRes = getNewPrice('optimizer_type','1'); 
								while($optimizer_typeAry = $cms->db_fetch_array($optimizer_typeRes)){ 
								$optimizerTypeArray = json_decode($optimizer_typeAry["content"], true);
								usort($optimizerTypeArray, function ($a, $b) {
									return $a['optimizer_name'] <=> $b['optimizer_name'];
								});
								foreach ($optimizerTypeArray as $odkey => $odvalue) {
									if($odvalue["optimizer_status"]==1){
									if($optimizer_type_name==$odvalue["optimizer_name"] || $optimizer_type_name==$optimizer_typeAry["id"] && ($leadid!='' && $pid!='')){
										$snsel = 'selected';
									}else{
										$snsel = '';
									}
									echo '<option value="'.$optimizer_typeAry["id"].'" '.$snsel.'>'.$odvalue["optimizer_name"].'</option>';
								} } }
								?>
							</select>
						</div>
						<?php if($optimizer_type_name){
							$optimizer_style = "";
						}else{
							$optimizer_style = "display:none";
						}?>
						<div class="form-group" id="optimizer_qty" style="<?=$optimizer_style?>">
							<label for="optimizer_qty" class="control-label">Optimizer Quantity</label>
							<input type="number" class="form-control" name="optimizer_qty" min="1" value="<?=$optimizer_qty?>">
						</div>
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
						$smin = $obj_smrg[0]->min;
						$smax= $obj_smrg[0]->max;
						//$smargin = $obj_smrg[0]->margin;
						$sinfo = '';
					}else{
						$smin = 0;
						//$smax= 0;
						$sinfo = 'display:none';
					}?>
					<div class="form-group col-md-3 show-solar-margin" style="<?=$stylesm?>">
						<label class="control-label" style="color:red;">Solar panel margin (%) <span style="<?=$sinfo?>"><i class="fa fa-info-circle" title="Minimum <?=$obj_smrg[0]->min?>%" style="color:red;"></i><br>(Min : <?=$obj_smrg[0]->min?>% and Max : <?=$obj_smrg[0]->max?>%)</span></label>

						<input type="number" class="form-control" name="solar_margin" value="<?=($leadid!='' && $pid!='')?($solar_margin?$solar_margin:$smin):$smin?>" <?=$_SESSION["ses_adm_role"]==1?'':''?> min="<?=($_SESSION["ses_adm_role"]==1)?-50:$smin?>" max="<?php if(($_SESSION["ses_adm_role"]!=1)){ echo $smax; } ?>">
					</div>
					<?php if($proposal_type==2 || $proposal_type==3 || $proposal_type==5 || $proposal_type==7 || $proposal_type==8 || $proposal_type==9){
						$stylem = '';
					}else{	
						$stylem = 'display:none';
					}
					?>
					<?php if($obj_evmrg[0]->status==1){
						$cmin = $obj_evmrg[0]->min;
						$cmax = $obj_evmrg[0]->max;
						$evinfo = '';
					}else{
						$cmin = 0;
						$cmax = 0;
						$evinfo = 'display:none';
					}?>
					<div class="form-group col-md-3 show-charger-margin" style="<?=$stylem?>">
					<label class="control-label" style="color:red;">Charger margin (%) <span style="<?=$evinfo?>"><i class="fa fa-info-circle" title="Minimum <?=$obj_evmrg[0]->min?>%" style="color:red;"></i><br>(Min : <?=$obj_evmrg[0]->min?>% and Max : <?=$obj_evmrg[0]->max?>%)</span></label>
						
						<input type="number" class="form-control" name="charger_margin" value="<?=($leadid!='' && $pid!='')?($charger_margin?$charger_margin:$cmin):$cmin?>" <?=$_SESSION["ses_adm_role"]==1?'':''?> min="<?=($_SESSION['ses_adm_role']==1)?0:$cmin?>" max="<?if(($_SESSION['ses_adm_role']!=1)){ echo $cmax;}?>">
					</div>
					<?php  if($proposal_type==3 || $proposal_type==4 || $proposal_type==6 || $proposal_type==7 || $proposal_type==8 || $proposal_type==10 || $proposal_type==11){
						$stylebm = '';
					}else{	
						$stylebm = 'display:none';
					}
					?>
					<?php if($obj_btmrg[0]->status==1){
						$bmin = $obj_btmrg[0]->min;
						$bmax = $obj_btmrg[0]->max;
						$binfo = '';
					}else{
						//$bmargin = 0;
						$bmin = 0;
						$bmax = 0;
						$binfo = 'display:none';
					}?>
					<div class="form-group col-md-3 show-battery-margin" style="<?=$stylebm?>">
						<label class="control-label" style="color:red;">Battery margin (%) <span style="<?=$binfo?>"><i class="fa fa-info-circle" title="Minimum <?=$obj_btmrg[0]->min?>%" style="color:red;"></i><br>(Min: <?=$obj_btmrg[0]->min?>% and Max: <?=$obj_btmrg[0]->max?>% )</span></label>
						
						<input type="number" class="form-control" name="battery_margin" value="<?=($leadid!='' && $pid!='')?($battery_margin?$battery_margin:$bmin):$bmax?>" <?=$_SESSION["ses_adm_role"]==1?'':''?> min="<?=($_SESSION['ses_adm_role']==1)?0:$bmin?>" max="<?if(($_SESSION['ses_adm_role']!=1)){ echo $bmax; }?>">
					</div>		
					<?php //if($obj_btmrg[0]->status==1){
						//$bmargin = $obj_btmrg[0]->margin;
						//$binfo = '';
					//}else{
					//	$bmargin = 0;
					//	$binfo = 'display:none';
					//}
					?>
					
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
					<!--<div class="clearfix"></div>
					
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
					</div>-->
					
					<div class="clearfix"></div>
					<?php
							if($_SESSION["ses_adm_role"]==1){ ?>
						<div>
						<div class="form-section-heading">	
								<h2>Proposal Terms & Conditions</h2>
							</div>
							<div class="form-group col-md-6">
								<label class="control-label">Title 1</label>
								<input type="text" class="form-control" name="tnc_title1" value="<?=($leadid!='' && $pid!='')?($tnc_title1?$tnc_title1:$tnc_title1):$tnc_title1?>">
								
								<label class="control-label">Content 1</label>
								<textarea class="form-control" name="tnc_content1" rows="5"><?=($leadid!='' && $pid!='')?($tnc_content1?$tnc_content1:$tnc_content1):$tnc_content1?></textarea>
							</div>
							<div class="form-group col-md-6">
								<label class="control-label">Title 2</label>
								<input type="text" class="form-control" name="tnc_title2" value="<?=($leadid!='' && $pid!='')?($tnc_title2?$tnc_title2:$tnc_title2):$tnc_title2?>">
								
								<label class="control-label">Content 2</label>
								<textarea class="form-control" name="tnc_content2" rows="5"><?=($leadid!='' && $pid!='')?($tnc_content2?$tnc_content2:$tnc_content2):$tnc_content2?></textarea>
							</div>
						</div>	
						<?php } ?>
						<div class="form-group col-sm-12">
							<div class="form-group text-danger error-while-generating"></div>
							<!--<button type="button" class="btn add-submit-btn" name="save-only" id="save_only">Save</button>-->
							<?php if($status!=4 || ($leadid!='' && $pid=='')){?>
							<button type="submit" name="save-generate" id="save-generate" class="btn btn-primary">Save</button>
							<?php } ?>
							<a href="javascript:void()" onClick="backToPage()" class=""><button type="button" class="btn back-btn">Back</button></a>
						</div>
					</div>
		
				</div>
				<!-- E:Project Info Form -->

				<!-- S:Other Details Form 07 -->
				<div role="tabpanel" class="tab-pane <?php echo $active3;?>" id="other_details">
					<div class="row">
						<!-- s:mk-19 -->
						<?php  if($proposal_type==1 || $proposal_type==8 || $proposal_type==9 || $proposal_type==11){ if($ac_status==1){?>
						<div class="form-check col-md-6">
							<input class="form-check-input" type="checkbox" value="1" name="surge_protc_ac" id="flexCheckDefault" <?php if($surge_protc_ac == 1){echo "checked";} ?>>
							<label class="form-check-label" for="flexCheckDefault">
								Överspänningsskydd AC
							</label>
						</div>
						<?php } if($dc_status==1){?>
						<div class="form-check col-md-6">
							<input class="form-check-input" type="checkbox" value="1" name="surge_protc_dc" id="flexCheckChecked" <?php if($surge_protc_dc == 1){echo "checked";}?>>
							<label class="form-check-label" for="flexCheckChecked">
								Överspänningsskydd DC
							</label>
						</div>
						<?php } }?>
						<div class="clearfix"></div>
						<br>
						<?php if($proposal_type==1 || $proposal_type==8 || $proposal_type==9 || $proposal_type==11){ ?>
						<div class="form-check col-md-6">
							<label class="form-check-label" for="flexCheckChecked">
								Cable length between Växelriktare and Fasadmätarskåp / Elcentral
							</label><br>
							<div class="input-group">
								<input type="number" class="form-control" placeholder="Cable Length (can't be less than 10m)" name="cable_len_inv" min="10" aria-describedby="basic-addon2" value="<?=$cable_len_inv?>">
								<span class="input-group-addon" id="basic-addon2">(in meter)</span>
							</div>
						</div>
						<?php } if($proposal_type==5 || $proposal_type==8 || $proposal_type==9 ) { ?>
						<div class="clearfix"></div>
						<br>
						<div class="form-check col-md-6">
							<label class="form-check-label" for="flexCheckChecked">
								Cable length between EV charger and Fasadmätarskåp / El central
							</label><br>
							<div class="input-group">
								<input type="number" class="form-control" placeholder="Cable Length (can't be less than 10m)" name="cable_len_ev" aria-describedby="basic-addon2" value="<?=$cable_len_ev?>">
								<span class="input-group-addon" id="basic-addon2">(in meter)</span>
							</div>
						</div>
						<?php } ?>
						<!-- e:mk-19 -->
						<input type="hidden" value="<?=$otherDetailsfetch['id']?>" name="other_id">
						<input type="hidden" name="new-gr-ppp" id="new-gr-ppp" value="1">

						<div class="clearfix"></div>
						<br>
						<?php if($proposal_type==1 || $proposal_type==5 || $proposal_type==8 || $proposal_type==9 || $proposal_type==11 ) {?>
						<div class="form-group col-sm-12">
                            <button type="submit" class="btn add-submit-btn" id="other_details" name="other_details" value="1">Save</button>
                        </div>
						<?php } else { ?>
							<h3>No Other Details Required</h3>
							<?php } ?>
					</div>
					<br>
					
                    <div class="clearfix"></div>
                </div>
                <!-- E:Other Details Form 07-->
				
				<!-- S:Roof Details Form -->
                <div role="tabpanel" class="tab-pane <?php echo $active2;?>" id="roof_details">
                    <div class="list_wrapper list_wrapper5">
                    <?php if($numRowsRoof>0) {
                        $i=0;
                        while($roofFetchDetailsArr = $roofFetchDetailsQry->fetch_array())
                        { @extract($roofFetchDetailsArr); 
                    ?>
                    <!-- S:Edit-->
                        <div class="row" id="btrow<?=$i?>">
                            <div class="form-group col-md-12">
                                <h3>Roof Details:&nbsp;<?= $i+1;?></h3>
                            </div>
                            <div class="form-group col-md-1">
                                <label for="total-pannel" class="control-label">Total Panel</label>
                                <input type="text" class="form-control" name="total_panel[<?=$i?>]" id="total_panel[<?=$i?>]" value="<?=$total_panel?>">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="roofing_material" class="control-label">Roof Type</label>
                                <select class="form-control" id="roofing_material[<?=$i?>]" name="roofing_material[<?=$i?>]" <?= $readonly_field ?>>
                                    <option value="">Select Roof type</option>
                                    <?php 
									$roofTypeQry = getNewPrice('roof_type','1');
									while($roofTypeAry = $roofTypeQry->fetch_array() ){
									$roofTypePriceArr = json_decode($roofTypeAry["content"], true);
                                    foreach ($roofTypePriceArr as $rkey => $rvalue) {
                                    if ($rvalue["rfstatus"] == 1) {
                                        if ($roofing_material == $rvalue["name"] || $roofTypeAry['id'] == $roofing_material ) {
                                            $rsel = 'selected';
                                            } else {
                                            $rsel = '';
                                        }
                                            echo '<option value="' . $roofTypeAry["id"] . '" ' . $rsel . '>' . $rvalue["name"] . '</option>';
                                        }
                                    } }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="roof-support" class="control-label">Roof Support</label><br>
                                <select class="form-control" id="roof_support[<?=$i?>]" name="roof_support[<?=$i?>]">
                                    <option value="">Select Roof Support</option>
                                        <option value="1" <?php if($roof_support == 1){ echo 'Selected';}?>>Råspont</option>
                                        <option value="2" <?php if($roof_support == 2){ echo 'Selected';}?>>No Råspont</option>
                                </select>
                            </div>
                            <div class="form-group col-md-1">
                                <label for="roof_angle" class="control-label">Roof Angle</label>
                                <input type="text" class="form-control" name="roof_angle[<?=$i?>]" id="roof_angle<?=$i?>" value="<?= $roof_angle ?>" <?= $readonly_field ?>>
                            </div>
							<div class="form-group col-md-2">
                                <label for="roof_length" class="control-label">Roof Height<span style="font-size:9px;">[in m]</span></label>
                                <input type="text" class="form-control" name="roof_height[<?=$i?>]" id="roof_height<?=$i?>" value="<?= $roof_height ?>" <?= $readonly_field ?>>
                            </div>
							<div class="form-group col-md-1">
                                <label for="roof_length" class="control-label">Length<span style="font-size:9px;">[in m]</span></label>
                                <input type="text" class="form-control" name="roof_length[<?=$i?>]" id="roof_length<?=$i?>" value="<?= $roof_length ?>" <?= $readonly_field ?>>
                            </div>
							<div class="form-group col-md-1">
                                <label for="roof_breath" class="control-label">Width<span style="font-size:9px;">[in m]</span></label>
                                <input type="text" class="form-control" name="roof_breath[<?=$i?>]" id="roof_breath<?=$i?>" value="<?= $roof_breath ?>" <?= $readonly_field ?>>
                            </div>
                            <input type="hidden" name="rec_id[<?=$i?>]" value="<?= $id ?>">
                            
                            <div class="col-xs-1 col-sm-7 col-md-1">
                                <label for="remove" class="control-label">Action</label>
                                <a href="javascript:void(0);" class="list_remove_button btn btn-danger " onClick="remove_roof_details('<?= $id ?>')">-</a>
                            </div>
                        </div>
                        <input type="hidden" name="edit" value="1">
						<input type="hidden" name="save" value="1">
						
                        <hr>        
                        <!-- E:Edit -->
                        <?php $i++; } } else{ ?>

                        <!-- S:create new -->
                        <div class="row" id="btrow<?=$i?>">
                            <div class="form-group col-md-1">
                                <label for="total-pannel" class="control-label">Total Panel</label>
                                <input type="number" class="form-control" name="total_panel[<?=$i?>]" id="total_panel[<?=$i?>]">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="roofing_material" class="control-label">Roof Type</label>
                                <select class="form-control" id="roofing_material[<?=$i?>]" name="roofing_material[<?=$i?>]" <?= $readonly_field ?>>
                                    <option value="">Select Roof type</option>
                                    <?php 
									$roofTypeQry = getNewPrice('roof_type','1');
									while($roofTypeAry = $roofTypeQry->fetch_array() ){
									$roofTypePriceArr = json_decode($roofTypeAry["content"], true);
                                    foreach ($roofTypePriceArr as $rkey => $rvalue) {
                                    if ($rvalue["rfstatus"] == 1) {
                                        if ($roofing_material == $rvalue["name"] || $roofTypeAry["id"] == $roofing_material) {
                                            $rsel = 'selected';
                                            } else {
                                            $rsel = '';
                                        }
                                            echo '<option value="' . $roofTypeAry["id"] . '" ' . $rsel . '>' . $rvalue["name"] . '</option>';
                                        }
                                    } }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="roof-support" class="control-label">Roof Support</label><br>
                                <select class="form-control" id="roof_support[<?=$i?>]" name="roof_support[<?=$i?>]">
                                    <option value="">Select Roof Support</option>
                                        <option value="1">Råspont</option>
                                        <option value="2">No Råspont</option>
                                </select>
                            </div>
                            <div class="form-group col-md-1">
                                <label for="roof_angle" class="control-label">Roof Angle</label>
                                <input type="number" min="1" class="form-control" name="roof_angle[<?=$i?>]" id="roof_angle<?=$i?>" <?= $readonly_field ?>>
							</div>
							<div class="form-group col-md-2">
                                <label for="roof_length" class="control-label">Roof Height<span style="font-size:9px;">[in m]</span></label>
                                <input type="text" class="form-control" name="roof_height[<?=$i?>]" id="roof_height<?=$i?>" value="<?= $roof_height ?>" <?= $readonly_field ?>>
                            </div>
							<div class="form-group col-md-1">
                                <label for="roof_length" class="control-label">Length<span style="font-size:9px;">[in m]</span></label>
                                <input type="text" class="form-control" name="roof_length[<?=$i?>]" id="roof_length<?=$i?>" <?= $readonly_field ?>>
                            </div>
							<div class="form-group col-md-1">
                                <label for="roof_breath" class="control-label">Width<span style="font-size:9px;">[in m]</span></label>
                                <input type="text" class="form-control" name="roof_breath[<?=$i?>]" id="roof_breath<?=$i?>" <?= $readonly_field ?>>
                            </div>
                        </div>
                         <input type="hidden" name="save" value="1">           
                        <!-- E:create new -->
                        <?php } ?>
                    </div>
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <h3>Add New <button class="btn btn-primary list_add_button5" type="button">+</button></h3>
                        </div>
                        <input type="hidden" name="total_rec" id="total_rec" value="<?=$roof_details_count?>">
                        <input type="hidden" name="new-gr-ppp" id="new-gr-ppp" value="1">

                        <div class="form-group col-sm-12">
                            <button type="submit" class="btn add-submit-btn" name="save" value="1">Save</button>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <!-- E:Roof Details Form -->

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


<?php if($_GET['t']=='prop_details'){ ?>
<script>
$("#aforms").on("submit",function(e){
	if($("#save-generate").hasClass("disabled")==false){
		var formData = new FormData(this);
		$.ajax({
			url:"<?=SITE_PATH_ADM.CPAGE?>/generate-newgr-ppp.php",
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
<?php } if($_GET['t']=='other_details'){ ?>
<!-- other-details-07 -->
<script>
$("#aforms").on("submit",function(e){
	if($("#save-generate").hasClass("disabled")==false){
		var formData = new FormData(this);
		$.ajax({
			url:"<?=SITE_PATH_ADM.CPAGE?>/other-details.php",
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
<?php } if($_GET['t']=='roof_details'){ ?>
	<script>
$("#aforms").on("submit",function(e){
	if($("#save-generate").hasClass("disabled")==false){
		var formData = new FormData(this);
		$.ajax({
			url:"<?=SITE_PATH_ADM.CPAGE?>/generate-roof-details.php",
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
<?php } ?>

<script>
$("#inverter_type").change(function(){
	var inverter_type = $(this).val();
	if(inverter_type!=''){
		$("#inverter_type1_qty").show();
		$("#inverter_type1_qty input").attr("required", true);
	}else{
		$("#inverter_type1_qty").hide();
		$("#inverter_type1_qty input").attr("required", false);
	}
});
</script>

<script>
$("#inverter_type2").change(function(){
	var inverter_type2 = $(this).val();
	if(inverter_type2!=''){
		$("#inverter_type2_qty").show();
		$("#inverter_type2_qty input").attr("required", true);
	}else{
		$("#inverter_type2_qty").hide();
		$("#inverter_type2_qty input").attr("required", false);
	}
});
</script>

<script>
$("#inverter_type3").change(function(){
	var inverter_type3 = $(this).val();
	if(inverter_type3!=''){
		$("#inverter_type3_qty").show();
		$("#inverter_type3_qty input").attr("required", true);
	}else{
		$("#inverter_type3_qty").hide();
		$("#inverter_type3_qty input").attr("required", false);
	}
});
</script>

<script>
$("#battery_name").change(function(){
	var battery_name = $(this).val();
	if(battery_name!=''){
		$("#battery_qty").show();
		$("#battery_qty input").attr("required", true);
	}else{
		$("#battery_qty").hide();
		$("#battery_qty input").attr("required", false);
	}
});
</script>

<script>
$("#charger_name").change(function(){
	var charger_name = $(this).val();
	if(charger_name!=''){
		$("#charger_qty").show();
		$("#charger_qty input").attr("required", true);
	}else{
		$("#charger_qty").hide();
		$("#charger_qty input").attr("required", false);
	}
});
</script>

<script>
$("#sensor_type_name").change(function(){
	var sensor_type_name = $(this).val();
	//alert(sensor_type_name);
	if(sensor_type_name!=''){
		$("#sensor_qty").show();
		$("#sensor_qty input").attr("required", true);
	}else{
		$("#sensor_qty").hide();
		$("#sensor_qty input").attr("required", false);
	}
});
</script>
<script>
$("#odrift_type_name").change(function(){
	var odrift_type_name = $(this).val();
	//alert(sensor_type_name);
	if(odrift_type_name!=''){
		$("#odrift_qty").show();
		$("#odrift_qty input").attr("required", true);
	}else{
		$("#odrift_qty").hide();
		$("#odrift_qty input").attr("required", false);
	}
});
</script>
<script>
$("#optimizer_type_name").change(function(){
	var optimizer_type_name = $(this).val();
	//alert(sensor_type_name);
	if(optimizer_type_name!=''){
		$("#optimizer_qty").show();
		$("#optimizer_qty input").attr("required", true);
	}else{
		$("#optimizer_qty").hide();
		$("#optimizer_qty input").attr("required", false);
	}
});
</script>

<script>
$("#panel_model").change(function(){
	var panel_model = $(this).val();
	//alert(panel_model);
	if(panel_model){
		$.ajax({
			url:"<?=SITE_PATH_ADM.CPAGE?>/panel-color-ppp.php",
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
			url:"<?=SITE_PATH_ADM.CPAGE?>/panel-color-ppp.php",
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
		//$("#show_sensor").show();
		$(".show-battery-margin").hide();
		$(".show-max-sev").hide();
		$(".show-max-sb").hide();
		$(".show-max-sevb").hide();
		$(".show-person-selection").hide();
		$(".show-max-onlysolar").show();
		$(".show-table-header").hide();
		$(".show_solar_max_rebate").hide();
		$(".show_charger_max_rebate").hide();
		$(".show_battery_max_rebate").hide();
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
		//$("#show_sensor").show();
		$(".show-battery-margin").hide();
		$(".show-max-sev").show();
		$(".show-max-sb").hide();
		$(".show-max-sevb").hide();
		$(".show-person-selection").show();
		$(".show-max-onlysolar").hide();
		$("#persontype").attr('colspan', 2);
		$(".show-table-header").show();
		$(".show_solar_max_rebate").show();
		$(".show_charger_max_rebate").show();
		$(".show_battery_max_rebate").hide();
	}
	else if(p_type=="3" || p_type=="8"){
		$(".show-solar-margin").show();
		$(".charger_show").show();
		$(".show-charger-margin").show();
		$(".battery_show").show();
		//$("#show_sensor").hide();
		$("#sensor_type_name").prop('required',true);
		$(".show_total_disc").show();
		$(".show-battery-margin").show();
		$("#self_use_solar").val(60);	
		$("#margin-heading").show();
		$("#discount-heading").show();
		$(".show-max-sev").hide();
		$(".show-max-sb").hide();
		$(".show-max-sevb").show();
		$(".show-person-selection").show();
		$(".show-max-onlysolar").hide();
		$("#persontype").attr('colspan', 3);
		$(".show-table-header").show();
		$(".show_solar_max_rebate").show();
		$(".show_charger_max_rebate").show();
		$(".show_battery_max_rebate").show();
	}
	else if(p_type=="4" || p_type=="10" || p_type=="11"){
		$(".show-solar-margin").show();
		$(".battery_show").show();
		//$("#show_sensor").hide();
		$("#sensor_type_name").prop('required',true);
		$(".show-battery-margin").show();
		$(".show_total_disc").show();
		$("#self_use_solar").val(60);	
		$("#margin-heading").show();		
		$("#discount-heading").show();	
		$(".charger_show").hide();
		$(".show-charger-margin").hide();
		$(".show-max-sev").hide();
		$(".show-max-sb").show();
		$(".show-max-sevb").hide();
		$(".show-person-selection").show();
		$(".show-max-onlysolar").hide();
		$("#persontype").attr('colspan', 2);
		$(".show-table-header").show();
		$(".show_solar_max_rebate").show();
		$(".show_charger_max_rebate").hide();
		$(".show_battery_max_rebate").show();
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
		//$("#show_sensor").show();
		$(".show-battery-margin").hide();
		$(".show-max-sev").hide();
		$(".show-max-sb").hide();
		$(".show-max-sevb").hide();
		$(".show-person-selection").hide();
		$(".show-max-onlysolar").hide();
		$(".show-table-header").hide();
		$(".show_solar_max_rebate").hide();
		$(".show_charger_max_rebate").hide();
		$(".show_battery_max_rebate").hide();
	}
	else if(p_type=="6"){
		$(".battery_show").show();
		//$("#show_sensor").hide();		
		$("#sensor_type_name").prop('required',true);
		$(".show-battery-margin").show();
		$(".show_total_disc").show();
		$(".show_total_disc").show();
		$("#self_use_solar").val(60);
		$("#margin-heading").show();		
		$("#discount-heading").show();		
		$(".show-solar-margin").hide();
		$(".charger_show").hide();
		$(".show-charger-margin").hide();
		$(".show-max-sev").hide();
		$(".show-max-sb").hide();
		$(".show-max-sevb").hide();
		$(".show-person-selection").hide();
		$(".show-max-onlysolar").hide();
		$(".show-table-header").hide();
		$(".show_solar_max_rebate").hide();
		$(".show_charger_max_rebate").hide();
		$(".show_battery_max_rebate").hide();
	}
	else if(p_type=="7"){
		$(".charger_show").show();
		$(".show-charger-margin").show();
		$(".show_total_disc").show();
		$(".battery_show").show();
		//$("#show_sensor").hide();
		$("#sensor_type_name").prop('required',true);
		$(".show-battery-margin").show();
		$("#self_use_solar").val(60);
		$("#margin-heading").show();		
		$("#discount-heading").show();		
		$(".show-solar-margin").hide();
		$(".show-max-sev").hide();
		$(".show-max-sb").hide();
		$(".show-max-sevb").hide();
		$(".show-person-selection").hide();
		$(".show-max-onlysolar").hide();
		$(".show-table-header").hide();
		$(".show_solar_max_rebate").hide();
		$(".show_charger_max_rebate").hide();
		$(".show_battery_max_rebate").hide();
	}	
	else{
		$(".show-solar-margin").hide();
		$(".charger_show").hide();
		$(".show-charger-margin").hide();
		$(".show_total_disc").hide();
		$("#self_use_solar").val(40);		
		$(".battery_show").hide();
		//$("#show_sensor").show();
		$(".show-battery-margin").hide();
		$("#margin-heading").hide();
		$("#discount-heading").hide();
		$(".show-max-sev").hide();
		$(".show-max-sb").hide();
		$(".show-max-sevb").hide();
		$(".show-person-selection").hide();
		$(".show-max-onlysolar").hide();
		$(".show-table-header").hide();
		$(".show_solar_max_rebate").hide();
		$(".show_charger_max_rebate").hide();
		$(".show_battery_max_rebate").hide();
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
<script type="text/javascript">
    $(document).ready(function()
    {

        var list_maxField = 50; //Input fields increment limitation
    var x5 = "<?=$roof_details_count?>"; //Initial field counter
    if(<?=$roof_details_count?> !== 0)
    { x5 = x5-1; }
    //else{ x5= x5+1; }
    			 
	$('.list_add_button5').click(function()
	    {
            // alert(x5);
	    //Check maximum number of input fields
	    if(x5 < list_maxField){ 
	        x5++; //Increment field counter
	        var list_fieldHTML = '<div class="row"><div class="form-group col-md-1 "><label for="total-panel" class="control-label">Total Pannel</label><input type="number" class="form-control" name="total_panel['+x5+']" id="total_panel['+x5+']"></div><div class="form-group col-md-3 col-sm-4 col-xs-6"><label for="roofing_material" class="control-label">Roof Type</label><select class="form-control roof" id="roofing_material'+x5+'" name="roofing_material['+x5+']"  <?=$readonly_field ?>  ><option value="">Select Roof type</option><?php $roofTypeQry = getNewPrice('roof_type','1'); while($roofTypeAry = $roofTypeQry->fetch_array() ){ $roofTypePriceArr = json_decode($roofTypeAry["content"], true); foreach ($roofTypePriceArr as $rkey=> $rvalue){if ($rvalue["rfstatus"]==1){ if ($roofing_material==$rvalue["name"] || $roofing_material==$roofTypeAry['id']){$rsel='';}else{$rsel='';}echo '<option value="' . $roofTypeAry["id"] . '" ' . $rsel . '>' . $rvalue["name"] . '</option>';}}}?></select></div><div class="form-group col-md-2 col-sm-4 col-xs-6"><label for="roof-support" class="control-label">Roof Support</label><br><select class="form-control" id="roof_support['+x5+']" name="roof_support['+x5+']"><option value="">Select Roof Support</option><option value="1">Råspont</option><option value="2">No Råspont</option></select></div><div class="form-group col-md-1 col-sm-4 col-xs-6"><label for="roof_angle" class="control-label">Roof Angle</label><input type="text" class="form-control" name="roof_angle['+x5+']" id="roof_angle['+x5+']" ></div><div class="form-group col-md-2"><label for="roof_length" class="control-label">Roof Height</label><input type="text" class="form-control" name="roof_height['+x5+']" id="roof_height['+x5+']"  <?= $readonly_field ?>></div><div class="form-group col-md-1 col-sm-4 col-xs-6"><label for="roof_length" class="control-label">Length</label><input type="text" class="form-control" name="roof_length['+x5+']" id="roof_length['+x5+']" <?= $readonly_field ?>></div><div class="form-group col-md-1 col-sm-4 col-xs-6"><label for="roof_breath" class="control-label">Width</label><input type="text" class="form-control" name="roof_breath['+x5+']" id="roof_breath['+x5+']"  <?= $readonly_field ?>></div><div class="col-xs-1 col-sm-7 col-md-1"><label for="remove" class="control-label">Action</label><br><a href="javascript:void(0);" class="list_remove_button btn btn-danger">-</a></div></div>';
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
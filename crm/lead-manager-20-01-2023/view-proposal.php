<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php
$action_message ='';
$pid = $_GET['id']; 

if($cms->is_post_back()){ 
	//print_r($_POST);die;
	if($pid){ 
		if($_FILES["installation_image"]["name"]){ 
			$_POST["installation_image"] = uploadImage("installation_image","proposal");
		};
		$cms->db_query("UPDATE #_leads SET installation_image='".$_POST["installation_image"]."' WHERE id=$pid");
		
		$cms->redir(SITE_PATH_ADM.CPAGE.'?mode=proposal-list&start=&id='.$leadid, true);
		exit;
	}
}

$rsAdmin = $cms->db_query("select * from #_leads where id='".$pid."'");
$arrAdmin = $rsAdmin->fetch_array(); 
@extract($arrAdmin);
		
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
				<h2>Proposal details <?=$lead_unique_id?'('.$lead_unique_id.')':''?> </h2>
			</div>
			<input type="hidden" class="form-control" name="proposal_customer_type" value="<?=$proposal_customer_type?>">
			<input type="hidden" class="form-control" name="customer_name" value="<?=$customer_name?>">
			<input type="hidden" class="form-control" name="email" value="<?=$email?>">
			<input type="hidden" class="form-control" name="phone" value="<?=$phone?>">
			<input type="hidden" class="form-control" name="lead_unique_id" value="<?=$lead_unique_id?>">
			<input type="hidden" name="automatic" id="automatic" value="<?=$automatic?>">
			<input type="hidden" class="form-control" name="proposal_address" value="<?=$proposal_address?$proposal_address:$address_input?>">
			<input type="hidden" class="form-control" name="pid" value="<?=$leadid?>">
			<input type="hidden" class="form-control" name="parent_id" value="<?=$pid?>">
			<div class="col-md-4">
				<label class="control-label">Proposal Type</label>
				<select class="form-control" id="proposal_type" name="proposal_type" disabled>
					<option value="">Select Proposal Type</option>					
					<?php $proposalType = json_decode($customerPriceArr["proposal_type_name"], true);
					foreach ($proposalType as $pkey=>$pval){
						if($pval["status"]==1){
							if($proposal_type==$pval["pnum"]){
								$psel = 'selected';
							}else{
								$psel = '';
							}
							echo '<option value="'.$pval["pnum"].'" '.$psel.'>'.$pval["name"].'</option>';
					} 	}
					?>
				</select>
			</div>
			<?php if($proposal_type==3 || $proposal_type==4 || $proposal_type==8 || $proposal_type==10){
				$propCount = 'display:block;';
			}else{
				$propCount = 'display:none;';
			}?>
			<div class="col-md-3 show_proposal_selection" style="<?=$propCount?>">
				<label class="control-label">Generate number of proposal</label>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="number_of_proposal" id="number_of_proposal1" value="1" <?=$number_of_proposal==1?'checked':''?> disabled>
					<label class="form-check-label" for="number_of_proposal1">1 Proposal</label>
					&nbsp;&nbsp;&nbsp;
					<input class="form-check-input" type="radio" name="number_of_proposal" id="number_of_proposal2" value="2" <?=$number_of_proposal==2?'checked':''?> disabled>
					<label class="form-check-label" for="number_of_proposal2">2 Proposal</label>
				</div>
			</div>
			<div class="form-group col-md-2">
				<label class="control-label">Prefix Proposal Name</label>
				<input type="text" class="form-control" name="proposal_name" value="<?=$proposal_name?>" pattern="[a-zA-Z0-9 ]+" id="proposal_name" disabled>
			</div>
			<div class="clearfix"></div>
			<div class="form-group col-sm-3">
				<label class="control-label">Offer Type</label>
				<select class="form-control" name="offer_type" id="offer_type" disabled>
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
			<?php if($number_of_proposal==2 && ($proposal_type==3 || $proposal_type==4 || $proposal_type==8 || $proposal_type==10)){
					$name2Style = 'display:block';
			}else{
				$name2Style = 'display:none';
			}
			?>
			<div class="col-md-6 customer_name2_show" style="<?=$name2Style?>">
				<label class="control-label">Name 2</label>
				<input type="text" class="form-control" name="customer_name2" placeholder="Full name" pattern="([^\s][A-Za-z\W+]+)" value="<?=$customer_name2?>" disabled>
			</div>
			<div class="clearfix"></div>	
			
			<div class="form-section-heading">	
				<h2>Sales channel details</h2>
			</div>
			<?php if($assigned_to>1){
			$agentQry = $cms->db_query("SELECT id, customer_name, email_id, contact_no FROM #_users where id=$assigned_to AND id!=1 ");
			$agentRes = $agentQry->fetch_array();
			} ?>
			<div class="form-group col-md-4">
				<label class="control-label">Reference</label>
				<input type="text" class="form-control" name="reference" placeholder="Our reference" pattern="([^\s][A-Za-z\W+]+)" value="<?=$reference?$reference:$agentRes['customer_name']?>" disabled>
			</div>
			<div class="form-group col-md-4">
				<label class="control-label">Reference Email</label>
				<input type="email" class="form-control" name="ref_email" placeholder="Reference Email" value="<?=$ref_email?$ref_email:$agentRes['email_id']?>" disabled>
			</div>
			<div class="form-group col-md-4">
				<label class="control-label">Reference Phone</label>
				<input type="text" class="form-control" name="ref_phone" placeholder="Reference Phone" value="<?=$ref_phone?$ref_phone:$agentRes['contact_no']?>" disabled>
			</div>
			<div class="clearfix"></div>
			<input type="hidden" class="form-control" name="quotation_number" value="<?=$quotation_number?>">
			
			<div class="col-md-4">	
				<label class="control-label">Quotation date(Y-m-d)</label>
				<div class="input-group">
					<input class="form-control" id="quotation_date" type="text" name="quotation_date" autocomplete="off" value="<?=$quotation_date?$quotation_date:date('Y-m-d')?>" disabled>
					<span class="input-group-addon"><i class="icon-calender"></i></span> 
				</div>
			</div>
			<div class="col-md-4">
				<label class="control-label">Quotation valid till (Y-m-d)</label>
				<div class="input-group">
					<input class="form-control" id="quotation_valid_till" type="text" name="quotation_valid_till" autocomplete="off" value="<?=$quotation_valid_till?$quotation_valid_till:date('Y-m-d',strtotime(date("Y-m-d", strtotime(date('Y-m-d'))) . " +15 day"))?>" disabled>
					<span class="input-group-addon"><i class="icon-calender"></i></span> 
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="form-section-heading">	
				<h2>Technical information</h2>
			</div>
			<div class="form-group col-md-3">
				<label class="control-label">Panel Type</label>
				<select class="form-control" id="panel_model" name="panel_model" id="panel_model" disabled>
					<option value="">Select Panel Type</option>
					<?php $panelTyeArray = json_decode($customerPriceArr["panel_types"], true);
					usort($panelTyeArray, function ($a, $b) {
						return $a['name'] <=> $b['name'];
					});
					foreach ($panelTyeArray as $key => $value) {
						if($value["pstatus"]==1){
							if($panel_model==$value["name"]){
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
				<label class="control-label">Number Of Panels <?php if($automatic==1){ ?><span style="<?=$binfo?>"><i class="fa fa-info-circle" title="Click refresh to apply changes" style="color:red;"></i></span><?php } ?></label>
				<input type="text" class="form-control" name="panel_count" value="<?=$panel_count?>" id="panel_count" disabled>
			</div>
			<?php if($automatic==1){ ?><div class="form-group col-md-1" style="margin-top:30px;">
				<a href="javascript:void(0)" onClick="updateData()"><i class="fa fa-refresh text-success"></i></a>
			</div>
			<?php } ?>
			<div class="form-group col-md-3">
				<label class="control-label">Color</label>
				<input type="text" class="form-control" name="color" id="color" value="<?=$color?>" disabled>
			</div>
			<div class="form-group col-md-3">
				<label class="control-label">Roof Type</label>
				<input type="text" class="form-control" name="roofing_material" placeholder="Roofing material" value="<?=$roofing_material?>" id="roofing_material" disabled>
			</div>
			<div class="clearfix"></div>
			<div class="form-group col-md-3">
				<label class="control-label">Inverter Type 1</label>
				<select class="form-control" id="inverter_type" name="inverter_type" disabled>
					<option value="">Select Inverter Type</option>
					<?php $inverterTyeArray = json_decode($customerPriceArr["inverter_types"], true);
					usort($inverterTyeArray, function ($a, $b) {
						return $a['name'] <=> $b['name'];
					});
					foreach ($inverterTyeArray as $ikey => $ivalue) {
						if($ivalue["invstatus"]){
						if($inverter_type==$ivalue["name"]){
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
				<select class="form-control" id="inverter_type2" name="inverter_type2" disabled>
					<option value="">Select Inverter Type</option>
					<?php $inverterTyeArray = json_decode($customerPriceArr["inverter_types"], true);
					usort($inverterTyeArray, function ($a, $b) {
						return $a['name'] <=> $b['name'];
					});
					foreach ($inverterTyeArray as $ikey => $ivalue) {
						if($ivalue["invstatus"]){
						if($inverter_type2==$ivalue["name"]){
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
				<select class="form-control" id="inverter_type3" name="inverter_type3" disabled>
					<option value="">Select Inverter Type</option>
					<?php $inverterTyeArray = json_decode($customerPriceArr["inverter_types"], true);
					usort($inverterTyeArray, function ($a, $b) {
						return $a['name'] <=> $b['name'];
					});
					foreach ($inverterTyeArray as $ikey => $ivalue) {
						if($ivalue["invstatus"]){
						if($inverter_type3==$ivalue["name"]){
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
				<?php if($_SESSION["ses_adm_role"]==1){?>
					<select class="form-control" id="installation_days" name="installation_days" disabled>
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
				<?php }else{ ?>
					<input type="text" name="installation_days" class="form-control" value="<?=$installation_days?>" disabled>
				<?php } ?>
				</div>
			</div>
			<div class="clearfix"></div>
			
			<div class="form-group col-md-4">
				<label class="control-label">Roof dimensions (AA x BB m,CC x DD m)</label>
				<input type="text" class="form-control" name="panel_area_dimension" value="<?=$panel_area_dimension?>" disabled>
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
				<select class="form-control" id="battery_name" name="battery_name" disabled>
					<option value="">Select Battery</option>
					<?php $batteryTyeArray = json_decode($customerPriceArr["battery_types"], true);
					usort($batteryTyeArray, function ($a, $b) {
						return $a['name'] <=> $b['name'];
					});
					foreach ($batteryTyeArray as $bkey => $bvalue) {
						if($bvalue["bstatus"]==1){
						if($battery_name==$bvalue["name"]){
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
				<select class="form-control" id="charger_name" name="charger_name" disabled>
					<option value="">Select EV Charger</option>
					<?php $chargerTyeArray = json_decode($customerPriceArr["ev_charger_types"], true);
					usort($chargerTyeArray, function ($a, $b) {
						return $a['name'] <=> $b['name'];
					});
					foreach ($chargerTyeArray as $ckey => $cvalue) {
						if($cvalue["evstatus"]==1){
						if($charger_name==$cvalue["name"]){
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
				<input type="checkbox" id="load_balancer" name="load_balancer" value="1" <?=$load_balancer==1?'checked':''?> disabled>
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
				<input type="text" class="form-control" name="total_discount" id="total_discount" value="<?=$total_discount?>" disabled>
			</div>
			<div class="clearfix"></div>
			<div class="form-section-heading">	
				<h2>Estimated production and conditions</h2>
			</div>
			<div class="form-group col-md-6">
				<label class="control-label">Annual electricity consumption in property (kWh)</label>
				<input type="text" class="form-control" name="annual_electricity_consumption" value="<?=$annual_electricity_consumption?>" placeholder="Annual electricity consumption in property" disabled>
			</div>
			<div class="form-group col-md-6">
				<label class="control-label">Estimated annual production solar (kWh)</label>
				<input type="text" class="form-control" name="annual_production" value="<?=$annual_production?>" placeholder="Estimated annual production solar" disabled>
			</div>
			<div class="clearfix"></div>
			<div class="form-group col-md-6">
				<label class="control-label">Self-use of solar (%)</label>
				<input type="text" class="form-control" name="self_use_solar" id="self_use_solar" value="<?=$self_use_solar?>" placeholder="Self-use of solar" disabled>
			</div>
			<div class="form-group col-md-6">
				<label class="control-label">Angle of panels</label>
				<input type="text" class="form-control" name="roof_angle" value="<?=$roof_angle?>" placeholder="Angle of panels" disabled>
			</div>
			<div class="clearfix"></div>
			<div class="form-section-heading">	
				<h2>Dimensioning</h2>
			</div>
			<div class="form-group col-md-12">
				<label class="label-control">The system is connected to the property's electrical exchange and installed according to the picture below.<br>(570px X 330px and should be less than 1 MB) (only png,jpg,jpeg)</label>
			</div>
			<?php if($_SESSION["ses_adm_id"]==1 || in_array(11,$act_arr)){?>
			<div class="form-group col-md-6">
				<div>
					<input type="file" name="installation_image" id="drop_area<?=$id?>" class="dropify dropify-area-img" data-max-file-size="1M" data-height="150" <?php if($installation_image AND file_exists(FILES_PATH.'proposal/'.$installation_image) && ($leadid!='' && $pid!='')){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/proposal/<?=$installation_image?>" <?php } ?> />
				</div>
				<input type="hidden" name="installation_image" value="<?=$installation_image?>">
			</div>
			<?php }else{?>				
			<div class="form-group col-md-4">
				<div>
					<img src="<?=SITE_PATH?>uploaded_files/proposal/<?=$installation_image?>" class="img-responsive">
				</div>
				<input type="hidden" name="installation_image" value="<?=$installation_image?>">
			</div>
			<?php } ?>
			<div class="clearfix"></div>
			
			<div class="form-section-heading">	
				<h2>MMS</h2>
			</div>			
			<div class="form-group col-md-3">
				<label class="control-label">MMS Cost (kr)</label>
				<input type="text" class="form-control" name="proposal_mms_cost" value="<?=$proposal_mms_cost?>" id="proposal_mms_cost" <?=$autofill?> disabled>
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
				<h2>Margin <span style="color:red; font-size:14px; <?=$margininfo?>">(Minimum total margin <?=$obj_mintotalmrg[0]->margin?>% )</span></h2>
				<input type="hidden" name="minimum_total_margin" value="<?=$totminmargin?>">
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

				<input type="text" class="form-control" name="solar_margin" value="<?=$solar_margin?$solar_margin:$smargin?>" <?=$autofill?> disabled>
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
				
				<input type="text" class="form-control" name="charger_margin" value="<?=$charger_margin?$charger_margin:$cmargin?>" <?=$autofill?> disabled>
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
				
				<input type="text" class="form-control" name="battery_margin" value="<?=$battery_margin?$battery_margin:$bmargin?>" disabled>
			</div>		
			<div class="clearfix"></div>
			
			<div class="form-group col-md-3">
				<label class="control-label">Current status &nbsp; <a href="javascript:void(0)" data-toggle="modal" data-target="#status_chart"> <i class="fa fa-info" aria-hidden="true"></i> </a></label>
				<input type="hidden" name="old_status" value="<?=$status?>">
				<select class="form-control" id="status" name="status" disabled>
					<option value="">Select Status</option>
					<?php $leadsStatusArr = getAllStatus();
					foreach($leadsStatusArr as $status_key=>$status_val){?>
					<option value="<?=$status_key?>" <?=($status==$status_key)?'selected':''?>><?=$status_val?></option>
					<?php } ?>
				</select>
			</div>
			<div class="clearfix"></div>				
			<div class="col-sm-12">
				<input type="hidden" name="max_solar_rebate" value="<?=$obj_max_solar[0]->status==1?$obj_max_solar[0]->maxmargin:0?>">
				<input type="hidden" name="max_solar_ev_rebate" value="<?=$obj_max_solar_ev[0]->status==1?$obj_max_solar_ev[0]->maxmargin:0?>">
				<input type="hidden" name="max_solar_battery_rebate" value="<?=$obj_max_solar_battery[0]->status==1?$obj_max_solar_battery[0]->maxmargin:0?>">
				<input type="hidden" name="max_solar_ev_battery_rebate" value="<?=$obj_max_solar_ev_battery[0]->sevstatus==1?$obj_max_solar_ev_battery[0]->sevmaxmargin:0?>">
				<input type="hidden" name="max_only_battery_rebate" value="<?=$obj_max_solar_ev_battery[0]->sbstatus==1?$obj_max_solar_ev_battery[0]->bmaxmargin:0?>">
			</div>
			<div class="clearfix"></div>
			<div class="form-group col-sm-12">
				<button type="submit" class="btn add-submit-btn">Save</button>
				<!--<button type="button" onClick="generatePDF()" name="save-generate" class="btn btn-primary">Save & Generate</button>-->
				<a href="javascript:void()" onClick="history.back();" class=""><button type="button" class="btn back-btn">Back</button></a>
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
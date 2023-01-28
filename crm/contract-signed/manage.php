<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 
	if($action=='del'){
		$cms->db_query("update #_customer_registration set is_deleted='1' where id in ($id)");
		$adm->sessset('Record has been deleted', 'e');
		$cms->redir(SITE_PATH_ADM.CPAGE, true);
		exit;
	}
	
	if(isset($_POST['assign_project_btn'])){
		if($arr_ids){
			if($_POST['project_manager']!=''){			
				$str_adm_ids = implode(",",$arr_ids);
				$cms->db_query("update #_leads set project_manager=".$_POST['project_manager'].", project_assigned_date='".date("Y-m-d")."', lead_type=3 where id in ($str_adm_ids)");
			
				//new status added on tracker
				$str_adm_idsArr = explode(',',$str_adm_ids);
				foreach($str_adm_idsArr as $lid){
					$lead_customer = $cms->getSingleResult("SELECT customer_name FROM #_leads WHERE id=".$lid." ");
					$assignedToProjectMgr = $cms->getSingleResult("SELECT customer_name FROM #_users WHERE id=".$_POST['project_manager']." ");
					$action_message = 'Proposal <b>LEAD-'.$lid.'-'.$lead_customer.'</b> assigned to <b>'.$assignedToProjectMgr.' (project manager)</b>';
					$ActionPOSTS["lead_id"] = $lid;
					$ActionPOSTS["action_message"] = $action_message;
					$ActionPOSTS["action_date"] = date('Y-m-d h:i:s');
					$ActionPOSTS["action_by"] = $_SESSION["ses_adm_id"];
					$ActionPOSTS["activity_for"] = $_POST['project_manager'];
					$cms->sqlquery("rs","lead_tracker",$ActionPOSTS);
				}
			}
			else{
				echo '<script>alert("Select project manager to assign")</script>';
			}				
			$path = $_SESSION['REFERER_page'];
			$cms->redir($path, true);
		}else{
			echo '<script>alert("Select one or more proposal from the list")</script>';
		}
	}
	
	if($cms->is_post_back()){
		if($arr_ids) {
			$str_adm_ids = implode(",",$arr_ids);
			//print_r($_POST);die;
			switch ($_POST['action']){
				case "delete":
					$cms->db_query("update #_customer_registration set is_deleted='1' where id in ($str_adm_ids)");
					$adm->sessset(count($arr_ids).' Item(s) Delete', 'e');
					break;
				case "Inactive":
					$cms->db_query("update #_customer_registration set status = '0' where pid in ($str_adm_ids)");
					$adm->sessset(count($arr_ids).' Item(s) Inactive', 'e');
					break;
				case "Active":
					$cms->db_query("update #_customer_registration set status = '1' where pid in ($str_adm_ids)");
					$adm->sessset(count($arr_ids).' Item(s) Active', 's');
					break;
				default:
			}
		}
		$cms->redir(SITE_PATH_ADM.CPAGE, true);
		exit;
	}
	
	$projectExists = $cms->getSingleResult("Select GROUP_CONCAT(cust_id) FROM #_customer_project");
	if(isset($_REQUEST['submt'])){
		$conditionsQr = "";
		if(!empty($_REQUEST['name_search'])){
			$name_search = $cms->escape_string($_REQUEST['name_search']);
			$conditionsQr .= " AND customer_name like '%$name_search%'";
		}
		if(!empty($_REQUEST['city_search'])){
			$city_search = $cms->escape_string($_REQUEST['city_search']);
			$conditionsQr .= " AND (city like '%$city_search%' || proposal_address like '%$city_search%')";
		}
		if(!empty($_REQUEST['search_battery'])){
			$search_battery = $cms->escape_string($_REQUEST['search_battery']);
			$conditionsQr .= " AND battery_name='$search_battery'";
		}
		if(!empty($_REQUEST['search_charger'])){
			$search_charger = $cms->escape_string($_REQUEST['search_charger']);
			$conditionsQr .= " AND charger_name='$search_charger'";
		}
		if(!empty($_REQUEST['search_panel'])){
			$search_panel = $cms->escape_string($_REQUEST['search_panel']);
			$conditionsQr .= " AND panel_model='$search_panel'";
		}
		if(!empty($_REQUEST['search_roof'])){
			$search_roof = $cms->escape_string($_REQUEST['search_roof']);
			$conditionsQr .= " AND roofing_material='$search_roof'";
		}
		if(!empty($_REQUEST['search_inverter'])){
			$search_inverter = $cms->escape_string($_REQUEST['search_inverter']);
			$conditionsQr .= " AND (inverter_type='$search_inverter' || inverter_type2='$search_inverter' || inverter_type3='$search_inverter')";
		}
		if(!empty($_REQUEST['search_agent'])){
			$search_agent = $cms->escape_string($_REQUEST['search_agent']);
			$conditionsQr .= " AND assigned_to=$search_agent";
		}
		if(!empty($_REQUEST['search_manager'])){
			$search_manager = $cms->escape_string($_REQUEST['search_manager']);
			$conditionsQr .= " AND project_manager_id=$search_manager";
		}
		if(!empty($_REQUEST['start_date']) AND !empty($_REQUEST['end_date'])){
			$start_date = $cms->escape_string($_REQUEST['start_date']);
			$end_date = $cms->escape_string($_REQUEST['end_date']);
			$postDateFrom = date("Y-m-d", strtotime($start_date));
			$postDateTo = date("Y-m-d", strtotime($end_date));
			$conditionsQr .= " AND post_date>='$postDateFrom' AND post_date<='$postDateTo' ";
		}else{
			if(!empty($_REQUEST['start_date'])){
				$start_date = $cms->escape_string($_REQUEST['start_date']);
				$postDate = date("Y-m-d", strtotime($start_date));
				$conditionsQr .= " AND  post_date>='$postDate'";
			} 
			if(!empty($_REQUEST['end_date'])){
				$end_date = $cms->escape_string($_REQUEST['end_date']);
				$postDate = date("Y-m-d", strtotime($end_date));
				$conditionsQr .= "AND post_date<='$postDate'";
			} 
		}
		 
		$start = intval($start);
		$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;		
		$columns = "select * ";
		$sql = " from #_leads where 1=1 AND lead_id>0 AND is_deleted=0 AND status=4 $conditionsQr ";		
		$order_by == '' ? $order_by = 'post_date' : true;
		$order_by2 == '' ? $order_by2 = 'asc' : true;
		$sql_count = "select count(*) ".$sql; 
		$sql .= "order by $order_by $order_by2 ";
		$sql .= "limit $start, $pagesize ";
		$sql = $columns.$sql;
		$result = $cms->db_query($sql);
		$reccnt = $cms->db_scalar($sql_count);
	}else{
		$start = intval($start);
		$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
		$columns = "select * ";
		$sql = " from #_leads where 1=1 AND lead_id>0 AND is_deleted=0 AND status=4 AND id NOT in($projectExists) ";
		$order_by == '' ? $order_by = 'post_date' : true;
		$order_by2 == '' ? $order_by2 = 'asc' : true;
		$sql_count = "select count(*) ".$sql; 
		$sql .= "order by $order_by $order_by2 ";
		$sql .= "limit $start, $pagesize ";
		$sql = $columns.$sql;
		$result = $cms->db_query($sql);
		$reccnt = $cms->db_scalar($sql_count);
	}
	//echo $sql;die;
	
	$customerPriceQry = $cms->db_query("SELECT battery_types, ev_charger_types, panel_types, roof_type_price, inverter_types FROM #_customer_price where id=1 ");
	$customerPriceArr = $customerPriceQry->fetch_array(); 

?>
<div class="row">
	<div class="col-sm-12">
		<div class="white-box">
			<div class="Search FORM">
				<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
					<div class="panel">
						<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
							<a class="panel-title <?=$expanded=='true'?'':'collapsed'?>" data-toggle="collapse" href="#exampleCollapseDefaultThree1" data-parent="#exampleAccordionDefault" aria-expanded="<?=$expanded=='true'?'true':'false'?>" aria-controls="exampleCollapseDefaultThree1">Filter <i class="fa fa-filter" aria-hidden="true"></i></a> 
						</div>
						<div class="panel-collapse collapse <?=$expanded=='true'?'in':''?>" id="exampleCollapseDefaultThree1" aria-labelledby="exampleCollapseDefaultThree1" role="tabpanel">
							<div class="panel-body">
								<input type="hidden" name="expanded" value="true">
								<div class="col-sm-3">
									<input type="text" name="name_search" id="name_search" value="<?=$name_search?>" class="form-control" placeholder="Customer Name" data-fv-regexp="true">
									<div class="help-block with-errors"></div>
								</div>
								<div class="col-sm-3">
									<input type="text" name="city_search" id="city_search" value="<?=$city_search?>" class="form-control" placeholder="City" data-fv-regexp="true">
									<div class="help-block with-errors"></div>
								</div>
								<div class="form-group col-sm-3">
									<select class="form-control" id="search_battery" name="search_battery">
										<option value="">Select Battery</option>
										<?php $obj_battery = json_decode($customerPriceArr['battery_types'],true);
										usort($obj_battery, function ($a, $b) {
											return $a['name'] <=> $b['name'];
										});
										foreach ($obj_battery as $bkey => $bvalue) {
											if($bvalue["bstatus"]==1){
											if($search_battery==$bvalue["name"]){
												$bsel = 'selected';
											}else{
												$bsel = '';
											}
											echo '<option value="'.$bvalue["name"].'" '.$bsel.'>'.$bvalue["name"].'</option>';
										} }
										?>
									</select>
								</div>
								<div class="form-group col-sm-3">
									<select class="form-control" id="search_charger" name="search_charger">
										<option value="">Select EV Charger</option>
										<?php $obj_charger = json_decode($customerPriceArr["ev_charger_types"], true);
										usort($obj_charger, function ($a, $b) {
											return $a['name'] <=> $b['name'];
										});
										foreach ($obj_charger as $ckey => $cvalue) {
											if($cvalue["evstatus"]==1){
											if($search_charger==$cvalue["name"]){
												$csel = 'selected';
											}else{
												$csel = '';
											}
											echo '<option value="'.$cvalue["name"].'" '.$csel.'>'.$cvalue["name"].'</option>';
										} }
										?>
									</select>
								</div>
								
								<div class="form-group col-sm-3">
									<select class="form-control" id="search_panel" name="search_panel">
										<option value="">Select Panel Type</option>
										<?php $obj_panel = json_decode($customerPriceArr["panel_types"], true);
										usort($obj_panel, function ($a, $b) {
											return $a['name'] <=> $b['name'];
										});
										foreach ($obj_panel as $key => $value) {
											if($value["pstatus"]==1){
												if($search_panel==$value["name"]){
													$psel = 'selected';
												}else{
													$psel = '';
												}
												echo '<option value="'.$value["name"].'" '.$psel.'>'.$value["name"].' - '.$value["wattage"].' Wp</option>';
										} 	}
										?>
									</select>
								</div>
								
								<div class="form-group col-sm-3">
									<select class="form-control" id="search_roof" name="search_roof">
										<option value="">Select Roof Type</option>
										<?php $obj_roof = json_decode($customerPriceArr["roof_type_price"], true);
										usort($obj_roof, function ($a, $b) {
											return $a['name'] <=> $b['name'];
										});
										foreach ($obj_roof as $rkey => $rvalue) {
											if($rvalue["rfstatus"]==1){
												if($search_roof==$rvalue["name"]){
													$rsel = 'selected';
												}else{
													$rsel = '';
												}
												echo '<option value="'.$rvalue["name"].'" '.$rsel.'>'.$rvalue["name"].'</option>';
										} 	}
										?>
									</select>
								</div>
								
								<div class="form-group col-sm-3">
									<select class="form-control" id="search_inverter" name="search_inverter">
										<option value="">Select Inverter</option>
										<?php $obj_inverter = json_decode($customerPriceArr["inverter_types"], true);
										usort($obj_inverter, function ($a, $b) {
											return $a['name'] <=> $b['name'];
										});
										foreach ($obj_inverter as $rkey => $invalue) {
											if($invalue["invstatus"]==1){
												if($search_inverter==$invalue["name"]){
													$insel = 'selected';
												}else{
													$insel = '';
												}
												echo '<option value="'.$invalue["name"].'" '.$insel.'>'.$invalue["name"].'</option>';
										} 	}
										?>
									</select>
								</div>
								
								<div class="form-group col-md-3">
									<select class="form-control select2" id="search_agent" name="search_agent">
										<option value="">Search by Sales Rep</option>
										<?php $allAgents = getAllAgents();
										foreach($allAgents as $akey=>$aval){
											if($akey==$search_agent){
												$asel = 'selected';
											}else{
												$asel = '';
											}
										?>
										<option value="<?=$akey?>" <?=$asel?>><?=$aval?></option>
										<?php } ?>
									</select>
								</div>
								<div class="form-group col-sm-4">				
									<div class="input-daterange input-group" id="date-range">
										<input type="text" class="form-control" name="start_date" id="start_date" value="<?=$start_date?>" placeholder="Date From" autocomplete="off">
										<span class="input-group-addon bg-info b-0 text-white">to</span>
										<input type="text" class="form-control" name="end_date" id="end_date" value="<?=$end_date?>" placeholder="Date To" autocomplete="off">
									</div>
								</div>
								
								<div class="col-sm-2">
									<input type="submit" name="submt" onClick="changeMethod()" value="Search" class="btn search-btn">
									<a href="<?=SITE_PATH_ADM.CPAGE?>" class="btn reset-btn">Reset</a>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php /*if($_SESSION["ses_adm_role"]=="1"){ ?>
			<div class="form-group col-sm-3">
				<select class="form-control select2" id="project_manager" name="project_manager">
					<option value="" >Select Project Manager</option>
					<?php $allProjectManager = getAllProjectManager();
					foreach($allProjectManager as $akey=>$aval){
					?>
					<option value="<?=$akey?>"><?=$aval?></option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group col-sm-4">
				<button type="submit" class="btn btn-primary" name="assign_project_btn">Assign Project</button>
			</div>
			
			<div class="form-group col-sm-5">
				<button type="button" class="fcbtn btn btn-warning btn-outline btn-1b pull-right" onClick="changeAction()">Download Report</button>
			</div>
			<div class="clearfix"></div>
			<?php }*/ ?>
			<div class="clearfix"></div>
			<div class="table-responsive">
				<table class="table table-striped1 table-bordered1 table-hover">
					<thead>
						<tr>
							<th>
								<div class="checkbox1 checkbox-success1">
									<label for="checkbox3"> Sr.</label>
								</div>
							</th>
							<th class="text-nowrap">Date</th>
							<th class="text-nowrap">Customer Name</th>
							<th class="text-nowrap">Address</th>
							<th class="text-nowrap">Status</th>
							<th class="text-nowrap">Panel</th>
							<th class="text-nowrap">Panel Count</th>
							<th class="text-nowrap">Inverter</th>
							<th class="text-nowrap">Battery</th>
							<th class="text-nowrap">EV Charger</th>
							<th class="text-nowrap">Smart Sensor</th>
							<th class="text-nowrap">Backup Box</th>
							<th class="text-nowrap">Optimizer</th>
							<th class="text-nowrap">Roof Type</th>
							<th class="text-nowrap">Project Manager</th>
						</tr>
					</thead>
					<tbody>
						<?php if($reccnt){ 
							$nums=$start+1; 
							while ($line = $result->fetch_array()){ 
							@extract($line);
						?>  
						<tr>
							<td class="table-center">
								<div class="checkbox1 checkbox-success1">
									<label for="checkbox3"> <?=$nums?></label>
								</div>
							</td>
							<td class="table-center text-nowrap"><?=date("Y-m-d",strtotime($post_date))?></td>
							<td class="table-center text-nowrap"><a href="<?=SITE_PATH_ADM.CPAGE?>?mode=add&start=&id=<?=$id?>" data-toggle="tooltip" data-original-title="Edit"><?=$customer_name?></a></td>
							<td class="table-center text-nowrap"><?=$proposal_address?></td>
							<td class="table-center text-nowrap"><?=$proposalStatus[$pstatus]?></td>
							<td class="table-center text-nowrap"><?=$panel_model?$panel_model:'NA'?></td>
							<td class="table-center text-nowrap"><?=$panel_count?$panel_count:'NA'?></td>
							<?php $inverters='';
							if($inverter_type || $inverter_type2 || $inverter_type3){
								if($inverter_type){
									$inverters = $inverter_type;
									if($inverter_type2){
										$inverters .= ',<br>'.$inverter_type2;
									}
									if($inverter_type3){
										$inverters .= ',<br>'.$inverter_type3;
									}
								}
							}else{
								$inverters = 'NA';
							} ?>
							<td class="table-center text-nowrap"><?=$inverters?></td>
							<td class="table-center text-nowrap"><?=$battery_name?$battery_name:'NA'?></td>
							<td class="table-center text-nowrap"><?=$charger_name?$charger_name:'NA'?></td>
							<td class="table-center text-nowrap"><?=$sensor_type_name?$sensor_type_name:'NA'?></td>
							<td class="table-center text-nowrap"><?=$odrift_type_name?$odrift_type_name:'NA'?></td>
							<td class="table-center text-nowrap"><?=$optimizer_type_name?$optimizer_type_name:'NA'?></td>
							<td class="table-center text-nowrap"><?=$roofing_material?$roofing_material:'NA'?></td>
							<td class="text-nowrap table-center"><?=$project_manager?$cms->getSingleResult("SELECT customer_name FROM #_users where id=$project_manager "):''?></td>
						</tr>
						<?php $nums++; } } else{ echo $adm->rowerror(15);}  ?>
					</tbody>
				</table>
			</div>
			<?php include("../inc/paging.inc.php")?> 
		</div>
	</div>
</div>
<!-- /.row -->
<script>
 function changeMethod() {
	$("#aforms").attr("method", "get");
}
</script>
<script type="text/javascript">
function updateApprovedStatus(id,current_status){
	$.ajax({
		url:"<?=SITE_PATH_ADM.CPAGE?>/ajaxChangeStatus.php",
		data:"id="+id+"&status="+current_status,
		method:"post"
	})
}
</script>
<script>
function changeAction(){
	$("#aforms").attr("action","<?=SITE_PATH_ADM.CPAGE?>/download.php");
	//alert($(".filter_form").attr("action"));
	$("#aforms").submit();
	setTimeout(function(){ location.reload() }, 1000);
}
</script>
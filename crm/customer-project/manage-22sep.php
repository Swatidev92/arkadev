<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 
	if($action=='del'){
		$cms->db_query("update #_customer_project set is_deleted='1' where id in ($id)");
		$adm->sessset('Record has been deleted', 'e');
		$cms->redir(SITE_PATH_ADM.CPAGE, true);
		exit;
	}
	
	if($cms->is_post_back()){
		if($arr_ids) {
			$str_adm_ids = implode(",",$arr_ids);
			//print_r($_POST);die;
			switch ($_POST['action']){
				case "delete":
					$cms->db_query("update #_customer_project set is_deleted='1' where id in ($str_adm_ids)");
					$adm->sessset(count($arr_ids).' Item(s) Delete', 'e');
					break;
				case "Inactive":
					$cms->db_query("update #_customer_project set status = '0' where pid in ($str_adm_ids)");
					$adm->sessset(count($arr_ids).' Item(s) Inactive', 'e');
					break;
				case "Active":
					$cms->db_query("update #_customer_project set status = '1' where pid in ($str_adm_ids)");
					$adm->sessset(count($arr_ids).' Item(s) Active', 's');
					break;
				default:
			}
		}
		$cms->redir(SITE_PATH_ADM.CPAGE, true);
		exit;
	}
	if($_SESSION["ses_adm_role"]==3){
		$agentQry = " AND sale_rep_id=".$_SESSION["ses_adm_id"]." ";
	}else{
		$agentQry = "";
	}
	if(isset($_REQUEST['submt'])){
		$conditionsQr = "";
		if(!empty($_REQUEST['name_search'])){
			$name_search = $cms->escape_string($_REQUEST['name_search']);
			$conditionsQr .= " AND p.project_name like '%$name_search%'";
		}
		if(!empty($_REQUEST['city_search'])){
			$city_search = $cms->escape_string($_REQUEST['city_search']);
			$conditionsQr .= " AND p.project_city like '%$city_search%'";
		}
		if(!empty($_REQUEST['search_battery'])){
			$search_battery = $cms->escape_string($_REQUEST['search_battery']);
			$conditionsQr .= " AND l.battery_name='$search_battery'";
		}
		if(!empty($_REQUEST['search_charger'])){
			$search_charger = $cms->escape_string($_REQUEST['search_charger']);
			$conditionsQr .= " AND l.charger_name='$search_charger'";
		}
		if(!empty($_REQUEST['search_panel'])){
			$search_panel = $cms->escape_string($_REQUEST['search_panel']);
			$conditionsQr .= " AND l.panel_model='$search_panel'";
		}
		if(!empty($_REQUEST['search_roof'])){
			$search_roof = $cms->escape_string($_REQUEST['search_roof']);
			$conditionsQr .= " AND l.roofing_material='$search_roof'";
		}
		if(!empty($_REQUEST['search_inverter'])){
			$search_inverter = $cms->escape_string($_REQUEST['search_inverter']);
			$conditionsQr .= " AND (l.inverter_type='$search_inverter' || ;.inverter_type2='$search_inverter' || l.inverter_type3='$search_inverter')";
		}
		if(!empty($_REQUEST['search_agent'])){
			$search_agent = $cms->escape_string($_REQUEST['search_agent']);
			$conditionsQr .= " AND p.sale_rep_id=$search_agent";
		}
		if(!empty($_REQUEST['search_manager'])){
			$search_manager = $cms->escape_string($_REQUEST['search_manager']);
			$conditionsQr .= " AND p.project_manager_id=$search_manager";
		}
		if(!empty($_REQUEST['search_status'])){
			$search_status = $cms->escape_string($_REQUEST['search_status']);
			$conditionsQr .= " AND p.status=$search_status";
		}
		if(!empty($_REQUEST['start_date']) AND !empty($_REQUEST['end_date'])){
			$start_date = $cms->escape_string($_REQUEST['start_date']);
			$end_date = $cms->escape_string($_REQUEST['end_date']);
			$postDateFrom = date("Y-m-d", strtotime($start_date));
			$postDateTo = date("Y-m-d", strtotime($end_date));
			$conditionsQr .= " AND p.project_date>='$postDateFrom' AND p.project_date<='$postDateTo' ";
		}else{
			if(!empty($_REQUEST['start_date'])){
				$start_date = $cms->escape_string($_REQUEST['start_date']);
				$postDate = date("Y-m-d", strtotime($start_date));
				$conditionsQr .= " AND p.project_date>='$postDate'";
			} 
			if(!empty($_REQUEST['end_date'])){
				$end_date = $cms->escape_string($_REQUEST['end_date']);
				$postDate = date("Y-m-d", strtotime($end_date));
				$conditionsQr .= "AND p.project_date<='$postDate'";
			} 
		}
		 
		$start = intval($start);
		$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
		$columns = "select p.id, p.project_name, p.project_address, p.sale_rep_id, p.project_manager_id, p.project_report_name, p.project_date, p.status, l.customer_name, l.battery_name, l.charger_name, l.inverter_type, l.inverter_type2, l.inverter_type3, l.panel_model, l.panel_count, l.roofing_material ";
		$sql = " from #_customer_project p LEFT JOIN #_leads l on p.cust_id=l.id where 1=1 AND p.is_deleted=0 $conditionsQr $agentQry ";
		$order_by == '' ? $order_by = 'p.project_date' : true;
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
		$columns = "select p.id, p.project_name, p.project_address, p.project_city, p.sale_rep_id, p.project_manager_id, p.project_report_name, p.project_date, p.status, l.customer_name, l.battery_name, l.charger_name, l.inverter_type, l.inverter_type2, l.inverter_type3, l.panel_model, l.panel_count, l.roofing_material ";
		$sql = " from #_customer_project p LEFT JOIN #_leads l on p.cust_id=l.id where 1=1 AND p.is_deleted=0 $agentQry ";
		$order_by == '' ? $order_by = 'p.project_date' : true;
		$order_by2 == '' ? $order_by2 = 'asc' : true;
		$sql_count = "select count(*) ".$sql; 
		$sql .= "order by $order_by $order_by2 ";
		$sql .= "limit $start, $pagesize ";
		$sql = $columns.$sql;
		$result = $cms->db_query($sql);
		$reccnt = $cms->db_scalar($sql_count);
	}
	//echo $sql;
	
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
									<input type="text" name="name_search" id="name_search" value="<?=$name_search?>" class="form-control" placeholder="Project Name" data-fv-regexp="true">
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
								<div class="form-group col-md-3">
									<select class="form-control select2" id="search_status" name="search_status">
										<option value="">Search Status</option>
										<?php foreach($proposalStatus as $pskey=>$psval){
											if($pskey==$search_status){
												$pssel = 'selected';
											}else{
												$pssel = '';
											}
										?>
										<option value="<?=$pskey?>" <?=$pssel?>><?=$psval?></option>
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
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
		
			<div class="table-responsive">
				<table class="table table-striped1 table-bordered1 table hover">
					<thead>
						<tr>      
							<th class="text-nowrap">Action</th>
							<th class="text-nowrap">Date</th>
							<th class="text-nowrap">Customer Name</th>
							<th class="text-nowrap">Address</th>
							<th class="text-nowrap">City</th>
							<th class="text-nowrap">Status</th>
							<th class="text-nowrap">Panel</th>
							<th class="text-nowrap">Panel Count</th>
							<th class="text-nowrap">Inverter</th>
							<th class="text-nowrap">Battery</th>
							<th class="text-nowrap">EV Charger</th>
							<th class="text-nowrap">Roof Type</th>
							<th class="text-nowrap">Sales Representative</th>
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
							<td class="text-nowrap">
								<?=$adm->action_e(SITE_PATH_ADM.CPAGE."?mode=add&start=".$_GET['start'],$id)?>
								
								<?=$adm->action_d(SITE_PATH_ADM.CPAGE."?mode=add&start=".$_GET['start'],$id)?>
								&nbsp;
								<?php if($project_report_name && file_exists(FILES_PATH.'reports/'.$project_report_name)){?>
								<a href="<?=SITE_PATH.'uploaded_files/reports/'.$project_report_name?>" download title="Report"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
								<?php } ?>
							</td>						 
							<td class="text-nowrap table-center"><?=$project_date?date("Y-m-d",strtotime($project_date)):''?></td>
							<td class="text-nowrap table-center"><?=$customer_name?></td>
							<td class="text-nowrap table-center"><?=$project_address?></td>
							<td class="text-nowrap table-center"><?=$project_city?$project_city:'NA'?></td>
							<td class="table-center text-nowrap"><?=$proposalStatus[$status]?></td>
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
							<td class="table-center text-nowrap"><?=$roofing_material?></td>
							<td class="text-nowrap table-center"><?=$sale_rep_id?$cms->getSingleResult("SELECT customer_name FROM #_users where id=$sale_rep_id "):''?></td>
							<td class="text-nowrap table-center"><?=$project_manager_id?$cms->getSingleResult("SELECT customer_name FROM #_users where id=$project_manager_id "):''?></td>
						</tr>
						<?php    $nums++;} } else{ echo $adm->rowerror(15);}  ?>
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
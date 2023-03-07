<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 
	if($action=='del'){
		$cms->db_query("update #_customer_project set is_deleted='1' where cust_id in ($id)");
		$cms->db_query("update #_leads set status='0' where id in ($id)");
		$lead_id = $cms->getSingleResult("SELECT lead_id FROM #_customer_project WHERE cust_id=".$id." ");
		$cms->db_query("update #_leads set status='0' where id in ($lead_id)");			
		$old_status = $cms->getSingleResult("SELECT new_status From #_lead_tracker WHERE lead_id = ".$lead_id." ORDER BY id DESC");
		$new_status = 0;
		// lead tracker
		$leadsStatusArr = getAllStatus();
		$action_message="Status Changed from <b>".$leadsStatusArr[$old_status]."</b> to <b>".$leadsStatusArr[$new_status]."</b>";	
		// echo "$action_message";die;
		$StatusPOSTS["lead_id"] = $leadid;
		$StatusPOSTS["action_message"] = $action_message;
		$StatusPOSTS["action_date"] = date('Y-m-d h:i:s');
		$StatusPOSTS["action_by"] = $_SESSION["ses_adm_id"];
		$StatusPOSTS["activity_for"] = $_SESSION["ses_adm_id"];
		$StatusPOSTS["new_status"] = $new_status;
		$StatusPOSTS["lead_status"] = $old_status;
		//print_r($StatusPOSTS);die;
		$cms->sqlquery("rs","lead_tracker",$StatusPOSTS);			
		
		$adm->sessset('Record has been deleted', 'e');
		$cms->redir(SITE_PATH_ADM.CPAGE, true);
		exit;
	}
	
	if(isset($_POST['assign_project_btn'])){
		if($arr_ids){
			if($_POST['project_manager']!=''){			
				$str_adm_ids = implode(",",$arr_ids);
				$cms->db_query("update #_leads set project_manager=".$_POST['project_manager'].", project_assigned_date='".date("Y-m-d")."', lead_type=3 where id in ($str_adm_ids)");
			$prodid = $cms->getSingleResult("SELECT id FROM #_customer_project where cust_id in ($str_adm_ids) and is_deleted = 0");
			$cms->db_query("update #_customer_project set project_manager_id=".$_POST['project_manager']." where cust_id=".$str_adm_ids." and is_deleted = 0");
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
					
					
			/*		
					$_POST['project_date'] = date("Y-m-d");
					$_POST['status'] = 1; //project created
					$_POST['project_manager_id'] = $_POST['project_manager'];
					$_POST['cust_id'] = $lid;
					$_POST['lead_id'] = $cms->getSingleResult("SELECT lead_id FROM #_leads WHERE id=".$lid." ");
					
					$custQry = $cms->db_query("SELECT * FROM #_leads WHERE id=".$lid." ");
					$custRes = $custQry->fetch_array();
					
					$_POST['project_name'] = $custRes['quotation_number'];
					$_POST['sale_rep_id'] = $custRes['assigned_to'];
					$_POST['roof_material'] = $custRes['roofing_material'];
					$_POST['is_deleted'] = 0;
					
					$customerPriceQry = $cms->db_query("SELECT * FROM #_customer_price where id=1 ");
					$customerPriceArr = $customerPriceQry->fetch_array(); 
					
					if($custRes['panel_model']){
						$panelTyeArray = json_decode($customerPriceArr['panel_types'],true);
						foreach ($panelTyeArray as $key => $value) {
							if($value["pstatus"]==1){
								if($custRes['panel_model']==$value["name"]){
									$_POST['panel_name'] = $value["name"];
									$_POST['effektfaktor'] = $value["effektfaktor"];
									$_POST['short_circuit'] = $value["short_circuit"];
									break;
								}
							}
						}
					}
					$_POST['system_size'] = $custRes['system_size'];
					
					if($custRes['inverter_type']){
						$inverterTyeArray = json_decode($customerPriceArr["inverter_types"], true);
						foreach ($inverterTyeArray as $ikey => $ivalue) {
							if($ivalue["invstatus"]==1){
								if($custRes['inverter_type']==$ivalue["name"]){
									$_POST['inverter1'] = $ivalue["name"];
									$_POST['inverter1_effect'] = $ivalue["inveffect"];
									break;
								}
							} 
						}
						$_POST['inverter1_qty'] = $custRes['inverter_type1_qty'];
					}
					if($custRes['inverter_type2']){
						$inverterTyeArray = json_decode($customerPriceArr["inverter_types"], true);
						foreach ($inverterTyeArray as $ikey => $ivalue) {
							if($ivalue["invstatus"]==1){
								if($custRes['inverter_type2']==$ivalue["name"]){
									$_POST['inverter2'] = $ivalue["name"];
									$_POST['inverter2_effect'] = $ivalue["inveffect"];
									break;
								}
							} 
						}
						$_POST['inverter2_qty'] = $custRes['inverter_type2_qty'];
					}
					
					if($custRes['inverter_type3']){
						$inverterTyeArray = json_decode($customerPriceArr["inverter_types"], true);
						foreach ($inverterTyeArray as $ikey => $ivalue) {
							if($ivalue["invstatus"]==1){
								if($custRes['inverter_type3']==$ivalue["name"]){
									$_POST['inverter3'] = $ivalue["name"];
									$_POST['inverter3_effect'] = $ivalue["inveffect"];
									break;
								}
							} 
						}
						$_POST['inverter3_qty'] = $custRes['inverter_type3_qty'];
					}
					
					if($custRes['battery_name']){
						$batteryTyeArray = json_decode($customerPriceArr["battery_types"], true);
						foreach ($batteryTyeArray as $bkey => $bvalue) {
							if($bvalue["bstatus"]==1){
								if($custRes['battery_name']==$bvalue["name"]){
									$_POST['battery'] = $bvalue["name"];
									$_POST['battery_quantity'] = $custRes["battery_qty"];
									$_POST['battery_size'] = $bvalue["btsize"];
									break;
								}
							}
						}
					}
					
					if($custRes['charger_name']){
						$chargerTyeArray = json_decode($customerPriceArr["ev_charger_types"], true);
						foreach ($chargerTyeArray as $ckey => $cvalue) {
							if($cvalue["evstatus"]==1){
								if($custRes['charger_name']==$cvalue["name"]){
									$_POST['ev_charger'] = $cvalue["name"];
									$_POST['ev_quantity'] = $custRes['charger_qty'];
									break;
								}
							} 
						}
					}
					
					if($custRes['sensor_type_name']){
						$sensorTypeArray = json_decode($customerPriceArr["sensor_type"], true);
						foreach ($sensorTypeArray as $snkey => $snvalue) {
							if($snvalue["sensor_status"]==1){
								if($custRes['sensor_type_name']==$snvalue["sensor_name"]){
									$_POST['smart_sensor_name'] = $snvalue["sensor_name"];
									$_POST['smart_sensor_qty'] = $custRes["sensor_qty"];
									break;
								}
							}
						}
					}
					
					if($custRes['odrift_type_name']){
						$odriftTypeArray = json_decode($customerPriceArr["odrift_type"], true);
						foreach ($odriftTypeArray as $odkey => $odvalue) {
							if($odvalue["odrift_status"]==1){
								if($custRes['odrift_type_name']==$odvalue["odrift_name"]){
									$_POST['odrift_name'] = $odvalue["odrift_name"];
									$_POST['odrift_quantity'] = $custRes["odrift_qty"];
									break;
								}
							} 
						}
					}
					
					if($custRes['optimizer_type_name']){
						$optimizerTypeArray = json_decode($customerPriceArr["optimizer_type"], true);
						foreach ($optimizerTypeArray as $odkey => $odvalue) {
							if($odvalue["optimizer_status"]==1){
								if($custRes['optimizer_type_name']==$odvalue["optimizer_name"]){
									$_POST['optimizer_name'] = $odvalue["optimizer_name"];
									$_POST['optimizer_quantity'] = $custRes["optimizer_qty"];
									break;
								}
							} 
						}
					}
		
					//print_r($_POST);die;
					$projExists = $cms->getSingleResult("SELECT id FROM #_customer_project where cust_id=".$lid." ");
					if($projExists>0 && $projExists!=''){
						$cms->sqlquery("rs","customer_project",$_POST,'id',$projExists);	
						$proj_id = $projExists;
					}else{
						$proj_id = $cms->sqlquery("rs","customer_project",$_POST);
					}
					/*$invoice_Arr = array("report_no"=>$uids);
					$name  = generateReport($invoice_Arr);*/

			
					$proj_id = $cms->getSingleResult("SELECT id FROM #_customer_project where cust_id=".$lid." and is_deleted=0");

					$customerQry = $cms->db_query("SELECT customer_name, quotation_number FROM #_leads where id=".$lid." AND status=4 and is_deleted=0 ");
					$customerArr = $customerQry->fetch_array();
					$project_customer = $customerArr['customer_name'];
					$data_Arr = array("report_no"=>$proj_id,"project_num"=>$customerArr['quotation_number'],"project_customer"=>$project_customer);
					// print_r($data_Arr);die;
					$ReportArr['project_report_name'] = generateReport($data_Arr);
					$cms->sqlquery("rs","customer_project",$ReportArr,'id',$proj_id);				
					
					//insert steps for projects
					/*if($proj_id){
						$allStepsQry = $cms->db_query("SELECT * FROM #_project_steps where status=1 AND is_deleted=0 order by step_id ");
						while($allStepsArr = $allStepsQry->fetch_array()){
							$projectStepsQry = $cms->db_query("SELECT * FROM #_users_project_steps where step_num=".$allStepsArr['step_id']."  AND project_id=".$proj_id." ");
							
							if($projectStepsQry->num_rows>0){
								$projectStepsArr = $projectStepsQry->fetch_array();
								$projectStepId = $projectStepsArr['id'];
								$cms->sqlquery("rs","users_project_steps",$projectStepsArr,'id',$projectStepId);
							}
							else{
								$allStepsArr['project_id'] = $proj_id;
								$allStepsArr['step_num'] = $allStepsArr['step_id'];
								$cms->sqlquery("rs","users_project_steps",$allStepsArr);
							}			
						}
					}*/
					
				}
			}
			else{
				echo '<script>alert("Select project manager to assign")</script>';
			}				
			//$adm->sessset('Record has been added', 's');
			$_SESSION['REFERER_page_project']=$_SERVER['REQUEST_URI'];
			$path = $_SESSION['REFERER_page_project'];
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
	
	//sorting of data
	$url="https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	$urls1 = $urls = explode("&", $url);
	$sortCondition = "";
	if(empty($_GET["sorting"])){
		$sortVar ="desc";
	}

	if(!empty($_GET["sortby"])){
		if($_GET["sorting"] =="asc"){
			$sortCondition .= "ORDER BY ".$_GET["sortby"]." asc ";
			$sortVar ="desc";
			$order_by = $_GET["sortby"];
			$order_by2 = "asc";	
		}else if($_GET["sorting"] =="desc"){
			$sortCondition .= "ORDER BY ".$_GET["sortby"]." desc ";
			$sortVar ="asc";
			$order_by = $_GET["sortby"];
			$order_by2 = "desc";		
		} 
	}  

	for($i=0;$i<count($urls1);$i++){
		if(!empty($_GET["sortby"])){
			$sortString ="sortby=".$_GET["sortby"];
			if($urls[$i]==$sortString){
				unset($urls[$i]);
			}
		}
		if(!empty($_GET["sorting"])){
			$sortStr ="sorting=".$_GET["sorting"];
			if($urls[$i]==$sortStr){
				unset($urls[$i]);
			}
		}
		if(!empty($_GET["sortbyArray"])){
			$sortStr1 ="sortbyArray=".$_GET["sortbyArray"];
			if($urls[$i]==$sortStr1){
				unset($urls[$i]);
			}
		}
	}
	
	$url = implode('&', $urls);
	
	if($_GET["method"]==''){
		$url= $url."?method=GET" ;
	}
	$_SESSION['REFERER_page_project']=$_SERVER['REQUEST_URI'];
	
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
			//print_r($_REQUEST['search_battery']);die;
			foreach($_REQUEST['search_battery'] as $batteryName){
				$search_batterys .= "'".$batteryName."',";
			}
			$search_batterys = rtrim($search_batterys,',');
			//echo $search_batterys;die;
			$conditionsQr .= " AND battery_name in ($search_batterys)";
		}
		if(!empty($_REQUEST['search_charger'])){
			foreach($_REQUEST['search_charger'] as $chargerName){
				$search_chargers .= "'".$chargerName."',";
			}
			$search_chargers = rtrim($search_chargers,',');
			$conditionsQr .= " AND charger_name in ($search_chargers)";
		}
		if(!empty($_REQUEST['search_panel'])){
			foreach($_REQUEST['search_panel'] as $panelName){
				$search_panels .= "'".$panelName."',";
			}
			$search_panels = rtrim($search_panels,',');
			$conditionsQr .= " AND panel_model in ($search_panels)";
		}
		if(!empty($_REQUEST['search_roof'])){
			foreach($_REQUEST['search_roof'] as $roofName){
				$search_roofs .= "'".$roofName."',";
			}
			$search_roofs = rtrim($search_roofs,',');
			$conditionsQr .= " AND roofing_material in ($search_roofs)";
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
		if(!empty($_REQUEST['search_status'])){
			$search_status = $cms->escape_string($_REQUEST['search_status']);
			$conditionsQr .= " AND p.status=$search_status";
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
		
		if(!empty($_REQUEST['is_all_checked']))
		{
			$is_all_checked = $cms->escape_string($_REQUEST['is_all_checked']);
			if($is_all_checked==1){
			$conditionsQr .= " AND p.is_all_checked=$is_all_checked";
			}else{
				$conditionsQr .= " AND p.`is_all_checked` IS NULL OR p.`is_all_checked` = 2";
			}
		}
		
		$start = intval($start);
		$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;		
		$columns = "select p.system_size, p.status as pstatus, p.project_report_name,p.sale_rep_id as psales, p.project_manager_id,p.project_date, l.price_including_vat,l.charger_price_including_vat,l.battery_price_including_vat, p.is_all_checked, l.* ";
		$sql = " from #_leads l LEFT JOIN #_customer_project p on l.id=p.cust_id where 1=1 AND l.lead_id>0 AND l.is_deleted=0 AND p.is_deleted=0 AND l.status=4 $conditionsQr ";		
		$order_by == '' ? $order_by = 'p.id' : true;
		$order_by2 == '' ? $order_by2 = 'desc' : true;
		$sql_count = "select count(*) ".$sql; 
		$sql .= "order by $order_by $order_by2 ";
		$sql .= "limit $start, $pagesize ";
		$sql = $columns.$sql;
		$result = $cms->db_query($sql);
		$reccnt = $cms->db_scalar($sql_count);
	}else{
		$start = intval($start);
		$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
		$columns = "select p.system_size, p.status as pstatus, p.project_report_name,p.project_date, p.modified_date,p.sale_rep_id as psales, p.project_manager_id, l.price_including_vat,l.charger_price_including_vat,l.battery_price_including_vat, p.is_all_checked, l.* ";
		$sql = " from #_leads l LEFT JOIN #_customer_project p on l.id=p.cust_id where 1=1 AND l.lead_id>0 AND l.is_deleted=0 AND p.is_deleted=0 AND  l.status=4 ";
		$order_by == '' ? $order_by = 'p.id' : true;
		$order_by2 == '' ? $order_by2 = 'desc' : true;
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
<style>
.dotgreen {
  height: 15px;
  width: 15px;
  background-color: #79df5761;
  border-radius: 50%;
  display: inline-block;
}
.dotred {
  height: 15px;
  width: 15px;
  background-color: #ed301185;
  border-radius: 50%;
  display: inline-block;
}
</style>
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
									<select class="form-control1 select2" id="search_battery" name="search_battery[]" placeholder="Select Battery" multiple>
										<?php $obj_battery = json_decode($customerPriceArr['battery_types'],true);
										usort($obj_battery, function ($a, $b) {
											return $a['name'] <=> $b['name'];
										});
										foreach ($obj_battery as $bkey => $bvalue) {
											if($bvalue["bstatus"]==1){
											//if($search_battery==$bvalue["name"]){
											if(in_array($bvalue["name"],$search_battery)){
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
									<select class="form-control1 select2" id="search_charger" name="search_charger[]" placeholder="Select EV Charger" multiple>
										<?php $obj_charger = json_decode($customerPriceArr["ev_charger_types"], true);
										usort($obj_charger, function ($a, $b) {
											return $a['name'] <=> $b['name'];
										});
										foreach ($obj_charger as $ckey => $cvalue) {
											if($cvalue["evstatus"]==1){
											if(in_array($cvalue["name"],$search_charger)){
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
									<select class="form-control1 select2" id="search_panel" name="search_panel[]" placeholder="Select Panel" multiple>
										<?php $obj_panel = json_decode($customerPriceArr["panel_types"], true);
										usort($obj_panel, function ($a, $b) {
											return $a['name'] <=> $b['name'];
										});
										foreach ($obj_panel as $key => $value) {
											if($value["pstatus"]==1){
												if(in_array($value["name"],$search_panel)){
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
									<select class="form-control1 select2" id="search_roof" name="search_roof[]" placeholder="Select Roof Type" multiple>
										<?php $obj_roof = json_decode($customerPriceArr["roof_type_price"], true);
										usort($obj_roof, function ($a, $b) {
											return $a['name'] <=> $b['name'];
										});
										foreach ($obj_roof as $rkey => $rvalue) {
											if($rvalue["rfstatus"]==1){
												if(in_array($rvalue["name"],$search_roof)){
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
								<div class="clearfix"></div>
								
								<div class="form-group col-md-3">
									<select class="form-control select2" id="search_manager" name="search_manager">
										<option value="">Search by Project Manager</option>
										<?php $allProjectManager = getAllProjectManager();
										foreach($allProjectManager as $akey=>$aval){
											if($akey==$search_manager){
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
								<div class="form-group col-md-3">
									<select class="form-control select2" id="is_all_checked" name="is_all_checked">
										<option value="">Readiness</option>
										<option value="2" <?php if($is_all_checked==2) echo "selected";?>>Red</option>
										<option value="1" <?php if($is_all_checked==1) echo "selected";?>>Green</option>
									</select>
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
			<?php if($_SESSION["ses_adm_role"]=="1" || (in_array(13,$act_arr))|| (in_array(14,$act_arr))){ ?>
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
			<?php } ?>
			<div class="clearfix"></div>
			<div class="table-responsive">
				<table class="table table-striped1 table-bordered1 table-hover">
					<thead>
						<tr>
							<th>
								<div class="checkbox checkbox-success">
									<?=$adm->check_all()?>
									<label for="checkbox3">All</label>
								</div>
							</th>
							<th class="text-nowrap">Readiness</th>
							<th class="text-nowrap">Contract Signed <a href="<?=$url?>&sortby=post_date&sorting=<?=$sortVar?>"><i class="fa fa-sort"></i></a></th>
							<th class="text-nowrap">Customer Name</th>
							<th class="text-nowrap">Address</th>
							<th class="text-nowrap">Status</th>
							<th class="text-nowrap">Project Manager</th>
							<th class="text-nowrap">Sales Rep</th>
							<th class="text-nowrap">Panel</th>
							<th class="text-nowrap">Panel Count</th>
							<th class="text-nowrap">Inverter</th>
							<th class="text-nowrap">Battery</th>
							<th class="text-nowrap">EV Charger</th>
							<th class="text-nowrap">Smart Sensor</th>
							<th class="text-nowrap">Backup Box</th>
							<th class="text-nowrap">Optimizer</th>
							<th class="text-nowrap">Roof Type</th>
							<th class="text-nowrap">Total Cost</th>
							<th class="text-nowrap">Storleken på system (Wp)</th>
						</tr>
					</thead>
					<tbody>
						<?php if($reccnt){ 
							$nums=$start+1; 
							while ($line = $result->fetch_array()){ 
							@extract($line);
							
							$project_id = $cms->getSingleResult("SELECT id FROM #_customer_project where cust_id=".$id." AND is_deleted=0 ");
							//$chklist_count = $cms->getSingleResult("SELECT is_all_checked FROM #_project_checklist where project_id=".$project_id." "); 
							$clr='';
							if($is_all_checked==1){$clr="dotgreen";}else{$clr="dotred";}
						?>  
						<tr>
							<td class="table-center text-nowrap">
								<div class="checkbox checkbox-success">
									<?=$adm->check_input($id)?>
									<label for="checkbox3"> <?=$nums?></label>
									<?php 
									
									//$project_id = $cms->getSingleResult("SELECT id FROM #_customer_project where cust_id=".$id." AND is_deleted=0 ");
									
									if($project_id>0){
										echo '&nbsp;&nbsp;'.$adm->action_e(SITE_PATH_ADM."customer-project?mode=add&start=".$_GET['start'],$project_id);
										echo '&nbsp;&nbsp;New'.$adm->action_e(SITE_PATH_ADM."customer-project?mode=add-ppp&start=".$_GET['start'],$project_id);

									?>								
									<?php if($_SESSION["ses_adm_role"]=="1"){
									echo $adm->action_d(SITE_PATH_ADM.CPAGE."?mode=add&start=".$_GET['start'],$id);
									} ?>
									&nbsp;&nbsp;
									<?php if($project_report_name && file_exists(FILES_PATH.UP_FILES_REPORTS.'/'.$project_report_name)){?>
									<a href="<?=SITE_PATH.UPLOAD_FILES_PTH.'/'.UP_FILES_REPORTS.'/'.$project_report_name?>" download title="Report">
									<i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
									<?php } } ?>
								</div>
							</td>
							<td class="table-center text-nowrap"><span class="<?=$clr?>"></span></td>
							<td class="table-center text-nowrap"><?=date("Y-m-d",strtotime($project_date))?></td>
							<td class="table-center text-nowrap">
								<a href="<?=SITE_PATH_ADM.CPAGE?>?mode=add&start=&id=<?=$id?>" data-toggle="tooltip" data-original-title="Edit"><?=$customer_name?>&nbsp;<?php if(!empty($aggrement_note)){echo "<sup style='color:red;'><i class='fa fa-info-circle' aria-hidden='true'></i></sup>";}?></a>
							</td>
							<td class="table-center text-nowrap"><?=$proposal_address?></td>
							<td class="table-center text-nowrap"><?=($project_id>0)?$proposalStatus[$pstatus]:''?></td>
							<td class="text-nowrap table-center">
								<?=($project_id>0)?($project_manager_id?$cms->getSingleResult("SELECT customer_name FROM #_users where id=$project_manager "):''):''?>
							</td>
							<td class="text-nowrap table-center">
								<?//=$sale_rep_id?> 
								<?=($project_id>0)?($psales?$cms->getSingleResult("SELECT customer_name FROM #_users where id=$psales"):''):''?>
								
							</td>
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
							} 
							
							$total_cost = amount_format_proposal(round($price_including_vat+$charger_price_including_vat+$battery_price_including_vat));
							?>
							<td class="table-center text-nowrap"><?=$inverters?></td>
							<td class="table-center text-nowrap"><?=$battery_name?$battery_name:'NA'?></td>
							<td class="table-center text-nowrap"><?=$charger_name?$charger_name:'NA'?></td>
							<td class="table-center text-nowrap"><?=$sensor_type_name?$sensor_type_name:'NA'?></td>
							<td class="table-center text-nowrap"><?=$odrift_type_name?$odrift_type_name:'NA'?></td>
							<td class="table-center text-nowrap"><?=$optimizer_type_name?$optimizer_type_name:'NA'?></td>
							<td class="table-center text-nowrap"><?=$roofing_material?$roofing_material:'NA'?></td>
							<td class="table-center text-nowrap"><?=$total_cost?$total_cost:'NA'?></td>
							<td class="table-center text-nowrap"><?=$system_size?$system_size:'NA'?></td>
						</tr>
						<?php    $nums++;} } else{ echo $adm->rowerror(20);}  ?>
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
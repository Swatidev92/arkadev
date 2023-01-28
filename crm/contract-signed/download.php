<?php include("../../lib/opin.inc.php");?>
<?php
error_reporting(0);
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
	if(!empty($_REQUEST['search_status'])){
		$search_status = $cms->escape_string($_REQUEST['search_status']);
		if($search_status==2){
			$conditionsQr .= " AND p.status!=7 AND p.status!='' ";				
		}
		if($search_status==3){
			$conditionsQr .= " AND p.status=7 AND p.status!='' ";				
		}
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
			
	//$sql="SELECT post_date, customer_name, proposal_address, city, panel_model, panel_count, inverter_type, inverter_type2, inverter_type3, battery_name, charger_name, roofing_material, project_manager FROM #_leads where 1=1 AND is_deleted=0 AND status=4 $conditionsQr order by id desc";
	$sql="select l.post_date, l.customer_name, l.proposal_address, l.city, l.panel_model, l.panel_count, l.inverter_type, l.inverter_type2, l.inverter_type3, l.battery_name, l.charger_name, l.roofing_material, l.project_manager from #_leads l LEFT JOIN #_customer_project p on l.id=p.cust_id where 1=1 AND l.is_deleted=0 AND l.status=4 $conditionsQr ";

	$filename = "Contract Signed Customer-" . date('Y-m-d') . ".csv";
	$fp = fopen('php://output', 'w');
	header("Content-Disposition: attachment; filename=\"$filename\"");
	header("Content-Type: text/csv");
	header("Pragma: no-cache");
	header("Expires: 0");
	fputcsv($fp, $header);	
	$flag = false;
	
	$result = $cms->db_query($sql);
	$h[]="Contract Signed Date\t";
	$h[]="Customer Name\t";
	$h[]="Address\t";
	$h[]="City\t";
	$h[]="Panel\t";
	$h[]="Panel Count\t";
	$h[]="Inverter\t";
	$h[]="Inverter2\t";
	$h[]="Inverter3\t";
	$h[]="Battery\t";
	$h[]="EV Charger\t";
	$h[]="Roof Type\t";
	$h[]="Project Manager\t";
	fputcsv($fp, $h);
	while($row = $result->fetch_assoc()){
		$row['city'] = $row['city']?$row['city']:'NA';
		$row['panel_model'] = $row['panel_model']?$row['panel_model']:'NA';
		$row['panel_count'] = $row['panel_count']?$row['panel_count']:'NA';
		$row['inverter_type'] = $row['inverter_type']?$row['inverter_type']:'NA';
		$row['inverter_type2'] = $row['inverter_type2']?$row['inverter_type2']:'NA';
		$row['inverter_type3'] = $row['inverter_type3']?$row['inverter_type3']:'NA';
		$row['battery_name'] = $row['battery_name']?$row['battery_name']:'NA';
		$row['charger_name'] = $row['charger_name']?$row['charger_name']:'NA';
		$row['roofing_material'] = $row['roofing_material']?$row['roofing_material']:'NA';
		$row['project_manager'] = $row['project_manager']?$cms->getSingleResult("SELECT customer_name FROM #_users where id=".$row['project_manager']." "):'';
				
		fputcsv($fp, $row);
	}
	$sql="SELECT post_date, customer_name, proposal_address, city, count(panel_model) as pmcount, sum(panel_count) as pcount, count(inverter_type) as inv1, count(inverter_type2) as inv2, count(inverter_type3) as inv3, count(battery_name) as bcount, count(charger_name) as evcount, roofing_material, project_manager FROM #_leads where 1=1 AND is_deleted=0 AND status=4 $conditionsQr order by id desc";
	$result = $cms->db_query($sql);
	$row = $result->fetch_assoc();
	
	$row['post_date'] = 'Sum';
	$row['customer_name'] = '';
	$row['proposal_address'] = '';
	$row['city'] = '';
	$row['roofing_material'] = '';
	$row['project_manager'] = '';
	//print_r($row);die;
	fputcsv($fp, $row);
exit;
?>
<?php include("../../lib/opin.inc.php");?>
<?php
error_reporting(0);
	$conditionsQr = "";
	if(!empty($_REQUEST['from_date']) AND !empty($_REQUEST['to_date'])){
		$from_date = $cms->escape_string($_REQUEST['from_date']);
		$to_date = $cms->escape_string($_REQUEST['to_date']);
		$postDateFrom = date("Y-m-d", strtotime($from_date));
		$postDateTo = date("Y-m-d", strtotime($to_date));
		$conditionsQr .= " AND DATE(action_date) BETWEEN '$postDateFrom' AND '$postDateTo' ";
	}else{
		if(!empty($_REQUEST['from_date'])){
			$from_date = $cms->escape_string($_REQUEST['from_date']);
			$postDate = date("Y-m-d", strtotime($from_date));
			$conditionsQr .= " AND DATE(action_date)>='$postDate'";
		} 
		if(!empty($_REQUEST['to_date'])){
			$to_date = $cms->escape_string($_REQUEST['to_date']);
			$postDate = date("Y-m-d", strtotime($to_date));
			$conditionsQr .= "AND DATE(action_date)<='$postDate'";
		} 
	}
	
	$filename = "Lead Analytics-" . date('Y-m-d') . ".csv";
	$fp = fopen('php://output', 'w');
	header("Content-Disposition: attachment; filename=\"$filename\"");
	header("Content-Type: text/csv");
	header("Pragma: no-cache");
	header("Expires: 0");
	fputcsv($fp, $header);	
	$flag = false;
	
	
	$headingQry = $cms->db_query("select lead_status, constant FROM #_lead_type_status WHERE 1=1 AND is_deleted=0 AND lead_type=1 AND constant in(1,2,5,6,4) order by constant ");
	while($headingArr = $headingQry->fetch_array()){
		$statusArr[$headingArr['constant']] = $headingArr['lead_status'];
	$h[]=$headingArr['lead_status']."\t";
	}
	fputcsv($fp, $h);
	
	foreach ($statusArr as $skey=>$sval){
		$row[$sval] = $cms->getSingleResult("SELECT count(id) FROM #_lead_tracker where (lead_status=".$skey." OR new_status=".$skey.") and lead_id>0 $conditionsQr ");
	}
		
	fputcsv($fp, $row);
	
exit;
?>
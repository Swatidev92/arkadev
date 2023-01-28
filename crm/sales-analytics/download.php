<?php include("../../lib/opin.inc.php");?>
<?php
error_reporting(0);

	$conditionsQrUser = "";
	$conditionsQr = "";
	if(!empty($_REQUEST['srch_assigned_to'])){
		$srchAssignedTo = implode(',',$_REQUEST['srch_assigned_to']);
		//$srch_assigned_to = $cms->escape_string($_REQUEST['srch_assigned_to']);
		$conditionsQrUser .= " AND id in ($srchAssignedTo) ";
	}
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

	
	$filename = "Sales Analytics-" . date('Y-m-d') . ".csv";
	$fp = fopen('php://output', 'w');
	header("Content-Disposition: attachment; filename=\"$filename\"");
	header("Content-Type: text/csv");
	header("Pragma: no-cache");
	header("Expires: 0");
	fputcsv($fp, $header);	
	$flag = false;
	
	$h[] = "Sales Lead\t";
	$headingQry = $cms->db_query("select lead_status, constant FROM #_lead_type_status WHERE 1=1 AND is_deleted=0 AND lead_type=1 AND constant in(2,6,13,4) order by constant ");
	while($headingArr = $headingQry->fetch_array()){
		$statusArr[$headingArr['constant']] = $headingArr['lead_status'];
	$h[] = $headingArr['lead_status']."\t";
	}
	fputcsv($fp, $h);
	
	$userQry = $cms->db_query("SELECT id, customer_name FROM #_users where id!=1 AND status=1 AND is_deleted=0 and role=3 $conditionsQrUser ");
	if($userQry->num_rows>0){
		while($userRes = $userQry->fetch_array()){
			$row['sales'] = $userRes['customer_name']; 
			foreach ($statusArr as $skey=>$sval){
				$row[$sval] = $cms->getSingleResult("SELECT count(id) FROM #_lead_tracker where (lead_status=".$skey." OR new_status=".$skey.") AND (action_by=".$userRes['id']." OR activity_for=".$userRes['id'].") AND lead_id>0 $conditionsQr ");
			}
			fputcsv($fp, $row);
		}
	}
			
	
exit;
?>
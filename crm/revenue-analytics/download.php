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
		$conditionsQr .= " AND DATE(post_date) BETWEEN '$postDateFrom' AND '$postDateTo' ";
	}else{
		if(!empty($_REQUEST['from_date'])){
			$from_date = $cms->escape_string($_REQUEST['from_date']);
			$postDate = date("Y-m-d", strtotime($from_date));
			$conditionsQr .= " AND DATE(post_date)>='$postDate'";
		} 
		if(!empty($_REQUEST['to_date'])){
			$to_date = $cms->escape_string($_REQUEST['to_date']);
			$postDate = date("Y-m-d", strtotime($to_date));
			$conditionsQr .= "AND DATE(post_date)<='$postDate'";
		} 
	}	

	
	$filename = "Revenue Analytics-" . date('Y-m-d') . ".csv";
	$fp = fopen('php://output', 'w');
	header("Content-Disposition: attachment; filename=\"$filename\"");
	header("Content-Type: text/csv");
	header("Pragma: no-cache");
	header("Expires: 0");
	fputcsv($fp, $header);	
	$flag = false;
	
	$h[] = "Sales Lead\t";
	$h[] = "Number of Contracts\t";
	$h[] = "Revenue Before Rot\t";
	$h[] = "Revenue After Rot\t";
	$h[] = "Average Margin\t";
	
	fputcsv($fp, $h);
	
	$userQry = $cms->db_query("SELECT id, customer_name FROM #_users where id!=1 AND status=1 AND is_deleted=0 and role=3 $conditionsQrUser ");
	if($userQry->num_rows>0){							
		$total_contract_customer = 0; $total_customer_price=0; $sum_total_price=0; $total_avg_margin=0;
		while($userRes = $userQry->fetch_array()){
			$row['sales'] = $userRes['customer_name']; 
			
			$contract_customer = $cms->getSingleResult("SELECT count(id) FROM #_leads where status=4 AND assigned_to=".$userRes['id']." AND lead_id>0 $conditionsQr ");
			$total_contract_customer = $total_contract_customer+$contract_customer;
			$row['Number of Contract'] = $contract_customer; 
			
			$total_price = (round($cms->getSingleResult("SELECT sum(price_including_vat+charger_price_including_vat+battery_price_including_vat) FROM #_leads where status=4 AND assigned_to=".$userRes['id']." AND lead_id>0 $conditionsQr ")));
			$sum_total_price = $sum_total_price+$total_price;
			$row['Total Price'] = amount_format_proposal($total_price); 
			
			$customer_price = (round($cms->getSingleResult("SELECT sum(proposal_total_cost) FROM #_leads where status=4 AND assigned_to=".$userRes['id']." AND lead_id>0 $conditionsQr ")));
			$total_customer_price = $total_customer_price+$customer_price;
			$row['Customer Price'] = amount_format_proposal($customer_price); 
			
			
			$avg_margin = round($cms->getSingleResult("SELECT round(avg(total_margin_percentage)) FROM #_leads where status=4 AND assigned_to=".$userRes['id']." AND lead_id>0 $conditionsQr "));
			$total_avg_margin = $total_avg_margin+($contract_customer*$avg_margin);							
			$row['Average Margin'] = amount_format_proposal($avg_margin).'%';
			
			fputcsv($fp, $row);
		}
		
		$row1['Total'] = 'Total';
		$row1['total_contract_customer'] = $total_contract_customer;
		$row1['sum_total_price'] = amount_format_proposal($sum_total_price);
		$row1['total_customer_price'] = amount_format_proposal($total_customer_price);
		$row1['total_avg_margin'] = round($total_avg_margin/$total_contract_customer).'%';
		fputcsv($fp, $row1);
	}
			
	
exit;
?>
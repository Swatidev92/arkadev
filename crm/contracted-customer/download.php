<?php include("../../lib/opin.inc.php");?>
<?php
error_reporting(0);

	$conditionsQr = "";
	if(!empty($_REQUEST['name_search'])){
		$name_search = $cms->escape_string($_REQUEST['name_search']);
		$name_search2 = trim($_REQUEST['name_search']);
		$conditionsQr .= " AND customer_name like '%$name_search2%'";
	}
	if(!empty($_REQUEST['search_agent'])){
		$search_agent = $cms->escape_string($_REQUEST['search_agent']);
		$conditionsQr .= " AND assigned_to='$search_agent'";
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

	
	$filename = "Contract Signed Proposal-" . date('Y-m-d') . ".csv";
	$fp = fopen('php://output', 'w');
	header("Content-Disposition: attachment; filename=\"$filename\"");
	header("Content-Type: text/csv");
	header("Pragma: no-cache");
	header("Expires: 0");
	fputcsv($fp, $header);	
	$flag = false;
	
	$h[] = "Date\t";
	$h[]="Project Number\t";
	$h[] = "Customer name\t";
	$h[] = "Proposal name\t";
	$h[] = "Total Price\t";
	$h[] = "Customer Type\t";
	$h[] = "Customer Price\t";
	$h[] = "Solar Green Rebate\t";
	$h[] = "Charger Green Rebate\t";
	$h[] = "Battery Green Rebate\t";
	$h[] = "Total Margin (kr)\t";
	$h[] = "Total Margin (%)\t";
	$h[] = "Payback Year\t";
	$h[] = "Assigned to\t";
	
	fputcsv($fp, $h);
	
	$sqlQry = $cms->db_query("SELECT id,post_date, customer_name, proposal_pdf, (price_including_vat+charger_price_including_vat+battery_price_including_vat) as total_price, proposal_customer_type,total_price_excluding_vat,proposal_total_cost, green_rebate_kr, charger_green_rebate_kr, battery_green_rebate_kr, total_margin_kr, total_margin_percentage, repayment_period, assigned_to FROM #_leads WHERE 1=1 AND is_deleted=0 AND lead_id>0 AND status=4 $conditionsQr order by post_date desc ");
	
	while($row = $sqlQry->fetch_assoc()){
		$row_arr=array();
		 $project_name = $cms->getSingleResult("SELECT project_name FROM #_customer_project where cust_id=".$row['id']." ");
		$row_arr['post_date'] = $row['post_date']?$row['post_date']:'NA';
		$row_arr['project_name'] = $project_name?$project_name:'NA';
		$row_arr['customer_name'] = $row['customer_name']?$row['customer_name']:'NA';
		$row_arr['proposal_pdf'] = $row['proposal_pdf']?$row['proposal_pdf']:'NA';
		$row_arr['total_price'] = amount_format_proposal(round($row['total_price']));
		$row_arr['proposal_customer_type'] = $proosalCustomerTypeArr[$row['proposal_customer_type']];
				
		if($row_arr['proposal_customer_type']==2){
			$customer_price = amount_format_proposal(round($row['total_price_excluding_vat']));
			$row_arr['customer_price'] = $customer_price;
		}else{
			$customer_price = amount_format_proposal(round($row['proposal_total_cost']));
			$row_arr['customer_price'] = $customer_price;
		}
		
		$row_arr['green_rebate_kr'] = $row['green_rebate_kr']?$row['green_rebate_kr']:'NA';
		$row_arr['charger_green_rebate_kr'] = $row['charger_green_rebate_kr']?$row['charger_green_rebate_kr']:'NA';
		$row_arr['battery_green_rebate_kr'] = $row['battery_green_rebate_kr']?$row['battery_green_rebate_kr']:'NA';
		$row_arr['total_margin_kr'] = $row['total_margin_kr']?$row['total_margin_kr']:'NA';
		$row_arr['total_margin_percentage'] = $row['total_margin_percentage']?$row['total_margin_percentage']:'NA';
		$row_arr['repayment_period'] = $row['repayment_period']?$row['repayment_period']:'NA';
		$row_arr['assigned_to'] = $cms->getSingleResult("SELECT customer_name FROM #_users WHERE id=".$row['assigned_to']." ");
		fputcsv($fp, $row_arr);
	}			
	
exit;
?>
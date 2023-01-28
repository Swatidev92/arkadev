<?php include("../lib/opin.inc.php");?>
<?php
error_reporting(0);
	if(isset($_REQUEST)){
		if(!empty($_REQUEST['name_search'])){
			$name_search = $cms->escape_string($_REQUEST['name_search']);
			$name_search2 = trim($_REQUEST['name_search']);
			$conditionsQr .= " AND l.customer_name like '%$name_search2%'";
		}
		if(!empty($_REQUEST['email_search'])){
			$email_search = $cms->escape_string($_REQUEST['email_search']);
			$conditionsQr .= " AND l.email_id='$email_search'";
		}
		if(!empty($_REQUEST['keyword'])){
			$keyword_search = $cms->escape_string($_REQUEST['keyword']);
			$conditionsQr .= " AND l.keyword like '%$keyword_search%'";
		}
		
		//echo $_REQUEST['assigned_to'];die;
		if(!empty($_REQUEST['srch_assigned_to'])){
			$srch_assigned_to = $cms->escape_string($_REQUEST['srch_assigned_to']);
			$conditionsQr .= " AND 	l.assigned_to ='$srch_assigned_to'";
		}
		if(!empty($_REQUEST['start_date']) AND !empty($_REQUEST['end_date'])){
			$start_date = $cms->escape_string($_REQUEST['start_date']);
			$end_date = $cms->escape_string($_REQUEST['end_date']);
			$postDateFrom = date("Y-m-d", strtotime($start_date));
			$postDateTo = date("Y-m-d", strtotime($end_date));
			$conditionsQr .= " AND l.post_date>='$postDateFrom' AND l.post_date<='$postDateTo' ";
		}else{
			if(!empty($_REQUEST['start_date'])){
				$start_date = $cms->escape_string($_REQUEST['start_date']);
				$postDate = date("Y-m-d", strtotime($start_date));
				$conditionsQr .= " AND  l.post_date>='$postDate'";
			} 
			if(!empty($_REQUEST['end_date'])){
				$end_date = $cms->escape_string($_REQUEST['end_date']);
				$postDate = date("Y-m-d", strtotime($end_date));
				$conditionsQr .= "AND l.post_date<='$postDate'";
			} 
		}
		if(!empty($_REQUEST['search_status'])){
			$search_status = $cms->escape_string($_REQUEST['search_status']);
			$conditionsQr .= " AND l.status='$search_status'";
		}
		if(!empty($_REQUEST['search_state'])){
			$search_state = $cms->escape_string($_REQUEST['search_state']);
			$conditionsQr .= " AND l.state_id='$search_state'";
		}
		if(!empty($_REQUEST['search_city'])){
			$search_status = $cms->escape_string($_REQUEST['search_city']);
			$conditionsQr .= " AND l.city='$search_city'";
		}
		
		if(!empty($_REQUEST['search_source'])){
			$search_source = $cms->escape_string($_REQUEST['search_source']);
			$conditionsQr .= " AND l.source='$search_source'";
		}
		// Filter for follow up leads through date range
		if(!empty($_REQUEST["followup_from"]) && !empty($_REQUEST["followup_to"])){
			$followup_from=date("Y-m-d 00:00:00", strtotime($_REQUEST["followup_from"]));
			$followup_to=date("Y-m-d 23:59:59", strtotime($_REQUEST["followup_to"]));
			$conditionsQr .= "AND comments.next_call_date >= '$followup_from' AND comments.next_call_date <= '$followup_to' ";
		}
	}
if($_SESSION["ses_adm_role"]=="1"){
		$adminRole = "";
	}else if($_SESSION["ses_adm_role"]=="0")	{
		$adminRole = " AND assigned_to='".$_SESSION["ses_adm_id"]."' ";
	}
	//echo $qrystring;die;
$sql="SELECT l.customer_name,l.email_id,l.contact_no,l.company,l.designation, l.num_of_session from #_leads l left join #_lead_comments comments on l.id=comments.lead_id where 1=1 $adminRole $conditionsQr GROUP BY l.id order by l.id desc";

$filename = "Leads-" . date('Y-m-d') . ".csv";
$fp = fopen('php://output', 'w');
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: text/csv");
header("Pragma: no-cache");
header("Expires: 0");
fputcsv($fp, $header);
$flag = false;
//$result = mysqli_query($con,$sql);
$result = $cms->db_query($sql);
$h[]="Name\t";
$h[]="Email\t";
$h[]="Mobile No.\t";
$h[]="Company Name\t";
$h[]="Designation\t";
$h[]="Number of Session\t";
fputcsv($fp, $h);
while($row = $result->fetch_assoc()){	
	fputcsv($fp, $row);
}
exit;
?>
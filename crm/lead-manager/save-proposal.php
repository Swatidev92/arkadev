<?php include("../../lib/opin.inc.php");?>

	<?php include_once('common-code.php');?>
	
	<?php
	//print_r($_POST);die;
	$lead_id = $_POST['pid'];
	$parentId = $_POST['parent_id'];
	//$_POST['chart_image'] = $_SESSION['chart_name'];
	
	
	if($_POST['proposal_type']!=5 && $_POST['proposal_type']!=6 && $_POST['proposal_type']!=7){
		$total_margin = $total_margin + $_POST['solar_margin_kr'];
	}
			
	if($charger_name){
		$total_margin = $total_margin + $_POST['charger_margin_kr'];
	}
	
	if($battery_name){
		$total_margin = $total_margin + $_POST['battery_margin_kr'];
	}
	//echo $total_margin;die;
	$_POST['total_margin_kr'] = round($total_margin);	
	
	$_POST['total_margin_percentage'] = round($total_margin*100/$_POST['proposal_total_cost']);
		//print_r($_POST);die;
	
	$_POST['address_input']= $_POST['proposal_address'];
	$_POST['payback_table'] = $payback_table;
	$_POST['repayment_period'] = $payback_year_count;
	$_POST['payment_at_ordering'] = $obj_orderPayment[0]->orderPayment;
	$_POST['proposal_shipment_cost'] = $obj_shipcost[0]->shipmentcost;
	//$_POST['proposal_mms_cost'] = $obj_mmscost[0]->mmscost;
	
	//print_r($_POST);die;
	if($_POST['status']==4){
		$_POST['lead_type'] = 3; //converted to project
	}else{
		$_POST['lead_type'] = 2; // converted to proposal
	}
	$_POST["update_date"] = date("Y-m-d h:i:s");
	//$_POST["post_by"] = $_SESSION["ses_adm_id"];
	//$_POST["assigned_to"] = $_SESSION["ses_adm_id"];
	$_POST["last_updated_by"] = $_SESSION["ses_adm_id"];
	
	if($lead_id && $parentId==''){ 
		//$_POST['created_date'] =  date("H:i a");
		/*$_POST["update_date"] = date("Y-m-d h:i:s");
		if($_POST['status']==4){
			$_POST['lead_type'] = 3; //converted to project
		}else{
			$_POST['lead_type'] = 2; // converted to proposal
		}
		if($assigned_to){
			$_POST["assigned_date"] = date("Y-m-d h:i:s");
		}		
		$cms->sqlquery("rs","leads",$_POST, 'id', $lead_id);
		$lead_insert_id = $lead_id;
		*/
		
		$_POST["parent_id"] = $lead_id;
		$_POST["lead_id"] = $lead_id;
		$_POST["post_date"] = date("Y-m-d");		
	}
	else if($lead_id && $parentId!=''){ 
		$_POST["parent_id"] = $parentId;
		$_POST["lead_id"] = $lead_id;
		$_POST["post_date"] = date("Y-m-d");
	}else{
		$_POST["created_date"] = date("Y-m-d h:i:s");
		$_POST["post_date"] = date("Y-m-d");
	}
	if($_POST['proposal_type']==1 || $_POST['proposal_type']==2 || $_POST['proposal_type']==3 || $_POST['proposal_type']==4 || $_POST['proposal_type']==8 || $_POST['proposal_type']==9 || $_POST['proposal_type']==10 || $_POST['proposal_type']==11){
		$solar_name = 'solar';
	}else{
		$solar_name = '';
	}
	
	if($_POST['create_log']==1){
		$lead_insert_id=$cms->sqlquery("rs","leads",$_POST);
		//update quotation number
		$_POST["quotation_number"] = generateQuotationNumber($lead_insert_id,$solar_name,$_POST['charger_name'],$_POST['battery_name']);
		echo $cms->sqlquery("rs","leads",$_POST, 'id', $lead_insert_id);
	}else{
		if($_POST["quotation_number"]==''){
			$getParentId = $cms->getSingleResult("SELECT id FROM #_leads where id=$lead_id AND status=1 AND is_deleted=0 ");
			$_POST["quotation_number"] = generateQuotationNumber($getParentId,$solar_name,$_POST['charger_name'],$_POST['battery_name']);
		}	
		$lead_insert_id = $parentId;
		echo $cms->sqlquery("rs","leads",$_POST, 'id', $parentId);
	}
	
?>
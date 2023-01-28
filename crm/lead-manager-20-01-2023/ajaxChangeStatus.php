<?php 
include("../../lib/opin.inc.php");
//print_r($_POST);die;
extract($_POST);
$HTML = "";
if($_POST){
	if($status=="4"){
		$new_status=$old_status;
	}else{
		$new_status=4;
	}
	$update=$cms->db_query("update #_leads set status='$new_status' where id='".trim($id)."'");
	$update=$cms->db_query("update #_leads set status='$new_status' where id='".trim($leadid)."'");
	
	if($new_status==4){
		$leadsStatusArr = getAllStatus();
		$action_message="Status Changed from <b>".$leadsStatusArr[$old_status]."</b> to <b>".$leadsStatusArr[$new_status]."</b>";	
		$StatusPOSTS["lead_id"] = $leadid;
		$StatusPOSTS["action_message"] = $action_message;
		$StatusPOSTS["action_date"] = date('Y-m-d h:i:s');
		$StatusPOSTS["action_by"] = $_SESSION["ses_adm_id"];
		$StatusPOSTS["activity_for"] = $_SESSION["ses_adm_id"];
		$StatusPOSTS["new_status"] = $new_status;
		$StatusPOSTS["lead_status"] = $old_status;
		//print_r($StatusPOSTS);die;
		$cms->sqlquery("rs","lead_tracker",$StatusPOSTS);
	}
		
	if($update){
		echo 1;
	}else{
		echo 0;
	}
}
die();
?>
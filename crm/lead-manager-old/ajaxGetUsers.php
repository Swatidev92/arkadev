<?php 
include("../../lib/opin.inc.php");
$HTML='<option value="">Select Assigned To</option>';
//print_r($cms);
if($_POST["id"]>0){
	$userReq = $cms->db_query("SELECT id, customer_name FROM #_users WHERE dealer_type='".$_POST["id"]."' AND status='1'");
	//echo $userReq->num_rows;
	while($userRes=$userReq->fetch_array()){
		$HTML .="<option value='".$userRes["id"]."'>".$userRes["customer_name"]."</option>";
	}
}else{
	$adminReq = $cms->db_query("SELECT id , CONCAT(fname, ' ', lname) as fullname FROM #_administrator WHERE type='".$_POST["id"]."' AND status='1'");
	while($admRes=$adminReq->fetch_array()){
		$HTML .="<option value='".$admRes["id"]."'>".$admRes["fullname"]."</option>";
	}
}
echo $HTML;die;
?>
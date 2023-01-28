<?php 
include("../../lib/opin.inc.php");
//print_r($_POST);
$HTML = "";
if($_POST){
	$cat_id = $_POST["cat_id"];
	$sub_cat_id = $_POST["sub_cat_id"];
	$getIssueReq = $cms->db_query("SELECT `id`, `issue_name` FROM `tech_issues` WHERE `status`=1 AND `is_deleted`=0 AND (`sub_cat_ids` IN ($sub_cat_id) OR `cat_ids` IN ($cat_id) )  ORDER BY issue_name ASC ");
	if($getIssueReq->num_rows>0){
		while($getIssueRes = $getIssueReq->fetch_assoc()){
			$HTML .= "<option value='".$getIssueRes["id"]."'>".$getIssueRes["issue_name"]."</option>";
		}
	}
	echo $HTML;
}
die();
?>
<?php 
include("../../lib/opin.inc.php");
//print_r($_POST);
$HTML = "";
if($_POST){
	$ids = $_POST["ids"];
	$getSubCatReq = $cms->db_query("SELECT `id`, `cat_name` FROM `tech_categories` WHERE `parent_id` IN ($ids) ");
	if($getSubCatReq->num_rows>0){
		while($getSubCatRes = $getSubCatReq->fetch_assoc()){
			$HTML .= "<option value='".$getSubCatRes["id"]."'>".$getSubCatRes["cat_name"]."</option>";
		}
	}
	echo $HTML;
}
die();
?>
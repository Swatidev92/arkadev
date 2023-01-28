<?php 
include("../../lib/opin.inc.php");
//print_r($_POST);die;
extract($_POST);
$HTML = "";
if($_POST){
	if($status=="4"){
		$status=0;
	}else{
		$status=4;
	}
	$update=$cms->db_query("update #_leads set status='$status' where id='".trim($id)."'");
	if($update){
		echo 1;
	}else{
		echo 0;
	}
}
die();
?>
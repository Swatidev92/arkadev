<?php 
include("../../lib/opin.inc.php");
extract($_POST);
$HTML = "";
if($_POST){
	if($status=="1"){
		$status=0;
	}else{
		$status=1;
	}
	$update=$cms->db_query("update #_project_steps set status='$status' where step_num='".trim($stepnum)."'");
	if($update){
		echo 1;
	}else{
		echo 0;
	}
}
die();
?>
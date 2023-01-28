<?php 
include("../../lib/opin.inc.website.php");
extract($_POST);
$HTML = "";
if($_POST){
	if($status=="1"){
		$status=0;
	}else{
		$status=1;
	}
	$update=$cms->db_query("update #_$table_name set status='$status' where id='".trim($id)."'");
	if($update){
		echo 1;
	}else{
		echo 0;
	}
}
die();
?>
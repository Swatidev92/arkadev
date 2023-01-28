<?php include("../../lib/opin.inc.php");?>
<?php $hedtitle = 'Help Content'; ?>
<?php include_once "../inc/header.inc.php"; ?>
<?php 
$materialTypeArr = array("1"=>"Youtube Video", "2"=>"Help Content", "3"=>"Ppt, Doc, Pdf");	
$courseArr = array();
$courseReq = $cms->db_query("SELECT id, help_name FROM #_help_category WHERE 1 AND status=1 AND is_deleted=0 ");
if($courseReq->num_rows>0){
	while($courseRes = $courseReq->fetch_assoc()){
		$courseArr[$courseRes["id"]] =  $courseRes["help_name"];
	}
}

?>
<?php include "../inc/header.php"; ?>   
<?php if($mode=='add'){include("add.php");}else if($mode=='edit'){include("edit.php");}else if($mode=='viewhelp'){include("viewhelp.php");}else{include("manage.php");}?>
<?php include("../inc/footer.inc.php");?>
<?php include("../inc/footer.php");?>
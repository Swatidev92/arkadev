<?php include("../../lib/opin.inc.website.php");?>
<?php $hedtitle = "<i class='icon-location-pin fa-fw '></i> FAQ Manager"; ?>
<?php include_once "../inc/header.inc.php"; ?>
<?php 
$catArr = array();
$catReq = $cms->db_query("select id, cat_name from #_faq_categories where status=1 AND is_deleted=0 ");
if($catReq->num_rows>0){
	while($catRes = $catReq->fetch_assoc()){
		$catArr[$catRes["id"]] =  $catRes["cat_name"];
	}
}

?>
<?php include "../inc/header.php"; ?>   
<?php if($mode=='add'){include("add.php");}elseif($mode=='addportfolio'){include('addportfolio.php');}else{include("manage.php");}?>
<?php include("../inc/footer.inc.php");?>
<?php include("../inc/footer.php");?>
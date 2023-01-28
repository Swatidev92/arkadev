<?php include("../../lib/opin.inc.website.php");?>
<?php $hedtitle = '<i class="ti-support fa-fw"></i> Blog Manager'; ?>
<?php include_once "../inc/header.inc.php"; ?>
<?php include "../inc/header.php"; ?>
<div class="clearfix"></div>
<?php 
$catArr = array();
$catReq = $cms->db_query("SELECT `id`, `cat_name` FROM `#_blog_catagories` WHERE `status`=1 AND `is_deleted`=0");
while($catRes = $catReq->fetch_assoc()){
	$catArr[$catRes["id"]] = $catRes["cat_name"];
}
/*
$tagArr = array();
$tagReq = $cms->db_query("SELECT `id`, `tag_name` FROM #_blog_tags WHERE `status`=1 AND `is_deleted`=0 ");
while($tagRes = $tagReq->fetch_assoc()){
	$tagArr[$tagRes["id"]] = $tagRes["tag_name"];
}*/
?>

<?php if($mode=="add"){include("add.php");}else if($mode=="view"){include("view.php");}else{include("manage.php");}?>
<?php include("../inc/footer.inc.php");?>

<?php include("../inc/footer.php");?>

<?php include("../../lib/opin.inc.website.php");?>
<?php $hedtitle = "<i class='fa fa-image fa-fw '></i> Charger - Right Images"; ?>
<?php include_once "../inc/header.inc.php"; 
?>
<?php include "../inc/header-without-add-del.php"; ?>   
<?php if($mode=="add"){include("add.php");}else if($mode=="manage-images"){include("manage-images.php");}else{include("manage-images.php");}?>
<?php include("../inc/footer.inc.php");?>
<?php include("../inc/footer.php");?>

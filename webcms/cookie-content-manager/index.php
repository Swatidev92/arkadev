<?php include("../../lib/opin.inc.website.php");?>
<?php $hedtitle = "<i class='icon-location-pin fa-fw '></i> Cookie Content Manager"; ?>
<?php include_once "../inc/header.inc.php"; ?>
<?php include "../inc/header-without-add-del.php"; ?>   
<?php if($mode){include("add.php");}else{include("manage.php");}?>
<?php include("../inc/footer.inc.php");?>
<?php include("../inc/footer.php");?>


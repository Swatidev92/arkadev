<?php include("../../lib/opin.inc.php");?>
<?php $hedtitle = "<i class='icon-location-pin fa-fw '></i> Customer Price Manager"; ?>
<?php include_once "../inc/header.inc.php"; ?>
<?php include "../inc/header-without-add-del.php"; ?>   
<?php if($mode){include("add.php");}else{include("manage.php");}?>
<?php include("../inc/footer.inc.php");?>
<?php include("../inc/footer.php");?>


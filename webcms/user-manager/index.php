<?php include("../../lib/opin.inc.website.php");?>
<?php $hedtitle = "<span class='glyphicon glyphicon-user'></span> User Manager"; ?>
<?php include_once "../inc/header.inc.php"; ?>
<?php include "../inc/header.php"; ?>   
<?php if($mode){include("add.php");}else{include("manage.php");}?>
<?php include("../inc/footer.inc.php");?>
<?php include("../inc/footer.php");?>
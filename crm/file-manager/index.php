<?php include("../../lib/opin.inc.php");?>
<?php $hedtitle = "<i class='fa fa-image fa-fw '></i> File Manager"; ?>
<?php include_once "../inc/header.inc.php"; 
?>
<?php include "../inc/header2.php"; ?>   
<?php if($mode=="add"){include("add.php");}else{include("manage.php");}?>
<?php include("../inc/footer.inc.php");?>
<?php include("../inc/footer.php");?>

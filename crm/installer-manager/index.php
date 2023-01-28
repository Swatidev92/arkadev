<?php include("../../lib/opin.inc.php");?>
<?php $hedtitle = '<i class="fa fa-user" aria-hidden="true"></i> Installer/Vendor Manager'; ?>
<?php
// action array
$act_arr = array(2,3,4,22); //add,edit,delete,view

// module name
$Sys_Gl_module_id ="1";
?>
<?php include_once "../inc/header.inc.php"; ?>
<?php include "../inc/header.php"; ?>
<div class="clearfix"></div>
<?php if($mode=="add"){include("add.php");}else if($mode=="view"){include("view.php");}else{include("manage.php");}?>
<?php include("../inc/footer.inc.php");?>
<?php include("../inc/footer.php");?>

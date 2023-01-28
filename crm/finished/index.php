<?php include("../../lib/opin.inc.php");?>
<?php $hedtitle = '<i class="fa fa-group" aria-hidden="true"></i> Project Completed'; ?>
<?php
// action array
$act_arr = array(6,7,8,23); //add,edit,delete,view

// module name
$Sys_Gl_module_id ="5";
?>

<?php include_once "../inc/header.inc.php"; ?>
<?php include "../inc/header-without-add-del.php"; ?>
<div class="clearfix"></div>
<?php if($mode=="add"){include("add.php");}else if($mode=="view"){include("view.php");}else{include("manage.php");}?>
<?php include("../inc/footer.inc.php");?>
<?php include("../inc/footer.php");?>

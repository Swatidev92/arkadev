<?php include("../../lib/opin.inc.php");?>
<?php $hedtitle = '<i class="fa fa-group" aria-hidden="true"></i> Customers'; ?>
<?php
$Sys_Gl_module_id ="1";

$submoduleAction = $cms->getSingleResult("SELECT sub_module_action FROM #_permissions where module_id=$Sys_Gl_module_id AND status=1 AND user_id=".$_SESSION['ses_adm_id']." ");

if($submoduleAction){
$act_arr = explode(',',$submoduleAction); 
//print_r($act_arr);die;
}
?>

<?php include_once "../inc/header.inc.php"; ?>
<?php include "../inc/header-without-add-del.php"; ?>
<div class="clearfix"></div>
<?php if($mode=="add"){include("add.php");}else if($mode=="add-ppp"){include("add-ppp.php");}else if($mode=="view"){include("view.php");}else{include("manage.php");}?>
<?php include("../inc/footer.inc.php");?>
<?php include("../inc/footer.php");?>

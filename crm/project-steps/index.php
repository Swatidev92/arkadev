<?php include("../../lib/opin.inc.php");?>
<?php $hedtitle = '<i class="fa fa-tasks"></i> Project Steps'; ?>
<?php
// action array
//$act_arr = array(2,3,4,22); //add,edit,delete,view

// module name
//$Sys_Gl_module_id ="1";
?>
<?php include_once "../inc/header.inc.php"; ?>

<div class="bg-title hidden-print">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h4 class="page-title"><?=$hedtitle?></h4>
	</div>
</div>
<?php if($mode=="manage-steps"){
$wid = $_GET['id'];
?>
<div class="row">
	<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
		<ol class="breadcrumb">
			<li class="active">
				<a href="<?=SITE_PATH_ADM.CPAGE.'/?mode=add&wid='.$wid?>" class="ub">
					<img  src="<?=SITE_PATH_ADM?>images/add_1.svg" width="25" alt="">
				</a> 	
			</li>
		</ol>
	</div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php if($mode=="add"){include("add.php");}else if($mode=="manage-steps"){include("manage-steps.php");}else if($mode=="edit-field"){include("edit-field.php");}else if($mode=="edit-step"){include("edit-step.php");}else{include("manage.php");}?>
<?php include("../inc/footer.inc.php");?>
<?php include("../inc/footer.php");?>

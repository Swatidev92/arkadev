<?php include("../../lib/opin.inc.php");?>
<?php $hedtitle = '<i class="fa fa-th-list"></i> Customer Project'; ?>

<?php
// action array
$act_arr = array(12); //add,edit,delete,view

// module name
$Sys_Gl_module_id ="1";
?>

<?php include_once "../inc/header.inc.php"; ?>
<div class="bg-title hidden-print">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	  <h4 class="page-title"><?=$hedtitle?></h4>
	</div>
</div>
<div class="row">
	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		<ol class="breadcrumb">
			<li class="active">
			<?php
			if(isset($_GET['mode'])){ ?>
			<a href="<?=$back_btn?>" class="ub">
				<b><i class="fa fa-angle-double-left fa-lg"></i> Back</b>
			</a>
			<?php } else{ ?>
			<?php if($_SESSION["ses_adm_role"]==1 || ($_SESSION["ses_adm_role"]!=1 && $_SESSION["ses_adm_role"]==4 && $_SESSION["ses_adm_usr"]!='')){?>
			<?php if(!$_GET['mode'] or $_GET['dis']!='hide'){ 
				if(in_array(12,$act_arr) || $_SESSION["ses_adm_id"]==1){ ?>
				<a href="<?=SITE_PATH_ADM.CPAGE.'/?mode=add'?>" class="btn btn-info d-none d-lg-block m-l-15 text-white add-new-btn pull-right">	
					<i class="fa fa-plus-circle"></i> Add New
				</a>
			<?php } } } } ?>
			</li>
		</ol>
	</div>
</div>	
<div class="clearfix"></div>
	
	
<div class="clearfix"></div>
<?php if($mode=="add"){include("add.php");}else if($mode=="view"){include("view.php");}else{include("manage.php");}?>
<?php include("../inc/footer.inc.php");?>
<?php include("../inc/footer.php");?>
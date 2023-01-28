<?php include("../../lib/opin.inc.php");?>
<?php $hedtitle = '<i class="fa fa-th-list"></i> Customer Project'; ?>

<?php include_once "../inc/header.inc.php"; ?>
<div class="add-remove-box">
	<div class="row">
		<div class="col-lg-4 col-sm-12 col-md-12 col-xs-12">
			<?php
			if(isset($_GET['mode'])){ ?>
				<a href="javascript:void(0)" onclick="javascript:formback();" class="ub">
				<b><i class="fa fa-angle-double-left fa-lg"></i> Back</b><!--<img src="<?=SITE_PATH_ADM?>images/back.png" alt="">--></a>
			<?php } else{
			?>
			<div class="">
				<h4 class="page-title"><b><?=$hedtitle?></b></h4>
			</div>
			<?php } ?>
		</div>
		<div class="col-lg-8 col-sm-12 col-md-12 col-xs-12">
			<?php if(!$_GET['mode']){ ?>
			<?php if(isset($_GET['dis']) !='hide' && in_array($act_arr[0],$_SESSION["url"][$Sys_Gl_module_id]) || $_SESSION["ses_adm_id"]==1){ ?>
			
			<a href="<?=SITE_PATH_ADM.CPAGE.'/?mode=add'?>" class="btn btn-info d-none d-lg-block m-l-15 text-white add-new-btn pull-right">	
				<i class="fa fa-plus-circle"></i> Add New
			</a> 
			<?php } } ?>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
	
	
<div class="clearfix"></div>
<?php if($mode=="add"){include("add.php");}else if($mode=="view"){include("view.php");}else{include("manage.php");}?>
<?php include("../inc/footer.inc.php");?>
<?php include("../inc/footer.php");?>
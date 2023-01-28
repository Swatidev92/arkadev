<?php include("../../lib/opin.inc.php");?>
<?php 
if($_SESSION["ses_adm_role"]!=1){ 
$hedtitle = "<i class='fa fa-bell'></i> My Activities";
}else{	
$hedtitle = "<i class='fa fa-bell'></i> Activities";
}	
?>
<?php include_once "../inc/header.inc.php"; ?>

<div class="bg-title hidden-print">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	  <h4 class="page-title"><?=$hedtitle?></h4>
	</div>
</div>

<div class="clearfix"></div>  
<?php if($mode =='add'){include("add.php");}else if($mode =='add-proposal'){include("add-proposal.php");}else if($mode =='proposal-list'){include("proposal-list.php");}else if($mode =='view'){include("view.php");}else if($mode =='view-proposal'){include("view-proposal.php");}else if($mode =='import') { include("import.php"); }else{include("manage.php");}?>

<?php include("../inc/footer.inc.php");?>
<?php include("../inc/footer.php");?>
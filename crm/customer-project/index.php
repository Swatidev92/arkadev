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
<?php if(isset($_GET['mode'])){ ?>
<div class="row">
	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		<ol class="breadcrumb">
			<li class="active">
			<a href="<?=$_SESSION['REFERER_page_project']?>" class="ub">
				<b><i class="fa fa-angle-double-left fa-lg"></i> Back</b>
			</a>
			</li>
		</ol>
	</div>
	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 text-right">
		<ol class="breadcrumb">
			<li class="active">
				<?php $contract_signed_proposal = $cms->getSingleResult("SELECT cust_id FROM #_customer_project where id=".$_GET['id']." ");				
				$resp_lead_id = $cms->getSingleResult("SELECT lead_id FROM #_leads where id=".$contract_signed_proposal." ");
				?>
				<a href="<?=SITE_PATH_ADM?>lead-manager?mode=proposal-list&start=&id=<?=$resp_lead_id?>" class="ub">
					<b>View Proposal</b>
				</a>
			</li>
		</ol>
	</div>
</div>	
<div class="clearfix"></div>
<?php } ?>
	
<?php if($mode=="add"){include("add.php");}else if($mode=="add-ppp"){include("add-ppp.php");}else if($mode=="view"){include("view.php");}else if($mode=="edit-step"){include("edit-step.php");}else{include("manage.php");}?>
<?php include("../inc/footer.inc.php");?>
<?php include("../inc/footer.php");?>
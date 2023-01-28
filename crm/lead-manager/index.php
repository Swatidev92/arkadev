<?php include("../../lib/opin.inc.php");?>
<?php 
if($_GET['leadid']){
	$lid = $_GET['leadid'];
}else{
	$lid = $_GET['id'];
}
if($_GET['mode']=='add'){
	$hedtitle = "<i class='fa fa-envelope-o fa-fw '></i> Lead Manager";
	if($_SESSION['REFERER_page']!=''){
		$back_btn = $_SESSION['REFERER_page'];
	}else{
		$back_btn = SITE_PATH_ADM.CPAGE;
	}
}
else if($_GET['mode']=='proposal-list'){
	$hedtitle = "<i class='fa fa-envelope-o fa-fw '></i> Proposal Manager for ".'"'.$cms->getSingleResult("SELECT customer_name FROM #_leads where id=".$lid." ").'"'.' <a href="'.SITE_PATH_ADM.CPAGE.'/?mode=add&start=&id='.$lid.'">(LEAD-'.$lid.')</a>';
	if($_SESSION['REFERER_page']!=''){
		$back_btn = $_SESSION['REFERER_page'];
	}else{
		$back_btn = SITE_PATH_ADM.CPAGE;
	}
}
else if($_GET['mode']=='add-proposal' || $_GET['mode']=='add-proposal-newgr'){
	$hedtitle = "<i class='fa fa-envelope-o fa-fw '></i> Proposal Manager for ".'"'.$cms->getSingleResult("SELECT customer_name FROM #_leads where id=".$_GET['leadid']." ").'"'.' <a href="'.SITE_PATH_ADM.CPAGE.'/?mode=add&start=&id='.$lid.'">(LEAD-'.$lid.')</a>';
	$back_btn = SITE_PATH_ADM.CPAGE.'/?mode=proposal-list&start=&id='.$lid;
}
else{
	$hedtitle = "<i class='fa fa-envelope-o fa-fw '></i> Lead Manager";
}	
?>
<?php include_once "../inc/header.inc.php"; ?>

<?php 
$Sys_Gl_module_id ="1";

$submoduleAction = $cms->getSingleResult("SELECT sub_module_action FROM #_permissions where module_id=$Sys_Gl_module_id AND status=1 AND user_id=".$_SESSION['ses_adm_id']." ");

if($submoduleAction){
$act_arr = explode(',',$submoduleAction); 
//print_r($act_arr);die;
}
?>

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
			<?php if(!$_GET['mode'] or $_GET['dis']!='hide'){ 
				if(in_array(2,$act_arr) || $_SESSION["ses_adm_id"]==1){ ?>
				<a href="<?=SITE_PATH_ADM.CPAGE.'/?mode=add'?>" class="ub">
					<img  src="<?=SITE_PATH_ADM?>images/add_1.svg" width="25" alt=""> Add New Lead
				</a> 
			<?php } } ?>
			<?php if(isset($_GET['dis']) !='hide'){ 
				if(in_array(7,$act_arr) || $_SESSION["ses_adm_id"]==1){ ?>
				<span class="enable_trash">&nbsp;&nbsp;&nbsp;
					<a href="javascript:void(0)" class="ub" onclick="javascript:submitions('delete');">
						<img class="trash_icon" src="<?=SITE_PATH_ADM?>images/trash_1.svg" width="25" alt="">
					</a>
				</span>
				<span class="disable_trash">&nbsp;&nbsp;&nbsp;
					<img class="trash_icon" src="<?=SITE_PATH_ADM?>images/trash_2.svg" width="25" alt="">
				</span> 
			<?php } } } ?>
			</li>
		</ol>
	</div>
	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		<ol class="breadcrumb pull-right">
			<li class="active">
			<?php
			if($_GET['mode']=='proposal-list'){
				if($_SESSION['REFERER_page']!=''){
					$redirect = $_SESSION['REFERER_page'];
				}else{
					$redirect = SITE_PATH_ADM.CPAGE;
				}
			?>
			<a href="<?=$redirect?>" class="ub">
				<b>View All Leads</b>
			</a>
			<?php $contract_signed_proposal = $cms->getSingleResult("SELECT id FROM #_leads where lead_id=".$_GET['id']." AND status=4 ");
			if($contract_signed_proposal){
			$project_id = $cms->getSingleResult("SELECT id FROM #_customer_project where cust_id=".$contract_signed_proposal." ");
			if($project_id>0){ ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="<?=SITE_PATH_ADM."customer-project?mode=add&start=".$_GET['start'].'&id='.$project_id?>" class="ub">
				<b>View Project</b>
			</a>
			<?php } ?>
			<?php } ?>
			<?php } ?>
			<?php
			if($_GET['mode']=='add'){ ?>
			<a href="<?=SITE_PATH_ADM.CPAGE?>?mode=proposal-list&start=&id=<?=$_GET['id']?>" class="ub">
				<b>View Proposal</b>
			</a>
			<?php } ?>
			</li>
		</ol>
	</div>
</div>	
<div class="clearfix"></div>
<?php //dimensioning requested users
$accessUser = $cms->getSingleResult("SELECT GROUP_CONCAT(user_id) FROM #_permissions where module_id=$Sys_Gl_module_id AND status=1 AND FIND_IN_SET(11,sub_module_action) ");
$dimensioningUserArr = explode(',',$accessUser);
?>								
  
<?php if($mode =='add'){include("add.php");}else if($mode =='add-proposal'){include("add-proposal.php");}else if($mode =='add-proposal-newgr'){include("add-proposal-newgr.php");}else if($mode =='proposal-list'){include("proposal-list.php");}else if($mode =='view'){include("view.php");}else if($mode =='view-proposal'){include("view-proposal.php");}else if($mode =='import') { include("import.php"); }else{include("manage.php");}?>
<!--<script>
function changeAction(){
	$("#aforms").attr("action","<?=SITE_PATH_ADM.CPAGE?>/download.php");
	//alert($(".filter_form").attr("action"));
	$("#aforms").submit();
	setTimeout(function(){ location.reload() }, 1000);

}
</script>-->
<?php include("../inc/footer.inc.php");?>
<?php include("../inc/footer.php");?>
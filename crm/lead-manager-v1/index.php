<?php include("../../lib/opin.inc.php");?>
<?php 
	if($_SESSION["ses_adm_role"]=="4"){ 
		header("location:".SITE_PATH_ADM."leads-count"); 
	} 
?>
<?php $hedtitle = "<i class='fa fa-envelope-o fa-fw '></i> Lead Management"; ?>
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
	<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
	  <ol class="breadcrumb">
		<li class="active">
		<?php
		if(isset($_GET['mode'])){ ?>
			<a href="javascript:void(0)" onclick="javascript:formback();" class="ub">
			<b><i class="fa fa-angle-double-left fa-lg"></i> Back</b><!--<img src="<?=SITE_PATH_ADM?>images/back.png" alt="">--></a>
		<?php } else{
		?>
		<?php if(!$_GET['mode'] or $_GET['dis']!='hide'){ 
			if(in_array(2,$act_arr) || $_SESSION["ses_adm_id"]==1){ ?>
			<a href="<?=SITE_PATH_ADM.CPAGE.'/?mode=add-proposal'?>" class="ub">
			<img  src="<?=SITE_PATH_ADM?>images/add_1.svg" width="25" alt=""> Add New Lead</a>  <?php } } ?>
			<?php if(isset($_GET['dis']) !='hide'){ ?>
			<?php if(in_array(7,$act_arr) || $_SESSION["ses_adm_id"]==1){ ?>
			<span class="enable_trash">&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" class="ub" onclick="javascript:submitions('delete');">
			<img class="trash_icon" src="<?=SITE_PATH_ADM?>images/trash_1.svg" width="25" alt=""></a></span>
			<span class="disable_trash">&nbsp;&nbsp;&nbsp;
			<img class="trash_icon" src="<?=SITE_PATH_ADM?>images/trash_2.svg" width="25" alt=""></span> <?php  }
			} } ?>
		
		</li>
	  </ol>
	</div>
	</div>
	
	
<div class="clearfix"></div>
 
  
<?php if($mode =='add'){include("add.php");}else if($mode =='add-proposal'){include("add-proposal.php");}else if($mode =='view'){include("view.php");}else if($mode =='view-proposal'){include("view-proposal.php");}else if($mode =='import') { include("import.php"); }else{include("manage.php");}?>
<script>
$(document).ready(function() {
	//$('[data-toggle="tooltip"]').tooltip(); 
	$(document).on('change','#assigned_user_type', function() {
		var id = $(this).val();
		//alert(id);
		$.ajax({
			type: "POST",
			url: "<?=SITE_PATH_ADM.CPAGE?>/ajaxGetUsers.php",
			data: 'id='+id,
			success: function (data) {
				//alert(data);
				$("#assigned_to").html(data);
			}
		});
	});
	});
	$(".f_faculty").change(function() {
		var f_faculty = $(this).val();
		
		if(f_faculty != "") {
			$.ajax({
				url:"<?=SITE_PATH_ADM.CPAGE?>/ajax-getCourses.php",
				data:'c_id='+f_faculty,
				type:'POST',
				success:function(response) {
					var resp = $.trim(response);
					$(".f_course").html(resp);
				}
			});
		} else {
			$(".f_course").html("<option value=''>Select Course</option>");
		}
	});
	
		$(".f_stateId").change(function() {
		var f_stateId = $(this).val();
		if(f_stateId != "") {
			$.ajax({
				url:"<?=SITE_PATH_ADM.CPAGE?>/ajax-getCity.php",
				data:'c_id='+f_stateId,
				type:'POST',
				success:function(response) {
					var resp = $.trim(response);
					$(".f_city").html(resp);
				}
			});
		} else {
			$(".f_city").html("<option value=''>Select City</option>");
		}
	});
	
	
/*$(".filter_form").change(function(){
	$(".filter_form").submit();
});*/
function changeAction(){
	$("#aforms").attr("action","<?=SITE_PATH_ADM.CPAGE?>/download.php");
	//alert($(".filter_form").attr("action"));
	$("#aforms").submit();
	setTimeout(function(){ location.reload() }, 1000);

}
</script>
<?php include("../inc/footer.inc.php");?>
<?php include("../inc/footer.php");?>
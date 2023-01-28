<?php include("../../lib/opin.inc.php");?>
<?php 
	if($_SESSION["ses_adm_role"]=="4"){ 
		header("location:".SITE_PATH_ADM."leads-count"); 
	} 
?>
<?php include_once "../inc/header.inc.php"; ?>
<?php $hedtitle = "<i class='fa fa-envelope-o fa-fw '></i> Lead Management"; ?>
<div class="row bg-title hidden-print">
	<div class="col-lg-6 col-md-5 col-sm-5 col-xs-12">
		<h4 class="page-title"><?=$hedtitle?></h4>
	</div>
	<div class="col-lg-6 col-sm-5 col-md-5 col-xs-12">
		<ol class="breadcrumb">
			<li class="active">
			<?php
				if(isset($_GET['mode'])){?>
				<a href="<?=SITE_PATH_ADM.CPAGE?>" class="ub">
					<img src="<?=SITE_PATH_ADM?>images/back.png" alt=""></a>
			<?php } else{ ?>
			<?php //if($_SESSION["ses_adm_role"] == "1"){ ?>
				
				<a href="<?=SITE_PATH_ADM.CPAGE.'/?mode=add'?>" class="ub" data-toggle="tooltip" title="Add Lead" data-placement="bottom">
				<img  src="<?=SITE_PATH_ADM?>images/add-new2.png" width="35" alt=""></a>
				<!--<a href="<?=SITE_PATH_ADM.CPAGE?>/?mode=import" class="ub btn btn-info">
				Import</a>-->
				<!--<a href="<?=SITE_PATH_ADM.CPAGE?>/download.php" class="ub">
				<img src="<?=SITE_PATH_ADM?>images/Export.png" alt=""></a>-->
				<!--<button type="button" onClick="changeAction()"  class="btn btn-success">Export</button>-->
				<a href="javascript:void(0)" class="ub" onclick="javascript:submitions('delete');" data-toggle="tooltip" title="Delete" data-placement="bottom">
				<img src="<?=SITE_PATH_ADM?>images/delete2.png" width="30" alt=""></a> 
				<!--<a style="color:#000;margin-left: 10px;" href="<?=SITE_PATH_ADM.CPAGE.'/?action=today_followup_leads'?>" class="ub" data-toggle="tooltip" title="Today's Follow Up Lead" data-placement="bottom">
				<i style="vertical-align:middle;" class="fa fa-tasks fa-2x"></i></a>-->
			<?php } //} ?>
				
		</li>
	  </ol>
	</div>
	<!-- /.col-lg-12 -->
	
	
</div>
<?php 
/*$contriesReq = $cms->db_query("SELECT id, name FROM #_countries WHERE status=1 ORDER BY name ASC ");
$contriesArr = array();
while($contriesRes=$contriesReq->fetch_assoc()){
	$contriesArr[$contriesRes["id"]] = $contriesRes["name"];
} */
?>
 
  
<?php if($mode =='add'){include("add.php");}else if($mode =='view'){include("view.php");}else if($mode =='view-lead'){include("view-lead.php");}else if($mode =='import') { include("import.php"); }else{include("manage.php");}?>
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
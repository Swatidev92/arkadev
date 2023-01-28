<?php include("../../lib/opin.inc.php");?>
<?php 
	if($_SESSION["ses_adm_role"]=="4"){ 
		header("location:".SITE_PATH_ADM."leads-count"); 
	} 
?>
<?php $hedtitle = "<i class='fa fa-envelope-o fa-fw '></i> Lead Management"; ?>
<?php include_once "../inc/header.inc.php"; ?>
<?php include "../inc/header-without-add.php"; ?>
<div class="clearfix"></div>
 
  
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
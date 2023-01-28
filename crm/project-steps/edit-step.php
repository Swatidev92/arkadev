<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 
$pid = $_GET["id"];
if($cms->is_post_back()){ 
	//print_r($_POST);die;
	
	if($pid){ 
		$uids =  $pid;
		$cms->sqlquery("rs","project_steps",$_POST,'step_num',$_POST['step_num']);
		$adm->sessset('Record has been updated', 's');
	}
	$cms->redir(SITE_PATH_ADM.CPAGE, true);
}	
if(isset($pid)){
	$rsAdmin=$cms->db_query("select * from #_project_steps where id='".$pid."'");
	$arrAdmin=$cms->db_fetch_array($rsAdmin);
	@extract($arrAdmin);
}
?>
<!-- .row -->
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">	
			<h2>Step <?=$step_num?></h2>
			<div class="form-group col-sm-6">
				<input type="hidden" name="step_num" value="<?=$step_num?>" class="form-control" id="step_num">
                <label for="step_title" class="control-label">Step Name*</label>
				<input type="text" name="step_title" value="<?=$step_title?>" class="form-control" id="step_title" required>
			</div>
			<div class="clearfix"></div>
			<div class="form-group col-sm-12">
				<input type="hidden" id="form_fields" name="form_fields">
				<button type="submit" class="btn add-submit-btn" id="saveData">Submit</button>
                <button type="button" onclick="history.go(-1)" class="btn back-btn">Back</button>
            </div>
			<div class="clearfix"></div>
        </div>
	</div>
</div>
<!-- /.row -->

<script src="<?=SITE_PATH_ADM?>js/jquery-ui.min.js"></script>
<script src="<?=SITE_PATH_ADM?>js/form-builder.min.js"></script>
<script>
jQuery(function($) {
	//$(document.getElementById('fb-editor')).formBuilder();
	var options = {
		disableFields: ['autocomplete', 'button', 'radio-group', 'select', 'checkbox-group', 'date', 'header', 'hidden', 'number', 'paragraph', 'starRating', 'save'],
		showActionButtons: false,
		disabledAttrs: ['placeholder', 'access', 'className', 'description', 'name', 'maxlength']
	};
		
	const formBuilder = $(document.getElementById('fb-editor')).formBuilder(options);
	
	document.getElementById("saveData").addEventListener("click", () => {
	//document.getElementById("saveData").addEventListener("click"{
		const result = formBuilder.actions.save();
		$('#form_fields').val(JSON.stringify(result));
		console.log("result:", result);	
	}); 
});
</script>
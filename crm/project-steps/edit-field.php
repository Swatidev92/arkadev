<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 
$pid = $_GET["id"];
$wid = $_GET["wid"];
if($cms->is_post_back()){ 
	//print_r($_POST);die;
	
	if($pid){ 
		$uids =  $pid;
		$cms->sqlquery("rs","project_steps",$_POST,'id',$pid);
		$adm->sessset('Record has been updated', 's');
	}
	//$cms->redir(SITE_PATH_ADM.CPAGE, true);
	$cms->redir(SITE_PATH_ADM.CPAGE.'?mode=add&start=&wid='.$wid.'&id='.$_GET['spid'], true);
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
			<h2><b>Step <?=$_GET['spid']?> - <?=$cms->getSingleResult("SELECT step_title FROM #_step_detail where step_num=".$_GET['spid']." ");?></b></h2>
			<div class="form-group col-sm-8">
                <label for="field_label" class="control-label">Field Label</label>
				<input type="text" name="field_label" value="<?=$field_label?>" class="form-control" id="field_label" required>
			</div>
			<div class="form-group col-sm-2">
				<label class="control-label">Required</label>
				<div class="radio-list">
					<label class="radio-inline p-0">
						<div class="radio radio-info">
							<input type="radio" name="field_required" id="field_required1" value="1" <?=$field_required==1?'checked':''?>>
							<label for="field_required1">Yes</label>
						</div>
					</label>
					<label class="radio-inline p-0">
						<div class="radio radio-info">
							<input type="radio" name="field_required" id="field_required2" value="0" <?=$field_required==0?'checked':''?>>
							<label for="field_required2">No</label>
						</div>
					</label>
				</div>
				<div class="help-block with-errors"></div>
			</div>
			<div class="clearfix"></div>
			<!--<div class="form-group col-sm-2">
				<label class="control-label">Values</label>
				<div class="radio-list">
					<label class="radio-inline p-0">
						<div class="radio radio-info">
							<input type="radio" name="field_required" id="field_required1" value="1" <?=$field_required==1?'checked':''?>>
							<label for="field_required1">Yes</label>
						</div>
					</label>
					<label class="radio-inline p-0">
						<div class="radio radio-info">
							<input type="radio" name="field_required" id="field_required2" value="0" <?=$field_required==0?'checked':''?>>
							<label for="field_required2">No</label>
						</div>
					</label>
				</div>
				<div class="help-block with-errors"></div>
			</div>-->
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
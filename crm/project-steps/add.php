<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 
$pid = $_GET["id"];
$wid = $_GET["wid"];

if($cms->is_post_back()){ 
	//print_r($_POST);die;
	$form_obj = json_decode($_POST['form_fields']);
	if($pid){ 
		$cms->sqlquery("rs","step_detail",$_POST,'id',$pid);
		if($_POST['form_fields']){
			//print_r($form_obj);
			foreach($form_obj as $formkey=>$formval){
				//print_r($formval->values);die;
				$FIELD['field_required'] = $formval->required;
				$FIELD['field_label'] = $formval->label;
				$FIELD['field_type'] = $formval->type;
				$FIELD['step_id'] = $_POST['step_id'];
				$FIELD['field_values'] = json_encode($formval->values);
				$uids = $cms->sqlquery("rs","project_steps",$FIELD);
			}
		}
		$adm->sessset('Record has been updated', 's');
	} else {		
		$cms->sqlquery("rs","step_detail",$_POST);
		foreach($form_obj as $formkey=>$formval){
			$FIELD['step_id'] = $_POST['step_num'];
			$FIELD['field_type'] = $formval->type;
			$FIELD['field_required'] = $formval->required;
			$FIELD['field_label'] = $formval->label;
			$FIELD['field_values'] = json_encode($formval->values);
			$uids = $cms->sqlquery("rs","project_steps",$FIELD);
		}
	}	
	$cms->redir(SITE_PATH_ADM.CPAGE.'?mode=manage-steps&id='.$wid, true);		
}	
if(isset($pid)){
	$rsAdmin=$cms->db_query("select * from #_step_detail where id='".$pid."'");
	$arrAdmin=$cms->db_fetch_array($rsAdmin);
	@extract($arrAdmin);
}

$addedSteps = $cms->getSingleResult("select GROUP_CONCAT(DISTINCT(step_num)) from #_step_detail where status=1 AND is_deleted=0");

$addedStepsArr = explode(',',$addedSteps);
?>
<style>
.table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
    padding: 0px 6px;
}
</style>

<!-- .row -->
<style>
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
</style>
<div class="row">
	<div class="col-sm-12">
		<div class="white-box">
			<?php if($pid){?>
			<div class="form-group col-sm-3">
				<label class="control-label">Step Number</label>
				<select name="step_num" id="step_num" class="form-control" <?=($pid && $wid)?'disabled':'required'?>>
					<option value="">Select Step</option>
					<?php for($i=1; $i<=20; $i++){
						if($step_num==$i){
							$sel = 'selected';
						}else{
							$sel = '';
						}
					?>
					<option value="<?=$i?>" <?=$sel?>>Step <?=$i?></option>
					<?php } //} ?>
				</select>
				<input type="hidden" name="step_id" value="<?=$step_num?>">
			</div>
			<?php }else{ ?>			
			<div class="form-group col-sm-3">
				<label class="control-label">Step Number</label>
				<select name="step_num" id="step_num" class="form-control" <?=($pid && $wid)?'disabled':'required'?>>
					<option value="">Select Step</option>
					<?php for($i=1; $i<=20; $i++){
						if(!in_array($i,$addedStepsArr)){
					?>
					<option value="<?=$i?>" <?=$sel?>>Step <?=$i?></option>
					<?php } } ?>
				</select>
				<?php if($pid){?>
				<input type="hidden" name="step_num" value="<?=$step_num?>">
				<?php } ?>
			</div>	
			<?php } ?>
			<div class="form-group col-sm-3">
				<label class="control-label">Step Name</label>
				<input type="text" name="step_title" class="form-control" id="step_title" value="<?=$step_title?>" placeholder="Step Name*" required>
			</div>
			<div class="clearfix"></div>			
			<div class="col-sm-12">
				<?php if($pid){
				$fieldQry = $cms->db_query("select *, id as fid from #_project_steps where step_id=$step_num AND is_deleted=0 ");	
				if($fieldQry->num_rows>0){
				?>
				<h2>Fields Added</h2>
				<style>
				.table > tbody > tr > td, .table > tbody > tr > th{
					padding: 10px;
				}
				.table > tbody > tr > td p{
					line-height: 1;
					margin:0px;
				}
				.field-icon {
					margin-right: 10px;
					font-size: 16px;
				}
				</style>
				<table style="clear: both" class="table table-bordered" id="user">
					<tbody>
						<tr>
							<th width="20%">Field Type</th>
							<th>Field Label</th>
							<th>Value</th>
							<th>Action</th>
						</tr>
						<?php while($fieldRes = $fieldQry->fetch_array()){ ?>
						<tr id="field_<?=$fieldRes['fid']?>">
							<td width="20%">
								<?php if($fieldRes['field_type']=='file'){
									$typeShow = '<span class="field-icon"><i class="fa fa-upload" aria-hidden="true"></i></span> File Upload';
								}
								else if($fieldRes['field_type']=='Capture Video'){
									$typeShow = '<span class="field-icon"><i class="fa fa-video-camera" aria-hidden="true"></i></span> Capture Video';
								}
								else if($fieldRes['field_type']=='checkbox-group'){
									$typeShow = '<span class="field-icon"><i class="fa fa-check-square"></i></span> Checkbox';
								}
								else if($fieldRes['field_type']=='radio-group'){
									$typeShow = '<span class="field-icon"><i class="fa fa-list"></i></span> Radio';
								}
								else if($fieldRes['field_type']=='text'){
									$typeShow = '<span class="field-icon"><i class="fa fa-folder"></i></span> Text Field';
								}
								else if($fieldRes['field_type']=='textarea'){
									$typeShow = '<span class="field-icon"><i class="fa fa-sticky-note"></i></span> Text Area';
								}
								else{
									$typeShow = '';
								}?>
								<p class="control-label"><?=$typeShow?></p>
							</td>
							<td width="30%">
								<?php if($fieldRes['field_required']==1){
									$req='<span class="text-danger">*</span>';
								}else{
									$req='';
								}
								?>
								<?=$fieldRes['field_label'].$req?>&nbsp;&nbsp;
								
							</td>
							<td width="30%">
								<?php if($fieldRes['field_values']){
									$field_values_obj = json_decode($fieldRes['field_values']);
									foreach($field_values_obj as $fval){
										echo '<p>'.$fval->label.'</p><br>';
									}
								}?>
							</td>
							<td>
								<?php 								
								echo '<a href="'.SITE_PATH_ADM.CPAGE.'?mode=edit-field&start='.$_GET['start'].'&id='.$fieldRes['fid'].'&spid='.$pid.'&wid='.$wid.'" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil text-inverse m-r-10"></i></a>&nbsp;&nbsp;<a href="javascript:void(0)" onclick="removeField('.$fieldRes['fid'].')"><i class="fa fa-close text-danger"></i></a>';
								
								?>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				<?php } } ?>
			</div>
			<div class="form-group col-sm-12">
				<h2>Add more fields</h2>
				<div id="fb-editor"></div>
			</div>
			<div class="form-group col-sm-12">
				<input type="hidden" name="work_type" value="<?=$wid?>">
				<input type="hidden" id="form_fields" name="form_fields">
				<button type="submit" class="btn add-submit-btn" id="saveData">Submit</button>
				<button type="button" onclick="history.go(-1)" class="btn back-btn">Back</button>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>

<script src="<?=SITE_PATH_ADM?>js/jquery-ui.min.js"></script>
<script src="<?=SITE_PATH_ADM?>js/form-builder.min.js?<?php echo time(); ?>"></script>
<script>
jQuery(function($) {
	//$(document.getElementById('fb-editor')).formBuilder();
	var options = {
		disableFields: ['autocomplete', 'button', 'paragraph', 'starRating','header','hidden','select','date', 'save','checkbox-group','file','number','textarea'],
		showActionButtons: false,
		disabledAttrs: ['placeholder', 'access', 'className', 'description', 'name', 'maxlength','subtype','value','rows','multiple','inline','toggle','other','min','max','step']
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

<script>
function removeField(fieldid){
	if (confirm("Are you sure to delete?")) {
		$.ajax({
			type:"post",
			url: "<?=SITE_PATH_ADM.CPAGE?>/remove_field.php",
			data:"fieldid="+fieldid,
			success:function(result){
				if(parseInt(result)=='1'){
					$("#field_"+fieldid).hide();
				}
				else{
					alert("Something went wrong.Pleas try again.");
				}
			}
		})
	}
}	
</script>

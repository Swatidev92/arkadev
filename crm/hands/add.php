<?php defined('_JEXEC') or die('Restricted access'); ?>
 <?php 
$pid = $_GET['id']; 
if($cms->is_post_back()){ 
//print_r($_POST);
//print_r($_FILES);die;
	
	if(!empty($_FILES["uploaded_files"]["name"])){
		$filename = $_FILES['uploaded_files']['name']; 
		$file_loc = $_FILES['uploaded_files']['tmp_name'];
		$file_size = $_FILES['uploaded_files']['size'];
		$file_type = $_FILES['uploaded_files']['type'];
		$folder = FILES_PATH."media/";
		// make file name in lower case
		$new_file_name = strtolower($filename);
		$final_file= str_replace(" ","-",$new_file_name);
		//if($file_size>0 && $file_size < 200000){
		move_uploaded_file($file_loc,$folder.$final_file);
		//$_POST['display_order']=$i+1;
		$_POST['uploaded_files']=$final_file;
	}
	if(!empty($_FILES["video_upload"]["name"])){
		$filename = $_FILES['video_upload']['name']; 
		$file_loc = $_FILES['video_upload']['tmp_name'];
		$file_size = $_FILES['video_upload']['size'];
		$file_type = $_FILES['video_upload']['type'];
		$folder = FILES_PATH."media/";
		// make file name in lower case
		$new_file_name = strtolower($filename);
		$final_file= str_replace(" ","-",$new_file_name);
		//if($file_size>0 && $file_size < 200000){
		move_uploaded_file($file_loc,$folder.$final_file);
		//$_POST['display_order']=$i+1;
		$_POST['video_upload']=$final_file;
	}
	
	if($pid){         
		$cms->sqlquery("rs","help_content",$_POST, 'id', $pid);
		$adm->sessset('Record has been updated', 's');
		$cms->redir(SITE_PATH_ADM.CPAGE.'?mode=add&courseid='.$_POST['helpcat_id'].'&step_id='.$_POST['step'], true);
	}else{
		//$nameExists=$cms->db_query("SELECT * FROM #_help_category WHERE email_id = '".$_POST['email_id']."' AND purpose='".$_POST['purpose']."' ");
		//if($nameExists->num_rows==0){		
		$uid = $cms->sqlquery("rs","help_content",$_POST);
		$adm->sessset('Record has been added', 's');
		$cms->redir(SITE_PATH_ADM.CPAGE.'?mode=add&courseid='.$_POST['helpcat_id'].'&step_id='.$_POST['step'], true);
		//}
	}
	 
	/*if(isset($_GET['start']) && $_GET['start'] > 0) {
		$path = SITE_PATH_ADM.CPAGE."/index.php?start=".$_GET['start'];
	} else {
		$path = SITE_PATH_ADM.CPAGE;
	}
	$cms->redir($path, true);	*/
} 	
if($pid){		
	$rsAdmin = $cms->db_query("select * from #_help_content where id=$pid ");
	$arrAdmin = $rsAdmin->fetch_array();
	@extract($arrAdmin);
}
 
?>
<!-- .row -->
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
			<div class="form-group col-sm-6">
				<label for="help_name" class="control-label">Select Help</label>
				<select class="form-control" name="helpcat_id" data-fv-regexp="true" data-error="Please select one Help" required>
					<?php if($_GET['courseId']){?>
					<option <?=$_GET['courseId']==$courseid?'selected':''?> value="<?=$_GET['courseId']?>"><?=$cms->getSingleResult("SELECT help_name FROM #_help_category where id=".$_GET['courseId']." ")?></option>
					<?php }else{ ?>
					<option value="">Select Help*</option>
					<?php foreach($courseArr as $key=>$val){?>
					<option <?=$key==$courseid?'selected':''?> value="<?=$key?>"><?=$val?></option>
					<?php } }?>
				</select>
				<div class="help-block with-errors"></div>
			</div>
			<div class="clearfix"></div>
			<div class="text-center">
				<h4 class="control-label"><strong>Start adding Help content and it's material</strong></h4>
			</div>
			<hr>
			<div class="form-group col-sm-3">
				<label for="step" class="control-label">Page/Index No.*</label>
				<select class="form-control" name="step" data-fv-regexp="true" data-error="Please select page" required>
					<option value="">Select page</option>
					<?php for($i=1; $i<=99; $i++){?>
					<option <?=$i==$step_id?'selected':''?> value="<?=$i?>">page <?=$i?></option>
					<?php } ?>
				</select>
				<div class="help-block with-errors"></div>
			</div>
			<div class="form-group col-sm-6">
				<label for="content_title" class="control-label">Content Title*</label>
				<input type="text" name="content_title" value="<?=$content_title?>" class="form-control" id="content_title" placeholder="Session Title" data-fv-regexp="true" data-error="Please enter Content title" required>
				<div class="help-block with-errors"></div>
			</div>
			<div class="form-group col-sm-3">
				<label for="material_type" class="control-label">Help Material Type</label>
				<select class="form-control" name="material_type" id="material_type" data-fv-regexp="true" data-error="Please select Material Type" required>
					<option value="">Select Material Type*</option>
					<?php foreach($materialTypeArr as $mkey=>$mval){?>
					<option value="<?=$mkey?>"><?=$mval?></option>
					<?php } ?>
				</select>
				<div class="help-block with-errors"></div>
			</div>
			<div class="clearfix"></div>
			<div class="show-Help-content" style="display:none;">
				<div class="form-group col-sm-6">
					<label for="content_title" class="control-label">Content Title*</label>
					<input type="text" name="content_title" value="<?=$content_title?>" class="form-control" id="content_title" placeholder="Content Title" data-fv-regexp="true" data-error="Please enter content title" required>
					<div class="help-block with-errors"></div>
				</div>
				<div class="form-group col-sm-12">
					<label for="course_content" class="control-label">Help Content*</label>
					<?=$adm->get_editor_s('course_content', $cms->removeSlash($course_content))?>
					<div class="help-block with-errors"></div>
				</div>	
			</div>
			<div class="clearfix"></div>
			<div class="show-file-upload" style="display:none;">
				<div class="form-group col-sm-6">
					<label for="file_title" class="control-label">File Title*</label>
					<input type="text" name="file_title" value="<?=$file_title?>" class="form-control" id="file_title" placeholder="File Title" data-fv-regexp="true" data-error="Please enter file title" required>
					<div class="help-block with-errors"></div>
				</div>
				<div class="form-group col-sm-6">
					<label for="content_title" class="control-label">Upload (DOC, PPT, PDF)*</label>
					<div class="fileinput fileinput-new input-group" data-provides="fileinput">
						<div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
						<span class="input-group-addon btn btn-default btn-file"> <span class="fileinput-new">Select File</span> <span class="fileinput-exists">Change</span>
						<input type="hidden"><input type="file" name="uploaded_files" required>
						</span> <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
					</div>
					<div class="help-block with-errors"></div>
				</div>	
			</div>	
			<div class="clearfix"></div>
			<div class="show-video-link" style="display:none;">
				<div class="form-group col-sm-6">
					<label for="video_title" class="control-label">Video Title*</label>
					<input type="text" name="video_title" value="<?=$video_title?>" class="form-control" id="video_title" placeholder="Video Title" data-fv-regexp="true" data-error="Please enter video title" required>
					<div class="help-block with-errors"></div>
				</div>
				<div class="form-group col-sm-6">
					<label for="video_link" class="control-label">Video Link*</label>
					<input type="text" name="video_link" value="<?=$video_link?>" class="form-control" id="video_link" placeholder="Videos" data-fv-regexp="true" required>
					<div class="help-block with-errors"></div>
				</div>
			</div>
			<div class="clearfix"></div>
			

			<div class="show-video-upload" style="display:none;">
				<div class="form-group col-sm-6">
					<label for="video_upload_title" class="control-label">Video Title*</label>
					<input type="text" name="video_upload_title" value="<?=$video_upload_title?>" class="form-control" id="video_upload_title" placeholder="Video Title" data-fv-regexp="true" data-error="Please enter Video title" required>
					<div class="help-block with-errors"></div>
				</div>
				<div class="form-group col-sm-6">
					<label for="video_upload" class="control-label">Upload Video*</label>
					<div class="fileinput fileinput-new input-group" data-provides="fileinput">
						<div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
						<span class="input-group-addon btn btn-default btn-file"> <span class="fileinput-new">Select File</span> <span class="fileinput-exists">Change</span>
						<input type="hidden"><input type="file" name="video_upload" required>
						</span> <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
					</div>
					<div class="help-block with-errors"></div>
				</div>
			</div>
			<div class="show-audio" style="display:none;">
				<div class="form-group col-sm-6">
					<label for="audio_title" class="control-label">Audio Title*</label>
					<input type="text" name="audio_title" value="<?=$audio_title?>" class="form-control" id="audio_title" placeholder="Audio Title" data-fv-regexp="true" required>
					<div class="help-block with-errors"></div>
				</div>
				<div class="form-group col-sm-6">
					<label for="audio_link" class="control-label">Audio Link*</label>
					<input type="text" name="audio_link" value="<?=$audio_link?>" class="form-control" id="audio_link" placeholder="Audio Link" data-fv-regexp="true" required>
					<div class="help-block with-errors"></div>
				</div>
			</div>
			<div class="clearfix"></div>

			<!--<div class="form-group col-sm-6">
				<label for="status" class="control-label">Status</label>
				<select class="form-control" name="status">
					<option value="1" <?=(($status=='1')?'selected="selected"':'')?>>Active</option>
					<option value="0" <?=(($status=='0')?'selected="selected"':'')?>>Inactive</option>
				</select>
            </div>
			<div class="clearfix"></div>-->
            <div class="form-group col-sm-12" id="show-submit" style="display:none;">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
			<div class="clearfix"></div>
        </div>
	</div>
</div>

<script>
$('#material_type').change(function(){
	var mtype=$(this).val();
	if(mtype!=''){
		if(mtype==1){
			$('.show-video-link').show();
			$('.show-file-upload').hide();
			$('.show-Help-content').hide();
			$('.show-quiz-select').hide();
			$('.show-video-upload').hide();
			$('.show-audio').hide();
		}else if(mtype==2){
			$('.show-video-link').hide();
			$('.show-file-upload').hide();
			$('.show-Help-content').show();
			$('.show-quiz-select').hide();
			$('.show-video-upload').hide();
			$('.show-audio').hide();
		}else if(mtype==3){
			$('.show-video-link').hide();
			$('.show-file-upload').show();
			$('.show-Help-content').hide();
			$('.show-quiz-select').hide();
			$('.show-video-upload').hide();
			$('.show-audio').hide();
		}else if(mtype==4){
			$('.show-video-link').hide();
			$('.show-file-upload').hide();
			$('.show-Help-content').hide();
			$('.show-quiz-select').show();
			$('.show-video-upload').hide();
			$('.show-audio').hide();
		}else if(mtype==5){
			$('.show-video-link').hide();
			$('.show-file-upload').hide();
			$('.show-Help-content').hide();
			$('.show-quiz-select').hide();
			$('.show-video-upload').show();
			$('.show-audio').hide();
		}else if(mtype==6){
			$('.show-video-link').hide();
			$('.show-file-upload').hide();
			$('.show-Help-content').hide();
			$('.show-quiz-select').hide();
			$('.show-video-upload').hide();
			$('.show-audio').show();
		}else{
			$('.show-video-link').hide();
			$('.show-file-upload').hide();
			$('.show-Help-content').hide();
			$('.show-quiz-select').hide();
			$('.show-video-upload').hide();
			$('.show-audio').hide();
		}		
		$('#show-submit').show();
		$('#show-duration').show();
	}
	
});
</script>
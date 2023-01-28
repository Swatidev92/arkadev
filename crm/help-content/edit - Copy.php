<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 
	
if($_GET['courseId']!=''){
	
	if($action=='mdel'){
		$cms->db_query("update #_help_content set is_deleted=1 where id in ($mid)");
			
		//$adm->sessset('Record has been deleted', 'e');
		$cms->redir(SITE_PATH_ADM.CPAGE.'?mode=edit&courseId='.$_GET['courseId'], true);
		//exit;
	}
	

	if($cms->is_post_back()){ 
		//print_r($_POST);die;
		//print_r($_FILES);die;
		
		//$_POST['step_title']=$_POST['step_title'];
		//echo "update #_help_content set step_title='".$_POST['step_title']."' where step=".$_GET['step']." AND helpcat_id=".$_GET['courseId']." ";die;
		//$cms->db_query("update #_help_content set step_title='".$_POST['step_title']."' where step=".$_GET['step']." AND helpcat_id=".$_GET['courseId']." ");
		
		if(!empty($_POST['edit_row'])){ 
			foreach($_POST['edit_row'] as $pid){
				$_POST['video_link']=$_POST['video_link'.$pid];
				$_POST['video_title']=$_POST['video_title'.$pid];
				$_POST['course_content']=$_POST['course_content'.$pid];
				$_POST['content_title']=$_POST['content_title'.$pid];
				$_POST['file_title']=$_POST['file_title'.$pid];
				$_POST['video_upload_title']=$_POST['video_upload_title'.$pid];
				$_POST['duration']=$_POST['duration'.$pid];
				$_POST['quiz_url']=$_POST['quiz_url'.$pid];
				$_POST['audio_title']=$_POST['audio_title'.$pid];
				$_POST['audio_link']=$_POST['audio_link'.$pid];
				
				if(!empty($_FILES["uploaded_files".$pid]["name"])){
					$filename = $_FILES["uploaded_files".$pid]['name']; 
					$file_loc = $_FILES["uploaded_files".$pid]['tmp_name'];
					$file_size = $_FILES["uploaded_files".$pid]['size'];
					$file_type = $_FILES["uploaded_files".$pid]['type'];
					$folder = CRM_FILES_PATH.UP_FILES_MEDIA."/";
					// make file name in lower case
					$new_file_name = strtolower($filename);
					$final_file= str_replace(" ","-",$new_file_name);
					//if($file_size>0 && $file_size < 200000){
					move_uploaded_file($file_loc,$folder.$final_file);
					//$_POST['display_order']=$i+1;
					$_POST['uploaded_files']=$final_file;
				}else{
					$_POST['uploaded_files']=$_POST['exist_file'.$pid];
				}
				
				if(!empty($_FILES["video_upload".$pid]["name"])){
					$filename = $_FILES["video_upload".$pid]['name']; 
					$file_loc = $_FILES["video_upload".$pid]['tmp_name'];
					$file_size = $_FILES["video_upload".$pid]['size'];
					$file_type = $_FILES["video_upload".$pid]['type'];
					$folder = FILES_PATH."media/";
					// make file name in lower case
					$new_file_name = strtolower($filename);
					$final_file= str_replace(" ","-",$new_file_name);
					//if($file_size>0 && $file_size < 200000){
					move_uploaded_file($file_loc,$folder.$final_file);
					//$_POST['display_order']=$i+1;
					$_POST['video_upload']=$final_file;
				}else{
					$_POST['video_upload']=$_POST['exist_video_file'.$pid];
				}
		
		
				$cms->sqlquery("rs","help_content",$_POST, 'id', $pid);
			}
		}
	$adm->sessset('Record has been updated', 's');
	$cms->redir(SITE_PATH_ADM.CPAGE.'?mode=edit&courseId='.$_GET['courseId'], true);
} 
	
	$cStepQry = $cms->db_query("select * from #_help_content where id=".$_GET['courseId']." AND is_deleted=0 ");
}

?>
<!-- .row -->
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
			<?php $num=1;
			while($cStepRes = $cStepQry->fetch_array()){ 
			if($num==1){
				?>
			<div class="form-group col-sm-6"></div>
			<!--<div class="form-group col-sm-6">
				<div class="pull-right"><a class="btn add-new-btn-vkmm" href="<?=SITE_PATH_ADM.CPAGE."?mode=add"?>">Add New </a></div>
			</div>-->
			<div class="form-group col-sm-12">			
				<?php $help_name = $cms->getSingleResult("SELECT help_name FROM #_help_category where id=".$_GET['courseId']." "); ?>			
				<h1 for="help_name" class="control-label"><?=$help_name?></h1>
			</div>
			<!--<div class="clearfix"></div>
			<div class="form-group col-sm-6">
				<label for="step_title" class="control-label">Content Title*</label>
				<input type="text" name="step_title" value="<?=$cStepRes['step_title']?>" class="form-control" id="step_title" placeholder="Content Title" data-fv-regexp="true" data-error="Please enter Content title" required>
				<div class="help-block with-errors"></div>
			</div>-->
			<div class="clearfix"></div>
			<?php } ?>
			<div class="text-center">
				<h5 class="control-label"><strong><?=$materialTypeArr[$cStepRes['material_type']]?></strong>
				<a href="<?=SITE_PATH_ADM.CPAGE.'?mode=edit&courseId='.$_GET['courseId'].'&step='.$_GET['step'].'&action=mdel&mid='.$cStepRes['id']?>" onclick="return confirm('Do you want delete this record?');" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-close text-danger"></i></a></h5>
			</div>
			<div class="clearfix"></div>
			<input type="hidden" name="edit_row[]" value="<?=$cStepRes['id']?>">
			<div class="form-group col-sm-6">
					<label for="content_heading" class="control-label">Content Title*</label>
					<input type="text" name="content_heading" value="<?=$cStepRes['content_heading']?>" class="form-control" id="content_heading" placeholder="Content Title" data-fv-regexp="true" data-error="Please enter content title" required>
					<div class="help-block with-errors"></div>
				</div>
			
			<?php if($cStepRes['content_title']!='' && $cStepRes['course_content']!=''){ ?>
			<div class="show-course-content">
				<div class="form-group col-sm-6">
					<label for="content_title" class="control-label">Content Title</label>
					<input type="text" name="content_heading" value="<?=$cStepRes['content_heading']?>" class="form-control" id="content_heading<?=$cStepRes['id']?>" placeholder="Content Title" data-fv-regexp="true" data-error="Please enter content title" required>
					<div class="help-block with-errors"></div>
				</div>				

				<div class="form-group col-sm-12">
					<label for="course_content" class="control-label">Help Content</label>
					<?=$adm->get_editor_s('course_content'.$cStepRes['id'], $cms->removeSlash($cStepRes['course_content']))?>
					<div class="help-block with-errors"></div>
				</div>	
			</div>
			<div class="clearfix"></div>
			<hr>
			<?php } ?>
			<div class="clearfix"></div>
			<?php if($cStepRes['file_title']){ ?>
			<div class="show-file-upload">
				<div class="form-group col-sm-4">
					<label for="file_title" class="control-label">File Title</label>
					<input type="text" name="file_title<?=$cStepRes['id']?>" value="<?=$cStepRes['file_title']?>" class="form-control" id="file_title<?=$cStepRes['id']?>" placeholder="File Title" data-fv-regexp="true" data-error="Please enter file title" required>
					<div class="help-block with-errors"></div>
				</div>
				<div class="form-group col-sm-6">
					<label for="step_title" class="control-label">Upload (DOC, PPT, PDF)</label>
					<div class="fileinput fileinput-new input-group" data-provides="fileinput">
						<div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"><?=$cStepRes['uploaded_files']?></span></div>
						<span class="input-group-addon btn btn-default btn-file"> <span class="fileinput-new">Select File</span> <span class="fileinput-exists">Change</span>
						<input type="file" name="uploaded_files<?=$cStepRes['id']?>">
						</span> <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
					</div>
					<input type="hidden" name="exist_file<?=$cStepRes['id']?>" value="<?=$cStepRes['uploaded_files']?>">
					<div class="help-block with-errors"></div>
				</div>	
				<div class="form-group col-sm-2">
					<label class="control-label"></label>
					<label class="form-control"><a href="<?=SITE_PATH.'uploaded_files/'.UP_FILES_MEDIA.'/'.$cStepRes['uploaded_files']?>" download>Download <i class="fa fa-download" aria-hidden="true"></i></a></label>
				</div>
				

			</div>
			<div class="clearfix"></div>
			<hr>
			<?php } ?>
			<div class="clearfix"></div>
			<?php if($cStepRes['video_upload']){ ?>
			<div class="show-file-upload">
				<div class="form-group col-sm-4">
					<label for="video_upload_title" class="control-label">Video Upload Title</label>
					<input type="text" name="video_upload_title<?=$cStepRes['id']?>" value="<?=$cStepRes['video_upload_title']?>" class="form-control" id="video_upload_title<?=$cStepRes['id']?>" placeholder="Video Upload Title" data-fv-regexp="true" data-error="Please enter Video upload title" required>
					<div class="help-block with-errors"></div>
				</div>
				<div class="form-group col-sm-5">	
					<label for="step_title" class="control-label">Upload Video* (Max size 2MB /for more use FTP)</label>
					<div class="fileinput fileinput-new input-group" data-provides="fileinput">
						<div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"><?=$cStepRes['video_upload']?></span></div>
						<span class="input-group-addon btn btn-default btn-file"> <span class="fileinput-new">Select File</span> <span class="fileinput-exists">Change</span>
						<input type="file" name="video_upload<?=$cStepRes['id']?>">
						</span> <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
					</div>
					
					<input type="hidden" name="exist_video_file<?=$cStepRes['id']?>" value="<?=$cStepRes['video_upload']?>">
					<div class="help-block with-errors"></div>
				</div>	

			</div>
			<div class="clearfix"></div>
			<hr>
			<?php } ?>
			<div class="clearfix"></div>
			<?php if($cStepRes['video_title']){ ?>
			<div class="show-video-link">
				<div class="form-group col-sm-6">
					<label for="video_title" class="control-label">Video Title</label>
					<input type="text" name="video_title<?=$cStepRes['id']?>" value="<?=$cStepRes['video_title']?>" class="form-control" id="video_title<?=$cStepRes['id']?>" placeholder="Video Title" data-fv-regexp="true" data-error="Please enter video title" required>
					<div class="help-block with-errors"></div>
				</div>
				<div class="form-group col-sm-6">
					<label for="video_link" class="control-label">Video Link</label>
					<input type="text" name="video_link<?=$cStepRes['id']?>" value="<?=$cStepRes['video_link']?>" class="form-control" id="video_link<?=$cStepRes['id']?>" placeholder="Videos" data-fv-regexp="true" required>
					<div class="help-block with-errors"></div>
				</div>

			</div>
			<div class="clearfix"></div>
			<hr>
			<?php } ?>
			
			<?php if($cStepRes['audio_link']){ ?>
			<div class="show-audio-link">
				<div class="form-group col-sm-6">
					<label for="audio_title" class="control-label">Audio Title</label>
					<input type="text" name="audio_title<?=$cStepRes['id']?>" value="<?=$cStepRes['audio_title']?>" class="form-control" id="audio_title<?=$cStepRes['id']?>" placeholder="Audio Title" data-fv-regexp="true" data-error="Please enter Audio title" required>
					<div class="help-block with-errors"></div>
				</div>
				<div class="form-group col-sm-6">
					<label for="audio_link" class="control-label">Audio Link</label>
					<input type="text" name="audio_link<?=$cStepRes['id']?>" value="<?=$cStepRes['audio_link']?>" class="form-control" id="audio_link<?=$cStepRes['id']?>" placeholder="Audio Link" data-fv-regexp="true" required>
					<div class="help-block with-errors"></div>
				</div>

			</div>
			<div class="clearfix"></div>
			<hr>
			<?php } ?>
			<div class="clearfix"></div>
		<?php $num++; } ?>
			<!--<div class="form-group col-sm-6">
				<label for="status" class="control-label">Status</label>
				<select class="form-control" name="status">
					<option value="1" <?=(($status=='1')?'selected="selected"':'')?>>Active</option>
					<option value="0" <?=(($status=='0')?'selected="selected"':'')?>>Inactive</option>
				</select>
            </div>
			<div class="clearfix"></div>-->
            <div class="form-group col-sm-12" id="show-submit">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
			<div class="clearfix"></div>
        </div>
		
	</div>
</div>
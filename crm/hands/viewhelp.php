<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 
	
if($_GET['courseId']!='' && $_GET['step']!=''){
	
	if($action=='mdel'){
		$cms->db_query("update #_help_content set is_deleted=1 where id in ($mid)");
			
		//$adm->sessset('Record has been deleted', 'e');
		$cms->redir(SITE_PATH_ADM.CPAGE.'?mode=edit&courseId='.$_GET['courseId'].'&step='.$_GET['step'], true);
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
					$folder = FILES_PATH."media/";
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
	$cms->redir(SITE_PATH_ADM.CPAGE.'?mode=edit&courseId='.$_GET['courseId'].'&step='.$_GET['step'], true);
} 
	
	$cStepQry = $cms->db_query("select * from #_help_content where helpcat_id=".$_GET['courseId']." AND step=".$_GET['step']." AND is_deleted=0 ");
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

			<div class="form-group col-sm-12">			
				<?php $help_name = $cms->getSingleResult("SELECT help_name FROM #_help_category where id=".$_GET['courseId']." "); ?>			
				<h1 for="help_name" class="control-label"><?=$help_name?> - Page <?=$_GET['step']?></h1>
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
				<h5 class="control-label"><strong>Material <?=$num?> - <?=$materialTypeArr[$cStepRes['material_type']]?></strong></h5>
				<a href="<?=SITE_PATH_ADM.CPAGE.'?mode=edit&courseId='.$_GET['courseId'].'&step='.$_GET['step'].'&action=mdel&mid='.$cStepRes['id']?>" onclick="return confirm('Do you want delete this record?');" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-close text-danger"></i></a>
			</div>
			<div class="clearfix"></div>
			<input type="hidden" name="edit_row[]" value="<?=$cStepRes['id']?>">
			<?php if($cStepRes['content_title']){ ?>
			<div class="show-course-content">
				<div class="form-group col-sm-6">
					
					<?=$cStepRes['content_title']?>
					<div class="help-block with-errors"></div>
				</div>				

				<div class="form-group col-sm-12">
					
					<?=$cStepRes['course_content']?>
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
					
					<?=$cStepRes['file_title']?>
					<div class="help-block with-errors"></div>
				</div>

				<div class="form-group col-sm-2">
					<label class="control-label"></label>
					<label class="form-control"><a href="<?=SITE_PATH.'uploaded_files/media/'.$cStepRes['uploaded_files']?>" download>Download <i class="fa fa-download" aria-hidden="true"></i></a></label>
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
					<?=$cStepRes['video_upload_title']?>
					<div class="help-block with-errors"></div>
				</div>
				<div class="form-group col-sm-5">	
					
					
					<a href="<?=$cStepRes['video_upload']?>" target="_blank">View</a>
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
	
					<?=$cStepRes['video_title']?>
					<div class="help-block with-errors"></div>
				</div>
				<div class="form-group col-sm-6">
					
					<a href="<?=$cStepRes['video_link']?>" class="form-control" id="video_link<?=$cStepRes['id']?>" target="_blank">
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
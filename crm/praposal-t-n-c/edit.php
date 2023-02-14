<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 
	
if($_GET['courseId']!=''){
	

	if($cms->is_post_back()){ 
		//print_r($_POST);die;
		//print_r($_FILES);die;
		
		//$_POST['step_title']=$_POST['step_title'];
		//echo "update #_tnc_content set step_title='".$_POST['step_title']."' where step=".$_GET['step']." AND helpcat_id=".$_GET['courseId']." ";die;
		//$cms->db_query("update #_tnc_content set step_title='".$_POST['step_title']."' where step=".$_GET['step']." AND helpcat_id=".$_GET['courseId']." ");
		
		if(!empty($_POST['edit_row'])){ 
			foreach($_POST['edit_row'] as $pid){
				
				$_POST['course_content']=$_POST['course_content'];
				$_POST['content_page_2']=$_POST['content_page_2'];
				
		
				$cms->sqlquery("rs","tnc_content",$_POST, 'id', $pid);
				//print_r($_POST);die;
			}
		}
	$adm->sessset('Record has been updated', 's');
	//$cms->redir(SITE_PATH_ADM.CPAGE.'?mode=edit&courseId='.$_GET['courseId'], true);
	$path = SITE_PATH_ADM."praposal-t-n-c/?mode=edit&courseId=1";
	$cms->redir($path, true);
} 
	
	$cStepQry = $cms->db_query("select * from #_tnc_content where id=".$_GET['courseId']." AND is_deleted=0 ");
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
			
			<!--<div class="clearfix"></div>
			<div class="form-group col-sm-6">
				<label for="step_title" class="control-label">Content Title*</label>
				<input type="text" name="step_title" value="<?=$cStepRes['step_title']?>" class="form-control" id="step_title" placeholder="Content Title" data-fv-regexp="true" data-error="Please enter Content title" required>
				<div class="help-block with-errors"></div>
			</div>-->
			<div class="clearfix"></div>
			<?php } ?>
			
			<div class="clearfix"></div>
			<input type="hidden" name="edit_row[]" value="<?=$cStepRes['id']?>">
			<!--<div class="form-group col-sm-6">
					<label for="content_title" class="control-label">Content Titles*</label>
					<input type="text" name="content_title<?=$cStepRes['id']?>" value="<?=$cStepRes['content_title']?>" class="form-control" id="content_title" placeholder="Content Title" data-fv-regexp="true" data-error="Please enter content title" required>
					<div class="help-block with-errors"></div>
				</div>-->
			<div class="clearfix"></div>
			<?php //if($cStepRes['course_content']!=''){ ?>
			<div class="show-course-content">
				<div class="form-group col-sm-6">
					<label for="content_title" class="control-label">Page-1</label>
				</div>				

				<div class="form-group col-sm-12">
					<?=$adm->get_editor_s('course_content', $cms->removeSlash($cStepRes['course_content']))?>
					<div class="help-block with-errors"></div>
				</div>	
			</div>
			<div class="clearfix"></div>
			<hr>
			<?php //} ?>
			<div class="clearfix"></div>
			
			
			<?php //if($cStepRes['content_page_2']==''){ ?>
			<div class="show-course-content">
				<div class="form-group col-sm-6">
					<label for="content_title" class="control-label">Page -2</label>
				</div>				

				<div class="form-group col-sm-12">
					<?=$adm->get_editor_s('content_page_2', $cms->removeSlash($cStepRes['content_page_2']))?>
					<div class="help-block with-errors"></div>
				</div>	
			</div>
			<div class="clearfix"></div>
			<hr>
			<?php //} ?>
			
			
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
<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 
$pid = $_GET["id"];
if($cms->is_post_back()){ 
	if($_FILES["project_img"]["name"]){ 
		$_POST["project_img"] = uploadImage("project_img","project");
	}
	
	if($pid){ 
		$cms->sqlquery("rs","recent_projects",$_POST,'id',$pid);
		$adm->sessset('Record has been updated', 's');
	} else { 
		$cms->sqlquery("rs","recent_projects",$_POST);
		$adm->sessset('Record has been added', 's');
	}	
	$cms->redir(SITE_PATH_ADM.CPAGE, true);
}	
if(isset($pid)){
	$rsAdmin=$cms->db_query("select * from #_recent_projects where id='".$pid."'");
	$arrAdmin=$cms->db_fetch_array($rsAdmin);
	@extract($arrAdmin);
}
?>
<!-- .row -->
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">	
			<?=$cms->sform((($mode)?'onsubmit="return formvalid(this)"':'onsubmit="return formvalid(this)"'));?>
			<ul class="nav customtab2 nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#eng" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"> English</span></a></li>
				<li role="presentation" class=""><a href="#swe" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Swedish</span></a></li>
			</ul>
            <!-- Tab panes -->
            <div class="tab-content">
				<div role="tabpanel" class="tab-pane fade active in" id="eng">
					<div class="form-group col-sm-6">
						<label for="project_name" class="control-label">Project Name*</label>
						<input type="text" name="project_name" value="<?=$project_name?>" class="form-control" id="project_name" placeholder="Project Name" data-fv-regexp="true" data-error="Please enter value" required> 
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group col-sm-6">
						<label for="project_type" class="control-label">Project Type*</label>
						<input type="text" name="project_type" value="<?=$project_type?>" class="form-control" id="project_type" placeholder="Project Type" data-fv-regexp="true" data-error="Please enter value" required> 
						<div class="help-block with-errors"></div>
					</div>	
					<div class="form-group col-sm-6">
						<label for="project_img" class="control-label">Project Image (360px X 183px) (Only jpg, png)</label>
						<input type="file" name="project_img" id="input-file-max-fs" class="dropify" data-max-file-size="1M" data-height="150" <?php if($project_img AND file_exists(FILES_PATH.'project/'.$project_img)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/project/<?=$project_img?>" <?php } ?> />
						<div class="help-block with-errors"></div>
					</div>	
					<div class="clearfix"></div>
					<div class="form-group col-sm-12">
						<button type="submit" class="btn btn-primary">Submit</button>
						<button type="button" onclick="history.go(-1)" class="btn btn-primary">Back</button>
					</div>
					<div class="clearfix"></div>
				</div>
				<div role="tabpanel" class="tab-pane fade" id="swe">
					<div class="form-group col-sm-6">
						<label for="project_name_sw" class="control-label">Project Name*</label>
						<input type="text" name="project_name_sw" value="<?=$project_name_sw?>" class="form-control" id="project_name_sw" placeholder="Project Name" data-fv-regexp="true" data-error="Please enter value" required> 
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group col-sm-6">
						<label for="project_type_sw" class="control-label">Project Type*</label>
						<input type="text" name="project_type_sw" value="<?=$project_type_sw?>" class="form-control" id="project_type_sw" placeholder="Project Type" data-fv-regexp="true" data-error="Please enter value" required> 
						<div class="help-block with-errors"></div>
					</div>	
					<div class="form-group col-sm-12">
						<button type="submit" class="btn btn-primary">Submit</button>
						<button type="button" onclick="history.go(-1)" class="btn btn-primary">Back</button>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<?=$cms->eform();?>
        </div>
	</div>
</div>
<!-- /.row -->
    
 

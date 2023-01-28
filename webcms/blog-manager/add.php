<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 
$pid = $_GET["id"];
if($cms->is_post_back()){ 
	
	if($_FILES["blog_image"]["name"]){ 
		$_POST["blog_image"] = uploadImage("blog_image","blog");
	}
	if(count($_POST["cat_id"])>0){
		$_POST["cat_id"] = implode(",", $_POST["cat_id"]);
	}
	/*if($_POST["tag_id"]){
		$_POST["tag_id"]=str_replace(" ","-",$_POST["tag_id"]);
	}*/
	
	$_POST['url'] = $cms->baseurl($_POST['title']);
	if($pid){ 
	   	$_POST['modified'] = date("Y-m-d h:i:s");
		$cms->sqlquery("rs","blogs",$_POST,'id',$pid);
		$adm->sessset('Record has been updated', 's');
	} else { 
		if(empty($_POST["post_date"])){
			$_POST['post_date'] = date("Y-m-d");
		}
		$_POST['modified'] = date("Y-m-d h:i:s");
		$_POST['post_by'] = $_SESSION["ses_adm_id"];
		$cms->sqlquery("rs","blogs",$_POST);
		$adm->sessset('Record has been added', 's');
	}	
	$cms->redir(SITE_PATH_ADM.CPAGE, true);
}	
if(isset($pid)){
	$rsAdmin=$cms->db_query("select * from #_blogs where id='".$pid."'");
	$arrAdmin=$cms->db_fetch_array($rsAdmin);
	@extract($arrAdmin);
}
?>

	<script src="../../ckeditor/ckeditor.js"></script>
	<script src="../../ckeditor/samples/js/sample.js"></script>
<!-- .row -->
<style>
.bootstrap-tagsinput{
	width:100%;
}
</style>
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
						<label for="title" class="control-label">Title*</label>
						<input type="text" name="title" value="<?=$title?>" onBlur="getUrl('from_url','to_url')" class="form-control from_url" id="title" placeholder="Title" data-fv-regexp="true"  data-error="Please enter valid Title" title="Title" required> 
						<div class="help-block with-errors"></div>
					</div>	
					<div class="clearfix"></div>
					<div class="form-group col-sm-12">
						<label for="inputEmail" class="control-label">Page Content*</label>
						<?//$adm->get_editor_s('blog_content', $cms->removeSlash($blog_content))?>
						
						<div id="editor">
							<?=$blog_content?>
						</div>
						<div class="help-block with-errors"></div>
					</div>	
					<div class="clearfix"></div>
					<div class="form-group col-sm-6">
						<label for="cat_id" class="control-label">Categories</label>
						<?php $catSelectedValue = array(); 
						if($cat_id!=''){ 
							$catSelectedValue = explode(",", $cat_id);
						}
						?>
						<select class="select2 m-b-10 select2-multiple"  id="cat_id" multiple="multiple" data-placeholder="Choose Categories" name="cat_id[]">
						   <?php foreach($catArr as $catId=>$catName){?>
							<option value="<?=$catId?>" <?=(in_array($catId,$catSelectedValue)?'selected="selected"':'')?> ><?=$catName?></option>
						   <?php } ?>
						</select>
						<div class="help-block with-errors"></div>
					</div>	
					<div class="clearfix"></div>
					<div class="form-group col-sm-6">
						<label for="file" class="control-label">Feature Image (770px*515px)</label>
						
						<input type="file" name="blog_image" id="input-file-max-fs" class="dropify" data-max-file-size="1M" data-height="150" <?php if($blog_image AND file_exists(FILES_PATH.'blog/'.$blog_image)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/blog/<?=$blog_image?>" <?php }else{ ?> required <?php } ?> />
						<div class="help-block with-errors"></div>
					</div>
					<div class="clearfix"></div>
					<div class="form-group col-sm-6">
						<label for="title" class="control-label">Post Date</label>
						<input type="date" name="post_date" value="<?=$post_date?>" class="form-control datepicker" placeholder="Post Date" data-fv-regexp="true"> 
						<div class="help-block with-errors"></div>
					</div>
					<div class="clearfix"></div>
					<div class="form-group col-sm-6">
						<label for="inputEmail" class="control-label">Meta Title</label>
						<input type="text"  name="meta_title" value="<?=$meta_title?>"  class="form-control" id="meta_title" placeholder="Meta Title" data-fv-regexp="true"   data-error="Please enter valid Meta Title" title="Meta Title " > 
						<div class="help-block with-errors"></div>
					</div>	
					<div class="clearfix"></div>
					<div class="form-group col-sm-6">
						<label for="inputEmail" class="control-label">Meta Keyword</label>
						<input type="text"  name="meta_key" value="<?=$meta_key?>"  class="form-control" id="meta_key" placeholder="Meta Keyword" data-fv-regexp="true"  data-error="Please enter valid Meta Keyword" title="Meta Keyword" > 
						<div class="help-block with-errors"></div>
					</div>	
					<div class="clearfix"></div>
					<div class="form-group col-sm-6">
						<label for="inputEmail" class="control-label">Meta Description</label>
						<input type="text"  name="meta_description" value="<?=$meta_description?>"  class="form-control" id="meta_description" placeholder="Meta Description" data-fv-regexp="true"  data-error="Please enter valid Meta Description" title="Meta Description" > 
						<div class="help-block with-errors"></div>
					</div>	
					<div class="clearfix"></div>
					<div class="form-group col-sm-3">
						<label for="inputPassword" class="control-label">Status</label>
						<select class="form-control select2" name="status"  id="status" title="status" >
							<option value="1" <?=(($status=='1')?'selected="selected"':'')?>>Active</option>
							<option value="0" <?=(($status=='0')?'selected="selected"':'')?>>Inactive</option>
						</select>
					</div>
					<div class="clearfix"></div><br>
					<div class="form-group col-sm-12">
						<button type="submit" class="btn btn-primary">Submit</button>
						<button type="button" onclick="history.go(-1)" class="btn btn-primary">Back</button>
					</div>
					<div class="clearfix"></div>
				</div>
				<div role="tabpanel" class="tab-pane fade" id="swe">
					<div class="form-group col-sm-6">
						<label for="title_sw" class="control-label">Title*</label>
						<input type="text" name="title_sw" value="<?=$title_sw?>" onBlur="getUrl('from_url','to_url')" class="form-control from_url" id="title_sw" placeholder="Title" data-fv-regexp="true"  data-error="Please enter valid Title" title="Title" required> 
						<div class="help-block with-errors"></div>
					</div>	
					<div class="clearfix"></div>
					<!--<div class="form-group col-sm-6">
						<label for="title" class="control-label">URL*</label>
						<input type="text"  name="url" value="<?=$url?>"  class="form-control to_url" id="" placeholder="URL" data-fv-regexp="true"  data-error="Please enter valid url" title="URL" required> 
						<div class="help-block with-errors"></div>
					</div>	
					<div class="clearfix"></div>-->
					<!--<div class="form-group col-sm-6">
						<label for="title" class="control-label">Short Description</label>
						<input type="text"  name="short_desc" value="<?=$short_desc?>"  class="form-control" placeholder="Short Description" data-fv-regexp="true"> 
						<div class="help-block with-errors"></div>
					</div>-->
					<div class="clearfix"></div>
					<div class="form-group col-sm-12">
						<label for="blog_content_sw" class="control-label">Page Content*</label>
						<?=$adm->get_editor_s('blog_content_sw', $cms->removeSlash($blog_content_sw))?>
						<div class="help-block with-errors"></div>
					</div>	
					<div class="clearfix"></div>
					<div class="form-group col-sm-6">
						<label for="cat_id" class="control-label">Categories</label>
						<?php $catSelectedValue = array(); 
						if($cat_id!=''){ 
							$catSelectedValue = explode(",", $cat_id);
						}
						?>
						<select class="select2 m-b-10 select2-multiple"  id="cat_id" multiple="multiple" data-placeholder="Choose Categories" name="cat_id[]">
						   <?php foreach($catArr as $catId=>$catName){?>
							<option value="<?=$catId?>" <?=(in_array($catId,$catSelectedValue)?'selected="selected"':'')?> ><?=$catName?></option>
						   <?php } ?>
						</select>
						<div class="help-block with-errors"></div>
					</div>	
					<div class="clearfix"></div>
					
					<!--<div class="form-group col-sm-6">
						<label for="tag_id" class="control-label">Tags</label>
						<?php /*$tagSelectedValue = array(); 
						if($tag_id!=''){ 
							$tagSelectedValue = explode(",", $tag_id);
						}
						?>
						<select class="select2 m-b-10 select2-multiple"  id="tag_id" multiple="multiple" data-placeholder="Choose Tags" name="tag_id[]">
						   <?php foreach($tagArr as $tagId=>$tagName){?>
							<option value="<?=$tagId?>" <?=(in_array($tagId,$tagSelectedValue)?'selected="selected"':'')?> ><?=$tagName?></option>
						   <?php } ?>
						</select>
						<div class="help-block with-errors"></div>
					</div>
					<!--<div class="form-group col-sm-6">
						<label for="tag_id" class="control-label">Tags</label>
						<?php /*$tagSelectedValue = array(); 
						if($tag_id!=''){ 
							$tagSelectedValue = explode(",", $tag_id);
						}*/
						?>
						 <div class="form-group col-sm-12 input-group m-b-30">
							<input type="text" value="<?=$tag_id?>" class="form-control" name="tag_id" data-role="tagsinput" placeholder="add tags">
						</div>
						<div class="help-block with-errors"></div>
					</div>	-->
					<div class="clearfix"></div>
					<div class="form-group col-sm-6">
						<label for="file" class="control-label">Feature Image (770px*515px)</label>
						<input type="file" name="file" id="input-file-max-fs" class="dropify" data-max-file-size="1M" data-height="150" <?php if($blog_image AND file_exists(FILES_PATH.'blog/'.$blog_image)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/blog/<?=$blog_image?>" <?php } ?> />
						<div class="help-block with-errors"></div>
					</div>
					<!--<div class="clearfix"></div>
					<div class="form-group col-sm-6">
						<label for="title" class="control-label">Image Alt</label>
						<input type="text"  name="image_alt" value="<?=$image_alt?>"  class="form-control" placeholder="Image Alt" data-fv-regexp="true"> 
						<div class="help-block with-errors"></div>
					</div>-->
					<div class="clearfix"></div>
					<div class="form-group col-sm-6">
						<label for="title" class="control-label">Post Date</label>
						<input type="date" name="post_date" value="<?=$post_date?>" class="form-control datepicker" placeholder="Post Date" data-fv-regexp="true"> 
						<div class="help-block with-errors"></div>
					</div>
					<div class="clearfix"></div>
					<div class="form-group col-sm-6">
						<label for="inputEmail" class="control-label">Meta Title</label>
						<input type="text"  name="meta_title" value="<?=$meta_title?>"  class="form-control" id="meta_title" placeholder="Meta Title" data-fv-regexp="true"   data-error="Please enter valid Meta Title" title="Meta Title " > 
						<div class="help-block with-errors"></div>
					</div>	
					<div class="clearfix"></div>
					<div class="form-group col-sm-6">
						<label for="inputEmail" class="control-label">Meta Keyword</label>
						<input type="text"  name="meta_key" value="<?=$meta_key?>"  class="form-control" id="meta_key" placeholder="Meta Keyword" data-fv-regexp="true"  data-error="Please enter valid Meta Keyword" title="Meta Keyword" > 
						<div class="help-block with-errors"></div>
					</div>	
					<div class="clearfix"></div>
					<div class="form-group col-sm-6">
						<label for="inputEmail" class="control-label">Meta Description</label>
						<input type="text"  name="meta_description" value="<?=$meta_description?>"  class="form-control" id="meta_description" placeholder="Meta Description" data-fv-regexp="true"  data-error="Please enter valid Meta Description" title="Meta Description" > 
						<div class="help-block with-errors"></div>
					</div>	
					<div class="clearfix"></div>
					<div class="form-group col-sm-3">
						<label for="inputPassword" class="control-label">Status</label>
						<select class="form-control select2" name="status"  id="status" title="status" >
							<option value="1" <?=(($status=='1')?'selected="selected"':'')?>>Active</option>
							<option value="0" <?=(($status=='0')?'selected="selected"':'')?>>Inactive</option>
						</select>
					</div>
					<div class="clearfix"></div><br>
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
    
<script>
	initSample();
</script>
 

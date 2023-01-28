<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 

if($cms->is_post_back()){ 
	if($_FILES["banner"]["name"]){ 
		$_POST["banner"] = uploadImage("banner","career");
	}
	if($_FILES["sec2_img"]["name"]){ 
		$_POST["sec2_img"] = uploadImage("sec2_img","career");
	}
	
	$cms->sqlquery("rs","career",$_POST,'id',1);
	$adm->sessset('Record has been updated', 's');
	
	//$cms->redir(SITE_PATH_ADM.CPAGE.'?mode=add&id='.$uids, true);
	$cms->redir(SITE_PATH_ADM.CPAGE, true);
}	

$rsAdmin=$cms->db_query("select * from #_career where id='1'");
$arrAdmin=$cms->db_fetch_array($rsAdmin);
@extract($arrAdmin);

?>
<div class="row">
	<div class="col-sm-12">
		<div class="white-box">
			<?=$cms->sform((($mode)?'onsubmit="return formvalid(this)"':'onsubmit="return formvalid(this)"'));?>
			<div class="form-group col-sm-9">&nbsp;</div>
			<div class="form-group col-sm-3 text-right pull-right">
                <button type="submit" class="btn btn-primary" id="submit_btn">Publish</button>
                <button type="button" onclick="history.go(-1)" class="btn btn-primary">Back</button>
            </div>
			<div class="clearfix"></div>
			<ul class="nav customtab2 nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#eng" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"> English</span></a></li>
				<li role="presentation" class=""><a href="#swe" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Swedish</span></a></li>
			</ul>
            <!-- Tab panes -->
            <div class="tab-content">
				<div role="tabpanel" class="tab-pane fade active in" id="eng">
					<div class="form-group">
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultOne" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleCollapseDefaultOne">Banner </a> 
								</div>
								<div class="panel-collapse collapse in" id="exampleCollapseDefaultOne" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
									<div class="panel-body">
										<div class="col-sm-6">
											<label for="banner" class="control-label">Banner Image (1440px X 700px) (Only jpg, png)</label>
											<input type="file" name="banner" id="input-file-max-fs" class="dropify" data-max-file-size="1M" data-height="150" <?php if($banner AND file_exists(FILES_PATH.'career/'.$banner)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/career/<?=$banner?>" <?php } ?> />
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>
										
										<div class="col-sm-6">
											<label for="banner_text" class="control-label">Banner Text</label>
											<textarea name="banner_text" id="banner_text" class="form-control"><?=$banner_text?></textarea>
										</div>
										<div class="col-sm-6">
											<label for="banner_text2" class="control-label">Banner Text 2</label>
											<textarea name="banner_text2" id="banner_text2" class="form-control" class="textareas"><?=$banner_text2?></textarea>
										</div>
										<div class="clearfix"></div>
										<div class="col-sm-6">
											<label for="btn_text" class="control-label">Button Text*</label>
											<input type="text" name="btn_text" value="<?=$btn_text?>" class="form-control" id="btn_text" placeholder="Button Text" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="col-sm-6">
											<label for="btn_link" class="control-label">Button Link*</label>
											<input type="text" name="btn_link" value="<?=$btn_link?>" class="form-control" id="btn_text" placeholder="Button Link" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultTwo" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleCollapseDefaultTwo">Section 1</a> 
								</div>
								<div class="panel-collapse collapse" id="exampleCollapseDefaultTwo" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
									<div class="panel-body">
										<div class="col-sm-6">
											<label for="sec1_main_heading" class="control-label">Main Heading</label>
											<textarea name="sec1_main_heading" id="sec1_main_heading" class="form-control"><?=$sec1_main_heading?></textarea>
										</div>
										<div class="clearfix"></div>
										<div class="col-sm-6">									
											<label for="sec1_content" class="control-label">Content</label>
											<textarea name="sec1_content" id="sec1_content" class="ckeditor"><?=$sec1_content?></textarea>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
					</div>			           
				</div>	
				<div role="tabpanel" class="tab-pane fade" id="swe">
					<div class="form-group">
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#careerAccSE1" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="careerAccSE1">Banner </a> 
								</div>
								<div class="panel-collapse collapse in" id="careerAccSE1" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
									<div class="panel-body">										
										<div class="col-sm-6">
											<label for="banner_text_sw" class="control-label">Banner Text</label>
											<textarea name="banner_text_sw" id="banner_text_sw" class="form-control"><?=$banner_text_sw?></textarea>
										</div>
										<div class="col-sm-6">
											<label for="banner_text2_sw" class="control-label">Banner Text 2</label>
											<textarea name="banner_text2_sw" id="banner_text2_sw" class="form-control" class="textareas"><?=$banner_text2_sw?></textarea>
										</div>
										<div class="clearfix"></div>
										<div class="col-sm-6">
											<label for="btn_text_sw" class="control-label">Button Text*</label>
											<input type="text" name="btn_text_sw" value="<?=$btn_text_sw?>" class="form-control" id="btn_text_sw" placeholder="Button Text" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="col-sm-6">
											<label for="btn_link_sw" class="control-label">Button Link*</label>
											<input type="text" name="btn_link_sw" value="<?=$btn_link_sw?>" class="form-control" id="btn_link_sw" placeholder="Button Link" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#careerAccSE2" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="careerAccSE2">Section 1</a> 
								</div>
								<div class="panel-collapse collapse" id="careerAccSE2" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
									<div class="panel-body">
										<div class="col-sm-6">
											<label for="sec1_main_heading_sw" class="control-label">Main Heading</label>
											<textarea name="sec1_main_heading_sw" id="sec1_main_heading_sw" class="form-control"><?=$sec1_main_heading_sw?></textarea>
										</div>
										<div class="clearfix"></div>
										<div class="col-sm-6">									
											<label for="sec1_content_sw" class="control-label">Content</label>
											<textarea name="sec1_content_sw" id="sec1_content_sw" class="ckeditor"><?=$sec1_content_sw?></textarea>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>			           
			<?=$cms->eform();?>
		</div>
	</div>
</div>
<!-- /.row -->
<script>
 function changeMethod() {
	$("#aforms").attr("method", "get");
}
</script>	
<script type="text/javascript">
	function updateStatus(id,current_status){
		$.ajax({
			url:"<?=SITE_PATH_ADM.CPAGE?>/ajaxChangeStatus.php",
			data:"id="+id+"&status="+current_status,
			method:"post"
		})
	}
</script>
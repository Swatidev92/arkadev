<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 

if($cms->is_post_back()){ 
	if($_FILES["banner"]["name"]){ 
		$_POST["banner"] = uploadImage("banner","solar");
	}
	if($_FILES["sec1_icon1"]["name"]){ 
		$_POST["sec1_icon1"] = uploadImage("sec1_icon1","solar");
	}
	if($_FILES["sec1_icon2"]["name"]){ 
		$_POST["sec1_icon2"] = uploadImage("sec1_icon2","solar");
	}
	if($_FILES["sec1_icon3"]["name"]){ 
		$_POST["sec1_icon3"] = uploadImage("sec1_icon3","solar");
	}
	if($_FILES["sec1_icon4"]["name"]){ 
		$_POST["sec1_icon4"] = uploadImage("sec1_icon4","solar");
	}
	if($_FILES["sec2_img1"]["name"]){ 
		$_POST["sec2_img1"] = uploadImage("sec2_img1","solar");
	}
	if($_FILES["sec2_img2"]["name"]){ 
		$_POST["sec2_img2"] = uploadImage("sec2_img2","solar");
	}
	if($_FILES["sec2_img3"]["name"]){ 
		$_POST["sec2_img3"] = uploadImage("sec2_img3","solar");
	}
	if($_FILES["sec3_icon1"]["name"]){ 
		$_POST["sec3_icon1"] = uploadImage("sec3_icon1","solar");
	}
	if($_FILES["sec3_icon2"]["name"]){ 
		$_POST["sec3_icon2"] = uploadImage("sec3_icon2","solar");
	}
	if($_FILES["sec3_icon3"]["name"]){ 
		$_POST["sec3_icon3"] = uploadImage("sec3_icon3","solar");
	}
		
	$cms->sqlquery("rs","solar",$_POST,'id',1);
	$adm->sessset('Record has been updated', 's');
	
	$cms->redir(SITE_PATH_ADM.CPAGE, true);
}	

$rsAdmin=$cms->db_query("select * from #_solar where id='1'");
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
									<a class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultOne" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleCollapseDefaultOne">Solar Banner </a> 
								</div>
								<div class="panel-collapse collapse in" id="exampleCollapseDefaultOne" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
									<div class="panel-body">
										<div class="form-group col-sm-6">
											<label for="banner" class="control-label">Banner Image (1440px X 700px) (Only jpg, png)</label>
											<input type="file" name="banner" id="input-file-max-fs" class="dropify" data-max-file-size="1M" data-height="150" <?php if($banner AND file_exists(FILES_PATH.'solar/'.$banner)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/solar/<?=$banner?>" <?php } ?> />
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>										
										<div class="form-group col-sm-6">
											<label for="banner" class="control-label">Banner Text</label>
											<textarea name="banner_text" id="banner_text" class="form-control"><?=$banner_text?></textarea>
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
											<label for="sec1_sub_heading" class="control-label">Sub Heading*</label>
											<input type="text" name="sec1_sub_heading" value="<?=$sec1_sub_heading?>" class="form-control" id="sec1_sub_heading" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>
										
										<div class="col-sm-3">
											<label for="sec1_icon1" class="control-label">Icon 1</label>
											<input type="file" name="sec1_icon1" id="input-file-max-fs" class="dropify" data-max-file-size="1M" data-height="150" <?php if($sec1_icon1 AND file_exists(FILES_PATH.'solar/'.$sec1_icon1)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/solar/<?=$sec1_icon1?>" <?php } ?> />
											<div class="help-block with-errors"></div>
											
											<label for="sec1_title1" class="control-label">Title 1*</label>
											<input type="text" name="sec1_title1" value="<?=$sec1_title1?>" class="form-control" id="sec1_title1" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec1_content1" class="control-label">Content 1</label>
											<textarea name="sec1_content1" id="sec1_content1" class="form-control" rows="6"><?=$sec1_content1?></textarea>
										</div>
										<div class="col-sm-3">
											<label for="sec1_icon2" class="control-label">Icon 2</label>
											<input type="file" name="sec1_icon2" id="input-file-max-fs" class="dropify" data-max-file-size="1M" data-height="150" <?php if($sec1_icon2 AND file_exists(FILES_PATH.'solar/'.$sec1_icon2)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/solar/<?=$sec1_icon2?>" <?php } ?> />
											<div class="help-block with-errors"></div>
											
											<label for="sec1_title2" class="control-label">Title 2*</label>
											<input type="text" name="sec1_title2" value="<?=$sec1_title2?>" class="form-control" id="sec1_title2" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec1_content2" class="control-label">Content 2</label>
											<textarea name="sec1_content2" id="sec1_content2" class="form-control" rows="6"><?=$sec1_content2?></textarea>
										</div>
										<div class="col-sm-3">
											<label for="banner" class="control-label">Icon 3</label>
											<input type="file" name="sec1_icon3" id="input-file-max-fs" class="dropify" data-max-file-size="1M" data-height="150" <?php if($sec1_icon3 AND file_exists(FILES_PATH.'solar/'.$sec1_icon3)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/solar/<?=$sec1_icon3?>" <?php } ?> />
											<div class="help-block with-errors"></div>
											
											<label for="sec1_title3" class="control-label">Title 3*</label>
											<input type="text" name="sec1_title3" value="<?=$sec1_title3?>" class="form-control" id="sec1_title3" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec1_content3" class="control-label">Content 3</label>
											<textarea name="sec1_content3" id="sec1_content3" class="form-control" rows="6"><?=$sec1_content3?></textarea>
										</div>
										
										<div class="col-sm-3">
											<label for="banner" class="control-label">Icon 4</label>
											<input type="file" name="sec1_icon4" id="input-file-max-fs" class="dropify" data-max-file-size="1M" data-height="150" <?php if($sec1_icon4 AND file_exists(FILES_PATH.'solar/'.$sec1_icon4)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/solar/<?=$sec1_icon4?>" <?php } ?> />
											<div class="help-block with-errors"></div>
											
											<label for="sec1_title4" class="control-label">Title 4*</label>
											<input type="text" name="sec1_title4" value="<?=$sec1_title4?>" class="form-control" id="sec1_title4" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
																						
											<label for="sec1_content4" class="control-label">Content 4</label>
											<textarea name="sec1_content4" id="sec1_content4" class="form-control" rows="6"><?=$sec1_content4?></textarea>
										</div>
										<div class="clearfix"></div>
										
										<div class="col-sm-3">											
											<label for="sec1_btn_text" class="control-label">Button Text</label>
											<input type="text" name="sec1_btn_text" value="<?=$sec1_btn_text?>" class="form-control" id="sec1_btn_text" required> 
										</div>
										<div class="col-sm-6">											
											<label for="sec1_btn_link" class="control-label">Button Link</label>
											<select class="form-control" name="sec1_btn_link" id="sec1_btn_link">
												<option value="">Select Link</option>
												<?php $pageQrySe = $cms->db_query("SELECT id, menu_title FROM #_menu LIMIT 10 ");
													while($pageArrSe = $pageQrySe->fetch_array()){
												?>												
												<option value="<?=$pageArrSe['id']?>" <?=$pageArrSe['id']==$sec1_btn_link?'selected':''?>><?=$pageArrSe['menu_title']?></option>
													<?php } ?>
											</select>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultThree" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleCollapseDefaultThree">Section 2</a> 
								</div>
								<div class="panel-collapse collapse" id="exampleCollapseDefaultThree" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
									<div class="panel-body">
										<div class="col-sm-6">
											<label for="sec2_main_heading" class="control-label">Main Heading*</label>
											<input type="text" name="sec2_main_heading" value="<?=$sec2_main_heading?>" class="form-control" id="sec2_main_heading" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>
										
										<div class="col-sm-4">			
											<label for="sec2_title1" class="control-label">Title 1*</label>
											<input type="text" name="sec2_title1" value="<?=$sec2_title1?>" class="form-control" id="sec2_title1" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
												
											<label for="panel_capacity1" class="control-label">Panel type Watts</label>
											<input type="text" name="panel_capacity1" value="<?=$panel_capacity1?>" class="form-control" id="panel_capacity1" data-fv-regexp="true" data-error="Panel type Watts" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec2_img1" class="control-label">Image 1 (305px X 415px) (Only jpg, png)</label>
											<input type="file" name="sec2_img1" id="input-file-max-fs" class="dropify" data-max-file-size="1M" data-height="150" <?php if($sec2_img1 AND file_exists(FILES_PATH.'solar/'.$sec2_img1)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/solar/<?=$sec2_img1?>" <?php } ?> />
											<div class="help-block with-errors"></div>
											
											
											<label for="sec2_panel1" class="control-label">Content *</label>
											<textarea name="sec2_panel1" id="sec2_panel1" data-fv-regexp="true" class="ckeditor"><?=$sec2_panel1?></textarea>
											<div class="help-block with-errors"></div>
										</div>
										<div class="col-sm-4">
											<label for="sec2_title2" class="control-label">Title 2*</label>
											<input type="text" name="sec2_title2" value="<?=$sec2_title2?>" class="form-control" id="sec2_title2" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="panel_capacity2" class="control-label">Panel type Watts</label>
											<input type="text" name="panel_capacity2" value="<?=$panel_capacity2?>" class="form-control" id="panel_capacity2" data-fv-regexp="true" data-error="Panel type Watts" required> 
											<div class="help-block with-errors"></div>
											
											
											<label for="sec2_img2" class="control-label">Image 2 (305px X 415px) (Only jpg, png)</label>
											<input type="file" name="sec2_img2" id="input-file-max-fs" class="dropify" data-max-file-size="1M" data-height="150" <?php if($sec2_img2 AND file_exists(FILES_PATH.'solar/'.$sec2_img2)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/solar/<?=$sec2_img2?>" <?php } ?> />
											<div class="help-block with-errors"></div>
											
											<label for="sec2_panel2" class="control-label">Content *</label>
											<textarea name="sec2_panel2" id="sec2_panel2" data-fv-regexp="true" class="ckeditor"><?=$sec2_panel2?></textarea>
											<div class="help-block with-errors"></div>
										</div>
										<div class="col-sm-4">
											<label for="sec2_title3" class="control-label">Title 3*</label>
											<input type="text" name="sec2_title3" value="<?=$sec2_title3?>" class="form-control" id="sec2_title3" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											
											<label for="panel_capacity3" class="control-label">Panel type Watts</label>
											<input type="text" name="panel_capacity3" value="<?=$panel_capacity3?>" class="form-control" id="panel_capacity3" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											
											<label for="sec2_img3" class="control-label">Image 3 (305px X 415px) (Only jpg, png)</label>
											<input type="file" name="sec2_img3" id="input-file-max-fs" class="dropify" data-max-file-size="1M" data-height="150" <?php if($sec2_img3 AND file_exists(FILES_PATH.'solar/'.$sec2_img3)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/solar/<?=$sec2_img3?>" <?php } ?> />
											<div class="help-block with-errors"></div>
											
											<label for="sec2_panel3" class="control-label">Content *</label>
											<textarea name="sec2_panel3" id="sec2_panel3" data-fv-regexp="true" class="ckeditor"><?=$sec2_panel3?></textarea>
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
						
						<!--<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#exampleHeadingDefaultFour" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleHeadingDefaultFour">Section 3</a> 
								</div>
								<div class="panel-collapse collapse" id="exampleHeadingDefaultFour" aria-labelledby="exampleHeadingDefaultFour" role="tabpanel">
									<div class="panel-body">
										<div class="col-sm-6">
											<label for="sec3_main_heading" class="control-label">Main Heading*</label>
											<input type="text" name="sec3_main_heading" value="<?=$sec3_main_heading?>" class="form-control" id="sec3_main_heading" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>
										
										<div class="col-sm-4">
											<label for="sec3_icon1" class="control-label">Icon 1</label>
											<input type="file" name="sec3_icon1" id="input-file-max-fs" class="dropify" data-max-file-size="1M" data-height="150" <?php if($sec3_icon1 AND file_exists(FILES_PATH.'solar/'.$sec3_icon1)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/solar/<?=$sec3_icon1?>" <?php } ?> />
											<div class="help-block with-errors"></div>
											
											<label for="sec3_title1" class="control-label">Title 1*</label>
											<input type="text" name="sec3_title1" value="<?=$sec3_title1?>" class="form-control" id="sec3_title1" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec3_content1" class="control-label">Content 1</label>
											<textarea name="sec3_content1" id="sec3_content1" class="form-control" rows="6"><?=$sec3_content1?></textarea>
										</div>
										<div class="col-sm-4">
											<label for="sec3_icon2" class="control-label">Icon 2</label>
											<input type="file" name="sec3_icon2" id="input-file-max-fs" class="dropify" data-max-file-size="1M" data-height="150" <?php if($sec3_icon2 AND file_exists(FILES_PATH.'solar/'.$sec3_icon2)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/solar/<?=$sec3_icon2?>" <?php } ?> />
											<div class="help-block with-errors"></div>
											
											<label for="sec3_title2" class="control-label">Title 2*</label>
											<input type="text" name="sec3_title2" value="<?=$sec3_title2?>" class="form-control" id="sec3_title2" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec3_content2" class="control-label">Content 2</label>
											<textarea name="sec3_content2" id="sec3_content2" class="form-control" rows="6"><?=$sec3_content2?></textarea>
										</div>
										<div class="col-sm-4">
											<label for="sec3_icon3" class="control-label">Icon 3</label>
											<input type="file" name="sec3_icon3" id="input-file-max-fs" class="dropify" data-max-file-size="1M" data-height="150" <?php if($sec3_icon3 AND file_exists(FILES_PATH.'solar/'.$sec3_icon3)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/solar/<?=$sec3_icon3?>" <?php } ?> />
											<div class="help-block with-errors"></div>
											
											<label for="sec3_title3" class="control-label">Title 3*</label>
											<input type="text" name="sec3_title3" value="<?=$sec3_title3?>" class="form-control" id="sec3_title3" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec3_content3" class="control-label">Content 3</label>
											<textarea name="sec3_content3" id="sec3_content3" class="form-control" rows="6"><?=$sec3_content3?></textarea>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>-->
						
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#exampleHeadingDefaultNine" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleHeadingDefaultNine">Section 4</a> 
								</div>
								<div class="panel-collapse collapse" id="exampleHeadingDefaultNine" aria-labelledby="exampleHeadingDefaultNine" role="tabpanel">
									<div class="panel-body">
										<div class="form-group col-sm-6">
											<label for="sec4_sub_heading" class="control-label">Sub Heading*</label>
											<input type="text" name="sec4_sub_heading" value="<?=$sec4_sub_heading?>" class="form-control" id="sec4_sub_heading" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>
										<div class="form-group col-sm-6">
											<a class="btn view-list-btn" href="<?=SITE_PATH_ADM?>project-manager">View All Projects</a>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#solarMeta" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="solarMeta">Meta Manager</a> 
								</div>
								<div class="panel-collapse collapse" id="solarMeta" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
									<div class="panel-body">
										<div class="form-group col-sm-12">											
											<label for="meta_title" class="control-label">Meta Title</label>
											<textarea name="meta_title" id="meta_title" class="form-control"><?=$meta_title?></textarea>
										</div>
										<div class="form-group col-sm-12">											
											<label for="meta_description" class="control-label">Meta Description</label>
											<textarea name="meta_description" id="meta_description" class="form-control"><?=$meta_description?></textarea>
										</div>
										<div class="form-group col-sm-12">											
											<label for="meta_key" class="control-label">Meta Key</label>
											<textarea name="meta_key" id="meta_key" class="form-control"><?=$meta_key?></textarea>
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
									<a class="panel-title collapsed" data-toggle="collapse" href="#solarOneSW" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="solarOneSW">Home Banner </a> 
								</div>
								<div class="panel-collapse collapse in" id="solarOneSW" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
									<div class="panel-body">										
										<div class="form-group col-sm-6">
											<label for="banner" class="control-label">Banner Text</label>
											<textarea name="banner_text_sw" id="banner_text_sw" class="form-control"><?=$banner_text_sw?></textarea>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#solarTwoSW" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="solarTwoSW">Section 1</a> 
								</div>
								<div class="panel-collapse collapse" id="solarTwoSW" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
									<div class="panel-body">
										<div class="col-sm-6">
											<label for="sec1_sub_heading_sw" class="control-label">Sub Heading*</label>
											<input type="text" name="sec1_sub_heading_sw" value="<?=$sec1_sub_heading_sw?>" class="form-control" id="sec1_sub_heading_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>
										
										<div class="col-sm-3">											
											<label for="sec1_title1_sw" class="control-label">Title 1*</label>
											<input type="text" name="sec1_title1_sw" value="<?=$sec1_title1_sw?>" class="form-control" id="sec1_title1_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec1_content1_sw" class="control-label">Content 1</label>
											<textarea name="sec1_content1_sw" id="sec1_content1_sw" class="form-control" rows="6"><?=$sec1_content1_sw?></textarea>
										</div>
										<div class="col-sm-3">
											<label for="sec1_title2_sw" class="control-label">Title 2*</label>
											<input type="text" name="sec1_title2_sw" value="<?=$sec1_title2_sw?>" class="form-control" id="sec1_title2_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec1_content2_sw" class="control-label">Content 2</label>
											<textarea name="sec1_content2_sw" id="sec1_content2_sw" class="form-control" rows="6"><?=$sec1_content2_sw?></textarea>
										</div>
										<div class="col-sm-3">											
											<label for="sec1_title3_sw" class="control-label">Title 3*</label>
											<input type="text" name="sec1_title3_sw" value="<?=$sec1_title3_sw?>" class="form-control" id="sec1_title3_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec1_content3_sw" class="control-label">Content 3</label>
											<textarea name="sec1_content3_sw" id="sec1_content3_sw" class="form-control" rows="6"><?=$sec1_content3_sw?></textarea>
										</div>
										
										<div class="col-sm-3">											
											<label for="sec1_title4_sw" class="control-label">Title 4*</label>
											<input type="text" name="sec1_title4_sw" value="<?=$sec1_title4_sw?>" class="form-control" id="sec1_title4_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
																						
											<label for="sec1_content4_sw" class="control-label">Content 4</label>
											<textarea name="sec1_content4_sw" id="sec1_content4_sw" class="form-control" rows="6"><?=$sec1_content4_sw?></textarea>
										</div>
										<div class="clearfix"></div>
										
										<div class="col-sm-3">											
											<label for="sec1_btn_text_sw" class="control-label">Button Text</label>
											<input type="text" name="sec1_btn_text_sw" value="<?=$sec1_btn_text_sw?>" class="form-control" id="sec1_btn_text_sw" required> 
										</div>
										<div class="col-sm-6">											
											<label for="sec1_btn_link_sw" class="control-label">Button Link</label>									
											<select class="form-control" name="sec1_btn_link_sw" id="sec1_btn_link_sw">
												<option value="">Select Link</option>
												<?php $pageQrySe = $cms->db_query("SELECT id, menu_title_sw FROM #_menu LIMIT 10 ");
													while($pageArrSe = $pageQrySe->fetch_array()){
												?>												
												<option value="<?=$pageArrSe['id']?>" <?=$pageArrSe['id']==$sec1_btn_link_sw?'selected':''?>><?=$pageArrSe['menu_title_sw']?></option>
													<?php } ?>
											</select>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#solarThreeSW" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="solarThreeSW">Section 2</a> 
								</div>
								<div class="panel-collapse collapse" id="solarThreeSW" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
									<div class="panel-body">
										<div class="col-sm-6">
											<label for="sec2_main_heading_sw" class="control-label">Main Heading*</label>
											<input type="text" name="sec2_main_heading_sw" value="<?=$sec2_main_heading_sw?>" class="form-control" id="sec2_main_heading_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>
										
										<div class="col-sm-4">			
											<label for="sec2_title1_sw" class="control-label">Title 1*</label>
											<input type="text" name="sec2_title1_sw" value="<?=$sec2_title1_sw?>" class="form-control" id="sec2_title1_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
												
											<label for="panel_capacity1_sw" class="control-label">Panel type Watts</label>
											<input type="text" name="panel_capacity1_sw" value="<?=$panel_capacity1_sw?>" class="form-control" id="panel_capacity1_sw" data-fv-regexp="true" data-error="Panel type Watts" required> 
											<div class="help-block with-errors"></div>	
											
											<label for="sec2_panel1_sw" class="control-label">Content *</label>
											<textarea name="sec2_panel1_sw" id="sec2_panel1_sw" data-fv-regexp="true" class="ckeditor"><?=$sec2_panel1_sw?></textarea>
											<div class="help-block with-errors"></div>
										</div>
										<div class="col-sm-4">
											<label for="sec2_title2_sw" class="control-label">Title 2*</label>
											<input type="text" name="sec2_title2_sw" value="<?=$sec2_title2_sw?>" class="form-control" id="sec2_title2_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="panel_capacity2_sw" class="control-label">Panel type Watts</label>
											<input type="text" name="panel_capacity2_sw" value="<?=$panel_capacity2_sw?>" class="form-control" id="panel_capacity2_sw" data-fv-regexp="true" data-error="Panel type Watts" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec2_panel2_sw" class="control-label">Content *</label>
											<textarea name="sec2_panel2_sw" id="sec2_panel2_sw" data-fv-regexp="true" class="ckeditor"><?=$sec2_panel2_sw?></textarea>
											<div class="help-block with-errors"></div>
										</div>
										<div class="col-sm-4">
											<label for="sec2_title3_sw" class="control-label">Title 3*</label>
											<input type="text" name="sec2_title3_sw" value="<?=$sec2_title3_sw?>" class="form-control" id="sec2_title3_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											
											<label for="panel_capacity3_sw" class="control-label">Panel type Watts</label>
											<input type="text" name="panel_capacity3_sw" value="<?=$panel_capacity3_sw?>" class="form-control" id="panel_capacity3_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											
											<label for="sec2_panel3_sw" class="control-label">Content *</label>
											<textarea name="sec2_panel3_sw" id="sec2_panel3_sw" data-fv-regexp="true" class="ckeditor"><?=$sec2_panel3_sw?></textarea>
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
						
						<!--<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#solarFourSW" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="solarFourSW">Section 3</a> 
								</div>
								<div class="panel-collapse collapse" id="solarFourSW" aria-labelledby="exampleHeadingDefaultFour" role="tabpanel">
									<div class="panel-body">
										<div class="col-sm-6">
											<label for="sec3_main_heading_sw" class="control-label">Main Heading*</label>
											<input type="text" name="sec3_main_heading_sw" value="<?=$sec3_main_heading_sw?>" class="form-control" id="sec3_main_heading_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>
										
										<div class="col-sm-4">											
											<label for="sec3_title1_sw" class="control-label">Title 1*</label>
											<input type="text" name="sec3_title1_sw" value="<?=$sec3_title1_sw?>" class="form-control" id="sec3_title1_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec3_content1_sw" class="control-label">Content 1</label>
											<textarea name="sec3_content1_sw" id="sec3_content1_sw" class="form-control" rows="6"><?=$sec3_content1_sw?></textarea>
										</div>
										<div class="col-sm-4">											
											<label for="sec3_title2_sw" class="control-label">Title 2*</label>
											<input type="text" name="sec3_title2_sw" value="<?=$sec3_title2_sw?>" class="form-control" id="sec3_title2_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec3_content2_sw" class="control-label">Content 2</label>
											<textarea name="sec3_content2_sw" id="sec3_content2_sw" class="form-control" rows="6"><?=$sec3_content2_sw?></textarea>
										</div>
										<div class="col-sm-4">
											<label for="sec3_title3_sw" class="control-label">Title 3*</label>
											<input type="text" name="sec3_title3_sw" value="<?=$sec3_title3_sw?>" class="form-control" id="sec3_title3_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec3_content3_sw" class="control-label">Content 3</label>
											<textarea name="sec3_content3_sw" id="sec3_content3_sw" class="form-control" rows="6"><?=$sec3_content3_sw?></textarea>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>-->
						
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#solarFiveSW" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="solarFiveSW">Section 4</a> 
								</div>
								<div class="panel-collapse collapse" id="solarFiveSW" aria-labelledby="exampleHeadingDefaultNine" role="tabpanel">
									<div class="panel-body">
										<div class="form-group col-sm-6">
											<label for="sec4_sub_heading_sw" class="control-label">Sub Heading*</label>
											<input type="text" name="sec4_sub_heading_sw" value="<?=$sec4_sub_heading_sw?>" class="form-control" id="sec4_sub_heading_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>
										<div class="form-group col-sm-6">
											<a class="btn view-list-btn" href="<?=SITE_PATH_ADM?>project-manager">View All Projects</a>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#solarMetaSW" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="solarMetaSW">Meta Manager</a> 
								</div>
								<div class="panel-collapse collapse" id="solarMetaSW" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
									<div class="panel-body">
										<div class="form-group col-sm-12">											
											<label for="meta_title_sw" class="control-label">Meta Title</label>
											<textarea name="meta_title_sw" id="meta_title_sw" class="form-control"><?=$meta_title_sw?></textarea>
										</div>
										<div class="form-group col-sm-12">											
											<label for="meta_description_sw" class="control-label">Meta Description</label>
											<textarea name="meta_description_sw" id="meta_description_sw" class="form-control"><?=$meta_description_sw?></textarea>
										</div>
										<div class="form-group col-sm-12">											
											<label for="meta_key_sw" class="control-label">Meta Key</label>
											<textarea name="meta_key_sw" id="meta_key_sw" class="form-control"><?=$meta_key_sw?></textarea>
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
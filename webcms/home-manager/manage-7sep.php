<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 

if($cms->is_post_back()){ 
	if($_FILES["banner"]["name"]){ 
		$_POST["banner"] = uploadImage("banner","home");
	}
	if($_FILES["sec2_img"]["name"]){ 
		$_POST["sec2_img"] = uploadImage("sec2_img","home");
	}
	if($_FILES["sec4_img"]["name"]){ 
		$_POST["sec4_img"] = uploadImage("sec4_img","home");
	}
	if($_FILES["sec4_img_sw"]["name"]){ 
		$_POST["sec4_img_sw"] = uploadImage("sec4_img_sw","home");
	}
	if($_FILES["sec5_icon1"]["name"]){ 
		$_POST["sec5_icon1"] = uploadImage("sec5_icon1","home");
	}
	if($_FILES["sec5_icon2"]["name"]){ 
		$_POST["sec5_icon2"] = uploadImage("sec5_icon2","home");
	}
	if($_FILES["sec5_icon3"]["name"]){ 
		$_POST["sec5_icon3"] = uploadImage("sec5_icon3","home");
	}
	if($_FILES["sec6_right_img"]["name"]){ 
		$_POST["sec6_right_img"] = uploadImage("sec6_right_img","home");
	}
	if($_FILES["sec6_icon1"]["name"]){ 
		$_POST["sec6_icon1"] = uploadImage("sec6_icon1","home");
	}
	if($_FILES["sec6_icon2"]["name"]){ 
		$_POST["sec6_icon2"] = uploadImage("sec6_icon2","home");
	}
	if($_FILES["sec6_icon3"]["name"]){ 
		$_POST["sec6_icon3"] = uploadImage("sec6_icon3","home");
	}
	if($_FILES["sec7_img"]["name"]){ 
		$_POST["sec7_img"] = uploadImage("sec7_img","home");
	}
	if($_FILES["sec7_img_sw"]["name"]){ 
		$_POST["sec7_img_sw"] = uploadImage("sec7_img_sw","home");
	}
		
	$cms->sqlquery("rs","home",$_POST,'id',1);
	$adm->sessset('Record has been updated', 's');
	
	$cms->redir(SITE_PATH_ADM.CPAGE, true);
}	

$rsAdmin=$cms->db_query("select * from #_home where id='1'");
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
									<a class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultOne" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleCollapseDefaultOne">Home Banner </a> 
								</div>
								<div class="panel-collapse collapse in" id="exampleCollapseDefaultOne" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
									<div class="panel-body">
										<div class="form-group col-sm-6">
											<label for="banner" class="control-label">Banner Image</label>
											<input type="file" name="banner" id="input-file-max-fs" class="dropify" data-max-file-size="1M" data-height="150" <?php if($banner AND file_exists(FILES_PATH.'home/'.$banner)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/home/<?=$banner?>" <?php } ?> />
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>										
										<div class="form-group col-sm-6">
											<label for="banner" class="control-label">Banner Text</label>
											<textarea name="banner_text" id="banner_text" class="form-control"><?=$banner_text?></textarea>
										</div>
										<div class="clearfix"></div>
										<div class="form-group col-sm-6">
											<label for="banner_calling_no" class="control-label">Banner Calling Number*</label>
											<input type="text" name="banner_calling_no" value="<?=$banner_calling_no?>" class="form-control" id="banner_calling_no" placeholder="Banner Calling Number" required> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>
										<div class="form-group col-sm-6">
											<label for="address_placeholder" class="control-label">Address Placeholder*</label>
											<input type="text" name="address_placeholder" value="<?=$address_placeholder?>" class="form-control" id="address_placeholder" required> 
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
											<label for="sec1_main_heading" class="control-label">Main Heading*</label>
											<input type="text" name="sec1_main_heading" value="<?=$sec1_main_heading?>" class="form-control" id="sec1_main_heading" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>
										
										<div class="col-sm-4">
											<label for="sec1_heading1" class="control-label">Title 1*</label>
											<input type="text" name="sec1_heading1" value="<?=$sec1_heading1?>" class="form-control" id="sec1_heading1" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec1_sub_heading1" class="control-label">Sub Heading 1*</label>
											<input type="text" name="sec1_sub_heading1" value="<?=$sec1_sub_heading1?>" class="form-control" id="sec1_sub_heading1" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec1_content1" class="control-label">Content 1</label>
											<textarea name="sec1_content1" id="sec1_content1" class="form-control" rows="6"><?=$sec1_content1?></textarea>
										</div>
										<div class="col-sm-4">
											<label for="sec1_heading2" class="control-label">Title 2*</label>
											<input type="text" name="sec1_heading2" value="<?=$sec1_heading2?>" class="form-control" id="sec1_heading2" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec1_sub_heading2" class="control-label">Sub Heading 2*</label>
											<input type="text" name="sec1_sub_heading2" value="<?=$sec1_sub_heading2?>" class="form-control" id="sec1_sub_heading2" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec1_content2" class="control-label">Content 2</label>
											<textarea name="sec1_content2" id="sec1_content2" class="form-control" rows="6"><?=$sec1_content2?></textarea>
										</div>
										<div class="col-sm-4">
											<label for="sec1_heading3" class="control-label">Title 3*</label>
											<input type="text" name="sec1_heading3" value="<?=$sec1_heading3?>" class="form-control" id="sec1_heading3" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec1_sub_heading3" class="control-label">Sub Heading 3*</label>
											<input type="text" name="sec1_sub_heading3" value="<?=$sec1_sub_heading3?>" class="form-control" id="sec1_sub_heading3" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec1_content3" class="control-label">Content 3</label>
											<textarea name="sec1_content3" id="sec1_content3" class="form-control" rows="6"><?=$sec1_content3?></textarea>
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
											<label for="sec2_heading1" class="control-label">Title 1*</label>
											<input type="text" name="sec2_heading1" value="<?=$sec2_heading1?>" class="form-control" id="sec2_heading1" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec2_sub_heading1" class="control-label">Sub Heading 1*</label>
											<input type="text" name="sec2_sub_heading1" value="<?=$sec2_sub_heading1?>" class="form-control" id="sec2_sub_heading1" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec2_content1" class="control-label">Content 1</label>
											<textarea name="sec2_content1" id="sec2_content1" class="form-control" rows="6"><?=$sec2_content1?></textarea>
										</div>
										<div class="col-sm-4">
											<label for="sec2_heading2" class="control-label">Title 2*</label>
											<input type="text" name="sec2_heading2" value="<?=$sec2_heading2?>" class="form-control" id="sec2_heading2" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec2_sub_heading2" class="control-label">Sub Heading 2*</label>
											<input type="text" name="sec2_sub_heading2" value="<?=$sec2_sub_heading2?>" class="form-control" id="sec2_sub_heading2" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec2_content2" class="control-label">Content 2</label>
											<textarea name="sec2_content2" id="sec2_content2" class="form-control" rows="6"><?=$sec2_content2?></textarea>
										</div>
										<div class="col-sm-4">
											<label for="sec2_heading3" class="control-label">Title 3*</label>
											<input type="text" name="sec2_heading3" value="<?=$sec2_heading3?>" class="form-control" id="sec2_heading3" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec2_sub_heading3" class="control-label">Sub Heading 3*</label>
											<input type="text" name="sec2_sub_heading3" value="<?=$sec2_sub_heading3?>" class="form-control" id="sec2_sub_heading3" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec2_content3" class="control-label">Content 3</label>
											<textarea name="sec2_content3" id="sec2_content3" class="form-control" rows="6"><?=$sec2_content3?></textarea>
										</div>
										<div class="clearfix"></div>
										
										<div class="form-group col-sm-6">
											<label for="sec2_img" class="control-label">Right Image</label>
											<input type="file" name="sec2_img" id="input-file-max-fs" class="dropify" data-max-file-size="1M" data-height="150" <?php if($sec2_img AND file_exists(FILES_PATH.'home/'.$sec2_img)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/home/<?=$sec2_img?>" <?php } ?> />
											<div class="help-block with-errors"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#exampleHeadingDefaultFour" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleHeadingDefaultFour">Section 3</a> 
								</div>
								<div class="panel-collapse collapse" id="exampleHeadingDefaultFour" aria-labelledby="exampleHeadingDefaultFour" role="tabpanel">
									<div class="panel-body">
										<div class="col-sm-6">
											<label for="sec3_title" class="control-label">Title*</label>
											
											<textarea name="sec3_title" id="sec3_title" class="ckeditor" rows="6"><?=$sec3_title?></textarea>
											<div class="help-block with-errors"></div>
											
											<label for="sec3_btn_text" class="control-label">Button Text*</label>
											<input type="text" name="sec3_btn_text" value="<?=$sec3_btn_text?>" class="form-control" id="sec3_btn_text" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec3_link" class="control-label">Button Link*</label>
											<input type="text" name="sec3_link" value="<?=$sec3_link?>" class="form-control" id="sec3_link" data-fv-regexp="true" data-error="Please enter value" required> 
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
									<a class="panel-title collapsed" data-toggle="collapse" href="#exampleHeadingDefaultFive" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleHeadingDefaultFive">Section 4</a> 
								</div>
								<div class="panel-collapse collapse" id="exampleHeadingDefaultFive" aria-labelledby="exampleHeadingDefaultFive" role="tabpanel">
									<div class="panel-body">
										<div class="form-group col-sm-6">
											<label for="sec4_img" class="control-label">Image</label>
											<input type="file" name="sec4_img" id="input-file-max-fs" class="dropify" data-max-file-size="1M" data-height="150" <?php if($sec4_img AND file_exists(FILES_PATH.'home/'.$sec4_img)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/home/<?=$sec4_img?>" <?php } ?> />
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
									<a class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultSix" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleCollapseDefaultSix">Section 5</a> 
								</div>
								<div class="panel-collapse collapse" id="exampleCollapseDefaultSix" aria-labelledby="exampleCollapseDefaultSix" role="tabpanel">
									<div class="panel-body">										
										<div class="col-sm-4">
											<label for="sec5_title1" class="control-label">Title 1*</label>
											<input type="text" name="sec5_title1" value="<?=$sec5_title1?>" class="form-control" id="sec5_title1" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec5_icon1" class="control-label">Icon 1</label>
											<input type="file" name="sec5_icon1" id="input-file-max-fs" class="dropify" data-max-file-size="1M" data-height="150" <?php if($sec5_icon1 AND file_exists(FILES_PATH.'home/'.$sec5_icon1)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/home/<?=$sec5_icon1?>" <?php } ?> />
											<div class="help-block with-errors"></div>
																					
											<label for="sec5_content1" class="control-label">Content 1</label>
											<textarea name="sec5_content1" id="sec5_content1" class="form-control" rows="6"><?=$sec5_content1?></textarea>
										</div>
										
										<div class="col-sm-4">
											<label for="sec5_title2" class="control-label">Title 2*</label>
											<input type="text" name="sec5_title2" value="<?=$sec5_title2?>" class="form-control" id="sec5_title2" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec5_icon2" class="control-label">Icon 2</label>
											<input type="file" name="sec5_icon2" id="input-file-max-fs" class="dropify" data-max-file-size="1M" data-height="150" <?php if($sec5_icon2 AND file_exists(FILES_PATH.'home/'.$sec5_icon2)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/home/<?=$sec5_icon2?>" <?php } ?> />
											<div class="help-block with-errors"></div>
																					
											<label for="sec5_content2" class="control-label">Content 2</label>
											<textarea name="sec5_content2" id="sec5_content2" class="form-control" rows="6"><?=$sec5_content2?></textarea>
										</div>
										
										<div class="col-sm-4">
											<label for="sec5_title3" class="control-label">Title 3*</label>
											<input type="text" name="sec5_title3" value="<?=$sec5_title3?>" class="form-control" id="sec5_title3" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec5_icon3" class="control-label">Icon 3</label>
											<input type="file" name="sec5_icon3" id="input-file-max-fs" class="dropify" data-max-file-size="1M" data-height="150" <?php if($sec5_icon3 AND file_exists(FILES_PATH.'home/'.$sec5_icon3)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/home/<?=$sec5_icon3?>" <?php } ?> />
											<div class="help-block with-errors"></div>
																					
											<label for="sec5_content3" class="control-label">Content 3</label>
											<textarea name="sec5_content3" id="sec5_content3" class="form-control" rows="6"><?=$sec5_content3?></textarea>
										</div>
										
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultSeven" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleCollapseDefaultSeven">Section 6</a> 
								</div>
								<div class="panel-collapse collapse" id="exampleCollapseDefaultSeven" aria-labelledby="exampleCollapseDefaultSeven" role="tabpanel">
									<div class="panel-body">
										<div class="col-sm-6">
											<label for="sec6_main_heading" class="control-label">Main Heading*</label>
											<input type="text" name="sec6_main_heading" value="<?=$sec6_main_heading?>" class="form-control" id="sec6_main_heading" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>
										
										<div class="col-sm-4">
											<label for="sec6_title1" class="control-label">Title 1*</label>
											<input type="text" name="sec6_title1" value="<?=$sec6_title1?>" class="form-control" id="sec6_title1" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec6_icon1" class="control-label">Icon 1</label>
											<input type="file" name="sec6_icon1" id="input-file-max-fs" class="dropify" data-max-file-size="1M" data-height="150" <?php if($sec6_icon1 AND file_exists(FILES_PATH.'home/'.$sec6_icon1)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/home/<?=$sec6_icon1?>" <?php } ?> />
											<div class="help-block with-errors"></div>
										</div>
										
										<div class="col-sm-4">
											<label for="sec6_title2" class="control-label">Title 2*</label>
											<input type="text" name="sec6_title2" value="<?=$sec6_title2?>" class="form-control" id="sec6_title2" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec6_icon2" class="control-label">Icon 2</label>
											<input type="file" name="sec6_icon2" id="input-file-max-fs" class="dropify" data-max-file-size="1M" data-height="150" <?php if($sec6_icon2 AND file_exists(FILES_PATH.'home/'.$sec6_icon2)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/home/<?=$sec6_icon2?>" <?php } ?> />
											<div class="help-block with-errors"></div>
										</div>
										
										<div class="col-sm-4">
											<label for="sec6_title3" class="control-label">Title 3*</label>
											<input type="text" name="sec6_title3" value="<?=$sec6_title3?>" class="form-control" id="sec6_title3" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec6_icon3" class="control-label">Icon 3</label>
											<input type="file" name="sec6_icon3" id="input-file-max-fs" class="dropify" data-max-file-size="1M" data-height="150" <?php if($sec6_icon3 AND file_exists(FILES_PATH.'home/'.$sec6_icon3)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/home/<?=$sec6_icon3?>" <?php } ?> />
											<div class="help-block with-errors"></div>
										</div>
										
										<div class="clearfix"></div>
										
										<div class="col-sm-6">
											<label for="sec6_right_img" class="control-label">Right Image</label>
											<input type="file" name="sec6_right_img" id="input-file-max-fs" class="dropify" data-max-file-size="1M" data-height="150" <?php if($sec6_right_img AND file_exists(FILES_PATH.'home/'.$sec6_right_img)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/home/<?=$sec6_right_img?>" <?php } ?> />
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
									<a class="panel-title collapsed" data-toggle="collapse" href="#exampleHeadingDefaultEight" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleHeadingDefaultEight">Section 7</a> 
								</div>
								<div class="panel-collapse collapse" id="exampleHeadingDefaultEight" aria-labelledby="exampleHeadingDefaultEight" role="tabpanel">
									<div class="panel-body">
										<div class="form-group col-sm-6">
											<label for="sec7_img" class="control-label">Image</label>
											<input type="file" name="sec7_img" id="input-file-max-fs" class="dropify" data-max-file-size="1M" data-height="150" <?php if($sec7_img AND file_exists(FILES_PATH.'home/'.$sec7_img)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/home/<?=$sec7_img?>" <?php } ?> />
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
									<a class="panel-title collapsed" data-toggle="collapse" href="#exampleHeadingDefaultNine" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleHeadingDefaultNine">Section 8</a> 
								</div>
								<div class="panel-collapse collapse" id="exampleHeadingDefaultNine" aria-labelledby="exampleHeadingDefaultNine" role="tabpanel">
									<div class="panel-body">
										<div class="form-group col-sm-6">
											<label for="sec8_sub_heading" class="control-label">Main Heading*</label>
											<input type="text" name="sec8_sub_heading" value="<?=$sec8_sub_heading?>" class="form-control" id="sec8_sub_heading" data-fv-regexp="true" data-error="Please enter value" required> 
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
									<a class="panel-title collapsed" data-toggle="collapse" href="#exampleHeadingDefaultTen" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleHeadingDefaultTen">Section 9</a> 
								</div>
								<div class="panel-collapse collapse" id="exampleHeadingDefaultTen" aria-labelledby="exampleHeadingDefaultNine" role="tabpanel">
									<div class="panel-body">
										<div class="form-group col-sm-6">
											<label for="news_main_heading" class="control-label">Main Heading*</label>
											<input type="text" name="news_main_heading" value="<?=$news_main_heading?>" class="form-control" id="news_main_heading" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="form-group col-sm-6">
											<label for="news_sub_heading" class="control-label">Sub Heading*</label>
											<input type="text" name="news_sub_heading" value="<?=$news_sub_heading?>" class="form-control" id="news_sub_heading" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>
										<div class="form-group col-sm-6">
											<a class="btn view-list-btn" href="<?=SITE_PATH_ADM?>blog-manager">View All News</a>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#homeAccSecENG10" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="homeAccSecENG10">Section 10</a> 
								</div>
								<div class="panel-collapse collapse" id="homeAccSecENG10" aria-labelledby="exampleHeadingDefaultNine" role="tabpanel">
									<div class="panel-body">
										<div class="form-group col-sm-6">
											<label for="faq_heading" class="control-label">Main Heading*</label>
											<input type="text" name="faq_heading" value="<?=$faq_heading?>" class="form-control" id="faq_heading" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="form-group col-sm-6">
											<a class="btn view-list-btn" href="<?=SITE_PATH_ADM?>faq-manager">View All FAQs</a>
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
									<a class="panel-title collapsed" data-toggle="collapse" href="#homeCollapseOneSw" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="homeCollapseOneSw">Home Banner </a> 
								</div>
								<div class="panel-collapse collapse in" id="homeCollapseOneSw" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
									<div class="panel-body">										
										<div class="form-group col-sm-6">
											<label for="banner_text_sw" class="control-label">Banner Text</label>
											<textarea name="banner_text_sw" id="banner_text_sw" class="form-control"><?=$banner_text_sw?></textarea>
										</div>
										<div class="clearfix"></div>
										<div class="form-group col-sm-6">
											<label for="address_placeholder_sw" class="control-label">Address Placeholder*</label>
											<input type="text" name="address_placeholder_sw" value="<?=$address_placeholder_sw?>" class="form-control" id="address_placeholder_sw" required> 
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
									<a class="panel-title collapsed" data-toggle="collapse" href="#homeCollapseTwoSw" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="homeCollapseTwoSw">Section 1</a> 
								</div>
								<div class="panel-collapse collapse" id="homeCollapseTwoSw" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
									<div class="panel-body">
										<div class="col-sm-6">
											<label for="sec1_main_heading_sw" class="control-label">Main Heading*</label>
											<input type="text" name="sec1_main_heading_sw" value="<?=$sec1_main_heading_sw?>" class="form-control" id="sec1_main_heading_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>
										
										<div class="col-sm-4">
											<label for="sec1_heading1_sw" class="control-label">Title 1*</label>
											<input type="text" name="sec1_heading1_sw" value="<?=$sec1_heading1_sw?>" class="form-control" id="sec1_heading1_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec1_sub_heading1_sw" class="control-label">Sub Heading 1*</label>
											<input type="text" name="sec1_sub_heading1_sw" value="<?=$sec1_sub_heading1_sw?>" class="form-control" id="sec1_sub_heading1_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec1_content1_sw" class="control-label">Content 1</label>
											<textarea name="sec1_content1_sw" id="sec1_content1_sw" class="form-control" rows="6"><?=$sec1_content1_sw?></textarea>
										</div>
										<div class="col-sm-4">
											<label for="sec1_heading2_sw" class="control-label">Title 2*</label>
											<input type="text" name="sec1_heading2_sw" value="<?=$sec1_heading2_sw?>" class="form-control" id="sec1_heading2_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec1_sub_heading2_sw" class="control-label">Sub Heading 2*</label>
											<input type="text" name="sec1_sub_heading2_sw" value="<?=$sec1_sub_heading2_sw?>" class="form-control" id="sec1_sub_heading2_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec1_content2_sw" class="control-label">Content 2</label>
											<textarea name="sec1_content2_sw" id="sec1_content2_sw" class="form-control" rows="6"><?=$sec1_content2_sw?></textarea>
										</div>
										<div class="col-sm-4">
											<label for="sec1_heading3_sw" class="control-label">Title 3*</label>
											<input type="text" name="sec1_heading3_sw" value="<?=$sec1_heading3_sw?>" class="form-control" id="sec1_heading3_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec1_sub_heading3_sw" class="control-label">Sub Heading 3*</label>
											<input type="text" name="sec1_sub_heading3_sw" value="<?=$sec1_sub_heading3_sw?>" class="form-control" id="sec1_sub_heading3_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec1_content3_sw" class="control-label">Content 3</label>
											<textarea name="sec1_content3_sw" id="sec1_content3_sw" class="form-control" rows="6"><?=$sec1_content3_sw?></textarea>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#homeCollapseThreeSw" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="homeCollapseThreeSw">Section 2</a> 
								</div>
								<div class="panel-collapse collapse" id="homeCollapseThreeSw" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
									<div class="panel-body">
										<div class="col-sm-6">
											<label for="sec2_main_heading_sw" class="control-label">Main Heading*</label>
											<input type="text" name="sec2_main_heading_sw" value="<?=$sec2_main_heading_sw?>" class="form-control" id="sec2_main_heading_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>
										
										<div class="col-sm-4">
											<label for="sec2_heading1_sw" class="control-label">Title 1*</label>
											<input type="text" name="sec2_heading1_sw" value="<?=$sec2_heading1_sw?>" class="form-control" id="sec2_heading1_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec2_sub_heading1_sw" class="control-label">Sub Heading 1*</label>
											<input type="text" name="sec2_sub_heading1_sw" value="<?=$sec2_sub_heading1_sw?>" class="form-control" id="sec2_sub_heading1_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec2_content1_sw" class="control-label">Content 1</label>
											<textarea name="sec2_content1_sw" id="sec2_content1_sw" class="form-control" rows="6"><?=$sec2_content1_sw?></textarea>
										</div>
										<div class="col-sm-4">
											<label for="sec2_heading2_sw" class="control-label">Title 2*</label>
											<input type="text" name="sec2_heading2_sw" value="<?=$sec2_heading2_sw?>" class="form-control" id="sec2_heading2_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec2_sub_heading2_sw" class="control-label">Sub Heading 2*</label>
											<input type="text" name="sec2_sub_heading2_sw" value="<?=$sec2_sub_heading2_sw?>" class="form-control" id="sec2_sub_heading2_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec2_content2_sw" class="control-label">Content 2</label>
											<textarea name="sec2_content2_sw" id="sec2_content2_sw" class="form-control" rows="6"><?=$sec2_content2_sw?></textarea>
										</div>
										<div class="col-sm-4">
											<label for="sec2_heading3_sw" class="control-label">Title 3*</label>
											<input type="text" name="sec2_heading3_sw" value="<?=$sec2_heading3_sw?>" class="form-control" id="sec2_heading3_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec2_sub_heading3_sw" class="control-label">Sub Heading 3*</label>
											<input type="text" name="sec2_sub_heading3_sw" value="<?=$sec2_sub_heading3_sw?>" class="form-control" id="sec2_sub_heading3_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec2_content3_sw" class="control-label">Content 3</label>
											<textarea name="sec2_content3_sw" id="sec2_content3_sw" class="form-control" rows="6"><?=$sec2_content3_sw?></textarea>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#homeCollapseFourSw" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleHeadingDefaultFour">Section 3</a> 
								</div>
								<div class="panel-collapse collapse" id="homeCollapseFourSw" aria-labelledby="homeCollapseFourSw" role="tabpanel">
									<div class="panel-body">
										<div class="col-sm-6">
											<label for="sec3_title_sw" class="control-label">Title*</label>
											
											<textarea name="sec3_title_sw" id="sec3_title_sw" class="ckeditor" rows="6"><?=$sec3_title_sw?></textarea>
											<div class="help-block with-errors"></div>
											
											<label for="sec3_btn_text_sw" class="control-label">Button Text*</label>
											<input type="text" name="sec3_btn_text_sw" value="<?=$sec3_btn_text_sw?>" class="form-control" id="sec3_btn_text_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec3_link_sw" class="control-label">Button Link*</label>
											<input type="text" name="sec3_link_sw" value="<?=$sec3_link_sw?>" class="form-control" id="sec3_link_sw" data-fv-regexp="true" data-error="Please enter value" required> 
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
									<a class="panel-title collapsed" data-toggle="collapse" href="#homeCollapseeightSw" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="homeCollapseeightSw">Section 4</a> 
								</div>
								<div class="panel-collapse collapse" id="homeCollapseeightSw" aria-labelledby="exampleHeadingDefaultFive" role="tabpanel">
									<div class="panel-body">
										<div class="form-group col-sm-6">
											<label for="sec4_img_sw" class="control-label">Image</label>
											<input type="file" name="sec4_img_sw" id="input-file-max-fs" class="dropify" data-max-file-size="1M" data-height="150" <?php if($sec4_img_sw AND file_exists(FILES_PATH.'home/'.$sec4_img_sw)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/home/<?=$sec4_img_sw?>" <?php } ?> />
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
									<a class="panel-title collapsed" data-toggle="collapse" href="#homeCollapseFiveSw" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleCollapseDefaultSix">Section 5</a> 
								</div>
								<div class="panel-collapse collapse" id="homeCollapseFiveSw" aria-labelledby="homeCollapseFiveSw" role="tabpanel">
									<div class="panel-body">
										
										<div class="col-sm-4">
											<label for="sec5_title1_sw" class="control-label">Title 1*</label>
											<input type="text" name="sec5_title1_sw" value="<?=$sec5_title1_sw?>" class="form-control" id="sec5_title1_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
																					
											<label for="sec5_content1_sw" class="control-label">Content 1</label>
											<textarea name="sec5_content1_sw" id="sec5_content1_sw" class="form-control" rows="6"><?=$sec5_content1_sw?></textarea>
										</div>
										
										<div class="col-sm-4">
											<label for="sec5_title2_sw" class="control-label">Title 2*</label>
											<input type="text" name="sec5_title2_sw" value="<?=$sec5_title2_sw?>" class="form-control" id="sec5_title2_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
																					
											<label for="sec5_content2_sw" class="control-label">Content 2</label>
											<textarea name="sec5_content2_sw" id="sec5_content2_sw" class="form-control" rows="6"><?=$sec5_content2_sw?></textarea>
										</div>
										
										<div class="col-sm-4">
											<label for="sec5_title3_sw" class="control-label">Title 3*</label>
											<input type="text" name="sec5_title3_sw" value="<?=$sec5_title3_sw?>" class="form-control" id="sec5_title3_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
																					
											<label for="sec5_content3_sw" class="control-label">Content 3</label>
											<textarea name="sec5_content3_sw" id="sec5_content3_sw" class="form-control" rows="6"><?=$sec5_content3_sw?></textarea>
										</div>
										
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#homeCollapseSixSw" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="homeCollapseSixSw">Section 6</a> 
								</div>
								<div class="panel-collapse collapse" id="homeCollapseSixSw" aria-labelledby="exampleCollapseDefaultSeven" role="tabpanel">
									<div class="panel-body">
										<div class="col-sm-6">
											<label for="sec6_main_heading_sw" class="control-label">Main Heading*</label>
											<input type="text" name="sec6_main_heading_sw" value="<?=$sec6_main_heading_sw?>" class="form-control" id="sec6_main_heading_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>
										
										<div class="col-sm-4">
											<label for="sec6_title1_sw" class="control-label">Title 1*</label>
											<input type="text" name="sec6_title1_sw" value="<?=$sec6_title1_sw?>" class="form-control" id="sec6_title1_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div>
										
										<div class="col-sm-4">
											<label for="sec6_title2_sw" class="control-label">Title 2*</label>
											<input type="text" name="sec6_title2_sw" value="<?=$sec6_title2_sw?>" class="form-control" id="sec6_title2_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div>
										
										<div class="col-sm-4">
											<label for="sec6_title3_sw" class="control-label">Title 3*</label>
											<input type="text" name="sec6_title3_sw" value="<?=$sec6_title3_sw?>" class="form-control" id="sec6_title3_sw" data-fv-regexp="true" data-error="Please enter value" required> 
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
									<a class="panel-title collapsed" data-toggle="collapse" href="#homeAcc22" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="homeAcc22">Section 7</a> 
								</div>
								<div class="panel-collapse collapse" id="homeAcc22" aria-labelledby="exampleHeadingDefaultEight" role="tabpanel">
									<div class="panel-body">
										<div class="form-group col-sm-6">
											<label for="sec7_img_sw" class="control-label">Image</label>
											<input type="file" name="sec7_img_sw" id="input-file-max-fs" class="dropify" data-max-file-size="1M" data-height="150" <?php if($sec7_img_sw AND file_exists(FILES_PATH.'home/'.$sec7_img_sw)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/home/<?=$sec7_img_sw?>" <?php } ?> />
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
									<a class="panel-title collapsed" data-toggle="collapse" href="#homeAccSecSW8" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="homeAccSecSW8">Section 8</a> 
								</div>
								<div class="panel-collapse collapse" id="homeAccSecSW8" aria-labelledby="exampleHeadingDefaultNine" role="tabpanel">
									<div class="panel-body">
										<div class="form-group col-sm-6">
											<label for="sec8_sub_heading_sw" class="control-label">Main Heading*</label>
											<input type="text" name="sec8_sub_heading_sw" value="<?=$sec8_sub_heading_sw?>" class="form-control" id="sec8_sub_heading_sw" data-fv-regexp="true" data-error="Please enter value" required> 
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
									<a class="panel-title collapsed" data-toggle="collapse" href="#homeAccSecSW9" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="homeAccSecSW9">Section 9</a> 
								</div>
								<div class="panel-collapse collapse" id="homeAccSecSW9" aria-labelledby="exampleHeadingDefaultNine" role="tabpanel">
									<div class="panel-body">
										<div class="form-group col-sm-6">
											<label for="news_main_heading_sw" class="control-label">Main Heading*</label>
											<input type="text" name="news_main_heading_sw" value="<?=$news_main_heading_sw?>" class="form-control" id="news_main_heading_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="form-group col-sm-6">
											<label for="news_sub_heading_sw" class="control-label">Sub Heading*</label>
											<input type="text" name="news_sub_heading_sw" value="<?=$news_sub_heading_sw?>" class="form-control" id="news_sub_heading_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>
										<div class="form-group col-sm-6">
											<a class="btn view-list-btn" href="<?=SITE_PATH_ADM?>blog-manager">View All News</a>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#homeAccSecSW10" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="homeAccSecSW10">Section 10</a> 
								</div>
								<div class="panel-collapse collapse" id="homeAccSecSW10" aria-labelledby="exampleHeadingDefaultNine" role="tabpanel">
									<div class="panel-body">
										<div class="form-group col-sm-6">
											<label for="faq_heading_sw" class="control-label">Main Heading*</label>
											<input type="text" name="faq_heading_sw" value="<?=$faq_heading_sw?>" class="form-control" id="faq_heading_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="form-group col-sm-6">
											<a class="btn view-list-btn" href="<?=SITE_PATH_ADM?>faq-manager">View All FAQs</a>
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
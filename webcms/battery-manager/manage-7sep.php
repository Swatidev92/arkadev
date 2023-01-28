<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 

if($cms->is_post_back()){ 
	if($_FILES["banner"]["name"]){ 
		$_POST["banner"] = uploadImage("banner","batteries");
	}
	if($_FILES["sec2_right_img"]["name"]){ 
		$_POST["sec2_right_img"] = uploadImage("sec2_right_img","batteries");
	}
	if($_FILES["sec2_right_img_sw"]["name"]){ 
		$_POST["sec2_right_img_sw"] = uploadImage("sec2_right_img_sw","batteries");
	}
	if($_FILES["sec5_icon1"]["name"]){ 
		$_POST["sec5_icon1"] = uploadImage("sec5_icon1","batteries");
	}
	if($_FILES["sec5_icon2"]["name"]){ 
		$_POST["sec5_icon2"] = uploadImage("sec5_icon2","batteries");
	}
	if($_FILES["sec5_icon3"]["name"]){ 
		$_POST["sec5_icon3"] = uploadImage("sec5_icon3","batteries");
	}
		
	$cms->sqlquery("rs","batteries",$_POST,'id',1);
	$adm->sessset('Record has been updated', 's');
	
	$cms->redir(SITE_PATH_ADM.CPAGE, true);
}	

$rsAdmin=$cms->db_query("select * from #_batteries where id='1'");
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
										<div class="form-group col-sm-6">
											<label for="banner" class="control-label">Banner Image</label>
											<input type="file" name="banner" id="input-file-max-fs" class="dropify" data-max-file-size="1M" data-height="150" <?php if($banner AND file_exists(FILES_PATH.'batteries/'.$banner)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/batteries/<?=$banner?>" <?php } ?> />
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>										
										<div class="form-group col-sm-6">
											<label for="banner_text" class="control-label">Banner Text</label>
											<textarea name="banner_text" id="banner_text" class="form-control"><?=$banner_text?></textarea>
										</div>
										<div class="clearfix"></div>
										<div class="form-group col-sm-6">
											<label for="banner_text2" class="control-label">Banner Text 2</label>
											<textarea name="banner_text2" id="banner_text2" class="form-control"><?=$banner_text2?></textarea>
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
											<label for="sec1_title1" class="control-label">Title 1*</label>
											<input type="text" name="sec1_title1" value="<?=$sec1_title1?>" class="form-control" id="sec1_title1" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec1_content1" class="control-label">Content 1</label>
											<textarea name="sec1_content1" id="sec1_content1" class="form-control" rows="6"><?=$sec1_content1?></textarea>
										</div>
										<div class="col-sm-4">											
											<label for="sec1_title2" class="control-label">Title 2*</label>
											<input type="text" name="sec1_title2" value="<?=$sec1_title2?>" class="form-control" id="sec1_title2" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec1_content2" class="control-label">Content 2</label>
											<textarea name="sec1_content2" id="sec1_content2" class="form-control" rows="6"><?=$sec1_content2?></textarea>
										</div>
										<div class="col-sm-4">											
											<label for="sec1_title3" class="control-label">Title 3*</label>
											<input type="text" name="sec1_title3" value="<?=$sec1_title3?>" class="form-control" id="sec1_title3" data-fv-regexp="true" data-error="Please enter value" required> 
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
											
											<label for="sec2_content" class="control-label">Content 3</label>
											<textarea name="sec2_content" id="sec2_content" class="form-control" rows="6"><?=$sec2_content?></textarea>
											
											<label for="sec2_btn_text" class="control-label">Button Text</label>
											<input type="text" name="sec2_btn_text" value="<?=$sec2_btn_text?>" class="form-control" id="sec2_btn_text" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec2_btn_link" class="control-label">Button Link</label>
											<input type="text" name="sec2_btn_link" value="<?=$sec2_btn_link?>" class="form-control" id="sec2_btn_link" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec2_right_img" class="control-label">Right Image</label>
											<input type="file" name="sec2_right_img" id="input-file-max-fs" class="dropify" data-max-file-size="1M" data-height="150" <?php if($sec2_right_img AND file_exists(FILES_PATH.'batteries/'.$sec2_right_img)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/batteries/<?=$sec2_right_img?>" <?php } ?> />
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
										
										<div class="col-sm-6">											
											<label for="sec3_title1" class="control-label">Title 1*</label>
											<input type="text" name="sec3_title1" value="<?=$sec3_title1?>" class="form-control" id="sec3_title1" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec3_content1" class="control-label">Content 1</label>
											<textarea name="sec3_content1" id="sec3_content1" class="ckeditor" rows="6"><?=$sec3_content1?></textarea>
										</div>
										<div class="col-sm-6">
											<label for="sec3_title2" class="control-label">Title 2*</label>
											<input type="text" name="sec3_title2" value="<?=$sec3_title2?>" class="form-control" id="sec3_title2" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec3_content2" class="control-label">Content 2</label>
											<textarea name="sec3_content2" id="sec3_content2" class="ckeditor" rows="6"><?=$sec3_content2?></textarea>
										</div>
										<div class="clearfix"></div>
										<div class="col-sm-6">
											<label for="sec3_btn_text" class="control-label">Button Text</label>
											<input type="text" name="sec3_btn_text" value="<?=$sec3_btn_text?>" class="form-control" id="sec3_btn_text" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec3_btn_link" class="control-label">Button Link</label>
											<input type="text" name="sec3_btn_link" value="<?=$sec3_btn_link?>" class="form-control" id="sec3_btn_link" data-fv-regexp="true" data-error="Please enter value" required> 
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
									<a class="panel-title collapsed" data-toggle="collapse" href="#exampleHeadingDefaultNine" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleHeadingDefaultNine">Section 4</a> 
								</div>
								<div class="panel-collapse collapse" id="exampleHeadingDefaultNine" aria-labelledby="exampleHeadingDefaultNine" role="tabpanel">
									<div class="panel-body">
										<div class="form-group col-sm-6">
											<label for="sec4_main_heading" class="control-label">Main Heading*</label>
											<input type="text" name="sec4_main_heading" value="<?=$sec4_main_heading?>" class="form-control" id="sec4_main_heading" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>
										<div class="form-group col-sm-6">
											<label for="sec4_content" class="control-label">Content</label>
											<textarea name="sec4_content" class="ckeditor" id="sec4_content"><?=$sec4_content?></textarea>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
						
						
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#exampleHeadingDefaultTen" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleHeadingDefaultTen">Section 5</a> 
								</div>
								<div class="panel-collapse collapse" id="exampleHeadingDefaultTen" aria-labelledby="exampleHeadingDefaultTen" role="tabpanel">
									<div class="panel-body">
										<div class="form-group col-sm-6">
											<label for="sec5_main_heading" class="control-label">Main Heading*</label>
											<input type="text" name="sec5_main_heading" value="<?=$sec5_main_heading?>" class="form-control" id="sec5_main_heading" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="form-group col-sm-6">
											<label for="sec5_sub_heading" class="control-label">Sub Heading*</label>
											<input type="text" name="sec5_sub_heading" value="<?=$sec5_sub_heading?>" class="form-control" id="sec5_sub_heading" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>
										<div class="form-group col-sm-4">
											<label for="sec5_title1" class="control-label">Title 1</label>
											<input type="text" name="sec5_title1" value="<?=$sec5_title1?>" class="form-control" id="sec5_title1" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec5_icon1" class="control-label">Icon 1</label>
											<input type="file" name="sec5_icon1" id="input-file-max-fs" class="dropify" data-max-file-size="1M" data-height="150" <?php if($sec5_icon1 AND file_exists(FILES_PATH.'batteries/'.$sec5_icon1)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/batteries/<?=$sec5_icon1?>" <?php } ?> />
											
											<label for="sec5_content1" class="control-label">Content 1</label>
											<textarea name="sec5_content1" class="form-control" id="sec5_content1" rows="5"><?=$sec5_content1?></textarea>
										</div>
										<div class="form-group col-sm-4">
											<label for="sec5_title2" class="control-label">Title 2</label>
											<input type="text" name="sec5_title2" value="<?=$sec5_title2?>" class="form-control" id="sec5_title2" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec5_icon2" class="control-label">Icon 2</label>
											<input type="file" name="sec5_icon2" id="input-file-max-fs" class="dropify" data-max-file-size="1M" data-height="150" <?php if($sec5_icon2 AND file_exists(FILES_PATH.'batteries/'.$sec5_icon2)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/batteries/<?=$sec5_icon2?>" <?php } ?> />
											
											<label for="sec5_content2" class="control-label">Content 2</label>
											<textarea name="sec5_content2" class="form-control" id="sec5_content2" rows="5"><?=$sec5_content2?></textarea>
										</div>
										<div class="form-group col-sm-4">
											<label for="sec5_title3" class="control-label">Title 3</label>
											<input type="text" name="sec5_title3" value="<?=$sec5_title3?>" class="form-control" id="sec5_title3" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec5_icon3" class="control-label">Icon 3</label>
											<input type="file" name="sec5_icon3" id="input-file-max-fs" class="dropify" data-max-file-size="1M" data-height="150" <?php if($sec5_icon3 AND file_exists(FILES_PATH.'batteries/'.$sec5_icon3)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/batteries/<?=$sec5_icon3?>" <?php } ?> />
											
											<label for="sec5_content3" class="control-label">Content 3</label>
											<textarea name="sec5_content3" class="form-control" id="sec5_content3" rows="5"><?=$sec5_content3?></textarea>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#exampleHeadingDefaulteleven" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleHeadingDefaulteleven">Section 6</a> 
								</div>
								<div class="panel-collapse collapse" id="exampleHeadingDefaulteleven" aria-labelledby="exampleHeadingDefaulteleven" role="tabpanel">
									<div class="panel-body">
										<div class="form-group col-sm-6">
											<label for="sec6_main_heading" class="control-label">Main Heading*</label>
											<input type="text" name="sec6_main_heading" value="<?=$sec6_main_heading?>" class="form-control" id="sec6_main_heading" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>
										<div class="form-group col-sm-6">
											<label for="sec6_btn_text" class="control-label">Button Text</label>
											<input type="text" name="sec6_btn_text" value="<?=$sec6_btn_text?>" class="form-control" id="sec6_btn_text" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>
										<div class="form-group col-sm-6">
											<label for="sec6_btn_link" class="control-label">Button Link</label>
											<input type="text" name="sec6_btn_link" value="<?=$sec6_btn_link?>" class="form-control" id="sec6_btn_link" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
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
									<a class="panel-title collapsed" data-toggle="collapse" href="#batteryOneSw" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="batteryOneSw">Banner </a> 
								</div>
								<div class="panel-collapse collapse in" id="batteryOneSw" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
									<div class="panel-body">										
										<div class="form-group col-sm-6">
											<label for="banner_text_sw" class="control-label">Banner Text</label>
											<textarea name="banner_text_sw" id="banner_text_sw" class="form-control"><?=$banner_text_sw?></textarea>
										</div>
										<div class="clearfix"></div>
										<div class="form-group col-sm-6">
											<label for="banner_text2_sw" class="control-label">Banner Text 2</label>
											<textarea name="banner_text2_sw" id="banner_text2_sw" class="form-control"><?=$banner_text2_sw?></textarea>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#batteryTwoSw" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="batteryTwoSw">Section 1</a> 
								</div>
								<div class="panel-collapse collapse" id="batteryTwoSw" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
									<div class="panel-body">
										<div class="col-sm-6">
											<label for="sec1_main_heading_sw" class="control-label">Main Heading*</label>
											<input type="text" name="sec1_main_heading_sw" value="<?=$sec1_main_heading_sw?>" class="form-control" id="sec1_main_heading_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>
										
										<div class="col-sm-4">											
											<label for="sec1_title1_sw" class="control-label">Title 1*</label>
											<input type="text" name="sec1_title1_sw" value="<?=$sec1_title1_sw?>" class="form-control" id="sec1_title1_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec1_content1_sw" class="control-label">Content 1</label>
											<textarea name="sec1_content1_sw" id="sec1_content1_sw" class="form-control" rows="6"><?=$sec1_content1_sw?></textarea>
										</div>
										<div class="col-sm-4">											
											<label for="sec1_title2_sw" class="control-label">Title 2*</label>
											<input type="text" name="sec1_title2_sw" value="<?=$sec1_title2_sw?>" class="form-control" id="sec1_title2_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec1_content2_sw" class="control-label">Content 2</label>
											<textarea name="sec1_content2_sw" id="sec1_content2_sw" class="form-control" rows="6"><?=$sec1_content2_sw?></textarea>
										</div>
										<div class="col-sm-4">											
											<label for="sec1_title3_sw" class="control-label">Title 3*</label>
											<input type="text" name="sec1_title3_sw" value="<?=$sec1_title3_sw?>" class="form-control" id="sec1_title3_sw" data-fv-regexp="true" data-error="Please enter value" required> 
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
									<a class="panel-title collapsed" data-toggle="collapse" href="#batteryThreeSw" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="batteryThreeSw">Section 2</a> 
								</div>
								<div class="panel-collapse collapse" id="batteryThreeSw" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
									<div class="panel-body">
										<div class="col-sm-6">
											<label for="sec2_main_heading_sw" class="control-label">Main Heading*</label>
											<input type="text" name="sec2_main_heading_sw" value="<?=$sec2_main_heading_sw?>" class="form-control" id="sec2_main_heading_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec2_content_sw" class="control-label">Content 3</label>
											<textarea name="sec2_content_sw" id="sec2_content_sw" class="form-control" rows="6"><?=$sec2_content_sw?></textarea>
											
											<label for="sec2_btn_text_sw" class="control-label">Button Text</label>
											<input type="text" name="sec2_btn_text_sw" value="<?=$sec2_btn_text_sw?>" class="form-control" id="sec2_btn_text_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec2_btn_link_sw" class="control-label">Button Link</label>
											<input type="text" name="sec2_btn_link_sw" value="<?=$sec2_btn_link_sw?>" class="form-control" id="sec2_btn_link_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec2_right_img_sw" class="control-label">Right Image (462px x 322px)</label>
											<input type="file" name="sec2_right_img_sw" id="input-file-max-fs" class="dropify" data-max-file-size="1M" data-height="150" <?php if($sec2_right_img_sw AND file_exists(FILES_PATH.'batteries/'.$sec2_right_img_sw)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/batteries/<?=$sec2_right_img_sw?>" <?php } ?> />
										</div>

										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#batteryFourSw" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="batteryFourSw">Section 3</a> 
								</div>
								<div class="panel-collapse collapse" id="batteryFourSw" aria-labelledby="exampleHeadingDefaultFour" role="tabpanel">
									<div class="panel-body">
										<div class="col-sm-6">
											<label for="sec3_main_heading_sw" class="control-label">Main Heading*</label>
											<input type="text" name="sec3_main_heading_sw" value="<?=$sec3_main_heading_sw?>" class="form-control" id="sec3_main_heading_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>
										
										<div class="col-sm-6">											
											<label for="sec3_title1_sw" class="control-label">Title 1*</label>
											<input type="text" name="sec3_title1_sw" value="<?=$sec3_title1_sw?>" class="form-control" id="sec3_title1_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec3_content1_sw" class="control-label">Content 1</label>
											<textarea name="sec3_content1_sw" id="sec3_content1_sw" class="ckeditor" rows="6"><?=$sec3_content1_sw?></textarea>
										</div>
										<div class="col-sm-6">
											<label for="sec3_title2_sw" class="control-label">Title 2*</label>
											<input type="text" name="sec3_title2_sw" value="<?=$sec3_title2_sw?>" class="form-control" id="sec3_title2_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec3_content2_sw" class="control-label">Content 2</label>
											<textarea name="sec3_content2_sw" id="sec3_content2_sw" class="ckeditor" rows="6"><?=$sec3_content2_sw?></textarea>
										</div>
										<div class="clearfix"></div>
										<div class="col-sm-6">
											<label for="sec3_btn_text_sw" class="control-label">Button Text</label>
											<input type="text" name="sec3_btn_text_sw" value="<?=$sec3_btn_text_sw?>" class="form-control" id="sec3_btn_text_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec3_btn_link_sw" class="control-label">Button Link</label>
											<input type="text" name="sec3_btn_link_sw" value="<?=$sec3_btn_link_sw?>" class="form-control" id="sec3_btn_link_sw" data-fv-regexp="true" data-error="Please enter value" required> 
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
									<a class="panel-title collapsed" data-toggle="collapse" href="#batteryFiveSw" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="batteryFiveSw">Section 4</a> 
								</div>
								<div class="panel-collapse collapse" id="batteryFiveSw" aria-labelledby="exampleHeadingDefaultNine" role="tabpanel">
									<div class="panel-body">
										<div class="form-group col-sm-6">
											<label for="sec4_main_heading_sw" class="control-label">Main Heading*</label>
											<input type="text" name="sec4_main_heading_sw" value="<?=$sec4_main_heading_sw?>" class="form-control" id="sec4_main_heading_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>
										<div class="form-group col-sm-6">
											<label for="sec4_content_sw" class="control-label">Content</label>
											<textarea name="sec4_content_sw" class="ckeditor" id="sec4_content_sw"><?=$sec4_content_sw?></textarea>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>-->
						
						
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#batterySixSw" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="batterySixSw">Section 5</a> 
								</div>
								<div class="panel-collapse collapse" id="batterySixSw" aria-labelledby="exampleHeadingDefaultTen" role="tabpanel">
									<div class="panel-body">
										<div class="form-group col-sm-6">
											<label for="sec5_sub_heading_sw" class="control-label">Sub Heading*</label>
											<input type="text" name="sec5_sub_heading_sw" value="<?=$sec5_sub_heading_sw?>" class="form-control" id="sec5_sub_heading_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>
										<div class="form-group col-sm-4">
											<label for="sec5_title1_sw" class="control-label">Title 1</label>
											<input type="text" name="sec5_title1_sw" value="<?=$sec5_title1_sw?>" class="form-control" id="sec5_title1_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											<label for="sec5_content1_sw" class="control-label">Content 1</label>
											<textarea name="sec5_content1_sw" class="form-control" id="sec5_content1_sw" rows="5"><?=$sec5_content1_sw?></textarea>
										</div>
										<div class="form-group col-sm-4">
											<label for="sec5_title2_sw" class="control-label">Title 2</label>
											<input type="text" name="sec5_title2_sw" value="<?=$sec5_title2_sw?>" class="form-control" id="sec5_title2_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
																						
											<label for="sec5_content2_sw" class="control-label">Content 2</label>
											<textarea name="sec5_content2_sw" class="form-control" id="sec5_content2_sw" rows="5"><?=$sec5_content2_sw?></textarea>
										</div>
										<div class="form-group col-sm-4">
											<label for="sec5_title3_sw" class="control-label">Title 3</label>
											<input type="text" name="sec5_title3_sw" value="<?=$sec5_title3_sw?>" class="form-control" id="sec5_title3_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
																						
											<label for="sec5_content3_sw" class="control-label">Content 3</label>
											<textarea name="sec5_content3_sw" class="form-control" id="sec5_content3_sw" rows="5"><?=$sec5_content3_sw?></textarea>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#batterySevenSw" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="batterySevenSw">Section 6</a> 
								</div>
								<div class="panel-collapse collapse" id="batterySevenSw" aria-labelledby="exampleHeadingDefaulteleven" role="tabpanel">
									<div class="panel-body">
										<div class="form-group col-sm-6">
											<label for="sec6_main_heading_sw" class="control-label">Main Heading*</label>
											<input type="text" name="sec6_main_heading_sw" value="<?=$sec6_main_heading_sw	?>" class="form-control" id="sec6_main_heading_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>
										<div class="form-group col-sm-6">
											<label for="sec6_btn_text_sw" class="control-label">Button Text</label>
											<input type="text" name="sec6_btn_text_sw" value="<?=$sec6_btn_text_sw?>" class="form-control" id="sec6_btn_text_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>
										<div class="form-group col-sm-6">
											<label for="sec6_btn_link_sw" class="control-label">Button Link</label>
											<input type="text" name="sec6_btn_link_sw" value="<?=$sec6_btn_link_sw?>" class="form-control" id="sec6_btn_link_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
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
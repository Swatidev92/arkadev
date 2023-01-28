<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 

if($cms->is_post_back()){ 
	if($_FILES["banner"]["name"]){ 
		$_POST["banner"] = uploadImage("banner","charger");
	}
	if($_FILES["sec2_right_img"]["name"]){ 
		$_POST["sec2_right_img"] = uploadImage("sec2_right_img","charger");
	}
	if($_FILES["sec8_img_left"]["name"]){ 
		$_POST["sec8_img_left"] = uploadImage("sec8_img_left","charger");
	}
	if($_FILES["sec8_img_right"]["name"]){ 
		$_POST["sec8_img_right"] = uploadImage("sec8_img_right","charger");
	}
	if($_FILES["sec9_img_left"]["name"]){ 
		$_POST["sec9_img_left"] = uploadImage("sec9_img_left","charger");
	}
	if($_FILES["sec9_img_right"]["name"]){ 
		$_POST["sec9_img_right"] = uploadImage("sec9_img_right","charger");
	}
	if($_FILES["sec3_img"]["name"]){ 
		$_POST["sec3_img"] = uploadImage("sec3_img","charger");
	}
	if($_FILES["sec4_img"]["name"]){ 
		$_POST["sec4_img"] = uploadImage("sec4_img","charger");
	}
	if($_FILES["sec5_right_img"]["name"]){ 
		$_POST["sec5_right_img"] = uploadImage("sec5_right_img","charger");
	}
		
	$cms->sqlquery("rs","charger",$_POST,'id',1);
	$adm->sessset('Record has been updated', 's');
	
	$cms->redir(SITE_PATH_ADM.CPAGE, true);
}	

$rsAdmin=$cms->db_query("select * from #_charger where id='1'");
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
											<label for="banner" class="control-label">Banner Image (1440px X 700px) (Only jpg, png)</label>
											<input type="file" name="banner" id="input-file-max-fs" class="dropify" data-max-file-size="1M" data-height="150" <?php if($banner AND file_exists(FILES_PATH.'charger/'.$banner)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/charger/<?=$banner?>" <?php } ?> />
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
										</div>
										<div class="clearfix"></div>
											
										<div class="col-sm-4">											
											<label for="sec2_title1" class="control-label">Title 1*</label>
											<input type="text" name="sec2_title1" value="<?=$sec2_title1?>" class="form-control" id="sec2_title1"> 
											
											<label for="sec2_content1" class="control-label">Content 1</label>
											<textarea name="sec2_content1" id="sec2_content1" class="form-control" rows="6"><?=$sec2_content1?></textarea>
										</div>
										<div class="col-sm-4">											
											<label for="sec2_title2" class="control-label">Title 2*</label>
											<input type="text" name="sec2_title2" value="<?=$sec2_title2?>" class="form-control" id="sec2_title2"> 
											<div class="help-block with-errors"></div>
											
											<label for="sec2_content2" class="control-label">Content 2</label>
											<textarea name="sec2_content2" id="sec2_content2" class="form-control" rows="6"><?=$sec2_content2?></textarea>
										</div>
										<div class="col-sm-4">											
											<label for="sec2_title3" class="control-label">Title 3*</label>
											<input type="text" name="sec2_title3" value="<?=$sec2_title3?>" class="form-control" id="sec2_title3" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec2_content3" class="control-label">Content 3</label>
											<textarea name="sec2_content3" id="sec2_content3" class="form-control" rows="6"><?=$sec2_content3?></textarea>
										</div>
										<div class="clearfix"></div>
										
										<!--<div class="col-sm-6">
											<label for="sec2_right_img" class="control-label">Right Image</label>
											<input type="file" name="sec2_right_img" id="input-file-max-fs" class="dropify" data-max-file-size="1M" data-height="150" <?php if($sec2_right_img AND file_exists(FILES_PATH.'solar/'.$sec2_right_img)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/solar/<?=$sec2_right_img?>" <?php } ?> />
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>-->
										
										<div class="col-sm-4">
											<label for="sec2_btn_text" class="control-label">Button Text</label>
											<input type="text" name="sec2_btn_text" value="<?=$sec2_btn_text?>" class="form-control" id="sec2_btn_text" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="col-sm-4">
											<label for="sec2_btn_link" class="control-label">Button Link</label>
											<select class="form-control" name="sec2_btn_link" id="sec2_btn_link">
												<option value="">Select Page</option>
												<?php $pageQrySe = $cms->db_query("SELECT id, menu_title FROM #_menu LIMIT 10 ");
													while($pageArrSe = $pageQrySe->fetch_array()){
												?>												
												<option value="<?=$pageArrSe['id']?>" <?=$pageArrSe['id']==$sec2_btn_link?'selected':''?>><?=$pageArrSe['menu_title']?></option>
													<?php } ?>
											</select>
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>
										<div class="form-group col-sm-6">
											<a class="btn view-list-btn" href="<?=SITE_PATH_ADM?>media-manager">Right Slider Images</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#chargerAcc9" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="chargerAcc9">Section 3</a> 
								</div>
								<div class="panel-collapse collapse" id="chargerAcc9" aria-labelledby="exampleHeadingDefaultNine" role="tabpanel">
									<div class="panel-body">
										<div class="form-group col-sm-6">
											<label for="sec8_img_left" class="control-label">Left Image (720px X 600px) (Only jpg, png)</label>
											<input type="file" name="sec8_img_left" id="input-file-max-fs" class="dropify" data-max-file-size="1M" data-height="150" <?php if($sec8_img_left AND file_exists(FILES_PATH.'charger/'.$sec8_img_left)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/charger/<?=$sec8_img_left?>" <?php } ?> />
											<div class="help-block with-errors"></div>
										</div>
										<div class="form-group col-sm-6">
											<label for="sec8_img_right" class="control-label">Right Image (720px X 600px) (Only jpg, png)</label>
											<input type="file" name="sec8_img_right" id="input-file-max-fs" class="dropify" data-max-file-size="1M" data-height="150" <?php if($sec8_img_right AND file_exists(FILES_PATH.'charger/'.$sec8_img_right)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/charger/<?=$sec8_img_right?>" <?php } ?> />
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
									<a class="panel-title collapsed" data-toggle="collapse" href="#exampleHeadingDefaulteleven" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleHeadingDefaulteleven">Section 4</a> 
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
											<label for="sec6_content" class="control-label">Content</label>
											<textarea name="sec6_content" class="form-control" id="sec6_content" rows="5"><?=$sec6_content?></textarea>
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
											<select class="form-control" name="sec6_btn_link" id="sec6_btn_link">
												<option value="">Select Page</option>
												<?php $pageQrySe = $cms->db_query("SELECT id, menu_title FROM #_menu LIMIT 10 ");
													while($pageArrSe = $pageQrySe->fetch_array()){
												?>												
												<option value="<?=$pageArrSe['id']?>" <?=$pageArrSe['id']==$sec6_btn_link?'selected':''?>><?=$pageArrSe['menu_title']?></option>
													<?php } ?>
											</select>
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
									<a class="panel-title collapsed" data-toggle="collapse" href="#exampleHeadingDefaultTen" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleHeadingDefaultTen">Section 5</a> 
								</div>
								<div class="panel-collapse collapse" id="exampleHeadingDefaultTen" aria-labelledby="exampleHeadingDefaultTen" role="tabpanel">
									<div class="panel-body">
										<div class="form-group col-sm-6">
											<label for="sec5_main_heading" class="control-label">Main Heading*</label>
											<input type="text" name="sec5_main_heading" value="<?=$sec5_main_heading?>" class="form-control" id="sec5_main_heading" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>
										<div class="form-group col-sm-6">											
											<label for="sec5_content" class="control-label">Content</label>
											<textarea name="sec5_content" class="form-control" id="sec5_content" rows="5"><?=$sec5_content?></textarea>
										</div>
										<div class="form-group col-sm-6">											
											<label for="sec5_right_img" class="control-label">Image (487px X 497px) (Only jpg, png)</label>
											<input type="file" name="sec5_right_img" id="input-file-max-fs" class="dropify" data-max-file-size="1M" data-height="150" <?php if($sec5_right_img AND file_exists(FILES_PATH.'charger/'.$sec5_right_img)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/charger/<?=$sec5_right_img?>" <?php } ?> />
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#sec6AccEng" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="sec6AccEng">Section 6</a> 
								</div>
								<div class="panel-collapse collapse" id="sec6AccEng" aria-labelledby="exampleHeadingDefaulteleven" role="tabpanel">
									<div class="panel-body">
										<div class="form-group col-sm-6">
											<label for="sec7_sub_heading" class="control-label">Main Heading*</label>
											<input type="text" name="sec7_sub_heading" value="<?=$sec7_sub_heading?>" class="form-control" id="sec7_sub_heading" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>
										<div class="form-group col-sm-6">
											<label for="sec7_main_heading" class="control-label">Sub Heading*</label>
											<textarea name="sec7_main_heading" class="form-control" id="sec7_main_heading"><?=$sec7_main_heading?></textarea> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>
										<div class="form-group col-sm-6">
											<label for="sec7_btn_text" class="control-label">Button Text</label>
											<input type="text" name="sec7_btn_text" value="<?=$sec7_btn_text?>" class="form-control" id="sec7_btn_text" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>
										<div class="form-group col-sm-6">
											<label for="sec7_btn_link" class="control-label">Button Link</label>
											<select class="form-control" name="sec7_btn_link" id="sec7_btn_link">
												<option value="">Select Page</option>
												<?php $pageQrySe = $cms->db_query("SELECT id, menu_title FROM #_menu LIMIT 10 ");
													while($pageArrSe = $pageQrySe->fetch_array()){
												?>												
												<option value="<?=$pageArrSe['id']?>" <?=$pageArrSe['id']==$sec7_btn_link?'selected':''?>><?=$pageArrSe['menu_title']?></option>
													<?php } ?>
											</select>
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
									<a class="panel-title collapsed" data-toggle="collapse" href="#chagerAcc10" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="chagerAcc10">Section 7</a> 
								</div>
								<div class="panel-collapse collapse" id="chagerAcc10" aria-labelledby="exampleHeadingDefaultFour" role="tabpanel">
									<div class="panel-body">
										<div class="col-sm-6">
											<label for="sec9_img_left" class="control-label">Left Image (720px X 600px) (Only jpg, png)</label>
											<input type="file" name="sec9_img_left" id="input-file-max-fs" class="dropify" data-max-file-size="1M" data-height="150" <?php if($sec9_img_left AND file_exists(FILES_PATH.'charger/'.$sec9_img_left)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/charger/<?=$sec9_img_left?>" <?php } ?> />
											<div class="help-block with-errors"></div>
										</div>
										<div class="col-sm-6">
											<label for="sec9_img_right" class="control-label">Right Image (720px X 600px) (Only jpg, png)</label>
											<input type="file" name="sec9_img_right" id="input-file-max-fs" class="dropify" data-max-file-size="1M" data-height="150" <?php if($sec9_img_right AND file_exists(FILES_PATH.'charger/'.$sec9_img_right)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/charger/<?=$sec9_img_right?>" <?php } ?> />
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
									<a class="panel-title collapsed" data-toggle="collapse" href="#chargerMeta" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="chargerMeta">Meta Manager</a> 
								</div>
								<div class="panel-collapse collapse" id="chargerMeta" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
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
									<a class="panel-title collapsed" data-toggle="collapse" href="#chargerAcc1" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="chargerAcc1">Banner </a> 
								</div>
								<div class="panel-collapse collapse in" id="chargerAcc1" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
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
									<a class="panel-title collapsed" data-toggle="collapse" href="#chargerAcc2" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="chargerAcc2">Section 1</a> 
								</div>
								<div class="panel-collapse collapse" id="chargerAcc2" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
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
									<a class="panel-title collapsed" data-toggle="collapse" href="#chargerAcc3" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="chargerAcc3">Section 2</a> 
								</div>
								<div class="panel-collapse collapse" id="chargerAcc3" aria-labelledby="chargerAcc3" role="tabpanel">
									<div class="panel-body">
										<div class="col-sm-6">
											<label for="sec2_main_heading_sw" class="control-label">Main Heading*</label>
											<input type="text" name="sec2_main_heading_sw" value="<?=$sec2_main_heading_sw?>" class="form-control" id="sec2_main_heading_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>
											
										<div class="col-sm-4">											
											<label for="sec2_title1_sw" class="control-label">Title 1*</label>
											<input type="text" name="sec2_title1_sw" value="<?=$sec2_title1_sw?>" class="form-control" id="sec2_title1_sw"> 
											
											<label for="sec2_content1_sw" class="control-label">Content 1</label>
											<textarea name="sec2_content1_sw" id="sec2_content1_sw" class="form-control" rows="6"><?=$sec2_content1_sw?></textarea>
										</div>
										<div class="col-sm-4">											
											<label for="sec2_title2_sw" class="control-label">Title 2*</label>
											<input type="text" name="sec2_title2_sw" value="<?=$sec2_title2_sw?>" class="form-control" id="sec2_title2_sw"> 
											<div class="help-block with-errors"></div>
											
											<label for="sec2_content2_sw" class="control-label">Content 2</label>
											<textarea name="sec2_content2_sw" id="sec2_content2_sw" class="form-control" rows="6"><?=$sec2_content2_sw?></textarea>
										</div>
										<div class="col-sm-4">											
											<label for="sec2_title3_sw" class="control-label">Title 3*</label>
											<input type="text" name="sec2_title3_sw" value="<?=$sec2_title3_sw?>" class="form-control" id="sec2_title3_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec2_content3_sw" class="control-label">Content 3</label>
											<textarea name="sec2_content3_sw" id="sec2_content3_sw" class="form-control" rows="6"><?=$sec2_content3_sw?></textarea>
										</div>
										<div class="clearfix"></div>
										
										<div class="col-sm-4">
											<label for="sec2_btn_text_sw" class="control-label">Button Text</label>
											<input type="text" name="sec2_btn_text_sw" value="<?=$sec2_btn_text_sw?>" class="form-control" id="sec2_btn_text_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="col-sm-4">
											<label for="sec2_btn_link_sw" class="control-label">Button Link</label>
											<select class="form-control" name="sec2_btn_link_sw" id="sec2_btn_link_sw">
												<option value="">Select Page</option>
												<?php $pageQrySe = $cms->db_query("SELECT id, menu_title_sw FROM #_menu LIMIT 10 ");
													while($pageArrSe = $pageQrySe->fetch_array()){
												?>												
												<option value="<?=$pageArrSe['id']?>" <?=$pageArrSe['id']==$sec2_btn_link_sw?'selected':''?>><?=$pageArrSe['menu_title_sw']?></option>
													<?php } ?>
											</select> 
											<div class="help-block with-errors"></div>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
												
						
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#chargerAcc6" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="chargerAcc6">Section 3</a> 
								</div>
								<div class="panel-collapse collapse" id="chargerAcc6" aria-labelledby="exampleHeadingDefaulteleven" role="tabpanel">
									<div class="panel-body">
										<div class="form-group col-sm-6">
											<label for="sec6_main_heading_sw" class="control-label">Main Heading*</label>
											<input type="text" name="sec6_main_heading_sw" value="<?=$sec6_main_heading_sw?>" class="form-control" id="sec6_main_heading_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>
										<div class="form-group col-sm-6">											
											<label for="sec6_content_sw" class="control-label">Content</label>
											<textarea name="sec6_content_sw" class="form-control" id="sec6_content_sw" rows="5"><?=$sec6_content_sw?></textarea>
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
											<select class="form-control" name="sec6_btn_link_sw" id="sec6_btn_link_sw">
												<option value="">Select Page</option>
												<?php $pageQrySe = $cms->db_query("SELECT id, menu_title_sw FROM #_menu LIMIT 10 ");
													while($pageArrSe = $pageQrySe->fetch_array()){
												?>												
												<option value="<?=$pageArrSe['id']?>" <?=$pageArrSe['id']==$sec6_btn_link_sw?'selected':''?>><?=$pageArrSe['menu_title_sw']?></option>
													<?php } ?>
											</select> 
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
									<a class="panel-title collapsed" data-toggle="collapse" href="#chargerAcc5" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="chargerAcc5">Section 4</a> 
								</div>
								<div class="panel-collapse collapse" id="chargerAcc5" aria-labelledby="exampleHeadingDefaultTen" role="tabpanel">
									<div class="panel-body">
										<div class="form-group col-sm-6">
											<label for="sec5_main_heading_sw" class="control-label">Main Heading*</label>
											<input type="text" name="sec5_main_heading_sw" value="<?=$sec5_main_heading_sw?>" class="form-control" id="sec5_main_heading_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>
										<div class="form-group col-sm-6">											
											<label for="sec5_content_sw" class="control-label">Content</label>
											<textarea name="sec5_content_sw" class="form-control" id="sec5_content_sw" rows="5"><?=$sec5_content_sw?></textarea>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
						
						
						
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#chargerAcc7" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="chargerAcc7">Section 5</a> 
								</div>
								<div class="panel-collapse collapse" id="chargerAcc7" aria-labelledby="exampleHeadingDefaulteleven" role="tabpanel">
									<div class="panel-body">
										<div class="form-group col-sm-6">
											<label for="sec7_sub_heading_sw" class="control-label">Main Heading*</label>
											<input type="text" name="sec7_sub_heading_sw" value="<?=$sec7_sub_heading_sw?>" class="form-control" id="sec7_sub_heading_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>
										<div class="form-group col-sm-6">
											<label for="sec7_main_heading_sw" class="control-label">Sub Heading*</label>
											<textarea name="sec7_main_heading_sw" class="form-control" id="sec7_main_heading_sw"><?=$sec7_main_heading_sw?></textarea> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>
										<div class="form-group col-sm-6">
											<label for="sec7_btn_text_sw" class="control-label">Button Text</label>
											<input type="text" name="sec7_btn_text_sw" value="<?=$sec7_btn_text_sw?>" class="form-control" id="sec7_btn_text_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>
										<div class="form-group col-sm-6">
											<label for="sec7_btn_link_sw" class="control-label">Button Link</label>
											<select class="form-control" name="sec7_btn_link_sw" id="sec7_btn_link_sw">
												<option value="">Select Page</option>
												<?php $pageQrySe = $cms->db_query("SELECT id, menu_title_sw FROM #_menu LIMIT 10 ");
													while($pageArrSe = $pageQrySe->fetch_array()){
												?>												
												<option value="<?=$pageArrSe['id']?>" <?=$pageArrSe['id']==$sec7_btn_link_sw?'selected':''?>><?=$pageArrSe['menu_title_sw']?></option>
													<?php } ?>
											</select> 
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
									<a class="panel-title collapsed" data-toggle="collapse" href="#chargerMetaSW" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="chargerMetaSW">Meta Manager</a> 
								</div>
								<div class="panel-collapse collapse" id="chargerMetaSW" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
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
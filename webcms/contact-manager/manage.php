<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 

if($cms->is_post_back()){ 
	if($_FILES["banner"]["name"]){ 
		$_POST["banner"] = uploadImage("banner","charger");
	}
	$cms->sqlquery("rs","contact",$_POST,'id',1);
	$adm->sessset('Record has been updated', 's');
	
	$cms->redir(SITE_PATH_ADM.CPAGE, true);
}	

$rsAdmin=$cms->db_query("select * from #_contact where id='1'");
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
									<a class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultOne" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleCollapseDefaultOne">Contact Us </a> 
								</div>
								<div class="panel-collapse collapse in" id="exampleCollapseDefaultOne" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
									<div class="panel-body">									
										<div class="form-group col-sm-6">
											<label for="contact_content" class="control-label">Content</label>
											<textarea name="contact_content" id="contact_content" class="form-control"><?=$contact_content?></textarea>
										</div>
										<div class="clearfix"></div>
										<div class="form-group col-sm-6">
											<label for="contact_btn_text" class="control-label">Button Text</label>
											<input type="text" name="contact_btn_text" value="<?=$contact_btn_text?>" class="form-control" id="contact_btn_text"> 
										</div>
										<div class="form-group col-sm-6">
											<label for="contact_btn_link" class="control-label">Button Link</label>
											<input type="text" name="contact_btn_link" value="<?=$contact_btn_link?>" class="form-control" id="contact_btn_link"> 
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultTwo" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleCollapseDefaultTwo">Get Connected</a> 
								</div>
								<div class="panel-collapse collapse" id="exampleCollapseDefaultTwo" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
									<div class="panel-body">									
										<div class="form-group col-sm-6">
											<label for="get_connect_content" class="control-label">Content</label>
											<textarea name="get_connect_content" id="get_connect_content" class="form-control"><?=$get_connect_content?></textarea>
										</div>
										<div class="clearfix"></div>
										<div class="form-group col-sm-6">
											<label for="get_connect_btn_text" class="control-label">Button Text</label>
											<input type="text" name="get_connect_btn_text" value="<?=$get_connect_btn_text?>" class="form-control" id="get_connect_btn_text"> 
										</div>
										<div class="form-group col-sm-6">
											<label for="get_connect_btn_link" class="control-label">Button Link</label>
											<input type="text" name="get_connect_btn_link" value="<?=$get_connect_btn_link?>" class="form-control" id="get_connect_btn_link"> 
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultThree" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleCollapseDefaultThree">Become a Ambassador</a> 
								</div>
								<div class="panel-collapse collapse" id="exampleCollapseDefaultThree" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
									<div class="panel-body">									
										<div class="form-group col-sm-6">
											<label for="ambassador_content" class="control-label">Content</label>
											<textarea name="ambassador_content" id="ambassador_content" class="form-control"><?=$ambassador_content?></textarea>
										</div>
										<div class="clearfix"></div>
										<div class="form-group col-sm-6">
											<label for="ambassador_btn_text" class="control-label">Button Text</label>
											<input type="text" name="ambassador_btn_text" value="<?=$ambassador_btn_text?>" class="form-control" id="ambassador_btn_text"> 
										</div>
										<div class="form-group col-sm-6">
											<label for="ambassador_btn_link" class="control-label">Button Link</label>
											<input type="text" name="ambassador_btn_link" value="<?=$ambassador_btn_link?>" class="form-control" id="ambassador_btn_link"> 
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#exampleHeadingDefaultFour" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleHeadingDefaultFour">Career</a> 
								</div>
								<div class="panel-collapse collapse" id="exampleHeadingDefaultFour" aria-labelledby="exampleHeadingDefaultFour" role="tabpanel">
									<div class="panel-body">									
										<div class="form-group col-sm-6">
											<label for="career_content" class="control-label">Content</label>
											<textarea name="career_content" id="career_content" class="form-control"><?=$career_content?></textarea>
										</div>
										<div class="clearfix"></div>
										<div class="form-group col-sm-6">
											<label for="career_btn_text" class="control-label">Button Text</label>
											<input type="text" name="career_btn_text" value="<?=$career_btn_text?>" class="form-control" id="career_btn_text"> 
										</div>
										<div class="form-group col-sm-6">
											<label for="career_btn_link" class="control-label">Button Link</label>
											<input type="text" name="career_btn_link" value="<?=$career_btn_link?>" class="form-control" id="career_btn_link"> 
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#exampleHeadingDefaultNine" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleHeadingDefaultNine">Support</a> 
								</div>
								<div class="panel-collapse collapse" id="exampleHeadingDefaultNine" aria-labelledby="exampleHeadingDefaultNine" role="tabpanel">
									<div class="panel-body">									
										<div class="form-group col-sm-6">
											<label for="support_content" class="control-label">Content</label>
											<textarea name="support_content" id="support_content" class="form-control"><?=$support_content?></textarea>
										</div>
										<div class="clearfix"></div>
										<div class="form-group col-sm-6">
											<label for="support_btn_text" class="control-label">Button Text</label>
											<input type="text" name="support_btn_text" value="<?=$support_btn_text?>" class="form-control" id="support_btn_text"> 
										</div>
										<div class="form-group col-sm-6">
											<label for="support_btn_link" class="control-label">Button Link</label>
											<input type="text" name="support_btn_link" value="<?=$support_btn_link?>" class="form-control" id="support_btn_link"> 
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
						
						
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#exampleHeadingDefaultTen" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleHeadingDefaultTen">Legal</a> 
								</div>
								<div class="panel-collapse collapse" id="exampleHeadingDefaultTen" aria-labelledby="exampleHeadingDefaultTen" role="tabpanel">
									<div class="panel-body">									
										<div class="form-group col-sm-6">
											<label for="legal_content" class="control-label">Content</label>
											<textarea name="legal_content" id="legal_content" class="form-control"><?=$legal_content?></textarea>
										</div>
										<div class="clearfix"></div>
										<div class="form-group col-sm-6">
											<label for="legal_btn_text" class="control-label">Button Text</label>
											<input type="text" name="legal_btn_text" value="<?=$legal_btn_text?>" class="form-control" id="legal_btn_text"> 
										</div>
										<div class="form-group col-sm-6">
											<label for="legal_btn_link" class="control-label">Button Link</label>
											<input type="text" name="legal_btn_link" value="<?=$legal_btn_link?>" class="form-control" id="legal_btn_link"> 
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#exampleHeadingDefaulteleven" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleHeadingDefaulteleven">Head Office</a> 
								</div>
								<div class="panel-collapse collapse" id="exampleHeadingDefaulteleven" aria-labelledby="exampleHeadingDefaulteleven" role="tabpanel">
									<div class="panel-body">
										<div class="form-group col-sm-6">											
											<label for="head_ofc_address" class="control-label">Address</label>
											<textarea name="head_ofc_address" class="ckeditor" id="head_ofc_address" rows="5"><?=$head_ofc_address?></textarea>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#sec6AccEng" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="sec6AccEng">Emails</a> 
								</div>
								<div class="panel-collapse collapse" id="sec6AccEng" aria-labelledby="exampleHeadingDefaulteleven" role="tabpanel">
									<div class="panel-body">
										<div class="form-group col-sm-6">											
											<label for="emails" class="control-label">Emails</label>
											<textarea name="emails" class="ckeditor" id="emails"><?=$emails?></textarea>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#sec7AccEng" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="sec7AccEng">Overseas  Address</a> 
								</div>
								<div class="panel-collapse collapse" id="sec7AccEng" aria-labelledby="exampleHeadingDefaulteleven" role="tabpanel">
									<div class="panel-body">
										<div class="form-group col-sm-6">											
											<label for="overseas_address" class="control-label">Address</label>
											<textarea name="overseas_address" class="ckeditor" id="overseas_address" rows="5"><?=$overseas_address?></textarea>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#sec8AccEng" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="sec8AccEng">Phone</a> 
								</div>
								<div class="panel-collapse collapse" id="sec8AccEng" aria-labelledby="exampleHeadingDefaulteleven" role="tabpanel">
									<div class="panel-body">
										<div class="form-group col-sm-6">											
											<label for="phones" class="control-label">Phone</label>
											<textarea name="phones" class="ckeditor" id="phones" rows="5"><?=$phones?></textarea>
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
											<input type="text" name="sec2_btn_link_sw" value="<?=$sec2_btn_link_sw?>" class="form-control" id="sec2_btn_link_sw" data-fv-regexp="true" data-error="Please enter value" required> 
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
									<a class="panel-title collapsed" data-toggle="collapse" href="#chargerAcc4" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="chargerAcc4">Section 4</a> 
								</div>
								<div class="panel-collapse collapse" id="chargerAcc4" aria-labelledby="exampleHeadingDefaultNine" role="tabpanel">
									<div class="panel-body">
										<div class="form-group col-sm-6">
											<label for="sec4_main_heading_sw" class="control-label">Main Heading*</label>
											<input type="text" name="sec4_main_heading_sw" value="<?=$sec4_main_heading_sw?>" class="form-control" id="sec4_main_heading_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>
										<div class="col-sm-3">											
											<label for="sec4_title1_sw" class="control-label">Title 1</label>
											<input type="text" name="sec4_title1_sw" value="<?=$sec4_title1_sw?>" class="form-control" id="sec4_title1_sw"> 
											
											<label for="sec4_content1_sw" class="control-label">Content 1</label>
											<textarea name="sec4_content1_sw" id="sec4_content1_sw" class="form-control" rows="6"><?=$sec4_content1_sw?></textarea>
										</div>
										<div class="col-sm-3">											
											<label for="sec4_title2_sw" class="control-label">Title 2</label>
											<input type="text" name="sec4_title2_sw" value="<?=$sec4_title2_sw?>" class="form-control" id="sec4_title2_sw"> 
											<div class="help-block with-errors"></div>
											
											<label for="sec4_content2_sw" class="control-label">Content 2</label>
											<textarea name="sec4_content2_sw" id="sec4_content2_sw" class="form-control" rows="6"><?=$sec4_content2_sw?></textarea>
										</div>
										<div class="col-sm-3">											
											<label for="sec4_title3_sw" class="control-label">Title 3</label>
											<input type="text" name="sec4_title3_sw" value="<?=$sec4_title3_sw?>" class="form-control" id="sec4_title3_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec4_content3_sw" class="control-label">Content 3</label>
											<textarea name="sec4_content3_sw" id="sec4_content3_sw" class="form-control" rows="6"><?=$sec4_content3_sw?></textarea>
										</div>
										<div class="col-sm-3">											
											<label for="sec4_title4_sw" class="control-label">Title 4</label>
											<input type="text" name="sec4_title4_sw" value="<?=$sec4_title4_sw?>" class="form-control" id="sec4_title4_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec4_content4_sw" class="control-label">Content 4</label>
											<textarea name="sec4_content4_sw" id="sec4_content4_sw" class="form-control" rows="6"><?=$sec4_content4_sw?></textarea>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
						
						
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#chargerAcc5" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="chargerAcc5">Section 5</a> 
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
									<a class="panel-title collapsed" data-toggle="collapse" href="#chargerAcc6" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="chargerAcc6">Section 6</a> 
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
											<input type="text" name="sec6_btn_link_sw" value="<?=$sec6_btn_link_sw?>" class="form-control" id="sec6_btn_link_sw" data-fv-regexp="true" data-error="Please enter value" required> 
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
									<a class="panel-title collapsed" data-toggle="collapse" href="#chargerAcc7" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="chargerAcc7">Section 7</a> 
								</div>
								<div class="panel-collapse collapse" id="chargerAcc7" aria-labelledby="exampleHeadingDefaulteleven" role="tabpanel">
									<div class="panel-body">
										<div class="form-group col-sm-6">
											<label for="sec7_main_heading_sw" class="control-label">Main Heading*</label>
											<input type="text" name="sec7_main_heading_sw" value="<?=$sec7_main_heading_sw?>" class="form-control" id="sec7_main_heading_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>
										<div class="form-group col-sm-6">
											<label for="sec7_sub_heading_sw" class="control-label">Sub Heading*</label>
											<input type="text" name="sec7_sub_heading_sw" value="<?=$sec7_sub_heading_sw?>" class="form-control" id="sec7_sub_heading_sw" data-fv-regexp="true" data-error="Please enter value" required> 
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
											<input type="text" name="sec7_btn_link_sw" value="<?=$sec7_btn_link_sw?>" class="form-control" id="sec7_btn_link_sw" data-fv-regexp="true" data-error="Please enter value" required> 
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
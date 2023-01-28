<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 

if($cms->is_post_back()){ 
		
		
		$_POSTS['ev_charger_types'] = json_encode($_POST['list']);



//print_r($field_values_array);

//echo $field_values_array[0][0];

//echo json_encode($field_values_array);die;


	$cms->sqlquery("rs","customer_price",$_POSTS,'id',1);
	$adm->sessset('Record has been updated', 's');
	
	//$cms->redir(SITE_PATH_ADM.CPAGE.'?mode=add&id='.$uids, true);
	$cms->redir(SITE_PATH_ADM.CPAGE, true);
}	

$rsAdmin=$cms->db_query("select * from #_customer_price where id='1'");
$arrAdmin=$cms->db_fetch_array($rsAdmin);
@extract($arrAdmin);

echo $ev_charger_types;
$obj = json_decode($ev_charger_types);

echo $obj->name;
echo $obj->price;

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
										<div class="list_wrapper">  
                                <div class="row">

                                    <div class="col-xs-4 col-sm-4 col-md-4">

                                        <div class="form-group">
                                            Item Name
                                            <input name="list[0][name]" type="text" placeholder="Type Item Name" class="form-control"/>
                                            
                                        </div>
                                    </div>

                                    <div class="col-xs-7 col-sm-7 col-md-7">
                                        <div class="form-group">
                                            Quantity
                                            <input autocomplete="off" name="list[0][price]" type="text" placeholder="Type Item Quantity" class="form-control"/>
                                        </div>
                                    </div> 

                                    <div class="col-xs-1 col-sm-1 col-md-1">
                                        <br>
                                       <button class="btn btn-primary list_add_button" type="button">+</button>
                                    </div>
                                </div>
                            </div>
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
										<div class="col-sm-8">														
											<label for="sec1_content" class="control-label">Content 1</label>
											<textarea name="sec1_content" id="sec1_content" class="ckeditor"><?=$sec1_content?></textarea>
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
								<div class="panel-collapse collapse" id="exampleCollapseDefaultThree" aria-labelledby="exampleCollapseDefaultThree" role="tabpanel">
									<div class="panel-body">
										<div class="col-sm-6">														
											<label for="sec2_main_heading" class="control-label">Main Heading</label>
											<input type="text" name="sec2_main_heading" value="<?=$sec2_main_heading?>" class="form-control" id="sec2_main_heading" data-fv-regexp="true" data-error="Please enter value"> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>
										<div class="form-group col-sm-6">
											<label for="sec2_title1" class="control-label">Title 1</label>
											<input type="text" name="sec2_title1" value="<?=$sec2_title1?>" class="form-control" id="sec2_title1" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec2_icon1" class="control-label">Icon 1</label>
											<input type="file" name="sec2_icon1" id="input-file-max-fs" class="dropify" data-max-file-size="1M" data-height="150" <?php if($sec2_icon1 AND file_exists(FILES_PATH.'about/'.$sec2_icon1)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/about/<?=$sec2_icon1?>" <?php } ?> />
											
											<label for="sec2_content1" class="control-label">Content 1</label>
											<textarea name="sec2_content1" class="form-control" id="sec2_content1" rows="5"><?=$sec2_content1?></textarea>
										</div>
										<div class="clearfix"></div>
										
										<div class="form-group col-sm-6">
											<label for="sec2_title2" class="control-label">Title 2</label>
											<input type="text" name="sec2_title2" value="<?=$sec2_title2?>" class="form-control" id="sec2_title2" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec2_icon2" class="control-label">Icon 2</label>
											<input type="file" name="sec2_icon2" id="input-file-max-fs" class="dropify" data-max-file-size="1M" data-height="150" <?php if($sec2_icon2 AND file_exists(FILES_PATH.'about/'.$sec2_icon2)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/about/<?=$sec2_icon2?>" <?php } ?> />
											
											<label for="sec2_content2" class="control-label">Content 2</label>
											<textarea name="sec2_content2" class="form-control" id="sec2_content2" rows="5"><?=$sec2_content2?></textarea>
										</div>
										<div class="clearfix"></div>
										
										<div class="form-group col-sm-6">
											<label for="sec2_title3" class="control-label">Title 3</label>
											<input type="text" name="sec2_title3" value="<?=$sec2_title3?>" class="form-control" id="sec2_title3" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec2_icon3" class="control-label">Icon 3</label>
											<input type="file" name="sec2_icon3" id="input-file-max-fs" class="dropify" data-max-file-size="1M" data-height="150" <?php if($sec2_icon3 AND file_exists(FILES_PATH.'about/'.$sec2_icon3)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/about/<?=$sec2_icon3?>" <?php } ?> />
											
											<label for="sec2_content3" class="control-label">Content 3</label>
											<textarea name="sec2_content3" class="form-control" id="sec2_content3" rows="5"><?=$sec2_content3?></textarea>
										</div>
										<div class="clearfix"></div><div class="form-group col-sm-6">
											<label for="sec2_title4" class="control-label">Title 4</label>
											<input type="text" name="sec2_title4" value="<?=$sec2_title4?>" class="form-control" id="sec2_title4" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec2_icon4" class="control-label">Icon 4</label>
											<input type="file" name="sec2_icon4" id="input-file-max-fs" class="dropify" data-max-file-size="1M" data-height="150" <?php if($sec2_icon4 AND file_exists(FILES_PATH.'about/'.$sec2_icon4)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/about/<?=$sec2_icon4?>" <?php } ?> />
											
											<label for="sec2_content4" class="control-label">Content 4</label>
											<textarea name="sec2_content4" class="form-control" id="sec2_content4" rows="5"><?=$sec2_content4?></textarea>
										</div>
										<div class="clearfix"></div><div class="form-group col-sm-6">
											<label for="sec2_title5" class="control-label">Title 5</label>
											<input type="text" name="sec2_title5" value="<?=$sec2_title5?>" class="form-control" id="sec2_title5" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec2_icon5" class="control-label">Icon 5</label>
											<input type="file" name="sec2_icon5" id="input-file-max-fs" class="dropify" data-max-file-size="1M" data-height="150" <?php if($sec2_icon5 AND file_exists(FILES_PATH.'about/'.$sec2_icon5)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/about/<?=$sec2_icon5?>" <?php } ?> />
											
											<label for="sec2_content5" class="control-label">Content 5</label>
											<textarea name="sec2_content5" class="form-control" id="sec2_content5" rows="5"><?=$sec2_content5?></textarea>
										</div>
										<div class="clearfix"></div>
										
										<div class="form-group col-sm-6">									
											<label for="sec2_content6" class="control-label">Content 6</label>
											<textarea name="sec2_content6" class="ckeditor" id="sec2_content6" rows="5"><?=$sec2_content6?></textarea>
										</div>
										<div class="clearfix"></div>
										<div class="col-sm-6">
											<label for="sec2_btn_text" class="control-label">Button Text*</label>
											<input type="text" name="sec2_btn_text" value="<?=$sec2_btn_text?>" class="form-control" id="sec2_btn_text" placeholder="Button Text" data-fv-regexp="true" data-error="Please enter value"> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="col-sm-6">
											<label for="sec2_btn_link" class="control-label">Button Link*</label>
											<input type="text" name="sec2_btn_link" value="<?=$sec2_btn_link?>" class="form-control" id="sec2_btn_link" placeholder="Button Link" data-fv-regexp="true" data-error="Please enter value"> 
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
										<div class="col-sm-3">
											<label for="count1" class="control-label">Count 1*</label>
											<input type="text" name="count1" value="<?=$count1?>" class="form-control" id="count1" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="count_text1" class="control-label">Count Text 1*</label>
											<input type="text" name="count_text1" value="<?=$count_text1?>" class="form-control" id="count_text1" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="col-sm-3">
											<label for="count2" class="control-label">Count 2*</label>
											<input type="text" name="count2" value="<?=$count2?>" class="form-control" id="count2" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="count_text2" class="control-label">Count Text 2*</label>
											<input type="text" name="count_text2" value="<?=$count_text2?>" class="form-control" id="count_text2" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="col-sm-3">
											<label for="count3" class="control-label">Count 3*</label>
											<input type="text" name="count3" value="<?=$count3?>" class="form-control" id="count3" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="count_text3" class="control-label">Count Text 3*</label>
											<input type="text" name="count_text3" value="<?=$count_text3?>" class="form-control" id="count_text3" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div><div class="col-sm-3">
											<label for="count4" class="control-label">Count 4*</label>
											<input type="text" name="count4" value="<?=$count4?>" class="form-control" id="count4" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="count_text4" class="control-label">Count Text 4*</label>
											<input type="text" name="count_text4" value="<?=$count_text4?>" class="form-control" id="count_text4" data-fv-regexp="true" data-error="Please enter value" required> 
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
									<a class="panel-title collapsed" data-toggle="collapse" href="#exampleHeadingDefaultFour1" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleHeadingDefaultFour1">Section 4</a> 
								</div>
								<div class="panel-collapse collapse" id="exampleHeadingDefaultFour1" aria-labelledby="exampleHeadingDefaultFour1" role="tabpanel">
									<div class="panel-body">								
										<div class="form-group col-sm-6">									
											<label for="sec4_main_heading" class="control-label">Content</label>
											<textarea name="sec4_main_heading" class="form-control" id="sec4_main_heading" rows="5"><?=$sec4_main_heading?></textarea>
										</div>
										<div class="clearfix"></div>
										<div class="col-sm-6">
											<label for="sec4_btn_text" class="control-label">Button Text*</label>
											<input type="text" name="sec4_btn_text" value="<?=$sec4_btn_text?>" class="form-control" id="sec4_btn_text" placeholder="Button Text" data-fv-regexp="true" data-error="Please enter value"> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="col-sm-6">
											<label for="sec4_btn_link" class="control-label">Button Link*</label>
											<input type="text" name="sec4_btn_link" value="<?=$sec4_btn_link?>" class="form-control" id="sec4_btn_link" placeholder="Button Link" data-fv-regexp="true" data-error="Please enter value"> 
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
									<a class="panel-title collapsed" data-toggle="collapse" href="#aboutMeta" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="aboutMeta">Meta Manager</a> 
								</div>
								<div class="panel-collapse collapse" id="aboutMeta" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
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
									<a class="panel-title collapsed" data-toggle="collapse" href="#aboutOneSW" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="aboutOneSW">Banner </a> 
								</div>
								<div class="panel-collapse collapse in" id="aboutOneSW" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
									<div class="panel-body">										
										<div class="col-sm-6">
											<label for="banner_text_sw" class="control-label">Banner Text</label>
											<input type="text" name="banner_text_sw" value="<?=$banner_text_sw?>" class="form-control" id="banner_text_sw" placeholder="Banner Text" data-fv-regexp="true" data-error="Please enter value"> 
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#aboutTwoSW" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="aboutTwoSW">Section 1</a> 
								</div>
								<div class="panel-collapse collapse" id="aboutTwoSW" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
									<div class="panel-body">
										<div class="col-sm-8">														
											<label for="sec1_content_sw" class="control-label">Content 1</label>
											<textarea name="sec1_content_sw" id="sec1_content_sw" class="ckeditor"><?=$sec1_content_sw?></textarea>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
										
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#aboutThreeSW" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="aboutThreeSW">Section 2</a> 
								</div>
								<div class="panel-collapse collapse" id="aboutThreeSW" aria-labelledby="exampleCollapseDefaultThree" role="tabpanel">
									<div class="panel-body">
										<div class="col-sm-6">														
											<label for="sec2_main_heading_sw" class="control-label">Main Heading</label>
											<input type="text" name="sec2_main_heading_sw" value="<?=$sec2_main_heading_sw?>" class="form-control" id="sec2_main_heading_sw" data-fv-regexp="true" data-error="Please enter value"> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>
										<div class="form-group col-sm-6">
											<label for="sec2_title1_sw" class="control-label">Title 1</label>
											<input type="text" name="sec2_title1_sw" value="<?=$sec2_title1_sw?>" class="form-control" id="sec2_title1_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec2_content1_sw" class="control-label">Content 1</label>
											<textarea name="sec2_content1_sw" class="form-control" id="sec2_content1_sw" rows="5"><?=$sec2_content1_sw?></textarea>
										</div>
										<div class="clearfix"></div>
										
										<div class="form-group col-sm-6">
											<label for="sec2_title2_sw" class="control-label">Title 2</label>
											<input type="text" name="sec2_title2_sw" value="<?=$sec2_title2_sw?>" class="form-control" id="sec2_title2_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec2_content2_sw" class="control-label">Content 2</label>
											<textarea name="sec2_content2_sw" class="form-control" id="sec2_content2_sw" rows="5"><?=$sec2_content2_sw?></textarea>
										</div>
										<div class="clearfix"></div>
										
										<div class="form-group col-sm-6">
											<label for="sec2_title3_sw" class="control-label">Title 3</label>
											<input type="text" name="sec2_title3_sw" value="<?=$sec2_title3_sw?>" class="form-control" id="sec2_title3_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec2_content3_sw" class="control-label">Content 3</label>
											<textarea name="sec2_content3_sw" class="form-control" id="sec2_content3_sw" rows="5"><?=$sec2_content3_sw?></textarea>
										</div>
										<div class="clearfix"></div><div class="form-group col-sm-6">
											<label for="sec2_title4_sw" class="control-label">Title 4</label>
											<input type="text" name="sec2_title4_sw" value="<?=$sec2_title4_sw?>" class="form-control" id="sec2_title4_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec2_content4_sw" class="control-label">Content 4</label>
											<textarea name="sec2_content4_sw" class="form-control" id="sec2_content4_sw" rows="5"><?=$sec2_content4_sw?></textarea>
										</div>
										<div class="clearfix"></div><div class="form-group col-sm-6">
											<label for="sec2_title5_sw" class="control-label">Title 5</label>
											<input type="text" name="sec2_title5_sw" value="<?=$sec2_title5_sw?>" class="form-control" id="sec2_title5_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
											
											<label for="sec2_content5_sw" class="control-label">Content 5</label>
											<textarea name="sec2_content5_sw" class="form-control" id="sec2_content5_sw" rows="5"><?=$sec2_content5_sw?></textarea>
										</div>
										<div class="clearfix"></div>
										
										<div class="form-group col-sm-6">									
											<label for="sec2_content6_sw" class="control-label">Content 6</label>
											<textarea name="sec2_content6_sw" class="ckeditor" id="sec2_content6_sw" rows="5"><?=$sec2_content6_sw?></textarea>
										</div>
										<div class="clearfix"></div>
										<div class="col-sm-6">
											<label for="sec2_btn_text_sw" class="control-label">Button Text*</label>
											<input type="text" name="sec2_btn_text_sw" value="<?=$sec2_btn_text_sw?>" class="form-control" id="sec2_btn_text_sw" placeholder="Button Text" data-fv-regexp="true" data-error="Please enter value"> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="col-sm-6">
											<label for="sec2_btn_link_sw" class="control-label">Button Link*</label>
											<input type="text" name="sec2_btn_link_sw" value="<?=$sec2_btn_link_sw?>" class="form-control" id="sec2_btn_link_sw" placeholder="Button Link" data-fv-regexp="true" data-error="Please enter value"> 
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
									<a class="panel-title collapsed" data-toggle="collapse" href="#aboutFourSW" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="aboutFourSW">Section 3</a> 
								</div>
								<div class="panel-collapse collapse" id="aboutFourSW" aria-labelledby="exampleHeadingDefaultFour" role="tabpanel">
									<div class="panel-body">
										<div class="col-sm-3">											
											<label for="count_text1_sw" class="control-label">Count Text 1*</label>
											<input type="text" name="count_text1_sw" value="<?=$count_text1_sw?>" class="form-control" id="count_text1_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="col-sm-3">											
											<label for="count_text2_sw" class="control-label">Count Text 2*</label>
											<input type="text" name="count_text2_sw" value="<?=$count_text2_sw?>" class="form-control" id="count_text2_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="col-sm-3">											
											<label for="count_text3_sw" class="control-label">Count Text 3*</label>
											<input type="text" name="count_text3_sw" value="<?=$count_text3_sw?>" class="form-control" id="count_text3_sw" data-fv-regexp="true" data-error="Please enter value" required> 
											<div class="help-block with-errors"></div>
										</div><div class="col-sm-3">											
											<label for="count_text4_sw" class="control-label">Count Text 4*</label>
											<input type="text" name="count_text4_sw" value="<?=$count_text4_sw?>" class="form-control" id="count_text4_sw" data-fv-regexp="true" data-error="Please enter value" required> 
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
									<a class="panel-title collapsed" data-toggle="collapse" href="#aboutFiveSW" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="aboutFiveSW">Section 4</a> 
								</div>
								<div class="panel-collapse collapse" id="aboutFiveSW" aria-labelledby="exampleHeadingDefaultFour1" role="tabpanel">
									<div class="panel-body">								
										<div class="form-group col-sm-6">									
											<label for="sec4_main_heading_sw" class="control-label">Content</label>
											<textarea name="sec4_main_heading_sw" class="form-control" id="sec4_main_heading_sw" rows="5"><?=$sec4_main_heading_sw?></textarea>
										</div>
										<div class="clearfix"></div>
										<div class="col-sm-6">
											<label for="sec4_btn_text_sw" class="control-label">Button Text*</label>
											<input type="text" name="sec4_btn_text_sw" value="<?=$sec4_btn_text_sw?>" class="form-control" id="sec4_btn_text_sw" placeholder="Button Text" data-fv-regexp="true" data-error="Please enter value"> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="col-sm-6">
											<label for="sec4_btn_link_sw" class="control-label">Button Link*</label>
											<input type="text" name="sec4_btn_link_sw" value="<?=$sec4_btn_link_sw?>" class="form-control" id="sec4_btn_link_sw" placeholder="Button Link" data-fv-regexp="true" data-error="Please enter value"> 
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
									<a class="panel-title collapsed" data-toggle="collapse" href="#aboutMetaSW" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="aboutMetaSW">Meta Manager</a> 
								</div>
								<div class="panel-collapse collapse" id="aboutMetaSW" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
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

<script type="text/javascript">
$(document).ready(function()

    {
	var x = 0; //Initial field counter
	var list_maxField = 10; //Input fields increment limitation
	
        //Once add button is clicked
	$('.list_add_button').click(function()
	    {
	    //Check maximum number of input fields
	    if(x < list_maxField){ 
	        x++; //Increment field counter
	        var list_fieldHTML = '<div class="row"><div class="col-xs-4 col-sm-4 col-md-4"><div class="form-group"><input name="list['+x+'][name]" type="text" placeholder="Type Item Name" class="form-control"/></div></div><div class="col-xs-7 col-sm-7 col-md-7"><div class="form-group"><input name="list['+x+'][price]" type="text" placeholder="Type Item Quantity" class="form-control"/></div></div><div class="col-xs-1 col-sm-7 col-md-1"><a href="javascript:void(0);" class="list_remove_button btn btn-danger">-</a></div></div>'; //New input field html 
	        $('.list_wrapper').append(list_fieldHTML); //Add field html
	    }
        });
    
        //Once remove button is clicked
        $('.list_wrapper').on('click', '.list_remove_button', function()
        {
           $(this).closest('div.row').remove(); //Remove field html
           x--; //Decrement field counter
        });
});
</script>
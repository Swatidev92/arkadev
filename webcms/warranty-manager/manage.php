<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 

if($cms->is_post_back()){ 
	
	$cms->sqlquery("rs","warranty",$_POST,'id',1);
	$adm->sessset('Record has been updated', 's');
	
	//$cms->redir(SITE_PATH_ADM.CPAGE.'?mode=add&id='.$uids, true);
	$cms->redir(SITE_PATH_ADM.CPAGE, true);
}	

$rsAdmin=$cms->db_query("select * from #_warranty where id='1'");
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
									<a class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultTwo" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleCollapseDefaultTwo">Section 1</a> 
								</div>
								<div class="panel-collapse collapse in" id="exampleCollapseDefaultTwo" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
									<div class="panel-body">
										<div class="col-sm-6">														
											<label for="sec1_main_heading" class="control-label">Main Heading</label>
											<input type="text" name="sec1_main_heading" value="<?=$sec1_main_heading?>" class="form-control" id="sec1_main_heading" data-fv-regexp="true" data-error="Please enter value"> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>
										<div class="col-sm-12">														
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
										
										<div class="col-sm-6">
											<label for="sec2_btn_text" class="control-label">Button Text*</label>
											<input type="text" name="sec2_btn_text" value="<?=$sec2_btn_text?>" class="form-control" id="sec2_btn_text" placeholder="Button Text" data-fv-regexp="true" data-error="Please enter value"> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="col-sm-12">
											<label for="sec2_btn_link" class="control-label">Button Link*</label>
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
									</div>
								</div>
							</div>
						</div>
						
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#warrantyMeta" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="warrantyMeta">Meta Manager</a> 
								</div>
								<div class="panel-collapse collapse" id="warrantyMeta" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
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
									<a class="panel-title collapsed" data-toggle="collapse" href="#warrantyAccSec1" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="warrantyAccSec1">Section 1</a> 
								</div>
								<div class="panel-collapse collapse in" id="warrantyAccSec1" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
									<div class="panel-body">
										<div class="col-sm-6">														
											<label for="sec1_main_heading_sw" class="control-label">Main Heading</label>
											<input type="text" name="sec1_main_heading_sw" value="<?=$sec1_main_heading_sw?>" class="form-control" id="sec1_main_heading_sw" data-fv-regexp="true" data-error="Please enter value"> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>
										<div class="col-sm-12">														
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
									<a class="panel-title collapsed" data-toggle="collapse" href="#warrantyAccSec2" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="warrantyAccSec2">Section 2</a> 
								</div>
								<div class="panel-collapse collapse" id="warrantyAccSec2" aria-labelledby="exampleCollapseDefaultThree" role="tabpanel">
									<div class="panel-body">
										<div class="col-sm-6">														
											<label for="sec2_main_heading_sw" class="control-label">Main Heading</label>
											<input type="text" name="sec2_main_heading_sw" value="<?=$sec2_main_heading_sw?>" class="form-control" id="sec2_main_heading_sw" data-fv-regexp="true" data-error="Please enter value"> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>										
										
										<div class="col-sm-6">
											<label for="sec2_btn_text_sw" class="control-label">Button Text*</label>
											<input type="text" name="sec2_btn_text_sw" value="<?=$sec2_btn_text_sw?>" class="form-control" id="sec2_btn_text_sw" placeholder="Button Text" data-fv-regexp="true" data-error="Please enter value"> 
											<div class="help-block with-errors"></div>
										</div>
										<div class="col-sm-12">
											<label for="sec2_btn_link_sw" class="control-label">Button Link*</label>
											<select class="form-control" name="sec2_btn_link_sw" id="sec2_btn_link_sw">
												<option value="">Select Page</option>
												<?php $pageQrySe = $cms->db_query("SELECT id, menu_title_sw FROM #_menu LIMIT 10 ");
													while($pageArrSe = $pageQrySe->fetch_array()){
												?>												
												<option value="<?=$pageArrSe['id']?>" <?=$pageArrSe['id']==$sec2_btn_link_sw?'selected':''?>><?=$pageArrSe['menu_title_sw']?></option>
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
									<a class="panel-title collapsed" data-toggle="collapse" href="#warrantyMetaSW" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="warrantyMetaSW">Meta Manager</a> 
								</div>
								<div class="panel-collapse collapse" id="warrantyMetaSW" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
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
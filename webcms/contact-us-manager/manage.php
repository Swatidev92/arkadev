<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 

if($cms->is_post_back()){ 
	
	$cms->sqlquery("rs","contact_us",$_POST,'id',1);
	$adm->sessset('Record has been updated', 's');
	
	//$cms->redir(SITE_PATH_ADM.CPAGE.'?mode=add&id='.$uids, true);
	$cms->redir(SITE_PATH_ADM.CPAGE, true);
}	

$rsAdmin=$cms->db_query("select * from #_contact_us where id='1'");
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
									<a class="panel-title collapsed" data-toggle="collapse" href="#quoteMeta" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="quoteMeta">Meta Manager</a> 
								</div>
								<div class="panel-collapse collapse in" id="quoteMeta" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
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
									<a class="panel-title collapsed" data-toggle="collapse" href="#quoteMetaSW" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="quoteMetaSW">Meta Manager </a> 
								</div>
								<div class="panel-collapse collapse in" id="quoteMetaSW" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
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
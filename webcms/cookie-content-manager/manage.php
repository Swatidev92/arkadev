<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 

if($cms->is_post_back()){ 
	
	$cms->sqlquery("rs","cookie",$_POST,'id',1);
	$adm->sessset('Record has been updated', 's');
	
	//$cms->redir(SITE_PATH_ADM.CPAGE.'?mode=add&id='.$uids, true);
	$cms->redir(SITE_PATH_ADM.CPAGE, true);
}	

$rsAdmin=$cms->db_query("select * from #_cookie where id='1'");
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
									<a class="panel-title collapsed" data-toggle="collapse" href="#cookiecontent" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="cookiecontent">Cookie Content</a> 
								</div>
								<div class="panel-collapse collapse in" id="cookiecontent" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
									<div class="panel-body">
										<div class="form-group col-sm-12">											
											<label for="necessary_content" class="control-label">Necessary Content</label>
											<textarea name="necessary_content" id="necessary_content" class="form-control" rows="4"><?=$necessary_content?></textarea>
										</div>
										<div class="form-group col-sm-12">											
											<label for="statistics_content" class="control-label">Statistics Content</label>
											<textarea name="statistics_content" id="statistics_content" class="form-control" rows="4"><?=$statistics_content?></textarea>
										</div>
										<div class="form-group col-sm-12">											
											<label for="marketing_content" class="control-label">Marketing Content</label>
											<textarea name="marketing_content" id="marketing_content" class="form-control" rows="4"><?=$marketing_content?></textarea>
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
									<a class="panel-title collapsed" data-toggle="collapse" href="#cookiecontentSW" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="cookiecontentSW">Meta Manager </a> 
								</div>
								<div class="panel-collapse collapse in" id="cookiecontentSW" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
									<div class="panel-body">
										<div class="form-group col-sm-12">											
											<label for="necessary_content_sw" class="control-label">Necessary Content</label>
											<textarea name="necessary_content_sw" id="necessary_content_sw" class="form-control" rows="4"><?=$necessary_content_sw?></textarea>
										</div>
										<div class="form-group col-sm-12">											
											<label for="statistics_content_sw" class="control-label">Statistics Content</label>
											<textarea name="statistics_content_sw" id="statistics_content_sw" class="form-control" rows="4"><?=$statistics_content_sw?></textarea>
										</div>
										<div class="form-group col-sm-12">											
											<label for="marketing_content_sw" class="control-label">Marketing Content</label>
											<textarea name="marketing_content_sw" id="marketing_content_sw" class="form-control" rows="4"><?=$marketing_content_sw?></textarea>
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
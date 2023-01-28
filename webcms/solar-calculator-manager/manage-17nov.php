<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 

if($cms->is_post_back()){ 
	
	$cms->sqlquery("rs","solar_calculator",$_POST,'id',1);
	$adm->sessset('Record has been updated', 's');
	
	//$cms->redir(SITE_PATH_ADM.CPAGE.'?mode=add&id='.$uids, true);
	$cms->redir(SITE_PATH_ADM.CPAGE, true);
}	

$rsAdmin=$cms->db_query("select * from #_solar_calculator where id='1'");
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
									<a class="panel-title collapsed" data-toggle="collapse" href="#calcMeta" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="calcMeta">Meta Manager</a> 
								</div>
								<div class="panel-collapse collapse in" id="calcMeta" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
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
						
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#calcValues" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="calcValues">Calculator </a> 
								</div>
								<div class="panel-collapse collapse" id="calcValues" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
									<div class="panel-body">
										<div class="form-group col-sm-4">											
											<label for="panel_cost1" class="control-label">Optimized Cost</label>
											<input type="text" class="form-control" name="panel_cost1" value="<?=$panel_cost1?>">
										</div>
										<div class="form-group col-sm-4">											
											<label for="panel_cost2" class="control-label">Esthetic Cost</label>
											<input type="text" class="form-control" name="panel_cost2" value="<?=$panel_cost2?>">
										</div>
										<div class="form-group col-sm-4">											
											<label for="panel_cost3" class="control-label">Performance Cost</label>
											<input type="text" class="form-control" name="panel_cost3" value="<?=$panel_cost3?>">
										</div>
										
										<div class="clearfix"></div>
										
										<div class="form-group col-sm-4">											
											<label for="battery_cost" class="control-label">Battery Cost (with discount)</label>
											<input type="text" class="form-control" name="battery_cost" value="<?=$battery_cost?>">
										</div>
										<div class="form-group col-sm-4">											
											<label for="charger_cost" class="control-label">Charger Cost (with discount)</label>
											<input type="text" class="form-control" name="charger_cost" value="<?=$charger_cost?>">
										</div>										
										<div class="clearfix"></div>
										
										<div class="form-group col-sm-4">											
											<label for="installation_cost_min" class="control-label">Panels<=20 </label>
											<input type="text" class="form-control" name="installation_cost_min" value="<?=$installation_cost_min?>">
										</div>
										<div class="form-group col-sm-4">											
											<label for="installation_cost_avg" class="control-label">20 < Panels < 50 </label>
											<input type="text" class="form-control" name="installation_cost_avg" value="<?=$installation_cost_avg?>">
										</div>
										<div class="form-group col-sm-4">											
											<label for="installation_cost_max" class="control-label">Panels>50</label>
											<input type="text" class="form-control" name="installation_cost_max" value="<?=$installation_cost_max?>">
										</div>
										
										<div class="clearfix"></div>
										
										<div class="form-group col-sm-4">											
											<label for="Inverter_cost_min" class="control-label">12kW >= Capacity </label>
											<input type="text" class="form-control" name="Inverter_cost_min" value="<?=$Inverter_cost_min?>">
										</div>
										<div class="form-group col-sm-4">											
											<label for="Inverter_cost_max" class="control-label">12kW < Capacity </label>
											<input type="text" class="form-control" name="Inverter_cost_max" value="<?=$Inverter_cost_max?>">
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
								<div class="panel-collapse collapse in" id="aboutMetaSW" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
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
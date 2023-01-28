<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 

if($cms->is_post_back()){ 
	//	echo '<pre>';
		//print_r($_FILES);
		//die;
//print_r($_FILES['evc']['name']);die;

	
	if($_FILES['evc']['name']){
		$countImage =  count($_FILES['evc']['name']);
		if($countImage>0){
			for($i=0;$i<$countImage;$i++){
				if(!empty($_FILES['evc']['name'][$i]['charger_img'])){
					$filename = rand(1000,100000)."-".$_FILES['evc']['name'][$i]['charger_img']; 
					$file_loc = $_FILES['evc']['tmp_name'][$i]['charger_img'];
					$file_size = ($_FILES['evc']['tmp_name'][$i]['size']/1024);
					$file_type = $_FILES['evc']['tmp_name'][$i]['type'];
					$folder = FILES_PATH."proposal/charger/";
					// make file name in lower case
					$supported_format = array('jpg','jpeg');
					$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
					$fileinfo = @getimagesize($_FILES['evc']['tmp_name'][$i]['charger_img']);
					$width = $fileinfo[0];
					$height = $fileinfo[1];
					if($file_size<2048 ){
						if ($width == "270" || $height == "131") {
							$msg='';
							if (in_array($ext, $supported_format)){
								$new_file_name = strtolower($filename);
								$final_file= str_replace(" ","-",$new_file_name);
								//echo $folder.$final_file;die;
								move_uploaded_file($file_loc,$folder.$final_file);
								//var_dump($_FILES);
								//$_POST['display_order']=$i+1;
								//$gArr['image']=$final_file;
								$_POST['evc'][$i]['charger_img'] = $final_file;
							}
						}else{
							echo '<script language="javascript">';
							echo 'alert("Upload charger image in required size")';
							echo '</script>';
						}							
					}else{
						$msg="Image size should be less than 2MB";
					}						
				}
			}
		}
	}
	if($_FILES['btrcs']['name']){
		$countImage =  count($_FILES['btrcs']['name']);
		if($countImage>0){
			for($i=0;$i<$countImage;$i++){
				if(!empty($_FILES['btrcs']['name'][$i]['battery_img'])){
					$filename = rand(1000,100000)."-".$_FILES['btrcs']['name'][$i]['battery_img']; 
					$file_loc = $_FILES['btrcs']['tmp_name'][$i]['battery_img'];
					$file_size = ($_FILES['btrcs']['tmp_name'][$i]['size']/1024);
					$file_type = $_FILES['btrcs']['tmp_name'][$i]['type'];
					$folder = FILES_PATH."proposal/battery/";
					// make file name in lower case
					$supported_format = array('jpg','jpeg');
					$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
					$fileinfo = @getimagesize($_FILES['btrcs']['tmp_name'][$i]['battery_img']);
					$width = $fileinfo[0];
					$height = $fileinfo[1];
					if($file_size<2048 ){
						if ($width == "270" || $height == "131") {
							$msg='';
							if (in_array($ext, $supported_format)){
								$new_file_name = strtolower($filename);
								$final_file= str_replace(" ","-",$new_file_name);
								//echo $folder.$final_file;die;
								move_uploaded_file($file_loc,$folder.$final_file);
								//var_dump($_FILES);
								//$_POST['display_order']=$i+1;
								//$gArr['image']=$final_file;
								$_POST['btrcs'][$i]['battery_img'] = $final_file;
							}
						}else{
							echo '<script language="javascript">';
							echo 'alert("Upload battery image in required size")';
							echo '</script>';
						}
					}else{
						$msg="Image size should be less than 2MB";
					}						
				}
			}
		}
	}
	
	if($_FILES['invt']['name']){
		$countImage =  count($_FILES['invt']['name']);
		if($countImage>0){
			for($i=0;$i<$countImage;$i++){
				if(!empty($_FILES['invt']['name'][$i]['inverter_img'])){
					$filename = rand(1000,100000)."-".$_FILES['invt']['name'][$i]['inverter_img']; 
					$file_loc = $_FILES['invt']['tmp_name'][$i]['inverter_img'];
					$file_size = ($_FILES['invt']['tmp_name'][$i]['size']/1024);
					$file_type = $_FILES['invt']['tmp_name'][$i]['type'];
					$folder = FILES_PATH."proposal/inverter/";
					// make file name in lower case
					$supported_format = array('jpg','jpeg');
					$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
					$fileinfo = @getimagesize($_FILES['invt']['tmp_name'][$i]['inverter_img']);
					$width = $fileinfo[0];
					$height = $fileinfo[1];
					if($file_size<2048 ){
						if ($width == "270" || $height == "131") {
							$msg='';
							if (in_array($ext, $supported_format)){
								$new_file_name = strtolower($filename);
								$final_file= str_replace(" ","-",$new_file_name);
								//echo $folder.$final_file;die;
								move_uploaded_file($file_loc,$folder.$final_file);
								//var_dump($_FILES);
								//$_POST['display_order']=$i+1;
								//$gArr['image']=$final_file;
								$_POST['invt'][$i]['inverter_img'] = $final_file;
							}
						}else{
							echo '<script language="javascript">';
							echo 'alert("Upload Inverter image in required size")';
							echo '</script>';
						}							
					}else{
						$msg="Image size should be less than 2MB";
					}						
				}
			}
		}
	}
	
	if($_FILES['pty']['name']){
		$countImage =  count($_FILES['pty']['name']);
		if($countImage>0){
			for($i=0;$i<$countImage;$i++){
				if(!empty($_FILES['pty']['name'][$i]['panel_img'])){
					$filename = rand(1000,100000)."-".$_FILES['pty']['name'][$i]['panel_img']; 
					$file_loc = $_FILES['pty']['tmp_name'][$i]['panel_img'];
					$file_size = ($_FILES['pty']['tmp_name'][$i]['size']/1024);
					$file_type = $_FILES['pty']['tmp_name'][$i]['type'];
					$folder = FILES_PATH."proposal/solar-panel/";
					// make file name in lower case
					$supported_format = array('jpg','jpeg');
					$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
					$fileinfo = @getimagesize($_FILES['pty']['tmp_name'][$i]['panel_img']);
					$width = $fileinfo[0];
					$height = $fileinfo[1];
					if($file_size<2048 ){
						if ($width == "270" || $height == "131") {
							$msg='';
							if (in_array($ext, $supported_format)){
								$new_file_name = strtolower($filename);
								$final_file= str_replace(" ","-",$new_file_name);
								//echo $folder.$final_file;die;
								move_uploaded_file($file_loc,$folder.$final_file);
								//var_dump($_FILES);
								//$_POST['display_order']=$i+1;
								//$gArr['image']=$final_file;
								$_POST['pty'][$i]['panel_img'] = $final_file;
							}	
						}else{
							echo '<script language="javascript">';
							echo 'alert("Upload panel image in required size")';
							echo '</script>';
						}
					}else{
						$msg="Image size should be less than 2MB";
					}						
				}
			}
		}
	}
	
	
	$_POSTS['ev_charger_types'] = json_encode($_POST['evc']);
	$_POSTS['panel_types'] = json_encode($_POST['pty']);
	$_POSTS['inverter_types'] = json_encode($_POST['invt']);
	$_POSTS['battery_types'] = json_encode($_POST['btrcs']);
	$_POSTS['installation_charges'] = json_encode($_POST['intc']);
	$_POSTS['green_rebate_solar'] = json_encode($_POST['grs']);
	$_POSTS['green_rebate_ev'] = json_encode($_POST['grev']);
	$_POSTS['green_rebate_battery'] = json_encode($_POST['grb']);
	$_POSTS['solar_margin'] = json_encode($_POST['smrg']);
	$_POSTS['ev_margin'] = json_encode($_POST['evmrg']);
	$_POSTS['battery_margin'] = json_encode($_POST['btmrg']);
	$_POSTS['minimum_total_margin'] = json_encode($_POST['minmrg']);
	$_POSTS['solar_discount'] = json_encode($_POST['sdis']);
	$_POSTS['battery_discount'] = json_encode($_POST['bdis']);
	$_POSTS['charger_discount'] = json_encode($_POST['cdis']);
	$_POSTS['mms_cost'] = json_encode($_POST['mcost']);
	$_POSTS['shipment_cost'] = json_encode($_POST['shipcost']);
	$_POSTS['pay_at_ordering'] = json_encode($_POST['orderpercentage']);
	$_POSTS['mounting_structure'] = json_encode($_POST['mmswarranty']);
	$_POSTS['production_data'] = json_encode($_POST['production']);
	$_POSTS['electricity_data'] = json_encode($_POST['electricity']);
	$_POSTS['vat_percentage'] = json_encode($_POST['vatArr']);
	$_POSTS['roof_type_price'] = json_encode($_POST['roof']);
	$_POSTS['proposal_type_name'] = json_encode($_POST['propType']);
	$_POSTS['solar_max_rebate'] = json_encode($_POST['solarmaxmrg']);
	$_POSTS['solar_ev_max_rebate'] = json_encode($_POST['solarEvmaxmrg']);
	$_POSTS['solar_battery_max_rebate'] = json_encode($_POST['solarBatterymaxmrg']);
	$_POSTS['solar_ev_battery_max_rebate'] = json_encode($_POST['solarEvBatterymaxmrg']);



//print_r($_POSTS);

//echo $field_values_array[0][0];

//print_r(json_decode($_POSTS['ev_charger_types']));die;


	$cms->sqlquery("rs","customer_price",$_POSTS,'id',1);
	$adm->sessset('Record has been updated '.$msg, 's');
	
	//$cms->redir(SITE_PATH_ADM.CPAGE.'?mode=add&id='.$uids, true);
	$cms->redir(SITE_PATH_ADM.CPAGE, true);
	
}	

$rsAdmin=$cms->db_query("select * from #_customer_price where id='1'");
$arrAdmin=$cms->db_fetch_array($rsAdmin);
@extract($arrAdmin);

?>
<style>
.status-checkbox{
	margin-top:25px;
	margin-right:10px;
	float:left;
}
.mgtp0{
	margin-top:0px;
}
</style>

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
			
            <!-- Tab panes -->
            <div class="tab-content">
				<div role="tabpanel" class="tab-pane fade active in" id="eng">
					<div class="form-group">
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultThree1" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleCollapseDefaultThree1">Battery	</a> 
								</div>
								<div class="panel-collapse collapse" id="exampleCollapseDefaultThree1" aria-labelledby="exampleCollapseDefaultThree1" role="tabpanel">
									<div class="panel-body">
										<div class="list_wrapper list_wrapper5">  
										<?php $obj = json_decode($battery_types);
										$btrcs_cnt = count($obj);
										$i=0;
										if(count($obj)>0){
											foreach($obj as $val){ ?>
											<div class="row" id="btrow<?=$i?>">
												<div class="status-checkbox">
													<input class="form-check-input" type="checkbox" name="btrcs[<?=$i?>][bstatus]" value="1" <?=$val->bstatus==1?'checked':''?>>
												</div>
												<div class="col-xs-4 col-sm-4 col-md-4">
													<div class="form-group">
														Name
														<input name="btrcs[<?=$i?>][name]" type="text" placeholder="Name" class="form-control" value="<?=$val->name?>"/>
													</div>
												</div>
												<div class="col-xs-2 col-sm-2 col-md-2">
													<div class="form-group">
														Cost
														<input autocomplete="off" name="btrcs[<?=$i?>][price]" type="text" placeholder="Cost" class="form-control" value="<?=$val->price?>"/>
													</div>
												</div> 
												<div class="col-xs-2 col-sm-2 col-md-2">
													<div class="form-group">
														Warranty (year)
														<input autocomplete="off" name="btrcs[<?=$i?>][bwarranty]" type="text" placeholder="Warranty" class="form-control" value="<?=$val->bwarranty?>"/>
													</div>
												</div> 
												<div class="col-xs-2 col-sm-2 col-md-2">
													<div class="form-group">
														Discount (kr)
														<input autocomplete="off" name="btrcs[<?=$i?>][bdiscount]" type="text" placeholder="Discount" class="form-control" value="<?=$val->bdiscount?>"/>
													</div>
												</div> 
												<div class="col-xs-3 col-sm-3 col-md-3">
													<div class="form-group">
														Image max-width: 270px and height: 131px and extension: jpg/jpeg
														<input type="file" name="btrcs[<?=$i?>][battery_img]" id="drop_battery<?=$i?>" class="dropify dropify-battery" data-max-file-size="1M" data-height="150" <?php if($val->battery_img AND file_exists(FILES_PATH.'proposal/battery/'.$val->battery_img)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/proposal/battery/<?=$val->battery_img?>" <?php } ?> />
														<input type="hidden" name="btrcs[<?=$i?>][battery_img]" class="form-control" value="<?=$val->battery_img?>"/>
													</div>
												</div>
												<div class="col-xs-1 col-sm-1 col-md-1">
													<br>
													<button class="" onclick='revrcrd("btrow<?=$i?>")' type="button"><i class="fa fa-close text-danger"></i></button>
												</div>
												<div class="clearfix"></div>
												<?php $i++;
											echo '</div>'; } } ?>  
											<div class="row">
												<div class="col-xs-4 col-sm-4 col-md-4">
													<h3>Add New <button class="btn btn-primary list_add_button5" type="button">+</button></h3>
												</div>
											</div>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#electricity" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="electricity">Electricity price based on own consumption</a> 
								</div>
								<div class="panel-collapse collapse" id="electricity" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
									<div class="panel-body">
										<div class="list_wrapper">  
											<div class="row">
											<?php $obj_elect = json_decode($electricity_data); 
											$i=0; ?>
												<div class="form-group col-md-6">
													<label class="control-label">Own consumption (kr/kWh)</label>
													<input type="text" class="form-control" name="electricity[<?=$i?>][elec_consumption]" placeholder="Own Consumption" value="<?=$obj_elect[0]->elec_consumption?>">
												</div>
												<div class="form-group col-md-6">
													<label class="control-label">Sold electricity (kr/kWh)</label>
													<input type="text" class="form-control" name="electricity[<?=$i?>][elec_sold]" placeholder="Sold electricity" value="<?=$obj_elect[0]->elec_sold?>">
												</div>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultOne" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleCollapseDefaultOne">EV charger</a> 
								</div>
								<div class="panel-collapse collapse" id="exampleCollapseDefaultOne" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
									<div class="panel-body">
										<div class="list_wrapper list_wrapper1">  
										<?php $obj = json_decode($ev_charger_types);
										$ec_cnt = count($obj);
										if(count($obj)>0){
											$i=0;
											foreach($obj as $val){?>
											<div class="row" id="rev<?=$i?>">
												<div class="status-checkbox">
													<input class="form-check-input" type="checkbox" name="evc[<?=$i?>][evstatus]" value="1" <?=$val->evstatus==1?'checked':''?>>
												</div>
												<div class="col-xs-2 col-sm-2 col-md-2">
													<div class="form-group">
														Name
														<input name="evc[<?=$i?>][name]" type="text" placeholder="Name" class="form-control" value="<?=$val->name?>"/>
													</div>
												</div>
												<div class="col-xs-2 col-sm-2 col-md-2">
													<div class="form-group">
														EV Charger Cost (kr)
														<input autocomplete="off" name="evc[<?=$i?>][price]" type="text" placeholder="Cost" class="form-control" value="<?=$val->price?>"/>
													</div>
												</div>
												<div class="col-xs-3 col-sm-3 col-md-3">
													<div class="form-group">
														EV Charger Warranty (years)
														<input autocomplete="off" name="evc[<?=$i?>][cwarranty]" type="text" placeholder="Warranty" class="form-control" value="<?=$val->cwarranty?>"/>
													</div>
												</div>
												<div class="col-xs-2 col-sm-2 col-md-2">
													<div class="form-group">
														Discount (kr)
														<input autocomplete="off" name="evc[<?=$i?>][cdiscount]" type="text" placeholder="Discount" class="form-control" value="<?=$val->cdiscount?>"/>
													</div>
												</div>
												<div class="clearfix"></div>
												<div class="col-xs-3 col-sm-3 col-md-3">
													<div class="form-group">
														Load Balancer Cost (kr)
														<input name="evc[<?=$i?>][loadbalancercost]" type="text" placeholder="Load Balancer" class="form-control" value="<?=$val->loadbalancercost?>"/>
													</div>
												</div>
												<div class="col-xs-3 col-sm-3 col-md-3">
													<div class="form-group">
														Load Balancer Warranty (years)
														<input name="evc[<?=$i?>][lbwarranty]" type="number" placeholder="Load Balancer warranty" class="form-control" value="<?=$val->lbwarranty?>"/>
													</div>
												</div>
												<div class="col-xs-3 col-sm-3 col-md-3">
													<div class="form-group">
														Image max-width: 270px and height: 131px and extension: jpg/jpeg
														<input type="file" name="evc[<?=$i?>][charger_img]" id="drp<?=$i?>" class="dropify dropify-charger" data-max-file-size="1M" data-height="150" <?php if($val->charger_img AND file_exists(FILES_PATH.'proposal/charger/'.$val->charger_img)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/proposal/charger/<?=$val->charger_img?>" <?php } ?> />
														<input type="hidden" name="evc[<?=$i?>][charger_img]" class="form-control" value="<?=$val->charger_img?>"/>
													</div>
												</div>
												<div class="col-xs-1 col-sm-1 col-md-1">
													<br>
													<button class="" onclick='revrcrd("rev<?=$i?>")' type="button"><i class="fa fa-close text-danger"></i></button>
												</div>
												<?php $i++; 
											echo '</div>'; } } ?>
											<div class="row">
												<div class="col-xs-4 col-sm-4 col-md-4">
													<h3>Add New <button class="btn btn-primary list_add_button1" type="button">+</button></h3>
												</div>
											</div>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#exampleHeadingDefaultFour1" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleHeadingDefaultFour1">Green Rebate</a> 
								</div>
								<div class="panel-collapse collapse" id="exampleHeadingDefaultFour1" aria-labelledby="exampleHeadingDefaultFour1" role="tabpanel">
									<div class="panel-body">								
										<div class="list_wrapper">  
											<div class="row">
											<?php $obj_solar = json_decode($green_rebate_solar);
											$obj_ev = json_decode($green_rebate_ev);
											$obj_battery = json_decode($green_rebate_battery);
											$i=0; ?>
												<div class="col-xs-4 col-sm-4 col-md-4">
													<div class="form-group">
														for solar panels (%)
														<input name="grs[<?=$i?>][rebate]" type="text" placeholder="" class="form-control" value="<?=$obj_solar[0]->rebate?>"/>
													</div>
												</div>
												<div class="col-xs-4 col-sm-4 col-md-4">
													<div class="form-group">
														for EV charger (%)
														<input name="grev[<?=$i?>][rebate]" type="text" placeholder="" class="form-control" value="<?=$obj_ev[0]->rebate?>"/>
													</div>
												</div>
												<div class="col-xs-4 col-sm-4 col-md-4">
													<div class="form-group">
														for Battery (%)
														<input name="grb[<?=$i?>][rebate]" type="text" placeholder="" class="form-control" value="<?=$obj_battery[0]->rebate?>"/>
													</div>
												</div>
												<div class="clearfix"></div>
											</div>
										</div>									
									</div>
								</div>
							</div>
						</div>
						
												
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#exampleHeadingDefaultFour" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleHeadingDefaultFour">Installation  Cost</a> 
								</div>
								<div class="panel-collapse collapse" id="exampleHeadingDefaultFour" aria-labelledby="exampleHeadingDefaultFour" role="tabpanel">
									<div class="panel-body">
										<div class="list_wrapper list_wrapper4">  
										<?php $obj = json_decode($installation_charges);
										$intc_cnt = count($obj);
										$i=0;
										if(count($obj)>0){										
											foreach($obj as $val){ ?>
											<div class="row" id="inscrow<?=$i?>">
												<div class="col-xs-2 col-sm-2 col-md-2">
													<div class="form-group">
														Number of Days
														<input name="intc[<?=$i?>][day]" type="text" placeholder="Days" class="form-control" value="<?=$val->day?>"/>
													</div>
												</div>
												<div class="col-xs-2 col-sm-2 col-md-2">
													<div class="form-group">
														Cost
														<input autocomplete="off" name="intc[<?=$i?>][price]" type="text" placeholder="Cost" class="form-control" value="<?=$val->price?>"/>
													</div>
												</div>
												<div class="col-xs-3 col-sm-3 col-md-3">
													<div class="form-group">
														Work performed (year)
														<input autocomplete="off" name="intc[<?=$i?>][work_year]" type="text" placeholder="Work Performed" class="form-control" value="<?=$val->work_year?>"/>
													</div>
												</div>
												<div class="col-xs-1 col-sm-1 col-md-1">
													<br>
													<button class="" onclick='revrcrd("inscrow<?=$i?>")' type="button"><i class="fa fa-close text-danger"></i></button>
												</div>
												<div class="clearfix"></div>
												<?php $i++;
											echo '</div>'; } } ?>  
											<div class="row">
												<div class="col-xs-4 col-sm-4 col-md-4">
													<h3>Add New <button class="btn btn-primary list_add_button4" type="button">+</button></h3>
												</div>
											</div>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultThree" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleCollapseDefaultThree">Inverter Model</a> 
								</div>
								<div class="panel-collapse collapse" id="exampleCollapseDefaultThree" aria-labelledby="exampleCollapseDefaultThree" role="tabpanel">
									<div class="panel-body">
										<div class="list_wrapper list_wrapper3">  
										<?php $obj = json_decode($inverter_types);
										$invt_cnt = count($obj);
										$i=0;
										if(count($obj)>0){											
											foreach($obj as $val){
										?>
										<div class="row" id="invm<?=$i?>">
											<div class="status-checkbox">
												<input class="form-check-input" type="checkbox" name="invt[<?=$i?>][invstatus]" value="1" <?=$val->invstatus==1?'checked':''?>>
											</div>
											<div class="col-xs-4 col-sm-4 col-md-4">
												<div class="form-group">
													Name
													<input name="invt[<?=$i?>][name]" type="text" placeholder="Name" class="form-control" value="<?=$val->name?>"/>
												</div>
											</div>
											<div class="col-xs-3 col-sm-3 col-md-3">
												<div class="form-group">
													Brand
													<input name="invt[<?=$i?>][invbrand]" type="text" placeholder="Brand" class="form-control" value="<?=$val->invbrand?>"/>
												</div>
											</div>
											<div class="col-xs-2 col-sm-2 col-md-2">
												<div class="form-group">
													Cost
													<input autocomplete="off" name="invt[<?=$i?>][price]" type="text" placeholder="Cost" class="form-control" value="<?=$val->price?>"/>
												</div>
											</div> 
											<div class="col-xs-2 col-sm-2 col-md-2">
												<div class="form-group">
													Warranty (years)
													<input autocomplete="off" name="invt[<?=$i?>][invwarranty]" type="text" placeholder="Warranty" class="form-control" value="<?=$val->invwarranty?>"/>
												</div>
											</div>
											<div class="col-xs-3 col-sm-3 col-md-3">
												<div class="form-group">
													Image max-width: 270px and height: 131px and extension: jpg/jpeg
													<input type="file" name="invt[<?=$i?>][inverter_img]" id="drop_inverter<?=$i?>" class="dropify dropify-inverter" data-max-file-size="1M" data-height="150" <?php if($val->inverter_img AND file_exists(FILES_PATH.'proposal/inverter/'.$val->inverter_img)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/proposal/inverter/<?=$val->inverter_img?>" <?php } ?> />
													<input type="hidden" name="invt[<?=$i?>][inverter_img]" class="form-control" value="<?=$val->inverter_img?>"/>
												</div>
											</div>
											<div class="col-xs-1 col-sm-1 col-md-1">
												<br>
												<button class="" onclick='revrcrd("invm<?=$i?>")' type="button"><i class="fa fa-close text-danger"></i></button>
											</div>
											<div class="clearfix"></div>
											<?php $i++;
										echo '</div>'; } } ?>  
											<div class="row">
												<div class="col-xs-4 col-sm-4 col-md-4">
													<h3>Add New <button class="btn btn-primary list_add_button3" type="button">+</button></h3>
												</div>
											</div>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#aboutMeta" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="aboutMeta">Margins</a> 
								</div>
								<div class="panel-collapse collapse" id="aboutMeta" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
									<div class="panel-body">
										<div class="list_wrapper">  
											<div class="row">
											<?php $obj_smrg = json_decode($solar_margin);
											$obj_evmrg = json_decode($ev_margin);
											$obj_btmrg = json_decode($battery_margin);
											$obj_minmrg = json_decode($minimum_total_margin);
											$i=0; ?>
												<div class="col-xs-3 col-sm-3 col-md-3">
													<div class="form-group">
														<div class="status-checkbox mgtp0">
															<input class="form-check-input" type="checkbox" name="smrg[<?=$i?>][status]" value="1" <?=$obj_smrg[0]->status==1?'checked':''?>>
															Margins for solar panel (%)
														</div>
													</div>
												</div>
												<div class="col-xs-2 col-sm-2 col-md-2">
													<div class="form-group">
														<input name="smrg[<?=$i?>][margin]" type="text" placeholder="" class="form-control" value="<?=$obj_smrg[0]->margin?>"/>
													</div>
												</div>
												<div class="clearfix"></div>
												
												<div class="col-xs-3 col-sm-3 col-md-3">
													<div class="form-group">
														<div class="status-checkbox mgtp0">
															<input class="form-check-input" type="checkbox" name="evmrg[<?=$i?>][status]" value="1" <?=$obj_evmrg[0]->status==1?'checked':''?>>
															Margins for EV charger (%)
														</div>
													</div>
												</div>
												<div class="col-xs-2 col-sm-2 col-md-2">
													<div class="form-group">
														<input name="evmrg[<?=$i?>][margin]" type="text" placeholder="" class="form-control" value="<?=$obj_evmrg[0]->margin?>"/>
													</div>
												</div>
												<div class="clearfix"></div>
												
												<div class="col-xs-3 col-sm-3 col-md-3">
													<div class="form-group">
														<div class="status-checkbox mgtp0">
															<input class="form-check-input" type="checkbox" name="btmrg[<?=$i?>][status]" value="1" <?=$obj_btmrg[0]->status==1?'checked':''?>>
															Margin for Battery (%)
														</div>
													</div>
												</div>
												<div class="col-xs-2 col-sm-2 col-md-2">
													<div class="form-group">
														<input name="btmrg[<?=$i?>][margin]" type="text" placeholder="" class="form-control" value="<?=$obj_btmrg[0]->margin?>"/>
													</div>
												</div>
												<div class="clearfix"></div>
												
												<div class="col-xs-3 col-sm-3 col-md-3">
													<div class="form-group">
														<div class="status-checkbox mgtp0">
															<input class="form-check-input" type="checkbox" name="minmrg[<?=$i?>][status]" value="1" <?=$obj_minmrg[0]->status==1?'checked':''?>>
															Minimum total margin (%)
														</div>
													</div>
												</div>
												<div class="col-xs-2 col-sm-2 col-md-2">
													<div class="form-group">
														<input name="minmrg[<?=$i?>][margin]" type="text" placeholder="" class="form-control" value="<?=$obj_minmrg[0]->margin?>"/>
													</div>
												</div>
												<div class="clearfix"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#mmswarranty" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="mmswarranty">Module Mounting Structure</a> 
								</div>
								<div class="panel-collapse collapse" id="mmswarranty" aria-labelledby="mmswarranty" role="tabpanel">
									<div class="panel-body">
										<div class="list_wrapper">  
											<div class="row">
											<?php $obj_mounting = json_decode($mounting_structure);
											$i=0; ?>
												<div class="col-xs-4 col-sm-4 col-md-4">
													<div class="form-group">
														Product guarantee mounting system (year)
														<input name="mmswarranty[<?=$i?>][mwarranty]" type="text" placeholder="" class="form-control" value="<?=$obj_mounting[0]->mwarranty?>"/>
													</div>
												</div>
											</div>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultTwo" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleCollapseDefaultTwo">Panel Model/Type</a> 
								</div>
								<div class="panel-collapse collapse" id="exampleCollapseDefaultTwo" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
									<div class="panel-body">
										<div class="list_wrapper list_wrapper2">  
										<?php $obj = json_decode($panel_types);
										$pty_cnt = count($obj);
										$i=0;
										if(count($obj)>0){
											foreach($obj as $val){ ?>
											<div class="row" id="pmt<?=$i?>">
												<div class="status-checkbox">
													<input class="form-check-input" type="checkbox" name="pty[<?=$i?>][pstatus]" value="1" <?=$val->pstatus==1?'checked':''?>>
												</div>
												<div class="col-xs-3 col-sm-3 col-md-3">
													<div class="form-group">
														Name
														<input name="pty[<?=$i?>][name]" type="text" placeholder="Name" class="form-control" value="<?=$val->name?>"/>
													</div>
												</div>
												<div class="col-xs-3 col-sm-3 col-md-3">
													<div class="form-group">
														Brand
														<input name="pty[<?=$i?>][brand]" type="text" placeholder="Brand" class="form-control" value="<?=$val->brand?>"/>
													</div>
												</div>
												<div class="col-xs-2 col-sm-2 col-md-2">
													<div class="form-group">
														Wattage
														<input autocomplete="off" name="pty[<?=$i?>][wattage]" type="text" placeholder="wattage" class="form-control" value="<?=$val->wattage?>"/>
													</div>
												</div>
												<div class="col-xs-1 col-sm-1 col-md-1">
													<div class="form-group">
														Cost
														<input autocomplete="off" name="pty[<?=$i?>][price]" type="text" placeholder="Cost" class="form-control" value="<?=$val->price?>"/>
													</div>
												</div>
												<div class="col-xs-2 col-sm-2 col-md-2">
													<div class="form-group">
														Warranty (years)
														<input autocomplete="off" name="pty[<?=$i?>][swarranty]" type="text" placeholder="Warranty" class="form-control" value="<?=$val->swarranty?>"/>
													</div>
												</div>
												<div class="col-xs-3 col-sm-3 col-md-3">
													<div class="form-group">
														Effect Warranty (years)
														<input autocomplete="off" name="pty[<?=$i?>][effectWarranty]" type="text" placeholder="Warranty" class="form-control" value="<?=$val->effectWarranty?>"/>
													</div>
												</div>
												<div class="col-xs-3 col-sm-3 col-md-3">
													<div class="form-group">
														Effect warranty after <?=$val->effectWarranty?> years (%)
														<input autocomplete="off" name="pty[<?=$i?>][warranty_percentage]" type="text" placeholder="Effect warranty after <?=$val->effectWarranty?> years (%)" class="form-control" value="<?=$val->warranty_percentage?>"/>
													</div>
												</div>
												<div class="col-xs-2 col-sm-2 col-md-2">
													<div class="form-group">
														Color
														<input autocomplete="off" name="pty[<?=$i?>][pcolor]" type="text" class="form-control" value="<?=$val->pcolor?>"/>
													</div>
												</div>
												<div class="col-xs-3 col-sm-3 col-md-3">
													<div class="form-group">
														Image max-width: 270px and height: 131px and extension: jpg/jpeg
														<input type="file" name="pty[<?=$i?>][panel_img]" id="drop_panel<?=$i?>" class="dropify dropify-panel" data-max-file-size="1M" data-height="150" <?php if($val->panel_img AND file_exists(FILES_PATH.'proposal/solar-panel/'.$val->panel_img)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/proposal/solar-panel/<?=$val->panel_img?>" <?php } ?> />
														<input type="hidden" name="pty[<?=$i?>][panel_img]" class="form-control" value="<?=$val->panel_img?>"/>
													</div>
												</div>
												<div class="col-xs-1 col-sm-1 col-md-1">
													<br>
													<button class="" onclick='revrcrd("pmt<?=$i?>")' type="button"><i class="fa fa-close text-danger"></i></button>
												</div>
												<?php $i++;
											echo '</div>';	} }	?>  
											<div class="row">
												<div class="col-xs-4 col-sm-4 col-md-4">
													<h3>Add New <button class="btn btn-primary list_add_button2" type="button">+</button></h3>
												</div>
											</div>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#orderPayment" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="orderPayment">Pay at ordering</a> 
								</div>
								<div class="panel-collapse collapse" id="orderPayment" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
									<div class="panel-body">
										<div class="list_wrapper">  
											<div class="row">
											<?php $obj_orderPayment = json_decode($pay_at_ordering);
											$i=0; ?>
												<div class="col-xs-4 col-sm-4 col-md-4">
													<div class="form-group">
														Pay % at ordering
														<input name="orderpercentage[<?=$i?>][orderPayment]" type="text" placeholder="" class="form-control" value="<?=$obj_orderPayment[0]->orderPayment?>"/>
													</div>
												</div>
											</div>
											<div class="clearfix"></div>
										</div>					  
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
							
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#production" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="production">Production</a> 
								</div>
								<div class="panel-collapse collapse" id="production" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
									<div class="panel-body">
										<div class="list_wrapper">  
											<div class="row">
											<?php $obj_prod = json_decode($production_data); 
											$i=0; ?>
												<div class="form-group col-md-6">
													<label class="control-label">Annual inflation adjustment on electricity price (%)</label>
													<input type="text" class="form-control" name="production[<?=$i?>][prod_inflation]" placeholder="Annual inflation adjustment on electricity price" value="<?=$obj_prod[0]->prod_inflation?>">
												</div>
												<div class="form-group col-md-6">
													<label class="control-label">Real price increase on variable electricity price (%)</label>
													<input type="text" class="form-control" name="production[<?=$i?>][prod_price_increase]" placeholder="Real price increase on variable electricity price" value="<?=$obj_prod[0]->prod_price_increase?>">
												</div>
												<div class="form-group col-md-6">
													<label class="control-label">Annual effect deterioration in percent (%)</label>
													<input type="text" class="form-control" name="production[<?=$i?>][prod_deterioration]" placeholder="Annual effect deterioration in percent" value="<?=$obj_prod[0]->prod_deterioration?>">
												</div>
												<div class="form-group col-md-3">
													<label class="control-label">Power loss (%)</label>
													<input type="text" class="form-control" name="production[<?=$i?>][prod_power_loss]" placeholder="Power loss" value="<?=$obj_prod[0]->prod_power_loss?>">
												</div>
											</div>
											<div class="clearfix"></div>
										</div>	  
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
						
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#propType" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="propType">Proposal Types</a> 
								</div>
								<div class="panel-collapse collapse" id="propType" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
									<div class="panel-body">
										<div class="list_wrapper">  
											<div class="row">
											<?php $obj_prop_type = json_decode($proposal_type_name,true); 
											//print_r($obj_prop_type);
											$i=0;
											foreach($proposalType as $pkey=>$pval){											
											?>
												<div class="form-group col-xs-6 col-sm-6 col-md-6">
													<div class="checkbox checkbox-success">
														<input id="proposal_type_name[<?=$i?>]" type="checkbox" name="propType[<?=$i?>][status]" value="1" <?=$obj_prop_type[$i]['status']==1?'checked':''?>>
														<label for="proposal_type_name[<?=$i?>]"> <?=$pval?> </label>
														<input name="propType[<?=$i?>][pnum]" type="hidden" placeholder="" class="form-control" value="<?=$pkey?>"/>
														<input name="propType[<?=$i?>][name]" type="hidden" placeholder="" class="form-control" value="<?=$pval?>"/>
													</div>
												</div>
												<div class="clearfix"></div>
											<?php $i++; } ?>
											</div>
											<div class="clearfix"></div>
										</div>	  
									</div>
									<hr>
									<div class="panel-body">
										<div class="list_wrapper">  
											<div class="row">
											<?php $obj_solarmaxmrg = json_decode($solar_max_rebate);
											$obj_solarevmaxmrg = json_decode($solar_ev_max_rebate);
											$obj_solarbatterymaxmrg = json_decode($solar_battery_max_rebate);
											$obj_solarevbatterymaxmrg = json_decode($solar_ev_battery_max_rebate);
											$i=0;								
											?>
												<div class="col-xs-3 col-sm-3 col-md-3">
													<div class="form-group">
														<h3 class="">
															Solar panel only:
														</h3>
													</div>
												</div>
												<div class="col-xs-2 col-sm-2 col-md-2">
													<div class="checkbox checkbox-success">
														<input id="obj_solarmaxmrg[<?=$i?>]" type="checkbox" name="solarmaxmrg[<?=$i?>][status]" value="1" <?=$obj_solarmaxmrg[0]->status==1?'checked':''?>>
														<label for="obj_solarmaxmrg[<?=$i?>]"> Max rebate </label>
														<input name="solarmaxmrg[<?=$i?>][maxmargin]" type="text" class="form-control" value="<?=$obj_solarmaxmrg[0]->maxmargin?>" pattern="[0-9]+" />
													</div>
												</div>									
												<div class="clearfix"></div>
												
												<div class="col-xs-6 col-sm-6 col-md-6">
													<div class="form-group">
														<h3 class="">
															Campaign (Solar + EV charger):
														</h3>
													</div>
												</div>
												<div class="col-xs-3 col-sm-3 col-md-3">
													<div class="checkbox checkbox-success">
														<input id="obj_solarevmaxmrg[<?=$i?>]" type="checkbox" name="solarEvmaxmrg[<?=$i?>][status]" value="1" <?=$obj_solarevmaxmrg[0]->status==1?'checked':''?>>
														<label for="obj_solarevmaxmrg[<?=$i?>]"> Max rebate </label>
														<input name="solarEvmaxmrg[<?=$i?>][maxmargin]" type="text" class="form-control" value="<?=$obj_solarevmaxmrg[0]->maxmargin?>" pattern="[0-9]+" />
													</div>
												</div>
												<div class="clearfix"></div>
												
												<div class="col-xs-6 col-sm-6 col-md-6">
													<div class="form-group">
														<h3 class="">
															Campaign (Solar + Battery):
														</h3>
													</div>
												</div>
												<div class="col-xs-3 col-sm-3 col-md-3">
													<div class="checkbox checkbox-success">
														<input id="obj_solarbatterymaxmrg[<?=$i?>]" type="checkbox" name="solarBatterymaxmrg[<?=$i?>][status]" value="1" <?=$obj_solarbatterymaxmrg[0]->status==1?'checked':''?>>
														<label for="obj_solarbatterymaxmrg[<?=$i?>]"> Max rebate </label>
														<input name="solarBatterymaxmrg[<?=$i?>][maxmargin]" type="text" class="form-control" value="<?=$obj_solarbatterymaxmrg[0]->maxmargin?>" pattern="[0-9]+" />
													</div>
												</div>
												<div class="clearfix"></div>
												
												<div class="col-xs-6 col-sm-6 col-md-6">
													<div class="form-group">
														<h3 class="">
															Campaign (Solar + EV charger + Battery):
														</h3>
													</div>
												</div>
												<div class="col-xs-3 col-sm-3 col-md-3">
													<div class="checkbox checkbox-success">
														<input id="solarEvBatterymaxmrg[<?=$i?>]" type="checkbox" name="solarEvBatterymaxmrg[<?=$i?>][sevstatus]" value="1" <?=$obj_solarevbatterymaxmrg[0]->sevstatus==1?'checked':''?>>
														<label for="solarEvBatterymaxmrg[<?=$i?>]"> Max rebate (Solar+EV) </label>
														<input name="solarEvBatterymaxmrg[<?=$i?>][sevmaxmargin]" type="text" class="form-control" value="<?=$obj_solarevbatterymaxmrg[0]->sevmaxmargin?>"/>
													</div>
												</div>
												<div class="col-xs-3 col-sm-3 col-md-3">
													<div class="checkbox checkbox-success">
														<input id="solarEvBatterymaxmrg1[<?=$i?>]" type="checkbox" name="solarEvBatterymaxmrg[<?=$i?>][sbstatus]" value="1" <?=$obj_solarevbatterymaxmrg[0]->sbstatus==1?'checked':''?>>
														<label for="solarEvBatterymaxmrg1[<?=$i?>]"> Max rebate (Battery) </label>
														<input name="solarEvBatterymaxmrg[<?=$i?>][bmaxmargin]" type="text" class="form-control" value="<?=$obj_solarevbatterymaxmrg[0]->bmaxmargin?>"/>
													</div>
												</div>
												<div class="clearfix"></div>
											</div>
										</div>	  
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>					
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#rooftypePrice" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="rooftypePrice">Roof Type Price</a>
								</div>
								<div class="panel-collapse collapse" id="rooftypePrice" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
									<div class="panel-body">
										<div class="list_wrapper list_wrapper6">  
										<?php $obj_roof = json_decode($roof_type_price);
										$roof_cnt = count($obj_roof);
										if(count($obj_roof)>0){
											$i=0;
											foreach($obj_roof as $val){?>
											<div class="row" id="rev<?=$i?>">
												<div class="status-checkbox">
													<input class="form-check-input" type="checkbox" name="roof[<?=$i?>][rfstatus]" value="1" <?=$val->rfstatus==1?'checked':''?>>
												</div>
												<div class="col-xs-3 col-sm-3 col-md-3">
													<div class="form-group">
														Roof Type
														<input name="roof[<?=$i?>][name]" type="text" placeholder="Name" class="form-control" value="<?=$val->name?>"/>
													</div>
												</div>
												<div class="col-xs-2 col-sm-2 col-md-2">
													<div class="form-group">
														Per panel cost (kr)
														<input autocomplete="off" name="roof[<?=$i?>][price]" type="text" placeholder="Cost" class="form-control" value="<?=$val->price?>"/>
													</div>
												</div>
												<div class="col-xs-1 col-sm-1 col-md-1">
													<br>
													<button class="" onclick='revrcrd("rev<?=$i?>")' type="button"><i class="fa fa-close text-danger"></i></button>
												</div>
												<?php $i++; 
											echo '</div>'; } } ?>
											<div class="row">
												<div class="col-xs-4 col-sm-4 col-md-4">
													<h3>Add New <button class="btn btn-primary list_add_button6" type="button">+</button></h3>
												</div>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>		
							
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#shipment" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="shipment">Shipment Cost</a> 
								</div>
								<div class="panel-collapse collapse" id="shipment" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
									<div class="panel-body">
										<div class="list_wrapper">  
											<div class="row">
											<?php $obj_shipcost = json_decode($shipment_cost);
											$i=0; ?>
												<div class="col-xs-4 col-sm-4 col-md-4">
													<div class="form-group">
														Shipment Cost
														<input name="shipcost[<?=$i?>][shipmentcost]" type="text" placeholder="" class="form-control" value="<?=$obj_shipcost[0]->shipmentcost?>"/>
													</div>
												</div>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>			
							
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#vat" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="vat">VAT</a> 
								</div>
								<div class="panel-collapse collapse" id="vat" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
									<div class="panel-body">
										<div class="list_wrapper">  
											<div class="row">
											<?php $obj_vat = json_decode($vat_percentage);
											$i=0; ?>
												<div class="col-xs-4 col-sm-4 col-md-4">
													<div class="form-group"> 
														VAT (%)
														<input name="vatArr[<?=$i?>][vat]" type="text" placeholder="" class="form-control" value="<?=$obj_vat[0]->vat?>"/>
													</div>
												</div>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
									<div class="clearfix"></div>
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

	var list_maxField = 50; //Input fields increment limitation
	
    // sec1
	var x1 = "<?=$ec_cnt-1?>"; //Initial field counter	
	$('.list_add_button1').click(function()
	    {
			
	    //Check maximum number of input fields
	    if(x1 < list_maxField){ 
	        x1++; //Increment field counter
	        var list_fieldHTML = '<div class="row"><div class="status-checkbox"><input class="form-check-input" type="checkbox" name="evc['+x1+'][evstatus]" value="1"></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input name="evc['+x1+'][name]" type="text" placeholder="Name" class="form-control"/></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input name="evc['+x1+'][price]" type="text" placeholder="Cost" class="form-control"/></div></div><div class="col-xs-3 col-sm-3 col-md-3"><div class="form-group"><input autocomplete="off" name="evc['+x1+'][cwarranty]" type="text" placeholder="Warranty" class="form-control"/></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input autocomplete="off" name="evc['+x1+'][cdiscount]" type="text" placeholder="Discount" class="form-control" /></div></div><div class="clearfix"></div><div class="col-xs-3 col-sm-3 col-md-3"><div class="form-group"><input name="evc['+x1+'][loadbalancercost]" type="text" placeholder="Load Balancer Cost" class="form-control"/></div></div><div class="col-xs-3 col-sm-3 col-md-3"><div class="form-group"><input name="evc['+x1+'][lbwarranty]" type="number" placeholder="Load Balancer warranty" class="form-control"/></div></div><div class="col-xs-3 col-sm-3 col-md-3"><div class="form-group"><input type="file" name="evc['+x1+'][charger_img]" id="drp['+x1+']" class="dropify dropify-charger" data-max-file-size="1M" data-height="150"/></div></div> <div class="col-xs-1 col-sm-7 col-md-1"><a href="javascript:void(0);" class="list_remove_button btn btn-danger">-</a></div></div>'; //New input field html 
	        $('.list_wrapper1').append(list_fieldHTML); //Add field html
	    }
        });
    // sec2
	var x2 = "<?=$pty_cnt-1?>"; //Initial field counter
	$('.list_add_button2').click(function()
	    {
	    //Check maximum number of input fields
	    if(x2 < list_maxField){ 
	        x2++; //Increment field counter
	        var list_fieldHTML = '<div class="row"><div class="status-checkbox"><input class="form-check-input" type="checkbox" name="pty['+x2+'][pstatus]" value="1"></div><div class="col-xs-3 col-sm-3 col-md-3"><div class="form-group"><input name="pty['+x2+'][name]" type="text" placeholder="Name" class="form-control"/></div></div><div class="col-xs-3 col-sm-3 col-md-3"><div class="form-group"><input name="pty['+x2+'][brand]" type="text" placeholder="Brand" class="form-control"/></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input name="pty['+x2+'][wattage]" type="text" placeholder="wattage" class="form-control"/></div></div><div class="col-xs-1 col-sm-1 col-md-1"><div class="form-group"><input name="pty['+x2+'][price]" type="text" placeholder="Cost" class="form-control"/></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input autocomplete="off" name="pty['+x2+'][swarranty]" type="text" placeholder="Warranty" class="form-control" /></div></div><div class="col-xs-3 col-sm-3 col-md-3"><div class="form-group"><input autocomplete="off" name="pty['+x2+'][effectWarranty]" type="text" placeholder="Warranty" class="form-control" /></div></div><div class="col-xs-3 col-sm-3 col-md-3"><div class="form-group"><input autocomplete="off" name="pty['+x2+'][warranty_percentage]" type="text" placeholder="Warranty" class="form-control" /></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group">Color<input autocomplete="off" name="pty['+x2+'][pcolor]" type="text" class="form-control"/></div></div><div class="col-xs-3 col-sm-3 col-md-3"><div class="form-group"><input type="file" name="pty['+x2+'][panel_img]" id="drop_panel'+x2+'" class="dropify dropify-panel" data-max-file-size="1M" data-height="150" /></div></div><div class="col-xs-1 col-sm-7 col-md-1"><a href="javascript:void(0);" class="list_remove_button btn btn-danger">-</a></div></div></div> '; //New input field html 
	        $('.list_wrapper2').append(list_fieldHTML); //Add field html
	    }
        });
	 // sec3
	 var x3 = "<?=$invt_cnt-1?>"; //Initial field counter
	$('.list_add_button3').click(function()
	    {
	    //Check maximum number of input fields
	    if(x3 < list_maxField){ 
	        x3++; //Increment field counter
	        var list_fieldHTML = '<div class="row"><div class="status-checkbox"><input class="form-check-input" type="checkbox" name="invt['+x3+'][invstatus]" value="1"></div><div class="col-xs-4 col-sm-4 col-md-4"><div class="form-group"><input name="invt['+x3+'][name]" type="text" placeholder="Name" class="form-control"/></div></div><div class="col-xs-3 col-sm-3 col-md-3"><div class="form-group"><input name="invt['+x3+'][invbrand]" type="text" placeholder="Brand" class="form-control" /></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input name="invt['+x3+'][price]" type="text" placeholder="Cost" class="form-control"/></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input autocomplete="off" name="invt['+x3+'][invwarranty]" type="text" placeholder="Warranty" class="form-control" /></div></div><div class="col-xs-3 col-sm-3 col-md-3"><div class="form-group"><input type="file" name="invt['+x3+'][inverter_img]" id="drop_inverter'+x3+'" class="dropify dropify-inverter" data-max-file-size="1M" data-height="150" /></div></div> <div class="col-xs-1 col-sm-7 col-md-1"><a href="javascript:void(0);" class="list_remove_button btn btn-danger">-</a></div></div>'; //New input field html 
	        $('.list_wrapper3').append(list_fieldHTML); //Add field html
	    }
        });	
	// sec4
	var x4 = "<?=$intc_cnt-1?>"; //Initial field counter	
	$('.list_add_button4').click(function()
	    {
	    //Check maximum number of input fields
	    if(x4 < list_maxField){ 
	        x4++; //Increment field counter
	        var list_fieldHTML = '<div class="row"><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input name="intc['+x4+'][day]" type="text" placeholder="Day" class="form-control"/></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input name="intc['+x4+'][price]" type="text" placeholder="Cost" class="form-control"/></div></div><div class="col-xs-3 col-sm-3 col-md-3"><div class="form-group"><input autocomplete="off" name="intc['+x4+'][work_year]" type="text" placeholder="Work Performed" class="form-control" value="<?=$val->work_year?>"/></div></div><div class="col-xs-1 col-sm-7 col-md-1"><a href="javascript:void(0);" class="list_remove_button btn btn-danger">-</a></div></div>'; //New input field html 
	        $('.list_wrapper4').append(list_fieldHTML); //Add field html
	    }
        });	
			 // sec5
	var x5 = "<?=$btrcs_cnt?>"; //Initial field counter			 
	$('.list_add_button5').click(function()
	    {
	    //Check maximum number of input fields
	    if(x5 < list_maxField){ 
	        x5++; //Increment field counter
	        var list_fieldHTML = '<div class="row"><div class="status-checkbox"><input class="form-check-input" type="checkbox" name="btrcs['+x5+'][bstatus]" value="1"></div><div class="col-xs-4 col-sm-4 col-md-4"><div class="form-group"><input name="btrcs['+x5+'][name]" type="text" placeholder="Name" class="form-control"/></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input name="btrcs['+x5+'][price]" type="text" placeholder="Cost" class="form-control"/></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input autocomplete="off" name="btrcs['+x5+'][bwarranty]" type="text" placeholder="Warranty" class="form-control"  /></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input autocomplete="off" name="btrcs['+x5+'][bdiscount]" type="text" placeholder="Discount" class="form-control" /></div></div><div class="col-xs-3 col-sm-3 col-md-3"><div class="form-group"><input type="file" name="btrcs['+x5+'][battery_img]" id="drop_battery'+x5+'" class="dropify dropify-battery" data-max-file-size="1M" data-height="150" /><input type="hidden" name="btrcs['+x5+'][battery_img]" class="form-control"/></div></div><div class="col-xs-1 col-sm-7 col-md-1"><a href="javascript:void(0);" class="list_remove_button btn btn-danger">-</a></div></div>'; //New input field html 
	        $('.list_wrapper5').append(list_fieldHTML); //Add field html
	    }
        });
        //Once remove button is clicked
        $('.list_wrapper').on('click', '.list_remove_button', function()
        {
           $(this).closest('div.row').remove(); //Remove field html
           x--; //Decrement field counter
        });

		// sec6
	var x6 = "<?=$btrcs_cnt?>"; //Initial field counter			 
	$('.list_add_button6').click(function()
	    {
	    //Check maximum number of input fields
	    if(x6 < list_maxField){ 
	        x6++; //Increment field counter
	        var list_fieldHTML = '<div class="row"><div class="status-checkbox"><input class="form-check-input" type="checkbox" name="roof['+x6+'][rfstatus]" value="1"></div><div class="col-xs-3 col-sm-3 col-md-3"><div class="form-group">Roof Type<input name="roof['+x6+'][name]" type="text" placeholder="Name" class="form-control" /></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group">Per panel cost (kr)<input autocomplete="off" name="roof['+x6+'][price]" type="text" placeholder="Cost" class="form-control" /></div></div><div class="col-xs-1 col-sm-7 col-md-1"><a href="javascript:void(0);" class="list_remove_button btn btn-danger">-</a></div>'; //New input field html 
	        $('.list_wrapper6').append(list_fieldHTML); //Add field html
	    }
        });
        //Once remove button is clicked
        $('.list_wrapper').on('click', '.list_remove_button', function()
        {
           $(this).closest('div.row').remove(); //Remove field html
           x--; //Decrement field counter
        });
});
function revrcrd(rid){
	$("#"+rid).remove();
}


$('.dropify').parent().find(".dropify-clear").trigger('click');

</script>
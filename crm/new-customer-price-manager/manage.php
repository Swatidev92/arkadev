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
					$folder = FILES_PATH.UP_FILES_PROPOSAL."/charger/";
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
					$folder = FILES_PATH.UP_FILES_PROPOSAL."/battery/";
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
					$folder = FILES_PATH.UP_FILES_PROPOSAL."/inverter/";
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
					$folder = FILES_PATH.UP_FILES_PROPOSAL."/solar-panel/";
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
	$_POSTS['only_charger_max_rebate'] = json_encode($_POST['onlychargermaxmrg']);
	$_POSTS['sensor_type'] = json_encode($_POST['sensor']);
	$_POSTS['odrift_type'] = json_encode($_POST['odrift']);
	$_POSTS['optimizer_type'] = json_encode($_POST['optimizer']);

// S:mk-19
$_POSTS['cable_inv'] = json_encode($_POST['cables_inv']);
$_POSTS['cable_ev'] = json_encode($_POST['cables_ev']);

$_POSTS['ac_protect'] = json_encode($_POST['ac_protect']);
$_POSTS['dc_protect'] = json_encode($_POST['dc_protect']);

$_POSTS['wifi_dongle'] = json_encode($_POST['wifi_dongle']);

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

if($_GET['val']=='1'){
	$active = "style='background:green;color:white;'";
	$lnk = "style='color:white;'";
}else if($_GET['val']=='2'){
	$active2 = "style='background:green;color:white;'";
	$lnk2 = "style='color:white;'";
}else if($_GET['val']=='3'){
	$active3 = "style='background:green;color:white;'";
	$lnk3 = "style='color:white;'";
}else if($_GET['val']=='4'){
	$active4 = "style='background:green;color:white;'";
	$lnk4 = "style='color:white;'";
}else if($_GET['val']=='5'){
	$active5 = "style='background:green;color:white;'";
	$lnk5 = "style='color:white;'";
}else if($_GET['val']=='6'){
	$active6 = "style='background:green;color:white;'";
	$lnk6 = "style='color:white;'";
}else if($_GET['val']=='7'){
	$active7 = "style='background:green;color:white;'";
	$lnk7 = "style='color:white;'";
}else{
	$active8 = "";
	$lnk8 = "";
}

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
			<div class="form-group col-sm-3 text-right pull-right">
                <button type="submit" class="btn btn-primary" id="submit_btn">Publish</button>
                <button type="button" onclick="history.go(-1)" class="btn btn-primary">Back</button>
            </div>
			<div class="col-md-2">
				<ul class="nav nav-pills nav-stacked">
  					<li <?=$active?>><a href="?val=1" <?=$lnk?>>Technique</a></li>
					<li <?=$active2?>><a href="?val=2" <?=$lnk2?>>Extras</a></li>
					<li <?=$active3?>><a href="?val=3" <?=$lnk3?>>MMS</a></li>
					<li <?=$active4?>><a href="?val=4" <?=$lnk4?>>Shipment</a></li>
					<li <?=$active5?>><a href="?val=5" <?=$lnk5?>>Instalation</a></li>
					<li <?=$active6?>><a href="?val=6" <?=$lnk6?>>Margin</a></li>
					<li <?=$active7?>><a href="?val=7" <?=$lnk7?>>Other</a></li>
				</ul>
			</div>
			<div class="col-md-10">
				<!--S:Technique -->
				<?php if($_GET['val']=='1'){?>
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#panel">Panel</a></li>
						<li><a data-toggle="tab" href="#inverter">Inverter</a></li>
						<li><a data-toggle="tab" href="#battery">Battery</a></li>
						<li><a data-toggle="tab" href="#ev">EV Charger</a></li>

					</ul>

					<div class="tab-content">
						<!-- S:panel -->
						<div id="panel" class="tab-pane fade in active">
							
							<div class="list_wrapper list_wrapper2" style="font-size:12px;">  
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
														<b>Name</b>
														<input name="pty[<?=$i?>][name]" type="text" placeholder="Name" class="form-control" value="<?=$val->name?>"/>
													</div>
												</div>
												<div class="col-xs-2 col-sm-2 col-md-2">
													<div class="form-group">
														<b>Brand</b>
														<input name="pty[<?=$i?>][brand]" type="text" placeholder="Brand" class="form-control" value="<?=$val->brand?>"/>
													</div>
												</div>
												<div class="col-xs-1 col-sm-1 col-md-1">
													<div class="form-group">
														<b>Wattage</b>
														<input autocomplete="off" name="pty[<?=$i?>][wattage]" type="text" placeholder="wattage" class="form-control" value="<?=$val->wattage?>"/>
													</div>
												</div>
												<div class="col-xs-1 col-sm-1 col-md-1">
													<div class="form-group">
														<b>Cost</b>
														<input autocomplete="off" name="pty[<?=$i?>][price]" type="text" placeholder="Cost" class="form-control" value="<?=$val->price?>"/>
													</div>
												</div>
												<div class="col-xs-2 col-sm-2 col-md-2">
													<div class="form-group">
														<b>Warranty (years)</b>
														<input autocomplete="off" name="pty[<?=$i?>][swarranty]" type="text" placeholder="Warranty" class="form-control" value="<?=$val->swarranty?>"/>
													</div>
												</div>
												<div class="col-xs-2 col-sm-2 col-md-2">
													<div class="form-group">
														<b>Effektfaktor</b>
														<input autocomplete="off" name="pty[<?=$i?>][effektfaktor]" type="text" placeholder="Effektfaktor" class="form-control" value="<?=$val->effektfaktor?>"/>
													</div>
												</div>
												<div class="col-xs-2 col-sm-2 col-md-2">
													<div class="form-group">
														<b>Kortslutningsström</b>
														<input autocomplete="off" name="pty[<?=$i?>][short_circuit]" type="text" class="form-control" value="<?=$val->short_circuit?>"/>
													</div>
												</div>
												<div class="col-xs-3 col-sm-3 col-md-3">
													<div class="form-group">
														<b>Effect Warranty (years)</b>
														<input autocomplete="off" name="pty[<?=$i?>][effectWarranty]" type="text" placeholder="Warranty" class="form-control" value="<?=$val->effectWarranty?>"/>
													</div>
												</div>
												<div class="col-xs-3 col-sm-3 col-md-3">
													<div class="form-group">
														<b>Effect warranty after <?=$val->effectWarranty?> years (%)</b>
														<input autocomplete="off" name="pty[<?=$i?>][warranty_percentage]" type="text" placeholder="Effect warranty after <?=$val->effectWarranty?> years (%)" class="form-control" value="<?=$val->warranty_percentage?>"/>
													</div>
												</div>
												<div class="col-xs-2 col-sm-2 col-md-2">
													<div class="form-group">
														<b>Color</b>
														<input autocomplete="off" name="pty[<?=$i?>][pcolor]" type="text" class="form-control" value="<?=$val->pcolor?>"/>
													</div>
												</div>
												<div class="col-xs-3 col-sm-3 col-md-3">
													<div class="form-group">
														<b>Image max-width:</b> 270px and height: 131px and extension: jpg/jpeg
														<input type="file" name="pty[<?=$i?>][panel_img]" id="drop_panel<?=$i?>" class="dropify dropify-panel" data-max-file-size="1M" data-height="150" <?php if($val->panel_img AND file_exists(FILES_PATH.UP_FILES_PROPOSAL.'/solar-panel/'.$val->panel_img)){ ?> data-default-file="<?=SITE_PATH.UPLOAD_FILES_PTH.'/'.UP_FILES_PROPOSAL?>/solar-panel/<?=$val->panel_img?>" <?php } ?> />
														<input type="hidden" name="pty[<?=$i?>][panel_img]" class="form-control" value="<?=$val->panel_img?>"/>
													</div>
												</div>
												<div class="col-xs-1 col-sm-1 col-md-1">
													<br>
													<button class="" onclick='revrcrd("pmt<?=$i?>")' type="button"><i class="fa fa-close text-danger"></i></button>
												</div>
												<?php $i++; ?>
											</div> 
											<hr>
										<?php } }	?>  
										<div class="row">
											<div class="col-xs-4 col-sm-4 col-md-4">
												<h3>Add New <button class="btn btn-primary list_add_button2" type="button">+</button></h3>
											</div>
										</div>
									</div>
									<div class="clearfix"></div>

						</div>
						<!-- S:inverter -->
						<div id="inverter" class="tab-pane fade">
							
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
												<b>Name</b>
												<input name="invt[<?=$i?>][name]" type="text" placeholder="Name" class="form-control" value="<?=$val->name?>"/>
											</div>
										</div>
										<div class="col-xs-3 col-sm-3 col-md-3">
											<div class="form-group">
												<b>Effect(kW)</b>
												<input name="invt[<?=$i?>][inveffect]" type="text" placeholder="Effect" class="form-control" value="<?=$val->inveffect?>"/>
											</div>
										</div>
										<div class="col-xs-3 col-sm-3 col-md-3">
											<div class="form-group">
												<b>Brand</b>
												<input name="invt[<?=$i?>][invbrand]" type="text" placeholder="Brand" class="form-control" value="<?=$val->invbrand?>"/>
											</div>
										</div>
										<div class="col-xs-2 col-sm-2 col-md-2">
											<div class="form-group">
												<b>Cost</b>
												<input autocomplete="off" name="invt[<?=$i?>][price]" type="text" placeholder="Cost" class="form-control" value="<?=$val->price?>"/>
											</div>
										</div> 
										<div class="col-xs-2 col-sm-2 col-md-2">
											<div class="form-group">
												<b>Warranty (years)</b>
												<input autocomplete="off" name="invt[<?=$i?>][invwarranty]" type="text" placeholder="Warranty" class="form-control" value="<?=$val->invwarranty?>"/>
											</div>
										</div>
										<div class="col-xs-3 col-sm-3 col-md-3">
											<div class="form-group">
												<b>Image max-width:</b> 270px and height: 131px and extension: jpg/jpeg
												<input type="file" name="invt[<?=$i?>][inverter_img]" id="drop_inverter<?=$i?>" class="dropify dropify-inverter" data-max-file-size="1M" data-height="150" <?php if($val->inverter_img AND file_exists(FILES_PATH.UP_FILES_PROPOSAL.'/inverter/'.$val->inverter_img)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/<?=UP_FILES_PROPOSAL?>/inverter/<?=$val->inverter_img?>" <?php } ?> />
												<input type="hidden" name="invt[<?=$i?>][inverter_img]" class="form-control" value="<?=$val->inverter_img?>"/>
											</div>
										</div>
										<div class="col-xs-3 col-sm-3 col-md-3">
											<div class="form-group">
												<div class="checkbox checkbox-success">
													<input id="checkbox<?=$i?>" type="checkbox" name="invt[<?=$i?>][compatible]" value="1" <?=$val->compatible==1?'checked':''?>>
													<label for="checkbox<?=$i?>">Battery Compatible</label>
												</div>
											</div>
										</div>
										<div class="col-xs-3 col-sm-3 col-md-3">
											<b>Wifi Dongle</b>
											<select class="form-control" id="model<?=$i?>" name="invt[<?=$i?>][dongle_model]" <?=$readonly_field?>>
											<!-- <option value="">Select Dongle type</option> -->
												<option value="dongle_include">Wifi Dongle Included</option>
													<?php $dongleTypePriceArr = json_decode($wifi_dongle, true);
														foreach ($dongleTypePriceArr as $dkey => $dvalue) {
															if($dvalue["dongle_status"]==1){
																if($val->dongle_model==$dvalue["dongle_model"]){
																	$dsel = 'selected';
																}else{
																	$dsel = '';
																}
															echo '<option value="'.$dvalue["dongle_model"].'" '.$dsel.'>'.$dvalue["dongle_brand"].'&nbsp'.$dvalue["dongle_model"].'</option>';
															} 
														}
													?>
											</select>
										</div>
											
										<div class="col-xs-1 col-sm-1 col-md-1">
											<br>
											<button class="" onclick='revrcrd("invm<?=$i?>")' type="button"><i class="fa fa-close text-danger"></i></button>
										</div>
										<div class="clearfix"></div>
										<?php $i++; ?>
									</div>
									<hr>
									<?php } } ?>  
									<div class="row">
										<div class="col-xs-4 col-sm-4 col-md-4">
											<h3>Add New <button class="btn btn-primary list_add_button3" type="button">+</button></h3>
										</div>
									</div>
								</div>
								<div class="clearfix"></div>					

						</div>
						<!-- S:battery -->
						<div id="battery" class="tab-pane fade">
							
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
														<b>Name</b>
														<input name="btrcs[<?=$i?>][name]" type="text" placeholder="Name" class="form-control" value="<?=$val->name?>"/>
													</div>
												</div>
												<div class="col-xs-2 col-sm-2 col-md-2">
													<div class="form-group">
														<b>Size(kWh)</b>
														<input autocomplete="off" name="btrcs[<?=$i?>][btsize]" type="text" placeholder="Size" class="form-control" value="<?=$val->btsize?>"/>
													</div>
												</div> 
												<div class="col-xs-2 col-sm-2 col-md-2">
													<div class="form-group">
														<b>Cost</b>
														<input autocomplete="off" name="btrcs[<?=$i?>][price]" type="text" placeholder="Cost" class="form-control" value="<?=$val->price?>"/>
													</div>
												</div> 
												<div class="col-xs-2 col-sm-2 col-md-2">
													<div class="form-group">
														<b>Warranty (year)</b>
														<input autocomplete="off" name="btrcs[<?=$i?>][bwarranty]" type="text" placeholder="Warranty" class="form-control" value="<?=$val->bwarranty?>"/>
													</div>
												</div> 
												<div class="col-xs-2 col-sm-2 col-md-2">
													<div class="form-group">
														<b>Discount (kr)</b>
														<input autocomplete="off" name="btrcs[<?=$i?>][bdiscount]" type="text" placeholder="Discount" class="form-control" value="<?=$val->bdiscount?>"/>
													</div>
												</div> 
												<div class="col-xs-3 col-sm-3 col-md-3">
													<div class="form-group">
														<b>Image max-width: 270px and height: 131px and extension: jpg/jpeg</b>
														<input type="file" name="btrcs[<?=$i?>][battery_img]" id="drop_battery<?=$i?>" class="dropify dropify-battery" data-max-file-size="1M" data-height="150" <?php if($val->battery_img AND file_exists(FILES_PATH.UP_FILES_PROPOSAL.'/battery/'.$val->battery_img)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/<?=UP_FILES_PROPOSAL?>/battery/<?=$val->battery_img?>" <?php } ?> />
														<input type="hidden" name="btrcs[<?=$i?>][battery_img]" class="form-control" value="<?=$val->battery_img?>"/>
													</div>
												</div>
												<div class="col-xs-1 col-sm-1 col-md-1">
													<br>
													<button class="" onclick='revrcrd("btrow<?=$i?>")' type="button"><i class="fa fa-close text-danger"></i></button>
												</div>
												<div class="clearfix"></div>
											<?php $i++; ?>
										</div> 
										<hr>
									<?php } } ?>  
									<div class="row">
										<div class="col-xs-4 col-sm-4 col-md-4">
											<h3>Add New <button class="btn btn-primary list_add_button5" type="button">+</button></h3>
										</div>
									</div>
								</div>
								<div class="clearfix"></div>

						</div>
						<!-- S:Ev -->
						<div id="ev" class="tab-pane fade">
							
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
														<b>Name</b>
														<input name="evc[<?=$i?>][name]" type="text" placeholder="Name" class="form-control" value="<?=$val->name?>"/>
													</div>
												</div>
												<div class="col-xs-2 col-sm-2 col-md-2">
													<div class="form-group">
														<b>EV Charger Cost (kr)</b>
														<input autocomplete="off" name="evc[<?=$i?>][price]" type="text" placeholder="Cost" class="form-control" value="<?=$val->price?>"/>
													</div>
												</div>
												<div class="col-xs-3 col-sm-3 col-md-3">
													<div class="form-group">
														<b>EV Charger Warranty (years)</b>
														<input autocomplete="off" name="evc[<?=$i?>][cwarranty]" type="text" placeholder="Warranty" class="form-control" value="<?=$val->cwarranty?>"/>
													</div>
												</div>
												<div class="col-xs-2 col-sm-2 col-md-2">
													<div class="form-group">
														<b>Discount (kr)</b>
														<input autocomplete="off" name="evc[<?=$i?>][cdiscount]" type="text" placeholder="Discount" class="form-control" value="<?=$val->cdiscount?>"/>
													</div>
												</div>
												<div class="clearfix"></div>
												<div class="col-xs-3 col-sm-3 col-md-3">
													<div class="form-group">
														<b>Load Balancer Cost (kr)</b>
														<input name="evc[<?=$i?>][loadbalancercost]" type="text" placeholder="Load Balancer" class="form-control" value="<?=$val->loadbalancercost?>"/>
													</div>
												</div>
												<div class="col-xs-3 col-sm-3 col-md-3">
													<div class="form-group">
														<b>Load Balancer Warranty (years)</b>
														<input name="evc[<?=$i?>][lbwarranty]" type="number" placeholder="Load Balancer warranty" class="form-control" value="<?=$val->lbwarranty?>"/>
													</div>
												</div>
												<div class="col-xs-3 col-sm-3 col-md-3">
													<div class="form-group">
														<b>Image max-width: 270px and height: 131px and extension: jpg/jpeg</b>
														<input type="file" name="evc[<?=$i?>][charger_img]" id="drp<?=$i?>" class="dropify dropify-charger" data-max-file-size="1M" data-height="150" <?php if($val->charger_img AND file_exists(FILES_PATH.UP_FILES_PROPOSAL.'/charger/'.$val->charger_img)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/<?=UP_FILES_PROPOSAL?>/charger/<?=$val->charger_img?>" <?php } ?> />
														<input type="hidden" name="evc[<?=$i?>][charger_img]" class="form-control" value="<?=$val->charger_img?>"/>
													</div>
												</div>
												<div class="col-xs-1 col-sm-1 col-md-1">
													<br>
													<button class="" onclick='revrcrd("rev<?=$i?>")' type="button"><i class="fa fa-close text-danger"></i></button>
												</div>
											<?php $i++; ?>
										</div>
										<hr>
									<?php } } ?>
								<div class="row">
									<div class="col-xs-4 col-sm-4 col-md-4">
										<h3>Add New <button class="btn btn-primary list_add_button1" type="button">+</button></h3>
									</div>
								</div>
							</div>
							<div class="clearfix"></div>				

						</div>
					</div>


				<!-- S:Extras -->
				<?php } else if($_GET['val']=='2'){?>

					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#smart-sensor">Smart Sensor</a></li>
						<li><a data-toggle="tab" href="#backup-box">Backup Box</a></li>
						<li><a data-toggle="tab" href="#optimizer">Optimizer</a></li>
						<li><a data-toggle="tab" href="#ac-protect">AC Protect</a></li>
						<li><a data-toggle="tab" href="#dc-protect">DC Protect</a></li>
						<li><a data-toggle="tab" href="#cable-length">Cable Length</a></li>
						<li><a data-toggle="tab" href="#wifi-dongle">Wifi Dongle</a></li>

					</ul>

					<div class="tab-content">
						<div id="smart-sensor" class="tab-pane fade in active">
							
							<div class="list_wrapper list_wrapper_sensor">
								<?php $sensor_obj = json_decode($sensor_type);
									$sensor_cnt = count($sensor_obj);
									if(count($sensor_obj)>0){
										$i=0;
										foreach($sensor_obj as $val){?>
										<div class="row" id="rev<?=$i?>">
											<div class="status-checkbox">
												<input class="form-check-input" type="checkbox" name="sensor[<?=$i?>][sensor_status]" value="1" <?=$val->sensor_status==1?'checked':''?>>
											</div>
											<div class="form-group col-xs-2 col-sm-2 col-md-4">
												<b>Name</b>
												<input name="sensor[<?=$i?>][sensor_name]" type="text" placeholder="Name" class="form-control" value="<?=$val->sensor_name?>"/>
											</div>
											<div class="form-group col-xs-2 col-sm-2 col-md-4">
												<b>Cost</b>
												<input name="sensor[<?=$i?>][sensor_cost]" type="text" placeholder="Cost" class="form-control" value="<?=$val->sensor_cost?>"/>
											</div>
											<div class="form-group col-xs-2 col-sm-2 col-md-2">
												<b>Warranty</b>
												<input name="sensor[<?=$i?>][sensor_warranty]" type="text" placeholder="Warranty" class="form-control" value="<?=$val->sensor_warranty?>"/>
											</div>
											<div class="col-xs-1 col-sm-1 col-md-1">
												<br>
												<button class="" onclick='revrcrd("rev<?=$i?>")' type="button"><i class="fa fa-close text-danger"></i></button>
											</div>
										<?php $i++; ?>
									</div>
									<?php } } ?>
									<div class="row">
										<div class="col-xs-4 col-sm-4 col-md-4">
											<h3>Add New <button class="btn btn-primary list_add_button7" type="button">+</button></h3>
										</div>
									</div>
								</div>
								<div class="clearfix"></div>

						</div>
						<div id="backup-box" class="tab-pane fade">
							
							<div class="list_wrapper list_wrapper_odrift">
								<?php $odrift_obj = json_decode($odrift_type);
									$odrift_cnt = count($odrift_obj);
									if(count($odrift_obj)>0){
										$i=0;
										foreach($odrift_obj as $val){?>
										<div class="row" id="rev<?=$i?>">
											<div class="status-checkbox">
												<input class="form-check-input" type="checkbox" name="odrift[<?=$i?>][odrift_status]" value="1" <?=$val->odrift_status==1?'checked':''?>>
											</div>
											<div class="form-group col-xs-2 col-sm-2 col-md-4">
												<b>Name</b>
												<input name="odrift[<?=$i?>][odrift_name]" type="text" placeholder="Name" class="form-control" value="<?=$val->odrift_name?>"/>
											</div>
											<div class="form-group col-xs-2 col-sm-2 col-md-4">
												<b>Cost</b>
												<input name="odrift[<?=$i?>][odrift_cost]" type="text" placeholder="Cost" class="form-control" value="<?=$val->odrift_cost?>"/>
											</div>
											<div class="form-group col-xs-2 col-sm-2 col-md-2">
												<b>Warranty</b>
												<input name="odrift[<?=$i?>][odrift_warranty]" type="text" placeholder="Warranty" class="form-control" value="<?=$val->odrift_warranty?>"/>
											</div>
											<div class="col-xs-1 col-sm-1 col-md-1">
												<br>
												<button class="" onclick='revrcrd("rev<?=$i?>")' type="button"><i class="fa fa-close text-danger"></i></button>
											</div>
											<?php $i++; ?> 
										</div>
										<?php } } ?>
										<div class="row">
											<div class="col-xs-4 col-sm-4 col-md-4">
												<h3>Add New <button class="btn btn-primary list_add_button8" type="button">+</button></h3>
											</div>
										</div>
									</div>
									<div class="clearfix"></div>

						</div>
						<div id="optimizer" class="tab-pane fade">
							
							<div class="list_wrapper list_wrapper_optimizer">
								<?php $optimizer_obj = json_decode($optimizer_type);
									$optimizer_obj_cnt = count($optimizer_obj);
									if(count($optimizer_obj)>0){
									$i=0;
										foreach($optimizer_obj as $val){?>
											<div class="row" id="rev<?=$i?>">
												<div class="status-checkbox">
													<input class="form-check-input" type="checkbox" name="optimizer[<?=$i?>][optimizer_status]" value="1" <?=$val->optimizer_status==1?'checked':''?>>
												</div>
												<div class="form-group col-xs-2 col-sm-2 col-md-4">
													<b>Name</b>
													<input name="optimizer[<?=$i?>][optimizer_name]" type="text" placeholder="Name" class="form-control" value="<?=$val->optimizer_name?>"/>
												</div>
												<div class="form-group col-xs-2 col-sm-2 col-md-2">
													<b>Cost</b>
													<input name="optimizer[<?=$i?>][optimizer_cost]" type="text" placeholder="Cost" class="form-control" value="<?=$val->optimizer_cost?>"/>
												</div>
												<div class="form-group col-xs-2 col-sm-2 col-md-2">
													<b>Warranty</b>
													<input name="optimizer[<?=$i?>][optimizer_warranty]" type="text" placeholder="Warranty" class="form-control" value="<?=$val->optimizer_warranty?>"/>
												</div>
												<div class="col-xs-1 col-sm-1 col-md-1">
													<br>
													<button class="" onclick='revrcrd("rev<?=$i?>")' type="button"><i class="fa fa-close text-danger"></i></button>
												</div>
												<?php $i++; ?>
											</div>
											<hr> 
											<?php } } ?>
											<div class="row">
												<div class="col-xs-4 col-sm-4 col-md-4">
													<h3>Add New <button class="btn btn-primary list_add_button9" type="button">+</button></h3>
												</div>
											</div>
										</div>
										<div class="clearfix"></div>

						</div>
						<div id="ac-protect" class="tab-pane fade">
						
							<div class="list_wrapper list_wrapper_ac">
								<?php $obj_ac_protect = json_decode($ac_protect);
									$ac_cnt = count($obj_ac_protect);
									if(count($obj_ac_protect)>0){
										$i=0;
										foreach($obj_ac_protect as $val1){
								?>
									<div class="row" id="rev<?=$i?>">
										<div class="status-checkbox">
											<input class="form-check-input" type="checkbox" name="ac_protect[<?=$i?>][status]" value="1" <?=$val1->status==1?'checked':''?>>
										</div>
										<div class="form-group col-xs-4 col-sm-4 col-md-4">
											Brand
											<input name="ac_protect[<?=$i?>][brand]" type="text" placeholder="Name" class="form-control" value="<?=$obj_ac_protect[$i]->brand?>"/>
										</div>
										<div class="form-group col-xs-2 col-sm-2 col-md-2">
											Price
											<input name="ac_protect[<?=$i?>][price]" type="text" placeholder="Cost" class="form-control" value="<?=$obj_ac_protect[$i]->price?>"/>
										</div>
										<?php $i++; ?>
									</div>
									<hr>
									<?php } } ?>
								</div>
								<div class="clearfix"></div>

						</div>
						<div id="dc-protect" class="tab-pane fade">
							
							<div class="list_wrapper list_wrapper_dc">
								<?php $obj_dc_protect = json_decode($dc_protect);
									$ac_cnt = count($obj_dc_protect);
									if(count($obj_dc_protect)>0){
									$i=0;
										foreach($obj_dc_protect as $val1){
								?>
								<div class="row" id="rev<?=$i?>">
									<div class="status-checkbox">
										<input class="form-check-input" type="checkbox" name="dc_protect[<?=$i?>][status]" value="1" <?=$val1->status==1?'checked':''?>>
									</div>
									<div class="form-group col-xs-4 col-sm-4 col-md-4">
										<b>Brand</b>
										<input name="dc_protect[<?=$i?>][brand]" type="text" placeholder="Name" class="form-control" value="<?=$obj_dc_protect[$i]->brand?>"/>
									</div>
									<div class="form-group col-xs-2 col-sm-2 col-md-2">
										<b>Price</b>
										<input name="dc_protect[<?=$i?>][price]" type="text" placeholder="Cost" class="form-control" value="<?=$obj_dc_protect[$i]->price?>"/>
									</div>
									<?php $i++; ?> 
								</div>
								<hr>
								<?php } } ?>
							</div>
							<div class="clearfix"></div>

						</div>
						<div id="cable-length" class="tab-pane fade">
							
							<div class="list_wrapper">
								<div class="list_wrapper">  
									<div class="row">
										<?php $obj_inv = json_decode($cable_inv);
											$obj_ev = json_decode($cable_ev); $i=0; ?>
										<div class="col-xs-6 col-sm-6 col-md-6">
											<div class="form-group">
												Inverter and EL meter Price/Meter including installation
												<input name="cables_inv[<?=$i?>][inv]" type="text" placeholder="" class="form-control" value="<?=$obj_inv[0]->inv?>"/>
											</div>
										</div>
										<div class="col-xs-6 col-sm-6 col-md-6">
											<div class="form-group">
												EV charger and EL meter Price/Meter including installation
												<input name="cables_ev[<?=$i?>][ev]" type="text" placeholder="" class="form-control" value="<?=$obj_ev[0]->ev?>"/>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="clearfix"></div>
							
						</div>
						<div id="wifi-dongle" class="tab-pane fade">
							
							<div class="list_wrapper list_wrapper_wifiDongle">
								<h3>Wifi Dongle</h3>
									<?php $obj_wifi_dongle = json_decode($wifi_dongle);
									$obj_wifi_cnt = count($obj_wifi_dongle);
									if(count($obj_wifi_dongle)>0){
										$i=0;
										foreach($obj_wifi_dongle as $val){?>
										<div class="row" id="rev<?=$i?>">
											<div class="status-checkbox">
												<input class="form-check-input" type="checkbox" name="wifi_dongle[<?=$i?>][dongle_status]" value="1" <?=$val->dongle_status==1?'checked':''?>>
											</div>
											<div class="form-group col-xs-2 col-sm-2 col-md-2">
												<b>Brand</b>
												<input name="wifi_dongle[<?=$i?>][dongle_brand]" type="text" placeholder="Brand Name" class="form-control" value="<?=$val->dongle_brand?>"/>
											</div>
											<div class="form-group col-xs-2 col-sm-2 col-md-2">
												<b>Model</b>
												<input name="wifi_dongle[<?=$i?>][dongle_model]" type="text" placeholder="Model Name" class="form-control" value="<?=$val->dongle_model?>"/>
											</div>
											<div class="form-group col-xs-2 col-sm-2 col-md-2">
												<b>Cost</b>
												<input name="wifi_dongle[<?=$i?>][dongle_cost]" type="text" placeholder="Cost" class="form-control" value="<?=$val->dongle_cost?>"/>
											</div>
											<div class="form-group col-xs-2 col-sm-2 col-md-2">
												<b>Warranty</b>
												<input name="wifi_dongle[<?=$i?>][dongle_warranty]" type="text" placeholder="Warranty" class="form-control" value="<?=$val->dongle_warranty?>"/>
											</div>
											<div class="col-xs-1 col-sm-1 col-md-1">
												<br>
												<button class="" onclick='revrcrd("rev<?=$i?>")' type="button"><i class="fa fa-close text-danger"></i></button>
											</div>
											<?php $i++; ?> 
										</div>
										<hr>
										<?php } } ?>
										<div class="row">
											<div class="col-xs-4 col-sm-4 col-md-4">
												<h3>Add New <button class="btn btn-primary list_add_button12" type="button">+</button></h3>
											</div>
										</div>
									</div>
									<div class="clearfix"></div>

						</div>
					</div>

				<!-- S:MMS -->
				<?php } else if($_GET['val']=='3'){?>

					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#vander-valk">Vander Valk</a></li>
						<li><a data-toggle="tab" href="#k2s">K2 System</a></li>
					</ul>

					<div class="tab-content">
						<div id="vander-valk" class="tab-pane fade in active">
							
							<div class="list_wrapper list_wrapper2" style="font-size:12px;">  
								<?php 
									$cpMmsQry=$cms->db_query("select * from #_customer_price_manager where m_id='3' and sub_id='31' and is_deleted = '0' "); 
									while($cpMmsArry= $cms->db_fetch_array($cpMmsQry)){	
									
									// @extract($cpMmsArry);
									$objMmsVv = json_decode($cpMmsArry['content'],true);
										$i=0;
										foreach($objMmsVv as $val){ ?>
											<div class="row" id="pmt<?=$i?>">
												<div class="status-checkbox">
													<input class="form-check-input" type="checkbox" name="vvstatus" value="1" <?=$cpMmsArry['status']==1?'checked':''?>>
												</div>
												<div class="col-xs-3 col-sm-3 col-md-3">
													<div class="form-group">
														<b>Code</b>
														<input name="mmsVV[<?=$i?>][code]" type="text" placeholder="Enter Code" class="form-control" value="<?=$val['code']?>"/>
													</div>
												</div>
												<div class="col-xs-4 col-sm-4 col-md-4">
													<div class="form-group">
														<b>Name</b>
														<input name="pty[<?=$i?>][name]" type="text" placeholder="Enter Name" class="form-control" value="<?=$val['name']?>"/>
													</div>
												</div>
												<div class="col-xs-3 col-sm-3 col-md-3">
													<div class="form-group">
														<b>Cost</b>
														<input autocomplete="off" name="pty[<?=$i?>][price]" type="text" placeholder="Cost" class="form-control" value="<?=$val['price']?>"/>
													</div>
												</div>
												<?php $i++; ?>
											</div> 
										<hr>
								<?php }  }?>  
											
							</div>
							<div class="clearfix"></div>

						</div>
						<div id="k2s" class="tab-pane fade">
						<div class="list_wrapper list_wrapper2" style="font-size:12px;">  
								<?php 
									$cpMmsQry=$cms->db_query("select * from #_customer_price_manager where m_id='3' and sub_id='32' and is_deleted = '0' "); 
									while($cpMmsArry= $cms->db_fetch_array($cpMmsQry)){	
									
									// @extract($cpMmsArry);
									$objMmsVv = json_decode($cpMmsArry['content'],true);
										$i=0;
										foreach($objMmsVv as $val){ ?>
											<div class="row" id="pmt<?=$i?>">
												<div class="status-checkbox">
													<input class="form-check-input" type="checkbox" name="vvstatus" value="1" <?=$cpMmsArry['status']==1?'checked':''?>>
												</div>
												<div class="col-xs-3 col-sm-3 col-md-3">
													<div class="form-group">
														<b>Code</b>
														<input name="mmsVV[<?=$i?>][code]" type="text" placeholder="Enter Code" class="form-control" value="<?=$val['code']?>"/>
													</div>
												</div>
												<div class="col-xs-4 col-sm-4 col-md-4">
													<div class="form-group">
														<b>Name</b>
														<input name="pty[<?=$i?>][name]" type="text" placeholder="Enter Name" class="form-control" value="<?=$val['name']?>"/>
													</div>
												</div>
												<div class="col-xs-3 col-sm-3 col-md-3">
													<div class="form-group">
														<b>Cost</b>
														<input autocomplete="off" name="pty[<?=$i?>][price]" type="text" placeholder="Cost" class="form-control" value="<?=$val['price']?>"/>
													</div>
												</div>
												<?php $i++; ?>
											</div> 
										<hr>
								<?php }  }?>  
											
							</div>
							<div class="clearfix"></div>
						</div>
					</div>

				<!-- S:Shipment -->
				<?php } else if($_GET['val']=='4'){?>

					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#shipment">Shipment</a></li>
					</ul>

					<div class="tab-content">
						<div id="shipment" class="tab-pane fade in active">
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

				<!-- S:Instalation -->
				<?php } else if($_GET['val']=='5'){?>

					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#installation-cost">Installation Cost</a></li>
					</ul>

					<div class="tab-content">
						<div id="installation-cost" class="tab-pane fade in active">
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
											<?php $i++; ?>
										</div>
										<?php } } ?>  
										<div class="row">
											<div class="col-xs-4 col-sm-4 col-md-4">
												<h3>Add New <button class="btn btn-primary list_add_button4" type="button">+</button></h3>
											</div>
										</div>
									</div>
									<div class="clearfix"></div>
								</div>
						
					</div>

				<!-- S:Margin -->
				<?php } else if($_GET['val']=='6'){?>
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#margin">Margin</a></li>
					</ul>

					<div class="tab-content">
						<!-- S:margin -->
						<div id="margin" class="tab-pane fade in active">
						
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
										Min : <input name="smrg[<?=$i?>][min]" type="text" placeholder="" class="form-control" value="<?=$obj_smrg[0]->min?>"/>
									</div>
								</div>
								<div class="col-xs-2 col-sm-2 col-md-2">
									<div class="form-group">
										Max : <input name="smrg[<?=$i?>][max]" type="text" placeholder="" class="form-control" value="<?=$obj_smrg[0]->max?>"/>
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
										Min : <input name="evmrg[<?=$i?>][min]" type="text" placeholder="" class="form-control" value="<?=$obj_evmrg[0]->min?>"/>
									</div>
								</div>
								<div class="col-xs-2 col-sm-2 col-md-2">
									<div class="form-group">
										Max : <input name="evmrg[<?=$i?>][max]" type="text" placeholder="" class="form-control" value="<?=$obj_evmrg[0]->max?>"/>
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
										Min : <input name="btmrg[<?=$i?>][min]" type="text" placeholder="" class="form-control" value="<?=$obj_btmrg[0]->min?>"/>
									</div>
								</div>
								<div class="col-xs-2 col-sm-2 col-md-2">
									<div class="form-group">
										Max : <input name="btmrg[<?=$i?>][max]" type="text" placeholder="" class="form-control" value="<?=$obj_btmrg[0]->max?>"/>
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

								<div class="clearfix"></div>
								</div>
								<div class="clearfix"></div>
							
							</div>

						</div>
					</div>
				<!--S:Other  -->
				<?php } else if($_GET['val']=='7'){?>
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#green-rebate">Green Rebate</a></li>
						<li><a data-toggle="tab" href="#pay-at-ordering">Pay At Ordering</a></li>
						<li><a data-toggle="tab" href="#production">Production</a></li>
						<li><a data-toggle="tab" href="#proposal-types">Proposal Types</a></li>
						<li><a data-toggle="tab" href="#vat">VAT</a></li>
					</ul>

					<div class="tab-content">
						<div id="green-rebate" class="tab-pane fade in active">
							
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
										</div>
									</div>
									<div class="clearfix"></div>

						</div>
						<div id="pay-at-ordering" class="tab-pane fade">
							
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
							<div class="clearfix"></div>

						</div>
						<div id="production" class="tab-pane fade">
						
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
						<div id="proposal-types" class="tab-pane fade">
							
							<div class="list_wrapper">  
								<div class="row">
									<?php $obj_prop_type = json_decode($proposal_type_name,true); 
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
								<hr>
								<div class="panel-body">
									<div class="list_wrapper">  
										<div class="row">
											<?php $obj_solarmaxmrg = json_decode($solar_max_rebate);
												$obj_solarevmaxmrg = json_decode($solar_ev_max_rebate);
												$obj_solarbatterymaxmrg = json_decode($solar_battery_max_rebate);
												$obj_solarevbatterymaxmrg = json_decode($solar_ev_battery_max_rebate);
												$obj_evchargermaxmrg = json_decode($only_charger_max_rebate);
												$i=0;								
											?>
											<div class="col-xs-3 col-sm-3 col-md-3">
												<div class="form-group">
													<h3 class="">Max Charger Rebate:</h3>
												</div>
											</div>
											<div class="col-xs-2 col-sm-2 col-md-2">
												<div class="checkbox checkbox-success">
													<input id="obj_evchargermaxmrg[<?=$i?>]" type="checkbox" name="onlychargermaxmrg[<?=$i?>][status]" value="1" <?=$obj_evchargermaxmrg[0]->status==1?'checked':''?>>
													<label for="obj_evchargermaxmrg[<?=$i?>]"> Max rebate </label>
													<input name="onlychargermaxmrg[<?=$i?>][maxrebate]" type="text" class="form-control" value="<?=$obj_evchargermaxmrg[0]->maxrebate?>" pattern="[0-9]+" />
												</div>
											</div>									
											<div class="clearfix"></div>
													
											<div class="col-xs-3 col-sm-3 col-md-3">
												<div class="form-group">
													<h3 class="">Solar panel only:</h3>
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
													<h3 class="">Campaign (Solar + EV charger):</h3>
												</div>
											</div>
											<div class="col-xs-6 col-sm-6 col-md-6">
												<table class="table table-striped1 table-hover1 table-bordered">
													<thead>
														<tr>
															<th align="center">1 Person</th>
															<th colspan="2">2 Person</th>
														</tr>
														<tr>
															<th>Solar+EV Charger</th>
															<th>Solar</th>
															<th>EV Charger</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td>
																<div class="checkbox checkbox-success">
																	<input id="obj_solarevmaxmrg[<?=$i?>]" type="checkbox" name="solarEvmaxmrg[<?=$i?>][sevstatus]" value="1" <?=$obj_solarevmaxmrg[0]->sevstatus==1?'checked':''?>>
																	<label for="obj_solarevmaxmrg[<?=$i?>]"> 
																	<input name="solarEvmaxmrg[<?=$i?>][maxsevmargin]" type="text" class="form-control" value="<?=$obj_solarevmaxmrg[0]->maxsevmargin?>" pattern="[0-9]+" /></label>
																</div>
															</td>	
															<td>
																<div class="checkbox checkbox-success">
																	<input id="obj_solarevmaxmrg[<?=$i?>]" type="checkbox" name="solarEvmaxmrg[<?=$i?>][sptwostatus]" value="1" <?=$obj_solarevmaxmrg[0]->sptwostatus==1?'checked':''?>>
																	<label for="obj_solarevmaxmrg[<?=$i?>]"> 
																		<input name="solarEvmaxmrg[<?=$i?>][sptwomaxmargin]" type="text" class="form-control" value="<?=$obj_solarevmaxmrg[0]->sptwomaxmargin?>" pattern="[0-9]+" />
																	</label>
																</div>
															</td>
															<td>
																<div class="checkbox checkbox-success">
																	<input id="obj_solarevmaxmrg[<?=$i?>]" type="checkbox" name="solarEvmaxmrg[<?=$i?>][evptwostatus]" value="1" <?=$obj_solarevmaxmrg[0]->evptwostatus==1?'checked':''?>>
																	<label for="obj_solarevmaxmrg[<?=$i?>]"> 
																		<input name="solarEvmaxmrg[<?=$i?>][evptwomaxmargin]" type="text" class="form-control" value="<?=$obj_solarevmaxmrg[0]->evptwomaxmargin?>" pattern="[0-9]+" />
																	</label>
																</div>
															</td>
														</tr>
													</tbody>
												</table>
											</div>
											<div class="clearfix"></div>
											<div class="col-xs-6 col-sm-6 col-md-6">
												<div class="form-group">
													<h3 class="">Campaign (Solar + Battery):</h3>
												</div>
											</div>
											<div class="col-xs-6 col-sm-6 col-md-6">
												<table class="table table-striped1 table-hover1 table-bordered">
													<thead>
														<tr>
															<th align="center">1 Person</th>
															<th colspan="2">2 Person</th>
														</tr>
														<tr>
															<th>Solar+Battery</th>
															<th>Solar</th>
															<th>Battery</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td>
																<div class="checkbox checkbox-success">
																	<input id="obj_solarbatterymaxmrg[<?=$i?>]" type="checkbox" name="solarBatterymaxmrg[<?=$i?>][status]" value="1" <?=$obj_solarbatterymaxmrg[0]->status==1?'checked':''?>>
																	<label for="obj_solarbatterymaxmrg[<?=$i?>]"> 
																	<input name="solarBatterymaxmrg[<?=$i?>][maxmargin]" type="text" class="form-control" value="<?=$obj_solarbatterymaxmrg[0]->maxmargin?>" pattern="[0-9]+" /></label>
																</div>
															</td>
															<td>
																<div class="checkbox checkbox-success">
																	<input id="obj_solarbatterymaxmrg[<?=$i?>]" type="checkbox" name="solarBatterymaxmrg[<?=$i?>][smaxstatus]" value="1" <?=$obj_solarbatterymaxmrg[0]->smaxstatus==1?'checked':''?>>
																	<label for="obj_solarbatterymaxmrg[<?=$i?>]"> 
																		<input name="solarBatterymaxmrg[<?=$i?>][solarmaxmargin]" type="text" class="form-control" value="<?=$obj_solarbatterymaxmrg[0]->solarmaxmargin?>" pattern="[0-9]+" />
																	</label>
																</div>
															</td>
															<td>
																<div class="checkbox checkbox-success">
																	<input id="obj_solarbatterymaxmrg[<?=$i?>]" type="checkbox" name="solarBatterymaxmrg[<?=$i?>][bmaxstatus]" value="1" <?=$obj_solarbatterymaxmrg[0]->bmaxstatus==1?'checked':''?>>
																	<label for="obj_solarbatterymaxmrg[<?=$i?>]"> 
																		<input name="solarBatterymaxmrg[<?=$i?>][batterymaxmargin]" type="text" class="form-control" value="<?=$obj_solarbatterymaxmrg[0]->batterymaxmargin?>" pattern="[0-9]+" />
																	</label>
																</div>
															</td>
														</tr>
													</tbody>
												</table>
											</div>
											<div class="clearfix"></div>
											<div class="col-xs-6 col-sm-6 col-md-6">
												<div class="form-group">
													<h3 class="">Campaign (Solar + EV charger + Battery):</h3>
												</div>
											</div>
											<div class="col-xs-6 col-sm-6 col-md-6">
												<table class="table table-striped1 table-hover1 table-bordered">
													<thead>
														<tr>
															<th align="center">1 Person</th>
															<th colspan="2">2 Person</th>
														</tr>
														<tr>
															<th>Solar+EV Charger+Battery</th>
															<th>Solar+EV Charger</th>
															<th>Battery</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td>
																<div class="checkbox checkbox-success">
																	<input id="obj_solarevbatterymaxmrg[<?=$i?>]" type="checkbox" name="solarEvBatterymaxmrg[<?=$i?>][sevbstatus]" value="1" <?=$obj_solarevbatterymaxmrg[0]->sevbstatus==1?'checked':''?>>
																	<label for="obj_solarevbatterymaxmrg[<?=$i?>]"> 
																	<input name="solarEvBatterymaxmrg[<?=$i?>][maxsevbmargin]" type="text" class="form-control" value="<?=$obj_solarevbatterymaxmrg[0]->maxsevbmargin?>" pattern="[0-9]+" /></label>
																</div>
															</td>
															<td>
																<div class="checkbox checkbox-success">
																	<input id="obj_solarevbatterymaxmrg[<?=$i?>]" type="checkbox" name="solarEvBatterymaxmrg[<?=$i?>][sevptwostatus]" value="1" <?=$obj_solarevbatterymaxmrg[0]->sevptwostatus==1?'checked':''?>>
																	<label for="obj_solarevbatterymaxmrg[<?=$i?>]"> 
																		<input name="solarEvBatterymaxmrg[<?=$i?>][sevptwomaxmargin]" type="text" class="form-control" value="<?=$obj_solarevbatterymaxmrg[0]->sevptwomaxmargin?>" pattern="[0-9]+" />
																	</label>
																</div>
															</td>
															<td>
																<div class="checkbox checkbox-success">
																	<input id="obj_solarevbatterymaxmrg[<?=$i?>]" type="checkbox" name="solarEvBatterymaxmrg[<?=$i?>][bptwostatus]" value="1" <?=$obj_solarevbatterymaxmrg[0]->bptwostatus==1?'checked':''?>>
																	<label for="obj_solarevbatterymaxmrg[<?=$i?>]"> 
																		<input name="solarEvBatterymaxmrg[<?=$i?>][bptwomaxmargin]" type="text" class="form-control" value="<?=$obj_solarevbatterymaxmrg[0]->bptwomaxmargin?>" pattern="[0-9]+" />
																	</label>
																</div>
															</td>
														</tr>
													</tbody>
												</table>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>	  
								</div>
								<div class="clearfix"></div>
							</div>

						</div>
						<div id="vat" class="tab-pane fade">
						
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
					</div>
				<!--  -->
				<?php }else{}?>
			</div>
			<div class="clearfix"></div>
			
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
	        var list_fieldHTML = '<div class="row"><div class="status-checkbox"><input class="form-check-input" type="checkbox" name="pty['+x2+'][pstatus]" value="1"></div><div class="col-xs-3 col-sm-3 col-md-3"><div class="form-group"><input name="pty['+x2+'][name]" type="text" placeholder="Name" class="form-control"/></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input name="pty['+x2+'][brand]" type="text" placeholder="Brand" class="form-control"/></div></div><div class="col-xs-1 col-sm-1 col-md-1"><div class="form-group"><input name="pty['+x2+'][wattage]" type="text" placeholder="wattage" class="form-control"/></div></div><div class="col-xs-1 col-sm-1 col-md-1"><div class="form-group"><input name="pty['+x2+'][price]" type="text" placeholder="Cost" class="form-control"/></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input autocomplete="off" name="pty['+x2+'][swarranty]" type="text" placeholder="Warranty" class="form-control" /></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input autocomplete="off" name="pty['+x2+'][effektfaktor]" type="text" placeholder="Effektfaktor" class="form-control"/></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input autocomplete="off" name="pty['+x2+'][short_circuit]" type="text" placeholder="Kortslutningsström" class="form-control" /></div></div><div class="col-xs-3 col-sm-3 col-md-3"><div class="form-group"><input autocomplete="off" name="pty['+x2+'][effectWarranty]" type="text" placeholder="Effect Warranty" class="form-control" /></div></div><div class="col-xs-3 col-sm-3 col-md-3"><div class="form-group"><input autocomplete="off" name="pty['+x2+'][warranty_percentage]" type="text" placeholder="Effect warranty after 25 years" class="form-control" /></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input autocomplete="off" name="pty['+x2+'][pcolor]" type="text" class="form-control" placeholder="Color" /></div></div><div class="col-xs-3 col-sm-3 col-md-3"><div class="form-group"><input type="file" name="pty['+x2+'][panel_img]" id="drop_panel'+x2+'" class="dropify dropify-panel" data-max-file-size="1M" data-height="150" /></div></div><div class="col-xs-1 col-sm-7 col-md-1"><a href="javascript:void(0);" class="list_remove_button btn btn-danger">-</a></div></div></div> '; //New input field html 
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
	        var list_fieldHTML = '<div class="row"><div class="status-checkbox"><input class="form-check-input" type="checkbox" name="invt['+x3+'][invstatus]" value="1"></div><div class="col-xs-4 col-sm-4 col-md-4"><div class="form-group"><input name="invt['+x3+'][name]" type="text" placeholder="Name" class="form-control"/></div></div><div class="col-xs-3 col-sm-3 col-md-3"><div class="form-group"><input name="invt['+x3+'][inveffect]" type="text" placeholder="Effect" class="form-control" /></div></div><div class="col-xs-3 col-sm-3 col-md-3"><div class="form-group"><input name="invt['+x3+'][invbrand]" type="text" placeholder="Brand" class="form-control" /></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input name="invt['+x3+'][price]" type="text" placeholder="Cost" class="form-control"/></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input autocomplete="off" name="invt['+x3+'][invwarranty]" type="text" placeholder="Warranty" class="form-control" /></div></div><div class="col-xs-3 col-sm-3 col-md-3"><div class="form-group"><input type="file" name="invt['+x3+'][inverter_img]" id="drop_inverter'+x3+'" class="dropify dropify-inverter" data-max-file-size="1M" data-height="150" /></div></div><div class="col-xs-3 col-sm-3 col-md-3"><div class="form-group"><div class="checkbox checkbox-success"><input id="checkbox'+x3+'" type="checkbox" name="invt['+x3+'][compatible]" value="1"><label for="checkbox'+x3+'">Battery Compatible</label></div></div></div><div class="col-xs-3 col-sm-3 col-md-3"><div class="form-group"><div class="checkbox checkbox-success"><input id="dongle'+x3+'" type="checkbox" name="invt['+x3+'][dongle]" value="1"><label for="checkbox'+x3+'">Dongle</label></div></div></div><div class="col-xs-3 col-sm-3 col-md-3"><select class="form-control" id="model'+x3+'" name="invt['+x3+'][dongle_model]" <?=$readonly_field?>><option value="">Select Dongle type</option><?php $dongleTypePriceArr = json_decode($wifi_dongle, true);foreach ($dongleTypePriceArr as $dkey => $dvalue) { if($dvalue["dongle_status"]==1){ echo '<option value="'.$dvalue["dongle_model"].'">'.$dvalue["dongle_brand"].'&nbsp'.$dvalue["dongle_model"].'</option>';} }?></select></div> <div class="col-xs-1 col-sm-7 col-md-1"><a href="javascript:void(0);" class="list_remove_button btn btn-danger">-</a></div></div>'; //New input field html 
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
	        var list_fieldHTML = '<div class="row"><div class="status-checkbox"><input class="form-check-input" type="checkbox" name="btrcs['+x5+'][bstatus]" value="1"></div><div class="col-xs-4 col-sm-4 col-md-4"><div class="form-group"><input name="btrcs['+x5+'][name]" type="text" placeholder="Name" class="form-control"/></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input autocomplete="off" name="btrcs['+x5+'][btsize]" type="text" placeholder="Size" class="form-control" /></div></div> <div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input name="btrcs['+x5+'][price]" type="text" placeholder="Cost" class="form-control"/></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input autocomplete="off" name="btrcs['+x5+'][bwarranty]" type="text" placeholder="Warranty" class="form-control"  /></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input autocomplete="off" name="btrcs['+x5+'][bdiscount]" type="text" placeholder="Discount" class="form-control" /></div></div><div class="col-xs-3 col-sm-3 col-md-3"><div class="form-group"><input type="file" name="btrcs['+x5+'][battery_img]" id="drop_battery'+x5+'" class="dropify dropify-battery" data-max-file-size="1M" data-height="150" /><input type="hidden" name="btrcs['+x5+'][battery_img]" class="form-control"/></div></div><div class="col-xs-1 col-sm-7 col-md-1"><a href="javascript:void(0);" class="list_remove_button btn btn-danger">-</a></div></div>'; //New input field html 
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
		
		 // sec extra sensor
	var x7 = "<?=$sensor_cnt-1?>"; //Initial field counter	
	$('.list_add_button7').click(function()
	    {
			
	    //Check maximum number of input fields
	    if(x7 < list_maxField){ 
	        x7++; //Increment field counter
	        var list_fieldHTML = '<div class="row"><div class="status-checkbox1" style="float:left"><input class="form-check-input" type="checkbox" name="sensor['+x7+'][sensor_status]" value="1"></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input name="sensor['+x7+'][sensor_name]" type="text" placeholder="Name" class="form-control"/></div></div><div class="form-group col-xs-2 col-sm-2 col-md-2"><input name="sensor['+x7+'][sensor_cost]" type="text" placeholder="Cost" class="form-control" /></div><div class="form-group col-xs-2 col-sm-2 col-md-2"><input name="sensor['+x7+'][sensor_warranty]" type="text" placeholder="Warranty" class="form-control" /></div><div class="col-xs-1 col-sm-7 col-md-1"><a href="javascript:void(0);" class="list_remove_button btn btn-danger">-</a></div></div>'; //New input field html 
	        $('.list_wrapper_sensor').append(list_fieldHTML); //Add field html
	    }
        });

		// sec extra odrift
	var x8 = "<?=$odrift_cnt-1?>"; //Initial field counter	
	$('.list_add_button8').click(function()
	    {
			
	    //Check maximum number of input fields
	    if(x8 < list_maxField){ 
	        x8++; //Increment field counter
	        var list_fieldHTML = '<div class="row"><div class="status-checkbox1" style="float:left"><input class="form-check-input" type="checkbox" name="odrift['+x8+'][odrift_status]" value="1"></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input name="odrift['+x8+'][odrift_name]" type="text" placeholder="Name" class="form-control"/></div></div><div class="form-group col-xs-2 col-sm-2 col-md-2"><input name="odrift['+x8+'][odrift_cost]" type="text" placeholder="Cost" class="form-control" /></div><div class="form-group col-xs-2 col-sm-2 col-md-2"><input name="odrift['+x8+'][odrift_warranty]" type="text" placeholder="Warranty" class="form-control" /></div><div class="col-xs-1 col-sm-7 col-md-1"><a href="javascript:void(0);" class="list_remove_button btn btn-danger">-</a></div></div>'; //New input field html 
	        $('.list_wrapper_odrift').append(list_fieldHTML); //Add field html
	    }
        });
		
		// sec extra optimizer
	var x9 = "<?=$optimizer_obj_cnt-1?>"; //Initial field counter	
	$('.list_add_button9').click(function()
	    {
			
	    //Check maximum number of input fields
	    if(x9 < list_maxField){ 
	        x9++; //Increment field counter
	        var list_fieldHTML = '<div class="row"><div class="status-checkbox1" style="float:left"><input class="form-check-input" type="checkbox" name="optimizer['+x9+'][optimizer_status]" value="1"></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input name="optimizer['+x9+'][optimizer_name]" type="text" placeholder="Name" class="form-control"/></div></div><div class="form-group col-xs-2 col-sm-2 col-md-2"><input name="optimizer['+x9+'][optimizer_cost]" type="text" placeholder="Cost" class="form-control" /></div><div class="form-group col-xs-2 col-sm-2 col-md-2"><input name="optimizer['+x9+'][optimizer_warranty]" type="text" placeholder="Warranty" class="form-control" /></div><div class="col-xs-1 col-sm-7 col-md-1"><a href="javascript:void(0);" class="list_remove_button btn btn-danger">-</a></div></div>'; //New input field html 
	        $('.list_wrapper_optimizer').append(list_fieldHTML); //Add field html
	    }
        });
	//ac protection
	var x10 = "<?=$ac_cnt-1?>"; //Initial field counter	
	$('.list_add_button10').click(function()
	{
			
	    //Check maximum number of input fields
	    if(x10 < list_maxField){ 
	        x10++; //Increment field counter
	        var list_fieldHTML = '<div class="row"><div class="status-checkbox1" style="float:left"><input class="form-check-input" type="checkbox" name="ac_protect['+x10+'][status]" value="1"></div><div class="form-group col-xs-2 col-sm-2 col-md-2">Brand<input name="ac_protect['+x10+'][brand]" type="text" placeholder="Name" class="form-control"/></div><div class="form-group col-xs-2 col-sm-2 col-md-2">Price<input name="ac_protect['+x10+'][price]" type="text" placeholder="Cost" class="form-control"/></div><div class="col-xs-1 col-sm-7 col-md-1"><a href="javascript:void(0);" class="list_remove_button btn btn-danger">-</a></div></div>'; //New input field html 
	        $('.list_wrapper_ac').append(list_fieldHTML); //Add field html
	    }
    });
	var x11 = "<?=$dc_cnt-1?>"; //Initial field counter	
	$('.list_add_button11').click(function()
	{
			
	    //Check maximum number of input fields
	    if(x11 < list_maxField){ 
	        x11++; //Increment field counter
	        var list_fieldHTML = '<div class="row"><div class="status-checkbox1" style="float:left"><input class="form-check-input" type="checkbox" name="dc_protect['+x11+'][status]" value="1"></div><div class="form-group col-xs-2 col-sm-2 col-md-2">Brand<input name="dc_protect['+x11+'][brand]" type="text" placeholder="Name" class="form-control"/></div><div class="form-group col-xs-2 col-sm-2 col-md-2">Price<input name="dc_protect['+x11+'][price]" type="text" placeholder="Cost" class="form-control"/></div><div class="col-xs-1 col-sm-7 col-md-1"><a href="javascript:void(0);" class="list_remove_button btn btn-danger">-</a></div></div>'; //New input field html 
	        $('.list_wrapper_dc').append(list_fieldHTML); //Add field html
	    }
    });
		var x12 = "<?=$obj_wifi_cnt-1?>"; //Initial field counter	
	$('.list_add_button12').click(function(){
			
	    //Check maximum number of input fields
	    if(x12 < list_maxField){ 
	        x12++; //Increment field counter
	        var list_fieldHTML = '<div class="row"><div class="status-checkbox1" style="float:left"><input class="form-check-input" type="checkbox" name="wifi_dongle['+x12+'][dongle_status]" value="1"></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input name="wifi_dongle['+x12+'][dongle_brand]" type="text" placeholder="Brand Name" class="form-control"/></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input name="wifi_dongle['+x12+'][dongle_model]" type="text" placeholder="Model Name" class="form-control"/></div></div><div class="form-group col-xs-2 col-sm-2 col-md-2"><input name="wifi_dongle['+x12+'][dongle_cost]" type="text" placeholder="Cost" class="form-control" /></div><div class="form-group col-xs-2 col-sm-2 col-md-2"><input name="wifi_dongle['+x12+'][dongle_warranty]" type="text" placeholder="Warranty" class="form-control" /></div><div class="col-xs-1 col-sm-7 col-md-1"><a href="javascript:void(0);" class="list_remove_button btn btn-danger">-</a></div></div>'; //New input field html 
	        $('.list_wrapper_wifiDongle').append(list_fieldHTML); //Add field html
	    }
        });
});
function revrcrd(rid){
	$("#"+rid).remove();
}


$('.dropify').parent().find(".dropify-clear").trigger('click');

</script>
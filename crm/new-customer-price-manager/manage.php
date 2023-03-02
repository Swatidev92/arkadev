<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 

if($cms->is_post_back()){ 
		// echo "<pre>";
		// print_r($_POST);
		//$_SESSION["ses_adm_id"]
		// die;
	//
	if($_GET['val']==1){
		//echo "<pre>";
		// print_r($_POST);die;
		//panel
		
		
		

		

		if($_POST['pty']){
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
			$ptyData= $_POST['pty'];
			foreach($ptyData as  $valpty){
				// print_r($valpty);
				$pty['m_id'] = "1";
				$pty['sub_id'] = "11";
				$pty['field_const'] = "panel_types";
				$ptyId = $valpty['id'];
				$content = [array( "pstatus"=>$valpty['pstatus'] , "name"=>$valpty['name'], "brand"=>$valpty['brand'], "wattage"=>$valpty['wattage'], "price"=>$valpty['price'] ,"width"=>$valpty['width'] ,"swarranty"=>$valpty['swarranty'], "effektfaktor"=>$valpty["effektfaktor"], "short_circuit"=>$valpty['short_circuit'], "effectWarranty"=>$valpty['effectWarranty'], "warranty_percentage"=>$valpty['warranty_percentage'], "pcolor"=>$valpty['pcolor'], "panel_img"=>$valpty['panel_img'])];
				$pty['content'] = json_encode($content);
				$pty['status'] = $valpty['pstatus'];
				$pty['code'] = $valpty['code'];
				$pty['last_updated_by'] = $_SESSION["ses_adm_id"];
				if(empty($ptyId))
				{
					$cms->sqlquery("rs","customer_price_manager",$pty); 
				}else{
				// print_r($pty);die;
				$cms->sqlquery("rs","customer_price_manager",$pty,'id',$ptyId); }
			}
		}
		//inverter
		if($_POST['invt']){
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
			$invtData= $_POST['invt'];
			foreach($invtData as  $valinvt){
				// print_r($valinvt);
				$invt['m_id'] = "1";
				$invt['sub_id'] = "12";
				$invt['field_const'] = "inverter_types";
				$invtId = $valinvt['id'];
				$content = [array( "invstatus"=>$valinvt['invstatus'] , "name"=>$valinvt['name'], "inveffect"=>$valinvt['inveffect'], "invbrand"=>$valinvt['invbrand'], "price"=>$valinvt['price'] ,"invwarranty"=>$valinvt['invwarranty'], "inverter_img"=>$valinvt["inverter_img"],"compatible"=>$valinvt["compatible"], "dongle_model"=>$valinvt['dongle_model'])];
				$invt['content'] = json_encode($content);
				$invt['status'] = $valinvt['invstatus'];
				$invt['code'] = $valinvt['code'];
				$invt['last_updated_by'] = $_SESSION["ses_adm_id"];
				if(empty($invtId))
				{
					$cms->sqlquery("rs","customer_price_manager",$invt); 
				}else{
				$cms->sqlquery("rs","customer_price_manager",$invt,'id',$invtId); }
			}
		}
		//battery
		if($_POST['btrcs']){
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
			$btrcsData= $_POST['btrcs'];
			foreach($btrcsData as  $valbtrcs){
				// print_r($valbtrcs);
				$btrcs['m_id'] = "1";
				$btrcs['sub_id'] = "13";
				$btrcs['field_const'] = "battery_types";
				$btrcsId = $valbtrcs['id'];
				$content = [array( "bstatus"=>$valbtrcs['bstatus'] , "name"=>$valbtrcs['name'], "btsize"=>$valbtrcs['btsize'], "price"=>$valbtrcs['price'] ,"bwarranty"=>$valbtrcs['bwarranty'], "bdiscount"=>$valbtrcs["bdiscount"], "battery_img"=>$valbtrcs['battery_img'])];
				$btrcs['content'] = json_encode($content);
				$btrcs['status'] = $valbtrcs['bstatus'];
				$btrcs['code'] = $valbtrcs['code'];
				$btrcs['last_updated_by'] = $_SESSION["ses_adm_id"];
				if(empty($btrcsId))
				{
					$cms->sqlquery("rs","customer_price_manager",$btrcs); 
				}else{
				// print_r($btrcs);die;
				$cms->sqlquery("rs","customer_price_manager",$btrcs,'id',$btrcsId); }
			}
		}
		//ev
		if($_POST['evc']){
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
			$evcData= $_POST['evc'];
			foreach($evcData as  $valevc){
				// print_r($valevc);
				$evc['m_id'] = "1";
				$evc['sub_id'] = "14";
				$evc['field_const'] = "ev_charger_types";
				$evcId = $valevc['id'];
				$content = [array( "evstatus"=>$valevc['evstatus'] , "name"=>$valevc['name'], "price"=>$valevc['price'] ,"cwarranty"=>$valevc['cwarranty'], "cdiscount"=>$valevc["cdiscount"], "loadbalancercost"=>$valevc['loadbalancercost'], "lbwarranty"=>$valevc["lbwarranty"], "charger_img"=>$valevc['charger_img'])];
				$evc['content'] = json_encode($content);
				$evc['status'] = $valevc['evstatus'];
				$evc['code'] = $valevc['code'];
				$evc['last_updated_by'] = $_SESSION["ses_adm_id"];
				if(empty($evcId))
				{
					$cms->sqlquery("rs","customer_price_manager",$evc); 
				}else{
				$cms->sqlquery("rs","customer_price_manager",$evc,'id',$evcId); }
			}
		}
		//roof
		if($_POST['roof']){
			$roofData= $_POST['roof'];
			//print_r($roofData);die;
			foreach($roofData as  $valroof){
				// print_r($valevc);
				$roof['m_id'] = "1";
				$roof['sub_id'] = "15";
				$roof['field_const'] = "roof_type";
				$roofId = $valroof['id'];
				$content = [array( "rfstatus"=>$valroof['rfstatus'] , "name"=>$valroof['name'])];
				$roof['content'] = json_encode($content);
				$roof['status'] = $valroof['rfstatus'];
				$roof['last_updated_by'] = $_SESSION["ses_adm_id"];
				if(empty($roofId))
				{
					$cms->sqlquery("rs","customer_price_manager",$roof); 
				}else{
				$cms->sqlquery("rs","customer_price_manager",$roof,'id',$roofId); }
			}
		}
		
		$adm->sessset('Record has been updated '.$msg, 's');
		$cms->redir(SITE_PATH_ADM.CPAGE.'/?val='.$_GET['val'], true);

	}
	//Extras
	if($_GET['val']==2){
		// echo "<pre>";
		// print_r($_POST);die;
		//sensor
		if($_POST['sensor']){
			$sensorData= $_POST['sensor'];
			// echo "<pre>";
			// print_r($sensorData);die;
			foreach($sensorData as  $valSensor){
				// print_r($valsensor);
				$sensor['m_id'] = "2";
				$sensor['sub_id'] = "21";
				$sensor['field_const'] = "sensor_type";
				$sensorId = $valSensor['id'];
				$content = [array( "sensor_status"=>$valSensor['sensor_status'] , "sensor_name"=>$valSensor['sensor_name'], "sensor_cost"=>$valSensor['sensor_cost'], "sensor_warranty"=>$valSensor['sensor_warranty'])];
				$sensor['content'] = json_encode($content);
				$sensor['status'] = $valSensor['sensor_status'];
				$sensor['code'] = $valSensor['code'];
				$sensor['last_updated_by'] = $_SESSION["ses_adm_id"];
				if(empty($sensorId))
				{
					$cms->sqlquery("rs","customer_price_manager",$sensor); 
					
					// print_r($sensor);die;
				}else{
				$cms->sqlquery("rs","customer_price_manager",$sensor,'id',$sensorId); }
			}
		}
		//odrift
		if($_POST['odrift']){
			$odriftData= $_POST['odrift'];
			foreach($odriftData as  $valOdrift){
				// print_r($valodrift);
				$odrift['m_id'] = "2";
				$odrift['sub_id'] = "22";
				$odrift['field_const'] = "odrift_type";
				$odriftId = $valOdrift['id'];
				$content = [array( "odrift_status"=>$valOdrift['odrift_status'] , "odrift_name"=>$valOdrift['odrift_name'], "odrift_cost"=>$valOdrift['odrift_cost'], "odrift_warranty"=>$valOdrift['odrift_warranty'])];
				$odrift['content'] = json_encode($content);
				$odrift['status'] = $valOdrift['odrift_status'];
				$odrift['code'] = $valOdrift['code'];
				$odrift['last_updated_by'] = $_SESSION["ses_adm_id"];
				// print_r($odrift);die;
				if(empty($odriftId))
				{ 
					$cms->sqlquery("rs","customer_price_manager",$odrift); 

				}else{
					$cms->sqlquery("rs","customer_price_manager",$odrift,'id',$odriftId); }
			}
		}
		//optimizer
		if($_POST['optimizer']){
			$optimizerData= $_POST['optimizer'];
			foreach($optimizerData as  $valoptimizer){
				// print_r($valoptimizer);
				$optimizer['m_id'] = "2";
				$optimizer['sub_id'] = "23";
				$optimizer['field_const'] = "optimizer_type";
				$optimizerId = $valoptimizer['id'];
				$content = [array( "optimizer_status"=>$valoptimizer['optimizer_status'] , "optimizer_name"=>$valoptimizer['optimizer_name'], "optimizer_cost"=>$valoptimizer['optimizer_cost'], "optimizer_warranty"=>$valoptimizer['optimizer_warranty'])];
				$optimizer['content'] = json_encode($content);
				$optimizer['status'] = $valoptimizer['optimizer_status'];
				$optimizer['code'] = $valoptimizer['code'];
				$optimizer['last_updated_by'] = $_SESSION["ses_adm_id"];
				if(empty($optimizerId))
				{ 
					$cms->sqlquery("rs","customer_price_manager",$optimizer); 

				}else{
				// print_r($optimizer);die;
					$cms->sqlquery("rs","customer_price_manager",$optimizer,'id',$optimizerId); 
				}
			}
		}
		//ac_protect
		if($_POST['ac_protect']){
			$ac_protectData= $_POST['ac_protect'];
			foreach($ac_protectData as  $valac_protect){
				// print_r($valac_protect);
				$ac_protectId = $valac_protect['id'];
				$content = [array( "status"=>$valac_protect['status'] , "brand"=>$valac_protect['brand'], "price"=>$valac_protect['price'])];
				$ac_protect['content'] = json_encode($content);
				$ac_protect['status'] = $valac_protect['status'];
				// print_r($ac_protect);die;
				$cms->sqlquery("rs","customer_price_manager",$ac_protect,'id',$ac_protectId);
			}
		}
		//dc_protect
		if($_POST['dc_protect']){
			$dc_protectData= $_POST['dc_protect'];
			foreach($dc_protectData as  $valdc_protect){
				// print_r($valac_protect);
				$dc_protectId = $valdc_protect['id'];
				$content = [array( "status"=>$valdc_protect['status'] , "brand"=>$valdc_protect['brand'], "price"=>$valdc_protect['price'])];
				$dc_protect['content'] = json_encode($content);
				$dc_protect['status'] = $valdc_protect['status'];
				// print_r($ac_protect);die;
				$cms->sqlquery("rs","customer_price_manager",$dc_protect,'id',$dc_protectId);
			}
		}
		//cables_inv
		if($_POST['cables_inv']){
			$cables_invData= $_POST['cables_inv'];
			foreach($cables_invData as  $valcables_inv){
				// print_r($valac_protect);
				$cables_invId = $valcables_inv['id'];
				$content = [array( "inv"=>$valcables_inv['inv'])];
				$cables_inv['content'] = json_encode($content);
				$cables_inv['status'] = "0";
				// print_r($ac_protect);die;
				$cms->sqlquery("rs","customer_price_manager",$cables_inv,'id',$cables_invId);
			}
		}
		//cables_ev
		if($_POST['cables_ev']){
			$cables_evData= $_POST['cables_ev'];
			foreach($cables_evData as  $valcables_ev){
				// print_r($valac_protect);
				$cables_evId = $valcables_ev['id'];
				$content = [array( "ev"=>$valcables_ev['ev'])];
				$cables_ev['content'] = json_encode($content);
				$cables_ev['status'] = "0";
				// print_r($ac_protect);die;
				$cms->sqlquery("rs","customer_price_manager",$cables_ev,'id',$cables_evId);
			
			}
		}
		//wifi_dongle
		if($_POST['wifi_dongle']){
			$wifi_dongleData= $_POST['wifi_dongle'];
			//print_r($wifi_dongleData);die;
			foreach($wifi_dongleData as  $valwifi_dongle){
				// print_r($valwifi_dongle);
				$wifi_dongle['m_id'] = "2";
				$wifi_dongle['sub_id'] = "27";
				$wifi_dongle['field_const'] = "wifi_dongle";
				$wifi_dongleId = $valwifi_dongle['id'];
				$content = [array( "dongle_status"=>$valwifi_dongle['dongle_status'] , "dongle_brand"=>$valwifi_dongle['dongle_brand'], "dongle_model"=>$valwifi_dongle['dongle_model'], "dongle_cost"=>$valwifi_dongle["dongle_cost"],"dongle_warranty"=>$valwifi_dongle['dongle_warranty'])];
				$wifi_dongle['content'] = json_encode($content);
				$wifi_dongle['status'] = $valwifi_dongle['dongle_status'];
				$wifi_dongle['code'] = $valwifi_dongle['code'];
				$wifi_dongle['last_updated_by'] = $_SESSION["ses_adm_id"];
				if(empty($wifi_dongleId))
				{ 
					$cms->sqlquery("rs","customer_price_manager",$wifi_dongle);

				}else{

					$cms->sqlquery("rs","customer_price_manager",$wifi_dongle,'id',$wifi_dongleId);
				}
				// print_r($wifi_dongle);
				// die;
			}
		}

		$adm->sessset('Record has been updated '.$msg, 's');
		$cms->redir(SITE_PATH_ADM.CPAGE.'/?val='.$_GET['val'], true);


	}
	//MMS
	if($_GET['val']==3){
		//S:vander valk update
		if($_POST['mmsVV']){
			// echo "<pre>";
			if($_FILES['mmsVV']['name']){
				$countImage =  count($_FILES['mmsVV']['name']);
				if($countImage>0){
					for($i=0;$i<$countImage;$i++){
						if(!empty($_FILES['mmsVV']['name'][$i]['img'])){
							$filename = rand(1000,100000)."-".$_FILES['mmsVV']['name'][$i]['img']; 
							$file_loc = $_FILES['mmsVV']['tmp_name'][$i]['img'];
							$file_size = ($_FILES['mmsVV']['tmp_name'][$i]['size']/1024);
							$file_type = $_FILES['mmsVV']['tmp_name'][$i]['type'];
							$folder = FILES_PATH.UP_FILES_PROPOSAL."/mms/vandervalk/";
							// make file name in lower case
							$supported_format = array('jpg','jpeg');
							$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
							$fileinfo = @getimagesize($_FILES['mmsVV']['tmp_name'][$i]['img']);
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
										$_POST['mmsVV'][$i]['img'] = $final_file;
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
			$vvData= $_POST['mmsVV'];
			foreach($vvData as  $valVV){
				// echo "<pre>";
				// print_r($valVV);
				$vvid = $valVV['id'];
				$content = [array( "code"=>$valVV['code'] , "name"=>$valVV['name'], "price"=>$valVV['price'], "length"=>$valVV['length'])];
				$vv['content'] = json_encode($content);
				$vv['status'] = $valVV['status'];
				$vv['image'] = $valVV['img'];
				$vv['last_updated_by'] = $_SESSION["ses_adm_id"];
				// print_r($vv);
				$cms->sqlquery("rs","customer_price_manager",$vv,'id',$vvid);
			}
			// die;
			
		}
		//S:kp update
		if($_POST['mmsKp']){
			//echo "<pre>";
			if($_FILES['mmsKp']['name']){
				$countImage =  count($_FILES['mmsKp']['name']);
				if($countImage>0){
					for($i=0;$i<$countImage;$i++){
						if(!empty($_FILES['mmsKp']['name'][$i]['img'])){
							$filename = rand(1000,100000)."-".$_FILES['mmsKp']['name'][$i]['img']; 
							$file_loc = $_FILES['mmsKp']['tmp_name'][$i]['img'];
							$file_size = ($_FILES['mmsKp']['tmp_name'][$i]['size']/1024);
							$file_type = $_FILES['mmsKp']['tmp_name'][$i]['type'];
							$folder = FILES_PATH.UP_FILES_PROPOSAL."/mms/kpsystem/";
							// make file name in lower case
							$supported_format = array('jpg','jpeg');
							$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
							$fileinfo = @getimagesize($_FILES['mmsKp']['tmp_name'][$i]['img']);
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
										$_POST['mmsKp'][$i]['img'] = $final_file;
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
			$kpData= $_POST['mmsKp'];
				
				// print_r($kpData);
				// die;
			foreach($kpData as  $valKP){
				// print_r($kpData);
				$kpid = $valKP['id'];
				$content = [array( "code"=>$valKP['code'] , "name"=>$valKP['name'], "price"=>$valKP['price'])];
				$kp['content'] = json_encode($content);
				$kp['status'] = $valKP['status'];
				$kp['image'] = $valKP['img'];
				$kp['last_updated_by'] = $_SESSION["ses_adm_id"];
					// print_r($kp);
				$cms->sqlquery("rs","customer_price_manager",$kp,'id',$kpid);
			}
			//die;
			// $adm->sessset('Record has been updated '.$msg, 's');
			// $cms->redir(SITE_PATH_ADM.CPAGE, true);
		}
		//S:warranty
		if($_POST['mmsWb']){
			$wbData= $_POST['mmsWb'];
				
				// print_r($kpData);
				// die;
			foreach($wbData as  $valwb){
				// print_r($kpData);
				$wbid = $valwb['id'];
				$content = [array( "mwarranty"=>$valwb['code'])];
				$wb['content'] = json_encode($content);
				$wb['status'] = '0';
				$kp['last_updated_by'] = $_SESSION["ses_adm_id"];
					// print_r($kp);
				$cms->sqlquery("rs","customer_price_manager",$wb,'id',$wbid);
			}
			
		}
		$adm->sessset('Record has been updated '.$msg, 's');
		$cms->redir(SITE_PATH_ADM.CPAGE.'/?val='.$_GET['val'], true);
	}
	//Shipment
	if($_GET['val']==4){
		if($_POST['shipcost']){
			// print_r($_POST['shipcost']);
			$shipment = $_POST['shipcost'];
			foreach($shipment as $valShip){
				$shipId = $valShip['id']; 
				$contentShip= [array("shipmentcost"=>$valShip['shipmentcost'])];
				$shipment['content'] = json_encode($contentShip);
				$shipment['status'] = "0";
				$cms->sqlquery("rs","customer_price_manager",$shipment,'id',$shipId);	
				
			}
		}
		$adm->sessset('Record has been updated '.$msg, 's');
		$cms->redir(SITE_PATH_ADM.CPAGE.'/?val='.$_GET['val'], true);
	}
	//Installation
	if($_GET['val']==5){
		
		if($_POST['intc']){
			$intcData= $_POST['intc'];
			foreach($intcData as  $valintc){
				//echo "<pre>";
				// print_r($valinvt);
				$intcId = $valintc['id'];
				$intc['m_id'] = "5";
				$intc['sub_id'] = "51";
				$intc['field_const'] = "installation_charges";
				$content = [array( "day"=>$valintc['day'] , "price"=>$valintc['price'], "work_year"=>$valintc['work_year'])];
				$intc['content'] = json_encode($content);
				$intc['status'] = "0";
				$intc['last_updated_by'] = $_SESSION["ses_adm_id"];
				//$intc['updated_date'] =date("Y-m-d h:i:s");
				// print_r($intc);
				if(empty($intcId))
				{ 
					$cms->sqlquery("rs","customer_price_manager",$intc); 
					
				} 
				else{
				   	$cms->sqlquery("rs","customer_price_manager",$intc,'id',$intcId);
				}
			}
			//die;
		}
		$adm->sessset('Record has been updated '.$msg, 's');
		$cms->redir(SITE_PATH_ADM.CPAGE.'/?val='.$_GET['val'], true);
	}
	//Margin
	if($_GET['val']==6){
		echo "<pre>";
		// solar margin
		if($_POST['smrg']){
			$smrgData = $_POST['smrg'];
			// print_r($grs);die;
			foreach($smrgData as $valsmrg)
			{
				$smrgId = $valsmrg['id']; 
				$contentsmrg= [array("status"=>$valsmrg['status'],"min"=>$valsmrg['min'],"max"=>$valsmrg['max'])];
				$smrg['content'] = json_encode($contentsmrg);
				$smrg['status'] = $valsmrg['status'];
				// print_r($smrg);die;
				$cms->sqlquery("rs","customer_price_manager",$smrg,'id',$smrgId);	
				
			}
		}
		//ev margin
		if($_POST['evmrg']){
			$evmrgData = $_POST['evmrg'];
			// print_r($grs);die;
			foreach($evmrgData as $valevmrg)
			{
				$evmrgId = $valevmrg['id']; 
				$contentevmrg= [array("status"=>$valevmrg['status'],"min"=>$valevmrg['min'],"max"=>$valevmrg['max'])];
				$evmrg['content'] = json_encode($contentevmrg);
				$evmrg['status'] = $valevmrg['status'];
				// print_r($evmrg);die;
				$cms->sqlquery("rs","customer_price_manager",$evmrg,'id',$evmrgId);	
				
			}
		}
		//battery margin
		if($_POST['btmrg']){
			$btmrgData = $_POST['btmrg'];
			// print_r($grs);die;
			foreach($btmrgData as $valbtmrg)
			{
				$btmrgId = $valbtmrg['id']; 
				$contentbtmrg= [array("status"=>$valbtmrg['status'],"min"=>$valbtmrg['min'],"max"=>$valbtmrg['max'])];
				$btmrg['content'] = json_encode($contentbtmrg);
				$btmrg['status'] = $valbtmrg['status'];
				// print_r($btmrg);die;
				$cms->sqlquery("rs","customer_price_manager",$btmrg,'id',$btmrgId);	
				
			}
		}
		//min margin
		if($_POST['minmrg']){
			$minmrgData = $_POST['minmrg'];
			// print_r($grs);die;
			foreach($minmrgData as $valminmrg)
			{
				$minmrgId = $valminmrg['id']; 
				$contentminmrg= [array("status"=>$valminmrg['status'],"margin"=>$valminmrg['margin'])];
				$minmrg['content'] = json_encode($contentminmrg);
				$minmrg['status'] = $valminmrg['status'];
				// print_r($minmrg);die;
				$cms->sqlquery("rs","customer_price_manager",$minmrg,'id',$minmrgId);	
				
			}
		}
		$adm->sessset('Record has been updated '.$msg, 's');
		$cms->redir(SITE_PATH_ADM.CPAGE.'/?val='.$_GET['val'], true);
	}
	//Other
	if($_GET['val']==7){
		//green_rebate
		if($_POST['grs']){
			$grs = $_POST['grs'];
			// print_r($grs);die;
			foreach($grs as $valGrs)
			{
				$grsId = $valGrs['id']; 
				$contentGrs= [array("rebate"=>$valGrs['rebate'])];
				$grs['content'] = json_encode($contentGrs);
				$grs['status'] = "0";
				// print_r($pay);die;
				$cms->sqlquery("rs","customer_price_manager",$grs,'id',$grsId);	
				
			}
		}
		if($_POST['grev']){
			$grev = $_POST['grev'];
			// print_r($grs);die;
			foreach($grev as $valGrev)
			{
				$grevId = $valGrev['id']; 
				$contentGrev= [array("rebate"=>$valGrev['rebate'])];
				$grev['content'] = json_encode($contentGrev);
				$grev['status'] = "0";
				// print_r($pay);die;
				$cms->sqlquery("rs","customer_price_manager",$grev,'id',$grevId);	
				
			}
		}
		if($_POST['grb']){
			$grb = $_POST['grb'];
			//print_r($grb);die;
			foreach($grb as $valGrb)
			{
				$grbId = $valGrb['id']; 
				$contentGrb= [array("rebate"=>$valGrb['rebate'])];
				$grb['content'] = json_encode($contentGrb);
				$grb['status'] = "0";
				// print_r($pay);die;
				$cms->sqlquery("rs","customer_price_manager",$grb,'id',$grbId);	
				
			}
		}

		//Pay At Ordering
		if($_POST['orderpercentage']){
			
			$payAt = $_POST['orderpercentage'];
			foreach($payAt as $valPay)
			{
				$payId = $valPay['id']; 
				$contentPay= [array("orderPayment"=>$valPay['orderPayment'])];
				$pay['content'] = json_encode($contentPay);
				$pay['status'] = "0";
				// print_r($pay);die;
				$cms->sqlquery("rs","customer_price_manager",$pay,'id',$payId);	
				
			}
		}

		//production
		if($_POST['production']){
			$prodData= $_POST['production'];
			// print_r($prod);die;
			foreach($prodData as $valProd)
			{
				$prodId = $valProd['id']; 
				$contentProd= [array("prod_inflation"=>$valProd['prod_inflation'],"prod_price_increase"=>$valProd['prod_price_increase'],"prod_deterioration"=>$valProd['prod_deterioration'],""=>$valProd['prod_deterioration'],"prod_power_loss"=>$valProd['prod_power_loss'])];
				$prod['content'] = json_encode($contentProd);
				$prod['status'] = "0";
				// print_r($pay);die;
				$cms->sqlquery("rs","customer_price_manager",$prod,'id',$prodId);	
				
			}
		}

		//Proposal Types //left
		if($_POST['propType']){
			echo "<pre>";
			// $proType= $_POST['propType'];
			$proTypeId = $_POST['propType']['id'];
			$proTypeVal = $_POST['propType'];
			$proTypeVal1['content'] = json_encode(array_slice($proTypeVal,'1'));
			// print_r($proTypeVal1['content']);
			//print_r($proTypeId);
			$val = $cms->sqlquery("rs","customer_price_manager",$proTypeVal1,'id',$proTypeId);
			//die;
		}

		//vat
		if($_POST['vatArr']){
			$vatData= $_POST['vatArr'];
			// print_r($vat);die;
			foreach($vatData as $valVat)
			{
				$vatId = $valVat['id']; 
				$contentVat= [array("vat"=>$valVat['vat'])];
				$vat['content'] = json_encode($contentVat);
				$vat['status'] = "0";
				// echo $vatId;
				// print_r($vat);die;
				$cms->sqlquery("rs","customer_price_manager",$vat,'id',$vatId);	
				
			}
		}

		$adm->sessset('Record has been updated '.$msg, 's');
		$cms->redir(SITE_PATH_ADM.CPAGE.'/?val='.$_GET['val'], true);
	}
}
// $rsAdmin=$cms->db_query("select * from #_customer_price where id='1'");
// $arrAdmin=$cms->db_fetch_array($rsAdmin);
//@extract($arrAdmin);

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

$wifi_dongleQry=$cms->db_query("select * from #_customer_price_manager where m_id='2' and sub_id='27' and is_deleted = '0' ");
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
			<div class="col-md-12">
				<button type="button" onclick="history.go(-1)" class="btn btn-primary">Back</button>
				<div class="form-group col-sm-3 text-right pull-right">
					<button type="submit" class="btn btn-primary" id="submit_btn">Publish</button>
				</div>
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
						<li><a data-toggle="tab" href="#roof-type">Roof Type</a></li>
					</ul>

					<div class="tab-content">
						<!-- S:panel -->
						<div id="panel" class="tab-pane fade in active">
							
							<div class="list_wrapper list_wrapper2" style="font-size:12px;">  
								<?php
									$panel_typesQry=$cms->db_query("select * from #_customer_price_manager where m_id='1' and sub_id='11' and is_deleted = '0' ");
									$i=0;
									while($panel_typesAry = $panel_typesQry->fetch_array()){
									$obj = json_decode($panel_typesAry['content'],true);
									$pty_cnt = $panel_typesQry->num_rows;
									if(count($obj)>0){
										foreach($obj as $val){ ?>
											<div class="row" id="pmt<?=$i?>">
												<div class="status-checkbox">
												<input type="hidden" name="pty[<?=$i?>][id]" value="<?=$panel_typesAry['id']?>">

													<input class="form-check-input" type="checkbox" name="pty[<?=$i?>][pstatus]" value="1" <?=$val['pstatus']==1?'checked':''?>>
												</div>
												<div class="col-xs-3 col-sm-3 col-md-3">
													<div class="form-group">
														<b>Code</b>
														<input name="pty[<?=$i?>][code]" type="text" placeholder="Code" class="form-control" value="<?=$panel_typesAry['code']?>"/>
													</div>
												</div>
												<div class="col-xs-3 col-sm-3 col-md-3">
													<div class="form-group">
														<b>Name</b>
														<input name="pty[<?=$i?>][name]" type="text" placeholder="Name" class="form-control" value="<?=$val['name']?>"/>
													</div>
												</div>
												<div class="col-xs-2 col-sm-2 col-md-2">
													<div class="form-group">
														<b>Brand</b>
														<input name="pty[<?=$i?>][brand]" type="text" placeholder="Brand" class="form-control" value="<?=$val['brand']?>"/>
													</div>
												</div>
												<div class="col-xs-1 col-sm-1 col-md-1">
													<div class="form-group">
														<b>Wattage</b>
														<input autocomplete="off" name="pty[<?=$i?>][wattage]" type="text" placeholder="wattage" class="form-control" value="<?=$val['wattage']?>"/>
													</div>
												</div>
												<div class="col-xs-1 col-sm-1 col-md-1">
													<div class="form-group">
														<b>Cost</b>
														<input autocomplete="off" name="pty[<?=$i?>][price]" type="text" placeholder="Cost" class="form-control" value="<?=$val['price']?>"/>
													</div>
												</div>
												<div class="col-xs-1 col-sm-1 col-md-1">
													<div class="form-group">
														<b>Width</b>
														<input autocomplete="off" name="pty[<?=$i?>][width]" type="text" placeholder="Width" class="form-control" value="<?=$val['width']?>"/>
													</div>
												</div>
												<div class="col-xs-2 col-sm-2 col-md-2">
													<div class="form-group">
														<b>Warranty (years)</b>
														<input autocomplete="off" name="pty[<?=$i?>][swarranty]" type="text" placeholder="Warranty" class="form-control" value="<?=$val['swarranty']?>"/>
													</div>
												</div>
												<div class="col-xs-2 col-sm-2 col-md-2">
													<div class="form-group">
														<b>Effektfaktor</b>
														<input autocomplete="off" name="pty[<?=$i?>][effektfaktor]" type="text" placeholder="Effektfaktor" class="form-control" value="<?=$val['effektfaktor']?>"/>
													</div>
												</div>
												<div class="col-xs-2 col-sm-2 col-md-2">
													<div class="form-group">
														<b>Kortslutningsström</b>
														<input autocomplete="off" name="pty[<?=$i?>][short_circuit]" type="text" class="form-control" value="<?=$val['short_circuit']?>"/>
													</div>
												</div>
												<div class="col-xs-3 col-sm-3 col-md-3">
													<div class="form-group">
														<b>Effect Warranty (years)</b>
														<input autocomplete="off" name="pty[<?=$i?>][effectWarranty]" type="text" placeholder="Warranty" class="form-control" value="<?=$val['effectWarranty']?>"/>
													</div>
												</div>
												<div class="col-xs-3 col-sm-3 col-md-3">
													<div class="form-group">
														<b>Effect warranty after <?=$val['effectWarranty']?> years (%)</b>
														<input autocomplete="off" name="pty[<?=$i?>][warranty_percentage]" type="text" placeholder="Effect warranty after <?=$val['effectWarranty']?> years (%)" class="form-control" value="<?=$val['warranty_percentage']?>"/>
													</div>
												</div>
												<div class="col-xs-2 col-sm-2 col-md-2">
													<div class="form-group">
														<b>Color</b>
														<input autocomplete="off" name="pty[<?=$i?>][pcolor]" type="text" class="form-control" value="<?=$val['pcolor']?>"/>
													</div>
												</div>
												<div class="col-xs-3 col-sm-3 col-md-3">
													<div class="form-group">
														<b>Image max-width:</b> 270px and height: 131px and extension: jpg/jpeg
														<input type="file" name="pty[<?=$i?>][panel_img]" id="drop_panel<?=$i?>" class="dropify dropify-panel" data-max-file-size="1M" data-height="150" <?php if($val['panel_img'] AND file_exists(FILES_PATH.UP_FILES_PROPOSAL.'/solar-panel/'.$val['panel_img'])){ ?> data-default-file="<?=SITE_PATH.UPLOAD_FILES_PTH.'/'.UP_FILES_PROPOSAL?>/solar-panel/<?=$val['panel_img']?>" <?php } ?> />
														<input type="hidden" name="pty[<?=$i?>][panel_img]" class="form-control" value="<?=$val['panel_img']?>"/>
													</div>
												</div>
												<div class="col-xs-1 col-sm-1 col-md-1">
													<br>
													<button class="" onClick='remove_details("<?=$panel_typesAry['id']?>")' type="button"><i class="fa fa-close text-danger"></i></button>
												</div>
												<?php  ?>
											</div> 
											<hr>
										<?php } }	$i++; }?>  
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
								<?php
									$inverter_typesQry=$cms->db_query("select * from #_customer_price_manager where m_id='1' and sub_id='12' and is_deleted = '0' ");
									$i=0;
									while($inverter_typesAry = $inverter_typesQry->fetch_array()){ 
									$obj = json_decode($inverter_typesAry['content'],true);
									$invt_cnt = $inverter_typesQry->num_rows;
									if(count($obj)>0){											
										foreach($obj as $val){
								?>
									<div class="row" id="invm<?=$i?>">
										<div class="status-checkbox">
											<input type="hidden" name="invt[<?=$i?>][id]" value="<?=$inverter_typesAry['id']?>">	

											<input class="form-check-input" type="checkbox" name="invt[<?=$i?>][invstatus]" value="1" <?=$val['invstatus']==1?'checked':''?>>
										</div>
										<div class="col-xs-1 col-sm-1 col-md-1">
											<div class="form-group">
												<b>Code</b>
												<input name="invt[<?=$i?>][code]" type="text" placeholder="Code" class="form-control" value="<?=$val['code']?>"/>
											</div>
										</div>
										<div class="col-xs-4 col-sm-4 col-md-4">
											<div class="form-group">
												<b>Name</b>
												<input name="invt[<?=$i?>][name]" type="text" placeholder="Name" class="form-control" value="<?=$val['name']?>"/>
											</div>
										</div>
										<div class="col-xs-3 col-sm-3 col-md-3">
											<div class="form-group">
												<b>Effect(kW)</b>
												<input name="invt[<?=$i?>][inveffect]" type="text" placeholder="Effect" class="form-control" value="<?=$val['inveffect']?>"/>
											</div>
										</div>
										<div class="col-xs-3 col-sm-3 col-md-3">
											<div class="form-group">
												<b>Brand</b>
												<input name="invt[<?=$i?>][invbrand]" type="text" placeholder="Brand" class="form-control" value="<?=$val['invbrand']?>"/>
											</div>
										</div>
										<div class="col-xs-2 col-sm-2 col-md-2">
											<div class="form-group">
												<b>Cost</b>
												<input autocomplete="off" name="invt[<?=$i?>][price]" type="text" placeholder="Cost" class="form-control" value="<?=$val['price']?>"/>
											</div>
										</div> 
										<div class="col-xs-2 col-sm-2 col-md-2">
											<div class="form-group">
												<b>Warranty (years)</b>
												<input autocomplete="off" name="invt[<?=$i?>][invwarranty]" type="text" placeholder="Warranty" class="form-control" value="<?=$val['invwarranty']?>"/>
											</div>
										</div>
										<div class="col-xs-3 col-sm-3 col-md-3">
											<div class="form-group">
												<b>Image max-width:</b> 270px and height: 131px and extension: jpg/jpeg
												<input type="file" name="invt[<?=$i?>][inverter_img]" id="drop_inverter<?=$i?>" class="dropify dropify-inverter" data-max-file-size="1M" data-height="150" <?php if($val['inverter_img'] AND file_exists(FILES_PATH.UP_FILES_PROPOSAL.'/inverter/'.$val['inverter_img'])){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/<?=UP_FILES_PROPOSAL?>/inverter/<?=$val['inverter_img']?>" <?php } ?> />
												<input type="hidden" name="invt[<?=$i?>][inverter_img]" class="form-control" value="<?=$val['inverter_img']?>"/>
											</div>
										</div>
										<div class="col-xs-3 col-sm-3 col-md-3">
											<div class="form-group">
												<div class="checkbox checkbox-success">
													<input id="checkbox<?=$i?>" type="checkbox" name="invt[<?=$i?>][compatible]" value="1" <?=$val['compatible']==1?'checked':''?>>
													<label for="checkbox<?=$i?>">Battery Compatible</label>
												</div>
											</div>
										</div>
										<div class="col-xs-3 col-sm-3 col-md-3">
											<b>Wifi Dongle</b>
											<select class="form-control" id="model<?=$i?>" name="invt[<?=$i?>][dongle_model]" <?=$readonly_field?>>
											<!-- <option value="">Select Dongle type</option> -->
												<option value="dongle_include">Wifi Dongle Included</option>
													<?php 
														while($wifi_dongle= $wifi_dongleQry->fetch_array()){
														$dongleTypePriceArr = json_decode($wifi_dongle['content'], true);
														foreach ($dongleTypePriceArr as $dkey => $dvalue) {
															if($dvalue["dongle_status"]==1){
																if($val['dongle_model']==$dvalue["dongle_model"]){
																	$dsel = 'selected';
																}else{
																	$dsel = '';
																}
															echo '<option value="'.$dvalue["dongle_model"].'" '.$dsel.'>'.$dvalue["dongle_brand"].'&nbsp'.$dvalue["dongle_model"].'</option>';
															} 
														} }
													?>
											</select>
										</div>
											
										<div class="col-xs-1 col-sm-1 col-md-1">
											<br>
											<button class="" onClick='remove_details("<?=$inverter_typesAry['id']?>")' type="button"><i class="fa fa-close text-danger"></i></button>
										</div>
										<div class="clearfix"></div>
										<?php  ?>
									</div>
									<hr>
									<?php } } $i++; }?>  
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
								<?php
								$battery_typesQry=$cms->db_query("select * from #_customer_price_manager where m_id='1' and sub_id='13' and is_deleted = '0' ");
								$i=0;
								while($battery_typesAry = $battery_typesQry->fetch_array()){  
									$obj = json_decode($battery_typesAry['content']);
									$btrcs_cnt = $battery_typesQry->num_rows;
									if(count($obj)>0){
										foreach($obj as $val){ ?>
											<div class="row" id="btrow<?=$i?>">
												<div class="status-checkbox">
													<input type="hidden" name="btrcs[<?=$i?>][id]" value="<?=$battery_typesAry['id']?>">
													<input class="form-check-input" type="checkbox" name="btrcs[<?=$i?>][bstatus]" value="1" <?=$val->bstatus==1?'checked':''?>>
												</div>
												<div class="col-xs-4 col-sm-4 col-md-4">
													<div class="form-group">
														<b>Code</b>
														<input name="btrcs[<?=$i?>][code]" type="text" placeholder="code" class="form-control" value="<?=$battery_typesAry['code']?>"/>
													</div>
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
													<button class="" onClick='remove_details("<?=$battery_typesAry['id']?>")' type="button"><i class="fa fa-close text-danger"></i></button>
												</div>
												<div class="clearfix"></div>
											<?php  ?>
										</div> 
										<hr>
									<?php } } $i++; }?>  
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
							
							<div class="list_wrapper list_wrapper1" style="font-size:12px;">  
								<?php
									$ev_charger_typesQry=$cms->db_query("select * from #_customer_price_manager where m_id='1' and sub_id='14' and is_deleted = '0' ");
									$i=0;
									
									while($ev_charger_typesAry = $ev_charger_typesQry->fetch_array()){ 
									$obj = json_decode($ev_charger_typesAry['content']);
									$ec_cnt = $ev_charger_typesQry->num_rows;
										if(count($obj)>0){
											foreach($obj as $val){?>
											<div class="row" id="rev<?=$i?>">
												<div class="status-checkbox">
													<input type="hidden" name="evc[<?=$i?>][id]" value="<?=$ev_charger_typesAry['id']?>">

													<input class="form-check-input" type="checkbox" name="evc[<?=$i?>][evstatus]" value="1" <?=$val->evstatus==1?'checked':''?>>
												</div>
												<div class="col-xs-2 col-sm-2 col-md-2">
													<div class="form-group">
														<b>Code</b>
														<input name="evc[<?=$i?>][code]" type="text" placeholder="Code" class="form-control" value="<?=$ev_charger_typesAry['code']?>"/>
													</div>
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
													<button class="" onClick='remove_details("<?=$ev_charger_typesAry['id']?>")' type="button"><i class="fa fa-close text-danger"></i></button>
												</div>
											<?php  ?>
										</div>
										<hr>
									<?php } } $i++; }?>
								<div class="row">
									<div class="col-xs-4 col-sm-4 col-md-4">
										<h3>Add New <button class="btn btn-primary list_add_button1" type="button">+</button></h3>
									</div>
								</div>
							</div>
							<div class="clearfix"></div>				

						</div>
						<!-- S:Roof Type -->
						<div id="roof-type" class="tab-pane fade">
							
							<div class="list_wrapper ">  
								<?php
									$roof_typesQry=$cms->db_query("select * from #_customer_price_manager where m_id='1' and sub_id='15' and is_deleted = '0' ");
									$i=0;
									
									while($roof_typesAry = $roof_typesQry->fetch_array()){ 
									$obj = json_decode($roof_typesAry['content']);
									$roof_cnt = $roof_typesQry->num_rows;
										if(count($obj)>0){
											foreach($obj as $val){?>
											<div class="row" id="rev<?=$i?>">
												<div class="status-checkbox">
													<input type="hidden" name="roof[<?=$i?>][id]" value="<?=$roof_typesAry['id']?>">
													<input class="form-check-input" type="checkbox" name="roof[<?=$i?>][rfstatus]" value="1" <?=$val->rfstatus==1?'checked':''?>>
												</div>
												<div class="col-xs-3 col-sm-3 col-md-3">
													<div class="form-group">
														Roof Type
														<input name="roof[<?=$i?>][name]" type="text" placeholder="Name" class="form-control" value="<?=$val->name?>"/>
													</div>
												</div>
													
												<div class="col-xs-1 col-sm-1 col-md-1">
													<button class="" onClick='remove_details("<?=$roof_typesAry['id']?>")' type="button"><i class="fa fa-close text-danger"></i></button>
												</div>
												<!-- <div class="clearfix"></div> -->
											<?php  ?>
										</div>
										<hr>
									<?php } } $i++; }?>
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
								<?php 
								$sensor_typeQry=$cms->db_query("select * from #_customer_price_manager where m_id='2' and sub_id='21' and is_deleted = '0' ");
								$i=0;
								while($sensor_typeAry = $sensor_typeQry->fetch_array()){
								//$obj_solar = json_decode($green_rebate_solarAry['content'],true);
									$sensor_obj = json_decode($sensor_typeAry['content'],true);
									$sensor_cnt = $sensor_typeQry->num_rows;
									if(count($sensor_obj)>0){
										
										foreach($sensor_obj as $val){?>
										<div class="row" id="rev<?=$i?>">
											<div class="status-checkbox">
												<input  type="hidden" name="sensor[<?=$i?>][id]" value="<?=$sensor_typeAry['id']?>">

												<input class="form-check-input" type="checkbox" name="sensor[<?=$i?>][sensor_status]" value="1" <?=$val['sensor_status']==1?'checked':''?>>
											</div>
											<div class="form-group col-xs-2 col-sm-2 col-md-2">
												<b>Code</b>
												<input name="sensor[<?=$i?>][code]" type="text" placeholder="Code" class="form-control" value="<?=$sensor_typeAry['code']?>"/>
											</div>
											<div class="form-group col-xs-2 col-sm-2 col-md-4">
												<b>Name</b>
												<input name="sensor[<?=$i?>][sensor_name]" type="text" placeholder="Name" class="form-control" value="<?=$val['sensor_name']?>"/>
											</div>
											<div class="form-group col-xs-2 col-sm-2 col-md-2">
												<b>Cost</b>
												<input name="sensor[<?=$i?>][sensor_cost]" type="text" placeholder="Cost" class="form-control" value="<?=$val['sensor_cost']?>"/>
											</div>
											<div class="form-group col-xs-2 col-sm-2 col-md-2">
												<b>Warranty</b>
												<input name="sensor[<?=$i?>][sensor_warranty]" type="text" placeholder="Warranty" class="form-control" value="<?=$val['sensor_warranty']?>"/>
											</div>
											<div class="col-xs-1 col-sm-1 col-md-1">
												<br>
												<button class="" onClick='remove_details("<?=$sensor_typeAry['id']?>")' type="button"><i class="fa fa-close text-danger"></i></button>
											</div>
										<?php  ?>
									</div>
									<?php } } $i++; }?>
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
								<?php
									$odrift_typeQry=$cms->db_query("select * from #_customer_price_manager where m_id='2' and sub_id='22' and is_deleted = '0' ");
									$i=0;
									while($odrift_typeAry = $odrift_typeQry->fetch_array()){ 
									$odrift_obj = json_decode($odrift_typeAry['content'],true);
									$odrift_cnt = $odrift_typeQry->num_rows;
									if(count($odrift_obj)>0){
										
										foreach($odrift_obj as $val){?>
										<div class="row" id="rev<?=$i?>">
											<div class="status-checkbox">
												<input type="hidden" name="odrift[<?=$i?>][id]" value="<?=$odrift_typeAry['id']?>">

												<input class="form-check-input" type="checkbox" name="odrift[<?=$i?>][odrift_status]" value="1" <?=$val['odrift_status']==1?'checked':''?>>
											</div>
											<div class="form-group col-xs-2 col-sm-2 col-md-2">
												<b>Code</b>
												<input name="odrift[<?=$i?>][code]" type="text" placeholder="Code" class="form-control" value="<?=$odrift_typeAry['code']?>"/>
											</div>
											<div class="form-group col-xs-2 col-sm-2 col-md-4">
												<b>Name</b>
												<input name="odrift[<?=$i?>][odrift_name]" type="text" placeholder="Name" class="form-control" value="<?=$val['odrift_name']?>"/>
											</div>
											<div class="form-group col-xs-2 col-sm-2 col-md-2">
												<b>Cost</b>
												<input name="odrift[<?=$i?>][odrift_cost]" type="text" placeholder="Cost" class="form-control" value="<?=$val['odrift_cost']?>"/>
											</div>
											<div class="form-group col-xs-2 col-sm-2 col-md-2">
												<b>Warranty</b>
												<input name="odrift[<?=$i?>][odrift_warranty]" type="text" placeholder="Warranty" class="form-control" value="<?=$val['odrift_warranty']?>"/>
											</div>
											<div class="col-xs-1 col-sm-1 col-md-1">
												<br>
												<button class="" onClick='remove_details("<?=$odrift_typeAry['id']?>")' type="button"><i class="fa fa-close text-danger"></i></button>
											</div>
											<?php  ?> 
										</div>
										<?php } } $i++; }?>
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
								<?php
								 	$optimizer_typeQry=$cms->db_query("select * from #_customer_price_manager where m_id='2' and sub_id='23' and is_deleted = '0' ");
									 $i=0;
									while($optimizer_typeAry = $optimizer_typeQry->fetch_array()){
									$optimizer_obj = json_decode($optimizer_typeAry['content'],true);
									$optimizer_obj_cnt = $optimizer_typeAry->num_rows;
									if(count($optimizer_obj)>0){
									
										foreach($optimizer_obj as $val){?>
											<div class="row" id="rev<?=$i?>">
												<div class="status-checkbox">
													<input type="hidden" name="optimizer[<?=$i?>][id]" value="<?=$optimizer_typeAry['id']?>">
													<input class="form-check-input" type="checkbox" name="optimizer[<?=$i?>][optimizer_status]" value="1" <?=$val['optimizer_status']==1?'checked':''?>>
												</div>
												<div class="form-group col-xs-2 col-sm-2 col-md-2">
													<b>Code</b>
													<input name="optimizer[<?=$i?>][code]" type="text" placeholder="Code" class="form-control" value="<?=$optimizer_typeAry['code']?>"/>
												</div>
												<div class="form-group col-xs-2 col-sm-2 col-md-4">
													<b>Name</b>
													<input name="optimizer[<?=$i?>][optimizer_name]" type="text" placeholder="Name" class="form-control" value="<?=$val['optimizer_name']?>"/>
												</div>
												<div class="form-group col-xs-2 col-sm-2 col-md-2">
													<b>Cost</b>
													<input name="optimizer[<?=$i?>][optimizer_cost]" type="text" placeholder="Cost" class="form-control" value="<?=$val['optimizer_cost']?>"/>
												</div>
												<div class="form-group col-xs-2 col-sm-2 col-md-2">
													<b>Warranty</b>
													<input name="optimizer[<?=$i?>][optimizer_warranty]" type="text" placeholder="Warranty" class="form-control" value="<?=$val['optimizer_warranty']?>"/>
												</div>
												<div class="col-xs-1 col-sm-1 col-md-1">
													<br>
													<button class="" onClick='remove_details("<?=$optimizer_typeAry['id']?>")' type="button"><i class="fa fa-close text-danger"></i></button>
												</div>
												<?php  ?>
											</div>
											<hr> 
											<?php } } $i++; }?>
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
								<?php
									$ac_protectQry=$cms->db_query("select * from #_customer_price_manager where m_id='2' and sub_id='24' and is_deleted = '0' ");
									$ac_protectAry = $ac_protectQry->fetch_array();
									$obj_ac_protect = json_decode($ac_protectAry['content'],true);
									$ac_cnt = count($obj_ac_protect);
									if(count($obj_ac_protect)>0){
										$i=0;
										foreach($obj_ac_protect as $val1){
								?>
									<div class="row" id="rev<?=$i?>">
										<div class="status-checkbox">
											<input type="hidden" name="ac_protect[<?=$i?>][id]" value="<?=$ac_protectAry['id']?>">
											<input class="form-check-input" type="checkbox" name="ac_protect[<?=$i?>][status]" value="1" <?=$val1['status']==1?'checked':''?>>
										</div>
										<div class="form-group col-xs-4 col-sm-4 col-md-4">
											Brand
											<input name="ac_protect[<?=$i?>][brand]" type="text" placeholder="Name" class="form-control" value="<?=$val1['brand']?>"/>
										</div>
										<div class="form-group col-xs-2 col-sm-2 col-md-2">
											Price
											<input name="ac_protect[<?=$i?>][price]" type="text" placeholder="Cost" class="form-control" value="<?=$val1['price']?>"/>
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
								<?php
									$dc_protectQry=$cms->db_query("select * from #_customer_price_manager where m_id='2' and sub_id='25' and is_deleted = '0' ");
									$dc_protectAry = $dc_protectQry->fetch_array(); 
									$obj_dc_protect = json_decode($dc_protectAry['content'],true);
									$dc_cnt = count($obj_dc_protect);
									if(count($obj_dc_protect)>0){
									$i=0;
										foreach($obj_dc_protect as $val1){
								?>
								<div class="row" id="rev<?=$i?>">
									<div class="status-checkbox">
									<input class="form-check-input" type="hidden" name="dc_protect[<?=$i?>][id]" value="<?=$dc_protectAry['id']?>">

										<input class="form-check-input" type="checkbox" name="dc_protect[<?=$i?>][status]" value="1" <?=$val1['status']==1?'checked':''?>>
									</div>
									<div class="form-group col-xs-4 col-sm-4 col-md-4">
										<b>Brand</b>
										<input name="dc_protect[<?=$i?>][brand]" type="text" placeholder="Name" class="form-control" value="<?=$val1['brand']?>"/>
									</div>
									<div class="form-group col-xs-2 col-sm-2 col-md-2">
										<b>Price</b>
										<input name="dc_protect[<?=$i?>][price]" type="text" placeholder="Cost" class="form-control" value="<?=$val1['price']?>"/>
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
										<?php
											$cable_invQry=$cms->db_query("select * from #_customer_price_manager where m_id='2' and sub_id='26' and field_const='cable_inv' and is_deleted = '0' ");
											$cable_invAry = $cable_invQry->fetch_array(); 
											$obj_inv = json_decode($cable_invAry['content'],true);
											$cable_evQry=$cms->db_query("select * from #_customer_price_manager where m_id='2' and sub_id='26' and field_const='cable_ev' and is_deleted = '0' ");
											$cable_evAry = $cable_evQry->fetch_array(); 
											$obj_ev = json_decode($cable_evAry['content'],true); $i=0; 
											foreach($obj_inv as $val){ ?>
										<div class="col-xs-6 col-sm-6 col-md-6">
											<div class="form-group">
												Inverter and EL meter Price/Meter including installation
												<input name="cables_inv[<?=$i?>][id]" type="hidden" placeholder="" class="form-control" value="<?=$cable_invAry['id']?>"/>
												<input name="cables_inv[<?=$i?>][inv]" type="text" placeholder="" class="form-control" value="<?=$val['inv']?>"/>
											</div>
										</div>
										<?php } foreach($obj_ev as $val){?>
										<div class="col-xs-6 col-sm-6 col-md-6">
											<div class="form-group">
												EV charger and EL meter Price/Meter including installation
												<input name="cables_ev[<?=$i?>][id]" type="hidden" placeholder="" class="form-control" value="<?=$cable_evAry['id']?>"/>

												<input name="cables_ev[<?=$i?>][ev]" type="text" placeholder="" class="form-control" value="<?=$val['ev']?>"/>
											</div>
										</div>
										<?php } ?>
									</div>
								</div>
							</div>
							<div class="clearfix"></div>
							
						</div>
						<div id="wifi-dongle" class="tab-pane fade">
							
							<div class="list_wrapper list_wrapper_wifiDongle">
									<?php
									$i=0;
									while($wifi_dongleAry = $wifi_dongleQry->fetch_array()){
									$obj_wifi_dongle = json_decode($wifi_dongleAry['content'],true);
									$obj_wifi_cnt = $wifi_dongleQry->num_rows;
									//if(count($obj_wifi_dongle)>0){
										
										foreach($obj_wifi_dongle as $val){?>
										<div class="row" id="rev<?=$i?>">
											<div class="status-checkbox">
												<input type="hidden" name="wifi_dongle[<?=$i?>][id]" value="<?=$wifi_dongleAry['id']?>">
												<input class="form-check-input" type="checkbox" name="wifi_dongle[<?=$i?>][dongle_status]" value="1" <?=$val['dongle_status']==1?'checked':''?>>
											</div>
											<div class="form-group col-xs-2 col-sm-2 col-md-2">
												<b>Code</b>
												<input name="wifi_dongle[<?=$i?>][code]" type="text" placeholder="Code" class="form-control" value="<?=$wifi_dongleAry['code']?>"/>
											</div>
											<div class="form-group col-xs-2 col-sm-2 col-md-2">
												<b>Brand</b>
												<input name="wifi_dongle[<?=$i?>][dongle_brand]" type="text" placeholder="Brand Name" class="form-control" value="<?=$val['dongle_brand']?>"/>
											</div>
											<div class="form-group col-xs-2 col-sm-2 col-md-2">
												<b>Model</b>
												<input name="wifi_dongle[<?=$i?>][dongle_model]" type="text" placeholder="Model Name" class="form-control" value="<?=$val['dongle_model']?>"/>
											</div>
											<div class="form-group col-xs-2 col-sm-2 col-md-2">
												<b>Cost</b>
												<input name="wifi_dongle[<?=$i?>][dongle_cost]" type="text" placeholder="Cost" class="form-control" value="<?=$val['dongle_cost']?>"/>
											</div>
											<div class="form-group col-xs-2 col-sm-2 col-md-2">
												<b>Warranty</b>
												<input name="wifi_dongle[<?=$i?>][dongle_warranty]" type="text" placeholder="Warranty" class="form-control" value="<?=$val['dongle_warranty']?>"/>
											</div>
											<div class="col-xs-1 col-sm-1 col-md-1">
												<br>
												<button class="" onClick='remove_details("<?=$wifi_dongleAry['id']?>")' type="button"><i class="fa fa-close text-danger"></i></button>
											</div>
											<?php  ?> 
										</div>
										<hr>
										<?php } $i++;  } ?>
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
						<li><a data-toggle="tab" href="#mmswb">Warranty</a></li>
					</ul>

					<div class="tab-content">
						<div id="vander-valk" class="tab-pane fade in active">
							
							<div class="list_wrapper list_wrapper2" style="font-size:12px;">  
								<?php 
									$mmsVVQry=$cms->db_query("select * from #_customer_price_manager where m_id='3' and sub_id='31' and is_deleted = '0' "); 
									$i=0;
									while($mmsVVArry= $mmsVVQry->fetch_array()){	
									
									@extract($mmsVVArry);
									$objMmsVv = json_decode($mmsVVArry['content'],true);
										// $i=0; ?>
										
											<div class="row">
												<div class="status-checkbox">
													<input type="hidden" name="mmsVV[<?=$i?>][id]" value="<?=$mmsVVArry['id']?>">
													<input class="form-check-input" type="checkbox" name="mmsVV[<?=$i?>][status]" value="1" <?=$mmsVVArry['status']==1?'checked':''?>>
												</div>
											<?php foreach($objMmsVv as $val){ ?>
												<div class="col-xs-3 col-sm-3 col-md-3">
													<div class="form-group">
														<b>Code</b>
														<input name="mmsVV[<?=$i?>][code]" type="text" placeholder="Enter Code" class="form-control" value="<?=$val['code']?>" readonly/>
													</div>
												</div>
												<div class="col-xs-4 col-sm-3 col-md-4">
													<div class="form-group">
														<b>Name</b>
														<input name="mmsVV[<?=$i?>][name]" type="text" placeholder="Enter Name" class="form-control" value="<?=$val['name']?>" readonly/>
													</div>
												</div>
												<div class="col-xs-3 col-sm-3 col-md-4">
													<div class="form-group">
														<b>Cost</b>
														<input autocomplete="off" name="mmsVV[<?=$i?>][price]" type="text" placeholder="Cost" class="form-control" value="<?=$val['price']?>"/>
													</div>
												</div>
												<div class="col-xs-3 col-sm-3 col-md-3">
													<div class="form-group">
														<b>Image max-width: 270px and height: 131px and extension: jpg/jpeg</b>
														<input type="file" name="mmsVV[<?=$i?>][img]" id="drp<?=$i?>" class="dropify dropify-charger" data-max-file-size="1M" data-height="150" <?php if($mmsVVArry['image'] AND file_exists(FILES_PATH.UP_FILES_PROPOSAL.'/mms/vandervalk/'.$mmsVVArry['image'])){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/<?=UP_FILES_PROPOSAL?>/mms/vandervalk/<?=$mmsVVArry['image']?>" <?php } ?> />
														<input type="hidden" name="mmsVV[<?=$i?>][img]" class="form-control" value="<?=$mmsVVArry['image']?>"/>
													</div>
												</div>
												<?php if($val['length']!="" || $val['length']!= null ){?>
												<div class="col-xs-3 col-sm-3 col-md-4">
													<div class="form-group">
														<b>Length [in m]</b>
														<input autocomplete="off" name="mmsVV[<?=$i?>][length]" type="text" placeholder="Length" class="form-control" value="<?=$val['length']?>"/>
													</div>
												</div>
												<?php } ?>
											</div> 
										<hr>
								<?php } $i++; ?>
												
								<?php }?>
								  
											
							</div>
							<div class="clearfix"></div>

						</div>
						<div id="k2s" class="tab-pane fade">
						<div class="list_wrapper list_wrapper2" style="font-size:12px;">  
								<?php 
									$mmsKPQry=$cms->db_query("select * from #_customer_price_manager where m_id='3' and sub_id='32' and is_deleted = '0' "); 
									$i=0;
									while($mmsKPArry= $mmsKPQry->fetch_array()){	
									
									// @extract($cpMmsArry);
									$objMmsKP = json_decode($mmsKPArry['content'],true);
										// $i=0; ?>
											<div class="row">
												<div class="status-checkbox">
													<input type="hidden" name="mmsKp[<?=$i?>][id]" value="<?=$mmsKPArry['id']?>">
													<input class="form-check-input" type="checkbox" name="mmsKp[<?=$i?>][status]" value="1" <?=$mmsKPArry['status']==1?'checked':''?>>
												</div>
												<?php	foreach($objMmsKP as $val){ ?>
												<div class="col-xs-3 col-sm-3 col-md-3">
													<div class="form-group">
														<b>Code</b>
														<input name="mmsKp[<?=$i?>][code]" type="text" placeholder="Enter Code" class="form-control" value="<?=$val['code']?>" readonly/>
													</div>
												</div>
												<div class="col-xs-4 col-sm-4 col-md-4">
													<div class="form-group">
														<b>Name</b>
														<input name="mmsKp[<?=$i?>][name]" type="text" placeholder="Enter Name" class="form-control" value="<?=$val['name']?>" readonly/>
													</div>
												</div>
												<div class="col-xs-3 col-sm-3 col-md-3">
													<div class="form-group">
														<b>Cost</b>
														<input autocomplete="off" name="mmsKp[<?=$i?>][price]" type="text" placeholder="Cost" class="form-control" value="<?=$val['price']?>"/>
													</div>
												</div>
												<div class="col-xs-3 col-sm-3 col-md-3">
													<div class="form-group">
														<b>Image max-width: 270px and height: 131px and extension: jpg/jpeg</b>
														<input type="file" name="mmsKp[<?=$i?>][img]" id="drp<?=$i?>" class="dropify dropify-charger" data-max-file-size="1M" data-height="150" <?php if($mmsKPArry['image'] AND file_exists(FILES_PATH.UP_FILES_PROPOSAL.'/mms/kpsystem/'.$mmsKPArry['image'])){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/<?=UP_FILES_PROPOSAL?>/mms/kpsystem/<?=$mmsKPArry['image']?>" <?php } ?> />
														<input type="hidden" name="mmsKp[<?=$i?>][img]" class="form-control" value="<?=$mmsKPArry['image']?>"/>
													</div>
												</div>
											</div> 
										<hr>
								<?php }  $i++; }?>  
									
							</div>
							<div class="clearfix"></div>
						</div>
						<div id="mmswb" class="tab-pane fade">
							<div class="list_wrapper list_wrapper2" style="font-size:12px;">  
								<?php 
									$mmsWbQry=$cms->db_query("select * from #_customer_price_manager where m_id='3' and sub_id='33' and is_deleted = '0' "); 
									//$i=0;
									$mmsWbArry= $mmsWbQry->fetch_array();	
									$objMmsWb = json_decode($mmsWbArry['content'],true);
										// $i=0; ?>
									<div class="row">
											<input type="hidden" name="mmsWb[<?=$i?>][id]" value="<?=$mmsWbArry['id']?>">
										<?php foreach($objMmsWb as $val){ ?>
										<div class="col-xs-6 col-sm-6 col-md-6">
											<div class="form-group">
												<b>Product guarantee mounting system (year)</b>
												<input name="mmsWb[<?=$i?>][code]" type="text" placeholder="Enter Warranty" class="form-control" value="<?=$val['mwarranty']?>"/>
											</div>
										</div>
									</div> 
										
								<?php }  ?>  
									
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
									<?php 
										$shipQry=$cms->db_query("select * from #_customer_price_manager where m_id='4' and sub_id='41' and is_deleted = '0' ");
										$i=0;
										while($shipArry= $shipQry->fetch_array()){
										$obj_shipcost = json_decode($shipArry['content'],true);
										// $i=0;
										// print_r($obj_shipcost);die;
										foreach($obj_shipcost as $val){ 
									?>
										<div class="col-xs-4 col-sm-4 col-md-4">
											<div class="form-group">
												Shipment Cost
												<input name="shipcost[<?=$i?>][id]" value="<?=$shipArry['id']?>" type="hidden"/>
												<input name="shipcost[<?=$i?>][shipmentcost]" type="text" placeholder="" class="form-control" value="<?=$val['shipmentcost']?>"/>
											</div>
										</div>
									<?php } $i++; } ?>
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
								<?php 
									$installationQry=$cms->db_query("select * from #_customer_price_manager where m_id='5' and sub_id='51' and is_deleted = '0' ");
									$i=0;
									while($installationArry= $installationQry->fetch_array()){
									$obj = json_decode($installationArry['content']);
									$intc_cnt = $installationQry->num_rows;
									// print_r($intc_cnt);die;
									// $i=0;
									if(count($obj)>0){										
										foreach($obj as $val){ ?>
										<div class="row" id="inscrow<?=$i?>">
											<div class="col-xs-2 col-sm-2 col-md-2">
												<div class="form-group">
													<input name="intc[<?=$i?>][id]" type="hidden" value="<?=$installationArry['id']?>"/>
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
												<button class="" onClick='remove_details("<?=$installationArry['id']?>")' type="button"><i class="fa fa-close text-danger"></i></button>
												<!-- <button class="" onclick='revrcrd("inscrow<?=$i?>")' type="button"><i class="fa fa-close text-danger"></i></button> -->										
											</div>
											<div class="clearfix"></div>
											<?php  ?>
										</div>
										<?php } } $i++; }?>  
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
				<?php } else if($_GET['val']=='6'){ if($_SESSION["ses_adm_id"]==1){ ?>
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#margin">Margin</a></li>
					</ul>

					<div class="tab-content">
						<!-- S:margin -->
						<div id="margin" class="tab-pane fade in active">
						
							<div class="list_wrapper">  
								<div class="row">
								<?php
									$smrgQry=$cms->db_query("select * from #_customer_price_manager where m_id='6' and sub_id='61' and field_const='solar_margin'  and is_deleted = '0' ");
									$smrgAry = $smrgQry->fetch_array(); 
									$obj_smrg = json_decode($smrgAry['content'],true);
									$evmrgQry=$cms->db_query("select * from #_customer_price_manager where m_id='6' and sub_id='61' and field_const='ev_margin'  and is_deleted = '0' ");
									$evmrgAry = $evmrgQry->fetch_array();
									$obj_evmrg = json_decode($evmrgAry['content'],true);
									$btmrgQry=$cms->db_query("select * from #_customer_price_manager where m_id='6' and sub_id='61' and field_const='battery_margin'  and is_deleted = '0' ");
									$btmrgAry = $btmrgQry->fetch_array();
									$obj_btmrg = json_decode($btmrgAry['content'],true);
									$minmrgQry=$cms->db_query("select * from #_customer_price_manager where m_id='6' and sub_id='61' and field_const='minimum_total_margin'  and is_deleted = '0' ");
									$minmrgAry = $minmrgQry->fetch_array();
									$obj_minmrg = json_decode($minmrgAry['content'],true);
								$i=0; foreach($obj_smrg as $val){ ?>
								<div class="col-xs-3 col-sm-3 col-md-3">
									<div class="form-group">
										<div class="status-checkbox mgtp0">
											<input type="hidden" value="<?=$smrgAry['id']?>" name="smrg[<?=$i?>][id]">
											<input class="form-check-input" type="checkbox" name="smrg[<?=$i?>][status]" value="1" <?=$smrgAry['status']==1?'checked':''?>>
												Margins for solar panel (%)
										</div>
									</div>
								</div>
								<div class="col-xs-2 col-sm-2 col-md-2">
									<div class="form-group">
										Min : <input name="smrg[<?=$i?>][min]" type="text" placeholder="" class="form-control" value="<?=$val['min']?>"/>
									</div>
								</div>
								<div class="col-xs-2 col-sm-2 col-md-2">
									<div class="form-group">
										Max : <input name="smrg[<?=$i?>][max]" type="text" placeholder="" class="form-control" value="<?=$val['max']?>"/>
									</div>
								</div>
								<?php } foreach($obj_evmrg as $val){ ?>
								<div class="clearfix"></div>
								<div class="col-xs-3 col-sm-3 col-md-3">
									<div class="form-group">
										<div class="status-checkbox mgtp0">
											<input type="hidden" value="<?=$evmrgAry['id']?>" name="evmrg[<?=$i?>][id]" >
											<input class="form-check-input" type="checkbox" name="evmrg[<?=$i?>][status]" value="1" <?=$evmrgAry['status']==1?'checked':''?>>
												Margins for EV charger (%)
										</div>
									</div>
								</div>
								<div class="col-xs-2 col-sm-2 col-md-2">
									<div class="form-group">
										Min : <input name="evmrg[<?=$i?>][min]" type="text" placeholder="" class="form-control" value="<?=$val['min']?>"/>
									</div>
								</div>
								<div class="col-xs-2 col-sm-2 col-md-2">
									<div class="form-group">
										Max : <input name="evmrg[<?=$i?>][max]" type="text" placeholder="" class="form-control" value="<?=$val['max']?>"/>
									</div>
								</div>
								<?php }foreach($obj_btmrg as $val){ ?>
								<div class="clearfix"></div>
								<div class="col-xs-3 col-sm-3 col-md-3">
									<div class="form-group">
										<div class="status-checkbox mgtp0">
											<input type="hidden" name="btmrg[<?=$i?>][id]" value="<?=$btmrgAry['id']?>">
											<input class="form-check-input" type="checkbox" name="btmrg[<?=$i?>][status]" value="1" <?=$btmrgAry['status']==1?'checked':''?>>
												Margin for Battery (%)
										</div>
									</div>
								</div>
								<div class="col-xs-2 col-sm-2 col-md-2">
									<div class="form-group">
										Min : <input name="btmrg[<?=$i?>][min]" type="text" placeholder="" class="form-control" value="<?=$val['min']?>"/>
									</div>
								</div>
								<div class="col-xs-2 col-sm-2 col-md-2">
									<div class="form-group">
										Max : <input name="btmrg[<?=$i?>][max]" type="text" placeholder="" class="form-control" value="<?=$val['max']?>"/>
									</div>
								</div>
								<?php } foreach($obj_minmrg as $val) { ?>
								<div class="clearfix"></div>
								<div class="col-xs-3 col-sm-3 col-md-3">
									<div class="form-group">
										<div class="status-checkbox mgtp0">
										<input type="hidden" value="<?=$minmrgAry['id']?>" name="minmrg[<?=$i?>][id]">
											<input class="form-check-input" type="checkbox" name="minmrg[<?=$i?>][status]" value="1" <?=$minmrgAry['status']==1?'checked':''?>>
												Minimum total margin (%)
										</div>
									</div>
								</div>
								<div class="col-xs-2 col-sm-2 col-md-2">
									<div class="form-group">
										<input name="minmrg[<?=$i?>][margin]" type="text" placeholder="" class="form-control" value="<?=$val['margin']?>"/>
									</div>
								</div>
								<?php } ?>
								<div class="clearfix"></div>

								<div class="clearfix"></div>
								</div>
								<div class="clearfix"></div>
							
							</div>

						</div>
					</div>
				<!--S:Other  -->
				<?php } } else if($_GET['val']=='7'){?>

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
									<?php 
										$green_rebate_solarQry=$cms->db_query("select * from #_customer_price_manager where m_id='7' and sub_id='71' and field_const='green_rebate_solar'  and is_deleted = '0' ");
										$green_rebate_solarAry = $green_rebate_solarQry->fetch_array();
										$obj_solar = json_decode($green_rebate_solarAry['content'],true);
										$green_rebate_evQry=$cms->db_query("select * from #_customer_price_manager where m_id='7' and sub_id='71' and field_const='green_rebate_ev'  and is_deleted = '0' ");
										$green_rebate_evAry = $green_rebate_evQry->fetch_array();
										$obj_ev = json_decode($green_rebate_evAry['content'],true);
										$green_rebate_batteryQry=$cms->db_query("select * from #_customer_price_manager where m_id='7' and sub_id='71' and field_const='green_rebate_battery'  and is_deleted = '0' ");
										$green_rebate_batteryAry = $green_rebate_batteryQry->fetch_array();
										$obj_battery = json_decode($green_rebate_batteryAry['content'],true);
										$i=0; foreach($obj_solar as $val){ ?>
											<div class="col-xs-4 col-sm-4 col-md-4">
												<div class="form-group">
													for solar panels (%)
													<input type="hidden" name="grs[<?=$i?>][id]" value="<?=$green_rebate_solarAry['id']?>"> 
													<input name="grs[<?=$i?>][rebate]" type="text" placeholder="" class="form-control" value="<?=$val['rebate']?>"/>
												</div>
											</div>
											<?php } foreach($obj_ev as $val){ ?>
											<div class="col-xs-4 col-sm-4 col-md-4">
												<div class="form-group">
													for EV charger (%)
													<input type="hidden" name="grev[<?=$i?>][id]" value="<?=$green_rebate_evAry['id']?>">
													<input name="grev[<?=$i?>][rebate]" type="text" placeholder="" class="form-control" value="<?=$val['rebate']?>"/>
												</div>
											</div>
											<?php } foreach($obj_battery as $val){ ?>
											<div class="col-xs-4 col-sm-4 col-md-4">
												<div class="form-group">
													for Battery (%)
													<input type="hidden" name="grb[<?=$i?>][id]" value="<?=$green_rebate_batteryAry['id']?>">
													<input name="grb[<?=$i?>][rebate]" type="text" placeholder="" class="form-control" value="<?=$val['rebate']?>"/>
												</div>
											</div>
											<?php } ?>
										</div>
									</div>
									<div class="clearfix"></div>

						</div>

						<div id="pay-at-ordering" class="tab-pane fade">
							
							<div class="list_wrapper">  
								<div class="row">
									<?php
										$payAtQry=$cms->db_query("select * from #_customer_price_manager where m_id='7' and sub_id='72' and is_deleted = '0' ");
										while( $payAtArry = $payAtQry->fetch_array()){
										// print_r($payAtArry);
										// die;
										$obj_orderPayment = json_decode($payAtArry['content'],true);
										$i=0; 
										foreach($obj_orderPayment as $val){
										?>
										<div class="col-xs-4 col-sm-4 col-md-4">
											<div class="form-group">
												Pay % at ordering
												<input name="orderpercentage[<?=$i?>][id]" type="hidden" value="<?=$payAtArry['id']?>">
												<input name="orderpercentage[<?=$i?>][orderPayment]" type="text" placeholder="" class="form-control" value="<?=$val['orderPayment']?>"/>
											</div>
										</div>
										<?php } $i++; }?>
									</div>
									<div class="clearfix"></div>
								</div>					  
							<div class="clearfix"></div>

						</div>
						<div id="production" class="tab-pane fade">
						
							<div class="list_wrapper">  
								<div class="row">
									<?php 
									$prodQry=$cms->db_query("select * from #_customer_price_manager where m_id='7' and sub_id='73' and is_deleted = '0' ");
									$i=0; 
									while( $prodArry = $prodQry->fetch_array()){
									$obj_prod = json_decode($prodArry['content'],true); 
									foreach($obj_prod as $valProd){	
									?>
										<div class="form-group col-md-6">
											<label class="control-label">Annual inflation adjustment on electricity price (%)</label>
											<input type="hidden" name="production[<?=$i?>][id]" value="<?=$prodArry['id']?>">
											<input type="text" class="form-control" name="production[<?=$i?>][prod_inflation]" placeholder="Annual inflation adjustment on electricity price" value="<?=$valProd['prod_inflation']?>">
										</div>
										<div class="form-group col-md-6">
											<label class="control-label">Real price increase on variable electricity price (%)</label>
											<input type="text" class="form-control" name="production[<?=$i?>][prod_price_increase]" placeholder="Real price increase on variable electricity price" value="<?=$valProd['prod_price_increase']?>">
										</div>
										<div class="form-group col-md-6">
											<label class="control-label">Annual effect deterioration in percent (%)</label>
											<input type="text" class="form-control" name="production[<?=$i?>][prod_deterioration]" placeholder="Annual effect deterioration in percent" value="<?=$valProd['prod_deterioration']?>">
										</div>
										<div class="form-group col-md-3">
											<label class="control-label">Power loss (%)</label>
											<input type="text" class="form-control" name="production[<?=$i?>][prod_power_loss]" placeholder="Power loss" value="<?=$valProd['prod_power_loss']?>">
										</div>
									<?php } $i++; }?>
								</div>
								<div class="clearfix"></div>
							</div>

						</div>
						<div id="proposal-types" class="tab-pane fade">
							
							<div class="list_wrapper">  
								<div class="row">
									<?php 
										$proposalTypeQry=$cms->db_query("select * from #_customer_price_manager where m_id='7' and sub_id='74' and field_const='proposal_type_name_2' and is_deleted = '0' ");
										$i=0;
										$proposalTypeArry = $proposalTypeQry->fetch_array();

										// print_r($proposalTypeArry);die;
										
										$proposalType1 = json_decode($proposalTypeArry['content'],true); 
										// print_r($proposalType1);
										// print_r($proposalType);
										foreach($proposalType as $pkey=>$pval){	
											//print_r($proposalType);										
									?>
									<div class="form-group col-xs-6 col-sm-6 col-md-6">
										<div class="checkbox checkbox-success">
											<input type="hidden" value="<?=$proposalTypeArry['id']?>" name="propType[id]">
											<input id="proposal_type_name[<?=$i?>]" type="checkbox" name="propType[<?=$i?>][status]" value="1" <?=$proposalType1[$i]['status']==1?'checked':''?>>
											<label for="proposal_type_name[<?=$i?>]"> <?=$pval?> </label>
											<input name="propType[<?=$i?>][pnum]" type="hidden" placeholder="" class="form-control" value="<?=$pkey?>"/>
											<input name="propType[<?=$i?>][name]" type="hidden" placeholder="" class="form-control" value="<?=$pval?>"/>
										</div>
									</div>
									<div class="clearfix"></div>
									<?php $i++;  }  ?>
								</div>
								<div class="clearfix"></div>
								
								<div class="clearfix"></div>
							</div>

						</div>
						<div id="vat" class="tab-pane fade">
						
							<div class="list_wrapper">  
								<div class="row">
									<?php 
										$vatQry=$cms->db_query("select * from #_customer_price_manager where m_id='7' and sub_id='75' and is_deleted = '0' ");
										$i=0;
										while( $vatArry = $vatQry->fetch_array()){
										$obj_vat = json_decode($vatArry['content'],true);
										foreach($obj_vat as $val){
									?>
										<div class="col-xs-4 col-sm-4 col-md-4">
											<div class="form-group"> 
												VAT (%)
												<input type="hidden" name="vatArr[<?=$i?>][id]" value="<?=$vatArry["id"]?>">
												<input name="vatArr[<?=$i?>][vat]" type="text" placeholder="" class="form-control" value="<?=$val["vat"]?>"/>
											</div>
										</div>
										<?php } $i++; }?>
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
	var x1 = "<?=$ec_cnt?>"; //Initial field counter	
	$('.list_add_button1').click(function()
	    {
			
	    //Check maximum number of input fields
	    if(x1 < list_maxField){ 
	        x1++; //Increment field counter
	        var list_fieldHTML = '<div class="row"><div class="status-checkbox"><input class="form-check-input" type="checkbox" name="evc['+x1+'][evstatus]" value="1"></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input name="evc['+x1+'][code]" type="text" placeholder="Code" class="form-control"/></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input name="evc['+x1+'][name]" type="text" placeholder="Name" class="form-control"/></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input name="evc['+x1+'][price]" type="text" placeholder="Cost" class="form-control"/></div></div><div class="col-xs-3 col-sm-3 col-md-3"><div class="form-group"><input autocomplete="off" name="evc['+x1+'][cwarranty]" type="text" placeholder="Warranty" class="form-control"/></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input autocomplete="off" name="evc['+x1+'][cdiscount]" type="text" placeholder="Discount" class="form-control" /></div></div><div class="clearfix"></div><div class="col-xs-3 col-sm-3 col-md-3"><div class="form-group"><input name="evc['+x1+'][loadbalancercost]" type="text" placeholder="Load Balancer Cost" class="form-control"/></div></div><div class="col-xs-3 col-sm-3 col-md-3"><div class="form-group"><input name="evc['+x1+'][lbwarranty]" type="number" placeholder="Load Balancer warranty" class="form-control"/></div></div><div class="col-xs-3 col-sm-3 col-md-3"><div class="form-group"><input type="file" name="evc['+x1+'][charger_img]" id="drp['+x1+']" class="dropify dropify-charger" data-max-file-size="1M" data-height="150"/></div></div> <div class="col-xs-1 col-sm-7 col-md-1"><a href="javascript:void(0);" class="list_remove_button btn btn-danger">-</a></div></div>'; //New input field html 
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
	        var list_fieldHTML = '<div class="row"><div class="status-checkbox"><input class="form-check-input" type="checkbox" name="pty['+x2+'][pstatus]" value="1"></div><div class="col-xs-3 col-sm-3 col-md-3"><div class="form-group"><input name="pty['+x2+'][code]" type="text" placeholder="Code" class="form-control"/></div></div><div class="col-xs-3 col-sm-3 col-md-3"><div class="form-group"><input name="pty['+x2+'][name]" type="text" placeholder="Name" class="form-control"/></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input name="pty['+x2+'][brand]" type="text" placeholder="Brand" class="form-control"/></div></div><div class="col-xs-1 col-sm-1 col-md-1"><div class="form-group"><input name="pty['+x2+'][wattage]" type="text" placeholder="wattage" class="form-control"/></div></div><div class="col-xs-1 col-sm-1 col-md-1"><div class="form-group"><input name="pty['+x2+'][price]" type="text" placeholder="Cost" class="form-control"/></div></div><div class="col-xs-1 col-sm-1 col-md-1"><div class="form-group"><input name="pty['+x2+'][width]" type="text" placeholder="Width" class="form-control"/></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input autocomplete="off" name="pty['+x2+'][swarranty]" type="text" placeholder="Warranty" class="form-control" /></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input autocomplete="off" name="pty['+x2+'][effektfaktor]" type="text" placeholder="Effektfaktor" class="form-control"/></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input autocomplete="off" name="pty['+x2+'][short_circuit]" type="text" placeholder="Kortslutningsström" class="form-control" /></div></div><div class="col-xs-3 col-sm-3 col-md-3"><div class="form-group"><input autocomplete="off" name="pty['+x2+'][effectWarranty]" type="text" placeholder="Effect Warranty" class="form-control" /></div></div><div class="col-xs-3 col-sm-3 col-md-3"><div class="form-group"><input autocomplete="off" name="pty['+x2+'][warranty_percentage]" type="text" placeholder="Effect warranty after 25 years" class="form-control" /></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input autocomplete="off" name="pty['+x2+'][pcolor]" type="text" class="form-control" placeholder="Color" /></div></div><div class="col-xs-3 col-sm-3 col-md-3"><div class="form-group"><input type="file" name="pty['+x2+'][panel_img]" id="drop_panel'+x2+'" class="dropify dropify-panel" data-max-file-size="1M" data-height="150" /></div></div><div class="col-xs-1 col-sm-7 col-md-1"><a href="javascript:void(0);" class="list_remove_button btn btn-danger">-</a></div></div></div> '; //New input field html 
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
	        var list_fieldHTML = '<div class="row"><div class="status-checkbox"><input class="form-check-input" type="checkbox" name="invt['+x3+'][invstatus]" value="1"></div><div class="col-xs-4 col-sm-4 col-md-4"><div class="form-group"><input name="invt['+x3+'][code]" type="text" placeholder="Code" class="form-control"/></div></div><div class="col-xs-4 col-sm-4 col-md-4"><div class="form-group"><input name="invt['+x3+'][name]" type="text" placeholder="Name" class="form-control"/></div></div><div class="col-xs-3 col-sm-3 col-md-3"><div class="form-group"><input name="invt['+x3+'][inveffect]" type="text" placeholder="Effect" class="form-control" /></div></div><div class="col-xs-3 col-sm-3 col-md-3"><div class="form-group"><input name="invt['+x3+'][invbrand]" type="text" placeholder="Brand" class="form-control" /></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input name="invt['+x3+'][price]" type="text" placeholder="Cost" class="form-control"/></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input autocomplete="off" name="invt['+x3+'][invwarranty]" type="text" placeholder="Warranty" class="form-control" /></div></div><div class="col-xs-3 col-sm-3 col-md-3"><div class="form-group"><input type="file" name="invt['+x3+'][inverter_img]" id="drop_inverter'+x3+'" class="dropify dropify-inverter" data-max-file-size="1M" data-height="150" /></div></div><div class="col-xs-3 col-sm-3 col-md-3"><div class="form-group"><div class="checkbox checkbox-success"><input id="checkbox'+x3+'" type="checkbox" name="invt['+x3+'][compatible]" value="1"><label for="checkbox'+x3+'">Battery Compatible</label></div></div></div><div class="col-xs-3 col-sm-3 col-md-3"><div class="form-group"><div class="checkbox checkbox-success"><input id="dongle'+x3+'" type="checkbox" name="invt['+x3+'][dongle]" value="1"><label for="checkbox'+x3+'">Dongle</label></div></div></div><div class="col-xs-3 col-sm-3 col-md-3"><select class="form-control" id="model'+x3+'" name="invt['+x3+'][dongle_model]" <?=$readonly_field?>><option value="">Select Dongle type</option><?php $dongleTypePriceArr = json_decode($wifi_dongle, true);foreach ($dongleTypePriceArr as $dkey => $dvalue) { if($dvalue["dongle_status"]==1){ echo '<option value="'.$dvalue["dongle_model"].'">'.$dvalue["dongle_brand"].'&nbsp'.$dvalue["dongle_model"].'</option>';} }?></select></div> <div class="col-xs-1 col-sm-7 col-md-1"><a href="javascript:void(0);" class="list_remove_button btn btn-danger">-</a></div></div>'; //New input field html 
			$('.list_wrapper3').append(list_fieldHTML); //Add field html
	    }
        });	
	// sec4
	var x4 = "<?=$intc_cnt?>"; //Initial field counter	
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
	        var list_fieldHTML = '<div class="row"><div class="status-checkbox"><input class="form-check-input" type="checkbox" name="btrcs['+x5+'][bstatus]" value="1"></div><div class="col-xs-4 col-sm-4 col-md-4"><div class="form-group"><input name="btrcs['+x5+'][code]" type="text" placeholder="Code" class="form-control"/></div></div><div class="col-xs-4 col-sm-4 col-md-4"><div class="form-group"><input name="btrcs['+x5+'][name]" type="text" placeholder="Name" class="form-control"/></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input autocomplete="off" name="btrcs['+x5+'][btsize]" type="text" placeholder="Size" class="form-control" /></div></div> <div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input name="btrcs['+x5+'][price]" type="text" placeholder="Cost" class="form-control"/></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input autocomplete="off" name="btrcs['+x5+'][bwarranty]" type="text" placeholder="Warranty" class="form-control"  /></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input autocomplete="off" name="btrcs['+x5+'][bdiscount]" type="text" placeholder="Discount" class="form-control" /></div></div><div class="col-xs-3 col-sm-3 col-md-3"><div class="form-group"><input type="file" name="btrcs['+x5+'][battery_img]" id="drop_battery'+x5+'" class="dropify dropify-battery" data-max-file-size="1M" data-height="150" /><input type="hidden" name="btrcs['+x5+'][battery_img]" class="form-control"/></div></div><div class="col-xs-1 col-sm-7 col-md-1"><a href="javascript:void(0);" class="list_remove_button btn btn-danger">-</a></div></div>'; //New input field html 
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
	var x7 = "<?=$sensor_cnt?>"; //Initial field counter	
	$('.list_add_button7').click(function()
	    {
			
	    //Check maximum number of input fields
	    if(x7 < list_maxField){ 
	        x7++; //Increment field counter
	        var list_fieldHTML = '<div class="row"><div class="status-checkbox1" style="float:left"><input class="form-check-input" type="checkbox" name="sensor['+x7+'][sensor_status]" value="1"></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input name="sensor['+x7+'][code]" type="text" placeholder="Code" class="form-control"/></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input name="sensor['+x7+'][sensor_name]" type="text" placeholder="Name" class="form-control"/></div></div><div class="form-group col-xs-2 col-sm-2 col-md-2"><input name="sensor['+x7+'][sensor_cost]" type="text" placeholder="Cost" class="form-control" /></div><div class="form-group col-xs-2 col-sm-2 col-md-2"><input name="sensor['+x7+'][sensor_warranty]" type="text" placeholder="Warranty" class="form-control" /></div><div class="col-xs-1 col-sm-7 col-md-1"><a href="javascript:void(0);" class="list_remove_button btn btn-danger">-</a></div></div>'; //New input field html 
	        $('.list_wrapper_sensor').append(list_fieldHTML); //Add field html
	    }
        });

		// sec extra odrift
	var x8 = "<?=$odrift_cnt?>"; //Initial field counter	
	$('.list_add_button8').click(function()
	    {
			
	    //Check maximum number of input fields
	    if(x8 < list_maxField){ 
	        x8++; //Increment field counter
	        var list_fieldHTML = '<div class="row"><div class="status-checkbox1" style="float:left"><input class="form-check-input" type="checkbox" name="odrift['+x8+'][odrift_status]" value="1"></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input name="odrift['+x8+'][code]" type="text" placeholder="Code" class="form-control"/></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input name="odrift['+x8+'][odrift_name]" type="text" placeholder="Name" class="form-control"/></div></div><div class="form-group col-xs-2 col-sm-2 col-md-2"><input name="odrift['+x8+'][odrift_cost]" type="text" placeholder="Cost" class="form-control" /></div><div class="form-group col-xs-2 col-sm-2 col-md-2"><input name="odrift['+x8+'][odrift_warranty]" type="text" placeholder="Warranty" class="form-control" /></div><div class="col-xs-1 col-sm-7 col-md-1"><a href="javascript:void(0);" class="list_remove_button btn btn-danger">-</a></div></div>'; //New input field html 
	        $('.list_wrapper_odrift').append(list_fieldHTML); //Add field html
	    }
        });
		
		// sec extra optimizer
	var x9 = "<?=$optimizer_obj_cnt?>"; //Initial field counter	
	$('.list_add_button9').click(function()
	    {
			
	    //Check maximum number of input fields
	    if(x9 < list_maxField){ 
	        x9++; //Increment field counter
	        var list_fieldHTML = '<div class="row"><div class="status-checkbox1" style="float:left"><input class="form-check-input" type="checkbox" name="optimizer['+x9+'][optimizer_status]" value="1"></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input name="optimizer['+x9+'][code]" type="text" placeholder="Code" class="form-control"/></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input name="optimizer['+x9+'][optimizer_name]" type="text" placeholder="Name" class="form-control"/></div></div><div class="form-group col-xs-2 col-sm-2 col-md-2"><input name="optimizer['+x9+'][optimizer_cost]" type="text" placeholder="Cost" class="form-control" /></div><div class="form-group col-xs-2 col-sm-2 col-md-2"><input name="optimizer['+x9+'][optimizer_warranty]" type="text" placeholder="Warranty" class="form-control" /></div><div class="col-xs-1 col-sm-7 col-md-1"><a href="javascript:void(0);" class="list_remove_button btn btn-danger">-</a></div></div>'; //New input field html 
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
		var x12 = "<?=$obj_wifi_cnt?>"; //Initial field counter	
	$('.list_add_button12').click(function(){
			
	    //Check maximum number of input fields
	    if(x12 < list_maxField){ 
	        x12++; //Increment field counter
	        var list_fieldHTML = '<div class="row"><div class="status-checkbox1" style="float:left"><input class="form-check-input" type="checkbox" name="wifi_dongle['+x12+'][dongle_status]" value="1"></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input name="wifi_dongle['+x12+'][code]" type="text" placeholder="Code" class="form-control"/></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input name="wifi_dongle['+x12+'][dongle_brand]" type="text" placeholder="Brand Name" class="form-control"/></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input name="wifi_dongle['+x12+'][dongle_model]" type="text" placeholder="Model Name" class="form-control"/></div></div><div class="form-group col-xs-2 col-sm-2 col-md-2"><input name="wifi_dongle['+x12+'][dongle_cost]" type="text" placeholder="Cost" class="form-control" /></div><div class="form-group col-xs-2 col-sm-2 col-md-2"><input name="wifi_dongle['+x12+'][dongle_warranty]" type="text" placeholder="Warranty" class="form-control" /></div><div class="col-xs-1 col-sm-7 col-md-1"><a href="javascript:void(0);" class="list_remove_button btn btn-danger">-</a></div></div>'; //New input field html 
	        $('.list_wrapper_wifiDongle').append(list_fieldHTML); //Add field html
	    }
        });
});
function revrcrd(rid){
	$("#"+rid).remove();
}


$('.dropify').parent().find(".dropify-clear").trigger('click');

</script>
<!-- delete roof details-->
<script>
    function remove_details(id){
        if(confirm("Are you sure to delete?")){
        $.ajax({
           type:"post",
           url:"<?= SITE_PATH_ADM . CPAGE ?>/remove_details.php?id=" + id,
           success: function(result){
            if (parseInt(result) == '1') {
                $("#" + id).hide();
                location.reload();
                } else {
                    alert("Something went wrong.Pleas try again.")
                }
            } 
        })}
    }
</script>
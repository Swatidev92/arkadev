<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 
$pid = $_GET["id"];

if($cms->is_post_back()){ 
	//print_r($_POST);die;
		
	$_POST['modified'] = date("Y-m-d h:i:s");
		
	if($pid){
		if($_POST['added_files'] && $_POST['uploaded_files']){
			$_POST['uploaded_files'] = implode(',',$_POST['uploaded_files']);
			$_POST['uploaded_files'] = $_POST['added_files'].','.$_POST['uploaded_files'];
		}else{
			$_POST['uploaded_files'] = implode(',',$_POST['uploaded_files']);
		}
		if($_FILES["acknowledgement_file"]["name"]){
			$_POST["acknowledgement_file"] = uploadFile("acknowledgement_file","reports");
		}
		$uids =  $pid;
		$cms->sqlquery("rs","customer_project",$_POST,'id',$pid);	
	
		$adm->sessset('Record has been updated', 's');
	} else {
		if($_SESSION["ses_adm_id"]!=1){
			$_POST['project_manager_id'] = $_SESSION["ses_adm_id"];
		}
		$pid = $cms->sqlquery("rs","customer_project",$_POST);
		/*$invoice_Arr = array("report_no"=>$uids);
		$name  = generateReport($invoice_Arr);*/
		$adm->sessset('Record has been added', 's');
	}	
	
	//if($pid){	
		$customerQry = $cms->db_query("SELECT customer_name, quotation_number FROM #_leads where id=".$_POST['cust_id']." AND status=4 and is_deleted=0 ");
		$customerArr = $customerQry->fetch_array();
		$project_customer = $customerArr['customer_name'];
		$data_Arr = array("report_no"=>$pid,"project_num"=>$_POST['project_name'],"project_customer"=>$project_customer);
		//print_r($data_Arr);die;
		$ReportArr['project_report_name'] = generateReport($data_Arr);
		$cms->sqlquery("rs","customer_project",$ReportArr,'id',$pid);
	//}
		//$cms->redir(SITE_PATH_ADM.CPAGE.'?mode=add&id='.$uids, true);
	
	if(!empty($_FILES["site_images"]["name"])){
		$countImage =  count($_FILES["site_images"]["name"]);
		if($countImage>0){
			for($i=0;$i<$countImage;$i++){
				if(!empty($_FILES['site_images']['name'][$i])){
					$filename = rand(1000,100000)."-".$_FILES['site_images']['name'][$i]; 
					$file_loc = $_FILES['site_images']['tmp_name'][$i];
					$file_size = ($_FILES['site_images']['size'][$i]/1024);
					$file_type = $_FILES['site_images']['type'][$i];
					$folder = FILES_PATH."reports/";
					// make file name in lower case
					$supported_format = array("jpg","JPG","jpeg","JPEG","gif","GIF","png","PNG","svg","SVG");
					$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
					
					if (in_array($ext, $supported_format)){
						$new_file_name = strtolower($filename);
						$final_file= str_replace(" ","-",$new_file_name);
						move_uploaded_file($file_loc,$folder.$final_file);
						$gArr['site_images']=$final_file;
						$gArr['system_report']='';
						$gArr['mms_report']='';
						$gArr['acknowledgement_files']='';
						$gArr['project_id']=$pid;
						//print_r($gArr);die;
						$cms->sqlquery("rs","reports",$gArr);								
					}
					else{
						echo '<script>alert("You have uploaded an invalid file!")</script>';
					}						
				}
			}
		}
	}
	
	if(!empty($_FILES["acknowledgement_files"]["name"])){
		$countImage =  count($_FILES["acknowledgement_files"]["name"]);
		if($countImage>0){
			for($i=0;$i<$countImage;$i++){
				if(!empty($_FILES['acknowledgement_files']['name'][$i])){
					$filename = rand(1000,100000)."-".$_FILES['acknowledgement_files']['name'][$i]; 
					$file_loc = $_FILES['acknowledgement_files']['tmp_name'][$i];
					$file_size = ($_FILES['acknowledgement_files']['size'][$i]/1024);
					$file_type = $_FILES['acknowledgement_files']['type'][$i];
					$folder = FILES_PATH."reports/";
					// make file name in lower case
					$supported_format = array("pdf");
					$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
					
					if (in_array($ext, $supported_format)){
						$new_file_name = strtolower($filename);
						$final_file= str_replace(" ","-",$new_file_name);
						move_uploaded_file($file_loc,$folder.$final_file);
						$gArr['acknowledgement_files']=$final_file;
						$gArr['system_report']='';
						$gArr['site_images']='';
						$gArr['mms_report']='';
						$gArr['project_id']=$pid;
						$cms->sqlquery("rs","reports",$gArr);								
					}
					else{
						echo '<script>alert("You have uploaded an invalid file!")</script>';
					}						
				}
			}
		}
	}
	
	if(!empty($_FILES["mms_report"]["name"])){
		$countImage =  count($_FILES["mms_report"]["name"]);
		if($countImage>0){
			for($i=0;$i<$countImage;$i++){
				if(!empty($_FILES['mms_report']['name'][$i])){
					$filename = rand(1000,100000)."-".$_FILES['mms_report']['name'][$i]; 
					$file_loc = $_FILES['mms_report']['tmp_name'][$i];
					$file_size = ($_FILES['mms_report']['size'][$i]/1024);
					$file_type = $_FILES['mms_report']['type'][$i];
					$folder = FILES_PATH."reports/";
					// make file name in lower case
					$supported_format = array('xls','pdf');
					$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
					
					if (in_array($ext, $supported_format)){
						$new_file_name = strtolower($filename);
						$final_file= str_replace(" ","-",$new_file_name);
						move_uploaded_file($file_loc,$folder.$final_file);
						$gArr['mms_report']=$final_file;
						$gArr['system_report']='';							
						$gArr['site_images']='';
						$gArr['acknowledgement_files']='';
						$gArr['project_id']=$pid;
						$cms->sqlquery("rs","reports",$gArr);								
					}
					else{
						echo '<script>alert("You have uploaded an invalid file!")</script>';
					}						
				}
			}
		}
	}
	
	if(!empty($_FILES["system_report"]["name"])){
		$countImage =  count($_FILES["system_report"]["name"]);
		if($countImage>0){
			for($i=0;$i<$countImage;$i++){
				if(!empty($_FILES['system_report']['name'][$i])){
					$filename = rand(1000,100000)."-".$_FILES['system_report']['name'][$i]; 
					$file_loc = $_FILES['system_report']['tmp_name'][$i];
					$file_size = ($_FILES['system_report']['size'][$i]/1024);
					$file_type = $_FILES['system_report']['type'][$i];
					$folder = FILES_PATH."reports/";
					// make file name in lower case
					$supported_format = array('xls','pdf');
					$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
					
					if (in_array($ext, $supported_format)){
						$new_file_name = strtolower($filename);
						$final_file= str_replace(" ","-",$new_file_name);
						move_uploaded_file($file_loc,$folder.$final_file);
						$gArr['system_report']=$final_file;
						$gArr['mms_report']='';							
						$gArr['site_images']='';
						$gArr['acknowledgement_files']='';
						$gArr['project_id']=$pid;
						$cms->sqlquery("rs","reports",$gArr);								
					}
					else{
						echo '<script>alert("You have uploaded an invalid file!")</script>';
					}						
				}
			}
		}
	}
	
	if($t=='proj_info' || $t==''){
		$cms->redir(SITE_PATH_ADM.CPAGE.'?mode=add&t=proj_info&id='.$pid, true);
	}
	elseif($t=='upload_info'){
		$cms->redir(SITE_PATH_ADM.CPAGE.'?mode=add&t=upload_info&id='.$pid, true);
	}
	else{
		$cms->redir(SITE_PATH_ADM.CPAGE, true);
	}
	
}	
if(isset($pid)){
	$rsAdmin=$cms->db_query("select * from #_customer_project where id='".$pid."'");
	$arrAdmin=$cms->db_fetch_array($rsAdmin);
	@extract($arrAdmin);
}
?>

<!-- .row -->
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
			<?php
			$t=$_REQUEST["t"];
			
			$lnk1="#";
			$lnk2="#";
			if($pid>0){
				$lnk1="?mode=add&t=proj_info&id=".$pid;
				$lnk2="?mode=add&t=upload_info&id=".$pid;
				$lnk3="?mode=add&t=project_steps&id=".$pid;
				$lnk4="?mode=add&t=project_logs&id=".$pid;
			}					
			
			if($t=='proj_info' || $t=='' ){
				$active="active";
				$active1="active";
			}
			elseif($t=='upload_info'){
				$active="active";
				$active2="active";
			}
			elseif($t=='project_steps'){
				$active="active";
				$active3="active";
			}
			elseif($t=='project_logs'){
				$active="active";
				$active4="active";
			}
			else{
				
			}
			?>
			<ul class="nav nav-tabs" role="tablist1">
				<input type="hidden" name="lead_id" id="lead_id" value="<?=$lead_id?>">
				<li role="presentation" class="<?php echo $active1;?>"><a href="<?PHP echo $lnk1 ?>"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs">Project Info</span></a></li>
				<li role="presentation" class="<?php echo $active2;?>"><a href="<?PHP echo $lnk2 ?>"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Uploads</span></a></li>				
				<li role="presentation" class="<?php echo $active3;?>"><a href="<?PHP echo $lnk3 ?>"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Steps</span></a></li>				
				<li role="presentation" class="<?php echo $active4;?>"><a href="<?PHP echo $lnk4 ?>"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Logs</span></a></li>				
			</ul>		
			<!-- Tab panes -->
			<div class="tab-content" style="margin-top:0px;">
				<!--Tab 1-->
				<br>
				<div role="tabpanel" class="tab-pane <?php echo $active1;?>" id="proj_info">
					<div class="">
						<div class="form-group col-sm-3">
							<label for="cust_id" class="control-label">Select Customer</label>
							<select class="form-control select2" name="cust_id" id="cust_id">
								<option value="">Select Customer</option>
								<?php echo get_customer_list($cust_id);	?>
							</select>
							<div class="help-block with-errors"></div>
						</div>
						<div class="clearfix"></div>
						<?php if($cust_id){
							$custQry = $cms->db_query("SELECT email,phone,quotation_number FROM #_leads where id=$cust_id ");
							$custRes = $custQry->fetch_array();
							$showQuo = "display:block";
						}else{
							$showQuo = "display:none";
						}?>					
						<div class="form-group col-sm-3 show-email" style="<?=$showQuo?>">
							<label for="email" class="control-label">Email</label>
							<input type="text" name="email" value="<?=$custRes['email']?>" class="form-control" id="email" readonly>
						</div>
						<div class="form-group col-sm-3 show-phone" style="<?=$showQuo?>">
							<label for="phone" class="control-label">Phone</label>
							<input type="text" name="phone" value="<?=$custRes['phone']?>" class="form-control" id="phone" readonly>
						</div>
						<div class="form-group col-sm-3 show-quotnum" style="<?=$showQuo?>">
							<label for="quotation_number" class="control-label">Quotation Number</label>
							<input type="text" name="quotation_number" value="<?=$custRes['quotation_number']?>" class="form-control" id="quotation_number" readonly>
						</div>	
						<div class="form-group col-sm-3 show-quotnum" style="<?=$showQuo?>">
							<label for="project_name" class="control-label">Project Number</label>
							<input type="text" name="project_name" value="<?=$project_name?>" class="form-control" id="project_name" data-fv-regexp="true" data-error="Please enter valid Name" readonly>
							<input type="hidden" name="sale_rep_id" value="<?=$sale_rep_id?>" class="form-control" id="sale_rep_id">
							<div class="help-block with-errors"></div>
						</div>	
						<div class="clearfix"></div>
						<div class="form-group col-sm-6">
							<!--<input type="checkbox" name="same_address" id="same_address" value="1" <?=$same_address?'checked':''?>> Installation address same as customer address-->
							
							<div class="checkbox checkbox-success">
								<input type="checkbox" name="same_address" id="same_address" value="1" <?=$same_address?'checked':''?>>
								<label for="same_address">Installation address same as customer address</label>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="fill-address">
							<div class="form-group col-sm-5">
								<label for="project_address" class="control-label">Address*</label>
								<input name="project_address" class="form-control" id="project_address" value="<?=$project_address?>" required>
								<div class="help-block with-errors"></div>
							</div>
							<div class="form-group col-sm-3">
								<label for="project_city" class="control-label">City</label>
								<input type="text" name="project_city" value="<?=$project_city?>" class="form-control" id="project_city" data-fv-regexp="true" data-error="Please enter value in correct format.">
								<div class="help-block with-errors"></div>
							</div>
							<div class="form-group col-sm-2">
								<label for="project_country" class="control-label">Country</label>
								<input type="text" name="project_country" value="<?=$project_country?$project_country:'Sweden'?>" class="form-control" id="project_country" data-fv-regexp="true" data-error="Please enter value in correct format.">
								<div class="help-block with-errors"></div>
							</div>
							<div class="form-group col-sm-2">
								<label for="project_postal_code" class="control-label">Postal Code</label>
								<input type="text" name="project_postal_code" value="<?=$project_postal_code?>" class="form-control" id="project_postal_code">
								<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
					<hr>
					<input type="hidden" name="project_id" value="<?=$pid?>">
					
					<div class="col-sm-12"><h2 class="form-section-heading">Roof Details -</h2></div>
					<div class="form-group col-sm-3">
						<label for="roof_material" class="control-label" style="<?=$sales_field_color?>">Roof Type*</label>
						<input type="text" name="roof_material" value="<?=$roof_material?>" class="form-control" id="roof_material" readonly>
						<div class="help-block with-errors"></div>
					</div>	
					<div class="form-group col-sm-2">
						<label for="number_of_roof" class="control-label" style="<?=$sales_field_color?>">Number of Roofs*</label>
						<input type="number" name="number_of_roof" value="<?=$number_of_roof?>" min="0" class="form-control" id="number_of_roof" data-fv-regexp="true" data-error="Please enter valid Name" required>
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group col-sm-2">
						<label class="control-label" style="<?=$sales_field_color?>">Råspant</label>
						<div class="radio-list">
							<label class="radio-inline p-0">
								<div class="radio radio-info">
									<input type="radio" name="raw_mortgage" id="raw_mortgage1" value="1" data-error="Please enter value in correct format" <?=$raw_mortgage==1?'checked':''?>>
									<label for="raw_mortgage1">Yes</label>
								</div>
							</label>
							<label class="radio-inline p-0">
								<div class="radio radio-info">
									<input type="radio" name="raw_mortgage" id="raw_mortgage2" value="0" data-error="Please enter value in correct format" <?=$raw_mortgage==0?'checked':''?>>
									<label for="raw_mortgage2">No</label>
								</div>
							</label>
						</div>
						<div class="help-block with-errors"></div>
					</div>	
					<div class="form-group col-sm-2">
						<label class="control-label" style="<?=$sales_field_color?>">Kortling</label>
						<div class="radio-list">
							<label class="radio-inline p-0">
								<div class="radio radio-info">
									<input type="radio" name="kortling" id="kortling1" value="1" data-error="Please enter value in correct format" <?=$kortling==1?'checked':''?>>
									<label for="kortling21">Yes</label>
								</div>
							</label>
							<label class="radio-inline p-0">
								<div class="radio radio-info">
									<input type="radio" name="kortling" id="kortling2" value="0" data-error="Please enter value in correct format" <?=$kortling==0?'checked':''?>>
									<label for="kortling2">No</label>
								</div>
							</label>
						</div>
						<div class="help-block with-errors"></div>
					</div>
					<div class="clearfix"></div>
					<hr>
					<div class="col-sm-12"><h2 class="form-section-heading">Site Placements -</h2></div>
					<div class="form-group col-sm-4">
						<label for="facade_meter_location" class="control-label" style="<?=$sales_field_color?>">Fasadmätare location</label>
						<input type="text" name="facade_meter_location" value="<?=$facade_meter_location?>" class="form-control" id="facade_meter_location" data-fv-regexp="true" data-error="Please enter valid Name">
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group col-sm-4">
						<label for="elcentral_location" class="control-label" style="<?=$sales_field_color?>">Elcentral(er) location</label>
						<input type="text" name="elcentral_location" value="<?=$elcentral_location?>" class="form-control" id="elcentral_location" data-fv-regexp="true" data-error="Please enter valid Name">
						<div class="help-block with-errors"></div>
					</div>		
					<div class="clearfix"></div>
					<div class="form-group col-sm-3">
						<label for="inverter_placement" class="control-label" style="<?=$sales_field_color?>">Placement of Inverter</label>
						<input type="text" name="inverter_placement" value="<?=$inverter_placement?>" class="form-control" id="inverter_placement" data-fv-regexp="true" data-error="Please enter valid Name">
						<div class="help-block with-errors"></div>
					</div>	
					<div class="form-group col-sm-3">
						<label for="battery_placement" class="control-label" style="<?=$sales_field_color?>">Placement of battery</label>
						<input type="text" name="battery_placement" value="<?=$battery_placement?>" class="form-control" id="battery_placement" data-fv-regexp="true" data-error="Please enter valid Name">
						<div class="help-block with-errors"></div>
					</div>	
					<div class="form-group col-sm-3">
						<label for="ev_placement" class="control-label" style="<?=$sales_field_color?>">Placement of EV</label>
						<input type="text" name="ev_placement" value="<?=$ev_placement?>" class="form-control" id="ev_placement" data-fv-regexp="true" data-error="Please enter valid Name">
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group col-sm-3">
						<label class="control-label" style="<?=$sales_field_color?>">Digging of ground for cabling</label>
						<div class="radio-list">
							<label class="radio-inline p-0">
								<div class="radio radio-info">
									<input type="radio" name="digging_ground" id="digging_ground1" value="1" data-error="Please enter value in correct format" <?=$digging_ground==1?'checked':''?>>
									<label for="digging_ground1">Yes</label>
								</div>
							</label>
							<label class="radio-inline p-0">
								<div class="radio radio-info">
									<input type="radio" name="digging_ground" id="digging_ground2" value="0" data-error="Please enter value in correct format" <?=$digging_ground==0?'checked':''?>>
									<label for="digging_ground2">No</label>
								</div>
							</label>
						</div>
						<div class="help-block with-errors"></div>
					</div>	
					<div class="form-group col-sm-4">
						<label for="site_images" class="control-label">Upload Site Images (size should be less than 2MB)</label>						
						<input type="file" name="site_images[]" id="site_images" class="form-control" multiple />
						<div class="help-block with-errors"></div>
					</div>
					<div class="clearfix"></div>
					<div class="form-group col-sm-6">
						<?php if($pid){
						$siteImgQry = $cms->db_query("SELECT id, project_id, site_images FROM #_reports where project_id=$pid ");
						if($siteImgQry->num_rows>0){
						echo '<ul>';
						while($siteImgRes = $siteImgQry->fetch_array()){
							if($siteImgRes['site_images']!=''){ ?>
							<li id="<?=$siteImgRes['id']?>"><?=$siteImgRes['site_images']?> &nbsp;<a href="<?=SITE_PATH?>uploaded_files/reports/<?=$siteImgRes['site_images']?>" download>View</a> &nbsp; <a href="javascript:void(0)" class="remove_icon" onClick="remove_file('<?=$siteImgRes['id']?>','<?=$siteImgRes['site_images']?>')" data-toggle="tooltip" data-original-title="Delete File"><img src="<?=SITE_PATH_ADM?>images/close-btn.png"></a></li>
							<?php }
						}
						echo '</ul>';
						} }
						?>
					</div>
					<div class="clearfix"></div>
					<hr>
					<div class="col-sm-12"><h2 class="form-section-heading">Other Info -</h2></div>
					<div class="form-group col-sm-3">
						<label for="facade_meter_location" class="control-label">Ö-drift</label>
						<div class="radio-list">
							<label class="radio-inline p-0">
								<div class="radio radio-info">
									<input type="radio" name="island_operation" id="island_operation1" value="Ja" data-error="Please enter value in correct format" <?=$island_operation=='Ja'?'checked':''?>>
									<label for="island_operation1">Ja</label>
								</div>
							</label>
							<label class="radio-inline p-0">
								<div class="radio radio-info">
									<input type="radio" name="island_operation" id="island_operation2" value="Nej" data-error="Please enter value in correct format" <?=$island_operation=='Nej'?'checked':''?>>
									<label for="island_operation2">Nej</label>
								</div>
							</label>
						</div>
					</div>
					<div class="form-group col-sm-3">
						<label for="short_circuit" class="control-label">Kortslutningsström</label>
						<input type="text" name="short_circuit" value="<?=$short_circuit?>" class="form-control" id="short_circuit" readonly>
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group col-sm-3">
						<label for="system_size" class="control-label">Storleken på system (kWp)</label>
						<input type="text" name="system_size" value="<?=$system_size?>" class="form-control" id="system_size" readonly>
					</div>
					<div class="form-group col-sm-3">
						<label for="effektfaktor" class="control-label">Effektfaktor</label>
						<input type="text" name="effektfaktor" value="<?=$effektfaktor?>" class="form-control" id="effektfaktor" readonly>
					</div>
					<div class="clearfix"></div>
					<?php if($ev_charger){
						$showcharger = "";
					}else{
						$showcharger = "display:none";
					}?>
					<div class="form-group col-sm-3" id="show_ev_charger" style="<?=$showcharger?>">
						<label for="ev_charger" class="control-label">EV Charger</label>
						<input type="text" name="ev_charger" value="<?=$ev_charger?>" class="form-control" id="ev_charger" readonly>
					</div>
					<div class="form-group col-sm-1" id="show_ev_quantity" style="<?=$showcharger?>">
						<label for="ev_quantity" class="control-label">Qunatity</label>
						<input type="text" name="ev_quantity" value="<?=$ev_quantity?>" class="form-control" id="ev_quantity" readonly>
					</div>
					<div class="clearfix"></div>
					<hr>					
					<div class="col-sm-12"><h2 class="form-section-heading">Distance -</h2></div>
					<div class="form-group col-sm-4">
						<label for="distance_panel_inverter" class="control-label" style="<?=$sales_field_color?>">between panels and inverter</label>
						<input type="text" name="distance_panel_inverter" value="<?=$distance_panel_inverter?>" class="form-control" id="distance_panel_inverter" data-fv-regexp="true" data-error="Please enter valid Name">
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group col-sm-4">
						<label for="distance_inverter_connection_point" class="control-label" style="<?=$sales_field_color?>">between inverter and connection point (AC)</label>
						<input type="text" name="distance_inverter_connection_point" value="<?=$distance_inverter_connection_point?>" class="form-control" id="distance_inverter_connection_point" data-fv-regexp="true" data-error="Please enter valid Name">
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group col-sm-4">
						<label for="distance_ev_connection_point" class="control-label" style="<?=$sales_field_color?>">between EV and connection point</label>
						<input type="text" name="distance_ev_connection_point" value="<?=$distance_ev_connection_point?>" class="form-control" id="distance_ev_connection_point" data-fv-regexp="true" data-error="Please enter valid Name">
						<div class="help-block with-errors"></div>
					</div>			
					<div class="clearfix"></div>
					<hr>
					<div class="col-sm-12"><h2 class="form-section-heading">Grid Details -</h2></div>
					<div class="form-group col-sm-4">
						<label for="grid_provider" class="control-label" style="<?=$sales_field_color?>">Grid provider</label>
						<input type="text" name="grid_provider" value="<?=$grid_provider?>" class="form-control" id="grid_provider" data-fv-regexp="true" data-error="Please enter valid Name">
						<div class="help-block with-errors"></div>
					</div>			
					<div class="form-group col-sm-4">
						<label for="plant_id" class="control-label" style="<?=$sales_field_color?>">AnläggningsID</label>
						<input type="text" name="plant_id" value="<?=$plant_id?>" class="form-control" id="plant_id" data-fv-regexp="true" data-error="Please enter valid Name">
						<div class="help-block with-errors"></div>
					</div>	
					<div class="form-group col-sm-4">
						<label for="pre_registration_date" class="control-label" style="<?=$sales_field_color?>">Föranmälan date</label>
						<div class="input-group">
							<?php 
							if(!empty($pre_registration_date) AND $pre_registration_date!='0000-00-00'){
								$pre_registration_date = date("m/d/Y", strtotime($pre_registration_date));
							}else{
								$pre_registration_date ="";
							}
							?>
							<input type="text" class="form-control" name="pre_registration_date" id="pre_registration_date"  value="<?=$pre_registration_date?>">
							<span class="input-group-addon"><i class="icon-calender"></i></span> 
						</div>
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group col-sm-4">
						<label for="main_fuse" class="control-label">Huvudsäkring</label>
						<input type="text" name="main_fuse" value="<?=$main_fuse?>" class="form-control" id="main_fuse" data-fv-regexp="true" data-error="Please enter valid Name">
						<div class="help-block with-errors"></div>
					</div>		
					<div class="clearfix"></div>
					<hr>
					<div class="col-sm-12"><h2 class="form-section-heading">Acknowledgement Details -</h2></div>
					<div class="form-group col-sm-4">
						<label for="acknowledgement" class="control-label" style="<?=$sales_field_color?>">Acknowledgement to start installation</label>
						<div class="radio-list">
							<label class="radio-inline p-0">
								<div class="radio radio-info">
									<input type="radio" name="acknowledgement" id="acknowledgement1" value="1" data-error="Please enter value in correct format" <?=$acknowledgement==1?'checked':''?>>
									<label for="acknowledgement1">Yes</label>
								</div>
							</label>
							<label class="radio-inline p-0">
								<div class="radio radio-info">
									<input type="radio" name="acknowledgement" id="acknowledgement2" value="0" data-error="Please enter value in correct format" <?=$acknowledgement==0?'checked':''?>>
									<label for="acknowledgement2">No</label>
								</div>
							</label>
						</div>
					</div>
					<div class="form-group col-sm-4">
						<label for="acknowledgement_files" class="control-label" style="<?=$sales_field_color?>">Upload Acknowledgement (size should be less than 2MB)</label>
						<input type="file" name="acknowledgement_files[]" id="acknowledgement_files" class="form-control" multiple />
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group col-sm-4">
						<?php if($pid){
						$siteImgQry = $cms->db_query("SELECT id, project_id, acknowledgement_files FROM #_reports where project_id=$pid ");
						if($siteImgQry->num_rows>0){
						echo '<ul>';
						while($siteImgRes = $siteImgQry->fetch_array()){
							if($siteImgRes['acknowledgement_files']!=''){ ?>
							<li id="<?=$siteImgRes['id']?>"><?=$siteImgRes['acknowledgement_files']?> &nbsp;<a href="<?=SITE_PATH?>uploaded_files/reports/<?=$siteImgRes['acknowledgement_files']?>" download>View</a> &nbsp; <a href="javascript:void(0)" class="remove_icon" onClick="remove_file('<?=$siteImgRes['id']?>','<?=$siteImgRes['acknowledgement_files']?>')" data-toggle="tooltip" data-original-title="Delete File"><img src="<?=SITE_PATH_ADM?>images/close-btn.png"></a></li>
							<?php }
						}
						echo '</ul>';
						} }
						?>
					</div>					
					<div class="clearfix"></div>
					<hr>
					<div class="col-sm-12"><h2 class="form-section-heading">Panel installation vendor</h2></div>
					<div class="form-group col-sm-4">
						<label for="panel_vendor_id" class="control-label" style="<?=$mgr_field_color?>">Vendor</label>
						<select class="form-control select2" name="panel_vendor_id" id="panel_vendor_id">
							<?php  print "<option value=''>Select Vendor</option>";
								echo get_vendor_list($panel_vendor_id);
							?>
						</select>
					</div>
					<div class="form-group col-sm-4">
						<label for="panel_resource" class="control-label" style="<?=$mgr_field_color?>">Resource names</label>
						<input type="text" name="panel_resource" value="<?=$panel_resource?>" class="form-control" id="panel_resource" data-fv-regexp="true" data-error="Please enter valid Name">
						<div class="help-block with-errors"></div>
					</div>
					<div class="clearfix"></div>
					<div class="form-group col-sm-6">
						<label for="panel_planned_start_date" class="control-label" style="<?=$mgr_field_color?>">Panel installation planned date</label>
						<div class="input-daterange input-group" id="date-range">
							<input type="text" class="form-control" name="panel_planned_start_date" id="planned_start_date" value="<?=$panel_planned_start_date?>" placeholder="Date From">
							<span class="input-group-addon bg-info b-0 text-white">to</span>
							<input type="text" class="form-control" name="panel_planned_end_date" id="planned_end_date" value="<?=$panel_planned_end_date?>" placeholder="Date To">
						</div>
					</div>			
					<div class="form-group col-sm-6">
						<label for="panel_finish_start_date" class="control-label" style="<?=$mgr_field_color?>">Panel installation finish date</label>
						<div class="input-daterange input-group" id="date-range">
							<input type="text" class="form-control" name="panel_finish_start_date" id="finish_start_date" value="<?=$panel_finish_start_date?>" placeholder="Date From">
							<span class="input-group-addon bg-info b-0 text-white">to</span>
							<input type="text" class="form-control" name="panel_finish_end_date" id="finish_end_date" value="<?=$panel_finish_end_date?>" placeholder="Date TO">
						</div>
					</div>			
					<div class="clearfix"></div>
					<hr>
					<div class="col-sm-12"><h2 class="form-section-heading">Electrical installation vendor</h2></div>
					<div class="form-group col-sm-4">
						<label for="electrical_vendor_id" class="control-label" style="<?=$mgr_field_color?>">Vendor</label>
						<select class="form-control select2" name="electrical_vendor_id" id="electrical_vendor_id">
							<?php  print "<option value=''>Select Vendor</option>";
								echo get_vendor_list($electrical_vendor_id);
							?>
						</select>
					</div>
					<div class="form-group col-sm-4">
						<label for="electrical_resource" class="control-label" style="<?=$mgr_field_color?>">Resource names</label>
						<input type="text" name="electrical_resource" value="<?=$electrical_resource?>" class="form-control" id="electrical_resource" data-fv-regexp="true" data-error="Please enter valid Name">
						<div class="help-block with-errors"></div>
					</div>
					<div class="clearfix"></div>
					<hr>
					<div class="form-group col-sm-6">
						<label for="electrical_planned_start_date" class="control-label" style="<?=$mgr_field_color?>">Electrical installation planned date</label>
						<div class="input-daterange input-group" id="date-range">
							<input type="text" class="form-control" name="electrical_planned_start_date" id="electrical_planned_start_date" value="<?=$electrical_planned_start_date?>" placeholder="Date From">
							<span class="input-group-addon bg-info b-0 text-white">to</span>
							<input type="text" class="form-control" name="electrical_planned_end_date" id="electrical_planned_end_date" value="<?=$electrical_planned_end_date?>" placeholder="Date To">
						</div>
					</div>
					<div class="form-group col-sm-6">
						<label for="electrical_finish_start_date" class="control-label" style="<?=$mgr_field_color?>">Electrical installation finish date</label>
						<div class="input-daterange input-group" id="date-range">
							<input type="text" class="form-control" name="electrical_finish_start_date" id="electrical_finish_start_date" value="<?=$electrical_finish_start_date?>" placeholder="Date From">
							<span class="input-group-addon bg-info b-0 text-white">to</span>
							<input type="text" class="form-control" name="electrical_finish_end_date" id="electrical_finish_end_date" value="<?=$electrical_finish_end_date?>" placeholder="Date to">
						</div>
					</div>
					<div class="clearfix"></div>
					<hr>
					<div class="col-sm-12"><h2 class="form-section-heading">Reports</h2></div>
					<div class="form-group col-sm-6">
						<label for="file" class="control-label">MMS report / reports (can upload multiple, size should be less than 2MB)</label>
						
						<input type="file" name="mms_report[]" id="mms_report" class="" data-max-file-size="1M" <?php if($mms_report AND file_exists(FILES_PATH.'reports/'.$mms_report)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/reports/<?=$mms_report?>" <?php }else{ ?>  <?php } ?> multiple />
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group col-sm-6">
						<label for="file" class="control-label">System report (can upload multiple, size should be less than 2MB)</label>
						<input type="file" name="system_report[]" id="system_report" class="" data-max-file-size="1M" <?php if($system_report AND file_exists(FILES_PATH.'reports/'.$system_report)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/reports/<?=$system_report?>" <?php }else{ ?>  <?php } ?> multiple />
						<div class="help-block with-errors"></div>
					</div>
					<div class="clearfix"></div>
					<div class="form-group col-sm-6">
						<?php if($pid){
						$siteImgQry = $cms->db_query("SELECT id, project_id, mms_report FROM #_reports where project_id=$pid ");
						if($siteImgQry->num_rows>0){
						echo '<ul>';
						while($siteImgRes = $siteImgQry->fetch_array()){
							if($siteImgRes['mms_report']!=''){ ?>
							<li id="<?=$siteImgRes['id']?>"><?=$siteImgRes['mms_report']?> &nbsp;<a href="<?=SITE_PATH?>uploaded_files/reports/<?=$siteImgRes['mms_report']?>" download>View</a> &nbsp; <a href="javascript:void(0)" class="remove_icon" onClick="remove_file('<?=$siteImgRes['id']?>','<?=$siteImgRes['mms_report']?>')" data-toggle="tooltip" data-original-title="Delete File"><img src="<?=SITE_PATH_ADM?>images/close-btn.png"></a></li>
							<?php }
						}
						echo '</ul>';
						} }
						?>
					</div>
					<div class="form-group col-sm-6">
						<?php if($pid){
						$siteImgQry = $cms->db_query("SELECT id, project_id, system_report FROM #_reports where project_id=$pid ");
						if($siteImgQry->num_rows>0){
						echo '<ul>';
						while($siteImgRes = $siteImgQry->fetch_array()){
							if($siteImgRes['system_report']!=''){ ?>
							<li id="<?=$siteImgRes['id']?>"><?=$siteImgRes['system_report']?> &nbsp;<a href="<?=SITE_PATH?>uploaded_files/reports/<?=$siteImgRes['system_report']?>" download>View</a> &nbsp; <a href="javascript:void(0)" class="remove_icon" onClick="remove_file('<?=$siteImgRes['id']?>','<?=$siteImgRes['system_report']?>')" data-toggle="tooltip" data-original-title="Delete File"><img src="<?=SITE_PATH_ADM?>images/close-btn.png"></a></li>
							<?php }
						}
						echo '</ul>';
						} }
						?>
					</div>				
					<div class="clearfix"></div>			
					<div class="form-group col-sm-12">
						<?php if((in_array($act_arr[1],$_SESSION["url"][$Sys_Gl_module_id]) || !in_array($act_arr[3],$_SESSION["url"][$Sys_Gl_module_id])) || $_SESSION["ses_adm_id"]==1){?>
						<button type="submit" class="btn add-submit-btn" id="check_submit">Submit</button>
						<?php } ?>
						<button type="button" onclick="history.go(-1)" class="btn back-btn">Back</button>
					</div>
					<div class="clearfix"></div>
				</div>
				
				<div role="tabpanel" class="tab-pane <?php echo $active2;?>" id="upload_info">
					<?php $fileQry = $cms->db_query("SELECT * FROM #_uploads where lead_id=$lead_id ");
					if($fileQry->num_rows>0){
						if($uploaded_files!=''){
							$uploaded_filesArr = explode(',',$uploaded_files);
						} ?>
					<div class="form-group col-sm-6">
						<h4><b>Select file to add in project</b></h4>
						<ul class="uploaded-file-list">
							<?php while($fileRes = $fileQry->fetch_array()){
								if(!in_array($fileRes['id'],$uploaded_filesArr)){
							?>
							<li id="<?=$fileRes['id']?>"><span class=""><input name="uploaded_files[]" class="uploaded_files" type="checkbox" value="<?=$fileRes['id']?>"></span> <b><?=$fileRes['file_title']?$fileRes['file_title'].' - ':''?></b> <?=$fileRes['file_upload']?> <a href="<?=SITE_PATH?>uploaded_files/uploads/<?=$fileRes['file_upload']?>" download>View</a></li>						
							<?php } }	?>
						</ul>
						<hr>
						<?php if($uploaded_files!=''){
							$uploaded_filesArr = explode(',',$uploaded_files);
						?>
						<h4><b>Added file in project</b></h4>
						<input type="hidden" name="added_files" id="added_files" value="<?=$uploaded_files?>">
						<ul class="uploaded-file-list">
							<?php foreach($uploaded_filesArr as $imgId){
								$fileQry = $cms->db_query("SELECT * FROM #_uploads where id=$imgId ");
								$fileRes = $fileQry->fetch_array();
							?>
							<li id="<?=$fileRes['id']?>"><b><?=$fileRes['file_title']?$fileRes['file_title'].' - ':''?></b> <?=$fileRes['file_upload']?> <a href="javascript:void(0)" class="remove_icon" onClick="remove_uploadfile('<?=$fileRes['id']?>')" data-toggle="tooltip" data-original-title="Delete File"><img src="<?=SITE_PATH_ADM?>images/close-btn.png"></a> <a href="<?=SITE_PATH?>uploaded_files/uploads/<?=$fileRes['file_upload']?>" download>View</a></li>						
							<?php }	?>
						</ul>	
						<?php } ?>
					</div>
					<div class="form-group col-sm-12">
						<?php if((in_array($act_arr[1],$_SESSION["url"][$Sys_Gl_module_id]) || !in_array($act_arr[3],$_SESSION["url"][$Sys_Gl_module_id])) || $_SESSION["ses_adm_id"]==1){?>
						<button type="submit" class="btn add-submit-btn" id="check_submit">Add File</button>
						<?php } ?>
						<button type="button" onclick="history.go(-1)" class="btn back-btn">Back</button>
					</div>
					<div class="clearfix"></div>					
					<?php }else{ ?>
					<div class="form-group col-sm-12">
						<h2>No files uploaded</h2>
					</div>
					<div class="clearfix"></div>
					<?php } ?>
				</div>
				
				<div role="tabpanel" class="tab-pane <?php echo $active3;?>" id="project_steps">
					<link rel="stylesheet" href="<?=SITE_PATH_ADM?>tabs/tabs.css" type="text/css" media="screen, projection"/>

					<script type="text/javascript" src="<?=SITE_PATH_ADM?>tabs/jquery-1.3.2.min.js"></script>
					<script type="text/javascript" src="<?=SITE_PATH_ADM?>tabs/jquery-ui-1.7.custom.min.js"></script>
					<div id="page-wrap">		
						<div id="tabs">						
							<ul style="display:none">
								<?php $projectStepQry = $cms->db_query("select step_num, step_title from #_project_steps where status=1 AND is_deleted=0 group by step_num order by step_num ");
								$i=1;
								while($projectStepArr = $projectStepQry->fetch_array()){ ?>
								<li><a href="#fragment-<?=$projectStepArr['step_num']?>">1</a></li>
								<?php } ?>
							</ul>
							
							<?php $projectStepContentQry = $cms->db_query("select step_num, step_title from #_project_steps where status=1 AND is_deleted=0 group by step_num order by step_num ");
							$j=1;
							while($projectStepContentArr = $projectStepContentQry->fetch_array()){ ?>
							<div id="fragment-<?=$projectStepContentArr['step_num']?>" class="ui-tabs-panel <?=$j!=1?'ui-tabs-hide':''?>">
								<h3 class="step-title"><?=$projectStepContentArr['step_title']?></h3>
								<?php $fieldQry = $cms->db_query("select *, id as fid from #_project_steps where step_num=".$projectStepContentArr['step_num']." AND is_deleted=0 ");
								while($fieldRes = $fieldQry->fetch_array()){
								echo '<h3>'.$fieldRes['field_label'].'</h3>';	
								if($fieldRes['field_type']=='file'){	
								?>
								<div class="">
									<img src="<?=SITE_PATH?>assets/images/pdf-icons/pdf-map.png" width="300">
								</div>
								<?php }else if($fieldRes['field_type']=='Capture Video'){ ?>
								<div class="">
									<img src="<?=SITE_PATH?>assets/images/pdf-icons/pdf-map.png" width="300">
								</div>	
								<?php }else if($fieldRes['field_type']=='checkbox-group'){
									$typeShow = '<span class="field-icon"><i class="fa fa-check-square"></i></span> Checkbox';
								}
								else if($fieldRes['field_type']=='Image Capture'){
									$typeShow = '<span class="field-icon"><i class="fa fa-image"></i></span> Image Capture';
								}
								else if($fieldRes['field_type']=='text'){
									$typeShow = '<span class="field-icon"><i class="fa fa-folder"></i></span> Text Field';
								}
								else if($fieldRes['field_type']=='textarea'){
									$typeShow = '<span class="field-icon"><i class="fa fa-sticky-note"></i></span> Text Area';
								}
								else{
									$typeShow = '';
								} 
								echo '<div class="">'.$typeShow.'</div>'; } ?>
							</div>
							<?php $j++; } ?>							
						</div>		
					</div>
					<div class="clearfix"></div>
				</div>
				
				<div role="tabpanel" class="tab-pane <?php echo $active4;?>" id="project_logs">
					<H3>Show All logs</h3>
					<div class="clearfix"></div>
				</div>
			</div>		
        </div>
	</div>
</div>
<!-- /.row -->
<script type="text/javascript">
$(function() {
	var $tabs = $('#tabs').tabs();
	$(".ui-tabs-panel").each(function(i){
		var totalSize = $(".ui-tabs-panel").size() - 1;
		if (i != totalSize) {
			next = i + 2;
			$(this).append("<a href='#' class='next-tab mover' rel='" + next + "'>Next Step &#187;</a>");
		}
		if (i != 0) {
			prev = i;
			$(this).append("<a href='#' class='prev-tab mover' rel='" + prev + "'>&#171; Prev Step</a>");
		}
	});

	$('.next-tab, .prev-tab').click(function() { 
		$tabs.tabs('select', $(this).attr("rel"));
		return false;
	});
});
</script>
<script>
$('#cust_id').change(function() {
    var custID = $(this).val();
	$.ajax({
		url:"<?=SITE_PATH_ADM.CPAGE?>/getCustomerDetails.php",
		data:"custID="+custID,
		method:"post",
		beforeSend:function(){
			$(".admin-ajax-loader").show();
		},
		success:function(result){
			$(".admin-ajax-loader").hide();
			var res = result.split("|");
			if(res[0]!='' && res[1]!='' && res[2]!=''){
				$(".admin-ajax-loader").hide();
				$('.show-quotnum').show();
				$('.show-email').show();
				$('.show-phone').show();
				$('#quotation_number').val(res[0]);
				$('#project_name').val(res[0]);
				$('#email').val(res[1]);
				$('#phone').val(res[2]);
				$('#lead_id').val(res[3]);
				$('#system_size').val(res[4]);
				$('#roof_material').val(res[5]);
				$('#effektfaktor').val(res[7]);
				$('#short_circuit').val(res[8]);
				$('#sale_rep_id').val(res[9]);
				if(res[6]!=''){
					$('#ev_charger').val(res[6]);
					$('#ev_quantity').val(1);
				}else{					
					$('#show_ev_charger').hide();
					$('#show_ev_quantity').hide();
				}
			}else{
				$('.show-quotnum').hide();
				$('.show-email').hide();
				$('.show-phone').hide();
			}
		}
	})
});
</script>
<script>
$("#same_address").click(function () {
	if ($(this).is(":checked")) {
		var cust_id = $('#cust_id').val();
		$.ajax({
			url:"<?=SITE_PATH_ADM.CPAGE?>/ajaxfillAddress.php",
			data:"cust_id="+cust_id,
			method:"post",
			beforeSend:function(){
				$(".admin-ajax-loader").show();
			},
			success:function(result){
				$(".admin-ajax-loader").hide();
				if(result!='' && result!=0){
					$(".loader").hide();
					$('.fill-address').html(result);
				}else{
					$("#project_address").val();
					$("#project_city").val();
					$("#project_country").val();
					$("#project_postal_code").val();
				}
			}
		})
	} else {
		$("#project_address").val('');
		$("#project_city").val('');
		$("#project_country").val('');
		$("#project_postal_code").val('');
	}
});
</script>

<script>
function remove_file(id,name){
	if (confirm("Are you sure to delete?")) {
		$.ajax({
			type:"post",
			url: "<?=SITE_PATH_ADM.CPAGE?>/remove_file.php?id="+id+"&name="+name,
			success:function(result){
				if(parseInt(result)=='1'){
					$("#"+id).hide();
					//location.reload();
				}
				else{
					alert("Something went wrong.Pleas try again.")
				}
			}
		})
	}
}	
</script>

<script>
function remove_uploadfile(id){
	if (confirm("Are you sure to delete?")) {
		var added_files = $("#added_files").val();
		var projId = "<?=$pid?>";
		$.ajax({
			type:"post",
			url: "<?=SITE_PATH_ADM.CPAGE?>/remove_uploadfile.php",
			data: "id="+id+"&added_files="+added_files+"&projId="+projId,
			success:function(result){
				if(parseInt(result)=='1'){
					$("#"+id).hide();
					location.reload();
				}
				else{
					alert("Something went wrong.Pleas try again.")
				}
			}
		})
	}
}	
</script>
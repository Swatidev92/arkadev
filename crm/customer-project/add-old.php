<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 
$pid = $_GET["id"];

if($action=='del-item'){
	$cms->db_query("Delete FROM #_installation_bom where id in ($itemid)");
	$adm->sessset('Record has been deleted', 'e');
	$cms->redir(SITE_PATH_ADM.CPAGE.'?mode=add&t=panel&id='.$pid, true);
	exit;
}
if($action=='del-itemE'){
	$cms->db_query("Delete FROM #_installation_bom where id in ($itemid)");
	$adm->sessset('Record has been deleted', 'e');
	$cms->redir(SITE_PATH_ADM.CPAGE.'?mode=add&t=electrical&id='.$pid, true);
	exit;
}

if(isset($_POST['update_electrical_items'])){
	//print_r($_POST);die;
	if($_POST['part_of_procurement']=='on'){
		$_POST['part_of_procurement'] = 1;
	}else{
		$_POST['part_of_procurement'] = 0;
	}
	if($_POST['deliver_by']==3){
		$_POST['project_site'] = $_POST['project_site'];
	}else{
		$_POST['project_site'] = '';
	}
	$cms->sqlquery("rs","installation_bom",$_POST,'id',$_POST['bom_id']);
	$cms->redir(SITE_PATH_ADM.CPAGE.'?mode=add&t=electrical&id='.$pid, true);	
}

if(isset($_POST['update_panel_items'])){
	//print_r($_POST);die;
	$_POST['item_id'] = $_POST['item_id_P'];
	$_POST['quantity'] = $_POST['quantity_P'];
	$_POST['unit'] = $_POST['unit_P'];
	$_POST['item_status'] = $_POST['item_status_P'];
	$_POST['delivery_address'] = $_POST['delivery_address_P'];
	$_POST['delivery_date'] = $_POST['delivery_date_P'];
	$_POST['comment'] = $_POST['comment_P'];
	$_POST['deliver_by'] = $_POST['deliver_by_P'];
	if($_POST['deliver_by_P']==3){
		$_POST['project_site'] = $_POST['project_site_P'];
	}else{
		$_POST['project_site'] = '';
	}
	if($_POST['part_of_procurementP']=='on'){
		$_POST['part_of_procurement'] = 1;
	}else{
		$_POST['part_of_procurement'] = 0;
	}
	$cms->sqlquery("rs","installation_bom",$_POST,'id',$_POST['bom_id_P']);
	$cms->redir(SITE_PATH_ADM.CPAGE.'?mode=add&t=panel&id='.$pid, true);	
}

if(isset($_POST['save_electrical_items'])){
	//print_r($_POST);die;
	$itemCount1 = count(array_filter($_POST['quantityE']));
	for($i=0; $i<$itemCount1; $i++){
		$itemArr['bom_type'] = $bomTypeArr[2];
		$itemArr['project_id'] = $pid;
		$itemArr['item_id'] = $_POST['item_idE'][$i];
		$itemArr['quantity'] = $_POST['quantityE'][$i];
		$itemArr['unit'] = $_POST['unitE'][$i];
		$itemArr['item_status'] = $_POST['item_statusE'][$i];
		$itemArr['delivery_address'] = $_POST['delivery_addressE'][$i];
		$itemArr['delivery_date'] = $_POST['delivery_dateE'][$i];
		$itemArr['comment'] = $_POST['commentE'][$i];
		$itemArr['part_of_procurement'] = $_POST['part_of_procurementE'][$i];
		$itemArr['deliver_by'] = $_POST['deliver_byE'][$i];
		if($_POST['deliver_byE'][$i]==3){
			$itemArr['project_site'] = $_POST['project_siteE'][$i];
		}else{
			$_POST['project_site'] = '';
		}
		$cms->sqlquery("rs","installation_bom",$itemArr);
	}
}
if(isset($_POST['save_items'])){
	//print_r($_POST);die;
	$itemCount = count(array_filter($_POST['quantityP']));
	for($i=0; $i<$itemCount; $i++){
		$itemArr['bom_type'] = $bomTypeArr[1];
		$itemArr['project_id'] = $pid;
		$itemArr['item_id'] = $_POST['item_idP'][$i];
		$itemArr['quantity'] = $_POST['quantityP'][$i];
		$itemArr['unit'] = $_POST['unitP'][$i];
		$itemArr['item_status'] = $_POST['item_statusP'][$i];
		$itemArr['delivery_address'] = $_POST['delivery_addressP'][$i];
		$itemArr['delivery_date'] = $_POST['delivery_dateP'][$i];
		$itemArr['comment'] = $_POST['commentP'][$i];
		$itemArr['part_of_procurement'] = $_POST['part_of_procurementP'][$i];
		$itemArr['deliver_by'] = $_POST['deliver_byP'][$i];
		if($_POST['deliver_byP'][$i]==3){
			$itemArr['project_site'] = $_POST['project_siteP'][$i];
		}else{
			$_POST['project_site'] = '';
		}
		
		$cms->sqlquery("rs","installation_bom",$itemArr);
	}
}

if($cms->is_post_back()){ 
	//print_r($_POST);die;
		
	$_POST['modified'] = date("Y-m-d h:i:s");
	
	/*if($_FILES["site_image"]["name"]){
		$_POST["site_image"] = uploadImage("site_image","site-image");
	}*/
	
	
	if($pid){
		
		/*$invoice_Arr = array("report_no"=>$pid);
		$name  = generateReport($invoice_Arr);*/
		
		if($_FILES["acknowledgement_file"]["name"]){
			$_POST["acknowledgement_file"] = uploadFile("acknowledgement_file","reports");
		}
		$uids =  $pid;
		$cms->sqlquery("rs","customer_project",$_POST,'id',$pid);
		
		
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
		$adm->sessset('Record has been updated', 's');
	} else { 
		$uids = $cms->sqlquery("rs","customer_project",$_POST);
		/*$invoice_Arr = array("report_no"=>$uids);
		$name  = generateReport($invoice_Arr);*/
		$adm->sessset('Record has been added', 's');
		$cms->redir(SITE_PATH_ADM.CPAGE.'?mode=add&id='.$uids, true);
	}	
	
	
	
	if($t=='proj_info' || $t==''){
		$cms->redir(SITE_PATH_ADM.CPAGE.'?mode=add&t=proj_info&id='.$pid, true);
	}
	elseif($t=='technical_info'){
		$cms->redir(SITE_PATH_ADM.CPAGE.'?mode=add&t=technical_info&id='.$pid, true);
	}
	elseif($t=='panel'){
		$cms->redir(SITE_PATH_ADM.CPAGE.'?mode=add&t=panel&id='.$pid, true);
	}
	elseif($t=='electrical'){
		$cms->redir(SITE_PATH_ADM.CPAGE.'?mode=add&t=electrical&id='.$pid, true);
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

if($_SESSION["ses_adm_id"]==1 || $_SESSION["ses_adm_type"]==2){ //sales 
	//$sales_field = 'border:3px solid #0ac500;';
	$sales_field_color = 'color: #0ac500;';
}else{
	//$sales_field = '';
	$sales_field_color = '';
} 
if($_SESSION["ses_adm_id"]==1 || $_SESSION["ses_adm_type"]==1){ //project manager 
	//$mgr_field = 'border:3px solid #ffa500;';
	$mgr_field_color = 'color: #ffa500;';
}else{
	//$mgr_field = '';
	$mgr_field_color = '';
} 

?>

<!-- .row -->
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
			<?php if($_SESSION["ses_adm_type"]==1 && $_SESSION["ses_adm_id"]!=1){?>
			<p class="text-right" style="<?=$mgr_field_color?>"><b>*Fill orange highlighted fields</b></p>
			<?php } ?>
			<?php if($_SESSION["ses_adm_type"]==2 && $_SESSION["ses_adm_id"]!=1){?>
			<p class="text-right" style="<?=$sales_field_color?>"><b>*Fill green highlighted fields</b></p>
			<?php } ?>
			<?php if($_SESSION["ses_adm_id"]==1){?>
			<style>
			ul li{
				display:inline-block;
			}
			ul input{
				border:0px;
			}
			.input-color {
				position: relative;
			}
			.input-color input {
				padding-left: 20px;
			}
			.input-color .color-box {
				width: 10px;
				height: 10px;
				display: inline-block;
				background-color: #ccc;
				position: absolute;
				left: 5px;
				top: 5px;
			}
			</style>
			<ul class="text-right">
				<li>
					<div class="input-color">
						<input type="text" value="For Sales Rep" />
						<div class="color-box" style="background-color: #0ac500;"></div>
					</div>
				</li>
				<li>
					<div class="input-color">
						<input type="text" value="For Project Manager" />
						<div class="color-box" style="background-color: #ffa500;"></div>
					</div>
				</li>
			</ul>
			<?php } ?>
			<?php
			$t=$_REQUEST["t"];
			
			$lnk1="#";
			$lnk2="#";
			$lnk3="#";
			$lnk4="#";
			$lnk5="#";						
			$lnk6="#";
			if($pid>0){
				$lnk1="?mode=add&t=proj_info&id=".$pid;
				$lnk2="?mode=add&t=technical_info&id=".$pid;
				$lnk3="?mode=add&t=panel&id=".$pid;
				$lnk4="?mode=add&t=electrical&id=".$pid;
				$lnk5="?mode=add&t=process&id=".$pid;
				$lnk6="?mode=add&t=project_status&id=".$pid;
			}					
			
			if($t=='proj_info' || $t=='' ){
				$active="active";
				$active1="active";
			}
			elseif($t=='technical_info'){
				$active="active";
				$active2="active";
			}
			elseif($t=='panel'){
				$active="active";
				$active3="active";
			}
			elseif($t=='electrical'){
				$active="active";
				$active4="active";
			}
			elseif($t=='process'){
				$active="active";
				$active5="active";
			}
			elseif($t=='project_status'){
				$active="active";
				$active6="active";
			}
			?>
			<ul class="nav nav-tabs" role="tablist1">
				<input type="hidden" name="">
				<li role="presentation" class="<?php echo $active1;?>"><a href="<?PHP echo $lnk1 ?>"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs">Project Info</span></a></li>
				<li role="presentation" class="<?php echo $active2;?>"><a href="<?PHP echo $lnk2 ?>"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Technical</span></a></li>
				<li role="presentation" class="<?php echo $active3;?>"><a href="<?PHP echo $lnk3 ?>"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Panel Installation BOM</span></a></li>
				<li role="presentation" class="<?php echo $active4;?>"><a href="<?PHP echo $lnk4 ?>"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Electrical Installation BOM</span></a></li>
				<li role="presentation" class="<?php echo $active5;?>"><a href="<?PHP echo $lnk5 ?>"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Installation Process</span></a></li>
				<li role="presentation" class="<?php echo $active6;?>"><a href="<?PHP echo $lnk6 ?>"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Project Status Log</span></a></li>
				
			</ul>		
			<!-- Tab panes -->
			<div class="tab-content" style="margin-top:0px;">
				<!--Tab 1-->
				<br>
				<div role="tabpanel" class="tab-pane <?php echo $active1;?>" id="proj_info">
					<div class="form-group col-sm-4">
						<label for="cust_id" class="control-label">Select Customer</label>
						<select class="form-control select2" name="cust_id" id="cust_id">
							<?php  print "<option value=''>Select Customer</option>";
							echo get_customer_list($cust_id);
							?>
						</select>
						<div class="help-block with-errors"></div>
					</div>	
					
					<div class="form-group col-sm-4">
						<label for="project_name" class="control-label">Project Name*</label>
						<input type="text" name="project_name" value="<?=$project_name?>" class="form-control" id="project_name" data-fv-regexp="true" data-error="Please enter valid Name" required>
						<div class="help-block with-errors"></div>
					</div>	
					<div class="clearfix"></div>
					<div class="form-group col-sm-4">
						<label for="sale_rep_id" class="control-label">Sale Representative</label>
						<!--<input type="text" name="sale_rep_name" value="<?=$sale_rep_id?$cms->getSingleResult("SELECT CONCAT(fname,' ',lname) as fullname FROM #_administrator where id=$sale_rep_id "):''?>" class="form-control" id="sale_rep_name">
						<input type="hidden" name="sale_rep_id" value="<?=$sale_rep_id?>" class="form-control" id="sale_rep_id">-->
						<select name="sale_rep_id" class="form-control" id="sale_rep_id">
							<option value="">Select</option>
							<?php $usersQry = $cms->db_query("SELECT id, fname, lname FROM #_administrator where role=(SELECT id FROM #_user_role where is_deleted=0 AND role_name='Sales Rep') AND status=1 AND is_deleted=0 AND id!=1 ");
							while($usersRes = $usersQry->fetch_array()){
								if($usersRes['id']==$sale_rep_id){
									$sales_sel = 'selected';
								}else{
									$sales_sel = '';
								}
							?>					
							<option value="<?=$usersRes['id']?>" <?=$sales_sel?>><?=$usersRes['fname']?><?=$usersRes['lname']?' '.$usersRes['lname']:''?></option>
							<?php } ?>
						</select>
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group col-sm-4">
						<label for="project_manager_id" class="control-label">Project Manager</label>
						<select name="project_manager_id" class="form-control" id="project_manager_id">
							<option value="">Select</option>
							<?php $usersQry = $cms->db_query("SELECT id, fname, lname FROM #_administrator where role=(SELECT id FROM #_user_role where is_deleted=0 AND role_name='Project Manager') AND status=1 AND is_deleted=0 AND id!=1 ");
							while($usersRes = $usersQry->fetch_array()){
								if($project_manager_id==$usersRes['id']){
									$psel = 'selected';
								}else{
									$psel = '';
								}
							?>					
							<option value="<?=$usersRes['id']?>" <?=$psel?>><?=$usersRes['fname']?><?=$usersRes['lname']?' '.$usersRes['lname']:''?></option>
							<?php } ?>
						</select>
						<div class="help-block with-errors"></div>
					</div>
					<div class="clearfix"></div>
					<div class="form-group col-sm-6">
						<input type="checkbox" name="same_address" id="same_address" value="1" <?=$same_address?'checked':''?>> Address same as customer address
					</div>
					<div class="clearfix"></div>
					<div class="fill-address">
						<div class="form-group col-sm-6">
							<label for="project_address" class="control-label">Address*</label>
							<textarea name="project_address" class="form-control" id="project_address" pattern="[^\s][a-zA-Z0-9 ]{2,35}" data-fv-regexp="true" data-error="Please enter value in correct format." maxlength="150" required><?=$project_address?></textarea>
							<div class="help-block with-errors"></div>
						</div>	
						<div class="clearfix"></div>
						<div class="form-group col-sm-4">
							<label for="project_city" class="control-label">City*</label>
							<input type="text" name="project_city" value="<?=$project_city?>" class="form-control" id="project_city" pattern="[^\s][a-zA-Z0-9 ]{2,35}" data-fv-regexp="true" data-error="Please enter value in correct format." required>
							<div class="help-block with-errors"></div>
						</div>
						<div class="form-group col-sm-4">
							<label for="project_country" class="control-label">Country*</label>
							<input type="text" name="project_country" value="<?=$project_country?>" class="form-control" id="project_country" pattern="[^\s][a-zA-Z0-9 ]{2,35}" data-fv-regexp="true" data-error="Please enter value in correct format." required>
							<div class="help-block with-errors"></div>
						</div>
						<div class="form-group col-sm-4">
							<label for="project_postal_code" class="control-label">Postal Code*</label>
							<input type="text" name="project_postal_code" value="<?=$project_postal_code?>" class="form-control" id="project_postal_code"  required>
							<div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="clearfix"></div>
					<input type="hidden" name="project_id" value="<?=$pid?>">
					<div class="form-group col-sm-12">
						<?php if((in_array($act_arr[1],$_SESSION["url"][$Sys_Gl_module_id]) || !in_array($act_arr[3],$_SESSION["url"][$Sys_Gl_module_id])) || $_SESSION["ses_adm_id"]==1){?>
						<button type="submit" class="btn add-submit-btn" id="check_submit">Submit</button>
						<?php } ?>
						<button type="button" onclick="history.go(-1)" class="btn back-btn">Back</button>
					</div>
					<div class="clearfix"></div>
				</div>
				<div role="tabpanel" class="tab-pane <?php echo $active2;?>" id="technical_info">
					<div class="col-sm-12"><h2 class="form-section-heading">Roof Details -</h2></div>
					<div class="form-group col-sm-3">
						<label for="roof_material" class="control-label" style="<?=$sales_field_color?>">Roof Type*</label>
						<select class="form-control" name="roof_material" id="roof_material" required>
							<option value="">Select Roof Type</option>
							<?php foreach($roofTypeArr as $rkey=>$rval){
								if($rkey==$roof_material){
									$rsel = 'selected';
								}else{
									$rsel = '';
								}
							?>
							<option value="<?=$rkey?>" <?=$rsel?>><?=$rval?></option>
							<?php } ?>
						</select>
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
						<label for="number_of_roof" class="control-label" style="<?=$sales_field_color?>">Number of Roofs*</label>
						<input type="number" name="number_of_roof" value="<?=$number_of_roof?>" min="0" class="form-control" id="number_of_roof" data-fv-regexp="true" data-error="Please enter valid Name" required>
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
						<input type="text" name="facade_meter_location" value="<?=$facade_meter_location?>" class="form-control" id="facade_meter_location" data-fv-regexp="true" pattern="([^\s]+)" data-error="Please enter valid Name">
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group col-sm-4">
						<label for="elcentral_location" class="control-label" style="<?=$sales_field_color?>">Elcentral(er) location</label>
						<input type="text" name="elcentral_location" value="<?=$elcentral_location?>" class="form-control" id="elcentral_location" data-fv-regexp="true" pattern="([^\s]+)" data-error="Please enter valid Name">
						<div class="help-block with-errors"></div>
					</div>		
					<div class="clearfix"></div>
					<div class="form-group col-sm-3">
						<label for="inverter_placement" class="control-label" style="<?=$sales_field_color?>">Placement of Inverter</label>
						<input type="text" name="inverter_placement" value="<?=$inverter_placement?>" class="form-control" id="inverter_placement" data-fv-regexp="true" pattern="([^\s]+)" data-error="Please enter valid Name">
						<div class="help-block with-errors"></div>
					</div>	
					<div class="form-group col-sm-3">
						<label for="battery_placement" class="control-label" style="<?=$sales_field_color?>">Placement of battery</label>
						<input type="text" name="battery_placement" value="<?=$battery_placement?>" class="form-control" id="battery_placement" data-fv-regexp="true" pattern="([^\s]+)" data-error="Please enter valid Name">
						<div class="help-block with-errors"></div>
					</div>	
					<div class="form-group col-sm-3">
						<label for="ev_placement" class="control-label" style="<?=$sales_field_color?>">Placement of EV</label>
						<input type="text" name="ev_placement" value="<?=$ev_placement?>" class="form-control" id="ev_placement" data-fv-regexp="true" pattern="([^\s]+)" data-error="Please enter valid Name">
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
						<input type="file" name="site_images[]" id="site_images" class="form-control" data-max-file-size="1M" <?php if($site_images AND file_exists(FILES_PATH.'site-image/'.$site_images)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/site-image/<?=$site_images?>" <?php }else{ ?>  <?php } ?> multiple />
						<div class="help-block with-errors"></div>
					</div>
					<div class="clearfix"></div>
					<div class="form-group col-sm-6">
						<?php if($site_image AND file_exists(FILES_PATH.'site-image/'.$site_image)){ ?>
						<img src="<?=SITE_PATH.'uploaded_files/site-image/'.$site_image?>" class="img-responsive">
						<?php } ?>
					</div>
					<div class="form-group col-sm-12">
					<?php if($pid){
						$siteImgQry = $cms->db_query("SELECT id, project_id, site_images FROM #_reports where project_id=$pid ");
						if($siteImgQry->num_rows>0){
						echo '<div class="row">';
						while($siteImgRes = $siteImgQry->fetch_array()){
							if($siteImgRes['site_images']!=''){
								echo '<div class="col-sm-4" id="report_'.$siteImgRes['id'].'"><a href="'.SITE_PATH.'uploaded_files/reports/'.$siteImgRes['site_images'].'" download><img src="'.SITE_PATH.'uploaded_files/reports/'.$siteImgRes['site_images'].'" class="img-responsive" style="    background: #199a14; padding: 15px;"></a> <a href="javascript:void(0)" onclick="removeFile('.$siteImgRes['id'].')"><i class="fa fa-close text-danger" style="position: absolute; top: 5px; right: 56px;"></i></a></div>';
							}
						}
						echo '</div>';
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
									<input type="radio" name="Ö_drift" id="Ö_drift1" value="Ja" data-error="Please enter value in correct format" <?=$Ö_drift=='Ja'?'checked':''?>>
									<label for="Ö_drift1">Ja</label>
								</div>
							</label>
							<label class="radio-inline p-0">
								<div class="radio radio-info">
									<input type="radio" name="Ö_drift" id="Ö_drift2" value="0" data-error="Please enter value in correct format" <?=$Ö_drift=='Nej'?'checked':''?>>
									<label for="Ö_drift2">Nej</label>
								</div>
							</label>
						</div>
					</div>
					<div class="form-group col-sm-3">
						<label for="kortslutningsström" class="control-label">Kortslutningsström</label>
						<input type="text" name="kortslutningsström" value="<?=$kortslutningsström?>" class="form-control" id="kortslutningsström" data-fv-regexp="true" pattern="([^\s]+)" data-error="Please enter valid Name">
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group col-sm-3">
						<label for="system_size" class="control-label">Storleken på system (kWp)</label>
						<input type="text" name="system_size" value="<?=$system_size?>" class="form-control" id="system_size" data-fv-regexp="true" pattern="([^\s]+)" data-error="Please enter valid Name">
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group col-sm-3">
						<label for="effektfaktor" class="control-label">Effektfaktor</label>
						<input type="text" name="effektfaktor" value="<?=$effektfaktor?>" class="form-control" id="effektfaktor" data-fv-regexp="true" pattern="([^\s]+)" data-error="Please enter valid Name">
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group col-sm-3">
						<label for="ev_charger" class="control-label">EV Charger</label>
						<input type="text" name="ev_charger" value="<?=$ev_charger?>" class="form-control" id="ev_charger" data-fv-regexp="true" pattern="([^\s]+)" data-error="Please enter valid Name">
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group col-sm-1">
						<label for="ev_quantity" class="control-label">Qunatity</label>
						<input type="number" name="ev_quantity" value="<?=$ev_quantity?>" class="form-control" id="ev_quantity" data-fv-regexp="true" pattern="([^\s]+)" data-error="Please enter valid Name">
						<div class="help-block with-errors"></div>
					</div>
					<div class="clearfix"></div>
					<hr>					
					<div class="col-sm-12"><h2 class="form-section-heading">Distance -</h2></div>
					<div class="form-group col-sm-4">
						<label for="distance_panel_inverter" class="control-label" style="<?=$sales_field_color?>">between panels and inverter</label>
						<input type="text" name="distance_panel_inverter" value="<?=$distance_panel_inverter?>" class="form-control" id="distance_panel_inverter" data-fv-regexp="true" pattern="([^\s]+)" data-error="Please enter valid Name">
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group col-sm-4">
						<label for="distance_inverter_connection_point" class="control-label" style="<?=$sales_field_color?>">between inverter and connection point (AC)</label>
						<input type="text" name="distance_inverter_connection_point" value="<?=$distance_inverter_connection_point?>" class="form-control" id="distance_inverter_connection_point" data-fv-regexp="true" pattern="([^\s]+)" data-error="Please enter valid Name">
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group col-sm-4">
						<label for="distance_ev_connection_point" class="control-label" style="<?=$sales_field_color?>">between EV and connection point</label>
						<input type="text" name="distance_ev_connection_point" value="<?=$distance_ev_connection_point?>" class="form-control" id="distance_ev_connection_point" data-fv-regexp="true" pattern="([^\s]+)" data-error="Please enter valid Name">
						<div class="help-block with-errors"></div>
					</div>			
					<div class="clearfix"></div>
					<hr>
					<div class="col-sm-12"><h2 class="form-section-heading">Grid Details -</h2></div>
					<div class="form-group col-sm-4">
						<label for="grid_provider" class="control-label" style="<?=$sales_field_color?>">Grid provider</label>
						<input type="text" name="grid_provider" value="<?=$grid_provider?>" class="form-control" id="grid_provider" data-fv-regexp="true" pattern="([^\s]+)" data-error="Please enter valid Name">
						<div class="help-block with-errors"></div>
					</div>			
					<div class="form-group col-sm-4">
						<label for="plant_id" class="control-label" style="<?=$sales_field_color?>">AnläggningsID</label>
						<input type="text" name="plant_id" value="<?=$plant_id?>" class="form-control" id="plant_id" data-fv-regexp="true" pattern="([^\s]+)" data-error="Please enter valid Name">
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
							<input type="text" class="form-control" name="pre_registration_date" id="datepicker-autoclose"  value="<?=$pre_registration_date?>">
							<span class="input-group-addon"><i class="icon-calender"></i></span> 
						</div>
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group col-sm-4">
						<label for="main_fuse" class="control-label">Huvudsäkring</label>
						<input type="text" name="main_fuse" value="<?=$main_fuse?>" class="form-control" id="main_fuse" data-fv-regexp="true" pattern="([^\s]+)" data-error="Please enter valid Name">
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
						<input type="file" name="acknowledgement_files[]" id="acknowledgement_files" class="form-control" data-max-file-size="1M" <?php if($acknowledgement_files AND file_exists(FILES_PATH.'reports/'.$acknowledgement_files)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/reports/<?=$acknowledgement_files?>" <?php }else{ ?>  <?php } ?> multiple />
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group col-sm-4">
					<?php if($pid){
						$ackQry = $cms->db_query("SELECT id, project_id, acknowledgement_files FROM #_reports where project_id=$pid ");
						if($ackQry->num_rows>0){
						echo '<ul>';
						while($ackRes = $ackQry->fetch_array()){
							if($ackRes['acknowledgement_files']!=''){
								echo '<li id="report_'.$ackRes['id'].'"><a href="'.SITE_PATH.'uploaded_files/reports/'.$ackRes['acknowledgement_files'].'" download>'.$ackRes['acknowledgement_files'].'</a> <a href="javascript:void(0)" onclick="removeFile('.$ackRes['id'].')"><i class="fa fa-close text-danger"></i></a></li>';
							}
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
						<input type="text" name="panel_resource" value="<?=$panel_resource?>" class="form-control" id="panel_resource" data-fv-regexp="true" pattern="([^\s]+)" data-error="Please enter valid Name">
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
						<input type="text" name="electrical_resource" value="<?=$electrical_resource?>" class="form-control" id="electrical_resource" data-fv-regexp="true" pattern="([^\s]+)" data-error="Please enter valid Name">
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
						$mmsReportQry = $cms->db_query("SELECT id, project_id, mms_report FROM #_reports where project_id=$pid ");
						if($mmsReportQry->num_rows>0){
						echo '<ul>';
						while($mmsReportRes = $mmsReportQry->fetch_array()){
							if($mmsReportRes['mms_report']!=''){
								echo '<li id="report_'.$mmsReportRes['id'].'"><a href="'.SITE_PATH.'uploaded_files/reports/'.$mmsReportRes['mms_report'].'" download>'.$mmsReportRes['mms_report'].'</a> <a href="javascript:void(0)" onclick="removeFile('.$mmsReportRes['id'].')"><i class="fa fa-close text-danger"></i></a></li>';
							}
						}
						echo '</ul>';
						} }
						?>
					</div>
					<div class="form-group col-sm-6">
						<?php if($pid){
						$systemReportQry = $cms->db_query("SELECT id, project_id, system_report FROM #_reports where project_id=$pid ");
						if($systemReportQry->num_rows>0){
						echo '<ul>';
						while($systemReportRes = $systemReportQry->fetch_array()){
							if($systemReportRes['system_report']!=''){
								echo '<li id="report_'.$systemReportRes['id'].'"><a href="'.SITE_PATH.'uploaded_files/reports/'.$systemReportRes['system_report'].'" download>'.$systemReportRes['system_report'].'</a> <a href="javascript:void(0)" onclick="removeFile('.$systemReportRes['id'].')"><i class="fa fa-close text-danger"></i></a></li>';
							}
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
				<div role="tabpanel" class="tab-pane <?php echo $active3;?>" id="panel">
					<div class="col-md-12">
						<table class="table table-striped1 table-hover table-bordered">
							<thead>
								<tr>
									<th class="text-nowrap">Item Name</th>				
									<th>Quantity</th>
									<th>Status</th>
									<th>Delivery Address</th>
									<th>Delivery Date</th>
									<th>Comment</th>
									<th>Part of procurement list</th>
									<th>Responsible for bringing on project site</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody class="item-list">
								<?php if($pid){
								$itemQry = $cms->db_query("SELECT * FROM #_installation_bom where project_id=$pid AND bom_type='Panel' ");
								if($itemQry->num_rows>0){
								while($itemRes = $itemQry->fetch_array()){
								$mainCat = $cms->getSingleResult("Select cat_name from #_inventory_categories where id=(Select parent_id from #_inventory_categories where id=".$itemRes['item_id'].") ");	
								$subCat = $cms->getSingleResult("Select cat_name from #_inventory_categories where id=".$itemRes['item_id']." ");	
								?>
								<tr>
									<td><?=$mainCat?> > <?=$subCat?></td>
									<td><?=$itemRes['quantity']?><?=$itemRes['unit']?' '.$itemRes['unit']:''?></td>
									<td><?=$itemStatusArr[$itemRes['item_status']]?></td>
									<td><?=$deliveryAddress[$itemRes['delivery_address']]?></td>
									<td><?=$itemRes['delivery_date']?></td>
									<td class="text-center">
										<?php $commentt=$itemRes['comment']?$itemRes['comment']:"No Comment Available";
											//echo '<a target="_blank" href="'.SITE_PATH_ADM.CPAGE."?mode=view&start=".$_GET['start'].'&id='.$id.'" data-toggle="popover" data-content="'.$comment.'"><i class="fa fa-comments text-inverse m-r-10"></i></a>';
											
											if($itemRes['comment']!=''){
												$style="color:#0cd20c";
											
										?>
										<a href="javascript:void(0)" data-placement="left" data-toggle="popover" title="Comment" onclick="showComment('<?=$itemRes['comment']?>')"><i class="fa fa-comments text-inverse m-r-10" style="<?=$style?>"></i></a>
											<?php }else{
												echo $commentt;
											}?>
									</td>
									<td><?=$itemRes['part_of_procurement']?></td>
									<td><?=$deliverByArr[$itemRes['deliver_by']]?></td>
									<td>
										<a href="javascript:void(0)" onclick="editItemValue(<?=$itemRes['id']?>)" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil"></i></a>	
										<a href="<?=SITE_PATH_ADM.CPAGE?>/?mode=add&t=panel&id=<?=$pid?>&itemid=<?=$itemRes['id']?>&action=del-item&view=true" onclick="return confirm('Do you want delete this record?');" data-toggle="tooltip" data-original-title="Close"><i class="fa fa-close text-danger"></i></a>
									</td>
								
								</tr>
								<?php } } } ?>
								<div class="modal fade" id="panelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											</div>
											<div class="modal-body" id="panel_body">
												
											</div>
										</div>
									</div>
								</div>
							</tbody>
						</table>
						<div class="add-item-in-list">
							<?php if($pid){
							$itemIds = $cms->getSingleResult("SELECT GROUP_CONCAT(item_id) as itemIds FROM ap_installation_bom where project_id=$id AND bom_type='Panel' ");
							$itemIdArr = explode(',',$itemIds);
							
							$itemQry = $cms->db_query("SELECT * FROM #_inventory_categories where status=1 AND is_deleted=0 AND default_item=1 AND cat_type=1 ");
							while($itemRes = $itemQry->fetch_array()){
								if(!in_array($itemRes['id'],$itemIdArr)){
							?>
							<div class="row">
								<div class="form-group col-sm-4">
									<label for="item_id" class="control-label">Item*</label>
									<select class="form-control select21" name="item_idP[]" required>
										<option value=""></option>
										<?=get_inventory_category_list($itemRes['id'])?>
									</select>
									<div class="help-block with-errors"></div>
								</div>
								<div class="form-group col-sm-1"><label for="quantity" class="control-label">Quantity*</label><input class="form-control" type="number" name="quantityP[]" min="0" required><div class="help-block with-errors"></div></div><div class="form-group col-sm-1"><label for="unit" class="control-label">Unit</label><input class="form-control" type="text" name="unitP[]"><div class="help-block with-errors"></div></div><div class="form-group col-sm-2"><label for="item_status" class="control-label">Status*</label><select class="form-control" name="item_statusP[]" id="item_status" required><option value="">Status</option><?php foreach($itemStatusArr as $skey=>$sval){?><option value="<?=$skey?>"><?=$sval?></option><?php } ?></select></div><div class="form-group col-sm-3"><label for="delivery_address" class="control-label">Delivery address*</label><select class="form-control" name="delivery_addressP[]" required><option value="">Delivery address</option><?php foreach($deliveryAddress as $dkey=>$dval){?><option value="<?=$dkey?>"><?=$dval?></option><?php } ?></select></div><div class="clearfix"></div><div class="form-group col-sm-3"><label for="comment" class="control-label">Comment</label><input class="form-control" type="text" name="commentP[]"></div><div class="form-group col-sm-4"><label for="deliver_by" class="control-label">Responsible for bringing on project site*</label><select class="form-control" name="deliver_byP[]" onchange="jsfunctionP()" id="deliver_byP" required><option value="">Deliver By</option><?php foreach($deliverByArr as $dbkey=>$dbval){?><option value="<?=$dbkey?>"><?=$dbval?></option><?php } ?></select></div><div class="form-group col-sm-3" id="project_site_show" style="display:none"><label for="project_site" class="control-label">Project Site</label><input class="form-control" type="text" name="project_siteP[]"><div class="help-block with-errors"></div></div><div class="form-group col-sm-4"><label for="delivery_date" class="control-label">Delivery date</label><div class="input-group"><input type="text" class="form-control" name="delivery_dateP[]" id="delivery_date" placeholder="yyyy-mm-dd"><span class="input-group-addon"><i class="icon-calender"></i></span></div><div class="help-block with-errors"></div></div><div class="clearfix"></div><div class="form-group col-sm-3"><div class="checkbox checkbox-success"><input id="" type="checkbox" name="part_of_procurementP[]" value="1"><label for="part_of_procurement"> Part of procurement list</label></div></div><a href="javascript:void(0);" class="remove_button"><i class="fa fa-close text-danger"></i></a></div>
							<?php } } } ?>
							<div class="field_wrapper">
							</div>
							<?php if($itemQry->num_rows>0){
								$savebtn = 'display:block';
							}else{
								$savebtn = 'display:none';
							}?>
							<div class="form-group col-sm-12 save-items" style="<?=$savebtn?>">
								<button type="submit" class="btn add-submit-btn" name="save_items">Save</button>
							</div>
						</div>
						<div class="text-right">
							<?php if($pid){
							$procurementQry = $cms->db_query("SELECT * FROM #_installation_bom where project_id=$pid AND bom_type='Panel' and part_of_procurement=1 ");
							if($procurementQry->num_rows>0){ ?>
							<a class="btn btn-info" onClick="doanloadPanelProcurement()"><i class="fa fa-download"></i> Download Procurement List</a>							
							<?php } }?>
							<?php if((in_array($act_arr[1],$_SESSION["url"][$Sys_Gl_module_id]) || !in_array($act_arr[3],$_SESSION["url"][$Sys_Gl_module_id])) || $_SESSION["ses_adm_id"]==1){?>
							<a href="javascript:void(0);" class="btn btn-info add_items"><i class="fa fa-plus"></i> Add Item</a>
							<?php } ?>
						</div>
						
						<br>
						<!--<div class="form-group col-sm-12">
							<?php if((in_array($act_arr[1],$_SESSION["url"][$Sys_Gl_module_id]) || !in_array($act_arr[3],$_SESSION["url"][$Sys_Gl_module_id])) || $_SESSION["ses_adm_id"]==1){?>
							<button type="submit" class="btn add-submit-btn" id="check_submit">Submit</button>
							<?php } ?>
							<button type="button" onclick="history.go(-1)" class="btn back-btn">Back</button>
						</div>-->
					</div>
					<div class="clearfix"></div>
				</div>
				<div role="tabpanel" class="tab-pane <?php echo $active4;?>" id="electrical">
					<div class="col-md-12">
						<table class="table table-striped1 table-hover table-bordered">
							<thead>
								<tr>
									<th class="text-nowrap">Item Name</th>				
									<th>Quantity</th>
									<th>Status</th>
									<th>Delivery Address</th>
									<th>Delivery Date</th>
									<th>Comment</th>
									<th>Part of procurement list</th>
									<th>Responsible for bringing on project site</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody class="item-list">
								<?php if($pid){
								$itemQry = $cms->db_query("SELECT * FROM #_installation_bom where project_id=$pid AND bom_type='Electrical' ");								
								if($itemQry->num_rows>0){
								while($itemRes = $itemQry->fetch_array()){
								$mainCat = $cms->getSingleResult("Select cat_name from #_inventory_categories where id=(Select parent_id from #_inventory_categories where id=".$itemRes['item_id'].") ");	
								$subCat = $cms->getSingleResult("Select cat_name from #_inventory_categories where id=".$itemRes['item_id']." ");	
								?>
								<tr>
									<td><?=$mainCat?> > <?=$subCat?></td>
									<td><?=$itemRes['quantity']?><?=$itemRes['unit']?' '.$itemRes['unit']:''?></td>
									<td><?=$itemStatusArr[$itemRes['item_status']]?></td>
									<td><?=$deliveryAddress[$itemRes['delivery_address']]?></td>
									<td><?=$itemRes['delivery_date']?></td>
									<td class="text-center">
										<?php $commentt=$itemRes['comment']?$itemRes['comment']:"No Comment Available";
											//echo '<a target="_blank" href="'.SITE_PATH_ADM.CPAGE."?mode=view&start=".$_GET['start'].'&id='.$id.'" data-toggle="popover" data-content="'.$comment.'"><i class="fa fa-comments text-inverse m-r-10"></i></a>';
											
											if($itemRes['comment']!=''){
												$style="color:#0cd20c";
											
										?>
										<a href="javascript:void(0)" data-placement="left" data-toggle="popover" title="Comment" onclick="showComment('<?=$itemRes['comment']?>')"><i class="fa fa-comments text-inverse m-r-10" style="<?=$style?>"></i></a>
											<?php }else{
												echo $commentt;
											}?>
									</td>
									<td><?=$itemRes['part_of_procurement']?></td>
									<td><?=$deliverByArr[$itemRes['deliver_by']]?></td>
									<td>
										<a href="javascript:void(0)" onclick="editElecItemValue(<?=$itemRes['id']?>)" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil"></i></a>	
										<a href="<?=SITE_PATH_ADM.CPAGE?>/?mode=add&t=panel&id=<?=$pid?>&itemid=<?=$itemRes['id']?>&action=del-itemE&view=true" onclick="return confirm('Do you want delete this record?');" data-toggle="tooltip" data-original-title="Close"><i class="fa fa-close text-danger"></i></a>									
									</td>
								</tr>
								<?php } } } ?>
								<div class="modal fade" id="electricalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											</div>
											<div class="modal-body" id="electrical_item">
												
											</div>
										</div>
									</div>
								</div>
							</tbody>
						</table>
						<div class="add-item-in-list">
							<?php if($pid){
							$itemIds = $cms->getSingleResult("SELECT GROUP_CONCAT(item_id) as itemIds FROM ap_installation_bom where project_id=$id AND bom_type='Electrical' ");
							$itemIdArr = explode(',',$itemIds);
							
							$itemQry = $cms->db_query("SELECT * FROM #_inventory_categories where status=1 AND is_deleted=0 AND default_item=1 AND cat_type=2 ");
							while($itemRes = $itemQry->fetch_array()){
								if(!in_array($itemRes['id'],$itemIdArr)){
							?>
							<div class="row"><div class="form-group col-sm-4"><label for="item_id" class="control-label">Item*</label><select class="form-control" name="item_idE[]" required><option value=""></option><?=get_inventory_category_list($itemRes['id'])?></select><div class="help-block with-errors"></div></div><div class="form-group col-sm-1"><label for="quantity" class="control-label">Quantity*</label><input class="form-control" type="number" name="quantityE[]" min="0" required><div class="help-block with-errors"></div></div><div class="form-group col-sm-1"><label for="unit" class="control-label">Unit</label><input class="form-control" type="text" name="unitE[]"><div class="help-block with-errors"></div></div><div class="form-group col-sm-2"><label for="item_status" class="control-label">Status*</label><select class="form-control" name="item_statusE[]" id="item_status" required><option value="">Status</option><?php foreach($itemStatusArr as $skey=>$sval){?><option value="<?=$skey?>"><?=$sval?></option><?php } ?></select></div><div class="form-group col-sm-3"><label for="delivery_address" class="control-label">Delivery address*</label><select class="form-control" name="delivery_addressE[]" required><option value="">Delivery address</option><?php foreach($deliveryAddress as $dkey=>$dval){?><option value="<?=$dkey?>"><?=$dval?></option><?php } ?></select></div><div class="clearfix"></div><div class="form-group col-sm-3"><label for="comment" class="control-label">Comment</label><input class="form-control" type="text" name="commentE[]"></div><div class="form-group col-sm-4"><label for="deliver_by" class="control-label">Responsible for bringing on project site*</label><select class="form-control" name="deliver_byE[]" id="deliver_byE" onchange="jsfunctionE()" required><option value="">Deliver By</option><?php foreach($deliverByArr as $dbkey=>$dbval){?><option value="<?=$dbkey?>"><?=$dbval?></option><?php } ?></select></div><div class="form-group col-sm-3" id="project_site_showE" style="display:none"><label for="project_site" class="control-label">Project Site</label><input class="form-control" type="text" name="project_siteE[]"><div class="help-block with-errors"></div></div><div class="form-group col-sm-4"><label for="delivery_date" class="control-label">Delivery date</label><div class="input-group"><input type="text" class="form-control" name="delivery_dateE[]" id="delivery_date" placeholder="yyyy-mm-dd"><span class="input-group-addon"><i class="icon-calender"></i></span></div><div class="help-block with-errors"></div></div><div class="clearfix"></div><div class="form-group col-sm-3"><div class="checkbox checkbox-success"><input id="" type="checkbox" name="part_of_procurementE[]" value="1"><label for="part_of_procurement"> Part of procurement list</label></div></div><a href="javascript:void(0);" class="remove_button1"><i class="fa fa-close text-danger"></i></a></div>
							<?php } } } ?>
							
							<div class="field_wrapper1">
							</div>
							<?php if($itemQry->num_rows>0){
								$savebtn1 = 'display:block';
							}else{
								$savebtn1 = 'display:none';
							}?>
							<div class="form-group col-sm-12 save-items" style="<?=$savebtn1?>">
								<button type="submit" class="btn add-submit-btn" name="save_electrical_items">Save</button>
							</div>
						</div>
						<div class="text-right">
							<?php if($pid){
							$procurementQry = $cms->db_query("SELECT * FROM #_installation_bom where project_id=$pid AND bom_type='Electrical' and part_of_procurement=1 ");
							if($procurementQry->num_rows>0){ ?>
							<a class="btn btn-info" onClick="doanloadElectricalProcurement()"><i class="fa fa-download"></i> Download Procurement List</a>
							<?php } }?>
							<?php if((in_array($act_arr[1],$_SESSION["url"][$Sys_Gl_module_id]) || !in_array($act_arr[3],$_SESSION["url"][$Sys_Gl_module_id])) || $_SESSION["ses_adm_id"]==1){?>
							<a href="javascript:void(0);" class="btn btn-info add_items1"><i class="fa fa-plus"></i> Add Item</a>
							<?php } ?>
						</div>
						
						<br>
						<!--<div class="form-group col-sm-12">
							<?php if((in_array($act_arr[1],$_SESSION["url"][$Sys_Gl_module_id]) || !in_array($act_arr[3],$_SESSION["url"][$Sys_Gl_module_id])) || $_SESSION["ses_adm_id"]==1){?>
							<button type="submit" class="btn add-submit-btn" id="check_submit">Submit</button>
							<?php } ?>
							<button type="button" onclick="history.go(-1)" class="btn back-btn">Back</button>
						</div>-->
					</div>
					<div class="clearfix"></div>
				</div>
				<div role="tabpanel" class="tab-pane <?php echo $active5;?>" id="process">
					<div class="col-sm-12">
					
					
						<div id="exampleBasic2" class="wizard">
							<ul class="wizard-steps" role="tablist">
								<li class="active" role="tab">
									<h4><span>1</span>Step</h4>
								</li>
								<li role="tab">
									<h4><span>2</span>Step</h4>
								</li>
								<li role="tab">
									<h4><span>3</span>Step</h4>
								</li>
							</ul>
							<div class="wizard-content">
								<div class="wizard-pane active" role="tabpanel">Step 1</div>
								<div class="wizard-pane" role="tabpanel">Step 2</div>
								<div class="wizard-pane" role="tabpanel">Step 3</div>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
				<div role="tabpanel" class="tab-pane <?php echo $active6;?>" id="project_status">
				Coming Soon
				</div>
			</div>
						
			
        </div>
	</div>
</div>
<!-- /.row -->

<script>
function showComment(message){
	//Success Message == 'Title', 'Message body', Last one leave as it is
	swal("Comment", message, "");
}
</script>
<script>
function doanloadPanelProcurement(){
	$("#aforms").attr("action","<?=SITE_PATH_ADM.CPAGE?>/download-panel-procurement.php");
	//alert($(".filter_form").attr("action"));
	$("#aforms").submit();
	setTimeout(function(){ location.reload() }, 1000);
}
</script>

<script>
function doanloadElectricalProcurement(){
	$("#aforms").attr("action","<?=SITE_PATH_ADM.CPAGE?>/download-electrical-procurement.php");
	//alert($(".filter_form").attr("action"));
	$("#aforms").submit();
	setTimeout(function(){ location.reload() }, 1000);
}
</script>

<script type="text/javascript">
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_items'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div class=""><div class="form-group col-sm-4"><label for="item_id" class="control-label">Item*</label><select class="form-control select2" name="item_idP[]" required><option value=""></option><?=get_inventory_category_list($item_id)?></select><div class="help-block with-errors"></div></div><div class="form-group col-sm-1"><label for="quantity" class="control-label">Quantity*</label><input class="form-control" type="number" name="quantityP[]" min="0" required><div class="help-block with-errors"></div></div><div class="form-group col-sm-1"><label for="unit" class="control-label">Unit</label><input class="form-control" type="text" name="unitP[]"><div class="help-block with-errors"></div></div><div class="form-group col-sm-2"><label for="item_status" class="control-label">Status*</label><select class="form-control" name="item_statusP[]" id="item_status" required><option value="">Status</option><?php foreach($itemStatusArr as $skey=>$sval){?><option value="<?=$skey?>"><?=$sval?></option><?php } ?></select></div><div class="form-group col-sm-3"><label for="delivery_address" class="control-label">Delivery address*</label><select class="form-control" name="delivery_addressP[]" required><option value="">Delivery address</option><?php foreach($deliveryAddress as $dkey=>$dval){?><option value="<?=$dkey?>"><?=$dval?></option><?php } ?></select></div><div class="clearfix"></div><div class="form-group col-sm-3"><label for="comment" class="control-label">Comment</label><input class="form-control" type="text" name="commentP[]"></div><div class="form-group col-sm-4"><label for="deliver_by" class="control-label">Responsible for bringing on project site*</label><select class="form-control" name="deliver_byP[]" onchange="jsfunctionP()" id="deliver_byP" required><option value="">Deliver By</option><?php foreach($deliverByArr as $dbkey=>$dbval){?><option value="<?=$dbkey?>"><?=$dbval?></option><?php } ?></select></div><div class="form-group col-sm-3" id="project_site_show" style="display:none"><label for="project_site" class="control-label">Project Site</label><input class="form-control" type="text" name="project_siteP[]"><div class="help-block with-errors"></div></div><div class="form-group col-sm-4"><label for="delivery_date" class="control-label">Delivery date</label><div class="input-group"><input type="text" class="form-control" name="delivery_dateP[]" id="delivery_date" placeholder="yyyy-mm-dd"><span class="input-group-addon"><i class="icon-calender"></i></span></div><div class="help-block with-errors"></div></div><div class="clearfix"></div><div class="form-group col-sm-3"><div class="checkbox checkbox-success"><input id="" type="checkbox" name="part_of_procurementP[]" value="1"><label for="part_of_procurement"> Part of procurement list</label></div></div><a href="javascript:void(0);" class="remove_button"><i class="fa fa-close text-danger"></i></a></div><div class="clearfix"></div><hr>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
			$('.save-items').show();
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script>

<script>
$('.remove_button').click(function(){
	$(this).parent('div').remove();
});
</script>

<script>
function jsfunctionP(){
	d = document.getElementById("deliver_byP").value;
    if(d==3){
		$('#project_site_show').show();
	}else{
		$('#project_site_show').hide();
	}
}
</script>

<script type="text/javascript">
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_items1'); //Add button selector
    var wrapper = $('.field_wrapper1'); //Input field wrapper
    var fieldHTML = '<div class=""><div class="form-group col-sm-4"><label for="item_id" class="control-label">Item*</label><select class="form-control" name="item_idE[]" required><option value=""></option><?=get_inventory_category_list($item_id)?></select><div class="help-block with-errors"></div></div><div class="form-group col-sm-1"><label for="quantity" class="control-label">Quantity*</label><input class="form-control" type="number" name="quantityE[]" min="0" required><div class="help-block with-errors"></div></div><div class="form-group col-sm-1"><label for="unit" class="control-label">Unit</label><input class="form-control" type="text" name="unitE[]"><div class="help-block with-errors"></div></div><div class="form-group col-sm-2"><label for="item_status" class="control-label">Status*</label><select class="form-control" name="item_statusE[]" id="item_status" required><option value="">Status</option><?php foreach($itemStatusArr as $skey=>$sval){?><option value="<?=$skey?>"><?=$sval?></option><?php } ?></select></div><div class="form-group col-sm-3"><label for="delivery_address" class="control-label">Delivery address*</label><select class="form-control" name="delivery_addressE[]" required><option value="">Delivery address</option><?php foreach($deliveryAddress as $dkey=>$dval){?><option value="<?=$dkey?>"><?=$dval?></option><?php } ?></select></div><div class="clearfix"></div><div class="form-group col-sm-3"><label for="comment" class="control-label">Comment</label><input class="form-control" type="text" name="commentE[]"></div><div class="form-group col-sm-4"><label for="deliver_by" class="control-label">Responsible for bringing on project site*</label><select class="form-control" name="deliver_byE[]" id="deliver_byE" onchange="jsfunctionE()" required><option value="">Deliver By</option><?php foreach($deliverByArr as $dbkey=>$dbval){?><option value="<?=$dbkey?>"><?=$dbval?></option><?php } ?></select></div><div class="form-group col-sm-3" id="project_site_showE" style="display:none"><label for="project_site" class="control-label">Project Site</label><input class="form-control" type="text" name="project_siteE[]"><div class="help-block with-errors"></div></div><div class="form-group col-sm-4"><label for="delivery_date" class="control-label">Delivery date</label><div class="input-group"><input type="text" class="form-control" name="delivery_dateE[]" id="delivery_date" placeholder="yyyy-mm-dd"><span class="input-group-addon"><i class="icon-calender"></i></span></div><div class="help-block with-errors"></div></div><div class="clearfix"></div><div class="form-group col-sm-3"><div class="checkbox checkbox-success"><input id="" type="checkbox" name="part_of_procurementE[]" value="1"><label for="part_of_procurement"> Part of procurement list</label></div></div><a href="javascript:void(0);" class="remove_button1"><i class="fa fa-close text-danger"></i></a><div class="clearfix"></div><hr></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
			$('.save-items').show();
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button1', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script>

<script>
function jsfunctionE(){
	d = document.getElementById("deliver_byE").value;
    if(d==3){
		$('#project_site_showE').show();
	}else{
		$('#project_site_showE').hide();
	}
}
</script>
<script>
function editItemValue(id){
	//alert(id);
	$.ajax({
		type:"post",
		url: "<?=SITE_PATH_ADM.CPAGE?>/getIBOMvalues.php",
		data:"bom_id="+id,
		success:function(result){
			if(result!='' && result!=0){
				$("#panel_body").html(result);
				$("#panelModal").modal("show");
			}
			else{
				alert("Something went wrong.Pleas try again.");
			}
		}
	})
}	
</script>


<script>
function editElecItemValue(id){
	//alert(id);
	$.ajax({
		type:"post",
		url: "<?=SITE_PATH_ADM.CPAGE?>/getEBOMvalues.php",
		data:"bom_id="+id,
		success:function(result){
			if(result!='' && result!=0){
				$("#electrical_item").html(result);
				$("#electricalModal").modal("show");
			}
			else{
				alert("Something went wrong.Pleas try again.");
			}
		}
	})
}	
</script>


<script>
function removeFile(id){
	if (confirm("Are you sure to delete?")) {
		$.ajax({
			type:"post",
			url: "<?=SITE_PATH_ADM.CPAGE?>/remove_file.php?id="+id,
			success:function(result){
				if(parseInt(result)=='1'){
					$("#report_"+id).hide();
				}
				else{
					alert("Something went wrong.Pleas try again.");
				}
			}
		})
	}
}	
</script>

<script>
function addItems(){
	$.ajax({
		url:"<?=SITE_PATH_ADM.CPAGE?>/addItemsTable.php",
		//data:"item_id="+item_id,
		method:"post",
		beforeSend:function(){
			$(".loader").show();
		},
		success:function(result){
			if(result!='' && result!=0){
				$(".loader").hide();
				$('.item-table').show();
				$('.add-item-in-list').html(result);
			}else{
				
			}
		}
	})
}
</script>
<script>
function addElectricalItems(item_id){
	$.ajax({
		url:"<?=SITE_PATH_ADM.CPAGE?>/addItemsTable.php",
		data:"item_id="+item_id,
		method:"post",
		beforeSend:function(){
			$(".loader").show();
		},
		success:function(result){
			if(result!='' && result!=0){
				$(".loader").hide();
				$('.electrical-item-table').show();
				$('.electrical-item-list').append(result);
			}else{
				
			}
		}
	})
}
</script>

<script>
$('#cust_id').change(function() {
	//alert();
    var custID = $(this).val();
	$.ajax({
		url:"<?=SITE_PATH_ADM.CPAGE?>/getProjectName.php",
		data:"custID="+custID,
		method:"post",
		beforeSend:function(){
			$(".loader").show();
		},
		success:function(result){
			if(result!='' && result!=0){
				$(".loader").hide();
				$('#project_name').val(result);
			}else{
				$('#project_name').val('');
			}
		}
	})
});
</script>

<script>
$('#cust_id').change(function() {
	//alert();
    var custID = $(this).val();
	$.ajax({
		url:"<?=SITE_PATH_ADM.CPAGE?>/getSalesName.php",
		data:"custID="+custID,
		method:"post",
		beforeSend:function(){
			$(".loader").show();
		},
		success:function(result){
			var res = result.split("|");
			if(res[0]!='' && res[1]!=''){
				$(".loader").hide();
				$('#sale_rep_name').val(res[1]);
				$('#sale_rep_id').val(res[0]);
			}else{
				$('#sale_rep_name').val('');
				$('#sale_rep_id').val('');
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
				$(".loader").show();
			},
			success:function(result){
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
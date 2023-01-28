<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 
$pid = $_GET["id"];
$roof_details_count = 0;

if($cms->is_post_back()){ 
	// echo "<pre>";
	// print_r($_POST);
	// echo "</pre>";
	// die;
		
		
	if($_POST['panel_vendor_id']==''){
	    $_POST['panel_vendor_id']=0;
	}
	if($_POST['electrical_vendor_id']==''){
	    $_POST['electrical_vendor_id']=0;
	}
	if($_POST['enskild_firma']=='on'){
	    $_POST['enskild_firma']=1;
	}else{
		$_POST['enskild_firma']=0;
	}
	
	$_POST['lead_id'] = $cms->getSingleResult("SELECT lead_id FROM #_leads WHERE id=".$_POST['cust_id']." ");

	// mk-19-27
	if(empty($_POST['not_same_bill'])){
		$_POST['not_same_bill'] = 0;
		$_POST['cust_name_bill'] = '';
		$_POST['personnummer_bill'] = '';
		$_POST['email_bill'] = '';
		$_POST['phone_bill'] = ''; 
	}
		
	if($pid){
		$_POST['modified_date'] = date("Y-m-d");
		
		if($_POST['added_files'] && $_POST['uploaded_files']){
			$_POST['uploaded_files'] = implode(',',$_POST['uploaded_files']);
			$_POST['uploaded_files'] = $_POST['added_files'].','.$_POST['uploaded_files'];
		}else{
			$_POST['uploaded_files'] = implode(',',$_POST['uploaded_files']);
		}
		if($_FILES["acknowledgement_file"]["name"]){
			$_POST["acknowledgement_file"] = uploadFile("acknowledgement_file",UP_FILES_REPORTS);
		}
		$uids =  $pid;
		$cms->sqlquery("rs","customer_project",$_POST,'id',$pid);
		
		$LEADARR['personnummer'] = $_POST['personnummer'];
		$cms->sqlquery("rs","leads",$LEADARR,'id',$_POST['cust_id']);
	
		$adm->sessset('Record has been updated', 's');
	} else {
		$_POST['project_date'] = date("Y-m-d");
		if($_SESSION["ses_adm_id"]!=1){
			$_POST['project_manager_id'] = $_SESSION["ses_adm_id"];
		}
		$pid = $cms->sqlquery("rs","customer_project",$_POST);
		/*$invoice_Arr = array("report_no"=>$uids);
		$name  = generateReport($invoice_Arr);*/
		$adm->sessset('Record has been added', 's');
	}	
	//when status changed
	$old_status=$_POST['old_status'];
	$status=$_POST['status'];
	if($old_status!=$status && $old_status!=''){
		$StatusPOSTS["project_id"] = $pid;
		$StatusPOSTS["action_message"] = '';
		$StatusPOSTS["action_date"] = date('Y-m-d h:i:s');
		$StatusPOSTS["action_by"] = $_SESSION["ses_adm_id"];
		$StatusPOSTS["project_new_status"] = $_POST["status"];
		$StatusPOSTS["project_old_status"] = $_POST["old_status"];
		//print_r($StatusPOSTS);die;
		$cms->sqlquery("rs","lead_tracker",$StatusPOSTS);
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
	
	/*if($pid){
		$allStepsQry = $cms->db_query("SELECT * FROM #_project_steps where status=1 AND is_deleted=0 order by step_id ");
		while($allStepsArr = $allStepsQry->fetch_array()){
			$projectStepsQry = $cms->db_query("SELECT * FROM #_users_project_steps where step_num=".$allStepsArr['step_id']."  AND project_id=".$pid." ");
			
			if($projectStepsQry->num_rows>0){
				$projectStepsArr = $projectStepsQry->fetch_array();
				$projectStepId = $projectStepsArr['id'];
				$cms->sqlquery("rs","users_project_steps",$projectStepsArr,'id',$projectStepId);
			}
			else{
				$allStepsArr['project_id'] = $pid;
				$allStepsArr['step_num'] = $allStepsArr['step_id'];
				$allStepsArr['step_title'] = $cms->getSingleResult("SELECT step_title FROM #_step_detail where step_num=".$allStepsArr['step_id']." ");
				$cms->sqlquery("rs","users_project_steps",$allStepsArr);
			}			
		}
	}*/
	
	
	if(!empty($_FILES["site_images"]["name"])){
		$countImage =  count($_FILES["site_images"]["name"]);
		if($countImage>0){
			for($i=0;$i<$countImage;$i++){
				if(!empty($_FILES['site_images']['name'][$i])){
					$filename = rand(1000,100000)."-".$_FILES['site_images']['name'][$i]; 
					$file_loc = $_FILES['site_images']['tmp_name'][$i];
					$file_size = ($_FILES['site_images']['size'][$i]/1024);
					$file_type = $_FILES['site_images']['type'][$i];
					$folder = FILES_PATH.UP_FILES_REPORTS."/";
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
					$folder = FILES_PATH.UP_FILES_REPORTS."/";
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
	
	
	/*if(!empty($_FILES["mms_report"]["name"])){
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
	*/
	
	/*if(isset($_FILES['file_upload']) and count(array_filter($_FILES['file_upload']['tmp_name']))>0){
		if(count($_FILES["file_upload"]["name"])>0){				
			$pcount = count($_FILES["file_upload"]["name"]);
			for($i=0; $i<$pcount; $i++){
				$uploadArr['file_title'] = $_POST['file_title'][$i];
									
				if(!empty($_FILES["file_upload"]["name"][$i])){
					$path = $_FILES["file_upload"]["name"][$i];
					$end = pathinfo($path, PATHINFO_EXTENSION);
					$filename = $_FILES['file_upload']['name'][$i]; 
					$file_loc = $_FILES['file_upload']['tmp_name'][$i];
					$file_size = $_FILES['file_upload']['size'][$i];
					$file_type = $_FILES['file_upload']['type'][$i];
					$folder = FILES_PATH."uploads/";
					// make file name in lower case
					$new_file_name = strtolower($filename);
					$final_file= str_replace(" ","-",$new_file_name);
					if($file_size>0 && $file_size>5000000){
						echo "<script>alert('File size should be less than 5MB')</script>";
					}else{
						move_uploaded_file($file_loc,$folder.$final_file);
						//$_POST['display_order']=$i+1;
						$uploadArr['file_upload']=$final_file;
						//$uploadArr['proposal_id']=$lead_insert_id;
						$uploadArr['lead_id']=$_POST['lead_id'];
						//print_r($uploadArr);die;
						$uploadId = $cms->sqlquery("rs","uploads",$uploadArr);
						
						if($uploadId){
							if($_POST['added_files']){
								$_POST['uploaded_files'] = $_POST['added_files'].','.$uploadId;	
							}else{							
								$_POST['uploaded_files'] = $uploadId;
							}
							$cms->sqlquery("rs","customer_project",$_POST,'id',$pid);
						}
					}
				}			
			}
		}	
	}*/
	
	
	
	if(isset($_POST['upload_files'])){
		$PROJECTARR['lead_id'] = $cms->getSingleResult("SELECT lead_id FROM #_leads WHERE id=".$_POST['cust_id']." ");
		$cms->sqlquery("rs","customer_project",$PROJECTARR,'id',$pid);
		//upload files
		if(isset($_FILES['file_upload']) and count(array_filter($_FILES['file_upload']['tmp_name']))>0){
			if(count($_FILES["file_upload"]["name"])>0){				
				$pcount = count($_FILES["file_upload"]["name"]);
				for($i=0; $i<$pcount; $i++){
					$uploadFilesArr['file_title'] = $_POST['file_title'][$i];									
					$uploadFilesArr['file_type'] = $_POST['file_type'][$i];									
					if(!empty($_FILES["file_upload"]["name"][$i])){
						$path = $_FILES["file_upload"]["name"][$i];
						$end = pathinfo($path, PATHINFO_EXTENSION);
						$filename = $_FILES['file_upload']['name'][$i]; 
						$file_loc = $_FILES['file_upload']['tmp_name'][$i];
						$file_size = $_FILES['file_upload']['size'][$i];
						$file_type1 = $_FILES['file_upload']['type'][$i];
						$folder = FILES_PATH.UP_FILES_UPLOADS."/";
						// make file name in lower case
						$new_file_name = strtolower($filename);
						$final_file= str_replace(" ","-",$new_file_name);
						if($file_size>0 && $file_size>5000000){
							echo "<script>alert('File size should be less than 5MB')</script>";
						}else{
							move_uploaded_file($file_loc,$folder.$final_file);
							$uploadFilesArr['display_order']=$i+1;
							$uploadFilesArr['file_upload']=$final_file;
							$uploadFilesArr['lead_id']=$PROJECTARR['lead_id'];						
							//echo $_POST['f_type'][$i];die;	
							//print_r($uploadFilesArr);die;
							$cms->sqlquery("rs","uploads",$uploadFilesArr);
						}
					}			
				}
			}	
		}
	}
	
	if(isset($_POST['save_doc'])){
		$PROJECTARR['lead_id'] = $cms->getSingleResult("SELECT lead_id FROM #_leads WHERE id=".$_POST['cust_id']." ");
		$cms->sqlquery("rs","customer_project",$PROJECTARR,'id',$pid);
		
		//upload files
		if(isset($_FILES['doc_upload']) and count(array_filter($_FILES['doc_upload']['tmp_name']))>0){
			if(count($_FILES["doc_upload"]["name"])>0){				
				$pcount = count($_FILES["doc_upload"]["name"]);
				for($i=0; $i<$pcount; $i++){
					$uploadArr['file_title'] = $_POST['doc_title'][$i];										
					$uploadArr['file_type'] = 1;										
					if(!empty($_FILES["doc_upload"]["name"][$i])){
						$path = $_FILES["doc_upload"]["name"][$i];
						$end = pathinfo($path, PATHINFO_EXTENSION);
						$filename = $_FILES['doc_upload']['name'][$i]; 
						$file_loc = $_FILES['doc_upload']['tmp_name'][$i];
						$file_size = $_FILES['doc_upload']['size'][$i];
						$file_type = $_FILES['doc_upload']['type'][$i];
						$folder = FILES_PATH.UP_FILES_UPLOADS."/";
						// make file name in lower case
						$new_file_name = strtolower($filename);
						$final_file= str_replace(" ","-",$new_file_name);
						if($file_size>0 && $file_size>5000000){
							echo "<script>alert('File size should be less than 5MB')</script>";
						}else{
							move_uploaded_file($file_loc,$folder.$final_file);
							$uploadArr['display_order']=$i+1;
							$uploadArr['file_upload']=$final_file;
							//$uploadArr['proposal_id']=$lead_insert_id;
							$uploadArr['lead_id']=$PROJECTARR['lead_id'];
							//print_r($uploadArr);die;
							$cms->sqlquery("rs","uploads",$uploadArr);
						}
					}			
				}
			}	
		}
	}
	
	if(isset($_POST['save_picture'])){
		$PROJECTARR['lead_id'] = $cms->getSingleResult("SELECT lead_id FROM #_leads WHERE id=".$_POST['cust_id']." ");
		$cms->sqlquery("rs","customer_project",$PROJECTARR,'id',$pid);
		
		//upload files
		if(isset($_FILES['pic_upload']) and count(array_filter($_FILES['pic_upload']['tmp_name']))>0){
			if(count($_FILES["pic_upload"]["name"])>0){	
				$pcount = count($_FILES["pic_upload"]["name"]);
				for($i=0; $i<$pcount; $i++){
					$uploadArr['file_title'] = $_POST['pic_title'][$i];										
					$uploadArr['file_type'] = 2;
					if(!empty($_FILES["pic_upload"]["name"][$i])){
						$path = $_FILES["pic_upload"]["name"][$i];
						$end = pathinfo($path, PATHINFO_EXTENSION);
						$filename = $_FILES['pic_upload']['name'][$i]; 
						$file_loc = $_FILES['pic_upload']['tmp_name'][$i];
						$file_size = $_FILES['pic_upload']['size'][$i];
						$file_type = $_FILES['pic_upload']['type'][$i];
						$folder = FILES_PATH.UP_FILES_UPLOADS."/";
						// make file name in lower case
						$new_file_name = strtolower($filename);
						$final_file= str_replace(" ","-",$new_file_name);
						if($file_size>0 && $file_size>5000000){
							echo "<script>alert('File size should be less than 5MB')</script>";
						}else{
							move_uploaded_file($file_loc,$folder.$final_file);
							$uploadArr['display_order']=$i+1;
							$uploadArr['file_upload']=$final_file;
							//$uploadArr['proposal_id']=$lead_insert_id;
							$uploadArr['lead_id']=$PROJECTARR['lead_id'];
							//print_r($uploadArr);die;
							$cms->sqlquery("rs","uploads",$uploadArr);
						}
					}											
				}
			}	
		}
	}
	
	if(isset($_POST['save'])){
        // 	echo "<pre>";
        //     print_r( $_POST);
        //     echo "</pre>";
        //    die;
        $total_rec = $_POST['total_rec'];
        if($total_rec>0){
            $roofDetails =array();
            $roof_details_count= $total_rec;
            if($_POST['edit']){ $roof_details_count = $roof_details_count-1;  }
            //echo $roof_details_count;die;
            
                for($i=0;$i<=$roof_details_count;$i++){
                    if($_POST['total_panel'][$i] == 0){
						$roofDetails['total_panel'] = '';	
					}else{
                    $roofDetails['total_panel'] = $_POST['total_panel'][$i]; }
                    $roofDetails['roofing_material'] = $_POST['roofing_material'][$i];
                    $roofDetails['roof_support'] = $_POST['roof_support'][$i];
                    if($_POST['roof_angle'][$i] == 0){ $roofDetails['roof_angle'] = '';}else{
					$roofDetails['roof_angle'] = $_POST['roof_angle'][$i];}
                    $roofDetails['lead_id'] = $_POST['lead_id'];
                    $roofDetails['form_type'] = 'customer';
                    $roofDetails['status'] = 0;
                    if(empty($_POST['rec_id'][$i]))
                    { 
                        $cms->sqlquery("rs","roof_details",$roofDetails); 
                        
                        //print_r($roofDetails);
                        // die;
                    } 
                    else{
                       $cms->sqlquery("rs","roof_details",$roofDetails,'id',$_POST['rec_id'][$i]);
                    }
                    
                    // echo $i;die;
              
                
                $roofDetails = array();
                // echo "<script type='text/javascript'> alert(".json_encode($roofDetails).") </script>";
            }
			
    	}
		else{
			if(count($_POST['total_panel'])!=0 || count($_POST['roofing_material'])!=0 || count($_POST['roof_support'])!=0 ||  count($_POST['roof_angle'])!=0 )
			{
				$roofDetails['total_panel'] = $_POST['total_panel'];
				$roofDetails['roofing_material'] = $_POST['roofing_material'];
				$roofDetails['roof_support'] = $_POST['roof_support'];
				$roofDetails['roof_angle'] = $_POST['roof_angle'];
				$roofDetails['lead_id'] = $_POST['lead_id'];;
				$roofDetails['form_type'] = 'customer';
				$roofDetails['status'] = 0;
				if(empty($_POST['rec_id'][$i]))
				{ 
					$cms->sqlquery("rs","roof_details",$roofDetails); 
					
					//print_r($roofDetails);
					// die;
				} 
				// else{
				//    $cms->sqlquery("rs","roof_details",$roofDetails,'id',$_POST['rec_id'][$i]);
				// }
			}
    // die;
		}
		$cms->redir(SITE_PATH_ADM.CPAGE.'?mode=add&t=roof_details&id='.$pid, true);
    // die;
    
    }
	if(isset($_POST['checklist_submit']))
	{
			$project_checklistqrr = $cms->db_query("SELECT id FROM #_project_checklist WHERE project_id=".$pid." ");
			$project_checklistARR = $project_checklistqrr->fetch_array();
			
			if($project_checklistARR["id"]=="")
			{	
				$chkarr["project_id"]=$_POST["checklist_project_id"];
				$chkarr["roof_angle_filled"]=$_POST["roof_angle_filled"];
				$chkarr["number_of_roofs_filled"]=$_POST["number_of_roofs_filled"];
				$chkarr["raspont_needed_filled"]=$_POST["raspont_needed_filled"];
				$chkarr["kortling_needed_filled"]=$_POST["kortling_needed_filled"];
				$chkarr["fasadmatare_location_filled"]=$_POST["fasadmatare_location_filled"];
				$chkarr["elcentral_location_filled"]=$_POST["elcentral_location_filled"];
				$chkarr["house_type_filled"]=$_POST["house_type_filled"];
				$chkarr["placement_of_inverter_filled"]=$_POST["placement_of_inverter_filled"];
				$chkarr["placement_of_battery_filled"]=$_POST["placement_of_battery_filled"];
				$chkarr["digging_of_ground"]=$_POST["digging_of_ground"];
				$chkarr["distance_between_panels"]=$_POST["distance_between_panels"];
				$chkarr["distance_between_inverter_connection"]=$_POST["distance_between_inverter_connection"];
				$chkarr["distance_between_ev_and_connection"]=$_POST["distance_between_ev_and_connection"];
				$chkarr["all_equipment_placement_picture"]=$_POST["all_equipment_placement_picture"];
				$chkarr["inverter_placement_picture"]=$_POST["inverter_placement_picture"];
				$chkarr["ev_placement_picture"]=$_POST["ev_placement_picture"];
				$chkarr["battery_placement_picture"]=$_POST["battery_placement_picture"];
				$chkarr["roof_pictures"]=$_POST["roof_pictures"];
				$chkarr["pv_sol_report"]=$_POST["pv_sol_report"];
				$chkarr["mms_report_for_all"]=$_POST["mms_report_for_all"];
				$chkarr["mms_bom_report"]=$_POST["mms_bom_report"];
				$chkarr["string_diagram_picture"]=$_POST["string_diagram_picture"];
				$chkarr["panel_layout_pictures"]=$_POST["panel_layout_pictures"];
				
				 if(array_search("", $chkarr) !== false){$is_all_checked= 2;}else{$is_all_checked = 1;}
				  $chkarr["is_all_checked"]=$is_all_checked;
				 
				$cms->sqlquery("rs","project_checklist",$chkarr);
				
				$Proj_chkarr["is_all_checked"]=$is_all_checked;
				$cms->sqlquery("rs","customer_project",$Proj_chkarr,'id',$pid);
				
			}
			elseif($project_checklistARR["id"]!='')
			{	$_POST["project_id"]=$_POST["checklist_project_id"];
			//echo $_POST["checklist_id"];die;
			
				$chkarr["roof_angle_filled"]=$_POST["roof_angle_filled"];
				$chkarr["number_of_roofs_filled"]=$_POST["number_of_roofs_filled"];
				$chkarr["raspont_needed_filled"]=$_POST["raspont_needed_filled"];
				$chkarr["kortling_needed_filled"]=$_POST["kortling_needed_filled"];
				$chkarr["fasadmatare_location_filled"]=$_POST["fasadmatare_location_filled"];
				$chkarr["elcentral_location_filled"]=$_POST["elcentral_location_filled"];
				$chkarr["house_type_filled"]=$_POST["house_type_filled"];
				$chkarr["placement_of_inverter_filled"]=$_POST["placement_of_inverter_filled"];
				$chkarr["placement_of_battery_filled"]=$_POST["placement_of_battery_filled"];
				$chkarr["digging_of_ground"]=$_POST["digging_of_ground"];
				$chkarr["distance_between_panels"]=$_POST["distance_between_panels"];
				$chkarr["distance_between_inverter_connection"]=$_POST["distance_between_inverter_connection"];
				$chkarr["distance_between_ev_and_connection"]=$_POST["distance_between_ev_and_connection"];
				$chkarr["all_equipment_placement_picture"]=$_POST["all_equipment_placement_picture"];
				$chkarr["inverter_placement_picture"]=$_POST["inverter_placement_picture"];
				$chkarr["ev_placement_picture"]=$_POST["ev_placement_picture"];
				$chkarr["battery_placement_picture"]=$_POST["battery_placement_picture"];
				$chkarr["roof_pictures"]=$_POST["roof_pictures"];
				$chkarr["pv_sol_report"]=$_POST["pv_sol_report"];
				$chkarr["mms_report_for_all"]=$_POST["mms_report_for_all"];
				$chkarr["mms_bom_report"]=$_POST["mms_bom_report"];
				$chkarr["string_diagram_picture"]=$_POST["string_diagram_picture"];
				$chkarr["panel_layout_pictures"]=$_POST["panel_layout_pictures"];
				
				
				   if(array_search("", $chkarr) !== false){
					   $is_all_checked= 2;
				   }else{ $is_all_checked = 1;}
				   
				 $chkarr["is_all_checked"]=$is_all_checked;
				 $Proj_chkarr["is_all_checked"]=$is_all_checked;
				 
				$cms->sqlquery("rs","project_checklist",$chkarr,'id',$_POST["checklist_id"]);
				$cms->sqlquery("rs","customer_project",$Proj_chkarr,'id',$pid);
			}
			
			$cms->redir(SITE_PATH_ADM.CPAGE.'?mode=add&t=project_checklist&id='.$pid, true);
			
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
		
		// get check list
		$rsAdmin2=$cms->db_query("select * from #_project_checklist where project_id='".$pid."'");
		$arrAdmin2=$cms->db_fetch_array($rsAdmin2);
		@extract($arrAdmin2);
	}
	$customerPriceQry = $cms->db_query("SELECT * FROM #_customer_price where id=1 ");
	$customerPriceArr = $customerPriceQry->fetch_array(); 
	$lead_id = $cms->getSingleResult("SELECT lead_id FROM #_leads WHERE id=".$cust_id." ");
	//echo $lead_id;die;
	$roofFetchDetailsQry = $cms->db_query("SELECT * FROM #_roof_details where lead_id='$lead_id' AND status=0 AND is_deleted=0 ");
	$numRowsRoof = $roofFetchDetailsQry->num_rows;
	if($numRowsRoof>0){
	$roof_details_count = $numRowsRoof;
}
	
?>
<style>
	.arrow-steps .step {
		font-size: 14px;
		text-align: center;
		color: #fff;
		cursor: default;
		margin: 0 3px;
		padding: 10px 10px 10px 30px;
		min-width: 180px;
		float: left;
		position: relative;
		background-color: #23468c;
		-webkit-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none; 
	transition: background-color 0.2s ease;
	margin-bottom:10px;
	}

	.arrow-steps .step:after,
	.arrow-steps .step:before {
		content: " ";
		position: absolute;
		top: 0;
		right: -17px;
		width: 0;
		height: 0;
		border-top: 22px solid transparent;
		border-bottom: 17px solid transparent;
		border-left: 17px solid #23468c;	
		z-index: 2;
	transition: border-color 0.2s ease;
	}

	.arrow-steps .step:before {
		right: auto;
		left: 0;
		border-left: 17px solid #fff;	
		z-index: 0;
	}

	.arrow-steps .step:first-child:before {
		border: none;
	}

	.arrow-steps .step:first-child {
		border-top-left-radius: 4px;
		border-bottom-left-radius: 4px;
	}

	.arrow-steps .step span {
		position: relative;
	}

	.arrow-steps .step span:before {
		opacity: 0;
		content: "✔";
		position: absolute;
		top: -2px;
		left: -20px;
	}

	.arrow-steps .step.done span:before {
		opacity: 1;
		-webkit-transition: opacity 0.3s ease 0.5s;
		-moz-transition: opacity 0.3s ease 0.5s;
		-ms-transition: opacity 0.3s ease 0.5s;
		transition: opacity 0.3s ease 0.5s;
	}

	.arrow-steps .step.current {
		color: #fff !important;
		background-color: #30bc22;
		font-weight:600;
	}

	.arrow-steps .step.current:after {
		border-left: 17px solid #30bc22;	
	}
	#upload_files_box{
		border: 1px solid #eee;
		padding: 20px;
	}
	.purple-field{
		border: 2px solid #03a9f3;
	}
</style>

<!-- .row -->
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
			<?php if($t=='proj_info' || $t==''){ ?>
			<div class="arrow-steps clearfix">
				<?php foreach($proposalStatus as $pkey=>$pval){
					if($pkey==$status){
						$current = 'current';
					}else{
						$current = '';
					}
				?>
				<div class="step <?=$current?>"> <span> <?=$pval?></span> </div>
				<?php } ?>
			</div>
			<?php } ?>
			<?php
			$t=$_REQUEST["t"];
			
			$lnk1="#";
			$lnk2="#";
			if($pid>0){
				$lnk1="?mode=add&t=proj_info&id=".$pid;
				$lnk2="?mode=add&t=upload_info&id=".$pid;
				$lnk3="?mode=add&t=project_steps&id=".$pid;
				$lnk4="?mode=add&t=project_logs&id=".$pid;
				$lnk5="?mode=add&t=project_checklist&id=".$pid;
				// mk-19
				$lnk6="?mode=add&t=roof_details&id=".$pid;
			}					
			
			if($t=='proj_info' || $t=='' ){
				$active="active";
				$active1="active";
			}
			//mk-19
			elseif($t=='roof_details'){
				$active="active";
				$active6="active";
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
			elseif($t=='project_checklist'){
				$active="active";
				$active5="active";
			}
			else{
				
			}
			?>
			<ul class="nav nav-tabs" role="tablist1">
				<input type="hidden" name="lead_id" id="lead_id" value="<?=$lead_id?>">
				<li role="presentation" class="<?php echo $active1;?>"><a href="<?PHP echo $lnk1 ?>"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs">Project Info</span></a></li>
				<!-- mk-19 -->
				<li role="presentation" class="<?php echo $active6;?>"><a href="<?PHP echo $lnk6 ?>"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs">Roof Details</span></a></li>
				<li role="presentation" class="<?php echo $active5;?>"><a href="<?PHP echo $lnk5 ?>"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Checklist</span></a></li>
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
						<?php if($cust_id){
							$custQry = $cms->db_query("SELECT id, Customer_name, email, phone, quotation_number, personnummer FROM #_leads where id=$cust_id ");
							$custRes = $custQry->fetch_array();
							$showQuo = "display:block";
						}else{
							$showQuo = "display:none";
						}?>					
						<div class="form-group col-sm-3">
							<label for="cust_id" class="control-label">Customer Name</label>
							<input type="text" value="<?=$custRes['Customer_name']?>" class="form-control" readonly>
							<input type="hidden" name="cust_id" value="<?=$cust_id?>" class="form-control" id="cust_id">
						</div>
						<div class="form-group col-sm-3" id="personnummer_error">
							<label for="personnummer" class="control-label">Personnummer*</label>
							<input type="text" name="personnummer" value="<?=$custRes['personnummer']?>" class="form-control" id="personnummer" required>
						</div>
						<div class="clearfix"></div>
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
						<!-- mk-19: -->
						<div class="form-group col-sm-6">
							<div class="checkbox checkbox-success">
								<input type="checkbox" name="not_same_bill" id="ebill" value="1" class="ebill-box" <?=$not_same_bill?'checked':''?>>
								<label for="same_electric">Electric Connection NOT On Same name.</label>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="ebill form-row">
							<div class="form-group col-sm-3">
								<label for="cust_id" class="control-label">Customer Name</label>
								<input type="text" class="form-control" name="cust_name_bill" value="<?=$cust_name_bill?>" class="form-control" id="cust_name" >
							</div>
							<div class="form-group col-sm-3" id="personnummer_error">
								<label for="personnummer" class="control-label">Personnummer</label>
								<input type="text" name="personnummer_bill" value="<?=$personnummer_bill?>" class="form-control" id="personnummer" >
							</div>
							<!-- <div class="clearfix"></div> -->
							<div class="form-group col-sm-3 show-email" >
								<label for="email" class="control-label">Email</label>
								<input type="text" name="email_bill" value="<?=$email_bill?>" class="form-control" id="email" >
							</div>
							<div class="form-group col-sm-3 show-phone" >
								<label for="phone" class="control-label">Phone</label>
								<input type="text" name="phone_bill" value="<?=$phone_bill?>" class="form-control" id="phone" >
							</div>
						</div>
						<div class="clearfix"></div>
						<!-- mk-19 -->
					</div>
					<hr>
					<input type="hidden" name="project_id" value="<?=$pid?>">
					
					<div class="col-sm-12"><h2 class="form-section-heading">Roof Details -</h2></div>
					<div class="form-group col-sm-3">
						<label for="roof_material" class="control-label" style="<?=$sales_field_color?>">Roof Type</label>
						<input type="text" name="roof_material" value="<?=$roof_material?>" class="form-control" id="roof_material" readonly>
						<div class="help-block with-errors"></div>
					</div>	
					<div class="form-group col-sm-2">
						<label for="number_of_roof" class="control-label" style="<?=$sales_field_color?>">Number of Roofs</label>
						<input type="number" name="number_of_roof" value="<?=$number_of_roof?>" min="0" class="form-control" id="number_of_roof" data-fv-regexp="true" data-error="Please enter valid Name" readonly>
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
						<input type="text" name="facade_meter_location" value="<?=$facade_meter_location?>" class="form-control purple-field" id="facade_meter_location" data-fv-regexp="true" data-error="Please enter valid Name">
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group col-sm-4">
						<label for="elcentral_location" class="control-label" style="<?=$sales_field_color?>">Elcentral(er) location</label>
						<input type="text" name="elcentral_location" value="<?=$elcentral_location?>" class="form-control purple-field" id="elcentral_location" data-fv-regexp="true" data-error="Please enter valid Name">
						<div class="help-block with-errors"></div>
					</div>	
					<div class="form-group col-sm-3">
						<label for="house_type" class="control-label" style="<?=$sales_field_color?>">House Type* <span style=""><i class="fa fa-info-circle" title="Villa, Rådhus, Kedjehus" style="color:red;"></i></span></label>
						<input type="text" name="house_type" value="<?=$house_type?>" class="form-control purple-field" id="house_type" data-fv-regexp="true" data-error="Please enter valid Name" required>
						<div class="help-block with-errors"></div>
					</div>		
					<div class="clearfix"></div>
					<div class="form-group col-sm-3">
						<label for="inverter_placement" class="control-label" style="<?=$sales_field_color?>">Placement of Inverter</label>
						<input type="text" name="inverter_placement" value="<?=$inverter_placement?>" class="form-control purple-field" id="inverter_placement" data-fv-regexp="true" data-error="Please enter valid Name">
						<div class="help-block with-errors"></div>
					</div>	
					<div class="form-group col-sm-3">
						<label for="battery_placement" class="control-label" style="<?=$sales_field_color?>">Placement of battery</label>
						<input type="text" name="battery_placement" value="<?=$battery_placement?>" class="form-control purple-field" id="battery_placement" data-fv-regexp="true" data-error="Please enter valid Name">
						<div class="help-block with-errors"></div>
					</div>	
					<div class="form-group col-sm-3">
						<label for="ev_placement" class="control-label" style="<?=$sales_field_color?>">Placement of EV</label>
						<input type="text" name="ev_placement" value="<?=$ev_placement?>" class="form-control purple-field" id="ev_placement" data-fv-regexp="true" data-error="Please enter valid Name">
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
							<li id="<?=$siteImgRes['id']?>"><?=$siteImgRes['site_images']?> &nbsp;<a href="<?=SITE_PATH?><?=UPLOAD_FILES_PTH?>/<?=UP_FILES_REPORTS?>/<?=$siteImgRes['site_images']?>" download>View</a> &nbsp; <a href="javascript:void(0)" class="remove_icon" onClick="remove_file('<?=$siteImgRes['id']?>','<?=$siteImgRes['site_images']?>')" data-toggle="tooltip" data-original-title="Delete File"><img src="<?=SITE_PATH_ADM?>images/close-btn.png"></a></li>
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
						<label class="control-label">Panel Type</label>
						<select class="form-control select2" id="panel_name" name="panel_name" id="panel_name">
							<option value="">Select Panel Type</option>
							<?php $panelTyeArray = json_decode($customerPriceArr["panel_types"], true);
							usort($panelTyeArray, function ($a, $b) {
								return $a['name'] <=> $b['name'];
							});
							foreach ($panelTyeArray as $key => $value) {
								if($value["pstatus"]==1){
									if($panel_name==$value["name"]){
										$psel = 'selected';
									}else{
										$psel = '';
									}
									echo '<option value="'.$value["name"].'" '.$psel.'>'.$value["name"].' - '.$value["wattage"].' Wp</option>';
							} 	}
							?>
						</select>
					</div>
					<div class="form-group col-sm-3">
						<label for="short_circuit" class="control-label">Kortslutningsström</label>
						<input type="text" name="short_circuit" value="<?=$short_circuit?>" class="form-control" id="short_circuit" readonly>
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group col-sm-3">
						<label for="effektfaktor" class="control-label">Effektfaktor</label>
						<input type="text" name="effektfaktor" value="<?=$effektfaktor?>" class="form-control" id="effektfaktor" readonly>
					</div>
					<div class="form-group col-sm-3">
						<label for="system_size" class="control-label">Storleken på system (Wp)</label>
						<input type="text" name="system_size" value="<?=$system_size?>" class="form-control" id="system_size" readonly>
					</div>
					<div class="clearfix"></div>
					
					<?php if($inverter1){
						$inverter_type1_style = "";
					}else{
						$inverter_type1_style = "display:none";
					}?>
					<div class="form-group col-md-3" id="show_inverter1" style="<?=$inverter_type1_style?>">
						<div class="form-group">
							<label class="control-label">Inverter Type 1</label>
							<select class="form-control select2" id="inverter1" name="inverter1">
								<option value="">Select Inverter Type</option>
								<?php $inverterTyeArray = json_decode($customerPriceArr["inverter_types"], true);
								usort($inverterTyeArray, function ($a, $b) {
									return $a['name'] <=> $b['name'];
								});
								foreach ($inverterTyeArray as $ikey => $ivalue) {
									if($ivalue["invstatus"]){
									if($inverter1==$ivalue["name"]){
										$invsel = 'selected';
									}else{
										$invsel = '';
									}
									echo '<option value="'.$ivalue["name"].'" '.$invsel.'>'.$ivalue["name"].'</option>';
								} }
								?>
							</select>
						</div>
						<div class="form-group" id="inverter1_qty" style="<?=$inverter_type1_style?>">
							<label for="inverter1_qty" class="control-label">Inverter Type 1 Quantity</label>
							<input type="number" class="form-control" name="inverter1_qty" min="1" value="<?=$inverter1_qty?>">
							<input type="hidden" class="form-control" name="inverter1_effect" id="inverter1_effect" value="<?=$inverter1_effect?>">
						</div>
					</div>
					
					<?php if($inverter2){
						$inverter_type2_style = "";
					}else{
						$inverter_type2_style = "display:none";
					}?>
					<div class="form-group col-md-3" id="show_inverter2" style="<?=$inverter_type2_style?>">
						<div class="form-group">
							<label class="control-label">Inverter Type 2</label>
							<select class="form-control select2" id="inverter2" name="inverter2">
								<option value="">Select Inverter Type</option>
								<?php $inverterTyeArray = json_decode($customerPriceArr["inverter_types"], true);
								usort($inverterTyeArray, function ($a, $b) {
									return $a['name'] <=> $b['name'];
								});
								foreach ($inverterTyeArray as $ikey => $ivalue) {
									if($ivalue["invstatus"]){
									if($inverter2==$ivalue["name"]){
										$invsel = 'selected';
									}else{
										$invsel = '';
									}
									echo '<option value="'.$ivalue["name"].'" '.$invsel.'>'.$ivalue["name"].'</option>';
								} }
								?>
							</select>
						</div>
						
						<div class="form-group" id="inverter2_qty" style="<?=$inverter_type2_style?>">
							<label for="inverter2_qty" class="control-label">Inverter Type 2 Quantity</label>
							<input type="number" class="form-control" name="inverter2_qty" min="1" value="<?=$inverter2_qty?>">
							<input type="hidden" class="form-control" name="inverter2_effect" id="inverter2_effect" value="<?=$inverter2_effect?>">
						</div>
					</div>
					
					<?php if($inverter3){
						$inverter_type3_style = "";
					}else{
						$inverter_type3_style = "display:none";
					}?>
					<div class="form-group col-md-3" id="show_inverter3" style="<?=$inverter_type3_style?>">
						<div class="form-group">
							<label class="control-label">Inverter Type 3</label>
							<select class="form-control select2" id="inverter3" name="inverter3">
								<option value="">Select Inverter Type</option>
								<?php $inverterTyeArray = json_decode($customerPriceArr["inverter_types"], true);
								usort($inverterTyeArray, function ($a, $b) {
									return $a['name'] <=> $b['name'];
								});
								foreach ($inverterTyeArray as $ikey => $ivalue) {
									if($ivalue["invstatus"]){
									if($inverter3==$ivalue["name"]){
										$invsel = 'selected';
									}else{
										$invsel = '';
									}
									echo '<option value="'.$ivalue["name"].'" '.$invsel.'>'.$ivalue["name"].'</option>';
								} }
								?>
							</select>
						</div>
						
						<div class="form-group" id="inverter3_qty" style="<?=$inverter_type3_style?>">
							<label for="inverter3_qty" class="control-label">Inverter Type 3 Quantity</label>
							<input type="number" class="form-control" name="inverter3_qty" min="1" value="<?=$inverter3_qty?>">
							<input type="hidden" class="form-control" name="inverter3_effect" id="inverter3_effect" value="<?=$inverter3_effect?>">
						</div>
					</div>
					<div class="clearfix"></div>
					
					<?php if($ev_charger){
						$showcharger = "";
					}else{
						$showcharger = "display:none";
					}?>
					
					<div class="col-sm-3 charger_show" style="<?=$showcharger?>">
						<div class="form-group">
							<label class="control-label">EV Charger Type</label>
							<select class="form-control" id="ev_charger" name="ev_charger" required>
								<option value="">Select EV Charger</option>
								<?php $chargerTyeArray = json_decode($customerPriceArr["ev_charger_types"], true);
								usort($chargerTyeArray, function ($a, $b) {
									return $a['name'] <=> $b['name'];
								});
								foreach ($chargerTyeArray as $ckey => $cvalue) {
									if($cvalue["evstatus"]==1){
									if($ev_charger==$cvalue["name"]){
										$csel = 'selected';
									}else{
										$csel = '';
									}
									echo '<option value="'.$cvalue["name"].'" '.$csel.'>'.$cvalue["name"].'</option>';
								} }
								?>
							</select>
						</div>
						
						<div class="form-group" id="ev_quantity" style="<?=$showcharger?>">
							<label for="ev_quantity" class="control-label">Charger Quantity</label>
							<input type="number" class="form-control" name="ev_quantity" min="1" value="<?=$ev_quantity?>">
						</div>
					</div>
					
					<?php if($battery){
						$showbattery = "";
					}else{
						$showbattery = "display:none";
					}?>
					<div class="form-group col-md-3 battery_show" style="<?=$showbattery?>">
						<div class="form-group">
							<label class="control-label">Battery</label>
							<select class="form-control" id="battery" name="battery" required>
								<option value="">Select Battery</option>
								<?php $batteryTyeArray = json_decode($customerPriceArr["battery_types"], true);
								usort($batteryTyeArray, function ($a, $b) {
									return $a['name'] <=> $b['name'];
								});
								foreach ($batteryTyeArray as $bkey => $bvalue) {
									if($bvalue["bstatus"]==1){
									if($battery==$bvalue["name"]){
										$bsel = 'selected';
									}else{
										$bsel = '';
									}
									echo '<option value="'.$bvalue["name"].'" '.$bsel.'>'.$bvalue["name"].'</option>';
								} }
								?>
							</select>
						</div>
						
						<div class="form-group" id="battery_quantity" style="<?=$showbattery?>">
							<label for="battery_quantity" class="control-label">Battery Quantity</label>
							<input type="number" class="form-control" name="battery_quantity" min="1" value="<?=$battery_quantity?>">
							<input type="hidden" class="form-control" name="battery_size" value="<?=$battery_size?>" id="battery_size">
						</div>
					</div>
					<div class="clearfix"></div>
					
					<?php if($smart_sensor_name){
						$sensor_style = "";
					}else{
						$sensor_style = "display:none";
					}?>
					<div class="form-group col-md-4 show_sensor" style="<?=$sensor_style?>">
						<div class="form-group">
							<label class="control-label">Smart Sensor</label>
							<select class="form-control" id="smart_sensor_name" name="smart_sensor_name">
								<option value="">Select Smart Sensor</option>
								<?php $sensorTypeArray = json_decode($customerPriceArr["sensor_type"], true);
								usort($sensorTypeArray, function ($a, $b) {
									return $a['sensor_name'] <=> $b['sensor_name'];
								});
								foreach ($sensorTypeArray as $snkey => $snvalue) {
									if($snvalue["sensor_status"]==1){
									if($smart_sensor_name==$snvalue["sensor_name"]){
										$snsel = 'selected';
									}else{
										$snsel = '';
									}
									echo '<option value="'.$snvalue["sensor_name"].'" '.$snsel.'>'.$snvalue["sensor_name"].'</option>';
								} }
								?>
							</select>
						</div>
						
						<div class="form-group" id="smart_sensor_qty" style="<?=$sensor_style?>">
							<label for="smart_sensor_qty" class="control-label">Smart Sensor Quantity</label>
							<input type="number" class="form-control" name="smart_sensor_qty" min="1" value="<?=$smart_sensor_qty?>">
						</div>
					</div>
					
					<?php if($odrift_name){
						$odrift_style = "";
					}else{
						$odrift_style = "display:none";
					}?>
					<div class="form-group col-md-4 show_odrift" style="<?=$odrift_style?>">
						<div class="form-group">
							<label class="control-label">Backup Box</label>
							<select class="form-control" id="odrift_name" name="odrift_name">
								<option value="">Select Backup Box</option>
								<?php $odriftTypeArray = json_decode($customerPriceArr["odrift_type"], true);
								usort($odriftTypeArray, function ($a, $b) {
									return $a['odrift_name'] <=> $b['odrift_name'];
								});
								foreach ($odriftTypeArray as $odkey => $odvalue) {
									if($odvalue["odrift_status"]==1){
									if($odrift_name==$odvalue["odrift_name"]){
										$snsel = 'selected';
									}else{
										$snsel = '';
									}
									echo '<option value="'.$odvalue["odrift_name"].'" '.$snsel.'>'.$odvalue["odrift_name"].'</option>';
								} }
								?>
							</select>
						</div>
						
						<div class="form-group" id="odrift_quantity" style="<?=$odrift_style?>">
							<label for="odrift_quantity" class="control-label">Backup Box Quantity</label>
							<input type="number" class="form-control" name="odrift_quantity" min="1" value="<?=$odrift_quantity?>">
						</div>
					</div>
					
					<?php if($optimizer_name){
						$optimizer_style = "";
					}else{
						$optimizer_style = "display:none";
					}?>
					<div class="form-group col-md-4 show_optimizer" style="<?=$optimizer_style?>">
						<div class="form-group">
							<label class="control-label">Optimizer</label>
							<select class="form-control" id="optimizer_name" name="optimizer_name">
								<option value="">Select Optimizer</option>
								<?php $optimizerTypeArray = json_decode($customerPriceArr["optimizer_type"], true);
								usort($optimizerTypeArray, function ($a, $b) {
									return $a['optimizer_name'] <=> $b['optimizer_name'];
								});
								foreach ($optimizerTypeArray as $odkey => $odvalue) {
									if($odvalue["optimizer_status"]==1){
									if($optimizer_name==$odvalue["optimizer_name"]){
										$snsel = 'selected';
									}else{
										$snsel = '';
									}
									echo '<option value="'.$odvalue["optimizer_name"].'" '.$snsel.'>'.$odvalue["optimizer_name"].'</option>';
								} }
								?>
							</select>
						</div>
						
						<div class="form-group" id="optimizer_quantity" style="<?=$optimizer_style?>">
							<label for="optimizer_quantity" class="control-label">Optimizer Quantity</label>
							<input type="number" class="form-control" name="optimizer_quantity" min="1" value="<?=$optimizer_quantity?>">
						</div>
					</div>
					<div class="clearfix"></div>
					<hr>					
					<div class="col-sm-12"><h2 class="form-section-heading">Distance -</h2></div>
					<div class="form-group col-sm-4">
						<label for="distance_panel_inverter" class="control-label" style="<?=$sales_field_color?>">between panels and inverter</label>
						<input type="text" name="distance_panel_inverter" value="<?=$distance_panel_inverter?>" class="form-control purple-field" id="distance_panel_inverter" data-fv-regexp="true" data-error="Please enter valid Name">
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group col-sm-4">
						<label for="distance_inverter_connection_point" class="control-label" style="<?=$sales_field_color?>">between inverter and connection point (AC)</label>
						<input type="text" name="distance_inverter_connection_point" value="<?=$distance_inverter_connection_point?>" class="form-control purple-field" id="distance_inverter_connection_point" data-fv-regexp="true" data-error="Please enter valid Name">
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group col-sm-4">
						<label for="distance_ev_connection_point" class="control-label" style="<?=$sales_field_color?>">between EV and connection point</label>
						<input type="text" name="distance_ev_connection_point" value="<?=$distance_ev_connection_point?>" class="form-control purple-field" id="distance_ev_connection_point" data-fv-regexp="true" data-error="Please enter valid Name">
						<div class="help-block with-errors"></div>
					</div>			
					<div class="clearfix" id="grid_details"></div>
					<hr>
					<div class="col-sm-12"><h2 class="form-section-heading">Grid Details -</h2></div>
					<div class="form-group col-sm-3">
						<label for="grid_provider" class="control-label" style="<?=$sales_field_color?>">Grid provider*</label>
						<select class="form-control" name="grid_provider" id="grid_provider" required>
							<option value="">Select Grid provider</option>
							<?php foreach($gridProvider as $gid=>$gval){
								if($grid_provider==$gid){
									$gsel = 'selected';
								}else{
									$gsel = '';
								}
							?>
							<option value="<?=$gid?>" <?=$gsel?>><?=$gval?></option>
							<?php } ?>
						</select>
						<div class="help-block with-errors"></div>
					</div>
					<?php if($grid_provider==4 && $grid_provider_name!=''){
						$gp_style="";
					}else{
						$gp_style="display:none;";
					}?>
					<div class="form-group col-sm-3 other-grid-provider" style="<?=$gp_style?>">
						<label for="grid_provider_name" class="control-label">Grid Provider Name</label>
						<input type="text" name="grid_provider_name" value="<?=$grid_provider_name?>" class="form-control purple-field" id="grid_provider_name">
						<div class="help-block with-errors"></div>
					</div>	
					<div class="form-group col-sm-3">
						<label for="grid_template" class="control-label" style="<?=$sales_field_color?>">Grid provider template*</label>
						<select class="form-control" name="grid_template" id="grid_template" required>
							<option value="">Select Grid provider</option>
							<?php foreach($gridTemplate as $gid=>$gval){
								if($grid_template==$gid){
									$gsel = 'selected';
								}else{
									$gsel = '';
								}
							?>
							<option value="<?=$gid?>" <?=$gsel?>><?=$gval?></option>
							<?php } ?>
						</select>
					</div>	
					<?php if($pid){?>
					<?php if($grid_provider_template==''){?>
					<div class="form-group col-sm-2" style="margin-top:25px;">						
						<a class="fcbtn btn btn-warning btn-outline btn-1b" href="javascript:void()" onclick="generate()"> Generate</a> <span style=""><i class="fa fa-info-circle" title="Make sure following data is filled: Personnummer, Address, House Type, Grid provider, Grid provider template, AnläggningsID, Huvudsäkring" style="color:red;"></i></span>
					</div>
					<?php }if($grid_provider_template){?>
					<div class="form-group col-sm-1 text-center" style="margin-top:25px;">						
						<a href="<?=SITE_PATH.UPLOAD_FILES_PTH.'/'.UP_FILES_GRID_PROVIDERS.'/'.$grid_provider_template?>" class="btn btn-success btn-circle" download><i class="fa fa-file-pdf-o"></i> </a>
					</div>
					<div class="form-group col-sm-2" style="margin-top:25px;">						
						<a class="fcbtn btn btn-primary btn-outline btn-1c" href="javascript:void()" onclick="generate()"> Re-generate </a> <span style=""><i class="fa fa-info-circle" title="Make sure following data is filled: Personnummer, Address, House Type, Grid provider, Grid provider template, AnläggningsID, Huvudsäkring" style="color:red;"></i></span>
					</div>
					<?php } ?>
					<?php } ?>
					<div class="clearfix"></div>
					<div class="form-group col-sm-3">
						<label for="plant_id" class="control-label" style="<?=$sales_field_color?>">AnläggningsID*</label>
						<input type="text" name="plant_id" value="<?=$plant_id?>" class="form-control purple-field" id="plant_id" data-fv-regexp="true" data-error="Please enter valid Name" required>
						<div class="help-block with-errors"></div>
					</div>	
					<div class="form-group col-sm-3">
						<label for="pre_registration_date" class="control-label" style="<?=$sales_field_color?>">Föranmälan date</label>
						<div class="input-group">
							<?php 
							if(!empty($pre_registration_date) AND $pre_registration_date!='0000-00-00'){
								$pre_registration_date = date("m/d/Y", strtotime($pre_registration_date));
							}else{
								$pre_registration_date ="";
							}
							?>
							<input type="text" class="form-control" name="pre_registration_date" id="pre_registration_date"  value="<?=$pre_registration_date?>" autocomplete="off">
							<span class="input-group-addon"><i class="icon-calender"></i></span> 
						</div>
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group col-sm-3">
						<label for="main_fuse" class="control-label">Huvudsäkring*</label>
						<input type="text" name="main_fuse" value="<?=$main_fuse?>" class="form-control purple-field" id="main_fuse" data-fv-regexp="true" data-error="Please enter valid Name" required>
						<div class="help-block with-errors"></div>
					</div>
					<?php if($pid){?>
					<div class="form-group col-sm-2" style="margin-top:25px;">						
						<?php if($project_report_name && file_exists(FILES_PATH.UP_FILES_REPORTS.'/'.$project_report_name)){?>
						<a class="fcbtn btn btn-warning btn-outline btn-1b" href="<?=SITE_PATH.UPLOAD_FILES_PTH.'/'.UP_FILES_REPORTS.'/'.$project_report_name?>" download> Download</a>
						<?php } ?>
					</div>
					<?php } ?>
					<div class="clearfix"></div>
					<?php $proposal_customer_type = $cms->getSingleResult("Select proposal_customer_type from #_leads where id=".$cust_id." ");
					if($proposal_customer_type==2){?>
					<div class="col-sm-2" style="margin-top:24px;">				
						<div class="checkbox checkbox-success">
							<input id="enskild_firma" type="checkbox" name="enskild_firma" <?=$enskild_firma==1?'checked':''?>>
							<label for="enskild_firma">Enskild Firma</label>
						</div>
					</div>
					<?php if($enskild_firma==1){
						$comp_style = "";
						$comp_req = "required";
					}else{
						$comp_style = "display:none;";
						$comp_req = "";
					}?>
					<div class="form-group col-sm-3 show_company">
						<label for="company_name" class="control-label">Company Name</label>
						<input type="text" name="company_name" value="<?=$company_name?>" class="form-control" id="company_name" <?=$comp_req?>>
					</div>
					<div class="form-group col-sm-3">
						<label for="org_number" class="control-label">Organization Number</label>
						<input type="text" name="org_number" value="<?=$org_number?>" class="form-control" id="org_number">
					</div>
					<div class="clearfix"></div>
					<?php } ?>
					<?php if($electricity_meter && $grid_template==3){
						$emStyle = "";
					}else{
						$emStyle = "display:none";
					}?>
					<div class="form-group col-sm-3" id="show_el_meter" style="<?=$emStyle?>">
						<label for="electricity_meter" class="control-label">El meter location*</label>
						<select class="form-control" name="electricity_meter" id="electricity_meter" required>
							<option value="">Select Value</option>
							<?php foreach($electricityMeterArr as $emid=>$emval){
								if($electricity_meter==$emid){
									$emsel = 'selected';
								}else{
									$emsel = '';
								}
							?>
							<option value="<?=$emid?>" <?=$emsel?>><?=$emval?></option>
							<?php } ?>
						</select>
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
							<li id="<?=$siteImgRes['id']?>"><?=$siteImgRes['acknowledgement_files']?> &nbsp;<a href="<?=SITE_PATH?><?=UPLOAD_FILES_PTH?>/<?=UP_FILES_REPORTS?>/<?=$siteImgRes['acknowledgement_files']?>" download>View</a> &nbsp; <a href="javascript:void(0)" class="remove_icon" onClick="remove_file('<?=$siteImgRes['id']?>','<?=$siteImgRes['acknowledgement_files']?>')" data-toggle="tooltip" data-original-title="Delete File"><img src="<?=SITE_PATH_ADM?>images/close-btn.png"></a></li>
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
							<input type="text" class="form-control" name="panel_planned_start_date" id="planned_start_date" value="<?=$panel_planned_start_date?>" placeholder="Date From" autocomplete="off">
							<span class="input-group-addon bg-info b-0 text-white">to</span>
							<input type="text" class="form-control" name="panel_planned_end_date" id="planned_end_date" value="<?=$panel_planned_end_date?>" placeholder="Date To" autocomplete="off">
						</div>
					</div>			
					<div class="form-group col-sm-6">
						<label for="panel_finish_start_date" class="control-label" style="<?=$mgr_field_color?>">Panel installation finish date</label>
						<div class="input-daterange input-group" id="date-range">
							<input type="text" class="form-control" name="panel_finish_start_date" id="finish_start_date" value="<?=$panel_finish_start_date?>" placeholder="Date From" autocomplete="off">
							<span class="input-group-addon bg-info b-0 text-white">to</span>
							<input type="text" class="form-control" name="panel_finish_end_date" id="finish_end_date" value="<?=$panel_finish_end_date?>" placeholder="Date TO" autocomplete="off">
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
							<input type="text" class="form-control" name="electrical_planned_start_date" id="electrical_planned_start_date" value="<?=$electrical_planned_start_date?>" placeholder="Date From" autocomplete="off">
							<span class="input-group-addon bg-info b-0 text-white">to</span>
							<input type="text" class="form-control" name="electrical_planned_end_date" id="electrical_planned_end_date" value="<?=$electrical_planned_end_date?>" placeholder="Date To" autocomplete="off">
						</div>
					</div>
					<div class="form-group col-sm-6">
						<label for="electrical_finish_start_date" class="control-label" style="<?=$mgr_field_color?>">Electrical installation finish date</label>
						<div class="input-daterange input-group" id="date-range">
							<input type="text" class="form-control" name="electrical_finish_start_date" id="electrical_finish_start_date" value="<?=$electrical_finish_start_date?>" placeholder="Date From" autocomplete="off">
							<span class="input-group-addon bg-info b-0 text-white">to</span>
							<input type="text" class="form-control" name="electrical_finish_end_date" id="electrical_finish_end_date" value="<?=$electrical_finish_end_date?>" placeholder="Date to" autocomplete="off">
						</div>
					</div>
		
					<div class="form-group col-sm-3">
						<label for="status" class="control-label">Project Status</label>
						<input type="hidden" name="old_status" value="<?=$status?>">
						<select name="status" id="status" class="form-control">
							<?php foreach($proposalStatus as $pskey=>$psval){
								if($pskey==$status){
									$psSel = 'selected';
								}else{
									$psSel = '';
								}
							?>
							<option value="<?=$pskey?>" <?=$psSel?>><?=$psval?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group col-sm-12">
						<?php if((in_array($act_arr[1],$_SESSION["url"][$Sys_Gl_module_id]) || !in_array($act_arr[3],$_SESSION["url"][$Sys_Gl_module_id])) || $_SESSION["ses_adm_id"]==1){?>
						<button type="submit" class="btn add-submit-btn" id="check_submit">Submit</button>
						<?php } ?>
						<button type="button" onclick="history.go(-1)" class="btn back-btn">Back</button>
					</div>
					<div class="clearfix"></div>
				</div>
				
				<!--S:Roof Details Tab -->
                <div role="tabpanel" class="tab-pane <?php echo $active6;?>" id="roof_details">
                    <div class="list_wrapper list_wrapper5">
                    <?php if($numRowsRoof>0) {
                        $i=0;
                        while($roofFetchDetailsArr = $roofFetchDetailsQry->fetch_array())
                        { @extract($roofFetchDetailsArr); 
                    ?>
                    <!-- S:Edit-->
                        <div class="row" id="btrow<?=$i?>">
                            <div class="form-group col-md-12">
                                <h3>Roof Details:&nbsp;<?= $i+1;?></h3>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="total-pannel" class="control-label">Total Panel</label>
                                <input type="number" class="form-control" name="total_panel[<?=$i?>]" id="total_panel[<?=$i?>]" value="<?=$total_panel?>" min="1">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="roofing_material" class="control-label">Roof Type</label>
                                <select class="form-control" id="roofing_material[<?=$i?>]" name="roofing_material[<?=$i?>]" <?= $readonly_field ?>>
                                    <option value="">Select Roof type</option>
                                    <?php $roofTypePriceArr = json_decode($customerPriceArr["roof_type_price"], true);
                                    foreach ($roofTypePriceArr as $rkey => $rvalue) {
                                    if ($rvalue["rfstatus"] == 1) {
                                        if ($roofing_material == $rvalue["name"]) {
                                            $rsel = 'selected';
                                            } else {
                                            $rsel = '';
                                        }
                                            echo '<option value="' . $rvalue["name"] . '" ' . $rsel . '>' . $rvalue["name"] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="roof-support" class="control-label">Roof Support</label><br>
                                <select class="form-control" id="roof_support[<?=$i?>]" name="roof_support[<?=$i?>]">
                                    <option value="">Select Roof Support</option>
                                        <option value="1" <?php if($roof_support == 1){ echo 'Selected';}?>>Råspont</option>
                                        <option value="2" <?php if($roof_support == 2){ echo 'Selected';}?>>No Råspont</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="roof_angle" class="control-label">Roof Angle</label>
                                <input type="number" class="form-control" name="roof_angle[<?=$i?>]" id="roof_angle<?=$i?>" value="<?= $roof_angle ?>" <?= $readonly_field ?> min="1">
                            </div>
                            <input type="hidden" name="rec_id[<?=$i?>]" value="<?= $id ?>">
                            
                            <div class="col-xs-1 col-sm-7 col-md-1">
                                <label for="remove" class="control-label">Action</label>
                                <a href="javascript:void(0);" class="list_remove_button btn btn-danger " onClick="remove_roof_details('<?= $id ?>')">-</a>
                            </div>
                        </div>
                        <input type="hidden" name="edit" value="1">
                        <hr>        
                        <!-- E:Edit -->
                        <?php $i++; } } else{ ?>

                        <!-- S:create new -->
                        <div class="row" id="btrow<?=$i?>">
                            <div class="form-group col-md-2">
                                <label for="total-pannel" class="control-label">Total Panel</label>
                                <input type="number" class="form-control" name="total_panel[<?=$i?>]" id="total_panel[<?=$i?>]">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="roofing_material" class="control-label">Roof Type</label>
                                <select class="form-control" id="roofing_material[<?=$i?>]" name="roofing_material[<?=$i?>]" <?= $readonly_field ?>>
                                    <option value="">Select Roof type</option>
                                    <?php $roofTypePriceArr = json_decode($customerPriceArr["roof_type_price"], true);
                                    foreach ($roofTypePriceArr as $rkey => $rvalue) {
                                    if ($rvalue["rfstatus"] == 1) {
                                        if ($roofing_material == $rvalue["name"]) {
                                            $rsel = 'selected';
                                            } else {
                                            $rsel = '';
                                        }
                                            echo '<option value="' . $rvalue["name"] . '" ' . $rsel . '>' . $rvalue["name"] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="roof-support" class="control-label">Roof Support</label><br>
                                <select class="form-control" id="roof_support[<?=$i?>]" name="roof_support[<?=$i?>]">
                                    <option value="">Select Roof Support</option>
                                        <option value="1">Råspont</option>
                                        <option value="2">No Råspont</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="roof_angle" class="control-label">Roof Angle</label>
                                <input type="text" class="form-control" name="roof_angle[<?=$i?>]" id="roof_angle<?=$i?>" <?= $readonly_field ?>>
                            </div> 
                        </div>
                                    
                        <!-- E:create new -->
                        <?php } ?>
                    </div>
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <h3>Add New <button class="btn btn-primary list_add_button5" type="button">+</button></h3>
                        </div>
                        <input type="hidden" name="total_rec" id="total_rec" value="<?=$roof_details_count?>">
                        <div class="form-group col-sm-12">
                            <button type="submit" class="btn add-submit-btn" name="save" value="1">Save Roof Details</button>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <!--E:Roof Details Tab -->

				
				
				<div role="tabpanel" class="tab-pane <?php echo $active5;?>" id="project_checklist">
						<div class="">
							
							<div class="row">
							<div class="form-group col-sm-1"><h4>Sales</h4></div><div class="form-group col-sm-11"></div>
						
						<div class="" style="margin-left:40px;">
							<div class="form-group col-sm-12">
							
								
								<div class="checkbox checkbox-success">
									<input type="checkbox" name="roof_angle_filled" id="roof_angle_filled" value="1" <?=$roof_angle_filled?'checked':''?>>
									<label for="">Roof angle filled</label>
								</div>
							</div>
							<div class="form-group col-sm-12">
							
								
								<div class="checkbox checkbox-success">
									<input type="checkbox" name="number_of_roofs_filled" id="number_of_roofs_filled" value="1" <?=$number_of_roofs_filled?'checked':''?>>
									<label for="">Number of roofs filled</label>
								</div>
							</div>
							<div class="form-group col-sm-12">
							
								
								<div class="checkbox checkbox-success">
									<input type="checkbox" name="raspont_needed_filled" id="raspont_needed_filled" value="1" <?=$raspont_needed_filled?'checked':''?>>
									<label for="">Råspont needed filled</label>
								</div>
							</div>
							<div class="form-group col-sm-12">
							
								
								<div class="checkbox checkbox-success">
									<input type="checkbox" name="kortling_needed_filled" id="kortling_needed_filled" value="1" <?=$kortling_needed_filled?'checked':''?>>
									<label for="">Kortling needed filled</label>
								</div>
							</div>
							<div class="form-group col-sm-12">
							
								
								<div class="checkbox checkbox-success">
									<input type="checkbox" name="fasadmatare_location_filled" id="fasadmatare_location_filled" value="1" <?=$fasadmatare_location_filled?'checked':''?>>
									<label for="">Fasadmätare location filled</label>
								</div>
							</div>
							<div class="form-group col-sm-8">
							
								
								<div class="checkbox checkbox-success">
									<input type="checkbox" name="elcentral_location_filled" id="elcentral_location_filled" value="1" <?=$elcentral_location_filled?'checked':''?>>
									<label for="">Elcentral location filled</label>
								</div>
							</div>
							<div class="form-group col-sm-8">
							
								
								<div class="checkbox checkbox-success">
									<input type="checkbox" name="house_type_filled" id="house_type_filled" value="1" <?=$house_type_filled?'checked':''?>>
									<label for="">House type filled</label>
								</div>
							</div>
							<div class="form-group col-sm-8">
							
								
								<div class="checkbox checkbox-success">
									<input type="checkbox" name="placement_of_inverter_filled" id="placement_of_inverter_filled" value="1" <?=$placement_of_inverter_filled?'checked':''?>>
									<label for="">Placement of inverter filled</label>
								</div>
							</div>
							<div class="form-group col-sm-8">
							
								
								<div class="checkbox checkbox-success">
									<input type="checkbox" name="placement_of_battery_filled" id="placement_of_battery_filled" value="1" <?=$placement_of_battery_filled?'checked':''?>>
									<label for="">Placement of battery filled (relevant for project with battery)</label>
								</div>
							</div>
							<div class="form-group col-sm-8">
							
								
								<div class="checkbox checkbox-success">
									<input type="checkbox" name="digging_of_ground" id="digging_of_ground" value="1" <?=$digging_of_ground?'checked':''?>>
									<label for="">Digging of ground for cabling filled</label>
								</div>
							</div>
							<div class="form-group col-sm-8">
							
								
								<div class="checkbox checkbox-success">
									<input type="checkbox" name="distance_between_panels" id="distance_between_panels" value="1" <?=$distance_between_panels?'checked':''?>>
									<label for="">Distance between panels and inverter filled</label>
								</div>
								</div>
							
							<div class="form-group col-sm-8">
							
								
								<div class="checkbox checkbox-success">
									<input type="checkbox" name="distance_between_inverter_connection" id="distance_between_inverter_connection" value="1" <?=$distance_between_inverter_connection?'checked':''?>>
									<label for="">Distance between inverter and connection point (AC) filled</label>
								</div>
							</div>
							<div class="form-group col-sm-8">
							
								
								<div class="checkbox checkbox-success">
									<input type="checkbox" name="distance_between_ev_and_connection" id="distance_between_ev_and_connection" value="1" <?=$distance_between_ev_and_connection?'checked':''?>>
									<label for="">Distance between EV and connection point filled</label>
								</div>
							</div>
							</div>
						</div>
							
						<div class="row">
							<div class="form-group col-sm-1"><h4>Picture </h4></div><div class="form-group col-sm-11"></div>
						
						<div class="" style="margin-left:40px;">
							<div class="form-group col-sm-12">
								<div class="checkbox checkbox-success">
									<input type="checkbox" name="all_equipment_placement_picture" id="all_equipment_placement_picture" value="1" <?=$all_equipment_placement_picture?'checked':''?>>
									<label for="">All equipment placement picture uploaded</label>
								</div>
							</div>
							<div class="form-group col-sm-12">
							
								
								<div class="checkbox checkbox-success">
									<input type="checkbox" name="inverter_placement_picture" id="inverter_placement_picture" value="1" <?=$inverter_placement_picture?'checked':''?>>
									<label for="">Inverter placement picture uploaded</label>
								</div>
							</div>
							<div class="form-group col-sm-8">
							
								
								<div class="checkbox checkbox-success">
									<input type="checkbox" name="ev_placement_picture" id="ev_placement_picture" value="1" <?=$ev_placement_picture?'checked':''?>>
									<label for="">EV placement picture uploaded (applicable for projects with EV)</label>
								</div>
								</div>
							
							<div class="form-group col-sm-12">
							
								
								<div class="checkbox checkbox-success">
									<input type="checkbox" name="battery_placement_picture" id="battery_placement_picture" value="1" <?=$battery_placement_picture?'checked':''?>>
									<label for="">Battery placement picture uploaded (applicable for projects with Battery)</label>
								</div>
							</div>
							<div class="form-group col-sm-12">
							
								
								<div class="checkbox checkbox-success">
									<input type="checkbox" name="roof_pictures" id="roof_pictures" value="1" <?=$roof_pictures?'checked':''?>>
									<label for="">Roof pictures uploaded</label>
								</div>
							</div>
							</div>
						</div>
						
						<div class="row">
							<div class="form-group col-sm-1"><h4>Dimensioning</h4></div><div class="form-group col-sm-11"></div>
						
						<div class="" style="margin-left:40px;">
							<div class="form-group col-sm-12">
							
								
								<div class="checkbox checkbox-success">
									<input type="checkbox" name="pv_sol_report" id="pv_sol_report" value="1" <?=$pv_sol_report?'checked':''?>>
									<label for="">PV sol report uploaded</label>
								</div>
							</div>
							<div class="form-group col-sm-12">
							
								
								<div class="checkbox checkbox-success">
									<input type="checkbox" name="mms_report_for_all" id="mms_report_for_all" value="1" <?=$mms_report_for_all?'checked':''?>>
									<label for="">MMS report for all roofs uploaded</label>
								</div>
							</div>
							<div class="form-group col-sm-12">
							
								
								<div class="checkbox checkbox-success">
									<input type="checkbox" name="mms_bom_report" id="mms_bom_report" value="1" <?=$mms_bom_report?'checked':''?>>
									<label for="">MMS BOM report for all roofs uploaded</label>
								</div>
							</div>
							<div class="form-group col-sm-12">
							
								
								<div class="checkbox checkbox-success">
									<input type="checkbox" name="string_diagram_picture" id="string_diagram_picture" value="1" <?=$string_diagram_picture?'checked':''?>>
									<label for="">String diagram picture uploaded</label>
								</div>
							</div>
							<div class="form-group col-sm-12">
							
								
								<div class="checkbox checkbox-success">
									<input type="checkbox" name="panel_layout_pictures" id="panel_layout_pictures" value="1" <?=$panel_layout_pictures?'checked':''?>>
									<label for="">Panel layout pictures for all roofs uploaded</label>
								</div>
							</div>
							
							</div>
						</div>
							<div class="clearfix"></div>
							
						
						
						
						
						<input type="hidden" name="checklist_project_id" value="<?=$pid?>">
						<input type="hidden" name="checklist_id" value="<?=$arrAdmin2["id"]?>">
				
						<div class="form-group col-sm-12">
							<?php if((in_array($act_arr[1],$_SESSION["url"][$Sys_Gl_module_id]) || !in_array($act_arr[3],$_SESSION["url"][$Sys_Gl_module_id])) || $_SESSION["ses_adm_id"]==1){?>
							<button type="submit" class="btn add-submit-btn" value="checklist_submit" name="checklist_submit" id="checklist_submit">Submit</button>
							<?php } ?>
							<button type="button" onclick="history.go(-1)" class="btn back-btn">Back</button>
						</div>
						<div class="clearfix"></div>
						</div>
					</div>
					
				<div role="tabpanel" class="tab-pane <?php echo $active2;?>" id="upload_info">
					<?php include('upload-files.php'); ?>
					<?php $fileQry = $cms->db_query("SELECT * FROM #_uploads where lead_id=$lead_id ");
					if($fileQry->num_rows>0){
						if($uploaded_files!=''){
							$uploaded_filesArr = explode(',',$uploaded_files);
						} ?>
					<!--<div class="form-group col-sm-6">
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
						
						<?php if((in_array($act_arr[1],$_SESSION["url"][$Sys_Gl_module_id]) || !in_array($act_arr[3],$_SESSION["url"][$Sys_Gl_module_id])) || $_SESSION["ses_adm_id"]==1){?>
						<button type="submit" class="btn add-submit-btn" id="check_submit">Add File</button>
						<?php } ?>
						<button type="button" onclick="history.go(-1)" class="btn back-btn">Back</button>
					</div>-->
					
					<!--<div class="form-group col-sm-6" id="upload_files_box">
						<div class="file_wrapper">	
							<div class="form-group col-sm-12 text-center">
								<a href="javascript:void(0);" class="add_file_button">Click here to upload more files</a>
							</div>
						</div>
						<?php if((in_array($act_arr[1],$_SESSION["url"][$Sys_Gl_module_id]) || !in_array($act_arr[3],$_SESSION["url"][$Sys_Gl_module_id])) || $_SESSION["ses_adm_id"]==1){?>
						<button type="submit" class="btn add-submit-btn" id="upload_files" style="display:none">Upload</button>
						<?php } ?>
					</div>-->
					<div class="clearfix"></div>					
					<?php }else{ ?>
					<div class="form-group col-sm-12">
						<h2>No files uploaded</h2>
					</div>
					<div class="clearfix"></div>
					<?php } ?>
				</div>
				
				<div role="tabpanel" class="tab-pane <?php echo $active3;?>" id="project_steps">
					<?php //include('project-steps.php');?>
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


<script>
function generate(){
	var grid_template = $("#grid_template").val();
	if(grid_template){
		if(grid_template==2){ //EON
			$("#plant_id").attr("required", true);
			$("#project_address").attr("required", true);
			$("#aforms").attr("action","<?=SITE_PATH_ADM.CPAGE?>/gridTemplate/eon.php");
			//alert($(".filter_form").attr("action"));
			$("#aforms").submit();
		}
		else if(grid_template==1){	//Ellevio
			if($("#enskild_firma").is(":checked")) {
				$("#company_name").attr("required", false);
				$("#org_number").attr("required", false);
			}else{			
				$("#company_name").attr("required", true);
				$("#org_number").attr("required", true);
			}
			$("#plant_id").attr("required", true);
			$("#project_address").attr("required", true);
			if($("#personnummer").val()==''){
				$("#personnummer").attr("readonly", false);
				$("#personnummer_error").addClass("has-error");
				$("#personnummer").attr("required", true);
			}
			$("#project_postal_code").attr("required", true);
			$("#project_city").attr("required", true);
			$("#aforms").attr("action","<?=SITE_PATH_ADM.CPAGE?>/gridTemplate/ellivio.php");
			//alert($(".filter_form").attr("action"));
			$("#aforms").submit();
		}
		else if(grid_template==3){ //Föranmälan.nu
			$("#battery_size").attr("required", true);
			$("#effektfaktor").attr("required", true);
			$("#short_circuit").attr("required", true);
			$("#main_fuse").attr("required", true);
			$("#plant_id").attr("required", true);
			$("#project_address").attr("required", true);
			$("#aforms").attr("action","<?=SITE_PATH_ADM.CPAGE?>/gridTemplate/foranmlan.php");
			//alert($(".filter_form").attr("action"));
			$("#aforms").submit();
		}else{
			alert("Something went wrong");
		}
	}else{
		alert("Please select grid template");
	}
	
	/*$.ajax({
		url:"<?=SITE_PATH_ADM.CPAGE?>/certificate/index.php",
		data:"custID=1",
		method:"post",
		beforeSend:function(){
			$(".admin-ajax-loader").show();
		},
		success:function(result){
			$(".admin-ajax-loader").hide();
			
		}
	})*/
}
</script>


<script>
$('#grid_provider').change(function() {
    var gridVal = $(this).val();
	if(gridVal==4){
		$(".other-grid-provider").show(200);
		$("#grid_provider_name").attr("required", true);
	}
	else{
		$(".other-grid-provider").hide(200);
		$("#grid_provider_name").val("");
		$("#grid_provider_name").attr("required", false);
	}
});
</script>

<script>
$('#grid_template').change(function() {
    var gridTemplateVal = $(this).val();
	if(gridTemplateVal==3){
		$("#show_el_meter").show(100);
		$("#electricity_meter").attr("required", true);
	}
	else{
		$("#show_el_meter").hide(200);
		$("#electricity_meter").val("");
		$("#electricity_meter").attr("required", false);
	}
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
				$('#panel_name').html(res[10]);
				if(res[6]!=''){
					$('.charger_show').show();
					$('#ev_quantity').show();
					$('#ev_charger').html(res[6]);
					$('#ev_quantity input').val(res[11]);
				}else{					
					$('.charger_show').hide();
					$('#ev_quantity').hide();
				}
				if(res[12]!=''){
					$('.battery_show').show();
					$('#battery_quantity').show();
					$('#battery').html(res[12]);
					$('#battery_quantity input').val(res[13]);
					$('#battery_size').val(res[26]);
				}else{					
					$('.battery_show').hide();
					$('#battery_quantity').hide();
				}
				if(res[14]!=''){
					$('#show_inverter1').show();
					$('#inverter1_qty').show();
					$('#inverter1').html(res[14]);
					$('#inverter1_qty input').val(res[15]);
					$('#inverter1_effect').val(res[27]);
				}else{					
					$('#show_inverter1').hide();
					$('#inverter1_qty').hide();
				}
				if(res[16]!=''){
					$('#show_inverter2').show();
					$('#inverter2_qty').show();
					$('#inverter2').html(res[16]);
					$('#inverter2_qty input').val(res[17]);
					$('#inverter2_effect').val(res[28]);
				}else{					
					$('#show_inverter2').hide();
					$('#inverter2_qty').hide();
				}
				if(res[18]!=''){
					$('#show_inverter3').show();
					$('#inverter3_qty').show();
					$('#inverter3').html(res[18]);
					$('#inverter3_qty input').val(res[19]);
					$('#inverter3_effect').val(res[29]);
				}else{
					$('#show_inverter3').hide();
					$('#inverter3_qty').hide();
				}	
				if(res[20]!=''){
					$('.show_sensor').show();
					$('#smart_sensor_qty').show();
					$('#smart_sensor_name').html(res[20]);
					$('#smart_sensor_qty input').val(res[21]);
				}else{
					$('.show_sensor').hide();
					$('#smart_sensor_qty').hide();
				}	
				if(res[22]!=''){
					$('.show_odrift').show();
					$('#odrift_quantity').show();
					$('#odrift_name').html(res[22]);
					$('#odrift_quantity input').val(res[23]);
				}else{
					$('.show_odrift').hide();
					$('#odrift_quantity').hide();
				}	
				if(res[24]!=''){
					$('.show_optimizer').show();
					$('#optimizer_quantity').show();
					$('#optimizer_name').html(res[24]);
					$('#optimizer_quantity input').val(res[25]);
				}else{
					$('.show_optimizer').hide();
					$('#optimizer_quantity').hide();
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
$('#panel_name').change(function() {
    var panel_name = $(this).val();
	$.ajax({
		url:"<?=SITE_PATH_ADM.CPAGE?>/getPanelDetails.php",
		data:"panel_name="+panel_name,
		method:"post",
		beforeSend:function(){
			$(".admin-ajax-loader").show();
		},
		success:function(result){
			$(".admin-ajax-loader").hide();
			var res = result.split("|");
			if(res[0]!='' && res[1]!=''){
				$('#effektfaktor').val(res[0]);
				$('#short_circuit').val(res[1]);			
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
function remove_uploaded_file(id,name){
	if (confirm("Are you sure to delete?")) {
		$.ajax({
			type:"post",
			url: "<?=SITE_PATH_ADM.CPAGE?>/remove_uploaded_file.php?id="+id+"&name="+name,
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
  
<script type="text/javascript">
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_file_button'); //Add button selector
    var wrapper = $('.file_wrapper'); //Input field wrapper
    var fieldHTML = '<div class="row"><div class="form-group col-sm-2"><label for="file_type" class="control-label">File Type*</label><select name="file_type[]" class="form-control" required><option value="">Select File Type</option><option value="1">Document</option><option value="2">Picture</option></select></div><div class="form-group col-sm-4"><label for="file_title" class="control-label">File Title</label><input type="text" name="file_title[]" class="form-control" id="file_title"></div><div class="form-group col-sm-5"><label for="file_upload" class="control-label">Upload File</label><input type="file" id="file_upload" name="file_upload[]"></div><div class="form-group col-sm-1"><a href="javascript:void(0);" class="remove_button"><i class="fa fa-close text-danger"></i></a></div><div class="clearfix"></div></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
		if(x>1){
			$("#upload_files").show();
		}
    });
    
    //Once remove button is clicked
    $('.file_wrapper').on('click', '.remove_button', function(e){
        e.preventDefault();
		$(this).closest('div.row').remove(); //Remove field html
		x--; //Decrement field counter
		if(x==1){
			$("#upload_files").hide();
		}
    });
});
</script>

<!--<script>
$("#enskild_firma").click(function() {
    if($(this).is(":checked")) {
		$("#company_name").attr("required", true);
    } else {
		$("#company_name").attr("required", false);
		$("#company_name").val('');
    }
});
</script>-->



<script type="text/javascript">
$(document).ready(function(){
	var list_maxField = 10; //Input fields increment limitation
	var x5 = <?=$mms_count?>;
	$('.list_add_mms').click(function(){
		//Check maximum number of input fields
		if(x5 < list_maxField){ 
			x5++; //Increment field counter
			var list_fieldHTML = '<div class="row"><div class="col-md-4"><h5><b>MMS Report Roof '+x5+'</b></h5><input type="hidden" name="doc_title[]" value="MMS Report Roof" class="form-control" id="doc_title"></div><div class="col-md-7"><input type="file" id="doc_upload" name="doc_upload[]"></div><div class="col-xs-1 col-sm-7 col-md-1"><a href="javascript:void(0);" class="list_remove_button btn btn-danger">-</a></div></div>'; //New input field html 
			$('.mms-wrapper').append(list_fieldHTML); //Add field html
		}
	});
	//Once remove button is clicked
	$('.mms-wrapper').on('click', '.list_remove_button', function(){
		$(this).closest('div.row').remove(); //Remove field html
		x--; //Decrement field counter
	});
});
function revrcrd(rid){
	$("#"+rid).remove();
}
</script>

<script type="text/javascript">
$(document).ready(function(){
	var list_maxField = 10; //Input fields increment limitation
	var x6 = <?=$bom_mms_count?>;
	$('.list_add_bom_mms').click(function(){
		//Check maximum number of input fields
		if(x6 < list_maxField){ 
			x6++; //Increment field counter
			var list_fieldHTML = '<div class="row"><div class="col-md-4"><h5><b>BOM MMS Roof '+x6+'</b></h5><input type="hidden" name="doc_title[]" value="BOM MMS Roof" class="form-control" id="doc_title"></div><div class="col-md-7"><input type="file" id="doc_upload" name="doc_upload[]"></div><div class="col-xs-1 col-sm-7 col-md-1"><a href="javascript:void(0);" class="list_remove_button btn btn-danger">-</a></div></div>'; //New input field html 
			$('.bom-mms-wrapper').append(list_fieldHTML); //Add field html
		}
	});
	//Once remove button is clicked
	$('.bom-mms-wrapper').on('click', '.list_remove_button', function(){
		$(this).closest('div.row').remove(); //Remove field html
		x--; //Decrement field counter
	});
});
function revrcrd(rid){
	$("#"+rid).remove();
}
</script>

<script type="text/javascript">
$(document).ready(function(){
	var list_maxField = 10; //Input fields increment limitation
	var x9 = <?=$formalon_count?>;
	$('.list_add_formalon').click(function(){
		//Check maximum number of input fields
		if(x9 < list_maxField){ 
			x9++; //Increment field counter
			var list_fieldHTML = '<div class="row"><div class="col-md-4"><h5><b>Föranmälan '+x9+'</b></h5><input type="hidden" name="doc_title[]" value="Föranmälan" class="form-control" id="doc_title"></div><div class="col-md-7"><input type="file" id="doc_upload" name="doc_upload[]"></div><div class="col-xs-1 col-sm-7 col-md-1"><a href="javascript:void(0);" class="list_remove_button btn btn-danger">-</a></div></div>'; //New input field html 
			$('.formalon-wrapper').append(list_fieldHTML); //Add field html
		}
	});
	//Once remove button is clicked
	$('.formalon-wrapper').on('click', '.list_remove_button', function(){
		$(this).closest('div.row').remove(); //Remove field html
		x--; //Decrement field counter
	});
});
function revrcrd(rid){
	$("#"+rid).remove();
}
</script>

<script type="text/javascript">
$(document).ready(function(){
	var list_maxField = 10; //Input fields increment limitation
	var x7 = <?=$panel_roof_count?>;
	$('.add_panel_roof').click(function(){
		//Check maximum number of input fields
		if(x7 < list_maxField){ 
			x7++; //Increment field counter
			var list_fieldHTML = '<div class="row"><div class="col-md-4"><label class="control-label">Panel Layout Roof '+x7+'</label><input type="hidden" name="pic_title[]" value="Panel Layout Roof" class="form-control" id="pic_title"></div><div class="col-md-7"><input type="file" name="pic_upload[]" id="pic_upload'+x7+'" class="dropify dropify-area-img installation_image" data-max-file-size="1M" data-height="150" /></div><div class="col-xs-1 col-sm-7 col-md-1"><a href="javascript:void(0);" class="list_remove_button btn btn-danger">-</a></div></div>'; //New input field html 
			$('.panel-roof-wrapper').append(list_fieldHTML); //Add field html
		}
	});
	//Once remove button is clicked
	$('.panel-roof-wrapper').on('click', '.list_remove_button', function(){
		$(this).closest('div.row').remove(); //Remove field html
		x--; //Decrement field counter
	});
});
function revrcrd(rid){
	$("#"+rid).remove();
}
</script>

<script type="text/javascript">
$(document).ready(function(){
	var list_maxField = 10; //Input fields increment limitation
	var x8 = <?=$roof_pic_count?>;
	$('.add_roof_pic').click(function(){
		//Check maximum number of input fields
		if(x8 < list_maxField){ 
			x8++; //Increment field counter
			var list_fieldHTML = '<div class="row"><div class="col-md-4"><label class="control-label">Roof Picture '+x8+'</label><input type="hidden" name="pic_title[]" value="Roof Picture" class="form-control" id="pic_title"></div><div class="col-md-7"><input type="file" name="pic_upload[]" id="pic_upload'+x8+'" class="dropify dropify-area-img installation_image" data-max-file-size="1M" data-height="150" /></div><div class="col-xs-1 col-sm-7 col-md-1"><a href="javascript:void(0);" class="list_remove_button btn btn-danger">-</a></div></div>'; //New input field html 
			$('.roof-picture-wrapper').append(list_fieldHTML); //Add field html
		}
	});
	//Once remove button is clicked
	$('.roof-picture-wrapper').on('click', '.list_remove_button', function(){
		$(this).closest('div.row').remove(); //Remove field html
		x--; //Decrement field counter
	});
});
function revrcrd(rid){
	$("#"+rid).remove();
}
</script>
<script>
    function remove_roof_details(id){
        if(confirm("Are you sure to delete?")){
        $.ajax({
           type:"post",
           url:"<?= SITE_PATH_ADM . CPAGE ?>/remove_roof_details.php?id=" + id,
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

<script type="text/javascript">
    $(document).ready(function()
    {

        var list_maxField = 50; //Input fields increment limitation
    var x5 = "<?=$roof_details_count?>"; //Initial field counter
    if(<?=$roof_details_count?> !== 0)
    { x5 = x5-1; }
    // else{ x5= x5+1; }
    			 
	$('.list_add_button5').click(function()
	    {
            // alert(x5);
	    //Check maximum number of input fields
	    if(x5 < list_maxField){ 
	        x5++; //Increment field counter
	        var list_fieldHTML = '<div class="row"><div class="form-group col-md-2 col-sm-4 col-xs-6"><label for="total-panel" class="control-label">Total Panel</label> <input type="number" class="form-control" name="total_panel['+x5+']" id="total_panel['+x5+']"> </div><div class="form-group col-md-4 col-sm-4 col-xs-6"> <label for="roofing_material" class="control-label">Roof Type</label> <select class="form-control" id="roofing_material['+x5+']" name="roofing_material['+x5+']" <?=$readonly_field ?>> <option value="">Select Roof type</option> <?php $roofTypePriceArr=json_decode($customerPriceArr["roof_type_price"], true); foreach ($roofTypePriceArr as $rkey=> $rvalue){if ($rvalue["rfstatus"]==1){if ($roofing_material==$rvalue["name"]){$rsel='';}else{$rsel='';}echo '<option value="' . $rvalue["name"] . '" ' . $rsel . '>' . $rvalue["name"] . '</option>';}}?> </select> </div><div class="form-group col-md-3 col-sm-4 col-xs-6"> <label for="roof-support" class="control-label">Roof Support</label><br><select class="form-control" id="roof_support['+x5+']" name="roof_support['+x5+']"><option value="">Select Roof Support</option><option value="1">Råspont</option><option value="2">No Råspont</option></select></div><div class="form-group col-md-2 col-sm-4 col-xs-6"> <label for="roof_angle" class="control-label">Roof Angle</label> <input type="text" class="form-control" name="roof_angle['+x5+']" id="roof_angle['+x5+']" value="" > </div><div class="col-xs-1 col-sm-7 col-md-1"><label for="remove" class="control-label">Action</label><br><a href="javascript:void(0);" class="list_remove_button btn btn-danger ">-</a></div></div>'; //New input field html 
	        $('.list_wrapper5').append(list_fieldHTML); //Add field html
            //var total_rec= $("#total_rec").val();
            var total_rec = parseInt($("#total_rec").val());
            total_rec = total_rec+1;
            //alert(total_rec);
            // total_rec =  parseInt('total_rec')+1;
             console.log(total_rec);
             $("#total_rec").val(total_rec);
            
	    }

        });

        //Once remove button is clicked
        $('.list_wrapper').on('click', '.list_remove_button', function()
        {
           $(this).closest('div.row').remove(); //Remove field html
           x5--; //Decrement field counter
           var total_rec = parseInt($("#total_rec").val());
            total_rec = total_rec-1;
            // alert(total_rec);
            // total_rec =  parseInt('total_rec')+1;
             console.log(total_rec);
             $("#total_rec").val(total_rec);
        });

    });
</script>



<script>
$("#aforms").on("submit",function(e){
	if($("#status").val()==8){
		var response=false;
		var facade_meter_location=$("#facade_meter_location").val();
		var elcentral_location=$("#elcentral_location").val();
		var house_type=$("#house_type").val();
		var inverter_placement=$("#inverter_placement").val();
		var battery_placement=$("#battery_placement").val();
		var ev_placement=$("#ev_placement").val();
		var distance_panel_inverter=$("#distance_panel_inverter").val();
		var distance_inverter_connection_point=$("#distance_inverter_connection_point").val();
		var plant_id=$("#plant_id").val();
		var main_fuse=$("#main_fuse").val();
			
			if(facade_meter_location=="" || elcentral_location=="" || house_type=="" || inverter_placement=="" || battery_placement=="" || ev_placement=="" || distance_panel_inverter=="" || distance_inverter_connection_point=="" || plant_id=="" || main_fuse==""){
				alert("Blue highlighted fields are required, please fill all the details.");
				var response=false;
			}
			else{
				var response=true;
			}
			return response;
		 e.preventDefault();
	}
	
});
</script>

<script>
	if(document.getElementById('ebill').checked){
	}
	else{
		$(".ebill").hide();
	}
	$(".ebill-box").click(function() {
    if($(this).is(":checked")) {
        $(".ebill").show();
    } else {
        $(".ebill").hide();
    }
});

</script>
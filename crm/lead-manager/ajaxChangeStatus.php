<?php 
include("../../lib/opin.inc.php");
//print_r($_POST);die;
extract($_POST);
$HTML = "";
if($_POST){
	if($status=="4"){
		$new_status=$old_status;
	}else{
		$new_status=4;
	}
		$lid= $_POST['id'];
	// $leadDetails = $cms->db_query("select * from #_leads"); 
	if($_POST['action'] == 0){
				$lead_customer = $cms->getSingleResult("SELECT customer_name FROM #_leads WHERE id=".$lid." ");
                //$assignedToProjectMgr = $cms->getSingleResult("SELECT customer_name FROM #_users WHERE id=".$_POST['project_manager']." ");
                $action_message = 'Proposal <b>LEAD-'.$lid.'-'.$lead_customer.'</b>';
                $ActionPOSTS["lead_id"] = $lid;
                $ActionPOSTS["action_message"] = $action_message;
                $ActionPOSTS["action_date"] = date('Y-m-d h:i:s');
                $ActionPOSTS["action_by"] = $_SESSION["ses_adm_id"];
                $ActionPOSTS["activity_for"] = $_POST['project_manager'];
                $cms->sqlquery("rs","lead_tracker",$ActionPOSTS);
                
                $_POST['project_date'] = date("Y-m-d");
                $_POST['status'] = 1; //project created
                // $_POST['project_manager_id'] = $_POST['project_manager'];
                $_POST['cust_id'] = $lid;
                $_POST['lead_id'] = $cms->getSingleResult("SELECT lead_id FROM #_leads WHERE id=".$lid." ");
                
                $custQry = $cms->db_query("SELECT * FROM #_leads WHERE id=".$lid." ");
                $custRes = $custQry->fetch_array();
                
                $_POST['project_name'] = $custRes['quotation_number'];
                $_POST['sale_rep_id'] = $custRes['assigned_to'];
                $_POST['roof_material'] = $custRes['roofing_material'];
                $_POST['is_deleted'] = 0;
                
                $customerPriceQry = $cms->db_query("SELECT * FROM #_customer_price where id=1 ");
                $customerPriceArr = $customerPriceQry->fetch_array(); 
                
                if($custRes['panel_model']){
                    $panelTyeArray = json_decode($customerPriceArr['panel_types'],true);
                    foreach ($panelTyeArray as $key => $value) {
                        if($value["pstatus"]==1){
                            if($custRes['panel_model']==$value["name"]){
                                $_POST['panel_name'] = $value["name"];
                                $_POST['effektfaktor'] = $value["effektfaktor"];
                                $_POST['short_circuit'] = $value["short_circuit"];
                                break;
                            }
                        }
                    }
                }
                $_POST['system_size'] = $custRes['system_size'];
                $_POST['panel_count'] =$custRes['panel_count'];
                if($custRes['inverter_type']){
                    $inverterTyeArray = json_decode($customerPriceArr["inverter_types"], true);
                    foreach ($inverterTyeArray as $ikey => $ivalue) {
                        if($ivalue["invstatus"]==1){
                            if($custRes['inverter_type']==$ivalue["name"]){
                                $_POST['inverter1'] = $ivalue["name"];
                                $dongle1 = array();
                                $itemObject = new stdClass();
                                $itemObject->dongle_model = $ivalue["dongle_model"];
                                $itemObject->qty = $custRes['inverter_type1_qty'];

                                array_push($dongle1, $itemObject);
                               $_POST['inverter1_dongle'] = json_encode($dongle1);
                                // $dongle1[0] = [array("dongle_model"=>$ivalue["dongle_model"],"qty"=>$custRes['inverter_type1_qty'])];
                                // echo $_POST['inverter1_dongle'] = json_encode($dongle1[0],JSON_FORCE_OBJECT);
                                // die;
                                $_POST['inverter1_effect'] = $ivalue["inveffect"];
                                break;
                            }
                        } 
                    }
                    $_POST['inverter1_qty'] = $custRes['inverter_type1_qty'];
                }
                if($custRes['inverter_type2']){
                    $inverterTyeArray = json_decode($customerPriceArr["inverter_types"], true);
                    foreach ($inverterTyeArray as $ikey => $ivalue) {
                        if($ivalue["invstatus"]==1){
                            if($custRes['inverter_type2']==$ivalue["name"]){
                                $_POST['inverter2'] = $ivalue["name"];
                                $dongle2 = array();
                                $itemObject2 = new stdClass();
                                $itemObject2->dongle_model = $ivalue["dongle_model"];
                                $itemObject2->qty = $custRes['inverter_type2_qty'];

                                array_push($dongle2, $itemObject2);
                               $_POST['inverter2_dongle'] = json_encode($dongle2);
                            //   die;  
                              // $dongle2[0] = array("dongle_model"=>$ivalue["dongle_model"],"qty"=>$custRes['inverter_type2_qty']);
                                // $_POST['inverter2_dongle'] = json_encode($dongle2[0],JSON_FORCE_OBJECT);
                                $_POST['inverter2_effect'] = $ivalue["inveffect"];
                                break;
                            }
                        } 
                    }
                    $_POST['inverter2_qty'] = $custRes['inverter_type2_qty'];
                }
                
                if($custRes['inverter_type3']){
                    $inverterTyeArray = json_decode($customerPriceArr["inverter_types"], true);
                    foreach ($inverterTyeArray as $ikey => $ivalue) {
                        if($ivalue["invstatus"]==1){
                            if($custRes['inverter_type3']==$ivalue["name"]){
                                $_POST['inverter3'] = $ivalue["name"];
                                $dongle3 = array();
                                $itemObject3 = new stdClass();
                                $itemObject3->dongle_model = $ivalue["dongle_model"];
                                $itemObject3->qty = $custRes['inverter_type3_qty'];

                                array_push($dongle3, $itemObject3);
                                $_POST['inverter3_dongle'] = json_encode($dongle3);
                                // $dongle3[0] = array("dongle_model"=>$ivalue["dongle_model"],"qty"=>$custRes['inverter_type3_qty']);
                                // $_POST['inverter3_dongle'] = json_encode($dongle3[0],JSON_FORCE_OBJECT);
                                $_POST['inverter3_effect'] = $ivalue["inveffect"];
                                break;
                            }
                        } 
                    }
                    $_POST['inverter3_qty'] = $custRes['inverter_type3_qty'];
                }
                
                if($custRes['battery_name']){
                    $batteryTyeArray = json_decode($customerPriceArr["battery_types"], true);
                    foreach ($batteryTyeArray as $bkey => $bvalue) {
                        if($bvalue["bstatus"]==1){
                            if($custRes['battery_name']==$bvalue["name"]){
                                $_POST['battery'] = $bvalue["name"];
                                $_POST['battery_quantity'] = $custRes["battery_qty"];
                                $_POST['battery_size'] = $bvalue["btsize"];
                                break;
                            }
                        }
                    }
                }
                
                if($custRes['charger_name']){
                    $chargerTyeArray = json_decode($customerPriceArr["ev_charger_types"], true);
                    foreach ($chargerTyeArray as $ckey => $cvalue) {
                        if($cvalue["evstatus"]==1){
                            if($custRes['charger_name']==$cvalue["name"]){
                                $_POST['ev_charger'] = $cvalue["name"];
                                $_POST['ev_quantity'] = $custRes['charger_qty'];
                                break;
                            }
                        } 
                    }
                }
                
                if($custRes['sensor_type_name']){
                    $sensorTypeArray = json_decode($customerPriceArr["sensor_type"], true);
                    foreach ($sensorTypeArray as $snkey => $snvalue) {
                        if($snvalue["sensor_status"]==1){
                            if($custRes['sensor_type_name']==$snvalue["sensor_name"]){
                                $_POST['smart_sensor_name'] = $snvalue["sensor_name"];
                                $_POST['smart_sensor_qty'] = $custRes["sensor_qty"];
                                break;
                            }
                        }
                    }
                }
                
                if($custRes['odrift_type_name']){
                    $odriftTypeArray = json_decode($customerPriceArr["odrift_type"], true);
                    foreach ($odriftTypeArray as $odkey => $odvalue) {
                        if($odvalue["odrift_status"]==1){
                            if($custRes['odrift_type_name']==$odvalue["odrift_name"]){
                                $_POST['odrift_name'] = $odvalue["odrift_name"];
                                $_POST['odrift_quantity'] = $custRes["odrift_qty"];
                                break;
                            }
                        } 
                    }
                }
                
                if($custRes['optimizer_type_name']){
                    $optimizerTypeArray = json_decode($customerPriceArr["optimizer_type"], true);
                    foreach ($optimizerTypeArray as $odkey => $odvalue) {
                        if($odvalue["optimizer_status"]==1){
                            if($custRes['optimizer_type_name']==$odvalue["optimizer_name"]){
                                $_POST['optimizer_name'] = $odvalue["optimizer_name"];
                                $_POST['optimizer_quantity'] = $custRes["optimizer_qty"];
                                break;
                            }
                        } 
                    }
                }
                
                // echo "<pre>";
                // print_r($_POST);
                // echo "</pre>";
                // die;
                // $projExists = $cms->getSingleResult("SELECT id FROM #_customer_project where cust_id=".$lid." ");
                // if($projExists>0 && $projExists!=''){
                    // $cms->sqlquery("rs","customer_project",$_POST,'id',$projExists);	
                    // $proj_id = $projExists;
                // }else{

                    $proj_id = $cms->sqlquery("rs","customer_project",$_POST);
					
                    $roofQry = $cms->db_query("SELECT * FROM #_roof_details WHERE proposal_id=".$lid." and form_type='proposal'");
                    while($roofRes = $roofQry->fetch_array()){
                        $newRoof['total_panel'] = $roofRes['total_panel'];
                        $newRoof['roofing_material'] = $roofRes['roofing_material'];
                        $newRoof['roof_support'] = $roofRes['roof_support'];
                        $newRoof['roof_angle'] = $roofRes['roof_angle'];
                        $newRoof['roof_thickness'] = $roofRes['roof_thickness'];
                        $newRoof['roof_material'] = $roofRes['roof_material'];
                        $newRoof['roof_breath'] = $roofRes['roof_breath'];
                        $newRoof['roof_length'] = $roofRes['roof_length'];
                        $newRoof['roof_height'] = $roofRes['roof_height'];
                        $newRoof['form_type'] = "customer";
                        $newRoof['lead_id'] = $roofRes['lead_id'];
                        $newRoof['proposal_id'] = $roofRes['proposal_id'];
                   // print_r($newRoof);die;    
                      $cms->sqlquery("rs","roof_details",$newRoof);


                    }
                // }
                /*$invoice_Arr = array("report_no"=>$uids);
                $name  = generateReport($invoice_Arr);*/

    
                // $customerQry = $cms->db_query("SELECT customer_name, quotation_number FROM #_leads where id=".$_POST['cust_id']." AND status=4 and is_deleted=0 ");
                // $customerArr = $customerQry->fetch_array();
                // $project_customer = $customerArr['customer_name'];
                // $data_Arr = array("report_no"=>$proj_id,"project_num"=>$_POST['project_name'],"project_customer"=>$project_customer);
                //print_r($data_Arr);die;
                // $ReportArr['project_report_name'] = generateReport($data_Arr);
                // $cms->sqlquery("rs","customer_project",$ReportArr,'id',$proj_id);

	}
	if($_POST['action'] == 1){
		$cid = $cms->getSingleResult("SELECT id FROM #_customer_project where cust_id=".$lid." and is_deleted=0 ");
        // echo "update #_customer_project set is_deleted=1, project_manager_id=NULL where id='".$cid."' ";
        // die;
        $delete= $cms->db_query("update #_customer_project set is_deleted=1, project_manager_id=NULL where id='".$cid."' ");
		
         
        $deleteProjectAsign = $cms->db_query("update #_leads set project_manager=NULL, project_assigned_date=NULL, lead_type=3 where id=".$lid." ");
	}			
	$update=$cms->db_query("update #_leads set status='$new_status' where id='".trim($id)."'");
	$update=$cms->db_query("update #_leads set status='$new_status' where id='".trim($leadid)."'");
	
	if($new_status==4){
		$leadsStatusArr = getAllStatus();
		$action_message="Status Changed from <b>".$leadsStatusArr[$old_status]."</b> to <b>".$leadsStatusArr[$new_status]."</b>";	
		$StatusPOSTS["lead_id"] = $leadid;
		$StatusPOSTS["action_message"] = $action_message;
		$StatusPOSTS["action_date"] = date('Y-m-d h:i:s');
		$StatusPOSTS["action_by"] = $_SESSION["ses_adm_id"];
		$StatusPOSTS["activity_for"] = $_SESSION["ses_adm_id"];
		$StatusPOSTS["new_status"] = $new_status;
		$StatusPOSTS["lead_status"] = $old_status;
		//print_r($StatusPOSTS);die;
		$cms->sqlquery("rs","lead_tracker",$StatusPOSTS);
	}
		
	if($update){
		echo 1;
	}else{
		echo 0;
	}
}
die();
?>
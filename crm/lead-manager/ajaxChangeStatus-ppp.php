<?php 
//error_log(3);
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
                    $panelTyeQry = getNewPrice('panel_types','1');
                    while($panelTyeAry = $panelTyeQry->fetch_array()){
                        $panelTyeArray = json_decode($panelTyeAry['content'],true);
                        foreach ($panelTyeArray as $key => $value) {
                            if($value["pstatus"]==1){
                                if($custRes['panel_model']==$value["name"] || $panelTyeAry['id']==$custRes['panel_model'] ){
                                    //$_POST['panel_name'] = $value["name"];
                                    $_POST['panel_name'] = $panelTyeAry["id"];
                                    $_POST['effektfaktor'] = $value["effektfaktor"];
                                    $_POST['short_circuit'] = $value["short_circuit"];
                                    break;
                                }
                            }
                        } 
                    }
                }
                $_POST['system_size'] = $custRes['system_size'];
                $_POST['panel_count'] =$custRes['panel_count'];
                if($custRes['inverter_type']){
                    $inverterTyeQry = getNewPrice('inverter_types','1');
                    while($inverterTyeAry = $inverterTyeQry->fetch_array()){
                    $inverterTyeArray = json_decode($inverterTyeAry["content"], true);
                    foreach ($inverterTyeArray as $ikey => $ivalue) {
                        if($ivalue["invstatus"]==1){
                            if($custRes['inverter_type']==$ivalue["name"] ||$custRes['inverter_type']==$inverterTyeAry["id"] ){
                                $_POST['inverter1'] = $inverterTyeAry["id"];
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
                }
                if($custRes['inverter_type2']){
                    $inverterTyeQry = getNewPrice('inverter_types','1');
                    while($inverterTyeAry = $inverterTyeQry->fetch_array()){
                    $inverterTyeArray = json_decode($inverterTyeAry["content"], true);
                    foreach ($inverterTyeArray as $ikey => $ivalue) {
                        if($ivalue["invstatus"]==1){
                            if($custRes['inverter_type2']==$ivalue["name"] || $custRes['inverter_type2']==$inverterTyeAry['id']){
                                $_POST['inverter2'] = $inverterTyeAry['id'];
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
                }
                // echo "<pre>";
                // print_r($_POST);die;
                if($custRes['inverter_type3']){
                    $inverterTyeQry = getNewPrice('inverter_types','1');
                    while($inverterTyeAry = $inverterTyeQry->fetch_array()){
                    $inverterTyeArray = json_decode($inverterTyeAry["content"], true);
                    foreach ($inverterTyeArray as $ikey => $ivalue) {
                        if($ivalue["invstatus"]==1){
                            if($custRes['inverter_type3']==$ivalue["name"] || $custRes['inverter_type3']==$inverterTyeAry['id']){
                                $_POST['inverter3'] = $inverterTyeAry['id'];
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
                }
                
                if($custRes['battery_name']){
                    $batteryTyeQry= getNewPrice('battery_types','1');
                    while($batteryTyeAry = $batteryTyeQry->fetch_array()){
                    $batteryTyeArray = json_decode($batteryTyeAry["content"], true);
                    foreach ($batteryTyeArray as $bkey => $bvalue) {
                        if($bvalue["bstatus"]==1){
                            if($custRes['battery_name']==$bvalue["name"] || $custRes['battery_name']==$batteryTyeAry['id']){
                                $_POST['battery'] = $batteryTyeAry['id'];
                                $_POST['battery_quantity'] = $custRes["battery_qty"];
                                 $_POST['battery_size'] = $bvalue["btsize"];
                                break;
                                }
                           }
                           
                        }
                    }
                }
                if($custRes['charger_name']){
                    $chargerTyeQry= getNewPrice('ev_charger_types','1');
                    while($chargerTyeAry = $chargerTyeQry->fetch_array()){
                    $chargerTyeArray = json_decode($chargerTyeAry["content"], true);
                    foreach ($chargerTyeArray as $ckey => $cvalue) {
                        if($cvalue["evstatus"]==1){
                            if($custRes['charger_name']==$cvalue["name"] || $custRes['charger_name']==$chargerTyeAry['id']){
                                $_POST['ev_charger'] = $chargerTyeAry['id'];
                                $_POST['ev_quantity'] = $custRes['charger_qty'];
                                break;
                                }
                            } 
                        } 
                    }
                }
                
                if($custRes['sensor_type_name']){
                    $sensorTypeQry = getNewPrice('sensor_type','1');
                    while($sensorTypeAry = $sensorTypeQry->fetch_array()){
                    $sensorTypeArray = json_decode($sensorTypeAry["content"], true);
                    foreach ($sensorTypeArray as $snkey => $snvalue) {
                        if($snvalue["sensor_status"]==1){
                            if($custRes['sensor_type_name']==$snvalue["sensor_name"] || $custRes['sensor_type_name']==$sensorTypeAry['id']){
                                $_POST['smart_sensor_name'] = $sensorTypeAry['id'];
                                $_POST['smart_sensor_qty'] = $custRes["sensor_qty"];
                                break;
                                }
                            }
                        } 
                    }
                }

                //print_r($_POST['smart_sensor_name']);die;
                if($custRes['odrift_type_name']){
                    $odriftTypeQry = getNewPrice('odrift_type','1');
                    while($odriftTypeAry = $odriftTypeQry->fetch_array()){
                    $odriftTypeArray = json_decode($odriftTypeAry["content"], true);
                    //$odriftTypeArray = json_decode($customerPriceArr["odrift_type"], true);
                    foreach ($odriftTypeArray as $odkey => $odvalue) {
                        if($odvalue["odrift_status"]==1){
                            if($custRes['odrift_type_name']==$odvalue["odrift_name"] || $custRes['odrift_type_name']==$odriftTypeAry['id']){
                                $_POST['odrift_name'] = $odriftTypeAry['id'];
                                $_POST['odrift_quantity'] = $custRes["odrift_qty"];
                                break;
                            }
                        } 
                    } }
                }
                
                if($custRes['optimizer_type_name']){
                    $optimizerTypeQry = getNewPrice('optimizer_type','1');
                    while($optimizerTypeAry = $optimizerTypeQry->fetch_array()){
                    $optimizerTypeArray = json_decode($optimizerTypeAry["content"], true);
                    //$optimizerTypeArray = json_decode($customerPriceArr["optimizer_type"], true);
                    foreach ($optimizerTypeArray as $odkey => $odvalue) {
                        if($odvalue["optimizer_status"]==1){
                            if($custRes['optimizer_type_name']==$odvalue["optimizer_name"] || $custRes['optimizer_type_name']==$optimizerTypeAry['id']){
                                $_POST['optimizer_name'] = $optimizerTypeAry['id'];
                                $_POST['optimizer_quantity'] = $custRes["optimizer_qty"];
                                break;
                            }
                        } 
                    } }
                }
                /************* mms code start *************/
                    
                
                $customerPriceQry = $cms->db_query("select roof_mms from #_roof_details where proposal_id='$lid' and form_type='proposal'" );
                $arry = array(46,6,1,5,13); // list of mms profile
                while($mmsVVArry = $customerPriceQry->fetch_array()){
		                $k=0;
		                foreach($arry as $key=>$ids)
		                {
                            $objMmsVv = json_decode($mmsVVArry['roof_mms'],true);
		                    $ar['mms_code'][$ids]=$objMmsVv[$k][0]['mms_code'];
		                    $ar['mms_item'][$ids]=$objMmsVv[$k][0]['mms_item'];
		                    $ar['mms_qty'][$ids]=$ar['mms_qty'][$ids]+$objMmsVv[$k][0]['mms_qty'];
		                    $ar['mms_cost'][$ids]=$ar['mms_cost'][$ids]+$objMmsVv[$k][0]['mms_cost'];
	                    	$k++;
		                }
		            }
                            //$arr = [$ar]; 
	                $roofMms = json_encode($ar);
                    
                    $_POST['mms_service'] = $roofMms;
                    $_POST['mms_vendor'] = $roofMms;

                    /************* mms code end *************/
                    
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
					// print_r($proj_id);
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
                        $newRoof['roof_mms'] = $roofRes['roof_mms'];
                        $newRoof['form_type'] = "customer";
                        $newRoof['lead_id'] = $roofRes['lead_id'];
                        $newRoof['proposal_id'] = $roofRes['proposal_id'];
                        $cms->sqlquery("rs","roof_details",$newRoof);


                    }
                   
	                    
                
               
                //print_r($ar1);
               //die;
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
        // echo "update #_roof_details set is_deleted='1' where proposal_id='.$lid.' and form_type='customer'";
        // die;
        $delete= $cms->db_query("update #_customer_project set is_deleted=1, project_manager_id=NULL where id='".$cid."' ");
		$deleteProjectAsign = $cms->db_query("update #_leads set project_manager=NULL, project_assigned_date=NULL, lead_type=3 where id=".$lid." ");
        $deleteRoof = $cms->db_query("update #_roof_details set is_deleted='1' where proposal_id='$lid' and form_type='customer'");

    }			

	$update=$cms->db_query("update #_leads set status='$new_status' where id='".trim($id)."'");
	$update=$cms->db_query("update #_leads set status='$new_status' where id='".$leadid."'");
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
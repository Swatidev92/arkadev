<?php 
$str =  $_SERVER['HTTP_REFERER'];

//$str = 'index.php?col=example&order=example2';
$qs = parse_url($str, PHP_URL_QUERY);
if(!empty($qs)){
    parse_str($qs, $output);
    $pageTo =  $output['start']; 
}

// echo "<pre>";
// print_r($_POST);die;

$total_inverter_cost=0;
$_POST['battery_discount'] = 0;
$_POST['charger_discount'] = 0;
$total_margin = 0;
$total_prod = $_POST['annual_production'];
$total_consumption = $_POST['annual_electricity_consumption'];

	//print_r($_FILES);die;
	if($_FILES["installation_image"]["name"]){ 
		$_POST["installation_image"] = uploadImage("installation_image",UP_FILES_PROPOSAL);
	}else{
		$_POST["installation_image"] = $_POST["installation_image"];
	}
	
	$customerPriceQry = $cms->db_query("SELECT * FROM #_customer_price where id=1 ");
	$customerPriceArr = $customerPriceQry->fetch_array(); 
	
	//$obj_smrg = json_decode($customerPriceArr['solar_margin']); //not use
	//$obj_sdis = json_decode($customerPriceArr['solar_discount']); //not use
	//$obj_solar = json_decode($customerPriceArr['green_rebate_solar']);
	$obj_solar = json_decode($cms->getSingleResult("SELECT content FROM #_customer_price_manager where field_const='green_rebate_solar' "));
    //$obj_shipcost = json_decode($customerPriceArr["shipment_cost"]);
	$obj_shipcost = json_decode($cms->getSingleResult("SELECT content FROM #_customer_price_manager where field_const='shipment_cost' "));
	
    //$obj_mmscost = json_decode($customerPriceArr["mms_cost"]); 
	// $obj_orderPayment = json_decode($customerPriceArr['pay_at_ordering']);
	$obj_orderPayment = json_decode($cms->getSingleResult("SELECT content FROM #_customer_price_manager where field_const='pay_at_ordering' "));
    //$obj_mounting = json_decode($customerPriceArr['mounting_structure']);
	$obj_mounting = json_decode($cms->getSingleResult("SELECT content FROM #_customer_price_manager where field_const='mounting_structure' "));
	//$obj_prod = json_decode($customerPriceArr['production_data']);
	$obj_prod = json_decode($cms->getSingleResult("SELECT content FROM #_customer_price_manager where field_const='production_data' "));
	//$obj_elect = json_decode($customerPriceArr['electricity_data']);
	$obj_elect = json_decode($cms->getSingleResult("SELECT content FROM #_customer_price_manager where field_const='electricity_data' "));
    //$obj_vat = json_decode($customerPriceArr['vat_percentage']);
    $obj_vat = json_decode($cms->getSingleResult("SELECT content FROM #_customer_price_manager where field_const='vat_percentage' "));
    
	
	// S:mk-19
	// $obj_cable_ev = json_decode($customerPriceArr['cable_ev'],true);
	$obj_cable_ev = json_decode($cms->getSingleResult("SELECT content FROM #_customer_price_manager where field_const='cable_ev'"),true);
    //$obj_cable_inv = json_decode($customerPriceArr['cable_inv'],true);
	$obj_cable_inv = json_decode($cms->getSingleResult("SELECT content FROM #_customer_price_manager where field_const='cable_inv'"),true);
    // $obj_ac_protect = json_decode($customerPriceArr['ac_protect'],true);
	$obj_ac_protect = json_decode($cms->getSingleResult("SELECT content FROM #_customer_price_manager where field_const='ac_protect'"),true);
	// $obj_dc_protect = json_decode($customerPriceArr['dc_protect'],true);
	$obj_dc_protect = json_decode($cms->getSingleResult("SELECT content FROM #_customer_price_manager where field_const='dc_protect'"),true);
	// $obj_dongle = json_decode($customerPriceArr['wifi_dongle'],true);
	$obj_dongle = json_decode($cms->getSingleResult("SELECT content FROM #_customer_price_manager where field_const='wifi_dongle'"),true);
	
	$ac_price= $obj_ac_protect[0]['price'];
	$dc_price= $obj_dc_protect[0]['price'];
	$cable_ev_price = $obj_cable_ev['0']['ev'];
	$cable_inv_price = $obj_cable_inv['0']['inv'];
	// print_r($obj_ac_protect);die;
	
	if($_POST['surge_protc_ac']==1){ $surge_protc_ac = $ac_price; }
	if($_POST['surge_protc_dc']==1){ $surge_protc_dc = $dc_price; }
	if($_POST['cable_len_inv']!="" ||$_POST['cable_len_inv']!=null ){  $total_cable_inv= $_POST['cable_len_inv'] * $cable_inv_price; }
	else{ $total_cable_inv= 10 * $cable_inv_price; }
	if($_POST['cable_len_ev']!="" ||$_POST['cable_len_ev']!=null ){  $total_cable_ev= $_POST['cable_len_ev'] * $cable_ev_price; }
	else{ $total_cable_ev= 10 * $cable_ev_price; }
	// echo $surge_protc_ac.'|'.$surge_protc_dc.'|'.$total_cable_inv.'|'.$total_cable_ev.'|';die;
	// E:mk-19
	$_POST['product_guarantee_mounting_system'] = $obj_mounting[0]->mwarranty;
	$_POST['annual_inflation'] = $obj_prod[0]->prod_inflation;
	$_POST['price_increase'] = $obj_prod[0]->prod_price_increase;
	$_POST['annual_deterioration_percent'] = $obj_prod[0]->prod_deterioration;
	$_POST['power_loss'] = $obj_prod[0]->prod_power_loss;
	$_POST['own_consumption'] = $obj_elect[0]->elec_consumption;
	$_POST['sold_electricity'] = $obj_elect[0]->elec_sold;
	$_POST['vat_percentage'] = $obj_vat[0]->vat;

	if($_POST['proposal_customer_type']==2){ //for commercial
		$_POST['max_solar_rebate']=0;
		$_POST['max_solar_ev_rebate']=0;
		$_POST['max_solar_battery_rebate']=0;
		$_POST['max_solar_ev_battery_rebate']=0;
		$_POST['max_only_battery_rebate']=0;
		$_POST['battery_extra_green_rebate']=0;
		$_POST['max_solar_battery_person1_rebate']=0;
		$_POST['max_solar_person2_rebate']=0;
		$_POST['max_battery_person2_rebate']=0;
		$_POST['max_solar_ev_person1_rebate']=0;
		$_POST['max_sev_solar_person2_rebate']=0;
		$_POST['max_sev_charger_person2_rebate']=0;
		$_POST['max_solar_ev_battery_person1_rebate']=0;
		$_POST['max_sevb_solarev_person2_rebate']=0;
		$_POST['max_sevb_battery_person2_rebate']=0;
		$_POST['person1_solar_max_rebate']=0;
		$_POST['person1_charger_max_rebate']=0;
		$_POST['person1_battery_max_rebate']=0;
		$_POST['max_sevb_charger_person2_rebate']=0;
		$_POST['ev_charger_max_fixed_rebate']=0;
		$_POST['max_sevb_solar_person2_rebate']=0;
	}
	if($_POST['proposal_type']!=8 && $_POST['proposal_type']!=9 && $_POST['proposal_type']!=11){
		$_POST['max_solar_battery_person1_rebate']=0;
		$_POST['max_solar_person2_rebate']=0;
		$_POST['max_battery_person2_rebate']=0;
		$_POST['number_of_person']=1;
		$_POST['person1_solar_max_rebate']=0;
		$_POST['person1_charger_max_rebate']=0;
		$_POST['person1_battery_max_rebate']=0;
	}
	
	if($_POST['proposal_type']==8){
		$_POST['max_solar_ev_person1_rebate']=0;
		$_POST['max_solar_battery_person1_rebate']=0;
	}
	if($_POST['proposal_type']==9){
		$_POST['person1_battery_max_rebate']=0;
		$_POST['max_solar_ev_battery_person1_rebate']=0;
		$_POST['max_solar_battery_person1_rebate']=0;
	}
	if($_POST['proposal_type']==11){
		$_POST['person1_charger_max_rebate']=0;
		$_POST['max_solar_ev_battery_person1_rebate']=0;
		$_POST['max_solar_ev_person1_rebate']=0;
	}
	////	
	if($_POST['proposal_type']!=3 && $_POST['proposal_type']!=4 && $_POST['proposal_type']!=8 && $_POST['proposal_type']!=11){
		$_POST['number_of_proposal']=1;
		$_POST['customer_name2']='';
	}else{
		$_POST['number_of_proposal'] = $_POST['number_of_proposal'];
		$_POST['customer_name2']= $_POST['customer_name2'];
	}
	
	if($_POST['sensor_type_name']!=''){
		$sensorTypeQry = getNewPrice('sensor_type','1');
        while($sensorTypeAry = $sensorTypeQry->fetch_array()){
        $sensorTypeArray = json_decode($sensorTypeAry["content"], true);
		foreach ($sensorTypeArray as $snkey => $snvalue) {
			if($snvalue["sensor_name"] == $_POST['sensor_type_name'] || $sensorTypeAry["id"] == $_POST['sensor_type_name'] ){
				$_POST['sensor_type_warranty'] = $snvalue["sensor_warranty"];
				$_POST['sensor_type_cost'] = $snvalue["sensor_cost"];
				
				if($_POST['sensor_qty']>0){
					$_POST['sensor_qty'] = $_POST['sensor_qty'];
				}else{					
					echo "Select sensor quantity";
					exit();
				}
				break;
			}
		} }
	}else{
		$_POST['sensor_type_name'] = '';
		$_POST['sensor_type_warranty'] = 0;
		$_POST['sensor_type_cost'] = 0;
		$_POST['sensor_qty'] = 0;
	}
	
	if($_POST['odrift_type_name']!=''){
        $odrift_type_nameQry = getNewPrice('odrift_type_name','1');
        while($odrift_type_nameAry = $odrift_type_nameQry->fetch_array()){
		$odriftTypeArray = json_decode($odrift_type_nameAry["content"], true);
		foreach ($odriftTypeArray as $odkey => $odvalue) {
			if($odvalue["odrift_name"] == $_POST['odrift_type_name'] || $odrift_type_nameAry["id"] == $_POST['odrift_type_name']){
				$_POST['odrift_type_warranty'] = $odvalue["odrift_warranty"];
				$_POST['odrift_type_cost'] = $odvalue["odrift_cost"];
				if($_POST['odrift_qty']>0){
					$_POST['odrift_qty'] = $_POST['odrift_qty'];
				}else{					
					echo "Select odrift quantity";
					exit();
				}
				break;
			}
		} }
	}else{
		$_POST['odrift_type_name'] = '';
		$_POST['odrift_type_warranty'] = 0;
		$_POST['odrift_type_cost'] = 0;
		$_POST['odrift_qty'] = 0;
	}
	
	if($_POST['optimizer_type_name']!=''){
        $optimizerTypeQry = getNewPrice('optimizer_type_name','1');
        while($optimizerTypeAry = $optimizerTypeQry->fetch_array()){
		$optimizerTypeArray = json_decode($optimizerTypeAry["content"], true);
		foreach ($optimizerTypeArray as $odkey => $odvalue) {
			if($odvalue["optimizer_name"] == $_POST['optimizer_type_name'] || $optimizerTypeAry["id"] == $_POST['optimizer_type_name'] ){
				$_POST['optimizer_type_warranty'] = $odvalue["optimizer_warranty"];
				$_POST['optimizer_type_cost'] = $odvalue["optimizer_cost"];
			
				if($_POST['optimizer_qty']>0){
					$_POST['optimizer_qty'] = $_POST['optimizer_qty'];
				}else{					
					echo "Select optimizer quantity";
					exit();
				}
				break;
			}
		} }
	}else{
		$_POST['optimizer_type_name'] = '';
		$_POST['optimizer_type_warranty'] = 0;
		$_POST['optimizer_type_cost'] = 0;
		$_POST['optimizer_qty'] = 0;
	}
	
	if($_POST['panel_model']!=''){
        $panelTypeQry = getNewPrice('panel_model','1');
        while($panelTypeAry = $panelTypeQry->fetch_array()){
		$panelTyeArray = json_decode($panelTypeAry["content"], true);
		foreach ($panelTyeArray as $key => $value) {
			if($value["name"] == $_POST['panel_model']){
				$_POST['panel_cost'] = $value["price"];
				$_POST['panel_wattage'] = $value["wattage"];
				$_POST['warranty_solar'] = $value["swarranty"];
				$_POST['solar_effect_warranty'] = $value["effectWarranty"];
				$_POST['supplier_solar_cells'] = $value["brand"];
				$_POST['guarantee_after_30_years'] = $value["warranty_percentage"];
				$_POST['panel_img'] = $value["panel_img"];
				$_POST['solar_discount'] = $value["sdiscount"];
				break;
			}
		} }
	}else{
		$_POST['panel_cost'] = 0;
		$_POST['panel_wattage'] = 0;
		$_POST['warranty_solar'] = 0;
		$_POST['solar_effect_warranty'] = 0;
		$_POST['supplier_solar_cells'] = '';
		$_POST['guarantee_after_30_years'] = 0;
		$_POST['panel_img'] = '';
		$_POST['solar_discount'] = 0;
		if($_POST['proposal_type']!=5 && $_POST['proposal_type']!=6){
		echo "Select panel type";
		exit();
		}
	}
	
	if($_POST['inverter_type']!=''){
        $inverterTypeQry = getNewPrice('inverter_types','1');
        // $inverterTypeAry =$cms->db_fetch_array($inverterTypeQry);
        // print_r($inverterTyeAry);die;
        while($inverterTypeAry = $inverterTypeQry->fetch_array()){
		$inverterTyeArray = json_decode($inverterTypeAry["content"], true);
        
		foreach ($inverterTyeArray as $ikey => $ivalue) {
			if($ivalue["name"] == $_POST['inverter_type'] || $inverterTypeAry['id'] == $_POST['inverter_type'] ){
				if($ivalue["dongle_model"]!="dongle_include"){
					foreach($obj_dongle as $dkey=> $dval){
						if($dval["dongle_status"]==1){
					if($ivalue["dongle_model"]== $dval["dongle_model"]){
						$dongle_cost = $dval["dongle_cost"];
					}}
						
				}
				$_POST['inverter_cost'] = $ivalue["price"]+$dongle_cost; }
				else{ $_POST['inverter_cost'] = $ivalue["price"]; }					   
				$_POST['warranty_inverter'] = $ivalue["invwarranty"];
				$_POST['inverter_brand'] = $ivalue["invbrand"];
				$_POST['inverter_img1'] = $ivalue["inverter_img"];
				$battery_compatible = $ivalue['compatible'];
				$inverter_selected = 1;
				
				if($_POST['inverter_type1_qty']>0){
					$_POST['inverter_type1_qty'] = $_POST['inverter_type1_qty'];
				}else{					
					echo "Select Inverter Type 1 quantity";
					exit();
				}				
				break;
			}
		} }
	}else{
		$_POST['inverter_cost'] = 0;
		$_POST['inverter_type1_qty'] = 0;
		$_POST['warranty_inverter'] = 0;
		$_POST['inverter_brand'] = '';
		$_POST['inverter_img1'] = '';
	}
	
	if($_POST['inverter_type2']!=''){
        $inverterTypeQry = getNewPrice('inverter_types','1');
        while($inverterTypeAry = $inverterTypeQry->fetch_array()){
		$inverterTyeArray = json_decode($inverterTypeAry["content"], true);
		foreach ($inverterTyeArray as $ikey => $ivalue) {
			if($ivalue["name"] == $_POST['inverter_type2'] || $inverterTypeAry['id'] == $_POST['inverter_type2'] ){
				if($ivalue["dongle_model"]!="dongle_include"){
					foreach($obj_dongle as $dkey=> $dval){
						if($dval["dongle_status"]==1){
					if($ivalue["dongle_model"]== $dval["dongle_model"]){
						$dongle_cost = $dval["dongle_cost"];
					}}
						
				}
				$_POST['inverter_cost2'] = $ivalue["price"]+$dongle_cost; }
				else{$_POST['inverter_cost2'] = $ivalue["price"];}
				$_POST['warranty_inverter2'] = $ivalue["invwarranty"];
				$_POST['inverter_brand2'] = $ivalue["invbrand"];
				$_POST['inverter_img2'] = $ivalue["inverter_img"];
				if($battery_compatible!=1){
					$battery_compatible = $ivalue['compatible'];
				}
				if($inverter_selected!=1){
					$inverter_selected = 1;
				}
				
				if($_POST['inverter_type2_qty']>0){
					$_POST['inverter_type2_qty'] = $_POST['inverter_type2_qty'];
				}else{					
					echo "Select Inverter Type 2 quantity";
					exit();
				}	
				break;
			}
		} }
	}else{
		$_POST['inverter_cost2'] = 0;
		$_POST['inverter_type2_qty'] = 0;
		$_POST['warranty_inverter2'] = 0;
		$_POST['inverter_brand2'] = '';
		$_POST['inverter_img2'] = '';
	}
	
	if($_POST['inverter_type3']!=''){
        $inverterTypeQry = getNewPrice('inverter_types','1');
        while($inverterTypeAry = $inverterTypeQry->fetch_array()){
		$inverterTyeArray = json_decode($inverterTypeAry["id"], true);
		foreach ($inverterTyeArray as $ikey => $ivalue) {
			if($ivalue["name"] == $_POST['inverter_type3'] || $inverterTyeAry['id'] == $_POST['inverter_type3'] ){
				if($ivalue["dongle_model"]!="dongle_include"){
					foreach($obj_dongle as $dkey=> $dval){
						if($dval["dongle_status"]==1){
					if($ivalue["dongle_model"]== $dval["dongle_model"]){
						$dongle_cost = $dval["dongle_cost"];
					}}
						
				}
				$_POST['inverter_cost3'] = $ivalue["price"]+$dongle_cost; }
				else{$_POST['inverter_cost3'] = $ivalue["price"];}
				$_POST['warranty_inverter3'] = $ivalue["invwarranty"];
				$_POST['inverter_brand3'] = $ivalue["invbrand"];
				$_POST['inverter_img3'] = $ivalue["inverter_img"];
				if($battery_compatible!=1){
					$battery_compatible = $ivalue['compatible'];
				}
				if($inverter_selected!=1){
					$inverter_selected = 1;
				}
				
				if($_POST['inverter_type3_qty']>0){
					$_POST['inverter_type3_qty'] = $_POST['inverter_type3_qty'];
				}else{					
					echo "Select Inverter Type 3 quantity";
					exit();
				}	
				break;
			}
		} }
	}else{
		$_POST['inverter_cost3'] = 0;
		$_POST['inverter_type3_qty'] = 0;
		$_POST['warranty_inverter3'] = 0;
		$_POST['inverter_brand3'] = '';
		$_POST['inverter_img3'] = '';
	}
	
	//echo $_POST['installation_days'];die;
	if($_POST['installation_days']!=''){
        $inverterTypeQry = getNewPrice('installation_charges','1');
        while($inverterTypeAry = $inverterTypeQry->fetch_array()){
		$installationArray = json_decode($inverterTypeAry["content"], true);
		foreach ($installationArray as $inkey => $invalue) {
			if(swedish_to_decimal_format($invalue["day"]) == $_POST['installation_days'] || $inverterTypeAry["id"] == $_POST['installation_days']){
				$_POST['installation_cost'] = $invalue["price"];
				$_POST['work_performed'] = $invalue["work_year"];
				break;
			}
		} }
	}else{
		$_POST['installation_cost'] = 0;
		$_POST['work_performed'] = 0;
		if($_POST['proposal_type']!=5 && $_POST['proposal_type']!=6){
		echo "Select installation days";
		exit();
		}
	}
	
	if($_POST['roofing_material']!=''){
        $roofTypeQry = getNewPrice('roof_model','1');
        while($roofTypeAry = $roofTypeQry->fetch_array()){
		$roof_type_price_Arr = json_decode($roofTypeAry["content"], true);
		foreach ($roof_type_price_Arr as $key => $value) {
			if($_POST['roofing_material']==$value["name"] || $_POST['roofing_material']==$roofTypeAry["id"] ){
				$_POST['roof_cost_per_panel'] = $value['price'];
				break;
			}else{
				$mms_cost = 0;
			}
		} }
	}else{
		$_POST['roof_cost_per_panel'] = 0;
	}
//	echo $_POST['installation_cost'];die;
	
	$_POST['system_size'] = $_POST['panel_wattage']*$_POST['panel_count']; //(panel wattage * number of panels)
	
	$total_inverter_cost=0;
	
	if($_POST['inverter_type']!=''){
		$total_inverter_cost = $total_inverter_cost + ($_POST['inverter_cost']*$_POST['inverter_type1_qty']);
	}
	if($_POST['inverter_type2']!=''){
		$total_inverter_cost = $total_inverter_cost + ($_POST['inverter_cost2']*$_POST['inverter_type2_qty']);
	}
	if($_POST['inverter_type3']!=''){
		$total_inverter_cost = $total_inverter_cost + ($_POST['inverter_cost3']*$_POST['inverter_type3_qty']);
	}
	
	//echo $total_inverter_cost;die;
	
	//at least one inverter selected
	if($inverter_selected=='' && $_POST['proposal_type']!=5 && $_POST['proposal_type']!=6){
		echo "Please select at least one inverter";
		exit();
	}
	
	$cost = ($_POST['panel_cost']*$_POST['panel_count']) + $total_inverter_cost + $_POST['proposal_mms_cost'] + $obj_shipcost[0]->shipmentcost + $_POST['installation_cost']+($_POST['sensor_type_cost']*$_POST['sensor_qty'])+($_POST['odrift_type_cost']*$_POST['odrift_qty'])+($_POST['optimizer_type_cost']*$_POST['optimizer_qty']);
	
	$_POST['proposal_total_price'] = $cost;
	
	if($_POST['proposal_type']==1){
		$_POST['battery_name']='';
		$_POST['charger_name']='';
	}
	if($_POST['proposal_type']==2 || $_POST['proposal_type']==5 || $_POST['proposal_type']==9){
		$_POST['battery_name']='';
	}
	if($_POST['proposal_type']==4 || $_POST['proposal_type']==6 || $_POST['proposal_type']==10 || $_POST['proposal_type']==11){
		$_POST['charger_name']='';
	}
	
	// add condition if proposal_type have battery then must select sensor
	if(($_POST['proposal_type']=='8' || $_POST['proposal_type']=='11') && ($_POST['sensor_type_name']==''))
	{		
			echo "Please select Smart Sensor";
			exit();
	}
	
	//for Battery
	if($_POST['battery_name']!=''){	
        // $obj_btmrg = json_decode($customerPriceArr['battery_margin']);		
        $obj_btmrg = json_decode($cms->getSingleResult("SELECT content FROM #_customer_price_manager where field_const='battery_margin' "));	
        //$obj_battery = json_decode($customerPriceArr['green_rebate_battery']);
		$obj_battery= json_decode($cms->getSingleResult("SELECT content FROM #_customer_price_manager where field_const='green_rebate_battery' "));
		$batteryTypeQry = getNewPrice('battery_types','1');
        while($batteryTyeAry = $batteryTypeQry->fetch_array()){
        $batteryTyeArray = json_decode($batteryTyeAry["content"], true);
		foreach ($batteryTyeArray as $bkey => $bvalue) {
			if($bvalue["name"] == $_POST['battery_name'] || $batteryTyeAry['id'] == $_POST['battery_name']){
				$_POST['battery_price'] = $bvalue["price"];
				$_POST['battery_warranty'] = $bvalue["bwarranty"];
				$_POST['battery_img'] = $bvalue["battery_img"];
				break;
			}
		}
    }
		if($_POST['battery_qty']>0){
			$_POST['battery_qty'] = $_POST['battery_qty'];
		}else{					
			echo "Select Battery quantity";
			exit();
		}	
		
		//echo $battery_compatible;die;
		if($battery_compatible=='' && $_POST['proposal_type']!=5 && $_POST['proposal_type']!=6){
			echo "Please select at least one battery compatible inverter";
			exit();
		}
		
		
		$_POST['battery_price_excluding_vat'] = ($_POST['battery_price']*$_POST['battery_qty'])*((100+$_POST['battery_margin'])/100); //Battery Price (excluding VAT) (P) = Battery cost * Margins for Battery (%)
		
		$_POST['battery_price_including_vat'] = $_POST['battery_price_excluding_vat']*((100+$_POST['vat_percentage'])/100); //Battery Price (including VAT) P1 = P x 1.25
		
		$_POST['battery_price_after_green_deduction'] = $_POST['battery_price_including_vat']*(100-$obj_battery[0]->rebate)/100;  //Battery Price (after green avdrag) = P1 x (100 – BGA)
		
		$_POST['battery_margin_kr'] = $_POST['battery_price_excluding_vat']-$_POST['battery_price'];
		$_POST['battery_vat_kr'] = $_POST['battery_price_including_vat']-$_POST['battery_price_excluding_vat'];
		$_POST['battery_green_rebate_kr'] = $_POST['battery_price_including_vat']-$_POST['battery_price_after_green_deduction'];
		
	}else{
		$_POST['battery_name']='';
		$_POST['battery_price'] = 0;
		$_POST['battery_warranty'] = 0;
		$_POST['battery_price_excluding_vat'] = 0;
		$_POST['battery_price_including_vat'] = 0;
		$_POST['battery_price_after_green_deduction'] = 0;
		$_POST['battery_img'] = 
		$_POST['battery_margin_kr'] = 0;
		$_POST['battery_vat_kr'] = 0;
		$_POST['battery_green_rebate_kr'] = 0;
		$_POST['battery_margin'] = 0;
		$_POST['battery_qty'] = 0;
	}
	
	
	//for EV Charger
	if($_POST['charger_name']!=''){		
		// $obj_evmrg = json_decode($customerPriceArr['ev_margin']);
        $obj_evmrg = json_decode($cms->getSingleResult("SELECT content FROM #_customer_price_manager where field_const='ev_margin' "));
		//$obj_ev = json_decode($customerPriceArr['green_rebate_ev']);
		$obj_ev = json_decode($cms->getSingleResult("SELECT content FROM #_customer_price_manager where field_const='green_rebate_ev' "));
		$evChargerTypeQry = getNewPrice('ev_charger_types','1');
        while($evChargerTyeAry = $evChargerTypeQry->fetch_array()){
        $chargerTyeArray = json_decode($evChargerTyeAry["content"], true);
		foreach ($chargerTyeArray as $ckey => $cvalue) {
			if($cvalue["name"] == $_POST['charger_name'] || $evChargerTyeAry['id'] == $_POST['charger_name'] ){
				$_POST['charger_price'] = $cvalue["price"];
				$_POST['charger_warranty'] = $cvalue["cwarranty"];
								
				//for load balancer
				if($_POST['load_balancer']==1){
					$_POST['load_balancer_cost'] = $cvalue["loadbalancercost"];
					$_POST['load_balancer_warranty'] = $cvalue["lbwarranty"];
				}else{
					$_POST['load_balancer_cost'] = 0;
					$_POST['load_balancer_warranty'] = 0;
					$_POST['load_balancer'] = 0;
				}
				$_POST['charger_img'] = $cvalue["charger_img"];
				
				if($_POST['charger_qty']>0){
					$_POST['charger_qty'] = $_POST['charger_qty'];
				}else{					
					echo "Select charger quantity";
					exit();
				}
				break;
			}
		} }
				
		//$_POST['charger_price_excluding_vat'] = ($_POST['charger_price']*$_POST['charger_qty'])*((100+$_POST['charger_margin'])/100); //EV charger Price (excluding VAT) (P) =  EV charger cost * Margins for EV charger (%)
		// s:mk-19
		$_POST['charger_price_excluding_vat'] = ($_POST['charger_price']*$_POST['charger_qty'])*((100+$_POST['charger_margin'])/100)+$total_cable_ev; //EV charger Price (excluding VAT) (P) =  EV charger cost * Margins for EV charger (%) + (cable length for ev * charge per m)
		// e:mk-19
		$_POST['charger_price_including_vat'] = $_POST['charger_price_excluding_vat']*((100+$_POST['vat_percentage'])/100); //EV charger Price (including VAT) P1 = P x 1.25
		
		$_POST['charger_price_after_green_deduction'] = $_POST['charger_price_including_vat']*(100-$obj_ev[0]->rebate)/100;  //EV charger Price (after green avdrag) = P1 x (100 – EVGA)
		
	}else{
		$_POST['charger_name']='';
		$_POST['charger_price'] = 0;
		$_POST['charger_warranty'] = '';
		$_POST['charger_price_excluding_vat'] = 0;
		$_POST['charger_price_including_vat'] = 0;
		$_POST['charger_price_after_green_deduction'] = 0;
		$_POST['charger_img'] = '';
		$_POST['load_balancer'] = 0;
		$_POST['charger_qty'] = 0;
	}
	
	//for solar panels
		
	if($proposal_type!=5 && $proposal_type!=6 && $proposal_type!=7){
		// $_POST['price_excluding_vat'] = $cost*((100+$_POST['solar_margin'])/100); 
		//Price (excluding VAT)(P) = Cost* Margin for panels
		//S:mk-19
		$_POST['price_excluding_vat'] = $cost*((100+$_POST['solar_margin'])/100) + $total_cable_inv + $surge_protc_ac + $surge_protc_dc; 
		//Price (excluding VAT)(P) = Cost* Margin for panels + (cable length * cable length cost per m) + surge protect ac cost + surge protect dc cost 
		// e:mk-19
		
		$_POST['price_including_vat'] = $_POST['price_excluding_vat']*((100+$_POST['vat_percentage'])/100); 
		//Price (including VAT) P1 = P x 1.25
		
		$_POST['vat_kr'] = $_POST['price_including_vat'] - $_POST['price_excluding_vat']; 
		//P1 - P (for text)		
		
		$_POST['price_after_green_deduction'] = $_POST['price_including_vat']*(100-$obj_solar[0]->rebate)/100; 
		// CP = P1 x (100 – GA)
		
		$_POST['green_rebate_kr'] = $_POST['price_including_vat'] - $_POST['price_after_green_deduction']; 
		//P1 – CP (for text)		
	}
	

	$_POST['solar_margin_kr'] = $_POST['price_excluding_vat']-$cost;  //(for text)
	
	if($_POST['charger_name']!=''){
		//$_POST['charger_margin'] = $obj_evmrg[0]->margin;
		$_POST['charger_margin_kr'] = $_POST['charger_price_excluding_vat']-$_POST['charger_price'];
		$_POST['charger_vat_kr'] = $_POST['charger_price_including_vat']-$_POST['charger_price_excluding_vat'];
		$_POST['charger_green_rebate_kr'] = $_POST['charger_price_including_vat']-$_POST['charger_price_after_green_deduction'];
		
	}else{
		$_POST['charger_margin_kr'] = 0;
		$_POST['charger_vat_kr'] = 0;
		$_POST['charger_green_rebate_kr'] = 0;
		$_POST['charger_margin'] = 0;
	}
	
	// total green rebate
	
	$tot_gr_rebate = $_POST['battery_green_rebate_kr']+$_POST['green_rebate_kr']+$_POST['charger_green_rebate_kr'];
	
	// case of solar discount
	$price_reduction=0;
	
	//echo $_POST['total_discount'];die;
	//if(($_POST['proposal_type']==2 || $_POST['proposal_type']==3 || $_POST['proposal_type']==4) && ($_POST['number_of_proposal']==1) && $proposal_customer_type==1){
		
	if(($_POST['proposal_type']==2 || $_POST['proposal_type']==3 || $_POST['proposal_type']==4 || $_POST['proposal_type']==8 || $_POST['proposal_type']==9 || $_POST['proposal_type']==10 || $_POST['proposal_type']==11)){
		//$_POST['price_after_discount'] = $_POST['price_including_vat']*(100-$obj_sdis[0]->discount)/100; //Price (after discount) P2 = P1 x (100-Discount)
			
		if($_POST['charger_name']!='' || $_POST['battery_name']!=''){
			$_POST['total_discount'] = $_POST['total_discount'];
		}
		else{
			$_POST['total_discount'] = 0;
		}
		//echo $_POST['total_discount'];die;
		/**** New Formula ****/
		$_POST['price_after_green_deduction'] = $_POST['price_after_green_deduction']-$_POST['total_discount'];
		$_POST['price_including_vat'] =  ($_POST['price_after_green_deduction']*100/(100-$obj_solar[0]->rebate));
		$_POST['price_excluding_vat'] =  $_POST['price_including_vat']/((100+$_POST['vat_percentage'])/100);
		$_POST['solar_margin_kr'] = $_POST['price_excluding_vat']-$cost;  //(for text)
		$_POST['vat_kr'] = $_POST['price_including_vat'] - $_POST['price_excluding_vat']; //for text
		$_POST['green_rebate_kr'] = $_POST['price_including_vat'] - $_POST['price_after_green_deduction']; //NewP1 – NewCP (for text)
	}
	else{
		$_POST['total_discount'] = 0;
	}
	
	if($_POST['charger_name']!=''){
		if(($_POST['proposal_type']==2 || $_POST['proposal_type']==3 || $_POST['proposal_type']==5 || $_POST['proposal_type']==7 || $_POST['proposal_type']==8 || $_POST['proposal_type']==9) && $_POST['load_balancer']==1){
			$_POST['load_price_excluding_vat'] =  $_POST['load_balancer_cost']*((100+$_POST['charger_margin'])/100);
			$_POST['load_price_including_vat'] =  $_POST['load_price_excluding_vat']*((100+$_POST['vat_percentage'])/100);
			$_POST['load_price_after_green_deduction'] = $_POST['load_price_including_vat']*(100-$obj_ev[0]->rebate)/100;
			$_POST['load_balancer_margin_kr'] = $_POST['load_price_excluding_vat']-$_POST['load_balancer_cost'];
			$_POST['load_balancer_vat_kr'] = $_POST['load_price_including_vat']-$_POST['load_price_excluding_vat'];
			$_POST['load_balancer_green_rebate_kr'] = $_POST['load_price_including_vat']-$_POST['load_price_after_green_deduction'];		
		}else{
			$_POST['load_price_excluding_vat'] = 0;
			$_POST['load_price_including_vat'] = 0;
			$_POST['load_price_after_green_deduction'] = 0;
			$_POST['load_balancer_margin_kr'] = 0;
			$_POST['load_balancer_vat_kr'] = 0;
			$_POST['load_balancer_green_rebate_kr'] = 0;
		}
	}
	
	$extra_cost = 0;
	$battery_extra_cost = 0;
	$_POST['total_green_rebate_kr'] = 0;
	$_POST['extra_green_rebate'] = 0;
	$_POST['battery_extra_green_rebate'] = 0;
	$total_max_rebate = 0;
	
	/*******************************New Gr Start *************************/
	// New Gr update (owner+co-owner green rebate)- 17-01-2023
	//$_POST['total_green_rebate_kr'] = $tot_gr_rebate;
	echo $_POST['percentg_gr_rebate'] = $tot_gr_rebate;

	 $person1_person2_max_rebate = $_POST['person1_max_rebate']+$_POST['person2_max_rebate'];
	 $_POST['total_green_rebate_kr'] = $person1_person2_max_rebate;

	if($tot_gr_rebate > $person1_person2_max_rebate){
			$extra_cost = $tot_gr_rebate-$person1_person2_max_rebate;
			//$_POST['total_green_rebate_kr'] = $tot_gr_rebate;
			
			$_POST['total_green_rebate_kr'] = $person1_person2_max_rebate;
			$_POST['extra_green_rebate'] = $extra_cost;
			//$_POST['price_after_green_deduction'] = $_POST['price_after_green_deduction']+$extra_cost;
			
			//$_POST['green_rebate_kr'] = $_POST['green_rebate_kr']-$extra_cost;
			echo '<br>';
			//echo $tot_gr_rebate = $_POST['battery_green_rebate_kr'].'+'.$_POST['green_rebate_kr'].'+'.$_POST['charger_green_rebate_kr'];
			
			$dist_gr=$person1_person2_max_rebate;
			
			
			
				

	echo '<br>';
		echo 'all INITIAL GR- ';echo '<br>';
		echo 'Solar GR- '.$_POST['green_rebate_kr'];echo '<br>';
		echo 'EV GR- '.$_POST['charger_green_rebate_kr'];echo '<br>';
		echo 'battery gr- '.$_POST['battery_green_rebate_kr'];echo '<br>';
		echo '<br>';
					echo 'allowed gr '.$dist_gr;echo '<br>';
					 $s_btr_ev_gr = $_POST['green_rebate_kr']+$_POST['charger_green_rebate_kr']+$_POST['battery_green_rebate_kr'];
					
					echo '% GR '.$s_btr_ev_gr;echo '<br>';
	// Solar + EV + Battery					
	if($_POST['proposal_type']==8)
	{	
echo '<br>';
echo 'Solar + EV + Battery';echo '<br>';
						//Distribution into Solar and battery
						if($_POST['charger_green_rebate_kr']>=$dist_gr)
						{
							echo 'case-1 ';echo '<br>';
							$_POST['charger_green_rebate_kr'] = $dist_gr;
							$_POST['battery_green_rebate_kr']=0;
							$_POST['green_rebate_kr']=0;
							
							$_POST['charger_price_after_green_deduction']=$_POST['charger_price_including_vat']-$_POST['charger_green_rebate_kr'];
							
							$_POST['battery_price_after_green_deduction']=$_POST['battery_price_including_vat'];
							
							$_POST['price_after_green_deduction']=$_POST['price_including_vat'];
						}
						else if(($_POST['charger_green_rebate_kr']+$_POST['battery_green_rebate_kr'])>=$dist_gr)
						{
							echo 'case-2';echo '<br>';
							
							//echo 'battery_green_rebate_kr-'.$_POST['battery_green_rebate_kr'];
							
							$_POST['battery_green_rebate_kr']=$dist_gr-$_POST['charger_green_rebate_kr'];
							
							
							$_POST['battery_price_after_green_deduction']=$_POST['battery_price_including_vat']-$_POST['battery_green_rebate_kr'];
							
							$_POST['green_rebate_kr']=0;
							
							$_POST['price_after_green_deduction']=$_POST['price_including_vat'];
						
						}
						else //($tot_gr_rebate>$dist_gr)
						{
							echo 'case-3 ';
							//echo $tot_gr_rebate;
							echo '<br>';
							echo $_POST['green_rebate_kr']=$dist_gr-($_POST['battery_green_rebate_kr']+$_POST['charger_green_rebate_kr']);
							
							
							$_POST['price_after_green_deduction']=$_POST['price_including_vat']-$_POST['green_rebate_kr'];
						
						}
					
	}
	//die;
	// Solar + EV
	if($_POST['proposal_type']==9)
	{	
echo 'Solar + EV';
						//Distribution into Solar and battery
						if($_POST['charger_green_rebate_kr']>=$dist_gr)
						{
							echo 'case-1 ';echo '<br>';
							$_POST['charger_green_rebate_kr'] = $dist_gr;
							$_POST['green_rebate_kr']=0;
							
							$_POST['charger_price_after_green_deduction']=$_POST['charger_price_including_vat']-$_POST['charger_green_rebate_kr'];
							
							$_POST['price_after_green_deduction']=$_POST['price_including_vat'];
						}
						else
						{
							$_POST['green_rebate_kr']=$dist_gr-$_POST['charger_green_rebate_kr'];
							
							
							$_POST['price_after_green_deduction']=$_POST['price_including_vat']-$_POST['green_rebate_kr'];
						
						}
					
	}
	// Solar + Battery					
	if($_POST['proposal_type']==11)
	{	echo '<br>';
	    echo 'Solar + Battery';echo '<br>';
		//Distribution into Solar and battery
						if($_POST['battery_green_rebate_kr']>=$dist_gr)
						{
							echo 'case-1 ';echo '<br>';
							$_POST['battery_green_rebate_kr'] = $dist_gr;
							
							$_POST['green_rebate_kr']=0;
							
							$_POST['battery_price_after_green_deduction']=$_POST['battery_price_including_vat']-$_POST['battery_green_rebate_kr'];

							
							$_POST['price_after_green_deduction']=$_POST['price_including_vat'];
						}
						else
						{
							echo 'case-2 ';
							//echo $tot_gr_rebate;
							echo '<br>';
							echo $_POST['green_rebate_kr']=$dist_gr-$_POST['battery_green_rebate_kr'];
							
							
							$_POST['price_after_green_deduction']=$_POST['price_including_vat']-$_POST['green_rebate_kr'];
						
						}
					
	}				
	// Solar					
	if($_POST['proposal_type']==1)
	{	
		$_POST['green_rebate_kr'] = $dist_gr;
		$_POST['price_after_green_deduction']=$_POST['price_including_vat']-$_POST['green_rebate_kr'];
	}
						
	// Battery				
	if($_POST['proposal_type']==6)
	{	
		$_POST['battery_green_rebate_kr'] = $dist_gr;
		$_POST['battery_price_after_green_deduction']=$_POST['battery_price_including_vat']-$_POST['battery_green_rebate_kr'];
	}
	// Charger					
	if($_POST['proposal_type']==5)
	{	
		$_POST['charger_green_rebate_kr']=$dist_gr;
		$_POST['charger_price_after_green_deduction']=$_POST['charger_price_including_vat']-$_POST['charger_green_rebate_kr'];
		//$_POST['green_rebate_kr']=0;
		//$_POST['battery_green_rebate_kr']=0;
	}
	
}
//die;
	/*******************************END *************************/
	
	
	
		// add solar cost in total cost
		$_POST['proposal_total_cost'] = $_POST['proposal_total_cost']+$_POST['price_after_green_deduction'];
	
	
	
	$_POST['total_price_excluding_vat'] = $_POST['price_excluding_vat'];
	if($_POST['charger_name']!=''){
		$_POST['proposal_total_cost'] = $_POST['proposal_total_cost'] + $_POST['charger_price_after_green_deduction'];
		$_POST['total_price_excluding_vat'] = $_POST['total_price_excluding_vat'] + $_POST['charger_price_excluding_vat'];
		
		if(($_POST['proposal_type']==2 || $_POST['proposal_type']==3 || $_POST['proposal_type']==5 || $_POST['proposal_type']==7 || $_POST['proposal_type']==8 || $_POST['proposal_type']==9) && $_POST['load_balancer']==1){			
			$_POST['proposal_total_cost'] = $_POST['proposal_total_cost']+$_POST['load_price_after_green_deduction'];
			$_POST['total_price_excluding_vat'] = $_POST['total_price_excluding_vat'] + $_POST['load_price_excluding_vat'];
		}
	}
	if($_POST['battery_name']!=''){
		$_POST['proposal_total_cost'] = $_POST['proposal_total_cost'] + $_POST['battery_price_after_green_deduction'];
		$_POST['total_price_excluding_vat'] = $_POST['total_price_excluding_vat'] + $_POST['battery_price_excluding_vat'];
	}
		
	$_POST['total_weighted_electricity_price'] =  (($_POST['own_consumption']*$_POST['self_use_solar']) + ($_POST['sold_electricity']*(100-$_POST['self_use_solar'])))/100;
	
	//$_POST['total_weighted_electricity_price'] =  1.19;
	//echo $_POST['proposal_total_cost'];die;
	$fixed_charger_discount=0;
	$fixed_battery_discount=0;
	if($_POST['proposal_customer_type']==1){ //for privat
		if($_POST['proposal_type']==2 || $_POST['proposal_type']==5 || $_POST['proposal_type']==9){
			$fixed_charger_discount = 10000;
			$proposal_total_cost_for_table = $_POST['proposal_total_cost']-$fixed_charger_discount;
		}
		if($_POST['proposal_type']==4 || $_POST['proposal_type']==6 || $_POST['proposal_type']==10 || $_POST['proposal_type']==11){
			$fixed_battery_discount = 20000;
			$proposal_total_cost_for_table = $_POST['proposal_total_cost']-$fixed_battery_discount;
		}
		if($_POST['proposal_type']==3 || $_POST['proposal_type']==7 || $_POST['proposal_type']==8){
			$fixed_charger_discount = 10000;
			$fixed_battery_discount = 20000;
			$proposal_total_cost_for_table = $_POST['proposal_total_cost']-$fixed_charger_discount-$fixed_battery_discount;
		}
		
		if($_POST['sensor_type_name']!=''){
			$proposal_total_cost_for_table = $proposal_total_cost_for_table-2000;
		}
		if($_POST['odrift_type_name']!=''){
			$proposal_total_cost_for_table = $proposal_total_cost_for_table-15000;
		}
	}
	if($_POST['proposal_customer_type']==2){ //for commercial
		$proposal_total_cost_for_table = $_POST['total_price_excluding_vat'];
	}
	//echo $_POST['price_after_green_deduction'];die;
	//echo $_POST['total_price_excluding_vat'];die;
	//echo $proposal_total_cost_for_table;die;
	//echo 'proposal_total_cost'.$_POST['proposal_total_cost'];
	
	$payback_table = '<table width="100%" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" modulebg="edit" style="background:#fff">
								<tbody>
									<tr>
										<th style="background-color:#eee; text-align:center;">År.</th>
										<th style="background-color:#eee; text-align:center;">Viktat elpris.</th>
										<th style="background-color:#eee; text-align:center;">Produktion solel</th>
										<th style="background-color:#eee; text-align:center;">Årligbesparing</th>
										<th style="background-color:#eee; text-align:center;">Avkastning.</th>
										<th style="background-color:#eee; text-align:center;">Kvar</th>
									</tr>';

	$payback_year_count=0;

	
	$total_annual_saving = ($_POST['annual_production']*$_POST['total_weighted_electricity_price']);
	$_POST['estimated_annual_saving'] = $total_annual_saving;
	if($_POST['proposal_customer_type']==1){
		if($_POST['proposal_type']==2 || $_POST['proposal_type']==3 || $_POST['proposal_type']==4 || $_POST['proposal_type']==5 || $_POST['proposal_type']==6 || $_POST['proposal_type']==7 || $_POST['proposal_type']==8 || $_POST['proposal_type']==9 || $_POST['proposal_type']==10 || $_POST['proposal_type']==11){
			$return_percentage = (($total_annual_saving)*100)/$proposal_total_cost_for_table; 
			$left_amount = $proposal_total_cost_for_table - $total_annual_saving;
		}else{
			$return_percentage = (($total_annual_saving)*100)/$_POST['price_after_green_deduction'];
			//$left_amount = $_POST['price_after_green_deduction'] - $total_annual_saving; 
			$left_amount = $_POST['proposal_total_cost'] - $total_annual_saving; 
		}
	}
	if($_POST['proposal_customer_type']==2){
		$return_percentage = (($total_annual_saving)*100)/$proposal_total_cost_for_table; 
		$left_amount = $proposal_total_cost_for_table - $total_annual_saving;
	}
	
	
									
	$payback_table .='<tr>
							<td style="text-align:center;">1</td>
							<td style="text-align:center;">'.proposal_decimal_format(number_format($_POST['total_weighted_electricity_price'],2)).'</td>
							<td style="text-align:center;">'.amount_format_proposal(round($_POST['annual_production'])).' kWh</td>
							<td style="text-align:center;">'.amount_format_proposal(round($total_annual_saving)).' kr</td>
							<td style="text-align:center;">'.proposal_decimal_format(number_format($return_percentage,2)).'%</td>
							<td style="text-align:center;">'.amount_format_proposal(round($left_amount)).' kr</td>
						</tr>';	
	
	$payback_year_count=1;
	//echo $left_amount;die;
	
	$prevWeightedPrice = $_POST['total_weighted_electricity_price'];
	$prevAnnualProd = $_POST['annual_production'];
	$prevLeftAmount = $left_amount;
	
	$k=2;
	while($prevLeftAmount>=0){
							
	$next_year_weighted_price = ($prevWeightedPrice + ($prevWeightedPrice*$_POST['annual_inflation']/100));
	
	$next_year_annual_prod = $prevAnnualProd-(($prevAnnualProd*$_POST['annual_deterioration_percent'])/100);
	$total_annual_saving = ($next_year_annual_prod*$next_year_weighted_price);
	//if($_POST['proposal_type']==8 || $_POST['proposal_type']==9){
	if($_POST['proposal_customer_type']==1){
		if($_POST['proposal_type']==2 || $_POST['proposal_type']==3 || $_POST['proposal_type']==4 || $_POST['proposal_type']==5 || $_POST['proposal_type']==6 || $_POST['proposal_type']==7 || $_POST['proposal_type']==8 || $_POST['proposal_type']==9 || $_POST['proposal_type']==10 || $_POST['proposal_type']==11){
			$return_percentage = (($total_annual_saving)*100)/$proposal_total_cost_for_table; 
		}else{
			$return_percentage = (($total_annual_saving)*100)/$_POST['price_after_green_deduction'];
		}
	}
	if($_POST['proposal_customer_type']==2){
		$return_percentage = (($total_annual_saving)*100)/$proposal_total_cost_for_table;
	}
	$left_amount = $prevLeftAmount - $total_annual_saving;
	if($left_amount<0){
		$left_amount=0;
	}else{
		$payback_year_count++;
	}
	
	
	//echo $left_amount .'<br>';
	
	$payback_table .='<tr>
							<td style="text-align:center;">'.$k.'</td>
							<td style="text-align:center;">'.proposal_decimal_format(number_format($next_year_weighted_price,2)).'</td>
							<td style="text-align:center;">'.amount_format_proposal(round($next_year_annual_prod)).' kWh</td>
							<td style="text-align:center;">'.amount_format_proposal(round($total_annual_saving)).' kr</td>
							<td style="text-align:center;">'.proposal_decimal_format(number_format($return_percentage,2)).'%</td>
							<td style="text-align:center;">'.amount_format_proposal(round($left_amount)).' kr</td>
						</tr>';	
		
		//echo 'left_amount'.$left_amount;
	if($k==20){
		break;
	}
	$prevLeftAmount = $left_amount;
	$prevWeightedPrice = $next_year_weighted_price;
	$prevAnnualProd = $next_year_annual_prod;
	$k++;
	}
	//echo $payback_year_count;
	$payback_table .='</tbody>
							</table>';
									
	//echo $payback_table;
	//die;
	
	?>
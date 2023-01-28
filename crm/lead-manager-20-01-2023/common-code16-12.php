<?php 
$str =  $_SERVER['HTTP_REFERER'];

//$str = 'index.php?col=example&order=example2';
$qs = parse_url($str, PHP_URL_QUERY);
if(!empty($qs)){
    parse_str($qs, $output);
    $pageTo =  $output['start']; 
}


//print_r($_POST);die;

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
	
	$obj_smrg = json_decode($customerPriceArr['solar_margin']);
	//$obj_sdis = json_decode($customerPriceArr['solar_discount']);
	$obj_solar = json_decode($customerPriceArr['green_rebate_solar']);
	$obj_shipcost = json_decode($customerPriceArr["shipment_cost"]);
	//$obj_mmscost = json_decode($customerPriceArr["mms_cost"]);
	$obj_orderPayment = json_decode($customerPriceArr['pay_at_ordering']);
	$obj_shipcost = json_decode($customerPriceArr['shipment_cost']);
	$obj_mounting = json_decode($customerPriceArr['mounting_structure']);
	$obj_prod = json_decode($customerPriceArr['production_data']);
	$obj_elect = json_decode($customerPriceArr['electricity_data']);
	$obj_vat = json_decode($customerPriceArr['vat_percentage']);
	
	
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
		$sensorTypeArray = json_decode($customerPriceArr["sensor_type"], true);
		foreach ($sensorTypeArray as $snkey => $snvalue) {
			if($snvalue["sensor_name"] == $_POST['sensor_type_name']){
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
		}
	}else{
		$_POST['sensor_type_name'] = '';
		$_POST['sensor_type_warranty'] = 0;
		$_POST['sensor_type_cost'] = 0;
		$_POST['sensor_qty'] = 0;
	}
	
	if($_POST['odrift_type_name']!=''){
		$odriftTypeArray = json_decode($customerPriceArr["odrift_type"], true);
		foreach ($odriftTypeArray as $odkey => $odvalue) {
			if($odvalue["odrift_name"] == $_POST['odrift_type_name']){
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
		}
	}else{
		$_POST['odrift_type_name'] = '';
		$_POST['odrift_type_warranty'] = 0;
		$_POST['odrift_type_cost'] = 0;
		$_POST['odrift_qty'] = 0;
	}
	
	if($_POST['optimizer_type_name']!=''){
		$optimizerTypeArray = json_decode($customerPriceArr["optimizer_type"], true);
		foreach ($optimizerTypeArray as $odkey => $odvalue) {
			if($odvalue["optimizer_name"] == $_POST['optimizer_type_name']){
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
		}
	}else{
		$_POST['optimizer_type_name'] = '';
		$_POST['optimizer_type_warranty'] = 0;
		$_POST['optimizer_type_cost'] = 0;
		$_POST['optimizer_qty'] = 0;
	}
	
	if($_POST['panel_model']!=''){
		$panelTyeArray = json_decode($customerPriceArr["panel_types"], true);
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
		}
	}else{
		$_POST['panel_cost'] = 0;
		$_POST['panel_wattage'] = 0;
		$_POST['warranty_solar'] = 0;
		$_POST['solar_effect_warranty'] = 0;
		$_POST['supplier_solar_cells'] = '';
		$_POST['guarantee_after_30_years'] = 0;
		$_POST['panel_img'] = '';
		$_POST['solar_discount'] = 0;
		echo "Select panel type";
		exit();
	}
	
	if($_POST['inverter_type']!=''){
		$inverterTyeArray = json_decode($customerPriceArr["inverter_types"], true);
		foreach ($inverterTyeArray as $ikey => $ivalue) {
			if($ivalue["name"] == $_POST['inverter_type']){
				$_POST['inverter_cost'] = $ivalue["price"];
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
		}
	}else{
		$_POST['inverter_cost'] = 0;
		$_POST['inverter_type1_qty'] = 0;
		$_POST['warranty_inverter'] = 0;
		$_POST['inverter_brand'] = '';
		$_POST['inverter_img1'] = '';
	}
	
	if($_POST['inverter_type2']!=''){
		$inverterTyeArray = json_decode($customerPriceArr["inverter_types"], true);
		foreach ($inverterTyeArray as $ikey => $ivalue) {
			if($ivalue["name"] == $_POST['inverter_type2']){
				$_POST['inverter_cost2'] = $ivalue["price"];
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
		}
	}else{
		$_POST['inverter_cost2'] = 0;
		$_POST['inverter_type2_qty'] = 0;
		$_POST['warranty_inverter2'] = 0;
		$_POST['inverter_brand2'] = '';
		$_POST['inverter_img2'] = '';
	}
	
	if($_POST['inverter_type3']!=''){
		$inverterTyeArray = json_decode($customerPriceArr["inverter_types"], true);
		foreach ($inverterTyeArray as $ikey => $ivalue) {
			if($ivalue["name"] == $_POST['inverter_type3']){
				$_POST['inverter_cost3'] = $ivalue["price"];
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
		}
	}else{
		$_POST['inverter_cost3'] = 0;
		$_POST['inverter_type3_qty'] = 0;
		$_POST['warranty_inverter3'] = 0;
		$_POST['inverter_brand3'] = '';
		$_POST['inverter_img3'] = '';
	}
	
	//echo $_POST['installation_days'];die;
	if($_POST['installation_days']!=''){
		$installationArray = json_decode($customerPriceArr["installation_charges"], true);
		foreach ($installationArray as $inkey => $invalue) {
			if(swedish_to_decimal_format($invalue["day"]) == $_POST['installation_days']){
				$_POST['installation_cost'] = $invalue["price"];
				$_POST['work_performed'] = $invalue["work_year"];
				break;
			}
		}
	}else{
		$_POST['installation_cost'] = 0;
		$_POST['work_performed'] = 0;
		echo "Select installation days";
		exit();
	}
	
	if($_POST['roofing_material']!=''){
		$roof_type_price_Arr = json_decode($customerPriceArr["roof_type_price"], true);
		foreach ($roof_type_price_Arr as $key => $value) {
			if($_POST['roofing_material']==$value["name"]){
				$_POST['roof_cost_per_panel'] = $value['price'];
				break;
			}else{
				$mms_cost = 0;
			}
		}
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
	if($inverter_selected==''){
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
		$obj_btmrg = json_decode($customerPriceArr['battery_margin']);		
		$obj_battery = json_decode($customerPriceArr['green_rebate_battery']);
		
		$batteryTyeArray = json_decode($customerPriceArr["battery_types"], true);
		foreach ($batteryTyeArray as $bkey => $bvalue) {
			if($bvalue["name"] == $_POST['battery_name']){
				$_POST['battery_price'] = $bvalue["price"];
				$_POST['battery_warranty'] = $bvalue["bwarranty"];
				$_POST['battery_img'] = $bvalue["battery_img"];
				break;
			}
		}
		
		if($_POST['battery_qty']>0){
			$_POST['battery_qty'] = $_POST['battery_qty'];
		}else{					
			echo "Select Battery quantity";
			exit();
		}	
		
		//echo $battery_compatible;die;
		if($battery_compatible==''){
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
		$obj_evmrg = json_decode($customerPriceArr['ev_margin']);		
		$obj_ev = json_decode($customerPriceArr['green_rebate_ev']);
		
		$chargerTyeArray = json_decode($customerPriceArr["ev_charger_types"], true);
		foreach ($chargerTyeArray as $ckey => $cvalue) {
			if($cvalue["name"] == $_POST['charger_name']){
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
		}
				
		$_POST['charger_price_excluding_vat'] = ($_POST['charger_price']*$_POST['charger_qty'])*((100+$_POST['charger_margin'])/100); //EV charger Price (excluding VAT) (P) =  EV charger cost * Margins for EV charger (%)
		
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
		$_POST['price_excluding_vat'] = $cost*((100+$_POST['solar_margin'])/100); 
		//Price (excluding VAT)(P) = Cost* Margin for panels
		
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
	
	//if green rebate is more than 50000
	if($_POST['proposal_type']==1){
		if($_POST['green_rebate_kr']>$_POST['max_solar_rebate']){
			$extra_cost = $_POST['green_rebate_kr']-$_POST['max_solar_rebate'];
			$_POST['green_rebate_kr'] = $_POST['max_solar_rebate'];
			$_POST['extra_green_rebate'] = $extra_cost;
			$_POST['price_after_green_deduction'] = $_POST['price_after_green_deduction']+$extra_cost;
		}
	}
	else if($_POST['proposal_type']==8){
		//echo $_POST['green_rebate_kr'];die;
		//if person 1 
		if($_POST['number_of_person']==1){
			
			echo 'price_after_green_deduction-'.$_POST['price_after_green_deduction'];
			
			//check total of max rebate
			$total_max_rebate = $_POST['person1_solar_max_rebate']+$_POST['person1_charger_max_rebate']+$_POST['person1_battery_max_rebate'];
			if($total_max_rebate<=$_POST['max_solar_ev_battery_person1_rebate']){ 
				//if max rabate is under set rebate, check solar rebate with max solar rebate
				if($_POST['green_rebate_kr']>$_POST['person1_solar_max_rebate']){
					//echo '<br>green_rebate_kr'.$_POST['green_rebate_kr'];
					//echo '<br>extra_cost';
					 $extra_cost = $_POST['green_rebate_kr']-$_POST['person1_solar_max_rebate'];
					$_POST['green_rebate_kr'] = $_POST['green_rebate_kr']-$extra_cost;
					$_POST['extra_green_rebate'] = $extra_cost;
					//echo '<br>';
					 $_POST['price_after_green_deduction'] = $_POST['price_after_green_deduction']+$extra_cost;
				}
				//max charger green rebate should not be greater than given max rebate
				if($_POST['person1_charger_max_rebate']<=$_POST['ev_charger_max_fixed_rebate']){
					//check charger green rebate with max charger rebate
					if($_POST['charger_green_rebate_kr']>$_POST['person1_charger_max_rebate']){
						$extra_cost = $_POST['charger_green_rebate_kr']-$_POST['person1_charger_max_rebate'];
						$_POST['charger_green_rebate_kr'] = $_POST['charger_green_rebate_kr']-$extra_cost;
						$_POST['extra_green_rebate'] = $extra_cost;
						
						$_POST['charger_price_after_green_deduction'] = $_POST['charger_price_after_green_deduction']+$extra_cost;
						
						
						//$_POST['price_after_green_deduction'] = $_POST['price_after_green_deduction']+$extra_cost;
					}
				}else{
					echo "Charger max rebate should not be greater than ".$_POST['ev_charger_max_fixed_rebate'];
					exit();
				}
				
				//check battery green rebate with max battery rebate
				//echo 'battery_green_rebate_kr'.$_POST['battery_green_rebate_kr'];
				if($_POST['battery_green_rebate_kr']>$_POST['person1_battery_max_rebate']){
					$extra_cost = $_POST['battery_green_rebate_kr']-$_POST['person1_battery_max_rebate'];
					$_POST['battery_green_rebate_kr'] = $_POST['battery_green_rebate_kr']-$extra_cost;
					$_POST['extra_green_rebate'] = $extra_cost;
					//$_POST['price_after_green_deduction'] = $_POST['price_after_green_deduction']+$extra_cost;
					//echo 'battery_price_after_green_deduction'.$_POST['battery_price_after_green_deduction'];
					//echo '<br>';
					$_POST['battery_price_after_green_deduction'] = $_POST['battery_price_after_green_deduction']+$extra_cost;
					//echo 'battery_price_after_green_deductionEXTRA'.$_POST['battery_price_after_green_deduction'];
				}
			}else{
				echo "Sum of Solar, Charger and Battery max rebate should not be greater than ".$_POST['max_solar_ev_battery_person1_rebate'];
				exit();
			}
		}
		//if person 2
		if($_POST['number_of_person']==2){
			$total_max_rebate = $_POST['max_sevb_solar_person2_rebate']+$_POST['max_sevb_charger_person2_rebate'];
			//$_POST['total_green_rebate_kr'] = $_POST['green_rebate_kr']+$_POST['charger_green_rebate_kr']+$_POST['load_balancer_green_rebate_kr'];
			if($total_max_rebate<=$_POST['max_sevb_solarev_person2_rebate']){
				//if max rabate is under set rebate, check solar rebate with max solar rebate
				if($_POST['green_rebate_kr']>$_POST['max_sevb_solar_person2_rebate']){
					$extra_cost = $_POST['green_rebate_kr']-$_POST['max_sevb_solar_person2_rebate'];
					$_POST['green_rebate_kr'] = $_POST['green_rebate_kr']-$extra_cost;
					$_POST['extra_green_rebate'] = $extra_cost;
					$_POST['price_after_green_deduction'] = $_POST['price_after_green_deduction']+$extra_cost;
				}
				//max charger green rebate should not be greater than given max rebate
				if($_POST['max_sevb_charger_person2_rebate']<=$_POST['ev_charger_max_fixed_rebate']){
					//check charger green rebate with max charger rebate
					if($_POST['charger_green_rebate_kr']>$_POST['max_sevb_charger_person2_rebate']){
						$extra_cost = $_POST['charger_green_rebate_kr']-$_POST['max_sevb_charger_person2_rebate'];
						$_POST['charger_green_rebate_kr'] = $_POST['charger_green_rebate_kr']-$extra_cost;
						$_POST['extra_green_rebate'] = $extra_cost;
						//$_POST['price_after_green_deduction'] = $_POST['price_after_green_deduction']+$extra_cost;
						
						$_POST['charger_price_after_green_deduction'] = $_POST['charger_price_after_green_deduction']+$extra_cost;
					}
				}else{
					echo "Charger max rebate should not be greater than ".$_POST['ev_charger_max_fixed_rebate'];
					exit();
				}
								
				/*if($_POST['total_green_rebate_kr']>$_POST['max_sevb_solarev_person2_rebate']){
					$extra_cost = $_POST['total_green_rebate_kr']-$_POST['max_sevb_solarev_person2_rebate'];
					$_POST['green_rebate_kr'] = $_POST['max_sevb_solarev_person2_rebate'];
					$_POST['extra_green_rebate'] = $extra_cost;
					$_POST['price_after_green_deduction'] = $_POST['price_after_green_deduction']+$extra_cost;
				}*/
				if($_POST['battery_green_rebate_kr']>$_POST['max_sevb_battery_person2_rebate']){
					$extra_cost = $_POST['battery_green_rebate_kr']-$_POST['max_sevb_battery_person2_rebate'];
					$_POST['battery_green_rebate_kr'] = $_POST['max_sevb_battery_person2_rebate'];
					$_POST['extra_green_rebate'] = $_POST['extra_green_rebate']+$extra_cost;
					$_POST['battery_price_after_green_deduction'] = $_POST['battery_price_after_green_deduction']+$extra_cost;
				}
			}else{
				echo "Sum of Solar and Charger max rebate should not be greater than ".$_POST['max_sevb_battery_person2_rebate'];
				exit();
			}
		}
	}
	else if($_POST['proposal_type']==9){		
		if($_POST['number_of_person']==1){
			//check total of max rebate
			//echo '<br>';
			//echo 'green_rebate_kr'.$_POST['green_rebate_kr'];
			//echo '<br>';
			 $total_max_rebate = $_POST['person1_solar_max_rebate']+$_POST['person1_charger_max_rebate'];
			if($total_max_rebate<=$_POST['max_solar_ev_person1_rebate']){ 
				//if max rabate is under set rebate, check solar rebate with max solar rebate
				if($_POST['green_rebate_kr']>$_POST['person1_solar_max_rebate']){
					//echo '<br>';
					 $extra_cost = $_POST['green_rebate_kr']-$_POST['person1_solar_max_rebate'];
					
					//echo 'price_after_green_deduction2-'.$_POST['price_after_green_deduction'];
					
					
					$_POST['green_rebate_kr'] = $_POST['green_rebate_kr']-$extra_cost;
					$_POST['extra_green_rebate'] = $extra_cost;
					$_POST['price_after_green_deduction'] = $_POST['price_after_green_deduction']+$extra_cost;
					//echo '<br>';
					//echo 'price_after_green_deductionEXTRA-'.$_POST['price_after_green_deduction'];//die;
					
					
				}
				
				//echo 'charger_green_rebate_kr--'.$_POST['charger_green_rebate_kr'];
				//echo 'charger_price_after_green_deduction--'.$_POST['charger_price_after_green_deduction'];
				//max charger green rebate should not be greater than given max rebate
				if($_POST['person1_charger_max_rebate']<=$_POST['ev_charger_max_fixed_rebate']){
					//check charger green rebate with max charger rebate
					if($_POST['charger_green_rebate_kr']>$_POST['person1_charger_max_rebate']){
						//echo '<br>';
						 $extra_cost = $_POST['charger_green_rebate_kr']-$_POST['person1_charger_max_rebate'];
						//echo '<br>';
						
						$_POST['charger_green_rebate_kr'] = $_POST['charger_green_rebate_kr']-$extra_cost;
						$_POST['extra_green_rebate'] = $extra_cost;
						$_POST['charger_price_after_green_deduction'] = $_POST['charger_price_after_green_deduction']+$extra_cost;
						
						//echo 'charger_price_after_green_deduction--'.$_POST['charger_price_after_green_deduction'];
						
						//die;
						//$_POST['price_after_green_deduction'] = $_POST['price_after_green_deduction']+$extra_cost;
					}
				}else{
					echo "Charger max rebate should not be greater than ".$_POST['ev_charger_max_fixed_rebate'];
					exit();
				}
			}else{
				echo "Sum of Solar and Charger max rebate should not be greater than ".$_POST['max_solar_ev_person1_rebate'];
				exit();
			}
		}
		//if person 2
		if($_POST['number_of_person']==2){
			$_POST['total_green_rebate_kr'] = $_POST['green_rebate_kr']+$_POST['charger_green_rebate_kr']+$_POST['load_balancer_green_rebate_kr'];
			if($_POST['green_rebate_kr']>$_POST['max_sev_solar_person2_rebate']){
				$extra_cost = $_POST['green_rebate_kr']-$_POST['max_sev_solar_person2_rebate'];
				$_POST['green_rebate_kr'] = $_POST['max_sev_solar_person2_rebate'];
				$_POST['extra_green_rebate'] = $extra_cost;
				$_POST['price_after_green_deduction'] = $_POST['price_after_green_deduction']+$extra_cost;
			}
			if($_POST['charger_green_rebate_kr']>$_POST['max_sev_charger_person2_rebate']){
				$extra_cost = $_POST['charger_green_rebate_kr']-$_POST['max_sev_charger_person2_rebate'];
				$_POST['charger_green_rebate_kr'] = $_POST['max_sev_charger_person2_rebate'];
				$_POST['extra_green_rebate'] = $_POST['extra_green_rebate']+$extra_cost;
				$_POST['charger_price_after_green_deduction'] = $_POST['charger_price_after_green_deduction']+$extra_cost;
			}
		}
	}
	else if($_POST['proposal_type']==11){
		if($_POST['number_of_person']==1){
			//check total of max rebate
			$total_max_rebate = $_POST['person1_solar_max_rebate']+$_POST['person1_battery_max_rebate'];
			if($total_max_rebate<=$_POST['max_solar_battery_person1_rebate']){ 
				//if max rabate is under set rebate, check solar rebate with max solar rebate
				if($_POST['green_rebate_kr']>$_POST['person1_solar_max_rebate']){
					$extra_cost = $_POST['green_rebate_kr']-$_POST['person1_solar_max_rebate'];
					$_POST['green_rebate_kr'] = $_POST['green_rebate_kr']-$extra_cost;
					$_POST['extra_green_rebate'] = $extra_cost;
					$_POST['price_after_green_deduction'] = $_POST['price_after_green_deduction']+$extra_cost;
				}		
				
				//check battery green rebate with max battery rebate
				if($_POST['battery_green_rebate_kr']>$_POST['person1_battery_max_rebate']){
					$extra_cost = $_POST['battery_green_rebate_kr']-$_POST['person1_battery_max_rebate'];
					$_POST['battery_green_rebate_kr'] = $_POST['battery_green_rebate_kr']-$extra_cost;
					$_POST['extra_green_rebate'] = $extra_cost;
					//$_POST['price_after_green_deduction'] = $_POST['price_after_green_deduction']+$extra_cost;
					
					$_POST['battery_price_after_green_deduction'] = $_POST['battery_price_after_green_deduction']+$extra_cost;
					
				}
			}else{
				echo "Sum of Solar and Battery max rebate should not be greater than ".$_POST['max_solar_battery_person1_rebate'];
				exit();
			}
		}
		//if person 2
		if($_POST['number_of_person']==2){
			$_POST['total_green_rebate_kr'] = $_POST['green_rebate_kr']+$_POST['battery_green_rebate_kr'];
			if($_POST['green_rebate_kr']>$_POST['max_solar_person2_rebate']){
				$extra_cost = $_POST['green_rebate_kr']-$_POST['max_solar_person2_rebate'];
				$_POST['green_rebate_kr'] = $_POST['max_solar_person2_rebate'];
				$_POST['extra_green_rebate'] = $extra_cost;
				$_POST['price_after_green_deduction'] = $_POST['price_after_green_deduction']+$extra_cost;
			}
			if($_POST['battery_green_rebate_kr']>$_POST['max_battery_person2_rebate']){
				$extra_cost = $_POST['battery_green_rebate_kr']-$_POST['max_battery_person2_rebate'];
				$_POST['battery_green_rebate_kr'] = $_POST['max_battery_person2_rebate'];
				$_POST['extra_green_rebate'] = $_POST['extra_green_rebate']+$extra_cost;
				$_POST['battery_price_after_green_deduction'] = $_POST['battery_price_after_green_deduction']+$extra_cost;
			}
		}		
	}else{
		$_POST['extra_green_rebate'] = 0;
		$_POST['total_green_rebate_kr'] = 0;
	}
	
	//echo $_POST['battery_price_after_green_deduction'];die;
	
	//echo $_POST['extra_green_rebate'];die;
	//add extra green rebate in cost
	
	
	//if($_POST['extra_green_rebate']>0 && $_POST['proposal_type']!=10){
		//$_POST['proposal_total_cost'] = $_POST['price_after_green_deduction'];
		//$_POST['proposal_total_cost'] = $_POST['price_after_green_deduction']+$_POST['extra_green_rebate'];
		/*if($_POST['battery_extra_green_rebate']>0 && $_POST['proposal_type']==8 && $_POST['number_of_proposal']==1){
			$_POST['proposal_total_cost'] = $_POST['proposal_total_cost']+$battery_extra_cost;
		}*/
	//}
	//else{
		//$_POST['proposal_total_cost'] = $_POST['price_after_green_deduction'];
	//}
	
	
	
	/*if($_POST['proposal_type']==1 || $_POST['proposal_type']==2 || $_POST['proposal_type']==3 || $_POST['proposal_type']==4){
		$_POST['price_after_green_deduction'] = $_POST['price_after_green_deduction']+$_POST['extra_green_rebate'];
	}*/
	
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
	echo 'proposal_total_cost'.$_POST['proposal_total_cost'];
	
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
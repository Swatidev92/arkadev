<?php
//print_r($_POST);die;
extract($_POST);
if($first_name!='' && $last_name!='' && $address_input!='' && $postal_code!='' && $email!='' && $phone!=''){

	$totcost=0; $greenSubsidy=0; $netCost=0; $total_capacity=0; $annual_savings=0; $pvar=0; $upVar=0; $upfrontCost=''; $battery='No'; $car_charger='No'; $upfrontCostCharger=0; $upfrontCostBattery=0; $upfrontCostPanel=0;

	//$size = getSize($roof_area);

		
	$solarQry = $cms->db_query("SELECT `panel_capacity1`, `panel_capacity2`, `panel_capacity3`, `panel_capacity1_sw`, `panel_capacity2_sw`, `panel_capacity3_sw` FROM #_solar where id=1 ");
	$solarRes = $solarQry->fetch_array();


	$calCQry = $cms->db_query("SELECT * FROM #_solar_calculator where id=1 ");
	$calCRes = $calCQry->fetch_array();
												

	if($sel_panel_type == 'Optimized'){
		$pvar= $solarRes['panel_capacity1'];
		$panel_cost = $calCRes['panel_cost1'];
	}else if($sel_panel_type == 'Esthetic'){
		$pvar= $solarRes['panel_capacity2'];
		$panel_cost = $calCRes['panel_cost2'];
	}else if($sel_panel_type == 'Performance'){
		$pvar= $solarRes['panel_capacity3'];
		$panel_cost = $calCRes['panel_cost3'];
	}

	//solar installation cost

	$obj_install1 = json_decode($calCRes['installation_cost1']);
	$obj_install2 = json_decode($calCRes['installation_cost2']);
	$obj_install3 = json_decode($calCRes['installation_cost3']);
	$obj_install4 = json_decode($calCRes['installation_cost4']);
	$obj_install5 = json_decode($calCRes['installation_cost5']);

	if($obj_install1->fromrange!=''){
		if($panels>=$obj_install1->fromrange && $panels<$obj_install1->torange){
			$installation_cost = $obj_install1->cost;
		}
	}
	if($obj_install2->fromrange!=''){
		if($panels>=$obj_install2->fromrange && $panels<$obj_install2->torange){
			$installation_cost = $obj_install2->cost;
		}
	}
	if($obj_install3->fromrange!=''){
		if($panels>=$obj_install3->fromrange && $panels<$obj_install3->torange){
			$installation_cost = $obj_install3->cost;
		}
	}
	if($obj_install4->fromrange!=''){
		if($panels>=$obj_install4->fromrange && $panels<$obj_install4->torange){
			$installation_cost = $obj_install4->cost;
		}
	}
	if($obj_install5->fromrange!=''){
		if($panels>=$obj_install5->fromrange && $panels<$obj_install5->torange){
			$installation_cost = $obj_install5->cost;
		}
	}


	$total_capacity = getCapacity($roof_area, $pvar);
	$annual_savings = getAnnualSavings($total_capacity);


	$mms_cost = $panels*$calCRes['fixed_mms']; //Panels*350

	//solar inverter cost

	$obj_inver1 = json_decode($calCRes['inverter_cost1']);	
	$obj_inver2 = json_decode($calCRes['inverter_cost2']);	
	$obj_inver3 = json_decode($calCRes['inverter_cost3']);	
	$obj_inver4 = json_decode($calCRes['inverter_cost4']);	
	$obj_inver5 = json_decode($calCRes['inverter_cost5']);	


	if($obj_inver1->fromrange!=''){
		if($panels>=$obj_inver1->fromrange && $panels<$obj_inver1->torange){
			$Inverter_cost = $obj_inver1->cost;
		}
	}	
	if($obj_inver2->fromrange!=''){
		if($panels>=$obj_inver2->fromrange && $panels<$obj_inver2->torange){
			$Inverter_cost = $obj_inver2->cost;
		}
	}	
	if($obj_inver3->fromrange!=''){
		if($panels>=$obj_inver3->fromrange && $panels<$obj_inver3->torange){
			$Inverter_cost = $obj_inver3->cost;
		}
	}	
	if($obj_inver4->fromrange!=''){
		if($panels>=$obj_inver4->fromrange && $panels<$obj_inver4->torange){
			$Inverter_cost = $obj_inver4->cost;
		}
	}	
	if($obj_inver5->fromrange!=''){
		if($panels>=$obj_inver5->fromrange && $panels<$obj_inver5->torange){
			$Inverter_cost = $obj_inver5->cost;
		}
	}		


		
	$vat = (100+$calCRes['vat_percentage'])/100;
	$margin = (100+$calCRes['magin_percentage'])/100;

	$upfrontCostPanel = upfrontCost($panels, $panel_cost, $mms_cost, $installation_cost, $Inverter_cost, $vat, $margin);
	$solarGreenSubsidy = solarGreenSubsidy($upfrontCostPanel, $calCRes['green_rebate_solar']);

	$solar_customer_price = $upfrontCostPanel-$solarGreenSubsidy;

	$addonArr = explode(',',$sel_addon_type);
	//for battery
	if(in_array('at1',$addonArr)){
		//$upfrontCostBattery = $calCRes['battery_cost'];
		//$upfrontCostBattery = $upfrontCostPanel+$addon_cost;
		$battery ='Yes';
		//battery cost calculation
		$upfrontCostBattery = ($calCRes['battery_cost']+ $calCRes['battery_installation_cost'])*$vat*$margin;
		$batteryGreenSubsidy = batteryGreenSubsidy($upfrontCostBattery, $calCRes['green_rebate_battery']);
		$battery_customer_price = $upfrontCostBattery-$batteryGreenSubsidy;
	}
	//for charger
	if(in_array('at2',$addonArr)){
		//$upfrontCostCharger = $calCRes['charger_cost'];
		//$upfrontCostCharger = $upfrontCostPanel+$addon_cost;
		$charger='Yes';
		//charger cost calculation
		$upfrontCostCharger = ($calCRes['charger_cost']+$calCRes['charger_installation_cost'])*$vat*$margin;
		$chargerGreenSubsidy = chargerGreenSubsidy($upfrontCostCharger, $calCRes['green_rebate_charger']);
		$charger_customer_price = $upfrontCostCharger-$chargerGreenSubsidy;
	}
	$upfrontCost = $upfrontCostPanel+$upfrontCostBattery+$upfrontCostCharger;
	//$price = getPrice($upfrontCostPanel, $upfrontCostBattery , $upfrontCostCharger);

	$final_price = customerPrice($solar_customer_price, $battery_customer_price, $charger_customer_price);

	$greenSubsidy = greenSubsidy($upfrontCostPanel, $upfrontCostBattery , $upfrontCostCharger);
	//$price = getPrice($upfrontCostPanel, $upfrontCostBattery , $upfrontCostCharger);
	$payback_time = getPaybackTime($price, $annual_savings);
	$yearlyProd = yearlyEnergyProduction($total_capacity);


	$_POST['upfront_cost'] = $upfrontCost;
	$_POST['total_cost'] = $final_price;
	$_POST['green_subsidy'] = $greenSubsidy;
	$_POST['annual_savings'] = $annual_savings;
	$_POST['payback_time'] = $payback_time;
	$_POST['yearly_energy_production'] = $yearlyProd;
	$_POST['post_date'] = date("Y-m-d");
	$_POST['form_type'] = 1;
	$_POST['status'] = 1;
	$_POST['source'] = 1;
	$_POST['customer_name'] = $_POST['first_name'].($_POST['last_name']?' '.$_POST['last_name']:'');
	
	//print_r($_POST);die;
	$user_map_area = $_SESSION['user_map_area'];
	$attached_img = SITE_FS_PATH.'/uploaded_files/user_map/'.$user_map_area;
	//file_put_contents($attached_img, file_get_contents($user_map_area));
	$insertId = $cms->sqlquery("rs","leads",$_POST);
	
	
	if($countryConst=='SE'){
		$subject='Tack för att du fyller i formuläret!';	
		$msg='Hej '.$_POST['customer_name'].',<br>Tack för att du visade ditt intresse för Arka. <br> En av våra experter kommer att kontakta dig inom kort för att diskutera nästa steg.<br>vänliga hälsningar,<br>Arka Team';
	
	}else{
		$subject='Thank you for filling out the form!';
		$msg='Hi '.$_POST['customer_name'].',<br>Thank you for showing your interest in Arka.<br>One of our experts will contact you shortly to discuss the next step.<br>Regards,<br>Arka Team';
	}

	$email_msg= emailFormat($msg);
		
	$m1 = sendEmail($email,$subject,$email_msg);
	
	//mail to admin
	
	//$adminemail = 'sneha.techblue@gmail.com';
	$adminemail = $settingArr['from_email'];
	$adminsubject = 'Arka solar panel enquiry from '.$first_name.' '.$last_name;
	
	$admin_msg = 'Hi Admin,<br> Please find details below and attached roof area image.<br>
				<table>
					<tr><td>Name: '.$first_name.' '.$last_name.'</td></tr>
					<tr><td>Email: '.$email.'</td></tr>
					<tr><td>Phone: '.$phone.'</td></tr>
					<tr><td>Address: '.$address_input.'</td></tr>
					<tr><td>Postal Code: '.$postal_code.'</td></tr>
					<tr><td>Area: '.$roof_area.' m<sup>2</sup></td></tr>
					<tr><td>Size: '.$size.' KW</td></tr>
					<tr><td>Panels: '.$panels.' Solar Panels</td></tr>
					<tr><td>Latitude: '.$sellong.'</td></tr>
					<tr><td>Longitude: '.$sellat.' </td></tr>
					<tr><td>Slope Type: '.$slope_type.' </td></tr>
					<tr><td>Panel Type: '.$panel_type.' </td></tr>
					<tr><td>Battery: '.$battery.' </td></tr>
					<tr><td>Car Charger: '.$car_charger.' </td></tr>
					<tr><td>Upfront Cost: '.amount_format_proposal($upfrontCost).'</td></tr>
					<tr><td>Total Cost: '.amount_format_proposal($final_price).'</td></tr>
					<tr><td>Green Subsidy: '.amount_format_proposal($greenSubsidy).'</td></tr>
					<tr><td>Annual Savings: '.amount_format_proposal($annual_savings).'</td></tr>
					<tr><td>Payback Time: '.$payback_time.'</td></tr>
					<tr><td>Yearly Energy Production: '.value_format($yearlyProd).'</td></tr>
				</table>';
				
	$email_adminmsg= emailFormat($admin_msg);			
				
				//$admin_msg='test';
				
//echo $admin_msg;die;
	$m2 = sendEmail($adminemail,$adminsubject,$email_adminmsg,$attached_img);
	
	if($m1 && $m2){
	//if(1){
		echo 1;
	}else{
		echo 0;
	}
}

?>
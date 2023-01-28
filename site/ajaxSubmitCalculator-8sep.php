<?php
//print_r($_POST);die;
extract($_POST);
if($first_name!='' && $last_name!='' && $address_input!='' && $postal_code!='' && $email!='' && $phone!=''){

	$totcost=0; $greenSubsidy=0; $netCost=0; $total_capacity=0; $annual_savings=0; $pvar=0; $upVar=0; $upfrontCost=''; $battery='No'; $car_charger='No';

	//$size = getSize($roof_area);

	if($sel_panel_type == 'Optimized'){
		$pvar= 400;
		$panel_cost = 1254.4;
	}else if($sel_panel_type == 'Esthetic'){
		$pvar= 395;
		$panel_cost = 1344;
	}else if($sel_panel_type == 'Performance'){
		$pvar= 375;
		$panel_cost = 2128;
	}

	if($panels<=20){
		$installation_cost = 15000;
	}
	else if($panels>20 && $roof_area<=40){
		$installation_cost = 20000;
	}
	else{
		$installation_cost = 25000;
	}

	$total_capacity = getCapacity($roof_area, $pvar);
	$annual_savings = getAnnualSavings($total_capacity);

	$mms_cost = $panels*350; //Panels*350

	if($total_capacity<=12){
		$Inverter_cost = 10000;	
	}else{
		$Inverter_cost = 15000;	
	}

	$upfrontCost = upfrontCost($panels, $panel_cost, $mms_cost, $installation_cost, $Inverter_cost);



	$addonArr = explode(',',$sel_addon_type);
	//for battery
	if(in_array('at1',$addonArr)){
		$addon_cost = 25000;
		$upfrontCost = $upfrontCost+$addon_cost;
		$battery ='Yes';
	}
	//for charger
	if(in_array('at2',$addonArr)){
		$addon_cost = 8500;
		$upfrontCost = $upfrontCost+$addon_cost;
		$charger='Yes';
	}


	$greenSubsidy = greenSubsidy($upfrontCost);
	$price = getPrice($upfrontCost);
	$payback_time = getPaybackTime($price, $annual_savings);
	$yearlyProd = yearlyEnergyProduction($total_capacity);

	$_POST['total_cost'] = $price;
	$_POST['green_subsidy'] = $greenSubsidy;
	$_POST['annual_savings'] = $annual_savings;
	$_POST['payback_time'] = $payback_time;
	$_POST['yearly_energy_production'] = $yearlyProd;
	$_POST['post_date'] = date("Y-m-d");
	$_POST['form_type'] = 1;
	$_POST['customer_name'] = $_POST['first_name'].($_POST['last_name']?' '.$_POST['last_name']:'');
	
	//print_r($_POST);die;
	$user_map_area = $_SESSION['user_map_area'];
	$attached_img = SITE_FS_PATH.'/uploaded_files/user_map/'.$user_map_area;
	//file_put_contents($attached_img, file_get_contents($user_map_area));
	$insertId = $cms->sqlquery("rs","leads",$_POST);
	
	
	if($countryConst=='SE'){
		$subject='Arka - Tack för att du fyller i formuläret!';	
		$msg='Hi '.$_POST['customer_name'].',<br>Tack för att du visade ditt intresse för Arka. <br> En av våra experter kommer att kontakta dig inom kort för att diskutera nästa steg.<br>Regards,<br>Arka Team';
	
	}else{
		$subject='Arka - Thank you for filling out the form!';
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
					<tr><td>Upfront Cost: '.amount_format($price).'</td></tr>
					<tr><td>Green Subsidy: '.amount_format($greenSubsidy).'</td></tr>
					<tr><td>Annual Savings: '.amount_format($annual_savings).'</td></tr>
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
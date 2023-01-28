<?php
//print_r($_POST);die;
extract($_POST);

$totcost=0; $greenSubsidy=0; $netCost=0; $total_capacity=0; $annual_savings=0; $pvar=0; $upVar=0; $upfrontCost=''; $Inverter_cost=0; $installation_cost=0; $mms_cost=0; $panel_cost=0; $upfrontCostCharger=0; $upfrontCostBattery=0; $upfrontCostPanel=0;

$battery ='No'; $charger='No';

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

if($panels<=20){
	$installation_cost = $calCRes['installation_cost_min'];
}
else if($panels>20 && $panels<=50){
	$installation_cost = $calCRes['installation_cost_avg'];
}
else{
	$installation_cost = $calCRes['installation_cost_max'];
}

$total_capacity = getCapacity($roof_area, $pvar);
$annual_savings = getAnnualSavings($total_capacity);


$mms_cost = $panels*350; //Panels*350

if($total_capacity<=12){
	$Inverter_cost = $calCRes['Inverter_cost_min'];	
}else{
	$Inverter_cost = $calCRes['Inverter_cost_max'];	
}


$upfrontCostPanel = upfrontCost($panels, $panel_cost, $mms_cost, $installation_cost, $Inverter_cost);


$addonArr = explode(',',$sel_addon_type);
//for battery
if(in_array('at1',$addonArr)){
	$upfrontCostBattery = $calCRes['battery_cost'];
	//$upfrontCostBattery = $upfrontCostPanel+$addon_cost;
	$battery ='Yes';
}
//for charger
if(in_array('at2',$addonArr)){
	$upfrontCostCharger = $calCRes['charger_cost'];
	//$upfrontCostCharger = $upfrontCostPanel+$addon_cost;
	$charger='Yes';
}
$upfrontCost = $upfrontCostPanel+$upfrontCostBattery+$upfrontCostCharger;
$price = getPrice($upfrontCostPanel, $upfrontCostBattery , $upfrontCostCharger);



echo amount_format($price).'|'.amount_format($annual_savings);


?>
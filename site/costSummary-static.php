<?php
//print_r($_POST);die;
extract($_POST);

$totcost=0; $greenSubsidy=0; $netCost=0; $total_capacity=0; $annual_savings=0; $pvar=0; $upVar=0; $upfrontCost=''; $Inverter_cost=0; $installation_cost=0; $mms_cost=0; $panel_cost=0; $upfrontCostCharger=0; $upfrontCostBattery=0; $upfrontCostPanel=0;

$battery ='No'; $charger='No';

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
else if($panels>20 && $panels<=40){
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

$upfrontCostPanel = upfrontCost($panels, $panel_cost, $mms_cost, $installation_cost, $Inverter_cost);


$addonArr = explode(',',$sel_addon_type);
//for battery
if(in_array('at1',$addonArr)){
	$upfrontCostBattery = 25000;
	//$upfrontCostBattery = $upfrontCostPanel+$addon_cost;
	$battery ='Yes';
}
//for charger
if(in_array('at2',$addonArr)){
	$upfrontCostCharger = 8500;
	//$upfrontCostCharger = $upfrontCostPanel+$addon_cost;
	$charger='Yes';
}
$upfrontCost = $upfrontCostPanel+$upfrontCostBattery+$upfrontCostCharger;

$greenSubsidy = greenSubsidy($upfrontCostPanel, $upfrontCostBattery , $upfrontCostCharger);
$price = getPrice($upfrontCostPanel, $upfrontCostBattery , $upfrontCostCharger);
$payback_time = getPaybackTime($price, $annual_savings);
$yearlyProd = yearlyEnergyProduction($total_capacity);


echo amount_format($upfrontCost).'|'.amount_format($annual_savings).'|'.amount_format($greenSubsidy).'|'.$payback_time.'|'.value_format($yearlyProd).'|'.$panels.'|'.$panel_type.'|'.$slope_type.'|'.$battery.'|'.$charger.'|'.$roof_area.'|'.$total_capacity.'|'.amount_format($price);


?>
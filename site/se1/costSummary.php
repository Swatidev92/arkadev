<?php
//print_r($_POST);die;
extract($_POST);

$totcost=0; $greenSubsidy=0; $netCost=0; $total_capacity=0; $annual_savings=0; $pvar=0; $upVar=0; $upfrontCost='';
$battery ='No'; $charger='No';

if($sel_panel_type == 'Essential'){
	$pvar= 950;
}else if($sel_panel_type == 'Design'){
	$pvar= 970;
}else if($sel_panel_type == 'Pro'){
	$pvar= 980;
}
$annual_savings = getAnnualSavings($roof_area, $panel_val, $pvar);

if($roof_area<5){
	$upVar = 16000;
}
else if($roof_area>5 && $roof_area<15){
	$upVar = 11300;
}
else{
	$upVar = 10000;
}


$upfrontCost = upfrontCost($roof_area, $panel_val, $upVar);

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
$payback_time = getPaybackTime($upfrontCost, $greenSubsidy, $annual_savings);
$yearlyProd = yearlyEnergyProduction($roof_area,$panel_val,$pvar);


echo amount_format($upfrontCost).'|'.amount_format($annual_savings).'|'.amount_format($greenSubsidy).'|'.$payback_time.'|'.value_format($yearlyProd).'|'.$panels.'|'.$panel_type.'|'.$slope_type.'|'.$battery.'|'.$charger.'|'.$roof_area.'|'.$size;


?>
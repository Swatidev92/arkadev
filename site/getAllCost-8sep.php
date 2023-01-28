<?php
//print_r($_POST);die;
extract($_POST);

$totcost=0; $greenSubsidy=0; $netCost=0; $total_capacity=0; $annual_savings=0; $pvar=0; $upVar=0; $upfrontCost=''; $Inverter_cost=0; $installation_cost=0; $mms_cost=0; $panel_cost=0;

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

$upfrontCost = upfrontCost($panels, $panel_cost, $mms_cost, $installation_cost, $Inverter_cost);


$addonArr = explode(',',$sel_addon_type);
//for battery
if(in_array('at1',$addonArr)){
	$addon_cost = 25000;
	$upfrontCost = $upfrontCost+$addon_cost;
}
//for charger
if(in_array('at2',$addonArr)){
	$addon_cost = 8500;
	$upfrontCost = $upfrontCost+$addon_cost;
}




/*$totcost = getTotalCost($avg_monthly_bill);
$taxBenefit = getTaxBenefit($avg_monthly_bill);
$netCost = getNetCost($totcost, $taxBenefit);
$total_capacity = getCapacity($avg_monthly_bill);
$annual_savings = getAnnualSavings($avg_monthly_bill, $b_value);
$payback_time = getPaybackTime($avg_monthly_bill, $netCost, $b_value);
$yearlyProd = yearlyEnergyProduction($avg_monthly_bill);
$emmissionSaving = emmissionSaving($avg_monthly_bill);*/


echo amount_format($upfrontCost).'|'.amount_format($annual_savings);


?>
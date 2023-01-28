<?php
//print_r($_POST);die;
extract($_POST);

$totcost=0; $taxBenefit=0; $netCost=0; $total_capacity=0; $annual_savings=0; $pvar=0; $upVar=0; $upfrontCost='';

if($sel_panel_type == 'Essential'){
	$pvar= 950;
}else if($sel_panel_type == 'Design'){
	$pvar= 970;
}else if($sel_panel_type == 'Pro'){
	$pvar= 980;
}

$annual_savings = getAnnualSavings($roof_area, $panel_val, $pvar);
$yearlyProd = yearlyEnergyProduction($roof_area, $panel_val, $pvar);

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
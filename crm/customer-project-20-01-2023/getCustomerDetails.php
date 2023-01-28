<?php 
include("../../lib/opin.inc.php");
extract($_POST);
$HTML = "";
if($custID){
	$custQry = $cms->db_query("SELECT email,phone,quotation_number,lead_id, system_size, roofing_material, charger_name, panel_model, assigned_to, charger_qty, battery_name, battery_qty, inverter_type, inverter_type2, inverter_type3, inverter_type1_qty, inverter_type2_qty, inverter_type3_qty, sensor_type_name, sensor_qty, odrift_type_name, odrift_qty, optimizer_type_name, optimizer_qty FROM #_leads where id=$custID ");
	$custRes = $custQry->fetch_array();
	
	$customerPriceQry = $cms->db_query("SELECT * FROM #_customer_price where id=1 ");
	$customerPriceArr = $customerPriceQry->fetch_array(); 
	$panelTyeArray = json_decode($customerPriceArr['panel_types'],true);
	foreach ($panelTyeArray as $key => $value) {
		if($value["pstatus"]==1){
			if($custRes['panel_model']==$value["name"]){
				$selEffectFactor = $value["effektfaktor"];
				$selshort_circuit = $value["short_circuit"];
				break;
			}else{
				$selEffectFactor = '';
			}
		}
 	}
	
	$panel_type = '<option value="">Select Panel Type</option>';
		$panelTyeArray = json_decode($customerPriceArr["panel_types"], true);
		usort($panelTyeArray, function ($a, $b) {
			return $a['name'] <=> $b['name'];
		});
		foreach ($panelTyeArray as $key => $value) {
			if($value["pstatus"]==1){
				if($custRes['panel_model']==$value["name"]){
					$psel = 'selected';
				}else{
					$psel = '';
				}
			$panel_type .='<option value="'.$value["name"].'" '.$psel.'>'.$value["name"].' - '.$value["wattage"].' Wp</option>';
		} 	}
		
	$charger_type ='<option value="">Select EV Charger</option>';
		$chargerTyeArray = json_decode($customerPriceArr["ev_charger_types"], true);
		usort($chargerTyeArray, function ($a, $b) {
			return $a['name'] <=> $b['name'];
		});
		foreach ($chargerTyeArray as $ckey => $cvalue) {
			if($cvalue["evstatus"]==1){
			if($custRes['charger_name']==$cvalue["name"]){
				$csel = 'selected';
			}else{
				$csel = '';
			}
		$charger_type .='<option value="'.$cvalue["name"].'" '.$csel.'>'.$cvalue["name"].'</option>';
		} }
		
	$battery_type ='<option value="">Select Battery</option>';
		$batteryTyeArray = json_decode($customerPriceArr["battery_types"], true);
		usort($batteryTyeArray, function ($a, $b) {
			return $a['name'] <=> $b['name'];
		});
		foreach ($batteryTyeArray as $bkey => $bvalue) {
			if($bvalue["bstatus"]==1){
			if($custRes['battery_name']==$bvalue["name"]){
				$bsel = 'selected';
				$battery_size = $bvalue["btsize"];
			}else{
				$bsel = '';
			}
		 $battery_type .='<option value="'.$bvalue["name"].'" '.$bsel.'>'.$bvalue["name"].'</option>';
		} }
		
	$inverter_type1 ='<option value="">Select Inverter Type</option>';
		$inverterTyeArray = json_decode($customerPriceArr["inverter_types"], true);
		usort($inverterTyeArray, function ($a, $b) {
			return $a['name'] <=> $b['name'];
		});
		foreach ($inverterTyeArray as $ikey => $ivalue) {
			if($ivalue["invstatus"]){
			if($custRes['inverter_type']==$ivalue["name"]){
				$invsel = 'selected';
				$inverter1_effect = $ivalue["inveffect"];
			}else{
				$invsel = '';
			}
		$inverter_type1 .='<option value="'.$ivalue["name"].'" '.$invsel.'>'.$ivalue["name"].'</option>';
		} }
		
		
	$inverter_type2 ='<option value="">Select Inverter Type</option>';
		$inverterTyeArray = json_decode($customerPriceArr["inverter_types"], true);
		usort($inverterTyeArray, function ($a, $b) {
			return $a['name'] <=> $b['name'];
		});
		foreach ($inverterTyeArray as $ikey => $ivalue) {
			if($ivalue["invstatus"]){
			if($custRes['inverter_type2']==$ivalue["name"]){
				$invsel = 'selected';
				$inverter2_effect = $ivalue["inveffect"];
			}else{
				$invsel = '';
			}
		$inverter_type2 .='<option value="'.$ivalue["name"].'" '.$invsel.'>'.$ivalue["name"].'</option>';
		} }
		
	$inverter_type3 ='<option value="">Select Inverter Type</option>';
		$inverterTyeArray = json_decode($customerPriceArr["inverter_types"], true);
		usort($inverterTyeArray, function ($a, $b) {
			return $a['name'] <=> $b['name'];
		});
		foreach ($inverterTyeArray as $ikey => $ivalue) {
			if($ivalue["invstatus"]){
			if($custRes['inverter_type3']==$ivalue["name"]){
				$invsel = 'selected';
				$inverter3_effect = $ivalue["inveffect"];
			}else{
				$invsel = '';
				
			}
		$inverter_type3 .='<option value="'.$ivalue["name"].'" '.$invsel.'>'.$ivalue["name"].'</option>';
		} }
		
	$smart_sensor ='<option value="">Select Smart Sensor</option>';
		$sensorTypeArray = json_decode($customerPriceArr["sensor_type"], true);
		usort($sensorTypeArray, function ($a, $b) {
			return $a['sensor_name'] <=> $b['sensor_name'];
		});
		foreach ($sensorTypeArray as $snkey => $snvalue) {
			if($snvalue["sensor_status"]==1){
			if($custRes['sensor_type_name']==$snvalue["sensor_name"]){
				$snsel = 'selected';
			}else{
				$snsel = '';
			}
			$smart_sensor .='<option value="'.$snvalue["sensor_name"].'" '.$snsel.'>'.$snvalue["sensor_name"].'</option>';
		} }
		
	$odrift_type .'<option value="">Select Backup Box</option>';
		$odriftTypeArray = json_decode($customerPriceArr["odrift_type"], true);
		usort($odriftTypeArray, function ($a, $b) {
			return $a['odrift_name'] <=> $b['odrift_name'];
		});
		foreach ($odriftTypeArray as $odkey => $odvalue) {
			if($odvalue["odrift_status"]==1){
			if($custRes['odrift_type_name']==$odvalue["odrift_name"]){
				$snsel = 'selected';
			}else{
				$snsel = '';
			}
			$odrift_type .='<option value="'.$odvalue["odrift_name"].'" '.$snsel.'>'.$odvalue["odrift_name"].'</option>';
		} }
		
	$optimizer_type .'<option value="">Select Optimizer</option>';
		$optimizerTypeArray = json_decode($customerPriceArr["optimizer_type"], true);
		usort($optimizerTypeArray, function ($a, $b) {
			return $a['optimizer_name'] <=> $b['optimizer_name'];
		});
		foreach ($optimizerTypeArray as $odkey => $odvalue) {
			if($odvalue["optimizer_status"]==1){
			if($custRes['optimizer_type_name']==$odvalue["optimizer_name"]){
				$snsel = 'selected';
			}else{
				$snsel = '';
			}
			$optimizer_type .='<option value="'.$odvalue["optimizer_name"].'" '.$snsel.'>'.$odvalue["optimizer_name"].'</option>';
		} }
		
	echo $custRes['quotation_number'].'|'.$custRes['email'].'|'.$custRes['phone'].'|'.$custRes['lead_id'].'|'.$custRes['system_size'].'|'.$custRes['roofing_material'].'|'.$charger_type.'|'.$selEffectFactor.'|'.$selshort_circuit.'|'.$custRes['assigned_to'].'|'.$panel_type.'|'.$custRes['charger_qty'].'|'.$battery_type.'|'.$custRes['battery_qty'].'|'.$inverter_type1.'|'.$custRes['inverter_type1_qty'].'|'.$inverter_type2.'|'.$custRes['inverter_type2_qty'].'|'.$inverter_type3.'|'.$custRes['inverter_type3_qty'].'|'.$smart_sensor.'|'.$custRes['sensor_qty'].'|'.$odrift_type.'|'.$custRes['odrift_qty'].'|'.$optimizer_type.'|'.$custRes['optimizer_qty'].'|'.$battery_size.'|'.$inverter1_effect.'|'.$inverter2_effect.'|'.$inverter3_effect;
}else{
	echo 0;
}
die();
?>
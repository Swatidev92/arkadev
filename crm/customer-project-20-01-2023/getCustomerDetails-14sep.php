<?php 
include("../../lib/opin.inc.php");
extract($_POST);
$HTML = "";
if($custID){
	$custQry = $cms->db_query("SELECT email,phone,quotation_number,lead_id, system_size, roofing_material, charger_name, panel_model, assigned_to FROM #_leads where id=$custID ");
	$custRes = $custQry->fetch_array();
	
	$customerPriceQry = $cms->db_query("SELECT panel_types FROM #_customer_price where id=1 ");
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
	
	echo $custRes['quotation_number'].'|'.$custRes['email'].'|'.$custRes['phone'].'|'.$custRes['lead_id'].'|'.$custRes['system_size'].'|'.$custRes['roofing_material'].'|'.$custRes['charger_name'].'|'.$selEffectFactor.'|'.$selshort_circuit.'|'.$custRes['assigned_to'];
}else{
	echo 0;
}
die();
?>
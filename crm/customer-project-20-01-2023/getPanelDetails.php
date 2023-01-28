<?php 
include("../../lib/opin.inc.php");
extract($_POST);
$HTML = "";
if($panel_name){
	$customerPriceQry = $cms->db_query("SELECT panel_types FROM #_customer_price where id=1 ");
	$customerPriceArr = $customerPriceQry->fetch_array(); 
	$panelTyeArray = json_decode($customerPriceArr['panel_types'],true);
	foreach ($panelTyeArray as $key => $value) {
		if($value["pstatus"]==1){
			if($panel_name==$value["name"]){
				$selEffectFactor = $value["effektfaktor"];
				$selshort_circuit = $value["short_circuit"];
				break;
			}else{
				$selEffectFactor = '';
				$selshort_circuit = '';
			}
		}
 	}
		
	echo $selEffectFactor.'|'.$selshort_circuit;
}else{
	echo 0;
}
die();
?>
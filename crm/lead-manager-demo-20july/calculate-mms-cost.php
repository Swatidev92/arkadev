<?php include("../../lib/opin.inc.php");

//print_r($_POST);die;
$perPanelPrice = 0;
if($_POST['panel_count']!='' && $_POST['roof_type']!=''){
	$customerPriceQry = $cms->db_query("select roof_type_price from #_customer_price where id='1'");
	$customerPriceRes = $customerPriceQry->fetch_array();
	
	$roof_type_price_Arr = json_decode($customerPriceRes["roof_type_price"], true);
	foreach ($roof_type_price_Arr as $key => $value) {
		if($_POST['roof_type']==$value["name"]){
			$perPanelPrice = $value['price'];
			$mms_cost = calculate_mms_cost($_POST['panel_count'],$perPanelPrice);
			break;
		}else{
			$mms_cost = 0;
		}
	}
	echo $mms_cost;
}else if($_POST['panel_count']!='' && $_POST['roof_type']==''){
	echo -1;
}else{
	echo 0;
}
die;
?>
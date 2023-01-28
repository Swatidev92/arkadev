<?php include("../../lib/opin.inc.php");

//print_r($_POST);die;
$battery_discount = '';
if($_POST['battery_name']!=''){
	$batteryQry = $cms->db_query("select battery_types from #_customer_price where id='1'");
	$batteryRes = $batteryQry->fetch_array();
	
	$batteryTyeArray = json_decode($batteryRes["battery_types"], true);
	foreach ($batteryTyeArray as $bkey => $bvalue) {
		if($_POST['battery_name']==$bvalue["name"]){
			$battery_discount = $bvalue['bdiscount'];
			break;
		}
	}
	echo $battery_discount;
}else{
	echo 0;
}
die;
?>
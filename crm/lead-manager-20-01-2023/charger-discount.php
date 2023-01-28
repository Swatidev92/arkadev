<?php include("../../lib/opin.inc.php");

//print_r($_POST);die;
$charger_discount = '';
if($_POST['charger_name']!=''){
	$chargerQry = $cms->db_query("select ev_charger_types from #_customer_price where id='1'");
	$chargerRes = $chargerQry->fetch_array();
	
	$chagerTypeArray = json_decode($chargerRes["ev_charger_types"], true);
	foreach ($chagerTypeArray as $ckey => $cvalue) {
		if($_POST['charger_name']==$cvalue["name"]){
			$charger_discount = $cvalue['cdiscount'];
			break;
		}
	}
	echo $charger_discount;
}else{
	echo 0;
}
die;
?>
<?php include("../../lib/opin.inc.php");

//print_r($_POST);die;
if($_POST['charger_name']!=''){
	$chargerQry = $cms->db_query("select ev_charger_types from #_customer_price where id='1'");
	$chargerRes = $chargerQry->fetch_array();
	
	$chagerTypeArray = json_decode($chargerRes["ev_charger_types"], true);
	foreach ($chagerTypeArray as $ckey => $cvalue) {
		if($charger_name==$cvalue["name"]){
			break;
		}
	}
	if($cvalue['cdiscount']!=0){
		echo $cvalue['cdiscount'];
	}else{
		echo 0;
	}
}else{
	echo 0;
}
die;
?>
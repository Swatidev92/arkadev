<?php include("../../lib/opin.inc.php");

//print_r($_POST);die;
$panel_discount = '';
if($_POST){
	$panelQry = $cms->db_query("select panel_types from #_customer_price where id='1'");
	$panelRes = $panelQry->fetch_array();
	
	$panelTyeArray = json_decode($panelRes["panel_types"], true);
	foreach ($panelTyeArray as $key => $value) {		
		if($_POST['panel_name']==$value["name"]){
			$panel_discount = $value['sdiscount'];
			break;
		}
	}
	echo $panel_discount;
}else{
	echo 0;
}
die;
?>
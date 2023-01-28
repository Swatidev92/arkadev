<?php include("../../lib/opin.inc.php");

//print_r($_POST);die;
if($_POST){
	$panelQry = $cms->db_query("select panel_types from #_customer_price where id='1'");
	$panelRes = $panelQry->fetch_array();
	
	$panelTyeArray = json_decode($panelRes["panel_types"], true);
	foreach ($panelTyeArray as $key => $value) {
		
		if($panel_name==$value["name"]){
			break;
		}
	}
	if($value['sdiscount']!=0){
		echo $value['sdiscount'];
	}else{
		echo 0;
	}
}
die;
?>
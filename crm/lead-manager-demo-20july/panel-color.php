<?php include("../../lib/opin.inc.php");

//print_r($_POST);die;
$panel_color='';
if($_POST['panel_model']!=''){
	$panelQry = $cms->db_query("select panel_types from #_customer_price where id='1'");
	$panelRes = $panelQry->fetch_array();
	
	$panelTypesArr = json_decode($panelRes["panel_types"], true);
	foreach ($panelTypesArr as $pkey => $pvalue) {
		if($_POST['panel_model']==$pvalue["name"]){
			$panel_color = $pvalue['pcolor'];
			break;
		}
	}
	echo $panel_color;
}else{
	echo 0;
}
die;
?>
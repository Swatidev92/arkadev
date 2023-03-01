<?php include("../../lib/opin.inc.php");

//print_r($_POST);die;
$panel_color='';
if($_POST['panel_model']!=''){
	// $panelQry = $cms->db_query("select panel_types from #_customer_price_manager where id='1'");
	$panelQry = getNewPrice('panel_types','1');
    while($panelRes = $panelQry->fetch_array()){
	
	$panelTypesArr = json_decode($panelRes["content"], true);
	foreach ($panelTypesArr as $pkey => $pvalue) {
		if($_POST['panel_model']==$pvalue["name"] || $_POST['panel_model']==$panelRes["id"] ){
			$panel_color = $pvalue['pcolor'];
			break;
		}
	} 
	echo $panel_color; }
}else{
	echo 0;
}
die;
?>
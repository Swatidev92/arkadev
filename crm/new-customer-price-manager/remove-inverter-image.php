<?php include("../../lib/opin.inc.php");

//print_r($_POST);die;

$rsAdmin=$cms->db_query("select inverter_types from #_customer_price where id='1'");
$arrAdmin=$cms->db_fetch_array($rsAdmin);
@extract($arrAdmin);
$obj = json_decode($inverter_types);

//echo $obj[0]->charger_img;die;
foreach($obj as $key=>$val){
	if($key==$drop_id){
		$invt[$key]['inverter_img']= '';
		unlink(FILES_PATH."proposal/inverter/".$val->inverter_img);
	}else{
		$invt[$key]['inverter_img']= $val->inverter_img;
	}
	$invt[$key]['invwarranty']= $val->invwarranty;
	$invt[$key]['price']= $val->price;
	$invt[$key]['invbrand']= $val->invbrand;
	$invt[$key]['name']= $val->name;
}
//print_r($evc);die;

$_POSTS['inverter_types'] = json_encode($invt);
$cms->sqlquery("rs","customer_price",$_POSTS,'id',1);

echo 1;

?>

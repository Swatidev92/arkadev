<?php include("../../lib/opin.inc.php");

//print_r($_POST);die;

$rsAdmin=$cms->db_query("select panel_types from #_customer_price where id='1'");
$arrAdmin=$cms->db_fetch_array($rsAdmin);
@extract($arrAdmin);
$obj = json_decode($panel_types);

//echo $obj[0]->charger_img;die;
foreach($obj as $key=>$val){
	if($key==$drop_id){
		$pty[$key]['panel_img']= '';
		unlink(FILES_PATH."proposal/solar-panel/".$val->panel_img);
	}else{
		$pty[$key]['panel_img']= $val->panel_img;
	}
	$pty[$key]['swarranty']= $val->swarranty;
	$pty[$key]['effectWarranty']= $val->effectWarranty;
	$pty[$key]['warranty_percentage']= $val->warranty_percentage;
	$pty[$key]['price']= $val->price;
	$pty[$key]['wattage']= $val->wattage;
	$pty[$key]['brand']= $val->brand;
	$pty[$key]['name']= $val->name;
}
//print_r($evc);die;

$_POSTS['panel_types'] = json_encode($pty);
$cms->sqlquery("rs","customer_price",$_POSTS,'id',1);

echo 1;

?>

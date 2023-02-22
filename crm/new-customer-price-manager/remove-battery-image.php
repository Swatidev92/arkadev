<?php include("../../lib/opin.inc.php");

//print_r($_POST);die;

$rsAdmin=$cms->db_query("select battery_types from #_customer_price where id='1'");
$arrAdmin=$cms->db_fetch_array($rsAdmin);
@extract($arrAdmin);
$obj = json_decode($battery_types);

//echo $obj[0]->charger_img;die;
foreach($obj as $key=>$val){
	if($key==$drop_id){
		$btrcs[$key]['battery_img']= '';
		unlink(FILES_PATH."proposal/battery/".$val->battery_img);
	}else{
		$btrcs[$key]['battery_img']= $val->battery_img;
	}
	$btrcs[$key]['bdiscount']= $val->bdiscount;
	$btrcs[$key]['bwarranty']= $val->bwarranty;
	$btrcs[$key]['price']= $val->price;
	$btrcs[$key]['name']= $val->name;
}
//print_r($evc);die;

$_POSTS['battery_types'] = json_encode($btrcs);
$cms->sqlquery("rs","customer_price",$_POSTS,'id',1);

echo 1;

?>

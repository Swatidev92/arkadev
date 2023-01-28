<?php include("../../lib/opin.inc.php");

//print_r($_POST);die;

$rsAdmin=$cms->db_query("select * from #_customer_price where id='1'");
$arrAdmin=$cms->db_fetch_array($rsAdmin);
@extract($arrAdmin);
$obj = json_decode($ev_charger_types);

//echo $obj[0]->charger_img;die;
foreach($obj as $key=>$val){
	if($key==$drop_id){
		$evc[$key]['charger_img']= '';
		unlink(FILES_PATH."proposal/charger/".$val->charger_img);
	}else{
		$evc[$key]['charger_img']= $val->charger_img;
	}
	$evc[$key]['cdiscount']= $val->cdiscount;
	$evc[$key]['cwarranty']= $val->cwarranty;
	$evc[$key]['price']= $val->price;
	$evc[$key]['name']= $val->name;
}
//print_r($evc);die;

$_POSTS['ev_charger_types'] = json_encode($evc);
$cms->sqlquery("rs","customer_price",$_POSTS,'id',1);

echo 1;

//[{"name":"Easee","price":"5000","cwarranty":"2","cdiscount":"5000","charger_img":"51831-trina---tsm-395de09.08-vertex-s-resized.jpg"},{"name":"svea","price":"22222","cwarranty":"3","cdiscount":"2000","charger_img":"81534-charger-banner---copy.jpg"}]

?>

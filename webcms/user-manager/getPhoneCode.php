<?php 
include("../../lib/opin.inc.php");
//print_r($_POST);
$HTML = "";
if($_POST){
	$ids = $_POST["ids"];
	$phonecode = $cms->getSingleResult("SELECT phonecode FROM #_countries WHERE  id = $ids ");
	if($phonecode){
		echo '+'.$phonecode;	
	}
}
die();
?>
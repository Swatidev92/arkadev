<?php 
include("../../lib/opin.inc.php");
//print_r($_POST);die;

$data_Arr = array("report_no"=>$_POST['projId']);
//print_r($data_Arr);die;
$name  = generateReport($data_Arr);
echo $name;
die();
?>
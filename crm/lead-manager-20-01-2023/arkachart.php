<?php
include("../../lib/opin.inc.php");

//print_r($_REQUEST);
$url = $_REQUEST["name"]; 
$output = preg_replace("/%u([0-9a-f]{3,4})/i","&#x\\1;",urldecode($url)); 
$url = html_entity_decode($output,null,'UTF-8');
$st = '&quot;Lucida Grande: &quot;Lucida Grande: ';

//$url = htmlspecialchars_decode($url);
$url = str_replace('style="font-family:"Lucida Grande", "Lucida Sans Unicode", Arial, Helvetica, sans-serif;font-size:12px;"','',$url);
//echo $b = html_entity_decode($a);die;
//die;
ob_start();
echo '<?xml version="1.0" encoding="UTF-8" standalone="no"?>';
echo $url;
$content = ob_get_clean();


 
$chart_generated = $url;
$chart_img = 'chart'.time().'.svg';
$attached_img = SITE_FS_PATH.'/'.UPLOAD_FILES_PTH.'/'.UP_FILES_PROPOSAL.'/'.$chart_img;



if(file_put_contents($attached_img, $content)) { // Filename for storing purpose

$_SESSION['chart_name'] =  $chart_img;
echo "Success";
}
else {
echo "Failed to save file";
}

$lead_id = $_GET["pid"];
if($lead_id){ 
	
	$_POST['chart_image'] = $_SESSION['chart_name'];	
	$cms->sqlquery("rs","leads",$_POST, 'id', $lead_id);
	//$lead_insert_id = $lead_id;
}
die;

?>
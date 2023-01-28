<?php
//print_r($_REQUEST);
$url = $_REQUEST["svg"]; 
//$st = '&quot;Lucida Grande: &quot;Lucida Grande: ';

$url = htmlspecialchars_decode($url);
$url = str_replace('style="font-family:"Lucida Grande", "Lucida Sans Unicode", Arial, Helvetica, sans-serif;font-size:12px;"','',$url);
//echo $b = html_entity_decode($a);die;
//die;
ob_start();
echo '<?xml version="1.0" encoding="UTF-8" standalone="no"?>';
echo $url;
$content = ob_get_clean();

  
$chart_generated = $url;
$chart_img = 'chart'.time().'.svg';
$attached_img = SITE_FS_PATH.'/uploaded_files/proposal/'.$chart_img;
file_put_contents($attached_img,$content, file_get_contents($chart_generated));

$_SESSION['chart_name'] =  $chart_img;

$lead_id = $_GET["pid"];
if($lead_id){ 
	
	$_POST['chart_image'] = $_SESSION['chart_name'];	
	$cms->sqlquery("rs","leads",$_POST, 'id', $lead_id);
	//$lead_insert_id = $lead_id;
}


/*
if(file_put_contents("chrt.svg", $content)) { // Filename for storing purpose
echo "Success";
}
else {
echo "Failed to save file";
}
*/

die;
?>
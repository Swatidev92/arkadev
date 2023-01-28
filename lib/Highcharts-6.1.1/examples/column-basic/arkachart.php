<?php
//print_r($_REQUEST);
$url = $_POST["svg"]; 
$st = '&quot;Lucida Grande: &quot;Lucida Grande: ';

$url = htmlspecialchars_decode($url);
$url = str_replace('style="font-family:"Lucida Grande", "Lucida Sans Unicode", Arial, Helvetica, sans-serif;font-size:12px;"','',$url);
//echo $b = html_entity_decode($a);die;
//die;
ob_start();
echo '<?xml version="1.0" encoding="UTF-8" standalone="no"?>';
echo $url;
$content = ob_get_clean();
if(file_put_contents("chrt.svg", $content)) { // Filename for storing purpose
echo "Success";
}
else {
echo "Failed to save file";
}
die;
?>
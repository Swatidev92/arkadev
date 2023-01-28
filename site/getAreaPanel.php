<?php
//print_r($_POST);die;
extract($_POST);

if($roof_area){
	$size = getSize($roof_area);
	$panels = numberOfPanels($roof_area);
	
	echo $size.'|'.$panels;
}
?>
<?php
	$file_name = '';
	if($proposal_type==1){
		$file_name = '(Solar-'.$panel_count.')'.date('h-s');
	}
	// solar and charger and battery
	if($proposal_type==3 || $proposal_type==8){
		$file_name = 'Solar-'.$panel_count.'-EVcharger-Battery'.date('h-s');
	}
	// solar and charger
	if($proposal_type==2 || $proposal_type==9){
		$file_name = 'Solar-'.$panel_count.'-EVcharger'.date('h-s');
	}
	// solar and battery
	if($proposal_type==4 || $proposal_type==10 || $proposal_type==11){
		$file_name = 'Solar-'.$panel_count.'-Battery'.date('h-s');
	}
	// battery and charger
	if($proposal_type==7){
		$file_name = 'Battery-EVcharger'.date('h-s');
	}
	// only charger
	if($proposal_type==5){
		$file_name = 'EVcharger'.date('h-s');
	}
	// only battery
	if($proposal_type==6){
		$file_name = 'Battery'.date('h-s');
	}
?>
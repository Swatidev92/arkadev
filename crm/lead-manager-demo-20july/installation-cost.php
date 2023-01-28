<?php include("../../lib/opin.inc.php");

//print_r($_POST);die;
if($_POST['panel_count']!='' && $_POST['proposal_type']!=''){
	if($_POST['proposal_type']==3 || $_POST['proposal_type']==4 || $_POST['proposal_type']==6 || $_POST['proposal_type']==7 || $_POST['proposal_type']==8 || $_POST['proposal_type']==10 || $_POST['proposal_type']==11 ){
		$has_battery = 'B';
	}else{
		$has_battery = '';
	}
	$installation_days = installation_days($_POST['panel_count'],$has_battery);
	/*if($_SESSION["ses_adm_role"]!=1){
		$days_html = '<input type="text" name="installation_days" class="form-control" value="'.$installation_days.'">';
	}else{
		$customerPriceQry = $cms->db_query("select installation_charges from #_customer_price where id='1'");
		$customerPriceRes = $customerPriceQry->fetch_array();
	
		$days_html = '<select class="form-control select2" id="installation_days" name="installation_days">
			<option value="">Select Installation Days</option>';
			$installationArray = json_decode($customerPriceRes["installation_charges"], true);
			foreach ($installationArray as $ikey => $invalue) {
				if($installation_days==$invalue["day"]){
					$inssel = 'selected';
				}else{
					$inssel = '';
				}
				$days_html .='<option value="'.$invalue["day"].'" '.$inssel.'>'.$invalue["day"].'</option>';
			}
		$days_html .='</select>';
	}*/
	$days_html = '<input type="text" name="installation_days" class="form-control" value="'.$installation_days.'">';
	echo $days_html;
}else if($_POST['panel_count']!='' && $_POST['proposal_type']==''){
	echo -1;
}else{
	echo 0;
}
die;
?>
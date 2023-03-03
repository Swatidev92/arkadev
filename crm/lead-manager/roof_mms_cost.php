<?php include("../../lib/opin.inc.php");

//print_r($_POST);die;
if($_POST['panel_count']!='' && $_POST['roof_typ']!='' && $_POST['panel_model']!=''){
	
	$arr = array(46,6,1,5,13);
	$roof_mms.='<div class="row" style="font-weight:500;"><div class="col-sm-4 col-md-4" align="center">Profile Name</div><div class="col-sm-2 col-md-2" align="center">Quantity</div><div class="col-sm-2 col-md-2" align="center">Price</div></div><hr>';
	foreach($arr as $key=>$id)
	{
		$customerPriceQry = $cms->db_query("select * from #_customer_price_manager where m_id='3' and sub_id='31' and is_deleted = '0' AND id =$id");
		$mmsVVArry = $customerPriceQry->fetch_array();
		@extract($mmsVVArry);
		$objMmsVv = json_decode($mmsVVArry['content'],true);
		//print_r($obj_evmrg);die;
		$rf_mms_cost='';
		if($objMmsVv[0]['code']=='701704670'){
			// GET PANEL WIDTH
			$panel_model = $_POST['panel_model'];
			$obj_evmrg = json_decode($cms->getSingleResult("SELECT content FROM #_customer_price_manager where id=".$panel_model));
			$no_of_prfl=round((2*$_POST['panel_count']*$obj_evmrg[0]->width/$objMmsVv[0]['length'])*0.1);
			$no_of_comp[$objMmsVv[0]['code']]['count']=$no_of_prfl;
			$no_of_comp[$objMmsVv[0]['code']]['price']=$no_of_comp[$objMmsVv[0]['code']]['count']*$objMmsVv[0]['price'];
		}
		elseif($objMmsVv[0]['code']=='724863'){
			$no_of_comp[$objMmsVv[0]['code']]['count']=$no_of_prfl*0.2;
			$no_of_comp[$objMmsVv[0]['code']]['price']=$no_of_comp[$objMmsVv[0]['code']]['count']*$objMmsVv[0]['price'];
		}
		elseif($objMmsVv[0]['code']=='721550ZW'){
			$no_of_comp[$objMmsVv[0]['code']]['count']=2*($_POST['panel_count']+1);
			$no_of_comp[$objMmsVv[0]['code']]['price']=$no_of_comp[$objMmsVv[0]['code']]['count']*$objMmsVv[0]['price'];
		}
		elseif($objMmsVv[0]['code']=='739052'){
			$no_of_comp[$objMmsVv[0]['code']]['count']=round($_POST['panel_count']/15);
			$no_of_comp[$objMmsVv[0]['code']]['price']=$no_of_comp[$objMmsVv[0]['code']]['count']*$objMmsVv[0]['price'];
		}
		elseif($objMmsVv[0]['code']=='747838'){
			$no_of_comp[$objMmsVv[0]['code']]['count']=round((2*$_POST['panel_count']*$obj_evmrg[0]->width/1.2)*0.1);
			$no_of_comp[$objMmsVv[0]['code']]['price']=$no_of_comp[$objMmsVv[0]['code']]['count']*$objMmsVv[0]['price'];
		}
		elseif($objMmsVv[0]['code']=='774380'){
			$no_of_comp[$objMmsVv[0]['code']]['count']=round((3*2*$_POST['panel_count']*$obj_evmrg[0]->width/1.2)*0.1);
			$no_of_comp[$objMmsVv[0]['code']]['price']=$no_of_comp[$objMmsVv[0]['code']]['count']*$objMmsVv[0]['price'];
		}
		
		$roof_mms.='<div class="row"><div class="col-sm-4 col-md-4" align="center">'.$objMmsVv[0]['name'].'</div><div class="col-sm-2 col-md-2" align="center">'.$no_of_comp[$objMmsVv[0]['code']]['count'].'</div><div class="col-sm-2 col-md-2" align="center">'.$no_of_comp[$objMmsVv[0]['code']]['price'].'</div></div><hr>';
		$tot_mms_cost+=$no_of_comp[$objMmsVv[0]['code']]['price'];
	}
		$roof_mms.='<div class="row"><div class="col-sm-4 col-md-4" align="center"></div><div class="col-sm-2 col-md-2" align="center">Total MMS Cost</div><div class="col-sm-2 col-md-2" align="center">'.$tot_mms_cost.'</div></div><hr>';
		
		echo $roof_mms;
	}
else{
	echo 0;
}
die;
?>
<?php include("../../lib/opin.inc.php");?>

<script src="<?=SITE_PATH?>Highcharts-6.1.1/code/highcharts.js"></script>
<script src="<?=SITE_PATH?>Highcharts-6.1.1/code/modules/exporting.js"></script>
<script src="<?=SITE_PATH?>Highcharts-6.1.1/code/modules/export-data.js"></script>
<script src="<?=SITE_PATH_ADM?>js/jquery-3.3.1.min.js"></script>
<!--<script src="<?=SITE_PATH?>lib/Highcharts-6.1.1/examples/column-basic/jquery-3.3.1.min.js"></script>-->
<?php 
	// echo "<pre>";
	// 	print_r( $_POST);
	// 	echo "</pre>";
	// 	echo "/".$leadid."/";
	// echo $_POST['other_id'];
	// die;
    
	$lead_id = $_POST['lead_id'];
	$parentId = $_POST['parent_id'];

    // S:Roof Details
	if(isset($_POST['save'])){
		// if()
		$otherDetails['lead_id']=$_POST['lead_id'];
		$otherDetails['parent_id']=$_POST['parent_id'];
		$otherDetails['surge_protc_ac']=$_POST['surge_protc_ac'];
		$otherDetails['surge_protc_dc']=$_POST['surge_protc_dc'];
		$otherDetails['cable_len_inv']=$_POST['cable_len_inv'];
		$otherDetails['cable_len_ev']=$_POST['cable_len_ev'];
		// print_r($otherDetails);die;
		
		if(empty($_POST['other_id']))
		{ 
			$cms->sqlquery("rs","other_details",$otherDetails); 
						
			//print_r($roofDetails);
			// die;
		} 
		else{
			   $cms->sqlquery("rs","other_details",$otherDetails,'id',$_POST['other_id']);
		}
		if(isset($_POST['new-gr-ppp'])){
			$cms->redir(SITE_PATH_ADM.CPAGE.'?mode=add-proposal-newgr-ppp&start=&t=other_details&leadid='.$pid.'&id='.$parentId, true);

		}
		else{
        $cms->redir(SITE_PATH_ADM.CPAGE.'?mode=add-proposal-newgr&start=&t=other_details&leadid='.$pid.'&id='.$parentId, true);
        // die;
	}

       // $cms->redir(SITE_PATH_ADM.CPAGE.'?mode=add-proposal-newgr&start=&t=other_details&leadid='.$pid.'&id='.$parentId, true);
        // die;
		
	}
?>
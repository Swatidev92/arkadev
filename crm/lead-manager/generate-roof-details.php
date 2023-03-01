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
	//    die;
    
	// $lead_id = $_POST['lead_id'];
	$parentId = $_POST['parent_id'];

    // S:Roof Details
	if(isset($_POST['save'])){
		$total_rec = $_POST['total_rec'];
		if($total_rec>0){
			$roofDetails =array();
			$roof_details_count= $total_rec;
			if($_POST['edit']){ $roof_details_count = $roof_details_count-1;  }
			//echo $roof_details_count;die;
			// {
				for($i=0;$i<=$roof_details_count;$i++){
					
					$roofDetails['total_panel'] = $_POST['total_panel'][$i];
					$roofDetails['roofing_material'] = $_POST['roofing_material'][$i];
					$roofDetails['roof_support'] = $_POST['roof_support'][$i];
					$roofDetails['roof_angle'] = $_POST['roof_angle'][$i];
					$roofDetails['roof_breath'] =$_POST['roof_breath'][$i];
					$roofDetails['roof_length'] =$_POST['roof_length'][$i];
					$roofDetails['roof_height'] = $_POST['roof_height'][$i];
					$roofDetails['lead_id'] = $pid;
					$roofDetails['form_type'] = 'proposal';
					$roofDetails['proposal_id'] = $parentId;
					$roofDetails['status'] = 0;
					if(empty($_POST['rec_id'][$i]))
					{ 
						$cms->sqlquery("rs","roof_details",$roofDetails); 
						
						//print_r($roofDetails);
						// die;
					} 
					else{
					   $cms->sqlquery("rs","roof_details",$roofDetails,'id',$_POST['rec_id'][$i]);
					}
					
					// echo $i;die;
				// }
				
				$roofDetails = array();
				// echo "<script type='text/javascript'> alert(".json_encode($roofDetails).") </script>";
			}
	}
    else{
        if(count($_POST['total_panel'])!=0 || count($_POST['roofing_material'])!=0 || count($_POST['roof_support'])!=0 ||  count($_POST['roof_angle'])!=0 )
        {
            $roofDetails['total_panel'] = $_POST['total_panel'];
            $roofDetails['roofing_material'] = $_POST['roofing_material'];
            $roofDetails['roof_support'] = $_POST['roof_support'];
            $roofDetails['roof_angle'] = $_POST['roof_angle'];
			$roofDetails['roof_breath'] =$_POST['roof_breath'];
			$roofDetails['roof_length'] =$_POST['roof_length'];
			$roofDetails['roof_height'] = $_POST['roof_height'];$roofDetails['lead_id'] = $pid;
            $roofDetails['form_type'] = 'lead';
            $roofDetails['status'] = 0;
            if(empty($_POST['rec_id'][$i]))
            { 
                $cms->sqlquery("rs","roof_details",$roofDetails); 
                
                //print_r($roofDetails);
                // die;
            } 
            // else{
            //    $cms->sqlquery("rs","roof_details",$roofDetails,'id',$_POST['rec_id'][$i]);
            // }
        }
    }
	// die;
		if(isset($_POST['new-gr-ppp'])){
			$cms->redir(SITE_PATH_ADM.CPAGE.'?mode=add-proposal-newgr-ppp&start=&t=roof_details&leadid='.$pid.'&id='.$parentId, true);

		}
		else{
        $cms->redir(SITE_PATH_ADM.CPAGE.'?mode=add-proposal-newgr&start=&t=roof_details&leadid='.$pid.'&id='.$parentId, true);
        // die;
	}
		
	}
?>
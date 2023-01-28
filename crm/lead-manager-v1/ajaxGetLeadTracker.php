<?php 
include("../../lib/opin.inc.php");
$HTML='';
//echo "<pre>";
//print_r($cms);
if($_POST){
	$leadTrackQr = $cms->db_query("SELECT id, action_by, action, action_message, action_date FROM #_lead_tracker WHERE lead_id='".$_POST["id"]."'");
	if($leadTrackQr->num_rows>0){
	
		$num=1;$status='';
		while($leadTrackRes = $leadTrackQr->fetch_array()){ 
			$actionby = $cms->getSingleResult("SELECT CONCAT(fname, ' ', lname) as fullname, email FROM #_administrator WHERE id='".$leadTrackRes["action_by"]."'");
			$HTML .='<tr>
						<td>'.$num.'</td>
						<td>'.$actionby.'</td>
						<td>'.$leadsStatusArr[trim($leadTrackRes["action"])].'</td>
						<td>'.$leadTrackRes["action_message"].'</td>
						<td>'.$leadTrackRes["action_date"].'</td>
					</tr>';
		$num++;
		}
	}else{
		
		$HTML .= $adm->rowerror(5);
	}
}
echo $HTML; die;
?>
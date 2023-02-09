<?php defined('_JEXEC') or die('Restricted access'); ?>
 <?php 
//$pid = $_GET['id']; 


if($cms->is_post_back()){
	$action_message ='';
	if(isset($_FILES['file_upload'])){
		// echo "<script>alert('Success.');</script>";
		$csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
		if(!empty($_FILES['file_upload']['name']) && in_array($_FILES['file_upload']['type'], $csvMimes))
		{
			$csvFile = fopen($_FILES['file_upload']['tmp_name'], 'r');
            
			$duplicate_id = array();
				fgetcsv($csvFile);
				while(($column = fgetcsv($csvFile)) !== FALSE){
					$email = $column[13];
					
					$q_data  = $cms->db_query("select id from #_leads where is_deleted='0' AND  email = '".$email."'");
					if($q_data->num_rows  == 0 && $email !='')
					{
            		
						//echo "<pre>";
						if($column[11]=='fb'){ $lead_data['form_type'] =  "5"; }else { $lead_data['form_type'] = "5"; }
						$lead_data['customer_name'] = $column[12];
						$lead_data['email'] = $email;
						$lead_data['phone'] = $column[14];
						$lead_data['address_input'] = $column[15];
						$lead_data['proposal_address'] = $column[15];
						$lead_data['city'] = $column[16];
						$lead_data['post_by'] = $_SESSION['ses_adm_id'];
						$lead_data['post_date'] = date("Y-m-d");
						$lead_data['update_date'] = date("Y-m-d H:i:s");
						$lead_data['status'] = "1";
						// print_r($lead_data);
						// echo "</pre>";
						$insert_id = $cms->sqlquery("rs","leads",$lead_data);
						$POSTARR["lead_unique_id"] = generateLeadId($insert_id);
						$uniqueLeadId = $POSTARR["lead_unique_id"];
						$cms->sqlquery("rs","leads",$POSTARR, 'id', $insert_id);	
												

						if(empty($action_message) && $pid==''){
							$action_message ="New Lead added by ".$cms->getSingleResult("SELECT customer_name FROM #_users WHERE id='".$_SESSION["ses_adm_id"]."'").".";
							$_POSTS["lead_id"] = $insert_id;
							$_POSTS["action_message"] = $action_message;
							$_POSTS["action_date"] = date('Y-m-d h:i:s');
							$_POSTS["action_by"] = $_SESSION["ses_adm_id"];
							$_POSTS["activity_for"] = $_SESSION["ses_adm_id"];		
							$_POSTS["new_status"] = 1;
							$_POSTS["lead_status"] = 0;
							$cms->sqlquery("rs","lead_tracker",$_POSTS);
						}
						
						
					}
					else{
						$q_id = $q_data->fetch_array();
						// $dupli_id =array();
						array_push($duplicate_id,$q_id);
					}
					
					
				}
				
				$dupli_id = sizeof($duplicate_id);
			
				if(!empty($insert_id))
				{
					
					// header('Location: '.SITE_PATH_ADM);
					// $page = $_SERVER['PHP_SELF'];
					// echo '<meta http-equiv="Refresh" content="0;' . $page . '">';
					// $cms->redir(SITE_PATH_ADM.CPAGE.'?mode=upload-lead', true);
					$adm->sessset('Record has been Imported', 's');
			}
			else
			{
				
				$adm->sessset('Record has been not Imported', 'e');
			}
			
            fclose($csvFile);
			}
			
	
	}
	// print_r($_POST);die;
if(isset($_POST['lead-update'])){
	//$uniqueLeadId = $cms->getSingleResult("SELECT `status` FROM #_leads WHERE id=".$_POST['id']." ");
	//print_r($uniqueLeadId);
	 //print_r($_POST);
	 //die;
	extract($_POST);
	if($arr_ids){
		$str_adm_ids = implode(",",$arr_ids);
		// echo $oldStatus= $_POST['status-id'];
		// die;
		$update_date=date("Y-m-d H:i:s");  
		$sel= $cms->db_query("update #_leads set post_by='".$_SESSION['ses_adm_id']."', update_date='".$update_date."' ,post_date='".date("Y-m-d")."' where id in ($str_adm_ids)");
		if(!empty($sel)){
			$str_adm_idsArr = explode(',',$str_adm_ids);
			// print_r($str_adm_idsArr);die;
			foreach($str_adm_idsArr as $lid){
					// $status = $cms->getSingleResult("SELECT `status` FROM #_leads WHERE id=".$lid." ");
					// print_r($status);
					$leadsStatusArr = getAllStatus();
					foreach($leadsStatusArr as $status_key=>$status_val){ 
						if($status_key == $status){
							
							$status_data= $status_val;
						};
						
						$action_message = "Status Changed from <b>".$status_data."</b> to <b>New</b>";
					$ActionPOSTS["lead_id"] = $lid;
					$ActionPOSTS["action_message"] = $action_message;
					$ActionPOSTS["action_date"] = date('Y-m-d h:i:s');
					$ActionPOSTS["action_by"] = $_SESSION["ses_adm_id"];
					$ActionPOSTS["activity_for"] = $_SESSION["ses_adm_id"];				
					$ActionPOSTS["new_status"] = 1;
					$ActionPOSTS["lead_status"] = 1;
					}
					// print_r($ActionPOSTS);
					$cms->sqlquery("rs","lead_tracker",$ActionPOSTS);				
					
				}
				// die;
				$adm->sessset('Record has been Updated', 's');
		}
		else{
			$adm->sessset('Record has been not Updated', 'e');
		}
		// print_r($sel);die;

	}
	// print_r($_POST);die;
}
}
// echo "<pre>";
// print_r($duplicate_id);
// echo "</pre>";
// echo $dupli_id;


 
?>
<?php if($dupli_id == 0){ ?>

<!-- .row -->
<div class="row">
    <div class="col-sm-12">
        <div class="white-box panel-body">
			<div class="file_wrapper">
				<div class="form-group col-sm-12">
					<label for="file_upload" class="control-label">Upload File*</label>
					<input type="file" id="file_upload" name="file_upload" required>
					<br>
					<p class="list-group-item list-group-item-danger">
					<span><b>Don't forget to follow following steps:</b></span><br>
						1:&nbsp;&nbsp;File should be uploaded in CSV UTF8 format only.<br>
						2:&nbsp;&nbsp;Don't forget to add City in the table after the street address and in cloumn Q.<br>
						3:&nbsp;&nbsp;Don't forget to check sample file.
					<br>
					<a href="<?=SITE_PATH.UPLOAD_FILES_PTH.'/format/sample.csv'?>" style="font-size:12px;"><i class="fa fa-download" aria-hidden="true"></i>&nbsp;<b>Sample CSV file.</b></a>
					</p>
				</div>	
				
				<div class="clearfix"></div>
			</div>		
			<div class="form-group col-sm-3">
                <button type="submit" class="btn btn-primary" id="submit_btn">Submit</button>
                <button type="button" onClick="history.go(-1)" class="btn btn-primary">Back</button>
            </div>
		</div>
	</div>
</div>
<?php } if($dupli_id != 0){ ?>
<div class="row">
	<div class="col-md-12">
		<div class="white-box panel-body">	
			<button class="btn btn-success pull-right" type="submit" id="lead-update" name="lead-update" value="1">Update</button>
			<br><br>
			<table class="table">
				<tr><th colspan="6" class="text-center">Duplicate Data</th></tr>
				<tr>
					<th>
						<div class="checkbox checkbox-success">
							<?=$adm->check_all()?>
							<label for="checkbox3"> All</label>
						</div>
					</th>
					<!-- <th>S.No</th> -->
					<th>ID</th>
					<th>Customer Name</th>
					<th>Email</th>
					<!-- <th>Post Date</th> -->
					<th>Last Status</th>
				</tr>
				<?php 
					$i=0; 
					while($i < $dupli_id ){ 
						$j=$i+1;
						$id = $duplicate_id[$i]['id'];
						$val_id = $cms->db_query("select customer_name,email,post_date,status from #_leads where is_deleted='0' AND  id = '".$id."'");
						$dupli_data = $val_id->fetch_array();
				?>
					
					<tr>
						<td class="table-center">
							<div class="checkbox checkbox-success">
								<?=$adm->check_input($id)?>
								<label for="checkbox3"> <?=$j?></label>
							</div>
						</td>
						<td><?=$id?></td>
						<td><?=$dupli_data['customer_name']?></td>
						<td><?=$dupli_data['email']?></td>
						<!-- <td><?//=$dupli_data['post_date']?></td> -->
						<td>
							<?//=$dupli_data['status']?>
							<input type="hidden" name="id" value=<?=$id?>>
							<?php $leadsStatusArr = getAllStatus();
								foreach($leadsStatusArr as $status_key=>$status_val){
									// print_r($leadsStatusArr);die;
									if($status_key == $dupli_data['status']){
										echo $status_val;
										
									};
									
								}
								
								?>
							<input type="hidden" name="status-id" value=<?=$dupli_data['status']?>>	
								
						</td>
					</tr>
				<?php $i++; } ?>
			</table>
			<button class="btn btn-success pull-right" type="submit" id="lead-update" name="lead-update" value="1">Update</button>

		</div>
	</div>
</div>
<?php } ?>

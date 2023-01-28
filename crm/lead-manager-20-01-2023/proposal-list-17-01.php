<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 
//error_reporting(3);
//print_r($_GET);die;
$pid = $_GET['id']; 

//create copy of proposal is already created 
$proposalDeleted = $cms->db_query("SELECT * FROM #_leads where lead_id=$pid AND parent_id=$pid AND proposal_pdf!='' AND is_deleted=1 ");
if($proposalDeleted->num_rows==0){
$proposalQry = $cms->db_query("SELECT * FROM #_leads where lead_id=$pid AND parent_id=$pid AND proposal_pdf!='' AND is_deleted=0 ");
if($proposalQry->num_rows==0){	
	$leadProposalQry = $cms->db_query("SELECT * FROM #_leads where id=$pid AND proposal_pdf!='' ");
	$row = $leadProposalQry->fetch_assoc();
	foreach ($row as $field => $value) {
		if($field!='id'){
			$PropArr[$field] = $value;
		}
		if($field=='lead_id'){
			$PropArr[$field] = $pid;
		}
		if($field=='parent_id'){
			$PropArr[$field] = $pid;
		}
	}
	$cms->sqlquery("rs","leads",$PropArr);
}
}
//print_r($PropArr);
//die;

//$_SESSION['REFERER_page']='';
	if(isset($_GET["lead_status"])){
		$lead_status= "AND status='".$_GET["lead_status"]."'";
	}else {
		$lead_status= "";
	}
	
	if($action=='del'){
		$return = $cms->db_query("update #_leads set is_deleted=1 where id in ($propId)");
		$cms->redir(SITE_PATH_ADM.CPAGE.'?mode=proposal-list&start=&id='.$pid, true);
		exit;	 
	}
	
	if(isset($_POST['upload_files'])){
		//upload files
		if(isset($_FILES['file_upload']) and count(array_filter($_FILES['file_upload']['tmp_name']))>0){
			if(count($_FILES["file_upload"]["name"])>0){				
				$pcount = count($_FILES["file_upload"]["name"]);
				for($i=0; $i<$pcount; $i++){
					$uploadFilesArr['file_title'] = $_POST['file_title'][$i];									
					$uploadFilesArr['file_type'] = $_POST['file_type'][$i];									
					if(!empty($_FILES["file_upload"]["name"][$i])){
						$path = $_FILES["file_upload"]["name"][$i];
						$end = pathinfo($path, PATHINFO_EXTENSION);
						$filename = $_FILES['file_upload']['name'][$i]; 
						$file_loc = $_FILES['file_upload']['tmp_name'][$i];
						$file_size = $_FILES['file_upload']['size'][$i];
						$file_type1 = $_FILES['file_upload']['type'][$i];
						$folder = FILES_PATH.UP_FILES_UPLOADS."/";
						// make file name in lower case
						$new_file_name = strtolower($filename);
						$final_file= str_replace(" ","-",$new_file_name);
						if($file_size>0 && $file_size>5000000){
							echo "<script>alert('File size should be less than 5MB')</script>";
						}else{
							move_uploaded_file($file_loc,$folder.$final_file);
							$uploadFilesArr['display_order']=$i+1;
							$uploadFilesArr['file_upload']=$final_file;
							$uploadFilesArr['lead_id']=$pid;						
							//echo $_POST['f_type'][$i];die;	
							//print_r($uploadFilesArr);die;
							$cms->sqlquery("rs","uploads",$uploadFilesArr);
						}
					}			
				}
			}	
		}
		$cms->redir(SITE_PATH_ADM.CPAGE."?mode=proposal-list&start=&id=".$pid.'#uplaod', true);
		exit;
	}
	
	if(isset($_POST['save_doc'])){
		//upload files
		if(isset($_FILES['doc_upload']) and count(array_filter($_FILES['doc_upload']['tmp_name']))>0){
			if(count($_FILES["doc_upload"]["name"])>0){				
				$pcount = count($_FILES["doc_upload"]["name"]);
				for($i=0; $i<$pcount; $i++){
					$uploadArr['file_title'] = $_POST['doc_title'][$i];										
					$uploadArr['file_type'] = 1;										
					if(!empty($_FILES["doc_upload"]["name"][$i])){
						$path = $_FILES["doc_upload"]["name"][$i];
						$end = pathinfo($path, PATHINFO_EXTENSION);
						$filename = $_FILES['doc_upload']['name'][$i]; 
						$file_loc = $_FILES['doc_upload']['tmp_name'][$i];
						$file_size = $_FILES['doc_upload']['size'][$i];
						$file_type = $_FILES['doc_upload']['type'][$i];
						$folder = FILES_PATH.UP_FILES_UPLOADS."/";
						// make file name in lower case
						$new_file_name = strtolower($filename);
						$final_file= str_replace(" ","-",$new_file_name);
						if($file_size>0 && $file_size>5000000){
							echo "<script>alert('File size should be less than 5MB')</script>";
						}else{
							move_uploaded_file($file_loc,$folder.$final_file);
							$uploadArr['display_order']=$i+1;
							$uploadArr['file_upload']=$final_file;
							//$uploadArr['proposal_id']=$lead_insert_id;
							$uploadArr['lead_id']=$pid;
							//print_r($uploadArr);die;
							$cms->sqlquery("rs","uploads",$uploadArr);
						}
					}			
				}
			}	
		}
		$cms->redir(SITE_PATH_ADM.CPAGE."?mode=proposal-list&start=&id=".$pid.'#uplaod', true);
		exit;
	}
		
	if(isset($_POST['save_picture'])){
		//upload files
		if(isset($_FILES['pic_upload']) and count(array_filter($_FILES['pic_upload']['tmp_name']))>0){
			if(count($_FILES["pic_upload"]["name"])>0){				
				$pcount = count($_FILES["pic_upload"]["name"]);
				for($i=0; $i<$pcount; $i++){
					if($_POST['pic_id'][$i] && !empty($_FILES["pic_upload"]["name"][$i])){
						if(!empty($_FILES["pic_upload"]["name"][$i])){
							$path = $_FILES["pic_upload"]["name"][$i];
							$end = pathinfo($path, PATHINFO_EXTENSION);
							$filename = $_FILES['pic_upload']['name'][$i]; 
							$file_loc = $_FILES['pic_upload']['tmp_name'][$i];
							$file_size = $_FILES['pic_upload']['size'][$i];
							$file_type = $_FILES['pic_upload']['type'][$i];
							$folder = FILES_PATH.UP_FILES_UPLOADS."/";
							// make file name in lower case
							$new_file_name = strtolower($filename);
							$final_file= str_replace(" ","-",$new_file_name);
							if($file_size>0 && $file_size>5000000){
								echo "<script>alert('File size should be less than 5MB')</script>";
							}else{
								move_uploaded_file($file_loc,$folder.$final_file);
								$updateArr['display_order']=$i+1;
								$updateArr['file_upload']=$final_file;
								//$uploadArr['proposal_id']=$lead_insert_id;
								$updateArr['lead_id']=$pid;
								//print_r($updateArr);die;
								$cms->sqlquery("rs","uploads",$updateArr, 'id', $_POST['pic_id'][$i]);
							}
						}
					}else{
						$uploadArr['file_title'] = $_POST['pic_title'][$i];										
						$uploadArr['file_type'] = 2;
						if(!empty($_FILES["pic_upload"]["name"][$i])){
							$path = $_FILES["pic_upload"]["name"][$i];
							$end = pathinfo($path, PATHINFO_EXTENSION);
							$filename = $_FILES['pic_upload']['name'][$i]; 
							$file_loc = $_FILES['pic_upload']['tmp_name'][$i];
							$file_size = $_FILES['pic_upload']['size'][$i];
							$file_type = $_FILES['pic_upload']['type'][$i];
							$folder = FILES_PATH.UP_FILES_UPLOADS."/";
							// make file name in lower case
							$new_file_name = strtolower($filename);
							$final_file= str_replace(" ","-",$new_file_name);
							if($file_size>0 && $file_size>5000000){
								echo "<script>alert('File size should be less than 5MB')</script>";
							}else{
								move_uploaded_file($file_loc,$folder.$final_file);
								$uploadArr['display_order']=$i+1;
								$uploadArr['file_upload']=$final_file;
								//$uploadArr['proposal_id']=$lead_insert_id;
								$uploadArr['lead_id']=$pid;
								//print_r($uploadArr);die;
								if($_POST['pic_id'][$i]){
									//$cms->sqlquery("rs","uploads",$uploadArr, 'id', $_POST['pic_id'][$i]);
								}else{
									//$cms->sqlquery("rs","uploads",$uploadArr);
								}
							}
							$cms->sqlquery("rs","uploads",$uploadArr);
						}
					}						
				};
			}	
		}
		$cms->redir(SITE_PATH_ADM.CPAGE."?mode=proposal-list&start=&id=".$pid.'#uplaod', true);
		exit;
	}
		
	if($cms->is_post_back()){
		@extract($_POST);
		
		if($arr_ids) {
			$str_adm_ids = implode(",",$arr_ids);
			//print_r($_POST);die;
			switch ($_POST['action']){
				case "delete":
					$return = $cms->db_query("update #_leads set is_deleted=1 where id in ($str_adm_ids)");  
					if($return===-1){ //-1 used Foreign Key Message
						$adm->sessset(count($arr_ids)." ".foreignKeyErrorMsg, 'e');
					}else{
						$adm->sessset(count($arr_ids).' Item(s) Delete', 'e');
					}
					
					break;
				 
				case "Assigned":
					if($assigned_to>0){
						$cms->db_query("update #_leads set  assigned_to='".$assigned_to."', assigned_date='".date('Y-m-d')."', update_date='".date("Y-m-d H:i:s")."' where id in ($str_adm_ids)");
						$assignedTo =  $cms->getSingleResult("SELECT   customer_name FROM #_lms_users WHERE id='".$assigned_to."'");
						$action_message=" Assigned to ".$assignedTo." By ".$cms->getSingleResult("SELECT customer_name FROM #_lms_users WHERE id='".$_SESSION["ses_adm_id"]."'");
						for($k=0;$k<sizeOf($arr_ids);$k++){
							$_POSTS["action_by"] = $_SESSION["ses_adm_id"];
							$_POSTS["action_message"] = $action_message;
							$_POSTS["action_date"] = date('Y-m-d h:i:s');
							$_POSTS["lead_id"] = $arr_ids[$k];
							$cms->sqlquery("rs","lead_tracker",$_POSTS);
						}
						$adm->sessset(count($arr_ids).' Item(s) Assigned', 's');
					}else{
						$adm->sessset('Some Error please try again', 'e');
					}
					
					break;
				default:
			}
		}
		//$cms->redir(SITE_PATH_ADM.CPAGE, true);
		//exit;
	} 
	 
	//sorting of data
	$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	$urls1 = $urls = explode("&", $url);
	$sortCondition = "";
	if(empty($_GET["sorting"])){
		$sortVar ="desc";
	}

	if(!empty($_GET["sortby"])){
		if($_GET["sorting"] =="asc"){
			$sortCondition .= "ORDER BY ".$_GET["sortby"]." asc ";
			$sortVar ="desc";
			$order_by = $_GET["sortby"];
			$order_by2 = "asc";	
		}else if($_GET["sorting"] =="desc"){
			$sortCondition .= "ORDER BY ".$_GET["sortby"]." desc ";
			$sortVar ="asc";
			$order_by = $_GET["sortby"];
			$order_by2 = "desc";		
		} 
	}  

	for($i=0;$i<count($urls1);$i++){
		if(!empty($_GET["sortby"])){
			$sortString ="sortby=".$_GET["sortby"];
			if($urls[$i]==$sortString){
				unset($urls[$i]);
			}
		}
		if(!empty($_GET["sorting"])){
			$sortStr ="sorting=".$_GET["sorting"];
			if($urls[$i]==$sortStr){
				unset($urls[$i]);
			}
		}
		if(!empty($_GET["sortbyArray"])){
			$sortStr1 ="sortbyArray=".$_GET["sortbyArray"];
			if($urls[$i]==$sortStr1){
				unset($urls[$i]);
			}
		}
	}
	
	$url = implode('&', $urls);
	
	if($_GET["method"]==''){
		$url= $url."?method=GET" ;
	}
	
	if($_SESSION["ses_adm_id"]!=1){
		if(in_array(11,$act_arr)){
			$adminRole = "";
		}
		else{
			$adminRole = " AND assigned_to='".$_SESSION["ses_adm_id"]."'";
		}
	}else{
		$adminRole ="";
	}	 

	//echo "test";
	$start = intval($_GET['start']);
	$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
	$columns = "SELECT l.*, l.id as propid ";
	$sql = " FROM #_leads l WHERE 1=1 AND l.is_deleted=0 AND l.lead_id=$pid $lead_status ";
	$order_by == '' ? $order_by = 'l.post_date' : true;
	$order_by2 == '' ? $order_by2 = 'DESC' : true;
	$sql_count = "SELECT count(*) ".$sql; 
	$sql .= " order by $order_by $order_by2 ";
	//$sql .= " limit $start, $pagesize ";
	$sql = $columns.$sql;
	$result = $cms->db_query($sql);
	$numRows = $result->num_rows; 
	$reccnt = $cms->db_scalar($sql_count);
		 
	//echo $sql_count;
	//echo $sql; //die;

	// mk-19
	// $line = $result->fetch_array();
	// print_r($line['proposal_type']);die;
	$roofFetchDetailsQry = $cms->db_query("SELECT * FROM #_roof_details where lead_id='".$pid."' AND status=0 AND is_deleted=0 ");
	$arrysRoof =$roofFetchDetailsQry->fetch_array();
	if($arrysRoof['proposal_id'] == null || $arrysRoof['proposal_id'] == ''){ $propId = "yes"; }else{ $propId = "no"; }
	//echo $propId;
//	die;
	//print_r($arrysRoof);die;
	// echo $arrysRoof['proposal_id'];die;
	$prapsl_with_no_roof = 0;
	if(mysqli_num_rows($roofFetchDetailsQry)>0){$prapsl_with_no_roof = 1;}else{$prapsl_with_no_roof = 0;}
	if(mysqli_num_rows($roofFetchDetailsQry)>0){
	while($arrRoof =$roofFetchDetailsQry->fetch_array()){
		if($arrRoof['total_panel'] == null || $arrRoof['total_panel'] == '' || $arrRoof['total_panel'] == 0 ){ $a=1; break;  }
		if($arrRoof['roofing_material'] == null || $arrRoof['roofing_material'] == ''){ $b=1; break; }
		if($arrRoof['roof_support'] == null || $arrRoof['roof_support'] == ''){ $c=1; break; }
		if($arrRoof['roof_angle'] == null ||  $arrRoof['roof_angle'] == '' || $arrRoof['roof_angle'] == 0){ $d=1; break; }
	}}else{
		$a = 1;
	}
	// $roofFetchDetailsQry1 = mysqli_num_rows($roofFetchDetailsQry);
	// // echo $roofFetchDetailsQry1;die;
	// $z = $roofFetchDetailsQry1;
		
?>
<!-- .row -->

<div class="row">
	<div class="col-sm-12">
		<div class="white-box">
			<div class="form-group">
				<?php if(in_array(4,$act_arr) || $_SESSION["ses_adm_id"]==1){ ?>
					<a href="<?=SITE_PATH_ADM.CPAGE.'/?mode=add-proposal&start='.$_GET['start'].'&t=prop_details&leadid='.$pid?>" class="ub">
						<img  src="<?=SITE_PATH_ADM?>images/add_1.svg" width="25" alt=""> Generate Proposal</a>
						&nbsp;&nbsp;
				<!--<a href="<?=SITE_PATH_ADM.CPAGE.'/?mode=add-proposal-newgr&start='.$_GET['start'].'&t=prop_details&leadid='.$pid?>" class="ub">
				<img  src="<?=SITE_PATH_ADM?>images/add_1.svg" width="25" alt=""> Generate Proposal NEW GR</a>-->
						
						<?php } ?>
				<a href="#uplaod" class="ub"><i class="fa fa-upload" aria-hidden="true"></i> Upload Files</a>
			</div>
			<div class="clearfix"></div>
			
			<div class="table-responsive">
				<table class="table table-striped1 table-hover1 table-bordered1">
					<thead>
						<tr>
							<!--<th>
								<div class="checkbox checkbox-success">
									<?=$adm->check_all()?>
									<label for="checkbox3"></label>
								</div>
							</th>-->
							<th class="text-nowrap">Action</th>
							<th class="text-nowrap">Contract Signed</th>
							<th>Date <a href="<?=$url?>&sortby=post_date&sorting=<?=$sortVar?>"><i class="fa fa-sort"></i></a></th>						
							<th>Proposal name</th>
							<th>Total Price</th>
							<th>Customer Price</th>
							<th>Total Green Rebate</th>
							<th>Solar Green Rebate</th>
							<th>Charger Green Rebate</th>
							<th>Battery Green Rebate</th>
							<th>Total Margin (kr)</th>
							<th>Total Margin (%)</th>
							<th>Payback Year</th>
							<th>Generated By</th>
							<!--<th>Last Updated By</th>-->
						</tr>
					</thead>
					<tbody>
						<?php if($reccnt){ 
						$nums=$start+1; 
						while ($line = $result->fetch_array()){ 
						@extract($line);
						$total_margin=0;
						if($proposal_type!=5 && $proposal_type!=6 && $proposal_type!=7){
							$total_margin = $total_margin + $solar_margin_kr;
						}
						if($charger_margin_kr){
							$total_margin = $total_margin + $charger_margin_kr;
						}
						if($battery_name){
							$total_margin = $total_margin + $battery_margin_kr;
						}
						$perc_margin = round($total_margin*100/$proposal_total_cost);
						
						if($status==4){
							$row_bg = "background:lightgreen;";
						}else{
							$row_bg = "";
						}
						$leadsStatusArr = getAllStatus();
						?>  
						<tr class="clickable-row" style="<?=$row_bg?>">
							<!--<td class="table-center">
								<div class="checkbox checkbox-success">
									<?=$adm->check_input($id)?>
									<label for="checkbox3"></label>
								</div>
							</td>-->
							<td class="text-nowrap">
								<?php if(in_array(4,$act_arr) || $_SESSION["ses_adm_id"]==1){ ?>
								<a href="<?=SITE_PATH_ADM.CPAGE?>?mode=add-proposal&start=<?=$_GET['start']?>&t=prop_details&leadid=<?=$pid?>&id=<?=$id?>" data-toggle="tooltip" title="Edit Proposal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;&nbsp;
								<!--<a href="<?=SITE_PATH_ADM.CPAGE?>?mode=add-proposal-newgr&start=<?=$_GET['start']?>&t=prop_details&leadid=<?=$pid?>&id=<?=$id?>" data-toggle="tooltip" title="Edit Proposal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>NEW GR</a>&nbsp;&nbsp;-->
								<?php if($proposal_pdf){ ?>
								 
								<a href="<?=SITE_PATH.UPLOAD_FILES_PTH.'/'.UP_FILES_PROPOSAL.'/'.$proposal_pdf?>" download title="Proposal 1"><i class="fa fa-file-pdf-o" aria-hidden="true">1</i></a>
								
								<?php if($number_of_proposal==2 && $proposal_pdf2!=''){ ?>
								&nbsp;
								<a href="<?=SITE_PATH.UPLOAD_FILES_PTH.'/'.UP_FILES_PROPOSAL.'/'.$proposal_pdf2?>" download title="Proposal 2"><i class="fa fa-file-pdf-o" aria-hidden="true">2</i></a>								 
								<?php } ?>
								
								<?php if($proposal_image_pdf!=''){ ?>
								&nbsp;
								<a href="<?=SITE_PATH.UPLOAD_FILES_PTH.'/'.UP_FILES_PROPOSAL.'/'.$proposal_image_pdf?>" download title="Proposal Image"><i class="fa fa-image"></i></a>
								<?php } ?>
								&nbsp;
								<?php } ?>
								
								<?php if($proposal_txt){ ?>
								<a href="<?=SITE_PATH.UPLOAD_FILES_PTH.'/'.UP_FILES_PROPOSAL.'/'.$proposal_txt?>" title="Download TXT" download><i class="fa fa-file"></i></a>&nbsp;&nbsp;
								<?php } ?>
								<?php if($status!=4){?>								
								<a href="<?=SITE_PATH_ADM.CPAGE?>?mode=proposal-list&id=<?=$pid?>&propId=<?=$propid?>&action=del" onclick="return confirm('Do you want delete this record?');" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-close text-danger"></i></a>
								<?php 
								 ?>
								<br>
								<br>
								<!-- mk-19 -->
								<?php if($proposal_type==1 || $proposal_type==8 || $proposal_type==9 || $proposal_type==11 || $prapsl_with_no_roof==1)  {
									
									
									
									
									
									if($propId == "yes") 
									{ ?>
										<a href="#" title="Generate Proposal" onclick="alert('Update the Roof Details')">
											<?//=$propId?><i class="fa fa-download" aria-hidden="true"></i>
										</a>
									<?php
									}
									
									if($propId == "no"){ 
										if($a==1 || $b==1 || $c==1 || $d==1 ){
										?>
									<a href="#" title="Generate Proposal" onclick="alert('Complete Roof Details')">
										<i class="fa fa-download" aria-hidden="true"></i>
									</a>
								<?php } 
								
								else{ ?>
									<a href="<?=SITE_PATH_ADM.CPAGE?>/generate-pdf2.php?pid=<?=$propid?>" title="Generate Proposal">
										<i class="fa fa-download" aria-hidden="true"></i>
									</a>
								<?php } } 
							
									} else{ ?>&nbsp;&nbsp;
									<a href="<?=SITE_PATH_ADM.CPAGE?>/generate-pdf2.php?pid=<?=$propid?>" title="Generate Proposal">
										<i class="fa fa-download" aria-hidden="true"></i>
									</a>
								<?php }?>

								<a href="<?=SITE_PATH_ADM.CPAGE?>/generate-chart-area.php?pid=<?=$propid?>" title="Generate Image"><i class="fa fa-download" aria-hidden="true"></i></a>&nbsp;&nbsp;
								<?php }								
								}else{?>
								<a href="<?=SITE_PATH_ADM.CPAGE?>?mode=view-proposal&start=<?=$_GET['start']?>&leadid=<?=$pid?>&id=<?=$id?>" data-toggle="tooltip" title="View proposal"><i class="fa fa-eye text-inverse m-r-10"></i></a>
								<?php }	?>
							</td>
							<td class="text-nowrap">
								<?php if(in_array(4,$act_arr) || $_SESSION["ses_adm_id"]==1){ ?>
								<?php $checked=($status=="4"?"checked":""); 
									$old_status = $cms->getSingleResult("SELECT lead_status FROM #_lead_tracker where lead_id=$pid ORDER by id desc ");
																		
									if($status==4 && $_SESSION["ses_adm_id"]!=1){
										$disabled = 'disabled';
									}else{
										$disabled = '';
									}
								?>
								<input data-size="small" type="checkbox" onChange="updateStatus('<?=$id?>','<?=$pid?>','<?=$status?>','<?=$old_status?>')" <?=$checked?> class="js-switch"  data-toggle="tooltip" title="Change Status" data-color="#99d683" data-secondary-color="#f96262" <?=$disabled?> />
								<?php }else{?>
								<?=$leadsStatusArr[$status]?$leadsStatusArr[$status]:'Not signed'?>
								<?php }	?>
							</td>
							<td class="table-center text-nowrap"><?=date("d M Y",strtotime($post_date))?> at <?=date("H:i",strtotime($post_date))?></td>
							<td class="table-center text-nowrap"><?=$proposal_pdf?></td>
							<?php if($proposal_customer_type==2){
								$customer_price = amount_format_proposal(round($total_price_excluding_vat));
							}else{
								$customer_price = amount_format_proposal(round($proposal_total_cost));
							}?>
							<td class="table-center text-nowrap"><?=amount_format_proposal(round($price_including_vat+$charger_price_including_vat+$battery_price_including_vat))?></td>
							<td class="table-center text-nowrap"><?=$customer_price?></td>
							<td class="table-center text-nowrap"><?=amount_format_proposal(round($total_green_rebate_kr))?></td>
							<td class="table-center text-nowrap"><?=($proposal_customer_type==1)?amount_format_proposal(round($green_rebate_kr)):0?></td>
							<td class="table-center text-nowrap"><?=($proposal_customer_type==1)?amount_format_proposal(round($charger_green_rebate_kr)):0?></td>
							<td class="table-center text-nowrap"><?=($proposal_customer_type==1)?amount_format_proposal(round($battery_green_rebate_kr)):0?></td>
							<td class="table-center text-nowrap"><?=amount_format_proposal(round($total_margin))?></td>
							<td class="table-center text-nowrap"><?=$perc_margin>0?$perc_margin:0?></td>
							<td class="table-center text-nowrap"><?=$repayment_period?></td>
							<!--<td class="table-center text-nowrap"><?=$cms->getSingleResult("SELECT customer_name FROM #_users WHERE id='$assigned_to' ")?></td>-->
							<td class="table-center text-nowrap"><?=$cms->getSingleResult("SELECT customer_name FROM #_users WHERE id='$post_by' ")?></td>
						</tr>
						<?php    $nums++;} } else{ echo $adm->rowerror(11);}  ?>
					</tbody>
				</table>
			</div>
			
			<div class="clearfix"></div>
			<?php include("../inc/paging.inc.php")?>  
			<div class="clearfix"></div>			
			<?php include("upload-files.php")?>
		</div>
	</div>
</div>
<!-- /.row -->

<script>
function searchAction(){
	$("#aforms").attr("method", "get");
	//$("#aforms").attr("action","<?=SITE_PATH_ADM.CPAGE?>?mode=proposal-list&start=&id=<?=$pid?>");
	//$("#aforms").submit();
	//setTimeout(function(){ location.reload() }, 1000);
}
</script>

<script type="text/javascript">
function updateStatus(id,leadid,current_status,old_status){
	$.ajax({
		url:"<?=SITE_PATH_ADM.CPAGE?>/ajaxChangeStatus.php",
		data:"id="+id+"&leadid="+leadid+"&status="+current_status+"&old_status="+old_status,
		method:"post",
		beforeSend:function(){
			$(".admin-ajax-loader").show();
		},
		success: function(result) {
			if(result==1){
				//$(".admin-ajax-loader").hide();
				location.reload();
			}
        }
	})
}
</script>
  
<script type="text/javascript">
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_file_button'); //Add button selector
    var wrapper = $('.file_wrapper'); //Input field wrapper
    var fieldHTML = '<div class="row"><div class="form-group col-sm-2"><label for="file_type" class="control-label">File Type*</label><select name="file_type[]" class="form-control" required><option value="">Select File Type</option><option value="1">Document</option><option value="2">Picture</option></select></div><div class="form-group col-sm-4"><label for="file_title" class="control-label">File Title</label><input type="text" name="file_title[]" class="form-control" id="file_title"></div><div class="form-group col-sm-5"><label for="file_upload" class="control-label">Upload File</label><input type="file" id="file_upload" name="file_upload[]"></div><div class="form-group col-sm-1"><a href="javascript:void(0);" class="remove_button"><i class="fa fa-close text-danger"></i></a></div><div class="clearfix"></div></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
		if(x>1){
			$("#upload_files").show();
		}
    });
    
    //Once remove button is clicked
    $('.file_wrapper').on('click', '.remove_button', function(e){
        e.preventDefault();
		$(this).closest('div.row').remove(); //Remove field html
		x--; //Decrement field counter
		if(x==1){
			$("#upload_files").hide();
		}
    });
});
</script>

<script>
function remove_file(id,name){
	if (confirm("Are you sure to delete?")) {
		$.ajax({
			type:"post",
			url: "<?=SITE_PATH_ADM.CPAGE?>/remove_file.php?id="+id+"&name="+name,
			success:function(result){
				if(parseInt(result)=='1'){
					$("#"+id).hide();
					location.reload();
				}
				else{
					alert("Something went wrong.Pleas try again.")
				}
			}
		})
	}
}	
</script>

<script type="text/javascript">
$(document).ready(function(){
	var list_maxField = 10; //Input fields increment limitation
	var x5 = <?=$mms_count?>;
	$('.list_add_mms').click(function(){
		//Check maximum number of input fields
		if(x5 < list_maxField){ 
			x5++; //Increment field counter
			var list_fieldHTML = '<div class="row"><div class="col-md-4"><h5><b>MMS Report Roof '+x5+'</b></h5><input type="hidden" name="doc_title[]" value="MMS Report Roof" class="form-control" id="doc_title"></div><div class="col-md-7"><input type="file" id="doc_upload" name="doc_upload[]"></div><div class="col-xs-1 col-sm-7 col-md-1"><a href="javascript:void(0);" class="list_remove_button btn btn-danger">-</a></div></div>'; //New input field html 
			$('.mms-wrapper').append(list_fieldHTML); //Add field html
		}
	});
	//Once remove button is clicked
	$('.mms-wrapper').on('click', '.list_remove_button', function(){
		$(this).closest('div.row').remove(); //Remove field html
		x--; //Decrement field counter
	});
});
function revrcrd(rid){
	$("#"+rid).remove();
}
</script>

<script type="text/javascript">
$(document).ready(function(){
	var list_maxField = 10; //Input fields increment limitation
	var x6 = <?=$bom_mms_count?>;
	$('.list_add_bom_mms').click(function(){
		//Check maximum number of input fields
		if(x6 < list_maxField){ 
			x6++; //Increment field counter
			var list_fieldHTML = '<div class="row"><div class="col-md-4"><h5><b>BOM MMS Roof '+x6+'</b></h5><input type="hidden" name="doc_title[]" value="BOM MMS Roof" class="form-control" id="doc_title"></div><div class="col-md-7"><input type="file" id="doc_upload" name="doc_upload[]"></div><div class="col-xs-1 col-sm-7 col-md-1"><a href="javascript:void(0);" class="list_remove_button btn btn-danger">-</a></div></div>'; //New input field html 
			$('.bom-mms-wrapper').append(list_fieldHTML); //Add field html
		}
	});
	//Once remove button is clicked
	$('.bom-mms-wrapper').on('click', '.list_remove_button', function(){
		$(this).closest('div.row').remove(); //Remove field html
		x--; //Decrement field counter
	});
});
function revrcrd(rid){
	$("#"+rid).remove();
}
</script>


<script type="text/javascript">
$(document).ready(function(){
	var list_maxField = 10; //Input fields increment limitation
	var x9 = <?=$formalon_count?>;
	$('.list_add_formalon').click(function(){
		//Check maximum number of input fields
		if(x9 < list_maxField){ 
			x9++; //Increment field counter
			var list_fieldHTML = '<div class="row"><div class="col-md-4"><h5><b>Föranmälan '+x9+'</b></h5><input type="hidden" name="doc_title[]" value="Föranmälan" class="form-control" id="doc_title"></div><div class="col-md-7"><input type="file" id="doc_upload" name="doc_upload[]"></div><div class="col-xs-1 col-sm-7 col-md-1"><a href="javascript:void(0);" class="list_remove_button btn btn-danger">-</a></div></div>'; //New input field html 
			$('.formalon-wrapper').append(list_fieldHTML); //Add field html
		}
	});
	//Once remove button is clicked
	$('.formalon-wrapper').on('click', '.list_remove_button', function(){
		$(this).closest('div.row').remove(); //Remove field html
		x--; //Decrement field counter
	});
});
function revrcrd(rid){
	$("#"+rid).remove();
}
</script>

<script type="text/javascript">
$(document).ready(function(){
	var list_maxField = 10; //Input fields increment limitation
	var x7 = <?=$panel_roof_count?>;
	$('.add_panel_roof').click(function(){
		//Check maximum number of input fields
		if(x7 < list_maxField){ 
			x7++; //Increment field counter
			var list_fieldHTML = '<div class="row"><div class="col-md-4"><label class="control-label">Panel Layout Roof '+x7+'</label><input type="hidden" name="pic_title[]" value="Panel Layout Roof" class="form-control" id="pic_title"></div><div class="col-md-7"><input type="file" name="pic_upload[]" id="pic_upload'+x7+'" class="dropify dropify-area-img installation_image" data-max-file-size="1M" data-height="150" /></div><div class="col-xs-1 col-sm-7 col-md-1"><a href="javascript:void(0);" class="list_remove_button btn btn-danger">-</a></div></div>'; //New input field html 
			$('.panel-roof-wrapper').append(list_fieldHTML); //Add field html
		}
	});
	//Once remove button is clicked
	$('.panel-roof-wrapper').on('click', '.list_remove_button', function(){
		$(this).closest('div.row').remove(); //Remove field html
		x--; //Decrement field counter
	});
});
function revrcrd(rid){
	$("#"+rid).remove();
}
</script>

<script type="text/javascript">
$(document).ready(function(){
	var list_maxField = 10; //Input fields increment limitation
	var x8 = <?=$roof_pic_count?>;
	$('.add_roof_pic').click(function(){
		//Check maximum number of input fields
		if(x8 < list_maxField){ 
			x8++; //Increment field counter
			var list_fieldHTML = '<div class="row"><div class="col-md-4"><label class="control-label">Roof Picture '+x8+'</label><input type="hidden" name="pic_title[]" value="Roof Picture" class="form-control" id="pic_title"></div><div class="col-md-7"><input type="file" name="pic_upload[]" id="pic_upload'+x8+'" class="dropify dropify-area-img installation_image" data-max-file-size="1M" data-height="150" /></div><div class="col-xs-1 col-sm-7 col-md-1"><a href="javascript:void(0);" class="list_remove_button btn btn-danger">-</a></div></div>'; //New input field html 
			$('.roof-picture-wrapper').append(list_fieldHTML); //Add field html
		}
	});
	//Once remove button is clicked
	$('.roof-picture-wrapper').on('click', '.list_remove_button', function(){
		$(this).closest('div.row').remove(); //Remove field html
		x--; //Decrement field counter
	});
});
function revrcrd(rid){
	$("#"+rid).remove();
}
</script>


<script>
function remove_uploaded_file(id,name){
	if (confirm("Are you sure to delete?")) {
		$.ajax({
			type:"post",
			url: "<?=SITE_PATH_ADM.CPAGE?>/remove_uploaded_file.php?id="+id+"&name="+name,
			success:function(result){
				if(parseInt(result)=='1'){
					$("#"+id).hide();
					location.reload();
				}
				else{
					alert("Something went wrong.Pleas try again.")
				}
			}
		})
	}
}	
</script>
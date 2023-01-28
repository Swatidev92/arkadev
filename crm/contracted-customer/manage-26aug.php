<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 
	if($action=='del'){
		$cms->db_query("update #_customer_registration set is_deleted='1' where id in ($id)");
		$adm->sessset('Record has been deleted', 'e');
		$cms->redir(SITE_PATH_ADM.CPAGE, true);
		exit;
	}
	
	if(isset($_POST['assign_project_btn'])){
		if($arr_ids){
			if($_POST['project_manager']!=''){			
				$str_adm_ids = implode(",",$arr_ids);
				$cms->db_query("update #_leads set project_manager=".$_POST['project_manager'].", project_assigned_date='".date("Y-m-d")."', lead_type=3 where id in ($str_adm_ids)");
			
				//new status added on tracker
				$str_adm_idsArr = explode(',',$str_adm_ids);
				foreach($str_adm_idsArr as $lid){
					$lead_customer = $cms->getSingleResult("SELECT customer_name FROM #_leads WHERE id=".$lid." ");
					$assignedToProjectMgr = $cms->getSingleResult("SELECT customer_name FROM #_users WHERE id=".$_POST['project_manager']." ");
					$action_message = 'Proposal <b>LEAD-'.$lid.'-'.$lead_customer.'</b> assigned to <b>'.$assignedToProjectMgr.' (project manager)</b>';
					$ActionPOSTS["lead_id"] = $lid;
					$ActionPOSTS["action_message"] = $action_message;
					$ActionPOSTS["action_date"] = date('Y-m-d h:i:s');
					$ActionPOSTS["action_by"] = $_SESSION["ses_adm_id"];
					$ActionPOSTS["activity_for"] = $_POST['project_manager'];
					$cms->sqlquery("rs","lead_tracker",$ActionPOSTS);
				}
			}
			else{
				echo '<script>alert("Select project manager to assign")</script>';
			}				
			$path = $_SESSION['REFERER_page'];
			$cms->redir($path, true);
		}else{
			echo '<script>alert("Select one or more proposal from the list")</script>';
		}
	}
	
	if($cms->is_post_back()){
		if($arr_ids) {
			$str_adm_ids = implode(",",$arr_ids);
			//print_r($_POST);die;
			switch ($_POST['action']){
				case "delete":
					$cms->db_query("update #_customer_registration set is_deleted='1' where id in ($str_adm_ids)");
					$adm->sessset(count($arr_ids).' Item(s) Delete', 'e');
					break;
				case "Inactive":
					$cms->db_query("update #_customer_registration set status = '0' where pid in ($str_adm_ids)");
					$adm->sessset(count($arr_ids).' Item(s) Inactive', 'e');
					break;
				case "Active":
					$cms->db_query("update #_customer_registration set status = '1' where pid in ($str_adm_ids)");
					$adm->sessset(count($arr_ids).' Item(s) Active', 's');
					break;
				default:
			}
		}
		$cms->redir(SITE_PATH_ADM.CPAGE, true);
		exit;
	}
	if(isset($_REQUEST['submt'])){
		$conditionsQr = "";
		if(!empty($_REQUEST['name_search'])){
			$name_search = $cms->escape_string($_REQUEST['name_search']);
			$conditionsQr .= " AND customer_name like '%$name_search%'";
		}
		if(!empty($_REQUEST['city_search'])){
			$city_search = $cms->escape_string($_REQUEST['city_search']);
			$conditionsQr .= " AND (city like '%$city_search%' || proposal_address like '%$city_search%')";
		}
		if(!empty($_REQUEST['search_battery'])){
			$search_battery = $cms->escape_string($_REQUEST['search_battery']);
			$conditionsQr .= " AND battery_name='$search_battery'";
		}
		if(!empty($_REQUEST['search_charger'])){
			$search_charger = $cms->escape_string($_REQUEST['search_charger']);
			$conditionsQr .= " AND charger_name='$search_charger'";
		}
		if(!empty($_REQUEST['search_panel'])){
			$search_panel = $cms->escape_string($_REQUEST['search_panel']);
			$conditionsQr .= " AND panel_model='$search_panel'";
		}
		if(!empty($_REQUEST['search_roof'])){
			$search_roof = $cms->escape_string($_REQUEST['search_roof']);
			$conditionsQr .= " AND roofing_material='$search_roof'";
		}
		if(!empty($_REQUEST['search_inverter'])){
			$search_inverter = $cms->escape_string($_REQUEST['search_inverter']);
			$conditionsQr .= " AND (inverter_type='$search_inverter' || inverter_type2='$search_inverter' || inverter_type3='$search_inverter')";
		}
		if(!empty($_REQUEST['search_agent'])){
			$search_agent = $cms->escape_string($_REQUEST['search_agent']);
			$conditionsQr .= " AND assigned_to=$search_agent";
		}
		if(!empty($_REQUEST['search_manager'])){
			$search_manager = $cms->escape_string($_REQUEST['search_manager']);
			$conditionsQr .= " AND project_manager_id=$search_manager";
		}
		if(!empty($_REQUEST['search_status'])){
			$search_status = $cms->escape_string($_REQUEST['search_status']);
			if($search_status==2){
				$conditionsQr .= " AND p.status!=7 AND p.status!='' ";				
			}
			if($search_status==3){
				$conditionsQr .= " AND p.status=7 AND p.status!='' ";				
			}
		}
		if(!empty($_REQUEST['start_date']) AND !empty($_REQUEST['end_date'])){
			$start_date = $cms->escape_string($_REQUEST['start_date']);
			$end_date = $cms->escape_string($_REQUEST['end_date']);
			$postDateFrom = date("Y-m-d", strtotime($start_date));
			$postDateTo = date("Y-m-d", strtotime($end_date));
			$conditionsQr .= " AND post_date>='$postDateFrom' AND post_date<='$postDateTo' ";
		}else{
			if(!empty($_REQUEST['start_date'])){
				$start_date = $cms->escape_string($_REQUEST['start_date']);
				$postDate = date("Y-m-d", strtotime($start_date));
				$conditionsQr .= " AND  post_date>='$postDate'";
			} 
			if(!empty($_REQUEST['end_date'])){
				$end_date = $cms->escape_string($_REQUEST['end_date']);
				$postDate = date("Y-m-d", strtotime($end_date));
				$conditionsQr .= "AND post_date<='$postDate'";
			} 
		}
		 
		$start = intval($start);
		$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;		
		$columns = "select p.status as pstatus, l.* ";
		$sql = " from #_leads l LEFT JOIN #_customer_project p on l.id=p.cust_id where 1=1 AND l.lead_id>0 AND l.is_deleted=0 AND l.status=4 $conditionsQr ";		
		$order_by == '' ? $order_by = 'l.post_date' : true;
		$order_by2 == '' ? $order_by2 = 'asc' : true;
		$sql_count = "select count(*) ".$sql; 
		$sql .= "order by $order_by $order_by2 ";
		$sql .= "limit $start, $pagesize ";
		$sql = $columns.$sql;
		$result = $cms->db_query($sql);
		$reccnt = $cms->db_scalar($sql_count);
	}else{
		$start = intval($_GET['start']);
		$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
		$columns = "SELECT l.*, l.id as propid ";
		$sql = " FROM #_leads l WHERE 1=1 AND l.is_deleted=0 AND l.lead_id>0 AND status=4 ";
		$order_by == '' ? $order_by = 'l.post_date' : true;
		$order_by2 == '' ? $order_by2 = 'desc' : true;
		$sql_count = "SELECT count(*) ".$sql; 
		$sql .= " order by $order_by $order_by2 ";
		//$sql .= " limit $start, $pagesize ";
		$sql = $columns.$sql;
		$result = $cms->db_query($sql);
		$numRows = $result->num_rows; 
		$reccnt = $cms->db_scalar($sql_count);
	}
	//echo $sql;
	
	$customerPriceQry = $cms->db_query("SELECT battery_types, ev_charger_types, panel_types, roof_type_price, inverter_types FROM #_customer_price where id=1 ");
	$customerPriceArr = $customerPriceQry->fetch_array(); 

?>
<div class="row">
	<div class="col-sm-12">
		<div class="white-box">
			<div class="table-responsive">
				<table class="table table-striped1 table-bordered1 table-hover">
					<thead>
						<tr>
							<th class="text-nowrap">Action</th>
							<th class="text-nowrap">Date</th>						
							<th class="text-nowrap">Customer name</th>
							<th class="text-nowrap">Proposal name</th>
							<th class="text-nowrap">Total Price</th>
							<th class="text-nowrap">Customer Price</th>
							<th class="text-nowrap">Solar Green Rebate</th>
							<th class="text-nowrap">Charger Green Rebate</th>
							<th class="text-nowrap">Battery Green Rebate</th>
							<th class="text-nowrap">Total Margin (kr)</th>
							<th class="text-nowrap">Total Margin (%)</th>
							<th class="text-nowrap">Payback Year</th>
							<th class="text-nowrap">Generated By</th>
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
						
						$leadsStatusArr = getAllStatus();
						?>  
						<tr class="clickable-row">
							<td class="text-nowrap">
								<a href="<?=SITE_PATH_ADM.CPAGE?>?mode=add-proposal&start=<?=$_GET['start']?>&leadid=<?=$lead_id?>&id=<?=$id?>" data-toggle="tooltip" title="Edit Proposal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;&nbsp;
								
								<?php if($proposal_pdf){ ?>
								 
								<a href="<?=SITE_PATH.'uploaded_files/proposal/'.$proposal_pdf?>" download title="Proposal 1"><i class="fa fa-file-pdf-o" aria-hidden="true">1</i></a>
								
								<?php if($number_of_proposal==2 && $proposal_pdf2!=''){ ?>
								&nbsp;
								<a href="<?=SITE_PATH.'uploaded_files/proposal/'.$proposal_pdf2?>" download title="Proposal 2"><i class="fa fa-file-pdf-o" aria-hidden="true">2</i></a>								 
								<?php } ?>
								
								<?php if($proposal_image_pdf!=''){ ?>
								&nbsp;
								<a href="<?=SITE_PATH.'uploaded_files/proposal/'.$proposal_image_pdf?>" download title="Proposal Image"><i class="fa fa-image"></i></a>
								<?php } ?>
								&nbsp;
								<?php } ?>
								
								<?php if($proposal_txt){ ?>
								<a href="<?=SITE_PATH.'uploaded_files/proposal/'.$proposal_txt?>" title="Download TXT" download><i class="fa fa-file"></i></a>&nbsp;&nbsp;
								<?php } ?>
							</td>
							<td class="table-center text-nowrap"><?=date("Y-m-d",strtotime($post_date))?></td>
							<td class="table-center text-nowrap"><?=$customer_name?></td>
							<td class="table-center text-nowrap"><?=$proposal_pdf?></td>
							<?php if($proposal_customer_type==2){
								$customer_price = amount_format_proposal(round($total_price_excluding_vat));
							}else{
								$customer_price = amount_format_proposal(round($proposal_total_cost));
							}?>
							<td class="table-center text-nowrap"><?=amount_format_proposal(round($price_including_vat+$charger_price_including_vat+$battery_price_including_vat))?></td>
							<td class="table-center text-nowrap"><?=$customer_price?></td>
							<td class="table-center text-nowrap"><?=($proposal_customer_type==1)?amount_format_proposal(round($green_rebate_kr)):0?></td>
							<td class="table-center text-nowrap"><?=($proposal_customer_type==1)?amount_format_proposal(round($charger_green_rebate_kr)):0?></td>
							<td class="table-center text-nowrap"><?=($proposal_customer_type==1)?amount_format_proposal(round($battery_green_rebate_kr)):0?></td>
							<td class="table-center text-nowrap"><?=amount_format_proposal(round($total_margin))?></td>
							<td class="table-center text-nowrap"><?=$perc_margin>0?$perc_margin:0?></td>
							<td class="table-center text-nowrap"><?=$repayment_period?></td>
							<!--<td class="table-center text-nowrap"><?=$cms->getSingleResult("SELECT customer_name FROM #_users WHERE id='$assigned_to' ")?></td>-->
							<td class="table-center text-nowrap"><?=$cms->getSingleResult("SELECT customer_name FROM #_users WHERE id='$post_by' ")?></td>
						</tr>
						<?php $nums++;} } else{ echo $adm->rowerror(11);}  ?>
					</tbody>
				</table>
			</div>
			<?php include("../inc/paging.inc.php")?> 
		</div>
	</div>
</div>
<!-- /.row -->
<script>
 function changeMethod() {
	$("#aforms").attr("method", "get");
}
</script>
<script type="text/javascript">
function updateApprovedStatus(id,current_status){
	$.ajax({
		url:"<?=SITE_PATH_ADM.CPAGE?>/ajaxChangeStatus.php",
		data:"id="+id+"&status="+current_status,
		method:"post"
	})
}
</script>
<script>
function changeAction(){
	$("#aforms").attr("action","<?=SITE_PATH_ADM.CPAGE?>/download.php");
	//alert($(".filter_form").attr("action"));
	$("#aforms").submit();
	setTimeout(function(){ location.reload() }, 1000);
}
</script>
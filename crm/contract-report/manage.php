<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 
	if($action=='del'){
		$cms->db_query("update #_customer_registration set is_deleted='1' where id in ($id)");
		$adm->sessset('Record has been deleted', 'e');
		$cms->redir(SITE_PATH_ADM.CPAGE, true);
		exit;
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
		if(!empty($_REQUEST['from_date']) AND !empty($_REQUEST['to_date'])){
			$from_date = $cms->escape_string($_REQUEST['from_date']);
			$to_date = $cms->escape_string($_REQUEST['to_date']);
			$postDateFrom = date("Y-m-d", strtotime($from_date));
			$postDateTo = date("Y-m-d", strtotime($to_date));
			$conditionsQr .= " AND post_date>='$postDateFrom' AND post_date<='$postDateTo' ";
		}else{
			if(!empty($_REQUEST['from_date'])){
				$from_date = $cms->escape_string($_REQUEST['from_date']);
				$postDate = date("Y-m-d", strtotime($from_date));
				$conditionsQr .= " AND post_date>='$postDate'";
			} 
			if(!empty($_REQUEST['to_date'])){
				$to_date = $cms->escape_string($_REQUEST['to_date']);
				$postDate = date("Y-m-d", strtotime($to_date));
				$conditionsQr .= "AND post_date<='$postDate'";
			} 
		}
		if(!empty($_REQUEST['srch_assigned_to'])){
			$srch_assigned_to = $cms->escape_string($_REQUEST['srch_assigned_to']);
			$conditionsQr .= " AND assigned_to ='$srch_assigned_to'";
		}
		 
		$start = intval($start);
		$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
		$columns = "select * ";
		$sql = " from #_leads where 1=1 AND is_deleted=0 AND status=4 $conditionsQr ";
		$order_by == '' ? $order_by = 'id' : true;
		$order_by2 == '' ? $order_by2 = 'desc' : true;
		$sql_count = "select count(*) ".$sql; 
		$sql .= "order by $order_by $order_by2 ";
		$sql .= "limit $start, $pagesize ";
		$sql = $columns.$sql;
		$result = $cms->db_query($sql);
		$reccnt = $cms->db_scalar($sql_count);
	}else{
		$start = intval($start);
		$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
		$columns = "select * ";
		$sql = " from #_leads where 1=1 AND is_deleted=0 AND status=4 ";
		$order_by == '' ? $order_by = 'id' : true;
		$order_by2 == '' ? $order_by2 = 'desc' : true;
		$sql_count = "select count(*) ".$sql; 
		$sql .= "order by $order_by $order_by2 ";
		$sql .= "limit $start, $pagesize ";
		$sql = $columns.$sql;
		$result = $cms->db_query($sql);
		$reccnt = $cms->db_scalar($sql_count);
	}
	//echo $sql;
?>
<div class="row">
	<div class="col-sm-12">
		<div class="white-box">
			<div class="Search FORM">
				<div class="form-group col-sm-4">				
					<div class="input-daterange input-group" id="date-range">
						<input type="text" class="form-control" name="from_date" id="from_date" value="<?=$from_date?>" placeholder="Date From" autocomplete="off">
						<span class="input-group-addon bg-info b-0 text-white">to</span>
						<input type="text" class="form-control" name="to_date" id="to_date" value="<?=$to_date?>" placeholder="Date To" autocomplete="off">
					</div>
				</div> 
				<?php if($_SESSION["ses_adm_role"]=="1"){ ?>
				<div class="form-group col-md-2">
					<select class="form-control select2" id="srch_assigned_to" name="srch_assigned_to">
						<option value="">Search by user</option>
						<?php $userQry = $cms->db_query("SELECT id, customer_name FROM #_users WHERE role=3 ");
							while($userArr = $userQry->fetch_array()){
							if($userArr['id']==$srch_assigned_to){
								$statusSel = 'selected';
							}else{
								$statusSel = '';
							}
							echo '<option value="'.$userArr['id'].'" '.$statusSel.'>'.$userArr['customer_name'].'</option>';
						}
						?>
					</select>
				</div>
				<?php } ?>
				<div class="col-sm-2">
					<input type="submit" name="submt" onClick="changeMethod()" value="Search" class="btn search-btn">
					<a href="<?=SITE_PATH_ADM.CPAGE?>" class="btn reset-btn">Reset</a>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
			<div class="table-responsive">
				<table class="table table-striped1 table-bordered1 table-hover">
					<thead>
						<tr>					
							<th>Customer name</th>
							<th>Customer price</th>
							<th>Total price</th>
							<th>Solar Green Rebate</th>
							<th>Charger Green Rebate</th>
							<th>Battery Green Rebate</th>
							<th>Total Margin (%)</th>
							<th>Total Margin (kr)</th>
						</tr>
					</thead>
					<tbody>
						<?php $sum_proposal_total_cost=0; $sum_green_rebate_kr=0; $sum_charger_green_rebate_kr=0; $sum_battery_green_rebate_kr=0; $sum_perc_margin=0; $perc_margin=0; $sum_total_margin=0;
						if($reccnt){ 
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
						$perc_margin = ($total_margin*100/$proposal_total_cost);
						
						if($perc_margin>0){
							$sum_perc_margin = ($sum_perc_margin+$perc_margin);
						}
						$sum_proposal_total_cost = $sum_proposal_total_cost+$proposal_total_cost;
						$sum_green_rebate_kr = $sum_green_rebate_kr+$green_rebate_kr;
						$sum_charger_green_rebate_kr = $sum_charger_green_rebate_kr+$charger_green_rebate_kr;
						$sum_battery_green_rebate_kr = $sum_battery_green_rebate_kr+$battery_green_rebate_kr;
						$sum_total_margin = $sum_total_margin+$total_margin;
						?>  
						<tr class="clickable-row">
							<td class="table-center text-nowrap"><?=$customer_name?></td>
							<td class="table-center text-nowrap"><?=amount_format_proposal(round($proposal_total_cost))?></td>
							<td class="table-center text-nowrap"><?=amount_format_proposal(round($proposal_total_cost))?></td>
							<td class="table-center text-nowrap"><?=amount_format_proposal(round($green_rebate_kr))?></td>
							<td class="table-center text-nowrap"><?=amount_format_proposal(round($charger_green_rebate_kr))?></td>
							<td class="table-center text-nowrap"><?=amount_format_proposal(round($battery_green_rebate_kr))?></td>
							<td class="table-center text-nowrap"><?=$perc_margin>0?round($perc_margin):0?></td>
							<td class="table-center text-nowrap"><?=amount_format_proposal(round($total_margin))?></td>
						</tr>
						<?php $nums++;} ?>
						<tr>
							<th>Total</th>						
							<th class="table-center text-nowrap"><?=amount_format_proposal(round($sum_proposal_total_cost))?></th>
							<th class="table-center text-nowrap"><?=amount_format_proposal(round($sum_proposal_total_cost))?></th>
							<th class="table-center text-nowrap"><?=amount_format_proposal(round($sum_green_rebate_kr))?></th>
							<th class="table-center text-nowrap"><?=amount_format_proposal(round($sum_charger_green_rebate_kr))?></th>
							<th class="table-center text-nowrap"><?=amount_format_proposal(round($sum_battery_green_rebate_kr))?></th>
							<th class="table-center text-nowrap"><?=round($sum_perc_margin/($nums-1))?></th>
							<th class="table-center text-nowrap"><?=amount_format_proposal(round($sum_total_margin))?></th>
						</tr>
						<?php } else{ echo $adm->rowerror(8);}  ?>
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
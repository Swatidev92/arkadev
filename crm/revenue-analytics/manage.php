<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 
	$_SESSION['REFERER_page']='';
	
	$conditionsQr = "";
	$conditionsQrUser = "";
	 
	if(!empty($_GET)){
		if(!empty($_REQUEST['srch_assigned_to'])){
			$srchAssignedTo = implode(',',$_REQUEST['srch_assigned_to']);
			//$srch_assigned_to = $cms->escape_string($_REQUEST['srch_assigned_to']);
			$conditionsQrUser .= " AND id in ($srchAssignedTo) ";
		}
		if(!empty($_REQUEST['from_date']) AND !empty($_REQUEST['to_date'])){
			$from_date = $cms->escape_string($_REQUEST['from_date']);
			$to_date = $cms->escape_string($_REQUEST['to_date']);
			$postDateFrom = date("Y-m-d", strtotime($from_date));
			$postDateTo = date("Y-m-d", strtotime($to_date));
			$conditionsQr .= " AND DATE(post_date) BETWEEN '$postDateFrom' AND '$postDateTo' ";
		}else{
			if(!empty($_REQUEST['from_date'])){
				$from_date = $cms->escape_string($_REQUEST['from_date']);
				$postDate = date("Y-m-d", strtotime($from_date));
				$conditionsQr .= " AND DATE(post_date)>='$postDate'";
			} 
			if(!empty($_REQUEST['to_date'])){
				$to_date = $cms->escape_string($_REQUEST['to_date']);
				$postDate = date("Y-m-d", strtotime($to_date));
				$conditionsQr .= "AND DATE(post_date)<='$postDate'";
			} 
		}	
	}
		
	$start = intval($_GET['start']);
	$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
	$columns = "SELECT * ";
	$sql = " FROM #_lead_type_status WHERE 1=1 AND is_deleted=0 AND lead_type=1 ";
	$order_by == '' ? $order_by = 'constant' : true;
	$order_by2 == '' ? $order_by2 = 'asc' : true;
	$sql_count = "SELECT count(*) ".$sql; 
	$sql .= " order by $order_by $order_by2 ";
	$sql .= " limit $start, $pagesize ";
	$sql = $columns.$sql;
	$result = $cms->db_query($sql);
	$numRows = $result->num_rows; 
	$reccnt = $cms->db_scalar($sql_count);
?>
<!-- .row -->

<div class="row">
	<div class="col-sm-12">
		<div class="white-box">
			<div class="Search FORM">
				<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
					<div class="panel">
						<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
							<a class="panel-title <?=$expanded=='true'?'':'collapsed'?>" data-toggle="collapse" href="#exampleCollapseDefaultThree1" data-parent="#exampleAccordionDefault" aria-expanded="<?=$expanded=='true'?'true':'false'?>" aria-controls="exampleCollapseDefaultThree1">Filter <i class="fa fa-filter" aria-hidden="true"></i></a> 
						</div>
						<div class="panel-collapse collapse <?=$expanded=='true'?'in':''?>" id="exampleCollapseDefaultThree1" aria-labelledby="exampleCollapseDefaultThree1" role="tabpanel">
							<div class="panel-body">
								<input type="hidden" name="expanded" value="true">								
								<div class="form-group col-sm-4">				
									<div class="input-daterange input-group" id="date-range">
										<input type="text" class="form-control" name="from_date" id="from_date" value="<?=$from_date?>" placeholder="Date From" autocomplete="off">
										<span class="input-group-addon bg-info b-0 text-white">to</span>
										<input type="text" class="form-control" name="to_date" id="to_date" value="<?=$to_date?>" placeholder="Date To" autocomplete="off">
									</div>
								</div>
								<div class="form-group col-md-4">
									<select class="form-control1 select2" id="srch_assigned_to" name="srch_assigned_to[]" data-placeholder="Select user" multiple>
										<?php $allAgents = getAllAgents();
										foreach($allAgents as $akey=>$aval){
											if($akey==$search_agent){
												$asel = 'selected';
											}else{
												$asel = '';
											}
										?>
										<option value="<?=$akey?>" <?=$asel?>><?=$aval?></option>
										<?php } ?>
									</select>
								</div>
								<div class="form-group col-sm-2">
									<input type="submit" name="submt" onClick="changeMethod()" value="Search" class="btn search-btn">
									<a href="<?=SITE_PATH_ADM.CPAGE?>" class="btn reset-btn">Reset</a>
								</div>	
							</div>
						</div>
					</div>
				</div>
			</div>
				
			<div class="form-group col-sm-2 pull-right">
				<button type="button" class="fcbtn btn btn-warning btn-outline btn-1b pull-right" onClick="changeAction()">Download Report</button>
			</div>
			<div class="clearfix"></div>
			
			<div class="table-responsive">
				<table class="table table-striped1 table-hover table-bordered1">
					<thead>
						<tr>
							<th class="text-nowrap">Sales Lead</th>
							<th class="text-nowrap">Number of Contracts</th>
							<th class="text-nowrap">Revenue Before Rot</th>
							<th class="text-nowrap">Revenue After Rot</th>
							<th class="text-nowrap">Average Margin</th>
						</tr>
					</thead>
					<tbody>
						<?php $userQry = $cms->db_query("SELECT id, customer_name FROM #_users where id!=1 AND status=1 AND is_deleted=0 and role=3 $conditionsQrUser ");
						if($userQry->num_rows>0){
							$total_contract_customer = 0; $total_customer_price=0; $sum_total_price=0; $total_avg_margin=0;
						while($userRes = $userQry->fetch_array()){ ?> 
						<tr class="clickable-row">
							<td class="table-center text-nowrap"><?=$userRes['customer_name']?></td>
							<?php $contract_customer = $cms->getSingleResult("SELECT count(id) FROM #_leads where status=4 AND assigned_to=".$userRes['id']." AND lead_id>0 $conditionsQr ");
							$total_contract_customer = $total_contract_customer+$contract_customer;
							?>
							<td class="table-center text-nowrap"><?=$contract_customer?></td>
							<?php 
							$total_price = (round($cms->getSingleResult("SELECT sum(price_including_vat+charger_price_including_vat+battery_price_including_vat) FROM #_leads where status=4 AND assigned_to=".$userRes['id']." AND lead_id>0 $conditionsQr ")));
							$sum_total_price = $sum_total_price+$total_price;
							?>
							<td class="table-center text-nowrap"><?=amount_format_proposal($total_price)?></td>
							<?php /*if($proposal_customer_type==2){
								$customer_price = amount_format_proposal(round($cms->getSingleResult("SELECT sum(total_price_excluding_vat) FROM #_leads where status=4 AND assigned_to=".$userRes['id']." AND lead_id>0 $conditionsQr ")));
							}else{
								$customer_price = amount_format_proposal(round($cms->getSingleResult("SELECT sum(proposal_total_cost) FROM #_leads where status=4 AND assigned_to=".$userRes['id']." AND lead_id>0 $conditionsQr ")));
							}*/
							$customer_price = (round($cms->getSingleResult("SELECT sum(proposal_total_cost) FROM #_leads where status=4 AND assigned_to=".$userRes['id']." AND lead_id>0 $conditionsQr ")));
							$total_customer_price = $total_customer_price+$customer_price;
							?>
							<td class="table-center text-nowrap"><?=amount_format_proposal($customer_price)?></td>
							<?php $avg_margin = round($cms->getSingleResult("SELECT round(avg(total_margin_percentage)) FROM #_leads where status=4 AND assigned_to=".$userRes['id']." AND lead_id>0 $conditionsQr "));
							$total_avg_margin = $total_avg_margin+($contract_customer*$avg_margin);
							?>
							<td class="table-center text-nowrap"><?=amount_format_proposal($avg_margin)?>%</td>
						</tr>
						<?php $nums++;} ?>
						<tr class="" style="background:linear-gradient(to right, #30bc22, #28b01d, #20a418, #189813, #0e8c0e);">
							<th class="table-center text-nowrap" style="color:#fff;">Total</th>
							<th class="table-center text-nowrap" style="color:#fff;"><?=$total_contract_customer?></th>
							<th class="table-center text-nowrap" style="color:#fff;"><?=amount_format_proposal($sum_total_price)?></th>
							<th class="table-center text-nowrap" style="color:#fff;"><?=amount_format_proposal($total_customer_price)?></th>
							<th class="table-center text-nowrap" style="color:#fff;"><?=round($total_avg_margin/$total_contract_customer)?>%</th>
						</tr>
						<?php } else{ echo $adm->rowerror(11);} ?>
					</tbody>
				</table>
			</div>
			
			<div class="clearfix"></div>
			<?php include("../inc/paging.inc.php")?>  
			<div class="clearfix"></div>
		</div>
	</div>
</div>
<!-- /.row -->

<script>
function changeMethod() {
	$("#aforms").attr("method", "get");
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
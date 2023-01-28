<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 
	$_SESSION['REFERER_page']='';
	
	$conditionsQr = "";
		 
	if(!empty($_GET)){
		if(!empty($_REQUEST['from_date']) AND !empty($_REQUEST['to_date'])){
			$from_date = $cms->escape_string($_REQUEST['from_date']);
			$to_date = $cms->escape_string($_REQUEST['to_date']);
			$postDateFrom = date("Y-m-d", strtotime($from_date));
			$postDateTo = date("Y-m-d", strtotime($to_date));
			$conditionsQr .= " AND DATE(action_date) BETWEEN '$postDateFrom' AND '$postDateTo' ";
		}else{
			if(!empty($_REQUEST['from_date'])){
				$from_date = $cms->escape_string($_REQUEST['from_date']);
				$postDate = date("Y-m-d", strtotime($from_date));
				$conditionsQr .= " AND DATE(action_date)>='$postDate'";
			} 
			if(!empty($_REQUEST['to_date'])){
				$to_date = $cms->escape_string($_REQUEST['to_date']);
				$postDate = date("Y-m-d", strtotime($to_date));
				$conditionsQr .= "AND DATE(action_date)<='$postDate'";
			} 
		}		
	}		
		
	$start = intval($_GET['start']);
	$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
	$columns = "SELECT * ";
	$sql = " FROM #_lead_type_status WHERE 1=1 AND is_deleted=0 AND lead_type=1 AND constant in(1,2,5,6,4) ";
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
								<div class="form-group col-sm-2">
									<input type="submit" name="submt" onClick="changeMethod()" value="Search" class="btn search-btn">
									<a href="<?=SITE_PATH_ADM.CPAGE?>" class="btn reset-btn">Reset</a>
								</div>				
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group col-sm-6 pull-right">
				<button type="button" class="fcbtn btn btn-warning btn-outline btn-1b pull-right" onClick="changeAction()">Download Report</button>
			</div>
			<div class="clearfix"></div>
			
			<div class="table-responsive">
				<table class="table table-striped1 table-hover table-bordered1">
					<thead>
						<tr>
							<?php if($reccnt){ 
							$nums=$start+1; 
							while ($line = $result->fetch_array()){ 
							@extract($line);?>	
							<th class="text-nowrap text-center"><?=$lead_status?></th>
							<?php } } ?>
						</tr>
					</thead>
					<tbody>
						<tr class="clickable-row">
							<?php $statusQry = $cms->db_query("SELECT * FROM #_lead_type_status WHERE 1=1 AND is_deleted=0 AND lead_type=1 AND constant in(1,2,5,6,4) order by constant asc ");
							if($statusQry->num_rows>0){  
							while ($statusArr = $statusQry->fetch_array()){
								echo '<td class="text-center">'.$cms->getSingleResult("SELECT count(id) FROM #_lead_tracker where (lead_status=".$statusArr['constant']." OR new_status=".$statusArr['constant'].") and lead_id>0 $conditionsQr ").'</td>';
							} } ?>
						</tr>
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
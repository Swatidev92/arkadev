<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 
	if(isset($_REQUEST['submt'])){
		$conditionsQr = "";
				 
		$start = intval($start);
		$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
		$columns = "select * ";
		$sql = " from #_vendor_type where 1=1 $conditionsQr ";
		$order_by == '' ? $order_by = 'id' : true;
		$order_by2 == '' ? $order_by2 = 'asc' : true;
		$sql_count = "select count(*) ".$sql; 
		$sql .= " order by $order_by $order_by2 ";
		$sql .= "limit $start, $pagesize ";
		$sql = $columns.$sql;
		$result = $cms->db_query($sql);
		$reccnt = $cms->db_scalar($sql_count);
	}else{
		$start = intval($start);
		$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
		$columns = "select * ";
		$sql = " from #_vendor_type where 1=1 ";
		$order_by == '' ? $order_by = 'id' : true;
		$order_by2 == '' ? $order_by2 = 'asc' : true;
		$sql_count = "select count(*) ".$sql;
		$sql .= " order by $order_by $order_by2 ";
		$sql .= "limit $start, $pagesize ";
		$sql = $columns.$sql;
		$result = $cms->db_query($sql);
		$reccnt = $cms->db_scalar($sql_count);
	}
	//echo $sql;die;
?>
<div class="row">
	<div class="col-sm-12">
		<div class="white-box">
			<div class="col-sm-12">
				<div class="table-responsive">
					<table class="table table-striped1 table-bordered">
						<thead>
							<tr>
								<th align="center">Vendor Work Type</th>
								<th class="text-nowrap">Manage Steps</th>
							</tr>
						</thead>
						<tbody>
							<?php if($reccnt){ 
								$nums=$start+1; 
								while ($line = $result->fetch_array()){ 
								@extract($line);
							?>  
							<tr>								 
								<td class="table-center"><?=$vendor_work?></td>
								<td>
									<?php echo '<a href="'.SITE_PATH_ADM.CPAGE.'?mode=manage-steps&start='.$_GET['start'].'&id='.$id.'" data-toggle="tooltip" data-original-title="Manage Steps"><i class="fa fa-pencil text-inverse m-r-10"></i></a>'; ?>
								</td>
							</tr>
							<?php $nums++;} } else{ echo $adm->rowerror(5);}  ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="clearfix"></div>
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
function updateStatus(stepnum,current_status){
	$.ajax({
		url:"<?=SITE_PATH_ADM.CPAGE?>/ajaxChangeStatus.php",
		data:"stepnum="+stepnum+"&status="+current_status,
		method:"post"
	})
}
</script>
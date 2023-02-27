<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 
	//define('DEF_PAGE_SIZE', 100);

	$wid = $_GET['id'];
	if($action=='del'){
		$cms->db_query("update #_step_detail set is_deleted='1' where id in ($id)");
		$adm->sessset('Record has been deleted', 'e');
		$cms->redir(SITE_PATH_ADM.CPAGE.'?mode=manage-steps&start=&id='.$wid, true);
		exit;
	}
	
	if(isset($_REQUEST['submt'])){
		$conditionsQr = "";
				 
		$start = intval($start);
		$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
		$columns = "select * ";
		$sql = " from #_step_detail where 1=1 AND is_deleted=0 $conditionsQr ";
		$order_by == '' ? $order_by = 'step_num' : true;
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
		$sql = " from #_step_detail where 1=1 AND work_type=$wid AND is_deleted=0 ";
		$order_by == '' ? $order_by = 'id' : true;
		$order_by2 == '' ? $order_by2 = 'asc' : true;
		$sql_count = "select count(*) ".$sql; 
		$sql .= " order by $order_by $order_by2 ";
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
			<div class="col-sm-12">
				<div class="table-responsive">
					<table class="table table-striped1 table-bordered">
						<thead>
							<tr>
								<th align="center">Step Number</th>
								<th align="center">Step Name</th>
								<th class="text-nowrap">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php if($reccnt){ 
								$nums=$start+1; 
								while ($line = $result->fetch_array()){ 
								@extract($line);
							?>  
							<tr>								 
								<td class="table-center"><b>Step <?=$step_num?></b></td>
								<td class="table-center"><?=$step_title?></td>
								<?php $checked2=($status=="1"?"checked":""); ?>
								<td class="text-nowrap">
									<?php echo '<a href="'.SITE_PATH_ADM.CPAGE.'?mode=add&start='.$_GET['start'].'&wid='.$wid.'&id='.$step_num.'&step_num='.$step_num.'" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil text-inverse m-r-10"></i></a>'; ?>&nbsp;&nbsp;
									<a href="<?=SITE_PATH_ADM.CPAGE?>?mode=manage-steps&id=<?=$id?>&action=del&view=true" onclick="return confirm('Do you want delete this record?');" data-toggle="tooltip" data-original-title="Close"><i class="fa fa-close text-danger"></i></a> 
									&nbsp;&nbsp;
									<input data-size="small" type="checkbox" onChange="updateStatus('<?=$step_num?>','<?=$status?>')" <?=$checked2?> class="js-switch" data-toggle="tooltip" data-color="#99d683" data-secondary-color="#f96262" />
									
								</td>
							</tr>
							<?php    $nums++;} } else{ echo $adm->rowerror(5);}  ?>
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
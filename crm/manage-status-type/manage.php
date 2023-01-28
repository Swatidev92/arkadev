<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 
if($action=='del'){	 
	$return=$cms->db_query("update #_lead_type_status set is_deleted='1' where id in ($id)");
	$adm->sessset('Record has been deleted', 'e');
	$cms->redir(SITE_PATH_ADM.CPAGE, true);
	exit;
}

$start = intval($_GET['start']);
$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
$columns = "SELECT * ";
$sql = " FROM #_lead_type_status WHERE 1=1 AND is_deleted=0 AND lead_type=1 ";
$order_by == '' ? $order_by = 'lead_status' : true;
$order_by2 == '' ? $order_by2 = 'ASC' : true;
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
	<div class="col-sm-6">
		<div class="white-box">		
			<div class="table-responsive">
				<h2 class="text-center">Status</h2>
				<table class="table table-bordered table-striped">
					<tbody>
						<?php if($reccnt){ 
							$nums=$start+1; 
							while ($line = $result->fetch_array()){ 
							@extract($line);
						?>  
						<tr>
							<td class="table-center"><?=$lead_status?></td>
							<td class="text-nowrap">
								<?php $checked=($status=="1"?"checked":""); ?>								
								<?php if($id>16 && $lead_type==1){ ?>
								<input data-size="small" type="checkbox" onChange="updateStatus('<?=$id?>','<?=$status?>')" <?=$checked?> class="js-switch"  data-toggle="tooltip" title="Change Status" data-color="#99d683" data-secondary-color="#f96262" />&nbsp;&nbsp;
								<?php } ?>
								<?=$adm->action_e(SITE_PATH_ADM.CPAGE."?mode=add&start=".$_GET['start'],$id)?>
							</td>							
						</tr>
						<?php    $nums++;} } else{ echo $adm->rowerror(6);}  ?>
					</tbody>
				</table>
			</div>
			<?php include("../inc/paging.inc.php")?>  	
			<div class="clearfix"></div>
		</div>
	</div>
	
	<?php $start = intval($_GET['start']);
	$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
	$columns = "SELECT * ";
	$sql = " FROM #_lead_type_status WHERE 1=1 AND is_deleted=0 AND lead_type=2 ";
	$order_by == '' ? $order_by = 'lead_status' : true;
	$order_by2 == '' ? $order_by2 = 'ASC' : true;
	$sql_count = "SELECT count(*) ".$sql; 
	$sql .= " order by $order_by $order_by2 ";
	$sql .= " limit $start, $pagesize ";
	$sql = $columns.$sql;
	$result = $cms->db_query($sql);
	$numRows = $result->num_rows; 
	$reccnt2 = $cms->db_scalar($sql_count);
	?>
	<div class="col-sm-6">
		<div class="white-box">
			<h2 class="text-center">Lead Type</h2>
			<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<tbody>
						<?php if($reccnt2){ 
							$nums=$start+1; 
							while ($line = $result->fetch_array()){ 
							@extract($line);
						?>  
						<tr>
							<td class="table-center"><?=$lead_status?></td>
							<td class="text-nowrap">
							<?php $checked=($status=="1"?"checked":""); ?>
							<input data-size="small" type="checkbox" onChange="updateStatus('<?=$id?>','<?=$status?>')" <?=$checked?> class="js-switch"  data-toggle="tooltip" title="Change Status" data-color="#99d683" data-secondary-color="#f96262" />&nbsp;&nbsp;
							<?=$adm->action_e(SITE_PATH_ADM.CPAGE."?mode=add&start=".$_GET['start'],$id)?>
							</td>						
						</tr>
						<?php    $nums++;} } else{ echo $adm->rowerror(6);}  ?>
					</tbody>
				</table>
			</div>
			<?php include("../inc/paging.inc.php")?>  	
			<div class="clearfix"></div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function updateStatus(id,current_status){
		$.ajax({
			url:"<?=SITE_PATH_ADM.CPAGE?>/ajaxChangeStatus.php",
			data:"id="+id+"&status="+current_status,
			method:"post"
		})
	}
</script>
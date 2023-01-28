<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 
	//define('DEF_PAGE_SIZE', 100);

	if($action=='del'){
		$deleted = $cms->db_query("delete from #_media_files where media_category= $id ");
		$cms->db_query("update #_media_category set is_deleted='1' where id in ($id)");
		$adm->sessset('Record has been deleted', 'e');
		$cms->redir(SITE_PATH_ADM.CPAGE, true);
		exit;
	}
	
	if(isset($_REQUEST['submt'])){
		$conditionsQr = "";
				 
		$start = intval($start);
		$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
		$columns = "select * ";
		$sql = " from #_media_category where 1=1 AND is_deleted=0 AND lead_id=0 $conditionsQr ";
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
		$columns = "SELECT * ";
		$sql = " FROM #_media_files where media_category=1 AND lead_id=0 ";
		$order_by == '' ? $order_by = 'id' : true;
		$order_by2 == '' ? $order_by2 = 'asc' : true;
		$sql_count = "select count(*) ".$sql; 
		$sql .= " order by $order_by $order_by2 ";
		$sql .= "limit $start, $pagesize ";
		$sql = $columns.$sql;
		$fileQry = $cms->db_query($sql);
		$reccnt = $cms->db_scalar($sql_count);
	}
	//echo $reccnt;
?>
<div class="row">
	<div class="col-sm-12">
		<div class="white-box">
			<div class="col-sm-12">
				<div class="table-responsive">
					<table class="table table-striped1 table-bordered">
						<thead>
							<tr>
								<th align="center">All Files</th>
								<th class="text-nowrap">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php if($reccnt){ 
								$nums=$start+1; 
								while ($fileRes = $fileQry->fetch_array()){ 
								//@extract($line);
							?>  
							<tr id="<?=$fileRes['id']?>">
								<td class="table-center">
									<b><?=$fileRes['media_title']?$fileRes['media_title'].' - ':''?></b> <?=$fileRes['media_name']?>&nbsp;&nbsp; 
									<a href="<?=SITE_PATH?>uploaded_files/media/<?=$fileRes['media_name']?>" download>&nbsp;&nbsp; View</a>
								</td>
								<td>
									<a href="javascript:void(0)" class="remove_icon" onClick="remove_file('<?=$fileRes['id']?>','<?=$fileRes['media_name']?>')" data-toggle="tooltip" data-original-title="Delete File"><img src="<?=SITE_PATH_ADM?>images/close-btn.png"></a>
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
<script>
function remove_file(id,name){
	if (confirm("Are you sure to delete?")) {
		$.ajax({
			type:"post",
			url: "<?=SITE_PATH_ADM.CPAGE?>/remove_file.php?id="+id+"&name="+name,
			success:function(result){
				if(parseInt(result)=='1'){
					$("#"+id).hide();
					//location.reload();
				}
				else{
					alert("Something went wrong.Pleas try again.")
				}
			}
		})
	}
}	
</script>
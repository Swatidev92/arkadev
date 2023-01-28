<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 
	if($action=='del'){
		$cms->db_query("update #_recent_projects set is_deleted = '1' where id in ($id)");
		$adm->sessset('Record has been deleted', 'e');
		$cms->redir(SITE_PATH_ADM.CPAGE, true);
		exit;
	}
	if($cms->is_post_back()){
		if($arr_ids) {
			$str_adm_ids = implode(",",$arr_ids);
			switch ($_POST['action']){
				case "delete":
					$cms->db_query("update #_recent_projects set is_deleted = '1' where id in ($str_adm_ids)");
					$adm->sessset(count($arr_ids).' Item(s) Delete', 'e');
					break;
				case "Inactive":
					$cms->db_query("update #_recent_projects set status = '0' where id in ($str_adm_ids)");
					$adm->sessset(count($arr_ids).' Item(s) Inactive', 'e');
					break;
				case "Active":
					$cms->db_query("update #_recent_projects set status = '1' where id in ($str_adm_ids)");
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
			$conditionsQr .= " AND project_name LIKE '%$name_search%'";
		}
		
		$start = intval($start);
		$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
		$columns = "select * ";
		$sql = " from #_recent_projects where 1=1  $conditionsQr ";
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
		$sql = " from #_recent_projects ";
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
				<input type="hidden" name="method" id="method" value="GET"/>
				<div class="form-group col-sm-3">
					<input type="text" name="name_search" id="name_search" value="<?=$name_search?>" class="form-control" placeholder="Name" data-fv-regexp="true" data-error="Please enter at least 3 alphabetes">
					<div class="help-block with-errors"></div>
				</div>
				 
				<?php if(isset($_REQUEST['submt'])){ ?>
				
				<div class="form-group col-sm-1">
					<a href="<?=SITE_PATH_ADM.CPAGE?>" class="ub">
					<img src="<?=SITE_PATH_ADM?>images/back.png" alt=""></a>
				</div>
				<?php } ?>
				<div class="form-group col-sm-3">
					<input type="submit" name="submt" onClick="changeMethod()" value="Search" class="btn btn-primary">
					
					<a href="<?=SITE_PATH_ADM.CPAGE?>" class="btn btn-primary">Reset</a>
				</div>
				 
			</div>
			<div class="clearfix"></div>
			<div class="col-sm-12">&nbsp;</div> 
			<div class="clearfix"></div>
			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th width="8%">
								<div class="">
									<label for="checkbox3"> Sr.</label>
								</div>
							</th>
      
							<th align="center">Project Name</th>
							<th align="center">Project Type</th>
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
							<td class="table-center">
								<div class="">
									<label for="checkbox3"> <?=$nums?></label>
								</div>
							</td>
							<td class="table-center"><?=$project_name?></td>
							<td class="table-center"><?=$project_type?></td>
							
							<td class="text-nowrap">
								<?php
								echo $adm->action_e(SITE_PATH_ADM.CPAGE."?mode=add&start=".$_GET['start'],$id);
								?>
								
								<?php $checked=($status=="1"?"checked":""); ?>
								<input data-size="small" type="checkbox" onChange="updateStatus('<?=$id?>','<?=$status?>')" <?=$checked?> class="js-switch"  data-toggle="tooltip" title="Change Status" data-color="#99d683" data-secondary-color="#f96262" />
							</td>
						</tr>
						<?php    $nums++;} } else{ echo $adm->rowerror(5);}  ?>
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
function updateStatus(id,current_status){
	$.ajax({
		url:"<?=SITE_PATH_ADM.CPAGE?>/ajaxChangeStatus.php",
		data:"id="+id+"&status="+current_status,
		method:"post"
	})
}
</script>
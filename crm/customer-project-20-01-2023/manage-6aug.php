<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 
	if($action=='del'){
		$cms->db_query("update #_customer_project set is_deleted='1' where id in ($id)");
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
					$cms->db_query("update #_customer_project set is_deleted='1' where id in ($str_adm_ids)");
					$adm->sessset(count($arr_ids).' Item(s) Delete', 'e');
					break;
				case "Inactive":
					$cms->db_query("update #_customer_project set status = '0' where pid in ($str_adm_ids)");
					$adm->sessset(count($arr_ids).' Item(s) Inactive', 'e');
					break;
				case "Active":
					$cms->db_query("update #_customer_project set status = '1' where pid in ($str_adm_ids)");
					$adm->sessset(count($arr_ids).' Item(s) Active', 's');
					break;
				default:
			}
		}
		$cms->redir(SITE_PATH_ADM.CPAGE, true);
		exit;
	}
	if($_SESSION["ses_adm_role"]==3){
		$agentQry = " AND sale_rep_id=".$_SESSION["ses_adm_id"]." ";
	}else{
		$agentQry = "";
	}
	if(isset($_REQUEST['submt'])){
		$conditionsQr = "";
		if(!empty($_REQUEST['name_search'])){
			$name_search = $cms->escape_string($_REQUEST['name_search']);
			$conditionsQr .= " AND project_name like '%$name_search%'";
		}
		if(!empty($_REQUEST['search_sales'])){
			$search_sales = $cms->escape_string($_REQUEST['search_sales']);
			$conditionsQr .= " AND sale_rep_id=$search_sales";
		}
		if(!empty($_REQUEST['search_manager'])){
			$search_manager = $cms->escape_string($_REQUEST['search_manager']);
			$conditionsQr .= " AND project_manager_id=$search_manager";
		}
		 
		$start = intval($start);
		$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
		$columns = "select * ";
		$sql = " from #_customer_project where 1=1 AND is_deleted=0 $conditionsQr $agentQry ";
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
		$sql = " from #_customer_project where 1=1 AND is_deleted=0 $agentQry ";
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
				<div class="col-sm-3">
					<input type="text" name="name_search" id="name_search" value="<?=$name_search?>" class="form-control" placeholder="Project Name" data-fv-regexp="true">
					<div class="help-block with-errors"></div>
				</div>
				
				<div class="col-sm-2">
					<input type="submit" name="submt" onClick="changeMethod()" value="Search" class="btn search-btn">
					<a href="<?=SITE_PATH_ADM.CPAGE?>" class="btn reset-btn">Reset</a>
				</div>
			</div>
			<div class="clearfix"></div>
		
			<div class="table-responsive">
				<table class="table table-striped1 table-bordered1 table hover">
					<thead>
						<tr>      
							<th align="center">Customer Name</th>
							<th>Address</th>
							<th>City</th>
							<th>Project Manager</th>
							<th class="text-nowrap">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php if($reccnt){ 
							$nums=$start+1; 
							while ($line = $result->fetch_array()){ 
							@extract($line);
							$cust_name = $cms->getSingleResult("SELECT customer_name FROM #_leads where id=$cust_id ");
						?>  
						<tr>							 
							<td class="table-center"><?=$cust_name?></td>
							<td class="table-center"><?=$project_address?></td>
							<td class="table-center"><?=$project_city?></td>
							<td class="table-center"><?=$project_manager_id?$cms->getSingleResult("SELECT customer_name FROM #_users where id=$project_manager_id "):''?></td>
							<td class="text-nowrap">
								<?php if($_SESSION["ses_adm_role"]==1 || ($_SESSION["ses_adm_role"]!=1 && $_SESSION["ses_adm_role"]==4 && $_SESSION["ses_adm_usr"]!='')){?>
								<?=$adm->action_e(SITE_PATH_ADM.CPAGE."?mode=add&start=".$_GET['start'],$id)?>
								
								<?=$adm->action_d(SITE_PATH_ADM.CPAGE."?mode=add&start=".$_GET['start'],$id)?>
								&nbsp;
								<?php }else{?>
								<a href="<?=SITE_PATH_ADM.CPAGE?>?mode=view&start=<?=$_GET['start']?>&id=<?=$id?>" data-toggle="tooltip" title="View proposal"><i class="fa fa-eye text-inverse m-r-10"></i></a>	
								<?php }if($project_report_name && file_exists(FILES_PATH.'reports/'.$project_report_name)){?>
								<a href="<?=SITE_PATH.'uploaded_files/reports/'.$project_report_name?>" download title="Report"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
								<?php } ?>
							</td>
						</tr>
						<?php    $nums++;} } else{ echo $adm->rowerror(8);}  ?>
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
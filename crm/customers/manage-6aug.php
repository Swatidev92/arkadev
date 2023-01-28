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
		if(!empty($_REQUEST['name_search'])){
			$name_search = $cms->escape_string($_REQUEST['name_search']);
			$conditionsQr .= " AND customer_name like '%$name_search%'";
		}
		if(!empty($_REQUEST['email_search'])){
			$email_search = $cms->escape_string($_REQUEST['email_search']);
			$conditionsQr .= " AND email='$email_search'";
		}
		if(!empty($_REQUEST['phone_search'])){
			$phone_search = $cms->escape_string($_REQUEST['phone_search']);
			$conditionsQr .= " AND phone='$phone_search'";
		}
		 
		$start = intval($start);
		$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
		$columns = "select * ";
		$sql = " from #_leads where 1=1 AND is_deleted=0 AND status=4 AND lead_id>0 $conditionsQr ";
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
?>
<div class="row">
	<div class="col-sm-12">
		<div class="white-box">
			<div class="Search FORM">
				<div class="col-sm-3">
					<input type="text" name="name_search" id="name_search" value="<?=$name_search?>" class="form-control" placeholder="Customer Name" data-fv-regexp="true">
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-sm-3">
					<input type="email" name="email_search" id="email_search" value="<?=$email_search?>" class="form-control" placeholder="Email" data-fv-regexp="true">
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-sm-3">
					<input type="text" name="phone_search" id="phone_search" value="<?=$phone_search?>" class="form-control" placeholder="Contact Number" data-fv-regexp="true">
					<div class="help-block with-errors"></div>
				</div>
				
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
							<th>Date</th>
							<th align="center">Customer Name</th>
							<th>Address</th>
							<th>Personnummer</th>
							<th>Status</th>
							<th>Sale Rep</th>
							<?php if($_SESSION["url"][$Sys_Gl_module_id][0]!='' || $_SESSION["ses_adm_id"]==1){?>
							<th class="text-nowrap">Action</th>
							<?php } ?>
						</tr>
					</thead>
					<tbody>
						<?php if($reccnt){ 
							$nums=$start+1; 
							while ($line = $result->fetch_array()){ 
							@extract($line);
						?>  
						<tr>
							<td class="table-center text-nowrap"><?=date("Y-m-d",strtotime($post_date))?></td>
							<td class="table-center"><?=$customer_name?></td>
							<td class="table-center"><?=$proposal_address?></td>
							<td class="table-center"><?=$personnummer?></td>
							<td class="table-center"><?=$cms->getSingleResult("SELECT lead_status FROM #_lead_type_status where constant=$status AND lead_type=1 ")?></td>
							<td class="table-center text-nowrap"><?=$cms->getSingleResult("SELECT customer_name FROM #_users WHERE id='$assigned_to' AND id!=1 ")?></td>
							<?php if($_SESSION["url"][$Sys_Gl_module_id][0]!='' || $_SESSION["ses_adm_id"]==1){?>
							<td class="text-nowrap">
								<?php if(in_array($act_arr[1],$_SESSION["url"][$Sys_Gl_module_id]) || $_SESSION["ses_adm_id"]==1){?>
								<?=$adm->action_e(SITE_PATH_ADM.CPAGE."?mode=add&start=".$_GET['start'],$id)?>
								<?php } ?>
							</td>
							<?php } ?>
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
<script type="text/javascript">
function updateApprovedStatus(id,current_status){
	$.ajax({
		url:"<?=SITE_PATH_ADM.CPAGE?>/ajaxChangeStatus.php",
		data:"id="+id+"&status="+current_status,
		method:"post"
	})
}
</script>
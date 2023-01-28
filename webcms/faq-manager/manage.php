<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 
	if($action=='del'){
		$return=$cms->db_query("delete from #_faqs where id in ($id)");
		if($return===-1){ //-1 used Foreign Key Message
			$adm->sessset(foreignKeyErrorMsg, 'e');
		}else{
			$adm->sessset('Record has been deleted', 'e');
		}
		//$cms->redir(SITE_PATH_ADM.CPAGE, true);
		//exit;
	}
	if($cms->is_post_back()){
		if($arr_ids) {
			$str_adm_ids = implode(",",$arr_ids);
			switch ($_POST['action']){
				case "delete":
					$return=$cms->db_query("delete from #_faqs where id in ($str_adm_ids)");  
					if($return===-1){ //-1 used Foreign Key Message
						$adm->sessset(count($arr_ids)." Record(s) ".foreignKeyErrorMsg, 'e');
					}else{
						$adm->sessset(count($arr_ids).' Item(s) Delete', 'e');
					}
					break;
				case "Inactive":
					$cms->db_query("update #_faqs set status = '0' where id in ($str_adm_ids)");
					$adm->sessset(count($arr_ids).' Item(s) Inactive', 'e');
					break;
				case "Active":
					$cms->db_query("update #_faqs set status = '1' where id in ($str_adm_ids)");
					$adm->sessset(count($arr_ids).' Item(s) Active', 's');
					break;
				default:
			}
		}
		//$cms->redir(SITE_PATH_ADM.CPAGE, true);
		//exit;
	} 
	if(isset($_REQUEST['submt'])){
		$conditionsQr = "";
		if(!empty($_REQUEST['name_search'])){
			$name_search = $cms->escape_string($_REQUEST['name_search']);
			$conditionsQr .= " AND question LIKE '%$name_search%'";
		}
		$start = intval($_GET['start']);
		$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
		$columns = "SELECT `id`, `question`, answer, cat_ids, `status`, `is_deleted`, `create_date` ";
		$sql = " FROM #_faqs WHERE 1=1 ".$conditionsQr." ";
		$order_by == '' ? $order_by = 'id' : true;
		$order_by2 == '' ? $order_by2 = 'DESC' : true;
		$sql_count = "SELECT count(*) ".$sql; 
		$sql .= "order by $order_by $order_by2 ";
		$sql .= "limit $start, $pagesize ";
		$sql = $columns.$sql;
		$result = $cms->db_query($sql);
		$reccnt = $cms->db_scalar($sql_count);
	}else { 
		$start = intval($_GET['start']);
		$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
		$columns = "SELECT `id`, `question`, answer, cat_ids, `status`, `is_deleted`, `create_date` ";
		$sql = " FROM #_faqs  WHERE 1 ";
		$order_by == '' ? $order_by = 'id' : true;
		$order_by2 == '' ? $order_by2 = 'DESC' : true;
		$sql_count = "SELECT count(*) ".$sql; 
		$sql .= "order by $order_by $order_by2 ";
		$sql .= "limit $start, $pagesize ";
		$sql = $columns.$sql;
		$result = $cms->db_query($sql);
		$numRows = $result->num_rows; 
		$reccnt = $cms->db_scalar($sql_count);
		 
	}
?>

	<!-- .row -->
<div class="row">
	<div class="col-sm-12">
		<div class="white-box">
			<div class="Search FORM">
				<div class="form-group col-sm-3">
					<input type="text" name="name_search" id="name_search" title="Question Name" value="<?=$name_search?>" class="form-control" id="inputName1" placeholder="Question Name" data-fv-regexp="true">
					<div class="help-block with-errors"></div>
				</div>
				 
				
				<div class="form-group col-sm-2">
					<input type="submit" name="submt" onClick="changeMethod()" value="Search" class="btn btn-primary">
					<a href="<?=SITE_PATH_ADM.CPAGE?>" class="btn btn-primary">Reset</a>
				</div>
				<div class="form-group col-sm-6">
					 
				</div>
				<?php if(isset($_REQUEST['submt'])){ ?>
				<div class="form-group col-sm-1">
					<a href="<?=SITE_PATH_ADM.CPAGE?>" class="ub">
					<img src="<?=SITE_PATH_ADM?>images/back.png" alt=""></a>
				</div>
				<?php } ?>
			</div>
			<div class="clearfix"></div>
			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>
								<div class="checkbox checkbox-success">
									<?=$adm->check_all()?>
									<label for="checkbox3"> Sr.</label>
								</div>
							</th>
							<th>FAQ</th>
							<th>Service</th>
							<th>Status</th>
							<th>Action</th>
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
								<div class="checkbox checkbox-success">
									<?=$adm->check_input($id)?>
									<label for="checkbox3"> <?=$nums?></label>
								</div>
							</td>
							<td class="table-center"><?=$question?></td>
							<td class="table-center"> 
							<?php if($cat_ids!=''){
								$catNames='';
							?> 
							<?php  $cat_idArr = explode(",", $cat_ids); ?> 
							<?php  foreach($cat_idArr as $cat_id){ ?> 
								<?php  if(array_key_exists($cat_id, $catArr)){ ?> 
									 <?php $catNames .= $catArr[$cat_id].",<br>"; ?>
								<?php } ?>
							<?php } ?>
								<?=rtrim($catNames,',<br>');?>
							<?php } ?>
							</td>
							<?php $checked=($status=="1"?"checked":""); ?>
							<td><input data-size="small" type="checkbox" onChange="updateStatus('<?=$id?>','<?=$status?>')" <?=$checked?> class="js-switch"  data-toggle="tooltip" title="Change Status" data-color="#99d683" data-secondary-color="#f96262" /></td>
							<td class="table-center">
							<?=$adm->action(SITE_PATH_ADM.CPAGE."?mode=add&start=".$_GET['start'],$id)?> &nbsp;&nbsp;
							</td>
						</tr>
						<?php    $nums++;} } else{ echo $adm->rowerror(7);}  ?>
					</tbody>
				</table>
			</div>
			<?php include("../inc/paging.inc.php")?> 
		</div>
	</div>
</div>
<!-- /.row -->
<script type="text/javascript">
function updateStatus(id,current_status){
	$.ajax({
		url:"<?=SITE_PATH_ADM.CPAGE?>/ajaxChangeStatus.php",
		data:"id="+id+"&status="+current_status,
		method:"post"
	})
}
</script>
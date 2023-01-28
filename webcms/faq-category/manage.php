<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 
	if($action=='del'){
		$cms->db_query("delete from #_faq_categories where id in ($id)");
		$adm->sessset('Record has been deleted', 'e');
		$cms->redir(SITE_PATH_ADM.CPAGE, true);
		exit;
	}
	if($cms->is_post_back()){
		if($arr_ids) {
			$str_adm_ids = implode(",",$arr_ids);
			switch ($_POST['action']){
				case "delete":
					$cms->db_query("delete from #_faq_categories where id in ($str_adm_ids)");
					$adm->sessset(count($arr_ids).' Item(s) Delete', 'e');
					break;
				case "Inactive":
					$cms->db_query("update #_faq_categories set status = '0' where pid in ($str_adm_ids)");
					$adm->sessset(count($arr_ids).' Item(s) Inactive', 'e');
					break;
				case "Active":
					$cms->db_query("update #_faq_categories set status = '1' where pid in ($str_adm_ids)");
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
			$conditionsQr .= " AND cat_name LIKE '%$name_search%'";
		}
		if(!empty($_REQUEST['lang_serach'])){
			$lang_serach = $cms->escape_string($_REQUEST['lang_serach']);
			$conditionsQr .= " AND lang_id='$lang_serach'";
		}  
		 
		$start = intval($start);
		$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
		$columns = "select * ";
		$sql = " from #_faq_categories where 1=1 AND is_deleted=0 $conditionsQr ";
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
		$sql = " from #_faq_categories where 1=1 AND is_deleted=0 ";
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
				<input type="hidden" name="method" id="method" value="GET"/>
				<div class="form-group col-sm-3">
					<input type="text" name="name_search" id="name_search" title="Category  Name" value="<?=$name_search?>" class="form-control"  placeholder="Category  Name" data-fv-regexp="true" pattern="[A-Za-z &.- ]{3,150}"  data-error="Please enter at least 3 alphabetes">
					<div class="help-block with-errors"></div>
				</div>
				
				<div class="form-group col-sm-6">
					<input type="submit" name="submt" onClick="changeMethod()" value="Search" class="btn btn-primary">
					
					<a href="<?=SITE_PATH_ADM.CPAGE?>" class="btn btn-primary">Reset</a>
				</div>
				<?php if(isset($_REQUEST['submt'])){ ?>
				
				<div class="form-group col-sm-1">
					<a href="<?=SITE_PATH_ADM.CPAGE?>" class="ub">
					<img src="<?=SITE_PATH_ADM?>images/back.png" alt=""></a>
				</div>
				<?php } ?>
				<div class="clearfix"></div>
				
				 
			</div>
			<div class="clearfix"></div>
			<div class="col-sm-12">&nbsp;</div>  
			<div class="clearfix"></div>
			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th width="8%">
								<div class="checkbox checkbox-success">
									<?=$adm->check_all()?>
									<label for="checkbox3"> Sr.</label>
								</div>
							</th>
      
							<th align="center">Category Name</th>
							 
							<th align="center">Status</th>
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
								<div class="checkbox checkbox-success">
									<?=$adm->check_input($id)?>
									<label for="checkbox3"> <?=$nums?></label>
								</div>
							</td>
							 
							<td class="table-center"><?=$cat_name?></td>
							<?php $checked2=($status=="1"?"checked":""); ?>
							<td><input data-size="small" type="checkbox" onChange="updateStatus('<?=$id?>','<?=$status?>')" <?=$checked2?> class="js-switch"  data-toggle="tooltip" title="Change Status" data-color="#99d683" data-secondary-color="#f96262" /></td>
							<td class="text-nowrap">
							<?php
							echo $adm->action_e(SITE_PATH_ADM.CPAGE."?mode=add&start=".$_GET['start'],$id);
							?> </td>
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
			data:"id="+id+"&status="+current_status+"&table_name=blog_catagories",
			method:"post"
		})
	}
</script>
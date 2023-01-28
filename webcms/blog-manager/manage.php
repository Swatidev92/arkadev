<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 
	if($action=='del'){
		$cms->db_query("update #_blogs set is_deleted = '1' where id in ($id)");
		$adm->sessset('Record has been deleted', 'e');
		$cms->redir(SITE_PATH_ADM.CPAGE, true);
		exit;
	}
	if($cms->is_post_back()){
		if($arr_ids) {
			$str_adm_ids = implode(",",$arr_ids);
			switch ($_POST['action']){
				case "delete":
					$cms->db_query("update #_blogs set is_deleted = '1' where id in ($str_adm_ids)");
					$adm->sessset(count($arr_ids).' Item(s) Delete', 'e');
					break;
				case "Inactive":
					$cms->db_query("update #_blogs set status = '0' where id in ($str_adm_ids)");
					$adm->sessset(count($arr_ids).' Item(s) Inactive', 'e');
					break;
				case "Active":
					$cms->db_query("update #_blogs set status = '1' where id in ($str_adm_ids)");
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
			$conditionsQr .= " AND title LIKE '%$name_search%'";
		}
		if(!empty($_REQUEST['category_search'])){
			$category_search = $cms->escape_string($_REQUEST['category_search']);
			$conditionsQr .= " AND FIND_IN_SET(".$category_search.", cat_id) " ;
		}
		if(!empty($_REQUEST['tag_search'])){
			$tag_search = $cms->escape_string($_REQUEST['tag_search']);
			$conditionsQr .= " AND tag_id like '%$tag_search%'" ;
		}
		
		$start = intval($start);
		$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
		$columns = "select * ";
		$sql = " from #_blogs where 1=1 AND is_deleted=0 $conditionsQr ";
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
		$sql = " from #_blogs where 1=1 AND is_deleted=0 ";
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
<?=$cms->sform((($mode)?'onsubmit="return formvalid(this)"':'onsubmit="return formvalid(this)"'));?>
<div class="row">
	<div class="col-sm-12">
		<div class="white-box">
			<div class="Search FORM">
				<input type="hidden" name="method" id="method" value="GET"/>
				<div class="form-group col-sm-3">
					<input type="text" name="name_search" id="name_search" title="Blog Title" value="<?=$name_search?>" class="form-control" placeholder="Blog Title" data-fv-regexp="true"  data-error="Please enter at least 3 alphabetes">
					<div class="help-block with-errors"></div>
				</div>
				<!--<div class="form-group col-sm-3">
					<select class="form-control" name="category_search" >
						<option value="">Select Category</option>
						<?php /*foreach($catArr as $catKey => $catValue){ ?>
						<option value="<?=$catKey?>" <?=(($catKey==$category_search)?'selected="selected"':'')?>><?=$catValue?></option>
						<?php }*/ ?>
					</select>
					<div class="help-block with-errors"></div>
				</div>-->
				<!--<div class="form-group col-sm-3">
				<input type="text" name="tag_search" value="<?=$tag_search?>" class="form-control" placeholder="Search by Tag" data-fv-regexp="true">
					<div class="help-block with-errors"></div>
				</div>-->				
				 
				 
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
								<div class="checkbox checkbox-success">
									<?=$adm->check_all()?>
									<label for="checkbox3"> Sr.</label>
								</div>
							</th>
      
							<th align="center">Page Title</th>
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
							<td class="table-center"><?=$title?></td>
							
							<?php $checked2=($status=="1"?"checked":""); ?>
							<td><input data-size="small" type="checkbox" onChange="updateStatus('<?=$id?>','<?=$status?>')" <?=$checked2?> class="js-switch"  data-toggle="tooltip" title="Change Status" data-color="#99d683" data-secondary-color="#f96262" /></td>	
								<!--<td class="center"><?php if($status==1)echo '<span class="label label-success">Active</span>';else echo '<span class="label label-danger">Inactive</span>';?></td>-->
							<td class="text-nowrap">
								<?php
								echo $adm->action_e(SITE_PATH_ADM.CPAGE."?mode=add&start=".$_GET['start'],$id);
								?>
								<a href="<?=SITE_PATH?>blog-detail/<?=$url?>" target="_blank">Preview</a>
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
	function updateHomeStatus(id,current_status){
		$.ajax({
			url:"<?=SITE_PATH_ADM.CPAGE?>/ajaxChangeHomeStatus.php",
			data:"id="+id+"&status="+current_status,
			method:"post"
		})
	}
	function updateFeaturedStatus(id,current_status){
		$.ajax({
			url:"<?=SITE_PATH_ADM.CPAGE?>/ajaxChangeFeaturedStatus.php",
			data:"id="+id+"&status="+current_status,
			method:"post"
		})
	}
</script>
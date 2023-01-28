<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 
$conditionsQr = "";
$mode = "edit";
if($_GET['helpcat_id']!='' && $_GET['mode']=='view'){
	$helpcat_id = $_GET['helpcat_id'];
	$conditionsQr .= " AND id = '$helpcat_id' ";
	$mode = "viewhelp";
}
	define('DEF_PAGE_SIZE', 10);
	if($action=='del'){
		$cms->db_query("update #_help_category set is_deleted = 0 where id in ($id)");
			
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
					$cms->db_query("delete from #_help_category where id in ($str_adm_ids)");  
					$adm->sessset(count($arr_ids).' Item(s) Delete', 'e');
					break;
				case "Inactive":
					$cms->db_query("update #_help_category set status = '0' where id in ($str_adm_ids)");
					$adm->sessset(count($arr_ids).' Item(s) Inactive', 'e');
					break;
				case "Active":
					$cms->db_query("update #_help_category set status = '1' where id in ($str_adm_ids)");
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
			$name_searchs = $cms->escape_string($_REQUEST['name_search']);
			$name_search=trim($name_searchs);
			$conditionsQr .= " AND help_name LIKE '%$name_search%' OR short_info LIKE '%$name_search%' ";
		}
		$start = intval($_GET['start']);
		$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
		$columns = "SELECT * ";
		$sql = " FROM #_help_category WHERE is_deleted=0 AND status=1 ".$conditionsQr." ";
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
		$columns = "SELECT * ";
		$sql = " FROM #_help_category WHERE is_deleted=0 AND status=1 ".$conditionsQr." ";
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
				<input type="hidden" name="method" id="method" value="GET"/>
				<div class="form-group col-sm-3">
					<input type="text" name="name_search" id="name_search" title="Search Name" value="<?=$name_search?>" class="form-control" placeholder="Search Help Name" data-fv-regexp="true" pattern="[A-Za-z &.- ]{3,150}" data-error="Please enter at least 3 alphabetes">
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
							<th>Help Name</th>				
							<th>All Page</th>				
							<!--<th>Status</th>				
							<th>Action</th>	-->			
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
							<td class="table-center"><?=$help_name?></td>
							<?php 
									$stepsQry=$cms->db_query("SELECT step FROM #_help_content where helpcat_id=$id  AND is_deleted=0 GROUP by step");
											if($stepsQry->num_rows>0){
												while($stepsRes=$stepsQry->fetch_array()){
													$allSteps[]=$stepsRes["step"];
												}
											}
							
										
							if(!empty($allSteps)){
							?>
							<td class="table-center">
								<ul>
									<?php foreach($allSteps as $step_id){?>
									<li><a href="<?=SITE_PATH_ADM.CPAGE."?mode=$mode&courseId=".$id."&step=".$step_id?>">Page <?=$step_id?></a></li>
									<?php } ?>
								</ul>
							</td>
							<?php } else{?>
							<td class="table-center">
								<a href="<?=SITE_PATH_ADM.CPAGE."?mode=add&courseId=".$id."&step=".$step_id?>">Add Page</a></li>
							</td>
							<?php } ?>
							<?php //$checked=($status=="1"?"checked":""); ?>
							<!--<td>
								<input data-size="small" type="checkbox" onChange="updateStatus('<?=$id?>','<?=$status?>')" <?=$checked?> class="js-switch" data-toggle="tooltip" title="Change Status" data-color="#99d683" data-secondary-color="#f96262" />
							</td>
							<td class="text-nowrap">
								<?=$adm->action_d(SITE_PATH_ADM.CPAGE."?mode=add&start=".$_GET['start'],$id)?> &nbsp;&nbsp;
								<?php $checked=($status=="1"?"checked":""); ?>
							</td>-->
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
	function updateStatus(id,current_status){
		$.ajax({
			url:"<?=SITE_PATH_ADM.CPAGE?>/ajaxChangeStatus.php",
			data:"id="+id+"&status="+current_status+"&table_name=courses",
			method:"post"
		})
	}
</script>

<?php
	function getAllHelp($helpcat_id){ 
		global $cms;
		$stepsQry=$cms->db_query("SELECT step FROM #_help_content where helpcat_id=$helpcat_id GROUP by step");
		if($stepsQry->num_rows>0){
			while($stepsRes=$stepsQry->fetch_array()){
				$allSteps[]=$stepsRes["step"];
			}
		}			
		return $allSteps;
	}
?>
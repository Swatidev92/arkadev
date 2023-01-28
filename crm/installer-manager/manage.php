<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 
	if($action=='del'){
		$cms->db_query("update #_vendor set is_deleted='1' where id in ($id)");
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
					$cms->db_query("update #_vendor set is_deleted='1' where id in ($str_adm_ids)");
					$adm->sessset(count($arr_ids).' Item(s) Delete', 'e');
					break;
				case "Inactive":
					$cms->db_query("update #_vendor set status = '0' where pid in ($str_adm_ids)");
					$adm->sessset(count($arr_ids).' Item(s) Inactive', 'e');
					break;
				case "Active":
					$cms->db_query("update #_vendor set status = '1' where pid in ($str_adm_ids)");
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
		if(!empty($_REQUEST['company_search'])){
			$company_search = $cms->escape_string($_REQUEST['company_search']);
			$conditionsQr .= " AND company_name like '%$company_search%'";
		}
		if(!empty($_REQUEST['person_search'])){
			$person_search = $cms->escape_string($_REQUEST['person_search']);
			$conditionsQr .= " AND contact_person_name like '%$person_search%'";
		}
		if(!empty($_REQUEST['email_search'])){
			$email_search = $cms->escape_string($_REQUEST['email_search']);
			$conditionsQr .= " AND email = '$email_search'";
		}
		if(!empty($_REQUEST['phone_search'])){
			$phone_search = $cms->escape_string($_REQUEST['phone_search']);
			$conditionsQr .= " AND phone=$phone_search";
		}
		if(!empty($_REQUEST['work_search'])){
			$work_search = $cms->escape_string($_REQUEST['work_search']);
			$conditionsQr .= " AND FIND_IN_SET($work_search,work_type)";
		}
		 
		$start = intval($start);
		$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
		$columns = "select * ";
		$sql = " from #_vendor where 1=1 AND is_deleted=0 $conditionsQr ";
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
		$sql = " from #_vendor where 1=1 AND is_deleted=0 ";
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
				<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
					<div class="panel">
						<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
							<a class="panel-title <?=$expanded=='true'?'':'collapsed'?>" data-toggle="collapse" href="#exampleCollapseDefaultThree1" data-parent="#exampleAccordionDefault" aria-expanded="<?=$expanded=='true'?'true':'false'?>" aria-controls="exampleCollapseDefaultThree1">Filter <i class="fa fa-filter" aria-hidden="true"></i></a> 
						</div>
						<div class="panel-collapse collapse <?=$expanded=='true'?'in':''?>" id="exampleCollapseDefaultThree1" aria-labelledby="exampleCollapseDefaultThree1" role="tabpanel">
							<div class="panel-body">
								<input type="hidden" name="expanded" value="true">
								<div class="col-sm-3">
									<input type="text" name="company_search" id="company_search" value="<?=$company_search?>" class="form-control" placeholder="Company Name" data-fv-regexp="true">
									<div class="help-block with-errors"></div>
								</div>
								<div class="col-sm-3">
									<input type="text" name="person_search" id="person_search" value="<?=$person_search?>" class="form-control" placeholder="Contact Person Name" data-fv-regexp="true">
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
								<div class="col-sm-3">
									<select class="form-control" name="work_search" id="work_search">
										<option value="">Select Work Type</option>
										<?php foreach($vendorWorkType as $wkey=>$wval){?>
										<option value="<?=$wkey?>"><?=$wval?></option>
										<?php } ?>
									</select>
								</div>
								
								<div class="form-group col-sm-2">
									<input type="submit" name="submt" onClick="changeMethod()" value="Search" class="btn search-btn">
									<a href="<?=SITE_PATH_ADM.CPAGE?>" class="btn reset-btn">Reset</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="col-sm-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>
								<div class="checkbox checkbox-success">
									<?=$adm->check_all()?>
									<label for="checkbox3">All</label>
								</div>
							</th>      
							<th align="center">Company Name</th>
							<th>Contact Person Name</th>
							<th>Email</th>
							<th>Phone</th>
							<th>Address</th>
							<th>City</th>
							<th>Work Type</th>
							<th align="center">Status</th>
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
							<td class="table-center">
								<div class="checkbox checkbox-success">
									<?=$adm->check_input($id)?>
									<label for="checkbox3"> <?=$nums?></label>
								</div>
							</td>
							 
							<td class="table-center"><?=$company_name?></td>
							<td class="table-center"><?=$contact_person_name?></td>
							<td class="table-center"><?=$email?></td>
							<td class="table-center"><?=$phone?></td>
							<td class="table-center"><?=$address?></td>
							<td class="table-center"><?=$city?></td>
							<td class="table-center"><?=$vendorWorkType[$work_type]?></td>
							<td class="table-center"><?=$installerStatus[$status]?></td>
							<td class="text-nowrap">
								<?=$adm->action_e(SITE_PATH_ADM.CPAGE."?mode=add&start=".$_GET['start'],$id)?>
								<?=$adm->action_d(SITE_PATH_ADM.CPAGE."?mode=add&start=".$_GET['start'],$id)?>
								<!--<a href="<?=SITE_PATH_ADM.CPAGE?>?mode=add&start=<?=$_GET['start']?>&id=<?=$id?>" data-toggle="tooltip" data-original-title="View"><i class="fa fa-eye text-inverse m-r-10"></i></a>-->
							</td>
						</tr>
						<?php $nums++;} } else{ echo $adm->rowerror(10);} ?>
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
function updateApprovedStatus(id,current_status){
	$.ajax({
		url:"<?=SITE_PATH_ADM.CPAGE?>/ajaxChangeStatus.php",
		data:"id="+id+"&status="+current_status,
		method:"post"
	})
}
</script>
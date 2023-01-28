<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 
	if($action=='del'){
		$cms->db_query("update #_users set is_deleted=1 where id in ($id)");
		$cms->db_query("delete from #_permissions where user_id in ($id)");				
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
					$cms->db_query("update #_users set is_deleted=1 where id in ($str_adm_ids)");
					$cms->db_query("delete from #_permissions where user_id in ($str_adm_ids)");					
					$adm->sessset(count($arr_ids).' Item(s) Delete', 'e');
					break;
				case "Inactive":
					$cms->db_query("update #_users set status = '0' where id in ($str_adm_ids)");
					$adm->sessset(count($arr_ids).' Item(s) Inactive', 'e');
					break;
				case "Active":
					$cms->db_query("update #_users set status = '1' where id in ($str_adm_ids)");
					$adm->sessset(count($arr_ids).' Item(s) Active', 's');
					break;
				default:
			}
		}
		$cms->redir(SITE_PATH_ADM.CPAGE, true);
		exit;
	} 
	if($_SESSION["ses_adm_role"]==5){
		$sessCon = " AND role!='5' ";
	}
	if(isset($_REQUEST['submt'])){
		
		if(!empty($_REQUEST['name_search'])){
			$name_search = $cms->escape_string($_REQUEST['name_search']);
			$conditionsQr .= " AND customer_name like '%$name_search%'";
		}
		if(!empty($_REQUEST['email_search'])){
			$email_search = $cms->escape_string($_REQUEST['email_search']);
			$conditionsQr .= " AND email_id='$email_search'";
		}
		if(!empty($_REQUEST['phone_search'])){
			$email_search = $cms->escape_string($_REQUEST['phone_search']);
			$conditionsQr .= " AND contact_no='$phone_search'";
		}
		if(!empty($_REQUEST['role'])){
			$role = $cms->escape_string($_REQUEST['role']);
			$conditionsQr .= " AND 	role ='$role'";
		}
		//$serchKeyword = mysql_real_escape_string($_REQUEST['SrchBx']);	
		$start = intval($_GET['start']);
		$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
		$columns = "SELECT `id`, `role`, `customer_name`, `email_id`, `contact_no`, `password`, `plain_password`, `address`, `address2`, `city`, `state_id`, `country_id`, `zip_code`, `status`, `create_date`, `update_date` ";
		$sql = " FROM #_users WHERE role!='1' AND is_deleted=0 $sessCon  ".$conditionsQr."";
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
		$sql = " FROM #_users WHERE role!='1' AND is_deleted=0 $sessCon";
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
	//echo $_SESSION["ses_adm_role"];
	//echo $sql;
?>

	<!-- .row -->
<div class="row">
	<div class="col-sm-12">
		<div class="white-box">
		<div class="Search FORM">
				<div class="form-group col-sm-2">
					<input type="text" name="name_search" id="name_search" title="Name" value="<?=$name_search?>" class="form-control" id="inputName1" placeholder="Name" data-fv-regexp="true">
					<div class="help-block with-errors"></div>
				</div>
				<div class="form-group col-sm-2">
					<input type="email" name="email_search" id="email_search" title="Email" value="<?=$email_search?>" class="form-control" id="inputName1" placeholder="Email" data-fv-regexp="true" >
					<div class="help-block with-errors"></div>
				</div> 
				<div class="form-group col-sm-2">
					<input type="text" name="phone_search" id="phone_search" title="Phone" value="<?=$phone_search?>" class="form-control" id="inputName1" placeholder="Phone" data-fv-regexp="true" >
					<div class="help-block with-errors"></div>
				</div> 
				<div class="form-group col-sm-2">
					<select class="form-control" name="role">
					<option value="">Select Role</option>	
					<?php foreach($roleArr as $rkey=>$rvalue){ 
					if($rkey!=2 && $rkey!=1 && $rkey!=4){ ?>
					<option value="<?=$rkey?>"><?=$rvalue?></option>
					<?php } } ?>
				</select>
				</div>
				<div class="form-group col-sm-3">
					<input type="submit" name="submt" onClick="changeMethod()" value="Search" class="btn btn-primary">
					<a href="<?=SITE_PATH_ADM.CPAGE?>" class="btn btn-primary">Reset</a>
				</div>
				<?php if($_SESSION["ses_adm_role"]!="1"){ ?>
				<div class="form-group col-sm-3"></div>
				<?php } ?>
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
							<th>User Name</th>
							 
							<th>Email</th>
							<th>Contact</th>
							<th>Role</th>
						 	<th>Status</th>
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
							<td class="table-center"><?=$customer_name?></td>
							<td class="table-center"><?=$email_id?></td>
							<td class="table-center"><?=$contact_no?></td>
							 
							<td class="table-center"><?=$roleArr[$role]?></td>
							<td class="text-nowrap">
								<?php $checked=($status=="1"?"checked":""); ?>								
								<input data-size="small" type="checkbox" onChange="updateStatus('<?=$id?>','<?=$status?>')" <?=$checked?> class="js-switch"  data-toggle="tooltip" title="Change Status" data-color="#99d683" data-secondary-color="#f96262" />
							</td>
							<td class="text-nowrap">
							<?php //if($_SESSION["ses_adm_role"]=="5") { ?>
							<?=$adm->action(SITE_PATH_ADM.CPAGE."?mode=add&start=".$_GET['start'],$id)?>
							<?php // } ?>
							<?php //if($_SESSION["ses_adm_role"]=="1") { ?>
							<?//=$adm->action(SITE_PATH_ADM.CPAGE."?mode=add&start=".$_GET['start'],$id)?> 
							<?php //} ?></td>
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
<script type="text/javascript">
function updateStatus(id,current_status){
	$.ajax({
		url:"<?=SITE_PATH_ADM.CPAGE?>/ajaxChangeStatus.php",
		data:"id="+id+"&status="+current_status,
		method:"post"
	})
}
</script>

<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 
$_SESSION['REFERER_page']='';
	if(isset($_GET["lead_status"])){
		$lead_status= "AND status='".$_GET["lead_status"]."'";
	}else {
		$lead_status= "";
	}
	if($action=='del'){
		$return = $cms->db_query("update #_leads set is_deleted=1 where id in ($id)");
		$cms->redir(SITE_PATH_ADM.CPAGE, true);
		exit;	 
	}
	
	if(isset($_POST['assign_lead_btn'])){
		if($arr_ids){
			$str_adm_ids = implode(",",$arr_ids);
			$cms->db_query("update #_leads set assigned_to=".$_POST['username'].", assigned_date='".date("Y-m-d")."', status=2 where id in ($str_adm_ids)");
			
			//new status added on tracker
			$str_adm_idsArr = explode(',',$str_adm_ids);
			foreach($str_adm_idsArr as $lid){
				$action_message="Status Changed from New to Assigned";
				$_POSTS["lead_id"] = $lid;
				$_POSTS["action_message"] = $action_message;
				$_POSTS["action_date"] = date('Y-m-d h:i:s');
				$_POSTS["action_by"] = $_SESSION["ses_adm_id"];
				$_POSTS["action"] = 2;
				$cms->sqlquery("rs","lead_tracker",$_POSTS);
			}
				
			$path = $_SESSION['REFERER_page'];
		}
	}
	if($cms->is_post_back()){
		
		@extract($_POST);
		
		if($arr_ids) {
			$str_adm_ids = implode(",",$arr_ids);
			//print_r($_POST);die;
			switch ($_POST['action']){
				case "delete":
					$return = $cms->db_query("update #_leads set is_deleted=1 where id in ($str_adm_ids)");  
					if($return===-1){ //-1 used Foreign Key Message
						$adm->sessset(count($arr_ids)." ".foreignKeyErrorMsg, 'e');
					}else{
						$adm->sessset(count($arr_ids).' Item(s) Delete', 'e');
					}
					
					break;
				 
				case "Assigned":
					if($assigned_to>0){
						$cms->db_query("update #_leads set  assigned_to='".$assigned_to."', assigned_date='".date('Y-m-d')."', update_date='".date("Y-m-d H:i:s")."' where id in ($str_adm_ids)");
						$assignedTo =  $cms->getSingleResult("SELECT   customer_name FROM #_lms_users WHERE id='".$assigned_to."'");
						$action_message=" Assigned to ".$assignedTo." By ".$cms->getSingleResult("SELECT customer_name FROM #_lms_users WHERE id='".$_SESSION["ses_adm_id"]."'");
						for($k=0;$k<sizeOf($arr_ids);$k++){
							$_POSTS["action_by"] = $_SESSION["ses_adm_id"];
							$_POSTS["action_message"] = $action_message;
							$_POSTS["action_date"] = date('Y-m-d h:i:s');
							$_POSTS["lead_id"] = $arr_ids[$k];
							$cms->sqlquery("rs","lead_tracker",$_POSTS);
						}
						$adm->sessset(count($arr_ids).' Item(s) Assigned', 's');
					}else{
						$adm->sessset('Some Error please try again', 'e');
					}
					
					break;
				default:
			}
		}
		//$cms->redir(SITE_PATH_ADM.CPAGE, true);
		//exit;
	} 
	 
	//sorting of data
	$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	$urls1 = $urls = explode("&", $url);
	$sortCondition = "";
	if(empty($_GET["sorting"])){
		$sortVar ="desc";
	}

	if(!empty($_GET["sortby"])){
		if($_GET["sorting"] =="asc"){
			$sortCondition .= "ORDER BY ".$_GET["sortby"]." asc ";
			$sortVar ="desc";
			$order_by = $_GET["sortby"];
			$order_by2 = "asc";	
		}else if($_GET["sorting"] =="desc"){
			$sortCondition .= "ORDER BY ".$_GET["sortby"]." desc ";
			$sortVar ="asc";
			$order_by = $_GET["sortby"];
			$order_by2 = "desc";		
		} 
	}  

	for($i=0;$i<count($urls1);$i++){
		if(!empty($_GET["sortby"])){
			$sortString ="sortby=".$_GET["sortby"];
			if($urls[$i]==$sortString){
				unset($urls[$i]);
			}
		}
		if(!empty($_GET["sorting"])){
			$sortStr ="sorting=".$_GET["sorting"];
			if($urls[$i]==$sortStr){
				unset($urls[$i]);
			}
		}
		if(!empty($_GET["sortbyArray"])){
			$sortStr1 ="sortbyArray=".$_GET["sortbyArray"];
			if($urls[$i]==$sortStr1){
				unset($urls[$i]);
			}
		}
	}
	
	$url = implode('&', $urls);
	
	if($_GET["method"]==''){
		$url= $url."?method=GET" ;
	}
	
	
	$conditionsQr = "";
	
	/*if($_SESSION["ses_adm_role"]=="1"){
		$adminRole = "";
	}else{
		$adminRole = " AND assigned_to='".$_SESSION["ses_adm_id"]."' ";
	}
	if($_SESSION["ses_adm_id"]=="7")
	{
		$adminRole = "";
	}*/
	
	/*if($_SESSION["ses_adm_id"]=="10"){
		$adminRole = " AND assigned_to='".$_SESSION["ses_adm_id"]."' ";
	}else{
		$adminRole ="";
	}
	*/
	if($_SESSION["ses_adm_id"]!=1){
		if(in_array(9,$act_arr)){
			$adminRole = "";
		}
		else{
			$adminRole = " AND activity_for='".$_SESSION["ses_adm_id"]."'";
		}
	}else{
		$adminRole ="";
	}
	 
	if(!empty($_GET)){
		if(!empty($_REQUEST['start_date']) AND !empty($_REQUEST['end_date'])){
			$start_date = $cms->escape_string($_REQUEST['start_date']);
			$end_date = $cms->escape_string($_REQUEST['end_date']);
			$postDateFrom = date("Y-m-d", strtotime($start_date));
			$postDateTo = date("Y-m-d", strtotime($end_date));
			$conditionsQr .= " AND due_date>='$postDateFrom' AND due_date<='$postDateTo' ";
		}else{
			if(!empty($_REQUEST['start_date'])){
				$start_date = $cms->escape_string($_REQUEST['start_date']);
				$postDate = date("Y-m-d", strtotime($start_date));
				$conditionsQr .= " AND due_date='$postDate'";
			} 
			if(!empty($_REQUEST['end_date'])){
				$end_date = $cms->escape_string($_REQUEST['end_date']);
				$postDate = date("Y-m-d", strtotime($end_date));
				$conditionsQr .= "AND due_date='$postDate'";
			} 
		}		
		
		$start = intval($_GET['start']);
		$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
		$columns = "SELECT * ";
		$sql = " FROM #_lead_tracker WHERE 1=1 AND activity_message IS NOT NULL $adminRole $conditionsQr ";
		$order_by == '' ? $order_by = 'dimensioning_priority' : true;
		$order_by2 == '' ? $order_by2 = 'ASC' : true;
		$sql_count = "SELECT count(*) ".$sql; 
		$sql .= " order by $order_by $order_by2 ";
		$sql .= " limit $start, $pagesize ";
		$sql = $columns.$sql;
		$result = $cms->db_query($sql);
		$numRows = $result->num_rows; 
		$reccnt = $cms->db_scalar($sql_count);
		//echo $sql;
	}else { 
		//echo "test";
		$start = intval($_GET['start']);
		$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
		$columns = "SELECT * ";
		$sql = " FROM #_lead_tracker WHERE 1=1 AND activity_message IS NOT NULL $adminRole ";
		$order_by == '' ? $order_by = 'dimensioning_priority' : true;
		$order_by2 == '' ? $order_by2 = 'ASC' : true;
		$sql_count = "SELECT count(*) ".$sql; 
		$sql .= " order by $order_by $order_by2 ";
		$sql .= " limit $start, $pagesize ";
	 	$sql = $columns.$sql;
		$result = $cms->db_query($sql);
		$numRows = $result->num_rows; 
		$reccnt = $cms->db_scalar($sql_count);
		 
	}
	//echo $sql_count;
	//echo $sql; //die;
?>
<!-- .row -->

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
								<div class="form-group col-sm-5">				
									<div class="input-daterange input-group" id="date-range">
										<input type="text" class="form-control" name="start_date" id="start_date" value="<?=$start_date?>" placeholder="Activity From Date" autocomplete="off">
										<span class="input-group-addon bg-info b-0 text-white">to</span>
										<input type="text" class="form-control" name="end_date" id="end_date" value="<?=$end_date?>" placeholder="Activity To Date" autocomplete="off">
									</div>
								</div>
								<div class="form-group col-sm-2">
									<input type="submit" name="submt" onClick="changeMethod()" value="Search" class="btn search-btn">
									<a href="<?=SITE_PATH_ADM.CPAGE?>" class="btn reset-btn">Reset</a>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="table-responsive">
				<table class="table table-striped1 table-hover table-bordered1">
					<thead>
						<tr>
							<th class="text-nowrap">Activity</th>
							<th>Due Date</th>
							<th>Priority</th>
							<th>Name</th>
							<th>Added By</th>
						</tr>
					</thead>
					<tbody>
						<?php if($reccnt){ 
							$nums=$start+1; 
							while ($line = $result->fetch_array()){ 
							@extract($line);			 
						?>  
						<tr class="clickable-row">
							<td class="table-center text-nowrap"><a href="<?=SITE_PATH_ADM?>lead-manager/?mode=add&start=&id=<?=$lead_id?>">(LEAD-<?=$lead_id?>)</a> &nbsp;&nbsp;<?=$activity_message?></td>
							<td class="table-center text-nowrap"><?=date("Y-m-d",strtotime($due_date))?></td>
							<td class="table-center text-nowrap"><?=($dimensioning_priority<9999 && $dimensioning_priority!='')?$dimensioning_priority:'NA'?></td>
							<td class="table-center text-nowrap"><?=$cms->getSingleResult("SELECT customer_name FROM #_leads WHERE id='$lead_id' ")?></td>
							<td class="table-center text-nowrap"><?=$cms->getSingleResult("SELECT customer_name FROM #_users WHERE id='$action_by' ")?></td>
						</tr>
						<?php $nums++;} } else{ echo $adm->rowerror(11);}  ?>
					</tbody>
				</table>
			</div>
			
			<div class="clearfix"></div>
			<?php include("../inc/paging.inc.php")?>  
			<div class="clearfix"></div>
		</div>
	</div>
</div>
<!-- /.row -->

<script>
function changeMethod() {
	$("#aforms").attr("method", "get");
}
</script>
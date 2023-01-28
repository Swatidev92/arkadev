<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 
	if($action=='del'){
		$cms->db_query("update #_customer_registration set is_deleted='1' where id in ($id)");
		$adm->sessset('Record has been deleted', 'e');
		$cms->redir(SITE_PATH_ADM.CPAGE, true);
		exit;
	}
	
	if(isset($_POST['assign_project_btn'])){
		if($arr_ids){
			if($_POST['project_manager']!=''){			
				$str_adm_ids = implode(",",$arr_ids);
				$cms->db_query("update #_leads set project_manager=".$_POST['project_manager'].", project_assigned_date='".date("Y-m-d")."', lead_type=3 where id in ($str_adm_ids)");
			
				//new status added on tracker
				$str_adm_idsArr = explode(',',$str_adm_ids);
				foreach($str_adm_idsArr as $lid){
					$lead_customer = $cms->getSingleResult("SELECT customer_name FROM #_leads WHERE id=".$lid." ");
					$assignedToProjectMgr = $cms->getSingleResult("SELECT customer_name FROM #_users WHERE id=".$_POST['project_manager']." ");
					$action_message = 'Proposal <b>LEAD-'.$lid.'-'.$lead_customer.'</b> assigned to <b>'.$assignedToProjectMgr.' (project manager)</b>';
					$ActionPOSTS["lead_id"] = $lid;
					$ActionPOSTS["action_message"] = $action_message;
					$ActionPOSTS["action_date"] = date('Y-m-d h:i:s');
					$ActionPOSTS["action_by"] = $_SESSION["ses_adm_id"];
					$ActionPOSTS["activity_for"] = $_POST['project_manager'];
					$cms->sqlquery("rs","lead_tracker",$ActionPOSTS);
				}
			}
			else{
				echo '<script>alert("Select project manager to assign")</script>';
			}				
			$path = $_SESSION['REFERER_page'];
			$cms->redir($path, true);
		}else{
			echo '<script>alert("Select one or more proposal from the list")</script>';
		}
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
	
	//sorting of data
	$url="https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
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
	
	
	if(isset($_REQUEST['submt'])){
		$conditionsQr = "";
		if(!empty($_REQUEST['name_search'])){
			$name_search = $cms->escape_string($_REQUEST['name_search']);
			$name_search2 = trim($_REQUEST['name_search']);
			$conditionsQr .= " AND l.customer_name like '%$name_search2%'";
		}
		if(!empty($_REQUEST['search_agent'])){
			$search_agent = $cms->escape_string($_REQUEST['search_agent']);
			$conditionsQr .= " AND l.assigned_to='$search_agent'";
		}
		if(!empty($_REQUEST['start_date']) AND !empty($_REQUEST['end_date'])){
			$start_date = $cms->escape_string($_REQUEST['start_date']);
			$end_date = $cms->escape_string($_REQUEST['end_date']);
			$postDateFrom = date("Y-m-d", strtotime($start_date));
			$postDateTo = date("Y-m-d", strtotime($end_date));
			$conditionsQr .= " AND post_date>='$postDateFrom' AND post_date<='$postDateTo' ";
		}else{
			if(!empty($_REQUEST['start_date'])){
				$start_date = $cms->escape_string($_REQUEST['start_date']);
				$postDate = date("Y-m-d", strtotime($start_date));
				$conditionsQr .= " AND  post_date>='$postDate'";
			} 
			if(!empty($_REQUEST['end_date'])){
				$end_date = $cms->escape_string($_REQUEST['end_date']);
				$postDate = date("Y-m-d", strtotime($end_date));
				$conditionsQr .= "AND post_date<='$postDate'";
			} 
		}
		 
		$start = intval($start);
		$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;		
		$columns = "select p.status as pstatus, l.* ";
		$sql = " from #_leads l LEFT JOIN #_customer_project p on l.id=p.cust_id where 1=1 AND l.lead_id>0 AND l.is_deleted=0 AND l.status=4 $conditionsQr ";		
		$order_by == '' ? $order_by = 'l.post_date' : true;
		$order_by2 == '' ? $order_by2 = 'desc' : true;
		$sql_count = "select count(*) ".$sql; 
		$sql .= "order by $order_by $order_by2 ";
		$sql .= "limit $start, $pagesize ";
		$sql = $columns.$sql;
		$result = $cms->db_query($sql);
		$reccnt = $cms->db_scalar($sql_count);
	}else{
		$start = intval($_GET['start']);
		$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
		$columns = "SELECT l.*, l.id as propid ";
		$sql = " FROM #_leads l WHERE 1=1 AND l.is_deleted=0 AND l.lead_id>0 AND status=4 ";
		$order_by == '' ? $order_by = 'l.post_date' : true;
		$order_by2 == '' ? $order_by2 = 'desc' : true;
		$sql_count = "SELECT count(*) ".$sql; 
		$sql .= " order by $order_by $order_by2 ";
		$sql .= " limit $start, $pagesize ";
		$sql = $columns.$sql;
		$result = $cms->db_query($sql);
		$numRows = $result->num_rows; 
		$reccnt = $cms->db_scalar($sql_count);
	}
	//echo $sql;
	
	$customerPriceQry = $cms->db_query("SELECT battery_types, ev_charger_types, panel_types, roof_type_price, inverter_types FROM #_customer_price where id=1 ");
	$customerPriceArr = $customerPriceQry->fetch_array(); 

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
								<div class="form-group col-sm-4">				
									<div class="input-daterange input-group" id="date-range">
										<input type="text" class="form-control" name="start_date" id="start_date" value="<?=$start_date?>" placeholder="Date From" autocomplete="off">
										<span class="input-group-addon bg-info b-0 text-white">to</span>
										<input type="text" class="form-control" name="end_date" id="end_date" value="<?=$end_date?>" placeholder="Date To" autocomplete="off">
									</div>
								</div>
								<div class="form-group col-sm-3">
									<input type="text" name="name_search" id="name_search" title="Name" value="<?=$name_search?>" class="form-control" id="inputName1" placeholder="Name" data-fv-regexp="true">
									<div class="help-block with-errors"></div>
								</div>
								<div class="form-group col-md-3">
									<select class="form-control select2" id="search_agent" name="search_agent">
										<option value="">Search by user</option>
										<?php $allAgents = getAllAgents();
										foreach($allAgents as $akey=>$aval){
											if($akey==$search_agent){
												$asel = 'selected';
											}else{
												$asel = '';
											}
										?>
										<option value="<?=$akey?>" <?=$asel?>><?=$aval?></option>
										<?php } ?>
									</select>
								</div>
								<div class="col-sm-2">
									<input type="submit" name="submt" onClick="changeMethod()" value="Search" class="btn search-btn">
									<a href="<?=SITE_PATH_ADM.CPAGE?>" class="btn reset-btn">Reset</a>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-sm-2 pull-right">
					<button type="button" class="fcbtn btn btn-warning btn-outline btn-1b pull-right" onClick="changeAction()">Export</button>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="table-responsive">
				<table class="table table-striped1 table-bordered1 table-hover">
					<thead>
						<tr>
							<th>
								<div class="checkbox1 checkbox-success1">
									<label for="checkbox3"> Sr.</label>
								</div>
							</th>
							<th class="text-nowrap">Action</th>
							<th class="text-nowrap">Date <a href="<?=$url?>&sortby=post_date&sorting=<?=$sortVar?>"><i class="fa fa-sort"></i></a></th>							
							<th class="text-nowrap">Customer name</th>
							<th class="text-nowrap">Proposal name</th>
							<th class="text-nowrap">Total Price</th>
							<th class="text-nowrap">Customer Price</th>
							<th class="text-nowrap">Solar Green Rebate</th>
							<th class="text-nowrap">Charger Green Rebate</th>
							<th class="text-nowrap">Battery Green Rebate</th>
							<th class="text-nowrap">Total Margin (kr)</th>
							<th class="text-nowrap">Total Margin (%)</th>
							<th class="text-nowrap">Payback Year</th>
							<th class="text-nowrap">Assigned To</th>
						</tr>
					</thead>
					<tbody>
						<?php if($reccnt){ 
						$nums=$start+1; 
						while ($line = $result->fetch_array()){ 
						@extract($line);
						$total_margin=0;
						if($proposal_type!=5 && $proposal_type!=6 && $proposal_type!=7){
							$total_margin = $total_margin + $solar_margin_kr;
						}
						if($charger_margin_kr){
							$total_margin = $total_margin + $charger_margin_kr;
						}
						if($battery_name){
							$total_margin = $total_margin + $battery_margin_kr;
						}
						$perc_margin = round($total_margin*100/$proposal_total_cost);
						
						$leadsStatusArr = getAllStatus();
						?>  
						<tr class="clickable-row">
							<td class="table-center">
								<div class="checkbox1 checkbox-success1">
									<label for="checkbox3"> <?=$nums?></label>
								</div>
							</td>
							<td class="text-nowrap">
								<a href="<?=SITE_PATH_ADM.CPAGE?>?mode=add-proposal&start=<?=$_GET['start']?>&leadid=<?=$lead_id?>&id=<?=$id?>" data-toggle="tooltip" title="Edit Proposal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;&nbsp;
								
								<?php if($proposal_pdf){ ?>
								 
								<a href="<?=SITE_PATH.UPLOAD_FILES_PTH.'/'.UP_FILES_PROPOSAL.'/'.$proposal_pdf?>" download title="Proposal 1"><i class="fa fa-file-pdf-o" aria-hidden="true">1</i></a>
								
								<?php if($number_of_proposal==2 && $proposal_pdf2!=''){ ?>
								&nbsp;
								<a href="<?=SITE_PATH.UPLOAD_FILES_PTH.'/'.UP_FILES_PROPOSAL.'/'.$proposal_pdf2?>" download title="Proposal 2"><i class="fa fa-file-pdf-o" aria-hidden="true">2</i></a>								 
								<?php } ?>
								
								<?php if($proposal_image_pdf!=''){ ?>
								&nbsp;
								<a href="<?=SITE_PATH.UPLOAD_FILES_PTH.'/'.UP_FILES_PROPOSAL.'/'.$proposal_image_pdf?>" download title="Proposal Image"><i class="fa fa-image"></i></a>
								<?php } ?>
								&nbsp;
								<?php } ?>
								
								<?php if($proposal_txt){ ?>
								<a href="<?=SITE_PATH.UPLOAD_FILES_PTH.'/'.UP_FILES_PROPOSAL.'/'.$proposal_txt?>" title="Download TXT" download><i class="fa fa-file"></i></a>&nbsp;&nbsp;
								<?php } ?>
							</td>
							<td class="table-center text-nowrap"><?=date("Y-m-d",strtotime($post_date))?></td>
							<td class="table-center text-nowrap"><?=$customer_name?></td>
							<td class="table-center text-nowrap"><?=$proposal_pdf?></td>
							<?php if($proposal_customer_type==2){
								$customer_price = amount_format_proposal(round($total_price_excluding_vat));
							}else{
								$customer_price = amount_format_proposal(round($proposal_total_cost));
							}?>
							<td class="table-center text-nowrap"><?=amount_format_proposal(round($price_including_vat+$charger_price_including_vat+$battery_price_including_vat))?></td>
							<td class="table-center text-nowrap"><?=$customer_price?></td>
							<td class="table-center text-nowrap"><?=($proposal_customer_type==1)?amount_format_proposal(round($green_rebate_kr)):0?></td>
							<td class="table-center text-nowrap"><?=($proposal_customer_type==1)?amount_format_proposal(round($charger_green_rebate_kr)):0?></td>
							<td class="table-center text-nowrap"><?=($proposal_customer_type==1)?amount_format_proposal(round($battery_green_rebate_kr)):0?></td>
							<td class="table-center text-nowrap"><?=amount_format_proposal(round($total_margin))?></td>
							<td class="table-center text-nowrap"><?=$perc_margin>0?$perc_margin:0?></td>
							<td class="table-center text-nowrap"><?=$repayment_period?></td>
							<!--<td class="table-center text-nowrap"><?=$cms->getSingleResult("SELECT customer_name FROM #_users WHERE id='$assigned_to' ")?></td>-->
							<td class="table-center text-nowrap"><?=$cms->getSingleResult("SELECT customer_name FROM #_users WHERE id='$assigned_to' ")?></td>
						</tr>
						<?php $nums++;} } else{ echo $adm->rowerror(11);}  ?>
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
<script>
function changeAction(){
	$("#aforms").attr("action","<?=SITE_PATH_ADM.CPAGE?>/download.php");
	//alert($(".filter_form").attr("action"));
	$("#aforms").submit();
	//setTimeout(function(){ location.reload() }, 1000);
}
</script>
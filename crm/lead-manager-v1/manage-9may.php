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
		if($return===-1){ //-1 used Foreign Key Message
			$adm->sessset(foreignKeyErrorMsg, 'e');
		}else{
			$adm->sessset('Record has been deleted', 'e');
		}
	 
	}
	
	if(isset($_POST['assign_lead_btn'])){
		if($arr_ids){
			$str_adm_ids = implode(",",$arr_ids);
			$cms->db_query("update #_leads set assigned_to=".$_POST['username'].", assigned_date='".date("Y-m-d")."' where id in ($str_adm_ids)");
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
			$adminRole = " AND assigned_to='".$_SESSION["ses_adm_id"]."'";
		}
	}else{
		$adminRole ="";
	}
	 
	if(!empty($_GET)){
		if(!empty($_REQUEST['name_search'])){
			$name_search = $cms->escape_string($_REQUEST['name_search']);
			$name_search2 = trim($_REQUEST['name_search']);
			$conditionsQr .= " AND l.customer_name like '%$name_search2%'";
		}
		if(!empty($_REQUEST['email_search'])){
			$email_search = $cms->escape_string($_REQUEST['email_search']);
			$email_search2 = trim($_REQUEST['email_search']);
			$conditionsQr .= " AND l.email='$email_search2'";
		}
		if(!empty($_REQUEST['keyword'])){
			$keyword_search = $cms->escape_string($_REQUEST['keyword']);
			$keyword_search2 = trim($_REQUEST['keyword']);
			$conditionsQr .= " AND l.keyword like '%$keyword_search2%'";
		}
		if(!empty($_REQUEST['faculty'])){
			$program_search = $cms->escape_string($_REQUEST['faculty']);
			$conditionsQr .= " AND l.faculty='$faculty'";
		}
		if(!empty($_REQUEST['course'])){
			$program_search = $cms->escape_string($_REQUEST['course']);
			$conditionsQr .= " AND l.course='$course'";
		}
		//echo $_REQUEST['assigned_to'];die;
		if(!empty($_REQUEST['srch_assigned_to'])){
			$srch_assigned_to = $cms->escape_string($_REQUEST['srch_assigned_to']);
			$conditionsQr .= " AND 	l.assigned_to ='$srch_assigned_to'";
		}
		if(!empty($_REQUEST['start_date']) AND !empty($_REQUEST['end_date'])){
			$start_date = $cms->escape_string($_REQUEST['start_date']);
			$end_date = $cms->escape_string($_REQUEST['end_date']);
			$postDateFrom = date("Y-m-d", strtotime($start_date));
			$postDateTo = date("Y-m-d", strtotime($end_date));
			$conditionsQr .= " AND l.post_date>='$postDateFrom' AND l.post_date<='$postDateTo' ";
		}else{
			if(!empty($_REQUEST['start_date'])){
				$start_date = $cms->escape_string($_REQUEST['start_date']);
				$postDate = date("Y-m-d", strtotime($start_date));
				$conditionsQr .= " AND  l.post_date>='$postDate'";
			} 
			if(!empty($_REQUEST['end_date'])){
				$end_date = $cms->escape_string($_REQUEST['end_date']);
				$postDate = date("Y-m-d", strtotime($end_date));
				$conditionsQr .= "AND l.post_date<='$postDate'";
			} 
		}
		if(!empty($_REQUEST['search_status'])){
			$search_status = $cms->escape_string($_REQUEST['search_status']);
			$conditionsQr .= " AND l.status='$search_status'";
		}
		if(!empty($_REQUEST['search_state'])){
			$search_state = $cms->escape_string($_REQUEST['search_state']);
			$conditionsQr .= " AND l.state_id='$search_state'";
		}
		if(!empty($_REQUEST['search_city'])){
			$search_status = $cms->escape_string($_REQUEST['search_city']);
			$conditionsQr .= " AND l.city='$search_city'";
		}
		if(!empty($_REQUEST['search_status'])){
			$search_status = $cms->escape_string($_REQUEST['search_status']);
			$conditionsQr .= " AND l.status='$search_status'";
		}
		if(!empty($_REQUEST['search_work_start'])){
			$search_work_start = $cms->escape_string($_REQUEST['search_work_start']);
			$conditionsQr .= " AND l.work_start='$search_work_start'";
		}
		if(!empty($_REQUEST['search_form'])){
			$search_form = $cms->escape_string($_REQUEST['search_form']);
			$conditionsQr .= " AND l.form_type='$search_form'";
		}
		if(!empty($_REQUEST['search_agent'])){
			$search_agent = $cms->escape_string($_REQUEST['search_agent']);
			$conditionsQr .= " AND l.assigned_to='$search_agent'";
		}
		
		if(!empty($_REQUEST['search_source'])){
			$search_source = $cms->escape_string($_REQUEST['search_source']);
			$conditionsQr .= " AND l.source='$search_source'";
		}
		// Filter for today's follow up leads
		if($_REQUEST["action"]=="today_followup_leads"){
			$current_date_from=date("Y-m-d 00:00:00");
			$current_date_to=date("Y-m-d 23:59:59");
			$conditionsQr .= "AND comments.next_call_date >= '$current_date_from' AND comments.next_call_date <= '$current_date_to' ";
		}
		// Filter for follow up leads through date range
		if(!empty($_REQUEST["followup_from"]) && !empty($_REQUEST["followup_to"])){
			$followup_from=date("Y-m-d 00:00:00", strtotime($_REQUEST["followup_from"]));
			$followup_to=date("Y-m-d 23:59:59", strtotime($_REQUEST["followup_to"]));
			$conditionsQr .= "AND comments.next_call_date >= '$followup_from' AND comments.next_call_date <= '$followup_to' ";
		}
		
		
		//print_r($_REQUEST);die;
		
		
		$start = intval($_GET['start']);
		$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
		$columns = "SELECT l.*,  comments.next_call_date ";
		$sql = " FROM #_leads l left join #_lead_comments comments on l.id=comments.lead_id  WHERE 1=1 AND is_deleted=0 ".$conditionsQr." $lead_status $adminRole ";
		$order_by == '' ? $order_by = 'l.id' : true;
		$order_by2 == '' ? $order_by2 = 'DESC' : true;
		$sql_count = "SELECT count(*) ".$sql." GROUP BY l.id"; 
		$sql .= " GROUP BY l.id order by $order_by $order_by2 ";
		$sql .= "limit $start, $pagesize ";
		$sql = $columns.$sql;
		$result = $cms->db_query($sql);
		//$reccnt = $cms->db_scalar($sql_count);
		$sql_count_exe=$cms->db_query($sql_count);
		$reccnt = $sql_count_exe->num_rows;
		//echo $sql;
	}else { 
		//echo "test";
		$start = intval($_GET['start']);
		$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
		$columns = "SELECT l.* ";
		$sql = " FROM #_leads l WHERE 1=1 AND is_deleted=0 $lead_status $adminRole ";
		$order_by == '' ? $order_by = 'l.id' : true;
		$order_by2 == '' ? $order_by2 = 'DESC' : true;
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
			<div class="form-group col-sm-3">
				<input type="text" name="name_search" id="name_search" title="Name" value="<?=$name_search?>" class="form-control" id="inputName1" placeholder="Name" data-fv-regexp="true" pattern="[A-Za-z-. ]{2,100}">
				<div class="help-block with-errors"></div>
			</div>
			
			<div class="form-group col-sm-3">
				<input type="email" name="email_search" id="email_search" title="Email" value="<?=$email_search?>" class="form-control" id="inputName1" placeholder="Email" data-fv-regexp="true" >
				<div class="help-block with-errors"></div>
			</div> 
			<div class="form-group col-sm-4">				
				<div class="input-daterange input-group" id="date-range">
					<input type="text" class="form-control" name="start_date" id="start_date" value="<?=$start_date?>" placeholder="Lead Start Date">
					<span class="input-group-addon bg-info b-0 text-white">to</span>
					<input type="text" class="form-control" name="end_date" id="end_date" value="<?=$end_date?>" placeholder="Lead End Date">
				</div>
				<!--<div class="input-daterange input-group date-range">
					<input type="text" class="form-control" name="start_date" id="start_date" value="<?=$start_date?>" placeholder="Date From">
					<span class="input-group-addon bg-info b-0 text-white">to</span>
					<input type="text" class="form-control" name="end_date" id="end_date" value="<?=$end_date?>" placeholder="Date To">
				  </div>-->
			</div> 
			<div class="clearfix"></div>
			<div class="form-group col-md-2">
				<select class="form-control select2" id="search_status" name="search_status">
					<option value="">Lead Status</option>
					<?php foreach($leadsStatusArr as $status_key=>$status_val){?>
					<option value="<?=$status_key?>" <?=($search_status==$status_key && $search_status!='')?'selected':''?>><?=$status_val?></option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group col-md-2">
				<select class="form-control select2" id="search_work_start" name="search_work_start">
					<option value="">Work start</option>
					<?php foreach($workStartArr as $wkey=>$wval){?>
					<option value="<?=$wkey?>" <?=$search_work_start==$wkey?'selected':''?>><?=$wval?></option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group col-md-2">
				<select class="form-control select2" id="search_form" name="search_form">
					<option value="">Lead from</option>
					<?php foreach($leadFormType as $fkey=>$fval){?>
					<option value="<?=$fkey?>" <?=$search_form==$fkey?'selected':''?>><?=$fval?></option>
					<?php } ?>
				</select>
			</div>
			<?php if($_SESSION["ses_adm_role"]=="1"){ ?>
			<div class="form-group col-md-3">
				<select class="form-control select2" id="search_agent" name="search_agent">
					<option value="">Search by agent</option>
					<?php $userQry = $cms->db_query("SELECT id, customer_name FROM #_users WHERE role=3 ");
						while($userArr = $userQry->fetch_array()){
						if($userArr['id']==$search_agent){
							$statusSel = 'selected';
						}else{
							$statusSel = '';
						}
						echo '<option value="'.$userArr['id'].'" '.$statusSel.'>'.$userArr['customer_name'].'</option>';
					}
					?>
				</select>
			</div>
			<?php } ?>
			<div class="form-group col-sm-2">
				<input type="submit" name="submt" onClick="changeMethod()" value="Search" class="btn btn-primary">
				<a href="<?=SITE_PATH_ADM.CPAGE?>" class="btn btn-primary">Reset</a>
			</div>
			<!--<div class="col-sm-6">
			<label style="font-size:12px">Follow Up Leads</label><br>
				<div class="form-group col-sm-8">
					<div class="input-daterange input-group date-range">
						<input type="text" class="form-control" name="followup_from" id="" value="<?=$followup_from?>" placeholder="Date From">
						<span class="input-group-addon bg-info b-0 text-white">to</span>
						<input type="text" class="form-control" name="followup_to" id="" value="<?=$followup_to?>" placeholder="Date To">
					</div>
				</div> -->
				
			<div class="clearfix"></div>
			<?php if($_SESSION["ses_adm_role"]=="1"){ ?>
			<div class="form-group col-sm-4">
				<select  class="form-control select2" id="username" title="Username" name="username">
					<?php $adminReq=$cms->db_query("SELECT id, customer_name, email_id FROM #_users WHERE id!=1 AND status='1'  ORDER BY customer_name ASC"); ?>
					<option value="" >Select Agent</option>
					<?php while($adminRes = $adminReq->fetch_array()){ ?>
					<option value="<?=$adminRes["id"]?>" <?=(($adminArr["id"]==$adminRes["id"])?'selected="selected"':'')?>><?=$adminRes["customer_name"]?></option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group col-sm-4">
				<button type="submit" class="btn btn-primary" name="assign_lead_btn">Assign</button>
			</div>
			<div class="clearfix"></div>
			<?php } ?>
			<div class="table-responsive">
				<table class="table table-striped table-hover table-bordered">
					<thead>
						<tr>
							<th>
								<div class="checkbox checkbox-success">
									<?=$adm->check_all()?>
									<label for="checkbox3"> Sr.</label>
								</div>
							</th>
							<th class="text-nowrap">Action</th>
							<th>Lead Date <a href="<?=$url?>&sortby=post_date&sorting=<?=$sortVar?>"><i class="fa fa-sort"></i></a></th>						
							<th>Name</th>
							<th>Phone</th>
							<th>Status</th>
							<th>Agent</th>
							<th>Area <a href="<?=$url?>&sortby=panel_area&sorting=<?=$sortVar?>"><i class="fa fa-sort"></i></a></th>
							<th>Work start</th>
							<th>Lead From</th>
							<!--<th>Lead Form Type</th>
							<th>Stay Option</th>
							<th>Visit Date</th>
							<th>IP</th>
							<th>Keyword</th>-->
						</tr>
					</thead>
					<tbody>
						<?php if($reccnt){ 
							$nums=$start+1; 
							while ($line = $result->fetch_array()){ 
							@extract($line);
							$pay=$pay_status;
							if($pay_status==''){
								$pay="Not Paid";
							}
			 
						?>  
						<tr class="clickable-row">
							<td class="table-center">
								<div class="checkbox checkbox-success">
									<?=$adm->check_input($id)?>
									<label for="checkbox3"> <?=$nums?></label>
								</div>
							</td>
							<td class="text-nowrap">
								<?php if(in_array(3,$act_arr) || $_SESSION["ses_adm_id"]==1){	?>
								<a href="<?=SITE_PATH_ADM.CPAGE?>?mode=add&start=<?=$_GET['start']?>&id=<?=$id?>" data-toggle="tooltip" title="Edit lead"><i class="fa fa-pencil text-inverse m-r-10"></i></a>&nbsp;&nbsp;
								<?php }else{ ?>
								<a href="<?=SITE_PATH_ADM.CPAGE?>?mode=view&start=<?=$_GET['start']?>&id=<?=$id?>" data-toggle="tooltip" title="View lead"><i class="fa fa-eye text-inverse m-r-10"></i></a>	
								<?php } ?>
								 
								<?php if(in_array(4,$act_arr) || $_SESSION["ses_adm_id"]==1){	?>
								<a href="<?=SITE_PATH_ADM.CPAGE?>?mode=add-proposal&start=<?=$_GET['start']?>&id=<?=$id?>" data-toggle="tooltip" title="Edit Proposal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;&nbsp;
								<?php } else{ ?>
								<a href="<?=SITE_PATH_ADM.CPAGE?>?mode=view-proposal&start=<?=$_GET['start']?>&id=<?=$id?>" data-toggle="tooltip" title="View Proposal"><i class="fa fa-eye text-inverse m-r-10" style="color:blue"></i></a>	
								<?php } ?>
								
								<?php if(in_array(5,$act_arr) || $_SESSION["ses_adm_id"]==1){	?>
								<?php if($proposal_pdf){ ?>
								 
								<a href="<?=SITE_PATH.'uploaded_files/proposal/'.$proposal_pdf?>" download title="Proposal 1"><i class="fa fa-file-pdf-o" aria-hidden="true">1</i></a>
								
								<?php if($number_of_proposal==2 && $proposal_pdf2!=''){ ?>
								&nbsp;
								<a href="<?=SITE_PATH.'uploaded_files/proposal/'.$proposal_pdf2?>" download title="Proposal 2"><i class="fa fa-file-pdf-o" aria-hidden="true">2</i></a>								 
								<?php } ?>
								
								<?php if($proposal_image_pdf!=''){ ?>
								&nbsp;
								<a href="<?=SITE_PATH.'uploaded_files/proposal/'.$proposal_image_pdf?>" download title="Proposal Image"><i class="fa fa-image"></i></a>
								<?php } ?>
								&nbsp;
								<?php } } ?>
								
								<?php if(in_array(6,$act_arr) || $_SESSION["ses_adm_id"]==1){
								if($proposal_txt){ ?>
								<a href="<?=SITE_PATH.'uploaded_files/proposal/'.$proposal_txt?>" title="Download TXT" download><i class="fa fa-file"></i></a>&nbsp;&nbsp;
								<?php } } ?>
								
								<?php 
								$comment=$cms->getSingleResult("select lead_comment from #_lead_comments where lead_id='$id' order by id desc");
								
								$commentt=$comment?$comment."<p><a class='label label-warning' href=".SITE_PATH_ADM.CPAGE."?mode=view&id=$id>View All</a></p>":"No Comment Available";
								//echo '<a target="_blank" href="'.SITE_PATH_ADM.CPAGE."?mode=view&start=".$_GET['start'].'&id='.$id.'" data-toggle="popover" data-content="'.$comment.'"><i class="fa fa-comments text-inverse m-r-10"></i></a>';
								
								$commentt = str_replace('"', "'", $commentt);
								$commentt = htmlentities($commentt);

								if($comment!=''){
									$style="color:#0cd20c";
								}else{
									$style="";
								}
								?>
								<a href="javascript:void(0)" data-placement="left" data-toggle="popover" title="Comment" data-content="<?=$commentt?>"><i class="fa fa-comments text-inverse m-r-10" style="<?=$style?>"></i></a>
								<?php if(in_array(7,$act_arr) || $_SESSION["ses_adm_id"]==1){
									echo $adm->action_d(SITE_PATH_ADM.CPAGE."?mode=add&start=".$_GET['start'],$id);
								}
								$msgg=strip_tags($message);
								?>
							</td>
							<td class="table-center text-nowrap"><?=date("Y-m-d",strtotime($post_date))?></td>
							<td class="table-center text-nowrap"><?=$customer_name?></td>
							<td class="table-center text-nowrap"><?=$phone?></td>
							<td class="table-center text-nowrap"><?=$leadsStatusArr[$status]?></td>
							<td class="table-center text-nowrap"><?=$cms->getSingleResult("SELECT customer_name FROM #_users WHERE id='$assigned_to' ")?></td>
							<td class="table-center text-nowrap"><?=$panel_area?></td>
							<td class="table-center text-nowrap"><?=$workStartArr[$work_start]?></td>
							<td class="table-center text-nowrap"><?=$leadFormType[$form_type]?></td>
							
							
							<!--<td class="table-center text-nowrap"><?=$stay_option?></td>
							<td class="table-center text-nowrap"><?=$visit_date?></td>-->
							<!--<td class="table-center text-nowrap"><?=$ip?></td>
							<td class="table-center text-nowrap"><?=$keyword?></td>-->
							<!--<td class="table-center text-nowrap" title="<?=$msgg?>">
							<?php 
							if(strlen($msgg)>50){
								echo substr($msgg,0,50)."...";
							}else{
								echo $msgg;
							}?></td>-->
						</tr>
						<?php    $nums++;} } else{ echo $adm->rowerror(11);}  ?>
					</tbody>
				</table>
			</div>
			
			<div class="clearfix"></div>
			<?php include("../inc/paging.inc.php")?>  
			<div class="clearfix"></div><br>
              <?php /*if($_SESSION["ses_adm_role"]=="1"){ ?>  
			<div class="form-group col-sm-4">
				<label for="inputName1" class="control-label">Assigned To</label>
				<select class="form-control assigned_to_btn" name="assigned_to" id="assigned_to" data-error="Please select Assigned To" >
					<option value="">Select Assigned To</option>
					<?php $userQry=$cms->db_query("select id, customer_name from #_lms_users where status='1' and role='0'");
					while($userRes=$userQry->fetch_array()){ ?>
						<option value="<?=$userRes['id']?>"><?=$userRes['customer_name']?></option>
					<?php } ?>
				</select>
				 
				<div class="help-block with-errors"></div>	
			</div>
			<div class="form-group col-sm-4">
				<div class="clearfix"></div><br>
                <a href="javascript:void(0)" type="submit" class="btn btn-primary " id="duplicate_btn" style="margin-top: 7px;" disabled >Submit</a>
                <a href="javascript:void(0)"  onclick="javascript:submitions('Assigned');" type="submit" id="orginal_btn" class="btn btn-primary" id="true_button" style="margin-top: 7px; display:none">Submit</a>
                <a href="<?=SITE_PATH_ADM.CPAGE?>" style="margin-top: 7px;" class="btn btn-primary">Reset</a>
            </div>
			<?php $col="col-sm-4"; }*/ ?>
			<!--<div class="form-group <?=$col?$col:"col-sm-12"?>" align="right">
				<div class="clearfix"></div><br>
				<button type="button" onClick="changeAction()"  class="btn btn-success ">Export data</button>
			</div>-->
			<div class="clearfix"></div>
		</div>
	</div>
</div>
<!-- /.row -->

<script>
 function changeMethod() {
	$("#aforms").attr("method", "get");
}

$(".assigned_to_btn").change(function(){
	if($(this).val()!=''){
		$("#orginal_btn").show();
		$("#duplicate_btn").hide();
	}else{
		$("#duplicate_btn").show();
		$("#orginal_btn").hide();
	}
});
</script>
<script>
$(document).ready(function(){
     $('[data-toggle="popover"]').popover({
        //trigger : 'hover',
		html: true
    });
	$('body').on('click', function (e) {
    $('[data-toggle="popover"]').each(function () {
        if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
            $(this).popover('hide');
        }
    });
});
});
</script>
 <script>
    function downloadFiles() {
      document.getElementById("a2").click();
    }
  </script>
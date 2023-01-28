<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 
//print_r($_GET);die;
$pid = $_GET['id']; 

//create copy of proposal is already created 
$proposalDeleted = $cms->db_query("SELECT * FROM #_leads where lead_id=$pid AND parent_id=$pid AND proposal_pdf!='' AND is_deleted=1 ");
if($proposalDeleted->num_rows==0){
$proposalQry = $cms->db_query("SELECT * FROM #_leads where lead_id=$pid AND parent_id=$pid AND proposal_pdf!='' AND is_deleted=0 ");
if($proposalQry->num_rows==0){	
	$leadProposalQry = $cms->db_query("SELECT * FROM #_leads where id=$pid AND proposal_pdf!='' ");
	$row = $leadProposalQry->fetch_assoc();
	foreach ($row as $field => $value) {
		if($field!='id'){
			$PropArr[$field] = $value;
		}
		if($field=='lead_id'){
			$PropArr[$field] = $pid;
		}
		if($field=='parent_id'){
			$PropArr[$field] = $pid;
		}
	}
	$cms->sqlquery("rs","leads",$PropArr);
}
}
//print_r($PropArr);
//die;

$_SESSION['REFERER_page']='';
	if(isset($_GET["lead_status"])){
		$lead_status= "AND status='".$_GET["lead_status"]."'";
	}else {
		$lead_status= "";
	}
	
	if($action=='del'){
		$return = $cms->db_query("update #_leads set is_deleted=1 where id in ($propId)");
		$cms->redir(SITE_PATH_ADM.CPAGE.'?mode=proposal-list&start=&id='.$pid, true);
		exit;	 
	}
	
	if(isset($_POST['assign_lead_btn'])){
		if($arr_ids){
			$str_adm_ids = implode(",",$arr_ids);
			$cms->db_query("update #_leads set assigned_to=".$_POST['username'].", assigned_date='".date("Y-m-d")."' where id in ($str_adm_ids)");
			$path = $_SESSION['REFERER_page'];
		}
	}
	if($cms->is_post_back()){
		//upload files
		if(isset($_FILES['file_upload']) and count(array_filter($_FILES['file_upload']['tmp_name']))>0){
			if(count($_FILES["file_upload"]["name"])>0){				
				$pcount = count($_FILES["file_upload"]["name"]);
				for($i=0; $i<$pcount; $i++){
					$uploadArr['file_title'] = $_POST['file_title'][$i];
										
					if(!empty($_FILES["file_upload"]["name"][$i])){
						$path = $_FILES["file_upload"]["name"][$i];
						$end = pathinfo($path, PATHINFO_EXTENSION);
						$filename = $_FILES['file_upload']['name'][$i]; 
						$file_loc = $_FILES['file_upload']['tmp_name'][$i];
						$file_size = $_FILES['file_upload']['size'][$i];
						$file_type = $_FILES['file_upload']['type'][$i];
						$folder = FILES_PATH."uploads/";
						// make file name in lower case
						$new_file_name = strtolower($filename);
						$final_file= str_replace(" ","-",$new_file_name);
						if($file_size>0 && $file_size>5000000){
							echo "<script>alert('File size should be less than 5MB')</script>";
						}else{
							move_uploaded_file($file_loc,$folder.$final_file);
							//$_POST['display_order']=$i+1;
							$uploadArr['file_upload']=$final_file;
							//$uploadArr['proposal_id']=$lead_insert_id;
							$uploadArr['lead_id']=$pid;
							$cms->sqlquery("rs","uploads",$uploadArr);
						}
					}			
				}
			}	
		}
		$cms->redir(SITE_PATH_ADM.CPAGE."?mode=proposal-list&start=&id=".$pid.'#uplaod', true);
		exit;
		
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
	
	if($_SESSION["ses_adm_id"]!=1){
		if(in_array(11,$act_arr)){
			$adminRole = "";
		}
		else{
			$adminRole = " AND assigned_to='".$_SESSION["ses_adm_id"]."'";
		}
	}else{
		$adminRole ="";
	}	 

	//echo "test";
	$start = intval($_GET['start']);
	$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
	$columns = "SELECT l.*, l.id as propid ";
	$sql = " FROM #_leads l WHERE 1=1 AND l.is_deleted=0 AND l.lead_id=$pid $lead_status ";
	$order_by == '' ? $order_by = 'l.id' : true;
	$order_by2 == '' ? $order_by2 = 'DESC' : true;
	$sql_count = "SELECT count(*) ".$sql; 
	$sql .= " order by $order_by $order_by2 ";
	$sql .= " limit $start, $pagesize ";
	$sql = $columns.$sql;
	$result = $cms->db_query($sql);
	$numRows = $result->num_rows; 
	$reccnt = $cms->db_scalar($sql_count);
		 
	//echo $sql_count;
	//echo $sql; //die;
		
?>
<!-- .row -->

<div class="row">
	<div class="col-sm-12">
		<div class="white-box">
			<div class="form-group">
				<?php if(in_array(4,$act_arr) || $_SESSION["ses_adm_id"]==1){ ?>
				<a href="<?=SITE_PATH_ADM.CPAGE.'/?mode=add-proposal&start='.$_GET['start'].'&leadid='.$pid?>" class="ub">
				<img  src="<?=SITE_PATH_ADM?>images/add_1.svg" width="25" alt=""> Generate Proposal</a>
				&nbsp;&nbsp;
				<?php } ?>
				<a href="#uplaod" class="ub"><i class="fa fa-upload" aria-hidden="true"></i> Upload Files</a>
			</div>
			<div class="clearfix"></div>
			
			<div class="table-responsive">
				<table class="table table-striped1 table-hover table-bordered1">
					<thead>
						<tr>
							<!--<th>
								<div class="checkbox checkbox-success">
									<?=$adm->check_all()?>
									<label for="checkbox3"></label>
								</div>
							</th>-->
							<th class="text-nowrap">Action</th>
							<th>Date <a href="<?=$url?>&sortby=post_date&sorting=<?=$sortVar?>"><i class="fa fa-sort"></i></a></th>						
							<th>Proposal name</th>
							<th>Customer Price</th>
							<th>Solar Green Rebate</th>
							<th>Charger Green Rebate</th>
							<th>Battery Green Rebate</th>
							<th>Total Margin (kr)</th>
							<th>Total Margin (%)</th>
							<th>Payback Year</th>
							<th>Generated By</th>
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
						?>  
						<tr class="clickable-row">
							<!--<td class="table-center">
								<div class="checkbox checkbox-success">
									<?=$adm->check_input($id)?>
									<label for="checkbox3"></label>
								</div>
							</td>-->
							<td class="text-nowrap">
								<?php if(in_array(4,$act_arr) || $_SESSION["ses_adm_id"]==1){ ?>
								<a href="<?=SITE_PATH_ADM.CPAGE?>?mode=add-proposal&start=<?=$_GET['start']?>&leadid=<?=$pid?>&id=<?=$id?>" data-toggle="tooltip" title="Edit Proposal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;&nbsp;
								
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
								<?php } ?>
								
								<?php if($proposal_txt){ ?>
								<a href="<?=SITE_PATH.'uploaded_files/proposal/'.$proposal_txt?>" title="Download TXT" download><i class="fa fa-file"></i></a>&nbsp;&nbsp;
								<?php } ?>								
								<a href="<?=SITE_PATH_ADM.CPAGE?>?mode=proposal-list&id=<?=$pid?>&propId=<?=$propid?>&action=del" onclick="return confirm('Do you want delete this record?');" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-close text-danger"></i></a>
								<?php }else{?>
								<a href="<?=SITE_PATH_ADM.CPAGE?>?mode=view-proposal&start=<?=$_GET['start']?>&leadid=<?=$pid?>&id=<?=$id?>" data-toggle="tooltip" title="View proposal"><i class="fa fa-eye text-inverse m-r-10"></i></a>
								<?php }	?>
							</td>
							<td class="table-center text-nowrap"><?=date("Y-m-d",strtotime($post_date))?></td>
							<td class="table-center text-nowrap"><?=$proposal_pdf?></td>
							<td class="table-center text-nowrap"><?=amount_format_proposal(round($proposal_total_cost))?></td>
							<td class="table-center text-nowrap"><?=amount_format_proposal(round($green_rebate_kr))?></td>
							<td class="table-center text-nowrap"><?=amount_format_proposal(round($charger_green_rebate_kr))?></td>
							<td class="table-center text-nowrap"><?=amount_format_proposal(round($battery_green_rebate_kr))?></td>
							<td class="table-center text-nowrap"><?=amount_format_proposal(round($total_margin))?></td>
							<td class="table-center text-nowrap"><?=$perc_margin>0?$perc_margin:0?></td>
							<td class="table-center text-nowrap"><?=$repayment_period?></td>
							<td class="table-center text-nowrap"><?=$cms->getSingleResult("SELECT customer_name FROM #_users WHERE id='$post_by' ")?></td>
						</tr>
						<?php    $nums++;} } else{ echo $adm->rowerror(11);}  ?>
					</tbody>
				</table>
			</div>
			
			<div class="clearfix"></div>
			<?php include("../inc/paging.inc.php")?>  
			<div class="clearfix"></div><br>
			
			<div id="uplaod">
				<div class="form-section-heading1">	
					<h2>Upload Files</h2>
				</div>				
				<div class="form-group col-sm-12">
					<div class="file_wrapper">
						<div class="form-group col-sm-5">
							<label for="file_title" class="control-label">File Title</label>
							<input type="text" name="file_title[]" value="<?=$file_title?>" class="form-control" id="file_title">
						</div>
						<div class="form-group col-sm-5">
							<label for="file_upload" class="control-label">Upload File (Size should be less than 5 MB)</label>
							<input type="file" id="file_upload" name="file_upload[]">
						</div>	
						<div class="form-group col-sm-2">
							<a href="javascript:void(0);" class="btn btn-primary add_file_button">Upload more files</a>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="form-group col-sm-12">
					<?php $fileQry = $cms->db_query("SELECT * FROM #_uploads where lead_id=$pid ");
						if($fileQry->num_rows>0){ ?>
						<ul>
							<?php while($fileRes = $fileQry->fetch_array()){?>
							<li id="<?=$fileRes['id']?>"><b><?=$fileRes['file_title']?$fileRes['file_title'].' - ':''?></b> <?=$fileRes['file_upload']?> <a href="javascript:void(0)" class="remove_icon" onClick="remove_file('<?=$fileRes['id']?>','<?=$fileRes['file_upload']?>')" data-toggle="tooltip" data-original-title="Delete File"><img src="<?=SITE_PATH_ADM?>images/close-btn.png"></a> <a href="<?=SITE_PATH?>uploaded_files/uploads/<?=$fileRes['file_upload']?>" download>View</a></li>						
							<?php }	?>
						</ul>						
					<?php }	?>
				</div>
				<div class="form-group col-sm-12">
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
				<div class="clearfix"></div><br>
			</div>
		</div>
	</div>
</div>
<!-- /.row -->

<script>
function searchAction(){
	$("#aforms").attr("method", "get");
	//$("#aforms").attr("action","<?=SITE_PATH_ADM.CPAGE?>?mode=proposal-list&start=&id=<?=$pid?>");
	//$("#aforms").submit();
	//setTimeout(function(){ location.reload() }, 1000);
}
</script>

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
  
<script type="text/javascript">
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_file_button'); //Add button selector
    var wrapper = $('.file_wrapper'); //Input field wrapper
    var fieldHTML = '<div class="row"><div class="form-group col-sm-5"><label for="file_title" class="control-label">File Title</label><input type="text" name="file_title[]" value="<?=$file_title?>" class="form-control" id="file_title"></div><div class="form-group col-sm-5"><label for="file_upload" class="control-label">Upload File</label><input type="file" id="file_upload" name="file_upload[]"></div><div class="form-group col-sm-1"><a href="javascript:void(0);" class="remove_button"><i class="fa fa-close text-danger"></i></a></div><div class="clearfix"></div></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $('.file_wrapper').on('click', '.remove_button', function(e){
        e.preventDefault();
		$(this).closest('div.row').remove(); //Remove field html
		x--; //Decrement field counter
    });
});
</script>

<script>
function remove_file(id,name){
	if (confirm("Are you sure to delete?")) {
		$.ajax({
			type:"post",
			url: "<?=SITE_PATH_ADM.CPAGE?>/remove_file.php?id="+id+"&name="+name,
			success:function(result){
				if(parseInt(result)=='1'){
					$("#"+id).hide();
					//location.reload();
				}
				else{
					alert("Something went wrong.Pleas try again.")
				}
			}
		})
	}
}	
</script>
<?php defined('_JEXEC') or die('Restricted access'); ?>
 <?php 
$pid = $_GET['id']; 
if($cms->is_post_back()){
	//print_r($_POST['evc']);die
	$_POST['reasons'] = json_encode($_POST['reasonArr']);
	if($pid){         
		$cms->sqlquery("rs","lead_type_status",$_POST, 'id', $pid);
		$adm->sessset('Record has been updated', 's');
	} else {  
		if($_POST['lead_type']){ // for status
			$checkCount = $cms->getSingleResult("select count(id) from #_lead_type_status where lead_type=".$_POST['lead_type']." ");
			$_POST['constant'] = $checkCount+1;
		}
		$cms->sqlquery("rs","lead_type_status",$_POST);
		$adm->sessset('Record has been added', 's');
	}
	 
	if(isset($_GET['start']) && $_GET['start'] > 0) {
		$path = SITE_PATH_ADM.CPAGE."/index.php?start=".$_GET['start'];
	} else {
		$path = SITE_PATH_ADM.CPAGE;
	}
	$cms->redir($path, true);	
	
}  
	$rsAdmin = $cms->db_query("select * from #_lead_type_status where id='".$pid."'");
	$arrAdmin = $rsAdmin->fetch_array(); 
	@extract($arrAdmin);
	 
 
?>
<!-- .row -->
<div class="row">
    <div class="col-sm-12">
        <div class="white-box panel-body">
			<h2>Add new status/lead type</h2>
			<div class="form-group col-sm-2">
				<label class="control-label">Select Type</label>
				<select class="form-control" name="lead_type" required>
					<option value="">Select*</option>
					<option value="1" <?=$lead_type==1?'selected':''?>>Status</option>
					<option value="2" <?=$lead_type==2?'selected':''?>>Lead Type</option>
				</select>
			</div>
			<div class="form-group col-sm-6">
				<label class="control-label">Lead Status/Type Label</label>
				<input type="text" name="lead_status" id="lead_status" value="<?=$lead_status?>" placeholder="Lead Status/Type Label*" class="form-control" required>
				<div class="help-block with-errors"></div>
			</div>
			<div class="clearfix"></div>
			<div class="form-group col-sm-12">
				<label class="control-label">Help Text</label>
				<input type="text" name="help_text" id="help_text" value="<?=$help_text?>" placeholder="Help Text" class="form-control">
				<div class="help-block with-errors"></div>
			</div>
			<div class="clearfix"></div>
			<?php if($_SESSION["ses_adm_role"]==1){ ?>
			<div class="form-group col-sm-2">
				<label class="control-label"> Send Mail to </label>
			</div>
			<div class="form-group col-sm-1">
				<div class="checkbox checkbox-success">
					<input id="to_admin" type="checkbox" name="to_admin" value="1" <?=$to_admin==1?'checked':''?>>
					<label for="to_admin"> Admin </label>
				</div>
			</div>
			<div class="form-group col-sm-1">
				<div class="checkbox checkbox-success">
					<input id="to_user" type="checkbox" name="to_user" value="1" <?=$to_user==1?'checked':''?>>
					<label for="to_user"> User </label>
				</div>
			</div>
			<?php } ?>
			<div class="clearfix"></div>
			<?php if($pid==5){?>
			<div class="form-group col-sm-12">
				<div class="panel">
					<div class="panel-heading"> 
						<a class="panel-title collapsed">Add reasons</a> 
					</div>
				</div>
				<div class="list_wrapper">  
				<?php $obj = json_decode($reasons);
				$rs_cnt = count($obj);
				if(count($obj)>0){
					$i=0;
					foreach($obj as $val){?>
					<div class="row" id="rev<?=$i?>">
						<div class="status-checkbox">
							<input class="form-check-input" type="checkbox" name="reasonArr[<?=$i?>][status]" value="1" <?=$val->status==1?'checked':''?>>
						</div>
						<div class="col-xs-4 col-sm-4 col-md-4">
							<div class="form-group">
								Name
								<input name="reasonArr[<?=$i?>][name]" type="text" placeholder="Name" class="form-control" value="<?=$val->name?>"/>
							</div>
						</div>
						<div class="col-xs-1 col-sm-1 col-md-1">
							<br>
							<button class="" onclick='revrcrd("rev<?=$i?>")' type="button"><i class="fa fa-close text-danger"></i></button>
						</div>
						<?php $i++; 
					echo '</div>'; } } ?>
					<div class="row">
						<div class="col-xs-4 col-sm-4 col-md-4">
							<h3>Add New <button class="btn btn-primary list_add_button" type="button">+</button></h3>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
			<?php } ?>			
			<div class="form-group col-sm-3">
                <button type="submit" class="btn btn-primary" id="submit_btn">Submit</button>
                <button type="button" onClick="history.go(-1)" class="btn btn-primary">Back</button>
            </div>
		</div>
	</div>
</div>
<style>
.status-checkbox{
	margin-top:25px;
	margin-right:10px;
	float:left;
}
.mgtp0{
	margin-top:0px;
}
</style>
<script>
$(document).ready(function(){
	var list_maxField = 50; //Input fields increment limitation
	
    // sec1
	var x1 = "<?=$rs_cnt-1?>"; //Initial field counter	
	$('.list_add_button').click(function()
	    {
			
	    //Check maximum number of input fields
	    if(x1 < list_maxField){ 
	        x1++; //Increment field counter
	        var list_fieldHTML = '<div class="row"><div class="status-checkbox"><input class="form-check-input" type="checkbox" name="reasonArr['+x1+'][status]" value="1"></div><div class="col-xs-4 col-sm-4 col-md-4"><div class="form-group">Name<input name="reasonArr['+x1+'][name]" type="text" placeholder="Name" class="form-control" /></div></div> <div class="col-xs-1 col-sm-7 col-md-1"><a href="javascript:void(0);" class="list_remove_button btn btn-danger">-</a></div></div>'; //New input field html 
	        $('.list_wrapper').append(list_fieldHTML); //Add field html
	    }
	});
	//Once remove button is clicked
	$('.list_wrapper').on('click', '.list_remove_button', function(){
	   $(this).closest('div.row').remove(); //Remove field html
	   x--; //Decrement field counter
	});
});
function revrcrd(rid){
	$("#"+rid).remove();
}
</script>
<?php defined('_JEXEC') or die('Restricted access'); ?>
 <?php 
$pid = $_GET['id']; 
if($cms->is_post_back()){
	$_POST['modified'] = date("Y-m-d");
	if($pid){         
		$cms->sqlquery("rs","help_category",$_POST, 'id', $pid);
		$adm->sessset('Record has been updated', 's');
	}else{
		//$nameExists=$cms->db_query("SELECT * FROM #_help_category WHERE email_id = '".$_POST['email_id']."' AND purpose='".$_POST['purpose']."' ");
		//if($nameExists->num_rows==0){		
		$cms->sqlquery("rs","help_category",$_POST);
		$adm->sessset('Record has been added', 's');
		//}
	}
	 
	if(isset($_GET['start']) && $_GET['start'] > 0) {
		$path = SITE_PATH_ADM.CPAGE."/index.php?start=".$_GET['start'];
	} else {
		$path = SITE_PATH_ADM.CPAGE;
	}
	$cms->redir($path, true);	
} 	
if($pid){		
	$rsAdmin = $cms->db_query("select * from #_help_category where id=$pid ");
	$arrAdmin = $rsAdmin->fetch_array();
	@extract($arrAdmin);
}
 
?>
<!-- .row -->
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
			<div class="form-group col-sm-8">
				<label for="help_name" class="control-label">Help Name</label>
				<input type="text" name="help_name" value="<?=$help_name?>" class="form-control" id="help_name" placeholder="Help Name" data-fv-regexp="true" data-error="Please enter Help name" required>
				<div class="help-block with-errors"></div>
			</div>
			<div class="clearfix"></div>
			<div class="form-group col-sm-6">
				<label for="short_info" class="control-label">Short Information (Max 250 Characters)</label>
				<textarea name="short_info" class="form-control" id="short_info" placeholder="Short Information" data-fv-regexp="true" rows="5" data-error="Please enter Short Information" maxlength="250" required><?=$short_info?></textarea>
				<div class="help-block with-errors"></div>
			</div>


			<div class="clearfix"></div>
			<div class="form-group col-sm-6">
				<label for="status" class="control-label">Status</label>
				<select class="form-control" name="status">
					<option value="1" <?=(($status=='1')?'selected="selected"':'')?>>Active</option>
					<option value="0" <?=(($status=='0')?'selected="selected"':'')?>>Inactive</option>
				</select>
            </div>
			<div class="clearfix"></div>
            <div class="form-group col-sm-12">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
			<div class="clearfix"></div>
        </div>
	</div>
</div>
      <!-- /.row -->
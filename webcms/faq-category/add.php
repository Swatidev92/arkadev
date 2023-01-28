<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 
$pid = $_GET["id"];
if($cms->is_post_back()){ 
	if($pid){ 
		$uids =  $pid;
		$_POST['modified'] = date("Y-m-d h:i:s");
		$cms->sqlquery("rs","faq_categories",$_POST,'id',$pid);
		$adm->sessset('Record has been updated', 's');
	} else { 
		$_POST['modified'] = date("Y-m-d h:i:s");
		$_POST['cat_url'] = $cms->baseurl($_POST['cat_name']);
		$uids = $cms->sqlquery("rs","faq_categories",$_POST);
		$adm->sessset('Record has been added', 's');
	}	
	//$cms->redir(SITE_PATH_ADM.CPAGE.'?mode=add&id='.$uids, true);
	$cms->redir(SITE_PATH_ADM.CPAGE, true);
}	
if(isset($pid)){
	$rsAdmin=$cms->db_query("select * from #_faq_categories where id='".$pid."'");
	$arrAdmin=$cms->db_fetch_array($rsAdmin);
	@extract($arrAdmin);
}

?>
<!-- .row -->
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">		
					 
			<div class="form-group col-sm-6">
                <label for="cat_name" class="control-label">Catagory Name*</label>
				<input type="text" name="cat_name" value="<?=$cat_name?>" class="form-control" id="cat_name" placeholder="Catagory Name" data-fv-regexp="true"  data-error="Please enter valid Catagory Name" title="Catagory Name" required> 
				<div class="help-block with-errors"></div>
			</div>	
			<div class="clearfix"></div>
			<div class="form-group col-sm-3">
				<label for="inputPassword" class="control-label">Status</label>
				<select class="form-control select2" name="status"  id="status" title="status" >
					<option value="1" <?=(($status=='1')?'selected="selected"':'')?>>Active</option>
					<option value="0" <?=(($status=='0')?'selected="selected"':'')?>>Inactive</option>
				</select>
			</div>
			<div class="clearfix"></div><br>
            <div class="form-group col-sm-12">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" onclick="history.go(-1)" class="btn btn-primary">Back</button>
            </div>
			<div class="clearfix"></div>
        </div>
	</div>
</div>
<!-- /.row -->
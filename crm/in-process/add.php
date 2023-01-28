<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 
$pid = $_GET["id"];
if($cms->is_post_back()){ 
	//print_r($_POST);die;
	
	if($pid){
		$cms->db_query("UPDATE #_leads SET personnummer='".$_POST['personnummer']."', aggrement_note='".$_POST['aggrement_note']."' WHERE id=$pid ");
		$adm->sessset('Record has been updated', 's');
	}
	$cms->redir(SITE_PATH_ADM.CPAGE, true);
}	
if(isset($pid)){
	$rsAdmin=$cms->db_query("select * from #_leads where id='".$pid."'");
	$arrAdmin=$cms->db_fetch_array($rsAdmin);
	@extract($arrAdmin);
}

?>
<!-- .row -->
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">			 
			<div class="form-group col-sm-4">
                <label for="customer_name" class="control-label">Name</label>
				<input type="text" name="customer_name" value="<?=$customer_name?>" class="form-control" readonly>
			</div>	
			<div class="form-group col-sm-4">
                <label for="email" class="control-label">Email</label>
				<input type="email" name="email" value="<?=$email?>" class="form-control" id="email" readonly>
			</div>	
			<div class="form-group col-sm-4">
                <label for="phone" class="control-label">Phone</label>
				<input type="text" name="phone" value="<?=$phone?>" class="form-control" id="phone" readonly>
			</div>
			<div class="clearfix"></div>	
			<div class="form-group col-sm-3">
                <label for="sale_rep_id" class="control-label">Sales Rep</label>
				<input type="text" name="sale_rep_id" value="<?=$cms->getSingleResult("SELECT customer_name FROM #_users WHERE id='$assigned_to' AND id!=1 ")?>" class="form-control" id="sale_rep_id" readonly>
			</div>
			<div class="form-group col-sm-6">
                <label for="proposal_address" class="control-label">Address</label>
				<input type="text" name="proposal_address" value="<?=$proposal_address?>" class="form-control" id="proposal_address" readonly>
			</div>
			<div class="form-group col-sm-3">
                <label for="city" class="control-label">City</label>
				<input type="text" name="city" value="<?=$city?>" class="form-control" id="city" readonly>
			</div>
			<div class="clearfix"></div>
			<div class="form-group col-sm-4">
                <label for="personnummer" class="control-label">Personnummer</label>
				<input type="text" name="personnummer" value="<?=$personnummer?>" class="form-control" id="personnummer">
			</div>
			<div class="clearfix"></div>
			<div class="form-group col-sm-6">
                <label for="aggrement_note" class="control-label">Agreement Note</label>
				<textarea name="aggrement_note" class="form-control" id="aggrement_note" data-fv-regexp="true" data-error="Please enter value in correct format." maxlength="250"><?=$aggrement_note?></textarea>
				<div class="help-block with-errors"></div>
			</div>
			<div class="clearfix"></div>						
            <div class="form-group col-sm-12">
				<?php if((in_array($act_arr[1],$_SESSION["url"][$Sys_Gl_module_id]) || !in_array($act_arr[3],$_SESSION["url"][$Sys_Gl_module_id])) || $_SESSION["ses_adm_id"]==1){?>
                <button type="submit" class="btn add-submit-btn" id="check_submit">Submit</button>
				<?php } ?>
                <button type="button" onclick="history.go(-1)" class="btn back-btn">Back</button>
            </div>
			<div class="clearfix"></div>
        </div>
	</div>
</div>
<!-- /.row -->
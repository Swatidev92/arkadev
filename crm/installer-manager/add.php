<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 
$pid = $_GET["id"];
if($cms->is_post_back()){ 
	//print_r($_POST);die;
	
	if($_FILES["vendor_logo"]["name"]){ 
		$_POST["vendor_logo"] = uploadImage("vendor_logo","media");
	}
	
	$_POST['modified'] = date("Y-m-d h:i:s");
	if($pid){ 
		$uids =  $pid;
		$cms->sqlquery("rs","vendor",$_POST,'id',$pid);
		$adm->sessset('Record has been updated', 's');
	} else { 
		$uids = $cms->sqlquery("rs","vendor",$_POST);
		$adm->sessset('Record has been added', 's');
	}	
	//$cms->redir(SITE_PATH_ADM.CPAGE.'?mode=add&id='.$uids, true);
	$cms->redir(SITE_PATH_ADM.CPAGE, true);
}	
if(isset($pid)){
	$rsAdmin=$cms->db_query("select * from #_vendor where id='".$pid."'");
	$arrAdmin=$cms->db_fetch_array($rsAdmin);
	@extract($arrAdmin);
}

?>
<style>
.checkbox label {
	padding-right:35px;
}
</style>
<!-- .row -->
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">			 
			<div class="form-group col-sm-6">
                <label for="company_name" class="control-label">Company Name*</label>
				<input type="text" name="company_name" value="<?=$company_name?>" class="form-control" id="company_name" data-fv-regexp="true" data-error="Please enter valid Name" required>
				<div class="help-block with-errors"></div>
			</div>	
			<div class="form-group col-sm-6">
                <label for="contact_person_name" class="control-label">Contact Person Name*</label>
				<input type="text" name="contact_person_name" value="<?=$contact_person_name?>" class="form-control" id="contact_person_name" data-fv-regexp="true" data-error="Please enter value in correct format." required>
				<div class="help-block with-errors"></div>
			</div>
			<div class="clearfix"></div>
			<div class="form-group col-sm-6">
                <label for="email" class="control-label">Email*</label>
				<input type="email" name="email" value="<?=$email?>" class="form-control" id="email" data-fv-regexp="true" data-error="Please enter value in correct format." required>
				<div class="help-block with-errors"></div>
			</div>	
			<div class="form-group col-sm-6">
                <label for="phone" class="control-label">Phone*</label>
				<input type="text" name="phone" value="<?=$phone?>" class="form-control" id="phone" data-fv-regexp="true" data-error="Please enter value in correct format." required>
				<div class="help-block with-errors"></div>
			</div>			
			<div class="clearfix"></div>
			<div class="form-group col-sm-3">
				<label for="email" class="control-label">Work Type</label>
				<select class="form-control" name="work_type" id="work_type">
					<option value="">Select work type</option>
					<?php foreach($vendorWorkType as $wkey=>$wval){
						if($work_type==$wkey){
							$wsel = 'selected';
						}
						else{
							$wsel = '';
						}
					?>
					<option value="<?=$wkey?>" <?=$wsel?>><?=$wval?></option>
					<?php } ?>
				</select>
			</div>	
			<div class="clearfix"></div>
			<div class="form-group col-sm-5">
                <label for="address" class="control-label">Address</label>
				<input type="text" name="address" class="form-control" value="<?=$address?>" id="address" data-fv-regexp="true" data-error="Please enter value in correct format." maxlength="150">
				<div class="help-block with-errors"></div>
			</div>
			<div class="form-group col-sm-3">
                <label for="city" class="control-label">City*</label>
				<input type="text" name="city" value="<?=$city?>" class="form-control" id="city" data-fv-regexp="true" data-error="Please enter value in correct format." required>
				<div class="help-block with-errors"></div>
			</div>
			<div class="form-group col-sm-2">
                <label for="country" class="control-label">Country*</label>
				<input type="text" name="country" value="<?=$country?$country:'Sweden'?>" class="form-control" id="country" data-fv-regexp="true" data-error="Please enter value in correct format." required>
				<div class="help-block with-errors"></div>
			</div>
			<div class="form-group col-sm-2">
                <label for="postal_code" class="control-label">Postal Code*</label>
				<input type="text" name="postal_code" value="<?=$postal_code?>" class="form-control" id="postal_code" data-fv-regexp="true" data-error="Please enter value in correct format." required>
				<div class="help-block with-errors"></div>
			</div>
			<div class="clearfix"></div>
			<div class="form-group col-md-6">
				<div class="form-group">
					<label for="website" class="control-label">Website</label>
					<input type="text" name="website" value="<?=$website?>" class="form-control" id="website" data-fv-regexp="true" data-error="Please enter value in correct format.">
					<div class="help-block with-errors"></div>
				</div>
				<div class="form-group">
					<label for="aggrement_note" class="control-label">Agreement Note</label>
					<textarea name="aggrement_note" class="form-control" id="aggrement_note" data-fv-regexp="true" data-error="Please enter value in correct format." maxlength="250"><?=$aggrement_note?></textarea>
					<div class="help-block with-errors"></div>
				</div>
			</div>
			<div class="form-group col-md-6">
				<label for="aggrement_note" class="control-label">Vendor Logo (size should be less than 1MB)</label>
				<input type="file" name="vendor_logo" id="vendor_logo<?=$id?>" class="dropify dropify-area-img vendor_logo" data-max-file-size="1M" data-height="150" <?php if($vendor_logo AND file_exists(FILES_PATH.'media/'.$vendor_logo)){ ?> data-default-file="<?=SITE_PATH?>uploaded_files/media/<?=$vendor_logo?>" <?php } ?> />
			</div>
			<div class="clearfix"></div>
			
			<div class="form-group col-sm-2">
                <label for="status" class="control-label">Status</label>
				<select class="form-control" name="status" id="status" data-fv-regexp="true" data-error="Please select value">
					<?php foreach($installerStatus as $skey=>$sval){
						if($skey==$status){
							$inStatusSel = 'selected';
						}else{
							$inStatusSel = '';
						}
					?>
					<option value="<?=$skey?>" <?=$inStatusSel?>><?=$sval?></option>
					<?php } ?>
				</select>
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
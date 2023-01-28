<?php 
include("../../lib/opin.inc.php");
extract($_POST);
$HTML = "";
if($cust_id){
	$custQry = $cms->db_query("SELECT * FROM #_leads where id=$cust_id ");
	$custRes = $custQry->fetch_array();
	extract($custRes);
	
	$HTML .='<div class="form-group col-sm-5">
		<label for="project_address" class="control-label">Address*</label>
		<input type="text" name="project_address" class="form-control" id="project_address" value="'.$proposal_address.'" required>
		<div class="help-block with-errors"></div>
	</div>	
	<div class="form-group col-sm-3">
		<label for="project_city" class="control-label">City</label>
		<input type="text" name="project_city" value="'.$city.'" class="form-control" id="project_city" data-fv-regexp="true" data-error="Please enter value in correct format.">
		<div class="help-block with-errors"></div>
	</div>
	<div class="form-group col-sm-2">
		<label for="project_country" class="control-label">Country</label>
		<input type="text" name="project_country" value="Sweden" class="form-control" id="project_country" data-fv-regexp="true" data-error="Please enter value in correct format.">
		<div class="help-block with-errors"></div>
	</div>
	<div class="form-group col-sm-2">
		<label for="project_postal_code" class="control-label">Postal Code</label>
		<input type="text" name="project_postal_code" value="'.$postal_code.'" class="form-control" id="project_postal_code" data-fv-regexp="true" data-error="Please enter value in correct format.">
		<div class="help-block with-errors"></div>
	</div>
	<div class="clearfix"></div>';
		
	echo $HTML;
}else{
	echo 0;
}
die();
?>
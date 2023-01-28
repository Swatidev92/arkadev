<?php defined('_JEXEC') or die('Restricted access'); ?>
 <?php 
$pid = $_GET['id']; 
if($cms->is_post_back()){  
  
	$_POST["cat_ids"] = implode(',',$_POST["cat_ids"]);
	if($pid){ 
		$_POST["action_date"] = date("Y-m-d h:i:s");
		$cms->sqlquery("rs","faqs",$_POST, 'id', $pid);
		$adm->sessset('Record has been updated', 's');
	} else {  
		$_POST["create_date"] = date("Y-m-d h:i:s");
		$_POST["action_date"] = date("Y-m-d h:i:s");
		$cms->sqlquery("rs","faqs",$_POST);
		$adm->sessset('Record has been added', 's');
	}
	 
	if(isset($_GET['start']) && $_GET['start'] > 0) {
		$path = SITE_PATH_ADM.CPAGE."/index.php?start=".$_GET['start'];
	} else {
		$path = SITE_PATH_ADM.CPAGE;
	}
	$cms->redir($path, true);	
	
}  
	$rsAdmin = $cms->db_query("select * from #_faqs where id='".$pid."'");
	$arrAdmin = $rsAdmin->fetch_array(); 
	@extract($arrAdmin);
	
//print_r($catArr);	
 
?>
<!-- .row -->
<div class="row">
    <div class="col-sm-12">
        <div class="white-box panel-body">
			<ul class="nav customtab2 nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#eng" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"> English</span></a></li>
				<li role="presentation" class=""><a href="#swe" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Swedish</span></a></li>
			</ul>
            <!-- Tab panes -->
            <div class="tab-content">
				<div role="tabpanel" class="tab-pane fade active in" id="eng">
					<div class="form-group col-md-9">
						<label for="question" class="control-label">Question</label>
						<input type="text" name="question" id="question" title="Question"  value="<?=$question?>" class="form-control" placeholder="Question" data-fv-regexp="true" required data-error="Please enter question">
						<div class="help-block with-errors"></div>
					</div>
					<div class="clearfix"></div> 
						<div class="form-group col-sm-9">
						<label for="answer" class="control-label">Answer</label>
						<textarea name="answer" rows="7" id="answer" title="Answer" class="form-control" placeholder="Answer" data-fv-regexp="true" required data-error="Please enter Answer"><?=$answer?></textarea>
						<div class="help-block with-errors"></div>
					</div>			
					<div class="clearfix"></div> 
					<div class="form-group col-sm-6">
						<label for="cat_ids" class="control-label">Services*</label>
						<select class="form-control-new select2" name="cat_ids[]" title="Services" multiple>
							<?php echo get_faq_cat($cat_id,$cat_ids);?>
						</select>
						<div class="help-block with-errors"></div>
					</div>
					<div class="clearfix"></div>
					<div class="form-group col-sm-6">
						<label for="inputPassword" class="control-label">Status</label>
						<select class="form-control" name="status"  id="status" lang="R" title="status" >
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
				
				<div role="tabpanel" class="tab-pane fade" id="swe">
					<div class="form-group col-md-9">
						<label for="question_sw" class="control-label">Question</label>
						<input type="text" name="question_sw" id="question_sw" title="Question" value="<?=$question_sw?>" class="form-control" placeholder="Question" data-fv-regexp="true" required data-error="Please enter question">
						<div class="help-block with-errors"></div>
					</div>
					<div class="clearfix"></div> 
						<div class="form-group col-sm-9">
						<label for="answer_sw" class="control-label">Answer</label>
						<textarea name="answer_sw" rows="7" id="answer_sw" title="Answer" class="form-control" placeholder="Answer" data-fv-regexp="true" required data-error="Please enter Answer"><?=$answer_sw?></textarea>
						<div class="help-block with-errors"></div>
					</div>			
					<div class="clearfix"></div> 
					<div class="form-group col-sm-12">
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
        </div>
	</div>
</div>
      <!-- /.row -->
     
<script> 
$("#cat_ids").on("change", function(){
	if($(this).val()!=''){
		var sub_cat_ids = $("#sub_cat_ids").val();
		$.ajax({
			type: "POST",
			url: "<?=SITE_PATH_ADM.CPAGE?>/ajaxGetSubCat.php",
			data: 'sub_cat_ids='+sub_cat_ids+'&ids='+$(this).val(),
			success: function (data) {
				$("#sub_cat_ids").html(data);
			}
		});
	}
});
</script> 
 
    
<script> 
$("#sub_cat_ids").on("change", function(){
	if($(this).val()!=''){
		var cat_ids = $("#cat_ids").val();
		var sub_cat_ids = $("#sub_cat_ids").val();
		var services_ids = $("#service_ids").val();
		$.ajax({
			type: "POST",
			url: "<?=SITE_PATH_ADM.CPAGE?>/ajaxGetServices.php",
			data: 'services_ids='+services_ids+'&sub_cat_ids='+sub_cat_ids+'&cat_ids='+cat_ids,
			success: function (data) {
				$("#service_ids").html(data);
			}
		});
	}
});
</script>  
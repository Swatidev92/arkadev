<style>
.upload-box{
	background: #ffffff;
    padding: 25px;
    margin-bottom: 15px;
    box-shadow: 0 14px 28px rgb(0 0 0 / 15%), 0 10px 10px rgb(0 0 0 / 13%);
    border-radius: 8px;
}
</style>
<div id="uplaod">
	<div class="form-section-heading1">	
		<h2>Upload Files (Size should be less than 5 MB)</h2>
	</div>				
	<div class="form-group col-sm-12">
		<?php $leadID = $cms->getSingleResult("SELECT lead_id FROM #_leads WHERE id=".$cust_id." ");
		
		$docfileQry = $cms->db_query("SELECT * FROM #_uploads where lead_id=$leadID AND file_type=1 ");
		if($docfileQry->num_rows>0){ 
			while($fileRes = $docfileQry->fetch_array()){
				$uploadedDoc[] = $fileRes['file_title'];
			}
			//print_r($uploadedDoc);
		}
		?>
		<div class="col-sm-6">
			<div class="upload-box">
				<h3 class="text-center">Documents</h3>
				<?php foreach($documentType as $doc_id=>$doc_name){	?>
				<?php if($doc_id==1){
				if(!in_array($doc_name,$uploadedDoc)){ ?>
				<div class="form-group col-sm-12">
					<h4><?=$doc_name?> (Dimensioning)</h4>
					<input type="hidden" name="doc_title[]" value="<?=$doc_name?>" class="form-control" id="doc_title">
					<input type="file" id="doc_upload" name="doc_upload[]">
				</div>
				<div class="clearfix"></div>
				<hr>
				<?php }else{
				$docfileQry = $cms->db_query("SELECT * FROM #_uploads where lead_id=$leadID AND file_type=1 AND file_title='".$doc_name."' order by id ");
				$fileRes = $docfileQry->fetch_array();
				?>
				<div class="form-group col-sm-12">
					<div id="<?=$fileRes['id']?>">
						<h3><?=$fileRes['file_title']?$fileRes['file_title'].' (Dimensioning)- ':''?></h3>
						<?=$fileRes['file_upload']?> <a href="javascript:void(0)" class="remove_icon" onClick="remove_uploaded_file('<?=$fileRes['id']?>','<?=$fileRes['file_upload']?>')" data-toggle="tooltip" data-original-title="Delete File"><img src="<?=SITE_PATH_ADM?>images/close-btn.png"></a> <a href="<?=SITE_PATH.UPLOAD_FILES_PTH?>/<?=UP_FILES_UPLOADS?>/<?=$fileRes['file_upload']?>" download>View</a></div>
				</div>
				<div class="clearfix"></div>
				<hr>
				<?php } } ?>
				<?php if($doc_id==2){ ?>
				<div class="mms-wrapper">					
					<div class="row">
						<div class="col-md-12">
							<h4>MMS Report Roof (Dimensioning)</h4>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12">
						<?php $docfileQry = $cms->db_query("SELECT * FROM #_uploads where lead_id=$leadID AND file_type=1 AND file_title='".$doc_name."' ");
						$mms_count = $docfileQry->num_rows;
						$num=1;
						while($fileRes = $docfileQry->fetch_array()){
						?>
						<li id="<?=$fileRes['id']?>"><b><?=$fileRes['file_title']?$fileRes['file_title'].' '.$num.' - ':''?></b> <?=$fileRes['file_upload']?> <a href="javascript:void(0)" class="remove_icon" onClick="remove_uploaded_file('<?=$fileRes['id']?>','<?=$fileRes['file_upload']?>')" data-toggle="tooltip" data-original-title="Delete File"><img src="<?=SITE_PATH_ADM?>images/close-btn.png"></a> <a href="<?=SITE_PATH?><?=UPLOAD_FILES_PTH?>/<?=UP_FILES_UPLOADS?>/<?=$fileRes['file_upload']?>" download>View</a></li>
						<?php $num++;} ?>
						</div>
						<!--<div class="col-md-7">
							<input type="hidden" name="doc_title[]" value="<?=$doc_name?>" class="form-control" id="doc_title">
							<input type="file" id="doc_upload" name="doc_upload[]">
						</div>-->
					</div>
					<div class="row">
						<div class="col-xs-4 col-sm-4 col-md-4">
							<h5><button class="btn btn-primary list_add_mms" type="button">Add New +</button></h5>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				<hr>
				<?php } ?>
				
				<?php if($doc_id==3){ ?>
				<div class="bom-mms-wrapper">					
					<div class="row">
						<div class="col-md-12">
							<h4>BOM MMS Roof (Dimensioning)</h4>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12">
						<?php $docfileQry = $cms->db_query("SELECT * FROM #_uploads where lead_id=$leadID AND file_type=1 AND file_title='".$doc_name."' ");
						$bom_mms_count = $docfileQry->num_rows;
						$num=1;
						while($fileRes = $docfileQry->fetch_array()){
						?>
						<li id="<?=$fileRes['id']?>"><b><?=$fileRes['file_title']?$fileRes['file_title'].' '.$num.' - ':''?></b> <?=$fileRes['file_upload']?> <a href="javascript:void(0)" class="remove_icon" onClick="remove_uploaded_file('<?=$fileRes['id']?>','<?=$fileRes['file_upload']?>')" data-toggle="tooltip" data-original-title="Delete File"><img src="<?=SITE_PATH_ADM?>images/close-btn.png"></a> <a href="<?=SITE_PATH?><?=UPLOAD_FILES_PTH?>/<?=UP_FILES_UPLOADS?>/<?=$fileRes['file_upload']?>" download>View</a></li>
						<?php $num++;} ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-4 col-sm-4 col-md-4">
							<h5><button class="btn btn-primary list_add_bom_mms" type="button">Add New +</button></h5>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				<hr>
				<?php } ?>
				
				<?php if($doc_id==4){ ?>
				<div class="formalon-wrapper">					
					<div class="row">
						<div class="col-md-12">
							<h4><?=$doc_name?> (Sales)</h4>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12">
						<?php $docfileQry = $cms->db_query("SELECT * FROM #_uploads where lead_id=$leadID AND file_type=1 AND file_title='".$doc_name."' ");
						$formalon_count = $docfileQry->num_rows;
						$num=1;
						while($fileRes = $docfileQry->fetch_array()){
						?>
						<li id="<?=$fileRes['id']?>"><b><?=$fileRes['file_title']?$fileRes['file_title'].' '.$num.' - ':''?></b> <?=$fileRes['file_upload']?> <a href="javascript:void(0)" class="remove_icon" onClick="remove_uploaded_file('<?=$fileRes['id']?>','<?=$fileRes['file_upload']?>')" data-toggle="tooltip" data-original-title="Delete File"><img src="<?=SITE_PATH_ADM?>images/close-btn.png"></a> <a href="<?=SITE_PATH?><?=UPLOAD_FILES_PTH?>/<?=UP_FILES_UPLOADS?>/<?=$fileRes['file_upload']?>" download>View</a></li>
						<?php $num++;} ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-4 col-sm-4 col-md-4">
							<h5><button class="btn btn-primary list_add_formalon" type="button">Add New +</button></h5>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				<hr>
				<?php } ?>
				<div class="clearfix"></div>		
				<?php } ?>
				<?php $docfileQry = $cms->db_query("SELECT * FROM #_uploads where lead_id=$leadID AND file_type=1 AND file_title!='Solar Report' AND file_title!='MMS Report Roof' AND file_title!='BOM MMS Roof' AND file_title!='Föranmälan' ");
				if($docfileQry->num_rows){ 
				echo '<h4>Other</h4>';
				while($fileRes = $docfileQry->fetch_array()){
				?>
				<div class="form-group col-sm-12">
					<li id="<?=$fileRes['id']?>"><b><?=$fileRes['file_title']?$fileRes['file_title'].' - ':''?></b> <?=$fileRes['file_upload']?> <a href="javascript:void(0)" class="remove_icon" onClick="remove_uploaded_file('<?=$fileRes['id']?>','<?=$fileRes['file_upload']?>')" data-toggle="tooltip" data-original-title="Delete File"><img src="<?=SITE_PATH_ADM?>images/close-btn.png"></a> <a href="<?=SITE_PATH?><?=UPLOAD_FILES_PTH?>/<?=UP_FILES_UPLOADS?>/<?=$fileRes['file_upload']?>" download>View</a></li>
				</div>
				<?php } } ?>
				<div class="clearfix"></div>
				<div class="form-group col-sm-12">
					<button type="submit" class="btn btn-primary" name="save_doc">Save Document</button>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		
		<div class="col-sm-6">
			<div class="upload-box">
				<h3 class="text-center">Picture</h3>
				<?php foreach($pictureType as $pic_id=>$pic_name){?>
				<?php if($pic_id==1){
				$picfileQry = $cms->db_query("SELECT * FROM #_uploads where lead_id=$leadID AND file_type=2 AND file_title='".$pic_name."' ");
				if($picfileQry->num_rows>0){
				$picfileRes = $picfileQry->fetch_array(); ?>
				<div class="form-group col-sm-12">
					<div class="row" id="<?=$picfileRes['id']?>">
						<div class="form-group col-sm-10">
							<h4><?=$pic_name?> (Dimensioning)</h4>
							<img src="<?=SITE_PATH.UPLOAD_FILES_PTH.'/'.UP_FILES_UPLOADS.'/'.$picfileRes['file_upload']?>" width="100%">
						</div>
						<div class="form-group col-sm-2">
							<a href="javascript:void(0)" class="remove_icon" onClick="remove_uploaded_file('<?=$picfileRes['id']?>','<?=$picfileRes['file_upload']?>')" data-toggle="tooltip" data-original-title="Delete File"><img src="<?=SITE_PATH_ADM?>images/close-btn.png"></a>
						</div>
					</div>
				</div>
				<?php }else{ ?>
				<div class="form-group col-sm-12">
					<h4><?=$pic_name?> (Dimensioning)</h4>
					<input type="hidden" name="pic_title[]" value="<?=$pic_name?>" class="form-control" id="pic_title">
					<!--<input type="file" id="pic_upload" name="pic_upload[]">-->
					<input type="file" id="pic_upload" name="pic_upload[]">
				</div>	
				<?php } ?>
				<div class="clearfix"></div>
				<hr>
				<?php } ?>
				
				<?php if($pic_id==2){ ?>
				<div class="panel-roof-wrapper">					
					<div class="row">
						<div class="col-md-12">						
							<h4><?=$pic_name?> (Dimensioning)</h4>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12">
						<?php $picfileQry = $cms->db_query("SELECT * FROM #_uploads where lead_id=$leadID AND file_type=2 AND file_title='".$pic_name."' order by id ");
						$panel_roof_count = $picfileQry->num_rows;
						$num=1;
						while($picfileRes = $picfileQry->fetch_array()){
						?>
						<div class="row" id="<?=$picfileRes['id']?>">
							<div class="form-group col-sm-8">
								<h5><b><?=$picfileRes['file_title']?$picfileRes['file_title'].' '.$num.' - ':''?></b></h5>
								<img src="<?=SITE_PATH.UPLOAD_FILES_PTH.'/'.UP_FILES_UPLOADS.'/'.$picfileRes['file_upload']?>" width="100%">
							</div>
							<div class="form-group col-sm-3">
								<a href="javascript:void(0)" class="remove_icon" onClick="remove_uploaded_file('<?=$picfileRes['id']?>','<?=$picfileRes['file_upload']?>')" data-toggle="tooltip" data-original-title="Delete File"><img src="<?=SITE_PATH_ADM?>images/close-btn.png"></a>
							</div>
						</div>
						<?php $num++;} ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-4 col-sm-4 col-md-4">
							<h5><button class="btn btn-primary add_panel_roof" type="button">Add New +</button></h5>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				<hr>
				<?php } ?>
				
				<?php if($pic_id==3){
				$picfileQry = $cms->db_query("SELECT * FROM #_uploads where lead_id=$leadID AND file_type=2 AND file_title='".$pic_name."' ");
				if($picfileQry->num_rows>0){
				$picfileRes = $picfileQry->fetch_array(); ?>
				<div class="form-group col-sm-12">
					<div class="row" id="<?=$picfileRes['id']?>">
						<div class="form-group col-sm-8">
							<h4><?=$pic_name?> (Sales)</h4>
							<img src="<?=SITE_PATH.UPLOAD_FILES_PTH.'/'.UP_FILES_UPLOADS.'/'.$picfileRes['file_upload']?>" width="100%">
						</div>
						<div class="form-group col-sm-3">
							<a href="javascript:void(0)" class="remove_icon" onClick="remove_uploaded_file('<?=$picfileRes['id']?>','<?=$picfileRes['file_upload']?>')" data-toggle="tooltip" data-original-title="Delete File"><img src="<?=SITE_PATH_ADM?>images/close-btn.png"></a>
						</div>
					</div>
				</div>
				<?php }else{ ?>
				<div class="form-group col-sm-12">
					<h4><?=$pic_name?> (Sales)</h4>
					<input type="hidden" name="pic_title[]" value="<?=$pic_name?>" class="form-control" id="pic_title">
					<!--<input type="file" id="pic_upload" name="pic_upload[]">-->
					<input type="file" id="pic_upload" name="pic_upload[]">
				</div>	
				<?php } ?>
				<div class="clearfix"></div>
				<hr>
				<?php } ?>
				
				<?php if($pic_id==4){
				$picfileQry = $cms->db_query("SELECT * FROM #_uploads where lead_id=$leadID AND file_type=2 AND file_title='".$pic_name."' ");
				if($picfileQry->num_rows>0){
				$picfileRes = $picfileQry->fetch_array(); ?>
				<div class="form-group col-sm-12">
					<div class="row" id="<?=$picfileRes['id']?>">
						<div class="form-group col-sm-8">
							<h4><?=$pic_name?> (Sales)</h4>
							<img src="<?=SITE_PATH.UPLOAD_FILES_PTH.'/'.UP_FILES_UPLOADS.'/'.$picfileRes['file_upload']?>" width="100%">
						</div>
						<div class="form-group col-sm-3">
							<a href="javascript:void(0)" class="remove_icon" onClick="remove_uploaded_file('<?=$picfileRes['id']?>','<?=$picfileRes['file_upload']?>')" data-toggle="tooltip" data-original-title="Delete File"><img src="<?=SITE_PATH_ADM?>images/close-btn.png"></a>
						</div>
					</div>
				</div>
				<?php }else{ ?>
				<div class="form-group col-sm-12">
					<h4><?=$pic_name?> (Sales)</h4>
					<input type="hidden" name="pic_title[]" value="<?=$pic_name?>" class="form-control" id="pic_title">
					<!--<input type="file" id="pic_upload" name="pic_upload[]">-->
					<input type="file" id="pic_upload" name="pic_upload[]">
				</div>	
				<?php } ?>
				<div class="clearfix"></div>
				<hr>
				<?php } ?>
				
				<?php if($pic_id==5){
				$picfileQry = $cms->db_query("SELECT * FROM #_uploads where lead_id=$leadID AND file_type=2 AND file_title='".$pic_name."' ");
				if($picfileQry->num_rows>0){
				$picfileRes = $picfileQry->fetch_array(); ?>
				<div class="form-group col-sm-12">
					<div class="row" id="<?=$picfileRes['id']?>">
						<div class="form-group col-sm-8">
							<h4><?=$pic_name?> (Sales)</h4>
							<img src="<?=SITE_PATH.UPLOAD_FILES_PTH.'/'.UP_FILES_UPLOADS.'/'.$picfileRes['file_upload']?>" width="100%">
						</div>
						<div class="form-group col-sm-3">
							<a href="javascript:void(0)" class="remove_icon" onClick="remove_uploaded_file('<?=$picfileRes['id']?>','<?=$picfileRes['file_upload']?>')" data-toggle="tooltip" data-original-title="Delete File"><img src="<?=SITE_PATH_ADM?>images/close-btn.png"></a>
						</div>
					</div>
				</div>
				<?php }else{ ?>
				<div class="form-group col-sm-12">
					<h4><?=$pic_name?> (Sales)</h4>
					<input type="hidden" name="pic_title[]" value="<?=$pic_name?>" class="form-control" id="pic_title">
					<!--<input type="file" id="pic_upload" name="pic_upload[]">-->
					<input type="file" id="pic_upload" name="pic_upload[]">
				</div>	
				<?php } ?>
				<div class="clearfix"></div>
				<hr>
				<?php } ?>
				
				<?php if($pic_id==6){
				$picfileQry = $cms->db_query("SELECT * FROM #_uploads where lead_id=$leadID AND file_type=2 AND file_title='".$pic_name."' ");
				if($picfileQry->num_rows>0){
				$picfileRes = $picfileQry->fetch_array(); ?>
				<div class="form-group col-sm-12">
					<div class="row" id="<?=$picfileRes['id']?>">
						<div class="form-group col-sm-8">
							<h4><?=$pic_name?> (Sales)</h4>
							<img src="<?=SITE_PATH.UPLOAD_FILES_PTH.'/'.UP_FILES_UPLOADS.'/'.$picfileRes['file_upload']?>" width="100%">
						</div>
						<div class="form-group col-sm-3">
							<a href="javascript:void(0)" class="remove_icon" onClick="remove_uploaded_file('<?=$picfileRes['id']?>','<?=$picfileRes['file_upload']?>')" data-toggle="tooltip" data-original-title="Delete File"><img src="<?=SITE_PATH_ADM?>images/close-btn.png"></a>
						</div>
					</div>
				</div>
				<?php }else{ ?>
				<div class="form-group col-sm-12">
					<h4><?=$pic_name?> (Sales)</h4>
					<input type="hidden" name="pic_title[]" value="<?=$pic_name?>" class="form-control" id="pic_title">
					<!--<input type="file" id="pic_upload" name="pic_upload[]">-->
					<input type="file" id="pic_upload" name="pic_upload[]">
				</div>	
				<?php } ?>
				<div class="clearfix"></div>
				<hr>
				<?php } ?>
				
				<?php if($pic_id==7){ ?>
				<div class="roof-picture-wrapper">					
					<div class="row">
						<div class="col-md-12">
							<h4><?=$pic_name?> (Sales)</h4>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12">
						<?php $picfileQry = $cms->db_query("SELECT * FROM #_uploads where lead_id=$leadID AND file_type=2 AND file_title='".$pic_name."' order by id ");
						$roof_pic_count = $picfileQry->num_rows;
						$num=1;
						while($picfileRes = $picfileQry->fetch_array()){
						?>
						<div class="row" id="<?=$picfileRes['id']?>">
							<div class="form-group col-sm-8">
								<h5><b><?=$picfileRes['file_title']?$picfileRes['file_title'].' '.$num.' - ':''?></b></h5>
								<img src="<?=SITE_PATH.UPLOAD_FILES_PTH.'/'.UP_FILES_UPLOADS.'/'.$picfileRes['file_upload']?>" width="100%">
							</div>
							<div class="form-group col-sm-3">
								<a href="javascript:void(0)" class="remove_icon" onClick="remove_uploaded_file('<?=$picfileRes['id']?>','<?=$picfileRes['file_upload']?>')" data-toggle="tooltip" data-original-title="Delete File"><img src="<?=SITE_PATH_ADM?>images/close-btn.png"></a>
							</div>
						</div>
						<?php $num++;} ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-4 col-sm-4 col-md-4">
							<h5><button class="btn btn-primary add_roof_pic" type="button">Add New +</button></h5>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				<hr>
				<?php } ?>
				<div class="clearfix"></div>
				<?php } ?>
				<div class="clearfix"></div>
				<?php $otherPicfileQry = $cms->db_query("SELECT * FROM #_uploads where lead_id=$leadID AND file_type=2 AND file_title!='String Diagram' AND file_title!='Panel Layout Roof' AND file_title!='All Equipment Placement' AND file_title!='Inverter Placement' AND file_title!='EV Placement' AND file_title!='Battery Placement' AND file_title!='Roof Picture' ");
				if($otherPicfileQry->num_rows){ 
				echo '<h4>Other</h4>';
				while($otherPicfileRes = $otherPicfileQry->fetch_array()){
				?>
				<div class="row" id="<?=$otherPicfileRes['id']?>">
					<div class="form-group col-sm-8">
						<h5><b><?=$otherPicfileRes['file_title']?$otherPicfileRes['file_title'].' - ':''?></b></h5>
						<img src="<?=SITE_PATH.UPLOAD_FILES_PTH.'/'.UP_FILES_UPLOADS.'/'.$otherPicfileRes['file_upload']?>" width="100%">
					</div>
					<div class="form-group col-sm-3">
						<a href="javascript:void(0)" class="remove_icon" onClick="remove_uploaded_file('<?=$otherPicfileRes['id']?>','<?=$otherPicfileRes['file_upload']?>')" data-toggle="tooltip" data-original-title="Delete File"><img src="<?=SITE_PATH_ADM?>images/close-btn.png"></a>
					</div>
				</div>
				<?php } } ?>
				<div class="form-group col-sm-12">
					<button type="submit" class="btn btn-primary" name="save_picture">Save Picture</button>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="form-group col-sm-12">
		<div class="file_wrapper">	
			<div class="form-group col-sm-2">
				<a href="javascript:void(0);" class="btn btn-primary add_file_button">Upload more files</a>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="form-group col-sm-12" id="upload_files" style="display:none">
			<button type="submit" class="btn btn-primary" name="upload_files">Save</button>
		</div>
	</div>
	<!--<div class="form-group col-sm-12">
		<?php $docfileQry = $cms->db_query("SELECT * FROM #_uploads where lead_id=$leadID AND file_type=1 order by id ");
		if($docfileQry->num_rows>0){ ?>
			<ul>
				<?php while($fileRes = $docfileQry->fetch_array()){?>
				<li id="<?=$fileRes['id']?>"><b><?=$fileRes['file_title']?$fileRes['file_title'].' - ':''?></b> <?=$fileRes['file_upload']?> <a href="javascript:void(0)" class="remove_icon" onClick="remove_uploaded_file('<?=$fileRes['id']?>','<?=$fileRes['file_upload']?>')" data-toggle="tooltip" data-original-title="Delete File"><img src="<?=SITE_PATH_ADM?>images/close-btn.png"></a> <a href="<?=SITE_PATH?>uploaded_files/uploads/<?=$fileRes['file_upload']?>" download>View</a></li>						
				<?php }	?>
			</ul>						
		<?php }	?>
	</div>-->
	<div class="clearfix"></div>
</div>
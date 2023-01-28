<?php defined('_JEXEC') or die('Restricted access'); ?>
 <?php 
$pid = $_GET['id']; 
if($cms->is_post_back()){
	//print_r($_POST);die;
		
	/*if($pid){ 
		if($_POST['old_cat_name']!=$_POST['cat_name']){
			$catExists = $cms->db_query("Select cat_name from #_media_category where cat_name='".$_POST['cat_name']."' AND is_deleted=0 ");
			if($catExists->num_rows>0){
				$adm->sessset('This category already exists.', 'e');
			}else{
				$cms->sqlquery("rs","media_category",$_POST, 'id', $pid);
				$adm->sessset('Record has been updated', 's');
			}
		}else{
			$cms->sqlquery("rs","media_category",$_POST, 'id', $pid);
			$adm->sessset('Record has been updated', 's');
		}
	} 
	else {		
		if($_POST['old_cat_name']!=$_POST['cat_name']){
			$catExists = $cms->db_query("Select cat_name from #_media_category where cat_name='".$_POST['cat_name']."' AND is_deleted=0");
			if($catExists->num_rows>0){
				$adm->sessset('This category already exists.', 'e');
			}else{
				$pid = $cms->sqlquery("rs","media_category",$_POST);
				$adm->sessset('Record has been added', 's');
			}
		}else{
			$pid = $cms->sqlquery("rs","media_category",$_POST);
			$adm->sessset('Record has been added', 's');
		}		
	}
	*/
	
	if(isset($_FILES['file_upload']) and count(array_filter($_FILES['file_upload']['tmp_name']))>0){
		if(count($_FILES["file_upload"]["name"])>0){				
			$pcount = count($_FILES["file_upload"]["name"]);
			for($i=0; $i<$pcount; $i++){
				$uploadArr['media_title'] = $_POST['file_title'][$i];
				$uploadArr['media_category'] = 1;
									
				if(!empty($_FILES["file_upload"]["name"][$i])){
					$path = $_FILES["file_upload"]["name"][$i];
					$end = pathinfo($path, PATHINFO_EXTENSION);
					$filename = $_FILES['file_upload']['name'][$i]; 
					$file_loc = $_FILES['file_upload']['tmp_name'][$i];
					$file_size = $_FILES['file_upload']['size'][$i];
					$file_type = $_FILES['file_upload']['type'][$i];
					$folder = FILES_PATH."media/";
					// make file name in lower case
					$new_file_name = strtolower($filename);
					$final_file= str_replace(" ","-",$new_file_name);
					if($file_size>0 && $file_size>5000000){
						echo "<script>alert('File size should be less than 5MB')</script>";
					}else{
						move_uploaded_file($file_loc,$folder.$final_file);
						$uploadArr['media_name']=$final_file;
						$cms->sqlquery("rs","media_files",$uploadArr);
					}
				}			
			}
		}	
	}
	 
	if(isset($_GET['start']) && $_GET['start'] > 0) {
		$path = SITE_PATH_ADM.CPAGE."/index.php?start=".$_GET['start'];
	} else {
		$path = SITE_PATH_ADM.CPAGE;
	}
	$cms->redir($path, true);	
	
}  
	$rsAdmin = $cms->db_query("select * from #_media_category where id='".$pid."'");
	$arrAdmin = $rsAdmin->fetch_array(); 
	@extract($arrAdmin);
	 
 
?>
<!-- .row -->
<div class="row">
    <div class="col-sm-12">
        <div class="white-box panel-body">
			<!--<div class="form-group col-sm-4">
				<label class="control-label">Category Name*</label>
				<input type="hidden" name="old_cat_name" value="<?=$cat_name?>">
				<input type="text" name="cat_name" id="cat_name" value="<?=$cat_name?>" class="form-control" required>
				<div class="help-block with-errors"></div>
			</div>
			<div class="clearfix"></div>-->
		
			<div class="file_wrapper">
				<div class="form-group col-sm-5">
					<label for="file_title" class="control-label">File Title*</label>
					<input type="text" name="file_title[]" value="<?=$file_title?>" class="form-control" id="file_title" required>
				</div>
				<div class="form-group col-sm-5">
					<label for="file_upload" class="control-label">Upload File (Size should be less than 5 MB)*</label>
					<input type="file" id="file_upload" name="file_upload[]" required>
				</div>	
				<div class="form-group col-sm-2">
					<a href="javascript:void(0);" class="btn btn-primary add_file_button">Upload more files</a>
				</div>
				<div class="clearfix"></div>
			</div>		
			<div class="form-group col-sm-3">
                <button type="submit" class="btn btn-primary" id="submit_btn">Submit</button>
                <button type="button" onClick="history.go(-1)" class="btn btn-primary">Back</button>
            </div>
		</div>
	</div>
</div>
  
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
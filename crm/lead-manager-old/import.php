<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php
$action_message ='';
$pid = $_GET['id']; 
if($cms->is_post_back()){ 
	$validFile  = array("csv");
	if($_FILES['filename']['name']){
		//echo $end = strtolower(end(explode(".",$_FILES['filename']['name']))); die;
		$end = pathinfo($_FILES['filename']['name'], PATHINFO_EXTENSION);
		if(in_array($end,$validFile)){
			if(!empty($_FILES["filename"]["name"])){
				$filename = rand(1000,100000)."-".$_FILES['filename']['name'];
				$file_loc = $_FILES['filename']['tmp_name'];
				$file_size = $_FILES['filename']['size'];
				$file_type = $_FILES['filename']['type'];
				$folder = FILES_PATH."csvfiles/";
				// new file size in KB
				$new_size = $file_size/1024;  
				// new file size in KB

				// make file name in lower case
				$new_file_name = strtolower($filename);
				
				$final_file=str_replace(' ','-',$new_file_name);
				$_POST["filename"] = $final_file;
				move_uploaded_file($file_loc,$folder.$final_file);
			}
		}
	}
	// Name of your CSV file
	$csv_file = FILES_PATH ."csvfiles/". $_POST["filename"];  


	if(($handle = fopen($csv_file, "r")) !== FALSE) {
		//echo $csv_file;die;
		fgetcsv($handle);   
		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			$num = count($data);
			for ($c=0; $c < $num; $c++) {
			  $col[$c] = $data[$c]; 
			}
			//print_r($col);die;
			$_POSTS["customer_name"] 		= $col[0];
			$_POSTS["email_id"] 			= $col[1];
			$_POSTS["contact_no"] 			= $col[2];
			$_POSTS["company"] 				= $col[3];
			$_POSTS["designation"] 			= $col[4];
			$_POSTS["num_of_session"] 		= $col[5];
			
			// SQL Query to insert data into DataBase
			//print_r($_POSTS);die;
			if(!empty($_POSTS["customer_name"]) AND !empty($_POSTS["email_id"])){
				$cms->sqlquery("rs","leads",$_POSTS);
			}
		
		}
		fclose($handle);
	}
	$adm->sessset('File data successfully imported to database!', 's');
} 
?>
 
<!-- .row -->
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
			<div class="form-group col-sm-6">
				<label for="inputName1" class="control-label">*Note : <a href="<?=SITE_PATH?>lms/uploaded_files/csvfiles/Format.csv" target="_blank" download >Download CSV Format to upload Leads </a></label>
			</div>
			<div class="clearfix"></div>
			<div class="form-group col-sm-6">
				<label for="inputName1" class="control-label">Upload Lead* </label>
				<div class="fileinput fileinput-new input-group" data-provides="fileinput">
					<div class="form-control" data-trigger="fileinput"> 
						<i class="glyphicon glyphicon-file fileinput-exists"></i> 
						<span class="fileinput-filename"></span>
					</div>
					<span class="input-group-addon btn btn-default btn-file"> 
						<span class="fileinput-new">Select file</span> 
						<span class="fileinput-exists">Change</span>
						<input type="hidden">
						<input type="file" name="filename" required>
					</span> 
					<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a> 
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="form-group col-sm-12">
				<button type="submit" class="btn btn-primary">Submit</button>
				<button type="reset" class="btn btn-primary">Reset</button>
			</div>	
			<div class="clearfix"></div>			
		</div>
		
    </div>
</div>
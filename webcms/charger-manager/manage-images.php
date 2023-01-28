<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 
$pid = $_GET['id']; 
//$iqry="SELECT id,image,display_order from #_gallery order by id desc";
		
		
		$start = intval($start);
		$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
		$columns = "SELECT * ";
		$sql = " from #_media ";
		$order_by == '' ? $order_by = 'id' : true;
		$order_by2 == '' ? $order_by2 = 'desc' : true;
		$sql_count = "select count(*) ".$sql; 
		$sql .= "order by $order_by $order_by2 ";
		$sql .= "limit $start, $pagesize ";
		$sql = $columns.$sql;
		$result = $cms->db_query($sql);
		$reccnt = $cms->db_scalar($sql_count);
		//echo $sql;
		$url_1="admin";
		$url="media-manager?";
		
if($cms->is_post_back()){
		
	if(!empty($_FILES["media_name"]["name"])){
		$countImage =  count($_FILES["media_name"]["name"]);
		if($countImage>0){
			for($i=0;$i<$countImage;$i++){
				if(!empty($_FILES['media_name']['name'][$i])){
					$filename = rand(1000,100000)."-".$_FILES['media_name']['name'][$i];
					$file_loc = $_FILES['media_name']['tmp_name'][$i];
					$file_size = $_FILES['media_name']['size'][$i];
					$file_type = $_FILES['media_name']['type'][$i];
					$folder = FILES_PATH."about/charger/";
					// make file name in lower case
					$new_file_name = strtolower($filename);
					$final_file= str_replace(" ","-",$new_file_name);
					move_uploaded_file($file_loc,$folder.$final_file);
					$_POST['display_order']=$i+1;
					$_POST['media_name']=$final_file;
					$_POST['media_path']='uploaded_files/charger/';
					//print_r($_POST);die;
					$cms->sqlquery("rs","media",$_POST);
				}
			}
		}
	}		
		
	$adm->sessset('Record has been updated', 's');
	$cms->redir($path, true);
}

?>
<style>
.img_padding{
	position:relative;
	background: #eee;
}
.remove-icon{
	position: absolute;
    top: 0;
    right: 12px;
}
</style>
<!-- .row -->
<div class="row">
    <div class="col-sm-12">
        <div class="white-box"> 
		<h5>Upload Images</h5>
			<div class="form-group col-sm-6">
				<div class="fileinput fileinput-new input-group" data-provides="fileinput">
                    <div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                    <span class="input-group-addon btn btn-default btn-file"> <span class="fileinput-new">Select Multiple Files</span> <span class="fileinput-exists">Change</span>
                    <input type="hidden"><input type="file" name="media_name[]" required multiple>
                    </span> <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
				</div>
				<div class="help-block with-errors"></div>
			</div>		
            <div class="form-group col-sm-6">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
			<div class="clearfix"></div>
        </div>
	</div>
	<div class="col-sm-12">
		 <div class="white-box"> 
		<?php 
		if($result->num_rows>0){ $i=1;
		while($imgRes=$result->fetch_array()){?>
		<div class="col-sm-3" id="<?php echo $imgRes['id']; ?>">
			<div class="img_padding" align="center">
			
				<img src="<?=SITE_PATH.$imgRes['media_path'].$imgRes['media_name']?>" class="img-responsive hosp_img" width="" height=""> 
			</div>
			<p class="remove-icon"><a href="javascript:void(0)" class="remove_icon" onClick="remove_img('<?php echo $imgRes['id']; ?>','<?php echo $imgRes['media_name'];?>')" data-toggle="tooltip" data-original-title="Delete Image"><img src="<?=SITE_PATH_ADM?>images/close-btn.png"></a></p>
		</div>
		<?php $i++;}
			echo "<div class='clearfix'></div>";
		} ?>
		<br><br><div class="clearfix"></div>
		<?php include("../../inc/paging.inc.php")?> 
		</div>
		
	</div>
</div>
      <!-- /.row -->
<script>
function remove_img(id,name){
	if (confirm("Are you sure to delete?")) {
		$.ajax({
			type:"post",
			url: "<?=SITE_PATH_ADM.CPAGE?>/remove_images.php?id="+id+"&name="+name,
			success:function(result){
				if(parseInt(result)=='1'){
					$("#"+id).hide();
				}
				else{
					alert("Something went wrong.Pleas try again.")
				}
			}
		})
	}
}	
</script>	  
<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 
$pid = $_GET['id']; 

if($cms->is_post_back()){ 
	//$_POST['plain_password'] = $_POST['password'];
	//$_POST['password'] = md5($_POST['password']); 

	//print_r($_POST);die;	
	
	if($pid){    		
		$cms->db_query("UPDATE #_users SET customer_name='".$_POST['customer_name']."', contact_no='".$_POST['contact_no']."' WHERE id=$pid ");
		$_SESSION["ses_adm_usr"] = $_POST["customer_name"];
		//$adm->sessset('Record has been updated', 's');	
		//$cms->redir(SITE_PATH_ADM.'profile?id='.$_SESSION["ses_adm_id"]);
	}
	$path = SITE_PATH_ADM.CPAGE.'?id='.$_SESSION["ses_adm_id"];
	echo "<script>window.location.href='".$path."';</script>";
} 

$rsAdmin = $cms->db_query("select * from #_users where id='".$pid."'");
$arrAdmin = $rsAdmin->fetch_array(); 
@extract($arrAdmin);
?>

<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
			<div class="form-group col-sm-4">
                <label for="email_id" class="control-label">Email</label>
                <input type="email"  name="email_id" value="<?=$email_id?>" class="form-control" id="email_id" placeholder="Email" data-error="Email address is invalid" readonly>
            </div>
			<div class="clearfix"></div>
			<div class="form-group col-sm-6">
				<label for="customer_name" class="control-label">Name*</label>
				<input type="text" name="customer_name" value="<?=$customer_name?>" class="form-control" id="customer_name" placeholder="Name" required>
			</div>
			<div class="form-group col-sm-6">
				<label for="contact_no" class="control-label">Contact Number*</label>
				<input type="text" name="contact_no" value="<?=$contact_no?>" class="form-control" id="contact_no" placeholder="Contact Number" required>
			</div>
			<div class="clearfix"></div>
			<div class="form-group col-sm-12">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
			<div class="clearfix"></div>
        </div>
	</div>
</div>
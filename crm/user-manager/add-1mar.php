<?php defined('_JEXEC') or die('Restricted access'); ?>
 <?php 
$pid = $_GET['id']; 
if($cms->is_post_back()){ 
	//$_POST["cat_ids"] = implode(',',$_POST["cat_ids"]);
	//$_POST["sub_cat_ids"] = implode(',',$_POST["sub_cat_ids"]);
	$_POST['plain_password'] = $_POST['password'];
	$_POST['password'] = md5($_POST['password']); 
	
	if($_FILES["profile_image"]["name"]){
			$_POST["profile_image"] = uploadImage("profile_image","users");
	}
	$_POST['user_slug'] = $adm->baseurl($_POST['customer_name']);
	if($pid){         
		$cms->sqlquery("rs","users",$_POST, 'id', $pid);
		$adm->sessset('Record has been updated', 's');
		$user_id=$pid;
	} else {  
		$_POST['urls'] = $adm->baseurl($_POST['name']);
		$user_id=$cms->sqlquery("rs","users",$_POST);
		$adm->sessset('Record has been added', 's');
	}
	// Sending Mail to Customer
	$token=md5($user_id);
	if($send_email){
		$to=$_POST['email_id'];
		$subject = "Dear $customer_name";
		if($_POST["email_verification_status"]=="1"){
		$user_msg ="<p>Dear ".$_POST['customer_name']."</p><br>
		<p>Welcome to Techsupport</p> <p>Here is your login credentials below:</p>
		<table width='100%' style='border-collapse:collapse'>
			<tr>
				<td>URL</td>
				<td><a href='http://www.techsupport.ae/login'>www.techsupport.ae/login</a></td>
			</tr>
			<tr><td>Username</td><td>".$_POST['email_id']."</td></tr>
			<tr><td>Password</td><td>".$_POST['plain_password']."</td></tr>
		</table>";
		$user_msg.="<br><p>Regards<br>Techsupport Team</p>";
		}else{ 
			$user_msg ="<p>Dear ".$_REQUEST['customer_name']."</p><br>
			<p>Welcome to Techsupport</p> <p>Here is your login credentials below:</p>
			<table width='100%' style='border-collapse:collapse'>
			<tr>
				<td>URL</td>
				<td><a href='http://www.techsupport.ae/login'>www.techsupport.ae/login</a></td>
			</tr>
			<tr><td>Username</td><td>".$_POST['email_id']."</td></tr>
			<tr><td>Password</td><td>".$_POST['plain_password']."</td></tr>
			</table>
			<br><p><a style='text-decoration:none;background: #052d46;color: #ffffff;text-transform: uppercase;letter-spacing: 1px;border-radius: 0px; min-height: 45px;padding: 10px 20px;' href='".SITE_PATH."email-verification?auth_token=$token&verify_email=".$_REQUEST['email_id']."'>Click here to verify your email id</a> <br><br>or copy and paste below url to your browser - <br><br> ".SITE_PATH."email-verification?auth_token=$token&verify_email=".$_REQUEST['email_id']."</p>";
			$user_msg.="<br><p>Regards<br>Techsupport Team</p></div></body></html>";
		}
		$headers .= "Reply-To: Techsupport <".FROM_EMAIL.">\r\n"; 
		$headers .= 'From: <'.FROM_EMAIL.'>' . "\r\n";
		$headers .= "X-Sender: Techsupport < ".FROM_EMAIL." >\n";
		$headers .= 'X-Mailer: PHP/' . phpversion();
		$headers .= "X-Priority: 1\n"; // Urgent message!
		$headers .= "Return-Path: ".FROM_EMAIL."\n"; // Return path for errors
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=iso-8859-1\n";
		
		//$headers  = 'MIME-Version: 1.0' . "\r\n";
		//$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		//$headers .= 'From: <'.FROM_EMAIL.'>' . "\r\n";
		//$headers .= "Cc: testsite < mail@testsite.com >\n";
		
		$msgbody=emailFormat($user_msg);
		mail($to,$subject,$msgbody,$headers);
	} 
	if(isset($_GET['start']) && $_GET['start'] > 0) {
		$path = SITE_PATH_ADM.CPAGE."/index.php?start=".$_GET['start'];
	} else {
		$path = SITE_PATH_ADM.CPAGE;
	}
	$cms->redir($path, true);	
	
} 

/*$catArr = array();
$catReq = $cms->db_query("select id, cat_name from #_categories where status=1 AND is_deleted=0 ");
if($catReq->num_rows>0){
	while($catRes = $catReq->fetch_assoc()){
		$catArr[$catRes["id"]] =  $catRes["cat_name"];
	}
}
 
$contriesReq = $cms->db_query("SELECT id, name FROM #_countries WHERE status=1 ORDER BY name ASC ");
$contriesArr = array();
while($contriesRes=$contriesReq->fetch_assoc()){
	$contriesArr[$contriesRes["id"]] = $contriesRes["name"];
}*/
	$rsAdmin = $cms->db_query("select * from #_users where id='".$pid."'");
	$arrAdmin = $rsAdmin->fetch_array(); 
	@extract($arrAdmin);
	 
 
?>
<!-- .row -->
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
			<div class="form-group col-sm-6">
				<label for="customer_name" class="control-label">Name</label>
				<input type="text" name="customer_name" value="<?=$customer_name?>" class="form-control" id="customer_name" placeholder="Name" data-fv-regexp="true" required data-error="Please enter name" required >
				<div class="help-block with-errors"></div>
			</div>
			<div class="form-group col-sm-6">
				<label for="contact_no" class="control-label">Contact Number</label>
				<input type="text" name="contact_no" value="<?=$contact_no?>" class="form-control" id="contact_no" placeholder="Contact Number" data-fv-regexp="true" required data-error="Please enter Contact Number" required >
				<div class="help-block with-errors"></div>
			</div>
			<div class="clearfix"></div>
            <div class="form-group col-sm-6">
                <label for="email_id" class="control-label">Email</label>
                <input type="email"  name="email_id" value="<?=$email_id?>" class="form-control" id="email_id" placeholder="Email" data-error="Email address is invalid" required>
                <div class="help-block with-errors"></div>
            </div>
           <div class="form-group col-sm-6">
                <label for="Cus_Password" class="control-label">Password</label>
                <input type="password" name="password" value="<?=$plain_password?>" data-toggle="validator" data-minlength="6" class="form-control" id="Cus_Password" placeholder="Password (Minimum of 6 characters)"  required>
                <a href="javascript:void(0)" class="pull-left" onClick="showPass()" id="pass_text">Show Password</a>
				<!--<a href="javascript:void(0)" class="pull-right" onClick="GeneratePass()">Generate Password</a>-->
				<div class="help-block with-errors"></div>
            </div>			 
			<div class="clearfix"></div>
			<div class="form-group col-sm-3">
               <label for="role" class="control-label">Role</label>
               <select class="form-control" name="role">
				<?php foreach($roleArr as $rkey=>$rvalue){ 
					if($rkey!=0 && $rkey!=2 && $rkey!=1){ ?>
					<option value="<?=$rkey?>" <?=(($rkey==$role)?'selected="selected"':'')?>><?=$rvalue?></option>
					<?php } } ?>
				</select>
            </div>
			<!--<div class="form-group col-sm-3">
				<label for="email_verification_status" class="control-label">Email Verified</label>
				<select class="form-control" name="email_verification_status">
					<option value="0" <?=(($email_verification_status=='0')?'selected="selected"':'')?>>No</option>
					<option value="1" <?=(($email_verification_status=='1')?'selected="selected"':'')?>>Yes</option>
				</select>
            </div>-->
			<div class="form-group col-sm-3">
				<label for="status" class="control-label">Status</label>
				<select class="form-control" name="status">
					<option value="1" <?=(($status=='1')?'selected="selected"':'')?>>Active</option>
					<option value="0" <?=(($status=='0')?'selected="selected"':'')?>>Inactive</option>
				</select>
            </div>
			<div class="clearfix"></div><br>
			<!--<div class="form-group col-sm-6">
				<div class="checkbox checkbox-success">
					<input name="send_email" type="checkbox" id="checkbox3" value="1">
					<label for="checkbox3"> Send Email with Login Details to User</label>
				</div>				
			</div>-->
			<div class="clearfix"></div><br>
            <div class="form-group col-sm-12">
                <button type="submit" class="btn btn-primary">Submit</button>
				<a href="<?=SITE_PATH_ADM.CPAGE?>" class="btn btn-primary">Back</a>
            </div>
			<div class="clearfix"></div>
        </div>
	</div>
</div>
<!-- /.row --> 

<script>


function showPass(){
	if($("#Cus_Password").attr("type")=="password"){
		$("#Cus_Password").attr("type","text");
		$("#pass_text").html("Hide Password");
	}else{
		$("#Cus_Password").attr("type","password");
		$("#pass_text").html("Show Password");
	}
}
</script>
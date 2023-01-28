<?php include("../../lib/opin.inc.php");?>
<?php 
$resReturn=false;
if(isset($_POST['reset_submit'])){
	//print_r($_POST);die;
	$userEmail = $cms->escape_string(trim($_POST["uemail"]));
	//echo $message= "SELECT `id`, `customer_name`, `email_id` FROM #_users WHERE `email_id`='".$userEmail."' AND `status`=1  AND `is_deleted`=0 AND role=3 ";die;
	$userLoginReq = $cms->db_query("SELECT `id`, `customer_name`, `email_id` FROM #_users WHERE `email_id`='".$userEmail."' AND `status`=1  AND `is_deleted`=0 AND role=3 ");
	if($userLoginReq->num_rows>0){
		$userLoginRes = $userLoginReq->fetch_assoc();
		//$POSTSARR["access_token"] = $cms->accessToken(15);
		//print_r($userLoginRes);	
		$to = $userLoginRes["email_id"];	
		$username = $userLoginRes["customer_name"];
		
		$user_password = generatePassword();
		$POSTSARR['plain_password'] = $user_password;
		$POSTSARR["password"]= md5($user_password);
		
		$cms->sqlquery("rs","users",$POSTSARR, 'id', $userLoginRes["id"]);
				
		$subject = 'Arka - New Password';		
		$msg_body='<div>Hi,</div>
				   <div>&nbsp;</div>
				   <div>Please find your login credentials below. </div>
				   <div>Email : '.$userEmail.'</div>
				   <div>Password : '.$user_password.'</div>
				   <div>&nbsp;</div>
				   <div><a href="'.SITE_PATH_ADM.'login">Click here to login.</a></div>
				   <div>&nbsp;</div>
				   <div><b>Regards,<br>Arka</b></div>';
					   
		$email_msg = emailFormat($msg_body);
		$resReturn = sendEmail($to, $subject,$email_msg);
					
		if($resReturn==true){
			$message =  '<div class="text-success text-center" style="font-size:17px;">Please check your email. Your password has been successfully sent to your registered email.</div>.';
		}else{
			$message =  "Some problem occur, Please try again";
		}
	}else{
		$message = "Please enter valid Email";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
 	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
		<title>Arka Admin</title>
		<!-- Bootstrap Core CSS -->
		<link href="<?=SITE_PATH_ADM?>bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
		<!-- animation CSS -->
		<link href="<?=SITE_PATH_ADM?>css/animate.css" rel="stylesheet">
		<!-- Custom CSS -->
		<link href="<?=SITE_PATH_ADM?>css/style.css" rel="stylesheet">
		<!-- color CSS -->
		<link href="<?=SITE_PATH_ADM?>css/colors/blue.css" id="theme"  rel="stylesheet">
		 
	</head>
	<body>
		<!-- Preloader -->
		<div class="preloader">
			<div class="cssload-speeding-wheel"></div>
		</div>
		<section id="wrapper" class="login-register">
		
			<div class="login-box">
			<div align="center"><img src="<?=SITE_PATH_ADM?>images/Arka-Logo.svg" class="logo-admin" style="padding: 20px; width: 250px;"></div>
				<div class="white-box" style="border: 2px solid rgba(128, 128, 128, 0.48); border-radius: 20px;">
				
					<form class="form-horizontal" id="recoverform1" role="form" method="post">
						<?php if($resReturn==false){ ?>
						<?php if($message!=''){
							echo '<p class="text-danger text-center">'.$message.'</p>';
						} ?>
						<div class="form-group ">
							<div class="col-xs-12">
								<h3>Recover Password</h3>
								<p class="text-muted">Enter your Email and password will be sent to you! </p>
							</div>
						</div>
						<div class="form-group">
							<div class="col-xs-12">
								<input class="form-control" type="email" name="uemail" required="" placeholder="Email">
							</div>
						</div>
						<div class="form-group text-center m-t-20">
							<div class="col-xs-12">
								<button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit" name="reset_submit">Reset</button>
							</div>
						</div>
						<?php }else{ ?>
						<div class="form-group">
							<div class="col-xs-12">
								<h3>Password Sent</h3>
								<p class="text-muted">Please check your email. New password has been successfully sent to your registered email. </p>
							</div>
						</div>
						<div class="form-group text-center m-t-20">
							<div class="col-xs-12">
								<a href="<?=SITE_PATH_ADM?>login" class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light">Login</a>
							</div>
						</div>
						<?php } ?>
					</form>
				</div>
				<div align="center"><b><?=date("Y")?> &copy; BLUE DIGITAL MEDIA </b></div>
			</div>
		</section>
		<!-- jQuery -->
		<script src="<?=SITE_PATH_ADM?>js/jquery.min.js"></script>
		<!-- Bootstrap Core JavaScript -->
		<script src="<?=SITE_PATH_ADM?>bootstrap/dist/js/bootstrap.min.js"></script>
		<!-- Menu Plugin JavaScript -->
		<script src="<?=SITE_PATH_ADM?>js/sidebar-nav.min.js"></script>

		<!--slimscroll JavaScript -->
		<script src="<?=SITE_PATH_ADM?>js/jquery.slimscroll.js"></script>
		<!--Wave Effects -->
		<script src="<?=SITE_PATH_ADM?>js/waves.js"></script>
		<!-- Custom Theme JavaScript -->
		<script src="<?=SITE_PATH_ADM?>js/custom.js"></script>
		 
	</body>
</html>

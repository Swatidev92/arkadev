<?php include("../../lib/opin.inc.php");?>
<?php 
$LOGINMSG="";
if($cms->is_post_back()){
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$res = $cms->user_login($username,$password);
	if($res) {  
		//$cms->updateStock("Test");
		if($_SESSION["ses_adm_role"]==3 && $_SESSION["ses_adm_usr"]==''){			
			$cms->redir(SITE_PATH_ADM.'profile?id='.$_SESSION["ses_adm_id"]);
		}else{
			$cms->redir(SITE_PATH_ADM);
		}
	} else {  
		$LOGINMSG = "Username/password is invalid";  
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
		<link rel="icon" type="image/png" sizes="16x16" href="<?=SITE_PATH?>assets/images/favicon.png">
		<title>ARKA ENERGY-CRM </title>
		<!-- Bootstrap Core CSS -->
		<link href="<?=SITE_PATH_ADM?>bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
		<!-- animation CSS -->
		<!--<link href="<?=SITE_PATH_ADM?>css/animate.css" rel="stylesheet">-->
		<!-- Custom CSS -->
		<link href="<?=SITE_PATH_ADM?>css/style.css" rel="stylesheet">
		<!-- color CSS -->
		<link href="<?=SITE_PATH_ADM?>css/colors/blue.css" id="theme"  rel="stylesheet">
		 
	</head>
	<style>
	.login-box {
		background: #018d45;
		width: 400px;
		margin: 3% auto;
		padding: 20px 0px;
	}
	.logo-admin {
		width: 168px;
		margin: 25px 0px;
	}
	</style>
	<body>
		<!-- Preloader -->
		<div class="preloader">
			<div class="cssload-speeding-wheel"></div>
		</div>
		<section id="wrapper" class="login-register">
		
			<div class="login-box">
			<div align="center"><img src="<?=SITE_PATH?>assets/images/footer-logo.png" class="logo-admin"></div>
			<!--<div align="center"><h1 style="font-size:25px;margin-bottom:5px;">SILVER MIRACLES</h1>
						<p>By Stutie Gupta</p></div>-->
				<div class="white-box" style="border: 1px solid rgba(128, 128, 128, 0.48); border-radius:0px;">
				
					<form class="form-horizontal form-material" id="loginform" role="form" method="post" >
						<h3 class="box-title m-b-20">Sign In</h3>
						<div class="form-group ">
							<div class="col-xs-12">
								<input class="form-control" type="text" name="username" required="" placeholder="Username">
							</div>
						</div>
						<div class="form-group">
							<div class="col-xs-12">
								<input class="form-control" type="password" name="password" required="" placeholder="Password">
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12">
								<?php if(!empty($LOGINMSG)){ ?>
									<div class="alert alert-danger alert-dismissable" style="border-radius: 4px; padding: 6px;">  <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="right:5px">×</button> <?=$LOGINMSG?></div>
								<?php } ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12">
								<a href="<?=SITE_PATH_ADM?>forgot-password" id="to-recover1" class="text-dark"><i class="fa fa-lock m-r-5"></i> Forgot Password?</a> 
							</div>
						</div>
						<div class="form-group text-center m-t-20">
							<div class="col-xs-12">
								<button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
							</div>
						</div>


					</form>

				</div>
				<div class="text-white" align="center"><b><?=date("Y")?> &copy; BLUE DIGITAL MEDIA </b></div>
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
		<!--<script src="<?=SITE_PATH_ADM?>js/waves.js"></script>-->
		<!-- Custom Theme JavaScript -->
		<script src="<?=SITE_PATH_ADM?>js/custom.js"></script>
		 
	</body>
</html>

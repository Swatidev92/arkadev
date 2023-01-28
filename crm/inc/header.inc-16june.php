<?php 
if(!$_SESSION["ses_adm_id"]){ $cms->redir(SITE_PATH_ADM."login"); die; }
 
?>
<?php //die("sdhkjfksdfk");?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" type="image/png" sizes="16x16" href="<?=SITE_PATH?>assets/images/favicon.png">
		<title>Admin Panel</title>
		<!-- Bootstrap Core CSS -->
		<link href="<?=SITE_PATH_ADM?>bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
		<!-- Menu CSS -->
		<link href="<?=SITE_PATH_ADM?>css/sidebar-nav.min.css" rel="stylesheet">
			<!-- Wizard CSS -->
		<link href="<?=SITE_PATH_ADM?>css/wizard.css" rel="stylesheet">
		  
		<!-- Date picker plugins css -->
		<link href="<?=SITE_PATH_ADM?>css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
		<!-- Daterange picker plugins css -->
		<link href="<?=SITE_PATH_ADM?>css/jquery-clockpicker.min.css" rel="stylesheet">
		<link href="<?=SITE_PATH_ADM?>css/custom-select.css" rel="stylesheet" type="text/css" />
		<link href="<?=SITE_PATH_ADM?>css/switchery.min.css" rel="stylesheet" />
		<!-- animation CSS -->
		<link href="<?=SITE_PATH_ADM?>css/animate.css" rel="stylesheet">
		<!-- Custom CSS -->
		<link href="<?=SITE_PATH_ADM?>css/style.css" rel="stylesheet">
		<link href="<?=SITE_PATH_ADM?>css/dropify.min.css" rel="stylesheet">
		<!-- color CSS -->
		<link href="<?=SITE_PATH_ADM?>css/colors/blue.css" id="theme"  rel="stylesheet">
		<!-- jQuery -->
		<script src="<?=SITE_PATH_ADM?>js/jquery.min.js"></script> 
		<script language="javascript" src="<?=SITE_PATH_ADM?>js/validate.js"></script>
	</head>
	
	<body>
		<div class="admin-ajax-loader"></div>
		<div id="wrapper">
			<!-- Navigation -->
			<nav class="navbar navbar-default navbar-static-top m-b-0">
				<div class="navbar-header"> 
					<a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
				
					<div class="top-left-part" style="text-align:center;margin:0px auto">
						<a class="logo" href="<?=SITE_PATH_ADM?>">
							<img src="<?=SITE_PATH?>assets/images/footer-logo.png" alt="home" width="180">
						</a>
					</div>
      
					<ul class="nav navbar-top-links navbar-right pull-right">
						<li class="dropdown"> 
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> 
								<img src="<?=SITE_PATH_ADM?>images/setting.svg" alt="user-img" width="36" class="img-circle">
								<b class=""><?=ucfirst($_SESSION["ses_adm_usr"])?></b> 
							</a>
							<ul class="dropdown-menu dropdown-user animated flipInY">
								<?php if($_SESSION["ses_adm_role"]==1){?>
								<li>
									<a href="<?=SITE_PATH_ADM?>settings.php"><i class="ti-settings"></i> Account Setting</a>
								</li>
								<li role="separator" class="divider"></li>
								<?php } ?>
								<li>
									<a href="<?=SITE_PATH_ADM?>change-password.php"><i class="fa fa-key"></i> Change Password</a>
								</li>
								<li>
									<a href="<?=SITE_PATH_ADM?>logout.php"><i class="fa fa-power-off"></i> Logout</a>
								</li>
							</ul>
							<!-- /.dropdown-user -->
						</li>
						<!-- /.dropdown -->
					</ul>
				</div>
				<!-- /.navbar-header -->
			</nav>
		<?php include("left-nav-bar.php");?>			
		<?=$cms->sform((($mode)?'onsubmit="return formvalid(this)"':'onsubmit="return formvalid(this)"'));?>
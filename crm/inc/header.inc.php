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
		<meta name="MobileOptimized" content="320" />
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Expires" content="0" />
		<META name="robots" content="noindex,nofollow">
		<link rel="icon" type="image/png" sizes="16x16" href="<?=SITE_PATH?>assets/images/favicon.png">
		<title>ARKA ENERGY - CRM </title>
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
		<link href="<?=SITE_PATH_ADM?>css/style.css?<?=time()?>" rel="stylesheet">
		<link href="<?=SITE_PATH_ADM?>css/dropify.min.css" rel="stylesheet">
		<!-- color CSS -->
		<link href="<?=SITE_PATH_ADM?>css/colors/blue.css?<?=time()?>" id="theme"  rel="stylesheet">
		<!-- jQuery -->
		<script src="<?=SITE_PATH_ADM?>js/jquery.min.js"></script> 
		<script src="<?=SITE_PATH_ADM?>js/validator.js"></script>
		<script language="javascript" src="<?=SITE_PATH_ADM?>js/validate.js"></script>
	</head>
	
	<body class="fix-header fix-sidebar1 full-bg">
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
					<!-- S:mk-19 Search Bar -->
					<form class="navbar-form navbar-left" action="<?=SITE_PATH_ADM?>lead-manager/" style="margin-left:25%;">
        				<div class="form-group">
          					<input type="text" name="name_search" id="name_search" title="Name" value="" class="form-control" id="inputName1" placeholder="Name" data-fv-regexp="true">
        				</div>
        				<button type="submit" name="submt" onClick="changeMethod()" value="Search" class="btn search-btn">Search</button>
      				</form>
					<!-- E:mk-19 -->
      
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
								<?php if($_SESSION["ses_adm_role"]==3){ ?>
								<li>
									<a href="<?=SITE_PATH_ADM?>profile?id=<?=$_SESSION["ses_adm_id"]?>"><i class="ti-settings"></i> My Profile</a>
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
		<!--<?=$cms->sform((($mode)?'onsubmit="return formvalid(this)"':'onsubmit="return formvalid(this)"'));?>-->
				
		<?=$cms->sform((($mode)?'onsubmit="return true"':'onsubmit="return true"'));?>
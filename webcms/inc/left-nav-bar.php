<!-- Left navbar-header -->
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar">
		<ul class="nav" id="side-menu">
			<?php if($_SESSION["ses_adm_role"]==1 || ($_SESSION["ses_adm_role"]!=1 && $_SESSION["ses_adm_role"]==3 && $_SESSION["ses_adm_usr"]!='')){ ?> 
			<li> 
				<a href="<?=SITE_PATH_ADM?>" class="waves-effect1 active1"><i class="linea-icon linea-basic fa-fw" data-icon="v"></i>Dashboard</a>
			</li>		
			<?php } if($_SESSION["ses_adm_role"]==1){?>
			<li> 
				<a href="<?=SITE_PATH_ADM?>home-manager"><i class="ti-support fa-fw"></i> Home Manager</a>
			</li>
			<li> 
				<a href="<?=SITE_PATH_ADM?>solar-manager"><i class="ti-support fa-fw"></i> Solar Manager</a>
			</li>
			<li> 
				<a href="<?=SITE_PATH_ADM?>battery-manager"><i class="ti-support fa-fw"></i> Battery Manager</a>
			</li>
			<li> 
				<a href="<?=SITE_PATH_ADM?>charger-manager"><i class="ti-support fa-fw"></i> Charger Manager</a>
			</li>
			<li> 
				<a href="<?=SITE_PATH_ADM?>solar-calculator-manager"><i class="ti-support fa-fw"></i> Solar Calculator Manager</a>
			</li>
			<li> 
				<a href="<?=SITE_PATH_ADM?>free-quote-manager"><i class="ti-support fa-fw"></i> Free Quote Manager</a>
			</li>
			<li> 
				<a href="<?=SITE_PATH_ADM?>about-manager"><i class="ti-support fa-fw"></i> About Manager</a>
			</li>
			<li> 
				<a href="<?=SITE_PATH_ADM?>warranty-manager"><i class="ti-support fa-fw"></i> Warranty Manager</a>
			</li>
			<li> 
				<a href="<?=SITE_PATH_ADM?>career-manager"><i class="ti-support fa-fw"></i> Career Manager</a>
			</li>
			<li> 
				<a href="<?=SITE_PATH_ADM?>legal-manager"><i class="ti-support fa-fw"></i> Legal Manager</a>
			</li>
			<li> 
				<a href="<?=SITE_PATH_ADM?>contact-us-manager"><i class="ti-support fa-fw"></i> Contact Us Manager</a>
			</li>
			<?php } ?>
			
			<?php if($_SESSION["ses_adm_role"]==1){?>
			<li> 
				<a href="<?=SITE_PATH_ADM?>cookie-content-manager"><i class="ti-support fa-fw"></i> Cookie Content Manager</a>
			</li>
				
			<li><a href="javascript:void(0)" class="waves-effect">
				<i class="ti-support fa-fw"></i> <span class="hide-menu">Blog <span class="fa arrow"></span></span></a>
				<ul class="nav nav-second-level">
					<li><a href="<?=SITE_PATH_ADM?>blog-category-manager"><i class="ti-support fa-fw"></i> Blog Category</a></li>
					<li><a href="<?=SITE_PATH_ADM?>blog-manager"><i class="ti-support fa-fw"></i> Blog Manager</a></li>
				</ul>
			</li>
			
			<li><a href="javascript:void(0)" class="waves-effect">
				<i class="ti-support fa-fw"></i> <span class="hide-menu">FAQ <span class="fa arrow"></span></span></a>
				<ul class="nav nav-second-level">
					<li><a href="<?=SITE_PATH_ADM?>faq-category"><i class="ti-help-alt fa-fw"></i>FAQ Category Manager</a></li>
					<li><a href="<?=SITE_PATH_ADM?>faq-manager"><i class="ti-help-alt fa-fw"></i>FAQ Manager</a></li>
				</ul>
			</li>
			<?php } ?>
		</ul>
	</div>
</div>
<!-- Left navbar-header end -->
  <!-- Page Content -->
	<div id="page-wrapper">
		<div class="container-fluid">  
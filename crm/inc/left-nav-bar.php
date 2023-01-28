<!-- Left navbar-header -->
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar">
		<ul class="nav" id="side-menu">
			<?php if($_SESSION["ses_adm_role"]==1 || ($_SESSION["ses_adm_role"]!=1 && $_SESSION["ses_adm_role"]==3 && $_SESSION["ses_adm_usr"]!='')){ ?> 
			<li> 
				<a href="<?=SITE_PATH_ADM?>" class="waves-effect1 active1"><i class="linea-icon linea-basic fa-fw" data-icon="v"></i>Dashboard</a>
			</li>		
			<?php } ?>
			
			<li><a href="javascript:void(0)" class="waves-effect">
				<i class="fa fa-group"></i> <span class="hide-menu">LMS <span class="fa arrow"></span></span></a>
				<ul class="nav nav-second-level">
					<?php if($_SESSION['REFERER_page']!=''){
						$redirect = $_SESSION['REFERER_page'];
					}else{
						$redirect = SITE_PATH_ADM.'lead-manager';
					}?>
					<li><a href="<?=$redirect?>"><i class="ti-support fa-fw"></i> Manage leads</a></li>
					<li>
						<a href="<?=SITE_PATH_ADM?>activities" class="waves-effect"><i class="fa fa-bell" aria-hidden="true"></i> <span class="hide-menu"> <?=($_SESSION["ses_adm_role"]==1)?'Activities':'My Activities'?></span></a>
					</li>
					
					<?php /*if($_SESSION["ses_adm_role"]!=1 && $_SESSION["ses_adm_role"]==3 && $_SESSION["ses_adm_usr"]!=''){ ?> 
					<li><a href="<?=SITE_PATH_ADM?>activities"><i class="fa fa-bell"></i> My Activities</a></li>
					<?php }*/ ?>
					<?php if($_SESSION["ses_adm_role"]==1){?>
					<li><a href="<?=SITE_PATH_ADM?>user-manager"><i class="ti-support fa-fw"></i> User Manager</a></li>
					<li><a href="<?=SITE_PATH_ADM?>customer-price-manager"><i class="ti-support fa-fw"></i> Customer Price Manager</a></li>	
					<!--<li style="background:#f4b532;"><a style="color:#fff;" href="<?=SITE_PATH_ADM?>lead-manager-v1"><i class="ti-support fa-fw"></i> Lead Manager V1</a></li>-->
					<li><a href="<?=SITE_PATH_ADM?>manage-status-type"><i class="ti-support fa-fw"></i> Manage Lead Status & Type</a></li>
					<!--<li><a href="<?=SITE_PATH_ADM?>contracted-customers" class="waves-effect"><i class="fa fa-group" aria-hidden="true"></i> <span class="hide-menu">Contracted Customer</span></a></li>
					<li><a href="<?=SITE_PATH_ADM?>customer-project" class="waves-effect"><i class="fa fa-th-list"></i> <span class="hide-menu">Customer Project</span></a></li>-->
					<?php } ?>
					
					<li><a href="<?=SITE_PATH_ADM?>contracted-customer" class="waves-effect"><i class="fa fa-group" aria-hidden="true"></i> <span class="hide-menu">Contracted Customer</span></a></li>
					
				</ul>
			</li>
			
			<?php $asign_mod = $cms->db_query("SELECT module_id, sub_module_action FROM #_permissions WHERE status='1' AND user_id='".$_SESSION["ses_adm_id"]."'");

			$moduleResArr = $asign_mod->fetch_array(); 
			?>
			<?php if($_SESSION["ses_adm_id"]==1 || ($_SESSION["ses_adm_role"]!=1 && $moduleResArr['sub_module_action'])){
			$actArr = explode(',',$moduleResArr['sub_module_action']);	
			?>
			<?php if($_SESSION["ses_adm_id"]==1 || in_array(12,$actArr)){
			?>
			<li><a href="javascript:void(0)" class="waves-effect">
				<i class="ti-support fa-fw"></i> <span class="hide-menu">Project Management <span class="fa arrow"></span></span></a>
				<ul class="nav nav-second-level">
					<!--<li> <a href="javascript:void(0)" class="waves-effect"><i class="ti-support fa-fw"></i> Customers <span class="fa arrow"></span></a>
						<ul class="nav nav-third-level">
							<li> <a href="<?=SITE_PATH_ADM?>customers"><i class="fa fa-th-list"></i> All</a> </li>
							<li> <a href="<?=SITE_PATH_ADM?>contract-signed"><i class="fa fa-th-list"></i> Contract Signed</a> </li>
							<li><a href="<?=SITE_PATH_ADM?>in-process"><i class="ti-support fa-fw"></i> In Process</a></li>
							<li> <a href="<?=SITE_PATH_ADM?>finished"><i class="fa fa-th-list"></i> Finished</a> </li>
						</ul>
                    </li>-->
					<li><a href="<?=SITE_PATH_ADM?>customers" class="waves-effect"><i class="fa fa-th-list"></i> <span class="hide-menu">Customers</span></a></li>
					<!--<li><a href="<?=SITE_PATH_ADM?>customer-project" class="waves-effect"><i class="fa fa-th-list"></i> <span class="hide-menu">Customer Project</span></a></li>-->
					<li><a href="<?=SITE_PATH_ADM?>installer-manager" class="waves-effect"><i class="fa fa-th-list"></i> <span class="hide-menu">Installer Manager</span></a></li>
					<li>
				    <a href="<?=SITE_PATH_ADM?>project-steps" class="waves-effect"><i class="fa fa-tasks"></i> <span class="hide-menu">Project Steps<span class=""></span></span></a></li>
				</ul>
			</li>
			<?php } } ?>
			<li><a href="javascript:void(0)" class="waves-effect">
				<i class="fa fa-file-text"></i> <span class="hide-menu">Report <span class="fa arrow"></span></span></a>
				<ul class="nav nav-second-level">
					<li><a href="<?=SITE_PATH_ADM?>lead-analytics"><i class="ti-support fa-fw"></i> Lead Analytics</a></li>
					<li><a href="<?=SITE_PATH_ADM?>sales-analytics"><i class="ti-support fa-fw"></i> Sales Analytics</a></li>
					<li><a href="<?=SITE_PATH_ADM?>revenue-analytics"><i class="ti-support fa-fw"></i> Revenue Analytics</a></li>
				</ul>
			</li>

			
			<li><a href="javascript:void(0)" class="waves-effect">
				<i class="fa fa-question-circle"></i> <span class="hide-menu">Knowledge base <span class="fa arrow"></span></span></a>
				<ul class="nav nav-second-level">
					
			<li><a href="<?=SITE_PATH_ADM?>hands" class="waves-effect"><i class="fa fa-support" aria-hidden="true"></i> <span class="hide-menu">Help & Support</span></a></li>
					<li><a href="<?=SITE_PATH_ADM?>help-category" class="waves-effect"><i class="fa fa-cog" aria-hidden="true"></i> <span class="hide-menu">Manage Help & Support</span></a></li>
				</ul>
			</li>
			
			
		</ul>
	</div>
</div>
<!-- Left navbar-header end -->
  <!-- Page Content -->
	<div id="page-wrapper">
		<div class="container-fluid">  
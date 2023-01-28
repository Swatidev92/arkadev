<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include_once('header-script.php');?>
	</head>
	
	<body>
		<div class="loader"></div>
		<!--sw header wrapper start-->
		<div class="transparent-menu header-area hidden-menu-bar animated fadeIn header-padding">
			<div class="container-fluid no-mob-padding-menu">
				<div class="bt_main_menu_wrapper">
					<div class="main-menu-wrapper clear-fix">
						<div class="logo float-left">
							<a href="<?=SITE_PATH?><?=$urlConst?>">
								<img src="<?=SITE_PATH?>assets/images/Logo.png" class="img-responsive" alt="logo">
							</a>
						</div>
					</div>
					<div class="sc_navigation hidden-sm hidden-xs">
						<nav id="primary-nav" class="dropdown nav_left_margin">
							<ul class="dropdown menu navigation cart_dropdown_wrapper">
								<li><a href="<?=SITE_PATH.$urlConst?><?=$countryConst=='SE'?'solceller':'solar'?>" style="<?=$menustyle?>"><?=SOLAR?></a></li>
								<li><a href="<?=SITE_PATH.$urlConst?><?=$countryConst=='SE'?'batterier':'batteries'?>" style="<?=$menustyle?>"><?=BATTERY?></a></li>
								<li><a href="<?=SITE_PATH.$urlConst?><?=$countryConst=='SE'?'laddare':'charger'?>" style="<?=$menustyle?>"><?=CHARGER?></a></li>
								<li><a href="<?=SITE_PATH.$urlConst?><?=$countryConst=='SE'?'kostnadskalkyl':'solar-calculator'?>" style="<?=$menustyle?>"><?=CALCULATOR?></a></li>
								<!--<li class="header_btnm green-bg"><a href="<?=SITE_PATH?>free-quote" class="white-text" title="" style="padding: 0px 15px">Free quote</a></li>-->
							</ul>
							<div class="header_right_main_wrapper">
                                <div class="header_btn">
                                    <ul>
                                        <li>
                                            <a href="<?=SITE_PATH.$urlConst?><?=$countryConst=='SE'?'fri-offert':'free-quote'?>" class="waves-effect waves-light waves-ripple"><?=QUOTE?></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>							

							<div class="header_right_inner_page">
								<div class="sw_icon_bar">
									<ul class="tc_login_btn_wrapper">
										<li class="dropdown tc_login_btn">
											<a class="dropdown-toggle hvr-float-shadow active waves-effect waves-light" data-toggle="dropdown" style="padding:0px;"><?=$lang?><i class="fa fa-angle-down"></i></a>
											<ul class="dropdown-menu tc_menu_fixed_border">
												<li class="dropdown_hover"><a href="<?=SITE_PATH.$conLangSelEN?>"><img src="<?=SITE_PATH?>assets/images/flag/english.png"> <span class="language-name">English</span></a></li>
												<li class="dropdown_hover"><a href="<?=SITE_PATH.$conLangSelSE?>"><img src="<?=SITE_PATH?>assets/images/flag/sweden.png"> <span class="language-name">Sverige</span></a></li>
											</ul>
										</li>
									</ul>
								</div>
							</div>								
						</nav>
					</div>
					<!-- /.main-menu-wrapper -->
					<!-- mobile menu area start -->
					<div class="mobile-menu-area visible-sm visible-xs">
                        <div class="container-fluid header_container">
                            <div class="row">

                                <div class="col-xs-12 cc_menu_top_margin">
                                    <!-- mobile menu start -->
                                    <div class="mobile-menu">
                                        <nav>
                                            <ul class="nav">
                                                <li><a href="<?=SITE_PATH.$urlConst?><?=$countryConst=='SE'?'solceller':'solar'?>"><?=SOLAR?></a></li>
												<li><a href="<?=SITE_PATH.$urlConst?><?=$countryConst=='SE'?'batterier':'batteries'?>"><?=BATTERY?></a></li>
												<li><a href="<?=SITE_PATH.$urlConst?><?=$countryConst=='SE'?'laddare':'charger'?>"><?=CHARGER?></a></li>
												<li><a href="<?=SITE_PATH.$urlConst?><?=$countryConst=='SE'?'kostnadskalkyl':'solar-calculator'?>"><?=CALCULATOR?></a></li>
												<li><a href="javascript:void(0);"><?=$lang?></a>
													<ul>
														<li><a href="<?=SITE_PATH?>">EN</a></li>
														<li><a href="<?=SITE_PATH?>se">SE</a></li>
													</ul>
												</li>
												<div class="mob-menu-get-connect text-center"><a href="<?=SITE_PATH?>get-connected" style="padding: 0px 15px; border: 1px solid #000;  border-radius: 20px; text-align: center;  display: inline; color:#182D42;" ><?=QUOTE?></a></div>
                                            </ul>
                                        </nav>										
                                    </div>
                                    <!-- mobile menu end -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- mobile menu area end -->
					
				</div>
			</div>
		</div>
		<!--sw header wrapper end-->
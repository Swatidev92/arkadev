<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include_once('header-script.php');?>
		<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-RGLWP5JM32"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-RGLWP5JM32');
</script>

<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window,document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '1371265816619335'); 
fbq('track', 'PageView');
</script>
<noscript>
<img height="1" width="1" 
src="https://www.facebook.com/tr?id=1371265816619335&ev=PageView
&noscript=1"/>
</noscript>
<!-- End Facebook Pixel Code -->


	</head>
	
	<body>
		<div class="loader"></div>
		<!--sw header wrapper start-->
		<div class="transparent-menu header-area hidden-menu-bar animated fadeIn header-padding">
			<div class="container no-mob-padding-menu">
				<div class="bt_main_menu_wrapper">
					<div class="main-menu-wrapper clear-fix">
						<div class="logo float-left">
							<a href="<?=SITE_PATH?><?=$urlConst?>">
								<img src="<?=SITE_PATH?>assets/images/Arka-Logo.svg" class="img-responsive" alt="logo">
							</a>
						</div>
					</div>
					<div class="sc_navigation hidden-sm hidden-xs">
						<nav id="primary-nav" class="dropdown nav_left_margin">
							<ul class="dropdown menu navigation cart_dropdown_wrapper">
								<li><a href="<?=SITE_PATH.$urlConst?><?=$countryConst=='SE'?'solceller':'solar'?>" class="<?=$menustyle?>"><?=SOLAR?></a></li>
								<li><a href="<?=SITE_PATH.$urlConst?><?=$countryConst=='SE'?'batterier':'batteries'?>" class="<?=$menustyle?>"><?=BATTERY?></a></li>
								<li><a href="<?=SITE_PATH.$urlConst?><?=$countryConst=='SE'?'laddare':'charger'?>" class="<?=$menustyle?>"><?=CHARGER?></a></li>
								<li><a href="<?=SITE_PATH.$urlConst?><?=$countryConst=='SE'?'kostnadskalkyl':'solar-calculator'?>" class="<?=$menustyle?>"><?=CALCULATOR?></a></li>
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
					<div class="mobile-menu-area">
                        <div class="container-fluid header_container">
                            <div class="row">

                                <div class="col-xs-12 cc_menu_top_margin">
								
							
							
							
                                    <!-- mobile menu start -->
                                    <div class="mobile-menu">
										<!--<div class="header_right_inner_page" id="with-mobile-menu">
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
										</div>-->
                                        <nav>
                                            <ul class="nav">
                                                <li><a href="<?=SITE_PATH.$urlConst?><?=$countryConst=='SE'?'solceller':'solar'?>"><?=SOLAR?></a></li>
												<li><a href="<?=SITE_PATH.$urlConst?><?=$countryConst=='SE'?'batterier':'batteries'?>"><?=BATTERY?></a></li>
												<li><a href="<?=SITE_PATH.$urlConst?><?=$countryConst=='SE'?'laddare':'charger'?>"><?=CHARGER?></a></li>
												<li><a href="<?=SITE_PATH.$urlConst?><?=$countryConst=='SE'?'kostnadskalkyl':'solar-calculator'?>"><?=CALCULATOR?></a></li>
												<li><a href="javascript:void(0);"><?=$lang?></a>
													<ul>
														<li><a href="<?=SITE_PATH.$conLangSelEN?>">English</a></li>
														<li><a href="<?=SITE_PATH.$conLangSelSE?>">Sverige</a></li>
													</ul>
												</li>
												<li><a href="<?=SITE_PATH.$urlConst?><?=$countryConst=='SE'?'fri-offert':'free-quote'?>"><?=QUOTE?></a></li>
												<!--<div class="mob-menu-get-connect text-center"><a href="<?=SITE_PATH.$urlConst?><?=$countryConst=='SE'?'fri-offert':'free-quote'?>" style="padding: 0px 15px; border: 1px solid #000;  border-radius: 20px; text-align: center;  display: inline; color:#182D42;" ><?=QUOTE?></a></div>-->
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
    <!-- sw footer section start-->
    <div class="sw_footer_main_wrapper sw_footer_index_wrapper">
        <div class="footer_wrapper">
            <div class="container">
			<a style="position: fixed;z-index: -99999;"href="https://www.bluedigital.co.in/" target="_blank">Website Design and Developed by Blue Digital Media</a>
                <!--<div class="row">
					<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">							
						<div class="abotus_content">
							<ul class="social-icon">
								<li><a href="#"><img src="<?=SITE_PATH?>assets/images/social-icons/fb.png"></a></li>
								<li><a href="#"><img src="<?=SITE_PATH?>assets/images/social-icons/tw.png"></a></li>
								<li><a href="#"><img src="<?=SITE_PATH?>assets/images/social-icons/ln.png"></a></li>
								<li><a href="#"><img src="<?=SITE_PATH?>assets/images/social-icons/fb.png"></a></li>
							</ul>
						</div>
					</div>
				</div>-->
				<div class="row">
                    <div class="foter_padder1 footer-spacing">
                        <div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
                            <div class="wrapper_second_about">
                                <div class="wrapper_first_image">
                                    <a href="<?=SITE_PATH?>"><img src="<?=SITE_PATH?>assets/images/footer-logo.png" class="img-responsive" alt="logo" /></a>
                                </div>	
								<div>
									<a href="https://www.uc.se/risksigill2/?showorg=5593209223&language=swe&special=" title="Sigillet är utfärdat av UC AB. Klicka på bilden för information om UC:s Riskklasser." target="_blank"><img src="https://www.uc.se/ucsigill2/sigill?org=5593209223&language=swe&product=lsa&special=&fontcolor=w&type=svg" alt="" style="border:0; width:200px;"/></a>
								</div>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-2 col-xs-4 col-sm-3">
                            <div class="wrapper_second_useful">
                                <ul>
									<li><a href="<?=SITE_PATH.$urlConst?><?=$countryConst=='SE'?'solceller':'solar'?>"><?=SOLAR?></a></li>
									<li><a href="<?=SITE_PATH.$urlConst?><?=$countryConst=='SE'?'batterier':'batteries'?>"><?=BATTERY?></a></li>
									<li><a href="<?=SITE_PATH.$urlConst?><?=$countryConst=='SE'?'laddare':'charger'?>"><?=CHARGER?></a></li>
									<li><a href="<?=SITE_PATH.$urlConst?><?=$countryConst=='SE'?'kostnadskalkyl':'solar-calculator'?>"><?=CALCULATOR?></a></li>
                                </ul>
                            </div>
                        </div>
						<div class="col-lg-2 col-md-2 col-xs-4 col-sm-3">
                            <div class="wrapper_second_useful">
                                <ul>    
									<li><a href="<?=SITE_PATH.$urlConst?><?=$countryConst=='SE'?'om-oss':'about-us'?>"><?=ABOUT?></a></li>
                                    <li><a href="<?=SITE_PATH.$urlConst?><?=$countryConst=='SE'?'garanti':'warranty'?>"><?=WARRANTY?></a></li>
                                    <li><a href="<?=SITE_PATH.$urlConst?><?=$countryConst=='SE'?'kontakta-oss':'contact-us'?>"><?=CONTACT?></a></li>
                                    <!--<li><a href="<?=SITE_PATH.$urlConst?><?=$countryConst=='SE'?'karriär':'careers'?>"><?=CAREER?></a></li>-->
                                    <li><a href="<?=SITE_PATH.$urlConst?><?=$countryConst=='SE'?'legal':'legal'?>"><?=LEGAL?></a></li>
                                </ul>
                            </div>
                        </div>
						<div class="col-lg-1 col-md-1 col-xs-4 col-sm-3">
                            <div class="wrapper_second_useful">
                                <ul>
									<?php if($settingArr['fb']){?>
									<li><a href="<?=$settingArr['fb']?>" target="_blank">Facebook</a></li>
									<?php } ?>
                                    <?php if($settingArr['instagram']){?>
									<li><a href="<?=$settingArr['instagram']?>" target="_blank">Instagram</a></li>
									<?php } ?>
									<?php if($settingArr['lin']){?>
									<li class="mg-right"><a href="<?=$settingArr['lin']?>" target="_blank">Linkedin</a></li>
									<?php } ?>	
                                </ul>
                            </div>
                        </div>
						<div class="col-lg-3 col-md-3 col-xs-12 col-sm-3" style="padding-left:0px;">
							<div class="footer-call-btn-area">
								<a href="tel:<?=$settingArr['phone']?>" class="footer-call-btn">
									<img src="<?=SITE_PATH?>assets/images/phone-banner.png">  
									<span class="calling-number"><?=$settingArr['phone']?></span>
								</a>
							</div>
                        </div>
                    </div>
                </div>
				<div class="row">
					<div class="col-lg-9 col-md-9 col-xs-12 col-sm-12">
						<div class="section3_copyright">
							<p>&copy; Arka Energy AB - <?=date('Y')?>. <?=$countryConst=='SE'?'Alla rättigheter reserverade':'All right reserved'?>.</p>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-xs-12 col-sm-12">						
						<div class="circle_btm1 text-right hidden-sm hidden-xs back-top-btn">
							<a href="javascript:" id="back-to-top" style="font-size: 15px; color: rgb(255, 255, 255); display: inline;"><?=$countryConst=='SE'?'Tillbaka till toppen':'Back to top'?> <i class="fa fa-long-arrow-up"></i></a>
						</div>
					</div>
                </div>
            </div>
        </div>

    </div>
    <!-- sw footer section end-->
    <!--main js files-->

    <?php include_once('footer-script.php');?>
	
	<script>
    $(document).ready(function(){
        $(".manage-cookie").click(function(){
            $("#cookie-poup").modal('show');
            $("#cookiebarBox").hide();
        });
		
		$(".cookieok").click(function(){
            $("#cookie-poup").modal('hide');
		});
    });
	
	</script>
	
</body>
</html>
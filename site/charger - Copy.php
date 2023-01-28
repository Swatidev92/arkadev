	<?php $chargerQry = $cms->db_query("SELECT * FROM #_charger ");
	$chargerRes = $chargerQry->fetch_array();
	?>
	
	<div class="page-head-banner" style="background: url(<?=SITE_PATH.'uploaded_files/charger/'.$chargerRes['banner']?>); background-position: center bottom; background-repeat: no-repeat; background-size: cover;">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-8">
					<div class="content-banner">
						<h2><?=$chargerRes['banner_text']?></h2> 
						<p class="banner-sub-heading"><?=$chargerRes['banner_text2']?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
										
										
	<!-- sw choose service wrapper start-->
    <div class="sw_chose_service_wrapper default-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                    <div class="sw_left_heading_wraper sw_center_heading_wrapper">
                        <h1><span class="heading-bold"><?=$chargerRes['sec1_main_heading']?></span></h1>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
                    <div class="chose_text_wrapper_left">
                        <div class="chose_icon_wrapper_list">
                            <div class="chose_icon_content_left">
                                <h5 class="text2"><?=$chargerRes['sec1_title1']?></h5>
                                <p class="arka-best-choice-text"><?=$chargerRes['sec1_content1']?></p>
                            </div>
                        </div>                   
                    </div>
                </div>
				 
                <div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
                    <div class="chose_text_wrapper_left">
                        <div class="chose_icon_wrapper_list">
                            <div class="chose_icon_content_left">
                                <h5 class="text2"><?=$chargerRes['sec1_title2']?></h5>
                                <p class="arka-best-choice-text"><?=$chargerRes['sec1_content2']?></p>
                            </div>
                        </div>                      
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
                    <div class="chose_text_wrapper_left">
                        <div class="chose_icon_wrapper_list">
                            <div class="chose_icon_content_left no-mrg-btm">
								<h5 class="text2"><?=$chargerRes['sec1_title3']?></h5>
                                <p class="arka-best-choice-text"><?=$chargerRes['sec1_content3']?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- sw choose service wrapper end-->
	
	 <!--sw leads wrapper start-->
    <div class="sw_leads_wrapper grey-bg default-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                    <div class="sw_disc_txt_wrapper">
                        <div class="sw_left_heading_wraper">
                            <h1 class="font-36 get-solar-home" style="line-height:1.2; color:#000; text-align:center"><span class="heading-bold"><?=$chargerRes['sec2_main_heading']?></span></h1>
                        </div>
					</div>
				</div>
						
				<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                    <div class="sw_disc_txt_wrapper">
                        <div class="row">
							<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 hidden-md hidden-lg">
								<div class="sw_road_leads_img" style="margin-top:25px;">
									<img src="<?=SITE_PATH?>assets/images/banners/charger-right.png" alt="img">
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-xs-12 col-sm-6">
								<div class="gb_icon_wrapper height-boxes">
									<div class="gb_icon_content">
										<b><?=$chargerRes['sec2_title1']?></b>
									</div>
									<p class="get-solar-desc"><?=$chargerRes['sec2_content1']?></p>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-xs-12 col-sm-6">
								<div class="gb_icon_wrapper height-boxes">                        
									<div class="gb_icon_content">
										<b><?=$chargerRes['sec2_title2']?></b>
										<p class="get-solar-text2"></p>
									</div>
									<p class="get-solar-desc"><?=$chargerRes['sec2_content2']?></p>
								</div>
							</div>      
						</div>
			
						<div class="row">
							<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
								<div class="gb_icon_wrapper">                        
									<div class="gb_icon_content">
										<b><?=$chargerRes['sec2_title3']?></b>
									</div>
									<p class="get-solar-desc"><?=$chargerRes['sec2_content3']?></p>
								</div>
							</div>
						</div>
					</div>
                </div>
                <div class="col-md-1 col-lg-1 col-sm-12 col-xs-12 hidden-sm hidden-xs"></div>
                <div class="col-md-5 col-lg-5 col-sm-12 col-xs-12 hidden-sm hidden-xs">
					<div class="sw_road_leads_img">
                        <img src="<?=SITE_PATH.'uploaded_files/charger/'.$chargerRes['sec2_right_img']?>">
                    </div>
                </div>
				
				<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
					<div class="btn-transparent text-center">
						<ul>
							<li>
								<a href="<?=$chargerRes['sec2_btn_link']?>" class="waves-effect waves-light waves-ripple green-text green-border-btn"><?=$chargerRes['sec2_btn_text']?></a>
							</li>
						</ul>
					</div>
				</div>
            </div>
        </div>
    </div>
    <!-- sw leads section end-->
	
	<div class="">
		<div class="">
			<img src="<?=SITE_PATH.'uploaded_files/charger/'.$chargerRes['sec3_img']?>" class="img-responsive">
		</div>
	</div>
	
	<div class="sw_chose_service_wrapper default-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                    <div class="sw_left_heading_wraper sw_center_heading_wrapper">
                        <h1><span class="heading-bold"><?=$chargerRes['sec4_main_heading']?></span></h1>
                    </div>
                </div>
				
				<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                    <div class="" style="margin-bottom:50px;">
						<img src="<?=SITE_PATH.'uploaded_files/charger/'.$chargerRes['sec4_img']?>" class="img-responsive">
					</div>
                </div>
			</div>
                
			<div class="row">
				<div class="col-lg-3 col-md-3 col-xs-12 col-sm-6">
					<div class="step-desc-mgbtm">
                        <h2 class="step-no">1. <?=$chargerRes['sec4_title1']?></h2>
						<p class="step-desc"><?=$chargerRes['sec4_content1']?></p>
                    </div>
				</div>
				<div class="col-lg-3 col-md-3 col-xs-12 col-sm-6">
					<div class="step-desc-mgbtm">
                        <h2 class="step-no">2. <?=$chargerRes['sec4_title2']?></h2>
						<p class="step-desc"><?=$chargerRes['sec4_content2']?></p>
                    </div>
				</div>
				<div class="col-lg-3 col-md-3 col-xs-12 col-sm-6">
					<div class="step-desc-mgbtm">
                        <h2 class="step-no">3. <?=$chargerRes['sec4_title3']?></h2>
						<p class="step-desc"><?=$chargerRes['sec4_content3']?></p>
                    </div>
				</div>
				<div class="col-lg-3 col-md-3 col-xs-12 col-sm-6">
					<div class="step-desc-mgbtm">
                        <h2 class="step-no">4. <?=$chargerRes['sec4_title4']?></h2>
						<p class="step-desc"><?=$chargerRes['sec4_content4']?></p>
                    </div>
				</div>	                
			</div>
        </div>
    </div>
    <!-- sw choose service wrapper end-->
	
	
	 <div class="sw_leads_wrapper grey-bg default-padding1">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                    <div class="sw_disc_txt_wrapper default-padding">
                        <div class="row">
							<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
								<div class="sw_disc_txt_wrapper">
									<div class="sw_left_heading_wraper">
										<h1 class="font-36 get-solar-home" style="line-height:1.2; color:#000;"><span class="heading-bold"><?=$chargerRes['sec5_main_heading']?></span></h1>
									</div>
								</div>
								<div>
									<p><?=$chargerRes['sec5_content']?></p>
								</div>
							</div>
						</div>	
					</div>
                </div>
                <div class="col-md-1 col-lg-1 col-sm-12 col-xs-12"></div>
                <div class="col-md-5 col-lg-5 col-sm-12 col-xs-12">
					<div class="sw_road_leads_img">
                        <img src="<?=SITE_PATH.'uploaded_files/charger/'.$chargerRes['sec5_right_img']?>" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
	
	<div class="sw_news_letter_wrapper charger-get-connect-banner">
        <div class="container">
			<div class="row">
                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12"></div>
                <div class="col-md-7 col-lg-7 col-sm-12 col-xs-12">
					<div class="sw_nl_heading_wrapper">
						<h2 class="get-connect-home-text"><b><?=$chargerRes['sec6_main_heading']?></b></h2>
						<p style="color:#fff; font-size:18px;margin-top:20px;"><?=$chargerRes['sec6_content']?></p>
					</div>
					<div class="sw_nl_form_wrapper">
						<div class="disc_btn ltr_btn">
							<ul>
								<li>
									<a href="<?=$chargerRes['sec6_btn_link']?>" class="waves-effect waves-light waves-ripple green-text1" style="margin-top:30px;"><?=$chargerRes['sec6_btn_text']?></a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>
	

	<div class="default-padding arka-installation">
        <div class="container">
            <div class="row">
				<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                    <div class="sw_left_heading_wraper sw_center_heading_wrapper">
                        <h5><span class="heading-bold"><?=$chargerRes['sec7_sub_heading']?></span></h5>
                        <h1 style="font-size:24px; margin-top:10px;"><span class="heading-bold"><?=$chargerRes['sec7_main_heading']?></span></h1>
                    </div>
                </div>
				
				<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
					<div class="disc_btn text-center">
						<ul>
							<li>
								<a href="<?=$chargerRes['sec7_btn_link']?>" class="waves-effect waves-light waves-ripple green-text green-border-btn"><?=$chargerRes['sec7_btn_text']?></a>
							</li>
						</ul>
					</div>
				</div>
            </div>
        </div>
    </div>
		    
	<?php $faqsQry = $cms->db_query("SELECT * FROM #_faqs where status=1 AND is_deleted=0 "); 
		$fnum=1;
		if($faqsQry->num_rows>0){
	?>
	<div class="sw_chose_service_wrapper grey-bg1 default-padding">
        <div class="container">
			<div class="row">
                <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
					<div class="sw_left_heading_wraper">
						<p style="font-family: 'ProximaNova Regular';"><b>FAQ</b></p>
						<h1><span class="heading-bold">Charger</span></h1>
					</div>
				</div>
                <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12">
                    <div class="sw_disc_txt_wrapper">
                        <div class="sw_leads_accordian">
                            <div class="panel-group" id="accordionFifteenLeft" role="tablist">
								<?php while($faqsRes = $faqsQry->fetch_array()){
									if($fnum==$faqsQry->num_rows){
										$collapsed='';
										$collapsedin='in';
									}else{
										$collapsed='collapsed';
										$collapsedin ='';
									}
								?>
                                <div class="panel panel-default">
                                    <div class="panel-heading horn">
                                        <h4 class="panel-title">
											<a class="<?=$collapsed?>" data-toggle="collapse" data-parent="#accordionFifteenLeft" href="#collapseFifteenLeft<?=$faqsRes['id']?>" aria-expanded="false"><?=$faqsRes['question']?></a>
										</h4>
                                    </div>
                                    <div id="collapseFifteenLeft<?=$faqsRes['id']?>" class="panel-collapse collapse <?=$collapsedin?>" aria-expanded="false" role="tabpanel">
                                        <div class="panel-body">

                                            <div class="panel_cont">
                                                <p><?=$faqsRes['answer']?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<?php $fnum++; } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>	
	</div>		
	<?php } ?>
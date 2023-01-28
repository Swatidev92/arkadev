	<?php $batteryQry = $cms->db_query("SELECT * FROM #_batteries where id=1 ");
	$batteryRes = $batteryQry->fetch_array();
	
	$metaTitle= $batteryRes['meta_title'.$langf];
	$metaIntro= $batteryRes['meta_description'.$langf];
	$metaKeyword= $batteryRes['meta_key'.$langf];
	
	?>
	
	<div class="page-head-banner" style="background: url(<?=SITE_PATH.'uploaded_files/batteries/'.$batteryRes['banner']?>); background-position: center bottom; background-repeat: no-repeat; background-size: cover;">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-8">
					<div class="content-banner" style="margin-top:70px;">
						<h2><?=$batteryRes['banner_text'.$langf]?></h2> 
						
						<div class="career-join">
							<p class="hidden-sm hidden-xs"><?=$batteryRes['banner_text2'.$langf]?></p>
							<p class="hidden-lg hidden-md"><?=$batteryRes['banner_text2'.$langf]?></p>
						</div>
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
                        <h1><span class="heading-bold"><?=$batteryRes['sec1_main_heading'.$langf]?></span></h1>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
                    <div class="chose_text_wrapper_left">
                        <div class="chose_icon_wrapper_list">
                            <div class="chose_icon_content_left">
                                <h5 class="text2"><?=$batteryRes['sec1_title1'.$langf]?></h5>
                                <p class="arka-best-choice-text black-text"><?=$batteryRes['sec1_content1'.$langf]?></p>
                            </div>
                        </div>                   
                    </div>
                </div>
				 
                <div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
                    <div class="chose_text_wrapper_left">
                        <div class="chose_icon_wrapper_list">
                            <div class="chose_icon_content_left">
                                <h5 class="text2"><?=$batteryRes['sec1_title2'.$langf]?></h5>
                                <p class="arka-best-choice-text"><?=$batteryRes['sec1_content2'.$langf]?></p>
                            </div>
                        </div>                      
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
                    <div class="chose_text_wrapper_left">
                        <div class="chose_icon_wrapper_list">
                            <div class="chose_icon_content_left">
								<h5 class="text2"><?=$batteryRes['sec1_title3'.$langf]?></h5>
                                <p class="arka-best-choice-text"><?=$batteryRes['sec1_content3'.$langf]?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- sw choose service wrapper end-->
	
	
    <div class="sw_leads_wrapper default-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-lg-5 col-sm-12 col-xs-12">
                    <div class="sw_disc_txt_wrapper">
                        <div class="sw_left_heading_wraper">
                            <h1 style="line-height:1.2"><span class="heading-bold"><?=$batteryRes['sec2_main_heading'.$langf]?></span></h1>
                        </div>
						<div class="">
							<p class="get-solar-desc get-solar-desc-padding"><?=$batteryRes['sec2_content'.$langf]?></p>
						</div>
						<div class="disc_btn">
							<ul>
								<li>
									<a href="<?=getPageUrl($batteryRes['sec2_btn_link'.$langf],$countryConst,$urlConst)?>" class="green-border-btn"><?=$batteryRes['sec2_btn_text'.$langf]?></a>
								</li>
							</ul>
						</div>
					</div>
                </div>
                <div class="col-md-2 col-lg-2 col-sm-12 col-xs-12"></div>
                <div class="col-md-5 col-lg-5 col-sm-12 col-xs-12">
					<div class="sw_road_leads_img" style="">
                        <img src="<?=SITE_PATH.'uploaded_files/batteries/'.$batteryRes['sec2_right_img'.$langf]?>">
                    </div>
                </div>
            </div>
        </div>
    </div>

	<div class="sw_blog_categories_2_wrapper grey-bg default-padding">
		<div class="container">
            <div class="row">
				<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                    <div class="sw_left_heading_wraper sw_center_heading_wrapper">
                        <h1><span class="heading-bold"><?=$batteryRes['sec3_main_heading'.$langf]?></span></h1>
                    </div>
                </div>
				<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<div class="battery-outer">
						<div class="battery-box battery-box-se">
							<div class="batter-opt-top">
								<h5><?=$batteryRes['sec3_title1'.$langf]?></h5>	
							</div>
							<?=$batteryRes['sec3_content1'.$langf]?>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<div class="battery-outer">
						<div class="battery-box battery-box-se">
							<div class="batter-opt-top">
								<h5><?=$batteryRes['sec3_title2'.$langf]?></h5>
							</div>
							<?=$batteryRes['sec3_content2'.$langf]?>
						</div>
					</div>
				</div>
				<!--<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<div class="battery-outer">
						<div class="battery-box">
							<div class="batter-opt-top">
								<h5 style="margin-bottom:18px;"><?=$batteryRes['sec3_title3'.$langf]?></h5>	
							</div>
							<?=$batteryRes['sec3_content3'.$langf]?>
						</div>
					</div>
				</div>-->
			</div>
			<div class="row">
				<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
					<div class="btn-transparent text-center">
						<ul>
							<li>
								<a href="<?=getPageUrl($batteryRes['sec3_btn_link'.$langf],$countryConst,$urlConst)?>" class=""><?=$batteryRes['sec3_btn_text'.$langf]?></a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
    <!--<div class="sw_leads_wrapper default-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-lg-7 col-sm-12 col-xs-12">
                    <div class="sw_disc_txt_wrapper">
                        <div class="sw_left_heading_wraper">
                            <h1 class="hidden-sm hidden-xs" style="line-height:1.2"><?=$batteryRes['sec4_main_heading'.$langf]?></span></h1>
							<h1 class="hidden-lg hidden-md" style="line-height:1.2"><?=$batteryRes['sec4_main_heading'.$langf]?></h1>
                        </div>
                        <div class="row">
							<div class="col-lg-12 col-md-12 col-xs-12 col-sm-6">
								<div class="">
									<?=$batteryRes['sec4_content'.$langf]?>
								</div>
							</div>							      
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>-->
	
	
	<div class="sw_chose_service_wrapper grey-bg1 default-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                    <div class="sw_left_heading_wraper sw_center_heading_wrapper">
						<!--<p class="logo-color"><b><?=$batteryRes['sec5_main_heading'.$langf]?></b></p>-->
                        <h1><span class="heading-bold"><?=$batteryRes['sec5_sub_heading'.$langf]?></span></h1>
                    </div>
                </div>
			</div>
                
			<div class="row">
				<div class="col-lg-4 col-md-4 col-xs-12 col-sm-4">
					<div class="outer-process-box">
						<div class="gb_icon_wrapper text-center battery-help-box">
							<div class="gb_icon_img">
								<img src="<?=SITE_PATH.'uploaded_files/batteries/'.$batteryRes['sec5_icon1']?>">
							</div>	
							<div class="gb_icon_content">
								<h4><?=$batteryRes['sec5_title1'.$langf]?></h4>
							</div>
							<p><?=$batteryRes['sec5_content1'.$langf]?></p>
						</div>
					</div>
					<div class="flow-arrow">
						<img src="<?=SITE_PATH?>assets/images/Batteries/Arrow3.png">
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-xs-12 col-sm-4">
					<div class="outer-process-box">
						<div class="gb_icon_wrapper text-center battery-help-box">
							<div class="gb_icon_img">
								<img src="<?=SITE_PATH.'uploaded_files/batteries/'.$batteryRes['sec5_icon2']?>">
							</div>
							<div class="gb_icon_content">
								<h4><?=$batteryRes['sec5_title2'.$langf]?></h4>
							</div>
							<p><?=$batteryRes['sec5_content2'.$langf]?></p>
						</div>					
					</div>					
					<div class="flow-arrow">
						<img src="<?=SITE_PATH?>assets/images/Batteries/Arrow3.png">
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-xs-12 col-sm-4">
					<div class="outer-process-box">
						<div class="gb_icon_wrapper text-center battery-help-box">
							<div class="gb_icon_img">
								<img src="<?=SITE_PATH.'uploaded_files/batteries/'.$batteryRes['sec5_icon3']?>">
							</div>
							<div class="gb_icon_content">
								<h4><?=$batteryRes['sec5_title3'.$langf]?></h4>
							</div>
							<p><?=$batteryRes['sec5_content3'.$langf]?></p>
						</div>
					</div>
				</div>                
			</div>
        </div>
    </div>
		
	<div class="sw_news_letter_wrapper default-padding battery-gradiant-banner">
        <div class="container">
			<div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
					<div class="sw_nl_heading_wrapper">
						<h2 class="get-connect-battery"><?=$batteryRes['sec6_main_heading'.$langf]?></h2>
					</div>
					<div class="sw_nl_form_wrapper">
						<div class="disc_btn ltr_btn">
							<ul>
								<li>
									<a href="<?=getPageUrl($batteryRes['sec6_btn_link'.$langf],$countryConst,$urlConst)?>" class=""><?=$batteryRes['sec6_btn_text'.$langf]?></a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>
	
	<?php $faqsQry = $cms->db_query("SELECT * FROM #_faqs where status=1 AND is_deleted=0 AND FIND_IN_SET(2,cat_ids) "); 
		$fnum=1;
		if($faqsQry->num_rows>0){
	?>
	<div class="sw_chose_service_wrapper default-padding">
        <div class="container">
			<div class="row">
                <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
					<div class="sw_left_heading_wraper">
						<p style="font-family: 'ProximaNova Regular';"><b><?=$items[0]=='se'?'Vanliga frågor':'FAQ'?></b></p>
						<h1><span class="heading-bold"><?=BATTERY?></span></h1>
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
											<a class="<?=$collapsed?>" data-toggle="collapse" data-parent="#accordionFifteenLeft" href="#collapseFifteenLeft<?=$faqsRes['id']?>" aria-expanded="false"><?=$faqsRes['question'.$langf]?></a>
										</h4>
                                    </div>
                                    <div id="collapseFifteenLeft<?=$faqsRes['id']?>" class="panel-collapse collapse <?=$collapsedin?>" aria-expanded="false" role="tabpanel">
                                        <div class="panel-body">

                                            <div class="panel_cont">
                                                <p><?=$faqsRes['answer'.$langf]?></p>
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
	<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>assets/css/inner-custom.css" />
	
	<?php $solarQry = $cms->db_query("SELECT * FROM #_solar where id=1 ");
	$solarRes = $solarQry->fetch_array();
	
	$metaTitle= $solarRes['meta_title'.$langf];
	$metaIntro= $solarRes['meta_description'.$langf];
	$metaKeyword= $solarRes['meta_key'.$langf];
	
	?>
	
	<?php $homeQry = $cms->db_query("SELECT address_placeholder, address_placeholder_sw, news_sub_heading, news_sub_heading_sw, news_main_heading, news_main_heading_sw FROM #_home ");
	$homeRes = $homeQry->fetch_array();
	?>
	
	<div class="page-head-banner" style="background: url(<?=SITE_PATH.'uploaded_files/solar/'.$solarRes['banner']?>); background-position: center bottom; background-repeat: no-repeat; background-size: cover;">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 col-md-9">
					<div class="content-banner">
						<h2><?=$solarRes['banner_text'.$langf]?></h2>  
						<div class="banner-input-box">
							<form class="" method="post" action="<?=getPageUrl(4,$countryConst,$urlConst)?>">
							<div class="row">
								<div class="col-md-5 col-sm-5 col-xs-6 banner-padding-right-none">
									<input type="text" name="search-address" id="ship-address" placeholder="<?=$homeRes['address_placeholder'.$langf]?>" class="banner-address-input">
								</div>
								<div class="col-md-1 col-sm-3 col-xs-3 padding-left-05 banner-btn-effect">
									<input type="image" id="my-img" src="<?=SITE_PATH?>assets/images/arrow/Group-222.svg" onmouseover="hover(this);" onmouseout="unhover(this);" />
								</div>
							</div>
							</form>
						</div>
						<div class="banner-call-btn">
							<a href="tel:<?=$settingArr['phone']?>"> 
								<img src="<?=SITE_PATH?>assets/images/arrow/phone.svg"> 
								<span class="calling-number"><?=$settingArr['phone']?></span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
  
    <div class="default-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                    <div class="sw_left_heading_wraper sw_center_heading_wrapper">
						<!--<p class="section-sub-heading"><?=$solarRes['sec1_main_heading'.$langf]?></p>-->
                        <h1><span class="heading-bold"><?=$solarRes['sec1_sub_heading'.$langf]?></span></h1>
                    </div>
                </div>
			</div>
			<div class="row">
				<div class="col-lg-3 col-md-3 col-xs-12 col-sm-6">
					<div class="arka-process-box arka-process-box-eng">
						<div class="arka-process-icon">
							<img src="<?=SITE_PATH.'uploaded_files/solar/'.$solarRes['sec1_icon1']?>">
						</div>	
						<div class="arka-process-content">
							<h4><?=$solarRes['sec1_title1'.$langf]?></h4>
						</div>
						<p class="arka-process-desc"><?=$solarRes['sec1_content1'.$langf]?></p>
						<div class="disc_btn text-center">
							<ul>
								<li>
									<a href="<?=getPageUrl($solarRes['sec1_btn_link'.$langf],$countryConst,$urlConst)?>" class="green-border-btn"><?=$solarRes['sec1_btn_text'.$langf]?></a>
								</li>
							</ul>
						</div>
					</div>					
					<div class="arka-arrow">
						<img src="<?=SITE_PATH?>assets/images/solar/p-arrow.png">
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-xs-12 col-sm-6">
					<div class="arka-process-box arka-process-box-eng">
						<div class="arka-process-icon">
							<img src="<?=SITE_PATH.'uploaded_files/solar/'.$solarRes['sec1_icon2']?>">
						</div>	
						<div class="arka-process-content">
							<h4><?=$solarRes['sec1_title2'.$langf]?></h4>
						</div>
						<p class="arka-process-desc"><?=$solarRes['sec1_content2'.$langf]?></p>
					</div>
					<div class="arka-arrow">
						<img src="<?=SITE_PATH?>assets/images/solar/p-arrow.png">
					</div>
				</div>	
				<div class="col-lg-3 col-md-3 col-xs-12 col-sm-6">
					<div class="arka-process-box arka-process-box-eng">
						<div class="arka-process-icon">
							<img src="<?=SITE_PATH.'uploaded_files/solar/'.$solarRes['sec1_icon3']?>">
						</div>	
						<div class="arka-process-content">
							<h4><?=$solarRes['sec1_title3'.$langf]?></h4>
						</div>
						<p class="arka-process-desc"><?=$solarRes['sec1_content3'.$langf]?></p>
					</div>
					<div class="arka-arrow">
						<img src="<?=SITE_PATH?>assets/images/solar/p-arrow.png">
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-xs-12 col-sm-6">
					<div class="arka-process-box arka-process-box-eng">
						<div class="arka-process-icon">
							<img src="<?=SITE_PATH.'uploaded_files/solar/'.$solarRes['sec1_icon4']?>">
						</div>	
						<div class="arka-process-content">
							<h4><?=$solarRes['sec1_title4'.$langf]?></h4>
						</div>
						<p class="arka-process-desc"><?=$solarRes['sec1_content4'.$langf]?></p>
					</div>
				</div>                
			</div>
        </div>
    </div>
	
	
	<div class="sw_blog_categories_2_wrapper pst grey-bg default-padding">
		<div class="container">
            <div class="row">
				<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                    <div class="sw_left_heading_wraper sw_center_heading_wrapper">
                        <h1><span class="heading-bold"><?=$solarRes['sec2_main_heading'.$langf]?></span></h1>
                    </div>
                </div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="content-three">
						<div class="tabs-box">
							<div class="">
								<div class="btn-column">
									<div class="tab-btn-box">
										<ul class="tab-btns tab-buttons clearfix">
											<li class="tab-btn active-btn" data-tab="#tab-1">
												<?=$solarRes['sec2_title1'.$langf]?> 
											</li>
											<li class="tab-btn" data-tab="#tab-2">
												<?=$solarRes['sec2_title2'.$langf]?>
											</li>
											<li class="tab-btn" data-tab="#tab-3">
												<?=$solarRes['sec2_title3'.$langf]?>
											</li>
										</ul>
									</div>
								</div>
								<div class="content-column">
									<div class="tabs-content">
										<div class="tab active-tab" id="tab-1" style="display:block">
											<div class="row">
												<div class="col-md-6 col-sm-8">
													<div class="solar-inner-box">
														<div class="text">													
															<div class="ib-text">
																<div class="row">
																	<div class="col-md-8">
																		<h3 class="solar-panel-name"><?=$solarRes['sec2_title1'.$langf]?></h3>
																	</div>
																	<div class="col-md-4">
																		<h3 class="solar-capacity"><?=$solarRes['panel_capacity1'.$langf]?>W</h3>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="solar-inner-box">
														<div class="text">													
															<div class="ib-text">
																<div class="row">
																	<div class="col-md-12">
																		<p class="panel-info"><b><?=$countryConst=='SE'?'Produktinformation':'Product information'?></b></p>
																		<?=$solarRes['sec2_panel1'.$langf]?>
																		<div class="disc_btn text-center">
																			<ul>
																				<li>
																					<a href="<?=getPageUrl(4,$countryConst,$urlConst)?>" class="green-border-btn"><?=$countryConst=='SE'?'Kostnadskalkyl':'Solar Calculator'?></a>
																				</li>
																			</ul>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-6 col-sm-4">
													<div class="text-center">
														<img src="<?=SITE_PATH.'uploaded_files/solar/'.$solarRes['sec2_img1']?>" class="img-responsive">
													</div>
												</div>
											</div>
										</div>
										
										<div class="tab" id="tab-2">
											<div class="row">
												<div class="col-md-6 col-sm-8">
													<div class="solar-inner-box">
														<div class="text">													
															<div class="ib-text">
																<div class="row">
																	<div class="col-md-8">
																		<h3 class="solar-panel-name"><?=$solarRes['sec2_title2'.$langf]?></h3>
																	</div>
																	<div class="col-md-4">
																		<h3 class="solar-capacity"><?=$solarRes['panel_capacity2'.$langf]?>W</h3>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="solar-inner-box">
														<div class="text">													
															<div class="ib-text">
																<div class="row">
																	<div class="col-md-12">
																		<p class="panel-info"><b><?=$countryConst=='SE'?'Produktinformation':'Product information'?></b></p>
																		<?=$solarRes['sec2_panel2'.$langf]?>
																		<div class="disc_btn text-center">
																			<ul>
																				<li>
																					<a href="<?=getPageUrl(4,$countryConst,$urlConst)?>" class="waves-effect waves-light waves-ripple green-text green-border-btn"><?=$countryConst=='SE'?'Kostnadskalkyl':'Solar Calculator'?></a>
																				</li>
																			</ul>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-6 col-sm-4">
													<div class="text-center">
														<img src="<?=SITE_PATH.'uploaded_files/solar/'.$solarRes['sec2_img2']?>" class="img-responsive">
													</div>
												</div>
											</div>
										</div>
										<div class="tab" id="tab-3">
											<div class="row">
												<div class="col-md-6 col-sm-8">
													<div class="solar-inner-box">
														<div class="text">													
															<div class="ib-text">
																<div class="row">
																	<div class="col-md-8">
																		<h3 class="solar-panel-name"><?=$solarRes['sec2_title3'.$langf]?></h3>
																	</div>
																	<div class="col-md-4">
																		<h3 class="solar-capacity"><?=$solarRes['panel_capacity3'.$langf]?>W</h3>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="solar-inner-box">
														<div class="text">													
															<div class="ib-text">
																<div class="row">
																	<div class="col-md-12">
																		<p class="panel-info"><b><?=$countryConst=='SE'?'Produktinformation':'Product information'?></b></p>
																		<?=$solarRes['sec2_panel3'.$langf]?>

																		<div class="disc_btn text-center">
																			<ul>
																				<li>
																					<a href="<?=getPageUrl(4,$countryConst,$urlConst)?>" class="green-border-btn"><?=$countryConst=='SE'?'Kostnadskalkyl':'Solar Calculator'?></a>
																				</li>
																			</ul>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-6 col-sm-4">
													<div class="text-center">
														<img src="<?=SITE_PATH.'uploaded_files/solar/'.$solarRes['sec2_img3']?>" class="img-responsive">
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!--<div class="sw_blog_categories_2_wrapper pst grey-bg default-padding">
		<div class="container">
            <div class="row">
				<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                    <div class="sw_left_heading_wraper sw_center_heading_wrapper">
                        <h1><span class="heading-bold">Our Bestsellers</span></h1>
                    </div>
                </div>
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<div class="btc_blog_indx_box_wrapper btc_blog_padder btc_index_blog_pader">
						<div class="btc_blog_indx_cont_wrapper">						
							<div class="btc_blog_indx_img_wrapper">
								<img src="<?=SITE_PATH?>assets/images/solar/b1.png" alt="blog_img">
							</div>
							<div class="installation-content">
								<h5>For your summer home</h5>	
								<div class="middle-part">
									<div class="row">
										<div class="col-md-6 col-xs-6">
											<div class="bestseller-left-text">
												<p class="dark-grey-text">Dark Panels</p>
											</div>
										</div>
										<div class="col-md-6 col-xs-6">
											<div class="bestseller-right-text text-right">
												<p class="light-grey-text">380-390 W panel</p>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-md-6 col-xs-6">
										<div class="payback-text">
											<p>Payback Year</p>
										</div>
									</div>
									<div class="col-md-6 col-xs-6">
										<div class="bestseller-more-info text-right">
											<p><a href=""> More info <img src="<?=SITE_PATH?>assets/images/solar/more-arrow.png"></a></p>
										</div>
									</div>
								</div>								
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<div class="btc_blog_indx_box_wrapper btc_blog_padder btc_index_blog_pader">
						<div class="btc_blog_indx_cont_wrapper">						
							<div class="btc_blog_indx_img_wrapper">
								<img src="<?=SITE_PATH?>assets/images/solar/b2.png" alt="blog_img">
							</div>
							<div class="installation-content">
								<h5>Luxory</h5>	
								<div class="middle-part">
									<div class="row">
										<div class="col-md-4 col-xs-6">
											<div class="bestseller-left-text">
												<p class="dark-grey-text">Black Panel</p>
											</div>
										</div>
										<div class="col-md-8 col-xs-6">
											<div class="bestseller-right-text text-right">
												<p class="light-grey-text">380-390 W panel/<br>Power Optimiser</p>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-md-6 col-xs-6">
										<div class="payback-text">
											<p>Payback Year</p>
										</div>
									</div>
									<div class="col-md-6 col-xs-6">
										<div class="bestseller-more-info text-right">
											<p><a href=""> More info <img src="<?=SITE_PATH?>assets/images/solar/more-arrow.png"></a></p>
										</div>
									</div>
								</div>								
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<div class="btc_blog_indx_box_wrapper btc_blog_padder btc_index_blog_pader">
						<div class="btc_blog_indx_cont_wrapper">						
							<div class="btc_blog_indx_img_wrapper">
								<img src="<?=SITE_PATH?>assets/images/solar/b3.png" alt="blog_img">
							</div>
							<div class="installation-content">
								<h5>Super Luxory</h5>	
								<div class="middle-part">
									<div class="row">
										<div class="col-md-6 col-xs-6">
											<div class="bestseller-left-text">
												<p class="dark-grey-text">Bi-Facial Panel</p>
											</div>
										</div>
										<div class="col-md-6 col-xs-6">
											<div class="bestseller-right-text text-right">
												<p class="light-grey-text">Elegent<br>380-390 W panel</p>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-md-6 col-xs-6">
										<div class="payback-text">
											<p>Payback Year</p>
										</div>
									</div>
									<div class="col-md-6 col-xs-6">
										<div class="bestseller-more-info text-right">
											<p><a href=""> More info <img src="<?=SITE_PATH?>assets/images/solar/more-arrow.png"></a></p>
										</div>
									</div>
								</div>								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>-->
	
	<!--<div class="sw_chose_service_wrapper default-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                    <div class="sw_left_heading_wraper sw_center_heading_wrapper">
                        <h1><span class="heading-bold"><?=$solarRes['sec3_main_heading']?></span></h1>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
                    <div class="chose_text_wrapper_left">
                        <div class="chose_icon_wrapper_list">
                            <div class="chose_icon_content_left">
								<div class="fin-icon">
									<img src="<?=SITE_PATH.'uploaded_files/solar/'.$solarRes['sec3_icon1']?>">
								</div>
                                <h5 class="text2"><?=$solarRes['sec3_title1']?></h5>
                                <p class="arka-best-choice-text"><?=$solarRes['sec3_content1']?></p>
                            </div>
                        </div>                   
                    </div>
                </div>
				 
                <div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
                    <div class="chose_text_wrapper_left">
                        <div class="chose_icon_wrapper_list">
                            <div class="chose_icon_content_left">
                                <div class="fin-icon">
									<img src="<?=SITE_PATH.'uploaded_files/solar/'.$solarRes['sec3_icon2']?>">
								</div>
                                <h5 class="text2"><?=$solarRes['sec3_title2']?></h5>
                                <p class="arka-best-choice-text"><?=$solarRes['sec3_content2']?></p>
                            </div>
                        </div>                      
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
                    <div class="chose_text_wrapper_left">
                        <div class="chose_icon_wrapper_list">
                            <div class="chose_icon_content_left">
								<div class="fin-icon">
									<img src="<?=SITE_PATH.'uploaded_files/solar/'.$solarRes['sec3_icon3']?>">
								</div>
								<h5 class="text2"><?=$solarRes['sec3_title3']?></h5>
                                <p class="arka-best-choice-text"><?=$solarRes['sec3_content3']?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>-->
	
	<?php $projectQry = $cms->db_query("SELECT * FROM #_recent_projects where status=1 AND is_deleted=0 ");
	if($projectQry->num_rows>0){
	?>
	<div class="default-padding arka-installation">
        <div class="container">
            <div class="row">
				<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                    <div class="sw_left_heading_wraper sw_center_heading_wrapper">
                        <h1 style="font-size:24px; margin-top:10px;"><span class="heading-bold"><?=$solarRes['sec4_sub_heading'.$langf]?></span></h1>
                    </div>
                </div>

                <!-- slider start -->
                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 sw_spectrm_padding">
                    <div class="spectrum_slider_wrapper">
						<div class="owl-carousel owl-theme">
							<?php while($projectArr = $projectQry->fetch_array()){?>
							<div class="item">
								<div class="btc_blog_indx_box_wrapper btc_blog_padder btc_index_blog_pader">
									<div class="btc_blog_indx_cont_wrapper">						
										<div class="btc_blog_indx_img_wrapper">
											<img src="<?=SITE_PATH.'uploaded_files/project/'.$projectArr['project_img']?>">
										</div>
										<div class="installation-content text-left">
											<h5><?=$projectArr['project_type'.$langf]?></h5>	
											<div class="btc_blog_indx_cont_bottom_left">
												<p><?=$projectArr['project_name'.$langf]?></p>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php } ?>
						</div>
					</div>
                </div>
				<!--<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
					<div class="disc_btn text-center">
						<ul>
							<li>
								<a href="#" class="waves-effect waves-light waves-ripple green-text green-border-btn">More projects</a>
							</li>
						</ul>
					</div>
				</div>-->
            </div>
        </div>
    </div>
	<?php } ?>
	
	
	<?php $latestBlogQry = $cms->db_query("SELECT * FROM #_blogs where status=1 AND is_deleted=0 order by post_date limit 1 ");
		if($latestBlogQry->num_rows>0){
		$latestBlogRes = $latestBlogQry->fetch_array();
		
		$catArr = explode(',',$latestBlogRes['cat_id']);
	?>
	<div class="sw_chose_service_wrapper default-padding">
        <div class="container">
			<div class="row">
				<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
					<div class="sw_left_heading_wraper">
						<p style="font-family: 'ProximaNova Regular';"><b><?=$homeRes['news_main_heading'.$langf]?></b></p>
						<h1><span class="heading-bold"><?=$homeRes['news_sub_heading'.$langf]?></span></h1>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
					<div class="sw_abt_right_btm_wrapper news-wrapper">
						<div class="sw_left_heading_wraper" style="padding-bottom:0px;">
							<p class="news-postdate"><?=date('M d, Y',strtotime($latestBlogRes['post_date']))?></p>
                            <h2><?=$latestBlogRes['title'.$langf]?></h2>
                            <p style="font-family: 'OpenSans Regular';padding-top:30px;font-size:15px; line-height:1.5;"><?=$latestBlogRes['blog_content'.$langf]?></p>
							
							<?php $blogCatQry = $cms->db_query("SELECT * FROM #_blog_catagories where status=1 AND is_deleted=0 ");
							if($blogCatQry->num_rows>0){
							?>
							<ul class="news-tags">
								<?php while($blogCatRes = $blogCatQry->fetch_array()){
									if(in_array($blogCatRes['id'],$catArr)){
								?>
								<li><?=$blogCatRes['cat_name']?></li>
								<?php } } ?>
							</ul>
							<?php } ?>
							<div class="blog-read-more-btn">
								<p style="font-weight:400; margin-bottom:0px;"><a href="<?=SITE_PATH.'blog/'.$latestBlogRes['url']?>" class="waves-effect waves-light waves-ripple">Read more <i class="fa fa-long-arrow-right"></i></a></p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
					<?php $blogQry = $cms->db_query("SELECT * FROM #_blogs where status=1 AND is_deleted=0 order by post_date ASC LIMIT 1,4 ");
					if($blogQry->num_rows>0){
					?>
					<div class="sw_disc_txt_wrapper">
						<?php while($blogRes = $blogQry->fetch_array()){?>
                        <div class="sw_desc_btm_txt">
                            <div class="sw_disc_head_text">
                                <h5><a href="<?=SITE_PATH.'blog/'.$blogRes['url']?>"><?=$blogRes['title'.$langf]?> <span class="next-arrow"><i class="fa fa-long-arrow-right"></i></span></a></h5>
                            </div>
                        </div>
						<?php } ?>
					</div>
					<?php } ?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
					<div class="disc_btn text-center">
						<ul>
							<li>
								<a href="<?=SITE_PATH?>blog" class="green-border-btn">See all news</a>
							</li>
						</ul>
					</div>
				</div>
			</div>	
		</div>	
	</div>
	<?php } ?>	
	
	<?php $faqsQry = $cms->db_query("SELECT * FROM #_faqs where status=1 AND is_deleted=0 AND FIND_IN_SET(1,cat_ids) "); 
		$fnum=1;
		if($faqsQry->num_rows>0){
	?>
	<div class="sw_chose_service_wrapper grey-bg default-padding">
        <div class="container">
			<div class="row">
                <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
					<div class="sw_left_heading_wraper">
						<p style="font-family: 'ProximaNova Regular';"><b>FAQ</b></p>
						<h1><span class="heading-bold"><?=SOLAR?></span></h1>
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
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>

<!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <!--<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBcuL09_sSUWR-65TVL061A0xG4TKGAhrA&libraries=places,drawing"
      async
    ></script>-->
	
	
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBcuL09_sSUWR-65TVL061A0xG4TKGAhrA&callback=initAutocomplete&v=weekly&libraries=places,drawing" async> </script>
	
<script>
// This sample uses the Places Autocomplete widget to:
// 1. Help the user select a place
// 2. Retrieve the address components associated with that place
// 3. Populate the form fields with those address components.
// This sample requires the Places library, Maps JavaScript API.
// Include the libraries=places parameter when you first load the API.
// For example: <script
// src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
let autocomplete;
let address1Field;
let address2Field;
let postalField;

function initAutocomplete() {
  address1Field = document.querySelector("#ship-address");
  address2Field = document.querySelector("#address2");
  postalField = document.querySelector("#postcode");
  // Create the autocomplete object, restricting the search predictions to
  // addresses in the US and Canada.
  autocomplete = new google.maps.places.Autocomplete(address1Field, {
    componentRestrictions: { country: ["se"] },
    fields: ["address_components", "geometry"],
    types: ["address"],
  });
  address1Field.focus();
  // When the user selects an address from the drop-down, populate the
  // address fields in the form.
  autocomplete.addListener("place_changed", fillInAddress);
}


function fillInAddress() {
  // Get the place details from the autocomplete object.
  const place = autocomplete.getPlace();
  let address1 = "";
  let postcode = "";

  // Get each component of the address from the place details,
  // and then fill-in the corresponding field on the form.
  // place.address_components are google.maps.GeocoderAddressComponent objects
  // which are documented at http://goo.gle/3l5i5Mr
  for (const component of place.address_components) {
    const componentType = component.types[0];

    switch (componentType) {
      case "street_number": {
        address1 = `${component.long_name} ${address1}`;
        break;
      }

      case "route": {
        address1 += component.short_name;
        break;
      }

      case "postal_code": {
        postcode = `${component.long_name}${postcode}`;
        break;
      }

      case "postal_code_suffix": {
        postcode = `${postcode}-${component.long_name}`;
        break;
      }
      case "locality":
        document.querySelector("#locality").value = component.long_name;
        break;

      case "administrative_area_level_1": {
        document.querySelector("#state").value = component.short_name;
        break;
      }
      case "country":
        document.querySelector("#country").value = component.long_name;
        break;
    }
  }
  address2Field.value = address1;
  postalField.value = postcode;
  // After filling the form with address components from the Autocomplete
  // prediction, set cursor focus on the second address line to encourage
  // entry of subpremise information such as apartment, unit, or floor number.
  address2Field.focus();
}
</script>
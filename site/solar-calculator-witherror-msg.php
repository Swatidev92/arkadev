<style>
.sw_dark_heading_wraper h1 {
    color: #000 !important;
}
</style>

	
	
	<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>assets/css/inner-custom.css" />

	<div class="contact-section grey-bg calculator-padding">
		<div class="container calc-container1">
			<div class="holder">
				<div class="calculator-tab hidden-sm hidden-xs">
					<ul class="nav nav-tabs nav-justified" role="tablist" id="form-tab">
						<li role="presentation" class="active">
							<a href="#address" aria-controls="address" role="tab" data-toggle="tab" aria-expanded="true"><?=$countryConst=='SE'?'Adress':'Address'?></a>
						</li>
						<li role="presentation" class="disabled">
							<a href="#mark-roof" aria-controls="mark-roof" role="tab" data-toggle="tab" aria-expanded="false"><?=$countryConst=='SE'?'Markera tak':'Mark roof'?></a>
						</li>
						<li role="presentation" class="disabled">
							<a href="#roof-slope" aria-controls="roof-slope" role="tab" data-toggle="tab" aria-expanded="false"><?=$countryConst=='SE'?'Taklutning':'Roof slope'?></a>
						</li>
						<li role="presentation" class="disabled">
							<a href="#pannel" aria-controls="pannel" role="tab" data-toggle="tab" aria-expanded="false"><?=$countryConst=='SE'?'Paneltyp':'Pannel section'?></a>
						</li>
						<li role="presentation" class="disabled summary-no-right-border">
							<a href="#summary" aria-controls="summary" role="tab" data-toggle="tab" aria-expanded="false"><?=$countryConst=='SE'?'Sammanfattning':'Summary'?></a>
						</li>
						<li class="annual-summary-top left-top-radius1">
							<div class="saving-inline annual-saving">
								<div class="saving-img">
									<img src="<?=SITE_PATH?>assets/images/calculator/Group-114.png" class="">
								</div>
								<div class="annual-text">
									<p class="annual-saving-count">-</p>
									<p class="annual-saving-text"><?=$countryConst=='SE'?'Årlig besparing':'Annual savings'?></p>
								</div>
							</div>
						</li>
						<li class="annual-summary-top top-right-corner">
							<div class="saving-inline annual-cost">
								<div class="saving-img">
									<img src="<?=SITE_PATH?>assets/images/calculator/Group-112.png" class="">
								</div>
								<div class="annual-text">
									<p class="annual-cost-count">-</p>
									<p class="annual-cost-text"><?=$countryConst=='SE'?'Kostnad':'Upfront cost'?></p>
								</div>
							</div>
						</li>
					</ul>
				</div>
				
				<form method="post" class="solar_form" data-toggle="validator" onSubmit="return submitCalculator('solar_form','cmsg','calculatorSubmit')">
				
				<!--<form method="post" class="solar_form" data-toggle="validator">-->
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="address">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 padding-right-none">
								<div class="calculator-leftbox1">
									<!--<div class="wrapper_second_useful_2">
										<div class="sw_left_heading_wraper sw_dark_heading_wraper">
										</div>
									</div>-->
									<?php if($countryConst=='SE'){?>
									<img class="map-image" src="<?=SITE_PATH?>assets/images/calculator/map-latest2.jpg" width="100%">
									<?php }else{?>
									<img class="map-image" src="<?=SITE_PATH?>assets/images/calculator/english-map.jpg" width="100%">
									<?php } ?>
									
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 padding-left-none">
								<div class="calculator-form-box form-boc-top tab1-right-box">
									<div class="row">									
										<div class="col-md-12">
											<label class="label-text"><?=$countryConst=='SE'?'Ange din adress':'Enter your address'?></label>
											<!--<p class="sub-label">Enter a home for your new Solar Panels</p>-->
											<div class="row">									
												<div class="col-md-9 col-sm-9 col-xs-9">
													<input type="text" name="address" placeholder="<?=$countryConst=='SE'?'Adress':'Address'?>" id="sel_address" value="<?=$_POST['search-address']?$_POST['search-address']:''?>">
													<input type="hidden" name="sellat" id="sellat" value="">
													<input type="hidden" name="sellong" id="sellong" value="">
													<input type="hidden" name="user_area_map" id="user_area_map" value="">
													<input type="hidden" id="postcode" name="postcode" />
													<input type="hidden" id="address2" name="address2" />
												</div>
												
												<div class="col-md-3 col-sm-3 col-xs-3">
													<a class="getlatlong submitForm getStarted continue" id="getlatlong">
														<img src="<?=SITE_PATH?>assets/images/arrow/Group-222.svg" class="calc-grey-arrow"> 
														<img src="<?=SITE_PATH?>assets/images/arrow/Group-223.svg" class="calc-green-arrow">
													</a>
												</div>
											</div>												
										</div>
									</div>
									<!--<a class="btn btn-primary continue">Continue</a>-->
								</div>
							</div>							
						</div>					
					</div>	
					
					<div role="tabpanel" class="tab-pane" id="mark-roof">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 padding-right-none">
								<div class="calculator-leftbox1">
									<div class="wrapper_second_useful_2">
										<div id="map"></div>

										<div class="css-6tshae resetmap" style="display:none;"><span class="carea"></span><span class="panelonmap"></span><a href="javascript:void(0);" onclick="reset();"><i class="fa fa-undo" aria-hidden="true"></i> <span class="css-joun2m"><?=$countryConst=='SE'?'Återställ':'Reset'?></span></a></div>
										
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 padding-left-none">
								<div class="calculator-form-box form-boc-top tab2-right-box">
									<div class="row">
										<div class="col-md-12">
											<label class="label-text"><?=$countryConst=='SE'?'Mät ditt takområde':'Measure your roof area'?></label>
											<p class="sub-label"><?=$countryConst=='SE'?'Klicka på varje hörn av ditt tak för att mäta ditt takområde':'Click on every corner of your house on the map to measure your roof area'?></p>	
											<div class="more-panel"></div>
											<div class="contact-link-map"></div>

											<input type="hidden" name="roof_area" id="roof_area">
											<input type="hidden" name="size" id="size">
											<input type="hidden" name="panels" id="panels">
										</div>
									</div>
								</div>
									
								<div class="bottom-btn-area">	
									<div class="row">	
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
											<div class="calculator-get-started cntct_2_btn_inner">
												<a class="submitForm backbtn back prev-step" id="back-to-address"><i class="fa fa-long-arrow-left"></i> <span><?=$countryConst=='SE'?'Tillbaka':'Back'?></span></a>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 hidden-lg hidden-md hidden-sm">
											<div class="progress">
												<div class="progress-bar" style="width:30%"></div>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
											<div class="calculator-get-started cntct_2_btn_inner text-right">
												<a class="submitForm nextbtn continue" id="step2_submit"><span><?=$countryConst=='SE'?'Nästa':'Next'?></span> <i class="fa fa-long-arrow-right"></i> </a>
											</div>
										</div>
									</div>
								</div>
							</div>							
						</div>	
					</div>

					<div role="tabpanel" class="tab-pane" id="roof-slope">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 padding-right-none">
								<div class="calculator-leftbox1">
									<div class="wrapper_second_useful_2">
										<img class="drawn-map-img" src="" width="100%">
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 padding-left-none">
								<div class="calculator-form-box form-boc-top tab3-right-box">
									<div class="row">
										<div class="col-md-12">
											<label class="label-text"><?=$countryConst=='SE'?'Välj taklutning':'Choose the slope'?></label>
											<!--<p class="sub-label">How tilted your roof is?</p>-->
											<div class="row">
												<div class="col-lg-4 col-md-4 col-xs-12 col-sm-4">
													<label class="custom-radio-lable">
														<input type="radio" name="slope_type" value="0-15">
														<div class="select-business">
															<img src="<?=SITE_PATH?>assets/images/calculator/flat.png" class="slop-icon">
															<!--<div class="business-name"><b>Flat</b></div>-->
															<p class="text-center">0-15&deg;</p>
														</div>
													</label>
												</div>
												<div class="col-lg-4 col-md-4 col-xs-12 col-sm-4">
													<label class="custom-radio-lable">
														<input type="radio" name="slope_type" value="15-30">
														<div class="select-business">
															<img src="<?=SITE_PATH?>assets/images/calculator/low-slope.png" class="slop-icon">
															<!--<div class="business-name"><b>Low Slope</b></div>-->
															<p class="text-center">15-30&deg;</p>
														</div>
													</label>
												</div>
												<div class="col-lg-4 col-md-4 col-xs-12 col-sm-4">
													<label class="custom-radio-lable">
														<input type="radio" name="slope_type" value=">30">
														<div class="select-business">
															<img src="<?=SITE_PATH?>assets/images/calculator/con-slope.png" class="slop-icon">
															<!--<div class="business-name"><b>Conventional Slope</b></div>-->
															<p class="text-center">>30&deg;</p>
														</div>														
													</label>
												</div>
												<input type="hidden" name="sel_slope_type" id="sel_slope_type">
											</div>
										</div>
									</div>
								</div>
								<div class="bottom-btn-area">	
									<div class="row">	
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
											<div class="calculator-get-started cntct_2_btn_inner">
												<a class="submitForm backbtn back prev-step"><i class="fa fa-long-arrow-left"></i> <span><?=$countryConst=='SE'?'Tillbaka':'Back'?></span></a>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 hidden-lg hidden-md hidden-sm">
											<div class="progress">
												<div class="progress-bar" style="width:60%"></div>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
											<div class="calculator-get-started cntct_2_btn_inner text-right">
												<a class="submitForm nextbtn continue" id="step3_submit"><span><?=$countryConst=='SE'?'Nästa':'Next'?></span> <i class="fa fa-long-arrow-right"></i> </a>
											</div>
										</div>
									</div>
								</div>
							</div>							
						</div>	
					</div>
					
					<div role="tabpanel" class="tab-pane" id="pannel">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 padding-right-none">
								<div class="calculator-leftbox1">
									<div class="wrapper_second_useful_2">
										<img class="essential-img" src="<?=SITE_PATH?>assets/images/calculator/panels/essential.jpg" width="100%">
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 padding-left-none">
								<div class="calculator-form-box tab4-right-box">
									<div class="row">
										<div class="col-md-12">
											<label class="label-text"><?=$countryConst=='SE'?'Vilken modell av solpaneler vill du använda':'Which solar panel type you want to install'?></label>
											<p class="sub-label"><?=$countryConst=='SE'?'Välj från de tre alternativen nedan. Pris och besparingar uppdateras automatiskt när du skiftar mellan de olika alernativen.':'Choose from our options to find the best solution  for you. Price and savings are in the box above. See all details in the next step.'?></p>
											<div class="row">
												<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
													<label class="have-rooftop-lable">
														<input type="radio" name="panel_type" value="Optimized" checked>
														<div class="rooftop-radio-label">Optimized</div>
													</label>
												</div>
												<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
													<label class="have-rooftop-lable">
														<input type="radio" name="panel_type" value="Esthetic">
														<div class="rooftop-radio-label">Esthetic</div>
													</label>
												</div>
												<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
													<label class="have-rooftop-lable">
														<input type="radio" name="panel_type" value="Performance">
														<div class="rooftop-radio-label">Performance</div>
													</label>
												</div>
												<input type="hidden" name="sel_panel_type" id="sel_panel_type" value="Optimized">
												<input type="hidden" name="panel_val" id="panel_val" value="400">
											</div>
											
											<div class="onPanelSel" id="onPanelSel1">
												<div class="row">
													<div class="col-lg-6 col-md-6 col-sm-8 col-xs-8">
														<label class="panel-text" id="panel_type_name">Optimized</label>
													</div>
													<div class="col-lg-6 col-md-6 col-sm-4 col-xs-4 text-right">
														<label class="panel-text" id="panel_type_val">400W</label>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">													
														<?php if($countryConst=='SE'){?>
														<p>Vi rekommenderar Optimized solpaneler för dig som vill ha de mest kostnadseffektiva panelerna på marknaden.</p>
														<ul class="solar-panel-list-info">
															<li>Lång förväntad livslängd (85% effekt efter 25 år)</li>
															<li>Mest kostnadseffektiva</li>
															<li>Monokristallpaneler</li>
														</ul>
														<?php }else{?>														
														<p>We recommend Optimized solar panels for you who want the most cost-effective panels on the market.</p>
														<ul class="solar-panel-list-info">
															<li>Long life expectancy (85% effect after 25 years)</li>
															<li>Most cost effective</li>
															<li>Single crystal panels</li>
														</ul>
														<?php } ?>
													</div>
												</div>
											</div>
											<div class="onPanelSel" id="onPanelSel2" style="display:none">
												<div class="row">
													<div class="col-lg-6 col-md-6 col-sm-8 col-xs-8">
														<label class="panel-text" id="panel_type_name">Esthetic</label>
													</div>
													<div class="col-lg-6 col-md-6 col-sm-4 col-xs-4 text-right">
														<label class="panel-text" id="panel_type_val">395W</label>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<?php if($countryConst=='SE'){?>
														<p>Esthetic solpaneler är vår helsvarta panel som tilltalar kundgrupper som efterfrågar stilrena paneler men utan att tumma på kvalité och effekt.  </p>
														<ul class="solar-panel-list-info">
															<li>Vacker helsvart design</li>
															<li>Lång förväntad livslängd (85% effekt efter 25 år)</li>
															<li>Hög effekt</li>
														</ul>
														<?php }else{?>						
														<p>Esthetic solar panels are our all-black panel that appeals to customer groups who demand stylish panels but without compromising on quality and effect.</p>
														<ul class="solar-panel-list-info">
															<li>Beautiful all-black design</li>
															<li>Long life expectancy (85% effect after 25 years)</li>
															<li>High power</li>
														</ul>
														<?php } ?>
														
													</div>
												</div>
											</div>
											<div class="onPanelSel" id="onPanelSel3" style="display:none">
												<div class="row">
													<div class="col-lg-6 col-md-6 col-sm-8 col-xs-8">
														<label class="panel-text" id="panel_type_name">Performance</label>
													</div>
													<div class="col-lg-6 col-md-6 col-sm-4 col-xs-4 text-right">
														<label class="panel-text" id="panel_type_val">375W</label>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<?php if($countryConst=='SE'){?>
														<p>Våra Performance-paneler ger en robusthet med hög effektivitet och är optimerad för en extra lång livslängd.</p>
														<ul class="solar-panel-list-info">
															<li>Extra lång livslängd (mer än 90% effekt efter 25 år)</li>
															<li>Reducerad förlust vid skuggning</li>
															<li>Dubbelglas med högre mekanisk tillförlitlighet och ökad brandsäkerhet</li>
														</ul>
														<?php }else{?>	
														<p>Our Performance panels provide robustness with high efficiency and are optimized for an extra long service life.</p>
														<ul class="solar-panel-list-info">
															<li>Extra long service life (more than 90% effect after 25 years)</li>
															<li>Reduced loss when shading</li>
															<li>Double glazing with higher mechanical reliability and increased fire safety</li>
														</ul>
														<?php } ?>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
													<label class="label-text addon-text"><?=$countryConst=='SE'?'Tillägg':'Add ons'?></label>
												</div>
												<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
													<label class="have-rooftop-lable">
														<input type="checkbox" name="addon_type[]" value="at1">
														<div class="rooftop-radio-label"><?=$countryConst=='SE'?'Batteri':'Battery'?></div>
													</label>
												</div>
												<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
													<label class="have-rooftop-lable">
														<input type="checkbox" name="addon_type[]" value="at2">
														<div class="rooftop-radio-label"><?=$countryConst=='SE'?'Billaddare':'Car charger'?></div>
													</label>
												</div>
												<input type="hidden" name="sel_addon_type" id="sel_addon_type">
												<input type="hidden" name="upfront_cost" id="upfront_cost">
											</div>
										</div>
									</div>
								</div>
								<div class="bottom-btn-area">	
									<div class="row">	
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
											<div class="calculator-get-started cntct_2_btn_inner">
												<a class="submitForm backbtn back prev-step" id="step4_back"><i class="fa fa-long-arrow-left"></i> <span><?=$countryConst=='SE'?'Tillbaka':'Back'?></span></a>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 hidden-lg hidden-md hidden-sm">
											<div class="progress">
												<div class="progress-bar" style="width:80%"></div>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
											<div class="calculator-get-started cntct_2_btn_inner text-right">
												<a class="submitForm nextbtn continue" id="step4_submit"><span><?=$countryConst=='SE'?'Nästa':'Next'?></span> <i class="fa fa-long-arrow-right"></i> </a>
											</div>
										</div>
									</div>
								</div>
							</div>							
						</div>	
					</div>
					<div role="tabpanel" class="tab-pane" id="summary">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 padding-right-none">
								<div class="calculator-leftbox" style="background: url(<?=SITE_PATH?>assets/images/calculator/background-green.jpg)">
									<div class="wrapper_second_useful_2">
										<div class="white-box-outer">
											<div class="white-box-summary">
												<div class="row">
													<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
														<div class="whitebox-list-outer">
															<div class="whitebox-list-img">
																<img src="<?=SITE_PATH?>assets/images/calculator/icons/area.svg" alt="title">
															</div>
															<div class="whitebox-list-text">
																<h4 class="area_selected"></h4>
															</div>
														</div>
													</div>
													<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
														<div class="whitebox-list-outer">
															<div class="whitebox-list-img">
																<img src="<?=SITE_PATH?>assets/images/calculator/icons/solar.svg" alt="title">
															</div>
															<div class="whitebox-list-text">
																<h4 class="size_selected"></h4>
															</div>
														</div>
													</div>
													<div class="clerfix"></div>
													
													<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
														<div class="whitebox-list-outer">
															<div class="whitebox-list-img">
																<img src="<?=SITE_PATH?>assets/images/calculator/icons/solar.svg" alt="title">
															</div>
															<div class="whitebox-list-text">
																<h4 class="show_panel"></h4>
															</div>
														</div>
													</div>
													<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
														<div class="whitebox-list-outer">
															<div class="whitebox-list-img">
																<img src="<?=SITE_PATH?>assets/images/calculator/icons/battery.svg" alt="title">
															</div>
															<div class="whitebox-list-text">
																<h4 class="battery_val"></h4>
															</div>
														</div>
													</div>
													<div class="clerfix"></div>
													<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
														<div class="whitebox-list-outer">
															<div class="whitebox-list-img">
																<img src="<?=SITE_PATH?>assets/images/calculator/icons/capacity.svg" alt="title">
															</div>
															<div class="whitebox-list-text">
																<h4 class="show_panel_type"></h4>
															</div>
														</div>
													</div>
													
													<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
														<div class="whitebox-list-outer">
															<div class="whitebox-list-img">
																<img src="<?=SITE_PATH?>assets/images/calculator/icons/charger.svg" alt="title">
															</div>
															<div class="whitebox-list-text">
																<h4 class="charger_val"></h4>
															</div>
														</div>
													</div>
													<div class="clerfix"></div>
													<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
														<div class="whitebox-list-outer">
															<div class="whitebox-list-img">
																<img src="<?=SITE_PATH?>assets/images/calculator/icons/slope.svg" alt="title">
															</div>
															<div class="whitebox-list-text">
																<h4 class="show_slope_type"></h4>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										
										<div class="summary-table-outer">
											<table class="summary-table">
												<tr>
													<th><?=$countryConst=='SE'?'Total kostnad':'Total cost'?></th>
													<th class="text-right" id="total_cost"></th>
												</tr>
												<tr class="btm-border">
													<td><?=$countryConst=='SE'?'Grönt bidrag':'Green subsidy'?></td>
													<td class="text-right" id="tax_benefit"></td>
												</tr>
												<tr>
													<td><?=$countryConst=='SE'?'Årliga kostnadsbesparingar':'Yearly cost savings'?></td>
													<td class="text-right" id="annual-saving-count"></td>
												</tr>
												<tr class="btm-border">
													<td><?=$countryConst=='SE'?'Återbetalningstid':'Payback time'?></td>
													<td class="text-right" id="payback_time"></td>
												</tr>
												<tr>
													<td class="top-padding"><?=$countryConst=='SE'?'Årlig energiproduktion':'Yearly energy production'?></td>
													<td class="top-padding text-right" id="energy_prod"></td>
												</tr>
												<!--<tr>
													<td>Annual Co2 Emmission Saved</td>
													<td class="text-right" id="co2Saving">247</td>
												</tr>-->
											</table>
										</div>
									
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 padding-left-none">
								<div class="lettalk-form-box">
									<div class="row">
										<div class="col-md-12">
											<h1 class="let-talk"><?=$countryConst=='SE'?'Fyll i dina uppgifter':'Get quote'?></h1>
											<p class="sub-label"><?=$countryConst=='SE'?'Vänligen ange detaljerna i formuläret nedan så kontaktas ni av en av våra solcellsexperter.':'Please provide the details in the form below and we will send you a mail. One of our solar experts will call you shortly to discuss the next step'?></p>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<input type="text" name="first_name" data-error="<?=$countryConst=='SE'?'Förnamn':'Please enter First name'?>" required>
												<label class="control-label"><?=$countryConst=='SE'?'Förnamn':'First name'?></label>
												<div class="help-block with-errors"></div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<input type="text" name="last_name" data-error="<?=$countryConst=='SE'?'efternamn':'Please enter Last name'?>" required>
												<label class="control-label"><?=$countryConst=='SE'?'Efternamn':'Last name'?></label>
												<div class="help-block with-errors"></div>
											</div>
										</div>
										<div class="clearfix"></div>
										<div class="col-md-6">
											<div class="form-group">
												<input type="text" name="address_input" id="address_input" data-error="<?=$countryConst=='SE'?'Adress':'Please enter Address'?>" required>
												<label class="control-label"><?=$countryConst=='SE'?'Adress':'Address'?></label>
												<div class="help-block with-errors"></div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<input type="text" name="postal_code" id="postal_code" data-error="<?=$countryConst=='SE'?'Postnummer':'Please enter Postal Code'?>" required>
												<label class="control-label"><?=$countryConst=='SE'?'Postnummer':'Postal Code'?></label>
												<div class="help-block with-errors"></div>
											</div>
										</div>
										<div class="clearfix"></div>
										<div class="col-md-6">
											<div class="form-group">
												<input type="text" name="email" id="email" data-error="<?=$countryConst=='SE'?'Email':'Please enter email'?>" required>
												<label class="control-label"><?=$countryConst=='SE'?'Email':'Email'?></label>
												<div class="help-block with-errors"></div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<input type="text" name="phone" id="phone" data-error="<?=$countryConst=='SE'?'Telefon':'Please enter Phone'?>" required>
												<label class="control-label"><?=$countryConst=='SE'?'Telefon':'Phone'?> </label>
												<div class="help-block with-errors"></div>
											</div>
										</div>
										<div class="clearfix"></div>
										<input type="hidden" name="countryConst" value="<?=$countryConst?>">
										<div class="form-group col-md-12">
											<!--<input type="checkbox" class="form-check-input" id="exampleCheck1" data-error="This is required" required>
											<label class="form-check-label" for="exampleCheck1"><?=$countryConst=='SE'?'Jag accepterar att Arka lagrar mina personuppgifter och samtycker till vår integritetspolicy.':'I accept the privacy policy and that Arka Energy stores my personal information.'?></label>-->
											
											<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required>
											<label class="form-check-label" for="flexCheckDefault">
												<?=$countryConst=='SE'?'Jag accepterar att Arka lagrar mina personuppgifter och samtycker till vår integritetspolicy.':'I accept the privacy policy and that Arka Energy stores my personal information.'?>
											</label>
											<div class="help-block with-errors"></div>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
								<div class="bottom-btn-area">
								<div class="form-bottom-prev-next">
									<div class="lettalk-form-box1">
									<div class="row">
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
											<div class="calculator-get-started cntct_2_btn_inner">
												<a class="submitForm backbtn back prev-step"><i class="fa fa-long-arrow-left"></i> <span><?=$countryConst=='SE'?'Tillbaka':'Back'?></span></a>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-9">
											<div class="calculator-get-started cntct_2_btn_inner text-right">
												<!--<a class="submitForm nextbtn continue">Get a quote <i class="fa fa-long-arrow-right"></i> </a>-->
												<button type="submit" class="submitForm1 nextbtn continue" id="calculatorSubmit" style="line-height:inherit"><?=$countryConst=='SE'?'Få offert':'Get quote'?> <i class="fa fa-long-arrow-right"></i> </button>
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
				</form>
			</div>
		</div>
	</div>
	
	
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>

<!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <!--<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBcuL09_sSUWR-65TVL061A0xG4TKGAhrA&libraries=places,drawing"
      async
    ></script>-->
	
	
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBcuL09_sSUWR-65TVL061A0xG4TKGAhrA&callback=initAutocomplete&v=weekly&libraries=places,drawing" async> </script>
 
<script>
// This example requires the Drawing library. Include the libraries=drawing
// parameter when you first load the API. For example:
// <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg&libraries=drawing">

var drawingManager;
var selectedShape;
var all_overlays = [];
var gmarkers = Array();
var polygons = Array();
function setSelection(shape) {
  clearSelection();
  selectedShape = shape;
  shape.setEditable(true);
}
function clearSelection() {
  if (selectedShape) {
    selectedShape.setEditable(false);
    selectedShape = null;
  }
}

function initMap() {
	$(".resetmap").hide();
	   var field = new google.maps.Polygon({
      paths: [],
      editable: true
    });
	
	//var sellat = $("#sellat").val();
	//var sellong = $("#sellong").val();
	var sellat = document.getElementById("sellat").value;
	var sellong = document.getElementById("sellong").value;
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 21,
    center: new google.maps.LatLng(sellat,sellong),
    mapTypeId: 'satellite',
	zoomControl:0,
	mapTypeControl:0,
	scaleControl:0,
	fullscreenControl:0,
	rotateControl:0,
	disableDefaultUI:1
  });
  var polyOptions = {
    fillColor: '#0099FF',
    fillOpacity: 0.7,
    strokeColor: '#AA2143',
    strokeWeight: 2,
    editable: true
  };
    // Creates a drawing manager attached to the map that allows the user to draw Polygons
drawingManager = new google.maps.drawing.DrawingManager({
	  drawingMode: google.maps.drawing.OverlayType.POLYGON,	
    drawingControlOptions: {
      position: google.maps.ControlPosition.TOP_CENTER,
      drawingModes: [
       google.maps.drawing.OverlayType.POLYGON,
      ],
    },
    polygonOptions: polyOptions,
    map: map
  });
  
  map.setTilt(0);

 var infowindow = new google.maps.InfoWindow();
  google.maps.event.addListener(drawingManager, 'polygoncomplete', function(polygon) {
    var area = google.maps.geometry.spherical.computeArea(polygon.getPath());
    //infowindow.setContent("area="+area.toFixed(2)+" sq meters");
    //$(".carea").html("area="+area.toFixed(2)+" sq meters");
    $(".carea").html('<span class="css-vurnku">'+Math.round(area.toFixed(2))+ ' m<sup>2</sup></span>');
    $("#roof_area").val(Math.round(area.toFixed(2)));
	$(".sizeonmap").html('<?=getSize('+Math.round(area.toFixed(2))+')?>');
    $("#size").val(Math.round(area.toFixed(2)));
	//$(".carea").html('<span class="css-vurnku">'+Math.round(area.toFixed(2))+ ' m<sup>2</sup></span>');
   // $("#roof_area").val(Math.round(area.toFixed(2)));
	//infowindow.setContent("area="+area.toFixed(2)+" sq meters");
    //infowindow.setPosition(polygon.getPath().getAt(0));
    //infowindow.open(map);
	$(".resetmap").show();
	$(".gmnoprint").hide();
	
	 // Switch back to non-drawing mode after drawing a shape.
      drawingManager.setDrawingMode(null);
      // To hide:
      drawingManager.setOptions({
        drawingControl: false
      });
	  
	  
	  
	   field.setPath(polygon.getPath().getArray());
      polygon.setMap(null);
     polygon = null;
      field.setMap(map);
      google.maps.event.addListener(field.getPath(), 'set_at', function(index, obj) {
        // changed point, via map
        for (var i = 0; i < field.getPath().getLength(); i++) {
          console.log(field.getPath().getAt(i).toUrlValue(6));
        }
        //console.log("a point has changed");
		var area = google.maps.geometry.spherical.computeArea(field.getPath());
		 $(".carea").html('<span class="css-vurnku">'+Math.round(area.toFixed(2))+ ' m<sup>2</sup></span>');
    $("#roof_area").val(Math.round(area.toFixed(2)));
	calculatePanel();
      });
      google.maps.event.addListener(field.getPath(), 'insert_at', function(index, obj) {
        // new point via map
        for (var i = 0; i < field.getPath().getLength(); i++) {
         // console.log(field.getPath().getAt(i).toUrlValue(6));
        }
       console.log("a point has been added");
		var area = google.maps.geometry.spherical.computeArea(polygon.getPath());
		$(".carea").html('<span class="css-vurnku">'+Math.round(area.toFixed(2))+ ' m<sup>2</sup></span>');
		calculatePanel();
      });
      google.maps.event.addListener(field.getPath(), "remove_at", function(index, obj) {
        //removed point, via map
        for (var i = 0; i < field.getPath().getLength(); i++) {
         // console.log(field.getPath().getAt(i).toUrlValue(6));
        }
       // console.log("a point has been removed");
		var area = google.maps.geometry.spherical.computeArea(polygon.getPath());
		 $(".carea").html('<span class="css-vurnku">'+Math.round(area.toFixed(2))+ ' m<sup>2</sup></span>');
		$("#roof_area").val(Math.round(area.toFixed(2)));
		calculatePanel();
      });

	  
	  calculatePanel();
	
	  
	  
	    
  });
  
   
     
   
  drawingManager.setMap(map);
}

function calculatePanel(){
 $.ajax({
		url:"<?=SITE_PATH?>ms_file/getAreaPanel",
		type:"post",
		//async:false,
		data:"roof_area="+$('#roof_area').val(),
		beforeSend:function(){
			$(".loader").show();
		},
		success:function(result){
			$(".loader").hide();
			//alert(result);
			res=result.split("|");
			if(res[0]!=''){	
				$('.sizeonmap').html(res[0]+' KW');
				$('.panelonmap').html(res[1]+' solar panels');
				$('#size').val(res[0]);
				$('#panels').val(res[1]);
				
				if(res[1]>50){
					if('<?=$countryConst?>' == 'SE'){
						$('.more-panel').html('<p class="more-panel-error">Du had markerat ett område med fler än 50 solpaneler. Kontakta oss så återkommer vi inom kort.</p>');
						$('.contact-link-map').html('<a href="<?=SITE_PATH.$urlConst?><?=$countryConst=="SE"?"kontakta-oss":"contact-us"?>" class="map-contact-btn"><?=CONTACT?></a>');
					}else{
						$('.more-panel').html('<p class="more-panel-error">You have selected an area with more than 50 panels. Please contact us and we will return to you shortly.</p>');
						$('.contact-link-map').html('<a href="<?=SITE_PATH.$urlConst?><?=$countryConst=="SE"?"kontakta-oss":"contact-us"?>" class="map-contact-btn"><?=CONTACT?></a>');
					}
					
					
					$('#step2_submit').hide();
				}else{
					$('.more-panel').html('');
					$('.contact-link-map').html('');
					
					$('#step2_submit').show();
				}
			}
		}
	});
	}
 
//google.maps.event.addDomListener(window, "load", initMap);




function calcIntersection(newOverlay, allOverlays) {
  //ensure the polygon contains enought vertices 
  if(newOverlay.getPath().getLength() < 3){
     alert("Not enought vertices. Draw a polygon that contains at least  3 vertices.");
     return;
  }

  var geometryFactory = new jsts.geom.GeometryFactory();
  var newPolygon = createJstsPolygon(geometryFactory, newOverlay);

  //iterate existing polygons and find if a new polygon intersects any of them
  var result = allOverlays.filter(function (currentOverlay) {
    var curPolygon = createJstsPolygon(geometryFactory, currentOverlay);
    var intersection = newPolygon.intersection(curPolygon);
    return intersection.isEmpty() == false;
  });

  //if new polygon intersects any of exiting ones, draw it with green color
  if(result.length > 0){
     newOverlay.setOptions({strokeWeight: 2.0, fillColor: 'green'});    
  }
}



function createJstsPolygon(geometryFactory, overlay) {
  var path = overlay.getPath();
  var coordinates = path.getArray().map(function name(coord) {
    return new jsts.geom.Coordinate(coord.lat(), coord.lng());
  });
  coordinates.push(coordinates[0]);
  var shell = geometryFactory.createLinearRing(coordinates);
  return geometryFactory.createPolygon(shell);
}


//google.maps.event.addDomListener(window, 'load', initialize);


function reset()
{
	$('.more-panel').html('');
	$('.contact-link-map').html('');
	$('#step2_submit').show();
	$('#size').val('');
	$('#panels').val('');
	initMap();
}

	

function saveMapToDataUrl() {
    var element = $("#map");
    html2canvas(element, {
        useCORS: true,
        onrendered: function(canvas) {
            var dataUrl= canvas.toDataURL("image/png");
			$.ajax({
				url: '<?=SITE_PATH?>ms_file/savemap',
				type: 'post',
				data: 'areaimg='+encodeURIComponent(dataUrl),
				beforeSend:function(){
					$(".loader").show();
				},
				success:function(response){
					$(".loader").hide();
					if(response != 0){
						//alert('file uploaded');
						if($('#roof_area').val()!=''){
							var $active = $('.nav-tabs li.active');
							$active.next().removeClass('disabled');
							nextTab($active);	
							$('.drawn-map-img').attr('src', '<?=SITE_PATH?>uploaded_files/user_map/'+response);
						}else{
							alert('Select roof area');
						}	
					}else{
						alert('file not generated');
					}
				},
			});		   
        }
    });
}
</script>


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
  address1Field = document.querySelector("#sel_address");
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
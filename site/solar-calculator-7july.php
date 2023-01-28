<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>assets/css/inner-custom.css" />

	<div class="contact-section grey-bg default-padding inner-page-menu">
		<div class="container">
			<div class="holder">
				<div class="calculator-tab">
					<ul class="nav nav-tabs nav-justified" role="tablist">
						<li role="presentation" class="active">
							<a href="#addressTab" aria-controls="addressTab" role="tab" data-toggle="tab" aria-expanded="true">Address</a>
						</li>
						<li role="presentation" class="disabled">
							<a href="#mark-roof" aria-controls="mark-roof" role="tab" data-toggle="tab" aria-expanded="false">Mark Roof</a>
						</li>
						<li role="presentation" class="disabled">
							<a href="#roof-slope" aria-controls="roof-slope" role="tab" data-toggle="tab" aria-expanded="false">Roof Slope</a>
						</li>
						<li role="presentation" class="disabled">
							<a href="#pannel" aria-controls="pannel" role="tab" data-toggle="tab" aria-expanded="false">Pannel Section</a>
						</li>
						<li role="presentation" class="disabled summary-no-right-border">
							<a href="#summary" aria-controls="summary" role="tab" data-toggle="tab" aria-expanded="false">Summary</a>
						</li>
						<li class="annual-summary-top left-top-radius">
							<div class="saving-inline annual-saving">
								<div class="saving-img">
									<img src="<?=SITE_PATH?>assets/images/calculator/Group-114.png" class="">
								</div>
								<div class="annual-text">
									<p class="annual-saving-count">-</p>
									<p class="annual-saving-text">Annual Savings</p>
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
									<p class="annual-cost-text">Upfront Cost</p>
								</div>
							</div>
						</li>
					</ul>
				</div>
				<form method="post" class="solar_form" data-toggle="validator">
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="addressTab">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="calculator-leftbox">
									<div class="wrapper_second_useful_2">
										<div class="sw_left_heading_wraper sw_dark_heading_wraper">
											<h1>Calculate the<br>Savings if you<br>Setup solar plant<br>in our Solar park</h1>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="calculator-form-box form-boc-top">
									<div class="row">									
										<div class="col-md-12">
											<label class="label-text">Enter Your Address</label>
											<p class="sub-label">Enter a home for your new Solar Panels</p>
											<div class="row">									
												<div class="col-md-9">
													<input type="text" name="address" id="address" placeholder="Address">
												</div>
												<div class="col-md-3">
													<a href="javascript:void(0);" class="submitForm getStarted continue" id="get_started"><img src="<?=SITE_PATH?>assets/images/green-btn.png"></a>
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
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="calculator-leftbox">
									<div class="wrapper_second_useful_2">
										<div class="sw_left_heading_wraper sw_dark_heading_wraper">
											<h1>Electricity bill<br>adjustment is our<br>responsibility</h1>
											<p class="small-info">Solar Energy is produced during the day, but thankfully, if produced in our park, it can be consumed anytime during the whole month</p>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="calculator-form-box form-boc-top">
									<div class="row">
										<div class="col-md-12">
											<label class="label-text">Measure your roof Area</label>
											<p class="sub-label">Click on every corner of your house on the<br>map to measure your roof area</p>												
										</div>
									</div>
									
									<div class="bottom-btn-area">	
										<div class="row">	
											<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
												<div class="calculator-get-started cntct_2_btn_inner">
													<a class="submitForm backbtn back prev-step"><i class="fa fa-long-arrow-left"></i> Back</a>
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
												<div class="calculator-get-started cntct_2_btn_inner text-right">
													<a class="submitForm nextbtn continue" id="step2_submit">Next <i class="fa fa-long-arrow-right"></i> </a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>							
						</div>	
					</div>

					<div role="tabpanel" class="tab-pane" id="roof-slope">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="calculator-leftbox">
									<div class="wrapper_second_useful_2">
										<div class="sw_left_heading_wraper sw_dark_heading_wraper">
											<h1>Fun Fact: You can<br>have solar on<br>Roof and on any<br>park at the same<br>time. But still,<br>why waste roof?</h1>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="calculator-form-box form-boc-top">
									<div class="row">
										<div class="col-md-12">
											<label class="label-text">Chose the Slope</label>
											<p class="sub-label">How tilted your roof is?</p>
											<div class="row">
												<div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
													<label class="custom-radio-lable">
														<input type="radio" name="slope_type" value="Flat">
														<div class="select-business">
															<img src="<?=SITE_PATH?>assets/images/calculator/flat.png" class="slop-icon">
															<div class="business-name"><b>Flat</b></div>
															<p>0-15 Degree</p>
														</div>
													</label>
												</div>
												<div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
													<label class="custom-radio-lable">
														<input type="radio" name="slope_type" value="Low Slope">
														<div class="select-business">
															<img src="<?=SITE_PATH?>assets/images/calculator/low-slope.png" class="slop-icon">
															<div class="business-name"><b>Low Slope</b></div>
															<p>15-30 Degree</p>
														</div>
													</label>
												</div>
												<div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
													<label class="custom-radio-lable">
														<input type="radio" name="slope_type" value="Conventional Slope">
														<div class="select-business">
															<img src="<?=SITE_PATH?>assets/images/calculator/con-slope.png" class="slop-icon">
															<div class="business-name"><b>Conventional Slope</b></div>
															<p>>30 Degree</p>
														</div>														
													</label>
												</div>
												<input type="hidden" name="sel_slope_type" id="sel_slope_type">
											</div>
										</div>
									</div>
									<div class="bottom-btn-area">	
										<div class="row">	
											<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
												<div class="calculator-get-started cntct_2_btn_inner">
													<a class="submitForm backbtn back prev-step"><i class="fa fa-long-arrow-left"></i> Back</a>
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
												<div class="calculator-get-started cntct_2_btn_inner text-right">
													<a class="submitForm nextbtn continue">Next <i class="fa fa-long-arrow-right"></i> </a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>							
						</div>	
					</div>
					
					<div role="tabpanel" class="tab-pane" id="pannel">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="calculator-leftbox">
									<div class="wrapper_second_useful_2">
										<div class="sw_left_heading_wraper sw_dark_heading_wraper">
											<h1>Fun Fact: You can<br>have solar on<br>Roof and on any<br>park at the same<br>time. But still,<br>why waste roof?</h1>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="calculator-form-box">
									<div class="row">
										<div class="col-md-12">
											<label class="label-text">Which Solar Panel type you want to install</label>
											<p class="sub-label">Choose from our options to find the best solution  for you. Price and savings are in the box above. See all details in the next step.</p>
											<div class="row">
												<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
													<label class="have-rooftop-lable">
														<input type="radio" name="test" value="Essential">
														<div class="rooftop-radio-label">Essential</div>
													</label>
												</div>
												<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
													<label class="have-rooftop-lable">
														<input type="radio" name="test" value="Design">
														<div class="rooftop-radio-label">Design</div>
													</label>
												</div>
												<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
													<label class="have-rooftop-lable">
														<input type="radio" name="test" value="Pro">
														<div class="rooftop-radio-label">Pro</div>
													</label>
												</div>
											</div>
											
											<div class="row">
												<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
													<label class="label-text">Essential</label>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
													<label class="label-text text-right">370w</label>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
													<p class="sub-label">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Adipiscing pellentesque nec molestie orci varius. Tortor magna lorem aenean nibh sed ac purus volutpat venenatis. Ultrices commodo enim enim cras euismod aenean sociis. Accumsan massa, phasellus dolor arcu. Quis in suspendisse senectus quam aenean pharetra. Cras pellentesque viverra quis euismod vel magna.</p>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
													<label class="label-text">Addon</label>
												</div>
												<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
													<label class="have-rooftop-lable">
														<input type="radio" name="test" value="Battery">
														<div class="rooftop-radio-label">Battery</div>
													</label>
												</div>
												<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
													<label class="have-rooftop-lable">
														<input type="radio" name="test" value="Car Charger">
														<div class="rooftop-radio-label">Car Charger</div>
													</label>
												</div>
											</div>
										</div>
									</div>
									<div class="bottom-btn-area">	
										<div class="row">	
											<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
												<div class="calculator-get-started cntct_2_btn_inner">
													<a class="submitForm backbtn back prev-step"><i class="fa fa-long-arrow-left"></i> Back</a>
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
												<div class="calculator-get-started cntct_2_btn_inner text-right">
													<a class="submitForm nextbtn continue">Next <i class="fa fa-long-arrow-right"></i> </a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>							
						</div>	
					</div>
					<div role="tabpanel" class="tab-pane" id="summary">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<!--<div class="calculator-leftbox">
									<div class="wrapper_second_useful_2">
										<div class="summary-table-outer">
											<table class="summary-table">
												<tr>
													<th>Total Cost</th>
													<th class="text-right">146188 kr</th>
												</tr>
												<tr class="btm-border">
													<td>Green Subsidy</td>
													<td class="text-right">24892 kr</td>
												</tr>
												<tr>
													<td class="top-padding">Yearly Cost Savings</td>
													<td class="top-padding text-right">14573 kr</td>
												</tr>
												<tr class="btm-border">
													<td>Payback Time</td>
													<td class="text-right">9 years</td>
												</tr>
												<tr>
													<td class="top-padding">Yearly Energy Production</td>
													<td class="top-padding text-right">12350 kWh</td>
												</tr>
												<tr>
													<td>Bathtubs of Oil Saved</td>
													<td class="text-right">247</td>
												</tr>
											</table>
										</div>
										
										<div class="white-box-outer">
											<div class="white-box-summary">
												<div class="row">
													<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
														<div class="whitebox-list-outer">
															<div class="whitebox-list-img">
																<img src="<?=SITE_PATH?>assets/images/calculator/capacity.png" alt="title">
															</div>
															<div class="whitebox-list-text">
																<h4>Capacity</h4>
															</div>
														</div>
													</div>
													<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
														<div class="whitebox-list-outer">
															<div class="whitebox-list-img">
																<img src="<?=SITE_PATH?>assets/images/calculator/state.png" alt="title">
															</div>
															<div class="whitebox-list-text">
																<h4>State</h4>
															</div>
														</div>
													</div>
													<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
														<div class="whitebox-list-outer">
															<div class="whitebox-list-img">
																<img src="<?=SITE_PATH?>assets/images/calculator/Union.png" alt="title">
															</div>
															<div class="whitebox-list-text">
																<h4>At Solar park</h4>
															</div>
														</div>
													</div>
													<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
														<div class="whitebox-list-outer">
															<div class="whitebox-list-img">
																<img src="<?=SITE_PATH?>assets/images/calculator/storage.png" alt="title">
															</div>
															<div class="whitebox-list-text">
																<h4>Without Storage</h4>
															</div>
														</div>
													</div>
													<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
														<div class="whitebox-list-outer">
															<div class="whitebox-list-img">
																<img src="<?=SITE_PATH?>assets/images/calculator/solar.png" alt="title">
															</div>
															<div class="whitebox-list-text">
																<h4>With/Without<br>Existing solar system</h4>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>-->
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="lettalk-form-box">
									<div class="row">
										<div class="col-md-12">
											<h1 class="let-talk">Get Quote</h1>
											<p>Please provide the details in the form below and we will send you a mail. One of our solar experts will call you shortly to discuss the next step</p>
										</div>
										
										<div class="col-md-6">
											<input type="text" name="name" placeholder="First Name">
										</div>
										<div class="col-md-6">
											<input type="text" name="company" placeholder="Last Name">
										</div>
										<div class="col-md-6">
											<input type="text" name="designation" placeholder="Address">
										</div>
										<div class="col-md-6">
											<input type="text" name="state" placeholder="Postal Code">
										</div>
										<div class="col-md-6">
											<input type="email" name="email" placeholder="Email Address">
										</div>
										<div class="col-md-6">
											<input type="text" name="phone" placeholder="Phone Number">
										</div>
										<div class="col-md-12">
											<input type="checkbox" class="form-check-input" id="exampleCheck1">
											<label class="form-check-label" for="exampleCheck1">I accept Arka' terms & conditions(consumption, production) and that my personal information is treatedin accordance with the laws that prevail Privacy Policy. Rays Experts also has permission to retrieve my consumption data from my energy provider.</label>
										</div>
									</div>
								</div>
								<div class="lettalk-form-box">
									<div class="row">
										<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
											<div class="calculator-get-started cntct_2_btn_inner">
												<a class="submitForm backbtn back prev-step"><i class="fa fa-long-arrow-left"></i> Back</a>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
											<div class="calculator-get-started cntct_2_btn_inner text-right">
												<a class="submitForm nextbtn continue">Get a quote <i class="fa fa-long-arrow-right"></i> </a>
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
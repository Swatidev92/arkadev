<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>assets/css/inner-custom.css" />

	<div class="get-connect-section default-padding show-getconnect">
		<div class="container">
			<div class="holder">
				<div class="row">
					<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<div class="connect-leftbox">
							<div class="wrapper_second_useful_2">
								<div class="connect-left-content">
									<h1>Ansluta</h1>
									<p>Vill du veta hur du sparar ditt företags elkostnad med mer än 80%?</p>
									
									<div class="connect-process-outer">
										<div class="connect-process-list">
											<div class="connect-process-list-img">
												<img src="<?=SITE_PATH?>assets/images/get-connect/Fill-Out-form.png">
											</div>
											<div class="connect-process-text">
												<h4>01. Fyll i formuläret</h4>
												<p>Skicka in din information så kontaktar vi dig</p>
											</div>
										</div>
										<div class="connect-process-list">
											<div class="connect-process-list-img">
												<img src="<?=SITE_PATH?>assets/images/get-connect/discussion.png">
											</div>
											<div class="connect-process-text">
												<h4>02. Diskussion</h4>
												<p>Tillsammans skapar vi en skräddarsydd lösning som passar dina behov</p>
											</div>
										</div>
										<div class="connect-process-list">
											<div class="connect-process-list-img">
												<img src="<?=SITE_PATH?>assets/images/get-connect/installation.png">
											</div>
											<div class="connect-process-text">
												<h4>03. Installation</h4>
												<p>Du är nu en del av maktskiftet till en mer hållbar planet</p>
											</div>
										</div>
									</div>
									
									<p class="calculate-own">Vill du beräkna på egen hand?</p>
									<h3><a class="submitForm getStarted white-text" href="<?=SITE_PATH?>se/kostnadskalkyl">Kostnadskalkyl <i class="fa fa-long-arrow-right"></i></a></h3>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
						<form method="post" class="coonect-form" onSubmit="return submitEnquiry('coonect-form','cmsg','submit-quote')">
							<div class="connect-form-box">
								<div class="row">
									<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
										<h2 class="connect-form-left-title">Om dig</h2>
										<p class="connect-form-left-info">Berätta lite om dig själv</p>
									</div>
									<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
										<div class="col-md-12">
											<select class="" name="customer_type" required>
												<option value="">Customer Type*</option>
												<?php foreach($customerTypeArr as $ckey=>$cval){?>
												<option value="<?=$ckey?>"><?=$cval?></option>
												<?php } ?>
											</select>
										</div>
										<div class="clearfix"></div>
										<div class="col-md-12">
											<input type="text" name="first_name" placeholder="fullständiga namn*" pattern="([^\s][A-zÀ-ž\s]+)" required>
										</div>
										<div class="col-md-6">
											<input type="email" name="email" placeholder="E-postadress*" required>
										</div>
										<div class="col-md-6">
											<input type="text" name="phone" placeholder="Telefonnummer*" pattern="[0-9]{8,15}" required>
										</div>
										<div class="clearfix"></div>
										<div class="col-md-12">
											<input type="text" name="address" placeholder="Adress">
										</div>
										<div class="clearfix"></div>
										<div class="col-md-6">
											<input type="text" name="postal_code" placeholder="Postnummer*" pattern="[0-9]+">
										</div>
										<div class="col-md-6">
											<input type="text" name="city" placeholder="stad" pattern="([^\s][A-zÀ-ž\s]+)">
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
										<h2 class="connect-form-left-title">Syfte</h2>
										<p class="connect-form-left-info">Välj det syfte som intresserar dig</p>
									</div>
									<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
										<div class="row">
											<div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
												<label class="custom-radio-lable">
													<input type="checkbox" name="purpose[]" value="Solar Park">
													<div class="select-purpose">
														<img src="<?=SITE_PATH?>assets/images/get-connect/solar-park.png" class="">
														<div class="purpose-name"><b>Solar Park</b></div>
													</div>
												</label>
											</div>
											<div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
												<label class="custom-radio-lable">
													<input type="checkbox" name="purpose[]" value="Batteries">
													<div class="select-purpose">
														<img src="<?=SITE_PATH?>assets/images/get-connect/storage.png" class="">
														<div class="purpose-name"><b>Batteries</b></div>
													</div>
												</label>
											</div>
											<div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
												<label class="custom-radio-lable">
													<input type="checkbox" name="purpose[]" value="Others">
													<div class="select-purpose">
														<img src="<?=SITE_PATH?>assets/images/get-connect/others.png" class="">
														<div class="purpose-name"><b>Others</b></div>
													</div>														
												</label>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
										<h2 class="connect-form-left-title">Kontakta oss</h2>
									</div>
									<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
										<div class="row">
											<div class="col-md-12">
												<input type="text" name="message" placeholder="Anything more we should to know?">
											</div>
											<div class="col-md-12">
												<input type="checkbox" class="form-check-input" id="exampleCheck1" required>
												<label class="form-check-label" for="exampleCheck1">Jag accepterar att arka lagrar min personliga information och sekretesspolicy</label>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
										<p class="connect-form-left-info"><b>Kontakta oss så ger vi all information på den sidan</b></p>
									</div>
									<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
										<div class="calculator-get-started cntct_2_btn_inner text-right" style="margin-top:25px;">
											<input type="submit" class="submitForm nextbtn continue" id="submit-quote" value="Skicka in">
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>								
				</div>					
			</div>			
		</div>
	</div>
	
	<div class="get-connect-section default-padding show-thankyou">
		<div class="container">
			<div class="holder">
				<div class="row">
					<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<div class="connect-leftbox" style="min-height:auto;">
							<div class="wrapper_second_useful_2">
								<div class="connect-left-content">
									<h1 class="thanku-heading">Tack!</h1>
									<p class="thnkumsg">Vi är glada att du är intresserad av den hållbara rörelsen!</p>
									<p class="thnkumsg">Arka Energy -teamet kommer att kontakta dig inom kort.</p>
									<br>
									<br>
									<p class="calculate-own">Vill du räkna själv?</p>
									<h3><a class="submitForm getStarted white-text" href="<?=SITE_PATH?>kostnadskalkyl">Kostnadskalkyl <i class="fa fa-long-arrow-right"></i></a></h3>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
						<div class="thanku-right-box">
							<p class="top-heading">Under tiden kan du kolla in våra verktyg för att bli inspirerad.</p>
							
							<a href="<?=SITE_PATH?>om-oss">
								<div class="links">
									<h2 class="link-title">Om oss</h2>
								</div>
							</a>
							<a href="<?=SITE_PATH?>legal">
								<div class="links">
									<h2 class="link-title">Legal</h2>
								</div>
							</a>
							<a href="<?=SITE_PATH?>garanti">
								<div class="links">
									<h2 class="link-title">Garanti</h2>
								</div>
							</a>
						</div>
					</div>								
				</div>					
			</div>			
		</div>
	</div>
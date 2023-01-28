<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>assets/css/inner-custom.css" />

	<?php $quoteQry = $cms->db_query("SELECT * FROM #_free_quote where id=1 ");
	$quoteRes = $quoteQry->fetch_array();
	
	$metaTitle= $quoteRes['meta_title'.$langf];
	$metaIntro= $quoteRes['meta_description'.$langf];
	$metaKeyword= $quoteRes['meta_key'.$langf];
	
	?>
	<div class="get-connect-section default-padding show-getconnect">
		<div class="container">
			<div class="holder">
				<div class="row">
					<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<div class="connect-leftbox">
							<div class="wrapper_second_useful_2">
								<div class="connect-left-content">
									<h1><?=$countryConst=='SE'?'Ansluta':'Get connected'?></h1>
									<p><?=$countryConst=='SE'?'Vill du veta hur du sparar ditt företags elkostnad med mer än 80%?':'Do you want to know how to<br>save your business electricity<br>expense by more then 80%?'?></p>
									
									<div class="connect-process-outer">
										<div class="connect-process-list">
											<div class="connect-process-list-img">
												<img src="<?=SITE_PATH?>assets/images/get-connect/Fill-Out-form.png">
											</div>
											<div class="connect-process-text">
												<h4>01. <?=$countryConst=='SE'?'Fyll i formuläret':'Fill out form'?></h4>
												<p><?=$countryConst=='SE'?'Skicka in din information så kontaktar vi dig':'Submit your information and we will contact you'?></p>
											</div>
										</div>
										<div class="connect-process-list">
											<div class="connect-process-list-img">
												<img src="<?=SITE_PATH?>assets/images/get-connect/discussion.png">
											</div>
											<div class="connect-process-text">
												<h4>02. <?=$countryConst=='SE'?'Diskussion':'Discussion'?></h4>
												<p><?=$countryConst=='SE'?'Tillsammans skapar vi en skräddarsydd lösning som passar dina behov':'Together we will create a customized solution that fits your needs'?></p>
											</div>
										</div>
										<div class="connect-process-list">
											<div class="connect-process-list-img">
												<img src="<?=SITE_PATH?>assets/images/get-connect/installation.png">
											</div>
											<div class="connect-process-text">
												<h4>03. <?=$countryConst=='SE'?'Installation':'Installation'?></h4>
												<p><?=$countryConst=='SE'?'Du är nu en del av maktskiftet till en mer hållbar planet':'You are now a part of the power shift to a more sustainable planet'?></p>
											</div>
										</div>
									</div>
									
									<p class="calculate-own"><?=$countryConst=='SE'?'Vill du beräkna på egen hand?':'Would you like to calculate on your own?'?></p>
									<h3><a class="submitForm getStarted white-text" href="<?=getPageUrl(4,$countryConst,$urlConst)?>"><?=$countryConst=='SE'?'Kostnadskalkyl':'Solar Calculator'?> <i class="fa fa-long-arrow-right"></i></a></h3>
								</div>
							</div>
						</div>
					</div>
					

					<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
						<form method="post" class="coonect-form" onSubmit="return submitEnquiry('coonect-form','cmsg','csubmit')">
							<div class="connect-form-box">
								<div class="row">
									<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
										<h2 class="connect-form-left-title"><?=$countryConst=='SE'?'Om dig':'About you'?></h2>
										<p class="connect-form-left-info"><?=$countryConst=='SE'?'Berätta lite om dig själv':'Tell us a bit about yourself'?></p>
									</div>
									<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
										<div class="col-md-12">
											<select class="select21" id="customer_type" name="customer_type" required>
												<option value=""><?=$countryConst=='SE'?'Typ av kund':'Customer Type'?></option>
												<?php foreach($customerTypeArr as $ckey=>$cval){?>
												<option value="<?=$ckey?>"><?=$cval?></option>
												<?php } ?>
											</select>
										</div>
										<div class="clearfix"></div>
										
										<div class="col-md-6">
											<input type="text" name="first_name" placeholder="<?=$countryConst=='SE'?'Förnamn':'First name'?>" pattern="([^\s][A-zÀ-ž\s]+)" required>
										</div>
										<div class="col-md-6">
											<input type="text" name="phone" placeholder="<?=$countryConst=='SE'?'Telefon':'Phone'?>" pattern="[0-9]{8,15}" required>
										</div>
										<div class="clearfix"></div>
										<div class="col-md-12">
											<input type="email" name="email" placeholder="<?=$countryConst=='SE'?'Email':'Email'?>" required>
										</div>
										<div class="clearfix"></div>
										<div class="col-md-12">
											<input type="text" name="address" placeholder="<?=$countryConst=='SE'?'Adress':'Address'?>">
										</div>
										<div class="clearfix"></div>
										<div class="col-md-6">
											<input type="text" name="postal_code" placeholder="<?=$countryConst=='SE'?'Postnummer':'Postal Code'?>" pattern="[0-9]+">
										</div>
										<div class="col-md-6">
											<input type="text" name="city" placeholder="<?=$countryConst=='SE'?'Ort':'City'?>" pattern="([^\s][A-zÀ-ž\s]+)">
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
										<h2 class="connect-form-left-title"><?=$countryConst=='SE'?'Syfte':'Purpose'?></h2>
										<p class="connect-form-left-info"><?=$countryConst=='SE'?'Välj det syfte som intresserar dig':'Select the purpose<br>that interests you'?></p>
									</div>
									<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
										<div class="row">
											<div class="col-lg-4 col-md-4 col-xs-12 col-sm-4">
												<label class="custom-radio-lable">
													<input type="checkbox" name="purpose[]" value="Solar panels">
													<div class="select-purpose">
														<img src="<?=SITE_PATH?>assets/images/get-connect/solar-park.png" class="">
														<div class="purpose-name"><b><?=$countryConst=='SE'?'Solceller':'Solar panels'?></b></div>
													</div>
												</label>
											</div>
											<div class="col-lg-4 col-md-4 col-xs-12 col-sm-4">
												<label class="custom-radio-lable">
													<input type="checkbox" name="purpose[]" value="Batteries">
													<div class="select-purpose">
														<img src="<?=SITE_PATH?>assets/images/get-connect/storage.png" class="">
														<div class="purpose-name"><b><?=$countryConst=='SE'?'Batterier':'Batteries'?></b></div>
													</div>
												</label>
											</div>
											<div class="col-lg-4 col-md-4 col-xs-12 col-sm-4">
												<label class="custom-radio-lable">
													<input type="checkbox" name="purpose[]" value="Chargers">
													<div class="select-purpose">
														<img src="<?=SITE_PATH?>assets/images/get-connect/charger1b.png" class="">
														<div class="purpose-name"><b><?=$countryConst=='SE'?'Laddare':'Chargers'?></b></div>
													</div>														
												</label>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
										<!--<h2 class="connect-form-left-title">Contact Us</h2>-->
									</div>
									<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
										<div class="row">
											<div class="col-md-12">
												<input type="text" name="message" placeholder="<?=$countryConst=='SE'?'Något annat du vill meddela?':'Anything more we should to know?'?>">
											</div>
											<div class="col-md-12">
												<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required>
												<label class="form-check-label" for="flexCheckDefault">
													<?=$countryConst=='SE'?'Jag accepterar att Arka lagrar mina personuppgifter och samtycker till vår integritetspolicy.':'I accept the privacy policy and that Arka Energy stores my personal information.'?>
												</label>
												<div class="help-block with-errors"></div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
										<!--<p class="connect-form-left-info"><b>Contact us and we give all that info on that page</b></p>-->
										<input type="hidden" name="countryConst" value="<?=$countryConst?>">
									</div>
									<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
										<div class="calculator-get-started cntct_2_btn_inner text-right" style="margin-top:25px;">
											<input type="submit" class="submitForm nextbtn continue" id="submit-quote" value="<?=$countryConst=='SE'?'Skicka':'Submit'?>">
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
									<h1 class="thanku-heading"><?=($countryConst=='SE')?'Tack!':'Thank you!'?></h1>
									<p class="thnkumsg"><?=($countryConst=='SE')?'Vi är glada att du är intresserad av våra produkter och tjänster.':'We are happy that you are interested in our product & services.'?></p>
									<p class="thnkumsg"><?=($countryConst=='SE')?'Arka teamet kommer att kontakta dig inom kort.':'Arka team will contact you shortly.'?></p>
									<br>
									<br>
									<p class="calculate-own"><?=($countryConst=='SE')?'Vill du räkna själv?':'Would you like to calculate on your own?'?></p>
									<h3><a class="submitForm getStarted white-text" href="<?=SITE_PATH.$urlConst?><?=$countryConst=='SE'?'kostnadskalkyl':'solar-calculator'?>"><?=CALCULATOR?> <i class="fa fa-long-arrow-right"></i></a></h3>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
						<div class="thanku-right-box">
							<p class="top-heading"><?=($countryConst=='SE')?'Under tiden kan du kolla in våra verktyg för att bli inspirerad.':'In the meantime, check out our tools to get inspired.'?></p>
							
							<a href="<?=SITE_PATH.$urlConst?><?=($countryConst=='SE' || $conLangSelSESE=='se')?'om-oss':'about-us'?>">
								<div class="links">
									<h2 class="link-title"><?=ABOUT?></h2>
								</div>
							</a>
							<a href="<?=SITE_PATH.$urlConst?><?=($countryConst=='SE' || $conLangSelSESE=='se')?'garanti':'warranty'?>">
								<div class="links">
									<h2 class="link-title"><?=WARRANTY?></h2>
								</div>
							</a>
							<a href="<?=SITE_PATH.$urlConst?><?=($countryConst=='SE' || $conLangSelSESE=='se')?'legal':'legal'?>">
								<div class="links">
									<h2 class="link-title"><?=LEGAL?></h2>
								</div>
							</a>
						</div>
					</div>							
				</div>					
			</div>			
		</div>
	</div>
	
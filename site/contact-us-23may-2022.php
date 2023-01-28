<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>assets/css/inner-custom.css" />

	<?php $contactQry = $cms->db_query("SELECT * FROM #_contact_us where id=1 ");
	$contactRes = $contactQry->fetch_array();
	
	$metaTitle= $contactRes['meta_title'.$langf];
	$metaIntro= $contactRes['meta_description'.$langf];
	$metaKeyword= $contactRes['meta_key'.$langf];
	
	?>
	
	<style>
	.captcha-img {
		float: left;
		width: 12%;
		margin-right: 25px;
	}
	.captcha-input {
		width: 30% !important;
		height:38px;
		box-shadow:none;
		padding:6px 12px !important;
		margin-bottom:25px;
	}
	</style>

	<div class="contactus-section default-padding show-getconnect">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
					<div class="sw_left_heading_wraper text-center">
						<h1><span class="heading-bold"><?=$countryConst=='SE'?'Kontakta oss':'Contact us'?></span></h1>
					</div>
				</div>
			</div>					

            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">			
					<form method="post" class="contact-form" onSubmit="return contactSubmission('contact-form','cmsg','submit-quote')">
						<div class="contact-us-form">
							<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
								<div class="form-group col-md-12">
									<label class="label-control"><?=$countryConst=='SE'?'Vad kan vi hjälpa dig med?':'What can we help you with?'?></label>
									<div class="checkbox">
										<label for="solar"><input type="checkbox" name="purpose[]" id="solar" value="Solar cells"><?=$countryConst=='SE'?'Solceller':'Solar cells'?></label>
									</div>
									<div class="checkbox">
										<label for="charging"><input type="checkbox" name="purpose[]" id="charging" value="Charging boxes"><?=$countryConst=='SE'?'Laddboxar':'Charging boxes'?></label>
									</div>
									<div class="checkbox">
										<label for="other"><input type="checkbox" name="purpose[]" id="other" value="Other"><?=$countryConst=='SE'?'Övrigt':'Other'?></label>
									</div>
									<div class="checkbox">
										<label for="mortgages"><input type="checkbox" name="purpose[]" id="mortgages" value="Information about green mortgages"><?=$countryConst=='SE'?'Information om grönt bolån':'Information about green mortgages'?></label>
									</div>
								</div>
								<div class="clearfix"></div>
								<div class="form-group col-md-6">
									<input type="text" class="form-control" name="first_name" placeholder="<?=$countryConst=='SE'?'Förnamn':'First name'?>" pattern="([^\s][A-zÀ-ž\s]+)" required>
								</div>
								<div class="form-group col-md-6">
									<input type="text" class="form-control" name="last_name" placeholder="<?=$countryConst=='SE'?'Efternamn':'Surname'?>" pattern="([^\s][A-zÀ-ž\s]+)" required>
								</div>
								<div class="clearfix"></div>
								<div class="form-group col-md-6">
									<input type="email" class="form-control" name="email" placeholder="<?=$countryConst=='SE'?'Email':'Email'?>" required>
								</div>
								<div class="form-group col-md-6">
									<input type="text" class="form-control" name="phone" placeholder="<?=$countryConst=='SE'?'Telefon':'Phone Number'?>" pattern="[0-9]+" required>
								</div>
								<div class="clearfix"></div>
								<div class="form-group col-md-12">
									<input type="text" class="form-control" name="ort" placeholder="<?=$countryConst=='SE'?'Ort':'Ort'?>" required>
								</div>
								<div class="form-group col-md-12">
									<input type="text" class="form-control" name="address" placeholder="<?=$countryConst=='SE'?'Adress':'Address'?>">
								</div>
								<div class="clearfix"></div>
								<div class="form-group col-md-6">
									<input type="text" class="form-control" name="postal_code" placeholder="<?=$countryConst=='SE'?'Postnummer':'Zip Code'?>" pattern="[0-9]+" required>
									<input type="hidden" name="countryConst" value="<?=$countryConst?>">
								</div>
								<div class="clearfix"></div>
								<div class="form-group col-md-12">
									<textarea class="form-control" name="message" placeholder="<?=$countryConst=='SE'?'Något annat vi behöver veta?':'Anything else we need to know?'?>" rows="4"></textarea>
								</div>
								<div class="form-group col-md-12">
									<label class="label-control"><?=$countryConst=='SE'?'Hur hörde du talas om Cell Solar':'How did you hear about Arka Energy?'?></label>
									<div class="radio">
										<label for="social"><input type="radio" name="link_source" id="social" value="Social Media"><?=$countryConst=='SE'?'Sociala Medier':'Social Media'?></label>
									</div>
									<div class="radio">
										<label for="mailing"><input type="radio" name="link_source" id="mailing" value="Mailing"><?=$countryConst=='SE'?'Mailutskick':'Mailing'?></label>
									</div>
									<div class="radio">
										<label for="google"><input type="radio" name="link_source" id="google" value="Google">
										<?=$countryConst=='SE'?'Google':'Google'?></label>
									</div>
									<div class="radio">
										<label for="other"><input type="radio" name="link_source" id="link_source_other" value="Other">
										<?=$countryConst=='SE'?'Övrigt':'Other'?></label>
									</div>
								</div>
								<div class="clearfix"></div>
								<div class="col-lg-12">
									<div class=""><img class="captcha-img" src="<?=SITE_PATH?>captcha.php" /></div>	
									<span class="text">
										<input type="text" name="captcha" value="" placeholder="Verify Captcha*" class="form-control captcha-input" required>
									</span>
								</div>
								<div class="col-lg-12">
									<div class="cmsg"></div>
								</div>
								<div class="col-lg-12">
									<div class="calculator-get-started cntct_2_btn_inner">
										<input type="submit" class="submitForm nextbtn continue" id="submit-quote" value="<?=$countryConst=='SE'?'Skicka in':'Submit'?>">
									</div>
								</div>
							</div>
						</div>
					</form>
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
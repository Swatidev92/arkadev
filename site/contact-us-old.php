<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>assets/css/inner-custom.css" />

	<?php $contactQry = $cms->db_query("SELECT * FROM #_contact ");
	$contactRes = $contactQry->fetch_array();
	?>
	<div class="faq-section default-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
					<div class="sw_left_heading_wraper">
						<h1><span class="heading-bold">Contact Us</span></h1>
					</div>
				</div>
			</div>
					
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
					<div class="row">
						<div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
							<div class="contact-right-box">
								<div class="contact-title">
									<h2>Contact Us</h2>
								</div>
								<div class="contact-content">
									<?=$contactRes['contact_content']?>
								</div>
								<div class="contact-btns">
									<a class="transparent-btn" href="<?=$contactRes['contact_btn_link']?>"><?=$contactRes['contact_btn_text']?></a>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
							<div class="contact-right-box">
								<div class="contact-title">
									<h2>Get Connected</h2>
								</div>
								<div class="contact-content">
									<?=$contactRes['get_connect_content']?>
								</div>
								<div class="contact-btns">
									<a class="transparent-btn" href="<?=$contactRes['get_connect_btn_link']?>"><?=$contactRes['get_connect_btn_text']?></a>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
							<div class="contact-right-box">
								<div class="contact-title">
									<h2>Become a Ambassador</h2>
								</div>
								<div class="contact-content">
									<?=$contactRes['ambassador_content']?>
								</div>
								<div class="contact-btns">
									<a class="transparent-btn" href="<?=$contactRes['ambassador_btn_link']?>"><?=$contactRes['ambassador_btn_text']?></a>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
							<div class="contact-right-box">
								<div class="contact-title">
									<h2><?=$contactRes['contact_btn_text']?></h2>
								</div>
								<div class="contact-content">
									<?=$contactRes['contact_btn_text']?>
								</div>
								<div class="contact-btns">
									<a class="transparent-btn" href="<?=$contactRes['contact_btn_text']?>"><?=$contactRes['contact_btn_text']?></a>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
							<div class="contact-right-box">
								<div class="contact-title">
									<h2><?=$contactRes['contact_btn_text']?></h2>
								</div>
								<div class="contact-content">
									<?=$contactRes['contact_btn_text']?>
								</div>
								<div class="contact-btns">
									<a class="transparent-btn" href="<?=$contactRes['contact_btn_text']?>"><?=$contactRes['contact_btn_text']?></a>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
							<div class="contact-right-box">
								<div class="contact-title">
									<h2><?=$contactRes['contact_btn_text']?></h2>
								</div>
								<div class="contact-content">
									<?=$contactRes['contact_btn_text']?>
								</div>
								<div class="contact-btns">
									<a class="transparent-btn" href="<?=$contactRes['contact_btn_text']?>"><?=$contactRes['contact_btn_text']?></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="row">
                <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
					<div class="sw_left_heading_wraper">
						<h1><span class="heading-bold">Visit Us</span></h1>
					</div>
				</div>
                <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12">
					<div class="row">
						<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
							<div class="contact-right-box">
								<div class="contact-title">
									<h2>Head Office</h2>
								</div>
								<!--<div class="contact-content">
									4th Floor Sheel Mohar Plaza Yudhisthir Marg
								</div>
								<br>
								<div class="contact-content">
									C Scheme, Jaipur, Rajasthan 302001
								</div>-->
								<?=$contactRes['contact_btn_text']?>
							</div>
						</div>
						<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
							<div class="contact-right-box">
								<div class="contact-title">
									<h2>Emails</h2>
								</div>
								<!--<div class="contact-content contact-email">
									<a href="mailto:info@raysexperts.com">info@raysexperts.com</a>
								</div>
								<div class="contact-content contact-email">
									<a href="mailto:info@raysrooftop.com">info@raysrooftop.com</a>
								</div>
								<div class="contact-content contact-email">
									<a href="mailto:marketing@raysexperts.com">marketing@raysexperts.com</a>
								</div>-->
								
								<?=$contactRes['contact_btn_text']?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
							<div class="contact-right-box">
								<div class="contact-title">
									<h2>Overseas Office</h2>
								</div>
								<!--<div class="contact-content">
									5 Shenton Way
								</div>
								<br>
								<div class="contact-content">
									UIC Building #10-01, Singapore 068808
								</div>-->
								<?=$contactRes['contact_btn_text']?>
							</div>
						</div>
						<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
							<div class="contact-right-box">
								<div class="contact-title">
									<h2>Phone Numbers</h2>
								</div>
								<!--<div class="contact-content contact-email">
									<a href="tel:+91-7414040111">+91-7414040111</a>
								</div>
								<div class="contact-content contact-email">
									<a href="tel:+91-(141)-2220140">+91-(141)-2220140</a>
								</div>-->
								<?=$contactRes['contact_btn_text']?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
	
	<div class="sw_chose_service_wrapper1 default-padding1">
        <div class="container1">
			<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14232.112915575433!2d75.7986722!3d26.9025992!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x8d443a10a5e02066!2sRays%20Power%20Experts!5e0!3m2!1sen!2sin!4v1626930798708!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
		</div>
	</div>
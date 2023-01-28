<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>assets/css/inner-custom.css" />
	
	<?php $warrantyQry = $cms->db_query("SELECT * FROM #_warranty where id=1 ");
	$warrantyRes = $warrantyQry->fetch_array();
	
	$metaTitle= $warrantyRes['meta_title'.$langf];
	$metaIntro= $warrantyRes['meta_description'.$langf];
	$metaKeyword= $warrantyRes['meta_key'.$langf];
	?>
	
	<div class="faq-section default-padding">
        <div class="container">				
			<div class="row">
                <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
					<div class="sw_left_heading_wraper">
						<h1><span class="heading-bold"><?=$warrantyRes['sec1_main_heading'.$langf]?></span></h1>
					</div>
				</div>
                <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12">
					<div class="legal-right-box">
						<?=$warrantyRes['sec1_content'.$langf]?>
						<!--<div class="legal-title">
							<h2>Installation with own electricians and installers</h2>
						</div>
						<div class="legal-content">
							We at Svea Solar want it to feel safe to invest in solar cells. Therefore, we offer a long warranty on our solar cells and we assemble and install the systems with our own certified personnel. Through local offices in Stockholm, Gothenburg, Malmö, Jönköping and Karlshamn (etc.), low transport costs will be achieved, which will further reduce the environmental impact! It gives you as a customer good prices and a high level of service. We have over 120 employees at Svea Solar, all experienced in the solar cell industry, which means that quality is always delivered to you as a customer. We always focus on the customer by guaranteeing security, simplicity and profitability. 
						</div>
						<div class="btm-space"></div>
						<div class="legal-title">
							<h2>By being assured of the quality we deliver, we always provide the following guarantees at our facilities:</h2>
						</div>
						<div class="legal-content">
							<ul class="warranty-list">
								<li>10 years installation guarantee</li>
								<li>5 years functional guarantee</li>
								<li>5-10 years product guarantee for inverters</li>
								<li>12-25 years product guarantee for panels</li>
								<li>20 year power guarantee 80% on solar cells (Trina Solar)</li>
							</ul>
						</div>
						<div class="btm-space"></div>
						<div class="legal-title">
							<h2>Certification, training and management systems - we take responsibility</h2>
						</div>
						<div class="legal-content">
							At Svea Solar, we have the necessary permits and management systems to take care of your solar cell installation in the best way, for you as a private person or you as a company. Our project managers hold prevailing BAS-U and BAS-P education and many years of experience in the solar cell industry.
						</div>
						<div class="btm-space"></div>
						<div class="legal-content">
							Svea Solar also has an environmental management system developed in accordance with ISO 14001, and a quality management system developed according to ISO 9001. Our installers and project managers have also undergone internal as well as external training in solar cell installation, roof security and scaffolding.
						</div>
						<div class="btm-space"></div>
						<div class="legal-content">
							This means that we at Svea Solar install your solar cell plant with our own trained personnel for your safety.
						</div>-->
					</div>
				</div>
			</div>
		</div>
    </div>
    
	<div class="about-green-banner">
        <div class="container">
			<div class="row">
				<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
					<div class="text-center">
						<h2 class="about-joinus"><b><?=$warrantyRes['sec2_main_heading'.$langf]?></b></h2>
					</div>
					<div class="">
						<div class="disc_btn1 ltr_btn1 text-center">
							<ul class="about-joinus">
								<li><a href="<?=getPageUrl($warrantyRes['sec2_btn_link'.$langf],$countryConst,$urlConst)?>" class=""><?=$warrantyRes['sec2_btn_text'.$langf]?></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>
	
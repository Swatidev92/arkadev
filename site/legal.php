<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>assets/css/inner-custom.css" />
	
	<?php $legalQry = $cms->db_query("SELECT * FROM #_legal where id=1 ");
	$legalRes = $legalQry->fetch_array();
	
	$metaTitle= $legalRes['meta_title'.$langf];
	$metaIntro= $legalRes['meta_description'.$langf];
	$metaKeyword= $legalRes['meta_key'.$langf];
	?>
	<div class="faq-section default-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
					<div class="sw_left_heading_wraper">
						<h1><span class="heading-bold"><?=$legalRes['sec1_main_heading'.$langf]?></span></h1>
					</div>
				</div>
			</div>
				
			<div class="row">
                <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">				
					<div class="legal-title">
						<h2><?=$legalRes['sec1_sub_heading'.$langf]?></h2>
					</div>
				</div>
                <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12">
					<div class="legal-right-box">
						<div class="legal-content">
							<?=$legalRes['sec1_content'.$langf]?> 
							
							<?php if($countryConst=='SE'){
									$doc='Privacy-policy-swe.docx';
							}else{
								$doc='Privacy-policy-eng.docx';
							}								
							?>
							
							
							<p><a href="<?=SITE_PATH.'assets/'.$doc?>" download>Read our Privacy Policies here.</a></p>
						</div>
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
						<h2 class="about-joinus"><b><?=$legalRes['sec2_main_heading'.$langf]?> </b></h2>
					</div>
					<div class="">
						<div class="disc_btn1 ltr_btn1 text-center">
							<ul class="about-joinus">
								<li><a href="<?=getPageUrl($legalRes['btn_link'.$langf],$countryConst,$urlConst)?>" class=""><?=$legalRes['btn_text'.$langf]?></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>
	
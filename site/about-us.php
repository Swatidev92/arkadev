	<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>assets/css/inner-custom.css" />
	
	<?php $aboutQry = $cms->db_query("SELECT * FROM #_about where id=1 ");
	$aboutRes = $aboutQry->fetch_array();
	
	$metaTitle= $aboutRes['meta_title'.$langf];
	$metaIntro= $aboutRes['meta_description'.$langf];
	$metaKeyword= $aboutRes['meta_key'.$langf];
	
	?>
	<div class="page-head-banner" style="background: url(<?=SITE_PATH.'uploaded_files/about/'.$aboutRes['banner']?>); background-position: center bottom; background-repeat: no-repeat; background-size: cover; height:300px;">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<div class="content-banner" style="margin-top:60px;">
						<h2><?=$aboutRes['banner_text'.$langf]?></h2>
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

					<div class="text-center">
						<?=$aboutRes['sec1_content'.$langf]?>

					</div>

				</div>
				
			</div>
		</div>
    </div>
    <!-- sw choose service wrapper end-->
	
	
    <div class="default-padding">
        <div class="container">
			<div class="row">
				<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
					<div class="sw_left_heading_wraper sw_center_heading_wrapper">
                        <h1><span class="heading-bold"><?=$aboutRes['sec2_main_heading'.$langf]?></span></h1>
                    </div>
				</div>
			
				<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-xs-12 col-sm-6">
							<div class="value-box">
								<div class="value-img-icon">
									<img src="<?=SITE_PATH.'uploaded_files/about/'.$aboutRes['sec2_icon1']?>">
								</div>
								<div class="gb_icon_content"><b><?=$aboutRes['sec2_title1'.$langf]?></b></div>
								<p class="value-short-text"><?=$aboutRes['sec2_content1'.$langf]?></p>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-xs-12 col-sm-6">
							<div class="value-box">
								<div class="value-img-icon">
									<img src="<?=SITE_PATH.'uploaded_files/about/'.$aboutRes['sec2_icon2']?>">
								</div>
								<div class="gb_icon_content"><b><?=$aboutRes['sec2_title2'.$langf]?></b></div>
								<p class="value-short-text"><?=$aboutRes['sec2_content2'.$langf]?></p>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-xs-12 col-sm-6">
							<div class="value-box">
								<div class="value-img-icon">
									<img src="<?=SITE_PATH.'uploaded_files/about/'.$aboutRes['sec2_icon3']?>">
								</div>
								<div class="gb_icon_content"><b><?=$aboutRes['sec2_title3'.$langf]?></b></div>
								<p class="value-short-text"><?=$aboutRes['sec2_content3'.$langf]?></p>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-xs-12 col-sm-6">
							<div class="value-box">
								<div class="value-img-icon">
									<img src="<?=SITE_PATH.'uploaded_files/about/'.$aboutRes['sec2_icon4']?>">
								</div>
								<div class="gb_icon_content"><b><?=$aboutRes['sec2_title4'.$langf]?></b></div>
								<p class="value-short-text"><?=$aboutRes['sec2_content4'.$langf]?></p>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-xs-12 col-sm-6">
							<div class="value-box">
								<div class="value-img-icon">
									<img src="<?=SITE_PATH.'uploaded_files/about/'.$aboutRes['sec2_icon5']?>">
								</div>
								<div class="gb_icon_content"><b><?=$aboutRes['sec2_title5'.$langf]?></b></div>
								<p class="value-short-text"><?=$aboutRes['sec2_content5'.$langf]?></p>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-xs-12 col-sm-6">
							<div class="value-box">
								<div class="last-col-content"><b><?=$aboutRes['sec2_content6'.$langf]?></b></div>
							</div>
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
						<h2 class="about-joinus"><b><?=$aboutRes['sec4_main_heading'.$langf]?></b></h2>
					</div>
				</div>
			</div>
        </div>
    </div>
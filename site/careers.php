	<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>assets/css/inner-custom.css" />
	
	<?php $careerQry = $cms->db_query("SELECT * FROM #_career ");
	$careerRes = $careerQry->fetch_array();
	?>
	
	<div class="page-head-banner" style="background: url(<?=SITE_PATH.'uploaded_files/career/'.$careerRes['banner']?>); background-position: center bottom; background-repeat: no-repeat; background-size: cover;">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<div class="content-banner" style="margin-top:70px;">
						<h2><?=$careerRes['banner_text'.$langf]?></h2> 
						
						<div class="career-join">
							<p><?=$careerRes['banner_text2'.$langf]?></p>
							<a href="<?=$careerRes['btn_link'.$langf]?>" class="black-text"><?=$careerRes['btn_text'.$langf]?></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
 
    <div class="default-padding">
        <div class="container">
			<div class="row">
                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                    <div class="sw_disc_txt_wrapper">
                        <div class="sw_left_heading_wraper">
                            <h1 style="line-height:1.2"><span class="heading-bold"><?=$careerRes['sec1_main_heading'.$langf]?></span></h1>
                        </div>
					</div>
					<?=$careerRes['sec1_content'.$langf]?>
				</div>				
			</div>
		</div>
    </div>
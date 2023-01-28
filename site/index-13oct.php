	<?php $homeQry = $cms->db_query("SELECT * FROM #_home where id=1 ");
	$homeRes = $homeQry->fetch_array();
	
	$metaTitle= $homeRes['meta_title'.$langf];
	$metaIntro= $homeRes['meta_description'.$langf];
	$metaKeyword= $homeRes['meta_key'.$langf];
	
	?>

	<div class="page-head-banner" style="background: url(<?=SITE_PATH.'uploaded_files/home/'.$homeRes['banner']?>); background-position: center bottom; background-repeat: no-repeat; background-size: cover;  max-width: 100%;">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 col-md-9">
					<div class="content-banner">
						<h2><?=$homeRes['banner_text'.$langf]?></h2>  
						<div class="banner-input-box">
							<form class="" method="post" action="<?=getPageUrl(4,$countryConst,$urlConst)?>">
							<div class="row">
								<div class="col-md-5 col-sm-5 col-xs-6 banner-padding-right-none">
									<input type="text" name="search-address" id="ship-address" placeholder="<?=$homeRes['address_placeholder'.$langf]?>" class="banner-address-input">
								</div>
								<div class="col-md-1 col-sm-3 col-xs-3 padding-left-05 banner-btn-effect">
									<input type="image" id="my-img" src="<?=SITE_PATH?>assets/images/arrow/Group-222.svg" onmouseover="hover(this);" onmouseout="unhover(this);" />
								</div>
							</div>
							</form>
						</div>
						<div class="banner-call-btn">
							<a href="tel:<?=$settingArr['phone']?>"> 
								<img src="<?=SITE_PATH?>assets/images/arrow/phone.svg"> 
								<span class="calling-number"><?=$settingArr['phone']?></span>
							</a>
						</div>
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
                    <div class="sw_left_heading_wraper sw_center_heading_wrapper">
                        <h1><span class="heading-bold"><?=$homeRes['sec1_main_heading'.$langf]?></span></h1>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
                    <div class="chose_text_wrapper_left">
                        <div class="chose_icon_wrapper_list">
                            <div class="chose_icon_content_left">
                                <h1 class="text1"><?=$homeRes['sec1_heading1'.$langf]?></h1>
                                <h5 class="text2"><?=$homeRes['sec1_sub_heading1'.$langf]?></h5>
                                <p class="arka-best-choice-text"><?=$homeRes['sec1_content1'.$langf]?></p>
                            </div>
                        </div>                   
                    </div>
                </div>
				 
                <div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
                    <div class="chose_text_wrapper_left">
                        <div class="chose_icon_wrapper_list">
                            <div class="chose_icon_content_left">
                                <h1 class="text1"><?=$homeRes['sec1_heading2'.$langf]?></h1>
                                <h5 class="text2"><?=$homeRes['sec1_sub_heading2'.$langf]?></h5>
                                <p class="arka-best-choice-text"><?=$homeRes['sec1_content2'.$langf]?></p>
                            </div>
                        </div>                      
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
                    <div class="chose_text_wrapper_left">
                        <div class="chose_icon_wrapper_list">
                            <div class="chose_icon_content_left no-mrg-btm">
                                <h1 class="text1"><?=$homeRes['sec1_heading3'.$langf]?></h1>
								<h5 class="text2"><?=$homeRes['sec1_sub_heading3'.$langf]?></h5>
                                <p class="arka-best-choice-text"><?=$homeRes['sec1_content3'.$langf]?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- sw choose service wrapper end-->
	
	 <!--sw leads wrapper start-->
    <div class="sw_leads_wrapper grey-bg default-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-lg-5 col-sm-12 col-xs-12">
                    <div class="sw_disc_txt_wrapper">
                        <div class="sw_left_heading_wraper">
                            <h1 class="font-36 get-solar-home" style="line-height:1.2; color:#000;"><span class="heading-bold"><?=$homeRes['sec2_main_heading'.$langf]?></span></h1>
                        </div>
                        <div class="row">
							<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 hidden-md hidden-lg">
								<div class="sw_road_leads_img">
									<img src="<?=SITE_PATH.'uploaded_files/home/'.$homeRes['sec2_img']?>" alt="img">
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-xs-12 col-sm-6">
								<div class="gb_icon_wrapper height-boxes-eng">
									<div class="gb_icon_content">
										<b><?=$homeRes['sec2_heading1'.$langf]?></b>
										<p class="get-solar-text2"><?=$homeRes['sec2_sub_heading1'.$langf]?></p>
									</div>
									<p class="get-solar-desc"><?=$homeRes['sec2_content1'.$langf]?></p>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-xs-12 col-sm-6">
								<div class="gb_icon_wrapper height-boxes-eng">                        
									<div class="gb_icon_content">
										<b><?=$homeRes['sec2_heading2'.$langf]?></b>
										<p class="get-solar-text2"><?=$homeRes['sec2_sub_heading2'.$langf]?></p>
									</div>
									<p class="get-solar-desc"><?=$homeRes['sec2_content2'.$langf]?></p>
								</div>
							</div>      
						</div>
			
						<div class="row">
							<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
								<div class="gb_icon_wrapper">                        
									<div class="gb_icon_content">
										<b><?=$homeRes['sec2_heading3'.$langf]?></b>
										<p class="get-solar-text2"><?=$homeRes['sec2_sub_heading3'.$langf]?></p>
									</div>
									<p class="get-solar-desc"><?=$homeRes['sec2_content3'.$langf]?></p>
								</div>
							</div>
						</div>
					</div>
                </div>
                <div class="col-md-7 col-lg-7 col-sm-12 col-xs-12 hidden-sm hidden-xs">
					<div class="sw_road_leads_img" style="margin-top:155px;">
                        <img src="<?=SITE_PATH.'uploaded_files/home/'.$homeRes['sec2_img']?>" alt="img">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- sw leads section end-->
	
	<div class="sw_news_letter_wrapper blue-gradiant-banner">
        <div class="container">
			<div class="row">
                <div class="col-md-1 col-lg-1 col-sm-12 col-xs-12"></div>
                <div class="col-md-10 col-lg-10 col-sm-12 col-xs-12">
					<div class="sw_nl_heading_wrapper">
						<h2 class="get-connect-home-text"><?=$homeRes['sec3_title'.$langf]?></b></h2>
					</div>
					<div class="sw_nl_form_wrapper">
						<div class="disc_btn ltr_btn">
							<ul>
								<li>
									<a href="<?=getPageUrl($homeRes['sec3_link'.$langf],$countryConst,$urlConst)?>" class=""><?=$homeRes['sec3_btn_text'.$langf]?></a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>
	
	<div class="">
		<div class="">
			<img src="<?=SITE_PATH.'uploaded_files/home/'.$homeRes['sec4_img'.$langf]?>" class="img-responsive" width="100%">
		</div>
	</div>
	
	<div class="sw_chose_service_wrapper default-padding">
        <div class="container">
            <!--<div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                    <div class="sw_left_heading_wraper sw_center_heading_wrapper">
                        <h1><span class="heading-bold">Arka Energy Protection</span></h1>
                    </div>
                </div>
			</div>-->
                
			<div class="row">
				<div class="col-lg-4 col-md-4 col-xs-12 col-sm-4">
					<div class="gb_icon_wrapper ae-protection-box eng-protection-box">
						<div class="row">
							<div class="col-md-12 col-lg-12 col-sm-12 col-xs-4">
								<div class="gb_icon_img">
									<img src="<?=SITE_PATH.'uploaded_files/home/'.$homeRes['sec5_icon1']?>" alt="title">
								</div>	
							</div>
							<div class="col-md-12 col-lg-12 col-sm-12 col-xs-8">
								<div class="gb_icon_content">
									<h4><?=$homeRes['sec5_title1'.$langf]?></h4>
								</div>
								<p class="arka-protection-text"><?=$homeRes['sec5_content1'.$langf]?></p>
							</div>
						</div>						
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-xs-12 col-sm-4">
					<div class="gb_icon_wrapper ae-protection-box eng-protection-box">
						<div class="row">
							<div class="col-md-12 col-lg-12 col-sm-12 col-xs-4">
								<div class="gb_icon_img">
									<img src="<?=SITE_PATH.'uploaded_files/home/'.$homeRes['sec5_icon2']?>" alt="title">
								</div>
							</div>
							<div class="col-md-12 col-lg-12 col-sm-12 col-xs-8">
								<div class="gb_icon_content">
									<h4><?=$homeRes['sec5_title2'.$langf]?></h4>
								</div>
								<p class="arka-protection-text"><?=$homeRes['sec5_content2'.$langf]?></p>
							</div>
						</div>		
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-xs-12 col-sm-4">
					<div class="gb_icon_wrapper ae-protection-box eng-protection-box">
						<div class="row">
							<div class="col-md-12 col-lg-12 col-sm-12 col-xs-4">
								<div class="gb_icon_img">
									<img src="<?=SITE_PATH.'uploaded_files/home/'.$homeRes['sec5_icon3']?>" alt="title">
								</div>
							</div>
							<div class="col-md-12 col-lg-12 col-sm-12 col-xs-8">
								<div class="gb_icon_content">
									<h4><?=$homeRes['sec5_title3'.$langf]?></h4>
								</div>
								<p class="arka-protection-text"><?=$homeRes['sec5_content3'.$langf]?></p>
							</div>
						</div>		
					</div>
				</div>                
			</div>
        </div>
    </div>
    <!-- sw choose service wrapper end-->
	
	
	 <div class="sw_leads_wrapper grey-bg default-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                    <div class="sw_disc_txt_wrapper">
                        <div class="row">
							<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
								<div class="gb_icon_wrapper">                        
									<div class="mob-app-big-text hidden-sm hidden-xs">
										<?=$homeRes['sec6_main_heading'.$langf]?>
									</div>
									<div class="mob-app-big-text hidden-lg hidden-md">
										<?=$homeRes['sec6_main_heading'.$langf]?>
									</div>
								</div>
							</div>
						</div>
                        <div class="row">
							<div class="col-lg-4 col-md-4 col-xs-12 col-sm-4">
								<div class="mob-app-box-wrapper">
									<div class="mob-app-box-icon">
										<img src="<?=SITE_PATH.'uploaded_files/home/'.$homeRes['sec6_icon1']?>" alt="title">
									</div>
									<div class="gb_icon_content">
										<b><?=$homeRes['sec6_title1'.$langf]?></b>										
									</div>									
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-xs-12 col-sm-4">
								<div class="mob-app-box-wrapper">    
									<div class="mob-app-box-icon">
										<img src="<?=SITE_PATH.'uploaded_files/home/'.$homeRes['sec6_icon2']?>" alt="title">
									</div>                   
									<div class="gb_icon_content">
										<b><?=$homeRes['sec6_title2'.$langf]?></b>										
									</div>									
								</div>
							</div> 
							<div class="col-lg-4 col-md-4 col-xs-12 col-sm-4">
								<div class="mob-app-box-wrapper">        
									<div class="mob-app-box-icon">
										<img src="<?=SITE_PATH.'uploaded_files/home/'.$homeRes['sec6_icon3']?>" alt="title">
									</div>                 
									<div class="gb_icon_content">
										<b><?=$homeRes['sec6_title3'.$langf]?></b>										
									</div>									
								</div>
							</div> 							
						</div>	
					</div>
                </div>
                <div class="col-md-1 col-lg-1 col-sm-12 col-xs-12"></div>
                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
					<div class="sw_road_leads_img">
                        <img src="<?=SITE_PATH.'uploaded_files/home/'.$homeRes['sec6_right_img']?>" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
	
	<div class="">
		<div class="">
			<img src="<?=SITE_PATH.'uploaded_files/home/'.$homeRes['sec7_img'.$langf]?>" class="img-responsive" width="100%">
		</div>
	</div>
	
	<?php $projectQry = $cms->db_query("SELECT * FROM #_recent_projects where status=1 AND is_deleted=0 ");
	if($projectQry->num_rows>0){
	?>
	<div class="default-padding arka-installation">
        <div class="container">
            <div class="row">
				<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                    <div class="sw_left_heading_wraper sw_center_heading_wrapper">
                        <h1 style="font-size:24px; margin-top:10px;"><span class="heading-bold"><?=$homeRes['sec8_sub_heading'.$langf]?></span></h1>
                    </div>
                </div>

                <!-- slider start -->
                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 sw_spectrm_padding">
                    <div class="spectrum_slider_wrapper">
						<div class="owl-carousel owl-theme">
							<?php while($projectArr = $projectQry->fetch_array()){?>
							<div class="item">
								<div class="btc_blog_indx_box_wrapper btc_blog_padder btc_index_blog_pader">
									<div class="btc_blog_indx_cont_wrapper">						
										<div class="btc_blog_indx_img_wrapper">
											<img src="<?=SITE_PATH.'uploaded_files/project/'.$projectArr['project_img']?>">
										</div>
										<div class="installation-content text-left">
											<h5><?=$projectArr['project_type'.$langf]?></h5>	
											<div class="btc_blog_indx_cont_bottom_left">
												<p><?=$projectArr['project_name'.$langf]?></p>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php } ?>
						</div>
					</div>
                </div>
				<!--<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
					<div class="disc_btn text-center">
						<ul>
							<li>
								<a href="#" class="waves-effect waves-light waves-ripple green-text green-border-btn">More projects</a>
							</li>
						</ul>
					</div>
				</div>-->
            </div>
        </div>
    </div>
	<?php } ?>
		   
	<?php $latestBlogQry = $cms->db_query("SELECT * FROM #_blogs where status=1 AND is_deleted=0 order by post_date limit 1 ");
		if($latestBlogQry->num_rows>0){
		$latestBlogRes = $latestBlogQry->fetch_array();
		
		$catArr = explode(',',$latestBlogRes['cat_id']);
	?>
	<div class="sw_chose_service_wrapper default-padding">
        <div class="container">
			<div class="row">
				<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
					<div class="sw_left_heading_wraper">
						<p style="font-family: 'ProximaNova Regular';"><b><?=$homeRes['news_main_heading'.$langf]?></b></p>
						<h1><span class="heading-bold"><?=$homeRes['news_sub_heading'.$langf]?></span></h1>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
					<div class="sw_abt_right_btm_wrapper news-wrapper">
						<div class="sw_left_heading_wraper" style="padding-bottom:0px;">
							<p class="news-postdate"><?=date('M d, Y',strtotime($latestBlogRes['post_date']))?></p>
                            <h2><?=$latestBlogRes['title'.$langf]?></h2>
                            <p style="font-family: 'OpenSans Regular';padding-top:30px;font-size:15px; line-height:1.5;"><?=$latestBlogRes['blog_content'.$langf]?></p>
							
							<?php $blogCatQry = $cms->db_query("SELECT * FROM #_blog_catagories where status=1 AND is_deleted=0 ");
							if($blogCatQry->num_rows>0){
							?>
							<ul class="news-tags">
								<?php while($blogCatRes = $blogCatQry->fetch_array()){
									if(in_array($blogCatRes['id'],$catArr)){
								?>
								<li><?=$blogCatRes['cat_name'.$langf]?></li>
								<?php } } ?>
							</ul>
							<?php } ?>
							<div class="blog-read-more-btn">
								<p style="font-weight:400; margin-bottom:0px;"><a href="<?=SITE_PATH.'blog/'.$latestBlogRes['url']?>" class="waves-effect waves-light waves-ripple">Read more <i class="fa fa-long-arrow-right"></i></a></p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
					<?php $blogQry = $cms->db_query("SELECT * FROM #_blogs where status=1 AND is_deleted=0 order by post_date ASC LIMIT 1,4 ");
					if($blogQry->num_rows>0){
					?>
					<div class="sw_disc_txt_wrapper">
						<?php while($blogRes = $blogQry->fetch_array()){?>
                        <div class="sw_desc_btm_txt">
                            <div class="sw_disc_head_text">
                                <h5><a href="<?=SITE_PATH.'blog/'.$blogRes['url']?>"><?=$blogRes['title'.$langf]?> <span class="next-arrow"><i class="fa fa-long-arrow-right"></i></span></a></h5>
                            </div>
                        </div>
						<?php } ?>
					</div>
					<?php } ?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
					<div class="disc_btn text-center">
						<ul>
							<li>
								<a href="<?=SITE_PATH?>blog" class="green-border-btn">See all news</a>
							</li>
						</ul>
					</div>
				</div>
			</div>		
		</div>	
	</div>		
	<?php } ?>

	<?php $faqsQry = $cms->db_query("SELECT * FROM #_faqs where status=1 AND is_deleted=0 "); 
		$fnum=1;
		if($faqsQry->num_rows>0){
	?>
	<div class="sw_chose_service_wrapper grey-bg default-padding">
        <div class="container">
			<div class="row">
                <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
					<div class="sw_left_heading_wraper">
						<h1><span class="heading-bold"><?=$homeRes['faq_heading'.$langf]?></span></h1>
					</div>
				</div>
                <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12">
                    <div class="sw_disc_txt_wrapper">
                        <div class="sw_leads_accordian">
                            <div class="panel-group" id="accordionFifteenLeft" role="tablist">
								<?php while($faqsRes = $faqsQry->fetch_array()){
									if($fnum==$faqsQry->num_rows){
										$collapsed='';
										$collapsedin='in';
									}else{
										$collapsed='collapsed';
										$collapsedin ='';
									}
								?>
                                <div class="panel panel-default">
                                    <div class="panel-heading horn">
                                        <h4 class="panel-title">
											<a class="<?=$collapsed?>" data-toggle="collapse" data-parent="#accordionFifteenLeft" href="#collapseFifteenLeft<?=$faqsRes['id']?>" aria-expanded="false"><?=$faqsRes['question'.$langf]?></a>
										</h4>
                                    </div>
                                    <div id="collapseFifteenLeft<?=$faqsRes['id']?>" class="panel-collapse collapse <?=$collapsedin?>" aria-expanded="false" role="tabpanel">
                                        <div class="panel-body">

                                            <div class="panel_cont">
                                                <p><?=$faqsRes['answer'.$langf]?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<?php $fnum++; } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>	
	</div>	
	<?php } ?>

	
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>

<!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <!--<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBcuL09_sSUWR-65TVL061A0xG4TKGAhrA&libraries=places,drawing"
      async
    ></script>-->
	
	
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBcuL09_sSUWR-65TVL061A0xG4TKGAhrA&callback=initAutocomplete&v=weekly&libraries=places,drawing" async> </script>
	
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
  address1Field = document.querySelector("#ship-address");
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
      case "locality":
        document.querySelector("#locality").value = component.long_name;
        break;

      case "administrative_area_level_1": {
        document.querySelector("#state").value = component.short_name;
        break;
      }
      case "country":
        document.querySelector("#country").value = component.long_name;
        break;
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
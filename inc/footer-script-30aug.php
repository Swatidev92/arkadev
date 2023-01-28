 <script src="<?=SITE_PATH?>assets/js/jquery_min.js"></script>
    <script src="<?=SITE_PATH?>assets/js/materialize.min.js"></script>
    <script src="<?=SITE_PATH?>assets/js/bootstrap.min.js"></script>
    <script src="<?=SITE_PATH?>assets/js/jqu_menu.js"></script>
    <script src="<?=SITE_PATH?>assets/js/jqu_slickmenu.js"></script>
    <script src="<?=SITE_PATH?>assets/js/isotope.pkgd.min.js"></script>
    <script src="<?=SITE_PATH?>assets/venobox/js/venobox.min.js"></script>
    <script src="<?=SITE_PATH?>assets/js/jquery.inview.min.js"></script>
    <script src="<?=SITE_PATH?>assets/js/jquery.mixitup.min.js"></script>
    <script src="<?=SITE_PATH?>assets/js/jquery.countTo.js"></script>
    <script src="<?=SITE_PATH?>assets/js/wow.min.js"></script>
    <script src="<?=SITE_PATH?>assets/js/jquery.easing.1.3.js"></script>
    <script src="<?=SITE_PATH?>assets/js/owl.carousel.js"></script>
	<script src="<?=SITE_PATH?>assets/js/validator.js"></script>
    <script src="<?=SITE_PATH?>assets/js/camera.min.js"></script>
	<script src="<?=SITE_PATH?>assets/js/plugin/rs_slider/jquery.themepunch.revolution.min.js"></script>
    <script src="<?=SITE_PATH?>assets/js/plugin/rs_slider/jquery.themepunch.tools.min.js"></script>
    <script src="<?=SITE_PATH?>assets/js/plugin/rs_slider/revolution.addon.snow.min.js"></script>
    <script src="<?=SITE_PATH?>assets/js/plugin/rs_slider/revolution.extension.actions.min.js"></script>
    <script src="<?=SITE_PATH?>assets/js/plugin/rs_slider/revolution.extension.carousel.min.js"></script>
    <script src="<?=SITE_PATH?>assets/js/plugin/rs_slider/revolution.extension.kenburn.min.js"></script>
    <script src="<?=SITE_PATH?>assets/js/plugin/rs_slider/revolution.extension.layeranimation.min.js"></script>
    <script src="<?=SITE_PATH?>assets/js/plugin/rs_slider/revolution.extension.migration.min.js"></script>
    <script src="<?=SITE_PATH?>assets/js/plugin/rs_slider/revolution.extension.navigation.min.js"></script>
    <script src="<?=SITE_PATH?>assets/js/plugin/rs_slider/revolution.extension.parallax.min.js"></script>
    <script src="<?=SITE_PATH?>assets/js/plugin/rs_slider/revolution.extension.slideanims.min.js"></script>
    <script src="<?=SITE_PATH?>assets/js/plugin/rs_slider/revolution.extension.video.min.js"></script>
    <script src="<?=SITE_PATH?>assets/js/custom_2.js"></script>
	<!--<script src="<?=SITE_PATH_ADM?>js/custom-select.min.js" type="text/javascript"></script>-->
    <!--js code-->

	
	<!--<script>
	$('.continue').click(function(){
		$('.nav-tabs > .active').next('li').find('a').trigger('click');
	});
	$('.back').click(function(){
		$('.nav-tabs > .active').prev('li').find('a').trigger('click');
	});
	</script>-->



	<script>
		//Tabs Box
	if($('.tabs-box').length){
		$('.tabs-box .tab-buttons .tab-btn').on('click', function(e) {
			e.preventDefault();
			var target = $($(this).attr('data-tab'));
			
			if ($(target).is(':visible')){
				return false;
			}else{
				target.parents('.tabs-box').find('.tab-buttons').find('.tab-btn').removeClass('active-btn');
				$(this).addClass('active-btn');
				target.parents('.tabs-box').find('.tabs-content').find('.tab').fadeOut(0);
				target.parents('.tabs-box').find('.tabs-content').find('.tab').removeClass('active-tab');
				$(target).fadeIn(300);
				$(target).addClass('active-tab');
			}
		});
	}
	</script>
	
	<!--<script>
		$("#customer_type").select2({
			minimumResultsForSearch: Infinity
		});
	</script>-->
	<script>
			
	 var tpj=jQuery;
			
			var revapi1050;
			tpj(document).ready(function() {
				if(tpj("#rev_slider_1050_1").revolution == undefined){
					revslider_showDoubleJqueryError("#rev_slider_1050_1");
				}else{
					revapi1050 = tpj("#rev_slider_1050_1").show().revolution({
						sliderType:"standard",
						jsFileLocation:"revolution/js/",
						sliderLayout:"fullscreen",
						dottedOverlay:"none",
						delay:9000,
						navigation: {
							keyboardNavigation:"on",
							keyboard_direction: "horizontal",
							mouseScrollNavigation:"off",
 							mouseScrollReverse:"default",
							onHoverStop:"off",
							touch:{
								touchenabled:"on",
								swipe_threshold: 75,
								swipe_min_touches: 50,
								swipe_direction: "horizontal",
								drag_block_vertical: false
							},
							arrows: {
					style:"uranus",
					enable:false,
					hide_onmobile:true,
					hide_onleave:true,
					tmp:'',
					left: {
						h_align:"left",
						v_align:"center",
						h_offset:0,
						v_offset:10
					},
					right: {
						h_align:"right",
						v_align:"center",
						h_offset:0,
						v_offset:10
					}
				}
							,
							bullets: {
								enable:true,
								hide_onmobile:false,
								hide_under:1024,
								style:"hephaistos",
								hide_onleave:false,
								direction:"horizontal",
								h_align:"center",
								v_align:"bottom",
								h_offset:0,
								v_offset:0,
								space:10,
								tmp:''
							}
						},
						responsiveLevels:[1240,1024,778,480],
						visibilityLevels:[1240,1024,778,480],
						gridwidth:[1400,1240,778,480],
						gridheight:[868,768,960,720],
						lazyType:"none",
						shadow:0,
						spinner:"spinner2",
						stopLoop:"on",
						stopAfterLoops:0,
						stopAtSlide:1,
						shuffle:"off",
						autoHeight:"off",
						fullScreenAutoWidth:"off",
						fullScreenAlignForce:"off",
						fullScreenOffsetContainer: "",
						fullScreenOffset: "",
						disableProgressBar:"on",
						hideThumbsOnMobile:"off",
						hideSliderAtLimit:0,
						hideCaptionAtLimit:0,
						hideAllCaptionAtLilmit:0,
						debugMode:false,
						fallbacks: {
							simplifyAll:"off",
							nextSlideOnWindowFocus:"off",
							disableFocusListener:false,
						}
					});
				}
			});	/*ready*/
	
	</script>
	
	<script>
	$(document).ready(function(){ 
		$("input[name$='slope_type']").click(function() {
			var selval = $(this).val();
			$('#sel_slope_type').val(selval);	
		}); 
	});
	</script>
	<script>
	$(document).ready(function(){ 
		$("input[name$='panel_type']").click(function() {
			var selval = $(this).val();
			$('#sel_panel_type').val(selval);
			$('#panel_type_name').html(selval);
			if(selval == 'Optimized'){
				$('#panel_val').val(405);				
				$('.essential-img').attr('src', '<?=SITE_PATH?>assets/images/calculator/panels/essential.jpg');
				$('#onPanelSel1').show();
				$('#onPanelSel2').hide();
				$('#onPanelSel3').hide();
			}else if(selval == 'Esthetic'){
				$('#panel_val').val(395);
				$('.essential-img').attr('src', '<?=SITE_PATH?>assets/images/calculator/panels/black.jpg');
				$('#onPanelSel1').hide();
				$('#onPanelSel2').show();
				$('#onPanelSel3').hide();
			}else if(selval == 'Performance'){
				$('#panel_val').val(375);				
				$('.essential-img').attr('src', '<?=SITE_PATH?>assets/images/calculator/panels/black.jpg');
				$('#onPanelSel1').hide();
				$('#onPanelSel2').hide();
				$('#onPanelSel3').show();
			}
			$.ajax({
				url:"<?=SITE_PATH?>ms_file/getAllCost",
				type:"post",
				//async:false,
				data:"roof_area="+$('#roof_area').val()+"&panel_val="+$('#panel_val').val()+"&sel_panel_type="+$('#sel_panel_type').val(),
				beforeSend:function(){
					$(".loader").show();
				},
				success:function(result){
					$(".loader").hide();
					//alert(result);
					res=result.split("|");
					if(res[0]!=''){	
						$('.annual-cost-count').html(res[0]);
						$('.annual-saving-count').html(res[1]);				
					}
				}
			});
				
		}); 
	});
	</script>
	
	<!--<script>
	$(document).ready(function(){ 
		$("input[name$='addon_type']").click(function() {
			var selval = $(this).val();
			$('#sel_addon_type').val(selval);	
		}); 
	});
	</script>-->
	<script>
	 $(function() {
        // listen for changes on the checkboxes
        $('input[name="addon_type[]"]').change(function() {
            // have an empty array to store the values in
            let values = [];
            // check each checked checkbox and store the value in array
            $.each($('input[name="addon_type[]"]:checked'), function(){
                values.push($(this).val());
            });
            // convert the array to string and store the value in hidden input field
            $('#sel_addon_type').val(values.toString());
			
			var sel_panel_type = $('#sel_panel_type').val();
			var sel_addon_type = $('#sel_addon_type').val();
			//alert(sel_addon_type);
			var nameArr = sel_addon_type.split(',');
 			
			if(nameArr[0]=='' && sel_panel_type=='Optimized'){
				$('.essential-img').attr('src', '<?=SITE_PATH?>assets/images/calculator/panels/essential.jpg');
			}
			if(nameArr[0]=='' && sel_panel_type=='Esthetic'){
				$('.essential-img').attr('src', '<?=SITE_PATH?>assets/images/calculator/panels/black.jpg');
			}
			if(nameArr[0]=='' && sel_panel_type=='Performance'){
				$('.essential-img').attr('src', '<?=SITE_PATH?>assets/images/calculator/panels/black.jpg');
			}
			if(nameArr[0]=='at1' && sel_panel_type=='Optimized'){
				$('.essential-img').attr('src', '<?=SITE_PATH?>assets/images/calculator/panels/essential-battery.jpg');
			}
			if(nameArr[0]=='at1' && sel_panel_type=='Esthetic'){
				$('.essential-img').attr('src', '<?=SITE_PATH?>assets/images/calculator/panels/black-battery.jpg');
			}
			if(nameArr[0]=='at1' && sel_panel_type=='Performance'){
				$('.essential-img').attr('src', '<?=SITE_PATH?>assets/images/calculator/panels/black-battery.jpg');
			}
			if(nameArr[0]=='at2' && sel_panel_type=='Optimized'){
				$('.essential-img').attr('src', '<?=SITE_PATH?>assets/images/calculator/panels/essential-charger.jpg');
			}
			if(nameArr[0]=='at2' && sel_panel_type=='Esthetic'){
				$('.essential-img').attr('src', '<?=SITE_PATH?>assets/images/calculator/panels/black-charger.jpg');
			}
			if(nameArr[0]=='at2' && sel_panel_type=='Performance'){
				$('.essential-img').attr('src', '<?=SITE_PATH?>assets/images/calculator/panels/black-charger.jpg');
			}
			if(nameArr[0]=='at1' && nameArr[1]=='at2' && sel_panel_type=='Optimized'){
				$('.essential-img').attr('src', '<?=SITE_PATH?>assets/images/calculator/panels/essential-both.jpg');
			}
			if(nameArr[0]=='at1' && nameArr[1]=='at2' && sel_panel_type=='Esthetic'){
				$('.essential-img').attr('src', '<?=SITE_PATH?>assets/images/calculator/panels/black-both.jpg');
			}
			if(nameArr[0]=='at1' && nameArr[1]=='at2' && sel_panel_type=='Performance'){
				$('.essential-img').attr('src', '<?=SITE_PATH?>assets/images/calculator/panels/black-both.jpg');
			}
			
			$.ajax({
				url:"<?=SITE_PATH?>ms_file/getAllCost",
				type:"post",
				//async:false,
				data:"roof_area="+$('#roof_area').val()+"&panel_val="+$('#panel_val').val()+"&sel_panel_type="+$('#sel_panel_type').val()+"&sel_addon_type="+$('#sel_addon_type').val(),
				beforeSend:function(){
					$(".loader").show();
				},
				success:function(result){
					$(".loader").hide();
					//alert(result);
					res=result.split("|");
					if(res[0]!=''){	
						$('.annual-cost-count').html(res[0]);
						$('.annual-saving-count').html(res[1]);				
					}
				}
			});		
        });
    });
	</script>

	<script>
	$(document).ready(function () {
		//Initialize tooltips
		$('.nav-tabs > li a[title]').tooltip();
		
		//Wizard
		$('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

			var $target = $(e.target);
		
			if ($target.parent().hasClass('disabled')) {
				return false;
			}
		});

		//Step 1
		$("#getlatlong").click(function () {
			//alert($('#address').val());
			if($('#sel_address').val()!=''){
				var $active = $('.nav-tabs li.active');
				$active.next().removeClass('disabled');
				nextTab($active);
			}else{
				alert('PLease enter address');
			}
		});
		
		
		//step 2
		$("#step2_submit").click(function () {
			var mapImg = saveMapToDataUrl();
			//alert($('#roof_area').val());
							
		});
		
		
		//step 3
		$("#step3_submit").click(function () {
			var sel_slope_type = $('#sel_slope_type').val();
			if(sel_slope_type==''){
				alert('Please Select slope type');
				return false;
			}else{
				$.ajax({
					url:"<?=SITE_PATH?>ms_file/getAllCost",
					type:"post",
					//async:false,
					data:"roof_area="+$('#roof_area').val()+"&panel_val="+$('#panel_val').val()+"&sel_panel_type="+$('#sel_panel_type').val(),
					beforeSend:function(){
						$(".loader").show();
					},
					success:function(result){
						$(".loader").hide();
						//alert(result);
						res=result.split("|");
						if(res[0]!=''){	
							$('.saving-img').addClass('with-cost');
							$('.annual-cost-count').html(res[0]);
							$('.annual-saving-count').html(res[1]);
							var $active = $('.nav-tabs li.active');
							$active.next().removeClass('disabled');
							nextTab($active);				
						}
					}
				});					
			}		
		});
		
		//step 4
		$("#step4_submit").click(function () {
			var sel_panel_type = $('#sel_panel_type').val();
			var sel_addon_type = $('#sel_addon_type').val();
			var postalCode = $('#postcode').val();
			var address2 = $('#address2').val();
			if(sel_panel_type==''){
				alert('Please Select solar panel type');
				return false;
			}else{
				$.ajax({
					url:"<?=SITE_PATH?>ms_file/costSummary",
					type:"post",
					//async:false,
					data:$(".solar_form").serialize(),
					beforeSend:function(){
						$(".loader").show();
					},
					success:function(result){
						$(".loader").hide();
						//alert(result);
						res=result.split("|");
						if(res[0]!=''){	
							$('.annual-cost-count').html(res[0]);
							$('.annual-saving-count').html(res[1]);
							$('#total_cost').html(res[0]);
							$('#tax_benefit').html(res[2]);
							$('#payback_time').html(res[3]);
							$('#annual-saving-count').html(res[1]);
							$('#energy_prod').html(res[4]);
							$('.show_panel').html(res[5]+' solar panels');
							$('.show_panel_type').html(res[6]);
							$('.show_slope_type').html(res[7]+'&deg;');
							$('.battery_val').html('Battery: '+res[8]);
							$('.charger_val').html('Car Charger: '+res[9]);
							$('.area_selected').html(res[10]+' m<sup>2</sup>');
							$('.size_selected').html(res[11]+' KW');
							$('#postal_code').val(postalCode);
							$('#address_input').val(address2);
							var $active = $('.nav-tabs li.active');
							$active.next().removeClass('disabled');
							nextTab($active);				
						}
					}
				});
			}		
		});
		
		//step 5
		/*$("#calculatorSubmit").click(function(e){			
			$.ajax({
				url:"<?=SITE_PATH?>ms_file/ajaxSubmitCalculator",
				type:"post",
				//async:false,
				data:$(".solar_form").serialize(),
				beforeSend:function(){
					$(".loader").show();
				},
				success:function(result){
					$(".loader").hide();
					//alert(result);
					if(result==1){	
						location.href="<?=SITE_PATH?>thankyou";
					}else{	
						$(".amsg").html('<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Went wrong</div>');
					}
				}
			});	
			return false;
		});
		*/
		
		$(".next-step").click(function (e) {
			var $active = $('.nav-tabs li.active');
			$active.next().removeClass('disabled');
			nextTab($active);
		});
		$(".prev-step").click(function (e) {

			var $active = $('.nav-tabs li.active');
			prevTab($active);

		});
	});

	function nextTab(elem) {
		$(elem).next().find('a[data-toggle="tab"]').click();
	}
	function prevTab(elem) {
		$(elem).prev().find('a[data-toggle="tab"]').click();
	}
	</script>
	
	<script>
	function submitCalculator(form,msg,btnid){
		if($("#"+btnid).hasClass("disabled")==false){
			$.ajax({
				url:"<?=SITE_PATH?>ms_file/ajaxSubmitCalculator",
				type:"post",
				//async:false,
				data:$(".solar_form").serialize(),
				beforeSend:function(){
					$(".loader").show();
				},
				success:function(result){
					$(".loader").hide();
					//alert(result);
					if(result==1){	
						location.href="<?=SITE_PATH?>thankyou";
					}else{	
						$(".amsg").html('<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Went wrong</div>');
					}
				}
			});
		}
			return false;
	}
	</script>


	<script>
	function isNumber(evt) {
		evt = (evt) ? evt : window.event;
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode > 31 && (charCode < 48 || charCode > 57)) {
			return false;
		}
		return true;
	}
	
	
	$("#getlatlong").click(function(e){
		var sel_address = $("#sel_address").val();	
		$.ajax({
			url:"<?=SITE_PATH?>ms_file/latlong",
			type:"post",
			//async:false,
			data:"location="+sel_address,
			beforeSend:function(){
				$(".loader").show();
			},
			success:function(result){
				$(".loader").hide();
				//alert(result);
				res=result.split("|");
				if(res[0]!=''){	
					$('#sellat').val(res[0]);	
					$('#sellong').val(res[1]);	
					initMap();
					return;					
				}else{	
					$(".amsg").html('<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Invalid address</div>');
				}
			}
		});	
	});	
	</script>
	
	<script>
	function submitEnquiry(form,msg,btnid){
		if($("#"+btnid).hasClass("disabled")==false){
			$.ajax({
				url:"<?=SITE_PATH?>ms_file/ajaxEnquiry",
				type:"post",
				//async:false,
				data:$("."+form).serialize(),
				beforeSend:function(){
					$(".loader").show();
				},
				success:function(result){
					$(".loader").hide();
					//var res=result.trim();
					var res=JSON.parse(result);
					if(res==-1){
						$("."+msg).html('<div class="alert-invalid-captcha">Invalid Captcha.Please try again.</div>');
						return false;
					}else if(res==1){
						//location.href="<?=SITE_PATH?>thankyou";
						$('.show-getconnect').hide();
						$('.show-thankyou').show();
					}else{
						$("."+msg).html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Something went wrong. Please try again.</div>');
					}
				}
			});
		}
			return false;
	}
	</script>
	
	<script>
	function contactSubmission(form,msg,btnid){
		if($("#"+btnid).hasClass("disabled")==false){
			$.ajax({
				url:"<?=SITE_PATH?>ms_file/ajaxContactSubmit",
				type:"post",
				//async:false,
				data:$("."+form).serialize(),
				beforeSend:function(){
					$(".loader").show();
				},
				success:function(result){
					$(".loader").hide();
					//var res=result.trim();
					var res=JSON.parse(result);
					if(res==-1){
						$("."+msg).html('<div class="alert-invalid-captcha">Invalid Captcha.Please try again.</div>');
						return false;
					}else if(res==1){
						//location.href="<?=SITE_PATH?>thankyou";
						$('.show-getconnect').hide();
						$('.show-thankyou').show();
					}else{
						$("."+msg).html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Something went wrong. Please try again.</div>');
					}
				}
			});
		}
			return false;
	}
	</script>
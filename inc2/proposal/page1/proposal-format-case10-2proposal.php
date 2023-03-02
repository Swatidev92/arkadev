<?php error_reporting(0); 
include("../../../lib/opin.inc.php");

//print_r($_REQUEST);die;
$rsAdmin = $cms->db_query("select * from #_leads where id='".$_REQUEST['order_no']."'");
$arrAdmin = $rsAdmin->fetch_array(); 
@extract($arrAdmin);


$customerPriceQry = $cms->db_query("SELECT * FROM #_customer_price where id=1 ");
$customerPriceArr = $customerPriceQry->fetch_array();

?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Arka</title>
		<style type="text/css">
         /* Client-specific Styles */
         #outlook a {padding:0;} /* Force Outlook to provide a "view in browser" menu link. */
         body{width:100% !important; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; margin:0; padding:0;}
         /* Prevent Webkit and Windows Mobile platforms from changing default font sizes, while not breaking desktop design. */
         .ExternalClass {width:100%;} /* Force Hotmail to display emails at full width */
         .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Force Hotmail to display normal line spacing.  More on that: http://www.emailonacid.com/forum/viewthread/43/ */
         #backgroundTable {margin:0; padding:0; width:100% !important; line-height: 100% !important;}
         img {outline:none; text-decoration:none;border:none; -ms-interpolation-mode: bicubic;}
         a img {border:none;}
         .image_fix {display:block;}
         p {margin: 0px 0px 10px 0px !important;}
         
         table td {border-collapse: collapse; font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #000; text-align:left;line-height: 20px;padding:0px 10px}
         table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; }
         /*a {color: #e95353;text-decoration: none;text-decoration:none!important;}*/
         /*STYLES*/
         table[class=full] { width: 100%; clear: both; }
         
         /*################################################*/
         /*IPAD STYLES*/
         /*################################################*/
         @media only screen and (max-width: 640px) {
         a[href^="tel"], a[href^="sms"] {
         text-decoration: none;
         color: #ffffff; /* or whatever your want */
         pointer-events: none;
         cursor: default;
         }
         .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
         text-decoration: default;
         color: #ffffff !important;
         pointer-events: auto;
         cursor: default;
         }
         table[class=devicewidth] {width: 440px!important;text-align:left!important;}
         table[class=devicewidthinner] {width: 420px!important;text-align:left!important;}
         table[class="sthide"]{display: none!important;}
         img[class="bigimage"]{width: 420px!important;height:219px!important;}
         img[class="col2img"]{width: 420px!important;height:258px!important;}
         img[class="image-banner"]{width: 440px!important;height:106px!important;}
         td[class="menu"]{text-align:center !important; padding: 0 0 10px 0 !important;}
         td[class="logo"]{padding:10px 0 5px 0!important;margin: 0 auto !important;}
         img[class="logo"]{padding:0!important;margin: 0 auto !important;}

         }
         /*##############################################*/
         /*IPHONE STYLES*/
         /*##############################################*/
         @media only screen and (max-width: 480px) {
			 img{width:200px;}
         a[href^="tel"], a[href^="sms"] {
         text-decoration: none;
         color: #ffffff; /* or whatever your want */
         pointer-events: none;
         cursor: default;
         }
         .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
         text-decoration: default;
         color: #ffffff !important; 
         pointer-events: auto;
         cursor: default;
         }
         table[class=devicewidth] {width: 280px!important;text-align:left!important;}
         table[class=devicewidthinner] {width: 260px!important;text-align:center!important;}
         table[class="sthide"]{display: none!important;}
         img[class="bigimage"]{width: 260px!important;height:136px!important;}
         img[class="col2img"]{width: 260px!important;height:160px!important;}
         img[class="image-banner"]{width: 280px!important;height:68px!important;}
         
         }
		</style>
	</head>
	<body style="background:#ffffff">
		<?php include('proposal-format-logo.php');?>
		<div class="block">
			<!-- image + text -->
			<table width="100%" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="bigimage">
				<tbody>
					<tr><td height="5" style="background-color:#000;"></td></tr>
					<tr>
						<td style="width: 100%;">
							<table class="" style="border-collapse: collapse; width: 100%; background-color:#000;" border="0">
								<tbody>
									<tr>
										<td valign="middle" style="text-align:center;font-size:20px;border:none; color:#fff;">
											<?=strtoupper($offerTyeArr[$offer_type])?>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr><td height="5" style="background-color:#000;"></td></tr>
					<tr><td height="20" style="background-color:#fff;"></td></tr>
					<tr>
						<td style="width: 100%;">	
							<table width="100%" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" modulebg="edit" style="background:#ffffff">
								<tbody>
									<tr>
										<td width="33%" style="text-align:center;">
											<table class="email_table" cellpadding="2" style="border-collapse: collapse; width: 100%;" border="0">
												<tbody>
													<tr>
														<td valign="middle" style="text-align:left;font-size:12px;border:none; width:30%;">
															Kundtyp:
														</td>
														<td valign="middle" style="text-align:left;font-size:12px;border:none; width:70%;">
															<?=$proosalCustomerTypeArr[$proposal_customer_type]?>
														</td>
													</tr>
													<tr>
														<td valign="middle" style="text-align:left;font-size:12px;border:none; width:30%;">
															Namn:
														</td>
														<td valign="middle" style="text-align:left;font-size:12px;border:none; width:70%;">
															<?=$customer_name?>
														</td>
													</tr>
													<?php
											if($person2_max_rebate!=''){?>
													<tr>
														<td valign="middle" style="text-align:left;font-size:12px;border:none; padding:15px;">
														Medsökande:
														</td>
														<td valign="middle" style="text-align:left;font-size:12px;border:none; padding:15px;">
														<?=$cms->getSingleResult("SELECT customer_name_ownwer2 FROM #_leads where id=$lead_id ");?>
														</td>
													</tr>
											<?php } ?>
													<tr>
														<td valign="middle" style="text-align:left;font-size:12px;border:none; width:30%;">
															Adress:
														</td>
														<td valign="middle" style="text-align:left;font-size:12px;border:none; max-width:70%;">
															<?=$proposal_address?>
														</td>
													</tr>
												</tbody>
											</table>
										</td>
										<td width="33%" style="text-align:center;">
											<table class="email_table" cellpadding="2" style="border-collapse: collapse; width: 100%;" border="0">
												<tbody>
													<tr>
														<td valign="middle" style="text-align:left;font-size:12px;border:none; width:40%;">
															Offertdatum:
														</td>
														<td valign="middle" style="text-align:left;font-size:12px;border:none; width:60%;">
															<?=$quotation_date?>
														</td>
													</tr>
													<tr>
														<td valign="middle" style="text-align:left;font-size:12px;border:none; width:40%;">
															Offert giltig till:
														</td>
														<td valign="middle" style="text-align:left;font-size:12px;border:none; width:60%;">
															<?=$quotation_valid_till?>
														</td>
													</tr>
													<tr>
														<td valign="middle" style="text-align:left;font-size:12px;border:none; width:40%;">
															Offertnummer:
														</td>
														<td valign="middle" style="text-align:left;font-size:12px;border:none; width:60%;">
															<?=$quotation_number?>
														</td>
													</tr>
												</tbody>
											</table>
										</td>
										<td width="33%" style="text-align:center;">
											<table class="email_table" cellpadding="2" style="border-collapse: collapse; width: 100%;" border="0">
												<tbody>
													<tr>
														<td valign="middle" style="text-align:left;font-size:12px;border:none; width:40%;">
															Vår referens:
														</td>
														<td valign="middle" style="text-align:left;font-size:12px;border:none; width:60%;">
															<?=$reference?>
														</td>
													</tr>
													<tr>
														<td valign="middle" style="text-align:left;font-size:12px;border:none; width:40%;">
															Email:
														</td>
														<td valign="middle" style="text-align:left;font-size:12px;border:none; width:60%;">
															<?=$ref_email?>
														</td>
													</tr>
													<tr>
														<td valign="middle" style="text-align:left;font-size:12px;border:none; width:40%;">
															Phone:
														</td>
														<td valign="middle" style="text-align:left;font-size:12px;border:none; width:60%;">
															<?=$ref_phone?>
														</td>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>
								</tbody>
							</table>										
						</td>
					</tr>
					
					<tr><td height="10"></td></tr>
					<tr><td height="10"></td></tr>
					<tr><td height="15" style="background-color:#eee;"></td></tr>
					<tr>
						<td style="width: 100%;">
							<table class="" style="border-collapse: collapse; width: 100%; background-color:#eee;" border="0">
								<tbody>
									<tr>
										<td valign="middle" style="text-align:center;font-size:30px;border:none; color:#22914f;">
											SUMMERING
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr><td height="15" style="background-color:#eee;"></td></tr>
					<tr><td height="15" style="background-color:#eee;"></td></tr>
					<tr>
						<td>
							<table width="100%" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" modulebg="edit" style="background-color:#eee;">
								<tbody>
									<tr>
										<td style="color:#fff; text-align:right; width:20%;">
											<img src="<?=SITE_PATH?>assets/images/pdf-icons/icon4.png" width="80">
										</td>
										<?php if($proposal_type!=5 && $proposal_type!=6 && $proposal_type!=7){
											$tdwidth = 30;
										}else{
											$tdwidth= 80;
										}
										
										if(($proposal_type==10 || $proposal_type==11) && $number_of_proposal==2){
											$proposal_total_cost = $proposal_total_cost-$battery_price_after_green_deduction;
										}
										?>
										<td style="color:#000; text-align:left; width:<?=$tdwidth?>%;">											
											<p style="font-size:30px; margin:0">
											<?php if($proposal_customer_type==2){
												$total_price_excluding_vat = $total_price_excluding_vat-$charger_price_excluding_vat - $battery_price_excluding_vat;
												echo amount_format_proposal(round($total_price_excluding_vat));
											}else{
												echo amount_format_proposal(round($proposal_total_cost));
											}?> SEK<br><span style="font-size:14px;">Pris efter grönt avdrag</span></p>
										</td>
										<td style=" color:#000; text-align:right; width:20%;">
											<img src="<?=SITE_PATH?>assets/images/pdf-icons/icon2.png" width="80">
										</td>
										<td style=" color:#000; text-align:left;width:30%;">	
											<p style="font-size:30px;"><?=amount_format_proposal($annual_production)?><br><span style="font-size:14px;">Årlig produktion (kWh)</span></p>
										</td>
										<?php if($proposal_type!=5 && $proposal_type!=6 && $proposal_type!=7){?>
										<!--<td style="color:#000; text-align:right; width:20%;">
											<img src="<?=SITE_PATH?>assets/images/pdf-icons/icon3.png" width="80">
										</td>
										<td style="color:#000; text-align:left; width:30%;">
											<p style="font-size:30px; margin:0;"><?=$repayment_period?> år<br><span style="font-size:14px;">Återbetalningstid</span></p>
										</td>-->
										<?php } ?>
									</tr>
									<tr>
									<?php if($proposal_type!=5 && $proposal_type!=6 && $proposal_type!=7){?>
										<!--<td style=" color:#000; text-align:right; width:20%;">
											<img src="<?=SITE_PATH?>assets/images/pdf-icons/icon2.png" width="80">
										</td>
										<td style=" color:#000; text-align:left;width:30%;">	
											<p style="font-size:30px;"><?=amount_format_proposal($annual_production)?><br><span style="font-size:14px;">Årlig produktion (kWh)</span></p>
										</td>
										<td style=" color:#000; text-align:right; width:20%;">
											<img src="<?=SITE_PATH?>assets/images/pdf-icons/icon1.png" width="80">
										</td>
										<td style=" color:#000; text-align:left; width:30%;">
											<p style="font-size:30px;"><?=$solar_effect_warranty?> år<br><span style="font-size:14px;">Garanti</span></p>
										</td>-->
									<?php } ?>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr><td height="10" style="background-color:#eee;"></td></tr>
					<tr><td height="10" style="background-color:#eee;"></td></tr>
					<tr><td height="15" style="background-color:#fff;"></td></tr>
					<tr><td height="15" style="background-color:#fff;"></td></tr>
					<tr>
						<td>
							<table class="item_table item_table_border no-border" width="100%">
								<tbody>
									<tr>
										<td width="50%" style="text-align:center;">										   
										   <table width="100%" align="center" cellspacing="0" cellpadding="3" border="0" class="devicewidth" modulebg="edit" style="background:#fff">
												<tbody>
													<tr>
														<td valign="middle" colspan="2" style="text-align:left;font-size:20px;border:none; color:#22914f;">
															Tekniska uppgifter
														</td>
													</tr>
													<tr><td height="10" style="background-color:#fff;" colspan="2"></td></tr>
													<?php if($proposal_type!=5 && $proposal_type!=6 && $proposal_type!=7){?>
														<tr>
															<td valign="middle" style="text-align:left;font-size:15px;border:none; padding:15px; width:50%;">
																Antal paneler:
															</td>
															<td valign="middle" style="text-align:left;font-size:15px;border:none; padding:15px; width:50%;">
																<?=$panel_count?>
															</td>
														</tr>
														<tr>
															<td valign="middle" style="text-align:left;font-size:15px;border:none; padding:15px; width:50%;">
																Storlek på system (kWp):
															</td>
															<td valign="middle" style="text-align:left;font-size:15px;border:none; padding:15px; width:50%;">
																<?=proposal_decimal_format($system_size/1000)?>
															</td>
														</tr>
														<tr style="padding:10px">
															<td valign="middle" style="text-align:left;font-size:15px;border:none; padding:15px; width:50%;">
																Paneltyp:
															</td>
															<td valign="middle" style="text-align:left;font-size:15px;border:none; padding:15px; width:50%;">
															<?php $ids = getids($panel_model);
																	// print_r($ids);die;
																$panel_model = json_decode($ids['content'],true);
																foreach($panel_model as $cval){
																echo $cval['name']; }
															?> - <?=$panel_wattage?> Wp
															</td>
														</tr>
													<tr>
														<td valign="middle" style="text-align:left;font-size:15px;border:none; padding:15px; width:50%;">
															Färg:
														</td>
														<td valign="middle" style="text-align:left;font-size:15px;border:none; padding:15px; width:50%;">
															<?=$color?>
														</td>
													</tr>
													<tr>
														<td valign="middle" style="text-align:left;font-size:15px;border:none; padding:15px; width:50%;">
															Växelriktare 1:
														</td>
														<td valign="middle" style="text-align:left;font-size:15px;border:none; padding:15px; width:50%;">
															<?=$inverter_brand?>* 
															<!-- (eller en motsvarig) -->
														</td>
													</tr>
													<?php if($inverter_type2){?>
													<tr>
														<td valign="middle" style="text-align:left;font-size:15px;border:none; padding:15px; width:50%;">
															Växelriktare 2:
														</td>
														<td valign="middle" style="text-align:left;font-size:15px;border:none; padding:15px; width:50%;">
															<?=$inverter_brand2?>* 
															<!-- (eller en motsvarig) -->
														</td>
													</tr>
													<?php }else{ $l=$l+1; } ?>
													<?php if($inverter_type3){?>
													<tr>
														<td valign="middle" style="text-align:left;font-size:15px;border:none; padding:15px; width:50%;">
															Växelriktare 3:
														</td>
														<td valign="middle" style="text-align:left;font-size:15px;border:none; padding:15px; width:50%;">
															<?=$inverter_brand3?>* 
															<!-- (eller en motsvarig) -->
														</td>
													</tr>
													<?php }else{ $l=$l+1; } ?>
													<!-- <tr>
														<td valign="middle" style="text-align:left;font-size:15px;border:none; padding:15px; width:50%;">
															Takmaterial:
														</td>
														<td valign="middle" style="text-align:left;font-size:15px;border:none; padding:15px; width:50%;">
															<?=$roofing_material?>
														</td>
													</tr> -->
													<?php } ?>
												</tbody>
											</table>
										</td>
										<td width="50%" style="text-align:center;">										   
										   <table width="100%" align="center" cellspacing="0" cellpadding="3" border="0" class="devicewidth" modulebg="edit" style="background:#fff">
												<tbody>
													<tr>
														<td valign="middle" colspan="2" style="text-align:left;font-size:20px;border:none; color:#22914f;">
															Garantier
														</td>
													</tr>
													<tr><td height="10" style="background-color:#fff;" colspan="2"></td></tr>
													<?php if($proposal_type!=5 && $proposal_type!=6 && $proposal_type!=7){?>
													<tr>
														<td valign="middle" style="text-align:left;font-size:15px;border:none; padding:15px; width:80%;">
															Leverantör solceller:
														</td>
														<td valign="middle" style="text-align:left;font-size:15px;border:none; padding:15px; width:20%;">
															<?=$supplier_solar_cells?>
														</td>
													</tr>
													<tr>
														<td valign="middle" style="text-align:left;font-size:15px;border:none; padding:15px; width:80%;">
															Utfört arbete:
														</td>
														<td valign="middle" style="text-align:left;font-size:15px;border:none; padding:15px; width:20%;">
															<?=$work_performed?> år
														</td>
													</tr>
													<tr>
														<td valign="middle" style="text-align:left;font-size:15px;border:none; padding:15px; width:80%;">
															Produktgaranti solceller:
														</td>
														<td valign="middle" style="text-align:left;font-size:15px;border:none; padding:15px; width:20%;">
															<?=$warranty_solar?> år
														</td>
													</tr>
													<tr>
														<td valign="middle" style="text-align:left;font-size:15px;border:none; padding:15px; width:80%;">
															Produktgaranti växelriktare 1:
														</td>
														<td valign="middle" style="text-align:left;font-size:15px;border:none; padding:15px; width:20%;">
															<?=$warranty_inverter?> år
														</td>
													</tr>
													<?php if($inverter_type2){?>
													<tr>
														<td valign="middle" style="text-align:left;font-size:15px;border:none; padding:15px; width:80%;">
															Produktgaranti växelriktare 2:
														</td>
														<td valign="middle" style="text-align:left;font-size:15px;border:none; padding:15px; width:20%;">
															<?=$warranty_inverter2?> år
														</td>
													</tr>
													<?php } ?>
													<?php if($inverter_type3){?>
													<tr>
														<td valign="middle" style="text-align:left;font-size:15px;border:none; padding:15px; width:80%;">
															Produktgaranti växelriktare 3:
														</td>
														<td valign="middle" style="text-align:left;font-size:15px;border:none; padding:15px; width:20%;">
															<?=$warranty_inverter3?> år
														</td>
													</tr>
													<?php } ?>
													<tr>
														<td valign="middle" style="text-align:left;font-size:15px;border:none; padding:15px; width:80%;">
															Produktgaranti montagesystem:
														</td>
														<td valign="middle" style="text-align:left;font-size:15px;border:none; padding:15px; width:20%;">
															<?=$product_guarantee_mounting_system?> år
														</td>
													</tr>
													<tr>
														<td valign="middle" style="text-align:left;font-size:15px;border:none; padding:15px; width:80%;">
															Effektgaranti solceller efter <?=$solar_effect_warranty?> år:
														</td>
														<td valign="middle" style="text-align:left;font-size:15px;border:none; padding:15px; width:20%;">
															<?=proposal_decimal_format($guarantee_after_30_years)?>%
														</td>
													</tr>
													<?php } ?>
												</tbody>
											</table>
										</td>
									</tr>
									<tr>
									<?php //$j=$l-1; for($k=0;$k<$j;$k++){ ?><br><?php //}?>
									<td style="font-size:8px;line-height: 1;">*På grund av omvärldsläget kan denna produkt behöva ersättas mot en likvärdig. I de fall den behöver ersättas kommer projektledare kontakta dig innan installation.</td>
								</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr><td></td></tr>					
				</tbody>
			</table>
		</div>
	</body>
</html>
<?php error_reporting(0); 
include("../lib/opin.inc.php");

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
					<tr><td height="10" style="background-color:#000;"></td></tr>
					<tr>
						<td style="width: 100%;">
							<table class="" style="border-collapse: collapse; width: 100%; background-color:#000;" border="0">
								<tbody>
									<tr>
										<td valign="middle" style="text-align:center;font-size:30px;border:none; color:#fff;">
											<?=strtoupper($offerTyeArr[$offer_type])?> FÖR SOLCELLANLÄGGNING
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr><td height="10" style="background-color:#000;"></td></tr>
					<tr><td height="20" style="background-color:#fff;"></td></tr>
					<tr>
						<td style="width: 100%;">	
							<table width="100%" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" modulebg="edit" style="background:#ffffff">
								<tbody>
									<tr>
										<td width="33.33%" style="text-align:center;">
											<table class="email_table" style="border-collapse: collapse; width: 100%;" border="0">
												<tbody>
													<tr>
														<td valign="middle" style="text-align:left;font-size:14px;border:none;">
															Kund typ:
														</td>
														<td valign="middle" style="text-align:left;font-size:14px;border:none;">
															<?=$proosalCustomerTypeArr[$proposal_customer_type]?>
														</td>
													</tr>
													<tr>
														<td valign="middle" style="text-align:left;font-size:14px;border:none; padding:15px;">
															Namn:
														</td>
														<td valign="middle" style="text-align:left;font-size:14px;border:none; padding:15px;">
															<?=$customer_name?>
														</td>
													</tr>
													<tr>
														<td valign="middle" style="text-align:left;font-size:14px;border:none; padding:15px; word-wrap: break-word">
															Adress:
														</td>
														<td valign="middle" style="text-align:left;font-size:14px;border:none; padding:15px;">
															<?=$proposal_address?>
														</td>
													</tr>
												</tbody>
											</table>
										</td>
										<td width="33.33%" style="text-align:center;">
											<table class="email_table" style="border-collapse: collapse; width: 100%;" border="0">
												<tbody>
													<tr>
														<td valign="middle" style="text-align:left;font-size:14px;border:none; ">
															Offertdatum:
														</td>
														<td valign="middle" style="text-align:left;font-size:14px;border:none;">
															<?=$quotation_date?>
														</td>
													</tr>
													<tr>
														<td valign="middle" style="text-align:left;font-size:14px;border:none; padding:15px;">
															Offert giltig till:
														</td>
														<td valign="middle" style="text-align:left;font-size:14px;border:none; padding:15px;">
															<?=$quotation_valid_till?>
														</td>
													</tr>
													<tr>
														<td valign="middle" style="text-align:left;font-size:14px;border:none; padding:15px;">
															Offert nummer:
														</td>
														<td valign="middle" style="text-align:left;font-size:14px;border:none; padding:15px;">
															<?=$quotation_number?>
														</td>
													</tr>
												</tbody>
											</table>
										</td>
										<td width="33.33%" style="text-align:center;">
											<table class="email_table" style="border-collapse: collapse; width: 100%;" border="0">
												<tbody>
													<tr>
														<td valign="middle" style="text-align:left;font-size:14px;border:none; padding:15px;">
															Vår referens:
														</td>
														<td valign="middle" style="text-align:left;font-size:14px;border:none; padding:15px;">
															<?=$reference?>
														</td>
													</tr>
													<tr>
														<td valign="middle" style="text-align:left;font-size:14px;border:none; padding:15px;">
															Email:
														</td>
														<td valign="middle" style="text-align:left;font-size:14px;border:none; padding:15px;">
															<?=$email?>
														</td>
													</tr>
													<tr>
														<td valign="middle" style="text-align:left;font-size:14px;border:none; padding:15px;">
															Phone:
														</td>
														<td valign="middle" style="text-align:left;font-size:14px;border:none; padding:15px;">
															<?=$phone?>
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
					<tr>
						<td>
							<table width="100%" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" modulebg="edit" style="background-color:#eee;">
								<tbody>
									<tr>
										<td style="color:#fff; text-align:left; width:20%;">
											<img src="<?=SITE_PATH?>assets/images/pdf-icons/icon4.png" width="80">
										</td>
										<td style="color:#000; text-align:left; width:30%;">											
											<p style="font-size:30px; margin:0"><?=$price_after_green_deduction?> SEK<br><span style="font-size:14px;">Pris efter grönt avdrag</span></p>
										</td>
										<td style="color:#000; text-align:left; width:20%;">
											<img src="<?=SITE_PATH?>assets/images/pdf-icons/icon3.png" width="80">
										</td>
										<td style="color:#000; text-align:left; width:30%;">
											<p style="font-size:30px; margin:0;"><?=$repayment_period?> år<br><span style="font-size:14px;">Återbetalningstid</span></p>
										</td>
									</tr>
									<tr>
										<td style=" color:#000; text-align:left; width:20%;">
											<img src="<?=SITE_PATH?>assets/images/pdf-icons/icon2.png" width="80">
										</td>
										<td style=" color:#000; text-align:left;width:30%;">											
											<p style="font-size:30px;"><?=$annual_production?><br><span style="font-size:14px;">Årlig produktion (kWh)</span></p>
										</td>
										<td style=" color:#000; text-align:left; width:20%;">
											<img src="<?=SITE_PATH?>assets/images/pdf-icons/icon1.png" width="80">
										</td>
										<td style=" color:#000; text-align:left; width:30%;">
											<p style="font-size:30px;"><?=$warranty_solar?> år<br><span style="font-size:14px;">Garanti</span></p>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr><td height="10" style="background-color:#eee;"></td></tr>
					<tr><td height="15" style="background-color:#fff;"></td></tr>
					<tr>
						<td>
							<table width="100%" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" modulebg="edit" style="background:#ffffff">
								<tbody>
									<tr>
										<td width="50%" style="text-align:center;">										   
										   <table width="100%" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" modulebg="edit" style="background:#fff">
												<tbody>
													<tr>
														<td valign="middle" colspan="2" style="text-align:center;font-size:30px;border:none; color:#22914f;">
															Tekniska uppgifter
														</td>
													</tr>
													<tr><td height="10" style="background-color:#fff;" colspan="2"></td></tr>
													<tr>
														<td valign="middle" style="text-align:center;font-size:16px;border:none; padding:15px; width:60%;">
															Paneltyp:
														</td>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:40%;">
															<?=$panel_model?> - <?=$panel_wattage?> Wp
														</td>
													</tr>
													<tr><td height="2" colspan="2"></td></tr>
													<tr>
														<td valign="middle" style="text-align:center;font-size:16px;border:none; padding:15px; width:60%;">
															Storlek på system (kW):
														</td>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:40%;">
															<?=$system_size?> kWp
														</td>
													</tr>
													<tr><td height="2" colspan="2"></td></tr>
													<tr>
														<td valign="middle" style="text-align:center;font-size:16px;border:none; padding:15px; width:60%;">
															Antal paneler:
														</td>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:40%;">
															<?=$panel_count?>
														</td>
													</tr>
													<tr><td height="2" colspan="2"></td></tr>
													<tr>
														<td valign="middle" style="text-align:center;font-size:16px;border:none; padding:15px; width:60%;">
															Färg:
														</td>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:40%;">
															<?=$color?>
														</td>
													</tr>
													<tr><td height="2" colspan="2"></td></tr>
													<tr>
														<td valign="middle" style="text-align:center;font-size:16px;border:none; padding:15px; width:60%;">
															Växelriktare:
														</td>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:40%;">
															<?=$inverter_type?>
														</td>
													</tr>
													<tr><td height="2" colspan="2"></td></tr>
													<tr>
														<td valign="middle" style="text-align:center;font-size:16px;border:none; padding:15px; width:60%;">
															Antal växelriktare:
														</td>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:40%;">
															1
														</td>
													</tr>
													<tr><td height="2" colspan="2"></td></tr>
													<tr>
														<td valign="middle" style="text-align:center;font-size:16px;border:none; padding:15px; width:60%;">
															Takmaterial:
														</td>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:40%;">
															<?=$roofing_material?>
														</td>
													</tr>
													<tr><td height="2" colspan="2"></td></tr>
													<tr>
														<td valign="middle" style="text-align:center;font-size:16px;border:none; padding:15px; width:60%;">
															Billaddare:
														</td>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:40%;">
															<?=$charger_name?>
														</td>
													</tr>
												</tbody>
											</table>
										</td>
										<td width="50%" style="text-align:center;">										   
										   <table width="100%" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" modulebg="edit" style="background:#fff">
												<tbody>
													<tr>
														<td valign="middle" colspan="2" style="text-align:center;font-size:30px;border:none; color:#22914f;">
															Garantier
														</td>
													</tr>
													<tr><td height="10" style="background-color:#fff;" colspan="2"></td></tr>
													<tr>
														<td valign="middle" style="text-align:center;font-size:16px;border:none; padding:15px; width:80%;">
															Leverantör solceller:
														</td>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:20%;">
															<?=$supplier_solar_cells?>
														</td>
													</tr>
													<tr><td height="2" colspan="2"></td></tr>
													<tr>
														<td valign="middle" style="text-align:center;font-size:16px;border:none; padding:15px; width:80%;">
															Utfört arbete:
														</td>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:20%;">
															<?=$work_performed?> år
														</td>
													</tr>
													<tr><td height="2" colspan="2"></td></tr>
													<tr>
														<td valign="middle" style="text-align:center;font-size:16px;border:none; padding:15px; width:80%;">
															Produktgaranti solceller:
														</td>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:20%;">
															<?=$warranty_solar?> år
														</td>
													</tr>
													<tr><td height="2" colspan="2"></td></tr>
													<tr>
														<td valign="middle" style="text-align:center;font-size:16px;border:none; padding:15px; width:80%;">
															Produktgaranti växelriktare:
														</td>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:20%;">
															<?=$warranty_inverter?> år
														</td>
													</tr>
													<tr><td height="2" colspan="2"></td></tr>
													<tr>
														<td valign="middle" style="text-align:center;font-size:16px;border:none; padding:15px; width:80%;">
															Produktgaranti montagesystem:
														</td>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:20%;">
															<?=$product_guarantee_mounting_system?> år
														</td>
													</tr>
													<tr><td height="2" colspan="2"></td></tr>
													<tr>
														<td valign="middle" style="text-align:center;font-size:16px;border:none; padding:15px; width:80%;">
															Effektgaranti solceller efter <?=$warranty_solar?> år:
														</td>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:20%;">
															<?=$guarantee_after_30_years?>%
														</td>
													</tr>
													<tr><td height="2" colspan="2"></td></tr>
													<tr>
														<td valign="middle" style="text-align:center;font-size:16px;border:none; padding:15px; width:80%;">
															Produktgaranti billaddare:
														</td>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:20%;">
															<?=$charger_warranty?> år
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
					<tr><td height="50"></td></tr>
					
					<tr><td height="10" style="background-color:#eee;"></td></tr>
					<tr>
						<td style="width: 100%;">
							<table class="" style="border-collapse: collapse; width: 100%; background-color:#eee;" border="0">
								<tbody>
									<tr>
										<td valign="middle" style="text-align:left;font-size:30px;border:none; color:#000;">
											Sammanställning pris
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr><td height="10" style="background-color:#eee;"></td></tr>
					<tr><td height="15" style="background-color:#fff;"></td></tr>
					
					<tr>
						<td>
							<table width="100%" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" modulebg="edit" style="background:#fff">
								<tbody>
									<tr>
										<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:70%;">
											Pris exklusive moms:
										</td>
										<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:30%;">
											<?=$price_excluding_vat?> kr
										</td>
									</tr>
									<tr><td height="1" colspan="2"></td></tr>
									<tr>
										<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px;">
											Pris inklusive moms:
										</td>
										<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px;">
											<?=$price_including_vat?> kr
										</td>
									</tr>
									<tr><td height="1" colspan="2"></td></tr>
									<tr>
										<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px;">
											<b>Pris solcellsanläggning efter 19,4% Grönt Avdrag*</b>
										</td>
										<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px;">
											<b><?=$price_after_green_deduction?> kr</b>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr><td height="10" style="background-color:#fff;"></td></tr>
					<tr>
						<td>
							<table width="100%" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" modulebg="edit" style="background:#ffffff">
								<tbody>
									<tr>
										<td style="color:#fff; text-align:left;">
										   <p style="color:#22914f">*Grönt avdrag är 20% av totalbelopp men omfattar enbart material & arbetskostnader. Schablon är satt av Skatteverket till 19,4%. För mer  nformation om bidraget och dess villkor, läs mer på www.skatteverket.se</p>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr><td height="40" style="background-color:#fff;"></td></tr>
					<tr><td height="10" style="background-color:#eee;"></td></tr>
					<tr>
						<td style="width: 100%;">
							<table class="" style="border-collapse: collapse; width: 100%; background-color:#eee;" border="0">
								<tbody>
									<tr>
										<td valign="middle" style="text-align:left;font-size:30px;border:none; color:#000;">
											Uppskattad produktion och förutsättningar
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr><td height="10" style="background-color:#eee;"></td></tr>
					<tr><td height="50" style="background-color:#fff;"></td></tr>	
					<tr>
						<td>
							<table width="100%" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" modulebg="edit" style="background:#ffffff">
								<tbody>
									<tr>
										<td width="65%" style="text-align:center;">										   
										   <table width="100%" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" modulebg="edit" style="background:#fff">
												<tbody>
													<tr>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:70%;">
															Årlig elförbrukning i fastighet:
														</td>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:30%;">
															<?=$annual_electricity_consumption?> kWh
														</td>
													</tr>
													<tr><td height="1" colspan="2"></td></tr>
													<tr>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:70%;">
															Uppskattad årlig produktion solel:
														</td>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:30%;">
															<?=$annual_production?> kWh
														</td>
													</tr>
													<tr><td height="1" colspan="2"></td></tr>
													<tr>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:70%;">
															Uppskattad årlig besparing av solel:
														</td>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:30%;">
															<?=amount_format_proposal(round($estimated_annual_saving))?> kr
														</td>
													</tr>
													<tr><td height="1" colspan="2"></td></tr>
													<tr>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:70%;">
															Egenanvändning av solel:
														</td>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:30%;">
															<?=$self_use_solar?>%
														</td>
													</tr>
												</tbody>
											</table>
										</td>
										<td width="35%" style="text-align:center;">										   
										   <table width="100%" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" modulebg="edit" style="background:#fff">
												<tbody>
													<tr>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:80%;">
															Standard soltimmar/år:
														</td>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:20%;">
															<?=$sunshine_hours?>
														</td>
													</tr>
													<tr><td height="1" colspan="2"></td></tr>
													<tr>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:80%;">
															Vinkel på paneler:
														</td>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:20%;">
															<?=$panels_angles?>
														</td>
													</tr>
													<tr><td height="1" colspan="2"></td></tr>
													<tr>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:80%;">
															Riktning från söder:
														</td>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:20%;">
															<?=$direction_from_south?>
														</td>
													</tr>
													<tr><td height="1" colspan="2"></td></tr>
													<tr>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:80%;">
															Förluster från skuggning:
														</td>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:20%;">
															<?=$losses_from_shading?>%
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
					<tr><td height="50" style="background-color:#fff;"></td></tr>
					<tr><td height="10" style="background-color:#eee;"></td></tr>
					<tr>
						<td style="width: 100%;">
							<table class="" style="border-collapse: collapse; width: 100%; background-color:#eee;" border="0">
								<tbody>
									<tr>
										<td valign="middle" style="text-align:left;font-size:30px;border:none; color:#000;">
											Ingående delar i nyckelfärdig solcellsanläggning
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr><td height="10" style="background-color:#eee;"></td></tr>
					<tr><td height="40" style="background-color:#fff;"></td></tr>	
					<tr>
						<td>
							<table width="100%" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" modulebg="edit" style="background:#ffffff">
								<tbody>
									<tr>
										<td style="color:#000; text-align:left;">
											<ul style="font-size:16px;">
												<li>Komplett material och projektering av anläggning</li>
												<li>Leverans av material samt montage av solpaneler av utbildad personal</li>
												<li>Elinstallation utav Arka Energys egna behöriga elektriker eller dess samarbetspartner</li>
												<li>Eventuellt montage av byggnadsställning om så krävs för säker installation</li>
												<li>För- och efteranmälan hos nätägare samt eventuell bygglovshandledning</li>
												<li>Övervakningstjänst för att följa produktionen via mobil eller dator</li>
											</ul>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr><td height="60" style="background-color:#fff;"></td></tr>
					<tr><td height="10" style="background-color:#000;"></td></tr>
					<tr>
						<td style="width: 100%;">
							<table class="" style="border-collapse: collapse; width: 100%; background-color:#000;" border="0">
								<tbody>
									<tr>
										<td valign="middle" style="text-align:left;font-size:30px;border:none; color:#fff;">
											DIMENSIONERING
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr><td height="10" style="background-color:#000;"></td></tr>
					<tr><td height="10" style="background-color:#fff;"></td></tr>
					<tr>
						<td>
							<table width="100%" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" modulebg="edit" style="background:#fff">
								<tbody>
									<tr>
										<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px;">
											Systembeskrivning:
										</td>
										<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px;">
											<?=$proposal_address?>   
										</td>
									</tr>
									<tr>
										<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px;">
											Antal paneler:
										</td>
										<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px;">
											<?=$panel_count?>
										</td>
									</tr>
									<tr>
										<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px;">
											Antal växelriktare:
										</td>
										<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px;">
											1   
										</td>
									</tr>
									<tr>
										<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px;">
											Panel-area:
										</td>
										<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px;">
											<?=$panel_area_dimension?>  
										</td>
									</tr>
									
									<tr><td height="10" colspan="2" style="background-color:#fff;"></td></tr>
									<tr>
										<td valign="middle" colspan="2" style="text-align:left;font-size:16px;border:none; padding:15px;">
											Anläggningen kopplas in i fastighetens el central och monteras enligt nedanstående bild.
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr><td height="20"></td></tr>
					<?php if($installation_image){?>
					<tr>
						<td>
							<table width="100%" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" modulebg="edit" style="background:#ffffff">
								<tbody>
									<tr>
										<td style="color:#fff; text-align:center;">
										   <img src="<?=SITE_PATH.UPLOAD_FILES_PTH.'/'.UP_FILES_PROPOSAL.'/'.$installation_image?>" width="400">
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr><td height="20" style="background-color:#fff;"></td></tr>
					<?php } ?>
					<tr>
						<td style="width: 100%;">
							<table class="" style="border-collapse: collapse; width: 100%; background-color:#fff;" border="0">
								<tbody>
									<tr>
										<td valign="middle" style="text-align:left;font-size:30px;border:none; color:#22914f;">
											UPPSKATTAD PRODUKTIONSBERÄKNING
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr><td height="10" style="background-color:#fff;"></td></tr>
					<tr><td height="10" style="background-color:#fff;"></td></tr>
					<?php //if($chart_image){?>
					<tr>
						<td>
							<table width="100%" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" modulebg="edit" style="background:#ffffff">
								<tbody>
									<tr>
										<td style="text-align:center;">
										    <!--<img src="https://arkaenergy.se/uploaded_files/proposal/chart1634039505.svg" width="400">-->
										    <img src="<?=SITE_PATH.UPLOAD_FILES_PTH.'/'.UP_FILES_PROPOSAL.'/'.$chart_image?>" width="400">
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<?php //} ?>
					<tr><td height="10" style="background-color:#fff;"></td></tr>
					<tr><td height="10" style="background-color:#000;"></td></tr>
					<tr>
						<td style="width: 100%;">
							<table class="" style="border-collapse: collapse; width: 100%; background-color:#000;" border="0">
								<tbody>
									<tr>
										<td valign="middle" style="text-align:center;font-size:30px;border:none; color:#fff;">
											BESPARINGSKALKYL
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr><td height="10" style="background-color:#000;"></td></tr>
					<tr>
						<td>
							<table width="100%" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" modulebg="edit" style="background:#fff">
								<tbody>
									<tr>
										<td style="text-align:left;">
										   <p>Besparingskalkylen nedan baseras på priset efter Grönt Avdrag. I kalkylen är era förutsättningar med riktning, vinkel, solläge och skuggor medräknade, samt en effektförlust på 2% i kablar och växelriktare. Kalkylen ska ses som en uppskattning och är ingen garanti för produktion eller besparing.</p>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr><td height="30"></td></tr>					
					<tr>
						<td>
							<table width="100%" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" modulebg="edit" style="background:#ffffff">
								<tbody>
									<tr>
										<td width="50%" style="text-align:center;">	
											<table width="100%" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" modulebg="edit" style="background:#fff">
												<tbody>
													<tr>
														<td valign="middle" colspan="2" style="text-align:center;font-size:20px;border:none; color:#22914f;">
															Produktion
														</td>
													</tr>
													<tr><td height="10" style="background-color:#fff;" colspan="2"></td></tr>
													<tr>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:80%;">
															Årlig inflationsjustering på elpris:
														</td>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:20%;">
															<?=$annual_inflation?>%
														</td>
													</tr>
													<tr>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:80%;">
															Realprisökning på rörligt elpris:
														</td>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:20%;">
															<?=$price_increase?>%
														</td>
													</tr>
													<tr>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:80%;">
															Årlig effektförsämring i procent:
														</td>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:20%;">
															<?=$annual_deterioration_percent?>%
														</td>
													</tr>
													<tr>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:80%;">
															Effektförlust (växelrikt, kablar):
														</td>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:20%;">
															<?=$power_loss?>%
														</td>
													</tr>
													<tr>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:80%;">
															Återbetalningstid med grönt avdrag:
														</td>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:20%;">
															<?=$repayment_period?> år
														</td>
													</tr>
												</tbody>
											</table>
										</td>
										<td width="50%" style="text-align:center;">
											<table width="100%" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" modulebg="edit" style="background:#fff">
												<tbody>
													<tr>
														<td valign="middle" colspan="2" style="text-align:center;font-size:20px;border:none; color:#22914f;">
															Elpris baserad på egenkonsumtion
														</td>
													</tr>
													<tr><td height="10" style="background-color:#fff;" colspan="2"></td></tr>
													<tr>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:60%;">
															Egenkonsumtion* (<?=$self_use_solar?>%):
														</td>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:40%;">
															<?=$own_consumption?> kr/kWh
														</td>
													</tr>
													<tr>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:60%;">
															Såld el** (<?=(100-$self_use_solar)?>%):
														</td>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:40%;">
															<?=$sold_electricity?> kr/kWh
														</td>
													</tr>
													<tr>
														<td colspan="2">	</td>
													</tr>
													<tr>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:60%;">
															Totalt viktat elpris:
														</td>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:40%;">
															<?=$total_weighted_electricity_price?> kr/kWh
														</td>
													</tr>
													<tr><td colspan="2"></td></tr>
												</tbody>
											</table>
										</td>										
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr><td height="5"></td></tr>
					<tr>
						<td>
							<table width="100%" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" modulebg="edit" style="background:#fff">
								<tbody>
									<tr>
										<td style="text-align:left;">										  
											<p>*Består av rörligt elpris, skatt, nätöverföring och moms<br>
											**Består av elpris, skattereduktion och nätnytta</p>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr><td height="20"></td></tr>
					<tr>
						<td>
							<?=$payback_table?>
						</td>
					</tr>
					<tr><td height="50" style="background-color:#fff;"></td></tr>
					<tr><td height="10" style="background-color:#000;"></td></tr>
					<tr>
						<td style="width: 100%;">
							<table class="" style="border-collapse: collapse; width: 100%; background-color:#000;" border="0">
								<tbody>
									<tr>
										<td valign="middle" style="text-align:center;font-size:30px;border:none; color:#fff;">
											SAMMANSTÄLLNING BUDGET OFFERT
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr><td height="10" style="background-color:#000;"></td></tr>
					<tr><td height="10" style="background-color:#fff;"></td></tr>
					
					<tr>
						<td>
							<table width="100%" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" modulebg="edit" style="background:#fff">
								<tbody>
									<tr>
										<td style="text-align:left;">Utfärdad av: <?=$issued_by?></td>
										<td style="text-align:left;">Mottagare: <?=$customer_name?> <?=$proposal_address?></td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr><td height="20" style="background-color:#fff;"></td></tr>
					<tr><td height="10" style="background-color:#eee;"></td></tr>
					<tr>
						<td style="width: 100%;">
							<table width="100%" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" modulebg="edit" style="background-color:#eee">
								<tbody>
									<tr>
										<td width="25%" valign="middle" style="text-align:center;font-size:20px;border:none; color:#000;">
											Betalningsvillkor:
										</td>
										<td width="20%" valign="middle" style="text-align:center;font-size:20px;border:none; color:#000;">
											10 dagar netto
										</td>
										<td width="55%" valign="middle" style="text-align:center;font-size:20px;border:none; color:#000;">
											Nyckelfärdig solcellsanläggning
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr><td height="10" style="background-color:#eee;"></td></tr>
					<tr><td height="10" style="background-color:#fff;"></td></tr>
				
					<tr>
						<td>
							<table width="100%" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" modulebg="edit" style="background:#fff">
								<tbody>
									<tr>
										<td style="text-align:left;"><?=$payment_at_ordering?>% faktureras vid beställning:</td>
										<td style="text-align:left;"><?=$system_size?> kW</td>
									</tr>
									<tr>
										<td style="text-align:left;"><?=(100-$payment_at_ordering)?>% faktureras vid funktionstestad anläggning</td>
										<td style="text-align:left;"></td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>					
					
					<tr><td height="20" style="background-color:#fff;"></td></tr>
					<tr><td height="5" style="background-color:#eee;"></td></tr>
					<tr>
						<td style="width: 100%;">
							<table width="100%" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" modulebg="edit" style="background-color:#eee">
								<tbody>
									<tr>
										<td width="33.33%" valign="middle" style="text-align:left;font-size:20px;border:none; color:#000;">
											Ingående material
										</td>
										<td width="33.33%" valign="middle" style="text-align:center;font-size:20px;border:none; color:#000;">
											Antal
										</td>
										<td width="33.33%" valign="middle" style="text-align:center;font-size:20px;border:none; color:#000;">
											Enhet
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr><td height="5" style="background-color:#eee;"></td></tr>
					<tr><td height="5" style="background-color:#fff;"></td></tr>
					<tr>
						<td>
							<table width="100%" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" modulebg="edit" style="background:#fff">
								<tbody>
									<tr>
										<td style="text-align:left;">Solpaneler: <?=$panel_model?> <?=$panel_wattage?>W</td>
										<td style="text-align:center;"><?=$panel_count?></td>
										<td style="text-align:center;">st</td>
									</tr>
									<tr>
										<td style="text-align:left;">Växelriktare:	<?=$inverter_type?></td>
										<td style="text-align:center;"><?=$inverter_count?></td>
										<td style="text-align:center;">st</td>
									</tr>
									<tr>
										<td style="text-align:left;">Monteringssystem</td>
										<td style="text-align:center;"><?=$mounting_system?></td>
										<td style="text-align:center;">st</td>
									</tr>
									<tr>
										<td style="text-align:left;">Billaddare <?=$charger_name?></td>
										<td style="text-align:center;">1</td>
										<td style="text-align:center;">st</td>
									</tr>
									<tr>
										<td style="text-align:left;">Likströmsbrytare (ingår i växelriktare)</td>
										<td style="text-align:center;"><?=$dc_switch?></td>
										<td style="text-align:center;">st</td>
									</tr>
									<tr>
										<td style="text-align:left;">Växelströmsbrytare</td>
										<td style="text-align:center;"><?=$ac_switch?></td>
										<td style="text-align:center;">st</td>
									</tr>
									<tr>
										<td style="text-align:left;">Elkapsling och säkringar</td>
										<td style="text-align:center;"><?=$electrical_enclosure_fuses?></td>
										<td style="text-align:center;">st</td>
									</tr>
									<tr>
										<td style="text-align:left;">Kablar och kontaktdon</td>
										<td style="text-align:center;">Efter behov</td>
										<td style="text-align:center;"></td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>					
					<tr><td height="20" style="background-color:#fff;"></td></tr>
					<tr>
						<td style="width: 100%;">
							<table class="" style="border-collapse: collapse; width: 100%; background-color:#fff;" border="0">
								<tbody>
									<tr>
										<td valign="middle" style="text-align:left;font-size:30px;border:none; color:#000;">
											Ingående moment
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr><td height="20" style="background-color:#fff;"></td></tr>
					<tr>
						<td>
							<table width="100%" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" modulebg="edit" style="background:#ffffff">
								<tbody>
									<tr>
										<td style="color:#000; text-align:left;">
											<ul style="font-size:14px;">
												<li>Komplett installation och transport till mottagaradress</li>
												<li>Ställningsmontage och taksäkerhet enligt Arbetsmiljöverkets föreskrifter</li>
												<li>Projektering och dimensionering av anläggning</li>
												<li>Bygglovshandledning efter behov (ifyllnad av nödvändiga dokument)</li>
												<li>För- och färdiganmälan till nätägare</li>
												<li>Eventuell uppkoppling av växelriktare mot internet för övervakning av produktion*</li>
											</ul>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr><td height="20" style="background-color:#fff;"></td></tr>
					
					<tr>
						<td>
							<table width="100%" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" modulebg="edit" style="background:#fff">
								<tbody>
									<tr>
										<td style="text-align:left;">
											Pris solcellsanläggning exklusive moms:
										</td>
										<td style="text-align:left;">
											<?=$price_excluding_vat?> kr
										</td>
									</tr>
									<tr>
										<td style="text-align:left;">
											Pris solcellsanläggning inklusive moms:
										</td>
										<td style="text-align:left;">
											<?=$price_including_vat?> kr
										</td>
									</tr>
									<tr>
										<td style="text-align:left;">
											<b>Pris solcellsanläggning med grönt avdrag**:</b>
										</td>
										<td style="text-align:left;">
											<b><?=$price_after_green_deduction?> kr</b>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr><td height="5"></td></tr>
					
					<?php if($_POST['charger_name']!=''){?>
					<tr>
						<td>
							<table width="100%" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" modulebg="edit" style="background:#fff">
								<tbody>
									<tr>
										<td style="text-align:left;">
											Pris billaddare exklusive moms:
										</td>
										<td style="text-align:left;">
											<?=$charger_price_excluding_vat?> kr
										</td>
									</tr>
									<tr>
										<td style="text-align:left;">
											Pris billaddare inklusive moms:
										</td>
										<td style="text-align:left;">
											<?=$charger_price_including_vat?> kr
										</td>
									</tr>
									<tr>
										<td style="text-align:left;">
											<b>Pris billaddare med grönt avdrag**:</b>
										</td>
										<td style="text-align:left;">
											<b><?=$charger_price_after_green_deduction?> kr</b>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr><td height="5"></td></tr>
					<?php } ?>
					
					<?php if($_POST['battery_name']!=''){?>
					<tr>
						<td>
							<table width="100%" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" modulebg="edit" style="background:#fff">
								<tbody>
									<tr>
										<td style="text-align:left;">
											Pris batteri exklusive moms:
										</td>
										<td style="text-align:left;">
											<?=$battery_price_excluding_vat?> kr
										</td>
									</tr>
									<tr>
										<td style="text-align:left;">
											Pris batteri inklusive moms:
										</td>
										<td style="text-align:left;">
											<?=$battery_price_including_vat?> kr
										</td>
									</tr>
									<tr>
										<td style="text-align:left;">
											<b>Pris batteri med grönt avdrag**:</b>
										</td>
										<td style="text-align:left;">
											<b><?=$battery_price_after_green_deduction?> kr</b>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr><td height="5"></td></tr>
					<?php } ?>
					
					<tr>
						<td>
							<table width="100%" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" modulebg="edit" style="background:#fff">
								<tbody>
									<tr>
										<td style="text-align:left;">										  
											*Förutsätterinternetuppkoppling till växelriktare i form av framdragen internetkabel.
										</td>
									</tr>
									<tr>
										<td>
											**Grönt avdrag är 20% av totalbelopp menomfattar enbart material & arbetskostnader. Schablon är satt av Skatteverket till 19,4%.För mer information om bidraget och dess villkor,läs mer på www.skatteverket.se
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr><td height="50"></td></tr>
					<tr>
						<td>
							<table width="100%" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" modulebg="edit" style="background:#fff">
								<tbody>
									<tr>
										<td width="100%" style="text-align:left;font-size:20px;border:none; color:#22914f;">
											ARKA ENERGY ÄR TOTALENTREPRENÖR
										</td>
									</tr>
									<tr>
										<td width="100%" style="font-size:16px;">
											I projekt där Arka Energy är totalentreprenör för en nyckelfärdig anläggning står Arka Energy som byggherre för projektet. Det innebär att Arka Energy har ansvar för att gällande lagar följs samt att arbetsmiljö efterföljs enligt gällande föreskrifter.
										</td>
									</tr>
									<tr><td height="10"></td></tr>
									<tr>
										<td width="100%" style="text-align:left;font-size:20px;border:none; color:#22914f;">
											REGELVERK OCH ELBEHÖRIGHET
										</td>
									</tr>
									<tr>
										<td width="100%" style="font-size:16px;">
											Installationen följer Boverkets Byggregler gällande taksäkerhet. Eventuella hål tätas noga med silikon/tjära/tätningsbricka vid eventuell takgenomföring. Elinstallationen följer Elsäkerhetsverkets föreskrifter och Energimyndighetens installationsguide för "Nätanslutna Solcellsanläggningar". Samtliga produkter är CE-märkta och leveransvillkor enligt Konsumentköplagen.
										</td>
									</tr>
									
									<tr><td width="100%" height="10"></td></tr>
									<tr>
										<td width="100%" style="text-align:left;font-size:20px;border:none; color:#22914f;">
											FÖRSÄKRINGAR
										</td>
									</tr>
									<tr>
										<td width="100%" style="font-size:16px;">
											Arka Energy har erforderliga försäkringar som krävs för projektet.
										</td>
									</tr>
									
									<tr><td width="100%" height="10"></td></tr>
									<tr>
										<td width="100%" style="text-align:left;font-size:20px;border:none; color:#22914f;">
											SNÖ- OCH VINDLAST
										</td>
									</tr>
									<tr>
										<td width="100%" style="font-size:16px;">
											Antal infästningar i fastigheten beräknas för varje projekt och dimensioneras efter normenliga snö- och vindlastberäkningar för relevant snö zon och vinkel på taket. Uppskattad vikt per kvm för anläggningen uppgår till max 14kg/kvm. Fastighetsägaren ansvarar för att fastigheten håller för den tillförda vikten.
										</td>
									</tr>
									
									<tr>
										<td valign="middle" style="text-align:left;font-size:20px;border:none; color:#22914f;">
											UPPSKATTAD PRODUKTION
										</td>
									</tr>
									<tr>
										<td style="font-size:16px;">
											Angivna uppgifter i denna offert gällande årlig produktion, besparing och återbetalningstid skall betraktas som uppskattningar baserade på givna uppgifter och är ingen garanti på utfall. Variationer från år till år kommer att förekomma.
										</td>
									</tr>
									<tr><td height="10"></td></tr>
									
									<tr>
										<td valign="middle" style="text-align:left;font-size:20px;border:none; color:#22914f;">
											INTERNETUPPKOPPLING
										</td>
									</tr>
									<tr>
										<td style="font-size:16px;">
											Uppkoppling av anläggningen till internet ingår förutsatt att nätverk finns tillgängligt på plats innan installation i form av framdragen nätverkskabel eller wifi-signal som når till växelriktaren.
										</td>
									</tr>
									<tr><td height="10"></td></tr>
									
									<tr>
										<td valign="middle" style="text-align:left;font-size:20px;border:none; color:#22914f;">
											FUNKTIONSTESTAD ANLÄGGNING
										</td>
									</tr>
									<tr>
										<td style="font-size:16px;">
											Med "funktionstestad anläggning" avses att anläggningen har testats i drift och att färdiganmälan har skickats in till nätägaren för byte av elmätaren. Eventuell handläggningstid utav nätägaren för att komma ut och byta elmätaren kan Arka Energy ej påverka och påverkar således inte betalningsvillkoren.
											Leverans av internet ingår ej i anläggningen.
										</td>
									</tr>
									<tr><td height="10"></td></tr>
									
									<tr>
										<td valign="middle" style="text-align:left;font-size:20px;border:none; color:#22914f;">
											ALLMÄNNA VILLKOR
										</td>
									</tr>
									<tr>
										<td style="font-size:16px;">
											Övriga villkor som gäller för installation framgår i Arka Energys Allmänna villkor som översändes på begäran eller i samband med beställning.
										</td>
									</tr>
									<tr><td height="10"></td></tr>
									
									<tr>
										<td valign="middle" style="text-align:left;font-size:20px;border:none; color:#22914f;">
											PERSONUPPGIFTER
										</td>
									</tr>
									<tr>
										<td style="font-size:16px;">
											Vi följer dataförordningen GDPR som gäller från och med 2018-05-25. Dina personuppgifter kommer behandlas i enlighet med den.
										</td>
									</tr>								
									
								</tbody>
							</table>
						</td>
					</tr>
						
				</tbody>
			</table>
		</div>
	</body>
</html>
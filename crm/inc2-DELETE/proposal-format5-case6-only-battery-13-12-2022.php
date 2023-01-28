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
		<div class="block">
			<!-- image + text -->
			<table width="100%" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="bigimage">
				<tbody>
					<tr>
						<td style="width: 100%;">
							<table class="" cellpadding="10" style="border-collapse: collapse; width: 100%; background-color:#000;" border="0">
								<tbody>
									<tr>
										<td valign="middle" style="text-align:left;font-size:20px;border:none; color:#fff;">
											SAMMANSTÄLLNING BUDGETOFFERT
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>					
					<tr>
						<td>
							<table class="item_table item_table_border no-border" width="100%">
								<tbody>
									<tr>
										<td width="50%" style="text-align:center;">
											<table width="100%" align="center" cellspacing="0" cellpadding="4" border="0" class="devicewidth" modulebg="edit" style="background:#fff">
												<tbody>
													<tr>
														<td style="text-align:left; width:30%;">Utfärdad av:</td>
														<td style="text-align:left; width:70%;"><?=$reference?></td>
													</tr>
												</tbody>
											</table>
										</td>
										<td width="50%" style="text-align:center;">
											<table width="100%" align="center" cellspacing="0" cellpadding="4" border="0" class="devicewidth" modulebg="edit" style="background:#fff">
												<tbody>
													<tr>
														<td style="text-align:left; width:30%;">Mottagare:</td>
														<td style="text-align:left; width:70%;"><?=$customer_name?>, <?=$proposal_address?></td>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<!--<tr>
						<td>
							<table width="100%" align="center" cellspacing="0" cellpadding="4" border="0" class="devicewidth" modulebg="edit" style="background:#fff">
								<tbody>
									<tr>
										<td style="text-align:left;">Utfärdad av: <?=$reference?></td>
										<td style="text-align:left;">Mottagare: <?=$customer_name?>, <?=$proposal_address?></td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>-->
					
					<tr><td></td></tr>
					<tr><td></td></tr>
					<tr>
						<td style="width: 100%;">
							<table width="100%" align="center" cellspacing="0" cellpadding="10" border="0" class="devicewidth" modulebg="edit" style="background-color:#eee">
								<tbody>
									<tr>
										<td width="25%" valign="middle" style="text-align:left;font-size:18px;border:none; color:#000;">
											Betalningsvillkor:
										</td>
										<td width="75%" valign="middle" style="text-align:left;font-size:18px;border:none; color:#000;">
											10 dagar netto
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>	
					<tr>
						<td>
							<table width="100%" align="center" cellspacing="4" cellpadding="4" border="0" class="devicewidth" modulebg="edit" style="background:#fff">
								<tbody>
									<!--<tr>
										<td style="text-align:left;"><?=$payment_at_ordering?>% faktureras vid beställning</td>
										<td style="text-align:center;"></td>
									</tr>-->
									<tr>
										<td colspan="2" style="text-align:left;">60% efter installation av solpaneler.<br>40% efter installation av växelriktare och funktionstestad anläggning.</td>
										<!--<td style="text-align:left;"></td>-->
									</tr>
								</tbody>
							</table>
						</td>
					</tr>			
					<tr><td></td></tr>
					<tr><td></td></tr>
					<tr>
						<td style="width: 100%;">
							<table width="100%" align="center" cellspacing="0" cellpadding="10" border="0" class="devicewidth" modulebg="edit" style="background-color:#eee">
								<tbody>
									<tr>
										<td width="33.33%" valign="middle" style="text-align:left;font-size:18px;border:none; color:#000;">
											Ingående material
										</td>
										<td width="33.33%" valign="middle" style="text-align:center;font-size:18px;border:none; color:#000;">
											Antal
										</td>
										<td width="33.33%" valign="middle" style="text-align:center;font-size:18px;border:none; color:#000;">
											Enhet
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					
					<tr>
						<td>
							<table width="100%" align="center" cellspacing="4" cellpadding="2" border="0" class="devicewidth" modulebg="edit" style="background:#fff;">
								<tbody>
									<?php if($battery_name){?>
									<tr>
										<td style="text-align:left; font-size:12px;">Batteri: <?=$battery_name?></td>
										<td style="text-align:center; font-size:12px;">1</td>
										<td style="text-align:center; font-size:12px;">st</td>
									</tr>
									<?php } ?>
									
									<tr>
										<td style="text-align:left; font-size:12px;">Elkapsling och säkringar</td>
										<td style="text-align:center; font-size:12px;">Efter behov</td>
										<td style="text-align:center; font-size:12px;"></td>
									</tr>
									<tr>
										<td style="text-align:left; font-size:12px;">Kablar och kontaktdon</td>
										<td style="text-align:center; font-size:12px;">Efter behov</td>
										<td style="text-align:center; font-size:12px;"></td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>		
					<tr><td></td></tr>
					<tr><td></td></tr>
					<tr>
						<td style="width: 100%;">
							<table class="" cellpadding="4" style="border-collapse: collapse; width: 100%; background-color:#fff;" border="0">
								<tbody>
									<tr>
										<td valign="middle" style="text-align:left;font-size:20px;border:none; color:#000;">
											Ingående moment
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr>
						<td>
							<table width="100%" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" modulebg="edit" style="background:#ffffff">
								<tbody>
									<tr>
										<td style="color:#000; text-align:left;">
											<ul style="font-size:12px;">
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
					<tr><td></td></tr>
					<tr><td></td></tr>
					
					
					<?php if($battery_name!=''){?>
					<tr>
						<td>
							<table width="100%" align="center" cellspacing="<?=$cellspacing?>" cellpadding="<?=$cellpadding?>" border="0" class="devicewidth" modulebg="edit" style="background:#fff">
								<tbody>
									<tr>
										<td style="text-align:left; font-size:12px;">
											Pris batteri exklusive moms:
										</td>
										<td style="text-align:left; font-size:12px;">
											<?=amount_format_proposal(round($battery_price_excluding_vat))?> kr
										</td>
									</tr>
									<tr>
										<?php if($proposal_customer_type==2){ $bold = 'font-weight: bold;'; }
										else{ $bold=''; }?>
										<td style="text-align:left; font-size:12px; <?=$bold?>">
											Pris batteri inklusive moms:
										</td>
										<td style="text-align:left; font-size:12px; <?=$bold?>">
											<?=amount_format_proposal(round($battery_price_including_vat))?> kr
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<?php if($proposal_customer_type==1){?>			
					<tr>
						<td>
							<table width="100%" align="center" cellspacing="<?=$cellspacing?>" cellpadding="<?=$cellpadding?>" border="0" class="devicewidth" modulebg="edit" style="background:#fff; border-top: 1px solid #000;">
								<tbody>
									<tr>
										<td style="text-align:left; font-size:12px;">
											<b>Pris batteri med grönt avdrag**:</b>
										</td>
										<td style="text-align:left; font-size:12px;">
											<b><?=amount_format_proposal(round($battery_price_after_green_deduction))?> kr</b>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<?php } } ?>
					<tr><td></td></tr>
					<tr>
						<td>
							<table width="100%" align="center" cellspacing="<?=$textspacing?>" cellpadding="<?=$textpadding?>" border="0" class="devicewidth" modulebg="edit" style="background:#fff">
								<tbody>
									<tr>
										<td style="text-align:left; font-size:12px;">*Förutsätter internetuppkoppling till växelriktare i form av WiFi.</td>
									</tr>
									<?php if($battery_name!=''){
										if($proposal_customer_type==1){?>
									<tr>
										<td style="text-align:left; font-size:12px;">**Grönt avdrag är 50% av totalbelopp menomfattar enbart material & arbetskostnader. Schablon är satt av Skatteverket till 48,5%.För mer information om bidraget och dess villkor,läs mer på <a href="https://www.skatteverket.se/">www.skatteverket.se</a></td>
									</tr>
									<?php } } ?>
								</tbody>
							</table>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</body>
</html>
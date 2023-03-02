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
											BESPARINGSKALKYL
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr>
						<td>
							<table width="100%" align="center" cellspacing="0" cellpadding="4" border="0" class="devicewidth" modulebg="edit" style="background:#fff">
								<tbody>
									<tr>
										<td style="text-align:left;">
											Besparingskalkylen nedan baseras på priset efter Grönt Avdrag. I kalkylen är era förutsättningar med riktning, vinkel, solläge och skuggor medräknade, samt en effektförlust på 2% i kablar och växelriktare. Kalkylen ska ses som en uppskattning och är ingen garanti för produktion eller besparing.
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr><td height="5" style="background-color:#fff;" colspan="2"></td></tr>
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
															<?=proposal_decimal_format($annual_deterioration_percent)?>%
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
											<table width="100%" align="center" cellspacing="0" cellpadding="3" border="0" class="devicewidth" modulebg="edit" style="background:#fff">
												<tbody>
													<tr>
														<td valign="middle" colspan="2" style="text-align:left;font-size:20px;border:none; color:#22914f;">
															Elpris baserad på egenkonsumtion
														</td>
													</tr>
													<tr><td height="10" style="background-color:#fff;" colspan="2"></td></tr>
													<tr>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:60%;">
															Egenkonsumtion* (<?=$self_use_solar?>%):
														</td>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:40%;">
															<?=proposal_decimal_format($own_consumption)?> kr/kWh
														</td>
													</tr>
													<tr>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:60%;">
															Såld el** (<?=(100-$self_use_solar)?>%):
														</td>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:40%;">
															<?=proposal_decimal_format($sold_electricity)?> kr/kWh
														</td>
													</tr>
													<tr>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:60%;">
															Totalt viktat elpris:
														</td>
														<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px; width:40%;">
															<?=proposal_decimal_format($total_weighted_electricity_price)?> kr/kWh
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
				</tbody>
			</table>
		</div>
	</body>
</html>
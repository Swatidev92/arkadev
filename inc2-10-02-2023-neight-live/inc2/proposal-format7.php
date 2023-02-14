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
		<meta charset="utf-8">
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
         img[class="bigimage"]{width: 420px!important;height:212px!important;}
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
		 .page6-heading{
			 text-align:left;
			 font-size:11px;
			 border:none; 
			 color:#22914f; 
			 line-height:1.2;
		 }
		 .page6-heading-desc{
			 font-size:11.5px;
			 line-height:1.4;
		 }
		</style>
	</head>
	<body style="background:#ffffff">
		<div class="block">
			<!-- image + text -->
			<table width="100%" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="bigimage">
				<tbody>
					<tr>
						<td>
							<table width="100%" align="center" cellspacing="0" cellpadding="2" border="0" class="devicewidth" modulebg="edit" style="background:#fff">
								<tbody>
									<tr>
										<td style="width: 100%;">
											<table class="" cellpadding="10" style="border-collapse: collapse; width: 100%; background-color:#000;" border="0">
												<tbody>
													<tr>
														<td valign="middle" style="text-align:center;font-size:20px;border:none; color:#fff;">
															VILLKOR
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
				</tbody>
			</table>
			<table width="100%" cellpadding="0" cellspacing="3" border="0" id="backgroundTable" st-sortable="bigimage">
				<tbody>
					<tr>
						<td>
							<table width="100%" align="center" cellspacing="0" cellpadding="2" border="0" class="devicewidth" modulebg="edit" style="background:#fff">
								<tbody>
									<tr>
										<td valign="middle" class="page6-heading">
											Avbrutna avtal
										</td>
									</tr>
									<tr>
										<td class="page6-heading-desc">Om kund av någon anledning väljer att avbryta avtalet efter att tiden för ångerrätt (två veckor) har gått ut kommer Arka Energy fakturera 10 000kr som ersättningskostnad. Detta gäller normalstora projekt (3-25kW) som ej har blivit inplanerade för installation. 
										För större projekt (>25kW) eller projekt som kommit längre fram i installationsfasen kommer debiteringen räknas ut för varje enskilt projekt.</td>
									</tr>
								</tbody>					
							</table>
						</td>
					</tr>
				</tbody>
			</table>
			<?php if($tnc_title1 && $tnc_content1){?>
			<table width="100%" cellpadding="0" cellspacing="3" border="0" id="backgroundTable" st-sortable="bigimage">
				<tbody>
					<tr>
						<td>
							<table width="100%" align="center" cellspacing="0" cellpadding="2" border="0" class="devicewidth" modulebg="edit" style="background:#fff">
								<tbody>
									<tr>
										<td valign="middle" class="page6-heading">
											<?=$tnc_title1?>
										</td>
									</tr>
									<tr>
										<td class="page6-heading-desc"><?=$tnc_content1?></td>
									</tr>
								</tbody>					
							</table>
						</td>
					</tr>
				</tbody>
			</table>
			<?php }if($tnc_title2 && $tnc_content2){?>
			<table width="100%" cellpadding="0" cellspacing="3" border="0" id="backgroundTable" st-sortable="bigimage">
				<tbody>
					<tr>
						<td>
							<table width="100%" align="center" cellspacing="0" cellpadding="2" border="0" class="devicewidth" modulebg="edit" style="background:#fff">
								<tbody>
									<tr>
										<td valign="middle" class="page6-heading">
											<?=$tnc_title2?>
										</td>
									</tr>
									<tr>
										<td class="page6-heading-desc"><?=$tnc_content2?></td>
									</tr>
								</tbody>					
							</table>
						</td>
					</tr>
				</tbody>
			</table>
			<?php } ?>
		</div>
	</body>
</html>
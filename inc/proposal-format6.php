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
						<td>
							<table width="100%" align="center" cellspacing="0" cellpadding="2" border="0" class="devicewidth" modulebg="edit" style="background:#fff">
								<tbody>
									<tr>
										<td width="100%" style="text-align:left;font-size:19px;border:none; color:#22914f;">
											ARKA ENERGY ÄR TOTALENTREPRENÖR
										</td>
									</tr>
									<tr>
										<td width="100%" style="font-size:14px;">I projekt där Arka Energy är totalentreprenör för en nyckelfärdig anläggning står Arka Energy som byggherre för projektet. Det innebär att Arka Energy har ansvar för att gällande lagar följs samt att arbetsmiljö efterföljs enligt gällande föreskrifter.</td>
									</tr>
								</tbody>					
							</table>
						</td>
					</tr>
				</tbody>
			</table>
			
			<table width="100%" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="bigimage">
				<tbody>
					<tr>
						<td>
							<table width="100%" align="center" cellspacing="0" cellpadding="2" border="0" class="devicewidth" modulebg="edit" style="background:#fff">
								<tbody>
									<tr>
										<td width="100%" style="text-align:left;font-size:19px;border:none; color:#22914f;">
											REGELVERK OCH ELBEHÖRIGHET
										</td>
									</tr>
									<tr>
										<td width="100%" style="font-size:14px;">Installationen följer Boverkets Byggregler gällande taktsäkerhet. Eventuella hål tätas noga med silikon/tjära/tätningsbricka vid eventuell takgenomföring. Elinstallationen följer Elsäkerhetsverkets föreskrifter och Energimyndighetens installationsguide för "Nätanslutna Solcellsanläggningar". Samtliga produkter är CE-märkta och leveransvillkor enligt Konsumentköplagen.</td>
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
										<td width="100%" style="text-align:left;font-size:19px;border:none; color:#22914f;">
											FÖRSÄKRINGAR
										</td>
									</tr>
									<tr>
										<td width="100%" style="font-size:14px;">Arka Energy har erforderliga försäkringar som krävs för projektet.</td>
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
										<td width="100%" style="text-align:left;font-size:19px;border:none; color:#22914f;">
											SNÖ- OCH VINDLAST
										</td>
									</tr>
									<tr>
										<td width="100%" style="font-size:14px;">Antal infästningar i fastigheten beräknas för varje projekt och dimensioneras efter normenliga snö- och vindlastberäkningar för relevant snö zon och vinkel på taket. Uppskattad vikt per kvm för anläggningen uppgår till max 14kg/kvm. Fastighetsägaren ansvarar för att fastigheten håller för den tillförda vikten.</td>
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
										<td valign="middle" style="text-align:left;font-size:19px;border:none; color:#22914f;">
											UPPSKATTAD PRODUKTION
										</td>
									</tr>
									<tr>
										<td style="font-size:14px;">Angivna uppgifter i denna offert gällande årlig produktion, besparing och återbetalningstid skall betraktas som uppskattningar baserade på givna uppgifter och är ingen garanti på utfall. Variationer från år till år kommer att förekomma.</td>
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
										<td valign="middle" style="text-align:left;font-size:19px;border:none; color:#22914f;">
											INTERNETUPPKOPPLING
										</td>
									</tr>
									<tr>
										<td style="font-size:14px;">Uppkoppling av anläggningen till internet ingår förutsatt att nätverk finns tillgängligt på plats innan installation i form av wifi-signal som når till växelriktaren.</td>
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
										<td valign="middle" style="text-align:left;font-size:19px;border:none; color:#22914f;">
											FUNKTIONSTESTAD ANLÄGGNING
										</td>
									</tr>
									<tr>
										<td style="font-size:14px;">Med "funktionstestad anläggning" avses att anläggningen har testats i drift och att färdiganmälan har skickats in till nätägaren för byte av elmätaren. Eventuell handläggningstid utav nätägaren för att komma ut och byta elmätaren kan Arka Energy ej påverka och påverkar således inte betalningsvillkoren. Leverans av internet ingår ej i anläggningen.</td>
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
										<td valign="middle" style="text-align:left;font-size:19px;border:none; color:#22914f;">
											ALLMÄNNA VILLKOR
										</td>
									</tr>
									<tr>
										<td style="font-size:16px;">Övriga villkor som gäller för installation framgår i Arka Energys Allmänna villkor som översändes på begäran eller i samband med beställning.</td>
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
										<td valign="middle" style="text-align:left;font-size:19px;border:none; color:#22914f;">
											PERSONUPPGIFTER
										</td>
									</tr>
									<tr>
										<td style="font-size:14px;">Vi följer dataförordningen GDPR som gäller från och med 2018-05-25. Dina personuppgifter kommer behandlas i enlighet med den.</td>
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
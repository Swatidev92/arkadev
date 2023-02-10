<?php error_reporting(3); 
include("../lib/opin.inc.php");

//print_r($_REQUEST);die;
$rsAdmin = $cms->db_query("select * from #_leads where id='".$_REQUEST['order_no']."'");
$arrAdmin = $rsAdmin->fetch_array(); 
@extract($arrAdmin);


$customerPriceQry = $cms->db_query("SELECT * FROM #_customer_price where id=1 ");
$customerPriceArr = $customerPriceQry->fetch_array();

$roofFetchDetailsQry = $cms->db_query("SELECT * FROM #_roof_details where proposal_id='".$_REQUEST['order_no']."' AND status=0 AND is_deleted=0 ");
// $roofFetchDetailsAry = $roofFetchDetailsQry->fetch_array();
//print_r($roofFetchDetailsAry);
//echo $_REQUEST['order_no'];
//die;
$k =1;

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
											DIMENSIONERING
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
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
											<?//=$inverter_type2?'2':'1'?>
											<?php if($inverter_type3){ echo '3'; }else{ if($inverter_type2){ echo '2'; } else{ echo '1';}} ?> 
										</td>
									</tr>
									<tr>
										<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px;">
											Tak-area:
										</td>
										<td valign="middle" style="text-align:left;font-size:16px;border:none; padding:15px;">
											<?=$panel_area_dimension?>
											<br>  
										</td>
									</tr>
									<tr><td></td></tr>
									<tr>
										<?php include("roof_format_details.php"); ?>
									</tr>
									<tr><td></td></tr>
									<!-- <tr><td height="10" colspan="2" style="background-color:#fff;"></td></tr> -->
									<!-- <tr>
										<td valign="middle" colspan="2" style="text-align:left;font-size:16px;border:none; padding:15px;">
											Anläggningen kopplas in i fastighetens elcentral och monteras enligt nedanstående bild.
										</td>
									</tr> -->
								</tbody>
							</table>
						</td>
					</tr>
					<?php $j=6-$k; for($b=0; $b<$j; $b++ ) {?>
					<tr><td></td></tr>
					<?php }?>
					<hr>
					<tr><td></td></tr>
					<tr>
						<td valign="middle" colspan="2" style="text-align:left;font-size:16px;border:none; padding:15px;">
							Anläggningen kopplas in i fastighetens elcentral och monteras enligt nedanstående bild.
						</td>
						<br>
					</tr>
					<tr><td height="20"></td></tr>
					<?php //if($installation_image){?>
					<tr>
						<td>
							<table width="100%" align="center" cellspacing="0" cellpadding="4" class="devicewidth" modulebg="edit" style="background:#ffffff; ">
								<tbody>
									<tr>
										<td width="50%" valign="middle" style="text-align:center;font-size:16px;border:none; color:#22914f;">
											Dimensionering
										</td>
										<td width="50%" valign="middle" style="text-align:center;font-size:16px;border:none; color:#22914f;">
											Uppskattad Produktionsberäkning
										</td>
									</tr>
									<tr>
										<td width="50%"style="color:#fff; text-align:center;">
										   <img src="<?=SITE_PATH.UPLOAD_FILES_PTH.'/'.UP_FILES_PROPOSAL.'/'.$installation_image?>" height="180">
										   <br>
										   <p style="color:black; line-height:1; text-align:left; font-size:10px;">Dimensioneringen visar ett förslag på placering av era paneler. Vi reserverar oss för att eventuella förändringar kan komma att ske utifrån de förutsättningar som upptäcks under installationens gång. I de fall paneler behöver tas bort kommer priset justeras därefter.</p>
										</td>
										<td width="50%" style="text-align:center;">
											<img src="<?=SITE_PATH.UPLOAD_FILES_PTH.'/'.UP_FILES_PROPOSAL.'/'.$chart_image?>" height="250">
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<!-- <hr> -->
					<?php if($inverter_type3=='' && $inverter_img3=='' && $inverter_type2=='' && $inverter_img2==''){?>
					<tr><td></td></tr>
					<!-- <tr><td></td></tr> -->
					<?php } ?>
					<?php //} ?>
					<!--<tr>
						<td style="width: 100%;">
							<table class="" style="border-collapse: collapse; width: 100%; background-color:#fff;" border="0">
								<tbody>
									<tr>
										<td valign="middle" style="text-align:center;font-size:25px;border:none; color:#22914f;">
											UPPSKATTAD PRODUKTIONSBERÄKNING
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>-->
					<!--<tr><td height="10" style="background-color:#fff;"></td></tr>
					<?php //if($chart_image){?>
					<tr>
						<td>
							<table width="100%" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" modulebg="edit" style="background:#ffffff">
								<tbody>
									<tr>
										<td style="text-align:center;">
										    <!--<img src="https://arkaenergy.se/uploaded_files/proposal/chart1634536911.svg" width="500">-->
										    <!--<img src="<?=SITE_PATH.'uploaded_files/proposal/'.$chart_image?>" width="500">
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>-->
					<?php //} ?>

					<tr style="">
						<?php if($panel_img AND file_exists(CRM_FILES_PATH.UP_FILES_PROPOSAL.'/solar-panel/'.$panel_img)){?>
						<td width="25%">
							<table width="100%" align="center" cellspacing="0" cellpadding="4" class="devicewidth" modulebg="edit" style="background:#ffffff; ">
								<tbody>
									<tr>
										<td valign="middle" style="text-align:center;font-size:16px;border:none; color:#22914f;">
											Paneltyp
										</td>
									</tr>
									<tr>
										<td style="color:#fff; text-align:center;">
										   <img src="<?=SITE_PATH.UPLOAD_FILES_PTH.'/'.UP_FILES_PROPOSAL.'/solar-panel/'.$panel_img?>" style="height:128px;">
										</td>
									</tr>
								</tbody>
							</table>
						</td>
						<?php } if($inverter_type && $inverter_img1 AND file_exists(CRM_FILES_PATH.UP_FILES_PROPOSAL.'/inverter/'.$inverter_img1)){?>
						<td width="25%">
							<table width="100%" align="center" cellspacing="0" cellpadding="4" class="devicewidth" modulebg="edit" style="background:#ffffff; ">
								<tbody>
									<tr>
										<td valign="middle" style="text-align:center;font-size:16px;border:none; color:#22914f;">
											Växelriktare 1
										</td>
									</tr>
									<tr>
										<td style="color:#fff; text-align:center;">
										   <img src="<?=SITE_PATH.UPLOAD_FILES_PTH.'/'.UP_FILES_PROPOSAL.'/inverter/'.$inverter_img1?>" style="height:128px;">
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					<!-- </tr> -->
						<?php } ?>
						<!-- <?php if($inverter_type3=='' && $inverter_img3=='' && $inverter_type2=='' && $inverter_img2==''){?>
							<tr><td></td></tr>
							<tr><td></td></tr>
							<?php } ?> -->
							<!-- <tr style="border-bottom: 1px solid #000;"> -->
								<?php if($inverter_type2 && $inverter_img2 AND file_exists(CRM_FILES_PATH.UP_FILES_PROPOSAL.'/inverter/'.$inverter_img2)){?>
						<td width="25%">
							<table width="100%" align="center" cellspacing="0" cellpadding="4" border="0" class="devicewidth" modulebg="edit" style="background:#ffffff; ">
								<tbody>
									<tr>
										<td valign="middle" style="text-align:center;font-size:16px;border:none; color:#22914f;">
											Växelriktare 2
										</td>
									</tr>
									<tr>
										<td style="color:#fff; text-align:center;">
										   <img src="<?=SITE_PATH.UPLOAD_FILES_PTH.'/'.UP_FILES_PROPOSAL.'/inverter/'.$inverter_img2?>" style="height:128px;">
										</td>
									</tr>
								</tbody>
							</table>
						</td>
						<?php }if($inverter_type3 && $inverter_img3 AND file_exists(CRM_FILES_PATH.UP_FILES_PROPOSAL.'/inverter/'.$inverter_img3)){?>
						<td width="25%">
							<table width="100%" align="center" cellspacing="0" cellpadding="4" border="0" class="devicewidth" modulebg="edit" style="background:#ffffff; ">
								<tbody>
									<tr>
										<td valign="middle" style="text-align:center;font-size:16px;border:none; color:#22914f;">
											Växelriktare 3
										</td>
									</tr>
									<tr>
										<td style="color:#fff; text-align:center;">
										   <img src="<?=SITE_PATH.UPLOAD_FILES_PTH.'/'.UP_FILES_PROPOSAL.'/inverter/'.$inverter_img3?>" style="height:128px;">
										</td>
									</tr>
								</tbody>
							</table>
						</td>
						<?php } ?>
					<!-- </tr> -->
					<!-- <tr style="border-bottom: 1px solid #000;"> -->
						<?php if($charger_name && $charger_img AND file_exists(CRM_FILES_PATH.UP_FILES_PROPOSAL.'/charger/'.$charger_img)){?>
						<td width="25%">
							<table width="100%" align="center" cellspacing="0" cellpadding="4" border="0" class="devicewidth" modulebg="edit" style="background:#ffffff">
								<tbody>
									<tr>
										<td valign="middle" style="text-align:center;font-size:16px;border:none; color:#22914f;">
											Billaddare
										</td>
									</tr>
									<tr>
										<td style="color:#fff; text-align:center;">
										   <img src="<?=SITE_PATH.UPLOAD_FILES_PTH.'/'.UP_FILES_PROPOSAL.'/charger/'.$charger_img?>" style="height:128px;">
										</td>
									</tr>
								</tbody>
							</table>
						</td>
						<?php }if($battery_name && $battery_img AND file_exists(CRM_FILES_PATH.UP_FILES_PROPOSAL.'/battery/'.$battery_img)){?>
						<td width="25%">
							<table width="100%" align="center" cellspacing="0" cellpadding="4" border="0" class="devicewidth" modulebg="edit" style="background:#ffffff">
								<tbody>
									<tr>
										<td valign="middle" style="text-align:center;font-size:16px;border:none; color:#22914f;">
											Batteri
										</td>
									</tr>
									<tr>
										<td style="color:#fff; text-align:center;">
										   <img src="<?=SITE_PATH.UPLOAD_FILES_PTH.'/'.UP_FILES_PROPOSAL.'/battery/'.$battery_img?>" style="height:128px;">
										</td>
									</tr>
								</tbody>
							</table>
						</td>
						<?php } ?>
					</tr>
					<!-- <hr> -->
				</tbody>
			</table>
		</div>
	</body>
</html>
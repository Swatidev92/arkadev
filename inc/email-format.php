<?php error_reporting(0); 
include("../lib/opin.inc.php");
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
         
         table td {border-collapse: collapse; font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #052d46; text-align:left;line-height: 20px;padding:0px 10px}
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
	<body style="background:#f8f8f8">
		<div class="block">
			<!-- start of header -->
			<table width="100%" style="background:#f8f8f8" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="header">
				<tbody>
					<tr>
						<td>
							<table width="580" style="background:#f8f8f8" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth" hlitebg="edit" shadow="edit">
								<tbody>
									<tr>
										<td valign="middle" width="100%" class="logo" style="padding:30px 0px;">
											<div class="imgpop" align="center">
												<a href="https://arkaenergy.se/">
													<img src="https://arkaenergy.se/assets/images/Logo.png" border="0" style="display:block; border:none; outline:none; text-decoration:none;" st-image="edit" class="logo" width="">
												</a>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
				</tbody>
			</table>
			<!-- end of header -->
		</div>
		<div class="block">
			<!-- image + text -->
			<table width="100%" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="bigimage">
				<tbody>
					<tr>
						<td>
							<table width="580" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" modulebg="edit" style="background:#ffffff">
								<tbody>
									<tr>
										<td style="padding:40px; border:10px solid #eee">
										   <?php echo $_REQUEST['body']; ?>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr><td height="20"></td></tr>
					<tr>
						<td>
							<p align="center" style="margin:0px;font-size:12px">
							<p align="center">&copy; <?php echo date('Y');?> <a href="http://arkaenergy.se/" target="_blank">www.arkaenergy.se</a> All Rights Reserved.</p>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</body>
</html>
<?php error_reporting(0); 
include("../lib/opin.inc.php");

//print_r($_REQUEST);die;
$rsAdmin = $cms->db_query("select * from #_leads where id='".$_REQUEST['order_no']."'");
$arrAdmin = $rsAdmin->fetch_array(); 
@extract($arrAdmin);


$customerPriceQry = $cms->db_query("SELECT * FROM #_customer_price where id=1 ");
$customerPriceArr = $customerPriceQry->fetch_array();

$obj_inverter = json_decode($customerPriceArr['inverter_types'],true);

$obj_ac =json_decode($customerPriceArr['ac_protect'],true);
$obj_dc = json_decode($customerPriceArr['dc_protect'],true);
$ac_brand= $obj_ac[0]['brand'];
$dc_brand= $obj_dc[0]['brand'];
// echo $lead_id;die;
$otherDetailsQry = $cms->db_query("SELECT * FROM #_other_details where lead_id= '".$lead_id."'");
// echo "1";die;
$otherDetailsArr = $otherDetailsQry->fetch_array();

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
											<!-- mk-04-1-23 -->
											SAMMANSTÄLLNING <?=strtoupper($offerTyeArr[$offer_type])?>
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
					<?php if($proposal_type==5 || $proposal_type==6 || $proposal_type==7){ ?>
					<tr><td></td></tr>
					<?php } ?>
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
					
					<?php if($proposal_type==1){?>
					<tr><td></td></tr>
					<?php } ?>
					<?php if($proposal_type==5 && $proposal_type==6 && $proposal_type==7){ ?>
					<tr><td></td></tr>
					<tr><td></td></tr>
					<?php } ?>
					<tr>
						<td style="width: 100%;">
							<table width="100%" align="center" cellspacing="0" cellpadding="2" border="0" class="devicewidth" modulebg="edit" style="background-color:#eee">
								<tbody>
									<tr>
										<td width="25%" valign="middle" style="text-align:left;font-size:16px;border:none; color:#000;">
											Betalningsvillkor:
										</td>
										<td width="20%" valign="middle" style="text-align:center;font-size:16px;border:none; color:#000;">
											10 dagar netto
										</td>
										<td width="55%" valign="middle" style="text-align:center;font-size:16px;border:none; color:#000;">
										<?php if($proposal_type==1 || $proposal_type==2 || $proposal_type==3 || $proposal_type==4 || $proposal_type==8 || $proposal_type==9 || $proposal_type==10){ ?>
											Nyckelfärdig solcellsanläggning
										<?php } ?>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>				
					<?php if($proposal_type==3){
						$cell0 = 1;
					}else{
						$cell0 = 4;
					} ?>
					<tr>
						<td>
							<table width="100%" align="center" cellspacing="<?=$cell0?>" cellpadding="2" border="0" class="devicewidth" modulebg="edit" style="background:#fff">
								<tbody>
									<!--<tr>
										<td style="text-align:left; font-size:12px;"><?=$payment_at_ordering?>% faktureras vid beställning</td>
										<td style="text-align:center;">
										<?php if($proposal_type==1 || $proposal_type==2 || $proposal_type==3 || $proposal_type==4 || $proposal_type==8 || $proposal_type==9 || $proposal_type==10){ ?>
										<?=proposal_decimal_format($system_size/1000)?> kWp</td>
										<?php } ?>
									</tr>-->
									<tr>
										<td colspan="2" style="text-align:left;">100% efter installation och funktionstestad anläggning (ej efter nätägarens arbete)</td>
										<!--<td style="text-align:left;"></td>-->
									</tr>
								</tbody>
							</table>
						</td>
					</tr>			
					<?php if($proposal_type==5 || $proposal_type==6 || $proposal_type==7){ ?>
					<tr><td></td></tr>
					<?php } ?>
					<?php if($proposal_type==1){ ?>
					<tr><td></td></tr>
					<?php } ?>
					<?php if($proposal_type==5 && $proposal_type==6 && $proposal_type==7){ ?>
					<tr><td></td></tr>
					<tr><td></td></tr>
					<?php } ?>
					<tr>
						<td style="width: 100%;">
							<table width="100%" align="center" cellspacing="0" cellpadding="4" border="0" class="devicewidth" modulebg="edit" style="background-color:#eee">
								<tbody>
									<tr>
										<td width="33.33%" valign="middle" style="text-align:left;font-size:16px;border:none; color:#000;">
											Ingående material
										</td>
										<td width="33.33%" valign="middle" style="text-align:center;font-size:16px;border:none; color:#000;">
											Antal
										</td>
										<td width="33.33%" valign="middle" style="text-align:center;font-size:16px;border:none; color:#000;">
											Enhet
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<?php if($load_balancer==1){
						$cell1 = 1;
					}else{
						$cell1 = 4;
					} ?>
					<tr>
						<td>
							<table width="100%" align="center" cellspacing="<?=$cell1?>" cellpadding="1" border="0" class="devicewidth" modulebg="edit" style="background:#fff;">
								<tbody>
								<?php if($proposal_type!=5 && $proposal_type!=6 && $proposal_type!=7){ ?>
									<tr>
										<td style="text-align:left;font-size:12px;">Solpaneler: <?=$panel_model?> <?=$panel_wattage?>W</td>
										<td style="text-align:center; font-size:12px;"><?=$panel_count?></td>
										<td style="text-align:center;font-size:12px;">st</td>
									</tr>
									<tr>
										<td style="text-align:left;font-size:12px;">Växelriktare 1: <?=$inverter_brand?> (eller en motsvarig)</td>
										<td style="text-align:center;font-size:12px;"><?=$inverter_type1_qty?></td>
										<td style="text-align:center;font-size:12px;">st</td>
									</tr>
									<?php 
										foreach ($obj_inverter as $ikey => $ivalue) {
											if($ivalue["name"] == $inverter_type){
												if($ivalue["dongle_model"]!="dongle_include"){
									?>				
									<tr>
										<td style="text-align:left;font-size:12px;">Wifi Dongle: <?=$ivalue["dongle_model"]?></td>
										<td style="text-align:center;font-size:12px;"><?=$inverter_type1_qty?></td>
										<td style="text-align:center;font-size:12px;">st</td>		
									</tr>					
									<?php 
											}  } } ?>
									<?php if($inverter_type2){?>
									<tr>
										<td style="text-align:left;font-size:12px;">Växelriktare 2: <?=$inverter_brand2?> (eller en motsvarig)</td>
										<td style="text-align:center;font-size:12px;"><?=$inverter_type2_qty?></td>
										<td style="text-align:center;font-size:12px;">st</td>
									</tr>
									<?php 
										foreach ($obj_inverter as $ikey => $ivalue) {
											if($ivalue["name"] == $inverter_type2){
												if($ivalue["dongle_model"]!="dongle_include"){
									?>				
									<tr>
										<td style="text-align:left;font-size:12px;">Wifi Dongle: <?=$ivalue["dongle_model"]?></td>
										<td style="text-align:center;font-size:12px;"><?=$inverter_type2_qty?></td>
										<td style="text-align:center;font-size:12px;">st</td>		
									</tr>					
									<?php 
											} } } ?>
									<?php } ?>
									<?php if($inverter_type3){?>
									<tr>
										<td style="text-align:left;font-size:12px;">Växelriktare 3: <?=$inverter_brand3?> (eller en motsvarig)</td>
										<td style="text-align:center;font-size:12px;"><?=$inverter_type3_qty?></td>
										<td style="text-align:center;font-size:12px;">st</td>
									</tr>
									<?php 
										foreach ($obj_inverter as $ikey => $ivalue) {
											if($ivalue["name"] == $inverter_type3){
												if($ivalue["dongle_model"]!="dongle_include"){
									?>				
									<tr>
										<td style="text-align:left;font-size:12px;">Wifi Dongle: <?=$ivalue["dongle_model"]?></td>
										<td style="text-align:center;font-size:12px;"><?=$inverter_type3_qty?></td>
										<td style="text-align:center;font-size:12px;">st</td>		
									</tr>					
									<?php 
											} } } ?>
									<?php } ?>
									<tr>
										<td style="text-align:left;font-size:12px;">Monteringssystem</td>
										<td style="text-align:center;font-size:12px;">1</td>
										<td style="text-align:center;font-size:12px;">st</td>
									</tr>
									<!-- S:mk-19 -->
									<?php if($proposal_type==1 || $proposal_type==8 || $proposal_type==9 || $proposal_type==11){ if($otherDetailsArr['surge_protc_ac']==1){?>
									<tr>
										<td style="text-align:left;font-size:12px;">Överspänningsskydd AC &nbsp;[<?=$ac_brand?>]</td>
										<td style="text-align:center;font-size:12px;">1</td>
										<td style="text-align:center;font-size:12px;">st</td>
									</tr>
									<?php }?>
									<?php if($otherDetailsArr['surge_protc_dc']==1){?>
									<tr>
										<td style="text-align:left;font-size:12px;">Överspänningsskydd DC &nbsp;[<?=$dc_brand?>]</td>
										<td style="text-align:center;font-size:12px;">1</td>
										<td style="text-align:center;font-size:12px;">st</td>
									</tr>
									<?php }}?>
									<!-- E:mk-19 -->
								<?php } ?>
									<?php if($charger_name){?>
									<tr>
										<td style="text-align:left;font-size:12px;">Billaddare: <?=$charger_name?></td>
										<td style="text-align:center;font-size:12px;"><?=$charger_qty?></td>
										<td style="text-align:center;font-size:12px;">st</td>
									</tr>
									<?php } ?>
									<?php if($load_balancer==1){?>
									<tr>
										<td style="text-align:left;font-size:12px;">Lastbalanserare: <?=$charger_name?></td>
										<td style="text-align:center;font-size:12px;">1</td>
										<td style="text-align:center;font-size:12px;">st</td>
									</tr>
									<?php } ?>
									<?php if($battery_name){?>
									<tr>
										<td style="text-align:left; font-size:12px;">Batteri: <?=$battery_name?></td>
										<td style="text-align:center; font-size:12px;"><?=$battery_qty?></td>
										<td style="text-align:center; font-size:12px;">st</td>
									</tr>
									<?php } ?>
									<?php if($proposal_type!=5 && $proposal_type!=6 && $proposal_type!=7){ ?>
									<tr>
										<td style="text-align:left; font-size:12px;">Likströmsbrytare (ingår i växelriktare)</td>
										<td style="text-align:center; font-size:12px;">1</td>
										<td style="text-align:center; font-size:12px;">st</td>
									</tr>
									<tr>
										<td style="text-align:left; font-size:12px;">Växelströmsbrytare</td>
										<td style="text-align:center; font-size:12px;">1</td>
										<td style="text-align:center; font-size:12px;">st</td>
									</tr>
									<?php } ?>
									<?php if($sensor_type_name){?>
									<tr>
										<td style="text-align:left; font-size:12px;">Smart sensor</td>
										<td style="text-align:center; font-size:12px;"><?=$sensor_qty?></td>
										<td style="text-align:center; font-size:12px;">st</td>
									</tr>
									<?php } ?>
									<?php if($odrift_type_name){?>
									<tr>
										<td style="text-align:left; font-size:12px;">Backup Box</td>
										<td style="text-align:center; font-size:12px;"><?=$odrift_qty?></td>
										<td style="text-align:center; font-size:12px;">st</td>
									</tr>
									<?php } ?>
									<?php if($optimizer_type_name){?>
									<tr>
										<td style="text-align:left; font-size:12px;">Optimizer</td>
										<td style="text-align:center; font-size:12px;"><?=$optimizer_qty?></td>
										<td style="text-align:center; font-size:12px;">st</td>
									</tr>
									<?php } ?>
									<!-- S:mk-19 -->
									<?php if($proposal_type==1 || $proposal_type==8 || $proposal_type==9 || $proposal_type==11) { 
										if($otherDetailsArr['cable_len_inv']!= null ||$otherDetailsArr['cable_len_inv']!= "" ){?>
									<tr>
										<td style="text-align:left;font-size:12px;">Kabellängd mellan Växelriktare och Fasadmätarskåp / Elcentral</td>
										<td style="text-align:center;font-size:12px;"><?=$otherDetailsArr['cable_len_inv']?></td>
										<td style="text-align:center;font-size:12px;">m</td>
									</tr>
									<?php } else { ?>
									<tr>
										<td style="text-align:left;font-size:12px;">Kabellängd mellan Växelriktare och Fasadmätarskåp / Elcentral</td>
										<td style="text-align:center;font-size:12px;">10</td>
										<td style="text-align:center;font-size:12px;">m</td>
									</tr>
									<?php } }?>
									<?php if($proposal_type==5 || $proposal_type==8 || $proposal_type==9 ) {
										if($otherDetailsArr['cable_len_ev']!= null ||$otherDetailsArr['cable_len_ev']!= "" ){?>
									<tr>
										<td style="text-align:left;font-size:12px;">Kabelllängd mellan billaddare och fasadmätarskåp/elcentral</td>
										<td style="text-align:center;font-size:12px;"><?=$otherDetailsArr['cable_len_ev']?></td>
										<td style="text-align:center;font-size:12px;">m</td>
									</tr>
									<?php } else { ?>
									<tr>
										<td style="text-align:left;font-size:12px;">Kabelllängd mellan billaddare och fasadmätarskåp/elcentral</td>
										<td style="text-align:center;font-size:12px;">10</td>
										<td style="text-align:center;font-size:12px;">m</td>
									</tr>
									<?php }}?>
									<!-- E:mk-19 -->	
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
					<?php if($proposal_type==5 || $proposal_type==6 || $proposal_type==7){ ?>
					<tr><td></td></tr>
					<?php } ?>
					<?php if($proposal_type==1){ ?>
					<tr><td></td></tr>
					<?php } ?>
					<?php if($proposal_type==5 && $proposal_type==6 && $proposal_type==7){ ?>
					<tr><td></td></tr>
					<tr><td></td></tr>
					<?php } ?>
					<tr>
						<td style="width: 100%;">
							<table class="" cellpadding="4" style="border-collapse: collapse; width: 100%; background-color:#fff;" border="0">
								<tbody>
									<tr>
										<td valign="middle" style="text-align:left;font-size:18px;border:none; color:#000;">
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
					<?php if($proposal_customer_type==2){ ?>
					<tr><td></td></tr>
					<tr><td></td></tr>
					<?php } ?>
					
					<?php 
					if($proposal_type==8){ 
						$cellspacing = 4;
						$cellpadding = 2;
					}
					if($load_balancer==1){
						$pris_text_heading = ', billaddare och lastbalanserare';
					}else{
						$pris_text_heading = ' och billaddare';
					}
					?>
					
					<tr>
						<td>
							<table width="100%" align="center" cellspacing="<?=$cellspacing?>" cellpadding="<?=$cellpadding?>" border="0" class="devicewidth" modulebg="edit" style="background:#fff">
								<tbody>
									<tr>
										<td style="text-align:left; font-size:12px; width:70%;">
											Pris solcellsanläggning<?=$pris_text_heading?> exklusive moms:
										</td>
										<td style="text-align:left; font-size:12px; width:30%;">
											<?php $price_excluding_vat = $price_excluding_vat + $charger_price_excluding_vat;
											
											if($load_balancer==1){
												$price_excluding_vat = $price_excluding_vat + $load_price_excluding_vat;
											}
											?>
											<?=amount_format_proposal(round($price_excluding_vat))?> kr
										</td>
									</tr>
									<tr>
										<?php if($proposal_customer_type==2){ $bold = 'font-weight: bold;'; }
										else{ $bold=''; }?>
										<td style="text-align:left; font-size:12px; <?=$bold?>; width:70%;">
											Pris solcellsanläggning<?=$pris_text_heading?> inklusive moms:
										</td>
										<td style="text-align:left; font-size:12px; <?=$bold?>; width:30%;">
											<?php $price_including_vat = $price_including_vat + $charger_price_including_vat;
											
											if($load_balancer==1){
												$price_including_vat = $price_including_vat + $load_price_including_vat;
											}											
											?>
											<?=amount_format_proposal(round($price_including_vat))?> kr
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
										<td style="text-align:left; font-size:12px; width:70%;">
											<b>Pris solcellsanläggning<?=$pris_text_heading?> med grönt avdrag**:</b>
										</td>
										<td style="text-align:left; font-size:12px; width:30%;">
											<?php $price_after_green_deduction = $price_after_green_deduction + $charger_price_after_green_deduction;
											
											if($load_balancer==1){
												$price_after_green_deduction = $price_after_green_deduction + $load_price_after_green_deduction;
											}
											?>
											<b><?=amount_format_proposal(round($price_after_green_deduction))?> kr</b>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<?php } ?>
					<?php if($proposal_customer_type==2){ 
						echo '<tr><td></td></tr>';
					}?>
					
					<?php 
					if($proposal_type==8){ 
						$textspacing = 4;
						$textpadding = 2;
					}
					?>
					<tr><td></td></tr>
					<tr>
						<td>
							<table width="100%" align="center" cellspacing="<?=$textspacing?>" cellpadding="<?=$textpadding?>" border="0" class="devicewidth" modulebg="edit" style="background:#fff">
								<tbody>
									<tr>
										<td style="text-align:left; font-size:12px;">*Förutsätter internetuppkoppling till växelriktaren via WiFi eller framdragen nätverkskabel. Arka Energy ansvarar ej för kundens internet</td>
									</tr>
									<tr>
										<td style="text-align:left; font-size:12px;">**Grönt avdrag är 20% för solcellsanläggning och 50% för billaddare/batteri av totalbelopp men omfattar enbart material & arbetskostnader. Schablon är satt av Skatteverket till 19,4% och 48,5%. För mer information om bidraget och dess villkor, läs mer på <a href="https://www.skatteverket.se/">www.skatteverket.se</a></td>
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
<?php include("../../lib/opin.inc.php");?>

<?php


error_reporting(0);
//echo $_GET['start'];die;
	//print_r($_REQUEST);die;
	$txt='';
	$rsAdmin = $cms->db_query("select id, customer_name, quotation_number, panel_model, panel_wattage, panel_count, inverter_type, inverter_type2, inverter_type3, proposal_mms_cost, charger_name, battery_name, solar_margin, solar_margin_kr, charger_margin, charger_margin_kr, proposal_type, vat_kr, vat_percentage, green_rebate_kr, number_of_proposal, charger_green_rebate_kr, charger_vat_kr, proposal_customer_type, proposal_total_price, load_balancer, battery_green_rebate_kr, battery_vat_kr, battery_margin, battery_margin_kr, proposal_total_cost, charger_price_after_green_deduction, price_after_green_deduction, battery_price_after_green_deduction, installation_days, total_discount, roofing_material, price_excluding_vat, price_including_vat, charger_price_including_vat, charger_price_excluding_vat, battery_price_excluding_vat, battery_price_including_vat, extra_green_rebate, load_balancer_margin_kr, load_balancer_vat_kr, load_balancer_green_rebate_kr, load_price_after_green_deduction, load_price_including_vat, load_price_excluding_vat, proposal_name, battery_extra_green_rebate, lead_id as leadID, charger_price, battery_price, panel_cost, inverter_cost, inverter_cost2, inverter_cost3, installation_cost, roof_cost_per_panel, sensor_type_name, sensor_type_cost, sensor_qty, odrift_type_name, odrift_type_cost, odrift_qty, optimizer_type_name,optimizer_type_cost, optimizer_qty, tnc_title1, tnc_title2, tnc_content1, tnc_content2 from #_leads where id='".$_REQUEST['pid']."'");
	$arrAdmin = $rsAdmin->fetch_array(); 
	@extract($arrAdmin);
	
	include('file-name.php');
	
	$invoice_Arr=array(
		"order_no"=>$_GET["pid"]
		);
		
	// Extend the TCPDF class to create custom Header and Footer
	class MYPDF extends TCPDF {


		// Page footer
		public function Footer() {
		// Position at 15 mm from bottom
		$this->SetY(-22);
		// Set font
		$this->SetFont('helvetica', '', 10);
		
		
			
		$footerHtml = '<table width="100%" align="center" cellspacing="0" cellpadding="6" border="0" class="devicewidth" modulebg="edit" style="background:#fff; border-top: 1px solid #000">
						<tbody>
							<tr>
								<td width="33.33%" style="text-align:left">	
									<p>08-80 08 80<br>info@arkaenergy.se<br>www.arkaenergy.se</p>
								</td>
								<td width="33.33%" style="text-align:left">	
									<p>Arka Energy AB<br>Birger Jarlsgatan 104E<br>Stockholm</p>
								</td>
								<td width="33.33%" style="text-align:right">	
									<img src="http://arkaenergy.se/assets/images/Arka-Logo.svg" border="0" style="display:block; border:none; outline:none; text-decoration:none; width:150px;">
								</td>
							</tr>
						</tbody>
					</table>';
			// Page number
     $this->writeHTML($footerHtml, false, true, false, true); 
    
			 
		}
	}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(true);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Anil Dua');
$pdf->SetTitle('Arka Proposal');
//$pdf->SetSubject('TCPDF Tutorial');
//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');


// set header and footer fonts
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
//pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetAutoPageBreak(TRUE, 0);
// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('dejavusans', '', 14, '', true);
 $pdf->SetTextColor(0, 0, 0);
	
	$pdf->AddPage();
	//$img_file = K_PATH_IMAGES.'logoweb.png';
	//$pdf->Image($img_file, 120, 85, 50, 50, '', '', '', true, 72);
	//$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
	
		$postdata = http_build_query($invoice_Arr);
			$opts = array('http' =>
				array(
					'method'  => 'POST',
					'header'  => 'Content-type: application/x-www-form-urlencoded',
					'content' => $postdata
				)
			);
			
		if($number_of_proposal==2 && $proposal_type==4){
			$context  = stream_context_create($opts);
			$html1=file_get_contents(SITE_PATH."inc2/proposal-format-case4-2proposal.php", false, $context);
			$pdf->writeHTMLCell(0, 0, '', '0', $html1, 0, 1, 0, true, '', true);
			$pdf->AddPage();
		}
		else if($number_of_proposal==2 && $proposal_type==10){
			$context  = stream_context_create($opts);
			$html1=file_get_contents(SITE_PATH."inc2/proposal-format-case10-2proposal.php", false, $context);
			$pdf->writeHTMLCell(0, 0, '', '0', $html1, 0, 1, 0, true, '', true);
			$pdf->AddPage();
		}
		else if($number_of_proposal==2 && $proposal_type==11){
			$context  = stream_context_create($opts);
			$html1=file_get_contents(SITE_PATH."inc2/proposal-format-case10-2proposal.php", false, $context);
			$pdf->writeHTMLCell(0, 0, '', '0', $html1, 0, 1, 0, true, '', true);
			$pdf->AddPage();
		}
		else if($number_of_proposal==2 && $proposal_type==3){
			$context  = stream_context_create($opts);
			$html1=file_get_contents(SITE_PATH."inc2/proposal-format-case3-2proposal.php", false, $context);
			$pdf->writeHTMLCell(0, 0, '', '0', $html1, 0, 1, 0, true, '', true);
			$pdf->AddPage();
		}
		else if($number_of_proposal==1 && $proposal_type==3){
			$context  = stream_context_create($opts);
			$html1=file_get_contents(SITE_PATH."inc2/proposal-format-case3-proposal1.php", false, $context);
			$pdf->writeHTMLCell(0, 0, '', '0', $html1, 0, 1, 0, true, '', true);
			$pdf->AddPage();
		}
		else if($proposal_type==5){
			$context  = stream_context_create($opts);
			$html1=file_get_contents(SITE_PATH."inc2/proposal-format-case5-only-charger.php", false, $context);
			$pdf->writeHTMLCell(0, 0, '', '0', $html1, 0, 1, 0, true, '', true);
			$pdf->AddPage();
		}
		else if($proposal_type==6){
			$context  = stream_context_create($opts);
			$html1=file_get_contents(SITE_PATH."inc2/proposal-format-case6-only-battery.php", false, $context);
			$pdf->writeHTMLCell(0, 0, '', '0', $html1, 0, 1, 0, true, '', true);
			$pdf->AddPage();
		}
		else if($proposal_type==7){
			$context  = stream_context_create($opts);
			$html1=file_get_contents(SITE_PATH."inc2/proposal-format-case7-only-battery-charger.php", false, $context);
			$pdf->writeHTMLCell(0, 0, '', '0', $html1, 0, 1, 0, true, '', true);
			$pdf->AddPage();
		}
		else if($proposal_type==2){
			$context  = stream_context_create($opts);
			$html1=file_get_contents(SITE_PATH."inc2/proposal-format-case2.php", false, $context);
			$pdf->writeHTMLCell(0, 0, '', '0', $html1, 0, 1, 0, true, '', true);
			$pdf->AddPage();
		}
		else if($number_of_proposal==1 && $proposal_type==8){
			$context  = stream_context_create($opts);
			$html1=file_get_contents(SITE_PATH."inc2/proposal-format-case8.php", false, $context);
			$pdf->writeHTMLCell(0, 0, '', '0', $html1, 0, 1, 0, true, '', true);
			$pdf->AddPage();
		}
		else if($number_of_proposal==2 && $proposal_type==8){
			$context  = stream_context_create($opts);
			$html1=file_get_contents(SITE_PATH."inc2/proposal-format-case8-proposal1.php", false, $context);
			$pdf->writeHTMLCell(0, 0, '', '0', $html1, 0, 1, 0, true, '', true);
			$pdf->AddPage();
		}
		else if($number_of_proposal==1 && $proposal_type==9){
			$context  = stream_context_create($opts);
			$html1=file_get_contents(SITE_PATH."inc2/proposal-format-case9.php", false, $context);
			$pdf->writeHTMLCell(0, 0, '', '0', $html1, 0, 1, 0, true, '', true);
			$pdf->AddPage();
		}
		else if($number_of_proposal==1 && $proposal_type==10){
			$context  = stream_context_create($opts);
			$html1=file_get_contents(SITE_PATH."inc2/proposal-format-case10.php", false, $context);
			$pdf->writeHTMLCell(0, 0, '', '0', $html1, 0, 1, 0, true, '', true);
			$pdf->AddPage();
		}
		else if($number_of_proposal==1 && $proposal_type==11){
			$context  = stream_context_create($opts);
			$html1=file_get_contents(SITE_PATH."inc2/proposal-format-case10.php", false, $context);
			$pdf->writeHTMLCell(0, 0, '', '0', $html1, 0, 1, 0, true, '', true);
			$pdf->AddPage();
		}
		else{
			$context  = stream_context_create($opts);
			$html1=file_get_contents(SITE_PATH."inc2/proposal-format.php", false, $context);
			$pdf->writeHTMLCell(0, 0, '', '0', $html1, 0, 1, 0, true, '', true);
			$pdf->AddPage();
		}
		
		/*
		$html2=file_get_contents(SITE_PATH."inc2/proposal-format2.php", false, $context);
		//echo $html2;die;
		$pdf->writeHTMLCell(0, 0, '', '0', $html2, 0, 1, 0, true, '', true);
		$pdf->AddPage();		
		*/
		//mk-19
		if($proposal_type!=5 && $proposal_type!=6 && $proposal_type!=7){
			if(($number_of_proposal==2 && $proposal_type==4) || ($number_of_proposal==2 && $proposal_type==10) || ($number_of_proposal==2 && $proposal_type==11)){
				$html3=file_get_contents(SITE_PATH."inc2/proposal-format3-case4-proposal2.php", false, $context);
				//echo $html2;die;
			
				$pdf->writeHTMLCell(0, 0, '', '0', $html3, 0, 1, 0, true, '', true);
				$pdf->AddPage();
			}
			else if($number_of_proposal==2 && $proposal_type==3){
				$html3=file_get_contents(SITE_PATH."inc2/proposal-format3-case3-proposal2.php", false, $context);
				//echo $html2;die;
			
				$pdf->writeHTMLCell(0, 0, '', '0', $html3, 0, 1, 0, true, '', true);
				$pdf->AddPage();
			}
			else if($number_of_proposal==2 && $proposal_type==8){
				$html3=file_get_contents(SITE_PATH."inc2/proposal-format3-case8-proposal2.php", false, $context);
				//echo $html2;die;
			
				$pdf->writeHTMLCell(0, 0, '', '0', $html3, 0, 1, 0, true, '', true);
				$pdf->AddPage();
			}
			else if($number_of_proposal==2 && $proposal_type==10){
				$html3=file_get_contents(SITE_PATH."inc2/proposal-format3-case10-proposal2.php", false, $context);
				//echo $html2;die;
			
				$pdf->writeHTMLCell(0, 0, '', '0', $html3, 0, 1, 0, true, '', true);
				$pdf->AddPage();
			}
			else if($number_of_proposal==2 && $proposal_type==11){
				$html3=file_get_contents(SITE_PATH."inc2/proposal-format3-case10-proposal2.php", false, $context);
				//echo $html2;die;
			
				$pdf->writeHTMLCell(0, 0, '', '0', $html3, 0, 1, 0, true, '', true);
				$pdf->AddPage();
			}
			else if($proposal_type==1){	
				$html3=file_get_contents(SITE_PATH."inc2/proposal-format3-case1.php", false, $context);
				//echo $html2;die;
			
				$pdf->writeHTMLCell(0, 0, '', '0', $html3, 0, 1, 0, true, '', true);
				$pdf->AddPage();
			}
			else if($proposal_type==2){	
				$html3=file_get_contents(SITE_PATH."inc2/proposal-format3-case2.php", false, $context);
				//echo $html2;die;
			
				$pdf->writeHTMLCell(0, 0, '', '0', $html3, 0, 1, 0, true, '', true);
				$pdf->AddPage();
			}
			else{		
				$html3=file_get_contents(SITE_PATH."inc2/proposal-format3.php", false, $context);
				//echo $html2;
				// die;
			
				$pdf->writeHTMLCell(0, 0, '', '0', $html3, 0, 1, 0, true, '', true);
				$pdf->AddPage();
			}
			// dimensionning new page addons//
			// if($inverter_type3=='' && $inverter_img3=='' && $inverter_type2=='' && $inverter_img2==''){  }else{
			if(($number_of_proposal==2 && $proposal_type==4) || ($number_of_proposal==2 && $proposal_type==10) || ($number_of_proposal==2 && $proposal_type==11)){
				$html3a=file_get_contents(SITE_PATH."inc2/proposal-format3a-case4-proposal2.php", false, $context);
				//echo $html2;die;
			
				$pdf->writeHTMLCell(0, 0, '', '0', $html3a, 0, 1, 0, true, '', true);
				$pdf->AddPage();
			}
			else if($number_of_proposal==2 && $proposal_type==3){
				$html3a=file_get_contents(SITE_PATH."inc2/proposal-format3a-case3-proposal2.php", false, $context);
				//echo $html2;die;
			
				$pdf->writeHTMLCell(0, 0, '', '0', $html3a, 0, 1, 0, true, '', true);
				$pdf->AddPage();
			}
			else if($number_of_proposal==2 && $proposal_type==8){
				$html3a=file_get_contents(SITE_PATH."inc2/proposal-format3a-case8-proposal2.php", false, $context);
				//echo $html2;die;
			
				$pdf->writeHTMLCell(0, 0, '', '0', $html3a, 0, 1, 0, true, '', true);
				$pdf->AddPage();
			}
			else if($number_of_proposal==2 && $proposal_type==10){
				$html3a=file_get_contents(SITE_PATH."inc2/proposal-format3a-case10-proposal2.php", false, $context);
				//echo $html2;die;
			
				$pdf->writeHTMLCell(0, 0, '', '0', $html3a, 0, 1, 0, true, '', true);
				$pdf->AddPage();
			}
			else if($number_of_proposal==2 && $proposal_type==11){
				$html3a=file_get_contents(SITE_PATH."inc2/proposal-format3a-case10-proposal2.php", false, $context);
				//echo $html2;die;
			
				$pdf->writeHTMLCell(0, 0, '', '0', $html3a, 0, 1, 0, true, '', true);
				$pdf->AddPage();
			}
			else if($proposal_type==1){	
				$html3a=file_get_contents(SITE_PATH."inc2/proposal-format3a-case1.php", false, $context);
				//echo $html2;die;
			
				$pdf->writeHTMLCell(0, 0, '', '0', $html3a, 0, 1, 0, true, '', true);
				$pdf->AddPage();
			}
			else if($proposal_type==2){	
				$html3a=file_get_contents(SITE_PATH."inc2/proposal-format3a-case2.php", false, $context);
				//echo $html2;die;
			
				$pdf->writeHTMLCell(0, 0, '', '0', $html3a, 0, 1, 0, true, '', true);
				$pdf->AddPage();
			}
			else{		
				$html3a=file_get_contents(SITE_PATH."inc2/proposal-format3a.php", false, $context);
				//echo $html2;
				//  die;
			
				$pdf->writeHTMLCell(0, 0, '', '0', $html3a, 0, 1, 0, true, '', true);
				$pdf->AddPage();
			}
		}

		//echo $html3; die;
		if($number_of_proposal==2 && ($proposal_type==3 || $proposal_type==4 || $proposal_type==8 || $proposal_type==10 || $proposal_type==11)){
			$html4='';
		}
		else{
			$html4=file_get_contents(SITE_PATH."inc2/proposal-format4.php", false, $context);
			//echo $html2;die;
			$pdf->writeHTMLCell(0, 0, '', '0', $html4, 0, 1, 0, true, '', true);
			$pdf->AddPage();
		}
		
		// }
		
		if(($number_of_proposal==2 && $proposal_type==4) || ($number_of_proposal==2 && $proposal_type==10) || ($number_of_proposal==2 && $proposal_type==11)){
			$html5=file_get_contents(SITE_PATH."inc2/proposal-format5-case4-proposal2.php", false, $context);
			$pdf->writeHTMLCell(0, 0, '', '0', $html5, 0, 1, 0, true, '', true);
			$pdf->AddPage();
		}
		else if($number_of_proposal==2 && $proposal_type==3){
			$html5=file_get_contents(SITE_PATH."inc2/proposal-format5-case3-proposal2.php", false, $context);
			$pdf->writeHTMLCell(0, 0, '', '0', $html5, 0, 1, 0, true, '', true);
			$pdf->AddPage();
		}
		else if($number_of_proposal==1 && $proposal_type==3){
			$html5=file_get_contents(SITE_PATH."inc2/proposal-format5-case3-proposal1.php", false, $context);
			$pdf->writeHTMLCell(0, 0, '', '0', $html5, 0, 1, 0, true, '', true);
			$pdf->AddPage();
		}
		else if($number_of_proposal==1 && $proposal_type==4){
			$html5=file_get_contents(SITE_PATH."inc2/proposal-format5-case4-proposal1.php", false, $context);
			$pdf->writeHTMLCell(0, 0, '', '0', $html5, 0, 1, 0, true, '', true);
			$pdf->AddPage();
		}
		else if($proposal_type==5){
			$html5=file_get_contents(SITE_PATH."inc2/proposal-format5-case5-only-charger.php", false, $context);
			$pdf->writeHTMLCell(0, 0, '', '0', $html5, 0, 1, 0, true, '', true);
			$pdf->AddPage();
		}
		else if($proposal_type==6){
			$html5=file_get_contents(SITE_PATH."inc2/proposal-format5-case6-only-battery.php", false, $context);
			$pdf->writeHTMLCell(0, 0, '', '0', $html5, 0, 1, 0, true, '', true);
			$pdf->AddPage();
		}
		else if($proposal_type==7){
			$html5=file_get_contents(SITE_PATH."inc2/proposal-format5-case7-only-battery-charger.php", false, $context);
			$pdf->writeHTMLCell(0, 0, '', '0', $html5, 0, 1, 0, true, '', true);
			$pdf->AddPage();
		}
		else if($number_of_proposal==1 && $proposal_type==8){
			$context  = stream_context_create($opts);
			$html1=file_get_contents(SITE_PATH."inc2/proposal-format5-case8.php", false, $context);
			$pdf->writeHTMLCell(0, 0, '', '0', $html1, 0, 1, 0, true, '', true);
			$pdf->AddPage();
		}
		else if($number_of_proposal==2 && $proposal_type==8){
			$context  = stream_context_create($opts);
			$html1=file_get_contents(SITE_PATH."inc2/proposal-format5-case8-proposal1.php", false, $context);
			$pdf->writeHTMLCell(0, 0, '', '0', $html1, 0, 1, 0, true, '', true);
			$pdf->AddPage();
		}
		else if($number_of_proposal==1 && $proposal_type==9){
			$context  = stream_context_create($opts);
			$html1=file_get_contents(SITE_PATH."inc2/proposal-format5-case9.php", false, $context);
			$pdf->writeHTMLCell(0, 0, '', '0', $html1, 0, 1, 0, true, '', true);
			$pdf->AddPage();
		}
		else if($number_of_proposal==1 && $proposal_type==10){
			$context  = stream_context_create($opts);
			$html1=file_get_contents(SITE_PATH."inc2/proposal-format5-case10.php", false, $context);
			$pdf->writeHTMLCell(0, 0, '', '0', $html1, 0, 1, 0, true, '', true);
			$pdf->AddPage();
		}
		else if($number_of_proposal==1 && $proposal_type==11){
			$context  = stream_context_create($opts);
			$html1=file_get_contents(SITE_PATH."inc2/proposal-format5-case11.php", false, $context);
			$pdf->writeHTMLCell(0, 0, '', '0', $html1, 0, 1, 0, true, '', true);
			$pdf->AddPage();
		}
		else if($proposal_type==2){
			$html5=file_get_contents(SITE_PATH."inc2/proposal-format5-case2.php", false, $context);
			$pdf->writeHTMLCell(0, 0, '', '0', $html5, 0, 1, 0, true, '', true);
			$pdf->AddPage();
		}
		else{
			$html5=file_get_contents(SITE_PATH."inc2/proposal-format5.php", false, $context);
			$pdf->writeHTMLCell(0, 0, '', '0', $html5, 0, 1, 0, true, '', true);
			$pdf->AddPage();
		}
		
		$html6=file_get_contents(SITE_PATH."inc2/proposal-format6.php", false, $context);
		$pdf->writeHTMLCell(0, 0, '', '0', $html6, 0, 1, 0, true, '', true);
		
		if(($tnc_title1 && $tnc_content1) || ($tnc_title2 && $tnc_content2)){
		$pdf->AddPage();
		$html7=file_get_contents(SITE_PATH."inc2/proposal-format7.php", false, $context);
		$pdf->writeHTMLCell(0, 0, '', '0', $html7, 0, 1, 0, true, '', true);
		}
		
		//file name format - customer name (solar-number of panel-evcharger-battery)
		//$final_file = $customer_name.''.$quotation_number.' '.date('d-m-Y').' '.date('h-s').'.pdf';
		$final_file = ($proposal_name?$proposal_name.'-':'').$customer_name.'-'.$file_name.'-'.$quotation_number.'.pdf';
		
		$pdf->Output(SITE_FS_PATH.'/'.UPLOAD_FILES_PTH.'/'.UP_FILES_PROPOSAL.'/'.$final_file, 'F');
		//ob_clean();
		//$pdf->Output($invoice_Arr["order_no"].time().'.pdf', 'D');
		//return $invoice_Arr["order_no"].".pdf";
		
		//$pdf->reset();
		
		//echo $final_file;die;
			
		
		if($number_of_proposal==2){
			
// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(true);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Anil Dua');
$pdf->SetTitle('Arka Proposal');
//$pdf->SetSubject('TCPDF Tutorial');
//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');


// set header and footer fonts
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
//pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetAutoPageBreak(TRUE, 0);
// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('dejavusans', '', 14, '', true);
 $pdf->SetTextColor(0, 0, 0);
	
	$pdf->AddPage();
	//$img_file = K_PATH_IMAGES.'logoweb.png';
	//$pdf->Image($img_file, 120, 85, 50, 50, '', '', '', true, 72);
	//$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
	
		$postdata = http_build_query($invoice_Arr);
			$opts = array('http' =>
				array(
					'method'  => 'POST',
					'header'  => 'Content-type: application/x-www-form-urlencoded',
					'content' => $postdata
				)
			);
		$context  = stream_context_create($opts);
		if($proposal_type==3){
			$html1=file_get_contents(SITE_PATH."inc2/proposal-format-case3-only-battery-charger.php", false, $context);
			$pdf->writeHTMLCell(0, 0, '', '0', $html1, 0, 1, 0, true, '', true);
			$pdf->AddPage();
		}
		else if($proposal_type==8){
			$html1=file_get_contents(SITE_PATH."inc2/proposal-format-case8-proposal2.php", false, $context);
			$pdf->writeHTMLCell(0, 0, '', '0', $html1, 0, 1, 0, true, '', true);
			$pdf->AddPage();
		}
		else if($proposal_type==10){
			$html1=file_get_contents(SITE_PATH."inc2/proposal-format-case10-battery.php", false, $context);
			$pdf->writeHTMLCell(0, 0, '', '0', $html1, 0, 1, 0, true, '', true);
			$pdf->AddPage();
		}
		else if($proposal_type==11){
			$html1=file_get_contents(SITE_PATH."inc2/proposal-format-case10-battery.php", false, $context);
			$pdf->writeHTMLCell(0, 0, '', '0', $html1, 0, 1, 0, true, '', true);
			$pdf->AddPage();
		}
		else{
			$html1=file_get_contents(SITE_PATH."inc2/proposal-format-case4-battery.php", false, $context);
			$pdf->writeHTMLCell(0, 0, '', '0', $html1, 0, 1, 0, true, '', true);
			$pdf->AddPage();
		}
		
		/*
		$html2=file_get_contents(SITE_PATH."inc2/proposal-format2.php", false, $context);
		//echo $html2;die;
		$pdf->writeHTMLCell(0, 0, '', '0', $html2, 0, 1, 0, true, '', true);
		$pdf->AddPage();		
		*/
		
		if($proposal_type!=5 && $proposal_type!=6 && $proposal_type!=7 && $number_of_proposal==1){
		/*$html3=file_get_contents(SITE_PATH."inc2/proposal-format3.php", false, $context);
		//echo $html2;die;
		
		$pdf->writeHTMLCell(0, 0, '', '0', $html3, 0, 1, 0, true, '', true);
		$pdf->AddPage();*/
		
		/*$html4=file_get_contents(SITE_PATH."inc2/proposal-format4.php", false, $context);
		//echo $html2;die;
		$pdf->writeHTMLCell(0, 0, '', '0', $html4, 0, 1, 0, true, '', true);
		$pdf->AddPage();*/
		}
		if($proposal_type==3){
			$html5=file_get_contents(SITE_PATH."inc2/proposal-format5-case3-only-battery-charger.php", false, $context);
			$pdf->writeHTMLCell(0, 0, '', '0', $html5, 0, 1, 0, true, '', true);
			$pdf->AddPage();
		}
		if($proposal_type==4){
			$html5=file_get_contents(SITE_PATH."inc2/proposal-format5-case4-battery.php", false, $context);
			$pdf->writeHTMLCell(0, 0, '', '0', $html5, 0, 1, 0, true, '', true);
			$pdf->AddPage();
		}
		if($proposal_type==10){
			$html5=file_get_contents(SITE_PATH."inc2/proposal-format5-case10-battery.php", false, $context);
			$pdf->writeHTMLCell(0, 0, '', '0', $html5, 0, 1, 0, true, '', true);
			$pdf->AddPage();
		}
		if($proposal_type==11){
			$html5=file_get_contents(SITE_PATH."inc2/proposal-format5-case10-battery.php", false, $context);
			$pdf->writeHTMLCell(0, 0, '', '0', $html5, 0, 1, 0, true, '', true);
			$pdf->AddPage();
		}
		if($proposal_type==8){
			$html5=file_get_contents(SITE_PATH."inc2/proposal-format5-case8-proposal2.php", false, $context);
			$pdf->writeHTMLCell(0, 0, '', '0', $html5, 0, 1, 0, true, '', true);
			$pdf->AddPage();
		}
		
		$html6=file_get_contents(SITE_PATH."inc2/proposal-format6.php", false, $context);
		$pdf->writeHTMLCell(0, 0, '', '0', $html6, 0, 1, 0, true, '', true);
		
		if(($tnc_title1 && $tnc_content1) || ($tnc_title2 && $tnc_content2)){
		$pdf->AddPage();
		$html7=file_get_contents(SITE_PATH."inc2/proposal-format7.php", false, $context);
		$pdf->writeHTMLCell(0, 0, '', '0', $html7, 0, 1, 0, true, '', true);
		}
		
		//$final_file2 = $customer_name.' '.$quotation_number.' '.date('d-m-Y').' '.date('h-s').'-proposal2.pdf';
		$final_file2 = ($proposal_name?$proposal_name.'-':'').$customer_name.'-'.$file_name.'-'.$quotation_number.'-proposal2.pdf';
		$pdf->Output(SITE_FS_PATH.'/'.UPLOAD_FILES_PTH.'/'.UP_FILES_PROPOSAL.'/'.$final_file2, 'F');
		//ob_clean();
		//$pdf->Output($invoice_Arr["order_no"].time().'.pdf', 'D');
		//return $invoice_Arr["order_no"].".pdf";
		
		//$pdf->reset();
		
		//echo $final_file;die;
		}
		//die;
		$lead_id = $_GET["pid"];
		if($lead_id){ 
			
			$_POST['proposal_pdf'] = $final_file;
			$_POST['proposal_pdf2'] = $final_file2;
			//$_POST['proposal_image_pdf'] = $final_file3;
			//$_POST['proposal_txt'] = $txtfilename;
			$cms->sqlquery("rs","leads",$_POST, 'id', $lead_id);
		}


//die;
		
		/*if(isset($_GET['start']) && $_GET['start'] > 0) {
			header('location:'.SITE_PATH_ADM.CPAGE.'/index.php?start='.$_GET['start']);
		} else {
			header('location:'.SITE_PATH_ADM.CPAGE);
		}
		*/
		
		//$path = $_SESSION['REFERER_page'];
		$path = SITE_PATH_ADM.CPAGE.'?mode=proposal-list&start=&id='.$leadID;
		echo "<script>window.location.href='".$path."';</script>";
		
?>
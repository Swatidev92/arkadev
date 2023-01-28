<?php include("../../lib/opin.inc.php");?>

<?php


error_reporting(0);
//echo $_GET['start'];die;
	//print_r($_REQUEST);die;
	$txt='';
	$rsAdmin = $cms->db_query("select id, customer_name, quotation_number, panel_model, panel_wattage, panel_count, inverter_type, inverter_type2, inverter_type3, proposal_mms_cost, charger_name, battery_name, solar_margin, solar_margin_kr, charger_margin, charger_margin_kr, proposal_type, vat_kr, vat_percentage, green_rebate_kr, number_of_proposal, charger_green_rebate_kr, charger_vat_kr, proposal_customer_type, proposal_total_price, load_balancer, battery_green_rebate_kr, battery_vat_kr, battery_margin, battery_margin_kr, proposal_total_cost, charger_price_after_green_deduction, price_after_green_deduction, battery_price_after_green_deduction, installation_days, total_discount, roofing_material, price_excluding_vat, price_including_vat, charger_price_including_vat, charger_price_excluding_vat, battery_price_excluding_vat, battery_price_including_vat, extra_green_rebate, load_balancer_margin_kr, load_balancer_vat_kr, load_balancer_green_rebate_kr, load_price_after_green_deduction, load_price_including_vat, load_price_excluding_vat, proposal_name, battery_extra_green_rebate, lead_id as leadID from #_leads where id='".$_REQUEST['pid']."'");
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
	
		//generate area-chart pdf
		
					
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
		
		$html_images=file_get_contents(SITE_PATH."inc2/proposal-format-only-images.php", false, $context);
		
		$pdf->writeHTMLCell(0, 0, '', '0', $html_images, 0, 1, 0, true, '', true);
		
		//$final_file3 = $customer_name.' '.$quotation_number.' '.date('d-m-Y').' '.date('h-s').'-area-chart.pdf';
		$final_file3 = ($proposal_name?$proposal_name.'-':'').$customer_name.'-'.$file_name.'-area-chart.pdf';
		$pdf->Output(SITE_FS_PATH.'/'.UPLOAD_FILES_PTH.'/'.UP_FILES_PROPOSAL.'/'.$final_file3, 'F');
		//ob_clean();
		//$pdf->Output($invoice_Arr["order_no"].time().'.pdf', 'D');
		//return $invoice_Arr["order_no"].".pdf";
		
		//$pdf->reset();
		
		//echo $final_file;die;
	
		//die;
		$lead_id = $_GET["pid"];
		if($lead_id){ 
			
			//$_POST['proposal_pdf'] = $final_file;
			//$_POST['proposal_pdf2'] = $final_file2;
			$_POST['proposal_image_pdf'] = $final_file3;
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
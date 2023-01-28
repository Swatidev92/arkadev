<?php include("../../lib/opin.inc.php");?>

<?php


error_reporting(0);
	//print_r($_POST);die;
	$invoice_Arr=array(
		"order_no"=>$_GET["pid"]
		);
	
	// Extend the TCPDF class to create custom Header and Footer
	class MYPDF extends TCPDF {
		  protected $last_page_flag = false;

  public function Close() {
    $this->last_page_flag = true;
    parent::Close();
  }

		// Page footer
		public function Footer() {
		// Position at 15 mm from bottom
		$this->SetY(-20);
		// Set font
		$this->SetFont('helvetica', '', 10);
		
		
			
		$footerHtml = '<table width="100%" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" modulebg="edit" style="background:#fff">
						<tbody>
							<tr>
								<td width="33.33%" style="text-align:left">	
									<p>070 245 40 04<br>info@arkaenergy.se<br>www.arkaenergy.se</p>
								</td>
								<td width="33.33%" style="text-align:left">	
									<p>Arka Energy AB<br>Birger Jarlsgatan 104B<br>Stockholm</p>
								</td>
								<td width="33.33%" style="text-align:right">	
									<img src="https://arkaenergy.se/assets/images/Arka-Logo.svg" border="0" style="display:block; border:none; outline:none; text-decoration:none; width:120px;">
								</td>
							</tr>
						</tbody>
					</table>';
			// Page number
			if ($this->last_page_flag) {
     $this->writeHTML($footerHtml, false, true, false, true); 
    }
			 
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
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

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
		$html2=file_get_contents(SITE_PATH."inc/proposal-format.php", false, $context);
		//echo $html2;die;
		$pdf->writeHTMLCell(0, 0, '', '0', $html2, 0, 1, 0, true, '', true);
		$final_file = $invoice_Arr["order_no"].time().'.pdf';
		$pdf->Output(SITE_FS_PATH.'/uploaded_files/proposal/'.$final_file, 'F');
		//ob_clean();
		//$pdf->Output($invoice_Arr["order_no"].time().'.pdf', 'D');
		//return $invoice_Arr["order_no"].".pdf";
		
		//$pdf->reset();
		
		
		$lead_id = $_GET["pid"];
		if($lead_id){ 
			
			$_POST['proposal_pdf'] = $final_file;	
			$cms->sqlquery("rs","leads",$_POST, 'id', $lead_id);
		}



		header('location:https://arkaenergy.se/arka-admin/lead-manager');
?>

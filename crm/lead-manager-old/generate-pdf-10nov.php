<?php include("../../lib/opin.inc.php");?>

<?php


error_reporting(0);
	//print_r($_REQUEST);die;
	
	$rsAdmin = $cms->db_query("select customer_name, quotation_number, panel_model, panel_wattage, panel_count, inverter_type, inverter_type2, proposal_mms_cost, charger_name, battery_name from #_leads where id='".$_REQUEST['pid']."'");
	$arrAdmin = $rsAdmin->fetch_array(); 
	@extract($arrAdmin);


	
	
		//generate txt 
		$txtfilename = $customer_name.' '.$quotation_number.' '.date('d-m-Y').' '.date('h-s').'.txt';
		
		$txtfullpath = "../../uploaded_files/proposal/".$txtfilename;
		
		$myfile = fopen($txtfullpath, "w") or die("Unable to open file!");
		$txt = "1. Panel type:".$panel_model." - ".$panel_wattage.", Quantity:".$panel_count."\n";
		$txt .= "2. Inverter type:".$inverter_type." , Quantity:1\n";
		$txt .= "3. MMS cost (kr):".$proposal_mms_cost."\n";
		$txt .= "4. EV charger:".$charger_name.", Quantity:1\n";
		$txt .= "5. Battery:".$battery_name.", Quantity:1";
		
		/*if (file_put_contents($newFileName, $newFileContent) !== false) {
			echo "File created (" . basename($newFileName) . ")";
		}*/

		fwrite($myfile, $txt);
		fclose($myfile);


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
									<img src="https://arkaenergy.se/assets/images/Arka-Logo.svg" border="0" style="display:block; border:none; outline:none; text-decoration:none; width:150px;">
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
		$context  = stream_context_create($opts);
		$html1=file_get_contents(SITE_PATH."inc/proposal-format.php", false, $context);
		$pdf->writeHTMLCell(0, 0, '', '0', $html1, 0, 1, 0, true, '', true);
		$pdf->AddPage();
		
		$html2=file_get_contents(SITE_PATH."inc/proposal-format2.php", false, $context);
		//echo $html2;die;
		$pdf->writeHTMLCell(0, 0, '', '0', $html2, 0, 1, 0, true, '', true);
		$pdf->AddPage();
		
		$html3=file_get_contents(SITE_PATH."inc/proposal-format3.php", false, $context);
		$pdf->writeHTMLCell(0, 0, '', '0', $html3, 0, 1, 0, true, '', true);
		$pdf->AddPage();
		
		$html4=file_get_contents(SITE_PATH."inc/proposal-format4.php", false, $context);
		//echo $html2;die;
		$pdf->writeHTMLCell(0, 0, '', '0', $html4, 0, 1, 0, true, '', true);
		$pdf->AddPage();
		
		$html5=file_get_contents(SITE_PATH."inc/proposal-format5.php", false, $context);
		$pdf->writeHTMLCell(0, 0, '', '0', $html5, 0, 1, 0, true, '', true);
		$pdf->AddPage();
		
		$html6=file_get_contents(SITE_PATH."inc/proposal-format6.php", false, $context);
		//echo $html2;die;
		$pdf->writeHTMLCell(0, 0, '', '0', $html6, 0, 1, 0, true, '', true);
		
		$final_file = $customer_name.' '.$quotation_number.' '.date('d-m-Y').' '.date('h-s').'.pdf';
		$pdf->Output(SITE_FS_PATH.'/uploaded_files/proposal/'.$final_file, 'F');
		//ob_clean();
		//$pdf->Output($invoice_Arr["order_no"].time().'.pdf', 'D');
		//return $invoice_Arr["order_no"].".pdf";
		
		//$pdf->reset();
		
		//echo $final_file;die;
		
		$lead_id = $_GET["pid"];
		if($lead_id){ 
			
			$_POST['proposal_pdf'] = $final_file;
			$_POST['proposal_txt'] = $txtfilename;
			$cms->sqlquery("rs","leads",$_POST, 'id', $lead_id);
		}


//die;
		header('location:'.SITE_PATH.'arka-admin/lead-manager');
?>

<?php
include("../../../lib/opin.inc.php");									

//update data in table
if($_POST['enskild_firma']=='on'){
	$_POST['enskild_firma']=1;
}else{
	$_POST['enskild_firma']=0;
}
$cms->sqlquery("rs","customer_project",$_POST,'id',$_POST['project_id']);


$leadQry = $cms->db_query("SELECT * FROM #_leads where id=".$_POST['cust_id']." ");
$leadRes = $leadQry->fetch_array(); 

$projectQry = $cms->db_query("SELECT * FROM #_customer_project where id=".$_POST['project_id']." ");
$projectRes = $projectQry->fetch_array(); 

if($projectRes['not_same_bill']==1)
{
	$customer_name = $projectRes['cust_name_bill'];
	$personnummer = $projectRes['personnummer_bill'];
	$email = $projectRes['email_bill'];
	$phone = $projectRes['phone_bill'];
}
else{
	$customer_name = $leadRes['customer_name'];
	$personnummer = $leadRes['personnummer'];
	$email = $leadRes['email'];
	$phone = $leadRes['phone'];
}
						
use setasign\Fpdi;
use setasign\fpdf;
require_once 'vendor/autoload.php';
require_once 'vendor/setasign/fpdf/fpdf.php';


$pdf = new Fpdi\Fpdi();
//$pdf = new Fpdi\TcpdfFpdi('L', 'mm', 'A3');

if ($pdf instanceof \TCPDF) {
    $pdf->SetProtection(['print'], '', 'owner');
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
}

$pdf->setSourceFile('EON.pdf');

$pdf->AddPage();
$tplIdx = $pdf->importPage(1);

$pdf->useTemplate($tplIdx, 10, 10, 200);
	
$pdf->SetFont('Arial', '', '8');
$pdf->SetTextColor(0,0,0);
$pdf->Text(80,193,iconv('UTF-8', 'windows-1252', html_entity_decode($customer_name)));
$pdf->Text(70,201,iconv('UTF-8', 'windows-1252', html_entity_decode($projectRes['project_address'])));
$pdf->Text(110,210,$projectRes['plant_id']);
$pdf->SetFont('Arial', 'B', '7');
$pdf->Text(64,224,'X');

$pdf->AddPage();
$tplIdx = $pdf->importPage(2);

$pdf->useTemplate($tplIdx, 10, 10, 200); // dynamic parameter based on your page

$pdf->SetFont('Arial', '', '8');
$pdf->SetTextColor(0,0,0);
$pdf->Text(55,189,'0');
$pdf->Text(113,238,iconv('UTF-8', 'windows-1252', html_entity_decode($customer_name)));
$pdf->Text(113,251,$phone);


$file_name = $leadRes['customer_name'].'-EON-'.$leadRes['quotation_number'].'-'.time().'.pdf';

//$pdf->Output('I', 'simple.pdf');
$pdf->Output(SITE_FS_PATH.'/'.UPLOAD_FILES_PTH.'/'.UP_FILES_GRID_PROVIDERS.'/'.$file_name, 'F');

$FILE_UPLOAD['grid_provider_template'] = $file_name;
$cms->sqlquery("rs","customer_project",$FILE_UPLOAD,'id',$_POST['project_id']);

$path = SITE_PATH_ADM."customer-project/?mode=add&start=&id=".$_POST['project_id']."#grid_details";
$cms->redir($path, true);
exit();

//$pdf->Output($file_name, 'D');
?>
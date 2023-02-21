<?php
include("../../../lib/opin.inc.php");									

//print_r($_POST);die;


$leadQry = $cms->db_query("SELECT * FROM #_leads where id=".$_POST['cust_id']." ");
$leadRes = $leadQry->fetch_array(); 

$projectQry = $cms->db_query("SELECT * FROM #_customer_project where id=".$_POST['project_id']." ");
$projectRes = $projectQry->fetch_array(); 

					
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

$pdf->setSourceFile('egenkontroll.pdf');

$pdf->AddPage();
$tplIdx = $pdf->importPage(1);

$pdf->useTemplate($tplIdx, 10, 10, 200);
	
$pdf->SetFont('Arial', '', '7');
$pdf->SetTextColor(0,0,0);
$pdf->Text(148,50,iconv('UTF-8', 'windows-1252', html_entity_decode($projectRes['project_name'])));

$pdf->Text(92,230,iconv('UTF-8', 'windows-1252', html_entity_decode($projectRes['inverter1_qty'].'x '.$projectRes['inverter1'])));
$pdf->Text(92,233,iconv('UTF-8', 'windows-1252', html_entity_decode($projectRes['inverter2_qty'].'x '.$projectRes['inverter2'])));
$pdf->Text(92,235,iconv('UTF-8', 'windows-1252', html_entity_decode($projectRes['inverter3_qty'].'x '.$projectRes['inverter3'])));


$system_size = $projectRes['system_size']/1000;

$pdf->Text(92,239,iconv('UTF-8', 'windows-1252', html_entity_decode($system_size.' kW')));



$pdf->AddPage();
$tplIdx = $pdf->importPage(2);

$pdf->useTemplate($tplIdx, 10, 10, 200); // dynamic parameter based on your page

$pdf->SetFont('Arial', '', '8');
$pdf->SetTextColor(0,0,0);
$pdf->Text(92,121,iconv('UTF-8', 'windows-1252', html_entity_decode($system_size.' W')));
$pdf->Text(92,45,iconv('UTF-8', 'windows-1252', html_entity_decode($system_size.' W')));
$pdf->Text(92,59,iconv('UTF-8', 'windows-1252', html_entity_decode($projectRes['main_fuse'])));


$pdf->AddPage();
$tplIdx = $pdf->importPage(3);

$pdf->useTemplate($tplIdx, 10, 10, 200); // dynamic parameter based on your page



$pdf->AddPage();
$tplIdx = $pdf->importPage(4);

$pdf->useTemplate($tplIdx, 10, 10, 200); // dynamic parameter based on your page


$pdf->AddPage();
$tplIdx = $pdf->importPage(5);

$pdf->useTemplate($tplIdx, 10, 10, 200); // dynamic parameter based on your page

$pdf->SetFont('Arial', '', '7');
$pdf->SetTextColor(0,0,0);
$pdf->Text(95,117,iconv('UTF-8', 'windows-1252', html_entity_decode($system_size.' kW')));
$pdf->Text(95,124,iconv('UTF-8', 'windows-1252', html_entity_decode($projectRes['panel_name'])));
$pdf->Text(95,127,iconv('UTF-8', 'windows-1252', html_entity_decode($projectRes['inverter1_qty'].'x '.$projectRes['inverter1'])));
$pdf->Text(95,130,iconv('UTF-8', 'windows-1252', html_entity_decode($projectRes['inverter2_qty'].'x '.$projectRes['inverter2'])));
$pdf->Text(95,133,iconv('UTF-8', 'windows-1252', html_entity_decode($projectRes['inverter3_qty'].'x '.$projectRes['inverter3'])));
$pdf->Text(95,148,iconv('UTF-8', 'windows-1252', html_entity_decode($projectRes['project_address'].', ')));
$pdf->Text(95,151,iconv('UTF-8', 'windows-1252', html_entity_decode($projectRes['project_city'].', '.$projectRes['project_postal_code'].', '.$projectRes['project_country'])));


$pdf->Text(95,157,iconv('UTF-8', 'windows-1252', html_entity_decode($gridProvider[$projectRes['grid_provider']])));

$pdf->AddPage();
$tplIdx = $pdf->importPage(6);

$pdf->useTemplate($tplIdx, 10, 10, 200); // dynamic parameter based on your page

$pdf->AddPage();
$tplIdx = $pdf->importPage(7);

$pdf->useTemplate($tplIdx, 10, 10, 200); // dynamic parameter based on your page

/*
$pdf->AddPage();
$tplIdx = $pdf->importPage(6);

$pdf->useTemplate($tplIdx, 10, 10, 200); // dynamic parameter based on your page

$pdf->SetFont('Arial', '', '8');
$pdf->SetTextColor(0,0,0);
$pdf->Text(55,189,'0');
$pdf->Text(113,238,iconv('UTF-8', 'windows-1252', html_entity_decode($customer_name)));


$pdf->AddPage();
$tplIdx = $pdf->importPage(7);

$pdf->useTemplate($tplIdx, 10, 10, 200); // dynamic parameter based on your page

$pdf->SetFont('Arial', '', '8');
$pdf->SetTextColor(0,0,0);
$pdf->Text(55,189,'0');
$pdf->Text(113,238,iconv('UTF-8', 'windows-1252', html_entity_decode($customer_name)));
*/

//$file_name = $leadRes['customer_name'].'-egenkontroll-'.'-'.time().'.pdf';
$file_name = $leadRes['customer_name'].'-egenkontroll-'.'.pdf';

//$pdf->Output('I', 'simple.pdf');
$pdf->Output(SITE_FS_PATH.'/'.UPLOAD_FILES_PTH.'/'.UP_FILES_EGENKONTROLL.'/'.$file_name, 'F');

$FILE_UPLOAD['egenkontroll_document'] = $file_name;
$cms->sqlquery("rs","customer_project",$FILE_UPLOAD,'id',$_POST['project_id']);

$path = SITE_PATH_ADM."customer-project/?mode=add&t=documentation&start=&id=".$_POST['project_id']."#documentation";
$cms->redir($path, true);
exit();

//$pdf->Output($file_name, 'D');
?>
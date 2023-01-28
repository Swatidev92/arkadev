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

$files = [
        'foranmlan.nu.pdf',
];

foreach ($files as $file) {
    $pageCount = $pdf->setSourceFile($file);

    for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
        $pdf->AddPage();
        $pageId = $pdf->importPage($pageNo, '/MediaBox');
        //$pageId = $pdf->importPage($pageNo, Fpdi\PdfReader\PageBoundaries::ART_BOX);
        $s = $pdf->useTemplate($pageId, 10, 10, 200);
    }
}

	
$pdf->SetFont('Arial', '', '8');
$pdf->SetTextColor(0,0,0);
$pdf->Text(65,120,iconv('UTF-8', 'windows-1252', html_entity_decode($leadRes['customer_name'])));
$pdf->Text(65,124,iconv('UTF-8', 'windows-1252', html_entity_decode($projectRes['project_address'])));
$pdf->Text(65,128,iconv('UTF-8', 'windows-1252', html_entity_decode($leadRes['email'])));
$pdf->Text(65,132,$projectRes['plant_id']);
$pdf->Text(138,120,$leadRes['phone']);
$pdf->Text(138,132,iconv('UTF-8', 'windows-1252', html_entity_decode($projectRes['main_fuse'])));

if($projectRes['inverter1']){
	$total_inverter = '';
	$total_inverter_qty = 0;
	$total_inverter = $projectRes['inverter1'];
	$total_inverter_effect = $projectRes['inverter1_effect'];
	$total_inverter_qty = $total_inverter_qty+$projectRes['inverter1_qty'];
}
if($projectRes['inverter2']){
	$total_inverter .= ', '.$projectRes['inverter2'];
	$total_inverter_effect .= ', '.$projectRes['inverter2_effect'];
	$total_inverter_qty = $total_inverter_qty+$projectRes['inverter2_qty'];
}
if($projectRes['inverter3']){
	$total_inverter .= ', '.$projectRes['inverter3'];
	$total_inverter_effect .= ', '.$projectRes['inverter3_effect'];
	$total_inverter_qty = $total_inverter_qty+$projectRes['inverter3_qty'];
}

if($projectRes['inverter1_effect']){
	$total_inverter_effect = '';
	$total_inverter_effect = $projectRes['inverter1_effect'];
}
if($projectRes['inverter2_effect']){
	$total_inverter_effect .= ', '.$projectRes['inverter2_effect'];
}
if($projectRes['inverter3_effect']){
	$total_inverter_effect .= ', '.$projectRes['inverter3_effect'];
}

$pdf->Text(80,155,iconv('UTF-8', 'windows-1252', html_entity_decode($total_inverter)));
$pdf->Text(85,161,$total_inverter_qty);
$pdf->Text(85,166.5,iconv('UTF-8', 'windows-1252', html_entity_decode($projectRes['short_circuit'])));
$pdf->Text(138,161,$total_inverter_effect);
$pdf->Text(138,166.5,$projectRes['effektfaktor']);
$pdf->Text(140,173,$projectRes['battery_size']);
$pdf->Text(110,243,iconv('UTF-8', 'windows-1252', html_entity_decode($leadRes['customer_name'])));
$pdf->Text(118,254,$leadRes['phone']);
$pdf->SetFont('Arial', 'B', '6');
$pdf->Text(102,145,'X');
$pdf->Text(90.5,172.5,'X');
$pdf->Text(122,186,'X');
$pdf->Text(40,195.5,'X');
$pdf->Text(40,200,'X');
//$pdf->Text(104,205,'X');
if($projectRes['odrift_name']!=''){
	$pdf->Text(92,181,'X');
}
if($projectRes['electricity_meter']!='' && $projectRes['electricity_meter']==1){
	$pdf->Text(40,205,'X');
}
if($projectRes['electricity_meter']!='' && $projectRes['electricity_meter']==2){
	$pdf->Text(71,205,'X');
}
if($projectRes['electricity_meter']!='' && $projectRes['electricity_meter']==3){
	$pdf->Text(104,205,'X');
}
$file_name = $leadRes['customer_name'].'-foranmlan-'.$leadRes['quotation_number'].'-'.time().'.pdf';

//$pdf->Output('I', 'simple.pdf');
$pdf->Output(SITE_FS_PATH.'/uploaded_files/grid-provider/'.$file_name, 'F');

$FILE_UPLOAD['grid_provider_template'] = $file_name;
$cms->sqlquery("rs","customer_project",$FILE_UPLOAD,'id',$_POST['project_id']);

$path = SITE_PATH_ADM."customer-project/?mode=add&start=&id=".$_POST['project_id']."#grid_details";
$cms->redir($path, true);
exit();

//$pdf->Output($file_name, 'D');

?>

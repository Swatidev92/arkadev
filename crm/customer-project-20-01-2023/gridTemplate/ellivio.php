<?php
include("../../../lib/opin.inc.php");									

//update data in table
if($_POST['enskild_firma']=='on'){
	$_POST['enskild_firma']=1;
}else{
	$_POST['enskild_firma']=0;
}
$cms->sqlquery("rs","customer_project",$_POST,'id',$_POST['project_id']);

$LEADARR['personnummer'] = $_POST['personnummer'];
$cms->sqlquery("rs","leads",$LEADARR,'id',$_POST['cust_id']);

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
	$phone = $projectRes['phone_bill'];
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

$files = [
        'Ellivio.pdf',
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

if($leadRes['proposal_customer_type']==1){
	$pdf->SetFont('Arial', 'B', '10');
	$pdf->Text(34,64.5,'X');
}
if($leadRes['proposal_customer_type']==2 && $projectRes['enskild_firma']==0){
	$pdf->SetFont('Arial', 'B', '10');
	$pdf->Text(34,75,'X');
}

if($projectRes['enskild_firma']==1){
	$pdf->SetFont('Arial', 'B', '10');
	$pdf->Text(34,70,'X');
}

$pdf->SetFont('Arial', '', '8');
if($projectRes['plant_id']){
	$plantIDArr = str_split($projectRes['plant_id']);
	foreach($plantIDArr as $ptkey=>$ptid){
		$x_axis = $i+36;
		$y_axis = 97;
		$pdf->Text($x_axis,$y_axis,$ptid);	
		$i = $i+10;
	}
}

$pdf->Text(62,106,iconv('UTF-8', 'windows-1252', html_entity_decode($projectRes['project_address'])));

if($leadRes['proposal_customer_type']==2 && $projectRes['enskild_firma']==0){
	$pdf->Text(60,187,iconv('UTF-8', 'windows-1252', html_entity_decode($projectRes['company_name'])));
}
if($leadRes['proposal_customer_type']==2 && $projectRes['enskild_firma']==1){
	$pdf->Text(60,187,iconv('UTF-8', 'windows-1252', html_entity_decode($projectRes['company_name'])));
}

$pdf->Text(60,177,iconv('UTF-8', 'windows-1252', html_entity_decode($customer_name)));

if($leadRes['proposal_customer_type']==2 && $projectRes['enskild_firma']==0){
	$pdf->Text(140,177,$projectRes['org_number']);
}
if($leadRes['proposal_customer_type']==1){
	$pdf->Text(140,177,$personnummer);
}
if($leadRes['proposal_customer_type']==2 && $projectRes['enskild_firma']==1){
	$pdf->Text(140,177,$personnummer);
}

$pdf->Text(140,187,$phone);
$pdf->Text(60,196,iconv('UTF-8', 'windows-1252', html_entity_decode($projectRes['project_address'])));
$pdf->Text(140,196,iconv('UTF-8', 'windows-1252', html_entity_decode($email)));
$pdf->Text(40,206,$projectRes['project_postal_code']);
$pdf->Text(80,206,iconv('UTF-8', 'windows-1252', html_entity_decode($projectRes['project_city'])));
$pdf->Text(105,253,iconv('UTF-8', 'windows-1252', html_entity_decode($customer_name)));
$pdf->Text(40,241,date('Ymd'));
$pdf->Text(62,241,iconv('UTF-8', 'windows-1252', html_entity_decode($projectRes['project_city'])));

$file_name = $leadRes['customer_name'].'-Ellevio-'.$leadRes['quotation_number'].'-'.time().'.pdf';

//$pdf->Output('I', 'simple.pdf');
$pdf->Output(SITE_FS_PATH.'/'.UPLOAD_FILES_PTH.'/'.UP_FILES_GRID_PROVIDERS.'/'.$file_name, 'F');

$FILE_UPLOAD['grid_provider_template'] = $file_name;
$cms->sqlquery("rs","customer_project",$FILE_UPLOAD,'id',$_POST['project_id']);

$path = SITE_PATH_ADM."customer-project/?mode=add&start=&id=".$_POST['project_id']."#grid_details";
$cms->redir($path, true);
exit();

//$pdf->Output($file_name, 'D');
?>

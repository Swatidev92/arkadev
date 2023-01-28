<?php include("../../lib/opin.inc.php");?>

<script src="<?=SITE_PATH?>assets/code/highcharts.js"></script>
<script src="<?=SITE_PATH?>assets/code/modules/exporting.js"></script>
<script src="<?=SITE_PATH?>assets/code/modules/export-data.js"></script>

<?php 

$total_prod = 12777;
$total_consumption = 12000;


//$total_prod = $_POST['annual_production'];
//$total_consumption = $_POST['annual_electricity_consumption'];

$fixedProdArr = array(217, 363, 1373, 1593, 1758, 1703, 1648, 1538, 1264, 769, 330, 220);
$fixedConsumtionArr = array(1680, 1519, 1359, 1080, 680, 440, 360, 399, 600, 960, 1400, 1520);



for($i=0; $i<12; $i++){	
	$chartProduction[] = round(($fixedProdArr[$i]*100)/$total_prod);
	$chartConsumption[] = round(($fixedConsumtionArr[$i]*100)/$total_consumption);
}
$jsonProd = json_encode($chartProduction);
$jsonConsum = json_encode($chartConsumption);
//print_r($chartProduction).'<br>'; 
//print_r($chartConsumption); die;
?>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>



<script type="text/javascript">
Highcharts.setOptions({
    colors: ['#c0504d', '#4f81bd']
});
const chart = Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'UPPSKATTAD PRODUKTIONSBERÄKNING'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec'
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
		tickInterval: 200,
        title: {
            text: ''
        }
    },
	
	/*
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
	*/
    plotOptions: {
        column: {
            pointPadding: 0,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Consumption',
        //data: [1680, 1519, 1359, 1080, 680, 440, 360, 399, 600, 960, 1400, 1520]
        data: <?=$jsonConsum?>

    }, {
        name: 'Production',
        //data: [217, 363, 1373, 1593, 1758, 1703, 1648, 1538, 1264, 769, 330, 220]
		data: <?=$jsonProd?>

    }]
});

// the button handler
    chart.exportChart({
        type: 'image/png',
        filename: 'my-pdf'
    });

</script>

<?php


error_reporting(0);
	//print_r($_POST);die;
	
	if($_FILES["installation_image"]["name"]){ 
		$_POST["installation_image"] = uploadImage("installation_image","proposal");
	}
	
	$customerPriceQry = $cms->db_query("SELECT * FROM #_customer_price where id=1 ");
	$customerPriceArr = $customerPriceQry->fetch_array(); 
	
	$obj_smrg = json_decode($customerPriceArr['solar_margin']);
	$obj_sdis = json_decode($customerPriceArr['solar_discount']);
	$obj_solar = json_decode($customerPriceArr['green_rebate_solar']);
	$obj_shipcost = json_decode($customerPriceArr["shipment_cost"]);
	$obj_mmscost = json_decode($customerPriceArr["mms_cost"]);
	

	$panelTyeArray = json_decode($customerPriceArr["panel_types"], true);
	foreach ($panelTyeArray as $key => $value) {
		if($value["name"] == $_POST['panel_model']){
			$_POST['panel_cost'] = $value["price"];
			$_POST['panel_wattage'] = $value["wattage"];
		}
	}
	
	$inverterTyeArray = json_decode($customerPriceArr["inverter_types"], true);
	foreach ($inverterTyeArray as $ikey => $ivalue) {
		if($ivalue["name"] == $_POST['inverter_type']){
			$_POST['inverter_cost'] = $ivalue["price"];
		}
	}
	
	$installationArray = json_decode($customerPriceArr["installation_charges"], true);
	foreach ($installationArray as $inkey => $invalue) {
		if($invalue["day"] == $_POST['installation_days']){
			$_POST['installation_cost'] = $invalue["price"];
		}
	}
	
	
	$_POST['system_size'] = $_POST['panel_wattage']*$_POST['panel_count']; //(panel wattage * number of panels)
	
	
	$cost = ($_POST['panel_cost']*$_POST['panel_count']) + $_POST['inverter_cost'] + $obj_mmscost[0]->mmscost + $obj_shipcost[0]->shipmentcost + $_POST['installation_cost'];
	
	
	//for Battery
	if($_POST['battery_name']!=''){
		
		$obj_btmrg = json_decode($customerPriceArr['battery_margin']);
		
		$obj_battery = json_decode($customerPriceArr['green_rebate_battery']);
		
		$batteryTyeArray = json_decode($customerPriceArr["battery_types"], true);
		foreach ($batteryTyeArray as $bkey => $bvalue) {
			if($bvalue["name"] == $_POST['battery_name']){
				$_POST['battery_price'] = $bvalue["price"];
			}
		}
		
		$_POST['battery_price_excluding_vat'] = $_POST['battery_price']*$obj_btmrg[0]->margin/100; //Battery Price (excluding VAT) (P) = Battery cost * Margins for Battery (%)
		
		$_POST['battery_price_including_vat'] = $_POST['battery_price_excluding_vat']*1.25; //Battery Price (including VAT) P1 = P x 1.25
		
		$_POST['battery_price_after_green_deduction'] = $_POST['battery_price_including_vat']*(100-$obj_battery[0]->rebate);  //Battery Price (after green avdrag) = P1 x (100 – BGA)
	}
	
	
	//for EV Charger
	if($_POST['charger_name']!=''){
		
		$obj_evmrg = json_decode($customerPriceArr['ev_margin']);
		
		$obj_ev = json_decode($customerPriceArr['green_rebate_ev']);
		
		$chargerTyeArray = json_decode($customerPriceArr["ev_charger_types"], true);
		foreach ($chargerTyeArray as $ckey => $cvalue) {
			if($cvalue["name"] == $_POST['charger_name']){
				$_POST['charger_price'] = $cvalue["price"];
			}
		}
			
		$_POST['charger_price_excluding_vat'] = $_POST['charger_price']*$obj_evmrg[0]->margin/100; //EV charger Price (excluding VAT) (P) =  EV charger cost * Margins for EV charger (%)
		
		$_POST['charger_price_including_vat'] = $_POST['charger_price_excluding_vat']*1.25; //EV charger Price (including VAT) P1 = P x 1.25
		
		$_POST['charger_price_after_green_deduction'] = $_POST['charger_price_including_vat']*(100-$obj_ev[0]->rebate);  //EV charger Price (after green avdrag) = P1 x (100 – EVGA)

	}
	
	//for solar panels
	
	$_POST['price_excluding_vat'] = $cost*$obj_smrg[0]->margin/100; //Price (excluding VAT)(P) = Cost* Margin for panels
	$_POST['price_including_vat'] = $_POST['price_excluding_vat']*1.25; //Price (including VAT) P1 = P x 1.25
	$_POST['price_after_discount'] = $_POST['price_including_vat']*(100-$obj_sdis[0]->discount); //Price (after discount) P2 = P1 x (100-Discount)
	
	$_POST['price_after_green_deduction'] = $_POST['price_after_discount']*(100-$obj_solar[0]->rebate); //Price (after green avdrag) = P2 x (100 – GA)

	
	$_POST['price_after_green_deduction'] = 139414;

	
	$_POST['total_weighted_electricity_price'] =  (($_POST['own_consumption']*$_POST['self_use_solar']) + ($_POST['sold_electricity']*(100-$_POST['self_use_solar'])))/100;
	
	
	
	$payback_table = '<table width="100%" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" modulebg="edit" style="background:#fff">
								<tbody>
									<tr>
										<th style="background-color:#eee; text-align:center;">År.</th>
										<th style="background-color:#eee; text-align:center;">Viktat elpris.</th>
										<th style="background-color:#eee; text-align:center;">Produktion solel</th>
										<th style="background-color:#eee; text-align:center;">Årligbesparing</th>
										<th style="background-color:#eee; text-align:center;">Avkastning.</th>
										<th style="background-color:#eee; text-align:center;">Kvar</th>
									</tr>';

	$payback_year_count=0;

	
	$total_annual_saving = ($_POST['annual_production']*$_POST['total_weighted_electricity_price']);
	$return_percentage = (($total_annual_saving)*100)/$_POST['price_after_green_deduction']; 
	$left_amount = $_POST['price_after_green_deduction'] - $total_annual_saving;
	
	
									
	$payback_table .='<tr>
							<td style="text-align:center;">1</td>
							<td style="text-align:center;">'.$_POST['total_weighted_electricity_price'].'</td>
							<td style="text-align:center;">'.$_POST['annual_production'].' kWh</td>
							<td style="text-align:center;">'.$total_annual_saving.' kr</td>
							<td style="text-align:center;">'.number_format($return_percentage,2).'%</td>
							<td style="text-align:center;">'.$left_amount.' kr</td>
						</tr>';	
	
	$payback_year_count=1;
	//echo $left_amount;die;
	//$prevWeightedPrice = 1.19;
	$prevWeightedPrice = $_POST['total_weighted_electricity_price'];
	$prevAnnualProd = $_POST['annual_production'];
	
	$k=2;
	while($left_amount>=0){
							
	$next_year_weighted_price = ($prevWeightedPrice + ($prevWeightedPrice*$_POST['annual_inflation']/100));
	
	$next_year_annual_prod = $prevAnnualProd-(($prevAnnualProd*$_POST['annual_deterioration_percent'])/100);
	$total_annual_saving = ($next_year_annual_prod*$next_year_weighted_price);
	$return_percentage = (($total_annual_saving)*100)/$_POST['price_after_green_deduction']; 
	$left_amount = $_POST['price_after_green_deduction'] - $total_annual_saving;

	//$zero_left_amount = $left_amount;
	
	$payback_table .='<tr>
							<td style="text-align:center;">'.$k.'</td>
							<td style="text-align:center;">'.number_format($next_year_weighted_price,2).'</td>
							<td style="text-align:center;">'.number_format($next_year_annual_prod,2).' kWh</td>
							<td style="text-align:center;">'.number_format($total_annual_saving,2).' kr</td>
							<td style="text-align:center;">'.number_format($return_percentage,2).'%</td>
							<td style="text-align:center;">'.number_format($left_amount,2).' kr</td>
						</tr>';	
		$payback_year_count++;
		//echo 'left_amount'.$left_amount;
	if($k==12){
		break;
	}
	$prevWeightedPrice = $next_year_weighted_price;
	$prevAnnualProd = $next_year_annual_prod;
	$k++;
	}
	
	$payback_table .='</tbody>
							</table>';
									
	//echo $payback_table;die;
	
	
	?>


		
		<?php
	
	
	
	
	$lead_id = $_POST['pid'];
	if($lead_id){ 
		//$_POST['created_date'] =  date("H:i a");
		$_POST["update_date"] = date("Y-m-d h:i:s");
		if($assigned_to){
			$_POST["assigned_date"] = date("Y-m-d h:i:s");
		}		
		$cms->sqlquery("rs","leads",$_POST, 'id', $lead_id);
	}else{
		$_POST["form_type"] = 4;
		$_POST["update_date"] = date("Y-m-d h:i:s");
		$_POST["post_date"] = date("Y-m-d");
		$lead_insert_id=$cms->sqlquery("rs","leads",$_POST);
	}
	
	$_POST['payback_table']=$payback_table;
	$_POST['chart_html']=$chart_html;
	$invoice_Arr=$_POST;
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
		//$pdf->Output(SITE_FS_PATH.'/uploaded_files/proposal/'.$invoice_Arr["order_no"].time().'.pdf', 'F');
		ob_clean();
		$pdf->Output($invoice_Arr["order_no"].time().'.pdf', 'D');
		//return $invoice_Arr["order_no"].".pdf";
		
		exit;
?>
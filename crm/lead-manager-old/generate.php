<?php include("../../lib/opin.inc.php");?>

<script src="<?=SITE_PATH?>Highcharts-6.1.1/code/highcharts.js"></script>
<script src="<?=SITE_PATH?>Highcharts-6.1.1/code/modules/exporting.js"></script>
<script src="<?=SITE_PATH?>Highcharts-6.1.1/code/modules/export-data.js"></script>
<script src="<?=SITE_PATH_ADM?>js/jquery-3.3.1.min.js"></script>
<!--<script src="<?=SITE_PATH?>lib/Highcharts-6.1.1/examples/column-basic/jquery-3.3.1.min.js"></script>-->

<?php 
$str =  $_SERVER['HTTP_REFERER'];

//$str = 'index.php?col=example&order=example2';
$qs = parse_url($str, PHP_URL_QUERY);
if(!empty($qs)){
    parse_str($qs, $output);
    $pageTo =  $output['start']; 
}


//print_r($_POST);die;

$total_inverter_cost=0;
$total_prod = $_POST['annual_production'];
$total_consumption = $_POST['annual_electricity_consumption'];

if($_FILES["installation_image"]["name"]){ 
		$_POST["installation_image"] = uploadImage("installation_image","proposal");
	}
	
	$customerPriceQry = $cms->db_query("SELECT * FROM #_customer_price where id=1 ");
	$customerPriceArr = $customerPriceQry->fetch_array(); 
	
	$obj_smrg = json_decode($customerPriceArr['solar_margin']);
	$obj_sdis = json_decode($customerPriceArr['solar_discount']);
	$obj_solar = json_decode($customerPriceArr['green_rebate_solar']);
	$obj_shipcost = json_decode($customerPriceArr["shipment_cost"]);
	//$obj_mmscost = json_decode($customerPriceArr["mms_cost"]);
	$obj_orderPayment = json_decode($customerPriceArr['pay_at_ordering']);
	$obj_shipcost = json_decode($customerPriceArr['shipment_cost']);
	$obj_mounting = json_decode($customerPriceArr['mounting_structure']);
	$obj_prod = json_decode($customerPriceArr['production_data']);
	$obj_elect = json_decode($customerPriceArr['electricity_data']);
	
	
	$_POST['product_guarantee_mounting_system'] = $obj_mounting[0]->mwarranty;
	$_POST['annual_inflation'] = $obj_prod[0]->prod_inflation;
	$_POST['price_increase'] = $obj_prod[0]->prod_price_increase;
	$_POST['annual_deterioration_percent'] = $obj_prod[0]->prod_deterioration;
	$_POST['power_loss'] = $obj_prod[0]->prod_power_loss;
	$_POST['own_consumption'] = $obj_elect[0]->elec_consumption;
	$_POST['sold_electricity'] = $obj_elect[0]->elec_sold;
	

	$panelTyeArray = json_decode($customerPriceArr["panel_types"], true);
	foreach ($panelTyeArray as $key => $value) {
		if($value["name"] == $_POST['panel_model']){
			$_POST['panel_cost'] = $value["price"];
			$_POST['panel_wattage'] = $value["wattage"];
			$_POST['warranty_solar'] = $value["swarranty"];
			$_POST['solar_effect_warranty'] = $value["effectWarranty"];
			$_POST['supplier_solar_cells'] = $value["brand"];
			$_POST['guarantee_after_30_years'] = $value["warranty_percentage"];
		}
	}
	
	$inverterTyeArray = json_decode($customerPriceArr["inverter_types"], true);
	foreach ($inverterTyeArray as $ikey => $ivalue) {
		if($ivalue["name"] == $_POST['inverter_type']){
			$_POST['inverter_cost'] = $ivalue["price"];
			$_POST['warranty_inverter'] = $ivalue["invwarranty"];
			$_POST['inverter_brand'] = $ivalue["invbrand"];
		}
	}
	
	if($_POST['inverter_type2']!=''){
		$inverterTyeArray = json_decode($customerPriceArr["inverter_types"], true);
		foreach ($inverterTyeArray as $ikey => $ivalue) {
			if($ivalue["name"] == $_POST['inverter_type2']){
				$_POST['inverter_cost2'] = $ivalue["price"];
				$_POST['warranty_inverter2'] = $ivalue["invwarranty"];
				$_POST['inverter_brand2'] = $ivalue["invbrand"];
			}
		}
	}
	
	$installationArray = json_decode($customerPriceArr["installation_charges"], true);
	foreach ($installationArray as $inkey => $invalue) {
		if($invalue["day"] == $_POST['installation_days']){
			$_POST['installation_cost'] = $invalue["price"];
			$_POST['work_performed'] = $invalue["work_year"];
		}
	}
	
	
	$_POST['system_size'] = $_POST['panel_wattage']*$_POST['panel_count']; //(panel wattage * number of panels)
	
	if($_POST['inverter_type2']!=''){
		$total_inverter_cost = $_POST['inverter_cost']+$_POST['inverter_cost2'];
	}else{
		$total_inverter_cost = $_POST['inverter_cost'];
	}
	//echo $_POST['installation_cost'];die;
	
	$cost = ($_POST['panel_cost']*$_POST['panel_count']) + $total_inverter_cost + $_POST['proposal_mms_cost'] + $obj_shipcost[0]->shipmentcost + $_POST['installation_cost'];
	
	
	//for Battery
	if($_POST['battery_name']!=''){
		
		$obj_btmrg = json_decode($customerPriceArr['battery_margin']);
		
		$obj_battery = json_decode($customerPriceArr['green_rebate_battery']);
		
		$batteryTyeArray = json_decode($customerPriceArr["battery_types"], true);
		foreach ($batteryTyeArray as $bkey => $bvalue) {
			if($bvalue["name"] == $_POST['battery_name']){
				$_POST['battery_price'] = $bvalue["price"];
				$_POST['battery_warranty'] = $bvalue["bwarranty"];
			}
		}
		
		$_POST['battery_price_excluding_vat'] = $_POST['battery_price']*((100+$obj_btmrg[0]->margin)/100); //Battery Price (excluding VAT) (P) = Battery cost * Margins for Battery (%)
		
		$_POST['battery_price_including_vat'] = $_POST['battery_price_excluding_vat']*1.25; //Battery Price (including VAT) P1 = P x 1.25
		
		$_POST['battery_price_after_green_deduction'] = $_POST['battery_price_including_vat']*(100-$obj_battery[0]->rebate)/100;  //Battery Price (after green avdrag) = P1 x (100 – BGA)
	}
	
	
	//for EV Charger
	if($_POST['charger_name']!=''){
		
		$obj_evmrg = json_decode($customerPriceArr['ev_margin']);
		
		$obj_ev = json_decode($customerPriceArr['green_rebate_ev']);
		
		$chargerTyeArray = json_decode($customerPriceArr["ev_charger_types"], true);
		foreach ($chargerTyeArray as $ckey => $cvalue) {
			if($cvalue["name"] == $_POST['charger_name']){
				$_POST['charger_price'] = $cvalue["price"];
				$_POST['charger_warranty'] = $cvalue["cwarranty"];
			}
		}
			
		$_POST['charger_price_excluding_vat'] = $_POST['charger_price']*((100+$obj_evmrg[0]->margin)/100); //EV charger Price (excluding VAT) (P) =  EV charger cost * Margins for EV charger (%)
		
		$_POST['charger_price_including_vat'] = $_POST['charger_price_excluding_vat']*1.25; //EV charger Price (including VAT) P1 = P x 1.25
		
		$_POST['charger_price_after_green_deduction'] = $_POST['charger_price_including_vat']*(100-$obj_ev[0]->rebate)/100;  //EV charger Price (after green avdrag) = P1 x (100 – EVGA)

	}
	
	//for solar panels
	
	$_POST['price_excluding_vat'] = $cost*((100+$obj_smrg[0]->margin)/100); //Price (excluding VAT)(P) = Cost* Margin for panels
	
	$_POST['price_including_vat'] = $_POST['price_excluding_vat']*1.25; //Price (including VAT) P1 = P x 1.25
	
	$_POST['price_after_discount'] = $_POST['price_including_vat']*(100-$obj_sdis[0]->discount)/100; //Price (after discount) P2 = P1 x (100-Discount)
	
	$_POST['price_after_green_deduction'] = $_POST['price_after_discount']*(100-$obj_solar[0]->rebate)/100; //Price (after green avdrag) = P2 x (100 – GA)
	
	//$_POST['price_after_green_deduction'] = 139414;
	
	$_POST['solar_margin'] = $obj_smrg[0]->margin;
	$_POST['solar_margin_kr'] = $_POST['price_excluding_vat']-$cost;
	
	$_POST['charger_margin'] = $obj_evmrg[0]->margin;
	$_POST['charger_margin_kr'] = $_POST['charger_price_excluding_vat']-$_POST['charger_price'];
	
$_POST['proposal_total_cost'] = $_POST['price_after_green_deduction'];
	if($_POST['charger_name']!=''){
		$_POST['proposal_total_cost'] = $_POST['price_after_green_deduction'] + $_POST['charger_price_after_green_deduction'];
	}
	
	/*if($_POST['battery_name']!=''){
		$_POST['proposal_total_cost'] = $_POST['proposal_total_cost'] + $_POST['battery_price_after_green_deduction'];
	}*/
	
	$_POST['total_weighted_electricity_price'] =  (($_POST['own_consumption']*$_POST['self_use_solar']) + ($_POST['sold_electricity']*(100-$_POST['self_use_solar'])))/100;
	
	//$_POST['total_weighted_electricity_price'] =  1.19;
	
	
	
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
	$_POST['estimated_annual_saving'] = $total_annual_saving;
	$return_percentage = (($total_annual_saving)*100)/$_POST['price_after_green_deduction']; 
	$left_amount = $_POST['price_after_green_deduction'] - $total_annual_saving;
	
	
									
	$payback_table .='<tr>
							<td style="text-align:center;">1</td>
							<td style="text-align:center;">'.proposal_decimal_format(number_format($_POST['total_weighted_electricity_price'],2)).'</td>
							<td style="text-align:center;">'.amount_format_proposal(round($_POST['annual_production'])).' kWh</td>
							<td style="text-align:center;">'.amount_format_proposal(round($total_annual_saving)).' kr</td>
							<td style="text-align:center;">'.proposal_decimal_format(number_format($return_percentage,2)).'%</td>
							<td style="text-align:center;">'.amount_format_proposal(round($left_amount)).' kr</td>
						</tr>';	
	
	$payback_year_count=1;
	//echo $left_amount;die;
	
	$prevWeightedPrice = $_POST['total_weighted_electricity_price'];
	$prevAnnualProd = $_POST['annual_production'];
	$prevLeftAmount = $left_amount;
	
	$k=2;
	while($prevLeftAmount>=0){
							
	$next_year_weighted_price = ($prevWeightedPrice + ($prevWeightedPrice*$_POST['annual_inflation']/100));
	
	$next_year_annual_prod = $prevAnnualProd-(($prevAnnualProd*$_POST['annual_deterioration_percent'])/100);
	$total_annual_saving = ($next_year_annual_prod*$next_year_weighted_price);
	$return_percentage = (($total_annual_saving)*100)/$_POST['price_after_green_deduction']; 
	$left_amount = $prevLeftAmount - $total_annual_saving;
	if($left_amount<0){
		$left_amount=0;
	}else{
		$payback_year_count++;
	}
	
	
	//echo $left_amount .'<br>';
	
	$payback_table .='<tr>
							<td style="text-align:center;">'.$k.'</td>
							<td style="text-align:center;">'.proposal_decimal_format(number_format($next_year_weighted_price,2)).'</td>
							<td style="text-align:center;">'.amount_format_proposal(round($next_year_annual_prod)).' kWh</td>
							<td style="text-align:center;">'.amount_format_proposal(round($total_annual_saving)).' kr</td>
							<td style="text-align:center;">'.proposal_decimal_format(number_format($return_percentage,2)).'%</td>
							<td style="text-align:center;">'.amount_format_proposal(round($left_amount)).' kr</td>
						</tr>';	
		
		//echo 'left_amount'.$left_amount;
	if($k==20){
		break;
	}
	$prevLeftAmount = $left_amount;
	$prevWeightedPrice = $next_year_weighted_price;
	$prevAnnualProd = $next_year_annual_prod;
	$k++;
	}
	//echo $payback_year_count;
	$payback_table .='</tbody>
							</table>';
									
	//echo $payback_table;
	//die;
	
	
	?>


		
		<?php
	
	
	
	
	$lead_id = $_POST['pid'];
	//$_POST['chart_image'] = $_SESSION['chart_name'];
	
	
	$_POST['payback_table'] = $payback_table;
	$_POST['repayment_period'] = $payback_year_count;
	$_POST['payment_at_ordering'] = $obj_orderPayment[0]->orderPayment;
	$_POST['proposal_shipment_cost'] = $obj_shipcost[0]->shipmentcost;
	//$_POST['proposal_mms_cost'] = $obj_mmscost[0]->mmscost;
	if($lead_id){ 
		//$_POST['created_date'] =  date("H:i a");
		$_POST["update_date"] = date("Y-m-d h:i:s");
		if($assigned_to){
			$_POST["assigned_date"] = date("Y-m-d h:i:s");
		}		
		$cms->sqlquery("rs","leads",$_POST, 'id', $lead_id);
		$lead_insert_id = $lead_id;
	}else{
		$_POST["form_type"] = 4;
		$_POST['status'] = 1;
		$_POST['source'] = 0;
		$_POST["update_date"] = date("Y-m-d h:i:s");
		$_POST["post_by"] = $_SESSION["ses_adm_id"];
		$_POST["assigned_to"] = $_SESSION["ses_adm_id"];
		$_POST["post_date"] = ($_POST["post_date"]?$_POST["post_date"]:date("Y-m-d"));
		$lead_insert_id=$cms->sqlquery("rs","leads",$_POST);
	}
	
	$_POST['chart_html']=$chart_html;
	$invoice_Arr=$_POST;
	
	

//$fixedProdArr = array(217, 363, 1373, 1593, 1758, 1703, 1648, 1538, 1264, 769, 330, 220);
//$fixedConsumtionArr = array(1680, 1519, 1359, 1080, 680, 440, 360, 399, 600, 960, 1400, 1520);

$fixedProdPercentage = array(2, 3, 11, 12, 14, 13, 13, 12, 10, 6, 3, 2);
$fixedConsumtionPercentage = array(14, 13, 11, 9, 6, 4, 3, 3, 5, 8, 12, 13);


for($i=0; $i<12; $i++){	
	$chartProduction[] = round(($fixedProdPercentage[$i]*$total_prod)/100);
	$chartConsumption[] = round(($fixedConsumtionPercentage[$i]*$total_consumption)/100);
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
        text: ''
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
            text: 'kWh'
        }
    },
	credits: {
		enabled: false
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
/*	
	
legend:{
     align: 'left',
     verticalAlign: 'top',
     floating: true        
},*/
    plotOptions: {
        column: {
            pointPadding: 0,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Uppskattad förbrukning av fastighetsel',
        //data: [1680, 1519, 1359, 1080, 680, 440, 360, 399, 600, 960, 1400, 1520]
		data: <?=$jsonConsum?>

    }, {
        name: 'Uppskattad produktion av solel',
        //data: [217, 363, 1373, 1593, 1758, 1703, 1648, 1538, 1264, 769, 330, 220]
		data: <?=$jsonProd?>

    }]
});


		  
var imageURL = '';
var svg = chart.getSVG();
//console.log(svg);
var svg12 = encodeURIComponent(svg);
var dataString = 'type=image/jpeg&filename=results&width=500&svg='+svg;


$.ajax({
	type: "POST",
	url: 'arkachart.php?pid=<?=$lead_insert_id?>',
	data: {name: svg12},
	success: function(data){
		//alert();
		location.href="<?=SITE_PATH?>arka-admin/lead-manager/generate-pdf.php?pid=<?=$lead_insert_id?>&start=<?=$pageTo?>";
	},
	error: function(xhr, status, error){
		console.error(xhr);
	}
});
	  
</script>

<?php
//header('location:'.SITE_PATH_ADM.CPAGE.'/generate-pdf.php');
//	exit;
?>



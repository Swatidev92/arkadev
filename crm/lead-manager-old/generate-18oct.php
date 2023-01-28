<?php include("../../lib/opin.inc.php");?>

<script src="<?=SITE_PATH?>lib/Highcharts-6.1.1/code/highcharts.js"></script>
<script src="<?=SITE_PATH?>lib/Highcharts-6.1.1/code/modules/exporting.js"></script>
<script src="<?=SITE_PATH?>lib/Highcharts-6.1.1/code/modules/export-data.js"></script>
<script src="<?=SITE_PATH?>lib/Highcharts-6.1.1/examples/column-basic/jquery-3.3.1.min.js"></script>

<?php 


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
	$obj_mmscost = json_decode($customerPriceArr["mms_cost"]);
	$obj_orderPayment = json_decode($customerPriceArr['pay_at_ordering']);
	$obj_shipcost = json_decode($customerPriceArr['shipment_cost']);
	

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

	
	//$_POST['price_after_green_deduction'] = 139414;

	
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
							<td style="text-align:center;">'.$_POST['total_weighted_electricity_price'].'</td>
							<td style="text-align:center;">'.$_POST['annual_production'].' kWh</td>
							<td style="text-align:center;">'.$total_annual_saving.' kr</td>
							<td style="text-align:center;">'.number_format($return_percentage,2).'%</td>
							<td style="text-align:center;">'.$left_amount.' kr</td>
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
							<td style="text-align:center;">'.number_format($next_year_weighted_price,2).'</td>
							<td style="text-align:center;">'.number_format($next_year_annual_prod,2).' kWh</td>
							<td style="text-align:center;">'.number_format($total_annual_saving,2).' kr</td>
							<td style="text-align:center;">'.number_format($return_percentage,2).'%</td>
							<td style="text-align:center;">'.number_format($left_amount,2).' kr</td>
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
	$_POST['proposal_mms_cost'] = $obj_mmscost[0]->mmscost;
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
		$_POST["update_date"] = date("Y-m-d h:i:s");
		$_POST["post_date"] = date("Y-m-d");
		$lead_insert_id=$cms->sqlquery("rs","leads",$_POST);
	}
	
	$_POST['chart_html']=$chart_html;
	$invoice_Arr=$_POST;
	
	

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
        data: [1680, 1519, 1359, 1080, 680, 440, 360, 399, 600, 960, 1400, 1520]
		//data: <?=$jsonConsum?>

    }, {
        name: 'Uppskattad produktion av solel',
        data: [217, 363, 1373, 1593, 1758, 1703, 1648, 1538, 1264, 769, 330, 220]
		//data: <?=$jsonProd?>

    }]
});

// the button handler
  		  
var imageURL = '';
var svg = chart.getSVG();
console.log(svg);
var svg = encodeURIComponent(svg);
var dataString = 'type=image/jpeg&filename=results&width=500&svg='+svg;
$.ajax({
    type: 'POST',
    data: dataString,
    url: '<?=SITE_PATH?>arka-admin/lead-manager/arkachart.php?pid=<?=$lead_insert_id?>',
    //async: false,
    success: function(data){
        imageURL = data;
		location.href="<?=SITE_PATH?>arka-admin/lead-manager/generate-pdf.php?pid=<?=$lead_insert_id?>";
    }
});

/*

$(function(){
       $.post("<?=SITE_PATH?>arka-admin/lead-manager/arkachart.php",{ svg: svg}, function(data){
           //alert(data);
		  // imageURL = data;
		//alert();
		//location.href="<?=SITE_PATH_ADM.CPAGE?>/generate-pdf.php?pid=<?=$lead_insert_id?>";
			//location.href="<?=SITE_PATH?>arka-admin/lead-manager/generate-pdf.php?pid=<?=$lead_insert_id?>";
       });
    });
	 */
/*	
var imageURL = '';
var svg = chart.getSVG();
//console.log(svg);
var svg = encodeURIComponent(svg);
var dataString = 'type=image/jpeg&filename=results&width=500&svg='+svg;
$.ajax({
    type: 'POST',
    data: dataString,
    url: '<?=SITE_PATH?>arka-admin/lead-manager/arkachart.php',
   // async: false,
    success: function(data){
        imageURL = data;
    }
});
*/
	
	
/*
$.ajax({
    type: 'POST',
    data: svg,
    url: '<?=SITE_PATH_ADM.CPAGE?>/arkachart.php',
    //async: false,
    success: function(data){
        imageURL = data;
		//alert();
		//location.href="<?=SITE_PATH_ADM.CPAGE?>/generate-pdf.php?pid=<?=$lead_insert_id?>";
		//location.href="<?=SITE_PATH_ADM.CPAGE?>/generate-pdf.php?pid=<?=$lead_insert_id?>";
    }
});
*/
</script>

<?php
//header('location:'.SITE_PATH_ADM.CPAGE.'/generate-pdf.php');
//	exit;
?>



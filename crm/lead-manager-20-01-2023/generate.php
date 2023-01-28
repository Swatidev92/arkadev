<?php include("../../lib/opin.inc.php");?>

<script src="<?=SITE_PATH?>Highcharts-6.1.1/code/highcharts.js"></script>
<script src="<?=SITE_PATH?>Highcharts-6.1.1/code/modules/exporting.js"></script>
<script src="<?=SITE_PATH?>Highcharts-6.1.1/code/modules/export-data.js"></script>
<script src="<?=SITE_PATH_ADM?>js/jquery-3.3.1.min.js"></script>
<!--<script src="<?=SITE_PATH?>lib/Highcharts-6.1.1/examples/column-basic/jquery-3.3.1.min.js"></script>-->

<?php include_once('common-code.php');?>
	
	<?php
	//print_r($_POST);die;
		$lead_id = $_POST['pid'];
		$parentId = $_POST['parent_id'];
		//$_POST['chart_image'] = $_SESSION['chart_name'];
	
	
	if($_POST['proposal_type']!=5 && $_POST['proposal_type']!=6 && $_POST['proposal_type']!=7){
		$total_margin = $total_margin + $_POST['solar_margin_kr'];
	}
			
	if($charger_name){
		$total_margin = $total_margin + $_POST['charger_margin_kr'];
	}
	
	if($battery_name){
		$total_margin = $total_margin + $_POST['battery_margin_kr'];
	}
	//echo $total_margin;die;
	$_POST['total_margin_kr'] = round($total_margin);	
	
	$_POST['total_margin_percentage'] = round($total_margin*100/$_POST['proposal_total_cost']);
		//print_r($_POST);die;
	if($_POST['proposal_type']!=5 && $_POST['proposal_type']!=6 && $_POST['installation_image']==''){
	echo "Dimensioning image is required to generate proposal";
	//$cms->redir(SITE_PATH_ADM.CPAGE.'?mode=proposal-list&start=&id='.$lead_id, true);
	//exit;
	}
	if(1==1){
	if($_POST['total_margin_percentage']>=$_POST['minimum_total_margin']){	
		$_POST['address_input']= $_POST['proposal_address'];
		$_POST['payback_table'] = $payback_table;
		$_POST['repayment_period'] = $payback_year_count;
		$_POST['payment_at_ordering'] = $obj_orderPayment[0]->orderPayment;
		$_POST['proposal_shipment_cost'] = $obj_shipcost[0]->shipmentcost;
		//$_POST['proposal_mms_cost'] = $obj_mmscost[0]->mmscost;
		
		//print_r($_POST);die;
		if($_POST['status']==4){
			$_POST['lead_type'] = 3; //converted to project
		}else{
			$_POST['lead_type'] = 2; // converted to proposal
		}
		$_POST["update_date"] = date("Y-m-d h:i:s");
		//$_POST["post_by"] = $_SESSION["ses_adm_id"];
		//$_POST["assigned_to"] = $_SESSION["ses_adm_id"];
		$_POST["last_updated_by"] = $_SESSION["ses_adm_id"];
		$_POST["post_date"] = date("Y-m-d H:i:s");
		
		if($lead_id && $parentId==''){ 
			//$_POST['created_date'] =  date("H:i a");
			/*$_POST["update_date"] = date("Y-m-d h:i:s");
			if($_POST['status']==4){
				$_POST['lead_type'] = 3; //converted to project
			}else{
				$_POST['lead_type'] = 2; // converted to proposal
			}
			if($assigned_to){
				$_POST["assigned_date"] = date("Y-m-d h:i:s");
			}		
			$cms->sqlquery("rs","leads",$_POST, 'id', $lead_id);
			$lead_insert_id = $lead_id;
			*/
			
			$_POST["parent_id"] = $lead_id;
			$_POST["lead_id"] = $lead_id;		
		}
		else if($lead_id && $parentId!=''){ 
			$_POST["parent_id"] = $parentId;
			$_POST["lead_id"] = $lead_id;
			//$_POST["post_date"] = date("Y-m-d");
		}else{
			$_POST["created_date"] = date("Y-m-d h:i:s");
			//$_POST["post_date"] = date("Y-m-d");
		}
		if($_POST['proposal_type']==1 || $_POST['proposal_type']==2 || $_POST['proposal_type']==3 || $_POST['proposal_type']==4 || $_POST['proposal_type']==8 || $_POST['proposal_type']==9 || $_POST['proposal_type']==10 || $_POST['proposal_type']==11){
			$solar_name = 'solar';
		}else{
			$solar_name = '';
		}
		
		if($_POST['create_log']==1){
			$lead_insert_id=$cms->sqlquery("rs","leads",$_POST);
			//update quotation number
			$_POST["quotation_number"] = generateQuotationNumber($lead_insert_id,$solar_name,$_POST['charger_name'],$_POST['battery_name']);
			$cms->sqlquery("rs","leads",$_POST, 'id', $lead_insert_id);
		}else{
			if($_POST["quotation_number"]==''){
				$getParentId = $cms->getSingleResult("SELECT id FROM #_leads where id=$lead_id AND status=1 AND is_deleted=0 ");
				$_POST["quotation_number"] = generateQuotationNumber($getParentId,$solar_name,$_POST['charger_name'],$_POST['battery_name']);
			}	
			$lead_insert_id = $parentId;
			$cms->sqlquery("rs","leads",$_POST, 'id', $parentId);
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
		location.href="<?=SITE_PATH_ADM.CPAGE?>/generate-pdf.php?pid=<?=$lead_insert_id?>&start=<?=$pageTo?>";
	},
	error: function(xhr, status, error){
		console.error(xhr);
	}
});
	  
</script>

		<?php }else{ //margin is less than minimum total margin
	echo "Total margin is ".$_POST['total_margin_percentage']."% which is less than minimum total margin (".$_POST['minimum_total_margin']."%)";
	//$cms->redir(SITE_PATH_ADM.CPAGE.'?mode=proposal-list&start=&id='.$lead_id, true);
	//exit;
}}
else{
	echo "Dimensioning image is required to generate proposal";
	//$cms->redir(SITE_PATH_ADM.CPAGE.'?mode=proposal-list&start=&id='.$lead_id, true);
	//exit;
}
?>
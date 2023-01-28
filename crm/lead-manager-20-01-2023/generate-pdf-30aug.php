<?php include("../../lib/opin.inc.php");?>

<?php


error_reporting(0);
//echo $_GET['start'];die;
	//print_r($_REQUEST);die;
	
	
	$lead_id = $_GET["pid"];
		
		
	$txt='';
	$rsAdmin = $cms->db_query("select id, customer_name, quotation_number, panel_model, panel_wattage, panel_count, inverter_type, inverter_type2, inverter_type3, proposal_mms_cost, charger_name, battery_name, solar_margin, solar_margin_kr, charger_margin, charger_margin_kr, proposal_type, vat_kr, vat_percentage, green_rebate_kr, number_of_proposal, charger_green_rebate_kr, charger_vat_kr, proposal_customer_type, proposal_total_price, load_balancer, battery_green_rebate_kr, battery_vat_kr, battery_margin, battery_margin_kr, proposal_total_cost, charger_price_after_green_deduction, price_after_green_deduction, battery_price_after_green_deduction, installation_days, total_discount, roofing_material, price_excluding_vat, price_including_vat, charger_price_including_vat, charger_price_excluding_vat, battery_price_excluding_vat, battery_price_including_vat, extra_green_rebate, load_balancer_margin_kr, load_balancer_vat_kr, load_balancer_green_rebate_kr, load_price_after_green_deduction, load_price_including_vat, load_price_excluding_vat, proposal_name, battery_extra_green_rebate, lead_id as leadID, charger_price, battery_price, panel_cost, inverter_cost, inverter_cost2, inverter_cost3, installation_cost, roof_cost_per_panel from #_leads where id='".$_REQUEST['pid']."'");
	$arrAdmin = $rsAdmin->fetch_array(); 
	@extract($arrAdmin);
	
	include('file-name.php');

	$total_margin = 0;
	
		//generate txt 
		$txtfilename = ($proposal_name?$proposal_name.'-':'').$customer_name.'-'.$file_name.'-'.$quotation_number.'.txt';
		
		$txtfullpath = "../../uploaded_files/proposal/".$txtfilename;
		
		$myfile = fopen($txtfullpath, "w") or die("Unable to open file!");
		if($proposal_customer_type==1){
			if($proposal_type==8 && $number_of_proposal==2){
				$proposal_total_cost = $proposal_total_cost+$battery_extra_green_rebate;
			}
		$txt .= "Total Pris efter grönt avdrag:".amount_format_proposal(round($proposal_total_cost))."\n\n";
		}
		$txt .= "Panel type:".$panel_model." - ".$panel_wattage.", Quantity:".$panel_count.", Price: ".$panel_cost."\n\n";
		$txt .= "Inverter type1:".$inverter_type." , Quantity:1, Price: ".$inverter_cost."\n\n";
		if($inverter_type2){
		$txt .= "Inverter type2:".$inverter_type2." , Quantity:1, Price: ".$inverter_cost2."\n\n";
		}
		if($inverter_type3){
		$txt .= "Inverter type3:".$inverter_type3." , Quantity:1, Price: ".$inverter_cost3."\n\n";
		}
		$txt .= "MMS cost (kr):".$proposal_mms_cost."\n\n";
		$txt .= "Installation Days:".$installation_days.", Price: ".$installation_cost."\n\n";
		$txt .= "Total Discount:".$total_discount."\n\n";
		$txt .= "Roof Material:".$roofing_material.", Price: ".$roof_cost_per_panel."\n\n";
		
		if($proposal_type!=5 && $proposal_type!=6 && $proposal_type!=7){
			if($proposal_type==2 || $proposal_type==3 || $proposal_type==4){
			$txt .= "Solar margins (%):".round(($solar_margin_kr*100)/$proposal_total_price)."\n";
			}else{
			$txt .= "Solar margins (%):".$solar_margin."\n";
			}
			$txt .= "Solar margins (kr):".amount_format_proposal(round($solar_margin_kr))."\n";
		
			$total_margin = $total_margin + $solar_margin_kr;
			$txt .= "Solar VAT (%):".$vat_percentage."\n";
			$txt .= "Solar VAT (kr):".amount_format_proposal(round($vat_kr))."\n";
			if($proposal_customer_type==1){
				/*if($proposal_type==8 || $proposal_type==9 || $proposal_type==11){
					$price_after_green_deduction = $price_after_green_deduction+$extra_green_rebate;
				}*/
				$txt .= "Solar Green rebate (kr):".amount_format_proposal(round($green_rebate_kr))."\n";
				$txt .= "Solar total price (after green rebate) (kr):".amount_format_proposal(round($price_after_green_deduction))."\n\n";
			}
			if($proposal_customer_type==2){
				$txt .= "\n";
			}
		}
		
		
		//echo $txt;die;

	
		if($charger_name){
			if($load_balancer==1){
				$loadText = '& load balancer ';
				$charger_margin_kr = $charger_margin_kr+$load_balancer_margin_kr;
				$charger_vat_kr = $charger_vat_kr+$load_balancer_vat_kr;
				$charger_green_rebate_kr = $charger_green_rebate_kr+$load_balancer_green_rebate_kr;
				$charger_price_after_green_deduction = $charger_price_after_green_deduction+$load_price_after_green_deduction;
			}else{
				$loadText = '';
			}
			$txt .= "EV charger:".$charger_name.", Quantity:1, Price: ".$charger_price."\n";
			$txt .= "EV Charger ".$loadText."margins (%):".$charger_margin."\n";
			$txt .= "EV Charger ".$loadText."margins (kr):".amount_format_proposal(round($charger_margin_kr))."\n";
			$txt .= "EV Charger ".$loadText."VAT (kr):".amount_format_proposal(round($charger_vat_kr))."\n";
			if($proposal_customer_type==1){
				$txt .= "EV Charger ".$loadText."Green rebate (kr):".amount_format_proposal(round($charger_green_rebate_kr))."\n";
				$txt .= "EV Charger ".$loadText."total price (after green rebate) (kr):".amount_format_proposal(round($charger_price_after_green_deduction))."\n\n";
			}
			if($proposal_customer_type==2){
				$txt .= "\n";
			}
		
			$total_margin = $total_margin + $charger_margin_kr;
		}
		if($battery_name){
			$txt .= "Battery:".$battery_name.", Quantity:1, Price: ".$battery_price."\n";
			$txt .= "Battery margins (%):".$battery_margin."\n";
			$txt .= "Battery margins (kr):".amount_format_proposal(round($battery_margin_kr))."\n";
			$txt .= "Battery VAT (kr):".amount_format_proposal(round($battery_vat_kr))."\n";
			if($proposal_customer_type==1){
				$txt .= "Battery Green rebate (kr):".amount_format_proposal(round($battery_green_rebate_kr))."\n";
				$txt .= "Battery total price (after green rebate) (kr):".amount_format_proposal(round($battery_price_after_green_deduction))."\n\n";
			}
			if($proposal_customer_type==2){
				$txt .= "\n";
			}			
			$total_margin = $total_margin + $battery_margin_kr;
		}
		$txt .= "Total Margin (kr):".amount_format_proposal(round($total_margin))."\n";
		$txt .= "Percentage Margin (%):".round($total_margin*100/$proposal_total_cost)."\n\n";
		
		$txt .= "Solar system with installation \n";
		$txt .= "\t customer price excluding VAT:".amount_format_proposal(round($price_excluding_vat))."\n";
		$txt .= "\t customer price including VAT:".amount_format_proposal(round($price_including_vat))."\n";
		if($proposal_customer_type==1){
			if($proposal_type==8 && $number_of_proposal==1){
				$price_after_green_deduction = $price_after_green_deduction+$battery_extra_green_rebate;
			}
			$txt .= "\t customer price after grönt rebate:".amount_format_proposal(round($price_after_green_deduction))."\n\n";
		}
		if($proposal_customer_type==2){
			$txt .= "\n";
		}
		
		if($charger_name){
			$txt .= "EV charger with installation \n";
			$txt .= "\t customer price excluding VAT:".amount_format_proposal(round($charger_price_excluding_vat))."\n";
			$txt .= "\t customer price including VAT:".amount_format_proposal(round($charger_price_including_vat))."\n";
			if($proposal_customer_type==1){
				$txt .= "\t customer price after grönt rebate:".amount_format_proposal(round($charger_price_after_green_deduction))."\n\n";
			}
			if($proposal_customer_type==2){
				$txt .= "\n";
			}
		}
		if($load_balancer==1){
			$txt .= "Load balancer with installation \n";
			$txt .= "\t customer price excluding VAT:".amount_format_proposal(round($load_price_excluding_vat))."\n";
			$txt .= "\t customer price including VAT:".amount_format_proposal(round($load_price_including_vat))."\n";
			if($proposal_customer_type==1){
				$txt .= "\t customer price after grönt rebate:".amount_format_proposal(round($load_price_after_green_deduction))."\n\n";
			}
			if($proposal_customer_type==2){
				$txt .= "\n";
			}
		}
		
		if($battery_name){
			$txt .= "Battery system with installation \n";
			$txt .= "\t customer price excluding VAT:".amount_format_proposal(round($battery_price_excluding_vat))."\n";
			$txt .= "\t customer price including VAT:".amount_format_proposal(round($battery_price_including_vat))."\n";
			if($proposal_customer_type==1){				
				if($proposal_type==8 && $number_of_proposal==2){
					$battery_price_after_green_deduction = $battery_price_after_green_deduction+$battery_extra_green_rebate;
				}
				$txt .= "\t customer price after grönt rebate:".amount_format_proposal(round($battery_price_after_green_deduction))."\n";
			}
		}
		
		/*if (file_put_contents($newFileName, $newFileContent) !== false) {
			echo "File created (" . basename($newFileName) . ")";
		}*/
			

		fwrite($myfile, $txt);
		fclose($myfile);

		//die;
		if($lead_id){ 
			
			$_POST['proposal_pdf'] = '';
			$_POST['proposal_pdf2'] = '';
			$_POST['proposal_image_pdf'] = '';
			$_POST['proposal_txt'] = $txtfilename;
			$cms->sqlquery("rs","leads",$_POST, 'id', $lead_id);
		}


//die;
		
		/*if(isset($_GET['start']) && $_GET['start'] > 0) {
			header('location:'.SITE_PATH_ADM.CPAGE.'/index.php?start='.$_GET['start']);
		} else {
			header('location:'.SITE_PATH_ADM.CPAGE);
		}
		*/
		
		//$path = $_SESSION['REFERER_page'];
		$path = SITE_PATH_ADM.CPAGE.'?mode=proposal-list&start=&id='.$leadID;
		echo "<script>window.location.href='".$path."';</script>";
		
		
?>
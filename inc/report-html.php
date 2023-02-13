<?php include("../lib/opin.inc.php");?>

<?php 
//print_r($_REQUEST);die;

$projectQry = $cms->db_query("SELECT * FROM #_customer_project where id=".$_REQUEST['report_no']." ");
$projectRes =  $projectQry->fetch_array();
@extract($projectRes);

$customerQry = $cms->db_query("SELECT customer_name, email, phone, personnummer, proposal_address, inverter_type, inverter_type2, inverter_type3, system_size, panel_model, panel_count, battery_name, charger_name FROM #_leads where id=".$projectRes['cust_id']." AND status=4 and is_deleted=0 ");
$customerRes =  $customerQry->fetch_array();

?>
<html>
	<head>
		<style>
		.email_table {
			color: #000;
			font-family: sans-serif;
			font-size: 13px;
			font-weight: 300;
			text-align: center;
			border-collapse: separate;
			border-spacing: 0;
			margin: 6px auto;
			box-shadow:none;
		}
		table {
			color: #000;
			font-family: sans-serif;
			font-size: 13px;
			font-weight: 300;
			text-align: center;
			border-collapse: separate;
			border-spacing: 0;
			width: 99%;
		}
		.item_table tbody td{
			border-bottom:1px solid #ddd;
		}
		th {font-weight: bold; padding:10px; border-bottom:2px solid #000;}

		tbody td {padding:0px;font-size: 13px;}

		.email_main_div{width:700px; margin:auto;  border:1px solid #dcdcdc;padding:20px;}
		.email_main_div2{width:700px; padding-left:20px;padding-right:20px;}
		strong{font-weight:bold;}
		.item_table{text-align:left;}
		.item_table_border td{}
		.no-border td{
			border:none;
		}
		.item_table tbody td{
			padding:10px;
		}
		</style>
	</head>
	<body>
		<h2 align="center"><?=$_REQUEST["project_customer"].'-'.$_REQUEST["project_num"].'-Föranmälan info';?></h2>
		<div class="email_main_div" style="padding:10px">
			<table cellpadding="4" style="border-collapse: collapse; width: 100%;" border="0">
				<tbody>
					<tr>
						<td style="width: 50%; text-align:left;">
							Namn:
						</td>
						<td style="width: 50%; text-align:left;">
							<?php if($not_same_bill == 1){ echo $cust_name_bill; }else{ echo $customerRes['customer_name']; }?>
						</td>
					</tr>
					<tr>
						<td style="width: 50%; text-align:left;">
							Personnummer:
						</td>
						<td style="width: 50%; text-align:left;">
						<?php if($not_same_bill == 1){ echo $personnummer_bill; } else { echo $customerRes['personnummer']?$customerRes['personnummer']:'NA'; }?>
						</td>
					</tr>
					<tr>
						<td style="width: 50%; text-align:left;">
							Telefonnummer:
						</td>
						<td style="width: 50%; text-align:left;">
						<?php if($not_same_bill == 1){ echo $phone_bill; } else { echo $customerRes['phone']; }?>
						</td>
					</tr>
					<tr>
						<td style="width: 50%; text-align:left;">
							Email:
						</td>
						<td style="width: 50%; text-align:left;">
						<?php if($not_same_bill == 1){ echo $email_bill; } else { echo $customerRes['email']; }?>
						</td>
					</tr>
					<tr>
						<td style="width: 50%; text-align:left;">
							Adress:
						</td>
						<td style="width: 50%; text-align:left;">
							<?=$projectRes['project_address']?>
						</td>
					</tr>
					<tr>
						<td style="width: 50%; text-align:left;">
							Nätägare:
						</td>
						<td style="width: 50%; text-align:left;">
							<?php if($projectRes['grid_provider']==4){
								$gridName = $projectRes['grid_provider_name'];
							}else{
								$gridName = $gridProvider[$projectRes['grid_provider']];
							}?>
							<?=$gridName?$gridName:'NA'?>
						</td>
					</tr>
					<tr>
						<td style="width: 50%; text-align:left;">
							Anläggnings-ID:
						</td>
						<td style="width: 50%; text-align:left;">
							<?=$projectRes['plant_id']?$projectRes['plant_id']:'NA'?>
						</td>
					</tr>
					<tr>
						<td style="width: 50%; text-align:left;">
							Huvudsäkring:
						</td>
						<td style="width: 50%; text-align:left;">
							<?=$projectRes['main_fuse']?$projectRes['main_fuse']:'NA'?>
						</td>
					</tr>
					<tr>
						<td style="width: 50%; text-align:left;">
							Växelriktare:
						</td>
						<td style="width: 50%; text-align:left;">
							<?php if($customerRes['inverter_type']!='' || $customerRes['inverter_type2']!='' || $customerRes['inverter_type3']!=''){ ?>
							<?=$customerRes['inverter_type']?$customerRes['inverter_type']:''?>
							<?=$customerRes['inverter_type2']?', '.$customerRes['inverter_type2']:''?>
							<?=$customerRes['inverter_type3']?', '.$customerRes['inverter_type3']:''?>
							<?php }else{ echo 'NA'; } ?>
						</td>
					</tr>
					<tr>
						<td style="width: 50%; text-align:left;">
							Storleken på system(kWp):
						</td>
						<td style="width: 50%; text-align:left;">
							<?=$projectRes['system_size']?$projectRes['system_size']/1000:'NA'?>
						</td>
					</tr>
					<tr>
						<td style="width: 50%; text-align:left;">
							Effektfaktor:
						</td>
						<td style="width: 50%; text-align:left;">
							<?=$projectRes['effektfaktor']?$projectRes['effektfaktor']:'NA'?>
						</td>
					</tr>
					<tr>
						<td style="width: 50%; text-align:left;">
							Antal paneler/modell:
						</td>
						<td style="width: 50%; text-align:left;">
							<?php if($customerRes['panel_model']!='' && $customerRes['panel_count']!=''){?>
							<?=$customerRes['panel_model'].' / '.$customerRes['panel_count']?>
							<?php }else{ echo 'NA'; } ?>
						</td>
					</tr>
					<tr>
						<td style="width: 50%; text-align:left;">
							Batteri (modell, storlek):
						</td>
						<td style="width: 50%; text-align:left;">
							<?=$customerRes['battery_name']?$customerRes['battery_name']:'NA'?>
						</td>
					</tr>
					<tr>
						<td style="width: 50%; text-align:left;">
							Ö-drift (Ja/Nej):
						</td>
						<td style="width: 50%; text-align:left;">
							<?=$projectRes['odrift_name']?'Ja':'Nej'?>
						</td>
					</tr>
					<tr>
						<td style="width: 50%; text-align:left;">
							Kortslutningsström (Isc, panel-data):
						</td>
						<td style="width: 50%; text-align:left;">
							<?=$projectRes['short_circuit']?$projectRes['short_circuit']:'NA'?>
						</td>
					</tr>
					<tr>
						<td style="width: 50%; text-align:left;">
							Elbilsladdare (modell)
						</td>
						<td style="width: 50%; text-align:left;">
							<?=$projectRes['ev_charger']?$projectRes['ev_charger']:'NA'?>
						</td>
					</tr>
					<tr>
						<td style="width: 50%; text-align:left;">
							House Type
						</td>
						<td style="width: 50%; text-align:left;">
							<?=$projectRes['house_type']?$projectRes['house_type']:'NA'?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</body>
</html>
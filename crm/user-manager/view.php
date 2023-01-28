<?php
$pid = $_GET['id'];

$enqQry = $cms->db_query("select * from #_users where id='".$pid."'");
$enqRes = $enqQry->fetch_array(); 
@extract($enqRes);

$billDetails='Name: '.$customer_name .'<br>';
if($email_id){ $billDetails.= "Email: ".$email_id."<br>"; }
if($address){ $billDetails.= "Address: ".$address.", "; }
if($address2){ $billDetails.= $address2."<br>"; }
if($city){ $billDetails.= "City: ".$city."<br>"; }
if($state){ $billDetails.= "State: ".$cms->getSingleResult("select name from #_states where id=$state")."<br>"; }
if($country_id){ $billDetails.= "Country: ".$cms->getSingleResult("select name from #_countries where id=$country_id")."<br>";}
if($zip_code){ $billDetails.= "Pincode: ".$zip_code;}


$shippingDetails='Name: '.$shipping_name .'<br>';
if($shipping_email){ $shippingDetails.= "Email: ".$shipping_email."<br>"; }
if($shipping_address){ $shippingDetails.= "Address: ".$shipping_address.", "; }
if($shipping_address2){ $shippingDetails.= $shipping_address2."<br>"; }
if($shipping_city){ $shippingDetails.= "City: ".$shipping_city."<br>"; }
if($shipping_state_id){ $shippingDetails.= "State: ".$cms->getSingleResult("select name from #_states where id=$shipping_state_id")."<br>"; }
if($shipping_country_id){ $shippingDetails.= "Country: ".$cms->getSingleResult("select name from #_countries where id=$shipping_country_id")."<br>";}
if($shipping_zip){ $shippingDetails.= "Pincode: ".$shipping_zip;}


?>

<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
			<div class="form-group col-sm-4">
				<label for="customer_name" class="control-label">Name*</label>
				<input type="text" name="customer_name" value="<?=$customer_name?>" class="form-control" id="customer_name" disabled>
			</div>
			<div class="form-group col-sm-4">
				<label for="email_id" class="control-label">Email*</label>
				<input type="email" name="email_id" value="<?=$email_id?>" class="form-control" id="email_id" disabled>
			</div>
			<div class="form-group col-sm-4">
				<label for="contact_no" class="control-label">Phone*</label>
				<input type="text" name="contact_no" value="<?=$contact_no?>" class="form-control" id="contact_no" disabled>
			</div>			
			<div class="clearfix"></div>
			<div class="col-md-12">
				<div class="table-responsive">
					<table class="table table-striped table-bordered">
						<tbody>
							<tr>								
								<td class="table-center" width="50%">
									<strong><u>Billing Information:</u></strong> <br>
									<?=$billDetails?>
								</td>
								<td class="table-center" width="50%">
									<strong><u>Shipping Information:</u></strong> <br>
									<?=$shippingDetails?>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="form-group col-sm-12">
				<a href="<?=SITE_PATH_ADM.CPAGE?>" class="" ><button type="button" class="btn btn-primary">Back</button></a>
			</div>	
			<div class="clearfix"></div>
		</div>
	</div>
</div>
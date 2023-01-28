<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>assets/css/inner-custom.css" />

<style>
.g2g-form-holder{
	float: left;
    width: 100%;
    background: #fff;
    border-radius: 20px;
	padding:35px 15px;
    box-shadow: 0px 8px 20px rgb(0 0 0 / 6%);
}

.form-section-heading{
	margin-bottom: 20px;
    background-color: #22914f;
    border: 1px solid #eee;
    border-radius: 4px;
    -webkit-box-shadow: 0 1px 1px rgb(0 0 0 / 5%);
    box-shadow: 0 1px 1px rgb(0 0 0 / 5%);
}
.form-section-heading h2{
    padding: 15px;
	color:#fff;
	font-size:22px;
}
.form-control{
	height: 3rem;
	box-shadow:none;
}
</style>
	
	<div class="contactus-section  default-padding">
        <div class="container">
			<div class="row">
                <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12">	
					<div class="g2g-form-holder">		
						<form method="post" class="contact-form" enctype="multipart/form-data" action="<?=SITE_PATH.$urlConst?>proposal-format">
							<div class="form-section-heading">	
								<h2>Personal Information</h2>
							</div>
							<div class="form-group col-md-12">
								<select class="select21" id="customer_type" name="customer_type" >
									<option value="">Customer Type</option>
									<?php foreach($customerTypeArr as $ckey=>$cval){?>
									<option value="<?=$ckey?>"><?=$cval?></option>
									<?php } ?>
								</select>
							</div>
							<div class="clearfix"></div>
							<div class="form-group col-md-12">
								<input type="text" class="form-control" name="full_name" placeholder="Full name" pattern="([^\s][A-zÀ-ž\s]+)" >
							</div>
							<div class="clearfix"></div>
							<div class="form-group col-md-6">
								<input type="email" class="form-control" name="email" placeholder="Email" >
							</div>
							<div class="form-group col-md-6">
								<input type="text" class="form-control" name="phone" placeholder="Phone Number" pattern="[0-9]{8,15}" >
							</div>
							<div class="clearfix"></div>
							<div class="form-group col-md-12">
								<input type="text" class="form-control" name="address" placeholder="Address">
							</div>
							<div class="clearfix"></div>
							<div class="form-group col-md-6">
								<input type="text" class="form-control" name="reference" placeholder="Our reference" >
							</div>
							<div class="form-group col-md-6">
								<input type="text" class="form-control" name="quotation_number" placeholder="Quotation number" >
							</div>
							<div class="form-group col-md-6">
								<input type="text" class="form-control" name="quotation-date" placeholder="Quotation date" >
							</div>
							<div class="form-group col-md-6">
								<input type="text" class="form-control" name="quotation_valid_till" placeholder="Quotation valid for" >
							</div>
							<div class="clearfix"></div>
							<div class="form-section-heading">	
								<h2>Technical information</h2>
							</div>
							<div class="form-group col-md-6">
								<input type="text" class="form-control" name="panel_type" placeholder="Panel type" >
							</div>
							<div class="form-group col-md-6">
								<input type="text" class="form-control" name="system_size" placeholder="System size (kW)" >
							</div>
							<div class="clearfix"></div>
							<div class="form-group col-md-6">
								<input type="text" class="form-control" name="number_of_panels" placeholder="Number of panels" >
							</div>
							<div class="form-group col-md-6">
								<input type="text" class="form-control" name="color" placeholder="Color" >
							</div>
							<div class="clearfix"></div>
							<div class="form-group col-md-6">
								<input type="text" class="form-control" name="inverters" placeholder="Inverters" >
							</div>
							<div class="form-group col-md-6">
								<input type="text" class="form-control" name="roofing_material" placeholder="Roofing material" >
							</div>
							<div class="clearfix"></div>
							<div class="form-section-heading">	
								<h2>Guarantee</h2>
							</div>
							<div class="form-group col-md-6">
								<input type="text" class="form-control" name="supplier_solar_cells" placeholder="Supplier of solar cells" >
							</div>
							<div class="form-group col-md-6">
								<input type="text" class="form-control" name="work_performed" placeholder="Work performed" >
							</div>
							<div class="clearfix"></div>
							<div class="form-group col-md-6">
								<input type="text" class="form-control" name="warranty_solar" placeholder="Product warranty solar cells" >
							</div>
							<div class="form-group col-md-6">
								<input type="text" class="form-control" name="warranty_inverter" placeholder="Product warranty inverter" >
							</div>
							<div class="clearfix"></div>
							<div class="form-group col-md-6">
								<input type="text" class="form-control" name="product_guarantee_mounting_system" placeholder="Product guarantee mounting system" >
							</div>
							<div class="form-group col-md-6">
								<input type="text" class="form-control" name="after_guarantee" placeholder="Power guarantee solar cells after 30 years" >
							</div>
							<div class="clearfix"></div>
							<div class="form-section-heading">	
								<h2>Estimated production and conditions</h2>
							</div>
							<div class="form-group col-md-6">
								<input type="text" class="form-control" name="annual_electricity_consumption" placeholder="Annual electricity consumption in property:" >
							</div>
							<div class="form-group col-md-6">
								<input type="text" class="form-control" name="estimated_annual_production_solar" placeholder="Estimated annual production solar" >
							</div>
							<div class="clearfix"></div>
							<div class="form-group col-md-6">
								<input type="text" class="form-control" name="estimated_annual_saving_solar" placeholder="Estimated annual saving of solar" >
							</div>
							<div class="form-group col-md-6">
								<input type="text" class="form-control" name="self_use_solar" placeholder="Self-use of solar" >
							</div>
							<div class="clearfix"></div>
							<div class="form-group col-md-6">
								<input type="text" class="form-control" name="sunshine_hours" placeholder="Standard hours of sunshine / year" >
							</div>
							<div class="form-group col-md-6">
								<input type="text" class="form-control" name="panels_angles" placeholder="Angle of panels" >
							</div>
							<div class="clearfix"></div>
							<div class="form-group col-md-6">
								<input type="text" class="form-control" name="direction_from_south" placeholder="Direction from the south" >
							</div>
							<div class="form-group col-md-6">
								<input type="text" class="form-control" name="losses_from_shading" placeholder="Losses from shading" >
							</div>
							<div class="clearfix"></div>
							<div class="form-section-heading">	
								<h2>Dimensioning</h2>
							</div>
							<div class="form-group col-md-6">
								<input type="text" class="form-control" name="system_description" placeholder="System description" >
							</div>
							<div class="clearfix"></div>
							<div class="form-group col-md-12">
								<label class="label-control">The system is connected to the property's electrical exchange and installed according to the picture below. (570px X 330px)</label>
								<div>
									<input type="file" class="file-input" name="installation_image">
								</div>
							</div>
							<div class="form-group col-md-12">
								<label class="label-control">Estimated production calculation (700px X 300px)</label>
								<div>
									<input type="file" class="file-input" name="calculation_chart">
								</div>
							</div>
							<div class="clearfix"></div>
							<div class="col-lg-12">
								<div class="calculator-get-started cntct_2_btn_inner">
									<input type="submit" class="submitForm nextbtn continue" id="submit-quote" value="<?=$countryConst=='SE'?'Skicka in':'Submit'?>" name="submit_g2g">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
    </div>
	

	
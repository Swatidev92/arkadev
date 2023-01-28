<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 

if($cms->is_post_back()){ 
	//	echo '<pre>';
//		print_r($_POST);
	$_POSTS['ev_charger_types'] = json_encode($_POST['evc']);
	$_POSTS['panel_types'] = json_encode($_POST['pty']);
	$_POSTS['inverter_types'] = json_encode($_POST['invt']);
	$_POSTS['battery_types'] = json_encode($_POST['btrcs']);
	$_POSTS['installation_charges'] = json_encode($_POST['intc']);
	$_POSTS['green_rebate_solar'] = json_encode($_POST['grs']);
	$_POSTS['green_rebate_ev'] = json_encode($_POST['grev']);
	$_POSTS['green_rebate_battery'] = json_encode($_POST['grb']);
	$_POSTS['solar_margin'] = json_encode($_POST['smrg']);
	$_POSTS['ev_margin'] = json_encode($_POST['evmrg']);
	$_POSTS['battery_margin'] = json_encode($_POST['btmrg']);
	$_POSTS['solar_discount'] = json_encode($_POST['sdis']);
	$_POSTS['mms_cost'] = json_encode($_POST['mcost']);
	$_POSTS['shipment_cost'] = json_encode($_POST['shipcost']);
	$_POSTS['pay_at_ordering'] = json_encode($_POST['orderpercentage']);
	$_POSTS['mounting_structure'] = json_encode($_POST['mmswarranty']);
	$_POSTS['production_data'] = json_encode($_POST['production']);
	$_POSTS['electricity_data'] = json_encode($_POST['electricity']);



//print_r($_POSTS);

//echo $field_values_array[0][0];

//print_r(json_decode($_POSTS['ev_charger_types']));die;


	$cms->sqlquery("rs","customer_price",$_POSTS,'id',1);
	$adm->sessset('Record has been updated', 's');
	
	//$cms->redir(SITE_PATH_ADM.CPAGE.'?mode=add&id='.$uids, true);
	$cms->redir(SITE_PATH_ADM.CPAGE, true);
	
}	

$rsAdmin=$cms->db_query("select * from #_customer_price where id='1'");
$arrAdmin=$cms->db_fetch_array($rsAdmin);
@extract($arrAdmin);


?>
<div class="row">
	<div class="col-sm-12">
		<div class="white-box">
			<?=$cms->sform((($mode)?'onsubmit="return formvalid(this)"':'onsubmit="return formvalid(this)"'));?>
			<div class="form-group col-sm-9">&nbsp;</div>
			<div class="form-group col-sm-3 text-right pull-right">
                <button type="submit" class="btn btn-primary" id="submit_btn">Publish</button>
                <button type="button" onclick="history.go(-1)" class="btn btn-primary">Back</button>
            </div>
			<div class="clearfix"></div>
			
            <!-- Tab panes -->
            <div class="tab-content">
				<div role="tabpanel" class="tab-pane fade active in" id="eng">
					<div class="form-group">
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultOne" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleCollapseDefaultOne">EV charger  </a> 
								</div>
								<div class="panel-collapse collapse" id="exampleCollapseDefaultOne" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
									<div class="panel-body">
										<div class="list_wrapper list_wrapper1">  
                                
								
								<?php
								
										
										$obj = json_decode($ev_charger_types);
										$ec_cnt = count($obj);
										if(count($obj)>0)
										{
											$i=0;
											foreach($obj as $val){
											
											?>
											<div class="row" id="rev<?=$i?>">
											<div class="col-xs-4 col-sm-4 col-md-4">

                                        <div class="form-group">
                                            Name
                                            <input name="evc[<?=$i?>][name]" type="text" placeholder="Name" class="form-control" value="<?=$val->name?>"/>
                                            
                                        </div>
                                    </div>

                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                        <div class="form-group">
                                            Cost
                                            <input autocomplete="off" name="evc[<?=$i?>][price]" type="text" placeholder="Cost" class="form-control" value="<?=$val->price?>"/>
                                        </div>
                                    </div> 
									<div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            Warranty (in years)
                                            <input autocomplete="off" name="evc[<?=$i?>][cwarranty]" type="text" placeholder="Warranty" class="form-control" value="<?=$val->cwarranty?>"/>
                                        </div>
                                    </div> 

                                    <div class="col-xs-1 col-sm-1 col-md-1">
                                        <br>
                                       <button class="" onclick='revrcrd("rev<?=$i?>")' type="button"><i class="fa fa-close text-danger"></i></button>
                                    </div>
									<?php
									$i++;
										echo '</div>';
											}
										}
								?>
								
                                <div class="row">
								
                                    <div class="col-xs-4 col-sm-4 col-md-4"><h3>Add New <button class="btn btn-primary list_add_button1" type="button">+</button></h3></div>
									<!--<div class="clearfix"></div>
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            Name
                                            <input name="evc[<?=$i?>][name]" type="text" placeholder="Name" class="form-control"/>
                                            
                                        </div>
                                    </div>

                                    <div class="col-xs-7 col-sm-7 col-md-7">
                                        <div class="form-group">
                                            Price
                                            <input autocomplete="off" name="evc[<?=$i?>][price]" type="text" placeholder="Price" class="form-control"/>
                                        </div>
                                    </div> -->

                                    <div class="col-xs-1 col-sm-1 col-md-1">
                                        <br>
                                       
                                    </div>
                                </div>
                            </div>
							<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultTwo" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleCollapseDefaultTwo">Panel Model/Type </a> 
								</div>
								<div class="panel-collapse collapse" id="exampleCollapseDefaultTwo" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
									<div class="panel-body">
										<div class="list_wrapper list_wrapper2">  
                              
								
								<?php
								
										
										$obj = json_decode($panel_types);
										$pty_cnt = count($obj);
										$i=0;
										if(count($obj)>0)
										{
											
											foreach($obj as $val){
											
											?>
											  <div class="row" id="pmt<?=$i?>">
											
									<div class="col-xs-3 col-sm-3 col-md-3">

                                        <div class="form-group">
                                            Name
                                            <input name="pty[<?=$i?>][name]" type="text" placeholder="Name" class="form-control" value="<?=$val->name?>"/>
                                            
                                        </div>
                                    </div>
									<div class="col-xs-3 col-sm-3 col-md-3">

                                        <div class="form-group">
                                            Brand
                                            <input name="pty[<?=$i?>][brand]" type="text" placeholder="Brand" class="form-control" value="<?=$val->brand?>"/>
                                            
                                        </div>
                                    </div>

								<div class="col-xs-2 col-sm-2 col-md-2">
                                        <div class="form-group">
                                            Wattage
                                            <input autocomplete="off" name="pty[<?=$i?>][wattage]" type="text" placeholder="wattage" class="form-control" value="<?=$val->wattage?>"/>
                                        </div>
                                    </div> 
                                    <div class="col-xs-1 col-sm-1 col-md-1">
                                        <div class="form-group">
                                            Cost
                                            <input autocomplete="off" name="pty[<?=$i?>][price]" type="text" placeholder="Cost" class="form-control" value="<?=$val->price?>"/>
                                        </div>
                                    </div> 
									<div class="col-xs-2 col-sm-2 col-md-2">
                                        <div class="form-group">
                                            Warranty (in years)
                                            <input autocomplete="off" name="pty[<?=$i?>][swarranty]" type="text" placeholder="Warranty" class="form-control" value="<?=$val->swarranty?>"/>
                                        </div>
                                    </div> 
									<div class="col-xs-3 col-sm-3 col-md-3">
                                        <div class="form-group">
                                           Effect Warranty (years)
                                            <input autocomplete="off" name="pty[<?=$i?>][effectWarranty]" type="text" placeholder="Warranty" class="form-control" value="<?=$val->effectWarranty?>"/>
                                        </div>
                                    </div> 
									<div class="col-xs-2 col-sm-2 col-md-2">
                                        <div class="form-group">
											Effect warranty after <?=$val->effectWarranty?> years (%)
                                            <input autocomplete="off" name="pty[<?=$i?>][warranty_percentage]" type="text" placeholder="Effect warranty after <?=$val->effectWarranty?> years (%)" class="form-control" value="<?=$val->warranty_percentage?>"/>
                                        </div>
                                    </div> 

									
                                    <div class="col-xs-1 col-sm-1 col-md-1">
                                        <br>
                                       <button class="" onclick='revrcrd("pmt<?=$i?>")' type="button"><i class="fa fa-close text-danger"></i></button>
                                    </div>
									<?php
									$i++;
										echo '</div>';	}
										}
								?>  
                                <div class="row">
								 <div class="col-xs-4 col-sm-4 col-md-4"><h3>Add New <button class="btn btn-primary list_add_button2" type="button">+</button></h3></div>
								<!--
									<div class="clearfix"></div>
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            Name
                                            <input name="pty[<?=$i?>][name]" type="text" placeholder="Name" class="form-control"/>
                                            
                                        </div>
                                    </div>

                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            Price
                                            <input autocomplete="off" name="pty[<?=$i?>][price]" type="text" placeholder="Price" class="form-control"/>
                                        </div>
                                    </div> 
								<div class="col-xs-3 col-sm-3 col-md-3">
                                        <div class="form-group">
                                            Wattage
                                            <input autocomplete="off" name="pty[<?=$i?>][wattage]" type="text" placeholder="Wattage" class="form-control"/>
                                        </div>
                                    </div> 
                                    <div class="col-xs-1 col-sm-1 col-md-1">
                                        <br>
                                       <button class="btn btn-primary list_add_button2" type="button">+</button>
                                    </div>
									-->
                                </div>
                          
									</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
										
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultThree" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleCollapseDefaultThree">Inverter Model</a> 
								</div>
								<div class="panel-collapse collapse" id="exampleCollapseDefaultThree" aria-labelledby="exampleCollapseDefaultThree" role="tabpanel">
									<div class="panel-body">
										<div class="list_wrapper list_wrapper3">  
                               
								
								<?php
								
										
										$obj = json_decode($inverter_types);
										$invt_cnt = count($obj);
										$i=0;
										if(count($obj)>0)
										{
											
											foreach($obj as $val){
											
											?>
											
											<div class="row" id="invm<?=$i?>">
											<div class="col-xs-4 col-sm-4 col-md-4">

                                        <div class="form-group">
                                            Name
                                            <input name="invt[<?=$i?>][name]" type="text" placeholder="Name" class="form-control" value="<?=$val->name?>"/>
                                            
                                        </div>
                                        </div>
										<div class="col-xs-3 col-sm-3 col-md-3">
										<div class="form-group">
                                            Brand
                                            <input name="invt[<?=$i?>][invbrand]" type="text" placeholder="Brand" class="form-control" value="<?=$val->invbrand?>"/>
                                            
                                        </div>
                                    </div>

                                    <div class="col-xs-2 col-sm-2 col-md-2">
                                        <div class="form-group">
                                            Cost
                                            <input autocomplete="off" name="invt[<?=$i?>][price]" type="text" placeholder="Cost" class="form-control" value="<?=$val->price?>"/>
                                        </div>
                                    </div> 
									<div class="col-xs-2 col-sm-2 col-md-2">
                                        <div class="form-group">
                                            Warranty (years)
                                            <input autocomplete="off" name="invt[<?=$i?>][invwarranty]" type="text" placeholder="Warranty" class="form-control" value="<?=$val->invwarranty?>"/>
                                        </div>
                                    </div> 
									
                                    <div class="col-xs-1 col-sm-1 col-md-1">
										<br>
                                         <button class="" onclick='revrcrd("invm<?=$i?>")' type="button"><i class="fa fa-close text-danger"></i></button>
                                    </div>
									<div class="clearfix"></div>
									<?php
									$i++;
										echo '</div>';	}
										}
								?>  
                                <div class="row">
								<div class="col-xs-4 col-sm-4 col-md-4"><h3>Add New <button class="btn btn-primary list_add_button3" type="button">+</button></h3></div>
								
									<!--<div class="clearfix"></div>
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            Name
                                            <input name="invt[<?=$i?>][name]" type="text" placeholder="Name" class="form-control"/>
                                            
                                        </div>
                                    </div>

                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            Price
                                            <input autocomplete="off" name="invt[<?=$i?>][price]" type="text" placeholder="Price" class="form-control"/>
                                        </div>
                                    </div> 
                                    <div class="col-xs-1 col-sm-1 col-md-1">
                                        <br>
                                       <button class="btn btn-primary list_add_button3" type="button">+</button>
                                    </div>-->
                                </div>
                          
									</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultThree1" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleCollapseDefaultThree1">Battery	</a> 
								</div>
								<div class="panel-collapse collapse" id="exampleCollapseDefaultThree1" aria-labelledby="exampleCollapseDefaultThree1" role="tabpanel">
									<div class="panel-body">
										<div class="list_wrapper list_wrapper5">  
                               
								
								<?php
								
										
										$obj = json_decode($battery_types);
										$btrcs_cnt = count($obj);
										$i=0;
										if(count($obj)>0)
										{
											
											foreach($obj as $val){
											
											?>
											 <div class="row" id="btrow<?=$i?>">
											<div class="col-xs-4 col-sm-4 col-md-4">

                                        <div class="form-group">
                                            Name
                                            <input name="btrcs[<?=$i?>][name]" type="text" placeholder="Name" class="form-control" value="<?=$val->name?>"/>
                                            
                                        </div>
                                    </div>

                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                        <div class="form-group">
                                            Cost
                                            <input autocomplete="off" name="btrcs[<?=$i?>][price]" type="text" placeholder="Cost" class="form-control" value="<?=$val->price?>"/>
                                        </div>
                                    </div> 
									<div class="col-xs-3 col-sm-3 col-md-3">
                                        <div class="form-group">
                                            Warranty (year)
                                            <input autocomplete="off" name="btrcs[<?=$i?>][bwarranty]" type="text" placeholder="Warranty" class="form-control" value="<?=$val->bwarranty?>"/>
                                        </div>
                                    </div> 
									
                                    <div class="col-xs-1 col-sm-1 col-md-1">
                                        <br>
                                       <button class="" onclick='revrcrd("btrow<?=$i?>")' type="button"><i class="fa fa-close text-danger"></i></button>
                                    </div>
									<div class="clearfix"></div>
									<?php
									$i++;
										echo '</div>';	}
										}
								?>  
                                <div class="row">
								
                                    <div class="col-xs-4 col-sm-4 col-md-4"><h3>Add New <button class="btn btn-primary list_add_button5" type="button">+</button></h3></div>
									<!--
									<div class="clearfix"></div>
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            Name
                                            <input name="btrcs[<?=$i?>][name]" type="text" placeholder="Name" class="form-control"/>
                                            
                                        </div>
                                    </div>

                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            Price
                                            <input autocomplete="off" name="btrcs[<?=$i?>][price]" type="text" placeholder="Price" class="form-control"/>
                                        </div>
                                    </div> 
                                    <div class="col-xs-1 col-sm-1 col-md-1">
                                        <br>
                                       <button class="btn btn-primary list_add_button5" type="button">+</button>
                                    </div>-->
                                </div>
                          
									</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#exampleHeadingDefaultFour" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleHeadingDefaultFour">Installation  Cost</a> 
								</div>
								<div class="panel-collapse collapse" id="exampleHeadingDefaultFour" aria-labelledby="exampleHeadingDefaultFour" role="tabpanel">
									<div class="panel-body">
										<div class="list_wrapper list_wrapper4">  
                               
								
								<?php
								
										
										$obj = json_decode($installation_charges);
										$intc_cnt = count($obj);
										$i=0;
										if(count($obj)>0)
										{
											
											foreach($obj as $val){
											
											?>
											 <div class="row" id="inscrow<?=$i?>">
											<div class="col-xs-2 col-sm-2 col-md-2">

                                        <div class="form-group">
                                            Number of Days
                                            <input name="intc[<?=$i?>][day]" type="text" placeholder="Days" class="form-control" value="<?=$val->day?>"/>
                                            
                                        </div>
                                    </div>

                                    <div class="col-xs-2 col-sm-2 col-md-2">
                                        <div class="form-group">
                                            Cost
                                            <input autocomplete="off" name="intc[<?=$i?>][price]" type="text" placeholder="Cost" class="form-control" value="<?=$val->price?>"/>
                                        </div>
                                    </div> 
									<div class="col-xs-3 col-sm-3 col-md-3">
                                        <div class="form-group">
                                            Work performed (year)
                                            <input autocomplete="off" name="intc[<?=$i?>][work_year]" type="text" placeholder="Work Performed" class="form-control" value="<?=$val->work_year?>"/>
                                        </div>
                                    </div> 
									
                                    <div class="col-xs-1 col-sm-1 col-md-1">
                                        <br>
                                        <button class="" onclick='revrcrd("inscrow<?=$i?>")' type="button"><i class="fa fa-close text-danger"></i></button>
                                    </div>
									<div class="clearfix"></div>
									<?php
									$i++;
										echo '</div>';	}
										}
								?>  
                                <div class="row">
								
                                    <div class="col-xs-4 col-sm-4 col-md-4"><h3>Add New <button class="btn btn-primary list_add_button4" type="button">+</button></h3></div>
									<!--
									<div class="clearfix"></div>
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            Number of Days
                                            <input name="intc[<?=$i?>][day]" type="text" placeholder="Days" class="form-control"/>
                                            
                                        </div>
                                    </div>

                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            Price
                                            <input autocomplete="off" name="intc[<?=$i?>][price]" type="text" placeholder="Price" class="form-control"/>
                                        </div>
                                    </div> 
                                    <div class="col-xs-1 col-sm-1 col-md-1">
                                        <br>
                                       <button class="btn btn-primary list_add_button4" type="button">+</button>
                                    </div>
									-->
                                </div>
                          
									</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#mmswarranty" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="mmswarranty">Module Mounting Structure</a> 
								</div>
								<div class="panel-collapse collapse" id="mmswarranty" aria-labelledby="mmswarranty" role="tabpanel">
									<div class="panel-body">
										<div class="list_wrapper">  
											<div class="row">
									
											<?php
									
											
											$obj_mounting = json_decode($mounting_structure);
											$i=0;
											?>
												<div class="col-xs-4 col-sm-4 col-md-4">

											<div class="form-group">
											 Product guarantee mounting system (year)
												<input name="mmswarranty[<?=$i?>][mwarranty]" type="text" placeholder="" class="form-control" value="<?=$obj_mounting[0]->mwarranty?>"/>
												
											</div>
											</div>
											</div>  
                            
                          
									</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#exampleHeadingDefaultFour1" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleHeadingDefaultFour1">Green Rebate</a> 
								</div>
								<div class="panel-collapse collapse" id="exampleHeadingDefaultFour1" aria-labelledby="exampleHeadingDefaultFour1" role="tabpanel">
									<div class="panel-body">								
										<div class="list_wrapper">  
                                <div class="row">
								
								<?php
								
										
										$obj_solar = json_decode($green_rebate_solar);
										$obj_ev = json_decode($green_rebate_ev);
										$obj_battery = json_decode($green_rebate_battery);
										$i=0;
										?>
											<div class="col-xs-4 col-sm-4 col-md-4">

                                        <div class="form-group">
                                           for solar panels (%)
                                            <input name="grs[<?=$i?>][rebate]" type="text" placeholder="" class="form-control" value="<?=$obj_solar[0]->rebate?>"/>
                                            
                                        </div>
										</div>
										<div class="col-xs-4 col-sm-4 col-md-4">

                                        <div class="form-group">
                                           for EV charger (%)
                                            <input name="grev[<?=$i?>][rebate]" type="text" placeholder="" class="form-control" value="<?=$obj_ev[0]->rebate?>"/>
                                            
                                        </div>
										</div>
										<div class="col-xs-4 col-sm-4 col-md-4">

                                        <div class="form-group">
                                           for Battery (%)
                                            <input name="grb[<?=$i?>][rebate]" type="text" placeholder="" class="form-control" value="<?=$obj_battery[0]->rebate?>"/>
                                            
                                        </div>
										</div>

									<div class="clearfix"></div>
									  </div>
                                
                          
									</div>
										
									</div>
								</div>
							</div>
						</div>
						
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#aboutMeta" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="aboutMeta">Margins</a> 
								</div>
								<div class="panel-collapse collapse" id="aboutMeta" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
									<div class="panel-body">
										<div class="list_wrapper">  
                                <div class="row">
								
								<?php
								
										
										$obj_smrg = json_decode($solar_margin);
										$obj_evmrg = json_decode($ev_margin);
										$obj_btmrg = json_decode($battery_margin);
										$i=0;
										?>
											<div class="col-xs-4 col-sm-4 col-md-4">

                                        <div class="form-group">
                                           Margins for solar panel (%)
                                            <input name="smrg[<?=$i?>][margin]" type="text" placeholder="" class="form-control" value="<?=$obj_smrg[0]->margin?>"/>
                                            
                                        </div>
										</div>
										<div class="col-xs-4 col-sm-4 col-md-4">

                                        <div class="form-group">
                                           Margins for EV charger (%)
                                            <input name="evmrg[<?=$i?>][margin]" type="text" placeholder="" class="form-control" value="<?=$obj_evmrg[0]->margin?>"/>
                                            
                                        </div>
										</div>
										<div class="col-xs-4 col-sm-4 col-md-4">

                                        <div class="form-group">
                                           Margin for Battery  (%)
                                            <input name="btmrg[<?=$i?>][margin]" type="text" placeholder="" class="form-control" value="<?=$obj_btmrg[0]->margin?>"/>
                                            
                                        </div>
										</div>

									<div class="clearfix"></div>
									  </div>
                                
                          
									</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#production" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="production">Production</a> 
								</div>
								<div class="panel-collapse collapse" id="production" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
									<div class="panel-body">
										<div class="list_wrapper">  
                                <div class="row">
								
								<?php
								
										
										$obj_prod = json_decode($production_data);
										$i=0;
										?>
										
										<div class="form-group col-md-6">
											<label class="control-label">Annual inflation adjustment on electricity price (%)</label>
											<input type="text" class="form-control" name="production[<?=$i?>][prod_inflation]" placeholder="Annual inflation adjustment on electricity price" value="<?=$obj_prod[0]->prod_inflation?>">
										</div>
										<div class="form-group col-md-6">
											<label class="control-label">Real price increase on variable electricity price (%)</label>
											<input type="text" class="form-control" name="production[<?=$i?>][prod_price_increase]" placeholder="Real price increase on variable electricity price" value="<?=$obj_prod[0]->prod_price_increase?>">
										</div>
										<div class="form-group col-md-6">
											<label class="control-label">Annual effect deterioration in percent (%)</label>
											<input type="text" class="form-control" name="production[<?=$i?>][prod_deterioration]" placeholder="Annual effect deterioration in percent" value="<?=$obj_prod[0]->prod_deterioration?>">
										</div>
										<div class="form-group col-md-3">
											<label class="control-label">Power loss (%)</label>
											<input type="text" class="form-control" name="production[<?=$i?>][prod_power_loss]" placeholder="Power loss" value="<?=$obj_prod[0]->prod_power_loss?>">
										</div>
										</div>

									<div class="clearfix"></div>
									  </div>
                                
                          
									</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
							
							<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#electricity" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="electricity">Electricity price based on own consumption</a> 
								</div>
								<div class="panel-collapse collapse" id="electricity" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
									<div class="panel-body">
										<div class="list_wrapper">  
                                <div class="row">
								
								<?php
								
										
										$obj_elect = json_decode($electricity_data);
										$i=0;
										?>
										
										<div class="form-group col-md-6">
											<label class="control-label">Own consumption (kr/kWh)</label>
											<input type="text" class="form-control" name="electricity[<?=$i?>][elec_consumption]" placeholder="Own Consumption" value="<?=$obj_elect[0]->elec_consumption?>">
										</div>
										<div class="form-group col-md-6">
											<label class="control-label">Sold electricity (kr/kWh)</label>
											<input type="text" class="form-control" name="electricity[<?=$i?>][elec_sold]" placeholder="Sold electricity" value="<?=$obj_elect[0]->elec_sold?>">
										</div>
										</div>

									<div class="clearfix"></div>
									  </div>
                                
                          
									</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
							
						<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
							<div class="panel">
								<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
									<a class="panel-title collapsed" data-toggle="collapse" href="#solarDiscountPercentage" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="solarDiscountPercentage">Solar Discount</a> 
								</div>
								<div class="panel-collapse collapse" id="solarDiscountPercentage" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
									<div class="panel-body">
										<div class="list_wrapper">  
                                <div class="row">
								
								<?php
								
										
										$obj_sdis = json_decode($solar_discount);
										$i=0;
										?>
											<div class="col-xs-4 col-sm-4 col-md-4">

                                        <div class="form-group">
                                         Discount on solar panel (%)
                                            <input name="sdis[<?=$i?>][discount]" type="text" placeholder="" class="form-control" value="<?=$obj_sdis[0]->discount?>"/>
                                            
                                        </div>
										</div>
										</div>

									<div class="clearfix"></div>
									  </div>
                                
                          
									</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
							
							<!--<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
								<div class="panel">
									<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
										<a class="panel-title collapsed" data-toggle="collapse" href="#mmsCost" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="mmsCost">MMS Cost</a> 
									</div>
									<div class="panel-collapse collapse" id="mmsCost" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
										<div class="panel-body">
											<div class="list_wrapper">  
									<div class="row">
									
									<?php
									
											
											$obj_mmscost = json_decode($mms_cost);
											$i=0;
											?>
												<div class="col-xs-4 col-sm-4 col-md-4">

											<div class="form-group">
											 MMS Cost
												<input name="mcost[<?=$i?>][mmscost]" type="text" placeholder="" class="form-control" value="<?=$obj_mmscost[0]->mmscost?>"/>
												
											</div>
											</div>
											</div>

										<div class="clearfix"></div>
										  </div>
									
							  
										</div>
											<div class="clearfix"></div>
										</div>
									</div>
							</div>-->
							
							<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
								<div class="panel">
									<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
										<a class="panel-title collapsed" data-toggle="collapse" href="#shipment" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="shipment">Shipment Cost</a> 
									</div>
									<div class="panel-collapse collapse" id="shipment" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
										<div class="panel-body">
											<div class="list_wrapper">  
									<div class="row">
									
									<?php
									
											
											$obj_shipcost = json_decode($shipment_cost);
											$i=0;
											?>
												<div class="col-xs-4 col-sm-4 col-md-4">

											<div class="form-group">
											 Shipment Cost
												<input name="shipcost[<?=$i?>][shipmentcost]" type="text" placeholder="" class="form-control" value="<?=$obj_shipcost[0]->shipmentcost?>"/>
												
											</div>
											</div>
											</div>

										<div class="clearfix"></div>
										  </div>
									
							  
										</div>
											<div class="clearfix"></div>
										</div>
									</div>
							</div>
							
							<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
								<div class="panel">
									<div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab"> 
										<a class="panel-title collapsed" data-toggle="collapse" href="#orderPayment" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="orderPayment">Pay at ordering</a> 
									</div>
									<div class="panel-collapse collapse" id="orderPayment" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
										<div class="panel-body">
											<div class="list_wrapper">  
									<div class="row">
									
									<?php
									
											
											$obj_orderPayment = json_decode($pay_at_ordering);
											$i=0;
											?>
												<div class="col-xs-4 col-sm-4 col-md-4">

											<div class="form-group">
												Pay % at ordering
													<input name="orderpercentage[<?=$i?>][orderPayment]" type="text" placeholder="" class="form-control" value="<?=$obj_orderPayment[0]->orderPayment?>"/> 
												
											</div>
											</div>
											</div>

										<div class="clearfix"></div>
										  </div>
									
							  
										</div>
											<div class="clearfix"></div>
										</div>
									</div>
							</div>
							
							
						</div>
					</div>			           
				</div>
				
						           
			</div>			           
			<?=$cms->eform();?>
		</div>
	</div>
</div>
<!-- /.row -->
<script>
 function changeMethod() {
	$("#aforms").attr("method", "get");
}
</script>	

<script type="text/javascript">
$(document).ready(function()

    {

	var list_maxField = 50; //Input fields increment limitation
	
    // sec1
	var x1 = "<?=$ec_cnt-1?>"; //Initial field counter	
	$('.list_add_button1').click(function()
	    {
			
	    //Check maximum number of input fields
	    if(x1 < list_maxField){ 
	        x1++; //Increment field counter
	        var list_fieldHTML = '<div class="row"><div class="col-xs-4 col-sm-4 col-md-4"><div class="form-group"><input name="evc['+x1+'][name]" type="text" placeholder="Name" class="form-control"/></div></div><div class="col-xs-3 col-sm-3 col-md-3"><div class="form-group"><input name="evc['+x1+'][price]" type="text" placeholder="Cost" class="form-control"/></div></div><div class="col-xs-4 col-sm-4 col-md-4"><div class="form-group"><input autocomplete="off" name="evc['+x1+'][cwarranty]" type="text" placeholder="Warranty" class="form-control"/></div></div> <div class="col-xs-1 col-sm-7 col-md-1"><a href="javascript:void(0);" class="list_remove_button btn btn-danger">-</a></div></div>'; //New input field html 
	        $('.list_wrapper1').append(list_fieldHTML); //Add field html
	    }
        });
    // sec2
	var x2 = "<?=$pty_cnt-1?>"; //Initial field counter
	$('.list_add_button2').click(function()
	    {
	    //Check maximum number of input fields
	    if(x2 < list_maxField){ 
	        x2++; //Increment field counter
	        var list_fieldHTML = '<div class="row"><div class="col-xs-3 col-sm-3 col-md-3"><div class="form-group"><input name="pty['+x2+'][name]" type="text" placeholder="Name" class="form-control"/></div></div><div class="col-xs-3 col-sm-3 col-md-3"><div class="form-group"><input name="pty['+x2+'][brand]" type="text" placeholder="Brand" class="form-control"/></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input name="pty['+x2+'][wattage]" type="text" placeholder="wattage" class="form-control"/></div></div><div class="col-xs-1 col-sm-1 col-md-1"><div class="form-group"><input name="pty['+x2+'][price]" type="text" placeholder="Cost" class="form-control"/></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input autocomplete="off" name="pty['+x2+'][swarranty]" type="text" placeholder="Warranty" class="form-control" /></div></div><div class="col-xs-3 col-sm-3 col-md-3"><div class="form-group"><input autocomplete="off" name="pty['+x2+'][effectWarranty]" type="text" placeholder="Warranty" class="form-control" /></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input autocomplete="off" name="pty['+x2+'][warranty_percentage]" type="text" placeholder="Warranty" class="form-control" /></div></div> <div class="col-xs-1 col-sm-7 col-md-1"><a href="javascript:void(0);" class="list_remove_button btn btn-danger">-</a></div></div>'; //New input field html 
	        $('.list_wrapper2').append(list_fieldHTML); //Add field html
	    }
        });
	 // sec3
	 var x3 = "<?=$invt_cnt-1?>"; //Initial field counter
	$('.list_add_button3').click(function()
	    {
	    //Check maximum number of input fields
	    if(x3 < list_maxField){ 
	        x3++; //Increment field counter
	        var list_fieldHTML = '<div class="row"><div class="col-xs-4 col-sm-4 col-md-4"><div class="form-group"><input name="invt['+x3+'][name]" type="text" placeholder="Name" class="form-control"/></div></div><div class="col-xs-3 col-sm-3 col-md-3"><div class="form-group"><input name="invt['+x3+'][invbrand]" type="text" placeholder="Brand" class="form-control" /></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input name="invt['+x3+'][price]" type="text" placeholder="Cost" class="form-control"/></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input autocomplete="off" name="invt['+x3+'][invwarranty]" type="text" placeholder="Warranty" class="form-control" /></div></div> <div class="col-xs-1 col-sm-7 col-md-1"><a href="javascript:void(0);" class="list_remove_button btn btn-danger">-</a></div></div>'; //New input field html 
	        $('.list_wrapper3').append(list_fieldHTML); //Add field html
	    }
        });	
	// sec4
	var x4 = "<?=$intc_cnt-1?>"; //Initial field counter	
	$('.list_add_button4').click(function()
	    {
	    //Check maximum number of input fields
	    if(x4 < list_maxField){ 
	        x4++; //Increment field counter
	        var list_fieldHTML = '<div class="row"><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input name="intc['+x4+'][day]" type="text" placeholder="Day" class="form-control"/></div></div><div class="col-xs-2 col-sm-2 col-md-2"><div class="form-group"><input name="intc['+x4+'][price]" type="text" placeholder="Cost" class="form-control"/></div></div><div class="col-xs-3 col-sm-3 col-md-3"><div class="form-group"><input autocomplete="off" name="intc['+x4+'][work_year]" type="text" placeholder="Work Performed" class="form-control" value="<?=$val->work_year?>"/></div></div><div class="col-xs-1 col-sm-7 col-md-1"><a href="javascript:void(0);" class="list_remove_button btn btn-danger">-</a></div></div>'; //New input field html 
	        $('.list_wrapper4').append(list_fieldHTML); //Add field html
	    }
        });	
			 // sec5
			var x5 = "<?=$btrcs_cnt?>"; //Initial field counter			 
	$('.list_add_button5').click(function()
	    {
	    //Check maximum number of input fields
	    if(x5 < list_maxField){ 
	        x5++; //Increment field counter
	        var list_fieldHTML = '<div class="row"><div class="col-xs-4 col-sm-4 col-md-4"><div class="form-group"><input name="btrcs['+x5+'][name]" type="text" placeholder="Name" class="form-control"/></div></div><div class="col-xs-3 col-sm-3 col-md-3"><div class="form-group"><input name="btrcs['+x5+'][price]" type="text" placeholder="Cost" class="form-control"/></div></div><div class="col-xs-3 col-sm-3 col-md-3"><div class="form-group"><input autocomplete="off" name="btrcs['+x5+'][bwarranty]" type="text" placeholder="Warranty" class="form-control"  /></div></div><div class="col-xs-1 col-sm-7 col-md-1"><a href="javascript:void(0);" class="list_remove_button btn btn-danger">-</a></div></div>'; //New input field html 
	        $('.list_wrapper5').append(list_fieldHTML); //Add field html
	    }
        });
        //Once remove button is clicked
        $('.list_wrapper').on('click', '.list_remove_button', function()
        {
           $(this).closest('div.row').remove(); //Remove field html
           x--; //Decrement field counter
        });
});
function revrcrd(rid){
	$("#"+rid).remove();
}
</script>
<?php include("../../lib/opin.inc.php"); ob_start();?>
<?php
//$lead_id=$_GET["lead_id"];
$lead_id="11";
//$leadSQL = "SELECT * from  WHERE  id='".$lead_id."' "; 
$orderReq = $cms->db_query($leadSQL);
$orderRes = $orderReq->fetch_assoc();
$msg1 = '<html>
					<body>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color:#579584;" align="right">  
							<tr>
								<td align="center">
									<table width="100%" align="right" border="0" cellspacing="0" cellpadding="0" style="background-color:#ffffff;" >
										<tr>
											<td width="100%">
												<table width="100%"  cellspacing="0" cellpadding="0" align="right">
													<tr >
														<td width="45%" style="padding: 5px;"><img src="'.SITE_PATH.'images/logo.png"></td>
														<td style="padding: 5px;"><div><h5>I - 34, DLF Industrial Area, Phase-I, Faridabad<br>
														Tel. : 0129-2254191, Fax : 0129-2274344<br>
														Helpline : 9548-130-131<br>
														Email : enquiry@aldaindia.com</div></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td colspan="2">&nbsp;</td>
										</tr>
										<tr>
											<td colspan="2">&nbsp;</td>
										</tr>
										<tr>
											<td colspan="2"><div style="height:75px;"></div></td>
										</tr>
										<tr>
											<td>
												<table width="100%"  border="0" cellspacing="0" cellpadding="0">
												<tr>
														<td  colspan="3" align="left" style="padding: 4px;">
															<h1>PACKING SLIP</h1>
														</td>
													</tr>
													<tr>
														<td  style="padding: 2px;">
															<div><strong>'.$orderRes["name_shiping"].'</strong> <br></div>
															<div><strong>Address - </strong>';
															if($orderRes["shipping_address"]){ 
																$msg1.= ' '.$orderRes["shipping_address"].'<br>'; 
															} 
															if($orderRes["shipping_address2"]){ 
																$msg1.= 'Landmark: '.$orderRes["shipping_address2"].'<br>'; 
															} 
															$msg1.= '</div>';
															$msg1 .= '<div><strong> </strong> '.$orderRes["shipping_city"].' - '.$orderRes["shipping_zip"].'</div>';
															if($orderRes["shipping_state"]>0){ 
																$state = $cms->getSingleResult("SELECT state FROM #_states WHERE pid='".$orderRes["shipping_state"]."'"); }else if($orderRes["shipping_state"]!=""){
																$state = $orderRes["shipping_state"];
															}
															$msg1 .= '<div><strong>'.$state.'</strong> </div>'; 
															$msg1 .= '<div><strong>'.$orderRes["shipping_phone"].'</strong> </div>'; 
															

														$msg1.= '</td>
														<td colspan="2"  style="padding: 4px;">
														<div><strong>Order Number: </strong> '.$orderRes["order_no"].'</div>
														<div><strong>Order Date: </strong>'.date_fmt($orderRes["post_date"]).'</div>
														<div><strong>Shipping Method: </strong>'.$orderRes["payment_method"].'</div>
														</td>
													</tr>
													<tr>
													<td colspan="3">&nbsp;</td>
												</tr>
												<tr>
													<td colspan="3">&nbsp;</td>
												</tr>
												</table>
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<th style="padding: 4px;background-color:#000;color:#fff;height:50px;" width="20%" align="left">Product</th>
														<th style="padding: 4px;padding-left: 15px; background-color:#000; color:#fff;" width="20%" align="left">Quantity</th>
													</tr>';
													$orderSql = "SELECT od.`id`, od.`order_id`, od.`pr_id`, od.`sku`, od.`variation_id`, od.`variation`, od.`qty`, od.`price`, od.`offer_price`, od.`sale_price`, od.`tax`, od.`tax_amount`, od.`shipping_amount`, od.`add_on_product`, od.`session_id`, od.`user_action`, od.`feature_image`, od.`pr_name`, od.`is_single_product`, p.`cat_id`, b.`brand_name` FROM `byc_orders_detail` as od LEFT JOIN byc_products as p ON p.`id`=od.`pr_id` LEFT JOIN  `byc_brands` as b ON b.`id`=p.`brand_id` WHERE od.`order_id`='".$order_id."'";
													$orderReq = $cms->db_query($orderSql);
						
													if($orderReq->num_rows>0){
														$nm = 1;
														$sbTot =0;
														while($orderRes = $orderReq->fetch_assoc()){
															$msg1 .='<tr>
															<td style="padding: 4px;height:50px;">'.$orderRes["pr_name"];
															
															if(!empty($orderRes["variation"])){
																$msg1 .='('.preg_replace("/([^\,]+)_([^\,]+)/", " \\2", $orderRes["variation"]).')<br>';
															}
															$msg1 .='(<span style="font-size:10px;">SKU-'.$orderRes["sku"].'<span>)<br>';
															if($orderRes["add_on_product"]>0){ 
																$msg1 .= '<br><span style="color:red;">( FREE WITH '.$cms->getSingleResult("SELECT  p.`pr_name` FROM `byc_orders_detail` AS c LEFT JOIN `byc_products` AS p ON p.id=c.`pr_id` WHERE c.pr_id=(SELECT pr_id FROM byc_orders_detail WHERE id='".$orderRes["add_on_product"]."') ").')</span>'; 
															}

															$msg1 .='</td>
															<td style="padding: 4px;padding-left: 15px; height:50px;">'.$orderRes["qty"].'</td>
															</tr><tr><td colspan="2"><hr></td></tr>';
															$nm++;
														}
													}
									
												$msg1.='</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</body>
</html>';
echo $msg1;
$dompdf = new DOMPDF();
$dompdf->load_html($msg1);
//$dompdf->set_paper(array(0,0,12*72,12*72), 'portrait');
$dompdf->render();
 
///echo $output = $dompdf->stream("hello.pdf");
$output = $dompdf->output();
$fileName = $order_id."packing_slip.pdf";
file_put_contents(FILES_PATH.'packing_slip/'.$fileName, $output);
echo $output = $dompdf->stream($fileName); 
?>
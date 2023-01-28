<?php 
	error_reporting(0);
	ini_set('session.gc_maxlifetime',60*60);
	ini_set('session.gc_probability',1);
	ini_set('session.gc_divisor',1);  
	
	if(!empty($_GET['q'])){
		$qry=$_GET['q']; 
		$items=explode("/",$qry); 
		if(count($items)!=0){
			if($items[(count($items)-1)]==""){
				array_pop($items);
			}
		} 
	} 
	@extract($_POST);
	@extract($_GET);
	@extract($_SERVER);
	@extract($_SESSION);	
	ini_set('display_errors', 1);  
	ini_set('register_globals', 'on');	
	ini_set('memory_limit', '800M');
	ini_set('max_upload_filesize',"300M");	
	if ($HTTP_HOST == "127.0.0.1" || $HTTP_HOST == "localhost") {
		define('LOCAL_MODE',true);
	} else {
		define('LOCAL_MODE',false);
	}	
	
	$tmp = dirname(__FILE__);
	$tmp = str_replace('\\' ,'/',$tmp);
	$tmp = substr($tmp, 0, strrpos($tmp, '/'));
	define('SITE_FS_PATH', $tmp); 
	
	define('_JEXEC', $tmp);   
	
	require_once(SITE_FS_PATH."/lib/config.inc.website.php");
	//require_once(SITE_FS_PATH."/lib/adminfunction.inc.php");
	require_once(SITE_FS_PATH."/smtpmail/PHPMailerAutoload.php");
	require_once(SITE_FS_PATH."/lib/ckeditor2/ckeditor.php");
	require_once(SITE_FS_PATH."/lib/tcpdf/tcpdf.php");
	$adm = new ADMIN_DAL(); //Class Start 
	define('SCRIPT_START_TIME', $cms->getmicrotime());
	if(get_magic_quotes_runtime()) {
		set_magic_quotes_runtime(0);
	}
	
	if(basename($_SERVER['PHP_SELF'], ".php")=='index'){
		$tbl = 'index';	
	}else{
		$tbl = basename($_SERVER['REQUEST_URI'], ".html");		
	}
	
	//$pageinfo = $cms->pageinfo($tbl);	  
	 
	$pagen = (($tbl)?$tbl:'index'); 
 
	 
 	$folder_array = explode("/", $_SERVER['REQUEST_URI']);
	define("CPAGE",$folder_array[sizeof($folder_array)-2]);
		
	
	function getLocationInfoByIp(){
		$client  = @$_SERVER['HTTP_CLIENT_IP'];
		$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
		$remote  = @$_SERVER['REMOTE_ADDR'];
		$result  = array('country'=>'', 'city'=>'');
		if(filter_var($client, FILTER_VALIDATE_IP)){
			$ip = $client;
		}elseif(filter_var($forward, FILTER_VALIDATE_IP)){
			$ip = $forward;
		}else{
			$ip = $remote;
		}
		//echo $ip;
		$ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));    
		if($ip_data && $ip_data->geoplugin_countryName != null){
			$result['country'] = $ip_data->geoplugin_countryCode;
			$result['city'] = $ip_data->geoplugin_city;
		}
		//print_r($result);
		return ($result);
	}
	
	$resultCountry = getLocationInfoByIp();
	
	
	
	/*if($resultCountry['country']=='SE'){
		header('location:https://www.arkaenergy.se/demo');
	}else{
		header('location:https://www.arkaenergy.se/demo/en');
	*/
	
	$settingQr = $cms->db_query("SELECT * FROM #_setting WHERE id='1'");
	$settingArr = $settingQr->fetch_array();
	
	$roleArr = array("0"=>"User", "1"=>"Super Admin", "2"=>"Admin", "3"=>"Agent", "4"=>"Project Manager" );
	$leadFormType = array('1'=>'Calculator', '2'=>'Free Quote', '3'=>'Contact Form', '4'=>'Manual Lead');
	$leadSourceArr = array("0"=>'Manual', "1"=>'Website');
	//$leadsStatusArr = array("0"=>"New",  "5"=>"Quotation Created, Reply Awaited", "1"=>"Quote Approved", "2"=>"On-going", "3"=>"Completed", "4"=>"Rejected", "6"=>"Others", "7"=>"Scheduled");
	$leadsStatusArr = array("1"=>"New", "2"=>"Assigned", "3"=>"Project completed", "4"=>"Contract signed", "5"=>"Rejected", "6"=>"Offer sent", "7"=>"Reviewed", "8"=>"Dimensioning completed");
	$leadType = array('1'=>'Lead', '2'=>'Proposal', '3'=>'Project');
	
	$customerTypeArr = array("1"=>"Factory","2"=>"Hotel","3"=>"Hospital","4"=>"Home","5"=>"Shopping Mall","6"=>"Govt Department","7"=>"Commercial & Residential","8"=>"Others");
	$customerTypeArrSE = array("1"=>"Fabrik","2"=>"Hotell","3"=>"Sjukhus","4"=>"Hem","5"=>"Köpcentrum","6"=>"myndighet","7"=>"Kommersiellt & Bostäder","8"=>"Andra");
	
	$proosalCustomerTypeArr = array("1"=>"Privat","2"=>"Commercial");
	$workStartArr = array("1"=>"ASAP","2"=>"3 month","3"=>"6 month","4"=>"1 year");
	
	//$proposalType = array("1"=>"Solar panel only","2"=>"Solar panel + EV charger","3"=>"Solar panel + EV charger + Battery", "4"=>"Solar panel + Battery", "5"=>"EV Charger only", "6"=>"Battery only", "7"=>"Battery + EV charger", "8"=>"Campaign (Solar + EV charger + Battery)", "9"=>"Campaign (Solar + EV charger)", "10"=>"Campaign (Solar + Battery)", "11"=>"Campaign (Solar + Battery) green rebate to 50000");
	$proposalType = array("1"=>"Solar panel only","2"=>"Solar panel + EV charger","3"=>"Solar panel + EV charger + Battery", "4"=>"Solar panel + Battery", "5"=>"EV Charger only", "6"=>"Battery only", "7"=>"Battery + EV charger", "8"=>"Campaign (Solar + EV charger + Battery)", "9"=>"Campaign (Solar + EV charger)", "10"=>"Campaign (Solar + Battery) green rebate to 50000", "11"=>"Campaign (Solar + Battery)");
	$offerTyeArr = array('1'=>'BUDGETOFFERT', '2'=>'OFFERT');

		
	define('EMAIL_HOST',$settingArr['smtp_host']);
	define('EMAIL_USER',$settingArr['smtp_user']);
	define('EMAIL_PASSWORD',$settingArr['smtp_password']);
	define("FROM_EMAIL",$settingArr['from_email']);
	
	//mail to user
	function sendEmailOLD($toEmailId=null, $subject=null, $mailBody=null, $attechment=null)
	{
		//echo $attechment;
		//echo $mailBody;die;
		//return emailFormat($mailBody);
		$mail = new PHPMailer();
		//$mail->CharSet = "UTF-8";
		$mail->IsSMTP();     // set mailer to use SMTP
		$mail->Mailer = "mail";	// set mailer to use SMTP
		$mail->Host = EMAIL_HOST;  // specify main and backup server
		$mail->SMTPAuth = true;     // turn on SMTP authentication
		$mail->port = 465;
		$mail->Username = EMAIL_USER;  // SMTP username
		$mail->Password = EMAIL_PASSWORD; // SMTP password
		$mail->From = 'Arka Energy';
		$mail->SMTPSecure = 'ssl';
		//$mail->SMTPDebug = 4;
		$mail->FromName = "Arka Energy"; 
		$emailIds = explode(",",$toEmailId);
		foreach($emailIds as $emails){
			$mail->AddAddress($emails);
		}
		if($attechment!=''){
			$mail->AddAttachment($attechment);    // optional name
		}
		$mail->IsHTML(true);                                  // set email format to HTML
		$mail->Subject = $subject;
		$mail->Body    = $mailBody;
		if($mail->Send()){
			return true;
			
		}else{
			
			return $mail->ErrorInfo;
		}
	}
	
	function sendEmail($toEmailId=null, $subject=null, $mailBody=null, $attechment=null)
	{	
		//$msg=file_get_contents("http://www.doubleclickexpert.com/demo/glen_mailers/air-purifier.html");
		//$msg='HI123456789arka';
			$mail = new PHPMailer();
			$mail->CharSet = "UTF-8";
			//print_r($mail);die;
			$mail->IsSMTP();   
			$mail->Mailer = "mail";	// set mailer to use SMTP
			$mail->Host =EMAIL_HOST;  // specify main and backup server
			$mail->SMTPAuth = true;     // turn on SMTP authentication
			$mail->Username =EMAIL_USER;  // SMTP username
			$mail->Password =EMAIL_PASSWORD; // SMTP password
			$mail->From = EMAIL_USER;
			$mail->FromName = "Arka Energy";
			  $mail->SMTPSecure = 'ssl';
			 // $mail->SMTPDebug = 2;
			  $mail->Port = 465;
			if($toEmailId){
			$adminemails=explode(",",$toEmailId);
			foreach($adminemails as $to1)
			$mail->AddAddress($to1, "");
			//$mail->AddAttachment($uploaded_path);    // optional name
			}	
			$mail->IsHTML(true);                                  // set email format to HTML
			$mail->Subject = $subject;
			$mail->Body    = $mailBody;
			if($mail->Send()){
			return true;
			
			}else{
				
				return $mail->ErrorInfo;
			}
			
	}
	
//echo $m1 = sendEmail('sneha.techblue@gmail.com', 'hi', 'Thankyou');die;

	
	//define("PASSWORD_PATTERN","(?=^.{6,50}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$");
	define("PASSWORD_PATTERN","");
	define("PASSWORD_MSG","Password must contain atleast 6 characters");	
	
	function generatePassword($length = 8) {
		$alphabets = range('a','z');
		$numbers = range('0','9');
		$capitalAlphabets = range('A','Z');
		//$additional_characters = array('!','@','#','$','&');
		$final_array = array_merge($alphabets,$capitalAlphabets,$numbers);
		$password = '';
		while($length--) {
			$key = array_rand($final_array);
			$password .= $final_array[$key];
		}
		return $password;
	}
	function uploadImage($image,$folder,$imageName1=null){
		global $cms;
		$validImage  = array("jpg","JPG","jpeg","JPEG","gif","GIF","png","PNG","svg","SVG");
		if($_FILES[$image]["name"]){
			$err = ""; 
			if(!empty($_FILES[$image]['name'])){
				$path = $_FILES[$image]['name'];
				$end = pathinfo($path, PATHINFO_EXTENSION);
			}else{
				$end ="";
			}
			if(!in_array($end,$validImage)){
				$err = "You have uploaded an invalid file!";
				if($mess!=""){ echo "<script>alert('".$mess."')</script>";  } 
			}else{
				if($err==""){
					$basename	= $cms->baseurl(basename($_FILES[$image]['name'], ".".$end));  
					
					if($imageName1!=''){
						$imageName 	= $imageName1."_".time().'.'.$end;
					}
					else{
						$imageName 	= $basename."_".time().'.'.$end;
					}
					$imageLoc 	= $_FILES[$image]['tmp_name'];
					$imageSize	= $_FILES[$image]['size'];
					$imageType 	= $_FILES[$image]['type'];
					$filePath =  FILES_PATH.$folder.'/'.$imageName;
					$bool = move_uploaded_file($imageLoc, $filePath); 
					if($bool){
						return $imageName;
					}else{
						return 0;
					}
				}
			}
		}else{
			return 0;
		}
	}
	
	function emailFormat($body){
		$bodyy=urlencode($body);
		$html=file_get_contents(SITE_PATH."inc/email-format.php?body=$bodyy");
		return $html;
	}
	
	function get_faq_cat($project=null,$selected=null,$parent = 0,$parent_link='') {
		global $cms;
		//$html = '<ul>';
		$cqr="SELECT * FROM #_faq_categories WHERE is_deleted=0 and parent_id = '$parent' ";
		$query1 = $cms->db_query($cqr);
		while($row = $query1->fetch_array()) {
			$current_id = $row['id']; 
			if($selected==$current_id)
				$sel='selected';
			else
				$sel='';                  
				$html .= '<option value="'.$row['id'].'" '.$sel.'>' .$parent_link.$row['cat_name'];
				$has_sub = NULL;

				$qr2 = "SELECT COUNT(parent_id) FROM #_faq_categories WHERE is_deleted=0 and parent_id = '$current_id'  ";

				$qr = $cms->db_query($qr2);
				$has_sub = $qr->num_rows; 

			if($has_sub){
				//$parent_link=$parent_link." > ".$row['tag_display_name'];
				$html .= get_faq_cat($project,$selected,$current_id,($parent_link==''?'':$parent_link." ").$row['cat_name']." > ");
			}
			//$html .= '</li>';
		}
		//$html .= '</ul>';
		return $html;
    }
	
	function get_blog_category_list($project=null,$selected=null,$parent = 0,$parent_link='') {
		global $cms;
		//$html = '<ul>';
		$cqr="SELECT * FROM #_blog_catagories WHERE is_deleted=0 and parent_id = '$parent' ";
		$query1 = $cms->db_query($cqr);
		while($row = $query1->fetch_array()) {
			$current_id = $row['id']; 
			if($selected==$current_id)
				$sel='selected';
			else
				$sel='';                  
				$html .= '<option value="'.$row['id'].'" '.$sel.'>' .$parent_link.$row['cat_name'];
				$has_sub = NULL;

				$qr2 = "SELECT COUNT(parent_id) FROM #_blog_catagories WHERE is_deleted=0 and parent_id = '$current_id'  ";

				$qr = $cms->db_query($qr2);
				$has_sub = $qr->num_rows; 

			if($has_sub){
				//$parent_link=$parent_link." > ".$row['tag_display_name'];
				$html .= get_blog_category_list($project,$selected,$current_id,($parent_link==''?'':$parent_link." ").$row['cat_name']." > ");
			}
			//$html .= '</li>';
		}
		//$html .= '</ul>';
		return $html;
    }
	
	function getPageUrl($pageId,$countryConst,$urlConst) {
		global $cms;
		//$html = '<ul>';
		$pageQry = $cms->db_query("Select * from #_menu where id=$pageId ");
		$pageRes = $pageQry->fetch_array();
		
		if($countryConst == 'SE'){
			$href= SITE_PATH.$urlConst.$pageRes['menu_url_sw'];
		}else{
			$href= SITE_PATH.$urlConst.$pageRes['menu_url'];
		}
		return $href;
    }

	function amount_format($amount){
		$formated_amt = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $amount);
		$formated_amt = str_replace(",", " ",$formated_amt);
		return $formated_amt.' kr';
	}
	
	function value_format($amount){
		$value_format = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $amount);
		$value_format = str_replace(",", " ",$value_format);
		return $value_format.' kWh';
	}
	function getSize($area){
		// x/2.2*390/1000 kw
		return (floor(($area/2.2)*(390/1000)));
	}
	function getCapacity($area,$pvar){
		// Area/2.2*(Panel type Watts)/1000
		return (round(($area/2.2)*($pvar/1000)));
	}
	function numberOfPanels($area){
		//  x/2.2
		return (floor($area/2.2));
	}
	function getAnnualSavings($capacity){
		// s= Rs. Capacity*980*1.2
		return (floor($capacity*980*1.2));
	}
	function upfrontCost($panels, $panel_cost, $mms_cost, $installation_cost, $Inverter_cost, $vat, $margin){
		// a= ((Panels*Panel cost)+MMS+Installation+Inverter)*1.25*1.2
		return floor((($panels*$panel_cost)+$mms_cost+$installation_cost+$Inverter_cost)*$vat*$margin);
	}
	function greenSubsidy($upfrontCostPanel, $upfrontCostBattery , $upfrontCostCharger){
		//(Upfront Panel*0,1445) + (Upfront Charger*0,5) + (Upfront Battery*0,5)
		return floor(($upfrontCostPanel*0.1445)+$upfrontCostBattery+$upfrontCostCharger);
	}
	
	function solarGreenSubsidy($upfrontCostPanel, $solarGR){
		return floor(($upfrontCostPanel*$solarGR)/100);
	}
	function batteryGreenSubsidy($upfrontCostBattery, $batteryGR){
		return floor(($upfrontCostBattery*$batteryGR)/100);
	}
	function chargerGreenSubsidy($upfrontCostCharger, $chargerGR){
		return floor(($upfrontCostCharger*$chargerGR)/100);
	}
	
	function getPaybackTime($price, $annual_savings){
		// Price/Annual Savings
		return floor($price/$annual_savings);
	}
	function yearlyEnergyProduction($capacity){
		// Capacity*980
		return floor($capacity*980);
	}
	function getPrice($upfrontCostPanel, $upfrontCostBattery , $upfrontCostCharger){
		// (Upfront Panel*0,855) + (Upfront Charger*0,5) + (Upfront Battery*0,5)
		return floor(($upfrontCostPanel*0.855)+$upfrontCostBattery+$upfrontCostCharger);
	}
	
	function customerPrice($solar_customer_price, $battery_customer_price, $charger_customer_price){
		return floor($solar_customer_price+$battery_customer_price+$charger_customer_price);
	}
	
	function proposal_decimal_format($input_value){
		$formated_amt = str_replace(".", ",",$input_value);
		return $formated_amt;
	}

	function swedish_to_decimal_format($input_value){
		$formated_amt = str_replace(",", ".",$input_value);
		return $formated_amt;
	}	
	
	function amount_format_proposal($price){
		$price_array = str_split(strrev($price), 3);
		$formated_amt =  strrev(implode(",", $price_array));
		$swedishFormat = str_replace(",", " ",$formated_amt);
		return $swedishFormat;
	}
	

	//echo getZipCode('Rudbecksvägen 6A 14743 Tumba');
	function getZipCode($address) {
		$ok = preg_match("/(\d\d\d\d\d)/", $address, $matches);
		if (!$ok) {
			// This address doesn't have a ZIP code
		}
		$postal_code =  $matches[count($matches) - 1];
		$break_pos =  strpos($address, $postal_code);
		$part1 =  substr($address,0,($break_pos-1));
		$part2 =  substr($address,($break_pos-1));
		return trim($part1).'<br>'.trim($part2);
		//return $postal_code;
	}
	
	function generateLeadId($lead_id){
		$uniqueLeadID = "LEAD-".$lead_id;
		return $uniqueLeadID;
	}
	function generateQuotationNumber($lead_id,$solar_name,$ev_charger,$battery){
		/*if($solar_name!='' && $ev_charger!='' && $battery!=''){
			$quotation_num = "SEB-".sprintf("%05d",$lead_id);
		}
		else if($solar_name!='' && $ev_charger!=''){
			$quotation_num = "SE-".sprintf("%05d",$lead_id);
		}
		else if($solar_name!='' && $battery!=''){
			$quotation_num = "SB-".sprintf("%05d",$lead_id);
		}
		else if($solar_name!=''){
			$quotation_num = "S-".sprintf("%05d",$lead_id);
		}
		else if($ev_charger!=''){
			$quotation_num = "E-".sprintf("%05d",$lead_id);
		}
		else if($battery!=''){
			$quotation_num = "B-".sprintf("%05d",$lead_id);
		}
		else{
			$quotation_num = "";
		}*/
		
		$quotation_num = sprintf("%05d",$lead_id);
		//echo $quotation_num;die;
		return $quotation_num;
	}
	//echo generateQuotationNumber(142,'','','');die;
	function getAllAgents(){
		global $cms;
	
		$agentQry = $cms->db_query("SELECT id, customer_name FROM #_users WHERE id!=1 AND status=1 AND is_deleted=0 ORDER BY customer_name ");
		if($agentQry->num_rows>0){
			while($agentRes=$agentQry->fetch_array()){
				$allAgents[$agentRes["id"]]=$agentRes["customer_name"];
			}
			return $allAgents;
		}
	}
	
	function getAllProjectManager(){
		global $cms;
	
		$pmQry = $cms->db_query("SELECT id, customer_name FROM #_users WHERE id!=1 AND role=4 AND status=1 AND is_deleted=0 ORDER BY customer_name ");
		if($pmQry->num_rows>0){
			while($pmRes=$pmQry->fetch_array()){
				$allProjectManager[$pmRes["id"]]=$pmRes["customer_name"];
			}
			return $allProjectManager;
		}
	}
	
	function getAllStatus(){
		global $cms;
		$statusQry=$cms->db_query("select * from #_lead_type_status where status=1 and is_deleted=0 and lead_type=1 order by lead_status ");
		if($statusQry->num_rows>0){
			while($statusRes=$statusQry->fetch_array()){
				$allStatus[$statusRes["constant"]]=$statusRes["lead_status"];
			}
			return $allStatus;
		}
	}
	
	function getAllLeadType(){
		global $cms;
		$leadTypeQry=$cms->db_query("select * from #_lead_type_status where status=1 and is_deleted=0 and lead_type=2 order by lead_status ");
		if($leadTypeQry->num_rows>0){
			while($leadTypeRes=$leadTypeQry->fetch_array()){
				$allLeadType[$leadTypeRes["constant"]]=$leadTypeRes["lead_status"];
			}
			return $allLeadType;
		}
	}
	function get_customer_list($cid = 0) {
		global $cms;
		
		if($_SESSION["ses_adm_role"]==4){
			$adminRole = " AND project_manager='".$_SESSION["ses_adm_id"]."'";
		}else{
			$adminRole = "";
		}
		
		$cqr="SELECT * FROM #_leads WHERE lead_id>0 AND is_deleted=0 AND status=4 AND customer_name!='' $adminRole order by customer_name ";
		$query1 = $cms->db_query($cqr);
		while($row = $query1->fetch_array()) {
			$current_id = $row['id']; 
			if($cid==$current_id)
				$sel='selected';
			else
				$sel='';                  
			$html .= '<option value="'.$row['id'].'" '.$sel.'>' .$row['customer_name'].'</option>';
		};
		return $html;
    }
	
	function calculate_mms_cost($per_panel_cost, $no_of_panels) {
		$mms_cost = 0;
		if($per_panel_cost!='' && $no_of_panels!=''){
			$mms_cost = $per_panel_cost*$no_of_panels;
		}else{
			$mms_cost = 0;
		}
		return $mms_cost;
    }
	
	function installation_days($panels,$has_battery) {
		$min_panel = 0;
		$max_panel = 200;
		$diff = 20;
		$day = 1;
		$battery_day = 1.5;
		$day_diff = 1;
		
		while($min_panel<=$max_panel){
			if($panels>$min_panel && $panels<=($min_panel+$diff)){
				if($has_battery==''){
					$installation_day = $day;
				}else{
					$installation_day = $battery_day;
				}
			}
			$min_panel = $min_panel+$diff;
			$day = $day+$day_diff;
			$battery_day = $battery_day+$day_diff;
		}
		return $installation_day;
    }	
	
	function activity($leadid,$new_status){
		global $cms;
		if($leadid!='' && $new_status!=''){
			$userQry = $cms->db_query("SELECT customer_name, lead_unique_id, status FROM #_leads where id=$leadid ");
			$userRes = $userQry->fetch_array();
			if($_SESSION["ses_adm_role"]=="1"){
				echo $leadid;
				$activityMsg = $userRes['customer_name'].' lead assigned to you - '.$userRes['lead_unique_id'];
			}else{
				$activityMsg = $userRes['customer_name'].' lead assigned to you - '.$userRes['lead_unique_id'];
			}
		}else{
			$activityMsg = '';
		}
		return $activityMsg;
	}
	
	//echo activity(172,2);die;
	
	$installerStatus = array("1"=>"New","2"=>"Approved","3"=>"Rejected","4"=>"inactive");
	
	function generateReport($report_Arr){
		$str = http_build_query($report_Arr);
		$strenc = urlencode($str);
		
		//echo "<pre>"; print_r($report_Arr);echo "</pre>";
		
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		//$pdf->SetFont ('Arial', '', '10px' , '', 'default', true );
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
			require_once(dirname(__FILE__).'/lang/eng.php');
			$pdf->setLanguageArray($l);
		}
		$pdf->setFontSubsetting(true);
		$pdf->AddPage();
		//$img_file = K_PATH_IMAGES.'logoweb.png';
		//$pdf->Image($img_file, 120, 85, 50, 50, '', '', '', true, 72);
		$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
		$postdata = http_build_query($report_Arr);
			$opts = array('http' =>
				array(
					'method'  => 'POST',
					'header'  => 'Content-type: application/x-www-form-urlencoded',
					'content' => $postdata
				)
			);
		$context  = stream_context_create($opts);
		$html2=file_get_contents(SITE_PATH."inc/report-html.php", false, $context);
		//echo $html2;die;
		$pdf->writeHTMLCell(0, 0, '', '0', $html2, 0, 1, 0, true, '', true);
		$report_filename = $report_Arr["project_customer"].'-'.$report_Arr["project_num"].'-Föranmälan info'.time();
		$generate= $pdf->Output(SITE_FS_PATH.'/uploaded_files/reports/'.$report_filename.'.pdf', 'F');
		return $report_filename.".pdf";
		//$pdf->Output($report_Arr["cust_name"].'-'.$report_Arr["proj_name"].'-Föranmälan'.'.pdf', 'D');
	}
	
	function get_vendor_list($cid = 0) {
		global $cms;
		//$html = '<ul>';
		$cqr="SELECT * FROM #_vendor WHERE is_deleted=0 ";
		$query1 = $cms->db_query($cqr);
		while($row = $query1->fetch_array()) {
			$current_id = $row['id']; 
			if($cid==$current_id)
				$sel='selected';
			else
				$sel='';                  
				$html .= '<option value="'.$row['id'].'" '.$sel.'>' .$row['company_name'].'</option>';
			//$html .= '</li>';
		}
		//$html .= '</ul>';
		return $html;
    }
	
	$proposalStatus = array("1"=>"Project Created","2"=>"Föranmälan Sent","3"=>"Föranmälan Approved","4"=>"Panel Installation Completed","5"=>"Electric Installation Completed","6"=>"Commissioned","7"=>"Handed over to customer");
	$vendorWorkType = array("1"=>"Panel Installation","2"=>"Electrician","3"=>"Other");
?>
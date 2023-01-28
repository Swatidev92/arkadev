<?php 
	error_reporting(~E_NOTICE);
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
	
	require_once(SITE_FS_PATH."/lib/config.inc.php");
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
	
	$roleArr = array("0"=>"User", "1"=>"Super Admin", "2"=>"Admin", "3"=>"Agent" );
	$leadFormType = array('1'=>'Calculator', '2'=>'Free Quote', '3'=>'Contact Form', '4'=>'Manual Lead');
	$leadSourceArr = array("0"=>'Manual', "1"=>'Website');
	//$leadsStatusArr = array("0"=>"New",  "5"=>"Quotation Created, Reply Awaited", "1"=>"Quote Approved", "2"=>"On-going", "3"=>"Completed", "4"=>"Rejected", "6"=>"Others", "7"=>"Scheduled");
	$leadsStatusArr = array("1"=>"New", "2"=>"Assigned", "3"=>"Project completed", "4"=>"Contract signed", "5"=>"Rejected", "6"=>"Offer sent", "7"=>"Reviewed", "8"=>"Dimensioning completed");
	
	$customerTypeArr = array("1"=>"Factory","2"=>"Hotel","3"=>"Hospital","4"=>"Home","5"=>"Shopping Mall","6"=>"Govt Department","7"=>"Commercial & Residential","8"=>"Others");
	
	$proosalCustomerTypeArr = array("1"=>"Privat","2"=>"Commercial");
	$workStartArr = array("1"=>"ASAP","2"=>"3 month","3"=>"6 month","4"=>"1 year");
	
	$proposalType = array("1"=>"Solar panel only","2"=>"Solar panel + EV charger","3"=>"Solar panel + EV charger + Battery", "4"=>"Solar panel + Battery", "5"=>"EV Charger only", "6"=>"Battery only", "7"=>"Battery + EV charger", "8"=>"Campaign (Solar + EV charger + Battery)", "9"=>"Campaign (Solar + EV charger)", "10"=>"Campaign (Solar + Battery)");
		
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
	
//echo $m1 = sendEmailNew('techbluetesting@gmail.com', 'hi', 'Thank');

	
	//define("PASSWORD_PATTERN","(?=^.{6,50}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$");
	define("PASSWORD_PATTERN","");
	define("PASSWORD_MSG","Password must contain atleast 6 characters");	
	
	function passwordGenrate($length = 8) {
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
		return floor($price/$annual_savings).' years';
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
?>
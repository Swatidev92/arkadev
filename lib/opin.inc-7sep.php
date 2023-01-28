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
	require_once(SITE_FS_PATH."/lib/PHPMailerAutoload.php");
	require_once(SITE_FS_PATH."/lib/ckeditor/ckeditor.php");
	//require_once(SITE_FS_PATH."/inc/email-format.php");
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
	
	
	$leadFormType = array('1'=>'Calculator', '2'=>'Free Quote', '3'=>'Contact Form');
	$leadSourceArr = array("0"=>'Manual', "1"=>'Website');
	$leadsStatusArr = array("0"=>"New",  "5"=>"Quotation Created, Reply Awaited", "1"=>"Quote Approved", "2"=>"In Process", "3"=>"Completed", "4"=>"Rejected", "6"=>"Others", "7"=>"Scheduled");
	
	$customerTypeArr = array("1"=>"Factory","2"=>"Hotel","3"=>"Hospital","4"=>"Home","5"=>"Shopping Mall","6"=>"Govt Department","7"=>"Commercial & Residential","8"=>"Others");
		
	define('EMAIL_HOST',$settingArr['smtp_host']);
	define('EMAIL_USER',$settingArr['smtp_user']);
	define('EMAIL_PASSWORD',$settingArr['smtp_password']);
	define("FROM_EMAIL",$settingArr['from_email']);
	
	//mail to user
	function sendEmail($toEmailId=null, $subject=null, $mailBody=null, $attechment=null)
	{
		//echo $attechment;
		//echo $mailBody;die;
		//return emailFormat($mailBody);
		$mail = new PHPMailer();
		$mail->IsSMTP();     // set mailer to use SMTP
		$mail->Host = EMAIL_HOST;  // specify main and backup server
		$mail->SMTPAuth = true;     // turn on SMTP authentication
		$mail->port = 465;
		$mail->Username = EMAIL_USER;  // SMTP username
		$mail->Password = EMAIL_PASSWORD; // SMTP password
		$mail->From = FROM_EMAIL;
		//$mail->SMTPDebug = 2;
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
//echo $m1 = sendEmail('sneha.techblue@gmail.com', 'hi', 'Thank');

	
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
		return (round(($area/2.2)*(390/1000)));
	}
	function getCapacity($area,$pvar){
		// Area/2.2*(Panel type Watts)/1000
		return (round(($area/2.2)*($pvar/1000)));
	}
	function numberOfPanels($area){
		//  x/2.2
		return (ceil($area/2.2));
	}
	function getAnnualSavings($capacity){
		// s= Rs. Capacity*980*1.2
		return (round($capacity*980*1.2));
	}
	function upfrontCost($panels, $panel_cost, $mms_cost, $installation_cost, $Inverter_cost){
		// a= ((Panels*Panel cost)+MMS+Installation+Inverter)*1.25*1.2
		return round((($panels*$panel_cost)+$mms_cost+$installation_cost+$Inverter_cost)*1.25*1.2);
	}
	function greenSubsidy($upfrontCost){
		//b = Rs $upfrontCost*14.5/100
		return round(($upfrontCost*14.45/100));
	}
	function getPaybackTime($price, $annual_savings){
		// Price/Annual Savings
		return ceil($price/$annual_savings).' years';
	}
	function yearlyEnergyProduction($capacity){
		// Capacity*980
		return round($capacity*980);
	}
	function getPrice($upfrontCost){
		// Upfront*0,855
		return round($upfrontCost*0.855);
	}
	
	
?>
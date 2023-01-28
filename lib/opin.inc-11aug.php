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
	//require_once(SITE_FS_PATH."/lib/ckeditor/ckeditor.php");
	//require_once(SITE_FS_PATH."/inc/email-format.php");
	//$adm = new ADMIN_DAL(); //Class Start 
	//define('SCRIPT_START_TIME', $cms->getmicrotime());
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
		
		
	define('EMAIL_HOST',"sxb1plzcpnl473189.prod.sxb1.secureserver.net");
	define('EMAIL_USER',"no-replay@arkaenergy.se");
	define('EMAIL_PASSWORD',"7#ud1Z3l}N_J");
	define("FROM_EMAIL","no-replay@arkaenergy.se");
	
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
		$validImage  = array("jpg","jpeg","gif",'png','svg');
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
						$imageName 	= $imageName1.'.'.$end;
					}
					else{
						$imageName 	= $basename.'.'.$end;
					}
					$imageLoc 	= $_FILES[$image]['tmp_name'];
					$imageSize	= $_FILES[$image]['size'];
					$imageType 	= $_FILES[$image]['type'];
					$filePath =  IMAGE_PATH.$folder.'/'.$imageName;
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
	
	
	function amount_format($amount){
		$formated_amt = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $amount);
		return $formated_amt.' kr';
	}
	function value_format($amount){
		$value_format = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $amount);
		return $value_format.' kWh';
	}
	function getSize($area){
		// x/2.2*390/1000 kw
		return (round(($area/2.2)*(390/1000)));
	}
	function numberOfPanels($area){
		//  x/2.2
		return (round($area/2.2));
	}
	function getAnnualSavings($area,$panel_val,$pvar){
		// s= Rs. x/2.2*390/1000*950*1.2
		return (round(($area/2.2*$panel_val/1000*$pvar*1.2)));
	}
	function upfrontCost($area, $panel_val, $upVar){
		// a= x/2.2*390/1000*11300
		return round($area/2.2*$panel_val/1000*$upVar);
	}
	function greenSubsidy($upfrontCost){
		//b = Rs $upfrontCost*14.5/100
		return round(($upfrontCost*14.5/100));
	}
	function getPaybackTime($upfrontCost, $greenSubsidy, $annual_savings){
		// (a-b)/s
		return round(($upfrontCost-$greenSubsidy)/$annual_savings).' Years';
	}
	function yearlyEnergyProduction($area,$panel_val,$pvar){
		// x/2.2*390/1000*950
		return round($area/2.2*$panel_val/1000*$pvar);
	}
?>
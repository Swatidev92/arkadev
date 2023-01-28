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
		
	define('EMAIL_HOST',"");
	define('EMAIL_USER',"");
	define('EMAIL_PASSWORD',"");
	define("FROM_EMAIL","");
	
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
		$mail->FromName = "Secure Shield"; 
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
		return 'Rs.'.$formated_amt;
	}
	function getAnnualSavings($bill_amt,$b_value){
		//Rs. (x/8)*0.75*6*12
		return (round(($bill_amt/8)*0.75*6*12));
	}
	function getCapacity($bill_amt){
		//x/8*0.75/110000*1000 Kw
		$megawatts = (($bill_amt/8)*(.75/110000)*(1000));
		/*if($kilowatts>=1000){
			$megawatts = $kilowatts/1000;
			return round($megawatts).' MW';
		}else{
			return round($kilowatts).' KW';
		}*/
			return round($megawatts).' KW';
	}
	function getTotalCost($bill_amt){
		//Rs. (x/8)*(.75/110000)*37500000)
		return (round(($bill_amt/8)*(.75/110000)*(37500000)));
	}
	function getTaxBenefit($bill_amt){
		//Rs. (x/8)*(.75/110000)*37500000)*(.17)
		return (round(($bill_amt/8)*(.75/110000)*(37500000*.17)));
	}
	function getNetCost($totcost, $taxBenefit){
		$netCost = ($totcost-$taxBenefit);
		return (round($netCost));
	}
	function getPaybackTime($bill_amt, $net_cost, $b_value){
		//(a-b)/( (x/8)*0.75*6*12)
		return round($net_cost/(($bill_amt/8)*0.75*$b_value*12)).' Years';
	}
	function yearlyEnergyProduction($bill_amt){
		// x/8*0.75/110000*1600000
		return round($bill_amt/8*0.75/110000*1600000).' kWh';
	}
	function emmissionSaving($bill_amt){
		return round(1500*($bill_amt/8)*(.75/110000)*(1000)).' KG';
		
	}
?>
<?php 
session_start();
//error_reporting(0);
//print_r($_POST);die;
$match=0;
if($_POST){
	if(isset($_POST["captcha"]) && $_POST["captcha"]!="" && $_SESSION["code"]==$_POST["captcha"]){
		if($_POST["first_name"]!='' && $_POST["email"]!='' && $_POST["phone"]!=''){
			
			$black_char=array("@","#","$","%","^","*","'",">","<","<a","href","http","https","www","/",":",".");
			foreach ($black_char as $url) {
				//if (strstr($string, $url)) { // mine version
				if (strstr($_POST["first_name"], $url) !== FALSE) { 
					$match=1;
				}if (strstr($_POST["phone"], $url) !== FALSE) { 
					$match=1;
				}if (strstr($_POST["phone"], $url) !== FALSE) { 
					$match=1;
				}if (strstr($_POST["ort"], $url) !== FALSE) { 
					$match=1;
				}if (strstr($_POST["address"], $url) !== FALSE) { 
					$match=1;
				}if (strstr($_POST["postal_code"], $url) !== FALSE) { 
					$match=1;
				}if (strstr($_POST["selPurpose"], $url) !== FALSE) { 
					$match=1;
				}if (strstr($_POST["link_source"], $url) !== FALSE) { 
					$match=1;
				}if (strstr($_POST["message"], $url) !== FALSE) { 
					$match=1;
				}
				
			}
			if($match==1){
				echo 0;
			}else{
				if($_POST['purpose']){
					$selPurpose = implode(',',$_POST['purpose']);
				}
				
				$_POST["post_date"]=date("Y-m-d");
				$_POST["customer_name"]=$_POST["first_name"].($_POST["last_name"]?' '.$_POST["last_name"]:'');
				$_POST["address_input"]=$_POST["address"];
				$_POST["proposal_address"]=$_POST["address"];
				$_POST['form_type'] = 3;
				$_POST['status'] = 1;
				$_POST['source'] = 1;
				$_POST['purpose'] = $selPurpose;
				$enquiry_id = $cms->sqlquery("rs","leads",$_POST);
				
				if($enquiry_id){
					//user mail
					
					if($countryConst=='SE'){				
						$subject='Thank you '.$_POST["first_name"].($_POST["last_name"]?' '.$_POST["last_name"]:'').' för att komma i kontakt!';
						$msg='<p>Hej '.$_POST["first_name"].($_POST["last_name"]?' '.$_POST["last_name"]:'').',<br>Thank you för att komma i kontakt!<br>Vi har fått ditt meddelande och vill tacka dig för att du skrev till oss. Vi återkommer snart.<br>vänliga hälsningar,<br>Arka Team</p>';
					}else{
						$subject='Thank you '.$_POST["first_name"].($_POST["last_name"]?' '.$_POST["last_name"]:'').' for getting in touch!';
						$msg='<p>Hi '.$_POST["first_name"].($_POST["last_name"]?' '.$_POST["last_name"]:'').',<br>Thank you for getting in touch!<br>We have received your message and would like to thank you for writing to us. We will get back to you soon.<br>Regards,<br>Arka Team</p>';
					}
					$email_msg= emailFormat($msg);
					$m1 = sendEmail($_POST["email"],$subject,$email_msg);
				
					
					//mail to admin
					$subjectAdmin= 'You have a new enquiry';
					
					$msgAdmin = '<p>Dear Admin,
					<br>You have a new enquiry. Please find all details below.</p>
					<table>';
					$msgAdmin .= '<tr><td>Name: </td><td>' . $_POST["first_name"] .($_POST["last_name"]?' '.$_POST["last_name"]:''). '</td></tr>';
					$msgAdmin .= '<tr><td>Email: </td><td>' . $_POST["email"] . '</td></tr>';
					$msgAdmin .= '<tr><td>Mobile: </td><td>' . $_POST["phone"] . '</td></tr>';
					$msgAdmin .= '<tr><td>Ort: </td><td>' . $_POST["ort"] . '</td></tr>';
					
					if($_POST["address"]){
					$msgAdmin .= '<tr><td>Address: </td><td>' . $_POST["address"] . '</td></tr>';
					}
					$msgAdmin .= '<tr><td>Postal Code: </td><td>' . $_POST["postal_code"] . '</td></tr>';
					
					if($_POST['purpose']){
					$msgAdmin .= '<tr><td>Purpose: </td><td>' . $selPurpose . '</td></tr>';
					}
					if($_POST['link_source']){
					$msgAdmin .= '<tr><td>Source: </td><td>' . $link_source . '</td></tr>';
					}
					$msgAdmin .= '<tr><td>Message: </td><td>' . $_POST["message"] . '</td></tr>';
					$msgAdmin .= '</table>';
					
					$admin_msg= emailFormat($msgAdmin);
					//echo $msgAdmin;die;
					$admin_email= $settingArr['from_email'];
					//$admin_email= 'sneharises@gmail.com';
					$m2 = sendEmail($admin_email,$subjectAdmin,$admin_msg);
				}
				if($m1 && $m2){
				//if(1){
					echo 1;
				}else{
					echo 0;
				}
			}
		} // name , email ,phone not blank	
	}else{
		echo -1;
	}		
}
die;
?>
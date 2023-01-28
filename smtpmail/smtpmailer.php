<?php 
//echo 1;die;
include("PHPMailerAutoload.php");
$to="sneha@bluedigital.co.in";
$subject="Mailer";
$msg='<p>Thank you for getting in touch!<br>We have received your message and would like to thank you for writing to us. We will get back to you soon.<br>Regards,<br>Arka Team</p>';
$msg=file_get_contents("http://arkaenergy.se/inc/email-format.php");
//$msg='HI123456789arka';
	$mail = new PHPMailer();
	//print_r($mail);die;
	$mail->IsSMTP();   
	$mail->Mailer = "mail";	// set mailer to use SMTP
	$mail->Host ="mail.arkaenergy.se";  // specify main and backup server
	$mail->SMTPAuth = true;     // turn on SMTP authentication
	$mail->Username ="no-reply@arkaenergy.se";  // SMTP username
	$mail->Password ="Nh,c$Cckxi87"; // SMTP password
	$mail->From = "no-reply@arkaenergy.se";
	$mail->FromName = "ARKA ENERGY";
	  $mail->SMTPSecure = 'ssl';
	  $mail->SMTPDebug = 2;
	  $mail->Port = 465;
	if($to){
	$adminemails=explode(",",$to);
	foreach($adminemails as $to1)
	$mail->AddAddress($to1, "");
	//$mail->AddAttachment($uploaded_path);    // optional name
	$mail->IsHTML(true);                                  // set email format to HTML
	$mail->Subject = $subject;
	$mail->Body    = $msg;  
	}	
	if($mail->Send()){
		echo "Success";
	}else{
		echo "Fail<pre/>";
		print_r($mail);die;
	}
	
?>
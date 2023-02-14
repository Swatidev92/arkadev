<?php
error_reporting(0);
include 'db.php';
include_once("../smtpmail/PHPMailerAutoload.php");

#ini_set("SMTP","smtp.gmail.com");
#ini_set("smtp_port","465");
#ini_set("username","noreply@arkaenergy.se");
#ini_set("password","Arka@2023x9");


$response=array();

$email=$_GET['email'];
$query_get_user="SELECT * FROM `ae_vendor` WHERE `email`='$email'";
$run_query_get_user=mysqli_query($connect,$query_get_user);
$total_result=mysqli_num_rows($run_query_get_user);
if($total_result > 0)
{
	$password='';
	$client_name='';
	while($row=mysqli_fetch_array($run_query_get_user))
	{
		$password=$row['password'];
		$client_name=$row['company_name'];
	}
$mail = new PHPMailer();
try {
    $mail->IsSMTP(); // enable SMTP
	$mail->SMTPAuth = true; // authentication enabled
	$mail->SMTPSecure = 'ssl'; //Set the SMTP port number - likely to be 25, 465 or 587
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 465; //Set the encryption system to use - ssl (deprecated) or tls
	$mail->Username = "noreply@arkaenergy.se";
	$mail->Password = "Arka@2023x9";
	$mail->setFrom('noreply@arkaenergy.se', 'First Last');
	$mail->addAddress($email, $client_name);
	$mail->Subject = "PHPMailer GMail SMTP test";
	$mail->msgHTML("Dear ".$client_name.",<br> We have successfully sent you your existing password. Your existing password is <strong>".$password."</strong>.<br> Thank you for choosing Arka Energy. ");
	$mail->IsHTML(true);
	$mail->SMTPOptions = array(
		'ssl' => array(
		'verify_peer' => false,
		'verify_peer_name' => false,
		'allow_self_signed' => true
		)
	);
			
	if(!$mail->Send()) {
		
		//echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
		$response["status"]="Success";
		//echo "Message has been sent";
	}
} catch (Exception $e) {
   // echo 'Message could not be sent. Mailer Error: '. $mail->ErrorInfo;
}

    
}
else
{
    $response["status"]="Failure";
}
echo json_encode($response);

?>
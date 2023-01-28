<?php


//	$email='info@arkaenergy.se';
$email='techbluetesting@gmail.com';
	if($countryConst=='SE'){
		$subject='Arka - Tack för att du fyller i formuläret!';	
		$msg='Hi <br>Tack för att du visade ditt intresse för Arka. <br> En av våra experter kommer att kontakta dig inom kort för att diskutera nästa steg.<br>Regards,<br>Arka Team';
	
	}else{
		$subject='Arka - Thank you for filling out the form!';
		$msg='Hi <br>Thank you for showing your interest in Arka.<br>One of our experts will contact you shortly to discuss the next step.<br>Regards,<br>Arka Team';
	}

	$email_msg= emailFormat($msg);
		
	$m1 = sendEmail($email,$subject,$email_msg);
	
	?>
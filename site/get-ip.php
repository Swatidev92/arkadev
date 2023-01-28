<?php
	$remote_IP_url = 'http://ip-api.com/json/' . $_SERVER['REMOTE_ADDR'];
	$remote_user_data = json_decode(file_get_contents($remote_IP_url));
	print_r($remote_user_data);
	if ($remote_user_data->status == 'success' ) {
		$user_country = $remote_user_data->countryCode;
		if($user_country!='IN'){
			define("CURRENCY","USD");
			define("CUR_SYMBOL","$");
			define("BOOK_SESSION_PRICE",$settingArr['per_book_price_usd']);
		}else{
			define("CURRENCY","INR");
			define("CUR_SYMBOL","Rs.");
			define("BOOK_SESSION_PRICE",$settingArr['per_book_price_inr']);
		}
	}
	else {
		define("CURRENCY","INR");		
		define("CUR_SYMBOL","Rs.");
		define("BOOK_SESSION_PRICE",$settingArr['per_book_price_inr']);
	}
	
	?>
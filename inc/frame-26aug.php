<?php 
	$checkfrem = 0;
 	//putenv("TZ=Asia/Calcutta");	
	
	//echo $items[1];die;
	
	$langf='';
	$countryConst='';
	$urlConst='';
	$menustyle='';
	
	if($resultCountry['country']!="SE"){
		$urlConst= 'se/';
		$conLangSelEN='';
		$conLangSelSE='se';
	}
	if($resultCountry['country']=="SE"){
		$urlConst= 'en/';
		$conLangSelEN='en';
		$conLangSelSE='';
	}
	if($items[0]=='en' && $resultCountry['country']=="SE"){
		$urlConst= 'en/';
	}
	
	if($items[0]=='' && $resultCountry['country']=="SE"){
		$langf='_sw';
		$countryConst = 'SE';
		$pageQry = $cms->db_query("Select * from #_menu where status=1 AND menu_url_sw='".$items[1]."' ");
		$pageRes = $pageQry->fetch_array();
		//$page = $pageRes['file_name'];
		if(count($items) >= 1){		
			$page = $pageRes['file_name'].".php";  
		} 
		if($items[1]!="" && file_exists("site/".$page)){
			$loadpage=$page;
		}else if($items[1]!="" && !file_exists("site/".$page)){
			$loadpage="404.php";
		}else{		
			$loadpage="index.php"; 
		}
		$loadpage="site/".$loadpage;
		$lang='<img src="'.SITE_PATH.'assets/images/flag/sweden.png">';
		$footer_lang='Swedish';
		
		$menustyle = 'padding: 25px 60px';
		include_once('lables_se.php');
		
	}else if($items[0]=='en' && $resultCountry['country']=="SE"){
		$pageQry = $cms->db_query("Select * from #_menu where status=1 AND menu_url='".$items[0]."' ");
		$pageRes = $pageQry->fetch_array();
		$page = $pageRes['file_name'];
		if(count($items) >= 1){		
			$page = $pageRes['file_name'].".php";  
		} 
		if($items[1]!="" && file_exists("site/".$page)){
			$loadpage=$page;
		}else if($items[1]!="" && !file_exists("site/".$page)){
			$loadpage="404.php";
		}else{		
			$loadpage="index.php"; 
		}
		$loadpage="site/".$loadpage;
		$lang='<img src="'.SITE_PATH.'assets/images/flag/english.png">';
		$footer_lang='English';
		$urlConst='';
		include_once('lables_en.php');		
	}
	else if($items[0]=='se' && $resultCountry['country']!="SE"){
		$langf='_sw';
		$countryConst = 'SE';
		$pageQry = $cms->db_query("Select * from #_menu where status=1 AND menu_url_sw='".$items[1]."' ");
		$pageRes = $pageQry->fetch_array();
		//$page = $pageRes['file_name'];
		if(count($items) >= 1){		
			$page = $pageRes['file_name'].".php";  
		} 
		if($items[1]!="" && file_exists("site/".$page)){
			$loadpage=$page;
		}else if($items[1]!="" && !file_exists("site/".$page)){
			$loadpage="404.php";
		}else{		
			$loadpage="index.php"; 
		}
		$loadpage="site/".$loadpage;
		$lang='<img src="'.SITE_PATH.'assets/images/flag/sweden.png">';
		$footer_lang='Swedish';
		
		$menustyle = 'padding: 25px 60px';
		include_once('lables_se.php');	
	}else{	 		
		$pageQry = $cms->db_query("Select * from #_menu where status=1 AND menu_url='".$items[0]."' ");
		$pageRes = $pageQry->fetch_array();
		$page = $pageRes['file_name'];
		if(count($items) >= 1){		
			$page = $items[0].".php";  
		} 
		if($items[0]!="" && file_exists("site/".$page)){
			$loadpage=$page;
		}else if($items[0]!="" && !file_exists("site/".$page)){
			$loadpage="404.php";
		}else{		
			$loadpage="index.php"; 
		}
		$loadpage="site/".$loadpage;
		$lang='<img src="'.SITE_PATH.'assets/images/flag/english.png">';
		$footer_lang='English';
		$urlConst='';
		include_once('lables_en.php');
	}
	//echo $loadpage;
	ob_start(); 
?>
 
 
	<?php include_once 'header.php'; ?> 
	<?php include_once $loadpage; ?>  
	<?php include_once 'footer.php'; ?>
 
<?php
	// this script to parse all content and parse to replace keys 
	$templateContent = ob_get_contents();
	ob_end_clean(); 
	
	$templateContent = str_replace("%%title%%",$metaTitle,$templateContent); 
	$templateContent = str_replace("%%pagetitle%%",$metaTitle . " - ",$templateContent); 
	$templateContent = str_replace("%%description%%",$metaIntro,$templateContent);
	$templateContent = str_replace("%%keywords%%",$metaKeyword,$templateContent);
	$templateContent = str_replace("%%property%%",$metaProperty,$templateContent);
	
	echo $templateContent;
?>

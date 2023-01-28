<?php 
	$checkfrem = 0;
 	//putenv("TZ=Asia/Calcutta");	
	
	//echo $items[1];die;
	if($items[0]=='se'){ 
		if(count($items) >= 1){		
			$page = $items[1].".php";  
		} 
		if($items[1]!="" && file_exists("site/se/".$page)){
			$loadpage=$page;
		}else if($items[1]!="" && !file_exists("site/se/".$page)){
			$loadpage="404.php";
		}else{		
			$loadpage="index.php"; 
		}
		$loadpage="site/se/".$loadpage;
		$header = 'header-se.php';
		$footer = 'footer-se.php';
		$lang='<img src="'.SITE_PATH.'assets/images/flag/sweden.png">';
		$footer_lang='Swedish';
		
	}else{	 
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
		$header ='header.php';
		$footer = 'footer.php';
		$lang='<img src="'.SITE_PATH.'assets/images/flag/english.png">';
		$footer_lang='English';
	}
	//echo $loadpage;
	ob_start(); 
?>
 
 
	<?php include_once $header; ?> 
	<?php include_once $loadpage; ?>  
	<?php include_once $footer; ?>
 
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

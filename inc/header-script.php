<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<?php if(!empty($items[0])){?>
		<title>%%title%%</title>
		<meta name="keywords" content="%%keywords%%" /> 
		<meta name="description" content="%%description%%" />
		<?php }else{
			$homeQry = $cms->db_query("SELECT meta_title, meta_title_sw, meta_description, meta_description_sw, meta_key, meta_key_sw FROM #_home ");
			$homeRes = $homeQry->fetch_array();
		?>		
		<title><?=$homeRes['meta_title'.$langf]?></title>
		<meta name="description" content="<?=$homeRes['meta_description'.$langf]?>" />
		<meta name="keywords" content="<?=$homeRes['meta_key'.$langf]?>" />
		<?php } ?>
<meta name="author" content="" />
<meta name="MobileOptimized" content="320" />
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
<!--start theme style -->
<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>assets/css/animate.css">
<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>assets/css/materialize.min.css?<?php echo time(); ?>">
<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>assets/css/meanmenu.css" />
<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>assets/css/slicknav.min.css" />
<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>assets/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>assets/css/owl.carousel.css">
<!--<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>assets/css/magnific-popup.css">
<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>assets/venobox/css/venobox.css" />-->
<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>assets/css/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>assets/css/flaticon.css">
<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>assets/css/fonts.css" />
<!--<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>assets/css/camera.css">-->
<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>assets/css/style_2.css?<?php echo time(); ?>" />
<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>assets/css/responsive_2.css?<?php echo time(); ?>" />
<!--<link href="<?=SITE_PATH_ADM?>css/custom-select.css" rel="stylesheet" type="text/css" />-->
<!-- favicon link-->
<link rel="shortcut icon" type="image/icon" href="<?=SITE_PATH?>assets/images/favicon.png" />
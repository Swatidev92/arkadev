<?php
//error_reporting(3);
session_start(); 
include('funcs_lib.inc.php');
include('adminfunction.inc.php');
 	if(!defined('LOCAL_MODE')) {
		die('<span style="font-family: tahoma, arial; font-size: 11px">config file cannot be included directly');
	}
 	if(LOCAL_MODE) {
		$ARR_CFGS["db_host"] = 'localhost';
		$ARR_CFGS["db_name"] = 'arkaenergy_arkadb'; 
    	$ARR_CFGS["db_user"] = 'root';
		$ARR_CFGS["db_pass"] = '';
		define('SITE_SUB_PATH', '/arkadev/');		
	} else { 
		$ARR_CFGS["db_host"] = 'localhost';
		$ARR_CFGS["db_name"] = 'arkaenergy_arkadb'; 
    	$ARR_CFGS["db_user"] = 'arkaenergy_akausr21';
		$ARR_CFGS["db_pass"] = 'S3wU8lmix*m[';
		define('SITE_SUB_PATH', '/');
	}  
	$tmp = dirname(__FILE__);
	$tmp = str_replace('\\' ,'/',$tmp); 
	$tmp = str_replace('/lib' ,'',$tmp);
	 
	define('tb_Prefix', 'ae_');
	define('ADMIN_DIR', 'crm/');  
	define('SITE_PATH', 'http://'.$HTTP_HOST.SITE_SUB_PATH); 
	define('SITE_PATH_ADM', 'http://'.$HTTP_HOST.SITE_SUB_PATH.ADMIN_DIR); 
	define('USER_DIR', 'users/');  
	define('SITE_PATH_USR', 'http://'.$HTTP_HOST.SITE_SUB_PATH.USER_DIR); 
	 
 	define('THUMB_CACHE_DIR', 'thumb_cache');
	define('IMAGE_PATH', SITE_FS_PATH.'/img/'); 
	define('UP_FILES_FS_PATH', SITE_FS_PATH.'/images');
	define('FILES_PATH', SITE_FS_PATH.'/uploaded_files/');
	define('UP_FILES_FS_PATHPC', SITE_FS_PATH.'/uploads');
	
	define('CRM_FILES_PATH', SITE_FS_PATH.'/uploaded_files/');
	define('UPLOAD_FILES_PTH', 'uploaded_files');
	
	define('UP_FILES_UPLOADS', '938465uploads271');
	define('UP_FILES_PROPOSAL', '938465proposal271');
	define('UP_FILES_MEDIA', '938465media271');
	define('UP_FILES_REPORTS', '938465reports271');
	define('UP_FILES_GRID_PROVIDERS', '938465grid-provider271');
	define('UP_FILES_Egenkontroll', '938465egenkontroll271');
	
	ini_set('session.gc_maxlifetime', 3600);
	 
 	define('SITE_NAME', ''); 	
	define('CUR', '&#x20AC;');
	 
	date_default_timezone_set('Europe/Stockholm'); 
	
	define('DEF_PAGE_SIZE', 20);
	define('FRO_PAGE_SIZE', 20);
	define('MAX_CATEGORY_SELECT', 2);
	define('MAX_HOME_PROPERTY', 8);
	define('SELLER_FILE_DIR', 'files/');
	$adminToolBar = array();
	 //Class Start
	$cms = new DAL($ARR_CFGS["db_host"],$ARR_CFGS["db_user"],$ARR_CFGS["db_pass"],$ARR_CFGS["db_name"]); 
 
?>

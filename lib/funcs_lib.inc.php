<?php
class DAL {  
	private $var;
	public $mysqli;
	public $data;
	public function __construct($host,$username,$password,$db_name){
		$this->mysqli = new mysqli($host, $username, $password, $db_name);
		if($this->mysqli->connect_error) {
 			echo "Error: Could not connect to database.";
			exit;
		} 
				
	}
	public function __destruct(){
      $this->mysqli->close();	
    }
	function user_login($username,$password){				
		$user=$this->mysqli->real_escape_string($username);
		$pass=$this->mysqli->real_escape_string($password);
		$sql ="select `id`, `role`, `customer_name`, `email_id`, `contact_no`, `status` from ".tb_Prefix."users where email_id='$user' and password='$pass' AND status=1 AND is_deleted=0";  
		$res = $this->mysqli->query($sql) or die($this->mysqli->connect_error);
		$numRows = $res->num_rows;  
		if($numRows == 1){
			$arrCheck = $res->fetch_array();
			$_SESSION["ses_adm_id"] = $arrCheck["id"];
			$_SESSION["ses_adm_usr"] = $arrCheck["customer_name"];
			$_SESSION["ses_adm_role"] = $arrCheck["role"];
			$_SESSION["ses_adm_email"] = $arrCheck["email_id"];
			$_SESSION["ses_adm_status"] = $arrCheck["status"];
			//print_r($_SESSION);die;
			return true;
		}else{
			return false;
		}
	} 
	 
	public function is_post_back() {
		if(count($_POST)>0) {
			return true;
		} else {
			return false;
		}
	
	}
	public function escape_string($val){
		return $this->mysqli->real_escape_string($val);
	}
	public function db_query($sql) {
		$sql = str_replace("#_", tb_Prefix, $sql);
		/*$result	= $this->mysqli->query($sql) or	die($this->mysqli->error);
		return $result;*/
		if(!$result= $this->mysqli->query($sql)){
			$err=$this->mysqli->error;
			if(strpos($err,"foreign key constraint fails")){
				//echo "Cannot delete/update this record as it is linked with other data.";
				return -1; // means cannot delete or update records as linked to other data
			}
		}
		else
		return $result;
	}
	
	public function db_fetch_array($rs) {
		$array	= $rs->fetch_array();
		return $array;
	}
	public function db_scalar($sql) {
		$result	= $this->db_query($sql);
		if ($line =	$result->fetch_array()) {
			$response =	$line[0];
		}
		return $response;
	}
	public function getSingleresult($sql) {
		$result	=$this->db_query($sql);
		if($line =	$result->fetch_array()) {
			$response =	$line[0];
		}else{
			$response = $this->mysqli->error;
		}
		return $response;
	}
	public function isExistUrl($tblName=null, $fields=null, $value=null) {
		$sql = "SELECT COUNT(".$fields.") FROM #_".$tblName." WHERE ".$fields."='".$value."'";
		$result	=$this->db_query($sql);
		if($line =	$result->fetch_array()) {
			$response =	$line[0];
		}
		return $response;
	} 
	
	public function sqlquery($rs='exe',$tablename, $arr, $update='', $id='', $update2='', $id2='') {
	
		$sql = $this->db_query("DESC ".tb_Prefix."$tablename");
		$row = $sql->fetch_array();
		if($update == '')
			$makesql = "INSERT INTO ";
		else
			$makesql = "UPDATE " ;
			$makesql .= tb_Prefix."$tablename SET ";
		
		$i = 1;
		while($row = $sql->fetch_array()) {
			if(array_key_exists($row['Field'], $arr)) {
				if($i != 1)
					$makesql .= ", ";
					$makesql .= $row['Field']."='".addslashes((is_array($arr[$row['Field']]))?implode(":",$arr[$row['Field']]):$arr[$row['Field']])."'";
					$i++;
			}
		}
		
		if($update)
			$makesql .= " WHERE ".$update."='".$id."'".(($update2 && $id2)?" AND ".$update2."='".$id2."'":"");
		if($rs == 'show') {
			echo $makesql;
			exit;
		}
		else {
			//echo $makesql;
			$this->db_query($makesql);
			//echo "djfklsdn".$this->insert_id;die;
		}
		//echo $makesql;die;
		return ($update)?$id:$this->mysqli->insert_id;
	}
	 
	public function print_error() {
		$debug_backtrace = debug_backtrace();
		for ($i = 1; $i < count($debug_backtrace); $i++) {
			$error = $debug_backtrace[$i];
			echo "<br><div><span>File:</span> ".str_replace(SITE_FS_PATH, '',$error['file'])."<br><span>Line:</span> ".$error['line']."<br><span>Function:</span> ".$error['function']."<br></div>";
		}
	}
	
	public function mysql_time($hour, $minute,	$ampm) {
		if ($ampm == 'PM' && $hour != '12') {
			$hour += 12;
		}
		if ($ampm == 'AM' && $hour == '12') {
			$hour =	'00';
		}
		$mysql_time	= $hour	. ':' .	$minute	. ':00';
		return $mysql_time;
	}
	
	
	public function price_format($price) {
		if ($price != '' &&	$price != '0') {
			$price = number_format($price, 2);
			return CUR.$price;
		}
	}
	
	
	public function opin_date_format($date) {
		if (strlen($date) >= 10) {
			if ($date == '0000-00-00 00:00:00' || $date	== '0000-00-00') {
				return '';
			}
			$mktime	= mktime(0,	0, 0, substr($date,	5, 2), substr($date, 8,	2),	substr($date, 0, 4));
			return date("M j, Y", $mktime);
		} else {
			return $s;
		}
	}
	public function dateshow($time,$format='F j,Y'){
		return date($format,$time);
	}
	
	
	public function datetime_format($date) {
		global $arr_month_short;
		if (strlen($date) >= 10) {
			if ($date == '0000-00-00 00:00:00' || $date	== '0000-00-00') {
				return '';
			}
			$mktime	= mktime(substr($date, 11, 2), substr($date, 14, 2), substr($date, 17, 2),substr($date,	5, 2), substr($date, 8,	2),	substr($date, 0, 4));
			return date("M j, Y h:i A ", $mktime);
		} else {
			return $s;
		}
	}
	
	
	public function time_format($time) {
		if (strlen($time) >= 5) {
			$hour =	substr($time, 0, 2);
			$hour =	str_pad($hour, 2, "0", STR_PAD_LEFT);
	
			return $hour . ':' . substr($time, 3, 2) . ' ' . $ampm;
		} else {
			return $s;
		}
	}
	
	
	public function ms_print_r($var) {
		//if(LOCAL_MODE || $_SESSION['debug']){
		echo "<textarea rows='10' cols='148' style='font-size: 11px; font-family: tahoma'>";
		print_r($var);
		echo "</textarea>";
		//}
	}
	
	
	public function ms_form_value($var) {
		return is_array($var) ? array_map('ms_form_value', $var) : htmlspecialchars(stripslashes(trim($var)));
	}
	
	
	public function ms_display_value($var) {
		return is_array($var) ? array_map('ms_display_value', $var) : nl2br(htmlspecialchars(stripslashes(trim($var))));
	}
	
	public function ms_adds($var) {
		return trim(addslashes(stripslashes($var)));
	}
	
	
	public function ms_stripslashes($var) {
		return is_array($var) ? array_map('ms_stripslashes', $var) : stripslashes(trim($var));
	}
	
	
	public function ms_addslashes($var) {
		//return is_array($var) ? array_map('ms_addslashes', $var) : addslashes(stripslashes(trim($var)));
		//return addslashes(stripslashes(trim($var)));
	}
	
	
	public function ms_trim($var) {
		return is_array($var) ? array_map('ms_trim', $var) : trim($var);
	}
	
	public function is_image_valid($file_name) {
		global $ARR_VALID_IMG_EXTS;
		$ext = file_ext($file_name);
		if (in_array($ext, $ARR_VALID_IMG_EXTS)) {
			return true;
		} else {
			return false;
		}
	}
	
	
	public function getmicrotime() {
		list($usec,	$sec) =	explode(" ", microtime());
		return ((float)$usec + (float)$sec);
	}
	
	
	public function file_ext($file_name) {
		$path_parts = pathinfo($file_name);
		$ext = strtolower($path_parts["extension"]);
		return $ext;
	}
	
	
	public function blank_filter($var) {
		$var = trim($var);
		return ($var != '' && $var != '&nbsp;');
	}
	
	
	public function apply_filter($sql,	$field,	$field_filter, $column) {
		if (!empty($field)) {
			if ($field_filter == "=" || $field_filter == "") {
				$sql = $sql	. "	and	$column	= '$field' ";
			} else if ($field_filter == "like") {
				$sql = $sql	. "	and	$column	like '%$field%'	";
			} else if ($field_filter ==	"starts_with") {
				$sql = $sql	. "	and	$column	like '$field%' ";
			} else if ($field_filter ==	"ends_with") {
				$sql = $sql	. "	and	$column	like '%$field' ";
			} else if ($field_filter ==	"not_contains") {
				$sql = $sql	. "	and	$column	not	like '%$field%'	";
			} else if ($field_filter == ">") {
				$sql = $sql . " and $column > '$field' ";
			} else if ($field_filter == "<") {
				$sql = $sql . " and $column < '$field' ";
			} else if ($field_filter ==	"!=") {
				$sql = $sql	. "	and	$column	!= '$field'	";
			}
		}
		return $sql;
	}
	
	public function filter_dropdown($name	= 'filter',	$sel_value) {
		$arr = array( "like" => 'Contains', '=' => 'Is', "starts_with" => 'Starts with', "ends_with"	=> 'Ends with', "!=" => 'Is not' , "not_contains" => 'Not contains');
		return $this->array_dropdown($arr, $sel_value, $name);
	}
	
	
	   
	
	public function make_url($url) {
		$parsed_url	= parse_url($url);
		if ($parsed_url['scheme'] == '') {
			return 'http://' . $url;
		} else {
			return $url;
		}
	}
	
	public function url($url, $dir='') {
		return SITE_PATH.(($dir)?$dir."/":'').$url.".html";
	}
	public function folder($url) {
		//$bodytag = str_replace(" ", "-", strtolower($url));
		//$bodytag = str_replace(" ", "-", $url);
		return $url;
	}
	public function onclickurl($url, $dir='') {
		return "onClick=\"location.href='".SITE_PATH.(($dir)?$dir."/":'').$url.".html'\"";
	}
	
	public function url2($url, $dir='') {
		return SITE_PATH.(($dir)?$dir."/":'').$url;
	}
	public function ms_mail($to, $subject, $message, $arr_headers= array()) {
		$str_headers = '';
		foreach($arr_headers as $name=>$value) {
			$str_headers .= "$name: $value\n";
		}
		@mail($to, $subject, $message, $str_headers);
		return true;
	}
	
	// make_thumb_im
	public function make_thumb_im($file_path, $arr_options) {
		$width		= $arr_options['width'];
		$height		= $arr_options['height'];
		$prefix		= $arr_options['prefix'];
		$target_dir	= $arr_options['target_dir'];
		$quality	= $arr_options['quality'];
	
		$path_parts = pathinfo($file_path);
	
		if($width=='') {
			$width = '120';
		}
	
		if($prefix=='') {
			$prefix = 'thumb_';
		}
		if($target_dir=='') {
			$target_dir = $path_parts["dirname"];
		}
	
		if($quality=='') {
			$quality = '70';
		}
	
		$size = @getimagesize($file_path);
		if($size=='') {
			return false;
		}
		$path_parts = pathinfo($file_path);
	
		$thumb_path="$target_dir/".$prefix.$path_parts["basename"];
	
		$cmd ="convert -resize ".$width.'x'." -quality $quality \"$file_path\" \"$thumb_path\" ";
		system($cmd);
		//echo("<br>$cmd");
		return $prefix.$path_parts["basename"];
	}
	
	
	public function date_to_mysql($date) {
		list($month, $day, $year) = explode('/', $date);
		return "$year-$month-$day";
	}
	
	
	 
	// to check how much time is lapsed before first call of this public function
	public function checkpoint($from_start = false) {
		global $PREV_CHECKPOINT;
		if($PREV_CHECKPOINT=='') {
			$PREV_CHECKPOINT = SCRIPT_START_TIME;
		}
		$cur_microtime = $this->getmicrotime();
	
		if($from_start) {
			return $cur_microtime - SCRIPT_START_TIME;
		} else {
			$time_taken = $cur_microtime - $PREV_CHECKPOINT;
			$PREV_CHECKPOINT = $cur_microtime;
			return $time_taken;
		}
	}
	
	
	public function readable_col_name($str) {
		return ucwords( str_replace('_', ' ', strtolower($str) ) );
	}
	
	
	public function ms_echo($str) {
		if(LOCAL_MODE) {
			echo($str);
		}
	}
	
	public function get_qry_str($over_write_key = array(),	$over_write_value =	array()) {
		global $_GET;
		$m = $_GET;
		if (is_array($over_write_key)) {
			$i = 0;
			foreach($over_write_key	as $key) {
				$m[$key] = $over_write_value[$i];
				$i++;
			}
		} else {
			$m[$over_write_key]	= $over_write_value;
		}
		$qry_str = $this->qry_str($m);
		return $qry_str;
	}
	
	
	public function qry_str($arr, $skip = '') {
		$s = "?";
		$i = 0;
		foreach($arr as	$key =>	$value) {
			if ($key !=	$skip) {
				if (is_array($value)) {
					foreach($value as $value2) {
						if ($i == 0) {
							$s .= $key . '[]=' . $value2;
							$i = 1;
						} else {
							$s .= '&' .	$key . '[]=' . $value2;
						}
					}
				} else {
					if ($i == 0) {
						$s .= "$key=$value";
						$i = 1;
					} else {
						$s .= "&$key=$value";
					}
				}
			}
		}
		return $s;
	}
	
	
	
	public function request_to_hidden($arr_skip='') {
		foreach($_REQUEST as $name => $value) {
			$s .= '<input type="hidden" name="'.$name.'" value="'.htmlspecialchars(stripslashes($value)).'">'."\n";
		}
		return $s;
	}
	
	public function qry_str_to_hidden($str) {
		$fields='';
		if(substr($str,0,1)=='?') {
			$str = substr($str,1);
		}
		$arr = explode('&', $str);
		foreach($arr as $pair) {
			list($name, $value) = explode('=',$pair);
			if($name!='') {
				$fields.='<input type="hidden" name="'.$name.'" id="'.$name.'" value="'.$value.'" />';
			}
		}
		return $fields;
	}
	
	 
	
	public function redir($url,$inpage=0) {
		if($inpage==0) {
			header('location: '.$url) or die("Cannot Send to next page");
			exit;
		}
		else {
			echo '
			<script type="text/javascript">
			<!--
			window.location.href="'.$url.'";
			-->
			</SCRIPT>'
			;
			exit;
		}
	}
			
	 
	public function getextention($fname){
		$fext=explode(".",$fname);
		$ext=$fext[count($fext)-1];
		return $ext;
	}
	
	public  function checkpath($PATH){
		if(!is_dir($PATH)){
			mkdir($PATH,0777);
		}
	}
	
	public function uploadFile($PATH,$FILENAME,$FILEBOX){
		global $temp_file; 
		$this->checkpath($PATH);
		$PATH = $PATH.'/';
		$ext = strtolower($this->getextention($FILENAME));
		$FILENAME_= time()."_".mt_rand(1,1000);
		$temp_file = SITE_FS_PATH."/".THUMB_CACHE_DIR."/".$FILENAME_;
		if (isset($_FILES[$FILEBOX])){
			switch($_FILES[$FILEBOX]['type']){
				case "image/png":
					$file = $temp_file.".".$ext;
					$FILENAME = $FILENAME_.".jpg";
					move_uploaded_file($_FILES[$FILEBOX]['tmp_name'], $file);
					$imageObject = imagecreatefrompng($file);
					imagejpeg($imageObject,$PATH.$FILENAME);
					unlink($file);
					//imagedestroy($imageObject);
					break;
				case "image/gif":
					$file = $temp_file.".".$ext;
					$FILENAME = $FILENAME_.".jpg";
					move_uploaded_file($_FILES[$FILEBOX]['tmp_name'], $file);
					$imageObject = imagecreatefromgif($file);
					imagejpeg($imageObject,$PATH.$FILENAME);
					unlink($file);
					//imagedestroy($imageObject);
					break; 
				case "image/bmp":
					$file = $temp_file.".".$ext;
					$FILENAME = $FILENAME_.".jpeg";
					move_uploaded_file($_FILES[$FILEBOX]['tmp_name'], $file);
					$imageObject = imagecreatefromwbmp($file);
					imagejpeg($imageObject,$PATH.$FILENAME);
					unlink($file);
					//imagedestroy($imageObject);
					break; 
				default:
					$file = $PATH.$FILENAME_.".".$ext;
					$FILENAME = $FILENAME_.".".$ext;
					move_uploaded_file($_FILES[$FILEBOX]['tmp_name'], $file);	
			}
		}	
		return $FILENAME;
	}
	
	public function storeImage1($tmp_name, $filename, $path, $type, $typeid, $name='Main') {
		$filename = $this->getFilename($filename);
		$PATH = $path.'/';
		list($wi,$hi)=getimagesize($tmp_name);

		$this->db_query("insert into ".tb_Prefix."images set id='', name='$name', type='$type', type_id='$typeid', path= '$filename', status='Active'");
	}
	
	public function storeImage($tmp_name, $filename, $path, $type, $typeid, $name='Main') {
		$filename = $this->getFilename($filename);
		$PATH = $path.'/';
		list($wi,$hi)=getimagesize($tmp_name);
		$this->sqlquery("rs","pages",array($name=>$filename),'page_id',$typeid);
	}
	
	public function showimg($type,$id,$fol,$imgid='') {
		$nn = $fol;
		if($imgid)
			$wh = " and name='".$imgid."'";
		$img = $this->getSingleresult("select path from ".tb_Prefix."images where type='".$type."' and type_id='".$id."'".$wh);
		if($img != '' && file_exists($nn.'/'.$img)) {
			return $nn.'/'.$img;
		}
		else {
			return "images/noimgbig.gif";
		}
	}
	
	public function showmess(){
		if($_SESSION['sessmsg']){
			echo "<table width='100%'>";
			echo "<tr>";
			echo "<td class='error-item'><span>";
			echo $_SESSION['sessmsg'];
			echo "</span></td>";
			echo "</tr>";
			echo "</table>";
			$_SESSION['sessmsg'] = '';
			unset($_SESSION['sessmsg']);
		}
	}
	
	public function sessset($val){
		$_SESSION['sessmsg'] = $val;
	}
	
	public function alt($val){
		return 'alt="'.$val.'" title="'.$val.'"';
	}
	
	public function sendmail($to, $subject, $message, $fname='', $femail=''){
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: '.(($fname)?$fname:$this->getSingleresult("select company from #_setting where `id`='1'")).' <'.(($femail)?$femail:$this->getSingleresult("select email from #_setting where `id`='1'")).'>' . "\r\n";
		@mail($to, $subject, $message, $headers);
	}
	
	public function  sform($vals=''){
		return '<form method="post" enctype="multipart/form-data" name="aforms" id="aforms" data-toggle="validator" action=""  '.$vals.'>';
	}
	
	public function  eform(){
		return '</form>';
	}
	
	public function pageinfo($page){
		$pageInfo = array();
		$pageInfo['title'] = $this->get_static_content('meta_title',$page);
		$pageInfo['keyword'] = $this->get_static_content('meta_keyword',$page);
		$pageInfo['description'] = $this->get_static_content('meta_description',$page);
		$pageInfo['heading'] = $this->get_static_content('heading',$page);
		$pageInfo['body'] = $this->get_static_content('body',$page);
		$pageInfo['pimage'] = $this->get_static_content('pimage',$page);
		return $pageInfo;
	}

	public function get_static_content($key, $pname){
		return $rs = $this->db_scalar("select ".$key." from #_pages where url='$pname'");
	}
	
	public function cal($fld,$val="",$class='', $frmt='yyyy/mm/dd'){
	  return '<input type="text" value="'.(($val)?$val:'').'" class="'.$class.'" readonly name="'.$fld.'" onclick="displayCalendar(document.forms[0].'.$fld.',\''.$frmt.'\',this)"/><div id="debug"></div>';
		
	}
	public function ptr($key){
		$key1 = str_replace("<p>","", $key);
		$rs = str_replace("</p>","", $key1);
		$rs = str_replace("<span>","", $rs);
		$rs = str_replace("</span>","", $rs);
		return $rs;
	}
	
	public function access(){
		if(!$_SESSION[uid] and !$_SESSION[eid]){
			$this->redir($this->url("login"),true);	
		}
	}
	
	function getDiscountPercent($actprice, $disPricwe){
		if(!$actprice) return 0; 
		if(!$disPricwe) return 0;
		$diff  =  $actprice - $disPricwe;
		$per = ceil(($diff*100)/$actprice);
		return $per; 
	}
	
	 
	public function geturl(){
		$pageURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
		if ($_SERVER["SERVER_PORT"] != "80")
		{
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} 
		else 
		{
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		return $pageURL;
	}
	 
 
	public function removeSlash($str) {
		$badFriends = '/(\\\)/';
		$str = preg_replace($badFriends, '', $str);
		return $str;
	}
	
	function curPageURL() {
		$pageURL = 'http';
		if ($_SERVER["HTTPS"] == "on") {
			$pageURL .= "s";
		}
			$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		return $pageURL;
	}
	
	public function getSiteEmails($store_id = 0){
		if($store_id == 0){
			$qry = "select email from #_subscribe_list where status = 'Active'";
		}else{
			$qry = "select email from #_subscribe_list where status = 'Active' and store_id = '$store_id'";
		}
		$rsAdmin=$this->db_query($qry);
		while($arrAdmin=$this->db_fetch_array($rsAdmin)){
		extract($arrAdmin);
		$emails .= $email.", ";
		}
		$emails = substr($emails,0,-2);
		return $emails;
	}
	
	function file_get_contents_curl($url){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

		$data = curl_exec($ch);
		curl_close($ch);

		return $data;
	}
	
	function checkAccess($type,$memid,$userid){
		if($type!='user'){
			return true;
		}else{
			if($memid==$userid){			
				return true;
			} 
		}
		return false;
	}
	
	function checkCookie($cookie_id){ 
			if(!$cookie_id) return false;
		    $cookQry = $this->db_query("select * from #_cookie where pid = '$cookie_id' ");
			if($cookQry->num_rows){
				$c = $this->db_fetch_array($cookQry); 
				$base = $c[base];
				if(!$_COOKIE[$base]){
					return false;
				}
			}
			return true;
						 
	}
	 
	function encryptcode($string){
	 
		$key ='3647';

		$result = '';
		for($i=0; $i<strlen($string); $i++){
			$char = substr($string, $i, 1);
			$keychar = substr($key, ($i % strlen($key))-1, 1);
			$char = chr(ord($char)+ord($keychar));
			$result.=$char;
		}
		return base64_encode($result);
	}


	/*function to decrypt promotional code*/
	function decryptcode($string){
		$key ='3647';
		$result = '';
		$string = base64_decode($string);
		for($i=0; $i<strlen($string); $i++){
			$char = substr($string, $i, 1);
			$keychar = substr($key, ($i % strlen($key))-1, 1);
			$char = chr(ord($char)-ord($keychar));
			$result.=$char;
		}
		return $result;
	}
	
	function checkEmail($email){
		$check = preg_match('/^[a-z0-9_.+-]+@[a-z0-9-]+\.[a-z0-9-.]+$/', $email);
		if($check) return true;
		else return false;
	}
	public function getSuscriberEmails(){ 
		$rs=$this->db_query("select email from #_subscribe_list where status='Active'");
		if($rs->num_rows){
			  while($res=$this->db_fetch_array($rs)){
				$emails .= $res['email'].", ";
			  }
		} 
			$emails = substr($emails,0,-2);
			return $emails;
	}
	public function generate_key(){
		$gen_key=rand();
	}
	
	function generate_random_code($length = 10) {
		$alphabets = range('A','Z');
		$numbers = range('0','9');
		$final_array = array_merge($alphabets,$numbers);
		$code = '';
		  while($length--) {
		  $key = array_rand($final_array);
		  $code .= $final_array[$key];
		}
		return $code;
	}
	public function baseurl($vals){
		$vals = str_replace(" ", "-",trim(strtolower($vals)));
		$vals = str_replace("/", "-",$vals);
		$vals = str_replace("(", "-",$vals);
		$vals = str_replace(")", "-",$vals);
		$vals = str_replace("&", "-",$vals);
		$vals = str_replace("#", "-",$vals);
		$vals = str_replace("---", "-",$vals);
		$vals = str_replace("--", "-",$vals);
		$vals = str_replace(".", "-",$vals);
		$vals = str_replace("?", "-",$vals);
		return $vals;
	}
		//Genrate Access Token
	function accessToken($length=null) {
		$alphabets = range('a','z');
		$numbers = range('0','9');
		$capitalAlphabets = range('A','Z');
		//$additional_characters = array('!','@','#','$','&');
		$final_array = array_merge($alphabets,$numbers,$capitalAlphabets);
		$accessToken = '';
		while($length--) {
			$key = array_rand($final_array);
			$accessToken .= $final_array[$key];
		}
		return $accessToken;
	}
}
?>
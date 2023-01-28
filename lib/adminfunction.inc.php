<?php
class ADMIN_DAL {  
	private $var;
	public function adminsbox(){
		return '';
	}
	
	public function adminebox(){
		return '';
	}
	
	public function admincids($val){
		$arr = explode(",",$val);
		$newarr = array();
		foreach($arr as $k => $v) {
			if($v)
				$newarr[] = $v;
		}
		return $newarr;
	}
	
	public function sessset($val, $msg=""){
		$_SESSION['sessmsg'] = $val;
		$_SESSION['alert'] = $msg;
		if($_SESSION['alert']=='e'){
			echo $this->error();
			unset($_SESSION['sessmsg']);$_SESSION['sessmsg']='';
		}
		if($_SESSION['alert']=='w'){
			echo $this->warning();	
			unset($_SESSION['sessmsg']);$_SESSION['sessmsg']='';
		}
		if($_SESSION['alert']=='s'){
			echo $this->success();	
			unset($_SESSION['sessmsg']);$_SESSION['sessmsg']='';
		}
		//print_r($_SESSION);die;
	}
	
	public function adminpublish($val){
		if($val == '0'){
			return "Inactive";
		} else {
			return "Active";
		}
	}
	public function secure(){
		if (!$_SESSION["ses_adm_id"] and !$_SESSION["ses_adm_usr"]){
			header('Location: '.SITE_PATH_ADM.'login.php');
			exit;	 
		}
	}
	
	public function alert(){
		if($_SESSION['alert']=='e'){
			echo $this->error();
			unset($_SESSION['sessmsg']);$_SESSION['sessmsg']='';
		}
		if($_SESSION['alert']=='w'){
			echo $this->warning();	
			unset($_SESSION['sessmsg']);$_SESSION['sessmsg']='';
		}
		if($_SESSION['alert']=='s'){
			echo $this->success();	
			unset($_SESSION['sessmsg']);$_SESSION['sessmsg']='';
		}
	}
	
	
	public function error() {
		if($_SESSION['sessmsg']){
			return '<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$_SESSION['sessmsg'].'
					</div>';	
		}
	}
	
	public function warning() {
		if($_SESSION['sessmsg']){
			return '<div class="alert alert-warning alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$_SESSION['sessmsg'].'
					</div>';	
		}	
	}
	
	public function success() {
		if($_SESSION['sessmsg']){
			return '<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$_SESSION['sessmsg'].'
					</div>';	
		}	
	}
	
	public function rowerror($n) {
		return '<tr><td align="center" colspan="'.$n.'"><b>Sorry! No record in databse.</b></td></tr>';	
	} 
	
	public function even_odd($vars){
			if($vars%2==1){
				return ' class="grey"';		
			}
	}
	
	public function orders($vars, $files=''){
		return $vars;
		//return '<a href="'.(($files)?$PHP_SELF:'javascript:void(0);').'">'.$vars.'</a>';
	}
	public function norders($vars){
		return $vars;
	}
	
	public function check_all(){
		return '<input name="check_all" class="all_checkboxes" type="checkbox" id="check_all" value="1" onClick="checkall(this.form)">';
	}
	
	public function check_input($vars){
		return '<input name="arr_ids[]" class="checkbox" type="checkbox" id="arr_ids[]" value="'.$vars.'">';
	}
	
	public function action($vars, $ids, $tags=''){
		return '<a href="'.$vars.'&id='.$ids.'" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil text-inverse m-r-10"></i></a>&nbsp;&nbsp;<a href="'.SITE_PATH_ADM.(($tags)?$tags:CPAGE).'?id='.$ids.'&action=del&view=true" onclick="return confirm(\'Do you want delete this record?\');" data-toggle="tooltip" data-original-title="Close"><i class="fa fa-close text-danger"></i></a>';
	}
	public function selaction($vars, $ids, $tags=''){
		return '<a href="'.$vars.'&id='.$ids.'"><img src="'.SITE_PATH_ADM.'images/icon_edit.png" alt="Edit record" title="Edit record"/></a>&nbsp;&nbsp;<a href="'.SITE_PATH_SEL.(($tags)?$tags:CPAGE).'?id='.$ids.'&action=del&view=true" onclick="return confirm(\'Do you want delete this record?\');"><img src="'.SITE_PATH_ADM.'images/delete-icon.png" alt="Delete record" title="Delete record"/></a>';
	}
	public function order_action($vars, $ids, $tags=''){
		return '<a href="'.$vars.'&id='.$ids.'"><img src="'.SITE_PATH_ADM.'images/icon_edit.png" alt="Edit record" title="Edit record"/></a>';
	}
	public function cataction($vars, $ids, $tags=''){
		return '<a href="'.$vars.'?id='.$ids.'"><img src="'.SITE_PATH_ADM.'images/icon_edit.png" alt="Edit record" title="Edit record"/></a>
		&nbsp;<a href="'.SITE_PATH_ADM.(($tags)?$tags:CPAGE).'?id='.$ids.'&action=del&view=true" onclick="return confirm(\'Do you want delete this record?\');"><img src="'.SITE_PATH_ADM.'images/delete-icon.png" alt="Delete record" title="Delete record"/></a>';
	}
	public function catactionseller($vars, $ids, $tags=''){
		return '<a href="'.$vars.'&id='.$ids.'"><img src="'.SITE_PATH_ADM.'images/icon_edit.png" alt="Edit record" title="Edit record"/></a>';
	}
	
	public function action_($vars, $ids){
		return '<a href="'.$vars.'&id='.$ids.'"><img src="'.SITE_PATH_ADM.'images/icon_edit.png" alt="Edit record" title="Edit record"/></a>&nbsp;<img src="'.SITE_PATH_ADM.'images/lock.png" alt="Lock Page" title="Lock Page"/>';
	}
	
	public function action_e($vars, $ids){
		return '<a href="'.$vars.'&id='.$ids.'" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil text-inverse m-r-10"></i></a>';
	}
	public function action_v($vars, $ids){
		return '<a href="'.$vars.'&id='.$ids.'" data-toggle="tooltip" data-original-title="View"><i class="fa fa-eye text-inverse m-r-10"></i></a>';
	}
	public function action_d($vars, $ids){
		return '<a href="'.SITE_PATH_ADM.(($tags)?$tags:CPAGE).'?id='.$ids.'&action=del&view=true" onclick="return confirm(\'Do you want delete this record?\');" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-close text-danger"></i></a>';
	}
	public function h1_tag($vars, $others='&nbsp;'){
		return '<h1><table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td width="50%" align="left">'.$vars.'</td><td width="50%">'.$others.'</td></tr></table></h1>';
	}
	
	public function heading($vars){
		return '<h2>'.$vars.'</h2>';
	}
	public function get_editor($fld, $vals, $path='', $w='900', $h='350'){
		return '<script type="text/javascript">
				window.onload = function(){
					var editor=CKEDITOR.replace(\''.$fld.'\',{
			        uiCoor : \'#9AB8F3\',
					width : \''.$w.'px\',
					height : \''.$h.'px\'
    			} );
				CKFinder.setupCKEditor( editor, \'/lib/ckfinder/\' );};</script>
				<textarea name="'.$fld.'" id="'.$fld.'" class="ckeditor" rows=""  cols="" class="textareas">'.$vals.'</textarea>';
	}
	
	//for ckeditor
	public function get_editor_s($fld, $vals, $path='', $w='100%', $h='350'){
		return '<script type="text/javascript">
				window.onload = function(){
					var editor=CKEDITOR.replace(\''.$fld.'\',{
			        uiCoor : \'#9AB8F3\',
					width : \''.$w.'px\',
					height : \''.$h.'px\'
    			} );
				CKFinder.setupCKEditor( editor, \'/lib/ckfinder/\' );};</script>
				<textarea name="'.$fld.'" id="'.$fld.'" class="ckeditor" rows=""  cols="" class="textareas">'.$vals.'</textarea>';
	}
	
	/*public function get_editor_s($fld, $vals, $w='45', $h='7'){
		return '<textarea cols="'.$w.'" id="'.$fld.'" class="textarea-editor" name="'.$fld.'" rows="'.$h.'" required>'.$vals.'</textarea>';
	}*/
	
	public function baseurl($vals){
		$vals = str_replace(" ", "-",trim(strtolower($vals)));
		$vals = str_replace("/", "-",$vals);
		$vals = str_replace("(", "-",$vals);
		$vals = str_replace(")", "-",$vals);
		$vals = str_replace("&", "-",$vals);
		$vals = str_replace("#", "-",$vals);
		$vals = str_replace("---", "-",$vals);
		$vals = str_replace("_", "-",$vals);
		$vals = str_replace("__", "-",$vals);
		$vals = str_replace("--", "-",$vals);
		$vals = str_replace(".", "-",$vals);
		$vals = str_replace("?", "-",$vals);
		return $vals;
	}
	public function convert_number($number){
		$no = round($number);
		$point = round($number - $no, 2) * 100;
		$hundred = null;
		$digits_1 = strlen($no);
		$i = 0;
		$str = array();
		$words = array('0' => '', '1' => 'one', '2' => 'two',
		'3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
		'7' => 'seven', '8' => 'eight', '9' => 'nine',
		'10' => 'ten', '11' => 'eleven', '12' => 'twelve',
		'13' => 'thirteen', '14' => 'fourteen',
		'15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
		'18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
		'30' => 'thirty', '40' => 'forty', '50' => 'fifty',
		'60' => 'sixty', '70' => 'seventy',
		'80' => 'eighty', '90' => 'ninety');
		$digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
		while ($i < $digits_1) {
			$divider = ($i == 2) ? 10 : 100;
			$number = floor($no % $divider);
			$no = floor($no / $divider);
			$i += ($divider == 10) ? 1 : 2;
			if ($number) {
				$plural = (($counter = count($str)) && $number > 9) ? 's' : null;
				$hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
				$str [] = ($number < 21) ? $words[$number] .
				" " . $digits[$counter] . $plural . " " . $hundred
				:
				$words[floor($number / 10) * 10]
				. " " . $words[$number % 10] . " "
				. $digits[$counter] . $plural . " " . $hundred;
			} else $str[] = null;
		}
		$str = array_reverse($str);
		$result = implode('', $str);
		$points = ($point) ?
		"." . $words[$point / 10] . " " . 
		$words[$point = $point % 10] : '';
		if($points)
		$output= $result . "Rupees  " . $points . " Paise only.";
		else
		$output= $result . "Rupees  ". " only.";
		return ucwords($output);
	}			
}
?>
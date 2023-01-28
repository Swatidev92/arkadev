<?php
include("../../lib/opin.inc.website.php");
if(isset($_POST['text'])) {
	$existing_url=$cms->db_query("select url from #_blogs where url='".trim($_POST['text'])."'");
	if($existing_url->num_rows>0){
		echo "-1";
	}else{
		echo $cms->baseurl(trim($_POST['text']));
	}
}
?>

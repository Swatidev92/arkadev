<?php include("../../lib/opin.inc.php");
if($_POST['id']){
	//print_r($_POST);die;
	$added_filesArr = explode(',', $added_files);
	while(($i = array_search($id, $added_filesArr)) !== false) {
        unset($added_filesArr[$i]);
    }
    $newFiles = implode(',', $added_filesArr);
	
	$updated = $cms->db_query("UPDATE #_customer_project SET uploaded_files='$newFiles' WHERE id=$projId ");
	if($updated){
		echo 1;
	}else{
		echo 0;
	}
}
die;
?>
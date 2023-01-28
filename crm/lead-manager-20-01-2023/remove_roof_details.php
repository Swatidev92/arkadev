<?php include("../../lib/opin.inc.php");
$delete= $cms->db_query("update #_roof_details set is_deleted = 1 where id=".$_REQUEST['id']." ");
// unlink(CRM_FILES_PATH."UP_FILES_MEDIA/".$_REQUEST["name"]."");

if($delete){
	echo 1;
}
else{
	echo 0;
}
die;
?>
<?php include("../../lib/opin.inc.php");
$delete= $cms->db_query("delete from #_media_files where id=".$_REQUEST['id']."");
unlink(CRM_FILES_PATH."UP_FILES_MEDIA/".$_REQUEST["name"]."");
if($delete){
	echo 1;
}
else{
	echo 0;
}
die;
?>
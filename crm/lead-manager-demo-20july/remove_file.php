<?php include("../../lib/opin.inc.php");
$delete= $cms->db_query("delete from #_uploads where id=".$_REQUEST['id']."");
unlink(FILES_PATH."uploads/".$_REQUEST["name"]."");
if($delete){
	echo 1;
}
else{
	echo 0;
}
die;
?>
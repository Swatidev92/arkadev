<?php include("../../lib/opin.inc.php");
$delete= $cms->db_query("delete from #_reports where id=".$_REQUEST['id']."");
unlink(FILES_PATH."reports/".$_REQUEST["name"]."");
if($delete){
	echo 1;
}
else{
	echo 0;
}
die;
?>
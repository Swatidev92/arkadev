<?php include("../../lib/opin.inc.php");
//print_r($_POST);die;
$delete= $cms->db_query("delete from #_project_steps where id=".$_POST['fieldid']."");

if($delete){
	echo 1;
}
else{
	echo 0;
}
die;
?>
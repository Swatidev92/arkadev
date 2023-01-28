<?php include("../../lib/opin.inc.php");

//print_r($_POST);die;

$rsAdmin = $cms->db_query("select installation_image from #_leads where id='".$drop_id."'");
$arrAdmin = $rsAdmin->fetch_array(); 
@extract($arrAdmin);

unlink(FILES_PATH."proposal/".$installation_image);

$_POST["installation_image"] ='';

$cms->sqlquery("rs","leads",$_POST, 'id', $drop_id);

echo 1;

?>

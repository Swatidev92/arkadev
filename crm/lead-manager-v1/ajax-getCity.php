<?php
include("../../lib/opin.inc.php");
if(isset($_POST['c_id'])) {
	$sql = $cms->db_query("select id,city_name from #_cities where `state_id`='".$_POST['c_id']."'");
	
	if($sql->num_rows > 0) {
		echo "<option value=''>Select City</option>";
		while($subcatRes = $sql->fetch_assoc()) {
			echo "<option value='".$subcatRes['id']."'>".$subcatRes['city_name']."</option>";
		}
	}else{
		echo "<option value=''>Select City</option>";
	}
}
?>

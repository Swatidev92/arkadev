<?php
include("../../lib/opin.inc.php");
if(isset($_POST['c_id'])) {
	$sql = $cms->db_query("select id,course_name from #_courses where `parent_id`='".$_POST['c_id']."'");
	
	if($sql->num_rows > 0) {
		echo "<option value=''>Select Course</option>";
		while($subcatRes = $sql->fetch_assoc()) {
			echo "<option value='".$subcatRes['id']."'>".$subcatRes['course_name']."</option>";
		}
	}else{
		echo "<option value=''>Select Course</option>";
	}
}
?>

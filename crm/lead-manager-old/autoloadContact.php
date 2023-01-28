<?php 
include("../../lib/opin.inc.php");
	//get search term
    $searchTerm = $_GET['term'];
    //get matched data from skills table
    $query = $cms->db_query("SELECT id, contact_no FROM #_leads WHERE contact_no LIKE '%".$searchTerm."%' GROUP BY contact_no ORDER BY contact_no ASC ");
    while ($row = $query->fetch_assoc()) {
        $data[] = array('label'=>$row['contact_no'],'value'=>$row['id']);
		
	}
    
    //return json data
    echo json_encode($data);
die;
?>
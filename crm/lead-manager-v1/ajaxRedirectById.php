<?php 
include("../../lib/opin.inc.php");
//get search term
    $searchTerm = $_REQUEST['phone'];
    
    //get matched data from skills table
  $id = $cms->getSingleResult("SELECT id FROM #_lead_management WHERE phone='".$searchTerm."'");
  if($id>0){
	  echo $id;
  }else{
	  echo 0;
  }
die;
?>
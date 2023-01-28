<?php
session_start();
  //print_r($_POST);
//$url = 'https://media.geeksforgeeks.org/wp-content/uploads/geeksforgeeks-6-1.png'; 
$url = $_POST["areaimg"]; 
  
echo $_SESSION['user_map_area']=$url;
die;

// Function to write image into file
//file_put_contents($img, file_get_contents($url));
   
?>
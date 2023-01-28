<?php
session_start();
  //print_r($_POST);
//$url = 'https://media.geeksforgeeks.org/wp-content/uploads/geeksforgeeks-6-1.png'; 
$url = $_POST["areaimg"]; 
  
$user_map_area = $url;
$drawn_img_name = 'area'.time().'.png';
$attached_img = SITE_FS_PATH.'/uploaded_files/user_map/'.$drawn_img_name;
file_put_contents($attached_img, file_get_contents($user_map_area));

$_SESSION['user_map_area'] =  $drawn_img_name;
echo $_SESSION['user_map_area'];

die;

// Function to write image into file
//file_put_contents($img, file_get_contents($url));
   
?>
<?php

include 'db.php';

$response=array();

$userId;
$email=$_GET['email'];
$query_get_user="SELECT * FROM `ae_vendor` WHERE `email`='$email'";
$run_query_get_user=mysqli_query($connect,$query_get_user);
while($row=mysqli_fetch_array($run_query_get_user))
{
    $userId=$row['id'];
}

$query_dashblisting="SELECT `id`,`status`,`project_name`,`project_date` FROM `ae_customer_project` WHERE `panel_vendor_id`=$userId OR `electrical_vendor_id`=$userId ORDER BY `id` DESC LIMIT 5";
$run_query_dashblisting=mysqli_query($connect,$query_dashblisting);
while($row2=mysqli_fetch_array($run_query_dashblisting))
{
    array_push($response,$row2);
}

echo json_encode($response);

?>
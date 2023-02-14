<?php

include 'db.php';

$response=array();

$vendor_id=$_GET['vendor_id'];
$query_get_user="SELECT * FROM `ae_vendor_resources` WHERE `vendor_id`=$vendor_id";
$run_query_get_user=mysqli_query($connect,$query_get_user);
while($row=mysqli_fetch_array($run_query_get_user))
{
    array_push($response,$row);
}

echo json_encode($response);

?>
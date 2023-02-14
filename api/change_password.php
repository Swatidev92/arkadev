<?php

include 'db.php';

$response=array();

$userId=$_GET['email'];
$password=$_GET['password'];
$query="UPDATE `ae_vendor` SET `password`='$password' WHERE `email`='$userId'";
$run_query=mysqli_query($connect,$query);
if($run_query)
{
    $response['status']="Success";
}
else
{
    $response['status']="Failure";
}

echo json_encode($response);

?>
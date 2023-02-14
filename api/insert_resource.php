<?php

include 'db.php';

$response=array();
if(isset($_POST['name']))
{
$userId=$_POST['name'];
$phone_nu=$_POST['phone'];
$u_email=$_POST['email'];
$u_remark=$_POST['remark'];
$vendor=$_POST['vendor_id'];
$r_password=$_POST['password'];
$query="INSERT INTO `ae_vendor_resources`(`id`, `resource_name`, `phone`, `email`, `remark`, `status`, `vendor_id`,`password`) VALUES (null,'$userId','$phone_nu','$u_email','$u_remark','1','$vendor','$r_password')";
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
}

?>
<?php include 'db.php';

$response=array();
$userId=$_GET['email'];
$get_user_data="SELECT `company_name`,`email`,`phone`,`address`,`vendor_logo`,`city`,`country`,`postal_code` FROM `ae_vendor` WHERE `email`='$userId'";
$run_get_user_data=mysqli_query($connect,$get_user_data);
while($row=mysqli_fetch_array($run_get_user_data))
{
    array_push($response,$row);
}

echo json_encode($response);

?>
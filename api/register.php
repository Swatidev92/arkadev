<?php 

include 'db.php';

$response=array();

if(isset($_POST['email']))
{
    $user_company=$_POST['company'];
    $user_name=$_POST['name'];
    $user_email=$_POST['email'];
    $user_password=$_POST['password'];
    $user_contact=$_POST['contact'];
    $user_work_type=$_POST['type'];
    $add_vendor="INSERT INTO `ae_vendor`(`id`, `company_name`, `phone`, `email`, `website`, `address`, `postal_code`, `city`, `country`, `aggrement_note`, `status`, `created`, `modified`, `vendor_id`, `is_deleted`, `approved_status`, `contact_person_name`, `work_type`, `vendor_logo`, `password`) VALUES (null,'$user_company','$user_contact','$user_email','','','','','','',0,'','','1',0,0,'$user_name','$user_work_type','','$user_password')";
    $run_add_vendor=mysqli_query($connect,$add_vendor);
    if($run_add_vendor)
    {
        $response["status"]="Success";
    }
    else
    {
        $response["status"]="Failure";
    }

    echo json_encode($response);
}

?>
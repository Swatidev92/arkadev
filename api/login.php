<?php

include 'db.php';

$respose=array();

if(isset($_GET['email']))
    $username=$_GET['email'];
    $user_password=$_GET['password'];
    $run_check="SELECT * FROM `ae_vendor` WHERE `email`='$username' AND `password`='$user_password' AND `status`=2";
    $murun_check=mysqli_query($connect,$run_check);
    $returnrows=mysqli_num_rows($murun_check);
    if($returnrows > 0)
    {
        while($row=mysqli_fetch_array($murun_check))
        {
            $respose["vendorId"]=$row['id'];
        }
        
    }
    else
    {
        $check_from_resource="";
        $un_check_from_resouce=mysqli_query($connect,$check_from_resource);
        $total_returned_data=mysqli_num_rows($un_check_from_resouce);
        if($total_returned_data >0)
        {
            $respose["status"]="Success";
        }
        else
        {
            $respose["status"]="Failure";
        }
        
    }
    
    echo json_encode($respose);


?>
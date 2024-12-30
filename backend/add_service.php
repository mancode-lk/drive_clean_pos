<?php

include 'conn.php';

$serName=$_REQUEST['serName'];
$description=$_REQUEST['description'];
$icon=$_REQUEST['icon'];
$price=$_REQUEST['price'];
$wcuText=$_REQUEST['wcuText'];
$heading=$_REQUEST['heading'];
$subHeading=$_REQUEST['subHeading'];


$sql="INSERT INTO tbl_service (service_name,serv_description,icon_image,price,wcu_text,heading,sub_heading) 
                        VALUES ('$serName','$description','$icon','$price','$wcuText','$heading','$subHeading')";
$rs=$conn->query($sql);

if($rs > 0){

   
    $_SESSION['Service_added_success']= true ;
  header('location:../servicemanagement.php');
  exit();
}
else {
    $_SESSION['Service_added_error']= true ;
  header('location:../servicemanagement.php');
  exit();
}


 ?>

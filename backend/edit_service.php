<?php

include 'conn.php';

$ser_id = $_REQUEST['ser_id'];
$serName=$_REQUEST['serName'];
$description=$_REQUEST['description'];
$icon=$_REQUEST['icon'];
$price=$_REQUEST['price'];
$wcuText=$_REQUEST['wcuText'];
$heading=$_REQUEST['heading'];
$subHeading=$_REQUEST['subHeading'];

$sql="UPDATE tbl_service SET service_name='$serName',
                           serv_description ='$description',
                           icon_image ='$icon',
                           price ='$price',
                           wcu_text ='$wcuText',
                           heading ='$heading',
                           sub_heading='$subHeading' WHERE ser_id ='$ser_id'";
$rs=$conn->query($sql);

if($rs > 0){
  header('location:../servicemanagement.php');
  exit();
}
else {
  header('location:../servicemanagement.php');
  exit();
}


 ?>

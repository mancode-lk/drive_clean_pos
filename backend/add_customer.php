<?php

include 'conn.php';

$customerName=$_REQUEST['customerName'];
$contactNo=$_REQUEST['contactNo'];
$email=$_REQUEST['email'];
$address=$_REQUEST['address'];
$city=$_REQUEST['city'];
$idNum=$_REQUEST['idNum'];

$sql="INSERT INTO customer (customer_name,customer_phone,email,address,city,id_number) 
                    VALUES ('$customerName','$contactNo','$email','$address','$city','$idNum')";
$rs=$conn->query($sql);

if($rs > 0){

   
    $_SESSION['customer_added_success']= true ;
  header('location:../addCustomer.php');
  exit();
}
else {
    $_SESSION['customer_added_error']= true ;
  header('location:../addCustomer.php');
  exit();
}


 ?>

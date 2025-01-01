<?php

include 'conn.php';

$c_id = $_REQUEST['c_id'];
$customerName=$_REQUEST['customerName'];
$contactNo=$_REQUEST['contactNo'];
$email=$_REQUEST['email'];
$address=$_REQUEST['address'];
$city=$_REQUEST['city'];
$idNum=$_REQUEST['idNum'];


$sql="UPDATE customer SET customer_name='$customerName',
                           customer_phone ='$contactNo',
                           email='$email',
                           address ='$address',
                           city ='$city',
                           id_number ='$idNum' WHERE customer_id ='$c_id'";
$rs=$conn->query($sql);

if($rs > 0){
  header('location:../addCustomer.php');
  exit();
}
else {
  header('location:../addCustomer.php');
  exit();
}


 ?>

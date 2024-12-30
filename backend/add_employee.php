<?php

include 'conn.php';

$empname=$_REQUEST['empname'];
$contactNo=$_REQUEST['contactNo'];
$email=$_REQUEST['email'];
$role=$_REQUEST['role'];

$sql="INSERT INTO tbl_employee (employee_name,role,email,contact_no) VALUES ('$empname','$role','$email','$contactNo')";
$rs=$conn->query($sql);

if($rs > 0){

   
    $_SESSION['employee_added_success']= true ;
  header('location:../employeemanagement.php');
  exit();
}
else {
    $_SESSION['employee_added_error']= true ;
  header('location:../employeemanagement.php');
  exit();
}


 ?>

<?php

include 'conn.php';

$emp_id = $_REQUEST['emp_id'];
$employee_name=$_REQUEST['employee_name'];
$email=$_REQUEST['email'];
$contactNo=$_REQUEST['contactNo'];
$role=$_REQUEST['role'];

$sql="UPDATE tbl_employee SET employee_name='$employee_name',
                           email ='$email',
                           contact_no ='$contactNo',
                           role='$role' WHERE employee_id ='$emp_id'";
$rs=$conn->query($sql);

if($rs > 0){
  header('location:../employeemanagement.php');
  exit();
}
else {
  header('location:../employeemanagement.php');
  exit();
}


 ?>

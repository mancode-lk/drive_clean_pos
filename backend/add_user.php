<?php

include 'conn.php';

$username=$_REQUEST['username'];
$password=$_REQUEST['password'];
$role=$_REQUEST['role'];

$sql="INSERT INTO tbl_users(username,password,role) VALUES ('$username','$password','$role')";
$rs=$conn->query($sql);

if($rs > 0){
  header('location:../usermanagement.php');
  exit();
}
else {
  header('location:../usermanagement.php');
  exit();
}


 ?>

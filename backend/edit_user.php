<?php

include 'conn.php';

$user_id = $_REQUEST['user_id'];
$username=$_REQUEST['username'];
$password=$_REQUEST['password'];
$role=$_REQUEST['role'];

$sql="UPDATE tbl_users SET username='$username',
                           password='$password',
                           role='$role' WHERE u_id='$user_id'";
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

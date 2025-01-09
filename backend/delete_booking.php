<?php
include 'conn.php';

$id = $_REQUEST['id'];

$sql ="DELETE FROM booked_services WHERE booking_id='$id'";
$rs = $conn->query($sql);

$sql = "DELETE FROM tbl_booking WHERE booking_id='$id'";
$rs=$conn->query($sql);

if($rs > 0){
  header('location:../bookings.php');
  exit();
}
else {
  header('location:../bookings.php');
  exit();
}

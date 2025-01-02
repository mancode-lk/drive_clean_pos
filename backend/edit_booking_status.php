<?php
include 'conn.php';

$booking_id=$_REQUEST['id'];

$sql="UPDATE tbl_booking SET status='1' WHERE booking_id='$booking_id'";
$rs=$conn->query($sql);

if($rs>0){
    header('location:../bookings.php');
    exit;
}else{
    echo $sql;
}

?>
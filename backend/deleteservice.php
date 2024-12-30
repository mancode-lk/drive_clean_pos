<?php

    include "conn.php";

    $ser_id=$_REQUEST['ser_id'];

    $sql="DELETE FROM tbl_service WHERE ser_id ='$ser_id'";
    $rs=$conn->query($sql);

    if($rs>0){
        echo 200;
        exit();
    }else{
        echo 300;
        exit();
    }

?>

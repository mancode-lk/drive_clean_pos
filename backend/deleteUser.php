<?php

    include "conn.php";

    $u_id=$_REQUEST['user_id'];

    $sql="DELETE FROM tbl_users WHERE u_id='$u_id'";
    $rs=$conn->query($sql);

    if($rs>0){
        echo 200;
        exit();
    }else{
        echo 300;
        exit();
    }

?>

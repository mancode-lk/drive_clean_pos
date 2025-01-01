<?php

    include "conn.php";

    $c_id=$_REQUEST['c_id'];

    $sql="DELETE FROM customer WHERE customer_id ='$c_id'";
    $rs=$conn->query($sql);

    if($rs>0){
        echo 200;
        exit();
    }else{
        echo 300;
        exit();
    }

?>

<?php

    include "conn.php";

    $emp_id=$_REQUEST['emp_id'];

    $sql="DELETE FROM tbl_employee WHERE employee_id ='$emp_id'";
    $rs=$conn->query($sql);

    if($rs>0){
        echo 200;
        exit();
    }else{
        echo 300;
        exit();
    }

?>

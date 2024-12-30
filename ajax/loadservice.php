<?php include '../backend/conn.php';
?>
<table class="table table-bordered">
  <thead>
    <tr>
      <th>#</th>
      <th>Service Name</th>
      
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $sql = "SELECT * FROM tbl_service";
      $rs=$conn->query($sql);
      if($rs->num_rows > 0){
        $num=1;
        while($rowSer = $rs->fetch_assoc()){
          $id=$rowSer['ser_id'];
     ?>
    <tr>
      <td><?= $num ?></td>
      <td><?= $rowSer['service_name'] ?></td>
      
      <td>
        <button class="btn btn-warning btn-sm" onclick="openserviceEditModal(<?= $id ?>)">Edit</button>
        <button class="btn btn-danger btn-sm" onclick="removeservice(<?= $id ?>)">Delete</button>
      </td>
    </tr>
  <?php $num++; } } ?>
  </tbody>
</table>

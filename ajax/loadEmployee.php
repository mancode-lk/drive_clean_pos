<?php include '../backend/conn.php';
?>
<table class="table table-bordered">
  <thead>
    <tr>
      <th>#</th>
      <th>Employee Name</th>
      <th>Contact</th>
      <th>Role</th>
      <th>Email</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $sql = "SELECT * FROM tbl_employee";
      $rs=$conn->query($sql);
      if($rs->num_rows > 0){
        $num=1;
        while($rowEmp = $rs->fetch_assoc()){
          $id=$rowEmp['employee_id'];
     ?>
    <tr>
      <td><?= $num ?></td>
      <td><?= $rowEmp['employee_name'] ?></td>
      <td><?= $rowEmp['contact_no'] ?></td>
      <td><?= $rowEmp['role'] ?></td>
      <td><?= $rowEmp['email'] ?></td>
      <td>
        <button class="btn btn-warning btn-sm" onclick="openemployeeEditModal(<?= $id ?>)">Edit</button>
        <button class="btn btn-danger btn-sm" onclick="removeEmployee(<?= $id ?>)">Delete</button>
      </td>
    </tr>
  <?php $num++; } } ?>
  </tbody>
</table>

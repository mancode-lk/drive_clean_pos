<?php include '../backend/conn.php';
?>
<table class="table table-bordered">
  <thead>
    <tr>
      <th>#</th>
      <th>Customer Name</th>
      <th>Contact</th>
      <th>Email</th>
      <th>Address</th>
      <th>City</th>
      <th>ID Number</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $sql = "SELECT * FROM customer";
      $rs=$conn->query($sql);
      if($rs->num_rows > 0){
        $num=1;
        while($rowCus = $rs->fetch_assoc()){
          $id=$rowCus['customer_id'];
     ?>
    <tr>
      <td><?= $num ?></td>
      <td><?= $rowCus['customer_name'] ?></td>
      <td><?= $rowCus['customer_phone'] ?></td>
      <td><?= $rowCus['email'] ?></td>
      <td><?= $rowCus['address'] ?></td>
      <td><?= $rowCus['city'] ?></td>
      <td><?= $rowCus['id_number'] ?></td>
      <td>
        <button class="btn btn-warning btn-sm" onclick="openemployeeEditModal(<?= $id ?>)">Edit</button>
        <button class="btn btn-danger btn-sm" onclick="removeEmployee(<?= $id ?>)">Delete</button>
      </td>
    </tr>
  <?php $num++; } } ?>
  </tbody>
</table>

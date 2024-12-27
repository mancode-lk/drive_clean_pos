<?php include '../backend/conn.php';
?>
<table class="table table-bordered">
  <thead>
    <tr>
      <th>#</th>
      <th>User Name</th>
      <th>Password</th>
      <th>Role</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $sql = "SELECT * FROM tbl_users";
      $rs=$conn->query($sql);
      if($rs->num_rows > 0){
        while($rowUsers = $rs->fetch_assoc()){
          $id=$rowUsers['u_id'];
          $role_id =$rowUsers['role'];

          $role =getRole($role_id);
     ?>
    <tr>
      <td><?= $id ?></td>
      <td><?= $rowUsers['username'] ?></td>
      <td><?= $rowUsers['password'] ?></td>
      <td><?= $role ?></td>
      <td>
        <button class="btn btn-warning btn-sm" onclick="openuserEditModal(<?= $id ?>)">Edit</button>
        <button class="btn btn-danger btn-sm" onclick="removeUser(<?= $id ?>)">Delete</button>
      </td>
    </tr>
  <?php } } ?>
  </tbody>
</table>

<?php
  include '../backend/conn.php';
  $user_id = $_REQUEST['user_id'];

  $sql = "SELECT * FROM tbl_users WHERE u_id='$user_id'";
  $rs=$conn->query($sql);
  if($rs->num_rows > 0){
  $rowUsers = $rs->fetch_assoc();
      $id=$rowUsers['u_id'];
      $role_id =$rowUsers['role'];

      $role =getRole($role_id);
  }
 ?>
<div class="container">
  <hr>
  <form action="backend/edit_user.php" method="post">
    <input type="hidden" name="user_id" value="<?= $id ?>">
    <div class="form-group">
      <label for="username">User Name</label>
      <input type="text" id="username" name="username" class="form-control" value="<?= $rowUsers['username'] ?>" required>
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" id="password" name="password" class="form-control" value="<?= $rowUsers['password'] ?>" required>
    </div>
    <div class="form-group">
      <label for="role">Role</label>
      <select id="role" name="role" class="form-control" required>
        <option value="">Select Role</option>
        <option value="1" <?php if ($role_id==1){ ?> selected <?php } ?>>Admin</option>
        <option value="2" <?php if ($role_id==2){ ?> selected <?php } ?>>Staff</option>
        <option value="3" <?php if ($role_id==3){ ?> selected <?php } ?>>Viewer</option>
      </select>
    </div> <br>
    <button type="submit" class="btn btn-warning btn-sm">Edit User</button>
  </form>
  <hr>
</div>

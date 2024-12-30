<?php
  include '../backend/conn.php';
  $emp_id = $_REQUEST['emp_id'];

  $sql = "SELECT * FROM tbl_employee WHERE employee_id='$emp_id'";
  $rs=$conn->query($sql);
  if($rs->num_rows > 0){
  $rowEmp = $rs->fetch_assoc();
      $id=$rowEmp['employee_id'];
  }
 ?>
<div class="container">
  <hr>
  <form action="backend/edit_employee.php" method="post">
    <input type="hidden" name="emp_id" value="<?= $id ?>">
    <div class="form-group">
      <label for="username">Employee Name</label>
      <input type="text" id="employee_name" name="employee_name" class="form-control" value="<?= $rowEmp['employee_name'] ?>" required>
    </div>
                            <div class="form-group">
                              <label for="contactNo">Contact No</label>
                              <input type="text" id="contactNo" name="contactNo" class="form-control" value="<?= $rowEmp['contact_no'] ?>" required>
                            </div>
                            <div class="form-group">
                              <label for="email">Email</label>
                              <input type="email" id="email" name="email" class="form-control" value="<?= $rowEmp['email'] ?>" required>
                            </div>
                            <div class="form-group">
                              <label for="role">Role</label>
                              <input type="text" id="role" name="role" class="form-control" value="<?= $rowEmp['role'] ?>" required>
                            </div>
     <br>
    <button type="submit" class="btn btn-warning btn-sm">Edit User</button>
  </form>
  <hr>
</div>

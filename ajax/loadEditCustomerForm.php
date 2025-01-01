<?php
  include '../backend/conn.php';
  $c_id = $_REQUEST['c_id'];

  $sql = "SELECT * FROM customer WHERE customer_id='$c_id'";
  $rs=$conn->query($sql);
  if($rs->num_rows > 0){
  $rowCust = $rs->fetch_assoc();
      $id=$rowCust['customer_id'];
  }
 ?>
<div class="container">
  <hr>
  <form action="backend/edit_customer.php" method="post">
    <input type="hidden" name="c_id" value="<?= $id ?>">
    <div class="form-group">
                            <label for="customerName">Customer Name</label>
                            <input type="text" id="customerName" name="customerName" class="form-control" value="<?= $rowCust['customer_name'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="contactNo">Contact No</label>
                            <input type="text" id="contactNo" name="contactNo" class="form-control" value="<?= $rowCust['customer_phone'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" value="<?= $rowCust['email'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" id="address" name="address" class="form-control" value="<?= $rowCust['address'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" id="city" name="city" class="form-control" value="<?= $rowCust['city'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="idNum">ID Number</label>
                            <input type="text" id="idNum" name="idNum" class="form-control" value="<?= $rowCust['id_number'] ?>" required>
                        </div>
                  
     <br>
    <button type="submit" class="btn btn-warning btn-sm">Edit Customer</button>
  </form>
  <hr>
</div>

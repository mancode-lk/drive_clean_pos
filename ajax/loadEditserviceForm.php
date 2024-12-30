<?php
  include '../backend/conn.php';
  $ser_id = $_REQUEST['ser_id'];

  $sql = "SELECT * FROM tbl_service WHERE ser_id='$ser_id'";
  $rs=$conn->query($sql);
  if($rs->num_rows > 0){
  $rowSer = $rs->fetch_assoc();
      $id=$rowSer['ser_id'];
  }
 ?>
<div class="container">
  <hr>
  <form action="backend/edit_service.php" method="post">
    <input type="hidden" name="ser_id" value="<?= $id ?>">
    
                            <div class="form-group">
                              <label for="serName">Service Name</label>
                              <input type="text" id="serName" name="serName" class="form-control" value="<?= $rowSer['service_name'] ?>" required>
                            </div>
                            <div class="form-group">
                              <label for="description">Description</label>
                              <input type="text" id="description" name="description" class="form-control" value="<?= $rowSer['serv_description'] ?>" required>
                            </div>
                            <div class="form-group">
                              <label for="icon">Icon Image</label>
                              <select id="icon" name="icon" class="form-control" value="<?= $rowSer['icon_image'] ?>" required>
                                <option value="">Select Icon</option>
                                <option value="1">image1</option>
                                <option value="2">image2</option>
                                <option value="3">image3</option>
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="price">Price</label>
                              <input type="text" id="price" name="price" class="form-control" value="<?= $rowSer['price'] ?>" required>
                            </div>
                            <div class="form-group">
                              <label for="wcuText">WCU text</label>
                              <input type="text" id="wcuText" name="wcuText" class="form-control" value="<?= $rowSer['wcu_text'] ?>" required>
                            </div>
                            <div class="form-group">
                              <label for="heading">Heading</label>
                              <input type="text" id="heading" name="heading" class="form-control" value="<?= $rowSer['heading'] ?>" required>
                            </div>
                            <div class="form-group">
                              <label for="subHeading">Sub Heading</label>
                              <input type="text" id="subHeading" name="subHeading" class="form-control" value="<?= $rowSer['sub_heading'] ?>" required>
                            </div>
     <br>
    <button type="submit" class="btn btn-warning btn-sm">Edit Service</button>
  </form>
  <hr>
</div>

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
                              <textarea name="description" class="form-control" id="description" rows="4" cols="80" required><?= $rowSer['serv_description'] ?></textarea>
                            </div>
                            <div class="form-group">
                              <label for="icon">Icon Image</label>
                              <select id="icon" name="icon" class="form-control" required>
                                <option value="">Select Icon</option>
                                <option value="bi bi-droplet fs-1" <?php if($rowSer['icon_image'] == "bi bi-droplet fs-1"){ echo "selected"; } ?>>Car Wash</option>
                                <option value="bi bi-tools fs-1" <?php if($rowSer['icon_image'] == "bi bi-tools fs-1"){ echo "selected"; } ?>>Repair</option>
                                <option value="bi bi-fuel-pump fs-1" <?php if($rowSer['icon_image'] == "bi bi-fuel-pump fs-1"){ echo "selected"; } ?>>Fuel Service</option>
                                <option value="bi bi-speedometer fs-1" <?php if($rowSer['icon_image'] == "bi bi-speedometer fs-1"){ echo "selected"; } ?>>Oil Change</option>
                                <option value="bi bi-battery-charging fs-1" <?php if($rowSer['icon_image'] == "bi bi-battery-charging fs-1"){ echo "selected"; } ?>>Battery Service</option>
                                <option value="bi bi-tire fs-1" <?php if($rowSer['icon_image'] == "bi bi-tire fs-1"){ echo "selected"; } ?>>Tire Change</option>
                                <option value="bi bi-wrench fs-1" <?php if($rowSer['icon_image'] == "bi bi-wrench fs-1"){ echo "selected"; } ?>>Engine Tune-Up</option>
                                <option value="bi bi-snow fs-1" <?php if($rowSer['icon_image'] == "bi bi-snow fs-1"){ echo "selected"; } ?>>Air Conditioning Service</option>
                                <option value="bi bi-clipboard-check fs-1" <?php if($rowSer['icon_image'] == "bi bi-clipboard-check fs-1"){ echo "selected"; } ?>>Inspection</option>
                                <option value="bi bi-lightning fs-1" <?php if($rowSer['icon_image'] == "bi bi-lightning fs-1"){ echo "selected"; } ?>>Electrical Repairs</option>
                                <option value="bi bi-camera-video fs-1" <?php if($rowSer['icon_image'] == "bi bi-camera-video fs-1"){ echo "selected"; } ?>>Camera Calibration</option>
                                <option value="bi bi-wind fs-1" <?php if($rowSer['icon_image'] == "bi bi-wind fs-1"){ echo "selected"; } ?>>Windshield Cleaning</option>
                                <option value="bi bi-circle fs-1" <?php if($rowSer['icon_image'] == "bi bi-circle fs-1"){ echo "selected"; } ?>>Alignment</option>
                                <option value="bi bi-brightness-high fs-1" <?php if($rowSer['icon_image'] == "bi bi-brightness-high fs-1"){ echo "selected"; } ?>>Headlight Polishing</option>
                                <option value="bi bi-shield-check fs-1" <?php if($rowSer['icon_image'] == "bi bi-shield-check fs-1"){ echo "selected"; } ?>>Safety Check</option>
                                <option value="bi bi-airplane fs-1" <?php if($rowSer['icon_image'] == "bi bi-airplane fs-1"){ echo "selected"; } ?>>Vehicle Shipping</option>
                                <option value="bi bi-truck fs-1" <?php if($rowSer['icon_image'] == "bi bi-truck fs-1"){ echo "selected"; } ?>>Heavy Vehicle Service</option>
                                <option value="bi bi-car-front fs-1" <?php if($rowSer['icon_image'] == "bi bi-car-front fs-1"){ echo "selected"; } ?>>Interior Detailing</option>
                                <option value="bi bi-box-arrow-in-down fs-1" <?php if($rowSer['icon_image'] == "bi bi-box-arrow-in-down fs-1"){ echo "selected"; } ?>>Parts Replacement</option>
                                <option value="bi bi-check-circle fs-1" <?php if($rowSer['icon_image'] == "bi bi-check-circle fs-1"){ echo "selected"; } ?>>Emissions Testing</option>
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="price">Price</label>
                              <input type="text" id="price" name="price" class="form-control" value="<?= $rowSer['price'] ?>" required>
                            </div>
                            <div class="form-group">
                              <label for="wcuText">WCU text</label>
                              <textarea name="wcuText" class="form-control" id="wcuText" rows="4" cols="80" required><?= $rowSer['wcu_text'] ?></textarea>
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

<?php include '../backend/conn.php';

$booking_id=$_REQUEST['booking_id'];
$sql = "SELECT * FROM tbl_booking WHERE booking_id='$booking_id'";
$rs=$conn->query($sql);
if($rs->num_rows > 0){
$rowBook = $rs->fetch_assoc();
    $id=$rowBook['booking_id'];
}

?>

<div class="container">
                  <hr>
                  <h6>Edit Booking</h6>
                  <hr>
                  <form class="" action="backend/edit_booking.php" method="post">
                    <div class="form-group">
                        <input type="hidden" name="booking_id" id="booking_id" value="<?= $booking_id ?>">
                        <label for="customer_id">Customer</label>
                        <?php
                        $customer_id = $rowBook['customer_id'];
                        $sql = "SELECT * FROM customer WHERE customer_id='$customer_id'";
                        $rs = $conn->query($sql);
                        if ($rs->num_rows == 1) {
                            $row = $rs->fetch_assoc();
                            $customer_name = htmlspecialchars($row['customer_name']);
                        ?>
                            <input
                                type="text"
                                class="form-control"
                                name="customer_id"
                                value="<?= $customer_name ?>"
                                onfocus="this.setAttribute('disabled', true); showVehicless('<?= $customer_id ?>');"
                                disabled>
                        <?php
                            }
                            ?>

                        <br>
                        <div id="showVehicles"></div>
                        <br>
                    </div>
                    <div class="form-group">
                        <label for="services">Select Services</label>
                        <br>
                        <hr>
                        <div class="row">
                            <?php
                            // Fetch booked services for the given booking ID
                            $sqlServices = "SELECT * FROM booked_services WHERE booking_id='$booking_id'";
                            $rsServices = $conn->query($sqlServices);
                            $bookedServices = []; // Store booked service IDs for easy lookup
                            if ($rsServices->num_rows > 0) {
                                while ($rowService = $rsServices->fetch_assoc()) {
                                    $bookedServices[] = $rowService['service_id'];
                                }
                            }

                            // Fetch all available services
                            $sqlSer = "SELECT * FROM tbl_service";
                            $rsSer = $conn->query($sqlSer);
                            if ($rsSer->num_rows > 0) {
                                while ($rowSer = $rsSer->fetch_assoc()) {
                                    $serviceId = $rowSer['ser_id'];
                                    $isChecked = in_array($serviceId, $bookedServices) ? 'checked' : ''; // Check if the service is already booked
                                    $estimated_duration ="";
                                    $sqlCheck ="SELECT * FROM booked_services WHERE booking_id='$booking_id' AND service_id='$serviceId'";
                                    $rsCheck = $conn->query($sqlCheck);
                                    if($rsCheck->num_rows > 0){
                                      $rowCheck = $rsCheck->fetch_assoc();
                                      $estimated_duration =$rowCheck['estimated_duration'];
                                    }

                            ?>
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input
                                                type="checkbox"
                                                style="width:20px;height:20px;"
                                                class="form-check-input"
                                                id="service<?= $serviceId ?>"
                                                name="services[<?= $serviceId ?>][id]"
                                                value="<?= $serviceId ?>"
                                                <?= $isChecked ?>>
                                            &nbsp;
                                            <label
                                                class="form-check-label"
                                                for="service<?= $serviceId ?>"
                                                style="font-size:15px;font-weight:bold;">
                                                <?= htmlspecialchars($rowSer['service_name']) ?>
                                            </label>
                                        </div>
                                        <div class="form-group mt-2">
                                            <label for="price">Price</label>
                                            <input
                                                type="number"
                                                step="0.01"
                                                class="form-control"
                                                name="services[<?= $serviceId ?>][price]"
                                                value="<?= htmlspecialchars($rowSer['price']) ?>"
                                                placeholder="Enter Price">
                                        </div>
                                        <div class="form-group mt-2">
                                            <label for="duration">Estimated Duration (in days)</label>
                                            <input
                                                type="number"
                                                class="form-control"
                                                name="services[<?= $serviceId ?>][duration]"
                                                placeholder="Enter Duration" value="<?= $estimated_duration ?>">
                                        </div>
                                        <hr>
                                    </div>
                            <?php
                                }
                            } else {
                                echo "<p class='text-danger'>No services available.</p>";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Staff Who Is handling</label>
                        <select class="form-control" name="emp_id" required>
                            <option value="">Select Staff</option>
                            <?php
                            $sqlStaff = "SELECT * FROM tbl_employee";
                            $rsStaff = $conn->query($sqlStaff);
                            if ($rsStaff->num_rows > 0) {
                                while ($rowStaff = $rsStaff->fetch_assoc()) {
                            ?>
                                <option value="<?= $rowStaff['employee_id'] ?>"><?= $rowStaff['employee_name'] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Edit Booking</button>
                </form>

                  <hr>
                </div>

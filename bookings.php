<?php include("layout/header.php"); ?>

        <!-- Start::app-content -->
        <div class="main-content app-content">
            <div class="container-fluid">

                <!-- Page Header -->
                <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                    <div class="">
                        <h1 class="page-title fw-semibold fs-20 mb-0">Booking Managment</h1>
                        <div class="">
                            <nav>
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Booking Managment</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- Page Header Close -->
                <div class="row">
                    <div class="col-lg-6">
                        <div class="row">
                          <div class="col-lg-4">
                            <button class="btn btn-primary btn-sm" type="button" onclick="openBookingModal()">
                                <i class="bi bi-calendar fs-5"></i> Make Booking
                            </button>

                          </div>
                            <div class="col-lg-4">
                              <button class="btn btn-success btn-sm" type="button" onclick="window.location.href='addCustomer.php'">
                                  <i class="bi bi-person fs-5"></i> Add Customer
                              </button>

                            </div>
                            <div class="col-lg-4">
                                <button class="btn btn-warning btn-SM" onclick="window.location.href='addVehicle.php'" type="button">
                                  <i class="bi bi-truck fs-5"></i> Add Vehicle
                                </button>
                            </div>
                        </div>
                    </div>
                </div> <br>


                <div class="card">
    <div class="card-body">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h5>Manage Booking</h5>
                    <hr>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Vehicle</th>
                                <th>Services</th>
                                <th>Total Bill Amount</th>
                                <th>Estimated Completion</th>
                                <th>Booked Time</th>
                                <th>Staff</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Fetch all bookings
                            $sql = "SELECT
                                        b.booking_id,
                                        c.customer_name,
                                        v.vehicle_type,
                                        v.number_plate,
                                        e.employee_name,
                                        b.start_date,
                                        b.status,
                                        SUM(bs.price) AS total_bill,
                                        SUM(bs.estimated_duration) AS total_days
                                    FROM
                                        tbl_booking b
                                    JOIN customer c ON b.customer_id = c.customer_id
                                    JOIN vehicle v ON b.vehicle_id = v.vehicle_id
                                    LEFT JOIN tbl_employee e ON b.employee_id = e.employee_id
                                    LEFT JOIN booked_services bs ON b.booking_id = bs.booking_id
                                    GROUP BY b.booking_id";

                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $booking_id = $row['booking_id'];

                                    // Fetch services for this booking
                                    $serviceQuery = "SELECT s.service_name FROM booked_services bs
                                                     JOIN tbl_service s ON bs.service_id = s.ser_id
                                                     WHERE bs.booking_id = ?";
                                    $serviceStmt = $conn->prepare($serviceQuery);
                                    $serviceStmt->bind_param("i", $booking_id);
                                    $serviceStmt->execute();
                                    $servicesResult = $serviceStmt->get_result();
                                    $services = [];
                                    while ($serviceRow = $servicesResult->fetch_assoc()) {
                                        $services[] = $serviceRow['service_name'];
                                    }
                                    $servicesList = implode(", ", $services);

                                    // Calculate estimated completion
                                    $total_days = (int) $row['total_days'];
                                    $start_date = $row['start_date'];
                                    $completion_date = date('Y-m-d', strtotime("$start_date + $total_days days"));
                                    $estimated_completion = "$total_days days from $start_date ($completion_date)";

                                    // Determine status
                                    $status = match ($row['status']) {
                                        1 => "Pending",
                                        2 => "In Progress",
                                        3 => "Completed",
                                        default => "Unknown",
                                    };
                            ?>
                            <tr>
                                <td><?= htmlspecialchars($row['customer_name']) ?></td>
                                <td><?= htmlspecialchars($row['vehicle_type'] . " (" . $row['number_plate'] . ")") ?></td>
                                <td><?= htmlspecialchars($servicesList) ?></td>
                                <td>LKR <?= number_format($row['total_bill'], 2) ?></td>
                                <td><?= htmlspecialchars($estimated_completion) ?></td>
                                <td><?= htmlspecialchars($start_date) ?></td>
                                <td><?= htmlspecialchars($row['employee_name']) ?></td>
                                <td><?= htmlspecialchars($status) ?></td>
                                <td>
                                    <a href="edit_booking.php?id=<?= $booking_id ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="delete_booking.php?id=<?= $booking_id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this booking?');">Delete</a>
                                </td>
                            </tr>
                            <?php
                                }
                            } else {
                            ?>
                            <tr>
                                <td colspan="9">No bookings found.</td>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>





            </div>
        </div>
        <!-- End::app-content -->

        <div class="modal fade" id="BookingModal" tabindex="-1" aria-labelledby="searchModal" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content" id="addCustomerForm">
                <div class="container">
                  <hr>
                  <h6>Make a Booking</h6>
                  <hr>
                  <form class="" action="backend/make_booking.php" method="post">
    <div class="form-group">
        <label for="customer_id">Customer</label>
        <select class="form-control" name="customer_id" onchange="showVehicles(this.value)" required>
            <option value="">Select Customer</option>
            <?php
            $sql = "SELECT * FROM customer";
            $rs = $conn->query($sql);
            if ($rs->num_rows > 0) {
                while ($row = $rs->fetch_assoc()) {
            ?>
                <option value="<?= $row['customer_id'] ?>"><?= $row['customer_name'] ?></option>
            <?php
                }
            }
            ?>
        </select>
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
            $sqlSer = "SELECT * FROM tbl_service";
            $rsSer = $conn->query($sqlSer);
            if ($rsSer->num_rows > 0) {
                while ($rowSer = $rsSer->fetch_assoc()) {
            ?>
                <div class="col-md-6">
                    <div class="form-check">
                        <input type="checkbox" style="width:20px;height:20px;" class="form-check-input" id="service<?= $rowSer['ser_id'] ?>" name="services[<?= $rowSer['ser_id'] ?>][id]" value="<?= $rowSer['ser_id'] ?>">
                        &nbsp; || <label class="form-check-label" for="service<?= $rowSer['ser_id'] ?>" style="font-size:15px;font-weight:bold;"><?= $rowSer['service_name'] ?></label>
                    </div>
                    <div class="form-group mt-2">
                        <label for="price">Price</label>
                        <input type="number" step="0.01" class="form-control" name="services[<?= $rowSer['ser_id'] ?>][price]" value="<?= $rowSer['price'] ?>" placeholder="Enter Price">
                    </div>
                    <div class="form-group mt-2">
                        <label for="duration">Estimated Duration (in minutes)</label>
                        <input type="number" class="form-control" name="services[<?= $rowSer['ser_id'] ?>][duration]" placeholder="Enter Duration">
                    </div>
                    <hr>
                </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
    <br>
    <div class="form-group">
        <label for="">Estimated Date To Complete</label>
        <input type="datetime-local" class="form-control" name="date_time_to_complete" value="" required>
    </div>
    <br>
    <div class="form-group">
        <label for="">Booked Date & Time</label>
        <input type="datetime-local" class="form-control" name="booked_datetime" value="" required>
    </div>
    <br>
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
    <button type="submit" class="btn btn-primary">Make Booking</button>
</form>

                  <hr>
                </div>
              </div>
            </div>
        </div>
        <?php include("layout/footer.php"); ?>

<script type="text/javascript">
  function openBookingModal(){
    $('#BookingModal').modal('show');
  }

  function showVehicles(cus_id){
    $('#showVehicles').load('ajax/loadVehicles.php', {
        c_id: cus_id
    });
  }

</script>

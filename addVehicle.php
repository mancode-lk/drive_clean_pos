<?php include("layout/header.php"); ?>

        <!-- Start::app-content -->
        <div class="main-content app-content">
            <div class="container-fluid">

                <!-- Page Header -->
                <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                    <div class="">
                        <h1 class="page-title fw-semibold fs-20 mb-0">Add Vehicle</h1>
                        <div class="">
                            <nav>
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="bookings.php">Booking Managment</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add Vehicle</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- Page Header Close -->
                <div class="row">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-6">
                              <button class="btn btn-success btn-sm" type="button" onclick="window.location.href='addCustomer.php'">
                                  <i class="bi bi-person fs-5"></i> Add Customer
                              </button>

                            </div>
                            <div class="col-lg-6">
                                <button class="btn btn-primary btn-SM" onclick="window.location.href='bookings.php'" type="button">
                                  <i class="bi bi-calendar fs-5"></i> Booking
                                </button>
                            </div>
                        </div>
                    </div>
                </div> <br>
                <br>

                <div class="card">
                  <div class="card-body">
                    <div class="container">
                      <div class="row">
                        <div class="col-4">
                          <h5>Add Vehicle</h5>
                          <form action="backend/add_vehicle.php" method="post" enctype="multipart/form-data">
                            <!-- Customer ID -->
                            <div class="form-group">
                                <label for="customer_id">Customer</label>
                                <select class="form-control select2" name="customer_id">
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

                            </div>

                            <!-- Vehicle Type -->
                            <div class="form-group">
                                <label for="vehicle_type">Vehicle Type</label>
                                <input type="text" class="form-control" id="vehicle_type" name="vehicle_type" placeholder="Enter Vehicle Type (e.g., Car, Truck)" required>
                            </div>

                            <!-- Number Plate -->
                            <div class="form-group">
                                <label for="number_plate">Number Plate</label>
                                <input type="text" class="form-control" id="number_plate" name="number_plate" placeholder="Enter Number Plate" required>
                            </div>

                            <!-- Description -->
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" placeholder="Enter Description" rows="3" required></textarea>
                            </div>
 <hr>
                            <!-- Vehicle Image -->
                            <div class="form-group">
                                <label for="vehicle_image">Vehicle Image (Optional)</label>
                                <input type="file" class="form-control-file" id="vehicle_image" name="vehicle_image" accept="image/*">
                            </div>

                            <br>
                            <button type="submit" class="btn btn-primary btn-sm">Add Booking</button>
                        </form>

                        </div>
                        <div class="col-8">
    <h5>Manage Vehicle</h5>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Customer</th>
                <th>Vehicle Type</th>
                <th>Number Plate</th>
                <th>Description</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
    <?php
    $sql = "SELECT v.vehicle_id, v.customer_id, c.customer_name, v.vehicle_type, v.number_plate, v.description, v.vehicle_image
        FROM vehicle v
        LEFT JOIN customer c ON v.customer_id = c.customer_id";

    $rs = $conn->query($sql);
    if ($rs->num_rows > 0) {
        $count = 1;
        while ($row = $rs->fetch_assoc()) {
    ?>
        <tr>
            <td><?= $count++ ?></td>
            <td><?= htmlspecialchars($row['customer_name']) ?></td>
            <td><?= htmlspecialchars($row['vehicle_type']) ?></td>
            <td><?= htmlspecialchars($row['number_plate']) ?></td>
            <td><?= htmlspecialchars($row['description']) ?></td>
            <td>
                <?php if (!empty($row['vehicle_image'])) { ?>
                    <a href="uploads/vehicles/<?= $row['vehicle_image'] ?>" data-lightbox="vehicle-gallery" data-title="<?= htmlspecialchars($row['vehicle_type']) ?>">
                        <img src="uploads/vehicles/<?= $row['vehicle_image'] ?>" alt="Vehicle Image" style="width: 100px; height: auto; border: 1px solid #ddd; border-radius: 5px;">
                    </a>
                <?php } else { ?>
                    No Image
                <?php } ?>
            </td>
            <td>
                <!-- Edit Button -->
                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['vehicle_id'] ?>">
                    <i class="bi bi-pencil-square"></i> Edit
                </button>

                <!-- Delete Button -->
                <a href="backend/delete_vehicle.php?id=<?= $row['vehicle_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this vehicle?');">
                    <i class="bi bi-trash"></i> Delete
                </a>
            </td>
        </tr>

        <!-- Edit Modal -->
        <div class="modal fade" id="editModal<?= $row['vehicle_id'] ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="backend/edit_vehicle.php" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Vehicle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Hidden Input for Vehicle ID -->
                    <input type="hidden" name="vehicle_id" value="<?= $row['vehicle_id'] ?>">

                    <!-- Customer Select Field -->
                    <div class="form-group">
                        <label for="customer_id">Customer</label>
                        <select class="form-control" name="customer_id" required>
    <option value="">Select Customer</option>
    <?php
    $sqlCus = "SELECT * FROM customer";
    $rsCus = $conn->query($sqlCus);

    // Check if the query returned any rows
    if ($rsCus->num_rows > 0) {
        while ($rowCus = $rsCus->fetch_assoc()) {
            $selected = ($rowCus['customer_id'] == $row['customer_id']) ? "selected" : "";
            echo "<option value='{$rowCus['customer_id']}' $selected>{$rowCus['customer_name']}</option>";
        }
    } else {
        echo "<option value=''>No Customers Found</option>";
    }
    ?>
</select>
                    </div>

                    <!-- Vehicle Type -->
                    <div class="form-group">
                        <label for="vehicle_type">Vehicle Type</label>
                        <input type="text" class="form-control" name="vehicle_type" value="<?= htmlspecialchars($row['vehicle_type']) ?>" required>
                    </div>

                    <!-- Number Plate -->
                    <div class="form-group">
                        <label for="number_plate">Number Plate</label>
                        <input type="text" class="form-control" name="number_plate" value="<?= htmlspecialchars($row['number_plate']) ?>" required>
                    </div>

                    <!-- Description -->
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" rows="3" required><?= htmlspecialchars($row['description']) ?></textarea>
                    </div>

                    <!-- Vehicle Image -->
                    <div class="form-group">
                        <label for="vehicle_image">Vehicle Image (Optional)</label>
                        <input type="file" class="form-control-file" name="vehicle_image" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>



    <?php
        }
    } else {
    ?>
        <tr>
            <td colspan="7">No vehicles found.</td>
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

        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModal" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">

              </div>
            </div>
        </div>
        <?php include("layout/footer.php"); ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>

        <!-- Include Select2 CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

        <!-- Include Select2 JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

        <script>
    $(document).ready(function () {
        // Initialize Select2 for all elements with the "select2" class
        $('.select2').select2({
            placeholder: "Select Customer",
            allowClear: true
        });

    });
</script>

<?php include("layout/header.php"); ?>

        <!-- Start::app-content -->
        <div class="main-content app-content">
            <div class="container-fluid">

                <!-- Page Header -->
                <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                    <div class="">
                        <h1 class="page-title fw-semibold fs-20 mb-0">Service Managment</h1>
                        <div class="">
                            <nav>
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Service Managment</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- Page Header Close -->
                 <?php
                 if(isset($_SESSION['Service_added_success'])){
                    ?>


                <div class="alert alert-success" role="alert">
                Service added Successfully
                </div>

                <?php
                unset($_SESSION['Service_added_success']);
                 }
                 ?>


                 <?php
                 if(isset($_SESSION['Service_added_error'])){
                    ?>


                <div class="alert alert-warning" role="alert">
                Something went wrong!!!
                </div>

                <?php
                unset($_SESSION['Service_added_error']);
                 }
                 ?>


                <div class="card">
                  <div class="card-body">
                    <div class="container">
                      <div class="row">
                        <div class="col-6">
                          <h5>Add Service</h5>
                          <form action="backend/add_service.php" method="post">
                            <div class="form-group">
                              <label for="serName">Service Name</label>
                              <input type="text" id="serName" name="serName" class="form-control" required>
                            </div>
                            <div class="form-group">
                              <label for="description">Description</label>
                              <textarea name="description" class="form-control" id="description" rows="4" cols="80"></textarea>
                            </div>
                            <div class="form-group">
                              <label for="icon">Icon Image</label>
                              <select id="icon" name="icon" class="form-control" required>
                                <option value="">Select Icon</option>
                                <option value="bi bi-droplet fs-1">Car Wash</option>
                                <option value="bi bi-tools fs-1">Repair</option>
                                <option value="bi bi-fuel-pump fs-1">Fuel Service</option>
                                <option value="bi bi-speedometer fs-1">Oil Change</option>
                                <option value="bi bi-battery-charging fs-1">Battery Service</option>
                                <option value="bi bi-tire fs-1">Tire Change</option>
                                <option value="bi bi-wrench fs-1">Engine Tune-Up</option>
                                <option value="bi bi-snow fs-1">Air Conditioning Service</option>
                                <option value="bi bi-clipboard-check fs-1">Inspection</option>
                                <option value="bi bi-lightning fs-1">Electrical Repairs</option>
                                <option value="bi bi-camera-video fs-1">Camera Calibration</option>
                                <option value="bi bi-wind fs-1">Windshield Cleaning</option>
                                <option value="bi bi-circle fs-1">Alignment</option>
                                <option value="bi bi-brightness-high fs-1">Headlight Polishing</option>
                                <option value="bi bi-shield-check fs-1">Safety Check</option>
                                <option value="bi bi-airplane fs-1">Vehicle Shipping</option>
                                <option value="bi bi-truck fs-1">Heavy Vehicle Service</option>
                                <option value="bi bi-car-front fs-1">Interior Detailing</option>
                                <option value="bi bi-box-arrow-in-down fs-1">Parts Replacement</option>
                                <option value="bi bi-check-circle fs-1">Emissions Testing</option>
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="price">Price</label>
                              <input type="text" id="price" name="price" class="form-control" required>
                            </div>
                            <div class="form-group">
                              <label for="wcuText">WCU text</label>
                              <textarea name="wcuText" class="form-control" id="wcuText" rows="4" cols="80"></textarea>
                            </div>
                            <div class="form-group">
                              <label for="heading">Heading</label>
                              <input type="text" id="heading" name="heading" class="form-control" required>
                            </div>
                            <div class="form-group">
                              <label for="subHeading">Sub Heading</label>
                              <input type="text" id="subHeading" name="subHeading" class="form-control" required>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary btn-sm">Add Service</button>
                          </form>
                        </div>
                        <div class="col-6">
                          <h5>Manage Service</h5>
                          <div id="loadService">

                          </div>

                        </div>
                      </div>
                    </div>

                  </div>
                </div>



            </div>
        </div>
        <!-- End::app-content -->

        <div class="modal fade" id="serviceEditModal" tabindex="-1" aria-labelledby="searchModal" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content" id="loadserviceForm">

              </div>
            </div>
        </div>
        <?php include("layout/footer.php"); ?>
        <script type="text/javascript">
        $('#loadService').load('ajax/loadservice.php');


        function openserviceEditModal(id){
          $('#serviceEditModal').modal('show');
          $('#loadserviceForm').load('ajax/loadEditserviceForm.php',{
            ser_id:id
          });
        }

        function removeservice(id) {
          if (confirm('Are you sure you want to delete the service?')) { // Fixed syntax
            $.ajax({
              url: 'backend/deleteservice.php',
              method: 'POST', // Use uppercase for consistency
              data: {
                ser_id: id
              },
              success: function(resp) {
                if (resp == 200) {
                  $('#loadService').load('ajax/loadservice.php');
                } else {
                  alert('Failed to delete the service. Please try again.');
                }
              },
              error: function() {
                alert('An error occurred while processing the request.');
              }
            });
          }
        }


        </script>

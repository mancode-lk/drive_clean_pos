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
                        <div class="col-4">
                          <h5>Add Service</h5>
                          <form action="backend/add_service.php" method="post">
                            <div class="form-group">
                              <label for="serName">Service Name</label>
                              <input type="text" id="serName" name="serName" class="form-control" required>
                            </div>
                            <div class="form-group">
                              <label for="description">Description</label>
                              <input type="text" id="description" name="description" class="form-control" required>
                            </div>
                            <div class="form-group">
                              <label for="icon">Icon Image</label>
                              <select id="icon" name="icon" class="form-control" required>
                                <option value="">Select Icon</option>
                                <option value="1">image1</option>
                                <option value="2">image2</option>
                                <option value="3">image3</option>
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="price">Price</label>
                              <input type="text" id="price" name="price" class="form-control" required>
                            </div>
                            <div class="form-group">
                              <label for="wcuText">WCU text</label>
                              <input type="text" id="wcuText" name="wcuText" class="form-control" required>
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
                        <div class="col-8">
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

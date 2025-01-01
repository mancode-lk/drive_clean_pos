
<?php include("layout/header.php"); ?>

        <!-- Start::app-content -->
        <div class="main-content app-content">
            <div class="container-fluid">

                <!-- Page Header -->
                <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                    <div class="">
                        <h1 class="page-title fw-semibold fs-20 mb-0">Customer Managment</h1>
                        <div class="">
                            <nav>
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Customer Managment</li>
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
                                <button class="btn btn-primary btn-small" type="button" onclick="window.location.href='addVehicle.php'">Add Vehicle</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                 if(isset($_SESSION['customer_added_success'])){
                    ?>
                    

                <div class="alert alert-success" role="alert">
                Customer added Successfully
                </div>

                <?php
                unset($_SESSION['customer_added_success']);
                 } 
                 ?>


                 <?php 
                 if(isset($_SESSION['customer_added_error'])){
                    ?>
                    

                <div class="alert alert-warning" role="alert">
                Something went wrong!!!
                </div>

                <?php
                unset($_SESSION['customer_added_error']);
                 } 
                 ?>


                <div class="card">
    <div class="card-body">
        <div class="container">
            <div class="row">
                <!-- Add Customer Section -->
                <div class="col-4">
                    <h5>Add Customer</h5>
                    <form action="backend/add_customer.php" method="post">
                        <div class="form-group">
                            <label for="customerName">Customer Name</label>
                            <input type="text" id="customerName" name="customerName" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="contactNo">Contact No</label>
                            <input type="text" id="contactNo" name="contactNo" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" id="address" name="address" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" id="city" name="city" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="idNum">ID Number</label>
                            <input type="text" id="idNum" name="idNum" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm mt-3">Add Customer</button>
                    </form>
                </div>

                <!-- Manage Booking Section -->
                <div class="col-8">
                    <h5>Manage Customer</h5>
                    <div id="loadCustomer">
                        <!-- Dynamic booking content will be loaded here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




            </div>
        </div>
        <!-- End::app-content -->

        <div class="modal fade" id="cutomerEditModal" tabindex="-1" aria-labelledby="searchModal" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content" id="loadCustomerForm">

              </div>
            </div>
        </div>
        <?php include("layout/footer.php"); ?>
        <script type="text/javascript">
        $('#loadCustomer').load('ajax/loadCustomer.php');
        

        function openCustomerEditModal(id){
          $('#cutomerEditModal').modal('show');
          $('#loadCustomerForm').load('ajax/loadEditCustomerForm.php',{
            c_id:id
          });
        }

        function removeCustomer(id) {
          if (confirm('Are you sure you want to delete the Customer?')) { // Fixed syntax
            $.ajax({
              url: 'backend/deleteCustomer.php',
              method: 'POST', // Use uppercase for consistency
              data: {
                c_id: id
              },
              success: function(resp) {
                if (resp == 200) {
                    $('#loadCustomer').load('ajax/loadCustomer.php');
                } else {
                  alert('Failed to delete the Customer. Please try again.');
                }
              },
              error: function() {
                alert('An error occurred while processing the request.');
              }
            });
          }
        }


        </script>


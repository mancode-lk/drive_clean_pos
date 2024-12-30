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
                            <div class="col-lg-6">
                            <button class="btn btn-primary btn-small" type="button" onclick="window.location.href='addCustomer.php'">Add Customer</button>

                            </div>
                            <div class="col-lg-6">
                                <button class="btn btn-primary btn-small" type="button">Add Vehicle</button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card">
                  <div class="card-body">
                    <div class="container">
                      <div class="row">
                        <div class="col-4">
                          <h5>Add Booking</h5>
                          <form action="backend/add_booking.php" method="post">
                            
                            <br>
                            <button type="submit" class="btn btn-primary btn-sm">Add Booking</button>
                          </form>
                        </div>
                        <div class="col-8">
                          <h5>Manage Booking</h5>
                          <div id="loadBooking">

                          </div>

                        </div>
                      </div>
                    </div>

                  </div>
                </div>



            </div>
        </div>
        <!-- End::app-content -->

        <div class="modal fade" id="addCustomer" tabindex="-1" aria-labelledby="searchModal" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content" id="addCustomerForm">

              </div>
            </div>
        </div>
        <?php include("layout/footer.php"); ?>
        <script type="text/javascript">
        $('#loadBooking').load('ajax/loadBooking.php');

        function openModalAddCustomer(){
            $('#addCustomer').modal('show');
            $('#addCustomerForm').load('ajax/addCustomerForm.php');
        }
        

        function openBookingEditModal(id){
          $('#bookingEditModal').modal('show');
          $('#loadBookingForm').load('ajax/loadEditBookingForm.php',{
            emp_id:id
          });
        }

        function removeBooking(id) {
          if (confirm('Are you sure you want to delete the Booking?')) { // Fixed syntax
            $.ajax({
              url: 'backend/deleteBooking.php',
              method: 'POST', // Use uppercase for consistency
              data: {
                emp_id: id
              },
              success: function(resp) {
                if (resp == 200) {
                  $('#loadBooking').load('ajax/loadBooking.php');
                } else {
                  alert('Failed to delete the Booking. Please try again.');
                }
              },
              error: function() {
                alert('An error occurred while processing the request.');
              }
            });
          }
        }


        </script>

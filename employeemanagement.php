<?php include("layout/header.php"); ?>

        <!-- Start::app-content -->
        <div class="main-content app-content">
            <div class="container-fluid">

                <!-- Page Header -->
                <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                    <div class="">
                        <h1 class="page-title fw-semibold fs-20 mb-0">Employee Managment</h1>
                        <div class="">
                            <nav>
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Employee Managment</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- Page Header Close -->
                 <?php 
                 if(isset($_SESSION['employee_added_success'])){
                    ?>
                    

                <div class="alert alert-success" role="alert">
                Employee added Successfully
                </div>

                <?php
                unset($_SESSION['employee_added_success']);
                 } 
                 ?>


                 <?php 
                 if(isset($_SESSION['employee_added_error'])){
                    ?>
                    

                <div class="alert alert-warning" role="alert">
                Something went wrong!!!
                </div>

                <?php
                unset($_SESSION['employee_added_error']);
                 } 
                 ?>


                <div class="card">
                  <div class="card-body">
                    <div class="container">
                      <div class="row">
                        <div class="col-4">
                          <h5>Add Employee</h5>
                          <form action="backend/add_employee.php" method="post">
                            <div class="form-group">
                              <label for="empname">Employee Name</label>
                              <input type="text" id="empname" name="empname" class="form-control" required>
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
                              <label for="role">Role</label>
                              <input type="text" id="role" name="role" class="form-control" required>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary btn-sm">Add Employee</button>
                          </form>
                        </div>
                        <div class="col-8">
                          <h5>Manage Employee</h5>
                          <div id="loadEmployee">

                          </div>

                        </div>
                      </div>
                    </div>

                  </div>
                </div>



            </div>
        </div>
        <!-- End::app-content -->

        <div class="modal fade" id="employeeEditModal" tabindex="-1" aria-labelledby="searchModal" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content" id="loadEmployeeForm">

              </div>
            </div>
        </div>
        <?php include("layout/footer.php"); ?>
        <script type="text/javascript">
        $('#loadEmployee').load('ajax/loadEmployee.php');
        

        function openemployeeEditModal(id){
          $('#employeeEditModal').modal('show');
          $('#loadEmployeeForm').load('ajax/loadEditEmployeeForm.php',{
            emp_id:id
          });
        }

        function removeEmployee(id) {
          if (confirm('Are you sure you want to delete the employee?')) { // Fixed syntax
            $.ajax({
              url: 'backend/deleteEmployee.php',
              method: 'POST', // Use uppercase for consistency
              data: {
                emp_id: id
              },
              success: function(resp) {
                if (resp == 200) {
                  $('#loadEmployee').load('ajax/loadEmployee.php');
                } else {
                  alert('Failed to delete the employee. Please try again.');
                }
              },
              error: function() {
                alert('An error occurred while processing the request.');
              }
            });
          }
        }


        </script>

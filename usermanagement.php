<?php include("layout/header.php"); ?>

        <!-- Start::app-content -->
        <div class="main-content app-content">
            <div class="container-fluid">

                <!-- Page Header -->
                <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                    <div class="">
                        <h1 class="page-title fw-semibold fs-20 mb-0">User Managment</h1>
                        <div class="">
                            <nav>
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">User Managment</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- Page Header Close -->
                <div class="card">
                  <div class="card-body">
                    <div class="container">
                      <div class="row">
                        <div class="col-4">
                          <h5>Add Users</h5>
                          <form action="backend/add_user.php" method="post">
                            <div class="form-group">
                              <label for="username">User Name</label>
                              <input type="text" id="username" name="username" class="form-control" required>
                            </div>
                            <div class="form-group">
                              <label for="password">Password</label>
                              <input type="password" id="password" name="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                              <label for="role">Role</label>
                              <select id="role" name="role" class="form-control" required>
                                <option value="">Select Role</option>
                                <option value="1">Admin</option>
                                <option value="2">Staff</option>
                                <option value="3">Viewer</option>
                              </select>
                            </div> <br>
                            <button type="submit" class="btn btn-primary btn-sm">Add User</button>
                          </form>
                        </div>
                        <div class="col-8">
                          <h5>Manage Users</h5>
                          <div id="loadUsers">

                          </div>

                        </div>
                      </div>
                    </div>

                  </div>
                </div>



            </div>
        </div>
        <!-- End::app-content -->

        <div class="modal fade" id="userEditModal" tabindex="-1" aria-labelledby="searchModal" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content" id="loadUserForm">

              </div>
            </div>
        </div>
        <?php include("layout/footer.php"); ?>
        <script type="text/javascript">
        $('#loadUsers').load('ajax/loadUsers.php');

        function openuserEditModal(id){
          $('#userEditModal').modal('show');
          $('#loadUserForm').load('ajax/loadEditUserForm.php',{
            user_id:id
          });
        }

        function removeUser(id) {
          if (confirm('Are you sure you want to delete the user?')) { // Fixed syntax
            $.ajax({
              url: 'backend/deleteUser.php',
              method: 'POST', // Use uppercase for consistency
              data: {
                user_id: id
              },
              success: function(resp) {
                if (resp == 200) {
                  $('#loadUsers').load('ajax/loadUsers.php');
                } else {
                  alert('Failed to delete the user. Please try again.');
                }
              },
              error: function() {
                alert('An error occurred while processing the request.');
              }
            });
          }
        }

        </script>

<?php include("layout/header.php"); ?>

        <!-- Start::app-content -->
        <div class="main-content app-content">
            <div class="container-fluid">

                <!-- Page Header -->
                <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                    <div class="">
                        <h1 class="page-title fw-semibold fs-20 mb-0">Web Managment</h1>
                        <div class="">
                            <nav>
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Web Managment</li>
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
                          <h5>Web Management</h5>
                          <form action="backend/add_web.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                              <label for="label">Label</label>
                              <input type="text" id="label" name="label" class="form-control" required>
                            </div>
                            <div class="form-group">
                              <label for="mobImage">Mobile Image</label>
                              <input type="file" id="mobImage" name="mobImage" class="form-control" required>
                            </div>
                            <div class="form-group">
                              <label for="deskImage">Desktop Image</label>
                              <input type="file" id="deskImage" name="deskImage" class="form-control" required>
                            </div>
                            
                            <br>
                            <button type="submit" class="btn btn-primary btn-sm">Change</button>
                          </form>
                        </div>
                        <div class="col-8">
                        <h5>Manage Web</h5>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Label</th>
                <th>Mobile Image</th>
                <th>Desktop Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
    <?php
    $sql = "SELECT * FROM website";

    $rs = $conn->query($sql);
    if ($rs->num_rows > 0) {
        $count = 1;
        while ($row = $rs->fetch_assoc()) {
    ?>
        <tr>
            <td><?= $count++ ?></td>
            <td><?= htmlspecialchars($row['label']) ?></td>
            <td>
                <?php if (!empty($row['mobile_image'])) { ?>
                    <a href="assets/website/mobile/<?= $row['mobile_image'] ?>" data-lightbox="vehicle-gallery" >
                        <img src="assets/website/mobile/<?= $row['mobile_image'] ?>" alt="Mobile Image" style="width: 20px; height: auto; border: 1px solid #ddd; border-radius: 5px;">
                    </a>
                <?php } else { ?>
                    No Image
                <?php } ?>
            </td>
            <td>
                <?php if (!empty($row['desktop_image'])) { ?>
                    <a href="assets/website/desktop/<?= $row['desktop_image'] ?>" data-lightbox="vehicle-gallery" >
                        <img src="assets/website/desktop/<?= $row['desktop_image'] ?>" alt="Desktop Image" style="width: 20px; height: auto; border: 1px solid #ddd; border-radius: 5px;">
                    </a>
                <?php } else { ?>
                    No Image
                <?php } ?>
            </td>
            <td>
                <!-- Edit Button -->
                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['web_id'] ?>">
                    <i class="bi bi-pencil-square"></i> Edit
                </button>

                <!-- Delete Button -->
                <a href="backend/delete_label.php?id=<?= $row['web_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this label?');">
                    <i class="bi bi-trash"></i> Delete
                </a>
            </td>
        </tr>

        <div class="modal fade" id="editModal<?= $row['web_id'] ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="backend/edit_label.php" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Web</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Hidden Input for label -->
                    <input type="hidden" name="web_id" value="<?= $row['web_id'] ?>">

                   
                

                    <!-- Label -->
                    <div class="form-group">
                        <label for="vehicle_type">Label</label>
                        <input type="text" class="form-control" name="label" value="<?= htmlspecialchars($row['label']) ?>" required>
                    </div>

                   

                    <!-- mobile Image -->
                    <div class="form-group">
                        <label for="mobImage">Mobile Image</label>
                        <input type="file" class="form-control-file" name="mobImage" class="form-control" accept="image/*">
                    </div>

                    <!-- Desktop Image -->
                    <div class="form-group">
                        <label for="deskImage">Desktop Image</label>
                        <input type="file" class="form-control-file" name="deskImage" class="form-control" accept="image/*">
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
            <td colspan="7">No Labels found.</td>
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
        </div>
        <!-- End::app-content -->

        <!-- <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="searchModal" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content" id="loadEmployeeForm">

              </div>
            </div>
        </div> -->
        <?php include("layout/footer.php"); ?>
        <script type="text/javascript">
        $('#loadWeb').load('ajax/loadWeb.php');
        

        // function openemployeeEditModal(id){
        //   $('#employeeEditModal').modal('show');
        //   $('#loadEmployeeForm').load('ajax/loadEditEmployeeForm.php',{
        //     emp_id:id
        //   });
        // }

        // function removeEmployee(id) {
        //   if (confirm('Are you sure you want to delete the employee?')) { // Fixed syntax
        //     $.ajax({
        //       url: 'backend/deleteEmployee.php',
        //       method: 'POST', // Use uppercase for consistency
        //       data: {
        //         emp_id: id
        //       },
        //       success: function(resp) {
        //         if (resp == 200) {
        //           $('#loadEmployee').load('ajax/loadEmployee.php');
        //         } else {
        //           alert('Failed to delete the employee. Please try again.');
        //         }
        //       },
        //       error: function() {
        //         alert('An error occurred while processing the request.');
        //       }
        //     });
        //   }
        // }


        </script>

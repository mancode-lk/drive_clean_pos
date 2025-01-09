<?php
include("layout/header.php");
?>

<!-- Start::app-content -->
<div class="main-content app-content">
    <div class="container-fluid">

        <!-- Page Header -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <div>
                <h1 class="page-title fw-semibold fs-20 mb-0"><?= $pageTitle ?? 'Web Management' ?></h1>
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Web Management</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Page Header Close -->

        <!-- Alerts -->
        <?php if (!empty($_SESSION['alerts'])): ?>
            <?php foreach ($_SESSION['alerts'] as $alert): ?>
                <div class="alert alert-<?= $alert['type'] ?>" role="alert">
                    <?= htmlspecialchars($alert['message']) ?>
                </div>
            <?php endforeach; unset($_SESSION['alerts']); ?>
        <?php endif; ?>

        <!-- Web Management Card -->
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <!-- Add/Edit Form -->
                    <div class="col-4">
                        <h5>Web Management</h5>
                        <form action="backend/manage_web.php" method="post" enctype="multipart/form-data">
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
                            <button type="submit" class="btn btn-primary btn-sm">Save</button>
                        </form>
                    </div>

                    <!-- Manage Web Table -->
                    <div class="col-8">
                        <h5>Manage Web</h5>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Label</th>
                                    <th>Mobile Image</th>
                                    <th>Desktop Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $result = $conn->query("SELECT * FROM website");
                                if ($result->num_rows > 0):
                                    $count = 1;
                                    while ($row = $result->fetch_assoc()):
                                ?>
                                    <tr>
                                        <td><?= $count++ ?></td>
                                        <td><?= htmlspecialchars($row['label']) ?></td>
                                        <td>
                                            <?php if ($row['mobile_image']): ?>
                                                <img src="assets/website/mobile/<?= $row['mobile_image'] ?>" alt="Mobile" style="width: 50px;">
                                            <?php else: ?>
                                                No Image
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($row['desktop_image']): ?>
                                                <img src="assets/website/desktop/<?= $row['desktop_image'] ?>" alt="Desktop" style="width: 50px;">
                                            <?php else: ?>
                                                No Image
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="edit.php?id=<?= $row['web_id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="delete.php?id=<?= $row['web_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">Delete</a>
                                        </td>
                                    </tr>
                                <?php endwhile; else: ?>
                                    <tr>
                                        <td colspan="5">No records found</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <br><br>
        <div class="card mt-4">
    <div class="card-body">
        <h5>Manage Sections</h5>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Section Name</th>
                    <th>Content</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
          
        </table>
    </div>
</div>

    </div>
</div>
<!-- End::app-content -->

<?php include("layout/footer.php"); ?>

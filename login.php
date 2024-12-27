<?php
include 'backend/conn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=no'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login - Drive Clean POS</title>
    <meta name="Description" content="Login page for Drive Clean POS System">
    <meta name="Author" content="Spruko Technologies Private Limited">
    <meta name="keywords" content="Drive Clean POS, POS login, admin panel, clean interface">

    <!-- Favicon -->
    <link rel="icon" href="assets/images/brand-logos/favicon.ico" type="image/x-icon">

    <!-- Libraries -->
    <link href="assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/styles.min.css" rel="stylesheet">
    <link href="assets/css/icons.css" rel="stylesheet">
    <link href="assets/libs/node-waves/waves.min.css" rel="stylesheet">
    <link href="assets/libs/simplebar/simplebar.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/libs/choices.js/public/assets/styles/choices.min.css">
    <link rel="stylesheet" href="assets/css/master.css">

</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1>Drive Clean POS</h1>
            <p>Your Comprehensive Point of Sale System</p>
        </div>
        <form action="backend/login.php" method="post" class="login-form">
            <div class="form-group">
                <label for="username">
                    <i class="icon fas fa-user"></i>Username
                </label>
                <input type="text" name="email" id="username" class="form-control" placeholder="Enter your username" required>
            </div>
            <div class="form-group">
                <label for="password">
                    <i class="icon fas fa-lock"></i>Password
                </label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
            </div>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </div>
        </form>
        <p class="footer-text">© 2024 Drive Clean POS. All rights reserved.</p>
    </div>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>

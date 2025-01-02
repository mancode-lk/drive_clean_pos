<?php
  include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vehicle_id = $_POST['vehicle_id'];
    $customer_id = $_POST['customer_id'];
    $vehicle_type = $_POST['vehicle_type'];
    $number_plate = $_POST['number_plate'];
    $description = $_POST['description'];
    $vehicle_image = null;

    if (isset($_FILES['vehicle_image']) && $_FILES['vehicle_image']['error'] === UPLOAD_ERR_OK) {
        $image_tmp = $_FILES['vehicle_image']['tmp_name'];
        $image_name = $_FILES['vehicle_image']['name'];
        $upload_dir = '../uploads/vehicles/';
        $unique_name = uniqid() . '_' . $image_name;
        $target_file = $upload_dir . $unique_name;
        move_uploaded_file($image_tmp, $target_file);
        $vehicle_image = $unique_name;
    }

    $updateSql = "UPDATE vehicle SET customer_id = ?, vehicle_type = ?, number_plate = ?, description = ?";
    if ($vehicle_image) {
        $updateSql .= ", vehicle_image = ?";
    }
    $updateSql .= " WHERE vehicle_id = ?";
    $stmt = $conn->prepare($updateSql);

    if ($vehicle_image) {
        $stmt->bind_param('sssssi', $customer_id, $vehicle_type, $number_plate, $description, $vehicle_image, $vehicle_id);
    } else {
        $stmt->bind_param('ssssi', $customer_id, $vehicle_type, $number_plate, $description, $vehicle_id);
    }

    if ($stmt->execute()) {
        header('Location: ../addVehicle.php');
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

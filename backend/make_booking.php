<?php
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Booking data
    $customer_id = $_POST['customer_id'];
    $vehicle_id = $_POST['vehicle_id']; // Assuming this is filled via `showVehicles`
    $employee_id = $_POST['emp_id'];
    $start_date = $_POST['booked_datetime'];
    $status = 1; // Default status (e.g., "pending")

    // Insert into tbl_booking
    $sqlBooking = "INSERT INTO tbl_booking (customer_id, vehicle_id, employee_id, start_date, status) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sqlBooking);
    $stmt->bind_param('iiisi', $customer_id, $vehicle_id, $employee_id, $start_date, $status);

    if ($stmt->execute()) {
        $booking_id = $stmt->insert_id;

        // Process selected services
        if (!empty($_POST['services']) && is_array($_POST['services'])) {
            foreach ($_POST['services'] as $service) {
                // Validate each service entry
                if (!isset($service['id']) || !isset($service['price']) || !isset($service['duration'])) {
                    continue; // Skip invalid service entries
                }

                $service_id = $service['id'];
                $price = $service['price'];
                $duration = !empty($service['duration']) ? $service['duration'] : null;
                $booked_datetime = $_POST['booked_datetime'];

                $sqlService = "INSERT INTO booked_services (booking_id, service_id, price, estimated_duration, booked_datetime) VALUES (?, ?, ?, ?, ?)";
                $stmtService = $conn->prepare($sqlService);
                $stmtService->bind_param('iidss', $booking_id, $service_id, $price, $duration, $booked_datetime);
                $stmtService->execute();
            }
        } else {
            // Handle case where no services are selected
            header('Location: ../bookings.php?error=No services selected');
            exit();
        }
    }

    // Redirect or display success message
    header('Location: ../bookings.php?message=Booking successfully created');
    exit();
} else {
    header('Location: ../bookings.php?error=Invalid request');
    exit();
}
?>

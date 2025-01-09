<?php
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Booking data
    $booking_id = isset($_POST['booking_id']) ? intval($_POST['booking_id']) : null;
    $employee_id = $_POST['emp_id'];
    $status = 1; // Default status (e.g., "pending")
    $date_time_to_complete = isset($_POST['date_time_to_complete']) ? $_POST['date_time_to_complete'] : null;

    if ($booking_id) {
        // Update existing booking
        $sqlBooking = "
            UPDATE tbl_booking
            SET
                employee_id = ?,
                start_date = ?,
                status = ?
            WHERE
                booking_id = ?";
        $stmt = $conn->prepare($sqlBooking);
        $stmt->bind_param('isii', $employee_id, $start_date, $status, $booking_id); // Corrected type definition
        $stmt->execute();
    } else {
        // Insert new booking
        $sqlBooking = "INSERT INTO tbl_booking (employee_id, start_date, status) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sqlBooking);
        $stmt->bind_param('isi', $employee_id, $start_date, $status); // Corrected type definition
        $stmt->execute();
        $booking_id = $stmt->insert_id;
    }

    if ($booking_id) {
        // Clear previous services for existing bookings


        // Process selected services
        if (!empty($_POST['services']) && is_array($_POST['services'])) {
            foreach ($_POST['services'] as $service) {
                // Validate each service entry
                if (!isset($service['id']) || !isset($service['price']) || !isset($service['duration'])) {
                    continue; // Skip invalid service entries
                }

                $service_id = intval($service['id']);
                  $price = floatval($service['price']);
                  $duration = isset($service['duration']) ? intval($service['duration']) : null;

                  // Prepare the query for fetching the booked_datetime
                  $btVar = date('Y-m-d H:i:s'); // Default to current date-time
                        $sqlDateTime = "SELECT * FROM booked_services WHERE booking_id = ? AND service_id = ?";
                        $stmtDateTime = $conn->prepare($sqlDateTime);
                        $stmtDateTime->bind_param('ii', $booking_id, $service_id);
                        $stmtDateTime->execute();
                        $resultDateTime = $stmtDateTime->get_result();
                        echo $sqlDateTime."<br>";
                          echo $booking_id."<br>";
                            echo $service_id."<br>";
                        exit();

                        if ($resultDateTime->num_rows > 0) {
                            $rowDateTime = $resultDateTime->fetch_assoc();
                            $btVar = $rowDateTime['booked_datetime'];
                        }

                        $sqlService = "
                            INSERT INTO booked_services (booking_id, service_id, price, estimated_duration, booked_datetime)
                            VALUES (?, ?, ?, ?, ?)";
                        $stmtService = $conn->prepare($sqlService);
                        $stmtService->bind_param('iidss', $booking_id, $service_id, $price, $duration, $btVar);
                        $stmtService->execute();
            }
        } else {
          if ($_POST['services']) {
              $sqlDeleteServices = "DELETE FROM booked_services WHERE booking_id = ?";
              $stmtDelete = $conn->prepare($sqlDeleteServices);
              $stmtDelete->bind_param('i', $booking_id);
              $stmtDelete->execute();
          }
            // Handle case where no services are selected
            header('Location: ../bookings.php?error=No services selected');
            exit();
        }

        // Redirect with success message
        header('Location: ../bookings.php?message=Booking successfully processed');
        exit();
    } else {
        header('Location: ../bookings.php?error=Failed to process booking');
        exit();
    }
} else {
    header('Location: ../bookings.php?error=Invalid request');
    exit();
}
?>

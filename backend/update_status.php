<?php
include 'conn.php';

if (isset($_GET['id']) && isset($_GET['status'])) {
    $booking_id = intval($_GET['id']);
    $new_status = intval($_GET['status']);

    // Validate new status
    if (!in_array($new_status, [1, 2, 3])) {
        header('Location: ../manage_bookings.php?error=Invalid+status');
        exit();
    }

    // Update the status in the database
    $sql = "UPDATE tbl_booking SET status = ? WHERE booking_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $new_status, $booking_id);

    if ($stmt->execute()) {
        header('Location: ../bookings.php?message=Status+updated+successfully');
    } else {
        header('Location: ../bookings.php?error=Failed+to+update+status');
    }
    $stmt->close();
} else {
    header('Location: ../bookings.php?error=Invalid+request');
}

$conn->close();
?>

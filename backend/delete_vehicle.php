<?php
// Include database configuration
include 'conn.php';

// Check if the `id` parameter is provided in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $vehicle_id = intval($_GET['id']); // Ensure the ID is an integer

    // Fetch the vehicle record to check if it exists
    $query = "SELECT vehicle_image FROM vehicle WHERE vehicle_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $vehicle_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Delete the vehicle record from the database
        $deleteQuery = "DELETE FROM vehicle WHERE vehicle_id = ?";
        $deleteStmt = $conn->prepare($deleteQuery);
        $deleteStmt->bind_param("i", $vehicle_id);

        if ($deleteStmt->execute()) {
            // Delete the vehicle image from the server, if it exists
            if (!empty($row['vehicle_image']) && file_exists("../uploads/vehicles/" . $row['vehicle_image'])) {
                unlink("../uploads/vehicles/" . $row['vehicle_image']); // Remove the file
            }

            // Redirect to the manage vehicles page with success message
            header("Location: ../addVehicle.php?message=Vehicle+deleted+successfully");
        } else {
            // Redirect to the manage vehicles page with error message
            header("Location: ../addVehicle.php?error=Failed+to+delete+vehicle");
        }
    } else {
        // Redirect to the manage vehicles page with an error if vehicle not found
        header("Location: ../addVehicle.php?error=Vehicle+not+found");
    }
} else {
    // Redirect to the manage vehicles page with an error if no ID is provided
    header("Location: ../addVehicle.php?error=Invalid+vehicle+ID");
}

// Close database connection
$conn->close();
?>

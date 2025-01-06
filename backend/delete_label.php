<?php
// Include database configuration
include 'conn.php';

// Check if the `id` parameter is provided in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $web_id = intval($_GET['id']); // Ensure the ID is an integer

    $query = "SELECT * FROM website WHERE web_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $web_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Delete the vehicle record from the database
        $deleteQuery = "DELETE FROM website WHERE web_id = ?";
        $deleteStmt = $conn->prepare($deleteQuery);
        $deleteStmt->bind_param("i", $web_id);

        if ($deleteStmt->execute()) {
            // Delete the vehicle image from the server, if it exists
            if (!empty($row['mobile_image']) && file_exists("../assets/website/mobile/" . $row['mobile_image'])) {
                unlink("../assets/website/mobile/" . $row['mobile_image']); // Remove the file
            }
            if (!empty($row['desktop_image']) && file_exists("../assets/website/desktop/" . $row['desktop_image'])) {
                unlink("../assets/website/desktop/" . $row['desktop_image']); // Remove the file
            }

            // Redirect to the manage vehicles page with success message
            header("Location: ../webManagement.php?message=label+deleted+successfully");
        } else {
            // Redirect to the manage vehicles page with error message
            header("Location: ../webManagement.php?error=Failed+to+delete+label");
        }
    } else {
        // Redirect to the manage vehicles page with an error if vehicle not found
        header("Location: ../webManagement.php?error=label+not+found");
    }
} else {
    // Redirect to the manage vehicles page with an error if no ID is provided
    header("Location: ../webManagement.php?error=Invalid+label+ID");
}

// Close database connection
$conn->close();
?>

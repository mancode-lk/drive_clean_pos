<?php
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $web_id = $_POST['web_id'];
    $label = $_POST['label'];

    $mobImage_image = null;
    $deskImage_image = null;

    // Handle mobile image upload
    if (isset($_FILES['mobImage']) && $_FILES['mobImage']['error'] === UPLOAD_ERR_OK) {
        $mobImage_tmp = $_FILES['mobImage']['tmp_name'];
        $mobImage_name = basename($_FILES['mobImage']['name']);
        $mob_upload_dir = '../assets/website/mobile/';

        // Create directory if it doesn't exist
        if (!is_dir($mob_upload_dir)) {
            mkdir($mob_upload_dir, 0777, true);
        }

        $mob_unique_name = uniqid() . '_' . $mobImage_name;
        $mob_target_file = $mob_upload_dir . $mob_unique_name;

        if (move_uploaded_file($mobImage_tmp, $mob_target_file)) {
            $mobImage_image = $mob_unique_name;
        }
    }

    // Handle desktop image upload
    if (isset($_FILES['deskImage']) && $_FILES['deskImage']['error'] === UPLOAD_ERR_OK) {
        $deskImage_tmp = $_FILES['deskImage']['tmp_name'];
        $deskImage_name = basename($_FILES['deskImage']['name']);
        $desk_upload_dir = '../assets/website/desktop/';

        // Create directory if it doesn't exist
        if (!is_dir($desk_upload_dir)) {
            mkdir($desk_upload_dir, 0777, true);
        }

        $desk_unique_name = uniqid() . '_' . $deskImage_name;
        $desk_target_file = $desk_upload_dir . $desk_unique_name;

        if (move_uploaded_file($deskImage_tmp, $desk_target_file)) {
            $deskImage_image = $desk_unique_name;
        }
    }

    // Prepare SQL to update the database
    $sql = "UPDATE website SET 
                label = ?, 
                mobile_image = COALESCE(?, mobile_image), 
                desktop_image = COALESCE(?, desktop_image) 
            WHERE web_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('sssi', $label, $mobImage_image, $deskImage_image, $web_id);

        if ($stmt->execute()) {
            header('Location: ../webManagement.php'); // Redirect after successful update
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing the statement: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid request method.";
}
?>

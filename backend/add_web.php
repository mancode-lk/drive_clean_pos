<?php
  include 'conn.php';

 // Check if form is submitted
 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     // Get form data
     $label = $_POST['label'];
    
   
     $mobImage_image = null; // Default to null if no mobile image is uploaded
     $deskImage_image = null; // Default to null if no desktop image is uploaded
 
     // Handle mobile image upload
     if (isset($_FILES['mobImage']) && $_FILES['mobImage']['error'] === UPLOAD_ERR_OK) {
         $mobImage_tmp = $_FILES['mobImage']['tmp_name'];
         $mobImage_name = basename($_FILES['mobImage']['name']);
         $mob_upload_dir = '../assets/website/mobile/';
 
         // Create the uploads directory if it doesn't exist
         if (!is_dir($mob_upload_dir)) {
             if (!mkdir($mob_upload_dir, 0777, true)) {
                 echo "Error creating mobile image upload directory.";
                 exit;
             }
         }
 
         // Set a unique name for the mobile image
         $mob_unique_name = uniqid() . '_' . $mobImage_name;
         $mob_target_file = $mob_upload_dir . $mob_unique_name;
 
         // Move the uploaded mobile image
         if (move_uploaded_file($mobImage_tmp, $mob_target_file)) {
             $mobImage_image = $mob_unique_name; // Save the file name to the database
         } else {
             echo "Error uploading the mobile image.";
             exit;
         }
     }
 
     // Handle desktop image upload
     if (isset($_FILES['deskImage']) && $_FILES['deskImage']['error'] === UPLOAD_ERR_OK) {
         $deskImage_tmp = $_FILES['deskImage']['tmp_name'];
         $deskImage_name = basename($_FILES['deskImage']['name']);
         $desk_upload_dir = '../assets/website/desktop/';
 
         // Create the uploads directory if it doesn't exist
         if (!is_dir($desk_upload_dir)) {
             if (!mkdir($desk_upload_dir, 0777, true)) {
                 echo "Error creating desktop image upload directory.";
                 exit;
             }
         }
 
         // Set a unique name for the desktop image
         $desk_unique_name = uniqid() . '_' . $deskImage_name;
         $desk_target_file = $desk_upload_dir . $desk_unique_name;
 
         // Move the uploaded desktop image
         if (move_uploaded_file($deskImage_tmp, $desk_target_file)) {
             $deskImage_image = $desk_unique_name; // Save the file name to the database
         } else {
             echo "Error uploading the desktop image.";
             exit;
         }
     }
 
     // Adjust query and bind parameters based on whether images were uploaded
     $sql = "INSERT INTO website (label, mobile_image, desktop_image) VALUES (?, ?, ?)";
     $stmt = $conn->prepare($sql);
 
     if ($stmt) {
         $stmt->bind_param('sss', $label, $mobImage_image, $deskImage_image);
 
         if ($stmt->execute()) {
             header('Location: ../webManagement.php'); // Redirect to success page
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

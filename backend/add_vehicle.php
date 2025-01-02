<?php
  include 'conn.php';

 // Check if form is submitted
 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     // Get form data
     $customer_id = $_POST['customer_id'];
     $vehicle_type = $_POST['vehicle_type'];
     $number_plate = $_POST['number_plate'];
     $description = $_POST['description'];
     $vehicle_image = null; // Default to null if no image is uploaded

     // Handle vehicle image upload if a file is provided
     if (isset($_FILES['vehicle_image']) && $_FILES['vehicle_image']['error'] === UPLOAD_ERR_OK) {
         $image_tmp = $_FILES['vehicle_image']['tmp_name'];
         $image_name = $_FILES['vehicle_image']['name'];
         $upload_dir = '../uploads/vehicles/';

         // Create the uploads directory if it doesn't exist
         if (!is_dir($upload_dir)) {
             mkdir($upload_dir, 0777, true);
         }

         // Set a unique name for the image
         $unique_name = uniqid() . '_' . $image_name;
         $target_file = $upload_dir . $unique_name;

         // Move the uploaded file to the uploads directory
         if (move_uploaded_file($image_tmp, $target_file)) {
             $vehicle_image = $unique_name; // Save the file name to the database
         } else {
             echo "Error uploading the image.";
             exit;
         }
     }

     // Insert data into the database
     $sql = "INSERT INTO vehicle (customer_id, vehicle_type, number_plate, description, vehicle_image)
             VALUES (?, ?, ?, ?, ?)";
     $stmt = $conn->prepare($sql);
     $stmt->bind_param('sssss', $customer_id, $vehicle_type, $number_plate, $description, $vehicle_image);

     if ($stmt->execute()) {
         header('Location:../addVehicle.php'); // Redirect to success page
         exit;
     } else {
         echo "Error: " . $stmt->error;
     }

     $stmt->close();
     $conn->close();
 } else {
     echo "Invalid request method.";
 }
 ?>

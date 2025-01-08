<?php
// Include database connection
include 'backend/conn.php';

// Check if booking_id is passed
if (!isset($_GET['booking_id']) || empty($_GET['booking_id'])) {
    die("Invalid booking ID.");
}

$booking_id = (int)$_GET['booking_id'];

// Fetch booking details
$sql = "SELECT
            b.booking_id,
            c.customer_name,
            v.vehicle_type,
            v.number_plate,
            b.start_date,
            SUM(bs.price) AS total_bill,
            GROUP_CONCAT(s.service_name SEPARATOR ', ') AS services
        FROM tbl_booking b
        JOIN customer c ON b.customer_id = c.customer_id
        JOIN vehicle v ON b.vehicle_id = v.vehicle_id
        LEFT JOIN booked_services bs ON b.booking_id = bs.booking_id
        LEFT JOIN tbl_service s ON bs.service_id = s.ser_id
        WHERE b.booking_id = ?
        GROUP BY b.booking_id";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $booking_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if booking exists
if ($result->num_rows === 0) {
    die("Booking not found.");
}

$booking = $result->fetch_assoc();

// Fetch individual services for detailed table
$serviceDetailsQuery = "SELECT
                            s.service_name,
                            bs.price,
                            bs.estimated_duration
                        FROM booked_services bs
                        JOIN tbl_service s ON bs.service_id = s.ser_id
                        WHERE bs.booking_id = ?";
$serviceStmt = $conn->prepare($serviceDetailsQuery);
$serviceStmt->bind_param("i", $booking_id);
$serviceStmt->execute();
$services = $serviceStmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill Details</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Material Design Lite -->
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        .bill-container {
            width: 210mm;
            height: 297mm;
            background: white;
            margin: auto;
            padding: 20mm;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }
        .bill-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #eee;
            padding-bottom: 20px;
        }
        .bill-header img {
            height: 60px;
        }
        .bill-header h1 {
            font-size: 24px;
            font-weight: 700;
            margin: 0;
        }
        .bill-section {
            margin: 20px 0;
        }
        .bill-section h2 {
            font-size: 18px;
            font-weight: 500;
            margin-bottom: 10px;
        }
        .bill-details {
            display: flex;
            justify-content: space-between;
            font-size: 16px;
        }
        .bill-details p {
            margin: 5px 0;
        }
        .bill-items {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        .bill-items th, .bill-items td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        .bill-items th {
            background: #f5f5f5;
            font-weight: 500;
        }
        .bill-footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="bill-container">
        <!-- Bill Header -->
        <div class="bill-header">
            <div>
                <h1>Drive Clean</h1>
                <p>Address Line 1, Address Line 2</p>
                <p>Email: info@company.com | Phone: +1 234 567 890</p>
            </div>
            <img src="https://via.placeholder.com/150" alt="Company Logo">
        </div>

        <!-- Customer and Booking Information -->
        <div class="bill-section">
            <h2>Customer Information</h2>
            <div class="bill-details">
                <div>
                    <p><strong>Name:</strong> <?= htmlspecialchars($booking['customer_name']) ?></p>
                    <p><strong>Vehicle:</strong> <?= htmlspecialchars($booking['vehicle_type']) ?> (<?= htmlspecialchars($booking['number_plate']) ?>)</p>
                </div>
                <div>
                    <p><strong>Bill Date:</strong> <?= date('Y-m-d') ?></p>
                    <p><strong>Booking ID:</strong> #<?= htmlspecialchars($booking['booking_id']) ?></p>
                </div>
            </div>
        </div>

        <!-- Services and Bill Details -->
        <div class="bill-section">
            <h2>Services Details</h2>
            <table class="bill-items">
                <thead>
                    <tr>
                        <th>Service</th>
                        <th>Price</th>
                        <th>Duration</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($service = $services->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($service['service_name']) ?></td>
                        <td>LKR <?= number_format($service['price'], 2) ?></td>
                        <td><?= htmlspecialchars($service['estimated_duration']) ?> mins</td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2" style="text-align:right;">Total</th>
                        <th>LKR<?= number_format($booking['total_bill'], 2) ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Footer -->
        <div class="bill-footer">
            <p>Thank you for choosing our services!</p>
            <p>This is a computer-generated bill and does not require a signature.</p>
        </div>
    </div>
    <script type="text/javascript">
      window.print();
    </script>
</body>
</html>

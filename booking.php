<?php
// Connect to MySQL
$conn = new mysqli("localhost", "root", "", "tshwane_booking");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get and sanitize input
$adults = isset($_POST['adults']) ? (int)$_POST['adults'] : 1;
$children = isset($_POST['children']) ? (int)$_POST['children'] : 0;
$checkin = isset($_POST['checkin']) ? $_POST['checkin'] : '';
$checkout = isset($_POST['checkout']) ? $_POST['checkout'] : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';

// Basic validation
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("❌ Invalid email address.");
}
if (empty($checkin) || empty($checkout)) {
    die("❌ Please provide both check-in and check-out dates.");
}

// Prepare statement
$stmt = $conn->prepare("INSERT INTO bookings (email, adults, children, checkin_date, checkout_date)
                        VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("siiss", $email, $adults, $children, $checkin, $checkout);

// Execute and check
if ($stmt->execute()) {
    echo "✅ Room successfully booked!";
} else {
    echo "❌ Booking failed: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>

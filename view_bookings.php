<?php
$conn = new mysqli("localhost", "root", "", "tshwane_booking");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM bookings ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <title>View Bookings</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 20px;
      background-color: #f9f9f9;
    }
    h2 {
      color: #1a1f4b;
    }
    table {
      border-collapse: collapse;
      width: 100%;
      margin-top: 20px;
      background-color: #fff;
      box-shadow: 0 0 8px rgba(0,0,0,0.1);
    }
    th, td {
      padding: 12px;
      border: 1px solid #ddd;
      text-align: left;
    }
    th {
      background-color: #007BFF;
      color: white;
    }
    a.back-link {
      display: inline-block;
      margin-top: 15px;
      text-decoration: none;
      color: #007BFF;
      font-weight: bold;
    }
    a.back-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <h2>All Room Bookings</h2>

  <?php if ($result->num_rows > 0): ?>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Email</th>
          <th>Adults</th>
          <th>Children</th>
          <th>Check-in</th>
          <th>Check-out</th>
          <th>Booked On</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row["id"]) ?></td>
            <td><?= htmlspecialchars($row["email"]) ?></td>
            <td><?= htmlspecialchars($row["adults"]) ?></td>
            <td><?= htmlspecialchars($row["children"]) ?></td>
            <td><?= htmlspecialchars($row["checkin_date"]) ?></td>
            <td><?= htmlspecialchars($row["checkout_date"]) ?></td>
            <td><?= htmlspecialchars($row["created_at"]) ?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  <?php else: ?>
    <p>No bookings found.</p>
  <?php endif; ?>

  <a href="index.html" class="back-link">← Back to Home</a>
</body>
</html>

<?php
$conn->close();
?>

<?php
// Database connection details
$servername = "db";
$username = "root";
$password = "root";
$dbname = "visitors";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get visitor IP address
$ip_address = $_SERVER['REMOTE_ADDR'];

// Insert log into database
$stmt = $conn->prepare("INSERT INTO visit_logs (ip_address) VALUES (?)");
$stmt->bind_param("s", $ip_address);
$stmt->execute();
$stmt->close();
$conn->close();

echo "Visit logged successfully!";
?>

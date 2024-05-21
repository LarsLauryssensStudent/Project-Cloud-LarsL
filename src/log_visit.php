<?php
// Database connection details ingeven zodat we een connectie kunnen maken later
$servername = "db";
$username = "root";
$password = "rootWord";
$dbname = "visitors";

// De voorafgenoemde connectie proberen te maken
$conn = new mysqli($servername, $username, $password, $dbname);

// Connectie nakijken en zien of het vlot werkt.
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// visitor IP address opzoeken zodat we dit kunnen vastleggen
$ip_address = $_SERVER['REMOTE_ADDR'];

// dan inserten we een log in de database
$stmt = $conn->prepare("INSERT INTO visit_logs (ip_address) VALUES (?)");
$stmt->bind_param("s", $ip_address);
$stmt->execute();
$stmt->close();
$conn->close();

echo "Visit logged successfully!";
?>

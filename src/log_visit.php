<?php
// Databaseverbinding parameters
$servername = "db";  // Gebruik 'db' als je Docker Compose netwerk gebruikt
$username = "root";
$password = "rootWord";
$dbname = "visitors";

// Maak verbinding met de database
$conn = new mysqli($servername, $username, $password, $dbname);

// Controleer de verbinding
if ($conn->connect_error) {
    die("Verbindingsfout: " . $conn->connect_error);
}

// Maak de tabel als deze niet bestaat
$tableCreationQuery = "
CREATE TABLE IF NOT EXISTS visit_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ip_address VARCHAR(45) NOT NULL,
    visit_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($tableCreationQuery) === FALSE) {
    die("Fout bij het maken van de tabel: " . $conn->error);
}

// Haal het IP-adres van de bezoeker op
$ip_address = $_SERVER['REMOTE_ADDR'];

// Bereid de SQL-instructie voor en bind de parameters
$stmt = $conn->prepare("INSERT INTO visit_logs (ip_address) VALUES (?)");
$stmt->bind_param("s", $ip_address);

// Voer de SQL-instructie uit
if ($stmt->execute() === FALSE) {
    die("Fout bij het loggen van het bezoek: " . $stmt->error);
}

// Sluit de statement en de databaseverbinding
$stmt->close();
$conn->close();

// Geef een bericht weer met de nieuwe bezoeker en de datum
echo "Nieuwe bezoeker: $ip_address";
?>

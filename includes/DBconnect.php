<?php
// Verbinding maken met de database
$servername = "";
$dbname = "";
$username = "";
$password = "";

try {
    /* Variabele met object om databaseverbinding te maken */
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Zet de PDO-error modus naar exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Verbinding mislukt: " . $e->getMessage();
}

return $conn;


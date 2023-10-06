<?php
include_once('includes/DBconnect.php');

try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Generate a unique identifier for the paste
    $uniqueId = uniqid();

    // Get the form data
    $code = $_POST['codeArea'];
    $category = $_POST['categoryArea'];
    $expiration = $_POST['expirationArea'];
    $syntax = $_POST['syntaxArea'];

    // Calculate the expiration date and time based on the selected option
    $expirationDateTime = new DateTime();
    switch ($expiration) {
        case '10 Minutes':
            $expirationDateTime->modify('+10 minutes');
            break;
        case '1 Hour':
            $expirationDateTime->modify('+1 hour');
            break;
        case '1 Day':
            $expirationDateTime->modify('+1 day');
            break;
        case '1 Week':
            $expirationDateTime->modify('+1 week');
            break;
        case '1 Month':
            $expirationDateTime->modify('+1 month');
            break;
    }
    $expirationFormatted = $expirationDateTime->format('Y-m-d H:i:s');

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO pastes (unique_id, code, category, expiration, syntax) VALUES (:unique_id, :code, :category, :expiration, :syntax)");

    // Bind the form data to the named parameters in the prepared statement
    $stmt->bindParam(':unique_id', $uniqueId);
    $stmt->bindParam(':code', $code);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':expiration', $expirationFormatted);
    $stmt->bindParam(':syntax', $syntax);


    // Execute the SQL statement
    if ($stmt->execute()) {
        // Redirect to the page with the shared link
        $sharedLink = "view.php?id=" . $uniqueId;
        header("Location: " . $sharedLink);
        exit();
    } else {
        // Handle the error, e.g., display an error message
        echo "Error: " . $stmt->errorInfo()[2];
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Close the prepared statement
$stmt = null;

// Close the database connection
$conn = null;

<?php
// getFileCount.php

$dbHost = 'localhost';
$dbName = 'user_data';
$dbUser = 'root';
$dbPassword = '';

try {
    // Connect to the database
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get the file count from the database
    $stmt = $pdo->query("SELECT COUNT(*) FROM attachments");
    $count = $stmt->fetchColumn();

    echo $count;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

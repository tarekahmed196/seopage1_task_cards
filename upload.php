<?php
// upload.php

$dbHost = 'localhost';
$dbName = 'user_data';
$dbUser = 'root';
$dbPassword = '';

try {
    // Connect to the database
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Handle file upload
    if (isset($_FILES['files'])) { // Update this line
        $files = $_FILES['files']; // Update this line

        foreach ($files['tmp_name'] as $key => $tmp_name) {
            $filename = $files['name'][$key];
            $contentType = $files['type'][$key];
            $fileData = file_get_contents($tmp_name);

            // Insert file data into the database
            $stmt = $pdo->prepare("INSERT INTO attachments (filename, content_type, file_data) VALUES (?, ?, ?)");
            $stmt->bindParam(1, $filename);
            $stmt->bindParam(2, $contentType);
            $stmt->bindParam(3, $fileData, PDO::PARAM_LOB);
            $stmt->execute();
        }

        echo "File(s) uploaded successfully.";
        
        
    } else {
        echo "No file uploaded.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>

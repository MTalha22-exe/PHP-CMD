<?php
// Database connection
$host = "localhost";
$user = "root";
$pass = "";
$db = "project";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Allowed file types (extensions)
$allowedTypes = ['pdf', 'jpg', 'jpeg', 'png'];

// Max file size in bytes (e.g., 2 MB)
$maxFileSize = 2 * 1024 * 1024; // 2*1024*1024=2097152 bytes

// Check if form submitted & file uploaded
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $fileName = $_FILES['file']['name'];
    $fileSize = $_FILES['file']['size'];
    $targetDir = "uploads/";
    $targetFilePath = $targetDir . basename($fileName);

    // get file extension (lowercase)
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Validate file type
    if (!in_array($fileExt, $allowedTypes)) {
        echo "Invalid file type. Only PDF, JPG, and PNG are allowed.";
        exit;
    }

    // Validate file size
    if ($fileSize > $maxFileSize) {
        echo "File too large. Max allowed size is 2 MB.";
        exit;
    }

    // Upload the file
    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) {
        // Save info to DB
        $stmt = $conn->prepare("INSERT INTO files (filename, filepath, filesize) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $fileName, $targetFilePath, $fileSize);
        $stmt->execute();
        $stmt->close();

        echo "File uploaded and saved to database successfully!";
        exit;
    } else {
        echo "Error uploading file.";
        exit;
    }
} else {
    echo "No file uploaded.";
    exit;
}
?>

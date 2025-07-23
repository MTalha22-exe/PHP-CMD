<?php
$conn = new mysqli("localhost", "root", "", "project"); 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];

// Get file info first
$result = $conn->query("SELECT * FROM files WHERE id=$id");
$file = $result->fetch_assoc();

if ($file) {
    // Delete file from folder
    if (file_exists($file['filepath'])) {
        unlink($file['filepath']);
    }

    // Delete from database
    $conn->query("DELETE FROM files WHERE id=$id");
}

// Redirect back to index.php
header("Location: index.php");
exit();
?>

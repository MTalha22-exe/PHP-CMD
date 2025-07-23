<?php
// Connect to database
$conn = new mysqli("localhost", "root", "", "project"); 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];

// Get current file info
$result = $conn->query("SELECT * FROM files WHERE id=$id");
$file = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["new_file"])) {
    $newFileName = $_FILES["new_file"]["name"];
    $targetDir = "uploads/";
    $newFilePath = $targetDir . basename($newFileName);

    if (move_uploaded_file($_FILES["new_file"]["tmp_name"], $newFilePath)) {
        // Update in database
        $sql = "UPDATE files SET filename='$newFileName', filepath='$newFilePath' WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
            exit();
        } else {
            echo "Database error: " . $conn->error;
        }
    } else {
        echo "Error uploading new file.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit File</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h2>Edit File: <?= htmlspecialchars($file['filename']) ?></h2>
    <form method="post" enctype="multipart/form-data">
      <input type="file" name="new_file" required>
      <button type="submit">Upload New File</button>
    </form>
  </div>
</body>
</html>

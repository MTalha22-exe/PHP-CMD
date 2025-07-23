<?php
// Database connection
$host = "localhost";
$user = "root";
$pass = "";
$db = "project"; // make sure your DB name matches

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Fetch all uploaded files
$result = $conn->query("SELECT * FROM files ORDER BY uploaded_on DESC");
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>File Upload & List</title>
  <link rel="stylesheet" href="style.css">
  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

  <!-- DataTables JS -->
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

</head>

<body>
  <div class="container">
    <h2>Upload a File</h2>
    <form class="upload-form" method="post" action="upload.php" enctype="multipart/form-data">
      <input type="file" name="file" required>
      <button type="submit">Upload</button>
    </form>

    <h3>Uploaded Files</h3>
    <table id="myTable">
      <thead>
        <tr>
          <th>ID</th>
          <th>Filename</th>
          <th>Upload Date</th>
          <th>Upload Time</th>
          <th>File Size</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($result->num_rows > 0): ?>
          <?php while($row = $result->fetch_assoc()): ?>
    <?php
      // split date and time once you have $row['uploaded_on']
      $dateTime = $row['uploaded_on'];
      $date = date('Y-m-d', strtotime($dateTime));
      $time = date('H:i:s', strtotime($dateTime));
    ?>
    <tr>
      <td><?= $row['id'] ?></td>
     <td>
  <?= htmlspecialchars($row['filename']) ?>
</td>

      <td><?= $date ?></td>
      <td><?= $time ?></td>
      <td><?= round($row['filesize']/1024, 2) ?> KB</td>
      <td>
        <a href="<?= htmlspecialchars($row['filepath']) ?>" target="_blank">View</a> |
        <a href="files.php?id=<?= $row['id'] ?>">Edit</a> |
        <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this file?');">Delete</a>
      </td>
    </tr>
<?php endwhile; ?>

        <?php else: ?>
          <tr>
            <td colspan="4">No files uploaded yet.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
  <script>
    $(document).ready(function() {
      $('#myTable').DataTable();
    });
  </script>


</body>

</html>
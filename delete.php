<?php
// Connect to the database
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "hiteshspa";
$conn = mysqli_connect($host, $user, $pass, $dbname);

// Check if an ID parameter was passed in the request
if(isset($_POST['id'])) {
    $id = $_POST['id'];

    // Retrieve the image filename from the database
    $sql = "SELECT filename FROM images WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $filename = $row['filename'];

    // Delete the image file from the uploads folder
    $filepath = "uploads/".$filename;
    if(file_exists($filepath)){
        unlink($filepath);
    }

    // Delete the image record from the database
    $sql = "DELETE FROM images WHERE id = $id";
    mysqli_query($conn, $sql);
}

// Close database connection
mysqli_close($conn);
?>

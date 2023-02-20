<?php
// Connect to the database
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "hiteshspa";
$conn = mysqli_connect($host, $user, $pass, $dbname);

// Check if a file was uploaded
if(isset($_FILES["image"])) {
    $caption = $_POST['caption'];
    $filename = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];
    $folder = "uploads/".$filename;
    $size = $_FILES["image"]["size"];

    // Check if the file is an image and the file size is less than 2MB
    $allowed = array('jpg', 'jpeg', 'png', 'gif');
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    if(in_array($ext, $allowed) && $size < 10000000){
        // Move the file to the uploads folder
        move_uploaded_file($tempname, $folder);

        // Insert image information into the database
        $sql = "INSERT INTO images (filename, caption) VALUES ('$filename', '$caption')";
        mysqli_query($conn, $sql);
    }
}

// Close database connection
mysqli_close($conn);
?>

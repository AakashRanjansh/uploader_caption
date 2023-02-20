<?php
// Connect to database
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "hiteshspa";
$conn = mysqli_connect($host, $user, $pass, $dbname);

// Retrieve images from database
$sql = "SELECT * FROM images ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

// Generate HTML code to display images
$html = "";
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $html .= "<div class='image'>";
        $html .= "<img width='300' height='200' src='uploads/".$row['filename']."' alt='".$row['caption']."'>";
        $html .= "<h5 style='font-family:Castellar;' >"."Comment: "."</h5>";
        $html .= "<p style='font-family:Courier New;'>".$row['caption']."</p>";
        $html .= "<button class='delete-btn button_delete' data-id='".$row['id']."'>Delete</button>" . "&emsp;<button class='button_download' ><a href='download.php?file=".$row['filename']."'>Download</a></button><br><br>";
        $html .= "</div>";
    }
} else {
    $html = "<p>No images to display.</p>";
}

// Return HTML code
echo $html;

// Close database connection
mysqli_close($conn);
?>

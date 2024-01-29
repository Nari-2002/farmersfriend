<?php
// Establish connection to MySQL database
$servername = "localhost"; // Change these details according to your database setup
$username = "root";
$password = "";
$dbname = "post";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $post_title = $_POST["post_title"];
    $post_description = $_POST["post_description"];
    $video_url = $_POST["video_url"];

    // Process image upload
    $target_dir = "uploads/"; // Directory to store uploaded images
    $target_file = $target_dir . basename($_FILES["post_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is an actual image or fake image
    $check = getimagesize($_FILES["post_image"]["tmp_name"]);
    if ($check !== false) {
        // File is an image
        $uploadOk = 1;
    } else {
        // File is not an image
        $uploadOk = 0;
    }

    // Check file size (limit to 5MB in this example)
    if ($_FILES["post_image"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow only certain file formats (you can extend this list)
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "Sorry, only JPG, JPEG, and PNG files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // Attempt to upload file
        if (move_uploaded_file($_FILES["post_image"]["tmp_name"], $target_file)) {
            // Insert data into the database
            $sql = "INSERT INTO posts (post_title, post_description, post_image, video_url)
                    VALUES ('$post_title', '$post_description', '$target_file', '$video_url')";

            if ($conn->query($sql) === TRUE) {
                // Redirect to the success page
                header("Location: post_success.php");
                exit();
            } else {
                echo"<a href='post.html'>repost</a>";
                echo "Error: " . $sql . "<br>" . $conn->error;
                
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

// Close database connection
$conn->close();
?>

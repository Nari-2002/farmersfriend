<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FarmersFriend - Post Details</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Your custom CSS styles */
        /* Add your additional CSS styles here */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 15px;
            text-align: center;
        }
        .post-details {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            border-radius: 8px;
        }
        .post-details img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 10px;
        }
        .back-link {
            margin-top: 20px;
            text-align: center;
        }
        .back-link a {
            text-decoration: none;
            color: #333;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to FarmersFriend</h1>
    </header>
    <main class="container">
        <div class="post-details">
            <?php
            // Check if the post ID is provided in the URL
            if (isset($_GET['id'])) {
                $post_id = $_GET['id'];

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

                // Fetch post details based on the provided ID
                $sql = "SELECT * FROM posts WHERE id = $post_id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Display post details
                    $row = $result->fetch_assoc();
                    echo '<h2>' . $row['post_title'] . '</h2>';
                    echo '<p>' . $row['post_description'] . '</p>';
                    echo '<img src="' . $row['post_image'] . '" alt="Post Image">';
                    echo '<a href="' . $row['video_url'] . '">Watch Video</a>';
                } else {
                    echo "Post not found";
                }

                // Close connection
                $conn->close();
            } else {
                echo "Invalid post ID";
            }
            ?>
            <div class="back-link">
                <a href="main.php">Back to Home</a>
            </div>
        </div>
    </main>
</body>
</html>

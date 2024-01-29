<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FarmersFriend - Home</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Your custom CSS styles */
        /* Add your additional CSS styles here */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
    
        nav {
            background-color: #444;
            padding: 10px;
        }
        nav ul {
            list-style: none;
            padding: 0;
            text-align: right;
        }
        nav ul li {
            display: inline;
            margin-right: 20px;
        }
        nav ul li a {
            color: #fff;
            text-decoration: none;
        }
        nav ul li a:hover {
            color: #ffcc00;
        }
        .post {
            border: 1px solid #ccc;
            padding: 20px;
            margin-bottom: 20px; /* Adjust margin bottom to change space between posts */
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            border-radius: 8px;
        }
        .post img {
            max-width: 100%; /* Adjust as needed */
            height: auto;
            border-radius: 8px;
            margin-bottom: 10px;
        }
        .post-title {
            font-size: 24px;
            margin-bottom: 10px;
            color: #333;
        }
        .post-description {
            color: #555;
        }
        
        nav ul li:first-child a {
            text-align: left; /* Align first link to the left */
        }
    </style>
</head>
<body>
    
    <nav>
        
        <ul>
            <li><a>FarmersFriend</a></li>
            <li><a href="post.html">Add Post</a></li>
            <!-- Add more navigation links if needed -->
        </ul>
    </nav>
    <br>
    <main class="container">
        <div class="row">
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

            // Fetch posts from the database
            $sql = "SELECT * FROM posts";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row with post links
                while($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-4">';
                    echo '<div class="post">';
                    echo '<h2><a href="post_details.php?id=' . $row['id'] . '">' . $row['post_title'] . '</a></h2>';
                    
                    echo '<img src="' . $row['post_image'] . '" class="img-fluid" alt="Post Image">';
                    echo '<a href="' . $row['video_url'] . '">Watch Video</a>';
                    echo '</div></div>';
                }
            } else {
                echo "0 results";
            }

            // Close connection
            $conn->close();
            ?>
        </div>
    </main>
</body>
</html>

<?php
$servername = "localhost";
$username = "root";
$password = "12345";
$dbname = "artikel_db";

// Create connection
$conn = new mysqli('localhost', 'root', '12345', 'artikel_db');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are filled
    if (!empty($_POST['title']) && !empty($_POST['content']) && !empty($_FILES["photo"]["name"])) {
        // Prepare and bind the SQL statement
        $stmt = $conn->prepare("INSERT INTO articles (title, content, image) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $title, $content, $image);

        // Set parameters
        $title = $_POST['title'];
        $content = $_POST['content'];

        // File upload handling
        $target_dir = "uploads/";
        $original_filename = basename($_FILES["photo"]["name"]);
        $imageFileType = strtolower(pathinfo($original_filename, PATHINFO_EXTENSION));
        $new_filename = pathinfo($original_filename, PATHINFO_FILENAME) . "_" . time() . "." . $imageFileType;
        $target_file = $target_dir . $new_filename;
        $uploadOk = 1;

        // Increase the file size limit
        $max_file_size = 10000000; // 5 MB

        // Check file size
        if ($_FILES["photo"]["size"] > $max_file_size) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                $image = $target_file; // Save the full path to the image
                echo "The file " . htmlspecialchars($new_filename) . " has been uploaded.";

                // Execute SQL statement
                if ($stmt->execute()) {
                    echo "New record created successfully.";
                } else {
                    echo "Error: " . $stmt->error;
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

        $stmt->close();
    } else {
        echo "All fields are required.";
    }
}

$conn->close();
?>

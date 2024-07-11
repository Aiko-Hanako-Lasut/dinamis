<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>NEWS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Reset some basic styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #FFFAE6;
        }

        /* Center and style the title */
        h1 {
            margin-top: 20px;
            font-size: 2.5em;
            color: #FF5F00;
        }

        /* Center and style the horizontal rule */
        hr {
            border: none;
            height: 5px;
            background-color: #FF5F00;
            width: 50%;
        }

        /* Style the search bar */
        #searchBar {
            width: 50%;
            padding: 10px;
            font-size: 16px;
            margin-bottom: 20px;
            border: 2px solid #FF5F00;
            border-radius: 5px;
        }

        /* Container for the cards */
        .card-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
        }

        /* Style each card */
        .card {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin: 10px 0;
            padding: 15px;
            width: 90%; /* Adjust the width to fit nicely on the screen */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        /* Add hover effect for cards */
        .card:hover {
            transform: scale(1.05);
        }

        /* Style images inside the cards */
        .card img {
            width: 100%;
            border-radius: 5px;
        }

        /* Style the content inside each card */
        .card-content {
            text-align: left;
            padding-top: 10px;
        }

        /* Style the card titles */
        .card-content h3 {
            font-size: 1.2em;
            color: #333;
            margin-bottom: 10px;
        }

        /* Style the card descriptions */
        .card-content p {
            font-size: 0.95em;
            color: #666;
        }

        /* Style the read more button */
        .btn {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 15px;
            background-color: #FF5F00;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.2s;
        }

        .btn:hover {
            background-color: #e65500;
        }

        /* Additional styles for search bar and form */
        .search-bar {
            width: 100%;
            padding: 30px;
            font-size: 16px;
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
        }

        .search-input {
            width: 80%;
            padding: 10px;
            font-size: 16px;
            border: 2px solid #FF5F00;
            border-radius: 5px 0 0 5px;
        }

        .search-button {
            padding: 10px 30px;
            background-color: #ff5f00;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 0 5px 5px 0;
        }

        .search-button:hover {
            background-color: #e65500;
        }
    </style>
</head>
<body>
    <br>
    <center><h1>ARTIKEL KEGIATAN DI UNKLAB</h1>
    <hr></center>

    <div class="search-bar">
        <form action="" method="GET" style="width: 100%; display: flex;">
            <input type="text" name="search" class="search-input" placeholder="Cari artikel..." required>
            <button type="submit" class="search-button">Search</button>
        </form>
    </div>

    <div class="card-container">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "12345";  // Sesuaikan dengan password MySQL Anda
        $dbname = "artikel_db";

        // Buat koneksi
        $conn = new mysqli('localhost', 'root', '12345', 'artikel_db');

        // Periksa koneksi
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Ambil data artikel berdasarkan pencarian
        $sql = "SELECT * FROM articles";
        if (isset($_GET['search'])) {
            $search = $conn->real_escape_string($_GET['search']);
            $sql .= " WHERE title LIKE '%$search%'";
        }
        $sql .= " ORDER BY created_at DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="card">';
                echo '<img src="'.$row["image"].'" alt="'.$row["title"].'">';
                echo '<div class="card-content">';
                echo '<h3>'.$row["title"].'</h3>';
                echo '<a href="detail.php?id='.$row["id"].'" class="btn">Read more</a>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "Tidak ada artikel.";
        }
        $conn->close();
        ?>
    </div>
</body>
</html>

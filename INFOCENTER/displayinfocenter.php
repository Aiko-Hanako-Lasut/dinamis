<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>INFORMATION CENTER</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
            font-family: sans-serif;
        }

        body {
            background-color: antiquewhite;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 50px;
        }

        .card {
            width: 325px;
            background-color: #FDDE55;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0px 2px 4px rgb(250, 242, 2);
            margin: 10px;
            text-align: center; /* Ensure text is centered */
            display: flex;
            flex-direction: column;
        }

        .card img {
            width: 100%;
            display: block;
        }

        .card-content {
            padding: 16px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .card-content h3 {
            font-size: 15px;
            margin-bottom: 8px;
        }

        .card-content p {
            color: #000000;
            font-size: 15px;
            line-height: 1.3;
        }

        .card-content .btn {
            display: inline-block;
            padding: 8px 16px;
            background-color: #23a1dc;
            text-decoration: none;
            border-radius: 4px;
            color: #fff;
            transition: background-color 0.3s;
            margin-top: auto; /* Push the button to the bottom */
        }

        .card-content .btn:hover {
            background-color: #84f090;
        }

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
    <center><h1>UNKLAB ORGANIZATION</h1>
    <hr color="#FF5F00" size="5" width="50%"></center>

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
        $dbname = "infocenter_db";

        // Buat koneksi
        $conn = new mysqli('localhost', 'root', '12345', 'infocenter_db');

        // Periksa koneksi
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Ambil data artikel berdasarkan pencarian
        $sql = "SELECT * FROM infocenter_db";
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
                $contentPreview = substr($row["content"], 0, 100); // Tampilkan hanya 100 karakter pertama
                echo '<p>'.$contentPreview.'...</p>';
                echo '<a href="detail.php?id='.$row["id"].'" class="btn">Click to read more</a>';
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>NEWS - Detail Artikel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .frame-utama {
            background-color: #f7f2d2;
            width: 1060px;
            padding: 20px;
            margin: 0 auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .large-text-input {
            width: 100%;
            height: 30px;
            margin-bottom: 20px;
        }
        textarea {
            width: 100%;
            margin-bottom: 20px;
            padding: 10px;
        }
        .frame-kecil {
            background-color: #ffffff;
            padding: 10px;
            margin-top: 20px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        button {
            background-color: #ff5f00;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #e65500;
        }
        img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }
    </style>
</head>
<body bgcolor="#FFFAE6">
    <br>
    <center><h1>DETAIL ARTIKEL KEGIATAN DI UNKLAB</h1>
    <hr color="#FF5F00" size="5" width="50%"></center>

    <div class="frame-utama">
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

        // Ambil data artikel berdasarkan ID
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM infocenter_db WHERE id=$id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo '<h2>'.$row["title"].'</h2>';
                echo '<img src="'.$row["image"].'" alt="'.$row["title"].'">';
                echo '<p>'.$row["content"].'</p>';
            } else {
                echo "Artikel tidak ditemukan.";
            }
        } else {
            echo "ID artikel tidak ditemukan.";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>

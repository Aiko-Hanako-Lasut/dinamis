<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>ARTIKEL</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tiny.cloud/1/uvp62i79whjicdyo97c2sy3nxyr67jlzzddkgnsdeuem6su3/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <style>
        body {
            background-color: #FFFAE6;
            font-family: Arial, sans-serif;
            padding: 20px;
        }
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
        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            margin-top: 40px;
        }
        .card {
            background-color: #fff;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            width: 300px;
            padding: 20px;
            text-align: center;
        }
        .card img {
            width: 100%;
            height: auto;
        }
        .card h3 {
            margin-top: 10px;
        }
        .card p {
            text-align: left;
        }
        .btn {
            background-color: #ff5f00;
            color: #fff;
            padding: 10px;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
            margin-right: 5px;
        }
        .btn:hover {
            background-color: #e65500;
        }
    </style>
</head>
<body>
    <div class="frame-utama">
        <center>
            <h1>BUAT ARTIKEL LAPORAN KEGIATAN ORGANISASI</h1>
            <hr color="#FF5F00" size="5" width="50%">
        </center>

        <h4>UPLOAD INFO KEGIATAN</h4>
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <h5>Judul artikel</h5>
            <input type="text" name="title" class="large-text-input" required>

            <h5>Isi</h5>
            <textarea name="content" id="myTextarea" rows="10"></textarea>
            <!-- Initialize TinyMCE -->
            <script>
                tinymce.init({
                    selector: '#myTextarea',
                    plugins: 'lists link',
                    toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright | bullist numlist',
                    menubar: false,
                    setup: function (editor) {
                        editor.on('change', function () {
                            editor.save();
                        });
                    }
                });
            </script>


            <div class="frame-kecil">
                <h5>UPLOAD DOKUMENTASI</h5>
                <input type="file" id="photo" name="photo" accept="image/*" required>
            </div>
            <br>
            <button type="submit">Upload</button>
        </form>
    </div>

    <div class="card-container">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "12345";  // Jika password MySQL Anda kosong, biarkan kosong
        $dbname = "percobaan2_db";

        // Buat koneksi
        $conn = new mysqli('localhost', 'root', '12345', 'artikel_db');

        // Periksa koneksi
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Ambil data artikel
        $sql = "SELECT * FROM articles ORDER BY created_at DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="card">';
                echo '<img src="'.$row["image"].'" alt="'.$row["title"].'">';
                echo '<div class="card-content">';
                echo '<h3>'.$row["title"].'</h3>';
                echo '<a href="edit.php?id='.$row["id"].'" class="btn">Edit</a>';
                echo '<a href="delete.php?id='.$row["id"].'" class="btn" onclick="return confirm(\'Are you sure you want to delete this article?\')">Delete</a>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "<p>Tidak ada artikel.</p>";
        }
        $conn->close();
        ?>
    </div>
</body>
</html>

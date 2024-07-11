<?php
// Pastikan parameter id tersedia dan benar
if (!isset($_GET['id'])) {
    echo "ID artikel tidak ditemukan.";
    exit();
}

$article_id = $_GET['id'];

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "12345";  // Sesuaikan dengan password MySQL Anda
$dbname = "infocenter_db";

// Buat koneksi
$conn = new mysqli('localhost', 'root', '12345', 'infocenter_db');

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query SQL untuk mengambil artikel berdasarkan id
$sql = "SELECT * FROM infocenter_db WHERE id = $article_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Artikel ditemukan, ambil data artikel
    $row = $result->fetch_assoc();
    $title = $row['title'];
    $content = $row['content'];
    $image = $row['image']; // Ini bisa Anda gunakan untuk menampilkan gambar artikel saat ini, jika perlu

    // Tampilkan form untuk mengedit artikel
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Edit Artikel</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            /* Gunakan gaya dari index.html */
            body {
                background-color: #FFFAE6;
                font-family: Arial, sans-serif;
            }
            .container {
                max-width: 1060px;
                margin: 0 auto;
                padding: 20px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                background-color: #f7f2d2;
            }
            h1 {
                text-align: center;
                color: #FF5F00;
            }
            hr {
                border: none;
                border-top: 5px solid #FF5F00;
                width: 50%;
                margin: 20px auto;
            }
            form {
                background-color: #ffffff;
                padding: 20px;
                box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            }
            input[type="text"],
            textarea {
                width: 100%;
                padding: 10px;
                margin-bottom: 20px;
                border: 1px solid #ccc;
                border-radius: 5px;
                box-sizing: border-box;
            }
            textarea {
                height: 200px; /* Atur sesuai kebutuhan */
            }
            button {
                background-color: #ff5f00;
                color: #fff;
                padding: 10px 20px;
                border: none;
                cursor: pointer;
                font-size: 16px;
            }
            button:hover {
                background-color: #e65500;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Edit Artikel</h1>
            <hr>
            <form action="update.php?id=<?php echo $article_id; ?>" method="POST" enctype="multipart/form-data">
                <label for="title">Judul artikel</label>
                <input type="text" id="title" name="title" value="<?php echo $title; ?>" required>

                <label for="content">Isi artikel</label>
                <textarea id="content" name="content" rows="10" required><?php echo $content; ?></textarea>

                <label for="photo">Ganti Dokumentasi</label>
                <input type="file" id="photo" name="photo" accept="image/*">

                <br><br>
                <button type="submit">Update</button>
            </form>
        </div>
    </body>
    </html>
    <?php
} else {
    // Artikel tidak ditemukan
    echo "Artikel tidak ditemukan.";
}

// Tutup koneksi database
$conn->close();
?>

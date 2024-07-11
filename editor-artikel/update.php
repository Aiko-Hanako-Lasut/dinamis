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
$dbname = "artikel_db";

// Buat koneksi
$conn = new mysqli('localhost', 'root', '12345', 'artikel_db');

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$title = $_POST['title'];
$content = $_POST['content'];

// Mulai query SQL untuk update artikel
$sql = "UPDATE articles SET title=?, content=? WHERE id=?";

$stmt = $conn->prepare($sql);
$stmt->bind_param('ssi', $title, $content, $article_id);

// Proses upload gambar jika ada file yang diupload
if (!empty($_FILES['photo']['name'])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Periksa apakah file adalah gambar
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File bukan gambar.";
        $uploadOk = 0;
    }

    // Periksa apakah file sudah ada
    if (file_exists($target_file)) {
        echo "File sudah ada. ";
        $uploadOk = 0;
    }

    // Periksa ukuran file
    if ($_FILES["photo"]["size"] > 500000) {
        echo "Ukuran file terlalu besar.";
        $uploadOk = 0;
    }

    // Hanya perbolehkan format gambar tertentu
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif") {
        echo "Hanya format JPG, JPEG, PNG & GIF yang diperbolehkan.";
        $uploadOk = 0;
    }

    // Periksa apakah $uploadOk adalah 0 karena error
    if ($uploadOk == 0) {
        echo "File tidak terupload.";
    // Jika semua periksa telah dilalui, coba upload file
    } else {
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            echo "File ". basename($_FILES["photo"]["name"]). " telah diupload.";
            
            // Update query SQL untuk menyertakan kolom image
            $sql = "UPDATE articles SET title=?, content=?, image=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('sssi', $title, $content, $target_file, $article_id);
        } else {
            echo "Terjadi kesalahan saat mengupload file.";
        }
    }
}

if ($stmt->execute()) {
    echo "Artikel berhasil diupdate.";
} else {
    echo "Terjadi kesalahan: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

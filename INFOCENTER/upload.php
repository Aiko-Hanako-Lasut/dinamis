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

// Proses upload file
if (!empty($_FILES['photo']['name'])) {
    $target_dir = "uploads/"; // Ganti dengan direktori penyimpanan file Anda
    $target_file = $target_dir . basename($_FILES['photo']['name']);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Cek ukuran file
    if ($_FILES['photo']['size'] > 10000000) { // Batas ukuran 2MB
        echo "Maaf, ukuran file terlalu besar. Batas maksimum adalah 2MB.";
        $uploadOk = 0;
    }

    // Izinkan hanya format gambar tertentu
    $allowed_formats = array("jpg", "jpeg", "png", "gif");
    if (!in_array($imageFileType, $allowed_formats)) {
        echo "Maaf, hanya file JPG, JPEG, PNG, dan GIF yang diperbolehkan.";
        $uploadOk = 0;
    }

    // Jika ada kesalahan, hentikan proses upload
    if ($uploadOk == 0) {
        echo "File tidak diunggah.";
    } else {
        // Jika semua kondisi terpenuhi, coba unggah file
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $target_file)) {
            // File berhasil diunggah, lanjutkan dengan penyimpanan data artikel ke database
            $title = $_POST['title'];
            $content = $_POST['content'];
            $image_path = $target_file;

            // Masukkan data ke dalam database
            $sql = "INSERT INTO infocenter_db (title, content, image) VALUES ('$title', '$content', '$image_path')";
            if ($conn->query($sql) === TRUE) {
                echo "Artikel berhasil diunggah.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Maaf, terjadi kesalahan saat mengunggah file.";
        }
    }
} else {
    echo "Silakan pilih file untuk diunggah.";
}

$conn->close();
?>

<?php
$servername = "localhost";
$username = "root";
$password = "12345";
$dbname = "infocenter_db";

// Buat koneksi
$conn = new mysqli('localhost', 'root', '12345', 'infocenter_db');

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil id artikel dari parameter GET
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $article_id = $_GET['id'];

    // Ambil data dari form
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Query untuk update artikel
    $sql = "UPDATE infocenter_db SET title='$title', content='$content' WHERE id=$article_id";

    if ($conn->query($sql) === TRUE) {
        echo "Artikel berhasil diperbarui.";
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    echo "ID artikel tidak valid.";
}

$conn->close();
?>

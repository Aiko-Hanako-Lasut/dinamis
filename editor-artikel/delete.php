<?php
$servername = "localhost";
$username = "root";
$password = "12345";
$dbname = "percobaan2_db";

// Buat koneksi
$conn = new mysqli('localhost', 'root', '12345', 'artikel_db');

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil id artikel dari parameter GET
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $article_id = $_GET['id'];

    // Query untuk menghapus artikel
    $sql = "DELETE FROM articles WHERE id = $article_id";

    if ($conn->query($sql) === TRUE) {
        echo "Artikel berhasil dihapus.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "ID artikel tidak valid.";
}

$conn->close();
?>

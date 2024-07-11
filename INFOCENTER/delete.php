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
if (isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])) {
    $article_id = (int) $_GET['id'];

    // Query untuk menghapus artikel menggunakan prepared statements
    $stmt = $conn->prepare("DELETE FROM infocenter_db WHERE id = ?");
    $stmt->bind_param("i", $article_id);

    if ($stmt->execute()) {
        echo "Artikel berhasil dihapus.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID artikel tidak valid.";
}

$conn->close();
?>

<?php
include('koneksi.php');

// Mengambil ID artikel dari URL
if (!isset($_GET['id'])) {
    echo "ID artikel tidak ditemukan.";
    exit;
}
$id = $_GET['id'];

// Query untuk menghapus artikel
$sql = "DELETE FROM artikel WHERE id = '$id'";

if ($koneksi->query($sql) === TRUE) {
    echo "Data artikel berhasil dihapus.";
    header("Location: index.php");
    exit;
} else {
    echo "Terjadi kesalahan saat menghapus data: " . $koneksi->error;
}

$koneksi->close();
?>

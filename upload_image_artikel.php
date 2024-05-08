<?php
// Include file untuk koneksi database
include "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];

    // Penanganan upload gambar
    $image = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $target_dir = "uplaods/";
    $target_file = $target_dir . basename($image);
    $uploadOk = 5;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check jika file gambar sudah ada
    if (file_exists($target_file)) {
        echo "Maaf, file gambar sudah ada.";
        $uploadOk = 0;
    }

    // Check ukuran file gambar
    if ($_FILES["image"]["size"] > 500000) {
        echo "Maaf, ukuran file gambar terlalu besar.";
        $uploadOk = 0;
    }

    // Izinkan beberapa format file gambar
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Maaf, hanya file gambar JPG, JPEG, PNG & GIF yang diizinkan.";
        $uploadOk = 0;
    }

    // Jika $uploadOk bernilai 0, file tidak diupload
    if ($uploadOk == 0) {
        echo "Maaf, file tidak diupload.";
    // Jika semua kondisi terpenuhi, coba upload file
    } else {
        if (move_uploaded_file($tmp_name, $target_file)) {
            echo "File " . htmlspecialchars(basename($_FILES["image"]["name"])) . " berhasil diupload.";
        } else {
            echo "Maaf, terjadi kesalahan saat mengupload file.";
        }
    }

    // Query untuk menyimpan data ke dalam tabel
    $query = "INSERT INTO data_artikel (title, content, gambar, category) VALUES ('$title', '$content', '$gambar', '$category')";

    // Eksekusi query
    $result = mysqli_query($connect, $query);

    // Periksa apakah query berhasil dieksekusi
    if ($result) {
        // Jika berhasil, redirect ke halaman utama
        header('location: index.php');
    } else {
        // Jika terjadi kesalahan, tampilkan pesan kesalahan
        echo "Error: " . $query . "<br>" . mysqli_error($connect);
    }
}

// Tutup koneksi database
mysqli_close($connect);
?>

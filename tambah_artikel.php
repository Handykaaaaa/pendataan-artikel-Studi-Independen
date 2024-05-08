<?php
include('koneksi.php');

// Proses penyimpanan artikel
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $content = $_POST["content"];
    $image = '';

    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $file = $_FILES['image'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($file["name"]);

        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            $image = $target_file;
        } else {
            echo "Terjadi kesalahan saat mengupload file.";
        }
    }

    $created_at = date("Y-m-d H:i:s");

    $sql = "INSERT INTO artikel (title, content, image, created_at) VALUES ('$title', '$content', '$image', '$created_at')";

    if ($koneksi->query($sql) === TRUE) {
        echo "Data artikel berhasil disimpan.";
        header("Location: data_artikel.php");
        exit;
    } else {
        echo "Terjadi kesalahan saat menyimpan data: " . $koneksi->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Artikel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
         header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            position: relative;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-content nav ul {
            list-style-type: none;
            display: flex;
        }

        .header-content nav ul li {
            margin-left: 20px;
        }

        .header-content nav ul li a {
            color: #fff;
            text-decoration: none;
        }
        /* Sidebar Styles */
        .sidebar {
            background-color: #f1f1f1;
            padding: 20px;
            width: 200px;
            height: 100%;
            float: left;
        }

        .sidebar a {
            padding: 6px 7px 6px 14px;
            text-decoration: none;
            font-size: 20px;
            color: #818181;
            display: ;
        }

        .sidebar a:hover {
            color: #000;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-content">
            <h1>Pendataan artikel sederhana</h1>
        </div>
    </header>
    <div class="container mt-5">
        <h1>Tambah Artikel</h1>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Judul Artikel</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="content">Konten Artikel</label>
                <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label for="image">Gambar Artikel</label>
                <input type="file" class="form-control-file" id="image" name="image">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="data_artikel.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
include('koneksi.php');

// Mengambil ID artikel dari URL
if (!isset($_GET['id'])) {
    echo "ID artikel tidak ditemukan.";
    exit;
}
$id = $_GET['id'];

// Query untuk mengambil data artikel berdasarkan ID
$sql = "SELECT * FROM artikel WHERE id = '$id'";
$result = $koneksi->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $title = $row['title'];
    $content = $row['content'];
    $image = $row['image'];
    $created_at = $row['created_at'];
} else {
    echo "Artikel tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        /* Header Styles */
        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
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

        /* Content Area Styles */
        .content {
            margin-left: 220px;
            padding: 20px;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-content">
            <h1>Pendataan Artikel Sederhana</h1>
        </div>
    </header>

    <main>
        <div class="container-fluid">
            <div class="row">>
                <div class="col-md-9 content">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5><?php echo $title; ?></h5>
                        </div>
                        <div class="card-body">
                            <?php
                            if (!empty($image)) {
                                echo "<img src='" . $image . "' alt='Gambar Artikel' class='img-fluid mb-3' width='75'>";
                            }
                            ?>
                            <p><?php echo $content; ?></p>
                            <p class="text-muted">Dibuat pada: <?php echo $created_at; ?></p>
                            <a href="index.php" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$koneksi->close();
?>

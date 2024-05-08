<?php
include('koneksi.php');

// Query untuk mengambil data artikel
$sql = "SELECT * FROM artikel";
$result = $koneksi->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Artikel</title>
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
        /* Sidebar Styles */
        .sidebar {
            background-color: #CAF4FF;
            padding: 20px;
            width: 200px;
            height: 100%;
            float: left;
        }

        .sidebar a {
            padding: 6px 7px 6px 14px;
            text-decoration: none;
            font-size: 20px;
            color: #CAF4FF;
            display: block;
        }

        .sidebar a:hover {
            color: #000;
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
            <h1>Pendataan artikel sederhana</h1>
        </div>
    </header>

    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9 content">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5><i class="fas fa-file-invoice-dollar"></i> Data Artikel</h5>
                            <a href="tambah_artikel.php" class="btn btn-primary btn-sm float-right"><i class="fas fa-plus"></i></a>
                            <a href="index.php" class="btn btn-secondary mb-3"><i class="fas fa-arrow-left"></i> Kembali</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Judul</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Gambar</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row["title"] . "</td>";
                                            echo "<td>" . $row["created_at"] . "</td>";
                                            echo "<td><img src='" . $row["image"] . "' alt='Gambar Artikel' width='100'></td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='4'>Belum ada data artikel.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
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

                

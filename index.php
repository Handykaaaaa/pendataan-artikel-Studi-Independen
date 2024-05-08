<?php
include('koneksi.php');

// Query untuk menghitung jumlah artikel
$sql_artikel = "SELECT COUNT(*) AS total_artikel FROM artikel";
$result_artikel = $koneksi->query($sql_artikel);
$row_artikel = $result_artikel->fetch_assoc();
$total_artikel = $row_artikel['total_artikel'];

// Pagination
$limit_per_page = 5;
$total_pages = ceil($total_artikel / $limit_per_page);
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($current_page - 1) * $limit_per_page;

// Pencarian
$search_query = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT * FROM artikel WHERE title LIKE '%$search_query%' ORDER BY id DESC LIMIT $offset, $limit_per_page";
$result = $koneksi->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Pendataan Artikel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        header {
            background-color: #333;
            color: #fff;
            padding: 5px 0;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .header-content h1 {
            font-size: 24px;
            font-weight: bold;
        }

        .header-content nav ul {
            list-style-type: none;
            display: flex;
            align-items: center;
        }

        .header-content nav ul li {
            margin-left: 20px;
        }

        .header-content nav ul li a {
            color: #fff;
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .header-content nav ul li a:hover {
            background-color: #4d4d4d;
        }

        .header-content nav ul li a.nav-link {
            background-color: #e74c3c;
            color: #fff;
        }

        .header-content nav ul li a.nav-link:hover {
            background-color: #c0392b;
        }

        .sidebar {
            position: fixed;
            top: 70px; /* Sesuaikan dengan tinggi header */
            left: 0;
            width: 200px;
            height: calc(100% - 80px); /* Sesuaikan dengan tinggi header */
            background-color: #f1f1f1;
            padding: 20px;
            overflow-y: auto;
        }

        .sidebar a {
            padding: 6px 7px 6px 14px;
            text-decoration: none;
            font-size: 20px;
            color: #818181;
            display: block;
        }

        .sidebar a:hover {
            color: #000;
        }

        .content {
            margin-left: 220px;
            padding: 30px;
        }


        .content {
            margin-left: 250px;
            padding: 55px;
            position: ;
        }

        
        .pagination {
            display: flex;
            justify-content: right;
            margin-top: 20px;
        }

        .pagination a {
            color: #333;
            float: left;
            padding: 8px 16px;
            text-decoration: none;
            transition: background-color .3s;
        }

        .pagination a.active {
            background-color: #4CAF50;
            color: white;
        }

        .pagination a:hover:not(.active) {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-content">
            <h1>Pendataan Artikel Sederhana</h1>
            <nav>
                <ul>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php" onclick="return confirmLogout();">Logout</a>
                    </li>
                </ul>
            </nav>
            <script>
            function confirmLogout() {
                if (confirm("Are you sure you want to logout?")) {
                    return true;
                } else {
                    return false;
                }
            }
            </script>
        </div>
    </header>


    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 sidebar">
                    <h2>Menu</h2>
                    <a href="index.php">Dashboard</a>
                    <a href="data_artikel.php">Data Artikel</a>
                </div>
                <div class="col-md-9 content">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5><i class="fas fa-file-invoice-dollar"></i> Total Artikel</h5>
                                </div>
                                <div class="card-body">
                                    <h3><?php echo $total_artikel; ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">
                            <h5><i class="fas fa-file-invoice-dollar"></i> Artikel Terbaru</h5>
                            <form class="form-inline float-right" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Cari artikel" name="search" value="<?php echo $search_query; ?>">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">Cari</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Judul</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Gambar</th>
                                        <th>Aksi</th>
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
                                            echo "<td>
                                                <a href='view.php?id=" . $row["id"] . "' class='btn btn-primary btn-sm'><i class='fas fa-eye'></i></a>
                                                <a href='edit_artikel.php?id=" . $row["id"] . "' class='btn btn-success btn-sm'><i class='fas fa-edit'></i></a>
                                                <a href='hapus_artikel.php?id=" . $row["id"] . "' class='btn btn-danger btn-sm'><i class='fas fa-trash'></i></a>
                                            </td>";
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

                    <!-- Pagination -->
                    <div class="pagination">
                        <?php
                        // Tampilkan pagination
                        for ($i = 1; $i <= $total_pages; $i++) {
                            $active = ($i == $current_page) ? "active" : "";
                            echo "<a href='?page=$i&search=$search_query' class='$active'>$i</a>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/

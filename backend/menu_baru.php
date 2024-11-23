<?php
session_start();
$current_page = 'menu_baru';
$timeout_duration = 1800; // 30 menit dalam detik

// Cek apakah user sudah login (misalnya dengan mengecek ada session 'username')
if (!isset($_SESSION['username'])) {  // Gantilah 'username' dengan nama session yang Anda gunakan
    $_SESSION['login_message'] = "Harus login terlebih dahulu!";
    header("Location: ../login/login.php"); // Arahkan ke halaman login
    exit(); // Menghentikan eksekusi lebih lanjut pada halaman ini
}
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
// Jika sudah login, proses akan lanjut ke halaman ini
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Menu Lain</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/kontenadmin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <?php
    include('../navbar.php')
    ?>

    <div class="content">
        <h1><i class="fa fa-burger"> </i> <i class="fa fa-bell-concierge"></i> Menu Baru</h1>
        <h3> Admin / Menu Baru </h3>
        <hr>
        <?php
        include('../koneksi.php'); // Koneksi ke database

        // Ambil input pencarian dari parameter URL
        $query = isset($_GET['query']) ? $_GET['query'] : '';

        // Tentukan jumlah data per halaman
        $limit = 5;

        // Ambil halaman saat ini dari URL, default ke 1
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $start = ($page - 1) * $limit;

        // Query untuk pencarian data dengan LIMIT
        $sql = "SELECT * FROM menu_baru WHERE menu LIKE ? OR keterangan LIKE ? OR harga LIKE ? LIMIT ?, ?";
        $stmt = $koneksi->prepare($sql);

        // Menambahkan wildcard pada query pencarian
        $search = "%$query%";
        $stmt->bind_param("sssii", $search, $search, $search, $start, $limit);

        // Menjalankan query
        $stmt->execute();
        $result = $stmt->get_result();

        // Query untuk menghitung jumlah total data
        $countSql = "SELECT COUNT(*) AS total FROM menu_baru WHERE menu LIKE ? OR keterangan LIKE ? OR harga LIKE ?";
        $countStmt = $koneksi->prepare($countSql);
        $countStmt->bind_param("sss", $search, $search, $search);
        $countStmt->execute();
        $countResult = $countStmt->get_result();
        $countRow = $countResult->fetch_assoc();
        $totalRows = $countRow['total'];

        // Menghitung total halaman
        $totalPages = ceil($totalRows / $limit);

        ?>

        <div class="container">
            <div class="cari">
                <!-- Form pencarian tetap di halaman yang sama -->
                <form class="d-flex" role="search" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
                    <input class="form-control me-2" type="search" name="query" placeholder="Cari data..." value="<?php echo htmlspecialchars($query); ?>" aria-label="Search">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-magnifying-glass"></i> Cari</button>
                </form>

                <a class="btn btn-primary" href="create_menubaru.php" role="button"> <i class="fa fa-plus"></i> Tambah Data</a>
                <a class="btn btn-secondary" href="menu_baru.php" role="button"><i class="fa fa-rotate-right"></i> Refresh</a>
            </div>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Galery</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php
                    $id = $start;
                    // Periksa apakah ada hasil
                    if ($result->num_rows > 0) {
                        while ($baris = $result->fetch_assoc()) {
                            $id++;
                    ?>
                            <tr>
                                <td><?php echo $id; ?></td>
                                <td><?php echo $baris['menu']; ?></td>
                                <td><?php echo $baris['keterangan']; ?></td>
                                <td><?php echo "Rp " . number_format($baris['harga'], 0, ',', '.'); ?></td>
                                <td>
                                    <?php
                                    // Menampilkan gambar dari data binary
                                    $imgData = $baris['img'];
                                    echo '<img src="data:image/jpeg;base64,' . base64_encode($imgData) . '" alt="Gambar Menu" width="50" height="50">';
                                    ?>
                                </td>
                                <td>
                                    <a class="btn btn-warning" href="edit_menubaru.php?id=<?php echo $baris['id']; ?>" role="button"><i class="fa fa-pen-to-square"></i></a>
                                    <a class="btn btn-danger" href="hapus_menubaru.php?id=<?php echo $baris['id']; ?>" role="button"><i class="fa fa-trash-can"></i></a>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='6'>Tidak ada data Menu Baru!! <strong>$query</strong></td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page - 1; ?>&query=<?php echo urlencode($query); ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>&query=<?php echo urlencode($query); ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
                <?php if ($page < $totalPages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page + 1; ?>&query=<?php echo urlencode($query); ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>

        <?php
        $stmt->close();
        $countStmt->close();
        $koneksi->close();
        ?>
    </div>
    <script src="../js/navbar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
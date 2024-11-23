<?php
session_start();
$current_page = 'booking';
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
    <title>Bootstrap demo</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/meja.css">
    <link rel="stylesheet" href="../css/kontenadmin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <?php
    include('../navbar.php')
    ?>

    <div class="content">
        <h1><i class="fa fa-handshake"> </i> Booking</h1>
        <h3> Admin / Booking </h3>
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
        $sql = "SELECT * FROM booking WHERE tanggal LIKE ? OR kode_meja LIKE ? OR nama LIKE ? LIMIT ?, ?";
        $stmt = $koneksi->prepare($sql);

        // Menambahkan wildcard pada query pencarian
        $search = "%$query%";
        $stmt->bind_param("sssii", $search, $search, $search, $start, $limit);

        // Menjalankan query
        $stmt->execute();
        $result = $stmt->get_result();

        // Query untuk menghitung jumlah total data
        $countSql = "SELECT COUNT(*) AS total FROM booking WHERE tanggal LIKE ? OR kode_meja LIKE ? OR nama LIKE ?";
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
                <a class="btn btn-warning" href="lihatmeja.php" role="button"> <i class="fa fa-eye"></i> Lihat Meja </a>
                <a class="btn btn-secondary" href="booking.php" role="button"><i class="fa fa-rotate-right"></i> Refresh</a>
            </div>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Nama</th>
                        <th scope="col">No Hp</th>
                        <th scope="col">Kode Meja</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    
                    <tr>
                    <td><?php echo $row['tanggal']; ?></td>
                    <td><?php echo $row['kode_meja']; ?></td>
                    <td><?php echo $row['nama']; ?></td>
                    <td><?php echo $row['nohp']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td>
                        <?php if ($row['status'] == 'Menunggu') { ?>
                            <!-- Form untuk konfirmasi jika status 'Menunggu' -->
                            <form action="konfirmasi_booking.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="Diterima" class="btn btn-success"><i class="fa fa-circle-check"></i></button>
                            </form>
                        <?php } else { ?>
                            <!-- Tombol konfirmasi hilang jika status sudah 'Diterima' -->
                            <button class="btn btn-secondary" disabled><i class="fa fa-user-check"></i></button>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
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
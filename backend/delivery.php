<?php
session_start();

$current_page = 'delivery';

$timeout_duration = 1800; // 30 menit dalam detik

if (!isset($_SESSION['username'])) {
    $_SESSION['login_message'] = "Harus login terlebih dahulu!";
    header("Location: ../login/login.php");
    exit();
}
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pesanan Masuk</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/kontenadmin.css">
    <link rel="stylesheet" href="../css/delivery.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <?php
    include('../navbar.php');
    include('../koneksi.php');
    ?>

    <div class="content">
        <h1><i class="fa fa-circle-check"></i> <i class="fa fa-motorcycle"></i> Pesanan Delivery</h1>
        <h3>Admin / Pesanan Delivery</h3>
        <hr>

        <?php
        $limit = 5; // Jumlah data per halaman
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $start = ($page - 1) * $limit;

        // Query untuk mengambil data pesanan dengan batasan pagination
        $queryPesanan = "SELECT nama_pemesan, status, tgl_pesan
                     FROM delivery 
                     GROUP BY nama_pemesan 
                     ORDER BY tgl_pesan DESC 
                     LIMIT ?, ?";
        $stmt = $koneksi->prepare($queryPesanan);
        $stmt->bind_param("ii", $start, $limit);
        $stmt->execute();
        $result = $stmt->get_result();

        // Query untuk menghitung total data pesanan
        $countQuery = "SELECT COUNT(DISTINCT nama_pemesan) AS total FROM delivery";
        $countResult = mysqli_query($koneksi, $countQuery);
        $countRow = mysqli_fetch_assoc($countResult);
        $totalRows = $countRow['total'];
        $totalPages = ceil($totalRows / $limit);
        if (mysqli_num_rows($result) > 0) { // Cek jika ada data
        ?>

        <div class="container">
            <div class="cari">
                <a class="btn btn-secondary" href="delivery.php" role="button"><i class="fa fa-rotate-right"></i> Refresh</a>
            </div>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Pemesan</th>
                        <th scope="col">Tanggal Pesan</th>
                        <th scope="col">Detail</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = $start + 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $nama_pemesan = $row['nama_pemesan'];
                        $tgl_pesan = $row['tgl_pesan'];
                        $status = $row['status'];

                        echo "<tr>
                        <td>{$no}</td>
                        <td>{$nama_pemesan}</td>
                        <td>{$tgl_pesan}</td>
                        <td>
                            <a href='detail_delivery.php?nama_pemesan={$nama_pemesan}' class='btn btn-warning' style='margin-right: 5px;'><i class='fa fa-eye'></i></a>";


                        echo "<td>
                            <form class='form-a' action='update_status.php' method='POST'>
                                <input type='hidden' name='nama_pemesan' value='{$nama_pemesan}'>
                                <select name='status' class='form-select'>
                                    <option value='Menunggu' " . ($status === 'Menunggu' ? 'selected' : '') . ">Menunggu</option>
                                    <option value='Disiapkan' " . ($status === 'Disiapkan' ? 'selected' : '') . ">Disiapkan</option>
                                    <option value='Diantar' " . ($status === 'Diantar' ? 'selected' : '') . ">Diantar</option>
                                    <option value='Ditolak' " . ($status === 'Ditolak' ? 'selected' : '') . ">Ditolak</option>
                                </select>
                                <button type='submit' class='btn btn-primary btn-sm mt-2'> <i class='fa fa-square-up-right'></i> Update</button>
                            </form>
                          </td>";

                        echo "  </td>
                      </tr>";
                        $no++;
                    }
                    ?>
                </tbody>
            </table>

            <!-- Pagination -->
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <?php if ($page > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($page < $totalPages): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?php echo $page + 1; ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
        <?php
        } else {
            echo "<p class='p1' >Tidak ada data pesaanan!.</p>";
        }

        // Menutup koneksi
        mysqli_close($koneksi);
        ?>
    </div>
    <script src="../js/navbar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
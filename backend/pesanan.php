<?php
session_start();

$current_page = 'pesanan';

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
    <link rel="stylesheet" href="../css/pesananadmin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<?php
include('../navbar.php');
include('../koneksi.php');
?>

<div class="content">
    <h1><i class="fa fa-circle-check"></i> Pesanan</h1>
    <h3>Admin / Pesanan Masuk</h3>
    <hr>

    <?php
    $query = isset($_GET['query']) ? $_GET['query'] : '';
    $limit = 5;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($page - 1) * $limit;

    $queryPesanan = "SELECT kode_meja, nama_pemesan, total_harga_setelah_diskon, status, tgl_pesanan 
                     FROM pesanan 
                     GROUP BY kode_meja 
                     ORDER BY tgl_pesanan DESC 
                     LIMIT ?, ?";
    $stmt = $koneksi->prepare($queryPesanan);
    $stmt->bind_param("ii", $start, $limit);
    $stmt->execute();
    $result = $stmt->get_result();

    $countQuery = "SELECT COUNT(DISTINCT kode_meja) AS total FROM pesanan";
    $countResult = mysqli_query($koneksi, $countQuery);
    $countRow = mysqli_fetch_assoc($countResult);
    $totalRows = $countRow['total'];
    $totalPages = ceil($totalRows / $limit);
    ?>

    <div class="container">
        <div class="cari">
            <a class="btn btn-secondary" href="pesanan.php" role="button"><i class="fa fa-rotate-right"></i> Refresh</a>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kode Meja</th>
                    <th scope="col">Nama Pemesan</th>
                    <th scope="col">Total Bayar</th>
                    <th scope="col">Tanggal Pesan</th>
                    <th scope="col">Detail || Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = $start + 1;
                if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $kode_meja = $row['kode_meja'];
                    $nama_pemesan = $row['nama_pemesan'];
                    $total_harga_setelah_diskon = $row['total_harga_setelah_diskon'];
                    $tgl_pesanan = $row['tgl_pesanan'];
                    $status = $row['status'];

                    echo "<tr>
                        <td>{$no}</td>
                        <td>{$kode_meja}</td>
                        <td>{$nama_pemesan}</td>
                        <td>Rp " . number_format($total_harga_setelah_diskon, 0, ',', '.') . "</td>
                        <td>{$tgl_pesanan}</td>
                        <td>
                            <a href='order_detail.php?kode_meja={$kode_meja}' class='btn btn-warning' style='margin-right: 5px;'><i class='fa fa-eye'></i></a>";

                    if ($status === 'Diproses') {
                        echo "<form method='post' action='konfirmasi_pesanan.php' style='display:inline;'>
                            <input type='hidden' name='kode_meja' value='{$kode_meja}'>
                            <button type='submit' name='konfirmasi' class='btn btn-primary'> <i class='fa fa-square-check'></i> </button>
                          </form>";
                    } else {
                        echo "Diantar";
                    }

                    echo "  </td>
                      </tr>";
                    $no++;
                
                
            }
        } else {
            echo "<tr><td colspan='6'>Tidak ada data Pesanan! <strong>$query</strong></td></tr>";
        }
        ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page - 1; echo $query ? '&query=' . urlencode($query) : ''; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $i; echo $query ? '&query=' . urlencode($query) : ''; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($page < $totalPages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page + 1; echo $query ? '&query=' . urlencode($query) : ''; ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>

</div>
<script src="../js/navbar.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

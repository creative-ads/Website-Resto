<?php
session_start();
$timeout_duration = 1800; // 30 menit dalam detik

// Cek apakah user sudah login (misalnya dengan mengecek ada session 'username')
if (!isset($_SESSION['username'])) {  // Gantilah 'username' dengan nama session yang Anda gunakan
    $_SESSION['login_message'] = "Login! untuk dapatkan kode promo diskon.";
    header("Location: ../login/login.php"); // Arahkan ke halaman login
    exit(); // Menghentikan eksekusi lebih lanjut pada halaman ini
}
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
// Query untuk mengambil semua detail pesanan dan nama pemesan berdasarkan kode_meja tertentu
include('../koneksi.php');
// Menyertakan koneksi ke database
$nama_pemesan = $_GET['nama_pemesan'];
$query = "SELECT d.menu, d.keterangan, d.jumlah_menu, d.catatan, d.total_harga_setelah_diskon, d.nama_pemesan, d.alamat, d.no_hp
        FROM delivery d
        WHERE d.nama_pemesan = '$nama_pemesan'";
$result = mysqli_query($koneksi, $query);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Pesanan</title>
    <link rel="stylesheet" href="../css/kontenadmin.css">
    <link rel="stylesheet" href="../css/detail.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php
    include('../navbar.php');
    ?>
    <div class="content">
    <div class="container me-4">
    <h1><i class="fa fa-shop"></i> <i class="fa fa-motorcycle"></i> Detail Pesanan Delivery</h1>
        <h3> Admin / Delivery / Detail Pesanan </h3>
        <hr>
        
            <?php
                // Ambil nama pemesan dari query pertama dan tampilkan
                $nama_pemesan = $_GET['nama_pemesan'];

                $query_pesanan = "
                SELECT 
                    nama_pemesan, 
                    total_harga_setelah_diskon 
                FROM delivery 
                WHERE nama_pemesan = '$nama_pemesan' 
                LIMIT 1";
                $result_pesanan = mysqli_query($koneksi, $query_pesanan);
                $row_pesanan = mysqli_fetch_assoc($result_pesanan);

                if ($row_pesanan) {
                    // Tampilkan Nama Pemesan dan Total Bayar
                    echo "<p class='h2'><strong>Nama Pemesan:</strong> <span> {$row_pesanan['nama_pemesan']} </span> </p>";
                    echo "<p class='h3'><strong>Total Bayar:</strong> <span> Rp " . number_format($row_pesanan['total_harga_setelah_diskon'], 0, ',', '.') . " </span></p>";
        
                } else {
                    echo "<p>Data pesanan tidak ditemukan.</p>";
                }
            ?>
        </p>
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>Menu</th>
                    <th>Jumlah Menu</th>
                    <th>Keterangan</th>
                    <th>Catatan</th>

                    <th>Alamat</th>
                    <th>NO Hp</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>{$row['menu']}</td>
                            <td>{$row['jumlah_menu']}</td>
                            <td>{$row['keterangan']}</td>
                            <td>{$row['catatan']}</td>
                            <td>{$row['alamat']}</td>
                            <td>{$row['no_hp']}</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
        <div class="d-md-flex justify-content-md-end ms-auto me-5">
            <a href="delivery.php" class="btn btn-primary"><i class="fa fa-clock-rotate-left"></i> Kembali</a>
        </div>
    </div>
    </div>
    <script src="../js/navbar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

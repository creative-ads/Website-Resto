<?php
session_start();
$current_page = 'dashboard';
include('../koneksi.php');
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

// Hitung jumlah total item menu yang dipesan
$queryTotalMenu = "SELECT SUM(jumlah_menu) as total_menu_dipesan FROM pesanan";
$resultTotalMenu = mysqli_query($koneksi, $queryTotalMenu);
$totalMenuDipesan = mysqli_fetch_assoc($resultTotalMenu)['total_menu_dipesan'];

// Hitung total keseluruhan pendapatan
$queryPendapatan = "SELECT total_harga_setelah_diskon as total_pendapatan FROM pesanan";
$resultPendapatan = mysqli_query($koneksi, $queryPendapatan);
$totalPendapatan = mysqli_fetch_assoc($resultPendapatan)['total_pendapatan'];

// Hitung jumlah seluruh menu dari tabel food, drink, cemilan, dan menu_baru
$queryTotalFood = "SELECT COUNT(*) as total_food FROM food";
$resultTotalFood = mysqli_query($koneksi, $queryTotalFood);
$totalFood = mysqli_fetch_assoc($resultTotalFood)['total_food'];

$queryTotalDrink = "SELECT COUNT(*) as total_drink FROM drink";
$resultTotalDrink = mysqli_query($koneksi, $queryTotalDrink);
$totalDrink = mysqli_fetch_assoc($resultTotalDrink)['total_drink'];

$queryTotalCemilan = "SELECT COUNT(*) as total_cemilan FROM cemilan";
$resultTotalCemilan = mysqli_query($koneksi, $queryTotalCemilan);
$totalCemilan = mysqli_fetch_assoc($resultTotalCemilan)['total_cemilan'];

$queryTotalMenuBaru = "SELECT COUNT(*) as total_menu_baru FROM menu_baru";
$resultTotalMenuBaru = mysqli_query($koneksi, $queryTotalMenuBaru);
$totalMenuBaru = mysqli_fetch_assoc($resultTotalMenuBaru)['total_menu_baru'];

// Total seluruh menu
$totalSeluruhMenu = $totalFood + $totalDrink + $totalCemilan + $totalMenuBaru;

// Total pendapatan per bulan (bulan ini)
$queryPendapatanBulanan = "SELECT SUM(total_harga_setelah_diskon) AS total_pendapatan_bulanan FROM pesanan
    WHERE MONTH(tgl_pesanan) = MONTH(CURRENT_DATE())
    AND YEAR(tgl_pesanan) = YEAR(CURRENT_DATE())";

$resultPendapatanBulanan = mysqli_query($koneksi, $queryPendapatanBulanan);
$totalPendapatanBulanan = mysqli_fetch_assoc($resultPendapatanBulanan)['total_pendapatan_bulanan'];

// Total pendapatan per minggu (7 hari terakhir)
$queryPendapatanMingguan = "SELECT SUM(total_harga_setelah_diskon) AS total_pendapatan_mingguan FROM pesanan
    WHERE tgl_pesanan >= DATE_SUB(CURRENT_DATE(), INTERVAL 7 DAY)";

$resultPendapatanMingguan = mysqli_query($koneksi, $queryPendapatanMingguan);
$totalPendapatanMingguan = mysqli_fetch_assoc($resultPendapatanMingguan)['total_pendapatan_mingguan'];

// Total pendapatan per hari
$query = "SELECT DATE(tgl_pesanan) AS tanggal, SUM(total_harga_setelah_diskon) AS total_pendapatan_harian 
          FROM pesanan 
          WHERE DATE(tgl_pesanan) = CURDATE() 
          GROUP BY DATE(tgl_pesanan)";

$result = mysqli_query($koneksi, $query);

// Cek apakah ada data yang ditemukan
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $pendapatan_harian = $row['total_pendapatan_harian'];
} else {
    $pendapatan_harian = 0; // Jika tidak ada data, set menjadi 0
}

// Tutup koneksi
mysqli_close($koneksi);


?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/dash.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php
    include('../navbar.php')
    ?>

    <div class="content">
        <div class="head-title">
            <div class="left">
                <h1> <i class="fa fa-chart-pie"> </i> Dashboard</h1>
            </div>
            <hr>
            <a href="#" class="btn-download">
                <i class="fa fa-download"></i>
                <span class="text">Download PDF</span>
            </a>
        </div>
        <hr>
        <ul class="box-info">
            <li>
                <i class="fa fa-calendar-week"></i>
                <span class="text">
                    <h3><?php echo $totalMenuDipesan; ?></h3>
                    <p>Pesanan</p>
                </span>
            </li>
            <li>
                <i class="fa fa-book"></i>
                <span class="text">
                    <h3><?php echo $totalSeluruhMenu; ?></h3>
                    <p>Menu Resto</p>
                </span>
            </li>
            <li>
                <i class="fa fa-dollar-sign"></i>
                <span class="text">
                    <h3>Rp <?php echo number_format($totalPendapatan, 0, ',', '.'); ?></h3>
                    <p>Pendapatan</p>
                </span>
            </li>
        </ul>
        <div class="container">
            <div class="row justify-content-center" style="gap: 1rem;">
                <div class="col-6 col-md-2" style="background-color: #a3e635; color: #721c24;">
                    <h3>Pendapatan Bulanan</h3>
                    <p>Rp <?php echo number_format($totalPendapatanBulanan, 0, ',', '.'); ?></p>
                </div>
                <div class="col-6 col-md-2" style="background-color: #a3e635; color: #721c24;">
                    <h3>Pendapatan Mingguan</h3>
                    <p>Rp <?php echo number_format($totalPendapatanMingguan, 0, ',', '.'); ?></p>
                </div>
                <div class="col-6 col-md-2" style="background-color: #a3e635; color: #721c24;">
                    <h3>Pendapatan Harian</h3>
                    <p>Rp <?php echo number_format($pendapatan_harian, 0, ',', '.'); ?></p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center" style="gap: 1rem;">
                <div class="col-10 col-md-2" style="background-color: #facc15; color: #721c24;">
                    <div class="one"> Menu Favorit </div>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Menu</th>
                                <th>Keterangan</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                            </tr>
                        </tbody>
                    </table>

                </div>
                <div class="col-10 col-md-2" style="background-color: #facc15; color: #721c24;">
                    <div class="one"> Pelanggan Setia </div>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Pengeluaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/navbar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
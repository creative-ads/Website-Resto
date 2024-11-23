<?php
include('../koneksi.php'); // Koneksi ke database

// Ambil kode_meja dari URL
$kode_meja = $_GET['kode_meja'];

// Query untuk mengambil semua detail pesanan dan nama pemesan berdasarkan kode_meja tertentu
$query = "SELECT p.nama_pemesan, p.menu, p.keterangan, p.jumlah_menu, p.catatan
          FROM pesanan p
          WHERE p.kode_meja = '$kode_meja'";
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
    <h1><i class="fa fa-right-from-bracket"></i> Detail Pesanan</h1>
        <h3> Admin / Pesanan / Detail Pesanan </h3>
        <hr>
        <p><strong>Kode Meja:</strong> <?= $kode_meja ?></p>
        <p><strong>Nama Pemesan:</strong> 
            <?php
                // Ambil nama pemesan dari query pertama dan tampilkan
                $query_pemesan = "SELECT nama_pemesan FROM pesanan WHERE kode_meja = '$kode_meja' LIMIT 1";
                $result_pemesan = mysqli_query($koneksi, $query_pemesan);
                $row_pemesan = mysqli_fetch_assoc($result_pemesan);
                echo $row_pemesan['nama_pemesan'];
            ?>
        </p>
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>Menu</th>
                    <th>Keterangan</th>
                    <th>Jumlah Menu</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>{$row['menu']}</td>
                            <td>{$row['keterangan']}</td>
                            <td>{$row['jumlah_menu']}</td>
                            <td>{$row['catatan']}</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
        <div class="d-md-flex justify-content-md-end ms-auto me-5">
            <a href="pesanan.php" class="btn btn-primary"><i class="fa fa-clock-rotate-left"></i> Kembali</a>
        </div>
    </div>
    </div>
    <script src="../js/navbar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

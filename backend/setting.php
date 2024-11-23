<?php
session_start();
$current_page = 'setting';
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
    <title>Foods</title>

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
        <h1><i class="fa fa-gear"> </i> Tampilan Website</h1>
        <h3> Admin / Setting </h3>
        <hr>
        <?php
        include('../koneksi.php'); // Koneksi ke database
        $query = "SELECT id, logo, banner1, banner2, banner3 FROM setting";
        $result = $koneksi->query($query);
        ?>

        <div class="container">
            <h6 style="color:red"> <b>Jangan upload lebih dari satu, file di upload untuk halaman depan !! </b></h6>
            <div class="cari">
                 <a class="btn btn-primary" href="create_setting.php" role="button"> <i class="fa fa-plus"></i> Tambah Data</a>
                <a class="btn btn-secondary" href="setting.php" role="button"><i class="fa fa-rotate-right"></i> Refresh</a>
            </div>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Logo</th>
                        <th scope="col">Banner 1</th>
                        <th scope="col">Banner 2</th>
                        <th scope="col">Banner 3</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php
                    // Periksa apakah ada hasil
                    if ($result->num_rows > 0) {
                        while ($baris = $result->fetch_assoc()) {
                            
                    ?>
                            <tr>

                                <td>
                                    <?php
                                    // Menampilkan gambar dari data binary
                                    $imgData = $baris['logo'];
                                    echo '<img src="data:image/jpeg;base64,' . base64_encode($imgData) . '" alt="Gambar Menu" width="50" height="50">';
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    // Menampilkan gambar dari data binary
                                    $imgData = $baris['banner1'];
                                    echo '<img src="data:image/jpeg;base64,' . base64_encode($imgData) . '" alt="Gambar Menu" width="50" height="50">';
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    // Menampilkan gambar dari data binary
                                    $imgData = $baris['banner2'];
                                    echo '<img src="data:image/jpeg;base64,' . base64_encode($imgData) . '" alt="Gambar Menu" width="50" height="50">';
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    // Menampilkan gambar dari data binary
                                    $imgData = $baris['banner3'];
                                    echo '<img src="data:image/jpeg;base64,' . base64_encode($imgData) . '" alt="Gambar Menu" width="50" height="50">';
                                    ?>
                                </td>
                                <td>
                                    <a class="btn btn-warning" href="lihat_setting.php?id=<?php echo $baris['id']; ?>" role="button"><i class="fa fa-pen-to-square"></i></a>
                                    <a class="btn btn-danger" href="hapus_setting.php?id=<?php echo $baris['id']; ?>" role="button"><i class="fa fa-trash-can"></i></a>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='6'>Tidak ada data Banner!! <strong></strong></td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>


        <?php
        $koneksi->close();
        ?>
    </div>
    <script src="../js/navbar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
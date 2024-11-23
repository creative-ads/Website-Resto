<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/kontenadmin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php include('../navbar.php') ?>

    <div class="content">
        <h1> fooot</h1>
        <h3> Admin / Food </h3>
        <hr>
        <?php
        include('../koneksi.php'); // Koneksi ke database

        // Ambil input pencarian dari parameter URL
        $query = isset($_GET['query']) ? $_GET['query'] : '';

        // Query untuk pencarian data
        $sql = "SELECT * FROM food WHERE menu LIKE ? OR keterangan LIKE ? OR harga LIKE ?";
        $stmt = $koneksi->prepare($sql);

        // Menambahkan wildcard pada query pencarian
        $search = "%$query%";
        $stmt->bind_param("sss", $search, $search, $search);

        // Menjalankan query
        $stmt->execute();
        $result = $stmt->get_result();

        ?>

        <div class="container">
            <div class="cari">
            <!-- Form pencarian tetap di halaman yang sama -->
            <form class="d-flex" role="search" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
                <input class="form-control me-2" type="search" name="query" placeholder="Cari data..." value="<?php echo htmlspecialchars($query); ?>" aria-label="Search">
                <button class="btn btn-primary" type="submit">Cari</button>
            </form>

            <a class="btn btn-primary" href="createfood.php" role="button">Tambah Data</a>
            <a class="btn btn-secondary" href="foot.php" role="button">Refress</a>
            </div>

            <table class="table table-warning">
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
                    $id = 0;
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
                                    <a class="btn btn-warning" href="editfood.php?id=<?php echo $baris['id']; ?>" role="button">Edit</a>
                                    <a class="btn btn-danger" href="hapusfood.php?id=<?php echo $baris['id']; ?>" role="button">Hapus</a>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='6'>Tidak ada data ditemukan untuk pencarian: <strong>$query</strong></td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php
        $stmt->close();
        $koneksi->close();
        ?>
    </div>
    <script src="../js/navbar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
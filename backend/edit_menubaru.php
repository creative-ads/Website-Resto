<?php
include('../koneksi.php');
$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM menu_baru WHERE id='$id'");
$baris = mysqli_fetch_array($data);

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Menu Lain</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/kontenadmin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php include('../navbar.php') ?>

    <div class="content">
        <div class="form-container">
            <form action="update_menubaru.php" method="post" enctype="multipart/form-data">
                <h2 class="form-title">Edit Menu Baru</h2>

                <!-- Input Menu -->
                <div class="form-group">
                    <label for="menu">Menu</label>
                    <input value="<?php echo $baris['menu']; ?>" type="text" class="form-control" id="menu" name="menu" placeholder="Masukkan judul menu" required>
                </div>
                <input name="id" value="<?php echo $id; ?>" hidden>

                <!-- Input Keterangan -->
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <input value="<?php echo $baris['keterangan']; ?>" type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Masukkan keterangan" required>
                </div>

                <!-- Input Harga -->
                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input value="<?php echo $baris['harga']; ?>" type="number" class="form-control" id="harga" name="harga" placeholder="Masukkan harga" required>
                </div>

                <div class="form-group">
                    <label for="img">Upload Gambar</label>

                    <!-- Menampilkan gambar dari database (binary data) -->
                    <?php if (!empty($baris['img'])): ?>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($baris['img']); ?>" alt="Gambar Menu" width="100" height="100">
                        <br><br>
                        <small>Gambar sebelumnya</small>
                    <?php endif; ?>

                    <!-- Input untuk memilih gambar baru -->
                    <input type="file" class="form-control-file" id="img" name="img" accept="image/*">
                </div>


                <!-- Tombol Submit -->
                <button type="submit" class="btn-submit">Simpan</button>
            </form>
        </div>
    </div>

    <script src="../js/navbar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
<?php
include('../koneksi.php');
$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM kupon WHERE id='$id'");
$baris = mysqli_fetch_array($data);

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Kupon</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/kontenadmin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php include('../navbar.php') ?>

    <div class="content">
        <div class="form-container">
            <form action="updatekupon.php" method="post" enctype="multipart/form-data">
                <h2 class="form-title">Edit Kupon Diskon</h2>

                <!-- Input Menu -->
                <div class="form-group">
                    <label for="kode_diskon"> Kode Kupon</label>
                    <input value="<?php echo $baris['kode_diskon']; ?>" type="text" class="form-control" id="kode_diskon" name="kode_diskon" placeholder="Masukkan kode diskon" required>
                </div>
                <input name="id" value="<?php echo $id; ?>" hidden>

                <!-- Input Harga -->
                <div class="form-group">
                    <label for="harga">Jumlah Diskon</label>
                    <input value="<?php echo $baris['harga']; ?>" type="number" class="form-control" id="harga" name="harga" placeholder="Masukkan jumlah diskon" required>
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
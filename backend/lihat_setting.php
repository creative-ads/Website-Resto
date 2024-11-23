<?php
include('../koneksi.php');
$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM setting WHERE id='$id'");
$baris = mysqli_fetch_array($data);

?>
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
        <div class="form-container">
            <form action="update_setting.php" method="post" enctype="multipart/form-data">
                <h2 class="form-title">Edit Tampilan Website</h2>

                <!-- Input Menu -->
               
                <input name="id" value="<?php echo isset($id) ? $id : ''; ?>" hidden>

                <div class="form-group">
                 
                    <label for="img">Logo</label>

                    <!-- Menampilkan gambar dari database (binary data) -->
                    <?php if (!empty($baris['logo'])): ?>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($baris['logo']); ?>" alt="Gambar Menu" width="100" height="100">
                        <br><br>
                        <small>Gambar sebelumnya</small>
                    <?php endif; ?>

                    <!-- Input untuk memilih gambar baru -->
                    <input type="file" class="form-control-file" id="logo" name="logo" accept="image/*">
                </div>
                
                <div class="form-group">
                    <label for="img">Banner 1</label>

                    <!-- Menampilkan gambar dari database (binary data) -->
                    <?php if (!empty($baris['banner1'])): ?>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($baris['banner1']); ?>" alt="Gambar Menu" width="100" height="100">
                        <br><br>
                        <small>Gambar sebelumnya</small>
                    <?php endif; ?>

                    <!-- Input untuk memilih gambar baru -->
                    <input type="file" class="form-control-file" id="banner1" name="banner1" accept="image/*">
                </div>

                <div class="form-group">
                    <label for="img">Banner 2</label>

                    <!-- Menampilkan gambar dari database (binary data) -->
                    <?php if (!empty($baris['banner2'])): ?>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($baris['banner2']); ?>" alt="Gambar Menu" width="100" height="100">
                        <br><br>
                        <small>Gambar sebelumnya</small>
                    <?php endif; ?>

                    <!-- Input untuk memilih gambar baru -->
                    <input type="file" class="form-control-file" id="banner2" name="banner2" accept="image/*">
                </div>

                <div class="form-group">
                    <label for="img">Banner 3</label>

                    <!-- Menampilkan gambar dari database (binary data) -->
                    <?php if (!empty($baris['banner3'])): ?>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($baris['banner3']); ?>" alt="Gambar Menu" width="100" height="100">
                        <br><br>
                        <small>Gambar sebelumnya</small>
                    <?php endif; ?>

                    <!-- Input untuk memilih gambar baru -->
                    <input type="file" class="form-control-file" id="banner3" name="banner3" accept="image/*">
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
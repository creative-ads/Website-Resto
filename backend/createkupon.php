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
            <form action="uploadkupon.php" method="post" enctype="multipart/form-data">
                <h2 class="form-title">Tambah Kupon Diskon</h2>

                <!-- Input Menu -->
                <div class="form-group">
                    <label for="menu">Kode Kupon</label>
                    <input type="text" class="form-control" id="kupon" name="kode_diskon" placeholder="Masukkan kode kupon" required>
                </div>

                <!-- Input Keterangan -->
                <div class="form-group">
                    <label for="keterangan">Diskon</label>
                    <input type="number" class="form-control" id="diskon" name="harga" placeholder="Masukkan jumlah dikson" required>
                </div>
                <!-- Tombol Submit -->
                <button type="submit" class="btn-submit">Tambah</button>
            </form>
        </div>
    </div>

    <script src="../js/navbar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
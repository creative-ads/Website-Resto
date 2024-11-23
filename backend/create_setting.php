<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Setting Admin</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/kontenadmin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php include('../navbar.php') ?>

    <div class="content">
        <div class="form-container">
            <form action="upload_setting.php" method="post" enctype="multipart/form-data">
                <h2 class="form-title">Settting Tampilan Website</h2>

                <!-- Input Menu -->

                <!-- Upload Gambar -->
                <div class="form-group">
                    <label for="logo">Logo</label>
                    <input type="file" class="form-control-file" id="logo" name="logo" accept="image/*" required>
                </div>
                <div class="form-group">
                    <label for="banner1">Banner 1</label>
                    <input type="file" class="form-control-file" id="banner1" name="banner1" accept="image/*" required>
                </div>
                <div class="form-group">
                    <label for="banner2">Banner 2</label>
                    <input type="file" class="form-control-file" id="banner2" name="banner2" accept="image/*" required>
                </div>
                <div class="form-group">
                    <label for="banner3">Banner 3</label>
                    <input type="file" class="form-control-file" id="banner3" name="banner3" accept="image/*" required>
                </div>

                <!-- Tombol Submit -->
                <button type="submit" class="btn-submit">Submit</button>
            </form>
        </div>
    </div>

    <script src="../js/navbar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
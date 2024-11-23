<?php
include('koneksi.php');
$data = mysqli_query($koneksi, "SELECT * FROM setting ");
$baris = mysqli_fetch_array($data);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>


<body>
    
    <input name="id" value="<?php echo isset($id) ? $id : ''; ?>" hidden>
    <?php if (!empty($baris['logo'])): ?>
    <img src="data:image/jpeg;base64,<?php echo base64_encode($baris['logo']); ?>" class="logo" alt="Logo">
    <?php endif; ?>
    <div class="card-container">
    
        <!-- Logo di atas card -->

        <div class="card">
            <div class="card-body">
                <img src="uploads/image1.png" class="card-img-top" alt="Gambar 2"> <!-- Gambar dalam card -->
                <h5 class="card-title">Yuk Pesan</h5>
                <p class="card-text">Pesan menu makanan disini</p>
                <a href="frontend/home.php" class="btn btn-primary"><i class="fa fa-palette"></i> Let's Go </a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <img src="uploads/image1.png" class="card-img-top" alt="Gambar 2"> <!-- Gambar dalam card -->
                <h5 class="card-title">Pegawai</h5>
                <p class="card-text">Disini khusus untuk pegawai resto !!</p>
                <a href="login/login.php" class="btn btn-primary"><i class="fa fa-user-lock"></i> Disini</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
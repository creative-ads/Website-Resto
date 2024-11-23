<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/auth.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
    <style>
        .alert {
            margin-top: 10px;
            padding: 10px 20px;
            /* Mengatur jarak padding */
            font-size: 14px;
            /* Ukuran font lebih kecil */
            margin-bottom: 15px;
            /* Jarak bawah alert */
            border-radius: 5px;
            /* Menambahkan rounded corners */
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Cek apakah ada pesan login yang belum login -->

        <div class="form-container">

            <?php
            if (isset($_SESSION['login_message'])) {
                echo '<div class="alert alert-warning alert-dismissible " role="alert" ">
                        <strong>Info!</strong> ' . $_SESSION['login_message'] . '
                    </div>';
                // Hapus pesan setelah ditampilkan
                unset($_SESSION['login_message']);
            }
            ?>

            <div class="header">
                <img src="../uploads/logo.png" alt="Logo"> <!-- Ganti dengan path logo Anda -->
                <h2>Login</h2>

            </div>
            <form action="login-process.php" method="POST">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
                <p class="switch"> <span>Belum punya akun? </span> <a href="register.php">Daftar</a></p>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
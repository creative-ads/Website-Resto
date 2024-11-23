<?php
session_start(); // Start session di atas halaman

include('../koneksi.php'); // Pastikan koneksi ke database sudah benar

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];  // Email yang dimasukkan
    $password = $_POST['password'];  // Password yang dimasukkan

    // Query untuk mengambil data pengguna berdasarkan email
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param('s', $email);  // Binding email ke query
    $stmt->execute();  // Menjalankan query
    $result = $stmt->get_result();  // Mengambil hasil query

    if ($result->num_rows > 0) {

        $user = $result->fetch_assoc();  // Mengambil data user

        // Verifikasi password yang dimasukkan dengan password hash dari database
        if (password_verify($password, $user['password'])) {
            // Jika password valid, set session untuk menyimpan informasi login
            $_SESSION['user_id'] = $user['id_user'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Redirect berdasarkan role pengguna
            if ($user['role'] == 'admin') {
                header("location: ../backend/dashboard.php");
                exit();
            } else {
                header("location: ../frontend/diskon.php");
                
            }
        } else {
            // Jika password tidak cocok
            $_SESSION['login_message'] = "Password salah!";
            header("location: login.php");
        }
    } else {
        $_SESSION['login_message'] = "Ada belum pernah melakukan daftar!";
        header("location: login.php");
    }
}
?>

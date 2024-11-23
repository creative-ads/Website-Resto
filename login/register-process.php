<?php
// Koneksi ke database
session_start(); // Start session di atas halaman
include('../koneksi.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];  // Ambil password sebelum hashing
    $confirm_password = $_POST['confirm_password'];

    // Validasi password dan confirm password
    if ($password == $confirm_password) {
        // Enkripsi password setelah validasi
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Role otomatis user
        $role = 'user';

        // Insert data ke database
        $query = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param('ssss', $username, $email, $hashed_password, $role);

        if ($stmt->execute()) {
            echo "Registration successful!";
            header('Location: login.php');
            exit; // Pastikan exit setelah header redirect
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        $_SESSION['error'] = "Password anda tidak cocok!";
        header("Location: register.php");
        exit();
       
    }
}

?>

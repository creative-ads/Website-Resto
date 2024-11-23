<?php
include('../koneksi.php');

// Cek jika form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role']; // Ambil data role dari form

    // Enkripsi password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Persiapkan query untuk menambah user baru
    $sql = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("ssss", $username, $email, $hashed_password, $role);

    if ($stmt->execute()) {
        echo "User berhasil ditambahkan!";
        header('Location: user.php');
    } else {
        echo "Gagal menambahkan user: " . $koneksi->error;
    }

    $stmt->close();
}
$koneksi->close();
?>

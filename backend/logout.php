<?php

include ('./koneksi.php');
// Memulai session
session_start();
session_unset();  // Menghapus semua session variables
session_destroy();  // Menghancurkan session
setcookie(session_name(), '', time() - 3600, '/'); // Menghapus cookie session
header('Location: ../login/login.php'); // Redirect ke halaman login
exit();
?>

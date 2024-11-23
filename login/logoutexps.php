<?php

include ('./koneksi.php');
// Memulai session
session_start();

// Menghapus semua session yang ada
session_unset();

// Menghancurkan session
session_destroy();

// Mengarahkan pengguna ke halaman login
header("Location: ../index.php");
exit();
?>

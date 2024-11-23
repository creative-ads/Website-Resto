<?php
include('../koneksi.php'); // Pastikan koneksi ke database benar

if (isset($_POST['konfirmasi'])) {
    $kode_meja = $_POST['kode_meja'];

    // Query untuk memperbarui status menjadi 'Diterima'
    $update_query = "UPDATE pesanan SET status = 'Diterima' WHERE kode_meja = '$kode_meja'";
    $update_result = mysqli_query($koneksi, $update_query);

    if ($update_result) {
        // Kembali ke halaman pesanan setelah konfirmasi
        header("Location: pesanan.php");
        exit();
    } else {
        echo "Gagal mengonfirmasi pesanan.";
    }
}
?>

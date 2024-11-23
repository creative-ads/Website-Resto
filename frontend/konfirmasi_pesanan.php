<?php
include '../koneksi.php'; // Pastikan koneksi ke database sudah benar

if (isset($_POST['konfirmasi'])) {
    $kode_meja = $_POST['kode_meja'];

    // Query untuk mengubah status pesanan menjadi 'Diterima'
    $update_query = "UPDATE pesanan SET status = 'Diterima' WHERE kode_meja = '$kode_meja'";
    $update_result = mysqli_query($koneksi, $update_query);

    // Cek apakah query berhasil
    if ($update_result) {
        // Redirect kembali ke halaman pesanan
        header("Location: pesanan.php");
        exit();
    } else {
        echo "Gagal mengonfirmasi pesanan.";
    }
}
?>

<?php
include ('../koneksi.php'); // Pastikan koneksi ke database sudah benar

if (isset($_POST['konfirmasi'])) {
    $nama_pemesan = $_POST['nama_pemesan'];

    // Query untuk mengubah status pesanan menjadi 'Diterima'
    $update_query = "UPDATE delivery SET status = 'Diterima' WHERE nama_pemesan = '$nama_pemesan'";
    $update_result = mysqli_query($koneksi, $update_query);

    // Cek apakah query berhasil
    if ($update_result) {
        // Redirect kembali ke halaman pesanan
        header("Location: status_delivery.php");
        exit();
    } else {
        echo "Gagal mengonfirmasi pesanan.";
    }
}
?>

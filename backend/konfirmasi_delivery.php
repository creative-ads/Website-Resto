<?php
include('../koneksi.php'); // Pastikan koneksi ke database benar

if (isset($_POST['konfirmasi'])) {
    $nama_pemesan = $_POST['nama_pemesan'];

    // Query untuk memperbarui status menjadi 'Diterima'
    $update_query = "UPDATE delivery SET status = 'Disiapkan' WHERE nama_pemesan = '$nama_pemesan'";
    $update_result = mysqli_query($koneksi, $update_query);

    if ($update_result) {
        // Kembali ke halaman pesanan setelah konfirmasi
        header("Location: delivery.php");
        exit();
    } else {
        echo "Gagal mengonfirmasi pesanan.";
    }
}
if (isset($_POST['diantar'])) {
    $nama_pemesan = $_POST['nama_pemesan'];

    // Query untuk memperbarui status menjadi 'Diterima'
    $update_query = "UPDATE delivery SET status = 'Diantar' WHERE nama_pemesan = '$nama_pemesan'";
    $update_result = mysqli_query($koneksi, $update_query);

    if ($update_result) {
        // Kembali ke halaman pesanan setelah konfirmasi
        header("Location: delivery.php");
        exit();
    } else {
        echo "Gagal mengonfirmasi pesanan.";
    }
}
?>

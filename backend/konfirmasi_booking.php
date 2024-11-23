<?php
include('../koneksi.php'); // Pastikan koneksi ke database benar

if (isset($_POST['Diterima'])) {
    $id = $_POST['id']; // Ambil id_booking dari form

    // Query untuk memperbarui status menjadi 'Diterima'
    $update_query = "UPDATE booking SET status = 'Diterima' WHERE id = '$id'";
    $update_result = mysqli_query($koneksi, $update_query);

    if ($update_result) {
        // Kembali ke halaman pesanan setelah konfirmasi
        header("Location: booking.php");
        exit();
    } else {
        echo "Gagal mengonfirmasi pesanan.";
    }
}
?>

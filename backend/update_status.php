<?php
// Ambil data yang dikirim dari form
if (isset($_POST['nama_pemesan']) && isset($_POST['status'])) {
    $nama_pemesan = $_POST['nama_pemesan'];
    $status = $_POST['status'];

    // Koneksi ke database
    include('../koneksi.php');
    // Query untuk update status
    $query = "UPDATE delivery SET status = ? WHERE nama_pemesan = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("ss", $status, $nama_pemesan);

    if ($stmt->execute()) {
        // Redirect kembali ke halaman pesanan setelah update
        header('Location: delivery.php');
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

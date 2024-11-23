<?php
include('../koneksi.php');

$id = $_POST['id'];
$kode_diskon = $_POST['kode_diskon'];
$harga = $_POST['harga'];

    // Jika tidak ada file gambar yang diunggah, update data lainnya tanpa mengganti gambar
    $sql = "UPDATE kupon SET kode_diskon = ?, harga = ? WHERE id = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("ssi", $kode_diskon, $harga, $id);


if ($stmt->execute()) {
    echo "Data berhasil diupdate.";
    header("location:kupon.php");
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$koneksi->close();
?>

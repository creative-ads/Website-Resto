<?php
include('../koneksi.php');

$id = $_POST['id'];
$kode_meja = $_POST['kode_meja'];
$lokasi = $_POST['lokasi'];

    // Jika tidak ada file gambar yang diunggah, update data lainnya tanpa mengganti gambar
    $sql = "UPDATE meja SET kode_meja = ?, lokasi = ? WHERE id = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("ssi", $kode_meja, $lokasi, $id);


if ($stmt->execute()) {
    echo "Data berhasil diupdate.";
    header("location:lihatmeja.php");
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$koneksi->close();
?>

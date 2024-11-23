<?php
include('../koneksi.php');

$id = $_POST['id'];
$menu = $_POST['menu'];
$keterangan = $_POST['keterangan'];
$harga = $_POST['harga'];

// Periksa apakah ada file gambar yang diunggah
if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
    // Jika ada file gambar yang diunggah, baca file gambar dan simpan dalam database
    $fileData = file_get_contents($_FILES['img']['tmp_name']);
    // Update query dengan gambar baru
    $sql = "UPDATE cemilan SET menu = ?, keterangan = ?, harga = ?, img = ? WHERE id = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("ssdsi", $menu, $keterangan, $harga, $fileData, $id);
} else {
    // Jika tidak ada file gambar yang diunggah, update data lainnya tanpa mengganti gambar
    $sql = "UPDATE cemilan SET menu = ?, keterangan = ?, harga = ? WHERE id = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("ssdi", $menu, $keterangan, $harga, $id);
}

if ($stmt->execute()) {
    echo "Data berhasil diupdate.";
    header("location:cemilan.php");
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$koneksi->close();
?>

<?php

    include('../koneksi.php');

    $menu = $_POST['menu'];
    $keterangan = $_POST['keterangan'];
    $harga = $_POST['harga'];

    // Memeriksa apakah file img diunggah dengan benar
    if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
        // Menyimpan informasi file
        $fileData = file_get_contents($_FILES['img']['tmp_name']);

        // Query untuk menyimpan data ke database
    $sql = "INSERT INTO menu_baru (menu, keterangan, harga, img) VALUES (?, ?, ?, ?)";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("ssds", $menu, $keterangan, $harga, $fileData);

    if ($stmt->execute()) {
        echo "Data berhasil disimpan.";
        header("location: menu_baru.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Tidak ada file yang diunggah atau terjadi kesalahan saat upload.";
}

$koneksi->close();
?>
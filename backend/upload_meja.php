<?php

    include('../koneksi.php');

    $kode_meja = $_POST['kode_meja'];
    $lokasi = $_POST['lokasi'];


        // Query untuk menyimpan data ke database
    $sql = "INSERT INTO meja (kode_meja, lokasi) VALUES (?, ?)";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("ss", $kode_meja, $lokasi);

    if ($stmt->execute()) {
        echo "Data berhasil disimpan.";
        header("location:lihatmeja.php");

    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();


$koneksi->close();
?>
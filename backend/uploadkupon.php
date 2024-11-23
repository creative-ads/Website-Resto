<?php

    include('../koneksi.php');

    $kode_diskon = $_POST['kode_diskon'];
    $harga = $_POST['harga'];


        // Query untuk menyimpan data ke database
    $sql = "INSERT INTO kupon (kode_diskon, harga) VALUES (?, ?)";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("ss", $kode_diskon, $harga);

    if ($stmt->execute()) {
        echo "Data berhasil disimpan.";
        header("location:kupon.php");

    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();


$koneksi->close();
?>
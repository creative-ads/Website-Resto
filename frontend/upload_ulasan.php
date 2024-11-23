<?php

    include('../koneksi.php');

    $nama = $_POST['nama'];
    $menu_recomend = $_POST['menu_recomend'];
    $kemontar = $_POST['komentar'];


        // Query untuk menyimpan data ke database
    $sql = "INSERT INTO ulasan (nama, menu_recomend, komentar) VALUES (?, ?, ?)";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("sss", $nama, $menu_recomend, $kemontar);

    if ($stmt->execute()) {
        echo "Data berhasil disimpan.";
        header("location: ulasan.php");

    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();


$koneksi->close();
?>
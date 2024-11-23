<?php
// Aktifkan laporan error untuk debugging
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Koneksi ke database
include ('../koneksi.php');

// Jika form dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inisialisasi variabel untuk setiap gambar
    $logo = isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK ? file_get_contents($_FILES['logo']['tmp_name']) : null;
    $banner1 = isset($_FILES['banner1']) && $_FILES['banner1']['error'] === UPLOAD_ERR_OK ? file_get_contents($_FILES['banner1']['tmp_name']) : null;
    $banner2 = isset($_FILES['banner2']) && $_FILES['banner2']['error'] === UPLOAD_ERR_OK ? file_get_contents($_FILES['banner2']['tmp_name']) : null;
    $banner3 = isset($_FILES['banner3']) && $_FILES['banner3']['error'] === UPLOAD_ERR_OK ? file_get_contents($_FILES['banner3']['tmp_name']) : null;

    // Pastikan semua gambar diunggah dengan benar
    if ($logo && $banner1 && $banner2 && $banner3) {
        // Siapkan pernyataan SQL untuk menyimpan data
        $stmt = $koneksi->prepare("INSERT INTO setting (logo, banner1, banner2, banner3) VALUES (?, ?, ?, ?)");
        
        // Bind data kosong pada awalnya
        $stmt->bind_param("bbbb", $null, $null, $null, $null);
        
        // Kirim data gambar secara terpisah
        $stmt->send_long_data(0, $logo);
        $stmt->send_long_data(1, $banner1);
        $stmt->send_long_data(2, $banner2);
        $stmt->send_long_data(3, $banner3);

        // Eksekusi dan cek apakah berhasil
        if ($stmt->execute()) {
            echo "Data berhasil disimpan!";
            header("location:setting.php");
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Gagal mengunggah gambar. Pastikan semua file gambar diisi.";
    }
}

$koneksi->close();
?>

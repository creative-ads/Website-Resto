<?php
// Aktifkan laporan error untuk debugging
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Koneksi ke database
include('../koneksi.php');

// Jika form dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Gambar yang di-upload
    $logo = isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK ? file_get_contents($_FILES['logo']['tmp_name']) : null;
    $banner1 = isset($_FILES['banner1']) && $_FILES['banner1']['error'] === UPLOAD_ERR_OK ? file_get_contents($_FILES['banner1']['tmp_name']) : null;
    $banner2 = isset($_FILES['banner2']) && $_FILES['banner2']['error'] === UPLOAD_ERR_OK ? file_get_contents($_FILES['banner2']['tmp_name']) : null;
    $banner3 = isset($_FILES['banner3']) && $_FILES['banner3']['error'] === UPLOAD_ERR_OK ? file_get_contents($_FILES['banner3']['tmp_name']) : null;

    // Debugging - Menampilkan data POST dan FILES
    echo "<pre>";
    var_dump($_POST);
    var_dump($_FILES);
    echo "</pre>";

    // Pastikan ada ID yang dikirimkan untuk update
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = $_POST['id'];

        // Mulai membangun query
        $query = "UPDATE setting SET ";
        $params = [];
        $types = '';

        // Cek apakah logo ada dan tambahkan ke query
        if ($logo) {
            $query .= "logo = ?, ";
            $params[] = $logo;
            $types .= 'b'; // 'b' untuk binary data
        }

        // Cek apakah banner1 ada dan tambahkan ke query
        if ($banner1) {
            $query .= "banner1 = ?, ";
            $params[] = $banner1;
            $types .= 'b'; // 'b' untuk binary data
        }

        // Cek apakah banner2 ada dan tambahkan ke query
        if ($banner2) {
            $query .= "banner2 = ?, ";
            $params[] = $banner2;
            $types .= 'b'; // 'b' untuk binary data
        }

        // Cek apakah banner3 ada dan tambahkan ke query
        if ($banner3) {
            $query .= "banner3 = ?, ";
            $params[] = $banner3;
            $types .= 'b'; // 'b' untuk binary data
        }

        // Hapus koma terakhir dan tambahkan kondisi WHERE
        $query = rtrim($query, ', ') . " WHERE id = ?";

        // Tambahkan ID ke parameter
        $params[] = $id;
        $types .= 'i'; // Tipe data untuk ID

        // Debugging - Menampilkan query yang akan dijalankan
        echo "Query yang akan dijalankan: " . $query . "<br>";

        // Siapkan dan jalankan query update
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param($types, ...$params);

        // Kirim data gambar secara terpisah (menggunakan send_long_data)
        $paramIndex = 0;
        if ($logo) $stmt->send_long_data($paramIndex++, $logo);
        if ($banner1) $stmt->send_long_data($paramIndex++, $banner1);
        if ($banner2) $stmt->send_long_data($paramIndex++, $banner2);
        if ($banner3) $stmt->send_long_data($paramIndex++, $banner3);

        // Eksekusi query
        if ($stmt->execute()) {
            echo "Data berhasil diperbarui!";
            header("Location: setting.php");
            exit; // Menghentikan eksekusi setelah redirect
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "ID tidak ditemukan!";
    }
}

$koneksi->close();
?>

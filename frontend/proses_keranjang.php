<?php
session_start();
include('../koneksi.php'); // Pastikan koneksi database sudah benar

// Pastikan data keranjang ada di session
if (isset($_SESSION['keranjang']) && !empty($_SESSION['keranjang'])) {
    // Tangkap data formulir
    $nama_pemesan = $_POST['nama_pemesan'];
    $kode_meja = $_POST['kode_meja'];
    $kode_diskon = $_POST['kode_diskon'];
    $catatan = $_POST['catatan'];

    // Total harga awal tanpa diskon
    $total_harga_awal = 0;

    // Proses setiap item di keranjang untuk menghitung total harga awal
    foreach ($_SESSION['keranjang'] as $item) {
        $jumlah_menu = $item['jumlah'];
        $total_harga_awal += $item['harga'] * $jumlah_menu;
    }

    // Ambil nilai diskon dari kupon (jika ada)
    $diskon = 0;
    if (!empty($kode_diskon)) {
        // Query untuk mencari diskon berdasarkan kode kupon
        $kupon_query = "SELECT harga FROM kupon WHERE kode_diskon = ?";
        $stmt = $koneksi->prepare($kupon_query);
        $stmt->bind_param("s", $kode_diskon);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $diskon = $row['harga']; // Nilai diskon dari kupon
        }
        $stmt->close();
    }

    // Hitung total harga setelah diskon
    $total_harga_setelah_diskon = max(0, $total_harga_awal - $diskon);

    // Proses setiap item di keranjang untuk memasukkannya ke tabel pesanan
    foreach ($_SESSION['keranjang'] as $item) {
        $menu = $item['menu'];
        $keterangan = $item['keterangan'];
        $jumlah_menu = $item['jumlah'];
        $total_harga_item = $item['harga'] * $jumlah_menu;

        // Memasukkan setiap item ke tabel pesanan
        $query = "INSERT INTO pesanan (menu, keterangan, jumlah_menu, total_harga, total_harga_setelah_diskon, nama_pemesan, kode_meja, catatan)
                  VALUES ('$menu', '$keterangan', '$jumlah_menu', '$total_harga_item', '$total_harga_setelah_diskon', '$nama_pemesan', '$kode_meja', '$catatan' )";

        if (!mysqli_query($koneksi, $query)) {
            echo "Error: " . mysqli_error($koneksi);
        }
    }

    // Setelah semua data pesanan dimasukkan, arahkan ke halaman pesanan
    echo "Pesanan berhasil dikirim!";
    header("location:pesanan.php");

    // Kosongkan keranjang setelah pesanan berhasil dikirim
    unset($_SESSION['keranjang']);
} else {
    echo "Keranjang kosong.";
}

$koneksi->close();
?>

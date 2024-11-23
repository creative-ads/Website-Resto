<?php
// Koneksi ke database
include ('../koneksi.php');

// Ambil data dari form
$nama = $_POST['nama'];
$nohp = $_POST['nohp'];
$kode_meja = $_POST['kode_meja'];
$tanggal = $_POST['tanggal'];

// Cek ketersediaan kode_meja di tanggal tersebut
$query = "SELECT * FROM booking WHERE kode_meja = '$kode_meja' AND tanggal = '$tanggal'";
$result = $koneksi->query($query);

if ($result->num_rows > 0) {
    echo '<div class="alert alert-warning alert-dismissible " role="alert" ">
                        <strong>Maaf, Meja sudah di booking pada tgl yang sama!</strong>
                    </div>';
} else {
    // Insert data ke tabel booking
    $insert = "INSERT INTO booking (kode_meja, nama, nohp, tanggal) VALUES ('$kode_meja', '$nama', '$nohp', '$tanggal')";
    if ($koneksi->query($insert) === TRUE) {
        header("location: status_booking.php");
    } else {
        echo "Error: " . $conn->error;
    }
}

$koneksi->close();
?>

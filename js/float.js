
// Menutup elemen saat tombol tutup diklik
function closeAlert() {
    document.getElementById('alertBox').style.display = 'none';
}

// Menambahkan event listener untuk menampilkan alert ketika elemen diklik
document.getElementById('alertBox').addEventListener('click', showAlert);
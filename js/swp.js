
const swiper = new Swiper('.swiper', {
  effect: "cube",             // Efek perpindahan slide
  grabCursor: true,           // Cursor mengikuti pergerakan slide
  loop: true,                 // Mengaktifkan perulangan slide
  spaceBetween: 50,           // Jarak antar slide
  cubeEffect: {
    shadow: true,             // Menambahkan bayangan
    slideShadows: true,       // Bayangan saat slide berpindah
    shadowOffset: 20,         // Jarak bayangan
    shadowScale: 0.94,        // Skala bayangan
  },
  pagination: {
    el: ".swiper-pagination", // Pagination yang menandakan halaman
  },
  navigation: {
    nextEl: ".swiper-button-next",  // Tombol next
    prevEl: ".swiper-button-prev",  // Tombol prev
  },
});

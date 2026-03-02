<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Title Dinamis -->
    <title>@yield('title', 'Desa Sebudi')</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet"
href="https://www.nerdfonts.com/assets/css/webfont.css">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="bg-gray-50 text-gray-800" style="font-family: 'Inter', system-ui, sans-serif;">

    <!-- NAVBAR -->
<nav class="relative w-full bg-[#3C4A76] shadow-[0_8px_24px_rgba(0,0,0,0.25)] z-50">
    <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">

        <!-- LOGO -->
        <a href="/" class="flex items-center text-white font-bold text-lg">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12">
            <span class="ml-3 tracking-wide">Desa Sebudi</span>
        </a>

        <!-- HAMBURGER BUTTON -->
        <button id="menu-btn" class="relative w-8 h-8 md:hidden focus:outline-none">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </button>

        <!-- MENU DESKTOP -->
        <ul class="hidden md:flex space-x-6 text-sm font-medium text-white">
            <li><a href="/" class="hover:text-[#F2C94C] transition">Halaman Utama</a></li>
            <li><a href="/data-masyarakat" class="hover:text-[#F2C94C] transition">Data Masyarakat</a></li>
            <li><a href="/profil-desa" class="hover:text-[#F2C94C] transition">Profil Desa</a></li>
            <li><a href="/berita-desa" class="hover:text-[#F2C94C] transition">Berita Desa</a></li>
            <li><a href="/dana-desa" class="hover:text-[#F2C94C] transition">Dana Desa</a></li>
            <li><a href="/surat-desa" class="hover:text-[#F2C94C] transition">Surat Desa</a></li>
        </ul>
    </div>

<!-- MOBILE SLIDE MENU -->
    <div id="mobile-menu"
         class="fixed left-0 top-[70px] h-full w-64 bg-[#3C4A76] text-white transform -translate-x-full transition-transform duration-300 md:hidden shadow-xl pt-20 px-6 space-y-4">
        <a href="/" class="block hover:text-[#F2C94C] transition">Halaman Awal</a>
        <a href="/data-masyarakat" class="block hover:text-[#F2C94C] transition">Data Masyarakat</a>
        <a href="/profil-desa" class="block hover:text-[#F2C94C] transition">Profil Desa</a>
        <a href="/berita-desa" class="block hover:text-[#F2C94C] transition">Berita Desa</a>
        <a href="/dana-desa" class="block hover:text-[#F2C94C] transition">Dana Desa</a>
        <a href="/surat-desa" class="hover:text-[#F2C94C] transition">Surat Desa</a>
    </div>
</nav>



 @yield('content')

    <!-- FOOTER -->
    <footer class="bg-gray-900 text-gray-300 py-8 text-center">
        <p class="text-sm">© 2025 Desa Sebudi. Semua Hak Dilindungi.</p>
    </footer>

<style>
    /* DEFAULT HAMBURGER BARS */
    .bar {
        position: absolute;
        left: 0;
        width: 32px;
        height: 3px;
        background: white;
        border-radius: 5px;
        transition: all 0.3s ease;
    }

    .bar:nth-child(1) { top: 6px; }
    .bar:nth-child(2) { top: 14px; }
    .bar:nth-child(3) { top: 22px; }

    /* ANIMASI MENJADI X */
    #menu-btn.open .bar:nth-child(1) {
        transform: rotate(45deg);
        top: 14px;
    }

    #menu-btn.open .bar:nth-child(2) {
        opacity: 0;
    }

    #menu-btn.open .bar:nth-child(3) {
        transform: rotate(-45deg);
        top: 14px;
    }
</style>
<script>
document.addEventListener("DOMContentLoaded", () => {
    const menuBtn = document.getElementById("menu-btn");
    const mobileMenu = document.getElementById("mobile-menu");

    menuBtn.addEventListener("click", () => {
        // toggle animasi hamburger (jadi X)
        menuBtn.classList.toggle("open");

        // toggle slide menu
        if (mobileMenu.classList.contains("-translate-x-full")) {
            mobileMenu.classList.remove("-translate-x-full");
            mobileMenu.classList.add("translate-x-0");
        } else {
            mobileMenu.classList.remove("translate-x-0");
            mobileMenu.classList.add("-translate-x-full");
        }
    });
});
</script>

<script>
const images = [
  "/images/1.png",
  "/images/3.jpg",
  "/images/Kantor_desa.png",
];

const slides = [
  document.getElementById("slideA"),
  document.getElementById("slideB"),
  document.getElementById("slideC"),
];

let index = 0;
let active = 0;

function playSlide() {
  const current = slides[active];
  const next = slides[1 - active];

  // 🔹 SETUP NEXT SLIDE (DI KANAN, HIDDEN DULU)
  next.style.backgroundImage = `url('${images[index]}')`;
  next.className =
    "absolute inset-0 bg-cover bg-center translate-x-full";

  // 🔥 FORCE REFLOW (BIAR TRANSISI KEDETECT)
  next.offsetHeight;

  // 🔹 MASUK DARI KANAN → TENGAH
    next.classList.add(
  "transition-transform",
  "duration-[1500ms]",
  "ease-[cubic-bezier(0.22,1,0.36,1)]"
);

  next.classList.remove("translate-x-full");

  // 🔹 SLIDE LAMA KELUAR KE KIRI
  if (!current.classList.contains("hidden")) {
    current.classList.add("-translate-x-full");
  }

  // 🔹 BERSIHKAN SLIDE LAMA
  setTimeout(() => {
    current.className =
      "absolute inset-0 bg-cover bg-center hidden";

    active = 1 - active;
    index = (index + 1) % images.length;

    playSlide();
  }, 5000);
}

// ▶️ START
playSlide();
</script>

</body>
</html>


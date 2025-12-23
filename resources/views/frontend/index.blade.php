<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Landing Page Desa Sebudi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800">
    <!-- NAVBAR -->
<nav class="w-full bg-[#3C4A76] shadow-sm z-50">
    <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">

        <!-- LOGO -->
        <a href="/" class="flex items-center text-white font-bold text-lg">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10">
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
            <li><a href="/" class="hover:text-[#F2C94C] transition">Halaman Awal</a></li>
            <li><a href="/data-masyarakat" class="hover:text-[#F2C94C] transition">Data Masyarakat</a></li>
            <li><a href="/profil-desa" class="hover:text-[#F2C94C] transition">Profil Desa</a></li>
        </ul>
    </div>

<!-- MOBILE SLIDE MENU -->
    <div id="mobile-menu"
         class="fixed left-0 top-[70px] h-full w-64 bg-[#3C4A76] text-white transform -translate-x-full transition-transform duration-300 md:hidden shadow-xl pt-20 px-6 space-y-4">
        <a href="/" class="block hover:text-[#F2C94C] transition">Halaman Awal</a>
        <a href="/data-masyarakat" class="block hover:text-[#F2C94C] transition">Data Masyarakat</a>
        <a href="/profil-desa" class="block hover:text-[#F2C94C] transition">Profil Desa</a>
    </div>
</nav>


<!-- SECTION 1: HERO -->
<section
    id="hero-container"
    class="relative overflow-hidden
           pt-32 pb-20 min-h-[70vh] sm:min-h-[75vh] md:min-h-[80vh] lg:min-h-[85vh]
           flex items-center justify-center text-white">

    <!-- Slide layer -->
    <div id="slide-current"
         class="absolute inset-0 bg-cover bg-center transition-transform duration-700">
    </div>

    <div id="slide-next"
         class="absolute inset-0 bg-cover bg-center transition-transform duration-700 translate-x-full">
    </div>

    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/40"></div>

    <!-- Text -->
    <div class="relative z-10 text-center px-4">
        <h1 class="text-4xl font-bold mb-4">Selamat Datang di Website Desa Sebudi</h1>
        <p class="text-lg opacity-90"></p>
    </div>

</section>

    <!-- SECTION 2: VISI & MISI -->
    <section class="py-20 bg-[#3C4A76]">
        <div class="max-w-5xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-10">Visi & Misi Desa</h2>

            <div class="bg-white p-8 rounded-2xl shadow-md">
                <h3 class="text-xl text-center font-semibold mb-4">Visi</h3>
                <p class="text-gray-700 mb-6">(Isi visi desa nanti)</p>

                <h3 class="text-xl text-center font-semibold mb-4">Misi</h3>
                <ul class="list-disc ml-5 text-gray-700 space-y-2">
                    <li>(Isi misi desa nanti)</li>
                    <li>(Isi misi desa nanti)</li>
                    <li>(Isi misi desa nanti)</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- SECTION 3: DATA WARGA -->
<section class="py-20 bg-gray-100">
    <div class="max-w-6xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Data Penduduk Desa Sebudi</h2>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 text-center">

            <!-- CARD 1 -->
            <div class="relative group bg-white p-6 rounded-xl shadow overflow-hidden">
                <span class="absolute inset-0 rounded-xl border-2 border-purple-500 opacity-0 group-hover:opacity-100 group-hover:shadow-[0_0_15px_rgba(34,197,94,0.6)] transition-all duration-300 pointer-events-none"></span>
                <h4 class="text-xl font-bold text-purple-700">{{ $totalWarga }}</h4>
                <p class="text-sm text-gray-600">Jumlah Warga</p>
            </div>

            <!-- CARD 2 -->
            <div class="relative group bg-white p-6 rounded-xl shadow overflow-hidden">
                <span class="absolute inset-0 rounded-xl border-2 border-purple-500 opacity-0 group-hover:opacity-100 group-hover:shadow-[0_0_15px_rgba(34,197,94,0.6)] transition-all duration-300 pointer-events-none"></span>
                <h4 class="text-xl font-bold text-purple-700">{{ $totalKepalaKeluarga }}</h4>
                <p class="text-sm text-gray-600">Jumlah KK</p>
            </div>

            <!-- CARD 3 -->
            <div class="relative group bg-white p-6 rounded-xl shadow overflow-hidden">
                <span class="absolute inset-0 rounded-xl border-2 border-purple-500 opacity-0 group-hover:opacity-100 group-hover:shadow-[0_0_15px_rgba(34,197,94,0.6)] transition-all duration-300 pointer-events-none"></span>
                <h4 class="text-xl font-bold text-purple-700">{{ $laki_laki }}</h4>
                <p class="text-sm text-gray-600">Warga Pria</p>
            </div>

            <!-- CARD 4 -->
            <div class="relative group bg-white p-6 rounded-xl shadow overflow-hidden">
                <span class="absolute inset-0 rounded-xl border-2 border-purple-500 opacity-0 group-hover:opacity-100 group-hover:shadow-[0_0_15px_rgba(34,197,94,0.6)] transition-all duration-300 pointer-events-none"></span>
                <h4 class="text-xl font-bold text-purple-700">{{ $perempuan }}</h4>
                <p class="text-sm text-gray-600">Warga Perempuan</p>
            </div>

        </div>
    </div>
</section>

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

.slide-in {
    transform: translateX(0);
}
.slide-out {
    transform: translateX(-100%);
}
.reset-right {
    transform: translateX(100%);
}
</style>

<script>
    const btn = document.getElementById("menu-btn");
    const menu = document.getElementById("mobile-menu");

    btn.addEventListener("click", () => {
        btn.classList.toggle("open");            // hamburger jadi X
        menu.classList.toggle("-translate-x-full"); // slide masuk
    });
</script>


<script>
const images = [
    "/images/1.png",
    "/images/2.jpg",
    "/images/3.jpg"
];

let index = 0;

const current = document.getElementById('slide-current');
const next = document.getElementById('slide-next');

// Set awal
current.style.backgroundImage = `url('${images[index]}')`;

function slideNext() {
    index = (index + 1) % images.length;

    next.style.backgroundImage = `url('${images[index]}')`;

    // Reset posisi next ke kanan tanpa hapus class Tailwind lain
    next.classList.remove("slide-in", "slide-out");
    next.classList.add("reset-right");

    // Delay 1 frame agar reset-right sempat apply
    requestAnimationFrame(() => {
        next.classList.remove("reset-right");
        next.classList.add("slide-in");
        current.classList.add("slide-out");
    });

    // Setelah animasi selesai
    setTimeout(() => {
        // Ganti gambar current
        current.style.backgroundImage = next.style.backgroundImage;

        // Reset class
        current.classList.remove("slide-out");
        next.classList.remove("slide-in");
        next.classList.add("reset-right");
    }, 700);
}

setInterval(slideNext, 8000);
</script>
</body>
</html>


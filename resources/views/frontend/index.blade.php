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
<nav class="w-full fixed top-0 left-0 bg-white shadow-sm z-50">
    <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">

        <!-- LOGO KIRI SEBAGAI LINK -->
        <a href="/" class="text-xl font-bold flex items-center justify-center text-purple-700">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10">
            <p class="ml-5">Desa Sebudi</p>
        </a>

        <!-- MENU KANAN -->
        <ul class="flex space-x-6 text-sm font-medium">
            <li>
                <a href="/" class="hover:text-purple-600 transition">Halaman Awal</a>
            </li>
            <li>
                <a href="/data-masyarakat" class="hover:text-purple-600 transition">Data Masyarakat</a>
            </li>
            <li>
                <a href="/profil-desa" class="hover:text-purple-600 transition">Profil Desa</a>
            </li>
        </ul>

    </div>
</nav>

    <!-- SECTION 1: HERO -->
    <section class="pt-32 pb-20  min-h-[60vh] bg-gradient-to-r from-green-600 to-green-800 text-white flex items-center">
        <div class="max-w-6xl mx-auto px-4 flex flex-col items-center justify-center text-center">
            <h1 class="text-4xl font-bold mb-4">Selamat Datang di Website Desa Sebudi</h1>
            <p class="text-lg opacity-90 mb-6 max-w-2xl mx-auto">
            </p>
        </div>
    </section>

    <!-- SECTION 2: VISI & MISI -->
    <section class="py-20">
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

</body>
</html>


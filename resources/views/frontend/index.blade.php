@extends('layouts.frontend')

@section('content')


<!-- SECTION 1: HERO -->
<section
    id="hero-container"
    class="relative overflow-hidden
           pt-32 pb-20 min-h-[70vh] sm:min-h-[75vh] md:min-h-[80vh] lg:min-h-[85vh]
           flex items-center justify-center text-white ">

    <!-- SLIDE A -->
  <div id="slideC"
       class="absolute inset-0 bg-cover bg-center hidden">

    <!-- overlay gelap -->
    <div class="absolute inset-0 bg-black/50"></div>

    <!-- konten -->
    <div class="relative z-10 flex flex-col items-center justify-center h-full text-white text-center px-6">
      <h1 class="text-4xl md:text-6xl font-bold">
      </h1>
      <p class="mt-4 max-w-xl text-lg md:text-xl">
      </p>
    </div>
  </div>

    <!-- SLIDE A -->
  <div id="slideA"
       class="absolute inset-0 bg-cover bg-center hidden">

    <!-- overlay gelap -->
    <div class="absolute inset-0 bg-black/50"></div>

    <!-- konten -->
    <div class="relative z-10 flex flex-col items-center justify-center h-full text-white text-center px-6">
      <h1 class="text-4xl md:text-6xl font-bold">
       Alam Yang Indah
      </h1>
      <p class="mt-4 max-w-xl text-lg md:text-xl">
        Desa adat yang kaya budaya dan keindahan alam
      </p>
    </div>
  </div>


  <div id="slideB"
       class="absolute inset-0 bg-cover bg-center hidden">

    <!-- overlay gelap -->
    <div class="absolute inset-0 bg-black/50"></div>

    <!-- konten -->
    <div class="relative z-10 flex flex-col items-center justify-center h-full text-white text-center px-6">
      <h1 class="text-4xl md:text-6xl font-bold">
       Selamat Datang Di Website Desa Sebudi
      </h1>
      <p class="mt-4 max-w-xl text-lg md:text-xl">
        Desa adat yang kaya budaya dan keindahan alam
      </p>
    </div>
  </div>

</section>

<!-- SECTION: KEUANGAN DESA (APBDes) -->
<section class="pt-32 pb-32 md:pt-40 md:pb-40 bg-[#3C4A76] shadow-md">
    <div class="max-w-6xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12 text-gray-50">
            Keuangan Desa (APBDes {{ $apbdesAktif?->tahun->tahun ?? '-' }})
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            <!-- CARD: TOTAL PENDAPATAN -->
<div
  class="bg-white rounded-2xl p-6 shadow-lg flex items-center gap-5
         transition-all duration-300 ease-out
         hover:-translate-y-2 hover:shadow-2xl hover:ring-2 hover:ring-green-200 cursor-pointer">

    <div class="bg-green-100 text-green-600 p-4 rounded-full
                transition-colors duration-300
                group-hover:bg-green-200">
        <!-- ICON TREND UP -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
             viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 17l6-6 4 4 8-8" />
        </svg>
    </div>

    <div>
        <p class="text-gray-500 text-sm">Total Pendapatan</p>
        <h3 class="text-2xl font-bold text-gray-800">
            Rp {{ number_format($apbdesAktif->total_pendapatan ?? 0, 0, ',', '.') }}
        </h3>
    </div>
</div>

            <!-- CARD: TOTAL BELANJA -->
<div
  class="bg-white rounded-2xl p-6 shadow-lg flex items-center gap-5
         transition-all duration-300 ease-out
         hover:-translate-y-2 hover:shadow-2xl hover:ring-2 hover:ring-red-200 cursor-pointer">

    <div class="bg-red-100 text-red-600 p-4 rounded-full
                transition-colors duration-300">
        <!-- ICON TREND DOWN -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
             viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M21 7l-6 6-4-4-8 8" />
        </svg>
    </div>

    <div>
        <p class="text-gray-500 text-sm">Total Belanja</p>
        <h3 class="text-2xl font-bold text-gray-800">
            Rp {{ number_format($apbdesAktif->total_belanja ?? 0, 0, ',', '.') }}
        </h3>
    </div>
</div>
            <!-- CARD: SURPLUS / DEFISIT -->
<div
  class="bg-white rounded-2xl p-6 shadow-lg flex items-center gap-5
         transition-all duration-300 ease-out
         hover:-translate-y-2 hover:shadow-2xl
         hover:ring-2
         {{ ($apbdesAktif?->surplus_defisit ?? 0) >= 0
            ? 'hover:ring-blue-200'
            : 'hover:ring-orange-200' }}
         cursor-pointer">

    <div class="
        {{ ($apbdesAktif?->surplus_defisit ?? 0) >= 0
            ? 'bg-blue-100 text-blue-600'
            : 'bg-orange-100 text-orange-600' }}
        p-4 rounded-full transition-colors duration-300">
        <!-- ICON BALANCE -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
             viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 8v8m-4-4h8" />
        </svg>
    </div>

    <div>
        <p class="text-gray-500 text-sm">
            {{ ($apbdesAktif?->surplus_defisit ?? 0) >= 0 ? 'Surplus' : 'Defisit' }}
        </p>
        <h3 class="text-2xl font-bold text-gray-800">
            Rp {{ number_format($apbdesAktif->surplus_defisit ?? 0, 0, ',', '.') }}
        </h3>
    </div>
</div>

        </div>
    </div>
</section>

    <!-- SECTION 3: DATA WARGA -->
<section class="py-20 bg-gray-100">
    <div class="max-w-6xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Data Penduduk Desa Sebudi</h2>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 text-center">

<!-- CARD 1 -->
<!-- CARD: JUMLAH WARGA -->
<div
    class="relative group bg-white p-7 rounded-2xl shadow-lg text-center
           border border-gray-100
           transition-all duration-300 ease-out
           hover:-translate-y-2 hover:shadow-2xl hover:border-purple-500">

    <!-- Glow border -->
    <span
        class="pointer-events-none absolute inset-0 rounded-2xl
               ring-2 ring-purple-500/0
               group-hover:ring-purple-500/40
               transition-all duration-300">
    </span>

    <!-- Icon -->
    <div
        class="w-14 h-14 mx-auto mb-4
               flex items-center justify-center
               rounded-xl
               bg-purple-100 text-purple-600
               text-3xl
               transition-all duration-300
               group-hover:bg-purple-600 group-hover:text-white
               group-hover:scale-110">
        <i class="nf nf-md-account_group"></i>
    </div>

    <!-- Number -->
    <h4
        class="text-3xl font-extrabold text-gray-800
               transition-colors duration-300
               group-hover:text-purple-600">
        {{ $totalWarga }}
    </h4>

    <!-- Label -->
    <p class="mt-1 text-sm font-medium text-gray-500">
        Jumlah Warga
    </p>
</div>



<!-- CARD 2 -->
<!-- CARD: JUMLAH kk -->
<div
    class="relative group bg-white p-7 rounded-2xl shadow-lg text-center
           border border-gray-100
           transition-all duration-300 ease-out
           hover:-translate-y-2 hover:shadow-2xl hover:border-purple-500">

    <!-- Glow border -->
    <span
        class="pointer-events-none absolute inset-0 rounded-2xl
               ring-2 ring-purple-500/0
               group-hover:ring-purple-500/40
               transition-all duration-300">
    </span>

    <!-- Icon -->
    <div
        class="w-14 h-14 mx-auto mb-4
               flex items-center justify-center
               rounded-xl
               bg-purple-100 text-purple-600
               text-3xl
               transition-all duration-300
               group-hover:bg-purple-600 group-hover:text-white
               group-hover:scale-110">
        <i class="nf nf-md-home_account"></i>
    </div>

    <!-- Number -->
    <h4
        class="text-3xl font-extrabold text-gray-800
               transition-colors duration-300
               group-hover:text-purple-600">
        {{ $totalKepalaKeluarga }}
    </h4>

    <!-- Label -->
    <p class="mt-1 text-sm font-medium text-gray-500">
        Jumlah Kartu Keluarga
    </p>
</div>



<!-- CARD 3-->
<!-- CARD: JUMLAH Jenis Kelmanin Pria -->
<div
    class="relative group bg-white p-7 rounded-2xl shadow-lg text-center
           border border-gray-100
           transition-all duration-300 ease-out
           hover:-translate-y-2 hover:shadow-2xl hover:border-purple-500">

    <!-- Glow border -->
    <span
        class="pointer-events-none absolute inset-0 rounded-2xl
               ring-2 ring-purple-500/0
               group-hover:ring-purple-500/40
               transition-all duration-300">
    </span>

    <!-- Icon -->
    <div
        class="w-14 h-14 mx-auto mb-4
               flex items-center justify-center
               rounded-xl
               bg-purple-100 text-purple-600
               text-3xl
               transition-all duration-300
               group-hover:bg-purple-600 group-hover:text-white
               group-hover:scale-110">
        <i class="nf nf-md-gender_male"></i>
    </div>

    <!-- Number -->
    <h4
        class="text-3xl font-extrabold text-gray-800
               transition-colors duration-300
               group-hover:text-purple-600">
        {{ $laki_laki }}
    </h4>

    <!-- Label -->
    <p class="mt-1 text-sm font-medium text-gray-500">
        Warga Pria
    </p>
</div>


<!-- CARD 3-->
<!-- CARD: JUMLAH Jenis Kelmanin Perempuan -->
<div
    class="relative group bg-white p-7 rounded-2xl shadow-lg text-center
           border border-gray-100
           transition-all duration-300 ease-out
           hover:-translate-y-2 hover:shadow-2xl hover:border-purple-500">

    <!-- Glow border -->
    <span
        class="pointer-events-none absolute inset-0 rounded-2xl
               ring-2 ring-purple-500/0
               group-hover:ring-purple-500/40
               transition-all duration-300">
    </span>

    <!-- Icon -->
    <div
        class="w-14 h-14 mx-auto mb-4
               flex items-center justify-center
               rounded-xl
               bg-purple-100 text-purple-600
               text-3xl
               transition-all duration-300
               group-hover:bg-purple-600 group-hover:text-white
               group-hover:scale-110">
        <i class="nf nf-md-gender_female"></i>
    </div>

    <!-- Number -->
    <h4
        class="text-3xl font-extrabold text-gray-800
               transition-colors duration-300
               group-hover:text-purple-600">
        {{ $perempuan }}
    </h4>

    <!-- Label -->
    <p class="mt-1 text-sm font-medium text-gray-500">
        Warga Perempuan
    </p>
</div>


<!-- CARD 3-->
<!-- CARD: JUMLAH Jenis Jumlah banjar Dinas -->
<div
    class="relative group bg-white p-7 rounded-2xl shadow-lg text-center
           border border-gray-100
           transition-all duration-300 ease-out
           hover:-translate-y-2 hover:shadow-2xl hover:border-purple-500">

    <!-- Glow border -->
    <span
        class="pointer-events-none absolute inset-0 rounded-2xl
               ring-2 ring-purple-500/0
               group-hover:ring-purple-500/40
               transition-all duration-300">
    </span>

    <!-- Icon -->
    <div
        class="w-14 h-14 mx-auto mb-4
               flex items-center justify-center
               rounded-xl
               bg-purple-100 text-purple-600
               text-3xl
               transition-all duration-300
               group-hover:bg-purple-600 group-hover:text-white
               group-hover:scale-110">
        <i class="nf nf-md-office_building"></i>
    </div>

    <!-- Number -->
    <h4
        class="text-3xl font-extrabold text-gray-800
               transition-colors duration-300
               group-hover:text-purple-600">
        10
    </h4>

    <!-- Label -->
    <p class="mt-1 text-sm font-medium text-gray-500">
        Jumlah Banjar Dinas
    </p>
</div>


<!-- CARD 3-->
<!-- CARD: JUMLAH Jenis Jumlah banjar Adat -->
<div
    class="relative group bg-white p-7 rounded-2xl shadow-lg text-center
           border border-gray-100
           transition-all duration-300 ease-out
           hover:-translate-y-2 hover:shadow-2xl hover:border-purple-500">

    <!-- Glow border -->
    <span
        class="pointer-events-none absolute inset-0 rounded-2xl
               ring-2 ring-purple-500/0
               group-hover:ring-purple-500/40
               transition-all duration-300">
    </span>

    <!-- Icon -->
    <div
        class="w-14 h-14 mx-auto mb-4
               flex items-center justify-center
               rounded-xl
               bg-purple-100 text-purple-600
               text-3xl
               transition-all duration-300
               group-hover:bg-purple-600 group-hover:text-white
               group-hover:scale-110">
        <i class="nf nf-md-home_city"></i>
    </div>

    <!-- Number -->
    <h4
        class="text-3xl font-extrabold text-gray-800
               transition-colors duration-300
               group-hover:text-purple-600">
        11
    </h4>

    <!-- Label -->
    <p class="mt-1 text-sm font-medium text-gray-500">
        Jumlah Banjar Adat
    </p>
</div>



<!-- CARD 3-->
<!-- CARD: JUMLAH Warga tanpa Bantuan -->
<div
    class="relative group bg-white p-7 rounded-2xl shadow-lg text-center
           border border-gray-100
           transition-all duration-300 ease-out
           hover:-translate-y-2 hover:shadow-2xl hover:border-purple-500">

    <!-- Glow border -->
    <span
        class="pointer-events-none absolute inset-0 rounded-2xl
               ring-2 ring-purple-500/0
               group-hover:ring-purple-500/40
               transition-all duration-300">
    </span>

    <!-- Icon -->
    <div
        class="w-14 h-14 mx-auto mb-4
               flex items-center justify-center
               rounded-xl
               bg-purple-100 text-purple-600
               text-3xl
               transition-all duration-300
               group-hover:bg-purple-600 group-hover:text-white
               group-hover:scale-110">
        <i class="nf nf-md-hand_heart"></i>
    </div>

    <!-- Number -->
    <h4
        class="text-3xl font-extrabold text-gray-800
               transition-colors duration-300
               group-hover:text-purple-600">
    {{$totalBantuan}}
    </h4>

    <!-- Label -->
    <p class="mt-1 text-sm font-medium text-gray-500">
   Warga Dengan Bantuan
    </p>
</div>

<!-- CARD 3-->
<!-- CARD: JUMLAH Warga Dengan Bantuan -->
<div
    class="relative group bg-white p-7 rounded-2xl shadow-lg text-center
           border border-gray-100
           transition-all duration-300 ease-out
           hover:-translate-y-2 hover:shadow-2xl hover:border-purple-500">

    <!-- Glow border -->
    <span
        class="pointer-events-none absolute inset-0 rounded-2xl
               ring-2 ring-purple-500/0
               group-hover:ring-purple-500/40
               transition-all duration-300">
    </span>

    <!-- Icon -->
    <div
        class="w-14 h-14 mx-auto mb-4
               flex items-center justify-center
               rounded-xl
               bg-purple-100 text-purple-600
               text-3xl
               transition-all duration-300
               group-hover:bg-purple-600 group-hover:text-white
               group-hover:scale-110">
        <i class="nf nf-md-hand_back_right_off"></i>
    </div>

    <!-- Number -->
    <h4
        class="text-3xl font-extrabold text-gray-800
               transition-colors duration-300
               group-hover:text-purple-600">
    {{$tanpa_bantuan}}
    </h4>

    <!-- Label -->
    <p class="mt-1 text-sm font-medium text-gray-500">
   Warga Tanpa Bantuan
    </p>
</div>

        </div>
    </div>
</section>

    <!-- SECTION 4:Sambuatan Kepala Desa  -->
<section class="py-20 bg-[#3C4A76] shadow-md flex justify-center">

  <div class="w-full max-w-4xl bg-white rounded-2xl  shadow-lg p-4 md:p-8  flex flex-col md:flex-row gap-6">

    <!-- FOTO KEPALA DESA -->
    <div class="w-full md:w-1/3">
      <img
        src="{{ asset('images/foto_prebekel.png') }}"
        alt="Kepala Desa"
        class="w-64 h-64 md:w-64 md:h-64 object-cover rounded-full border-4 border-white mx-auto"
      >
    </div>

    <!-- KONTEN SAMBUTAN -->
    <div class="w-full md:w-2/3 flex flex-col justify-between">
      <div>
        <h3 class="text-xl font-semibold mb-2">Sambutan Kepala Desa</h3
        <p class="text-gray-700 leading-relaxed">
          Om Suastiyastu<br>
          Selamat datang di Website Resmi Desa Kami.
          Melalui website ini kami berkomitmen menghadirkan informasi yang transparan,
          terbuka, dan bermanfaat bagi seluruh masyarakat desa.
        </p>
      </div>

      <div class="mt-4">
        <p class="font-semibold text-gray-900">I Nyoman Tinggal S.Pd</p>
        <p class="text-gray-600 text-sm">Kepala Desa</p>
      </div>
    </div>

  </div>
</section>

<!-- Section Berita Desa -->
<section class="bg-white py-12">
    <div class="container mx-auto px-4">

        <!-- Judul Section -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Berita Desa</h1>
            <p class="text-gray-500 mt-2">Informasi terbaru seputar desa kita</p>
        </div>

        <!-- Grid Card Berita -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($news as $index => $b)

                {{-- MOBILE: tampil 1 --}}
                {{-- TABLET: tampil 2 --}}
                {{-- DESKTOP: tampil 3 --}}
                <div
                    class="
                        bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden
                        transform transition hover:-translate-y-2 hover:border-purple-500
                        {{ $index > 0 ? 'hidden sm:block' : '' }}
                        {{ $index > 1 ? 'sm:hidden lg:block' : '' }}
                    "
                >
                    @if($b->gambar)
                        <img
                            src="{{ Storage::url($b->gambar) }}"
                            alt="{{ $b->judul }}"
                            class="w-full h-40 object-cover">
                    @endif

                    <div class="p-4">
                        <h2 class="font-bold text-lg text-gray-800">
                            {{ $b->judul }}
                        </h2>

                        <p class="text-gray-500 text-sm mt-2">
                            {{ Str::limit(strip_tags($b->isi), 100) }}
                        </p>

                        <div class="flex justify-between items-center mt-4 text-xs text-gray-400">
                            <span>By {{ $b->penulis }}</span>
                            <span>{{ $b->views }} dilihat</span>
                        </div>

                        <a
                            href="{{ url('berita/'.$b->slug) }}"
                            class="text-purple-600 hover:underline mt-3 inline-block font-medium">
                            Baca Selengkapnya
                        </a>
                    </div>
                </div>

            @endforeach
        </div>

        <!-- Tombol Lihat Berita Lainnya -->
        <div class="mt-10 flex justify-center">
            <a
                href="{{ url('/berita-desa') }}"
                class="inline-flex items-center gap-2
                       px-6 py-3 rounded-full
                       bg-purple-600 text-white font-semibold
                       hover:bg-purple-700 transition">
                Lihat Berita Lainnya →
            </a>
        </div>

    </div>
</section>
<!-- SECTION: LOKASI DESA -->
<section id="lokasi-desa" class="py-20 bg-[#3C4A76]">
  <div class="max-w-6xl mx-auto px-4 text-center">
    <h2 class="text-3xl md:text-4xl font-bold mb-4 text-white">Lokasi Desa</h2>
    <p class="text-white mb-8">
      Temukan lokasi Desa kami melalui Google Maps.
    </p>

    <!-- MAP CONTAINER -->
    <div class="w-full h-96 md:h-[500px] rounded-lg overflow-hidden shadow-lg">
      <iframe
        src="https://www.google.com/maps?q=-8.4092885,115.4837228&hl=id&z=17&output=embed"
        width="100%"
        height="100%"
        style="border:0;"
        allowfullscreen=""
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade">
      </iframe>
    </div>
  </div>
</section>

@endsection


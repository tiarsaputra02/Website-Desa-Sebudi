@extends('layouts.frontend')
@section('title', 'Dana Desa')

@section('content')

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

@endsection

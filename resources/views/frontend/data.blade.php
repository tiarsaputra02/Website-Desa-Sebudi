@extends('layouts.frontend')

@section('title', 'Data Masyarakat')
@section('content')

<div class="max-w-6xl mx-auto py-10 px-4 space-y-6">

    <!-- FILTER -->
    <form id="filterForm" method="GET" action="{{ route('data') }}"
      class="bg-white rounded-xl shadow p-6 flex flex-col md:flex-row gap-4">

    <select name="wilayah" id="wilayahSelect"
        class="border rounded-lg px-4 py-2 w-full md:w-1/3">

        <option value="0" {{ request('wilayah') == 0 ? 'selected' : '' }}>
            Seluruh Desa Sebudi
        </option>

        @foreach($wilayah as $w)
            <option value="{{ $w->id }}" {{ request('wilayah') == $w->id ? 'selected' : '' }}>
                {{ $w->nama_wilayah }}
            </option>
        @endforeach
    </select>

    <select name="tahun" id="tahunSelect"
        class="border rounded-lg px-4 py-2 w-full md:w-1/3">
        @foreach ($listTahun as $t)
            <option value="{{ $t }}" {{ request('tahun') == $t ? 'selected' : '' }}>
                {{ $t }}
            </option>
        @endforeach
    </select>

    <button type="submit"
        class="bg-[#3C4A76] text-white px-6 py-2 rounded-lg hover:bg-opacity-90 transition">
        Tampilkan
    </button>
</form>

    <!-- SECTION 3: DATA WARGA -->
<section class="py-20 bg-gray-100">
    <div class="max-w-6xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Data Penduduk {{$banjar}}</h2>

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
                <h4 class="text-xl font-bold text-purple-700">{{$totalBantuan}}</h4>
                <p class="text-sm text-gray-600">Warga Dengan Bantuan</p>
            </div>

            <!-- CARD 4 -->
            <div class="relative group bg-white p-6 rounded-xl shadow overflow-hidden">
                <span class="absolute inset-0 rounded-xl border-2 border-purple-500 opacity-0 group-hover:opacity-100 group-hover:shadow-[0_0_15px_rgba(34,197,94,0.6)] transition-all duration-300 pointer-events-none"></span>
                <h4 class="text-xl font-bold text-purple-700">{{$tanpa_bantuan}}</h4>
                <p class="text-sm text-gray-600">Warga Tanpa Bantuan</p>
            </div>

        </div>
    </div>
</section>

<!--Chart Umur -->
    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-lg font-semibold mb-4">Jumlah Penduduk Berdasarkan Usia</h2>
        <div id="chartUmur"></div>
    </div>
    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-lg font-semibold mb-4">Usia Warga</h2>
        <table class="w-full border text-sm mt-4">
        <thead class="bg-gray-100">
        <tr>
            <th class="border px-3 py-2">Usia Warga</th>
            <th class="border px-3 py-2">Jumlah</th>
        </tr>
        </thead>
        <tbody id="umurTable"></tbody>
        </table>
    </div>

    <!-- CHART -->
    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-lg font-semibold mb-4">Jumlah Penduduk Berdasarkan Jenis Kelamin</h2>
        <div id="chart"></div>
    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-lg font-semibold mb-4">Jenis Kelamin</h2>
        <table class="w-full border text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-3 py-2">Kategori</th>
                    <th class="border px-3 py-2">Jumlah</th>
                </tr>
            </thead>
            <tbody id="dataTable"></tbody>
        </table>
    </div>

<!--Chart Pekerjaan -->
    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-lg font-semibold mb-4">Jumlah Penduduk Berdasarkan Jenis Pekerjaan</h2>
        <div id="chartPekerjaan"></div>
    </div>
    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-lg font-semibold mb-4">Pekerjaan</h2>
        <table class="w-full border text-sm mt-4">
        <thead class="bg-gray-100">
        <tr>
            <th class="border px-3 py-2">Pekerjaan</th>
            <th class="border px-3 py-2">Jumlah</th>
        </tr>
        </thead>
        <tbody id="pekerjaanTable"></tbody>
        </table>
    </div>


<!--Chart Agama -->
    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-lg font-semibold mb-4">Jumlah Penduduk Berdasarkan Agama</h2>
        <div id="chartAgama"></div>
    </div>
    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-lg font-semibold mb-4">Agama</h2>
        <table class="w-full border text-sm mt-4">
        <thead class="bg-gray-100">
        <tr>
            <th class="border px-3 py-2">Agama</th>
            <th class="border px-3 py-2">Jumlah</th>
        </tr>
        </thead>
        <tbody id="agamaTable"></tbody>
        </table>
    </div>

<!--Chart Pendidikan -->
    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-lg font-semibold mb-4">Jumlah Penduduk Berdasarkan Pendidikan</h2>
        <div id="chartPendidikan"></div>
    </div>
    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-lg font-semibold mb-4">Pendidikan</h2>
        <table class="w-full border text-sm mt-4">
        <thead class="bg-gray-100">
        <tr>
            <th class="border px-3 py-2">Pendidikan</th>
            <th class="border px-3 py-2">Jumlah</th>
        </tr>
        </thead>
        <tbody id="pendidikanTable"></tbody>
        </table>
    </div>

<!--Chart Perkawinan -->
    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-lg font-semibold mb-4">Jumlah Penduduk Berdasarkan Perkawinan</h2>
        <div id="chartPerkawinan"></div>
    </div>
    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-lg font-semibold mb-4">Perkawinan</h2>
        <table class="w-full border text-sm mt-4">
        <thead class="bg-gray-100">
        <tr>
            <th class="border px-3 py-2">Perkawinan</th>
            <th class="border px-3 py-2">Jumlah</th>
        </tr>
        </thead>
        <tbody id="perkawinanTable"></tbody>
        </table>
    </div>

<!--Chart Bantuan -->
    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-lg font-semibold mb-4">Jumlah Penduduk Berdasarkan Bantuan</h2>
        <div id="chartBantuan"></div>
    </div>
    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-lg font-semibold mb-4">Bantuan</h2>
        <table class="w-full border text-sm mt-4">
        <thead class="bg-gray-100">
        <tr>
            <th class="border px-3 py-2">Bantuan</th>
            <th class="border px-3 py-2">Jumlah</th>
        </tr>
        </thead>
        <tbody id="bantuanTable"></tbody>
        </table>
    </div>

<!--Chart BPJS -->
    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-lg font-semibold mb-4">Jumlah Penduduk Berdasarkan Jenis BPJS</h2>
        <div id="chartBPJS"></div>
    </div>
    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-lg font-semibold mb-4">Jenis BPJS</h2>
        <table class="w-full border text-sm mt-4">
        <thead class="bg-gray-100">
        <tr>
            <th class="border px-3 py-2">Jensis BPJS</th>
            <th class="border px-3 py-2">Jumlah</th>
        </tr>
        </thead>
        <tbody id="jenisbpjsTable"></tbody>
        </table>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-lg font-semibold mb-4">Kategori BPJS</h2>
        <table class="w-full border text-sm mt-4">
        <thead class="bg-gray-100">
        <tr>
            <th class="border px-3 py-2">Kategori BPJS</th>
            <th class="border px-3 py-2">Jumlah</th>
        </tr>
        </thead>
        <tbody id="kategoriTable"></tbody>
        </table>
    </div>



</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
    window.statistik = @json($statistik);
    window.pekerjaanStat = @json($pekerjaanStat);
    window.agamaStat = @json($agamaStat);
    window.bantuanStat = @json($bantuanStat);
    window.umurStat = @json($umurStat);
    window.pendidikanStat = @json($pendidikanStat);
    window.perkawinanStat = @json($perkawinanStat);
    window.jenisbpjsStat = @json($jenisbpjsStat);
    window.kategoribpjsStat = @json($kategoribpjsStat);
</script>

@vite('resources/js/chart-jeniskelamin.js')
@vite('resources/js/chart-pekerjaan.js')
@vite('resources/js/chart-agama.js')
@vite('resources/js/chart-bantuan.js')
@vite('resources/js/chart-umur.js')
@vite('resources/js/chart-pendidikan.js')
@vite('resources/js/chart-perkawinan.js')
@vite('resources/js/chart-bpjs.js')

@endsection




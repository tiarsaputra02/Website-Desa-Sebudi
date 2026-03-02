@extends('layouts.frontend')

@section('title', 'Surat Desa')
@section('content')

<section class="py-20 bg-[#3C4A76]">
    <div class="max-w-6xl mx-auto px-4">

        <h2 class="text-3xl font-bold text-center text-white mb-3">
            Surat Desa
        </h2>

        <p class="text-center text-white/80 mb-10">
            Arsip Tahun {{ $tahunSekarang }}
        </p>

        {{-- FILTER KATEGORI --}}
        <div class="flex flex-wrap justify-center gap-4 mb-12">

            <a href="{{ route('suratdesa') }}"
               class="px-5 py-2 rounded-full text-sm font-medium
               {{ !$kategori ? 'bg-white text-[#3C4A76]' : 'bg-white/20 text-white' }}">
                Semua
            </a>

            @foreach($kategoriList as $item)
                <a href="{{ route('suratdesa', ['kategori' => $item]) }}"
                   class="px-5 py-2 rounded-full text-sm font-medium
                   {{ $kategori == $item ? 'bg-white text-[#3C4A76]' : 'bg-white/20 text-white' }}">
                    {{ $item }}
                </a>
            @endforeach

        </div>

        {{-- CARD GRID --}}
        <div class="grid md:grid-cols-3 gap-8">

            @forelse($surat as $item)
                <div class="bg-white rounded-2xl shadow-lg p-6 flex flex-col justify-between">

                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">
                            {{ $item->judul }}
                        </h3>

                        <p class="text-sm text-gray-500 mb-4">
                            {{ $item->kategori }}
                        </p>
                    </div>

                    <div class="flex gap-3 mt-4">
                        <a href="{{ asset('storage/' . $item->file) }}"
                           target="_blank"
                           class="flex-1 text-center bg-[#3C4A76] text-white py-2 rounded-lg text-sm hover:bg-[#2f3a5f] transition">
                            Lihat
                        </a>

                        <a href="{{ asset('storage/' . $item->file) }}"
                           download
                           class="flex-1 text-center bg-gray-200 text-gray-800 py-2 rounded-lg text-sm hover:bg-gray-300 transition">
                            Download
                        </a>
                    </div>

                </div>
            @empty
                <div class="col-span-3 text-center text-white">
                    Belum ada surat untuk tahun {{ $tahunSekarang }}.
                </div>
            @endforelse

        </div>

    </div>
</section>

@endsection


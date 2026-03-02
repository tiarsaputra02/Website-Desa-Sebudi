@extends('layouts.frontend')

@section('title', 'Berita Desa')
@section('content')

<section class="py-10 bg-gray-50">
    <div class="container mx-auto px-4">

        {{-- JUDUL HALAMAN --}}
        <h1 class="text-3xl font-bold mb-8">
            Berita Desa
        </h1>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            {{-- LIST BERITA (KIRI) --}}
            <div class="lg:col-span-8 space-y-6">

                @foreach($news as $b)
                    <article class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden flex flex-col sm:flex-row hover:shadow-md transition">

                        {{-- GAMBAR --}}
                        @if($b->gambar)
                            <img src="{{ Storage::url($b->gambar) }}"
                                 alt="{{ $b->judul }}"
                                 class="w-full sm:w-56 h-44 sm:h-auto object-cover">
                        @else
                            <div class="w-full sm:w-56 h-44 bg-gray-200"></div>
                        @endif

                        {{-- KONTEN --}}
                        <div class="p-5 flex flex-col justify-between flex-1">

                            <div>
                                <h2 class="text-xl font-semibold text-gray-800 mb-2">
                                    {{ $b->judul }}
                                </h2>

                                <p class="text-gray-600 text-sm">
                                    {{ Str::limit(strip_tags($b->isi), 130) }}
                                </p>
                            </div>

                            <div class="mt-4 flex items-center justify-between text-xs text-gray-500">
                                <span>By {{ $b->penulis }}</span>
                                <span>{{ $b->views }} dilihat</span>
                            </div>

                            <a href="{{ route('berita.show', $b->slug) }}"
                               class="mt-3 inline-block text-sm font-medium text-purple-600 hover:underline">
                                Baca Selengkapnya →
                            </a>

                        </div>
                    </article>
                @endforeach

                {{-- INFO + PAGINATION --}}
<div class="pt-6 border-t">

    {{-- INFO JUMLAH DATA --}}
    <p class="text-sm text-gray-600 mb-4">
        Menampilkan
        <span class="font-medium">
            {{ $news->firstItem() ?? 0 }}–{{ $news->lastItem() ?? 0 }}
        </span>
        dari
        <span class="font-medium">
            {{ $news->total() }}
        </span>
        berita
    </p>

    {{-- PAGINATION --}}
    {{ $news->links('pagination.indonesia-clean') }}


</div>


            </div>

            {{-- SIDEBAR (KANAN) --}}
            <aside class="lg:col-span-4">

                <div class="
                    bg-white
                    shadow-sm
                    rounded-2xl
                    p-5
                    space-y-4
                    lg:sticky lg:top-24
                    lg:max-h-[calc(100vh-120px)]
                    lg:overflow-y-auto
                ">

                    <h2 class="text-lg font-semibold border-b pb-2">
                        Berita Terbaru
                    </h2>

                    <div class="space-y-4">
                        @foreach ($latestNews as $item)
                            <a href="{{ route('berita.show', $item->slug) }}"
                               class="flex gap-3 group">

                                @if($item->gambar)
                                    <img src="{{ Storage::url($item->gambar) }}"
                                         class="w-16 h-16 object-cover rounded-lg">
                                @else
                                    <div class="w-16 h-16 bg-gray-200 rounded-lg"></div>
                                @endif

                                <div>
                                    <p class="text-sm font-medium leading-snug group-hover:text-purple-600">
                                        {{ Str::limit($item->judul, 55) }}
                                    </p>
                                    <span class="text-xs text-gray-500">
                                        {{ $item->created_at?->format('d M Y') ?? '-' }}
                                    </span>
                                </div>
                            </a>
                        @endforeach
                    </div>

                </div>

            </aside>

        </div>
    </div>
</section>

@endsection


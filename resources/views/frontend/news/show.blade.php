@extends('layouts.frontend')

@section('content')

{{-- SWIPER CSS --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

<section class="py-10">
    <div class="container mx-auto px-4 grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- KONTEN UTAMA --}}
        <article class="lg:col-span-2 bg-white shadow rounded-2xl p-6">

            <h1 class="text-3xl font-bold mb-3">{{ $news->judul }}</h1>

            <div class="text-sm text-gray-500 mb-4">
                By {{ $news->penulis }}
                {{ $news->created_at?->format('d M Y') ?? '-' }}
                • {{ $news->views }} dilihat
            </div>

            {{-- ===== SLIDER GAMBAR ===== --}}
            @if($news->gambar || $news->images->count())
            <div class="swiper mySwiper mb-6 rounded-xl overflow-hidden bg-gray-100">
                <div class="swiper-wrapper">

                    {{-- Thumbnail (slide pertama) --}}
                    @if($news->gambar)
                    <div class="swiper-slide flex justify-center items-center h-80">
                        <img src="{{ Storage::url($news->gambar) }}"
                             alt="{{ $news->judul }}"
                             class="max-h-full w-auto object-contain">
                    </div>
                    @endif

                    {{-- Gambar tambahan --}}
                    @foreach($news->images as $img)
                    <div class="swiper-slide flex justify-center items-center h-80">
                        <img src="{{ Storage::url($img->image_path) }}"
                             class="max-h-full w-auto object-contain">
                    </div>
                    @endforeach

                </div>

                {{-- Navigasi --}}
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
            @endif
            {{-- ===== END SLIDER ===== --}}

            <div class="prose max-w-none text-justify">
                {!! $news->isi !!}
            </div>

            <a href="{{ route('berita.utama') }}"
               class="inline-block mt-6 text-sm text-blue-600 hover:underline">
                ← Kembali ke daftar berita
            </a>
        </article>

        {{-- SIDEBAR --}}
        <aside class="bg-white shadow rounded-2xl p-5 h-fit">

            <h2 class="text-lg font-semibold mb-3">Berita Terbaru</h2>

            <div class="space-y-4">
                @foreach ($latestNews as $item)
                    <a href="{{ route('berita.show', $item->slug) }}"
                       class="flex gap-3 group">

                        @if($item->gambar)
                            <img src="{{ Storage::url($item->gambar) }}"
                                 class="w-16 h-16 object-contain bg-gray-100 rounded-lg">
                        @else
                            <div class="w-16 h-16 bg-gray-200 rounded-lg"></div>
                        @endif

                        <div>
                            <p class="font-medium leading-tight group-hover:text-blue-600">
                                {{ Str::limit($item->judul, 60) }}
                            </p>
                            <span class="text-xs text-gray-500">
                                {{ $item->created_at?->format('d M Y') ?? '-' }}
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>

        </aside>

    </div>
</section>

{{-- SWIPER JS --}}
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    new Swiper('.mySwiper', {
        loop: true,
        spaceBetween: 10,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
});
</script>

@endsection


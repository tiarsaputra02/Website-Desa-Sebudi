@if ($paginator->hasPages())
    <nav class="flex items-center justify-between">

        {{-- TOMBOL SEBELUMNYA --}}
        @if ($paginator->onFirstPage())
            <span class="px-3 py-2 text-sm text-gray-400 bg-gray-100 rounded-lg">
                ← Sebelumnya
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
               class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border rounded-lg hover:bg-gray-50">
                ← Sebelumnya
            </a>
        @endif

        {{-- NOMOR HALAMAN --}}
        <div class="hidden sm:flex items-center gap-1">
            @foreach ($elements as $element)

                {{-- "..." --}}
                @if (is_string($element))
                    <span class="px-3 py-2 text-sm text-gray-400">
                        {{ $element }}
                    </span>
                @endif

                {{-- LINK HALAMAN --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="px-3 py-2 text-sm font-semibold text-white bg-purple-600 rounded-lg">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}"
                               class="px-3 py-2 text-sm text-gray-700 border rounded-lg hover:bg-gray-50">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif

            @endforeach
        </div>

        {{-- TOMBOL SELANJUTNYA --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
               class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border rounded-lg hover:bg-gray-50">
                Selanjutnya →
            </a>
        @else
            <span class="px-3 py-2 text-sm text-gray-400 bg-gray-100 rounded-lg">
                Selanjutnya →
            </span>
        @endif

    </nav>
@endif


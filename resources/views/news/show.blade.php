@extends('layouts.dashboard')

@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Detail Berita</h3>
                <p class="text-subtitle text-muted">Informasi lengkap berita yang diunggah admin</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('news.index') }}">Berita Desa</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">{{ $news->judul }}</h4>
                <div class="card-header-action">
                    <a href="{{ route('news.edit', $news->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('news.destroy', $news->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin ingin menghapus berita ini?')">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>

            <div class="card-body">
                {{-- Info Meta --}}
                <p class="text-muted mb-3">
                    <strong>Penulis:</strong> {{ $news->penulis }} |
                    <strong>Status:</strong> 
                    @if($news->status == 'publish')
                        <span class="badge bg-success">Publish</span>
                    @else
                        <span class="badge bg-secondary">Draft</span>
                    @endif
                    | <strong>Views:</strong> {{ $news->views }}x
                    | <strong>Tanggal:</strong> {{ $news->created_at->format('d M Y') }}
                </p>

                {{-- Thumbnail utama --}}
                @if($news->gambar)
                    <img src="{{ Storage::url($news->gambar) }}" 
                         alt="Thumbnail" 
                         class="w-100 rounded mb-3" 
                         style="max-height:400px; object-fit:cover">
                @endif

                {{-- Gambar tambahan --}}
                @if($news->images->count())
                    <div class="mb-3">
                        <h6>Gambar Tambahan:</h6>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($news->images as $img)
                                <img src="{{ Storage::url($img->image_path) }}" 
                                     alt="Gambar tambahan" 
                                     class="rounded" 
                                     style="width:120px; height:80px; object-fit:cover;">
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Isi berita --}}
                <div class="mt-3">
                    {!! $news->isi !!}
                </div>

                <a href="{{ route('news.index') }}" class="btn btn-secondary mt-3">
                    ← Kembali ke daftar berita
                </a>
            </div>
        </div>
    </section>
</div>

@endsection


@extends('layouts.dashboard')

@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Berita Desa</h3>
                <p class="text-subtitle text-muted">Daftar berita yang telah dipublikasikan</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Tampilan Utama</a></li>
                        <li class="breadcrumb-item">Berita Desa</li>
                        <li class="breadcrumb-item active" aria-current="page">Menu Utama</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Daftar Berita Desa</h5>
            </div>

            <div class="card-body">

                <div class="d-flex">
                    <a href="{{ route('news.create') }}" class="btn btn-primary mb-3 ms-auto">
                        Tambahkan Berita Baru
                    </a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Thumbnail</th>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Gambar Tambahan</th>
                            <th>Views</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach ($berita as $b)
                        <tr>
                            {{-- Thumbnail --}}
                            <td>
                                @if($b->gambar)
                                    <img src="{{ asset('storage/' . $b->gambar) }}" 
                                         alt="Thumbnail" 
                                         style="width: 80px; height: auto; object-fit: cover; border-radius: 4px;">
                                @else
                                    <span class="text-muted">Tidak ada</span>
                                @endif
                            </td>

                            {{-- Judul --}}
                            <td>{{ $b->judul }}</td>

                            {{-- Penulis --}}
                            <td>{{ $b->penulis }}</td>

                            {{-- Gambar Tambahan --}}
                            <td>
                                @if($b->images->count())
                                    <div class="d-flex flex-wrap gap-1">
                                        @foreach($b->images as $img)
                                            <img src="{{ asset('storage/' . $img->image_path) }}" 
                                                 alt="Gambar tambahan" 
                                                 style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-muted">Tidak ada</span>
                                @endif
                            </td>

                            {{-- Views --}}
                            <td>{{ $b->views }}x</td>

                            {{-- Status --}}
                            <td>
                                @if($b->status == 'publish')
                                    <span class="badge bg-success">Publish</span>
                                @else
                                    <span class="badge bg-secondary">Draft</span>
                                @endif
                            </td>

                            {{-- Tanggal --}}
                            <td>{{ $b->created_at->format('d M Y') }}</td>

                            {{-- Aksi --}}
                            <td>
                                <a href="{{ route('news.show', $b->slug) }}" class="btn btn-info btn-sm">Lihat</a>
                                <a href="{{ route('news.edit', $b->slug) }}" class="btn btn-warning btn-sm">Edit</a>

                                <form action="{{ route('news.destroy', $b->slug) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin menghapus berita {{ $b->judul }} ?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                {{-- Pagination --}}
                <div class="mt-3">
                    {{ $berita->links() }}
                </div>

            </div>
        </div>
    </section>
</div>
@endsection


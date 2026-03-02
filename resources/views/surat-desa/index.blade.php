@extends('layouts.dashboard')

@section('content')

<header class="mb-3">
   <a href="#" class="burger-btn d-block d-xl-none">
      <i class="bi bi-justify fs-3"></i>
   </a>
</header>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Surat Desa</h3>
                <p class="text-subtitle text-muted">Menambahkan dan Mengelola Surat Desa</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/dashboard">Tampilan Utama</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Surat Desa
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Surat Desa
                </h5>
            </div>
            <div class="card-body">

                <div class="d-flex">
                    <a href="{{ route('SuratDesa.create') }}" 
                       class="btn btn-primary mb-3 ms-auto">
                       Tambahkan Surat Baru
                    </a>
                </div>

                {{-- Notifikasi --}}
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Tahun</th>
                            <th>File</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($surat as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->judul }}</td>
                            <td>
                                @if($item->kategori == 'Peraturan Desa')
                                    <span class="badge bg-primary">
                                        {{ $item->kategori }}
                                    </span>
                                @elseif($item->kategori == 'Keputusan Perbekel')
                                    <span class="badge bg-warning">
                                        {{ $item->kategori }}
                                    </span>
                                @else
                                    <span class="badge bg-info">
                                        {{ $item->kategori }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-secondary">
                                    {{ $item->tahun }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ asset('storage/' . $item->file) }}" 
                                   target="_blank" 
                                   class="btn btn-info btn-sm">
                                   Lihat File
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('SuratDesa.edit', $item->id) }}" 
                                   class="btn btn-warning btn-sm">
                                   Edit
                                </a>

                                <form action="{{ route('SuratDesa.destroy', $item->id) }}" 
                                      method="POST" 
                                      style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah yakin menghapus surat {{ $item->judul }} ?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                Belum ada data surat.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </section>
</div>

@endsection


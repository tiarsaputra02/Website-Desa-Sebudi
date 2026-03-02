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
                <h3>Jenis Surat</h3>
                <p class="text-subtitle text-muted">Menambahkan dan Mengelola Jenis Surat</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Tampilan Utama</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Jenis Surat</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                 Jenis Surat
                </h5>
            </div>
            <div class="card-body">

                <div class="d-flex">
                    <a href="{{ route('jenis-surat.create') }}" class="btn btn-primary mb-3 ms-auto">Tambahkan Jenis Surat Baru</a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Kode Surat</th>
                            <th>Nama Surat</th>
                            <th>Aktif</th>
                            <th>Template</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($jenisSurat as $jenis)
                        <tr>
                            <td>{{ $jenis->kode_surat }}</td>
                            <td>{{ $jenis->nama_surat }}</td>
                            <td>
                                @if($jenis->aktif)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-secondary">Nonaktif</span>
                                @endif
                            </td>
                            <td>
                                @if($jenis->template_path)
                                    <a href="{{ Storage::url($jenis->template_path) }}" target="_blank" class="btn btn-info btn-sm">Lihat Template</a>
                                @else
                                    <span class="text-muted">Tidak ada</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('jenis-surat.edit', $jenis->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('jenis-surat.destroy', $jenis->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah yakin menghapus jenis surat {{ $jenis->nama_surat }} ?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>

@endsection


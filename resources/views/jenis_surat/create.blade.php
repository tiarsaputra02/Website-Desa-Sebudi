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
                <h3>Tambah Jenis Surat</h3>
                <p class="text-subtitle text-muted">Form untuk menambahkan jenis surat baru</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Tampilan Utama</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('jenis-surat.index') }}">Jenis Surat</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Jenis Surat</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Form Tambah Jenis Surat</h5>
            </div>
            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('jenis-surat.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="kode_surat" class="form-label">Kode Surat</label>
                        <input type="text" class="form-control" id="kode_surat" name="kode_surat" value="{{ old('kode_surat') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="nama_surat" class="form-label">Nama Surat</label>
                        <input type="text" class="form-control" id="nama_surat" name="nama_surat" value="{{ old('nama_surat') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="template_file" class="form-label">Template Surat (HTML / DOCX)</label>
                        <input type="file" class="form-control" id="template_file" name="template_file" accept=".html,.docx">
                    </div>

                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="aktif" name="aktif" value="1" checked>
                        <label class="form-check-label" for="aktif">Aktif</label>
                    </div>

                    <div class="d-flex">
                        <a href="{{ route('jenis-surat.index') }}" class="btn btn-secondary me-2">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan Jenis Surat</button>
                    </div>
                </form>

            </div>
        </div>
    </section>
</div>

@endsection


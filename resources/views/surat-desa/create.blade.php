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
                <p class="text-subtitle text-muted">Upload Peraturan / SK / Pengumuman Desa</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Surat Desa</li>
                        <li class="breadcrumb-item active">Tambah Surat</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Tambah Surat Desa
                </h5>
            </div>
            <div class="card-body">

                <form action="{{ route('SuratDesa.store') }}" 
                      method="POST" 
                      enctype="multipart/form-data">

                    @csrf

                    {{-- Judul --}}
                    <div class="mb-3">
                        <label class="form-label">Judul Surat</label>
                        <input type="text" 
                               name="judul" 
                               class="form-control @error('judul') is-invalid @enderror"
                               value="{{ old('judul') }}" 
                               required>

                        @error('judul')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Kategori --}}
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="kategori" 
                                class="form-control @error('kategori') is-invalid @enderror"
                                required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Peraturan Desa">Peraturan Desa</option>
                            <option value="Keputusan Perbekel">Keputusan Perbekel</option>
                            <option value="Pengumuman">Pengumuman</option>
                        </select>

                        @error('kategori')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Tahun --}}
                    <div class="mb-3">
                        <label class="form-label">Tahun</label>
                        <input type="number" 
                        name="tahun" 
                        class="form-control @error('tahun') is-invalid @enderror"
                        value="{{ old('tahun', date('Y')) }}"  {{-- default tahun sekarang --}}
                        min="2000"
                        max="{{ date('Y') + 5 }}"
                        required>
                        @error('tahun')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Upload PDF --}}
                    <div class="mb-3">
                        <label class="form-label">Upload File (PDF)</label>
                        <input type="file" 
                               name="file" 
                               class="form-control @error('file') is-invalid @enderror"
                               accept="application/pdf"
                               required>

                        @error('file')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Upload Surat
                    </button>

                    <a href="{{ route('SuratDesa.index') }}" 
                       class="btn btn-secondary">
                        Kembali
                    </a>

                </form>

            </div>
        </div>
    </section>
</div>

@endsection


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
                <h3>Edit Surat Desa</h3>
                <p class="text-subtitle text-muted">Mengubah Data Surat Desa</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Tampilan Utama</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('SuratDesa.index') }}">Surat Desa</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Form Edit Surat Desa</h5>
            </div>
            <div class="card-body">

                <form action="{{ route('SuratDesa.update', $data->id) }}" 
                      method="POST" 
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Judul --}}
                    <div class="mb-3">
                        <label class="form-label">Judul Surat</label>
                        <input type="text" 
                               name="judul"
                               value="{{ old('judul', $data->judul) }}"
                               class="form-control @error('judul') is-invalid @enderror"
                               required>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Kategori --}}
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="kategori" 
                                class="form-control @error('kategori') is-invalid @enderror"
                                required>
                            <option value="Peraturan Desa" {{ $data->kategori == 'Peraturan Desa' ? 'selected' : '' }}>Peraturan Desa</option>
                            <option value="Keputusan Perbekel" {{ $data->kategori == 'Keputusan Perbekel' ? 'selected' : '' }}>Keputusan Perbekel</option>
                            <option value="Pengumuman" {{ $data->kategori == 'Pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                        </select>
                        @error('kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tahun --}}
                    <div class="mb-3">
                        <label class="form-label">Tahun</label>
                        <input type="number"
                               name="tahun"
                               value="{{ old('tahun', $data->tahun) }}"
                               class="form-control @error('tahun') is-invalid @enderror"
                               required>
                        @error('tahun')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- File --}}
                    <div class="mb-3">
                        <label class="form-label">Ganti File (Optional)</label>
                        <input type="file"
                               name="file"
                               class="form-control @error('file') is-invalid @enderror"
                               accept="application/pdf">
                        <small class="text-muted">
                            File saat ini: 
                            <a href="{{ asset('storage/' . $data->file) }}" target="_blank">
                                Lihat File
                            </a>
                        </small>
                        @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Update
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


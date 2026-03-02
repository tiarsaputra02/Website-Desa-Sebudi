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
                <h3>Berita Desa</h3>
                <p class="text-subtitle text-muted">Tambah Berita Desa</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Berita Desa</li>
                        <li class="breadcrumb-item active">Tambah</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Tambah Berita</h5>
            </div>

            <div class="card-body">
                <form action="{{ route('news.store') }}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf

                    {{-- Judul --}}
                    <div class="form-group mb-3">
                        <label>Judul Berita</label>
                        <input type="text"
                               class="form-control"
                               name="judul"
                               placeholder="Masukkan judul berita"
                               required>
                    </div>

                    {{-- Penulis --}}
                    <div class="form-group mb-3">
                        <label>Penulis</label>
                        <input type="text"
                               class="form-control"
                               name="penulis"
                               value="Admin Desa">
                    </div>

                    {{-- Thumbnail --}}
                    <div class="form-group mb-3">
                        <label>Thumbnail (Wajib)</label>
                        <input type="file"
                               class="form-control"
                               name="gambar"
                               accept="image/*"
                               required>
                    </div>

                    {{-- Gambar Tambahan --}}
                    <div class="form-group mb-3">
                        <label>Gambar Tambahan (maks 3)</label>
                        <input type="file"
                               class="form-control"
                               name="images[]"
                               accept="image/*"
                               multiple>
                        <small class="text-muted">
                            Opsional, maksimal 3 gambar tambahan
                        </small>
                    </div>

                    {{-- Isi Berita --}}
                    <div class="form-group mb-3">
                        <label>Isi Berita</label>
                        <textarea class="form-control"
                                  name="isi"
                                  rows="6"
                                  placeholder="Tulis isi berita di sini..."
                                  required></textarea>
                    </div>

                    {{-- Status --}}
                    <div class="form-group mb-3">
                        <label>Status</label>
                        <select name="status" class="form-select">
                            <option value="publish">Publish</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Berita</button>

                </form>
            </div>
        </div>
    </section>
</div>

@endsection


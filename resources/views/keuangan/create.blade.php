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
                <h3>Tambah APBDes</h3>
                <p class="text-subtitle text-muted">Input Tahun Anggaran & APBDes baru</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('keuangan.index') }}">Keuangan Desa</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah APBDes</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Form Tambah APBDes</h5>
            </div>
            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('keuangan.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="tahun_id" class="form-label">Pilih Tahun (untuk APBDes lama)</label>
                        <select name="tahun_id" id="tahun_id" class="form-select">
                            <option value="">-- Tahun Baru --</option>
                            @foreach($tahun as $t)
                                <option value="{{ $t->id }}">{{ $t->tahun }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="tahun_baru" class="form-label">Tahun Baru (isi jika ingin tambah tahun baru)</label>
                        <input type="number" name="tahun_baru" id="tahun_baru" class="form-control" placeholder="contoh: 2026">
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status Tahun</label>
                        <select name="status" id="status" class="form-select">
                            <option value="aktif">Aktif</option>
                            <option value="arsip">Arsip</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="total_pendapatan" class="form-label">Total Pendapatan</label>
                        <input type="number" name="total_pendapatan" id="total_pendapatan" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="total_belanja" class="form-label">Total Belanja</label>
                        <input type="number" name="total_belanja" id="total_belanja" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" class="form-control" rows="3"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan APBDes</button>
                    <a href="{{ route('keuangan.index') }}" class="btn btn-secondary">Batal</a>

                </form>

            </div>
        </div>
    </section>
</div>

@endsection


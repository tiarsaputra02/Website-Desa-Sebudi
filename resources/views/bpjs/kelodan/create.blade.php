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
                <h3> Bpjs Banjar Dinas Badeg Kelodan</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item " aria-current="page"> Bpjs Banjar Dinas Badeg Kelodan</li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah  Bpjs Banjar Dinas Badeg Kelodan </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Tambah Data BPJS Warga Dinas kelodan
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route ('bpjs.kelodan.store')}}" method="POST">

                    @csrf

                    <div class="mb-2" >
                        <label for=""class="form-label">Nama</label>
                        <p>{{$nama}}</p>
                    </div>

                    <div class="mb-2" style="display:none">
                        <label for=""class="form-label">warga_id</label>
                        <input type="hidden" name="warga_id" class="form-control" value="{{$citizen}}" required>
                        @error('warga_id')
                            <div class="invalid-feedback" >{{$message}}</div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label for="" class="form-label">Jenis BPJS</label>
                            <select name="jenis_bpjs" id="jenis_bpjs"
                                class="form-control @error('jenis_bpjs') is-invalid @enderror" required>
                                <option value="">Pilih Jenis BPJS</option>
                                <option value="BPJS Kesehatan" {{
                                old('jenis_bpjs') == 'BPJS Kesehatan' ?
                            'selected' : '' }}>BPJS Kesehatan</option>
                                <option value="BPJS Ketenagakerjaan" {{
                                old('jenis_bpjs') == 'BPJS Ketenagakerjaan' ?
                            'selected' : '' }}>BPJS Ketenagakerjaan</option>
                            </select>
                        @error('jenis_bpjs')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label for="" class="form-label">Kategori BPJS</label>
                            <select name="kategori" id="kategori"
                                class="form-control @error('kategori') is-invalid @enderror" required>
                                <option value="">Pilih Kategori BPJS</option>
                                <option value="Penerima Bantuan Iuran" {{
                                old('kategori') == 'Penerima Bantuan Iuran' ?
                            'selected' : '' }}>Penerima Bantuan Iuran</option>
                                <option value="Pekerja Penerima Upah" {{
                                old('kategori') == 'Pekerja Penerima Upah' ?
                            'selected' : '' }}>Pekerja Penerima Upah</option>
                                <option value="Pekerja Mandiri" {{
                                old('kategori') == 'Pekerja Mandiri' ?
                            'selected' : '' }}>Pekerja Mandiri</option>
                                <option value="Bukan Pekerja" {{
                                old('kategori') == 'Bukan Pekerja' ?
                            'selected' : '' }}>Bukan Pekerja</option>
                                <option value="Jaminan Hari Tua" {{
                                old('kategori') == 'Jaminan Hari Tua' ?
                            'selected' : '' }}>Jaminan Hari Tua</option>
                                <option value="Jaminan Kelecakaan Kerja" {{
                                old('kategori') == 'Jaminan Kecelakaan Kerja' ?
                            'selected' : '' }}>Jaminan Kecelakaan Kerja</option>
                                <option value="Jaminan Pensiun" {{
                                old('kategori') == 'Jaminan Pensiun' ?
                            'selected' : '' }}>Jaminan Pensiun</option>
                                <option value="Jaminan Kematian" {{
                                old('kategori') == 'Jaminan Kematian' ?
                            'selected' : '' }}>Jaminan Kematian</option>
                                <option value="Jaminan Migran Indoenesia" {{
                                old('kategori') == 'Jaminan Migran Indonesia' ?
                            'selected' : '' }}>Jaminan Mirgran Indonesia</option>
                            </select>
                        @error('kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label for="" class="form-label">Status BPJS</label>
                            <select name="status" id="status"
                                class="form-control @error('status') is-invalid @enderror" required>
                                <option value="">Pilih Status BPJS</option>
                                <option value="Active" {{
                                old('status') == 'Active' ?
                            'selected' : '' }}>Aktif</option>
                                <option value="Non Active " {{
                                old('status') == 'Non Active' ?
                            'selected' : '' }}>Tidak Aktif</option>
                            </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label for=""class="form-label">Nomor Kartu Bpjs</label>
                        <input type="text" name="nomor_kartu"
                        class="form-control  @error('nomor_kartu')
                        is-invalid @enderror" value="{{old('nomor_kartu')
                        }}">
                        @error('nomor_kartu')
                            <div class="invalid-feedback" >{{$message}}</div>
                        @enderror
                    </div>

                    <button type="submit"class="btn btn-primary">Tambah Data
                        BPJS</button>
                    <a href="{{route('bpjs.kelodan.index')}}" class="btn
                        btn-secondary">Kembali Ke Daptar Bpjs</a>
                </form>
            </div>
        </div>

    </section>
</div>
<script>

@endsection

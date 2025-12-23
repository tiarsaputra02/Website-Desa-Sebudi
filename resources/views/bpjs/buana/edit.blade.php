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
                <h3>Angota Kaluarga</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item " aria-current="page">BPJS
                            Banjar Telung Buana</li>
                        <li class="breadcrumb-item active"
                            aria-current="page">Perbaharui Data BPJS</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Perbaharui Data BPJS
                </h5>
            </div>
            <div class="card-body">

                @if(session('error'))
                    <div class="alert alert-danger" >{{session('error')}}</div>
                @endif

                <form action="{{route('bpjs.buana.update',$bpjs_member->id)}}"  method="POST">
                    @csrf
                    @method('PUT')

                <div class="mb-2">
                    <label for=""class="form-label">Warga Banjar Dinas buana</label>
                    <p>{{$bpjs_member->Citizen->nama_lengkap}}</p>
                    <input type="Hidden" name="warga_id" class="form-control"
                     value="{{$bpjs_member->Citizen->id}}" required>
                </div>

                    <div class="mb-2">
                        <label for="" class="form-label">Jenis BPJS</label>
                            <select name="jenis_bpjs" id="jenis_bpjs" class="form-control" required>
                                <option value="BPJS Kesehatan" {{
                                old('jenis_bpjs',$bpjs_member->jenis_bpjs) ==
                            'BPSJ Kesehatan' ? 'selected' : '' }}>BPJS Kesehatan</option>
                                <option value="BPJS Ketenagakerjaan" {{
                                old('jenis_bpjs',$bpjs_member->jenis_bpjs) ==
                            'BPJS Ketenagakerjaan' ? 'selected' : '' }}>BPJS
                            Ketenaga Kerjaan</option>
                            </select>
                    </div>

                    <div class="mb-2">
                        <label for="" class="form-label">Kategori BPJS</label>
                            <select name="kategori" id="kategori" class="form-control" required>

                                <option value="Penerima Bantuan Iuran" {{
                                old('kategori',$bpjs_member->kategori) ==
                            'Penerima Bantuan Iuran' ? 'selected' : ''
                        }}>Penrima Bantuan Iuran</option>

                                <option value="Pekerja Penerima Upah" {{
                                old('kategori',$bpjs_member->kategori) ==
                            'Pekerja Penerima Upah' ? 'selected' : '' }}>
                            Pekerja Penerima Upah</option>

                                <option value="Pekerja Mandiri" {{
                                old('kategori',$bpjs_member->kategori) ==
                            'Pekerja Mandiri' ? 'selected' : '' }}>
                            Pekerja Mandiri</option>

                                <option value="Bukan Pekerja" {{
                                old('kategori',$bpjs_member->kategori) ==
                            'Bukan Pekerja' ? 'selected' : '' }}>
                            Bukan Pekerja</option>

                                <option value="Jaminan Hari Tua" {{
                                old('kategori',$bpjs_member->kategori) ==
                            'Jaminan Hari Tua' ? 'selected' : '' }}>
                            Jaminan Hari Tua</option>

                                <option value="Jaminan Kecelakaan Kerja" {{
                                old('kategori',$bpjs_member->kategori) ==
                            'Jaminan Kecelakaan Kerja' ? 'selected' : '' }}>Jaminan Kecelakaan Kerja
                            </option>

                                <option value="Jaminan Pensiun" {{
                                old('kategori',$bpjs_member->kategori) ==
                            'Jaminan Pensiun' ? 'selected' : '' }}>Jaminan
                            Pensiun
                            </option>

                                <option value="Jaminan Kematian" {{
                                old('kategori',$bpjs_member->kategori) ==
                            'Jaminan Kematian' ? 'selected' : '' }}>Jaminan
                            Kematian
                            </option>

                                <option value="Jaminan Migran Indonesia" {{
                                old('kategori',$bpjs_member->kategori) ==
                            'Jaminan Migran Indonesia' ? 'selected' : '' }}>Jaminan
                            Migran Indonesia
                            </option>

                            </select>
                    </div>

                    <div class="mb-2">
                        <label for="" class="form-label">Status BPJS</label>
                            <select name="status" class="form-control" required>
                                <option value="Active" {{
                                old('status',$bpjs_member->status) ==
                            'Active' ? 'selected' : '' }}> Aktif</option>
                                <option value="Non Active" {{
                                old('status',$bpjs_member->status) ==
                            'Non Active' ? 'selected' : '' }}>
                            Tidak Aktif</option>
                            </select>
                    </div>

                <div class="mb-2">
                    <label for=""class="form-label">Nomor Kartu BPJS</label>
                    <input type="text" name="nomor_kartu" class="form-control"
                    value="{{$bpjs_member->nomor_kartu}}" required>
                </div>

                    <button type="submit"class="btn btn-primary">Perbaharui BPJS </button>
                    <a href="{{route ('bpjs.buana.index')}}" class="btn
                        btn-secondary">Kembali Ke Daptar BPJS</a>

                </form>
            </div>
        </div>

    </section>
</div>

@endsection

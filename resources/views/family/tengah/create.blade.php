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
                <h3>Kepala Keluarga</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item " aria-current="page">Kepala Keluarga</li>
                        <li class="breadcrumb-item " aria-current="page">Banjar Dinas Badeg Tengah</li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Kepala Keluarga </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Tambah Kepala Keluarga
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route ('tengah.store')}}" method="POST"  enctype="multipart/form-data">

                    @csrf

                    <div class="mb-2">
                        <label for=""class="form-label">Kepala Keluarga</label>
                        <input type="text" name="kepala_keluarga" style="text-transform: upercase;" class="form-control @error('kepala_keluarga') is-invalid @enderror" value="{{old('kepala_keluarga') }}" required>
                        @error('kepala_keluarga')
                            <div class="invalid-feedback" >{{$message}}</div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label for=""class="form-label">Nomor Kartu Keluarga</label>
                        <input type="text" name="no_kk" class="form-control @error('no_kk') is-invalid @enderror" value="{{old('no_kk') }}" required>
                        @error('no_kk')
                            <div class="invalid-feedback" >{{$message}}</div>
                        @enderror
                    </div>

                    <div class="mb-2" style="display:none">
                        <label for=""class="form-label">wilayah</label>
                        <input type="text" name="wilayah_id" class="form-control" value="4" required>
                        @error('wilayah_id')
                            <div class="invalid-feedback" >{{$message}}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="photo_kk" class="form-label">Foto KK</label>
                        <p>Foto KK Hanya Bisa Di Simpan Dalam format pdf</p>
                        <input type="file" name="photo_kk" id="photo_kk" class="form-control @error('photo_kk') is-invalid @enderror" value="{{old('photo_kk')}}" accept="application/pdf">
                        @error('photo_kk')
                            <div class="invalid-feedback" >{{$message}}</div>
                        @enderror
                    </div>

                    <button type="submit"class="btn btn-primary">Tambah Kepala Keluarga Baru</button>
                    <a href="{{route('tengah.index')}}" class="btn btn-secondary">Kembali Ke Daptar Kepala Keluarga </a>

                </form>
            </div>
        </div>

    </section>
</div>

@endsection

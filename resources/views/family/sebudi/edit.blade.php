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
                        <li class="breadcrumb-item active" aria-current="page">Perbaharui Kepala Keluarga</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Kepala Keluarga
                </h5>
            </div>
            <div class="card-body">

                @if(session('error'))
                    <div class="alert alert-danger" >{{session('error')}}</div>
                @endif

                <form action="{{ route ('sebudi.update', $family->id) }}" enctype="multipart/form-data" method="POST">

                    @csrf
                    @method('PUT')

                <div class="mb-3">
                    <label for="no_kk" class="form-label">Nomor KK</label>
                    <input type="text" name="no_kk" class="form-control @error('no_kk') is-invalid @enderror" value="{{ old('no_kk',$family->no_kk) }}" required>
                    @error('no_kk')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nama_kepala" class="form-label">Nama Kepala Keluarga</label>
                    <input type="text" name="kepala_keluarga"  class="form-control" value="{{ old('kepala_keluarga', $family->kepala_keluarga) }}" required>
                </div>

                <div class="mb-3">
                    <label for="photo_kk" class="form-label">File Kartu Keluarga (PDF)</label><br>

                     @if ($family->photo_kk)
                        <a href="{{ asset('storage/' . $family->photo_kk) }}"
                           target="_blank"
                           class="btn btn-outline-primary btn-sm mb-2">
                           Lihat File KK (PDF)
                        </a>
                    <br>
                    <small class="text-muted">Jika ingin mengganti file, upload file PDF baru di bawah ini.</small>
                    @endif

                    <input type="file"
                        name="photo_kk"
                        id="photo_kk"
                        class="form-control mt-2"
                        accept="application/pdf">
                    </div>

                    <button type="submit"class="btn btn-primary">Perbaharui Kepala Keluarga </button>
                    <a href="{{route('sebudi.index')}}" class="btn btn-secondary">Kembali Kedaptar Kepala Keluarga</a>

                </form>
            </div>
        </div>

    </section>
</div>

@endsection

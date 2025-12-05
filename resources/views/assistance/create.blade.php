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
                <h3>Jenis Bantuan</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Tampilan Utama</a></li>
                        <li class="breadcrumb-item " aria-current="page">Jenis Bantuan</li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Jenis Bantuan </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Tambah Jenis Bantuan
                </h5>
            </div>
            <div class="card-body">

                <form action="{{ route ('assistance.store')}}" method="POST">

                    @csrf

                    <div class="mb-2">
                        <label for=""class="form-label">Jenis Bantuan</label>
                        <input type="text" name="jenis_bantuan" class="form-control" value="" required>
                        @error('jenis_bantuan')
                            <div class="invalid-feedback" >{{$message}}</div>
                        @enderror
                    </div>


                    <button type="submit"class="btn btn-primary">Tambah Jenis Bantuan Baru</button>
                    <a href="{{route('assistance.index')}}" class="btn btn-secondary">Kembali Ke Daptar Jenis Bantuan </a>

                </form>
            </div>
        </div>

    </section>
</div>

@endsection

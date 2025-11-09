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
                <h3>Status Perkawinan</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Tamilan Utama</a></li>
                        <li class="breadcrumb-item " aria-current="page">Status Perkawinan</li>
                        <li class="breadcrumb-item active" aria-current="page">Perbaharui Status Perkawinan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Status Perkawinan
                </h5>
            </div>
            <div class="card-body">

                @if(session('error'))
                    <div class="alert alert-danger" >{{session('error')}}</div>
                @endif

                <form action="{{ route ('marital.update', $maritalstatus->id) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="mb-2">
                        <label for=""class="form-label">Status Perkawinan</label>
                        <input type="text" name="status_pernikahan" class="form-control" value="{{old('status_pernikahan',$maritalstatus->status_pernikahan)}}" required>
                        @error('status_pernikahan')
                            <div class="invalid-feedback" >{{$message}}</div>
                        @enderror
                    </div>

                    <button type="submit"class="btn btn-primary">Perbaharui Status Perkawinan </button>
                    <a href="{{route('marital.index')}}" class="btn btn-secondary">Kembali Kedaptar Status Perkawinan</a>

                </form>
            </div>
        </div>

    </section>
</div>

@endsection

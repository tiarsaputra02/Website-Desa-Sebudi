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
                <h3>Jenis Admin</h3>
                <p class="text-subtitle text-muted">Jenis Admin </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Tamilan Utama</a></li>
                        <li class="breadcrumb-item " aria-current="page">Jenis Admin</li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Jenis Admin</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                  Jenis Admin
                </h5>
            </div>
            <div class="card-body">

                @if(session('error'))
                    <div class="alert alert-danger" >{{session('error')}}</div>
                @endif

                <form action="{{ route ('role.update', $role->id) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="mb-2">
                        <label for=""class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" value="{{old('title',$role->title)}}" required>
                        @error('')
                            <div class="invalid-feedback" >{{$message}}</div>
                        @enderror
                    </div>

                    <button type="submit"class="btn btn-primary">Perbaharui Jenis Admin</button>
                    <a href="{{route('role.index')}}" class="btn btn-secondary">Kembali Kedaptar Jenis Admin</a>

                </form>
            </div>
        </div>

    </section>
</div>

@endsection

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
                <p class="text-subtitle text-muted"> Akun </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item " aria-current="page">Akun</li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Akun</li>
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

                <form action="{{ route ('user.update', $user->id) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="mb-2">
                        <label>Nama</label>
                        <p>{{$user->name}}</p>
                    </div>

                    <div class="mb-2">
                        <label>Email</label>
                        <p>{{$user->email}}</p>
                    </div>

                    <div class="mb-2">
                        <label for=""class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" value="" required>
                        @error('')
                            <div class="invalid-feedback" >{{$message}}</div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label for=""class="form-label"> confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" value="" required>
                        @error('')
                            <div class="invalid-feedback" >{{$message}}</div>
                        @enderror
                    </div>

                    <button type="submit"class="btn btn-primary">Perbaharui Akun</button>
                    <a href="{{route('user.index')}}" class="btn btn-secondary">Kembali Kedaptar Akun</a>

                </form>
            </div>
        </div>

    </section>
</div>

@endsection

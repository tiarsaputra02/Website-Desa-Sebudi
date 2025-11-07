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
                <h3>Edit Admin</h3>
                <p class="text-subtitle text-muted">Ubah Admin </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Halaman Utama</a></li>
                        <li class="breadcrumb-item " aria-current="page">Admin</li>
                        <li class="breadcrumb-item active" aria-current="page">Ubah Admin</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                   Ubah Admin
                </h5>
            </div>
            <div class="card-body">

                @if(session('error'))
                    <div class="alert alert-danger" >{{session('error')}}</div>
                @endif

                <form action="{{ route ('employee.update', $employee->id) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="mb-2">
                        <label for=""class="form-label">Full Name</label>
                        <input type="text" name="fullname" class="form-control" value="{{old('fullname',$employee->fullname)}}" required>
                        @error('fullname')
                            <div class="invalid-feedback" >{{$message}}</div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label for=""class="form-label">Email</label>
                        <input type="text" name="email" class="form-control" value="{{old('email',$employee->email)}}" required>
                        @error('email')
                            <div class="invalid-feedback" >{{$message}}</div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label for=""class="form-label">Phone Number</label>
                        <input type="text" name="phone_number" class="form-control" value="{{old('phone_number',$employee->phone_number)}}" required>
                        @error('phone_number')
                            <div class="invalid-feedback" >{{$message}}</div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label for=""class="form-label">Role</label>
                            <select  name="role_id"  class="form-control @error('role_id') is-invalid @enderror">
                                    <option value="">Select An Role</option>
                                @foreach ($role as $roles)
                            <option value="{{$roles->id}}" @if(old('role_id',$roles->id) == $employee->role_id) selected @endif>{{$roles->title}}</option>
                                @endforeach
                            </select>
                            @error('role_id')
                            <div class="invalid-feedback" >{{$message}}</div>
                        @enderror
                    </div>

                    <button type="submit"class="btn btn-primary">Ubah Data Admin</button>
                    <a href="{{route('employee.index')}}" class="btn btn-secondary">Kembali Ke Halaman Admin</a>

                </form>
            </div>
        </div>

    </section>
</div>

@endsection

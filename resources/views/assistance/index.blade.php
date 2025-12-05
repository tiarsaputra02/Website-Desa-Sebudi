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
                        <li class="breadcrumb-item active" aria-current="page">Menu Utama</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Jenis Bantuan
                </h5>
            </div>
            <div class="card-body">

                <div class="d-flex">
                    <a href="{{ route ('assistance.create') }} " class="btn btn-primary mb-3 ms-auto">Tambahkan Jenis Bantuan Baru</a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success" >{{session('success')}}</div>
                @endif

                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Jenis Bantuan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($assistance as $assistances)
                        <tr>
                            <td>{{$assistances->jenis_bantuan}}</td>
                            <td>
                                <a href="{{ route ('assistance.edit', $assistances->id) }} " class="btn btn-warning btn-sm">Ubah</a>
                                <form action="{{ route ('assistance.destroy', $assistances->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah yakin menghapua data {{$assistances->jenis_bantuan}}  ?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>

@endsection

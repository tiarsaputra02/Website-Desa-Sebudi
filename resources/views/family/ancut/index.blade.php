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
                <h3>Kepala Keluarga Banjar Dinas Ancut</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item " aria-current="page">Kepala Keluarga Banjar Dinas Ancut</li>
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

                <div class="d-flex">
                    <a href="{{ route ('ancut.create') }} " class="btn btn-success mb-3 ms-auto">Tambahkan Kepala Keluarga Baru</a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success" >{{session('success')}}</div>
                @endif

                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Nama Kepala Keluarga</th>
                            <th>No KK</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($family as $familys)
                        <tr>
                            <td>{{$familys->kepala_keluarga}}</td>
                            <td>{{$familys->no_kk}}</td>
                            <td>
                                <a href="{{ route ('ancut.show', $familys->id) }} " class="btn btn-primary btn-sm">Lihat Data</a>
                                <a href="{{ route ('ancut.edit', $familys->id) }} " class="btn btn-warning btn-sm">Ubah</a>

                                <form action="{{ route ('ancut.destroy', $familys->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah yakin menghapus data Kepala Keluarga {{$familys->kepala_keluarga}}  ?')">Hapus</button>
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

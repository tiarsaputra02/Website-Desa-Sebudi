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
                <h3>Pendidikan</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Tampilan Utama</a></li>
                        <li class="breadcrumb-item " aria-current="page">Pendidikan</li>
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
                    Pendidikan
                </h5>
            </div>
            <div class="card-body">

                <div class="d-flex">
                    <a href="{{ route ('education.create') }} " class="btn btn-primary mb-3 ms-auto">Tambahkan Pendidikan Baru</a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success" >{{session('success')}}</div>
                @endif

                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Pendidikan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($education as $educations)
                        <tr>
                            <td>{{$educations->strata_pendidikan}}</td>
                            <td>
                                <a href="{{ route ('education.edit', $educations->id) }} " class="btn btn-warning btn-sm">Ubah</a>
                                <form action="{{ route ('education.destroy', $educations->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah yakin menghapua data {{$educations->strata_pendidikan}}  ?')">Hapus</button>
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

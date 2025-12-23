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
                <h3>Data Warga Banjar Dinas Sebudi</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item " aria-current="page">Data Warga Banjar Dinas Sebudi</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Data Warga Banjar Dinas Sebudi
                </h5>
            </div>
            <div class="card-body">

                @if(session('success'))
                    <div class="alert alert-success" >{{session('success')}}</div>
                    <script>
                        document.addEventListener('DOMContentLoaded', () => {
                        const alert = document.querySelector('.alert');
                            if (alert) {
                                setTimeout(() => {
                                const bsAlert = new bootstrap.Alert(alert);
                                bsAlert.close(); // auto-dismiss pakai animasi fade bawaan Bootstrap
                                  }, 3000); // 3 detik
                                }
                             });
                    </script>
                @endif

                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Nama Warga Banjar Dinas Sebudi</th>
                            <th>No Nik</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($citizen as $citizens)
                        <tr>
                            <td>{{$citizens->nama_lengkap}}</td>
                            <td>{{$citizens->nik}}</td>
                            <td>
                                <a href="{{ route ('bpjs.sebudi.create', $citizens->id) }} " class="btn btn-success btn-sm">Tambah BPJS</a>
                                <a href="{{ route ('citizen.sebudi.show', $citizens->id) }} " class="btn btn-primary btn-sm">Lihat Data</a>
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

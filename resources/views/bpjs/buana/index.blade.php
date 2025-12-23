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
                <h3>BPJS Masyarakat Banjar Telung Buana</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item " aria-current="page">BPJS
                            Masyarakat Banjar Telung Buana</li>
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
                    BPJS Masyarakat Banjar Telungi Buana
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
                            <th>Nama Warga Penerima Bpjs</th>
                            <th>Jenis BPJS</th>
                            <th>Kategori BPJS</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($bpjs_member as $bpjs_members)
                        <tr>
                            <td>{{$bpjs_members->Citizen->nama_lengkap}}</td>
                            <td>{{$bpjs_members->jenis_bpjs}}</td>
                            <td>{{$bpjs_members->kategori}}</td>
                            <td>{{$bpjs_members->status}}</td>
                            <td>

                            <a href="{{ route ('bpjs.buana.edit', $bpjs_members->id) }} " class="btn btn-warning btn-sm">Ubah</a>

                            <form action="{{ route('bpjs.buana.destroy', $bpjs_members->id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')

                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah yakin menghapus data  {{$bpjs_members->Citizen->nama_lengkap}}  ?')">Hapus</button>
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

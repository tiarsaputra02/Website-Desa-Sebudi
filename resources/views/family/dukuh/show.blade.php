
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
                <h3>Kepala Keluarga</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item " aria-current="page">Kepala Keluarga</li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Kepala Keluarga</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Detail Kepala Keluarga
                </h4>
            </div>
            <div class="card-body">

                <div class="mb-3">
                   <label for=""><b><u>Kepala Keluarga</u></b></label>
                    <p>{{$family->kepala_keluarga}}</p>
                </div>

                <div class="mb-3">
                   <label for=""><b><u>No Kartu Keluarga</u></b></label>
                    <p>{{$family->no_kk}}</p>
                </div>

                <div class="mb-3">
                   <label for=""><b>Foto Kartu Keluraga</b></label>
                    <br>
                        <a href="{{ asset('storage/' . $family->photo_kk) }}"
                           target="_blank"
                           class="btn btn-outline-primary btn-sm mb-2">
                           Lihat File KK (PDF)
                        </a>
                </div>

            <div class="pt-5">
                <h5>
                    Angggota Kepala Keluarga
                </h5>
            </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                    </div>

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


                <div class="d-flex">
                    <a href="{{ route ('citizen.dukuh.create', $family->id) }} " class="btn btn-success mb-3 ms-auto">Tambahkan Data Agota Keluarga {{$family->kepala_keluarga}}</a>
                </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th> Nama Lengkap</th>
                            <th> NIK</th>
                            <th>Setatus Hubungan Dalam Keluarga</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($family->citizen as $citizens)
                        <tr>
                            <td>{{$citizens->nama_lengkap}}</td>
                            <td>{{$citizens->nik}}</td>
                            <td>{{$citizens->status_keluarga}}</td>
                            <td>
                                <a href="{{ route ('bpjs.dukuh.create', $citizens->id) }} " class="btn btn-success btn-sm">Tambah BPJS</a>
                                <a href="{{ route ('citizen.dukuh.show', $citizens->id) }} " class="btn btn-primary btn-sm">Lihat Data</a>
                                <a href="{{ route ('citizen.dukuh.edit', $citizens->id) }} " class="btn btn-warning btn-sm">Ubah</a>
                                <form action="{{ route ('citizen.dukuh.destroy', $citizens->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Yakin Menghapus Data  {{$citizens->nama_lengkap}}  ?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

                <a href="{{route('dukuh.index')}}" class="btn btn-secondary">Kembali Ke Daptar Kepala Keluarga</a>
            </div>
        </div>

    </section>
</div>

@endsection

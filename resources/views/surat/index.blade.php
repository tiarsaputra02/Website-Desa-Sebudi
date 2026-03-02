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
                <h3>Surat Keluar</h3>
                <p class="text-subtitle text-muted">Daftar Surat Keluar Desa</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Surat Keluar</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Surat Keluar
                </h5>
            </div>

            <div class="card-body">

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomor Surat</th>
                            <th>Nama Surat</th>
                            <th>Jenis Surat</th>
                            <th>Tanggal Surat</th>
                            <th>Kepala Keluarga</th>
                            <th>Wilayah</th>
                            <th>File</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                    @forelse ($surat as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nomor_surat }}</td>
                            <td>{{ $item->nama_surat }}</td>
                            <td>{{ $item->jenisSurat->nama_surat ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_surat)->format('d-m-Y') }}</td>
                            <td>{{ $item->family->kepala_keluarga ?? '-' }}</td>
                            <td>{{ $item->family->village->nama_wilayah ?? '-' }}</td>
                            <td>
                                @if($item->file_path)
                                    <a href="{{ Storage::url($item->file_path) }}" 
                                       target="_blank"
                                       class="btn btn-info btn-sm">
                                       Lihat
                                    </a>
                                @else
                                    <span class="text-muted">Belum Ada</span>
                                @endif
                            </td>
                            <td>

                                <form action="{{ route('surat.destroy', $item->id) }}" 
                                      method="POST" 
                                      style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin hapus surat ini?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">
                                Belum ada data surat keluar.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </section>
</div>

@endsection


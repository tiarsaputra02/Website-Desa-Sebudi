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
                <h3>Keuangan Desa</h3>
                <p class="text-subtitle text-muted">Data Tahun Anggaran & APBDes</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Keuangan Desa</li>
                        <li class="breadcrumb-item active" aria-current="page">APBDes</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title">Daftar APBDes</h5>
                <a href="{{ route('keuangan.create') }}" class="btn btn-primary btn-sm">Tambah APBDes</a>
            </div>

            <div class="card-body">

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    <script>
                        document.addEventListener('DOMContentLoaded', () => {
                            const alert = document.querySelector('.alert');
                            if (alert) {
                                setTimeout(() => {
                                    const bsAlert = new bootstrap.Alert(alert);
                                    bsAlert.close();
                                }, 3000);
                            }
                        });
                    </script>
                @endif

                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Tahun Anggaran</th>
                            <th>Status</th>
                            <th>Total Pendapatan</th>
                            <th>Total Belanja</th>
                            <th>Surplus / Defisit</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tahun as $t)
                            <tr>
                                <td>{{ $t->tahun }}</td>
                                <td>{{ ucfirst($t->status) }}</td>
                                <td>Rp {{ number_format($t->apbdes?->total_pendapatan ?? 0, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($t->apbdes?->total_belanja ?? 0, 0, ',', '.') }}</td>
                                <td>
                                    @php $sd = $t->apbdes?->surplus_defisit ?? 0 @endphp
                                    @if ($sd >= 0)
                                        <span class="text-success">Rp {{ number_format($sd,0,',','.') }}</span>
                                    @else
                                        <span class="text-danger">Rp {{ number_format(abs($sd),0,',','.') }}</span>
                                    @endif
                                </td>
                                <td>{{ $t->apbdes?->keterangan ?? '-' }}</td>
                                <td>
                                    @if ($t->apbdes)
                                        <a href="{{ route('keuangan.edit', $t->apbdes->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('keuangan.destroy', $t->apbdes->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    @else
                                        <a href="{{ route('keuangan.create') }}" class="btn btn-primary btn-sm">Tambah APBDes</a>
                                    @endif
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


@extends('layouts.dashboard')

@section('content')

<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <div class="page-title">
        <h3>Buat Surat: {{ $jenis->nama_surat }}</h3>
        <p class="text-muted">Kepala Keluarga: {{ $family->kepala_keluarga }}</p>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5>Input Data Surat</h5>
            </div>

            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('surat.store', [$family->id, $jenis->id]) }}">
                    @csrf
                    <input type="hidden" name="redirect" value="{{ $redirect }}">

                    {{-- Include form berdasarkan slug --}}
                    @includeIf('surat.forms.' . $jenis->slug)

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Generate Surat</button>
                        <a href="{{ route($redirect, $family->id) }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>

            </div>
        </div>
    </section>
</div>

@endsection


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
                <h3> Warga Banjar Dinas Ancut</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item " aria-current="page"> Warga Banjar Dinas Ancut</li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah  Warga Banjar Dinas Ancut </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Tambah Angota Kartu Keluraga {{$familyhead->kepala_keluarga}}
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route ('citizen.ancut.store')}}" method="POST">

                    @csrf

                    <div class="mb-2">
                        <label for=""class="form-label"> Nama Warga</label>
                        <input type="text" name="nama_lengkap" style="text-transform: upercase;" class="form-control @error('nama_lengkap') is-invalid @enderror" value="{{old('nama_lengkap') }}" required>
                        @error('nama_lengkap')
                            <div class="invalid-feedback" >{{$message}}</div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label for=""class="form-label">Nomor Induk Kependudukan</label>
                        <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" value="{{old('nik') }}" required>
                        @error('nik')
                            <div class="invalid-feedback" >{{$message}}</div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label for="" class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-Laki" {{ old('jenis_kelamin') == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        @error('jenis_kelamin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label for=""class="form-label">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" value="{{old('tempat_lahir') }}" required>
                        @error('tempat_lahir')
                            <div class="invalid-feedback" >{{$message}}</div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label for=""class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control date @error('tanggal_lahir') is-invalid @enderror" value="{{old('tanggal_lahir') }}" required>
                        @error('tanggal_lahir')
                            <div class="invalid-feedback" >{{$message}}</div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label for=""class="form-label">Agama</label>
                            <select  name="agama_id" id="agama_id" class="form-control @error('agama_id') is-invalid @enderror" value="{{old('agama_id')}}"  required>
                                    <option value="">Pilih Agama</option>
                                @foreach ($religion as $religions)
                                    <option value="{{ $religions->id }}" {{ old('agama_id') == $religions->id ? 'selected' : '' }}>
                                        {{$religions->agama}}
                                    </option>
                                @endforeach
                            </select>
                            @error('agama_id')
                            <div class="invalid-feedback" >{{$message}}</div>
                            @enderror
                    </div>

                    <div class="mb-2">
                        <label for=""class="form-label">Pendidikan</label>
                            <select  name="pendidikan_id" id="pendidikan_id" class="form-control @error('pendidikan_id') is-invalid @enderror" value="{{old('pendidikan_id')}}" required>
                                    <option value="">Pilih Strata Pendidikan</option>
                                @foreach ($educationlevel as $educationlevels)
                                    <option value="{{ $educationlevels->id }}" {{ old('pendidikan_id') == $educationlevels->id ? 'selected' : '' }}>
                                        {{$educationlevels->strata_pendidikan}}
                                    </option>
                                @endforeach
                            </select>
                            @error('pendidikan_id')
                            <div class="invalid-feedback" >{{$message}}</div>
                            @enderror
                    </div>

                    <div class="mb-2">
                        <label for=""class="form-label">Pekerjaan</label>
                            <select  name="pekerjaan_id" id="pekerjaan_id" class="form-control @error('perkerjaan_id') is-invalid @enderror" value="{{old('pekerjaan_id')}}" required>
                                    <option value="">Pilih Pekerjaan</option>
                                @foreach ($profesion as $profesions)
                                    <option value="{{ $profesions->id }}" {{ old('pekerjaan_id') == $profesions->id ? 'selected' : '' }}>
                                        {{$profesions->pekerjaan}}
                                    </option>
                                @endforeach
                            </select>
                            @error('pekerjaan_id')
                            <div class="invalid-feedback" >{{$message}}</div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label for=""class="form-label">Status Perkawinan</label>
                            <select  name="perkawinan_id" id="perkawinan_id" class="form-control @error('perkawinan_id') is-invalid @enderror" value="{{old('perkawinan_id')}}"required>
                                    <option value="">Pilih Perkawinan</option>
                                @foreach ($maritalstatus as $maritalstatuss)
                                    <option value="{{ $maritalstatuss->id }}" {{ old('perkawinan_id') == $maritalstatuss->id ? 'selected' : '' }}>
                                        {{$maritalstatuss->status_pernikahan}}
                                    </option>
                                @endforeach
                            </select>
                            @error('perkawinan_id')
                            <div class="invalid-feedback" >{{$message}}</div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label for="" class="form-label">Status Hubungan Dalam Keluarga Keluarga</label>
                            <select name="status_keluarga" id="status_keluarga" class="form-control @error('status_keluarga') is-invalid @enderror" required>
                                <option value="">Pilih Status Keluarga</option>
                                <option value="Kepala Keluarga" {{ old('status_keluarga') == 'Kepala Keluarga' ? 'selected' : '' }}>Kepala Keluarga</option>
                                <option value="Istri" {{ old('status_keluarga') == 'Istri' ? 'selected' : '' }}>Istri</option>
                                <option value="Anak" {{ old('status_keluarga') == 'Anak' ? 'selected' : '' }}>Anak</option>
                                <option value="Orang Tua" {{ old('status_keluarga') == 'Orang Tua' ? 'selected' : '' }}>Orang Tua</option>
                                <option value="Menantu" {{ old('status_keluarga') == 'Menantu' ? 'selected' : '' }}>Menantu</option>
                                <option value="Cucu" {{ old('status_keluarga') == 'Cucu' ? 'selected' : '' }}>Cucu</option>
                                <option value="Lainnya" {{ old('status_keluarga') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        @error('status_keluarga')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label for="" class="form-label">Kewarganegaraan</label>
                            <select name="kewarganegaraan" id="kewarganegaraan" class="form-control @error('kewarganegaraan') is-invalid @enderror" required>
                                <option value="">Pilih Kewarganegaraan</option>
                                <option value="WNA" {{ old('kewarganegaraan') == 'WNA' ? 'selected' : '' }}>WNA</option>
                                <option value="WNI" {{ old('kewarganegaraan') == 'WNI' ? 'selected' : '' }}>WNI</option>
                            </select>
                        @error('kewarganegaraan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label for=""class="form-label">Nama Ayah</label>
                        <input type="text" name="ayah" class="form-control @error('ayah') is-invalid @enderror" value="{{old('ayah') }}" required>
                        @error('ayah')
                            <div class="invalid-feedback" >{{$message}}</div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label for=""class="form-label">Nama Ibu</label>
                        <input type="text" name="ibu" class="form-control @error('ibu') is-invalid @enderror" value="{{old('ibu') }}" required>
                        @error('ibu')
                            <div class="invalid-feedback" >{{$message}}</div>
                        @enderror
                    </div>

                    <div class="mb-2" style="display:none;">
                        <label for=""class="form-label">Status Hidup</label>
                        <input type="hidden" name="status_hidup" class="form-control @error('ibu') is-invalid @enderror" value="Hidup" required>
                            @error('status_hidup')
                            <div class="invalid-feedback" >{{$message}}</div>
                        @enderror
                    </div>

                    <div class="mb-2" style="display:none">
                        <label for=""class="form-label">wilayah</label>
                        <input type="hidden" name="wilayah_id" class="form-control" value="6" required>
                        @error('wilayah_id')
                            <div class="invalid-feedback" >{{$message}}</div>
                        @enderror
                    </div>

                    <div class="mb-2" style="display:none;">
                        <label for=""class="form-label">Kepala Keluarga</label>
                        <input type="hidden" name="kepala_keluarga" class="form-control" value="{{$familyhead->id}}" required>
                    </div>


                    <div class="mb-2">
                        <label for=""class="form-label">Jenis Bantuan</label>
                            <select  name="bantuan_id" id="bantuan_id" class="form-control @error('bantuan_id') is-invalid @enderror" value="{{old('bantuan_id')}}" required>
                                    <option value="">Pilih Jenis Bantuan</option>
                                    <option value="">Tidak Ada Bantuan</option>
                                @foreach ($assistancetypes as $assistancetypess)
                                    <option value="{{ $assistancetypess->id }}" {{ old('bantuan_id') == $assistancetypess->id ? 'selected' : '' }}>
                                        {{$assistancetypess->jenis_bantuan}}
                                    </option>
                                @endforeach
                            </select>
                            @error('bantuan_id')
                            <div class="invalid-feedback" >{{$message}}</div>
                        @enderror
                    </div>

                    <button type="submit"class="btn btn-primary">Tambah Angota Keluarga {{$familyhead->kepala_keluarga}} </button>
                    <a href="{{route ('ancut.show', $familyhead->id)}}" class="btn btn-secondary">Kembali Ke Kartu Keluraga {{$familyhead->kepala_keluarga}}</a>

                </form>
            </div>
        </div>

    </section>
</div>

@endsection

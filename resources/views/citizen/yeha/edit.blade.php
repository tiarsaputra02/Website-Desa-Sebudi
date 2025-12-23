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
                <h3>Angota Kaluarga</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item " aria-current="page">Angota Kaluarga</li>
                        <li class="breadcrumb-item active" aria-current="page">Perbaharui Angota Kaluarga</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                  Perbaharui Data Angota Kaluarga {{$citizen->nama_lengkap}}
                </h5>
            </div>
            <div class="card-body">

                @if(session('error'))
                    <div class="alert alert-danger" >{{session('error')}}</div>
                @endif

                <form action="{{ route ('citizen.yeha.update', $citizen->id) }}"  method="POST">

                    @csrf
                    @method('PUT')

                <div class="mb-3">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror" value="{{ old('nama_lengkap',$citizen->nama_lengkap) }}" required>
                    @error('nama_lengkap')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nik" class="form-label">NIK</label>
                    <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik',$citizen->nik) }}" required>
                    @error('nik')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-2">
                    <label for="" class="form-label">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="Laki-Laki" {{ old('jenis_kelamin',$citizen->jenis_kelamin) == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin',$citizen->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                 </div>

                <div class="mb-3">
                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" value="{{ old('tempat_lahir',$citizen->tempat_lahir) }}" required>
                    @error('tempat_lahir')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="tempat_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control date @error('tanggal_lahir') is-invalid @enderror" value="{{ old('tanggal_lahir',$citizen->tanggal_lahir) }}" required>
                    @error('tempat_lahir')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                    @enderror
                </div>


                <div class="mb-2">
                    <label for=""class="form-label">Agama</label>
                    <select  name="agama_id"  class="form-control @error('agama_id') is-invalid @enderror">
                          @foreach ($religion as $religions)
                          <option value="{{$religions->id}}" @if(old('agama_id',$religions->id) == $citizen->agama_id) selected @endif>{{$religions->agama}}</option>
                          @endforeach
                    </select>
                    @error('agama_id')
                          <div class="invalid-feedback" >{{$message}}</div>
                    @enderror
                </div>

                <div class="mb-2">
                    <label for=""class="form-label">Pendidikan</label>
                    <select  name="pendidikan_id"  class="form-control @error('pendidikan_id') is-invalid @enderror">
                          @foreach ($educationlevel as $educationlevels)
                          <option value="{{$educationlevels->id}}" @if(old('pendidikan_id',$educationlevels->id) == $citizen->pendidikan_id) selected @endif>{{$educationlevels->strata_pendidikan}}</option>
                          @endforeach
                    </select>
                    @error('pendidikan_id')
                          <div class="invalid-feedback" >{{$message}}</div>
                    @enderror
                </div>

                <div class="mb-2">
                    <label for=""class="form-label">Jenis Pekerjaan</label>
                    <select  name="pekerjaan_id"  class="form-control @error('pekerjaan_id') is-invalid @enderror">
                          @foreach ($profesion as $profesions)
                          <option value="{{$profesions->id}}" @if(old('pekerjaan_id',$profesions->id) == $citizen->pekerjaan_id) selected @endif>{{$profesions->pekerjaan}}</option>
                          @endforeach
                    </select>
                    @error('pekerjaan_id')
                          <div class="invalid-feedback" >{{$message}}</div>
                    @enderror
                </div>

                <div class="mb-2">
                    <label for=""class="form-label">Status Perkawinan</label>
                    <select  name="perkawinan_id"  class="form-control @error('perkawinan_id') is-invalid @enderror">
                          @foreach ($maritalstatus as $maritalstatuss)
                          <option value="{{$maritalstatuss->id}}" @if(old('perkawinan_id',$maritalstatuss->id) == $citizen->perkawinan_id) selected @endif>{{$maritalstatuss->status_pernikahan}}</option>
                          @endforeach
                    </select>
                    @error('pekerjaan_id')
                          <div class="invalid-feedback" >{{$message}}</div>
                    @enderror
                </div>

                    <div class="mb-2">
                        <label for="" class="form-label">Status Hubungan Dalam Keluarga Keluarga</label>
                            <select name="status_keluarga" id="status_keluarga" class="form-control @error('status_keluarga') is-invalid @enderror" required>
                                <option value="Kepala Keluarga" {{ old('status_keluarga',$citizen->status_keluarga) == 'Kepala Keluarga' ? 'selected' : '' }}>Kepala Keluarga</option>
                                <option value="Istri" {{ old('status_keluarga',$citizen->status_keluarga) == 'Istri' ? 'selected' : '' }}>Istri</option>
                                <option value="Anak" {{ old('status_keluarga',$citizen->status_keluarga) == 'Anak' ? 'selected' : '' }}>Anak</option>
                                <option value="Orang Tua" {{ old('status_keluarga',$citizen->status_keluarga) == 'Orang Tua' ? 'selected' : '' }}>Orang Tua</option>
                                <option value="Menantu" {{ old('status_keluarga',$citizen->status_keluarga) == 'Menantu' ? 'selected' : '' }}>Menantu </option>
                                <option value="Cucu" {{ old('status_keluarga',$citizen->status_keluarga) == 'Cucu' ? 'selected' : '' }}>Cucu </option>
                                <option value="Lainnya" {{ old('status_keluarga',$citizen->status_keluarga) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        @error('status_keluarga')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                <div class="mb-2">
                    <label for="" class="form-label">Kewarganegaraan</label>
                    <select name="kewarganegaraan" id="kewarganegaraan" class="form-control @error('kewarganegaraan') is-invalid @enderror" required>
                        <option value="WNA" {{ old('kewarganegaraan',$citizen->kewarganegaraan) == 'WNA' ? 'selected' : '' }}>WNA</option>
                        <option value="WNI" {{ old('kewarganegaraan',$citizen->kewarganegaraan) == 'WNI' ? 'selected' : '' }}>WNI</option>
                    </select>
                    @error('kewarganegaraan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                 </div>

                <div class="mb-3">
                    <label for="tempat_lahir" class="form-label">Nama Ayah</label>
                    <input type="text" name="ayah" class="form-control @error('ayah') is-invalid @enderror" value="{{ old('ayah',$citizen->ayah) }}" required>
                    @error('ayah')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="tempat_lahir" class="form-label">Nama Ibu</label>
                    <input type="text" name="ibu" class="form-control @error('ibu') is-invalid @enderror" value="{{ old('ibu',$citizen->ibu) }}" required>
                    @error('ibu')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-2" style="display:none;">
                    <label for=""class="form-label">Kepala Keluarga</label>
                    <input type="hidden" name="kepala_keluarga" class="form-control" value="{{$citizen->kepala_keluarga}}" required>
                </div>

                <div class="mb-2">
                    <label for=""class="form-label">Jenis Bantuan</label>
                    <select  name="bantuan_id"  class="form-control @error('bantuan_id') is-invalid @enderror">
                           <option value=""
                            {{ old('bantuan_id', $citizen->bantuan_id) == null ? 'selected' : '' }}>
                                Tidak Ada Bantuan
                           </option>
                          @foreach ($assistancetypes as $assistancetypess)
                          <option value="{{$assistancetypess->id}}" @if(old('bantuan_id',$assistancetypess->id) == $citizen->bantuan_id) selected @endif>{{$assistancetypess->jenis_bantuan}}</option>
                          @endforeach
                    </select>
                    @error('bantuan_id')
                          <div class="invalid-feedback" >{{$message}}</div>
                    @enderror
                </div>

                    <div class="mb-2">
                        <label for="" class="form-label">Status Hidup</label>
                            <select name="status_hidup" id="status_hidup" class="form-control" required>
                                <option value="Hidup" {{ old('status_hidup',$citizen->status_hidup) == 'Hidup' ? 'selected' : '' }}>Hidup</option>
                                <option value="Meninggal" {{ old('status_hidup',$citizen->status_hidup) == 'Meninggal' ? 'selected' : '' }}>Meninggal</option>
                            </select>
                    </div>

                    <button type="submit"class="btn btn-primary">Perbaharui Angota Kaluarga {{$citizen->nama_lengkap}}</button>
                    <a href="{{route ('yeha.show',$citizen->kepala_keluarga)}}" class="btn btn-secondary">Kembali Kedaptar Angota Kaluarga {{$citizen->nama_lengkap}}</a>

                </form>
            </div>
        </div>

    </section>
</div>

@endsection

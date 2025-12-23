
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
                <h3>Warga Banjar Dinas tengah</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Detail Warga Banjar Dinas Badeg tengah</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Detail Warga Banjar Dinas Badeg Tengah
                </h4>
            </div>
            <div class="card-body">

                <div class="mb-3">
                   <label class="mb-3" for=""><b><u>Nama Kepala Keluarga</u></b></label>
                       <ul>
                           <li>{{$citizen->FamilyHead->kepala_keluarga}}</li>
                       </ul>
                </div>

                <h5>Alamat</h5>
                <div class="mb-3">
                   <label class="mb-3" for=""><b><u>Alamat</u></b></label>
                       <ul>
                           <li>{{$citizen->Villages->nama_wilayah}}</li>
                       </ul>
                </div>

                <div class="mb-3">
                   <label class="mb-3" for=""><b><u>Desa/Kelurahan</u></b></label>
                       <ul>
                           <li>{{$citizen->Villages->desa}}</li>
                       </ul>
                </div>

                <div class="mb-3">
                   <label class="mb-3" for=""><b><u>Kecamatan</u></b></label>
                       <ul>
                           <li>{{$citizen->Villages->kecamatan}}</li>
                       </ul>
                </div>

                <div class="mb-3">
                   <label class="mb-3" for=""><b><u>Kabupaten</u></b></label>
                       <ul>
                           <li>{{$citizen->Villages->kabupaten}}</li>
                       </ul>
                </div>

                <div class="mb-3">
                   <label class="mb-3" for=""><b><u>Provinsi</u></b></label>
                       <ul>
                           <li>{{$citizen->Villages->provinsi}}</li>
                       </ul>
                </div>

                <h6>Detail Warga {{$citizen->nama_lengkap}}</h6>
                <div class="mb-3">
                   <label class="mb-3" for=""><b><u>Nama Lengkap</u></b></label>
                       <ul>
                           <li>{{$citizen->nama_lengkap}}</li>
                       </ul>
                </div>

                <div class="mb-3">
                   <label class="mb-3" for=""><b><u>NIK</u></b></label>
                       <ul>
                           <li>{{$citizen->nik}}</li>
                       </ul>
                </div>

                <div class="mb-3">
                   <label class="mb-3" for=""><b><u>Jenis Kelamin</u></b></label>
                       <ul>
                           <li>{{$citizen->jenis_kelamin}}</li>
                       </ul>
                </div>

                <div class="mb-3">
                   <label class="mb-3" for=""><b><u>Tempat Lahir</u></b></label>
                       <ul>
                           <li>{{$citizen->tempat_lahir}}</li>
                       </ul>
                </div>

                <div class="mb-3">
                   <label class="mb-3" for=""><b><u>Tanggal Lahir</u></b></label>
                       <ul>
                           <li>{{$tanggal_lahir}} ( {{$age}} Tahun )</li>
                       </ul>
                </div>

                <div class="mb-3">
                   <label class="mb-3" for=""><b><u>Agama</u></b></label>
                       <ul>
                           <li>{{$citizen->Religion->agama}}</li>
                       </ul>
                </div>

                <div class="mb-3">
                   <label class="mb-3" for=""><b><u>Pendidikan</u></b></label>
                       <ul>
                           <li>{{$citizen->EducationLevel->strata_pendidikan}}</li>
                       </ul>
                </div>

                <div class="mb-3">
                   <label class="mb-3" for=""><b><u>Jenis Pekerjaan</u></b></label>
                       <ul>
                           <li>{{$citizen->Profesion->pekerjaan}}</li>
                       </ul>
                </div>

                <div class="mb-3">
                   <label class="mb-3" for=""><b><u>Status Perkawinan</u></b></label>
                       <ul>
                           <li>{{$citizen->MaritalStatus->status_pernikahan}}</li>
                       </ul>
                </div>

                <div class="mb-3">
                   <label class="mb-3" for=""><b><u>Status Hubungan Dalam Keluarga</u></b></label>
                       <ul>
                        <li>{{$citizen->status_keluarga}}</li>
                       </ul>
                </div>

                <div class="mb-3">
                   <label class="mb-3" for=""><b><u>Kewarganegaraan</u></b></label>
                       <ul>
                        <li>{{$citizen->kewarganegaraan}}</li>
                       </ul>
                </div>

                <h5>Nama Orang Tua</h5>
                <div class="mb-3">
                   <label class="mb-3" for=""><b><u>Ayah</u></b></label>
                       <ul>
                        <li>{{$citizen->ayah}}</li>
                       </ul>
                </div>

                <div class="mb-3">
                   <label class="mb-3" for=""><b><u>Ibu</u></b></label>
                       <ul>
                        <li>{{$citizen->ibu}}</li>
                       </ul>
                </div>

                <div class="mb-3">
                   <label class="mb-3" for=""><b><u>Status Hidup</u></b></label>
                       <ul>
                        <li>{{$citizen->status_hidup}}</li>
                       </ul>
                </div>

                <div class="mb-3">
                   <label class="mb-3" for=""><b><u>Jenis Bantuan</u></b></label>
                   @if($citizen->bantuan_id === null)
                       <ul>
                       <li>Tidak Ada Bantuan</li>
                       </ul>
                   @else
                       <ul>
                        <li>{{$citizen->AssistanceTypes->jenis_bantuan}}</li>
                       </ul>
                   @endif
                </div>

                <div class="mb-3">
                   <label class="mb-3" for=""><b><u>Jenis BPJS</u></b></label>
                   @if( $citizen->BpjsMember->isEmpty())
                       <ul>
                       <li>Tidak Ada BPJS</li>
                       </ul>
                   @else
                   @foreach($citizen->BpjsMember as $bpjs)
                       <ul>
                       <li>{{$bpjs->jenis_bpjs}}</li>
                       </ul>
                   @endforeach
                   @endif
                </div>

                <div class="mb-3">
                   <label class="mb-3" for=""><b><u>Kategori BPJS</u></b></label>
                   @if( $citizen->BpjsMember->isEmpty())
                       <ul>
                       <li>Tidak Ada BPJS</li>
                       </ul>
                   @else
                   @foreach($citizen->BpjsMember as $bpjs)
                       <ul>
                       <li>{{$bpjs->kategori}}</li>
                       </ul>
                   @endforeach
                   @endif
                </div>

                <div class="mb-3">
                   <label class="mb-3" for=""><b><u>Status BPJS</u></b></label>
                   @if( $citizen->BpjsMember->isEmpty())
                       <ul>
                       <li>Tidak Ada BPJS</li>
                       </ul>
                   @else
                   @foreach($citizen->BpjsMember as $bpjs)
                       <ul>
                       <li>{{$bpjs->status}}</li>
                       </ul>
                   @endforeach
                   @endif
                </div>

                <div class="mb-3">
                   <label class="mb-3"for=""><b><u>NO BPJS</u></b></label>
                   @if( $citizen->BpjsMember->isEmpty())
                       <ul>
                       <li>Tidak Ada BPJS</li>
                       </ul>
                   @else
                   @foreach($citizen->BpjsMember as $bpjs)
                       <ul>
                       <li>{{$bpjs->nomor_kartu}}</li>
                       </ul>
                   @endforeach
                   @endif
                </div>

                <div class="mb-3">
                   <label for=""><b>Foto Kartu Keluraga</b></label>
                    <br>
                        <a href="{{ asset('storage/' . $citizen->FamilyHead->photo_kk) }}"
                           target="_blank"
                           class="btn btn-outline-primary btn-sm mb-2">
                           Lihat File KK (PDF)
                        </a>
                </div>

               <a href="{{route('citizen.tengah.citizen.tengah', $citizen->Villages->id)}}" class="btn btn-secondary">Kembali Data Warga</a>
               <a href="{{route ('tengah.show',$citizen->FamilyHead->id)}}" class="btn btn-secondary">Kembali Kedaptar Angota Keluarga {{$citizen->FamilyHead->kepala_keluarga}}</a>

            </div>
        </div>

    </section>
</div>

@endsection

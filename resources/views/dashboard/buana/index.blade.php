@extends('layouts.dashboard')

@section('content')
   <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
           <i class="bi bi-justify fs-3"></i>
        </a>
   </header>

<div class="page-heading">
    <h3>Menu Utama Banjar Dinas Telung Buana</h3>
    <h5>Selamat Datang {{ auth()->user()->empeloyee->fullname }}
{{ auth()->user()->empeloyee->role->title }} </h5>
</div>


<div class="page-content">
    <section class="row">
       <div class="row">
          <div class="col-12">
            <div class="card">
                 <div class="card-header d-flex justify-content-between align-items-center">
                     <h4>Jumlah Warga Banjar Dinas Pura Telung Buana {{$tahun}}</h4>
                        <form method="GET" action="{{ route('dashboard.buana') }}">
                            <select name="tahun" class="form-select" onchange="this.form.submit()">
                            <option>Tahun Data {{$tahun}}</option>
                            @foreach ($listTahun as $t)
                                <option value="{{ $t }}" {{ request('tahun') == $t ? 'selected' : '' }}>
                                {{ $t }}
                                </option>
                            @endforeach
                            </select>
                        </form>
                    </div>
                </div>
             </div>
           </div>
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon blue mb-2">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Kartu Kelurga</h6>
                                    <h6 class="font-extrabold mb-0">{{$totalKepalaKeluarga}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon blue mb-2">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Warga</h6>
                                    <h6 class="font-extrabold mb-0">{{$totalWarga}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon green mb-2">
                                        <i class="iconly-boldAdd-User"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Bantuan</h6>
                                    <h6 class="font-extrabold mb-0">{{$totalAssistance}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon red mb-2">
                                        <i class="iconly-boldBookmark"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Tanpa Bantuan </h6>
                                    <h6 class="font-extrabold mb-0">{{$tanpa_bantuan}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Umur Warga </h4>
                        </div>
                        <div class="card-body">
                            <div id="umur"></div>
                            <div class="table-responsive">
                            <table class="table table-striped">
                            <thead>
                                <tr>
                                  <th>Usia</th>
                                  <th>Rentang Umur</th>
                                  <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                  <td>Bayi</td>
                                  <td>0-1 Tahun</td>
                                  <td>{{$umur->bayi}}</td>
                                </tr>

                                <tr>
                                  <td>Balita </td>
                                  <td> 1-5 Tahun</td>
                                  <td>{{$umur->balita}}</td>
                                </tr>

                                <tr>
                                  <td>Anak-Anak</td>
                                  <td> 6-12 Tahun</td>
                                  <td>{{$umur->anak}}</td>
                                </tr>

                                <tr>
                                  <td>Remaja</td>
                                  <td> 13-17 Tahun</td>
                                  <td>{{$umur->remaja}}</td>
                                </tr>

                                <tr>
                                  <td>Dewasa</td>
                                  <td> 18-55 Tahun</td>
                                  <td>{{$umur->dewasa}}</td>
                                </tr>

                                <tr>
                                  <td>Lansia</td>
                                  <td> 55 > Tahun</td>
                                  <td>{{$umur->lansia}}</td>
                                </tr>
                                <tr><td><b>Total Jumlah</b></td></tr>
                                <tr><td>{{$totalUmur}}</td></tr>
                            </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4>Jenis Kelamin</h4>
                </div>
                <div class="card-body">
                    <div id="jenis-kelamin"></div>
                <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Laki-Laki</td>
                            <td>{{$laki_laki}}</td>
                        </tr>
                        <tr>
                            <td>Perempuan</td>
                            <td>{{$perempuan}}</td>
                        </tr>
                         <tr><td><b>Total Jumlah</b></td></tr>
                         <tr><td>{{$totalJenisKelamin}}</td></tr>
                    </tbody>
                </table>
            </div>
         </div>
      </div>

            <div class="card">
                <div class="card-header">
                    <h4>Agama</h4>
                </div>
                <div class="card-body">
                    <div id="agama"></div>
                <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Agama </th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($queryReligion as $religion)
                        <tr>
                            <td>{{$religion->agama}}</td>
                            <td>{{$religion->total}}</td>
                        </tr>
                    @endforeach
                         <tr><td><b>Total Jumlah</b></td></tr>
                         <tr><td>{{$totalReligion}}</td></tr>
                    </tbody>
                </table>
            </div>
         </div>
      </div>

            <div class="card">
                <div class="card-header">
                    <h4>Pekerjaan</h4>
                </div>
                <div class="card-body">
                    <div id="pekerjaan"></div>
                <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th> Pekerjaan</th>
                            <th> Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($jumlahPekerjaan as $pekerjaan)
                        <tr>
                            <td>{{$pekerjaan->pekerjaan}}</td>
                            <td>{{$pekerjaan->total}}</td>
                        </tr>
                    @endforeach
                         <tr><td><b>Total Jumlah</b></td></tr>
                         <tr><td>{{$totalProfesion}}</td></tr>
                    </tbody>
                </table>
            </div>
          </div>
       </div>

            <div class="card">
                <div class="card-header">
                    <h4>Pendidikan</h4>
                </div>
                <div class="card-body">
                    <div id="pendidikan"></div>
                <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th> Pendidikan</th>
                            <th> Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($jumlahPendidikan as $pendidikan)
                        <tr>
                            <td>{{$pendidikan->strata_pendidikan}}</td>
                            <td>{{$pendidikan->total}}</td>
                        </tr>
                    @endforeach
                         <tr><td><b>Total Jumlah</b></td></tr>
                         <tr><td>{{$totalEducationLevels}}</td></tr>
                    </tbody>
                </table>
            </div>
          </div>
       </div>

            <div class="card">
                <div class="card-header">
                    <h4>Status Perwakinan</h4>
                </div>
                <div class="card-body">
                    <div id="pernikahan"></div>
                <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th> Perkawinan</th>
                            <th> Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($jumlahPerkawinan as $perkawinan)
                        <tr>
                            <td>{{$perkawinan->status_pernikahan}}</td>
                            <td>{{$perkawinan->total}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                         <tr><td><b>Total Jumlah</b></td></tr>
                         <tr><td>{{$totalMaritalStatus}}</td></tr>
                </table>
            </div>
          </div>
       </div>

            <div class="card">
                <div class="card-header">
                    <h4>Bantuan</h4>
                </div>
                <div class="card-body">
                    <div id="bantuan"></div>
                <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th> Bantuan</th>
                            <th> Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($jumlahBantuan as $bantuan)
                        <tr>
                            <td>{{$bantuan->jenis_bantuan}}</td>
                            <td>{{$bantuan->total}}</td>
                        </tr>
                    @endforeach
                         <tr><td><b>Total Jumlah</b></td></tr>
                         <tr><td>{{$totalAssistance}}</td></tr>
                    </tbody>
                </table>
            </div>
          </div>
       </div>

            <div class="card">
                <div class="card-header">
                    <h4>Jumlah BPJS</h4>
                </div>
                <div class="card-body">
                    <div id="bpjs"></div>
                <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Jenis BPJS</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($queryJenis as $bpjs_jenis)
                        <tr>
                            <td>{{$bpjs_jenis->jenis_bpjs}}</td>
                            <td>{{$bpjs_jenis->total}}</td>
                        </tr>
                    @endforeach
                         <tr><td><b>Total Jumlah</b></td></tr>
                         <tr><td>{{$totalJenisBpjs}}</td></tr>
                    </tbody>
                    <thead>
                        <tr>
                            <th>Kategori BPJS</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($queryKategori as $bpjs_kategori)
                        <tr>
                            <td>{{$bpjs_kategori->kategori}}</td>
                            <td>{{$bpjs_kategori->total}}</td>
                        </tr>
                    @endforeach
                         <tr><td><b>Total Jumlah</b></td></tr>
                         <tr><td>{{$totalKategoriBpjs}}</td></tr>
                    </tbody>
                </table>
            </div>
          </div>
       </div>

    </section>
</div>

<script>

    window.chartDataJenisKelamin = {
        series: @json($data_kelamin),
        labels: @json($jenis_kelamin),
    };

    window.chartDataAgama = {
        series: @json($chartReligionData),
        labels: @json($chartReligionLebel),
    };

    window.chartDataPekerjaan = {
        series: @json($chartProfesionData),
        labels: @json($chartProfesionLebel),
    };

    window.chartDataPendidikan = {
        series: @json($chartEducationLevelsData),
        labels: @json($chartEducationLevelsLebel),
    };

    window.chartDataPernikahan = {
        series: @json($chartMaritalStatusData),
        labels: @json($chartMaritalStatusLebel),
    };

    window.chartDataBantuan = {
        series: @json($chartAssistanceData),
        labels: @json($chartAssistanceLebel),
    };

    window.chartDataJenis = {
        series: @json($chartJenisBpjsData),
        labels: @json($chartJenisBpjsLabel),
    };

</script>

<script>
    document.addEventListener("DOMContentLoaded", () => {

        const umurData = @json($umur);

        let optionsUmur = {
            chart: {
                type: 'bar',
                height: 350
            },
            series: [{
                name: 'Jumlah',
                data: [
                    umurData.bayi,
                    umurData.balita,
                    umurData.anak,
                    umurData.remaja,
                    umurData.dewasa,
                    umurData.lansia
                ]
            }],
            xaxis: {
                categories: [
                    'Bayi',
                    'Balita',
                    'Anak-anak',
                    'Remaja',
                    'Dewasa',
                    'Lansia'
                ]
            },
            plotOptions: {
                bar: {
                    columnWidth: '40%',
                    distributed: true
                }
            },
            dataLabels: {
                enabled: true
            }
        };

        new ApexCharts(
            document.querySelector("#umur"),
            optionsUmur
        ).render();

    });
</script>




@endsection

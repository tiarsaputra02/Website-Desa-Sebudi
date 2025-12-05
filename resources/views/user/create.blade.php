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
                <h3>Jenis Admin</h3>
                <p class="text-subtitle text-muted">Tambahkan Akun</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item " aria-current="page">Akun</li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Akun </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Tambah Akun
                </h5>
            </div>
            <div class="card-body">

                <form action="{{ route ('user.store')}}" method="POST">

                    @csrf

                    <div class="mb-2">
                        <label for=""class="form-label">Plilih Admin </label>
                            <select  name="employe_id" id="Empeloyee_Select"
                                class="form-control @error('employe_id')
                                is-invalid @enderror" value="{{old('employe_id')}}" required>
                                    <option value="">Pilih Admin
                                    </option>
                                @foreach ($employe as $employes)
                                    <option value="{{ $employes->id }}" data-name = "{{$employes->fullname}}"
                                    data-email="{{$employes->email}}" data-jabatan="{{$employes->Role->title}}"{{
                                    old('') == $employes->id ? 'selected' : '' }}>
                                        {{$employes->fullname}}
                                    </option>
                                @endforeach
                            </select>
                            @error('employes_id')
                            <div class="invalid-feedback" >{{$message}}</div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <input type="hidden" id="name" name="name" class="form-control"  value="name" required>
                        @error('name')
                            <div class="invalid-feedback" >{{$message}}</div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <input type="hidden" id="email" name="email" class="form-control"  value="email" required>
                        @error('name')
                            <div class="invalid-feedback" >{{$message}}</div>
                        @enderror
                    </div>

                    <div class="mb-2" id="passwordWrapper" style="display:none;">
                        <label>Password</label>
                             <input type="password" name="password" class="form-control">
                    </div>

                    <div class="mb-2" id="jabatanWrapper" style="display:none;">
                        <label>Jabatan</label>
                        <p id="jabatan"></p>
                    </div>

                    <button type="submit"class="btn btn-primary">Tambah Akun</button>
                    <a href="{{route('user.index')}}" class="btn btn-secondary">Kembali Ke Daptar Akun</a>

                </form>
            </div>
        </div>

    </section>
</div>
<script>
document.getElementById('Empeloyee_Select').addEventListener('change', function() {
    const selected = this.options[this.selectedIndex];

    document.getElementById('name').value = selected.dataset.name || '';
    document.getElementById('email').value = selected.dataset.email || '';
    document.getElementById('jabatan').textContent = selected.dataset.jabatan || '';
});
document.getElementById('Empeloyee_Select').addEventListener('change', function() {
    const wrapper = document.getElementById('passwordWrapper');
    const jabatanwrapper = document.getElementById('jabatanWrapper');

    if (this.value) {
        wrapper.style.display = 'block';
    } else {
        wrapper.style.display = 'none';
    }

    if (this.value) {
        jabatanwrapper.style.display = 'block';
    } else {
        jabatanwrapper.style.display = 'none';
    }
})

</script>
@endsection

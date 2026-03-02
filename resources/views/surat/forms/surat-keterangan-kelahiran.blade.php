<h5 class="mt-3">Data Anak</h5>
<div class="mb-3">
    <label>No Surat</label>
    <input type="text" name="no_surat" class="form-control" value="{{ old('no_surat') }}" required>
</div>
<div class="mb-3">
    <label>Nama Anak</label>
    <input type="text" name="nama_anak" class="form-control" value="{{ old('nama_anak') }}" required>
</div>

<div class="mb-3">
    <label>Jenis Kelamin</label>
    <select name="jenis_kelamin_anak" class="form-control">
        <option value="Laki-laki">Laki-laki</option>
        <option value="Perempuan">Perempuan</option>
    </select>
</div>

<div class="mb-3">
    <label>Tempat Lahir</label>
    <input type="text" name="tempat_lahir_anak" class="form-control" value="{{ old('tempat_lahir_anak') }}" required>
</div>

<div class="mb-3">
    <label>Tanggal Lahir</label>
    <input type="date" name="tanggal_lahir_anak" class="form-control" value="{{ old('tanggal_lahir_anak', date('Y-m-d')) }}" required>
</div>

<div class="mb-3">
    <label>Jam Lahir</label>
    <input type="time" name="jam_lahir" class="form-control" value="{{ old('jam_lahir') }}" required>
</div>

<div class="mb-3">
    <label>Agama</label>
    <input type="text" name="agama_anak" class="form-control" value="{{ old('agama_anak',$agamaAyah) }}">
</div>

<div class="mb-3">
    <label>Alamat</label>
    <textarea name="alamat_anak" class="form-control">{{ old('alamat_anak',$alamatAyah) }}</textarea>
</div>

<hr>
<h5>Data Ayah</h5>
<div class="mb-3">
    <label>Pilih Ayah</label>
    <select name="ayah_id" class="form-control" required>
        @foreach($family->citizen->where('status_keluarga', 'Kepala Keluarga') as $ayah)
            <option value="{{ $ayah->id }}">{{ $ayah->nama_lengkap }} ({{ $ayah->nik }})</option>
        @endforeach
    </select>
</div>

<h5>Data Ibu</h5>
<div class="mb-3">
    <label>Pilih Ibu</label>
    <select name="ibu_id" class="form-control" required>
        @foreach($family->citizen->where('status_keluarga', 'Istri') as $ibu)
            <option value="{{ $ibu->id }}">{{ $ibu->nama_lengkap }} ({{ $ibu->nik }})</option>
        @endforeach
    </select>
</div>


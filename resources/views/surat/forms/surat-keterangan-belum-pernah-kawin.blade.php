<h5 class="mt-3">Data Pemohon dari Anak {{$family->kepala_keluarga}} </h5>

<div class="mb-3">
    <label>No Surat</label>
    <input type="text" name="no_surat" class="form-control" value="{{ old('no_surat') }}" required>
</div>

<div class="mb-3">
    <label>Pilih Anak</label>
    <select name="pemohon_id" class="form-control" required>
        @foreach($family->citizen->whereNotIn('status_keluarga', ['Kepala Keluarga', 'Istri']) as $warga)
        <option value="{{ $warga->id }}">
        {{ $warga->nama_lengkap }} 
        </option>
        @endforeach

    </select>

</div>




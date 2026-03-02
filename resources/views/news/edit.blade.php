@extends('layouts.dashboard')

@section('content')
<div class="page-heading">
    <h3>Edit Berita</h3>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('news.update', $news->slug) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Judul</label>
                    <input type="text" name="judul" class="form-control" value="{{ $news->judul }}" required>
                </div>

                <div class="mb-3">
                    <label>Penulis</label>
                    <input type="text" name="penulis" class="form-control" value="{{ $news->penulis }}">
                </div>

                <div class="mb-3">
                    <label>Thumbnail</label><br>
                    @if($news->gambar)
                        <a href="{{ asset('storage/'.$news->gambar) }}" class="glightbox">
                            <img src="{{ asset('storage/'.$news->gambar) }}" width="160" class="rounded mb-2">
                        </a>
                    @endif
                    <input type="file" name="gambar" class="form-control mt-2">
                </div>

                <div class="mb-3">
                    <label>Gambar Tambahan (maks 3)</label>
                    <input type="file" name="images[]" class="form-control" multiple>
                </div>

                {{-- Preview gambar tambahan --}}
                @if ($news->images->count())
                    <div class="mb-3">
                        <label>Gambar Tambahan Saat Ini</label>
                        <div class="row g-2">
                            @foreach ($news->images as $img)
                                <div class="col-md-3">
                                    <a href="{{ asset('storage/'.$img->image_path) }}" class="glightbox">
                                        <img src="{{ asset('storage/'.$img->image_path) }}" class="img-fluid rounded shadow-sm">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <a href="{{ route('news.images.manage', $news->slug) }}" class="btn btn-warning mt-2">
                            Kelola Gambar Tambahan
                        </a>
                    </div>
                @endif

                <div class="mb-3">
                    <label>Isi Berita</label>
                    <textarea name="isi" class="form-control" rows="6" required>{{ $news->isi }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-select">
                        <option value="publish" {{ $news->status==='publish' ? 'selected':'' }}>Publish</option>
                        <option value="draft" {{ $news->status==='draft' ? 'selected':'' }}>Draft</option>
                    </select>
                </div>

                <button class="btn btn-primary">Update Berita</button>
                <a href="{{ route('news.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<link href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    GLightbox({ selector: '.glightbox', touchNavigation:true, loop:true });
});
</script>
@endpush


@extends('layouts.dashboard')

@section('content')
<div class="page-heading">
    <h3>Kelola Gambar Tambahan</h3>

    <div class="card">
        <div class="card-body">
            <div class="row g-2">
                @foreach($news->images as $img)
                    <div class="col-md-3 image-wrapper" id="image-{{ $img->id }}">
                        <img src="{{ asset('storage/'.$img->image_path) }}" class="img-fluid rounded shadow-sm">

                        <form action="{{ route('news.image.destroy', $img->id) }}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm delete-image" 
                                    onclick="return confirm('Hapus gambar ini?')">
                                &times;
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>

            <a href="{{ route('news.edit', $news->slug) }}" class="btn btn-secondary mt-3">
                Kembali ke Edit Berita
            </a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<style>
.image-wrapper { position: relative; margin-bottom: 10px; }
.delete-form { position: absolute; top: 5px; right: 5px; z-index: 10; }
.delete-image { padding: 0 6px; font-size: 14px; }
</style>
@endpush


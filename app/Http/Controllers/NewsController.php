<?php

namespace App\Http\Controllers;
use App\Models\News;
use App\Models\NewsImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage; // <-- Ini yang penting


class NewsController extends Controller
{
    public function index()
    {
        $berita = News::orderBy('created_at', 'desc')->paginate(10);

        return view('news.index', compact('berita'));
    }
    public function create()
    {
       return view('news.create');
    }

public function store(Request $request)
{
    // Validasi
     $request->validate([
    'judul'   => 'required|string|max:255',
    'isi'     => 'required|string',
    'gambar'  => 'nullable|image|max:2048', // sementara nullable
    'images.*'=> 'nullable|image|max:2048',
    'status'  => 'required|in:publish,draft',
]);


    // Generate slug unik
    $slug = Str::slug($request->judul);
    $originalSlug = $slug;
    $counter = 1;
    while (\App\Models\News::where('slug', $slug)->exists()) {
        $slug = $originalSlug . '-' . $counter;
        $counter++;
    }

    // Simpan thumbnail
    $thumbnailPath = $request->file('gambar')->store('berita', 'public');
    // Create berita utama
    $news = \App\Models\News::create([
        'judul'   => $request->judul,
        'slug'    => $slug,
        'isi'     => $request->isi,
        'penulis' => $request->penulis ?? 'Admin',
        'gambar'  => $thumbnailPath,
        'status'  => $request->status,
        'views'   => 0,
    ]);

    // Simpan gambar tambahan (maks 3)
    if ($request->hasFile('images')) {
        $files = array_slice($request->file('images'), 0, 3); // ambil max 3
        foreach ($files as $file) {
            $news->images()->create([
                'image_path' => $file->store('berita', 'public'),
            ]);
        }
    }

    return redirect()->route('news.index')
        ->with('success', 'Berita berhasil ditambahkan');
}
    public function edit(News $news)
    {
        $news->load('images');

    return view('news.edit', compact('news'));
    }
public function update(Request $request, News $news)
{
    $request->validate([
        'judul'   => 'required|string|max:255',
        'isi'     => 'required|string',
        'gambar'  => 'nullable|image|max:2048',
        'images.*'=> 'nullable|image|max:2048',
        'status'  => 'required|in:publish,draft',
    ]);

    // update slug kalau judul berubah
    if ($news->judul !== $request->judul) {
        $slug = Str::slug($request->judul);
        $original = $slug;
        $i = 1;
        while (News::where('slug', $slug)->where('id', '!=', $news->id)->exists()) {
            $slug = $original . '-' . $i++;
        }
        $news->slug = $slug;
    }

    // ganti thumbnail
    if ($request->hasFile('gambar')) {
        Storage::disk('public')->delete($news->gambar);
        $news->gambar = $request->file('gambar')->store('berita', 'public');
    }

    // update data utama
    $news->update([
        'judul'   => $request->judul,
        'isi'     => $request->isi,
        'status'  => $request->status,
        'penulis' => $request->penulis ?? $news->penulis,
    ]);

    // tambah gambar tambahan (maks 3 total)
    if ($request->hasFile('images')) {
        $sisa = 3 - $news->images()->count();
        $files = array_slice($request->file('images'), 0, $sisa);

        foreach ($files as $file) {
            $news->images()->create([
                'image_path' => $file->store('berita', 'public'),
            ]);
        }
    }

    return redirect()->route('news.index')
        ->with('success', 'Berita berhasil diupdate');
}

    public function destroyImage($id)

    {
    $image = NewsImage::findOrFail($id);
    Storage::disk('public')->delete($image->image_path);
    $image->delete();

     return redirect()->back()->with('success', 'Gambar berhasil dihapus');

    }

    public function manageImages(News $news)
    {
        return view('news.manage', compact('news'));
    }

public function destroy(News $news)
{
    // 1. Hapus thumbnail
    if ($news->gambar && Storage::disk('public')->exists($news->gambar)) {
        Storage::disk('public')->delete($news->gambar);
    }

    // 2. Hapus semua gambar tambahan
    foreach ($news->images as $img) {
        if (Storage::disk('public')->exists($img->image_path)) {
            Storage::disk('public')->delete($img->image_path);
        }
    }

    // 3. Hapus data gambar tambahan (DB)
    $news->images()->delete();

    // 4. Hapus berita
    $news->delete();

    return redirect()
        ->route('news.index')
        ->with('success', 'Berita dan semua gambarnya berhasil dihapus');
}


    public function show(News $news)
    {
    // Tambah jumlah views
    $news->increment('views');
    $news->load('images');

    return view('news.show', compact('news'));
    }

}

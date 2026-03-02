<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\NewImage;

class News extends Model
{
    protected $table = 'newses';

    protected $fillable = [
        'judul','slug','isi','penulis','gambar','status','views'
    ];

    protected $casts = [
        'views' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($news) {
            if (empty($news->slug)) {
                $slug = Str::slug($news->judul);
                $count = static::where('slug', 'LIKE', "$slug%")->count();
                $news->slug = $count ? "{$slug}-" . ($count + 1) : $slug;
            }
        });

        static::updating(function ($news) {
            if ($news->isDirty('judul')) {
                $news->slug = Str::slug($news->judul);
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function addView()
    {
        $this->increment('views');
    }

    // 🔥 RELATION
    public function images()
    {
        return $this->hasMany(NewsImage::class, 'news_id');
    }
}

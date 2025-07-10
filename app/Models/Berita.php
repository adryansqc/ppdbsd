<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Berita extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the user that owns the Berita
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        static::updating(function ($berita) {
            if ($berita->isDirty('isi')) {
                $oldContent = $berita->getOriginal('isi');
                $newContent = $berita->isi;

                preg_match_all('/<img[^>]*src=["\']([^"\']*)["\'][^>]*>/i', $oldContent, $oldImages);
                preg_match_all('/<img[^>]*src=["\']([^"\']*)["\'][^>]*>/i', $newContent, $newImages);

                preg_match_all('/<a[^>]*href=["\']([^"\']*\.pdf)["\'][^>]*>/i', $oldContent, $oldPdfs);
                preg_match_all('/<a[^>]*href=["\']([^"\']*\.pdf)["\'][^>]*>/i', $newContent, $newPdfs);

                $oldPaths = collect($oldImages[1])->merge($oldPdfs[1])->filter(function ($path) {
                    return str_contains($path, 'berita/');
                });

                $newPaths = collect($newImages[1])->merge($newPdfs[1])->filter(function ($path) {
                    return str_contains($path, 'berita/');
                });

                $removedPaths = $oldPaths->diff($newPaths);
                foreach ($removedPaths as $path) {
                    $filePath = str_replace('/storage/', '', parse_url($path, PHP_URL_PATH));
                    Storage::disk('public')->delete($filePath);
                }
            }
        });

        static::deleting(function ($berita) {
            if ($berita->gambar) {
                Storage::disk('public')->delete($berita->gambar);
            }
        });

        static::updating(function ($berita) {
            if ($berita->isDirty('gambar') && ($oldFile = $berita->getOriginal('gambar'))) {
                Storage::disk('public')->delete($oldFile);
            }
        });
    }
}

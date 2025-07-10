<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $beritas = [
            [
                'user_id' => 1,
                'judul' => 'Berita 1',
                'isi' => 'Ini adalah berita 1',
                'gambar' => null,
                'status' => 'published',
                'tanggal_publikasi' => now(),
                'slug' => 'berita-1',
            ],
            [
                'user_id' => 1,
                'judul' => 'Berita 2',
                'isi' => 'Ini adalah berita 2',
                'gambar' => null,
                'status' => 'published',
                'tanggal_publikasi' => now(),
                'slug' => 'berita-2',
            ],
        ];

        foreach ($beritas as $berita) {
            \App\Models\Berita::create($berita);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $berita = Berita::where('status', 'published')->latest()->take(4)->get();
        return view('fe.pages.home', compact('berita'));
    }

    public function berita()
    {
        $berita = Berita::where('status', 'published')->latest()->paginate(10);
        return view('fe.pages.berita', compact('berita'));
    }

    public function beritaDetail($slug)
    {
        $berita = Berita::where('slug', $slug)->firstOrFail();
        $related_news = Berita::where('status', 'published')
            ->where('id', '!=', $berita->id)
            ->latest()
            ->take(3)
            ->get();
        return view('fe.pages.berita-detail', compact('berita', 'related_news'));
    }
}

<?php

use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');
Route::get('/berita', [FrontendController::class, 'berita'])->name('frontend.berita');
Route::get('/berita/{slug}', [FrontendController::class, 'beritaDetail'])->name('frontend.berita-detail');
Route::post('/midtrans-token', [\App\Http\Controllers\MidtransController::class, 'getSnapToken']);

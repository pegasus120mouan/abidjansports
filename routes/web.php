<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ImageProxyController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Proxy pour les images MinIO (HTTPS)
Route::get('/images/{path}', [ImageProxyController::class, 'show'])->where('path', '.*')->name('image.proxy');

// API interne pour le rafraîchissement AJAX
Route::get('/api/latest-articles', [ApiController::class, 'latestArticles'])->name('api.latest-articles');
Route::get('/api/flash-infos', [ApiController::class, 'flashInfos'])->name('api.flash-infos');
Route::get('/categorie/{slug}', [HomeController::class, 'category'])->name('category');
Route::get('/sous-categorie/{slug}', [HomeController::class, 'sousCategory'])->name('sous-category');
Route::get('/article/{slug}', [HomeController::class, 'article'])->name('article.show');
Route::get('/resultats', [HomeController::class, 'results'])->name('results');
Route::get('/equipes', [HomeController::class, 'teams'])->name('teams');
Route::get('/boutique', [HomeController::class, 'boutique'])->name('boutique');
Route::get('/boutique/{slug}', [HomeController::class, 'journalDetail'])->name('journal.show');

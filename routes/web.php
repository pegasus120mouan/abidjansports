<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/categorie/{slug}', [HomeController::class, 'category'])->name('category');
Route::get('/resultats', [HomeController::class, 'results'])->name('results');
Route::get('/equipes', [HomeController::class, 'teams'])->name('teams');

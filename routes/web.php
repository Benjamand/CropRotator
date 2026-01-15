<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\FarmerController;

Route::get('/create', [ArticleController::class, 'create'])
    ->name('create')
    ->middleware('auth');

Route::get('/', [ArticleController::class, 'index'])
    ->name('index');

Route::post('/', [ArticleController::class, 'store'])
    ->name('store');

Route::get('/register', [ArticleController::class, 'showRegistrationForm'])
    ->name('register');

Route::post('/register', [ArticleController::class, 'register']);

Route::get('/login', [ArticleController::class, 'showLoginForm'])
    ->name('login');

Route::post('/login', [ArticleController::class, 'login']);

Route::get('/logout', [ArticleController::class, 'logout'])
    ->name('logout');

Route::get('/articles', [ArticleController::class, 'articles'])
    ->name('articles');

Route::get('/articlesUser', [ArticleController::class, 'articlesUser'])
    ->name('articlesUser');

Route::get('/profile', [ArticleController::class, 'profile'])
    ->name('profile')
    ->middleware('auth');

Route::patch('/patch', [ArticleController::class, 'patch'])
    ->name('patch')
    ->middleware('auth');

Route::delete('/delete/{id}', [ArticleController::class, 'delete'])
    ->name('delete')
    ->middleware('auth');

    
Route::post('/search', [ArticleController::class, 'search'])->name('search');

Route::get('/map', [FarmerController::class, 'map'])->name('map');

Route::get('/test', fn () => view('test'));

Route::get('/articles/{id}', [ArticleController::class, 'show']);

Route::get('/debug-file/{filename}', function ($filename) {
    $path = public_path($filename);
    if (file_exists($path)) {
        return response("Found: $filename", 200);
    }
    return response("Missing: $filename", 404);
});

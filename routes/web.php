<?php

use App\Http\Controllers\JenreController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// ログインぺージ
Route::get('/', function () {
    return view('auth/login');
});

// トップページ
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [RecipeController::class, 'showRecipes'])->middleware(['auth', 'verified'])->name('dashboard');
Route::post('/dashboard', [RecipeController::class, 'uploadRecipe'])->name('upload');

// プロフィール編集ページ
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// マイページ
Route::get('/user_mypage', function () {
    return view('user_mypage');
})->name('user_mypage');

// 新規投稿ページ
Route::get('/new_recipe', [JenreController::class, 'getJenre'])->name('new_recipe');

//新規投稿作業
Route::post('/upload', [RecipeController::class, 'uploadRecipe'])->name('upload');

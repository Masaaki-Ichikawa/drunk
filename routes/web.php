<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\JenreController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\UserController;
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
Route::get('/user_mypage', [RecipeController::class, 'showMypage'])->name('user_mypage');

//ほかのユーザーの投稿一覧
Route::get('/user_recipes', [RecipeController::class, 'showUserRecipes'])->name('user_recipes');

// 新規投稿ページ
Route::get('/new_recipe', [JenreController::class, 'getJenre'])->name('new_recipe');

//新規投稿実行
Route::post('/upload', [RecipeController::class, 'uploadRecipe'])->name('upload');

//投稿詳細
Route::get('/recipe_detail', [RecipeController::class, 'recipeDetail'])->name('recipe_detail');

//コメントページ
Route::get('/comment', [CommentController::class, 'commentForm'])->name('comment');

//コメントアップロード処理
Route::post('/comment_upload', [CommentController::class, 'uploadComment'])->name('comment_upload');

//投稿編集
Route::get('/recipe_edit/{recipe}', [RecipeController::class, 'recipeEdit'])->name('recipe_edit');

//投稿編集アップロード
Route::post('/recipe_edit_upload', [RecipeController::class, 'recipeEditUp'])->name('recipe_edit_upload');

//投稿削除ページ
Route::get('/recipe_del_conf/{recipe}', [RecipeController::class, 'recipeDelConf'])->name('recipe_del_conf');

//投稿削除実行
Route::get('/recipe_del/{recipe}', [RecipeController::class, 'recipeDel'])->name('recipe_del');

//コメント削除ページ
Route::get('/comment_del_conf/{comment}', [CommentController::class, 'commentDelConf'])->name('comment_del_conf');

//コメント削除実行
Route::get('/comment_del/{comment}', [CommentController::class, 'commentDel'])->name('comment_del');

//ユーザー削除確認ページ
Route::get('/user_del_conf/{user}', [UserController::class, 'userDelConf'])->name('user_del_conf');

//ユーザー削除実行
Route::get('/user_del/{user}', [UserController::class, 'userDel'])->name('user_del');
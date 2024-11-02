<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ApiPostingController;
use App\Http\Controllers\ApiKomentarController;
use App\Http\Controllers\ApiLikeController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// user
Route::get('/coba', [App\Http\Controllers\ApiUserController::class, 'ambilData'])->name('coba');
Route::get('/ambilJenisUser', [App\Http\Controllers\ApiUserController::class, 'ambilJenisUser'])->name('coba');
Route::get('/coba/{id}', [App\Http\Controllers\ApiUserController::class, 'show']);
Route::put('/coba/{id}', [App\Http\Controllers\ApiUserController::class, 'update']);
Route::delete('/deleteUser/{id}', [App\Http\Controllers\ApiUserController::class, 'destroy']);
Route::post('/createUser', [App\Http\Controllers\ApiUserController::class, 'store']);

// kategori
Route::get('/kategori', [App\Http\Controllers\ApiKategoriController::class, 'showKategori'])->name('show.kategori');
Route::post('/createKategori', [App\Http\Controllers\ApiKategoriController::class, 'store'])->name('store.kategori');
Route::put('/kategori/{id}', [App\Http\Controllers\ApiKategoriController::class, 'update']);
Route::delete('/kategori/{id}', [App\Http\Controllers\ApiKategoriController::class, 'destroy']);

// buku
Route::get('/buku', [App\Http\Controllers\ApiBukuController::class, 'index'])->name('show.buku');
Route::get('/buku/{id}', [App\Http\Controllers\ApiBukuController::class, 'show']);
Route::post('/createBuku', [App\Http\Controllers\ApiBukuController::class, 'store']);
Route::put('/buku/{id}', [App\Http\Controllers\ApiBukuController::class, 'update']);
Route::delete('/buku/{id}', [App\Http\Controllers\ApiBukuController::class, 'destroy']);
Route::get('/kategori', [App\Http\Controllers\ApiBukuController::class, 'ambilKategori']);

// menu level
Route::get('/menuLevel', [App\Http\Controllers\ApiMenuLevelController::class, 'showMenuLevel'])->name('show.menuLevel');
Route::post('/createMenuLevel', [App\Http\Controllers\ApiMenuLevelController::class, 'store'])->name('store.menuLevel');
Route::put('/menuLevel/{id}', [App\Http\Controllers\ApiMenuLevelController::class, 'update']);
Route::delete('/menuLevel/{id}', [App\Http\Controllers\ApiMenuLevelController::class, 'destroy']);

// menu
Route::get('/menu', [App\Http\Controllers\ApiMenuController::class, 'index'])->name('menu.index');
Route::get('/menu/level', [App\Http\Controllers\ApiMenuController::class, 'ambilMenuLevel'])->name('menu.level');
Route::get('/menu/{id}', [App\Http\Controllers\ApiMenuController::class, 'show'])->name('menu.show');
Route::post('/menu', [App\Http\Controllers\ApiMenuController::class, 'store'])->name('menu.store');
Route::put('/menu/{id}', [App\Http\Controllers\ApiMenuController::class, 'update'])->name('menu.update');
Route::delete('/menu/{id}', [App\Http\Controllers\ApiMenuController::class, 'destroy'])->name('menu.destroy');

// menu user
Route::get('/menuUser', [App\Http\Controllers\ApiMenuUserController::class, 'index'])->name('menuUser.show');
Route::post('/menuUser', [App\Http\Controllers\ApiMenuUserController::class, 'store'])->name('menuUser.store');
Route::get('/menuUser/{id}', [App\Http\Controllers\ApiMenuUserController::class, 'show']);
Route::put('/menuUser/{id}', [App\Http\Controllers\ApiMenuUserController::class, 'update']);
Route::delete('/menuUser/{id}', [App\Http\Controllers\ApiMenuUserController::class, 'destroy']);
Route::get('/ambilJenisUser', [App\Http\Controllers\ApiMenuUserController::class, 'ambilJenisUser']);
Route::get('/ambilMenuUser', [App\Http\Controllers\ApiMenuUserController::class, 'ambilMenuUser']);

// data gempa bumi
Route::get('/ambilGempa', [App\Http\Controllers\GempaController::class, 'index'])->name('gempa.index');

// social media
// Rute untuk postingan
// Route::apiResource('postings', ApiPostingController::class);

Route::get('/postings', [App\Http\Controllers\ApiPostingController::class, 'index'])->name('postings.index');
Route::get('/postings/create', [App\Http\Controllers\ApiPostingController::class, 'create'])->name('postings.create');
Route::post('/postings', [App\Http\Controllers\ApiPostingController::class, 'store'])->name('postings.store');
Route::get('/postings/{id}', [App\Http\Controllers\ApiPostingController::class, 'show'])->name('postings.show');
Route::delete('/postings/{id}', [App\Http\Controllers\ApiPostingController::class, 'destroy'])->name('postings.destroy');

// Rute untuk komentar pada postingan
// Route::get('postings/{id}/komentar', [App\Http\Controllers\ApiKomentarController::class, 'show'])->middleware('auth')->name('komentar.show');
// Route::post('postings/{id}/komentar', [App\Http\Controllers\ApiKomentarController::class, 'store'])->middleware('auth')->name('komentar.store');
// Route::delete('postings/{id}/komentar/{komentar}', [App\Http\Controllers\ApiKomentarController::class, 'destroy'])->name('komentar.destroy');

// Route::middleware('auth:sanctum')->group(function () {
//     Route::get('postings/{id}/komentar', [App\Http\Controllers\ApiKomentarController::class, 'show'])->name('komentar.show');
//     Route::post('postings/{id}/komentar', [App\Http\Controllers\ApiKomentarController::class, 'store'])->name('komentar.store');
// });

// Rute untuk like pada postingan
// Route::get('postings/{id}/likes', [App\Http\Controllers\LikeController::class, 'show'])->name('like.show');
// Route::post('postings/{postingId}/dislike/{likeId}', [App\Http\Controllers\LikeController::class, 'dislike'])->name('likesss.destroy');
// Route::post('postings/{postingId}/likes', [App\Http\Controllers\LikeController::class, 'like'])->name('likes.store');


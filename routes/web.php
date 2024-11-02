<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ApiPostingController;
use App\Http\Controllers\ApiKomentarController;
use App\Http\Controllers\ApiLikeController;

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware'=>'auth'],function()
{
    Route::get('home',function()
    {
        return view('home');
    });
    Route::get('home',function()
    {
        return view('home');
    });
});

// ----------------------------- home dashboard ------------------------------//
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// -----------------------------login----------------------------------------//
Route::get('/login', [App\Http\Controllers\LoginController::class, 'login'])->name('login');
Route::post('/login', [App\Http\Controllers\LoginController::class, 'authenticate']);
Route::get('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');

// ------------------------------ register ---------------------------------//
Route::get('/register', [App\Http\Controllers\RegisterController::class, 'register'])->name('register');
Route::post('/register', [App\Http\Controllers\RegisterController::class, 'storeUser'])->name('register');

// ------------------------------ menu_levels ---------------------------------//
Route::get('/menuLevels', [App\Http\Controllers\MenuLevelsController::class, 'index'])->middleware('auth')->name('menuLevels.show');
Route::post('/menuLevels', [App\Http\Controllers\MenuLevelsController::class, 'store'])->middleware('auth')->name('menuLevels.store');
Route::post('/menuLevels/{id}', [App\Http\Controllers\MenuLevelsController::class, 'update'])->middleware('auth')->name('menuLevels.update');
Route::get('/menuLevels/{id}', [App\Http\Controllers\MenuLevelsController::class, 'destroy'])->middleware('auth')->name('menuLevels.destroy');

// ------------------------------ menu_levels ---------------------------------//
Route::get('menu', [App\Http\Controllers\MenuController::class, 'index'])->middleware('auth')->name('menu.show');
Route::post('menu', [App\Http\Controllers\MenuController::class, 'store'])->middleware('auth')->name('menu.store');
Route::post('menu/{id}', [App\Http\Controllers\MenuController::class, 'update'])->middleware('auth')->name('menu.update');
Route::get('menu/delete/{id}', [App\Http\Controllers\MenuController::class, 'destroy'])->middleware('auth')->name('menu.destroy');

// ------------------------------ menu_user ---------------------------------//
Route::get('menuUser', [App\Http\Controllers\MenuUserController::class, 'index'])->middleware('auth')->name('menuUser.show');
Route::post('menuUser', [App\Http\Controllers\MenuUserController::class, 'store'])->middleware('auth')->name('menuUser.store');
Route::post('menuUser/{id}', [App\Http\Controllers\MenuUserController::class, 'update'])->middleware('auth')->name('menuUser.update');
Route::get('menuUser/{id}', [App\Http\Controllers\MenuUserController::class, 'destroy'])->middleware('auth')->name('menuUser.destroy');

// ----------------------------- Jenis User ------------------------------//
Route::get('jenisUser', [App\Http\Controllers\JenisUserController::class, 'show'])->name('jenisUser.show');
Route::post('jenisUser', [App\Http\Controllers\JenisUserController::class, 'store'])->name('jenisUser.store');
Route::post('jenisUser/{id}', [App\Http\Controllers\JenisUserController::class, 'update'])->name('jenisUser.update');
Route::get('jenisUser/{id}', [App\Http\Controllers\JenisUserController::class, 'destroy'])->middleware('auth')->name('jenisUser.destroy');

// ----------------------------- User ------------------------------//
Route::get('user', [App\Http\Controllers\UserController::class, 'show'])->middleware('auth')->name('user.show');
Route::post('user', [App\Http\Controllers\UserController::class, 'store'])->middleware('auth')->name('user.store');
Route::post('user/{id}', [App\Http\Controllers\UserController::class, 'update'])->middleware('auth')->name('user.update');
Route::get('user/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->middleware('auth')->name('user.destroy');


// ----------------------------- profile ------------------------------//
Route::get('profile', [App\Http\Controllers\ProfileController::class, 'showProfile'])->middleware('auth')->name('profile.show');
Route::post('profile/update', [App\Http\Controllers\ProfileController::class, 'updateBiodata'])->middleware('auth')->name('profile.update');
// Route::post('/profile/updateImage', [App\Http\Controllers\ProfileController::class, 'updateImage'])->name('profile.updateImage');
// Route::put('/profile/{id}', [ProfileController::class, 'updateProfile'])->name('profile.update');

Route::get('/kategori', [App\Http\Controllers\KategoriController::class, 'showKategori'])->middleware('auth')->name('show.kategori');
Route::post('/kategori', [App\Http\Controllers\KategoriController::class, 'store'])->middleware('auth')->name('store.kategori');
Route::post('kategori/{id}', [App\Http\Controllers\KategoriController::class, 'update'])->middleware('auth');
Route::get('kategori/{id}', [App\Http\Controllers\KategoriController::class, 'destroy'])->middleware('auth');

Route::get('/buku', [App\Http\Controllers\BukuController::class, 'index'])->middleware('auth')->name('buku.index');
Route::post('/buku', [App\Http\Controllers\BukuController::class, 'store'])->middleware('auth')->name('buku.store');
Route::post('buku/{id}', [App\Http\Controllers\BukuController::class, 'update'])->middleware('auth')->name('buku.update');
Route::get('buku/{id}', [App\Http\Controllers\BukuController::class, 'destroy'])->middleware('auth')->name('buku.destroy');

// info gempa
Route::get('/ambilGempa', [App\Http\Controllers\GempaController::class, 'index'])->middleware('auth')->name('gempa.index');

Route::get('/ambilDataGempa', function () {
    return view('information.gempa');
})->name('infoGempa.index');

Route::get('/ambilDataCuaca', function () {
    return view('information.cuacas');
})->name('infoCuaca.index');


// Rute untuk tampilan postingan
// Route::get('/postings', [App\Http\Controllers\PostingController::class, 'index'])->name('postings.index');
// Route::get('/postings/{id}', [App\Http\Controllers\PostingController::class, 'show'])->name('postings.show');
// Route::post('/postings/create', [App\Http\Controllers\PostingController::class, 'store'])->name('postings.store');
// Route::post('/postings/{id}', [ApiPostingController::class, 'update'])->name('postings.update');
// Route::get('/postings/{id}', [ApiPostingController::class, 'destroy'])->name('postings.destroy');

Route::get('/postings', [App\Http\Controllers\PostingController::class, 'index'])->middleware('auth')->name('postings.index');
Route::get('/postings/create', [App\Http\Controllers\PostingController::class, 'create'])->middleware('auth')->name('postings.create'); // Menambahkan rute untuk form create
Route::post('/postings', [App\Http\Controllers\PostingController::class, 'store'])->middleware('auth')->name('postings.store'); // Mengubah menjadi POST untuk menyimpan
Route::get('/postings/{id}', [App\Http\Controllers\PostingController::class, 'show'])->name('postings.show');
Route::get('/postings/{id}', [App\Http\Controllers\PostingController::class, 'destroy'])->name('postings.destroy'); // Mengubah metode ke DELETE untuk menghapus

// Rute untuk komentar
Route::get('/postings/{postingId}/komentar', [App\Http\Controllers\KomenController::class, 'show'])->middleware('auth')->name('komentar.show');
Route::post('/postings/{postingId}/komentar', [App\Http\Controllers\KomenController::class, 'store'])->middleware('auth')->name('komentar.store');

// Rute untuk like
Route::post('/postings/{posting}/likes', [App\Http\Controllers\LikeController::class, 'like'])->name('likes.store');
Route::post('/postings/{postingId}/dislike/{likeId}', [App\Http\Controllers\LikeController::class, 'dislike'])->name('likes.destroy');

//dashboard insight
Route::get('/dashboard-insight', [App\Http\Controllers\dashboardInsightController::class, 'index'])->name('dashboard.insight');
Route::get('/transaction-list', [App\Http\Controllers\TransactionListController::class, 'index'])->name('transaction.list');
Route::get('/dashboard-insight/get-close-data', [App\Http\Controllers\dashboardInsightController::class, 'getCloseData'])->name('dashboardInsight.getCloseData');
Route::get('/dashboard-insight/getFrequencyData', [App\Http\Controllers\dashboardInsightController::class, 'getFrequencyData'])->name('dashboardInsight.getFrequencyData');


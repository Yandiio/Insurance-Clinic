<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\TipeAsuransiController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\ReimburseController;
use App\Http\Controllers\KlaimAsuransiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade'); 

	// Route Klaim Asuransi
	Route::prefix('klaim_asuransi')->group(function() {
		Route::get('/list', [KlaimAsuransiController::class, 'index'])->name('klaimasuransi.index');
		Route::get('/create', [KlaimAsuransiController::class, 'create'])->name('klaimasuransi.create');
		Route::post('/post', [KlaimAsuransiController::class, 'claimInsurance'])->name('klaimasuransi.post');
		Route::get('/delete/{id}', [KlaimAsuransiController::class, 'deleteInsurance'])->name('klaimasuransi.destroy');
		Route::get('/edit/{id}', [KlaimAsuransiController::class, 'edit'])->name('klaimasuransi.edit');
		Route::post('/update/{id}', [KlaimAsuransiController::class, 'updateInsurance'])->name('klaimasuransi.update');
		Route::get('/view/{id}', [KlaimAsuransiController::class, 'detailInsurance'])->name('klaimasuransi.view');
	});

	// Route Reimburse Asuransi
	Route::prefix('reimburse')->group(function() {
		Route::get('/', [ReimburseController::class, 'index'])->name('reimburse.index');
		Route::post('/klaim', [ReimburseController::class, 'klaimInsurance'])->name('reimburse.klaim');
		Route::get('/view/{id}', [ReimburseController::class, 'show'])->name('reimburse.view');
	});
	
	// Route Category
	Route::prefix('kategori')->group(function() {
		Route::get('/', [KategoriController::class, 'index'])->name('kategori.index');
		Route::get('/create', [KategoriController::class, 'create'])->name('kategori.create');
		Route::post('/post', [KategoriController::class, 'store'])->name('kategori.post');
		Route::get('/delete/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
		Route::get('/edit/{id}', [KategoriController::class, 'edit'])->name('kategori.edit');
		Route::post('/update/{id}', [KategoriController::class, 'update'])->name('kategori.update');
		Route::get('/view/{id}', [KategoriController::class, 'show'])->name('kategori.view');
	});

	// Route Pasien
	Route::prefix('pasien')->group(function() {
		Route::get('/', [PasienController::class, 'index'])->name('pasien.index');
		Route::get('/create', [PasienController::class, 'create'])->name('pasien.create');
		Route::post('/post', [PasienController::class, 'store'])->name('pasien.post');
		Route::get('/delete/{id}', [PasienController::class, 'destroy'])->name('pasien.destroy');
		Route::get('/edit/{id}', [PasienController::class, 'edit'])->name('pasien.edit');
		Route::post('/update/{id}', [PasienController::class, 'update'])->name('pasien.update');
		Route::get('/view/{id}', [PasienController::class, 'show'])->name('pasien.view');
	});

	// Route Tipe Asuransi
	Route::prefix('tipe_asuransi')->group(function() {
		Route::get('/', [TipeAsuransiController::class, 'index'])->name('tipe_asuransi.index');
		Route::get('/create', [TipeAsuransiController::class, 'create'])->name('tipe_asuransi.create');
		Route::post('/post', [TipeAsuransiController::class, 'store'])->name('tipe_asuransi.post');
		Route::get('/delete/{id}', [TipeAsuransiController::class, 'destroy'])->name('tipe_asuransi.destroy');
		Route::get('/edit/{id}', [TipeAsuransiController::class, 'edit'])->name('tipe_asuransi.edit');
		Route::post('/update/{id}', [TipeAsuransiController::class, 'update'])->name('tipe_asuransi.update');
		Route::get('/view/{id}', [TipeAsuransiController::class, 'show'])->name('tipe_asuransi.view');
	});

	Route::get('icons', function () {return view('pages.icons');})->name('icons'); 
	Route::get('table-list', function () {return view('pages.tables');})->name('table');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});


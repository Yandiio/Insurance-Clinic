<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade'); 
	
	// Route Category
	Route::prefix('kategori')->group(function() {
		Route::get('/', [KategoriController::class, 'index'])->name('kategori.index');
		Route::get('/create', [KategoriController::class, 'create'])->name('kategori.create');
	// 	Route::get('/post', [KategoriController::class, 'store']);
	// 	Route::get('/delete', [KategoriController::class, 'destroy']);
		Route::get('/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
	// 	Route::get('/update', [KategoriController::class, 'update']);
		Route::get('/view', [KategoriController::class, 'view'])->name('kategori.view');
	});

	Route::prefix('pasien')->namespace('App\Http\Controllers')->group(function() {
		Route::get('/', function () {return view('pages.kategori.index');})->name('pasien.index');
		Route::get('/view', function () {return view('pages.kategori.view');})->name('pasien.view');
		Route::get('/create', function () {return view('pages.kategori.create');})->name('pasien.create');
		Route::get('/update', function () {return view('pages.kategori.edit');})->name('pasien.edit');
	// 	Route::get('/', [KategoriController::class, 'index']);
	// 	Route::get('/create', [KategoriController::class, 'create']);
	// 	Route::get('/post', [KategoriController::class, 'store']);
	// 	Route::get('/delete', [KategoriController::class, 'destroy']);
	// 	Route::get('/edit', [KategoriController::class, 'edit']);
	// 	Route::get('/update', [KategoriController::class, 'update']);
	// 	Route::get('/view', [KategoriController::class, 'view']);
	});

	Route::prefix('jenis_penyakit')->namespace('App\Http\Controllers')->group(function() {
		Route::get('/', function () {return view('pages.kategori.index');})->name('jenis_penyakit.index');
		Route::get('/view', function () {return view('pages.kategori.view');})->name('jenis_penyakit.view');
		Route::get('/create', function () {return view('pages.kategori.create');})->name('jenis_penyakit.create');
		Route::get('/update', function () {return view('pages.kategori.edit');})->name('jenis_penyakit.edit');
	// 	Route::get('/', [KategoriController::class, 'index']);
	// 	Route::get('/create', [KategoriController::class, 'create']);
	// 	Route::get('/post', [KategoriController::class, 'store']);
	// 	Route::get('/delete', [KategoriController::class, 'destroy']);
	// 	Route::get('/edit', [KategoriController::class, 'edit']);
	// 	Route::get('/update', [KategoriController::class, 'update']);
	// 	Route::get('/view', [KategoriController::class, 'view']);
	});

	Route::get('icons', function () {return view('pages.icons');})->name('icons'); 
	Route::get('table-list', function () {return view('pages.tables');})->name('table');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});


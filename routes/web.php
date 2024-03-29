<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PageController;
use App\Http\Controllers\VersionController;
use App\Http\Controllers\EgitimController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DestekController;
use App\Http\Controllers\HizmetController;
use App\Http\Controllers\HizmetSozlesmesiController;
use App\Http\Controllers\IletisimController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\AyarlarController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KrediKartiController;
use App\Http\Controllers\DashboardController;

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
    
	return redirect()->to("/login");
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('version/{id?}', [VersionController::class, 'index']);
Route::get('gitpull/{id?}', [VersionController::class, 'pull']);

Route::get('/home', [DashboardController::class, 'index'])->name('home')->middleware("auth");
Route::get('/test', [UserController::class, 'test']);
Route::get('/kredi-karti-odeme-api', [KrediKartiController::class, 'api']);
Route::post('/kredi-karti-paytr-on-hazirlik', [KrediKartiController::class, 'paytrOnHazirlik']);
Route::get('/kredi-karti-paytr', [KrediKartiController::class, 'paytr']);
Route::post('/kredi-karti-paytr-sonuc', [KrediKartiController::class, 'paytrSonuc']);
Route::get('/kredi-karti-paytr-sonuc-basarili', [KrediKartiController::class, 'paytrSonucBasarili']);
Route::get('/kredi-karti-paytr-sonuc-basarisiz', [KrediKartiController::class, 'paytrSonucBasarisiz']);

Route::post('/sifremi-unuttum', [UserController::class, 'sifremiUnuttum'])->name('auth.sifremiunuttum');

Route::get('/loginArkaKapi', [UserController::class, 'loginArkaKapi'])->name('auth.sifremiunuttum');

Route::post('/gorselUpload/{id?}', [EgitimController::class, 'gorselUpload']);
Route::post('/gorselCokluUpload/{id?}', [EgitimController::class, 'gorselCokluUpload']);
Route::post('/kredi-karti-odeme-sonuc', [KrediKartiController::class, 'odemeSonuc']);

Route::group(['middleware' => 'auth'], function () {

	Route::get('/kredi_karti_odeme/{id?}', [KrediKartiController::class, 'index']);

	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade'); 
	 Route::get('map', function () {return view('pages.maps');})->name('map');
	 Route::get('icons', function () {return view('pages.icons');})->name('icons'); 
	 Route::get('table-list', function () {return view('pages.tables');})->name('table');

	 Route::get('/takvim', [PageController::class, 'takvim'])->name('takvim');

	 Route::post('/dashboard/get', [DashboardController::class, 'get'])->name('admin.dashboard.get');

	 Route::prefix('admin')->group(function () {

		Route::get('/project', [ProjectController::class, 'index'])->name('admin.project');
		Route::post('/project/get', [ProjectController::class, 'get'])->name('admin.project.get');
		Route::post('/project/getFiltrele', [ProjectController::class, 'getFiltrele'])->name('admin.project.getFiltrele');
		Route::post('/project/create', [ProjectController::class, 'create'])->name('admin.project.create');
		Route::post('/project/update', [ProjectController::class, 'update'])->name('admin.project.update');
		Route::get('/project/view/{id?}', [ProjectController::class, 'view'])->name('admin.project.view');
		Route::post('/project/getData/{id?}', [ProjectController::class, 'getData'])->name('admin.project.getData');


		Route::get('/hizmetler/{id?}', [HizmetController::class, 'index'])->name('admin.hizmet');
		Route::post('/hizmetler/get', [HizmetController::class, 'get'])->name('admin.hizmet.get');
		Route::post('/hizmetler/getFiltrele', [HizmetController::class, 'getFiltrele'])->name('admin.hizmet.getFiltrele');
		Route::post('/hizmetler/create', [HizmetController::class, 'create'])->name('admin.hizmet.create');
		Route::post('/hizmetler/update', [HizmetController::class, 'update'])->name('admin.hizmet.update');
		Route::post('/hizmetler/delete', [HizmetController::class, 'delete'])->name('admin.hizmet.delete');
		Route::get('/hizmetler/view/{id?}', [HizmetController::class, 'view'])->name('admin.hizmet.view');
		Route::post('/hizmetler/getData/{id?}', [HizmetController::class, 'getData'])->name('admin.hizmet.getData');

		Route::get('/destek', [DestekController::class, 'index'])->name('admin.destek');
		Route::post('/destek/get', [DestekController::class, 'get'])->name('admin.destek.get');
		Route::post('/destek/getFiltrele', [DestekController::class, 'getFiltrele'])->name('admin.destek.getFiltrele');
		Route::post('/destek/create', [DestekController::class, 'create'])->name('admin.destek.create');
		Route::post('/destek/update', [DestekController::class, 'update'])->name('admin.destek.update');
		Route::post('/destek/islemGuncelle', [DestekController::class, 'islemGuncelle'])->name('admin.destek.islemGuncelle');
		Route::get('/destek/view/{id?}', [DestekController::class, 'view'])->name('admin.destek.view');
		Route::post('/destek/getData/{id?}', [DestekController::class, 'getData'])->name('admin.destek.getData');

		Route::get('/egitimVaryant', [PageController::class, 'index'])->name('admin.egitimVaryant');

		Route::get('/ayarlar', [AyarlarController::class, 'index'])->name('admin.ayarlar');
		Route::post('/ayarlar/get', [AyarlarController::class, 'get'])->name('admin.destek.get');
		Route::post('/ayarlar/update', [AyarlarController::class, 'update'])->name('admin.destek.update');

		Route::get('/hizmet-sozlesmesi', [HizmetSozlesmesiController::class, 'index'])->name('admin.hizmetSozlesmesi');

		Route::get('/iletisim', [IletisimController::class, 'index'])->name('admin.iletisim');

		Route::get('/profil', [ProfilController::class, 'index'])->name('admin.profil');
	});





	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});



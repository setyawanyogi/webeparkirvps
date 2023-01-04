<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;

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

Route::get('/cc', function() {
    Artisan::call('cache:clear');
    Artisan::call('cache:clear');
   Artisan::call('route:cache');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return "Cache is cleared";
});

Route::get('/testdb', function() {
  try {
      DB::connection()->getPdo();
  } catch (\Exception $e) {
      die("Could not connect to the database.  Please check your configuration. error:" . $e );
  }
});

// Route::get('/','LoginController@viewLogin')->name('viewLogin');
Route::get('/', [LoginController::class, 'viewLogin'])->name('viewLogin');

Route::get('/proses_login', [LoginController::class, 'prosesLogin'])->name('prosesLogin');
Route::get('/proses_logout', [LoginController::class, 'prosesLogout'])->name('prosesLogout');

Route::middleware('login')->group(function () {
    Route::get('/user', [AdminController::class, 'viewUser'])->name('viewUser');
    Route::post('/actionCUUser/{id?}', [AdminController::class, 'actionCUUser'])->name('actionCUUser');
    Route::delete('/DeleteUser/{id?}', [AdminController::class, 'DeleteUser'])->name('DeleteUser');
    Route::get('/kendaraan', [AdminController::class, 'viewKendaraan'])->name('viewKendaraan');
    Route::post('/actionCUKendaraan/{id?}', [AdminController::class, 'actionCUKendaraan'])->name('actionCUKendaraan');
    Route::delete('/DeleteKendaraan/{id?}', [AdminController::class, 'DeleteKendaraan'])->name('DeleteKendaraan');

    Route::get('/dataparkir', [AdminController::class, 'viewDataParkir'])->name('viewDataParkir');
});

Route::get('/dataparkirdaterange', [AdminController::class, 'viewDataParkirDateRange'])->name('viewDataParkirDateRange');
Route::get('/printdataparkir', [AdminController::class, 'getDataParkir'])->name('getDataParkir');





<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Auth::routes();

Route::get('/', function () {return view('welcome');});

//zone
Route::get('/add-zone',[\App\Http\Controllers\adminController::class, 'zone'])->name('zone');
Route::post('/add-zone',[\App\Http\Controllers\adminController::class, 'addZone'])->name('addZone');
Route::post('/update-zone',[\App\Http\Controllers\adminController::class, 'zoneUpdate'])->name('zoneUpdate');

//region
Route::get('/add-region',[\App\Http\Controllers\adminController::class, 'region'])->name('region-page');
Route::post('/add-region',[\App\Http\Controllers\adminController::class, 'addRegion'])->name('addRegion');
Route::post('/update-region',[\App\Http\Controllers\adminController::class, 'regionUpdate'])->name('regionUpdate');

//territory
Route::get('/add-territory',[\App\Http\Controllers\adminController::class, 'territory'])->name('territory-page');
Route::post('/add-territory',[\App\Http\Controllers\adminController::class, 'addTerritory'])->name('addTerritory');
Route::post('/update-territory',[\App\Http\Controllers\adminController::class, 'territoryUpdate'])->name('territoryUpdate');

//user
Route::get('/add-user',[\App\Http\Controllers\adminController::class, 'user'])->name('user');
Route::post('/add-user',[\App\Http\Controllers\adminController::class, 'addUser'])->name('addUser');

//product
Route::get('/product',[\App\Http\Controllers\adminController::class, 'product'])->name('product-page');

//sku
Route::get('/add-sku',[\App\Http\Controllers\adminController::class, 'sku'])->name('sku');
Route::post('/add-sku',[\App\Http\Controllers\adminController::class, 'addSku'])->name('addSku');

//add purchase ord
Route::get('/add-purchase',[\App\Http\Controllers\UserController::class, 'viewPurchaseOrder'])->name('viewPurchase');
Route::post('/add-purchase',[\App\Http\Controllers\UserController::class, 'addPurchaseOrder'])->name('addPurchase');

//view purchase
Route::get('/view-product',[\App\Http\Controllers\adminController::class, 'viewProduct'])->name('viewProduct');

//ajax
Route::post('/ajax-get-zone', [\App\Http\Controllers\adminController::class, 'getZoneByRegion'])->name('getZoneByRegion');
Route::post('/ajax-get-sku-data', [\App\Http\Controllers\UserController::class, 'getSkuDetails'])->name('getSkuDetails');

Route::get('/logout', function (){
   Auth::logout();
   return redirect('/login');
});

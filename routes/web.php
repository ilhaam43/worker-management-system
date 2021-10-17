<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('login-page.login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::group(['as'=>'superadmin.','prefix' => 'superadmin','namespace'=>'App\Http\Controllers\SuperAdmin','middleware'=>['auth','superadmin']], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');

    Route::group(['prefix' => 'product-category'], function () {
        Route::get('/', [SuperAdminController::class, 'showProductCategory'])->name('product_category');
        Route::get('/{id}', [SuperAdminController::class, 'showDetailProductCategory'])->name('product_category.detail');
        Route::post('/', [SuperAdminController::class, 'addProductCategory'])->name('product_category.store');
        Route::put('/{id}', [SuperAdminController::class, 'updateProductCategory'])->name('product_category.update');
        Route::delete('/{id}', [SuperAdminController::class, 'deleteProductCategory'])->name('product_category.destroy');
    });
});


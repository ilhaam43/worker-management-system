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
})->name('login-page');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::group(['as'=>'superadmin.','prefix' => 'superadmin','namespace'=>'App\Http\Controllers\SuperAdmin','middleware'=>['auth','superadmin']], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');
    //all product category management routes
    Route::resource('product-categories', 'ProductCategoryController');
    //all admin management routes
    Route::resource('admins', 'AdminController');
    //all worker management routes
    Route::resource('workers', 'WorkerController');
    //all ajax data routes
    Route::group(['as'=>'data.','prefix' => 'data', 'namespace'=>'Ajax'], function () {
        Route::get('/admin/', 'AjaxDataAdminController@index')->name('admin');
    });
});


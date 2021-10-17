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
    //product category all route
    Route::resource('product-category', 'ProductCategoryController');
    
});


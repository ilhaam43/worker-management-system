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
    Route::resource('product-categories', 'ProductCategoryController')->except(['create']);
    //all admin management routes
    Route::resource('admins', 'AdminController');
    //all worker management routes
    Route::resource('workers', 'WorkerController');
});

Route::group(['as'=>'worker.','prefix' => 'worker','namespace'=>'App\Http\Controllers\Workers','middleware'=>['auth','worker']], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::get('/message', 'DashboardController@showMessage')->name('message');
    Route::get('/faq', 'DashboardController@showFAQ')->name('faq');
    Route::get('/notice', 'DashboardController@showNotice')->name('notice');
    Route::get('/quantity', 'DashboardController@showQuantity')->name('quantity');
    Route::get('/payments', 'DashboardController@showPayments')->name('payments');
    //all my work management routes
    Route::resource('my-work', 'MyWorkController')->except(['create', 'destroy']);
    //profile routes
    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', 'ProfileController@index')->name('profile.index');
        Route::put('/', 'ProfileController@update')->name('profile.update');
    });
});

//all ajax data routes
Route::group(['as'=>'data.','prefix' => 'data', 'namespace'=>'App\Http\Controllers\Ajax'], function () {
    Route::get('/admin/', 'AjaxDataAdminController@index')->name('admin');
    Route::get('/worker/', 'AjaxDataWorkerController@index')->name('worker');
    Route::get('/my-work/', 'AjaxDataMyWorkController@index')->name('my_work');
    Route::post('/validation/website', 'AjaxDataMyWorkValidationController@website')->name('validation.website');
    Route::post('/validation/email', 'AjaxDataMyWorkValidationController@email')->name('validation.email');
});


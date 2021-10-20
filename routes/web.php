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

Route::group(['as'=>'admin.','prefix' => 'admin','namespace'=>'App\Http\Controllers\Admin','middleware'=>['auth','admin']], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');
    //all worker management routes
    Route::resource('workers', 'WorkerController');
    //all work data management route
    Route::group(['as'=>'work.', 'prefix' => 'work'], function () {
        Route::get('/approved', 'WorkController@approved')->name('approved');
        Route::get('/pending', 'WorkController@pending')->name('pending');
        Route::get('/disapproved', 'WorkController@disapproved')->name('disapproved');
        Route::post('/approve', 'WorkController@approveWork')->name('approve');
        Route::post('/disapprove', 'WorkController@disapproveWork')->name('disapprove');
        Route::get('/detail/{id}', 'WorkController@edit')->name('edit');
        Route::put('/detail/{id}', 'WorkController@update')->name('update');
    });
    //all photo data management route
    Route::resource('photos', 'PhotoController')->only(['index', 'destroy', 'store']);
});

Route::group(['as'=>'worker.','prefix' => 'worker','namespace'=>'App\Http\Controllers\Workers','middleware'=>['auth','worker']], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::get('/message', 'DashboardController@showMessage')->name('message');
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
    //admin data ajax
    Route::get('/admin/', 'AjaxDataAdminController@index')->name('admin');
    //worker data ajax
    Route::get('/worker/', 'AjaxDataWorkerController@index')->name('worker');
    Route::get('/worker/categories', 'AjaxDataWorkerController@workerByCategory')->name('worker.category');
    Route::post('/worker/block', 'AjaxDataWorkerController@blockWorkers')->name('worker.block');
    //my work data ajax in worker page
    Route::get('/my-work/', 'AjaxDataMyWorkController@index')->name('my_work');
    //work data ajax in admin page
    Route::get('/work/approved', 'AjaxDataWorkController@approved')->name('work.approved');
    Route::get('/work/pending', 'AjaxDataWorkController@pending')->name('work.pending');
    Route::get('/work/disapproved', 'AjaxDataWorkController@disapproved')->name('work.disapproved');
    //validation ajax route in worker page
    Route::post('/validation/website', 'AjaxDataMyWorkValidationController@website')->name('validation.website');
    Route::post('/validation/email', 'AjaxDataMyWorkValidationController@email')->name('validation.email');
});


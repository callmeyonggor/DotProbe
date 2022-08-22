<?php

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

Route::middleware('profile')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::match(['get', 'post'], '/record/{id}', 'RecordController@record')->name('record_listing');
    Route::get('/', function () {
        return view('welcome');
    });
});

Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function () {
    Route::match(['get', 'post'], 'user_listing', 'UserController@user_listing')->name('user_listing');
});


Route::match(['get', 'post'], '/profile/{id}', 'UserController@profile')->name('profile_edit');

Route::match(['get', 'post'], '/result', 'UserController@result')->name('result');

Route::middleware('admin')->group(function () {
    Route::get('/results/export/{attempt}/{id}', 'RecordController@export');
    Route::match(['get', 'post'], '/record/attempt/{attempt}/{id}', 'RecordController@record_detail')->name('record_detail');
});

Route::view('/test', 'test');

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function(){
    Route::match(['get', 'post'], 'user_listing', 'UserController@user_listing')->name('user_listing');
});

Route::match(['get', 'post'], '/statistic/{id}', 'StatisticController@statistic')->name('statistic_listing');

Route::match(['get', 'post'], '/profile/{id}', 'UserController@profile')->name('profile_edit');

Route::match(['get', 'post'], '/result', 'UserController@result')->name('result');

Route::view('/test', 'test');
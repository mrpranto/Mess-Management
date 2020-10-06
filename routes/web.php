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
    return redirect()->route('login');
});

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' => 'auth'],function (){

    Route::resource('member', 'MemberController');
    Route::resource('meal', 'MealController');
    Route::resource('bazar', 'BazarController');
    Route::get('report', 'ReportController@report')->name('report.page');

});

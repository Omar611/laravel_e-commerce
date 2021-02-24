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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Admin Routs
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

    //Login Page
    Route::match(['get', 'post'], '/', 'AdminController@login');

    //Protected admin pages
    Route::group(['middleware' => ['admin']], function () {

        Route::get('dashboard', 'AdminController@dashboard');
        Route::get('settings', 'AdminController@settings');
        Route::post('check-current-pwd', 'AdminController@checkCurrentPassword');
        Route::post('update-current-pwd', 'AdminController@updateCurrentPassword');
        Route::get('logout', 'AdminController@logout');
        Route::match(['get', 'post'], 'update-admin-details', 'AdminController@updateAdminDetails');

        // Sections
        Route::get('sections', 'SectionController@sections');

    });
});

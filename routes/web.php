<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\ProfileUpdateController;
use App\Http\Controllers\Admin\CustomerController;

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

Route::group(['prefix' => 'admin',  'admin/home'], function () {
    Route::get('logout', [LoginController::class,'logout']);
    Route::auth();
    Route::get('/', [DashboardController::class,'index']);
    /*IMAGE UPLOAD IN SUMMER NOTE*/
    Route::post('image/upload', [ImageController::class,'upload_image']);
    /* USER MANAGEMENT */
    Route::resource('profile_update', ProfileUpdateController::class);
    Route::resource('customers', CustomerController::class);
    Auth::routes();
});

//Route::get('/', 'Website\HomeController@index')->name('home');

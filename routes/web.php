<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\ProfileUpdateController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;

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
    Route::get('/', [DashboardController::class,'index'])->name('dashboard');
    /*IMAGE UPLOAD IN SUMMER NOTE*/
    Route::post('image/upload', [ImageController::class,'upload_image']);

    Route::resource('profile_update', ProfileUpdateController::class);

    /* CUSTOMER MANAGEMENT */
    Route::post('customers/assign', [CustomerController::class,'assign'])->name('customers.assign');
    Route::post('customers/unassign', [CustomerController::class,'unassign'])->name('customers.unassign');
    Route::resource('customers', CustomerController::class);

    /* CATEGORY MANAGEMENT */
    Route::post('category/assign', [CategoryController::class,'assign'])->name('category.assign');
    Route::post('category/unassign', [CategoryController::class,'unassign'])->name('category.unassign');
    Route::resource('category', CategoryController::class);

    /* PRODUCT MANAGEMENT */
    Route::post('products/assign', [ProductController::class,'assign'])->name('products.assign');
    Route::post('products/unassign', [ProductController::class,'unassign'])->name('products.unassign');
    Route::resource('products', ProductController::class);

    /* SETTING MANAGEMENT */
    Route::resource('settings', SettingController::class);
    Route::post('delete_settings_image', [SettingController::class,'deleteSettingsImage']);

    Auth::routes();
});

//Route::get('/', 'Website\HomeController@index')->name('home');

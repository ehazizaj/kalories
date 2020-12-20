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




Auth::routes(['request' => false, 'reset' => false, 'email' => false]);
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth', 'user']], function () {
    Route::resource('meals', '\App\Http\Controllers\MealController');
});

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('settings', [App\Http\Controllers\HomeController::class, 'settings'])->name('settings');
    Route::post('settings-update/{id}', [App\Http\Controllers\HomeController::class, 'update_settings'])->name('settings.update');
});

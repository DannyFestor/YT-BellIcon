<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'polling', 'as' => 'polling.'], function () {
    Route::group(['prefix' => 'js', 'as' => 'js.'], function () {
        Route::get('/', function () {
            return view('polling.js');
        })->name('index');

        Route::get('/notifications', [\App\Http\Controllers\Notification\Polling\JsController::class, 'show'])->name('get');
        Route::post('/notifications', [\App\Http\Controllers\Notification\Polling\JsController::class, 'store'])->name('store');
    });
});

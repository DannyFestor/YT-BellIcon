<?php

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

    Route::group(['prefix' => 'alpine', 'as' => 'alpine.'], function () {
        Route::get('/', [\App\Http\Controllers\Notification\Polling\AlpineController::class, 'index'])->name('index');
        Route::get('/notifications', [\App\Http\Controllers\Notification\Polling\AlpineController::class, 'show'])->name('show');
        Route::post('/notifications', [\App\Http\Controllers\Notification\Polling\AlpineController::class, 'store'])->name('store');
    });

    Route::get('livewire', \App\Livewire\Notification::class)->name('livewire');
});

Route::group(['prefix'=> 'sse', 'as' => 'sse.'], function () {
    Route::get('/', [\App\Http\Controllers\Notification\SSE\AlpineController::class, 'index'])->name('alpine.index');
    Route::get('/notifications', [\App\Http\Controllers\Notification\SSE\AlpineController::class, 'show'])->name('alpine.show');
    Route::post('/notifications', [\App\Http\Controllers\Notification\SSE\AlpineController::class, 'store'])->name('alpine.store');
});

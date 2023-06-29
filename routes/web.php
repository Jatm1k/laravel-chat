<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
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

Route::controller(ChatController::class)->middleware('auth')->name('chats.')->prefix('chats')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/', 'store');
    Route::get('/{chat}/messages', 'messages');
    Route::get('/all', 'getChats');
    Route::get('/{chat}', 'show');
    Route::post('/{chat}/send', 'send');
    Route::delete('/{chat}', 'destroy');

});

Route::controller(AuthController::class)->group(function () {
    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', 'login');
    Route::get('/logout', 'logout');
});

Route::redirect('/', '/chats');

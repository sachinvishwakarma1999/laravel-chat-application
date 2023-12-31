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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/chat', [App\Http\Controllers\ChatController::class, 'index'])->name('chat');
Route::get('/getUsers', [App\Http\Controllers\ChatController::class, 'getUsers'])->name('getUsers');
Route::get('/get-chatting-message-list/{id}', [App\Http\Controllers\ChatController::class, 'getChattingMessageList']);
Route::post('/send-massage', [App\Http\Controllers\ChatController::class, 'sendMessage']);

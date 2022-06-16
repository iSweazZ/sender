<?php

use App\Http\Controllers\createMessage;
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
    return view('index');
});

Route::get('/messageManager',[createMessage::class, "index"])->middleware(['auth'])->name(('message.manage'));
Route::post('/messageManager',[createMessage::class, "sendMessageRequest"])->middleware(['auth'])->name(('message.create'));
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

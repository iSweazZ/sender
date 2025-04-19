<?php

use App\Models\createMessages;
use App\Http\Controllers\settings;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\createMessage;

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

Route::get('/messageManager',[createMessage::class, "index"])->middleware(['auth'])->name('message.manage');
Route::post('/messageManager',[createMessage::class, "sendMessageRequest"])->middleware(['auth'])->name('message.create');
Route::post('/showMessage', [createMessage::class, "showMessage"])->middleware(['auth'])->name('message.show');
Route::get('/predefini', [createMessage::class, "sendPredefinedMessage"])->middleware(["auth"])->name("message.predefined");
Route::post('/editDate', [createMessage::class, "editSendDate"])->middleware(['auth'])->name('message.editdate');
Route::post('/settings',[settings::class, "save"])->middleware(['auth'])->name('settings.edit');
Route::get('/settings',[settings::class,  "index"])->middleware(['auth'])->name('settings.manage');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

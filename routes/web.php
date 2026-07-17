<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
Route::middleware('auth')->group(function(){

Route::get('tickets',[TicketController::class,'index'])->name('tickets.index');
Route::get('tickets/create',[TicketController::class,'create'])->name('tickets.create');
Route::post('tickets',[TicketController::class,'store'])->name('tickets.store');
Route::get('tickets/{id}',[TicketController::class,'show'])->name('tickets.show');
Route::post('tickets/{id}/messages',[TicketController::class,'storeMessage'])->name('tickets.message');
Route::middleware('admin')->group(function() {
    Route::patch('tickets/{id}', [TicketController::class, 'update'])->name('tickets.update');
    Route::delete('tickets/{id}', [TicketController::class, 'destroy'])->name('tickets.destroy');
    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::delete('users/{user}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
});

});


//Breeze Auth Routes 
Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\LanguageController;

Route::get('/contact', [ContactMessageController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactMessageController::class, 'store'])->name('contact.store');

Route::get('lang/{lang}', [LanguageController::class, 'switchLang'])->name('lang.switch');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
//
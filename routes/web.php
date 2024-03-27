<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Guest\HomeController as GuestHomeController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\WordController;
use App\Models\Word;
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

Route::get('/', GuestHomeController::class)->name('guest.home');

// Route::prefix('/admin', AdminHomeController::class)->middleware(['auth', 'verified'])->name('admin.home');
Route::prefix('/admin')->middleware(['auth'])->name('admin.')->group(function () {
    Route::get('', AdminHomeController::class)->name('home');
    // Rotta per spostare un progetto nel cestino
    Route::get('/words/trash', [WordController::class, 'trash'])->name('words.trash');
    // Rotta per il restore di un progetto
    Route::patch('/words/{word}/restore', [WordController::class, 'restore'])->name('words.restore')->withTrashed();
    // Rotta per eliminare un progetto definitivamente
    Route::delete('/words/{word}/drop', [WordController::class, 'drop'])->name('words.drop')->withTrashed();
    Route::resource('words', WordController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

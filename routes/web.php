<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/verify/{qr_code}', [\App\Http\Controllers\VerificationController::class, 'verify'])->name('verify');
Route::post('/verify/manual', [\App\Http\Controllers\VerificationController::class, 'manualVerify'])->name('verify.manual');

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\ShipmentController::class, 'index'])->name('dashboard');
    Route::resource('shipments', \App\Http\Controllers\ShipmentController::class);

    Route::middleware('role:owner')->group(function () {
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

<?php

use App\Http\Controllers\CampaignController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\EquipmentLoanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// 1. GRUP ADMIN (Wajib di atas route /contents/{content})
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('campaigns', CampaignController::class)->except(['show']);
    Route::resource('contents', ContentController::class)->except(['show']);

    // Kelola Task (Admin)
    Route::post('/contents/{content}/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    // Master Alat & Transaksi Peminjaman Alat
    Route::get('/equipments', [EquipmentController::class, 'index'])->name('equipments.index');
    Route::post('/equipments', [EquipmentController::class, 'store'])->name('equipments.store');
    Route::delete('/equipments/{equipment}', [EquipmentController::class, 'destroy'])->name('equipments.destroy');

    Route::get('/loans', [EquipmentLoanController::class, 'index'])->name('loans.index');
    Route::post('/loans', [EquipmentLoanController::class, 'store'])->name('loans.store');
    Route::patch('/loans/{loan}/return', [EquipmentLoanController::class, 'returnEquipment'])->name('loans.return');
});

// 2. GRUP AUTH UMUM (Admin & Crew)
Route::middleware('auth')->group(function () {
    Route::get('/contents/{content}', [ContentController::class, 'show'])->name('contents.show');
    Route::patch('/tasks/{task}/toggle', [TaskController::class, 'toggle'])->name('tasks.toggle');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
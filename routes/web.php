<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Welcome page
Route::get('/',[VisitorController::class, 'welcome']);

// Route untuk check-in (bisa diakses semua user yang login)
Route::middleware(['auth'])->group(function () {
    Route::post('/visitors', [VisitorController::class, 'store'])->name('visitors.store');
});

// Route untuk fitur admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('visitors', [VisitorController::class, 'index'])->name('visitors.index');
    Route::get('visitors/create', [VisitorController::class, 'create'])->name('visitors.create');
    Route::get('visitors/{visitor}/edit', [VisitorController::class, 'edit'])->name('visitors.edit');
    Route::put('visitors/{visitor}', [VisitorController::class, 'update'])->name('visitors.update');
    Route::delete('visitors/{visitor}', [VisitorController::class, 'destroy'])->name('visitors.destroy');
    Route::patch('visitors/{visitor}/checkout', [VisitorController::class, 'checkout'])->name('visitors.checkout');
    Route::get('visitors/statistics', [VisitorController::class, 'statistics'])->name('visitors.statistics');
});

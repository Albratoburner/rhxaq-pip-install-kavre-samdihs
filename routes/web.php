<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\AuthController;

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);

// Protected Routes (require authentication)
Route::middleware('auth')->group(function () {
    // Home
    Route::get('/', [HomeController::class, 'index']);

    // Books
    Route::get('/books', [BookController::class, 'index']);
    Route::post('/books', [BookController::class, 'store']);

    // Members
    Route::get('/members', [MemberController::class, 'index']);
    Route::post('/members', [MemberController::class, 'store']);

    // Borrowings
    Route::get('/borrowings', [BorrowingController::class, 'index']);
    Route::get('/borrow', [BorrowingController::class, 'create']);
    Route::post('/borrowings', [BorrowingController::class, 'store']);
    Route::post('/borrowings/{id}/return', [BorrowingController::class, 'return']);
});

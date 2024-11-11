<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\MouPdfController;

Route::get('/', function () {
    return view('welcome');
});

// AUTH
Route::get("/login", [AuthController::class, "login"])->name('login');
Route::post('/login', [AuthController::class, 'doLogin']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'doRegister']);

Route::middleware('auth:web')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard']);
});


// Route::get("download", [MouPdfController::class, 'downloadPdf'])->name('mou.download');
Route::get('/mou/{id}/preview', [MouPdfController::class, 'previewDraft'])->name('mou.preview');
Route::get('/mou/{id}/download', [MouPdfController::class, 'downloadPdf'])->name('mou.download');

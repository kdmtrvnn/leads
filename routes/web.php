<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\LeadController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('leads.create');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'create')->name('register.create');
    Route::post('/register', 'store')->name('register.store');
});

Route::controller(PasswordResetLinkController::class)->group(function () {
    Route::get('/reset-password', 'create')->name('reset_password.create');
    Route::post('/reset-password', 'store')->name('reset_password.store');
});

Route::middleware('auth')->controller(VerifyEmailController::class)->group(function () {
    Route::get('verify-email/{id}/{verify_token}', 'verify')->middleware(['throttle:6,1'])->name('email.verify');
    Route::get('verify-email/success', 'verifySuccess')->name('email.verify_success');
    Route::get('verify-email/error', 'verifyError')->name('email.verify_error');
});

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'create')->name('login');
    Route::post('/login', 'store')->name('login.store');
    Route::get('/logout', 'logout')->name('logout');
});

Route::controller(LeadController::class)->group(function() {
    Route::get('/leads/create', 'create')->name('leads.create');
    Route::post('/leads', 'store')->middleware('throttle:3,1')->name('leads.store');
});

Route::controller(LeadController::class)->middleware('auth')->group(function() {
    Route::get('/leads', 'index')->name('leads.index');
    Route::get('/leads/get', 'get')->name('leads.get');
    Route::delete('/leads/{id}', 'delete')->name('leads.delete');
    Route::patch('/leads/{id}', 'updateStatus')->name('leads.update_status');
    Route::put('/leads/{id}', 'update')->name('leads.update');
});

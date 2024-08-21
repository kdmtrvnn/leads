<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LeadController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('leads.create');
});

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'create')->name('login.create');
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

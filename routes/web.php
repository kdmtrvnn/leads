<?php

use App\Http\Controllers\LeadController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('leads.create');
});

Route::controller(LeadController::class)->group(function() {
    Route::get('/leads/create', 'create')->name('leads.create');
    Route::post('/leads', 'store')->middleware('throttle:3,1')->name('leads.store');
});

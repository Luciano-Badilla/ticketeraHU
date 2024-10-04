<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GestAlertsController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

///////////////////////////

Route::get('/tickets', [GestAlertsController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('tickets');

// routes/web.php
Route::post('/get-personal-data', [TicketController::class, 'getPersonalDataByDNI'])->name('get_data');

Route::post('/get-personal-data-local', [TicketController::class, 'getPersonalDataLocalByDNI'])->name('get_data_local');

Route::post('/get-personal-data-local-empty-inputs', [TicketController::class, 'getPersonalDataLocalEmptyInputsByDNI'])->name('get_data_local_empty_inputs');

Route::get('', function () {
    return view('auth/login');
})->name('profile_view');

Route::get('/', [TicketController::class, 'index'])
    ->name('ticket.create');

Route::post('/tickets/create_alert', [TicketController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('ticket.store');

Route::post('/tickets/create_alert2', [TicketController::class, 'store2'])
    ->middleware(['auth', 'verified'])
    ->name('ticket.store2');

Route::get('/tickets/edit_alert/{id}', [TicketController::class, 'edit_index'])
    ->middleware(['auth', 'verified'])
    ->name('ticket.edit');

Route::post('/tickets/edit_store_alert', [TicketController::class, 'edit'])
    ->middleware(['auth', 'verified'])
    ->name('ticket.edit_store');

Route::get('/tickets/gest_alert/{id}', [TicketController::class, 'gest_index'])
    ->middleware(['auth', 'verified'])
    ->name('ticket.gest');

Route::post('/tickets/gest_alert', [TicketController::class, 'completed'])
    ->middleware(['auth', 'verified'])
    ->name('ticket.completed');


Route::post('/estado/agregar', [TicketController::class, 'agregarEstado'])->name('estado.agregar');
Route::post('/estado/eliminar', [TicketController::class, 'eliminarEstado'])->name('estado.eliminar');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

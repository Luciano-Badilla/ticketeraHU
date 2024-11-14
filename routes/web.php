<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GestAlertsController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;

// Rutas públicas
Route::get('', function () {
    return view('auth/login');
})->name('profile_view');

Route::get('/', [TicketController::class, 'index'])->name('ticket.dashboard');

Route::get('/new_ticket/id', [TicketController::class, 'load_create_view'])->name('ticket.create');

Route::post('/estado/agregar', [TicketController::class, 'agregarEstado'])->name('estado.agregar');
Route::post('/estado/eliminar', [TicketController::class, 'eliminarEstado'])->name('estado.eliminar');

Route::post('/upload-image', [ImageController::class, 'store'])->name('imgUpload');
Route::get('/mis_tickets', [TicketController::class, 'show_own_tickets'])->name('ticket.show');

// Rutas protegidas por 'auth' y 'verified'
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/tickets/edit_alert/{id}', [TicketController::class, 'edit_index'])->name('ticket.edit');
    Route::post('/tickets/edit_store_alert', [TicketController::class, 'edit'])->name('ticket.edit_store');

    Route::get('/tickets/gest_alert/{id}', [TicketController::class, 'gest_index'])->name('ticket.gest');
    Route::post('/tickets/gest_alert', [TicketController::class, 'completed'])->name('ticket.completed');
});

// Rutas protegidas para el perfil de usuario
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Ruta de creación de tickets, sin middleware adicional
Route::post('/tickets/create_ticket', [TicketController::class, 'store'])->name('ticket.store');

require __DIR__ . '/auth.php';

<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GestAlertsController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;

// Rutas públicas
Route::get('admin', function () {
    return view('auth/login');
})->name('profile_view');

Route::get('/', [TicketController::class, 'index'])->name('ticket.dashboard');

Route::get('/new_ticket/id', [TicketController::class, 'load_create_view'])->name('ticket.create');
Route::post('/tickets/create_ticket', [TicketController::class, 'store'])->name('ticket.store');
Route::get('/mis_tickets', [TicketController::class, 'show_own_tickets'])->name('ticket.show');
Route::get('/view/{id}', [TicketController::class, 'gest_ticket'])->name('ticket.gest');


Route::post('/estado/agregar', [TicketController::class, 'agregarEstado'])->name('estado.agregar');
Route::post('/estado/eliminar', [TicketController::class, 'eliminarEstado'])->name('estado.eliminar');

Route::post('/upload-image', [ImageController::class, 'store'])->name('imgUpload');
Route::post('/tickets/gest_alert/response', [TicketController::class, 'ticket_response_store'])->name('ticket.response');
Route::get('/ticket/{ticketId}/new-messages', [TicketController::class, 'checkNewMessages'])->name('ticket.checkNewMessages');



// Rutas protegidas por 'auth' y 'verified'
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/tickets/edit_alert/{id}', [TicketController::class, 'edit_index'])->name('ticket.edit');
    Route::post('/tickets/edit_store_alert', [TicketController::class, 'edit'])->name('ticket.edit_store');

    //Route::get('/tickets/gest_alert/{id}', [TicketController::class, 'gest_index'])->name('ticket.gest');
    Route::post('/tickets/gest_alert', [TicketController::class, 'completed'])->name('ticket.completed');
});

// Rutas protegidas para el perfil de usuario
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

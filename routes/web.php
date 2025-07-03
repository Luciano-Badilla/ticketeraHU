<?php

use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckUserRole;
use App\Http\Middleware\CheckUserAccess;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\UserGuideController;
use Illuminate\Support\Facades\Auth;


// Rutas públicas
Route::get('admin', function () {
    return view('auth/login');
})->name('profile_view');

Route::get('/select_ticketera', [TicketController::class, 'index'])->name('ticketera.dashboard');

Route::get('/new_ticket/id', [TicketController::class, 'load_create_view'])->name('ticket.create');
Route::post('/tickets/create_ticket', [TicketController::class, 'store'])->name('ticket.store');
Route::get('/mis_tickets', [TicketController::class, 'show_own_tickets'])->name('ticket.show');
Route::get('/view/{id?}', [TicketController::class, 'gest_ticket'])->name('ticket.gest');

Route::post('/estado/agregar', [TicketController::class, 'agregarEstado'])->name('estado.agregar');
Route::post('/estado/eliminar', [TicketController::class, 'eliminarEstado'])->name('estado.eliminar');

Route::post('/upload-image', [ImageController::class, 'store'])->name('imgUpload');
Route::post('video-upload', [VideoController::class, 'store'])->name('videoUpload');

Route::post('/tickets/gest_alert/response', [TicketController::class, 'ticket_response_store'])->name('ticket.response');
Route::get('/ticket/{ticketId}/new-messages', [TicketController::class, 'checkNewMessages'])->name('ticket.checkNewMessages');
Route::get('/mis_tickets', [TicketController::class, 'show_own_tickets'])->name('ticket.show');
Route::post('/reopen', [TicketController::class, 'reopen_ticket'])->name('ticket.reopen');

Route::post('/login-check', [AuthenticatedSessionController::class, 'checkLogin'])->name('login.check');
Route::post('/select-ticketera', [AuthenticatedSessionController::class, 'selectTicketera'])->name('select.ticketera');

Route::get('/user_guide', [UserGuideController::class, 'index'])->name('guide.user_guide');
Route::get('/user_guide/{id}', [UserGuideController::class, 'guide'])->name('guide.view_guide');



// Rutas protegidas con 'auth' y 'verified'
Route::middleware(['auth', 'verified', CheckUserAccess::class])->group(function () {

    // Rutas para Agente
    Route::middleware([CheckUserRole::class . ':1,2'])->group(function () {
        Route::get('admin/tickets/{typeSort?}/{id?}', [TicketController::class, 'tickets_dashboard'])
            ->name('ticket.dashboard');
        Route::post('admin/ticket/close/{id?}', [TicketController::class, 'close_ticket'])->name('ticket.close');
        Route::post('admin/ticket/reassing', [TicketController::class, 'reassign'])->name('ticket.reassign');
        Route::get('admin/tickets_area_estado', [TicketController::class, 'area_estados_dashboard'])->name('ticket_sorting.dashboard');
        Route::post('admin/stop', [TicketController::class, 'stop_ticket'])->name('ticket.stop');
        Route::post('admin/unstop', [TicketController::class, 'unstop_ticket'])->name('ticket.unstop');
    });

    // Rutas para Administrador
    Route::middleware([CheckUserRole::class . ':2'])->group(function () {
        Route::get('admin/departamentos', [DepartamentoController::class, 'index'])->name('departamento.dashboard');
        Route::post('admin/departamentos/store', [DepartamentoController::class, 'store'])->name('departamento.store');
        Route::post('admin/departamentos/edit', [DepartamentoController::class, 'edit'])->name('departamento.edit');
        Route::get('admin/areas', [AreaController::class, 'index'])->name('area.dashboard');
        Route::post('admin/areas/store', [AreaController::class, 'store'])->name('area.store');
        Route::post('admin/area/edit', [AreaController::class, 'edit'])->name('area.edit');
        Route::get('admin/clientes', [ClienteController::class, 'index'])->name('cliente.dashboard');
        Route::post('admin/clientes/store', [ClienteController::class, 'store'])->name('cliente.store');

        Route::get('admin/usuarios', [UsuarioController::class, 'index'])->name('usuario.dashboard');
        Route::post('admin/usuarios/update/{id}', [UsuarioController::class, 'updateUser'])->name('usuario.update');
        Route::post('admin/usuarios/validate/{id}', [UsuarioController::class, 'validateUser'])->name('usuario.validate');
        Route::post('admin/usuarios/recibe_emails/{id}', [UsuarioController::class, 'recibeEmails'])->name('usuario.recibe_emails');
    });
});

Route::post('/usuarios/requestpassword', [UsuarioController::class, 'requestPassword'])->name('usuarios.requestPassword');
Route::get('usuarios/viewchangepassword', [UsuarioController::class, 'requestPasswordView'])->name('view.changepassword');
Route::post('usuarios/password', [UsuarioController::class, 'passwordUser'])->name('usuario.password');


// Rutas protegidas para el perfil de usuario
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', function () {
    $user = Auth::user();

    if ($user) {
        return redirect()->route('ticket_sorting.dashboard'); // Vista predeterminada si no tiene rol específico
    } else {
        return redirect()->route('ticketera.dashboard'); // Vista predeterminada si no tiene rol específico
    }
})->name('shared');


Route::get('/unauthorized', function () {
    return view('unauthorized'); // Carga la vista 'unauthorized.blade.php'
})->name('unauthorized');

Route::get('/send_restore_email', [TicketController::class, 'send_restore_email'])->name('send.restore_email_ip');
Route::get('/restore_ticket_access/{id}', [TicketController::class, 'restore_ticket_access'])->name('restore.ticket_access');

require __DIR__ . '/auth.php';

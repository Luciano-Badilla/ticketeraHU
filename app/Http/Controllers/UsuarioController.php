<?php

namespace App\Http\Controllers;

use App\Mail\ticketRestorePassword;
use App\Models\EspecialidadModel;
use Illuminate\Support\Facades\Hash;

use App\Models\RolModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UsuarioController extends Controller
{
    //

    public function index()
    {
        $ticketera_id = Auth::user()->ticketera_id;
        $usuarios = User::where('ticketera_id', $ticketera_id)->get();
        $roles = RolModel::all();
        return view('usuarios', [
            'usuarios' => $usuarios,
            'roles' => $roles
        ]);
    }

    public function updateUser(Request $request, $id)
    {
        $usuario = User::find($id);
        if ($usuario) {
            $usuario->rol_id = $request->rol_id;
            $usuario->save();
            return response()->json(['success' => true]);
        }
    }
    public function validateUser(Request $request, $id)
    {
        $usuario = User::find($id);
        if ($usuario) {
            if ($usuario->validated) {
                $usuario->validated = 0;
                $usuario->save();
                return redirect()->route('usuario.dashboard')->with('success', 'Usuario invalidado correctamente.');
            } else {
                $usuario->validated = 1;
                $usuario->save();
                return redirect()->route('usuario.dashboard')->with('success', 'Usuario validado correctamente.');
            }
        }
    }

    public function recibeEmails(Request $request, $id)
    {
        $usuario = User::find($id);
        if ($usuario) {
            if ($usuario->recibe_emails) {
                $usuario->recibe_emails = 0;
                $usuario->save();
                return redirect()->route('usuario.dashboard')->with('success', 'Recibo de email desactivado.');
            } else {
                $usuario->recibe_emails = 1;
                $usuario->save();
                return redirect()->route('usuario.dashboard')->with('success', 'Recibo de email activado.');
            }
        }
    }
    public function requestPassword(Request $request)
    {
        $email = $request->input('addEmail');

        // Obtenemos el primer usuario que coincida con el email
        $usuario = User::where('email', $email)->first();

        if ($usuario) {
            // Actualizamos el campo requestsPassword a 1
            $usuario->requestsPassword = 1;
            $usuario->save(); // Guardamos los cambios
            Mail::to($email)->send(new ticketRestorePassword($email));
        }
        return redirect()->route('login')->with('error', 'Si el correo corresponde a una cuenta, se enviara un mail.');
    }

    public function requestPasswordView(Request $request)
    {
        $email = $request->query('email');

        $usuario = User::where('email', $email)->first();

        if ($usuario->requestsPassword) {
            return view('changepassword', ['email' => $email]);
        } else {
            return redirect()->route('login');
        }
    }

    public function passwordUser(Request $request)
    {

        // Obtener el ID del usuario
        $email = $request->input('email'); // Asegúrate de que el ID se pase desde el modal
        $password = $request->input(key: 'password');

        // Buscar al usuario
        $usuario = User::where('email', $email)->first();

        if ($usuario) {
            // Cambiar la contraseña
            $usuario->password = Hash::make($password);
            $usuario->requestsPassword = 0;
            $usuario->save();

            return redirect()->route('login')->with('error', 'Contraseña cambiada correctamente.');
        } else {
            return redirect()->route('login')->with('error', 'Usuario no encontrado.');
        }
    }
}

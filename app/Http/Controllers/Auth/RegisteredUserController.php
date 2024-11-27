<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException; // Asegúrate de tener esta línea


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    public function store(Request $request): RedirectResponse
    {
        // Validaciones iniciales
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'ticketera' => ['required', 'int'],
            'email' => ['required', 'string', 'email', 'lowercase', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Crear el usuario
        $user = User::create([
            'name_and_surname' => $request->name,
            'email' => $request->email,
            'ticketera_id' => $request->ticketera,
            'password' => Hash::make($request->password),
            'validated' => false, // Asegúrate de que la cuenta no esté validada de entrada
        ]);

        // Verifica si el usuario fue creado sin validación
        if (!$user->validated) {
            throw ValidationException::withMessages([
                'email' => 'Tu cuenta debe ser validada, por favor envía un ticket a TICS para solicitar la validación con los siguientes datos: (' . $user->name_and_surname . ', ' . $user->email . ').',
            ])->redirectTo(route('login', [], false));
        }

        // Dispara el evento de registro del usuario
        event(new Registered($user));

        // Redirige al login
        return redirect(route('login', [], false));
    }
}

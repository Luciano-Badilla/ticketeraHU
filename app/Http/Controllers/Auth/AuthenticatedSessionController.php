<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\DashboardTicketModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        $ticketeras = DashboardTicketModel::all();
        return view('auth.login', ['ticketeras' => $ticketeras]);
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');
        $ticketeraId = $request->input('ticket_id');

        $users = User::where('email', $credentials['email'])->get();
        $validUsers = $users->filter(function ($user) use ($credentials) {
            return Hash::check($credentials['password'], $user->password);
        });

        if ($validUsers->count() > 1 && $ticketeraId) {
            $selectedUser = $validUsers->firstWhere('ticketera_id', $ticketeraId);
            if ($selectedUser) {
                $user = $selectedUser;
                if ($user->validated) {
                    Auth::login($selectedUser,$remember);
                    $request->session()->regenerate();

                    return redirect()->intended(route('ticket_sorting.dashboard'));
                } else {
                    return redirect()->back()->with('error', 'Tu usuario no ha sido validado, por favor envía un ticket a ' . DashboardTicketModel::find($selectedUser->ticketera_id)->titulo . ' con tus datos para poder avanzar con el proceso de validación');
                }
            }
        } elseif ($validUsers->count() === 1) {
            $user = $validUsers->first();
            if ($user->validated) {
                Auth::login($user,$remember);
                $request->session()->regenerate();

                return redirect()->intended(route('ticket_sorting.dashboard'));
            } else {
                return redirect()->back()->with('error', 'Tu usuario no ha sido validado, por favor envía un ticket a ' . DashboardTicketModel::find($user->ticketera_id)->titulo . ' con tus datos para poder avanzar con el proceso de validación');
            }
        }

        // Si no se encuentra un usuario válido, lanza un error de validación
        return redirect()->back()->withErrors([
            'email' => 'Email o contraseña incorrectos.',
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function checkLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        $users = User::where('email', $credentials['email'])->get();

        // Verifica la contraseña para cada usuario
        $validUsers = $users->filter(function ($user) use ($credentials) {
            return Hash::check($credentials['password'], $user->password);
        });

        if ($validUsers->count() === 1) {
            // Si solo hay un usuario válido, lo autentica
            Auth::login($validUsers->first(),$remember);
            $request->session()->regenerate();
            return response()->json(['logged' => true]);
        } elseif ($validUsers->count() > 1) {
            // Si hay más de un usuario válido, devuelve los datos para el modal
            $ticketeras = $validUsers->pluck('ticketera_id'); // Obtiene los ticketera_id de ambos usuarios
            return response()->json([
                'duplicated' => true,
                'ticketeras' => $ticketeras
            ]);
        }

        // Si las credenciales son incorrectas, devuelve un error
        return response()->json(['error' => 'Email o contraseña incorrectos.'], 401);
    }
}

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
                    Auth::login($selectedUser);
                    $request->session()->regenerate();

                    return redirect()->intended(route('ticket_sorting.dashboard'));
                } else {
                    return redirect()->back()->with('error', 'Tu usuario no a sido validado por favor envia un ticket a '.DashboardTicketModel::find($selectedUser->ticketera_id)->titulo .' con tus datos para poder avanzar con el proceso de validación');
                }
            }
        } elseif ($validUsers->count() === 1) {
            $user = $validUsers->first();
            if ($user->validated) {
                Auth::login($user);
                $request->session()->regenerate();

                return redirect()->intended(route('ticket_sorting.dashboard'));
            } else {
                return redirect()->back()->with('error', 'Tu usuario no a sido validado por favor envia un ticket a '.DashboardTicketModel::find($user->ticketera_id)->titulo .' con tus datos para poder avanzar con el proceso de validación');

            }
        }

        // Si no se encuentra ningún usuario válido, lanza un error de validación
        return back()->withErrors([
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

        $users = User::where('email', $credentials['email'])
            ->get();

        // Verifica la contraseña para cada usuario
        $validUsers = $users->filter(function ($user) use ($credentials) {
            return Hash::check($credentials['password'], $user->password);
        });

        if ($validUsers->count() === 1) {

            // Si solo hay un usuario válido, lo autentica
            Auth::login($validUsers->first());
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
    }
}

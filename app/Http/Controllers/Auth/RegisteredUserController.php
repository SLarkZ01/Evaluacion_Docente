<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        // Obtener los roles disponibles para mostrarlos en el formulario
        $roles = \App\Models\Rol::all();
        return view('auth.register', compact('roles'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'id_rol' => ['required', 'integer', 'exists:rol,id_rol'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_rol' => $request->id_rol,
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Redireccionar según el rol del usuario
        switch ($user->id_rol) {
            case 1: // Decano
                return redirect()->route('user.index');
            case 2: // Docente
                return redirect()->route('docente.p_docente');
            case 3: // Administrador
                return redirect()->route('Admin.Dashboard');
            default:
                return redirect(RouteServiceProvider::HOME);
        }
    }
}

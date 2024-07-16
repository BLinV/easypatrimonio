<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{

    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $credenciales = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credenciales)) {
            $request->session()->regenerate();
    
            // Obtener el usuario autenticado
            $user = Auth::user();
            // Obtener el personal asociado al usuario autenticado
            $personal = $user->personal;
    
            // Pasar IdPersonal a la vista
            return redirect()->intended('dashboard')->with('IdPersonal', $personal->IdPersonal);
        }
    
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function destroy()
    {
        auth()->logout();
        return redirect()->to('/');
    }
}

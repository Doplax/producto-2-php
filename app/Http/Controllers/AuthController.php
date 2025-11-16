<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Viajero;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login', ['title' => 'Iniciar Sesión']);
    }

    public function showRegister()
    {
        return view('auth.register', ['title' => 'Registro']);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:transfer_viajeros,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $viajero = Viajero::create([
            'nombre' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'apellido1' => '',
            'apellido2' => '',
            'direccion' => '',
            'codigoPostal' => '',
            'ciudad' => '',
            'pais' => '',
            'status' => 'activo',
        ]);

        return redirect()->route('login')->with('success', 'registered');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $viajero = Viajero::where('email', $request->email)->first();

        if ($viajero && Hash::check($request->password, $viajero->password)) {
            if ($viajero->status !== 'activo') {
                return back()->with('error', 'inactive');
            }

            Auth::guard('viajero')->login($viajero);
            $request->session()->put('user_id', $viajero->id_viajero);
            $request->session()->put('user_email', $viajero->email);

            return redirect()->route('home');
        }

        return back()->with('error', 'invalid');
    }

    public function logout(Request $request)
    {
        Auth::guard('viajero')->logout();
        $request->session()->flush();

        return redirect()->route('login');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('formLogin.login');
    }

    public function auth(Request $request)
    {
        $credenciais = $request->validate([
            'email' => 'required|email',
            'password' => 'required|max:15',
        ], [
            'email.required' => 'O email é um campo obrigatorio!',
            'email.email' => 'Digite um email valido',
            'password.required' => 'O campo senha é obrigatorio',
        ]);

        if (Auth::attempt($credenciais, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/')->with('success-login', 'Seja bem vindo!');
        } else {
            return redirect()->route('login')->with('error', 'Usuario ou senha incorreto');
        }
    }

    public function modal(Request $request)
    {
        if ($request->id) {
            $user = auth()->user()->name;
            return redirect()->back()->with('logout', 'Ate qualquer dia leitor, ' . $user . '!');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route("dashboard");
    }


    public function register()
    {   
        
    }
}

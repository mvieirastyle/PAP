<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(): View {
     return view('pages.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            if (Auth::user()->admin)
                return redirect('/admin/');         
            else
                return redirect('/');    
        }

        return back()->withErrors([
            'email' => 'Email ou palavra-passe incorretos.',
        ])->onlyInput('email');
    }

       public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
   
    public function showRegister()
    {
        return view('pages.register');
    }

    public function register(UserRequest $request)
    {

        $request->validated();
   
        $user = User::createNew($request->all());

        Auth::login($user);

        return redirect('/');
    }
}

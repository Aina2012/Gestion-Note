<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginEtu;
use App\Models\User;
use App\Models\Client;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\LoginRequest;
use App\Models\Etudiant;
use App\Models\Proprietaire;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    public function login()
    {
        return view('auth.login');
    }

    public function doLogin(LoginRequest $request)
    {
        $credentials = $request->validated();
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            if ($user->isAdmin()) {
                return redirect()->intended('/home');
            } else {
                return redirect()->intended('/home');
            }
        }

        return back()->withErrors([
            'email' => 'Verifier',
            'password' => 'Verifier'
        ])->onlyInput('email');
    }

    public function doRegister(Request $request)
    {
        $validatedData = $request->validate(
            [
                'nomm' => 'required',
                'emaila' => ['required', 'string', 'email', 'unique:' . User::class],
                'password' => ['required', 'confirmed'],
                'password_confirmation' => ['required']
            ],
            [
                'email.unique' => 'Email deja utilise',
            ]
        );

        $user = User::create([
            'nom' => $request->nom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => false
        ]);
        Auth::login($user);
        return redirect('/');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function insertAd()
    {
        $user = User::create([
            'nom' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'is_admin' => true
        ]);

        Auth::login($user);

        return redirect('/');
    }

    public function inscription()
    {
        $user = User::create([
            'nom' => 'user',
            'email' => 'default0348846103@gmail.com',
            'password' => Hash::make('0348846103'),
            'is_admin' => false
        ]);
    }

  
}
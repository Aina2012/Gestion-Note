<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Equipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class EquipeLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'login' => 'required',
            'password' => 'required',
        ]);

        if (Auth::guard('equipe')->attempt(['login' => $request->login, 'password' => $request->password])) {
            return redirect("/equipe");
        }

        return back()->withErrors([
            'login' => 'Verifier',
            'password' => 'Verifier'
        ])->onlyInput('login');
    }
}

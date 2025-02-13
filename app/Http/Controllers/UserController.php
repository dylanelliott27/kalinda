<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            session()->regenerate();
 
            return response(null, 200);
        }
 
        return response(null, 403);
    }

    public function register(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'name' => ['required'],
            'password' => ['required'],
        ]);

        $user = new User();
        $user->email = $credentials['email'];
        $user->name = $credentials['name'];
        $user->password = $credentials['password'];
        $user->save();

        return response(null, 200);
    }

    public function logout()
    {
        Auth::guard('web')->logout();

        return response(null, 200);
    }

    public function getAuthStatus()
    {
        return Auth::user();
    }
}

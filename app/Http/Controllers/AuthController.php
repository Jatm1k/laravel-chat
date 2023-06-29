<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (!auth()->attempt($request->validated())) {
            return redirect()->back()->withInput()->withErrors([
                'email' => 'Неверный email или пароль'
            ]);
        } else {
            return redirect()->route('chats.index');
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/login');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\RegisterFormRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('auth.login');
    }

    public function authenticate(LoginFormRequest $request): RedirectResponse
    {
        // если пользователь будет найден, автоматически создается сессия
        if (!auth()->attempt($request->validated())) {
            return back()->withErrors([
                'email' => 'Неверный логин или пароль'
            ]);
        }

        return redirect()->route('articles.index');
    }

    public function register(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('auth.register');
    }

    public function store(RegisterFormRequest $request): RedirectResponse
    {
        User::query()->create([
            'name' => $request->get('email'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password'))
        ]);

        return redirect()->route('login');
    }

    public function logout(): RedirectResponse
    {
        auth()->logout();

        return redirect()->route('home');
    }
}
